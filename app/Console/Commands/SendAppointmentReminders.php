<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DocumentRequest;
use App\Notifications\DocumentAppointmentReminder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders';
    protected $description = 'Send 1-day and 30-minute automated notification bell and email appointment reminders for document requests';

    public function handle()
    {
        $now = Carbon::now();
        $this->info("Checking appointment reminders at: " . $now->toDateTimeString());

        $activeRequests = DocumentRequest::with('user')
            ->whereIn('status', ['pending', 'processing', 'ready'])
            ->whereNotNull('appointment_date')
            ->whereNotNull('appointment_time')
            ->get();

        $sentCount = 0;

        foreach ($activeRequests as $doc) {
            try {
                $appDateTime = Carbon::parse($doc->appointment_date . ' ' . $doc->appointment_time);
            } catch (\Exception $e) {
                continue;
            }

            $diffMinutes = $now->diffInMinutes($appDateTime, false);
            $diffHours = $now->diffInHours($appDateTime, false);

            // 1. 1-DAY BEFORE REMINDER (Scheduled for tomorrow or 12h to 26h away)
            if ($appDateTime->isTomorrow() || ($diffHours >= 12 && $diffHours <= 26)) {
                $alreadySent1Day = DB::table('notifications')
                    ->where('data', 'like', '%"doc_id":' . $doc->id . '%')
                    ->where('data', 'like', '%"reminder_type":"1_day"%')
                    ->exists();

                if (!$alreadySent1Day) {
                    if ($doc->user) {
                        $doc->user->notify(new DocumentAppointmentReminder($doc, '1_day'));
                        $sentCount++;
                        $this->info("Sent 1-Day reminder to User #{$doc->user_id} for Doc #{$doc->id}");
                    } elseif ($doc->guest_email) {
                        Notification::route('mail', $doc->guest_email)
                            ->notify(new DocumentAppointmentReminder($doc, '1_day'));
                        $sentCount++;
                        $this->info("Sent 1-Day reminder to Guest {$doc->guest_email} for Doc #{$doc->id}");
                    }
                }
            }

            // 2. 30-MINUTE BEFORE REMINDER (Within 0 to 35 minutes before scheduled appointment)
            if ($diffMinutes >= 0 && $diffMinutes <= 35) {
                $alreadySent30Min = DB::table('notifications')
                    ->where('data', 'like', '%"doc_id":' . $doc->id . '%')
                    ->where('data', 'like', '%"reminder_type":"30_min"%')
                    ->exists();

                if (!$alreadySent30Min) {
                    if ($doc->user) {
                        $doc->user->notify(new DocumentAppointmentReminder($doc, '30_min'));
                        $sentCount++;
                        $this->info("Sent 30-Min reminder to User #{$doc->user_id} for Doc #{$doc->id}");
                    } elseif ($doc->guest_email) {
                        Notification::route('mail', $doc->guest_email)
                            ->notify(new DocumentAppointmentReminder($doc, '30_min'));
                        $sentCount++;
                        $this->info("Sent 30-Min reminder to Guest {$doc->guest_email} for Doc #{$doc->id}");
                    }
                }
            }

            // 3. MISSED APPOINTMENT 1-TIME NOTIFICATION (If appointment has passed by at least 1 hour and within 3 days, and not yet released/disapproved)
            if ($diffMinutes <= -60 && $diffHours >= -72 && in_array($doc->status, ['pending', 'processing', 'ready'])) {
                $alreadySentMissed = DB::table('notifications')
                    ->where('data', 'like', '%"doc_id":' . $doc->id . '%')
                    ->where('data', 'like', '%"reminder_type":"missed"%')
                    ->exists();

                if (!$alreadySentMissed) {
                    if ($doc->user) {
                        $doc->user->notify(new DocumentAppointmentReminder($doc, 'missed'));
                        $sentCount++;
                        $this->info("Sent Missed Appointment notice to User #{$doc->user_id} for Doc #{$doc->id}");
                    } elseif ($doc->guest_email) {
                        Notification::route('mail', $doc->guest_email)
                            ->notify(new DocumentAppointmentReminder($doc, 'missed'));
                        $sentCount++;
                        $this->info("Sent Missed Appointment notice to Guest {$doc->guest_email} for Doc #{$doc->id}");
                    }
                }
            }
        }

        $this->info("Completed sending {$sentCount} appointment reminder(s).");
        return Command::SUCCESS;
    }
}
