@extends('layouts.frontend')

@section('title', 'Contact Us — WP Maintenance')
@section('meta_description', 'Let\'s secure your digital presence. Our concierge team is standing by to ensure your WordPress ecosystem remains performant, secure, and always-on.')

@section('content')
<section class="section contact-page">
    <div class="fp-container">
        {{-- Hero Header --}}
        <div class="contact-hero" data-animate>
            <span class="badge-mini">CONTACT US</span>
            <h1 class="display-lg">Let's secure your digital <br> presence.</h1>
            <p class="body-lg text-muted hero-sub">Our concierge team is standing by to ensure your WordPress ecosystem <br> remains performant, secure, and always-on.</p>
        </div>

        <div class="contact-layout">
            {{-- Left: Contact Form --}}
            <div class="contact-form-card" data-animate>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group flex-1">
                            <label class="form-label-mini" for="name">Name *</label>
                            <input type="text" class="contact-input" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                            @error('name') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group flex-1">
                            <label class="form-label-mini" for="email">Email Address *</label>
                            <input type="email" class="contact-input" id="email" name="email" placeholder="john@example.com" value="{{ old('email') }}" required>
                            @error('email') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label-mini" for="subject">Subject *</label>
                        <input type="text" class="contact-input" id="subject" name="subject" placeholder="Maintenance Inquiry" value="{{ old('subject') }}" required>
                        @error('subject') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label-mini" for="message">Your Message *</label>
                        <textarea class="contact-textarea" id="message" name="message" placeholder="How can our digital custodians help you today?" required>{{ old('message') }}</textarea>
                        @error('message') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn-send">Send Message</button>
                </form>
            </div>

            {{-- Right: Contact Details --}}
            <aside class="contact-details" data-animate>
                {{-- Email --}}
                <div class="detail-item">
                    <div class="icon-box email-icon"><span class="material-icons-outlined">mail</span></div>
                    <div class="detail-content">
                        <span class="label-mini">SUPPORT EMAIL</span>
                        <a href="mailto:support@reunited.tech" class="value-lg">support@reunited.tech</a>
                        <span class="sub-label">24/7 Monitoring for Premium Tier</span>
                    </div>
                </div>

                {{-- Hours --}}
                <div class="detail-item">
                    <div class="icon-box time-icon"><span class="material-icons-outlined">schedule</span></div>
                    <div class="detail-content">
                        <span class="label-mini">BUSINESS HOURS</span>
                        <span class="value-lg">Mon — Fri: 9AM - 6PM EST</span>
                        <span class="sub-label">Emergency response available 24/7</span>
                    </div>
                </div>

                {{-- Monitoring Status --}}
                <div class="status-banner">
                    <div class="sb-header">
                        <div class="sb-left">
                            <span class="dot-green"></span>
                            <span class="sb-title">Active Monitoring</span>
                        </div>
                        <span class="system-badge">All Systems Operational</span>
                    </div>
                    <p class="sb-desc">Our digital custodians are currently managing 1,240+ WordPress environments with 99.9% uptime.</p>
                </div>
            </aside>
        </div>
    </div>
</section>

<style>
    .contact-page { background: #ffffff; padding-top: calc(var(--space-24) + 80px); min-height: 100vh; }
    
    /* Hero Header */
    .contact-hero { margin-bottom: 4rem; padding-left: 2rem; }
    .badge-mini { color: #f97316; font-size: 0.625rem; font-weight: 800; letter-spacing: 0.15em; display: block; margin-bottom: 1.5rem; }
    .contact-hero h1 { font-weight: 900; color: #010101; font-size: 3.5rem; letter-spacing: -0.02em; line-height: 1.1; margin-bottom: 1.5rem; }
    .hero-sub { color: #854d0e; font-size: 1.125rem; line-height: 1.6; font-weight: 500; }

    /* Layout */
    .contact-layout { display: grid; grid-template-columns: 1fr 400px; gap: 4rem; padding: 0 2rem; }

    /* Form Card */
    .contact-form-card { background: white; padding: 0; border: none; }
    .form-row { display: flex; gap: 1.5rem; margin-bottom: 1.5rem; }
    .flex-1 { flex: 1; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label-mini { display: block; font-size: 0.6875rem; font-weight: 800; color: #854d0e; margin-bottom: 10px; letter-spacing: 0.02em; }
    
    .contact-input, .contact-textarea {
        width: 100%; background: #f0f4f9; border: none; border-radius: 8px; padding: 1.125rem;
        font-size: 0.9375rem; color: #1e293b; transition: all 0.2s;
    }
    .contact-input::placeholder, .contact-textarea::placeholder { color: #94a3b8; }
    .contact-input:focus, .contact-textarea:focus { background: #e2eaf3; outline: none; box-shadow: 0 0 0 4px rgba(240, 244, 249, 0.5); }
    .contact-textarea { min-height: 180px; resize: none; }

    .btn-send {
        background: #f97316; color: white; border: none; padding: 1.125rem 2.5rem; border-radius: 10px;
        font-weight: 800; font-size: 0.9375rem; cursor: pointer; transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2);
    }
    .btn-send:hover { background: #ea580c; transform: translateY(-2px); box-shadow: 0 6px 18px rgba(249, 115, 22, 0.3); }

    /* Right Details */
    .contact-details { display: flex; flex-direction: column; gap: 2.5rem; padding-top: 1rem; }
    .detail-item { display: flex; gap: 1.25rem; align-items: flex-start; }
    
    .icon-box {
        width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;
        border-radius: 10px; flex-shrink: 0;
    }
    .email-icon { background: #dbeafe; color: #1e40af; }
    .time-icon { background: #dbeafe; color: #1e40af; opacity: 0.8; }
    .icon-box .material-icons-outlined { font-size: 1.25rem; }

    .detail-content { display: flex; flex-direction: column; }
    .label-mini { font-size: 0.625rem; font-weight: 800; color: #64748b; letter-spacing: 0.1em; margin-bottom: 2px; }
    .value-lg { font-size: 1.125rem; font-weight: 800; color: #010101; text-decoration: none; transition: color 0.2s; }
    .value-lg:hover { color: #f97316; }
    .sub-label { font-size: 0.75rem; color: #94a3b8; font-weight: 500; margin-top: 2px; }

    /* Status Banner */
    .status-banner { background: #f0f6ff; border-radius: 12px; padding: 1.75rem; margin-top: 1rem; }
    .sb-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .sb-left { display: flex; align-items: center; gap: 8px; }
    .dot-green { width: 8px; height: 8px; background: #854d0e; border-radius: 50%; display: block; }
    .sb-title { font-size: 0.8125rem; font-weight: 800; color: #1e293b; }
    .system-badge { background: #dbeafe; color: #1e40af; font-size: 0.625rem; font-weight: 700; padding: 4px 10px; border-radius: 99px; }
    .sb-desc { font-size: 0.75rem; color: #64748b; line-height: 1.6; margin: 0; }

    @media (max-width: 992px) {
        .contact-layout { grid-template-columns: 1fr; gap: 4rem; }
        .contact-hero h1 { font-size: 2.5rem; }
    }
</style>
@endsection
