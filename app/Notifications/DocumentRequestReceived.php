<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\DocumentRequest;

class DocumentRequestReceived extends Notification
{
    use Queueable;

    public DocumentRequest $docRequest;

    public function __construct(DocumentRequest $docRequest)
    {
        $this->docRequest = $docRequest;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $docType  = ucwords(str_replace('_', ' ', $this->docRequest->document_type));
        $name     = trim(($notifiable->first_name ?? '') . ' ' . ($notifiable->last_name ?? ''));
        $logoUrl  = config('app.url') . '/images/circlelogo.png';

        return (new MailMessage)
            ->subject('Document Request Received — Barangay San Miguel II')
            ->from(config('mail.from.address'), 'Barangay San Miguel II')
            ->greeting('Dear ' . ($name ?: 'Resident') . ',')
            ->line('We have successfully received your document request. Our office will process it and notify you once it is ready for pick-up.')
            ->line('---')
            ->line('**Document Type:** ' . $docType)
            ->line('**Purpose:** ' . ($this->docRequest->purpose ?? 'N/A'))
            ->line('**Status:** Pending — Under Review')
            ->line('---')
            ->line('📍 **Pick-up Location:** Barangay San Miguel II Hall, Dasmariñas City, Cavite')
            ->line('🕐 **Office Hours:** Monday to Friday, 8:00 AM – 5:00 PM')
            ->action('View My Requests', url('/resident'))
            ->salutation('— Barangay San Miguel II' . "\n\n" . '*This is an automated message. Please do not reply to this email. For inquiries, please visit the barangay hall or contact us through our official Facebook page.*');
    }

    public function toArray(object $notifiable): array
    {
        $docType = ucwords(str_replace('_', ' ', $this->docRequest->document_type));
        return [
            'type'    => 'document_received',
            'title'   => 'Document Request Received✔️',
            'message' => 'Your request for ' . $docType . ' has been received and is now pending review.',
        ];
    }
}
