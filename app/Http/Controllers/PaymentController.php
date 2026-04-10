<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Invoice;
use App\Models\User;
use App\Mail\SubscriptionConfirmation;
use App\Mail\InvoiceMail;
use App\Mail\AdminNewClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function show($subscriptionId)
    {
        $subscription = Subscription::with(['client', 'plan'])->findOrFail($subscriptionId);

        if ($subscription->payment_status === 'paid') {
            return redirect()->route('success', $subscription->id);
        }

        return view('frontend.payment', compact('subscription'));
    }

    public function process(Request $request, $subscriptionId)
    {
        $subscription = Subscription::with(['client', 'plan'])->findOrFail($subscriptionId);

        // Simulate payment processing
        $subscription->update([
            'status' => 'active',
            'payment_status' => 'paid',
            'payment_method' => $request->input('payment_method', 'card'),
            'transaction_id' => 'txn_' . strtolower(str()->random(16)),
        ]);

        // Create invoice
        $invoice = Invoice::create([
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'client_id' => $subscription->client_id,
            'subscription_id' => $subscription->id,
            'subtotal' => $subscription->amount,
            'tax' => round($subscription->amount * 0.18, 2),
            'total' => round($subscription->amount * 1.18, 2),
            'status' => 'paid',
            'issue_date' => Carbon::now(),
            'due_date' => $subscription->end_date,
            'paid_date' => Carbon::now(),
        ]);

        // Client users are provisioned only after purchase succeeds.
        User::firstOrCreate(
            ['email' => $subscription->client->email],
            [
                'name' => trim(($subscription->client->first_name ?? '') . ' ' . ($subscription->client->last_name ?? '')) ?: ($subscription->client->company_name ?? 'Client User'),
                'password' => Hash::make('password'),
                'role' => 'client',
                'email_verified_at' => now(),
            ]
        );

        // Send emails (silently fail if mail not configured)
        try {
            Mail::to($subscription->client->email)->send(new SubscriptionConfirmation($subscription));
            Mail::to($subscription->client->billing_email ?? $subscription->client->email)->send(new InvoiceMail($invoice));
            Mail::to(config('mail.admin_email', 'admin@wpmaintenance.com'))->send(new AdminNewClient($subscription));
        } catch (\Exception $e) {
            // Log but don't fail
            \Log::warning('Email sending failed: ' . $e->getMessage());
        }

        return redirect()->route('success', $subscription->id);
    }

    public function success($subscriptionId)
    {
        $subscription = Subscription::with(['client', 'plan'])->findOrFail($subscriptionId);
        $invoice = Invoice::where('subscription_id', $subscription->id)->latest()->first();
        return view('frontend.success', compact('subscription', 'invoice'));
    }

    public function publicInvoice($invoiceId)
    {
        $invoice = Invoice::with(['client', 'subscription.plan'])->findOrFail($invoiceId);
        return view('frontend.invoice', compact('invoice'));
    }
}
