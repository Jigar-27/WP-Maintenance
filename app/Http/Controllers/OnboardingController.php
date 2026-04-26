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
        $billingCycle = 'yearly';
        return view('frontend.onboarding', compact('plan', 'plans', 'billingCycle'));

    }

    public function store(Request $request, $planSlug)
    {
        $plan = Plan::where('slug', $planSlug)->firstOrFail();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255', // This is "Contact Name" in the UI
            'email' => 'required|email|max:255',
            'company_name' => 'nullable|string|max:255',
            'website_url' => 'required|url|max:255',
            'wp_username' => 'required|string|max:255',
            'wp_password' => 'required|string|max:255',
            'hosting_login_url' => 'required|url|max:255',
            'hosting_username' => 'required|string|max:255',
            'hosting_password' => 'required|string|max:255',
            'billing_address' => 'nullable|string',
            'terms_agreed' => 'required|accepted',
        ]);

        // Split "first_name" (Contact Name) into two parts for the database
        $nameParts = explode(' ', trim($validated['first_name']), 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '.';

        // Create or update client
        $client = Client::updateOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'company_name' => $validated['company_name'] ?? null,
                'website_url' => $validated['website_url'],
                'wp_username' => $validated['wp_username'],
                'wp_password_encrypted' => encrypt($validated['wp_password']),
                'hosting_login_url' => $validated['hosting_login_url'],
                'hosting_username' => $validated['hosting_username'],
                'hosting_password_encrypted' => encrypt($validated['hosting_password']),
                'billing_address' => $validated['billing_address'] ?? null,
                // Defaulting or clearing other fields
                'wp_admin_url' => null,
                'hosting_provider' => null,
                'phone' => null,
                'billing_name' => null,
                'billing_email' => null,
                'billing_city' => null,
                'billing_state' => null,
                'billing_zip' => null,
                'billing_country' => null,
            ]
        );


        // Dynamic dates and pricing based on billing cycle
        // Hardcoded to Yearly with no discount
        $billingCycle = 'yearly';
        $finalAmount = round($plan->price * 12, 2);
        $endDate = Carbon::now()->addYear();


        // Create subscription
        $subscription = Subscription::create([
            'client_id' => $client->id,
            'plan_id' => $plan->id,
            'start_date' => Carbon::now(),
            'end_date' => $endDate,
            'amount' => $finalAmount,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // TEMPORARY: Skip payment — auto-mark as paid for dummy testing
        // To re-enable payment, replace the lines below with:
        // return redirect()->route('payment', $subscription->id);
        $subscription->update([
            'status' => 'active',
            'payment_status' => 'paid',
            'payment_method' => 'dummy_bypass',
            'transaction_id' => 'txn_dummy_' . strtolower(\Illuminate\Support\Str::random(12)),
        ]);

        // Create invoice (same as PaymentController)
        $invoice = \App\Models\Invoice::create([
            'invoice_number' => \App\Models\Invoice::generateInvoiceNumber(),
            'client_id' => $client->id,
            'subscription_id' => $subscription->id,
            'subtotal' => $subscription->amount,
            'tax' => round($subscription->amount * 0.18, 2),
            'total' => round($subscription->amount * 1.18, 2),
            'status' => 'paid',
            'issue_date' => Carbon::now(),
            'due_date' => $endDate,
            'paid_date' => Carbon::now(),
        ]);

        // No client user provisioning - direct service model only


        // Send emails (silently fail if mail not configured)
        try {
            Mail::to($client->email)->send(new SubscriptionConfirmation($subscription));
            Mail::to($client->billing_email ?? $client->email)->send(new InvoiceMail($invoice));
            Mail::to(config('mail.admin_email', 'admin@wpmaintenance.com'))->send(new AdminNewClient($subscription));
        } catch (\Exception $e) {
            \Log::warning('Email sending failed: ' . $e->getMessage());
        }

        return redirect()->route('success', $subscription->id);
    }
}
