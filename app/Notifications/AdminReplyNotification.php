<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;
use App\Models\ResidentMessage;

class AdminReplyNotification extends Notification
{
    use Queueable;

    public ResidentMessage $msg;

    public function __construct(ResidentMessage $msg)
    {
        $this->msg = $msg;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $name = trim(($notifiable->first_name ?? '') . ' ' . ($notifiable->last_name ?? ''));

        return (new MailMessage)
            ->subject('📬 Reply from Barangay San Miguel II — ' . $this->msg->subject)
            ->from(config('mail.from.address'), 'Barangay San Miguel II — Official')
            ->greeting('Dear ' . ($name ?: 'Resident') . ',')
            ->line('The barangay office has replied to your message.')
            ->line('---')
            ->line('**Your Message Subject:** ' . $this->msg->subject)
            ->line('**Your Message:** ' . $this->msg->message)
            ->line('---')
            ->line('**Barangay Office Reply:**')
            ->line($this->msg->admin_reply)
            ->action('View in Portal', url('/resident'))
            ->salutation(
                '— Barangay San Miguel II' . "\n" .
                'Dasmariñas City, Cavite' . "\n\n" .
                '*This is an automated message. Please do not reply to this email. ' .
                'For further inquiries, please visit the barangay hall or message us again through the portal.*'
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'    => 'admin_reply',
            'title'   => '📬 Reply from Barangay Office',
            'message' => 'The office replied to your message: "' . Str::limit($this->msg->subject, 40) . '"',
        ];
    }
}
