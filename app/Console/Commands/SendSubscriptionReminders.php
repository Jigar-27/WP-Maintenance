<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\ReminderLog;
use App\Mail\SubscriptionReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendSubscriptionReminders extends Command
{
    protected $signature = 'subscriptions:send-reminders';
    protected $description = 'Send subscription expiry reminder emails at 15, 10, 5, and 0 days';

    public function handle()
    {
        $reminderDays = [15, 10, 5, 0];

        foreach ($reminderDays as $days) {
            $flagColumn = "reminder_{$days}_sent";
            $targetDate = Carbon::now()->addDays($days)->toDateString();

            $subscriptions = Subscription::with(['client', 'plan'])
                ->where('status', 'active')
                ->whereDate('end_date', $targetDate)
                ->where($flagColumn, false)
                ->get();

            foreach ($subscriptions as $subscription) {
                try {
                    Mail::to($subscription->client->email)
                        ->send(new SubscriptionReminder($subscription, $days));

                    $subscription->update([$flagColumn => true]);

                    ReminderLog::create([
                        'subscription_id' => $subscription->id,
                        'client_id' => $subscription->client_id,
                        'days_before_expiry' => $days,
                        'email_sent_to' => $subscription->client->email,
                        'status' => 'sent',
                    ]);

                    $this->info("Reminder sent to {$subscription->client->email} ({$days} days before expiry)");
                } catch (\Exception $e) {
                    ReminderLog::create([
                        'subscription_id' => $subscription->id,
                        'client_id' => $subscription->client_id,
                        'days_before_expiry' => $days,
                        'email_sent_to' => $subscription->client->email,
                        'status' => 'failed',
                    ]);

                    $this->error("Failed to send reminder to {$subscription->client->email}: {$e->getMessage()}");
                }
            }
        }

        $this->info('Subscription reminder check completed.');
    }
}
