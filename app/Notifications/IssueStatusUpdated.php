<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\IssueReport;

class IssueStatusUpdated extends Notification
{
    use Queueable;

    public $issue;

    public function __construct(IssueReport $issue)
    {
        $this->issue = $issue;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Incident Report Status Updated')
                    ->greeting('Hello, ' . ($notifiable->first_name ?? $notifiable->name) . '!')
                    ->line('The status of your incident report ('.$this->issue->issue_type.') has been updated.')
                    ->line('New Status: ' . ucfirst(str_replace('_', ' ', $this->issue->status)))
                    ->action('View Your Dashboard', url('/resident'))
                    ->line('Thank you for using the Barangay San Miguel II notification system.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'type'    => 'issue_status',
            'title'   => 'Incident Status Updated',
            'message' => 'Status for your report ' . $this->issue->issue_type . ' is now ' . ucfirst(str_replace('_', ' ', $this->issue->status)),
            'id'      => $this->issue->id,
        ];
    }
}
