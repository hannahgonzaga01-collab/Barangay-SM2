<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\DocumentRequest;
use Carbon\Carbon;

class DocumentAppointmentReminder extends Notification
{
    use Queueable;

    public DocumentRequest $docRequest;
    public string $reminderType; // '1_day', '30_min', or 'missed'

    public function __construct(DocumentRequest $docRequest, string $reminderType = '1_day')
    {
        $this->docRequest = $docRequest;
        $this->reminderType = $reminderType;
    }

    public function via(object $notifiable): array
    {
        if ($notifiable instanceof \Illuminate\Notifications\AnonymousNotifiable) {
            return ['mail'];
        }
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $docType = ucwords(str_replace('_', ' ', $this->docRequest->document_type));
        $name = trim(($notifiable->first_name ?? '') . ' ' . ($notifiable->last_name ?? ''));
        if (!$name && !empty($this->docRequest->guest_first_name)) {
            $name = trim($this->docRequest->guest_first_name . ' ' . $this->docRequest->guest_last_name);
        }

        $appDate = Carbon::parse($this->docRequest->appointment_date)->format('F j, Y (l)');
        $appTime = Carbon::parse($this->docRequest->appointment_time)->format('h:i A');

        if ($this->reminderType === 'missed') {
            return (new MailMessage)
                ->subject('⚠️ Missed Appointment Notice: Document Pick-up — Barangay San Miguel II')
                ->from(config('mail.from.address', 'noreply@barangaysanmiguel2.gov.ph'), 'Barangay San Miguel II')
                ->greeting('Dear ' . ($name ?: 'Resident') . ',')
                ->line('We noticed that you were unable to claim your **' . $docType . '** on your scheduled appointment (' . $appDate . ' at ' . $appTime . ').')
                ->line('---')
                ->line('**📄 Document:** ' . $docType)
                ->line('**📅 Missed Schedule:** ' . $appDate . ' at ' . $appTime)
                ->line('**📍 Pick-up Location:** Barangay San Miguel II Hall, Dasmariñas City, Cavite')
                ->line('---')
                ->line('**🔄 Would you like to reschedule your appointment?**')
                ->line('• You can easily select a new date and time that fits your schedule directly in your **Resident Portal**.')
                ->line('• Alternatively, you may personally visit the Barangay Hall during office hours (Monday to Friday, 8:00 AM – 5:00 PM) to claim your document.')
                ->line('• Please remember to bring your **Valid ID** when claiming.')
                ->action('Reschedule My Appointment', url('/resident'))
                ->salutation("Barangay San Miguel II Secretariat\n\n*This is an automated appointment notification. Please do not reply to this email.*");
        }

        $is30Min = ($this->reminderType === '30_min');

        $subject = $is30Min
            ? '⏰ Urgent Reminder: Document Pick-up in 30 Minutes — Barangay San Miguel II'
            : '📅 Appointment Reminder: Document Pick-up Tomorrow — Barangay San Miguel II';

        $headline = $is30Min
            ? 'Your scheduled document pick-up appointment at the Barangay Hall is in **30 minutes**.'
            : 'This is a reminder that your scheduled document pick-up appointment is **tomorrow**.';

        return (new MailMessage)
            ->subject($subject)
            ->from(config('mail.from.address', 'noreply@barangaysanmiguel2.gov.ph'), 'Barangay San Miguel II')
            ->greeting('Dear ' . ($name ?: 'Resident') . ',')
            ->line($headline)
            ->line('---')
            ->line('**📄 Document Requested:** ' . $docType)
            ->line('**📅 Scheduled Date:** ' . $appDate)
            ->line('**⏰ Scheduled Time:** ' . $appTime)
            ->line('**👤 Personnel in Charge:** ' . ($this->docRequest->personnel_in_charge ?: 'Duty Officer / Admin Staff'))
            ->line('**👥 Alternate Personnel (if unavailable):** ' . ($this->docRequest->alternate_personnel ?: 'Any available staff (Barangay San Miguel II Hall, Dasmariñas City, Cavite)'))
            ->line('**📍 Pick-up Location:** Barangay San Miguel II Hall, Dasmariñas City, Cavite')
            ->line('---')
            ->line('**📌 Important Claiming Instructions:**')
            ->line('• Upon arrival at the Barangay Hall, look for **' . ($this->docRequest->personnel_in_charge ?: 'the Duty Officer') . '**. If unavailable, look for **' . ($this->docRequest->alternate_personnel ?: 'Any available staff (Barangay San Miguel II Hall, Dasmariñas City, Cavite)') . '**.')
            ->line('• Please bring a **Valid Government-issued ID** upon claiming.')
            ->line('• If claiming on behalf of someone as an Authorized Person, please present the signed **Authorization Letter** and valid ID.')
            ->line('• Please arrive on time to be assisted promptly.')
            ->action('View My Document Requests', url('/resident'))
            ->salutation("Barangay San Miguel II Secretariat\n\n*This is an automated appointment reminder. Please do not reply to this email.*");
    }

    public function toArray(object $notifiable): array
    {
        $docType = ucwords(str_replace('_', ' ', $this->docRequest->document_type));
        $appDate = Carbon::parse($this->docRequest->appointment_date)->format('M d, Y');
        $appTime = Carbon::parse($this->docRequest->appointment_time)->format('h:i A');

        if ($this->reminderType === 'missed') {
            return [
                'type'             => 'appointment_reminder',
                'reminder_type'    => 'missed',
                'doc_id'           => $this->docRequest->id,
                'document_type'    => $this->docRequest->document_type,
                'appointment_date' => $this->docRequest->appointment_date,
                'appointment_time' => $this->docRequest->appointment_time,
                'title'            => '⚠️ Missed Appointment (' . $appDate . ')',
                'message'          => "You missed your scheduled pick-up for {$docType} on {$appDate} at {$appTime}. Would you like to reschedule?",
            ];
        }

        $is30Min = ($this->reminderType === '30_min');

        $title = $is30Min
            ? '⏰ Pick-up in 30 Mins (' . $appTime . ')'
            : '📅 Pick-up Reminder Tomorrow (' . $appDate . ')';

        $personnelInfo = $this->docRequest->personnel_in_charge 
            ? " Look for: {$this->docRequest->personnel_in_charge}" . ($this->docRequest->alternate_personnel ? " (Alternate: {$this->docRequest->alternate_personnel})" : "") . "." 
            : "";

        $message = $is30Min
            ? "Your appointment to pick up your {$docType} is in 30 minutes ({$appTime}).{$personnelInfo} Please prepare your Valid ID and proceed to the Barangay Hall."
            : "Reminder: You have an appointment tomorrow ({$appDate}) at {$appTime} to pick up your {$docType}.{$personnelInfo} Please bring your Valid ID.";

        return [
            'type'             => 'appointment_reminder',
            'reminder_type'    => $this->reminderType,
            'doc_id'           => $this->docRequest->id,
            'document_type'    => $this->docRequest->document_type,
            'appointment_date' => $this->docRequest->appointment_date,
            'appointment_time' => $this->docRequest->appointment_time,
            'title'            => $title,
            'message'          => $message,
        ];
    }
}
