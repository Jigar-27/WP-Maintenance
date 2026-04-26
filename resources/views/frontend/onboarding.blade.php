@extends('layouts.frontend')

@section('title', 'Setup — ' . $plan->name)

@push('styles')
<style>
    :root {
        --ob-primary: #ea580c;
        --ob-primary-hover: #c2410c;
        --ob-bg: #f8fafc;
        --ob-text: #0f172a;
        --ob-text-muted: #64748b;
        --ob-border: #e2e8f0;
    }

    .onboarding-page {
        background: white;
        padding: 4rem 0 6rem;
        min-height: 100vh;
        color: var(--ob-text);
    }

    .container-setup {
        max-width: 680px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Header */
    .setup-header {
        text-align: left;
        margin-bottom: 2.5rem;
    }

    .setup-badge {
        display: inline-block;
        background: #dae0f5;
        color: #3730a3;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 0.6875rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1.25rem;
    }

    .setup-title {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .setup-title span {
        color: var(--ob-primary);
    }

    .setup-desc {
        font-size: 1rem;
        color: var(--ob-text-muted);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .secure-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f1f5f9;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.625rem;
        font-weight: 800;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Selected Plan Card */
    .plan-mini-card {
        background: #f1f5f9;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
    }

    .pmc-label {
        font-size: 0.625rem;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .pmc-name {
        font-size: 1rem;
        font-weight: 800;
        color: var(--ob-text);
    }

    .pmc-change {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--ob-primary);
        text-decoration: none;
        margin-left: 12px;
    }

    .pmc-check {
        width: 28px;
        height: 28px;
        background: #dae0f5;
        color: #3730a3;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Form Styling */
    .setup-section {
        margin-bottom: 2.5rem;
        padding-top: 1.75rem;
        border-top: 1px solid #f1f5f9;
    }

    .setup-section:first-of-type { border-top: none; padding-top: 0; }

    .setup-section-title {
        text-align: center;
        font-size: 0.6875rem;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        margin-bottom: 1.75rem;
    }

    .setup-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .setup-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 1.25rem;
    }

    .setup-group.full { grid-column: span 2; }

    .setup-label {
        font-size: 0.6875rem;
        font-weight: 800;
        color: var(--ob-text);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .setup-input-wrapper {
        position: relative;
    }

    .setup-input {
        width: 100%;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.85rem 1rem;
        font-size: 0.9375rem;
        color: var(--ob-text);
        transition: border-color 0.2s;
        box-sizing: border-box;
    }

    .setup-input:focus {
        outline: none;
        border-color: var(--ob-primary);
    }
    
    .setup-input::placeholder {
        color: #cbd5e1;
    }

    .setup-eye {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        cursor: pointer;
        font-size: 1.25rem;
    }

    /* Terms */
    .setup-terms {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin: 2.5rem 0;
    }

    .setup-checkbox {
        margin-top: 4px;
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .setup-terms-text {
        font-size: 0.875rem;
        line-height: 1.5;
        color: var(--ob-text-muted);
    }

    .setup-terms-text a {
        color: var(--ob-primary);
        font-weight: 600;
        text-decoration: none;
    }

    /* Action Button */
    .setup-btn {
        width: 100%;
        background: var(--ob-primary);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 1.15rem;
        font-size: 1.125rem;
        font-weight: 800;
        cursor: pointer;
        transition: transform 0.2s, background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 25px rgba(234, 88, 12, 0.2);
    }

    .setup-btn:hover {
        background: var(--ob-primary-hover);
        transform: translateY(-2px);
    }

    .setup-footer-text {
        text-align: center;
        font-size: 0.75rem;
        color: var(--ob-text-muted);
        margin-top: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    @media (max-width: 600px) {
        .setup-grid { grid-template-columns: 1fr; }
        .setup-group { grid-column: span 1 !important; }
        .setup-title { font-size: 2rem; }
    }
</style>
@endpush

@section('content')
<section class="onboarding-page">
    <div class="container-setup">
        
        {{-- Header --}}
        <div class="setup-header">
            <div class="setup-badge">New Customer Onboarding</div>
            <h1 class="setup-title">The WP Maintenance<br><span>Setup.</span></h1>
            <p class="setup-desc">Provide your site details below. Our concierge team will begin the migration and optimization process immediately.</p>
            <div class="secure-badge">
                <span class="material-icons-outlined" style="font-size: 12px">lock</span>
                256-Bit Secure Checkout
            </div>
        </div>

        {{-- Plan Info --}}
        <div class="plan-mini-card">
            <div>
                <div class="pmc-label">Selected Plan</div>
                <div class="pmc-name">
                    {{ $plan->name }} 
                    <span style="color:var(--ob-text-muted); font-weight:400; font-size:0.9375rem; margin-left:8px;">${{ number_format($plan->price * 12, 0) }}/yr</span>
                    <a href="{{ route('plans') }}" class="pmc-change">Change Plan</a>
                </div>

            </div>
            <div class="pmc-check">
                <span class="material-icons-outlined">done</span>
            </div>
        </div>

        {{-- Setup Form --}}
        <form action="{{ route('onboard.store', $plan->slug) }}" method="POST" id="onboardingForm">
            @csrf
            <input type="hidden" name="billing_cycle" value="{{ $billingCycle }}">

            {{-- 1. Website Details --}}
            <div class="setup-section">
                <div class="setup-section-title">Website Details</div>
                <div class="setup-group full">
                    <label class="setup-label">Domain URL *</label>
                    <input type="url" name="website_url" class="setup-input" placeholder="example.com" value="{{ old('website_url') }}" required>
                    @error('website_url') <div style="color:red; font-size:0.75rem; margin-top:4px;">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- 2. Login Credentials --}}
            <div class="setup-section">
                <div class="setup-section-title">Login Credentials</div>
                <div class="setup-grid">
                    <div class="setup-group full">
                        <label class="setup-label">Admin Username *</label>
                        <input type="text" name="wp_username" class="setup-input" placeholder="admin_user" value="{{ old('wp_username') }}" required>
                    </div>
                    <div class="setup-group full">
                        <label class="setup-label">Password *</label>
                        <div class="setup-input-wrapper">
                            <input type="password" name="wp_password" class="setup-input" placeholder="••••••••••••" id="wpPass" required>
                            <span class="material-icons-outlined setup-eye" onclick="togglePass('wpPass')">visibility_off</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Hosting & Access --}}
            <div class="setup-section">
                <div class="setup-section-title">Hosting & Access</div>
                <div class="setup-group full">
                    <label class="setup-label">Hosting/cPanel URL *</label>
                    <input type="url" name="hosting_login_url" class="setup-input" placeholder="e.g. cpanel.yourdomain.com" value="{{ old('hosting_login_url') }}" required>
                </div>
                <div class="setup-grid" style="margin-top: 1rem;">
                    <div class="setup-group">
                        <label class="setup-label">Username *</label>
                        <input type="text" name="hosting_username" class="setup-input" placeholder="Hosting username" value="{{ old('hosting_username') }}" required>
                    </div>
                    <div class="setup-group">
                        <label class="setup-label">Password *</label>
                        <div class="setup-input-wrapper">
                            <input type="password" name="hosting_password" class="setup-input" placeholder="••••••••" id="hostPass" required>
                            <span class="material-icons-outlined setup-eye" onclick="togglePass('hostPass')">visibility_off</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Contact Details --}}
            <div class="setup-section">
                <div class="setup-section-title">Your Contact Details</div>
                <div class="setup-grid">
                    <div class="setup-group">
                        <label class="setup-label">Contact Name *</label>
                        <input type="text" name="first_name" class="setup-input" placeholder="Alex Rivera" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="setup-group">
                        <label class="setup-label">Email Address *</label>
                        <input type="email" name="email" class="setup-input" placeholder="alex@agency.com" value="{{ old('email') }}" required>
                    </div>
                </div>
            </div>

            {{-- 5. Billing Info --}}
            <div class="setup-section">
                <div class="setup-section-title">Who Should We Bill This To?</div>
                <div class="setup-group full">
                    <label class="setup-label">Company Name</label>
                    <input type="text" name="company_name" class="setup-input" placeholder="Enter company name" value="{{ old('company_name') }}">
                </div>
                <div class="setup-group full">
                    <label class="setup-label">Full Address (Optional)</label>
                    <textarea name="billing_address" class="setup-input" rows="2" placeholder="Street, City, Zip Code, Country" style="resize:none;">{{ old('billing_address') }}</textarea>
                </div>
            </div>

            {{-- Terms --}}
            <div class="setup-terms">
                <input type="checkbox" name="terms_agreed" class="setup-checkbox" id="tCheck" value="1" required>
                <label for="tCheck" class="setup-terms-text">
                    I agree to the <a href="{{ route('terms') }}">Terms of Service</a> and authorize to use my details ethically and securely.
                </label>
            </div>

            <button type="submit" class="setup-btn">
                Complete Onboarding & Pay now
                <span class="material-icons-outlined">arrow_forward</span>
            </button>

            <div class="setup-footer-text">
                <span class="material-icons-outlined" style="font-size: 14px">mail</span>
                An email invoice and receipt will be sent.
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function togglePass(id) {
        const el = document.getElementById(id);
        const icon = el.nextElementSibling;
        if (el.type === 'password') {
            el.type = 'text';
            icon.innerText = 'visibility';
        } else {
            el.type = 'password';
            icon.innerText = 'visibility_off';
        }
    }
</script>
@endpush
