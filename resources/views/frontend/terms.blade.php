@extends('layouts.frontend')

@section('title', 'Terms & Conditions — United WPAgency')
@section('meta_description', 'These Terms & Conditions govern your use of the United WPAgency services and website.')

@push('styles')
<style>
    :root {
        --legal-bg: #ffffff;
        --legal-text-p: #64748b;
        --legal-text-h: #0f172a;
        --legal-primary: #ea580c;
        --legal-card-bg: #f8fafc;
    }

    .legal-page { background: var(--legal-bg); color: var(--legal-text-h); padding-top: 2rem; padding-bottom: 6rem; font-family: 'Inter', sans-serif; }
    .legal-container { max-width: 1140px; margin: 0 auto; padding: 0 1.5rem; }

    /* Header Section */
    .legal-header { 
        padding-bottom: 1rem; margin-bottom: 0.5rem;
        text-align: center;
    }
    .lh-badge { color: var(--legal-primary); font-size: 0.75rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1rem; display: block; }
    .lh-title { font-size: 3.5rem; font-weight: 850; color: #010101; margin: 0 0 1rem 0; letter-spacing: -0.04em; line-height: 1.1; }
    .lh-desc { font-size: 1.125rem; color: var(--legal-text-p); line-height: 1.6; max-width: 800px; margin: 0 auto; }
    
    .legal-grid { max-width: 800px; margin: 0 auto; }

    /* Content Area */
    .legal-content { display: flex; flex-direction: column; gap: 1.5rem; }
    .legal-section { scroll-margin-top: 50px; }
    .sec-title { font-size: 1.75rem; font-weight: 850; color: #010101; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 12px; }
    .sec-title span { color: var(--legal-primary); font-size: 1.25rem; font-weight: 900; opacity: 0.5; }
    .sec-p { font-size: 1rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem; }
    
    /* Card Variant */
    .legal-card {
        background: var(--legal-card-bg); border-radius: 16px; padding: 2.5rem; border: 1px solid #edf2f7;
    }

    /* Footer Trust Banner */
    .legal-footer {
        background: #0f172a; border-radius: 24px; padding: 4rem 2rem; text-align: center; color: white; margin-top: 4rem;
    }
    .lf-title { font-size: 2rem; font-weight: 850; margin-bottom: 1rem; color: white; }
    .lf-desc { font-size: 1.125rem; color: #94a3b8; max-width: 600px; margin: 0 auto 2.5rem auto; line-height: 1.6; }
    .btn-support {
        display: inline-flex; align-items: center; gap: 10px; background: var(--legal-primary); color: white;
        padding: 1rem 2.5rem; border-radius: 99px; font-weight: 800; text-decoration: none; transition: transform 0.2s;
    }
    .btn-support:hover { transform: translateY(-2px); }

    @media (max-width: 992px) {
        .lh-title { font-size: 2.75rem; }
    }
</style>
@endpush

@section('content')
<div class="legal-page">
    <div class="legal-container">
        {{-- Header --}}
        <header class="legal-header">
            <span class="lh-badge">Legal Documentation</span>
            <h1 class="lh-title">Terms & Conditions</h1>
            <p class="lh-desc">Welcome to United WP agency. These Terms & Conditions govern your use of our services and website (www.unitedwpagency.com). By accessing or using our services, you agree to be bound by these terms.</p>
        </header>

        <div class="legal-grid">
            {{-- Main Content --}}
            <div class="legal-content">
                {{-- About Us --}}
                <section class="legal-section" id="about">
                    <h2 class="sec-title"><span>01</span> About Us</h2>
                    <div class="legal-card">
                        <p class="sec-p" style="margin-bottom: 0;">United WPAgency is a service offering focused on WordPress website maintenance, support, and related digital services. United WPAgency operates as a product of <strong>ReUnited Technologies Pvt Ltd.</strong></p>
                    </div>
                </section>

                {{-- Services --}}
                <section class="legal-section" id="services">
                    <h2 class="sec-title"><span>02</span> Services</h2>
                    <p class="sec-p">We provide ongoing WordPress maintenance services including updates, backups, performance optimization, security monitoring, and technical support. The scope of services may vary depending on the selected plan or agreement.</p>
                    <p class="sec-p">While we strive to ensure optimal website performance and security, we do not guarantee that services will be uninterrupted or error-free at all times.</p>
                </section>

                {{-- User Responsibilities --}}
                <section class="legal-section" id="responsibilities">
                    <h2 class="sec-title"><span>03</span> User Responsibilities</h2>
                    <p class="sec-p">Clients are responsible for providing accurate information and ensuring that their website content complies with applicable laws and regulations.</p>
                    <p class="sec-p" style="color: #ef4444; font-weight: 700;">You agree not to use our services for any unlawful, harmful, or malicious activities.</p>
                </section>

                {{-- Payments --}}
                <section class="legal-section" id="payments">
                    <h2 class="sec-title"><span>04</span> Payments</h2>
                    <p class="sec-p">All services are billed as per the selected plan or agreed proposal. Payments must be made in advance unless otherwise agreed. Failure to make timely payments may result in suspension or termination of services.</p>
                </section>

                {{-- IP --}}
                <section class="legal-section" id="ip">
                    <h2 class="sec-title"><span>05</span> Intellectual Property</h2>
                    <p class="sec-p">All content, materials, and custom work created specifically for the client shall remain the property of the client upon full payment. Any proprietary tools, frameworks, or systems used by United WPAgency shall remain our intellectual property.</p>
                </section>

                {{-- Liability --}}
                <section class="legal-section" id="liability" style="margin-top: 1rem;">
                    <h2 class="sec-title"><span>06</span> Limitation of Liability</h2>
                    <p class="sec-p">United WPAgency shall not be held liable for any indirect, incidental, or consequential damages arising from the use or inability to use our services, including but not limited to data loss, downtime, or security breaches.</p>
                </section>

                {{-- Termination --}}
                <section class="legal-section" id="termination">
                    <h2 class="sec-title"><span>07</span> Termination</h2>
                    <p class="sec-p">We reserve the right to suspend or terminate services in case of violation of these terms, non-payment, or misuse of services. Clients may also terminate services as per agreed cancellation terms.</p>
                </section>

                {{-- Modifications --}}
                <section class="legal-section" id="modifications">
                    <h2 class="sec-title"><span>08</span> Modifications</h2>
                    <p class="sec-p">We reserve the right to update or modify these Terms & Conditions at any time without prior notice. Continued use of our services constitutes acceptance of the revised terms.</p>
                </section>

                {{-- Footer banner --}}
                <footer class="legal-footer">
                    <h2 class="lf-title">Questions about these terms?</h2>
                    <p class="lf-desc">If you have any questions regarding these Terms & Conditions, please contact our support team.</p>
                    <a href="mailto:{{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}" class="btn-support">
                        <span class="material-icons-outlined">mail</span>
                        {{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}
                    </a>
                </footer>
            </div>
        </div>
    </div>
</div>

@endsection
