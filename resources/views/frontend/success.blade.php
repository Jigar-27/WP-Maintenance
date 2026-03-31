@extends('layouts.frontend')

@section('title', 'Subscription Confirmed')

@section('content')
<div class="success-page">
    <div class="success-card card card-elevated" data-animate>
        <div class="success-icon">
            <span class="material-icons-outlined">check_circle</span>
        </div>
        <h1 class="success-title">You're All Set!</h1>
        <p class="success-desc">
            Thank you, <strong>{{ $subscription->client->first_name }}</strong>. Your <strong>{{ $subscription->plan->name }}</strong> subscription is now active.
            Our concierge team will begin the onboarding process for <strong>{{ $subscription->client->website_url }}</strong> immediately.
        </p>

        <div class="payment-summary mb-8" style="text-align:left">
            <div class="payment-line">
                <span class="body-sm text-muted">Subscription</span>
                <span class="title-md">{{ $subscription->plan->name }}</span>
            </div>
            <div class="payment-line">
                <span class="body-sm text-muted">Website</span>
                <span class="body-md">{{ $subscription->client->website_url }}</span>
            </div>
            <div class="payment-line">
                <span class="body-sm text-muted">Period</span>
                <span class="body-md">{{ $subscription->start_date->format('M d, Y') }} — {{ $subscription->end_date->format('M d, Y') }}</span>
            </div>
            <div class="payment-line">
                <span class="body-sm text-muted">Amount Paid</span>
                <span class="title-md text-primary">${{ number_format($subscription->amount * 1.18, 2) }}</span>
            </div>
        </div>

        <div class="alert alert-info mb-6" style="text-align:left">
            <span class="material-icons-outlined">mail</span>
            A confirmation email and invoice have been sent to <strong>{{ $subscription->client->email }}</strong>
        </div>

        <div style="display:flex; gap: var(--space-4); flex-wrap:wrap; justify-content:center">
            <a href="{{ route('client.dashboard') }}" class="btn btn-primary">Back to Home</a>
            <a href="{{ route('contact') }}" class="btn btn-outline">Contact Support</a>
        </div>
    </div>
</div>
@endsection
