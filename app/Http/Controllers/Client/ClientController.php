<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Plan;

class ClientController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $client = Client::where('email', $user->email)
            ->orWhere('billing_email', $user->email)
            ->first();

        if (!$client) {
            return redirect()->route('plans')
                ->with('error', 'No client profile found. Please choose a plan first.');
        }

        $activeSubscription = $client->subscriptions()
            ->with('plan')
            ->whereIn('status', ['active', 'pending', 'expired'])
            ->latest('start_date')
            ->first();

        if (!$activeSubscription) {
            return redirect()->route('plans')
                ->with('error', 'No active plan found for this account. Please choose a plan to continue.');
        }

        $plans = Plan::where('is_active', true)->orderBy('sort_order')->get();
        $currentSortOrder = (int) optional($activeSubscription->plan)->sort_order;
        $upgradePlan = $plans->first(fn ($plan) => $plan->sort_order > $currentSortOrder);

        return view('client.dashboard', compact('client', 'activeSubscription', 'upgradePlan'));
    }
}
