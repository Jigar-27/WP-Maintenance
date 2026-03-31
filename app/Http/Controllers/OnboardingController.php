<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Invoice;
use App\Mail\SubscriptionConfirmation;
use App\Mail\InvoiceMail;
use App\Mail\AdminNewClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OnboardingController extends Controller
{
    public function show($planSlug)
    {
        $plan = Plan::where('slug', $planSlug)->firstOrFail();
        $plans = Plan::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.onboarding', compact('plan', 'plans'));
    }

    public function store(Request $request, $planSlug)
    {
        $plan = Plan::where('slug', $planSlug)->firstOrFail();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'website_url' => 'required|url|max:255',
            'wp_admin_url' => 'nullable|url|max:255',
            'wp_username' => 'nullable|string|max:255',
            'wp_password' => 'nullable|string|max:255',
            'hosting_provider' => 'nullable|string|max:255',
            'hosting_login_url' => 'nullable|url|max:255',
            'hosting_username' => 'nullable|string|max:255',
            'hosting_password' => 'nullable|string|max:255',
            'sftp_host' => 'nullable|string|max:255',
            'sftp_username' => 'nullable|string|max:255',
            'sftp_password' => 'nullable|string|max:255',
            'sftp_port' => 'nullable|integer',
            'billing_name' => 'nullable|string|max:255',
            'billing_email' => 'nullable|email|max:255',
            'billing_address' => 'nullable|string',
            'billing_city' => 'nullable|string|max:255',
            'billing_state' => 'nullable|string|max:255',
            'billing_zip' => 'nullable|string|max:20',
            'billing_country' => 'nullable|string|max:255',
            'terms_agreed' => 'required|accepted',
        ]);

        // Create or update client
        $client = Client::updateOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'] ?? null,
                'company_name' => $validated['company_name'] ?? null,
                'website_url' => $validated['website_url'],
                'wp_admin_url' => $validated['wp_admin_url'] ?? null,
                'wp_username' => $validated['wp_username'] ?? null,
                'wp_password_encrypted' => isset($validated['wp_password']) ? encrypt($validated['wp_password']) : null,
                'hosting_provider' => $validated['hosting_provider'] ?? null,
                'hosting_login_url' => $validated['hosting_login_url'] ?? null,
                'hosting_username' => $validated['hosting_username'] ?? null,
                'hosting_password_encrypted' => isset($validated['hosting_password']) ? encrypt($validated['hosting_password']) : null,
                'sftp_host' => $validated['sftp_host'] ?? null,
                'sftp_username' => $validated['sftp_username'] ?? null,
                'sftp_password_encrypted' => isset($validated['sftp_password']) ? encrypt($validated['sftp_password']) : null,
                'sftp_port' => $validated['sftp_port'] ?? 22,
                'billing_name' => $validated['billing_name'] ?? null,
                'billing_email' => $validated['billing_email'] ?? null,
                'billing_address' => $validated['billing_address'] ?? null,
                'billing_city' => $validated['billing_city'] ?? null,
                'billing_state' => $validated['billing_state'] ?? null,
                'billing_zip' => $validated['billing_zip'] ?? null,
                'billing_country' => $validated['billing_country'] ?? null,
            ]
        );

        // Create subscription
        $subscription = Subscription::create([
            'client_id' => $client->id,
            'plan_id' => $plan->id,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth(),
            'amount' => $plan->price,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('payment', $subscription->id);
    }
}
