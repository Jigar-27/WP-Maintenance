@extends('layouts.frontend')

@section('title', 'Onboarding — ' . $plan->name)
@section('meta_description', 'Complete your WordPress site details to get started with ' . $plan->name . ' maintenance plan.')

@section('content')
<section class="onboarding-page">
    <div class="container container-narrow">
        <div class="onboarding-header" data-animate>
            <div class="hero-overline" style="display:inline-flex; margin-bottom: var(--space-4)">
                <span class="pulse"></span>
                Step 2 of 4
            </div>
            <h1 class="display-md">The Digital Custodian Setup.</h1>
            <p class="body-lg text-muted mt-4">Provide your site details below. Our concierge team will begin the migration and optimization process immediately.</p>
        </div>

        {{-- Selected Plan --}}
        <div class="selected-plan" data-animate>
            <div class="selected-plan-info">
                <div class="selected-plan-icon">
                    <span class="material-icons-outlined">shield</span>
                </div>
                <div>
                    <div class="selected-plan-name">{{ $plan->name }}</div>
                    <div class="body-sm text-muted">{{ $plan->best_for }}</div>
                </div>
            </div>
            <div>
                <div class="selected-plan-price">${{ number_format($plan->price) }}<span class="body-sm text-muted">/mo</span></div>
                <a href="{{ route('plans') }}" class="body-sm text-primary">Change Plan</a>
            </div>
        </div>

        {{-- Onboarding Form --}}
        <div class="onboarding-card" data-animate>
            <form action="{{ route('onboard.store', $plan->slug) }}" method="POST" id="onboardingForm">
                @csrf

                {{-- Website Details --}}
                <div class="form-section">
                    <div class="form-section-title">Website Details</div>
                    <div class="form-grid">
                        <div class="form-group form-full">
                            <label class="form-label" for="website_url">Website URL *</label>
                            <input type="url" class="form-input" id="website_url" name="website_url" placeholder="https://yourwebsite.com" value="{{ old('website_url') }}" required>
                            @error('website_url') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="company_name">Company / Business Name</label>
                            <input type="text" class="form-input" id="company_name" name="company_name" placeholder="Your Company" value="{{ old('company_name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="tel" class="form-input" id="phone" name="phone" placeholder="+1 (555) 000-0000" value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>

                {{-- Login Credentials --}}
                <div class="form-section">
                    <div class="form-section-title">Login Credentials</div>
                    <div class="form-grid">
                        <div class="form-group form-full">
                            <label class="form-label" for="wp_admin_url">WordPress Admin URL</label>
                            <input type="url" class="form-input" id="wp_admin_url" name="wp_admin_url" placeholder="https://yourwebsite.com/wp-admin" value="{{ old('wp_admin_url') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="wp_username">WP Admin Username</label>
                            <input type="text" class="form-input" id="wp_username" name="wp_username" placeholder="admin" value="{{ old('wp_username') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="wp_password">WP Admin Password</label>
                            <input type="password" class="form-input" id="wp_password" name="wp_password" placeholder="••••••••">
                            <div class="form-hint">Stored with bank-grade encryption</div>
                        </div>
                    </div>
                </div>

                {{-- Hosting & Access --}}
                <div class="form-section">
                    <div class="form-section-title">Hosting & Access</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="hosting_provider">Hosting Provider</label>
                            <input type="text" class="form-input" id="hosting_provider" name="hosting_provider" placeholder="e.g. SiteGround, WP Engine" value="{{ old('hosting_provider') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="hosting_login_url">Hosting Login URL</label>
                            <input type="url" class="form-input" id="hosting_login_url" name="hosting_login_url" placeholder="https://hosting-panel.com/login" value="{{ old('hosting_login_url') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="hosting_username">Hosting Username</label>
                            <input type="text" class="form-input" id="hosting_username" name="hosting_username" value="{{ old('hosting_username') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="hosting_password">Hosting Password</label>
                            <input type="password" class="form-input" id="hosting_password" name="hosting_password" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sftp_host">SFTP Host</label>
                            <input type="text" class="form-input" id="sftp_host" name="sftp_host" value="{{ old('sftp_host') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sftp_username">SFTP Username</label>
                            <input type="text" class="form-input" id="sftp_username" name="sftp_username" value="{{ old('sftp_username') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sftp_password">SFTP Password</label>
                            <input type="password" class="form-input" id="sftp_password" name="sftp_password" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sftp_port">SFTP Port</label>
                            <input type="number" class="form-input" id="sftp_port" name="sftp_port" value="{{ old('sftp_port', 22) }}">
                        </div>
                    </div>
                </div>

                {{-- Contact Details --}}
                <div class="form-section">
                    <div class="form-section-title">Your Contact Details</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="first_name">First Name *</label>
                            <input type="text" class="form-input" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="last_name">Last Name *</label>
                            <input type="text" class="form-input" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label" for="email">Email Address *</label>
                            <input type="email" class="form-input" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- Billing --}}
                <div class="form-section">
                    <div class="form-section-title">Who Should We Bill This To?</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="billing_name">Billing Name</label>
                            <input type="text" class="form-input" id="billing_name" name="billing_name" value="{{ old('billing_name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="billing_email">Billing Email</label>
                            <input type="email" class="form-input" id="billing_email" name="billing_email" value="{{ old('billing_email') }}">
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label" for="billing_address">Address</label>
                            <input type="text" class="form-input" id="billing_address" name="billing_address" value="{{ old('billing_address') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="billing_city">City</label>
                            <input type="text" class="form-input" id="billing_city" name="billing_city" value="{{ old('billing_city') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="billing_state">State / Province</label>
                            <input type="text" class="form-input" id="billing_state" name="billing_state" value="{{ old('billing_state') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="billing_zip">ZIP / Postal Code</label>
                            <input type="text" class="form-input" id="billing_zip" name="billing_zip" value="{{ old('billing_zip') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="billing_country">Country</label>
                            <input type="text" class="form-input" id="billing_country" name="billing_country" value="{{ old('billing_country') }}">
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="form-section" style="margin-bottom: var(--space-6)">
                    <div class="form-checkbox">
                        <input type="checkbox" id="terms_agreed" name="terms_agreed" value="1" required>
                        <label for="terms_agreed" class="body-md">
                            I agree to the <a href="{{ route('terms') }}" target="_blank">Terms of Service</a> and <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>.
                        </label>
                    </div>
                    @error('terms_agreed') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    <span class="material-icons-outlined">lock</span>
                    Proceed to Secure Payment
                </button>

                <p class="text-center body-sm text-muted mt-4">
                    <span class="material-icons-outlined" style="font-size:1rem; vertical-align:middle">mail</span>
                    An email invoice and receipt will be sent.
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
