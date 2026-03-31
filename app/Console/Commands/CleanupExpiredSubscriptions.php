<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanupExpiredSubscriptions extends Command
{
    protected $signature = 'subscriptions:cleanup-expired';
    protected $description = 'Delete expired subscription data that has not been renewed';

    public function handle()
    {
        $expiredSubscriptions = Subscription::with('client')
            ->where('status', 'active')
            ->where('end_date', '<', Carbon::now())
            ->get();

        foreach ($expiredSubscriptions as $subscription) {
            $this->info("Marking subscription #{$subscription->id} for {$subscription->client->email} as expired");

            $subscription->update(['status' => 'expired']);

            // Check if client has no other active subscriptions
            $otherActive = Subscription::where('client_id', $subscription->client_id)
                ->where('id', '!=', $subscription->id)
                ->where('status', 'active')
                ->exists();

            if (!$otherActive) {
                $subscription->client->update(['status' => 'inactive']);
                $this->info("Client {$subscription->client->email} marked as inactive");
            }
        }

        // Delete subscription data for expired subs older than 30 days
        $oldExpired = Subscription::where('status', 'expired')
            ->where('end_date', '<', Carbon::now()->subDays(30))
            ->get();

        foreach ($oldExpired as $sub) {
            $this->info("Deleting old expired subscription #{$sub->id}");
            $sub->reminderLogs()->delete();
            $sub->delete();
        }

        $this->info('Expired subscription cleanup completed.');
    }
}
