@extends('layouts.frontend')

@section('title', 'Secure Payment')

@section('content')
<section class="onboarding-page">
    <div class="container" style="max-width: 640px">
        <div class="onboarding-header" data-animate>
            <div class="hero-overline" style="display:inline-flex; margin-bottom: var(--space-4)">
                <span class="material-icons-outlined" style="font-size:1rem">lock</span>
                Step 3 of 4 — Secure Payment
            </div>
            <h1 class="headline-lg">Complete Your Subscription</h1>
            <p class="body-lg text-muted mt-2">Review your order and enter payment details.</p>
        </div>

        <div class="onboarding-card" data-animate>
            {{-- Order Summary --}}
            <div class="payment-summary mb-8">
                <h3 class="title-md mb-4">Order Summary</h3>
                <div class="payment-line">
                    <span>{{ $subscription->plan->name }}</span>
                    <span>${{ number_format($subscription->amount, 2) }}</span>
                </div>
                <div class="payment-line">
                    <span>Tax (18%)</span>
                    <span>${{ number_format($subscription->amount * 0.18, 2) }}</span>
                </div>
                <div class="payment-line total" style="border-top: 1.5px solid var(--surface-container-high)">
                    <span>Total</span>
                    <span>${{ number_format($subscription->amount * 1.18, 2) }}</span>
                </div>
            </div>

            {{-- Payment Form --}}
            <form action="{{ route('payment.process', $subscription->id) }}" method="POST">
                @csrf

                <div class="form-section">
                    <div class="form-section-title">Payment Method</div>
                    <div class="form-group">
                        <div style="display: flex; gap: var(--space-3); margin-bottom: var(--space-5);">
                            <label style="flex:1; display:flex; align-items:center; gap:var(--space-2); padding:var(--space-4); background:var(--surface-container-low); border-radius:var(--radius-md); cursor:pointer; font-size:0.9375rem; font-weight:500;">
                                <input type="radio" name="payment_method" value="card" checked style="accent-color:var(--primary)">
                                <span class="material-icons-outlined" style="font-size:1.25rem">credit_card</span>
                                Credit Card
                            </label>
                            <label style="flex:1; display:flex; align-items:center; gap:var(--space-2); padding:var(--space-4); background:var(--surface-container-low); border-radius:var(--radius-md); cursor:pointer; font-size:0.9375rem; font-weight:500;">
                                <input type="radio" name="payment_method" value="paypal" style="accent-color:var(--primary)">
                                <span class="material-icons-outlined" style="font-size:1.25rem">account_balance</span>
                                PayPal
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="card_name">Cardholder Name</label>
                        <input type="text" class="form-input" id="card_name" placeholder="Name on card" value="{{ $subscription->client->full_name }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="card_number">Card Number</label>
                        <input type="text" class="form-input" id="card_number" placeholder="4242 4242 4242 4242" maxlength="19">
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="card_expiry">Expiry Date</label>
                            <input type="text" class="form-input" id="card_expiry" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="card_cvc">CVC</label>
                            <input type="text" class="form-input" id="card_cvc" placeholder="123" maxlength="4">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    <span class="material-icons-outlined">lock</span>
                    Pay ${{ number_format($subscription->amount * 1.18, 2) }}
                </button>

                <p class="text-center body-sm text-muted mt-4">
                    <span class="material-icons-outlined" style="font-size:0.875rem; vertical-align:middle">verified_user</span>
                    Secured by 256-bit SSL encryption. Trusted Payment Partner.
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
