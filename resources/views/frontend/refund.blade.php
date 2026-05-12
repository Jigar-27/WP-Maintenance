@extends('layouts.frontend')

@section('title', 'Refund & Cancellation Policy — United WP agency')
@section('meta_description', 'At United WP agency, we aim to provide our users with clear, honest, and transparent policies regarding the use of our services, including purchases and billing.')

@push('styles')
<style>
    .refund-page { background: #ffffff; color: #1e293b; padding-bottom: 8rem; font-family: 'Inter', sans-serif; }
    .refund-container { max-width: 900px; margin: 0 auto; padding: 4rem 1.5rem; }

    /* Header */
    .refund-hero { text-align: center; margin-bottom: 2rem; }
    .refund-hero h1 { font-size: 3.5rem; font-weight: 900; color: #010101; letter-spacing: -0.025em; margin-bottom: 1.5rem; }
    .hero-sub { font-size: 1.125rem; color: #854d0e; line-height: 1.6; max-width: 700px; margin: 0 auto; font-weight: 500; }

    /* Policy Sections */
    .policy-section { margin-bottom: 5rem; }
    .policy-card {
        background: #ffffff; border: 1px solid #f1f5f9; border-radius: 20px;
        padding: 3.5rem; box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
    }
    .pc-header { display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; }
    .pc-header .material-icons-outlined { color: #854d0e; font-size: 1.75rem; }
    .pc-header h2 { font-size: 1.75rem; font-weight: 850; color: #010101; margin: 0; }
    .pc-text { font-size: 1rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem; }
    .pc-text strong { color: #0f172a; font-weight: 800; }

    /* No Refund Highlight */
    .no-refund-grid { display: grid; grid-template-columns: 1fr 240px; gap: 3rem; align-items: center; }
    .final-badge-card {
        background: #8c2f1b; border-radius: 16px; padding: 2.5rem; text-align: center; color: white;
        box-shadow: 0 20px 40px rgba(140, 47, 27, 0.2);
    }
    .final-badge-card .material-icons-outlined { font-size: 2.5rem; margin-bottom: 1.25rem; }
    .final-badge-card .badge-text { font-size: 1rem; font-weight: 850; letter-spacing: 0.1em; line-height: 1.4; display: block; }

    /* Grid Layout for secondary points */
    .secondary-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-bottom: 3rem; }
    .sec-card { background: #f8fbff; border-radius: 16px; padding: 2.5rem; border: 1px solid #edf2f7; }
    .sec-card h3 { font-size: 1.25rem; font-weight: 850; color: #010101; margin-bottom: 1rem; display: flex; align-items: center; gap: 10px; }
    .sec-card h3 .material-icons-outlined { color: #854d0e; }
    .sec-card p { font-size: 0.9375rem; color: #64748b; line-height: 1.7; margin: 0; }

    /* Footer Banner */
    .billing-footer-banner {
        background: #0f172a; border-radius: 24px; padding: 4rem 3.5rem; color: white;
        display: flex; justify-content: space-between; align-items: center; gap: 3rem;
    }
    .bf-content h2 { font-size: 2rem; font-weight: 850; margin-bottom: 1rem; color: white; }
    .bf-content p { font-size: 1rem; color: #94a3b8; max-width: 450px; line-height: 1.6; margin: 0; }
    .bf-actions { display: flex; gap: 1rem; flex-shrink: 0; align-items: center; }
    
    .btn-bf-white {
        background: #ffffff; color: #0f172a; padding: 0.9375rem 2.25rem; border-radius: 99px;
        font-weight: 800; font-size: 0.875rem; text-decoration: none; border: none; transition: all 0.2s;
    }
    .btn-bf-white:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    
    .btn-bf-outline {
        background: transparent; color: white; padding: 0.9375rem 2.25rem; border-radius: 99px;
        font-weight: 800; font-size: 0.875rem; text-decoration: none; border: 1.5px solid rgba(255,255,255,0.2); transition: all 0.2s;
    }
    .btn-bf-outline:hover { background: rgba(255,255,255,0.05); }

    @media (max-width: 992px) {
        .no-refund-grid, .secondary-grid, .billing-footer-banner { grid-template-columns: 1fr; gap: 3rem; }
        .refund-hero h1 { font-size: 2.75rem; }
        .bf-actions { flex-direction: column; width: 100%; }
        .btn-bf-white, .btn-bf-outline { width: 100%; text-align: center; }
    }
</style>
@endpush

@section('content')
<div class="refund-page">
    <div class="refund-container">
        {{-- Hero Header --}}
        <header class="refund-hero" data-animate>
            <h1>Refund & Cancellation Policy</h1>
            <p class="hero-sub">At United WP agency, we aim to provide our users with clear, honest, and transparent policies regarding the use of our services, including purchases and billing. Please read the following carefully before proceeding with any transactions on our website.</p>
        </header>

        {{-- No Refund Policy Block --}}
        <section class="policy-card no-refund-grid" data-animate>
            <div class="pc-left">
                <div class="pc-header">
                    <span class="material-icons-outlined">gavel</span>
                    <h2>No Refund Policy</h2>
                </div>
                <p class="pc-text">Due to the nature of our services—digital delivery of website development, maintenance, customization, and related solutions—we do not offer refunds once a transaction is completed. This policy applies to all subscription plans, one-time services, and other paid offerings available on the platform.</p>
                <p class="pc-text">When you make a purchase or initiate a service, resources are allocated, and work may begin immediately. Because of this commitment and the inherent nature of digital and service-based offerings, <strong>all sales are final.</strong></p>
                <p class="pc-text" style="font-size: 0.875rem; font-style: italic; color: #94a3b8;">We strongly recommend that users review service details carefully and contact our support team for any pre-purchase clarifications to ensure the services meet their specific requirements.</p>
            </div>
            <div class="pc-right">
                <div class="final-badge-card">
                    <span class="material-icons-outlined">verified</span>
                    <span class="badge-text">DIGITAL SERVICE <br> FINAL SALE</span>
                </div>
            </div>
        </section>

        {{-- Cancellation & Disputes Grid --}}
        <div class="secondary-grid" data-animate>
            {{-- Cancellation --}}
            <div class="sec-card">
                <h3><span class="material-icons-outlined">cancel</span> Cancellation</h3>
                <p>If you are on a recurring subscription plan, you may cancel your subscription at any time before the next billing cycle. Cancellation will prevent future charges, and you will continue to have access to the service until the end of your current billing period.</p>
                <p style="margin-top: 1rem; font-weight: 700; color: #010101; font-size: 0.875rem;">No partial refunds will be provided for unused time within an active subscription.</p>
                <p style="margin-top: 1rem; font-size: 0.8125rem;">To cancel, please email <strong>{{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}</strong> before renewal.</p>
            </div>

            {{-- Dispute Resolution --}}
            <div class="sec-card">
                <h3><span class="material-icons-outlined">help_outline</span> Dispute Resolution</h3>
                <p>In the event of a billing dispute or technical issue, we encourage you to contact our support team immediately. While we maintain a strict no-refund policy, we are committed to reviewing and resolving concerns fairly and promptly where applicable.</p>
                <p style="margin-top: 1rem; font-size: 0.8125rem;">Your trust and satisfaction are important to us. We aim for resolution through open communication.</p>
            </div>
        </div>

        {{-- Footer Trust Banner --}}
        <footer class="billing-footer-banner" data-animate>
            <div class="bf-content">
                <h2>Still have questions?</h2>
                <p>Thank you for choosing United WP agency. If you have any questions about this policy, please contact us at {{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}.</p>
            </div>
            <div class="bf-actions">
                <a href="mailto:{{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}" class="btn-bf-white">Email Support</a>
                <a href="{{ route('contact') }}" class="btn-bf-outline">Contact Page</a>
            </div>
        </footer>
    </div>
</div>
@endsection
