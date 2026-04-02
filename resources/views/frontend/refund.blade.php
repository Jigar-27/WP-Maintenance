@extends('layouts.frontend')

@section('title', 'Refund Policy — WP Maintenance')
@section('meta_description', 'Please read our refund policy carefully. To maintain high transparency and credibility, we outline our terms regarding cancellations and refunds below.')

@push('styles')
<style>
    .refund-page { background: #ffffff; color: #1e293b; padding-bottom: 8rem; font-family: 'Inter', sans-serif; }
    .refund-container { max-width: 900px; margin: 0 auto; padding: 4rem 1.5rem; }

    /* Header */
    .refund-hero { text-align: center; margin-bottom: 5rem; }
    .refund-hero h1 { font-size: 3.5rem; font-weight: 900; color: #010101; letter-spacing: -0.025em; margin-bottom: 1.5rem; }
    .hero-sub { font-size: 1.125rem; color: #854d0e; line-height: 1.6; max-width: 700px; margin: 0 auto; font-weight: 500; }

    /* No Refund Block */
    .no-refund-card {
        background: #ffffff; border: 1px solid #f1f5f9; border-radius: 20px;
        padding: 3.5rem; box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        display: grid; grid-template-columns: 1fr 240px; gap: 3rem; margin-bottom: 5rem; align-items: center;
    }
    .nr-header { display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; }
    .nr-header .material-icons-outlined { color: #1e293b; font-size: 1.75rem; }
    .nr-header h2 { font-size: 1.75rem; font-weight: 850; color: #010101; margin: 0; }
    .nr-text { font-size: 0.9375rem; color: #64748b; line-height: 1.8; margin-bottom: 1.5rem; }
    .nr-text strong { color: #854d0e; font-weight: 800; }
    
    .final-badge-card {
        background: #0f172a; border-radius: 16px; padding: 2.5rem; text-align: center; color: white;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);
    }
    .final-badge-card .material-icons-outlined { font-size: 2.5rem; margin-bottom: 1.25rem; }
    .final-badge-card .badge-text { font-size: 1rem; font-weight: 850; letter-spacing: 0.1em; line-height: 1.4; display: block; }

    /* Terms & Transparency Section */
    .transparency-layout { display: grid; grid-template-columns: 320px 1fr; gap: 4rem; margin-bottom: 6rem; }
    .tl-left h2 { font-size: 1.75rem; font-weight: 900; color: #010101; margin-bottom: 1.5rem; }
    .tl-left p { font-size: 0.9375rem; color: #64748b; line-height: 1.75; }

    .tl-right { display: flex; flex-direction: column; gap: 1.25rem; }
    .trans-card { background: #f8fbff; border-radius: 16px; padding: 2rem 2.5rem; display: flex; align-items: flex-start; gap: 1.5rem; }
    .tc-number { font-size: 1.125rem; font-weight: 900; color: #0f172a; flex-shrink: 0; padding-top: 2px; }
    .tc-content h3 { font-size: 1.0625rem; font-weight: 850; color: #010101; margin-bottom: 0.75rem; }
    .tc-content p { font-size: 0.875rem; color: #64748b; line-height: 1.7; margin: 0; }

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
        .no-refund-card, .transparency-layout, .billing-footer-banner { grid-template-columns: 1fr; gap: 3rem; }
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
            <h1>Refund Policy</h1>
            <p class="hero-sub">Please read our refund policy carefully. To maintain high transparency and credibility, we outline our terms regarding cancellations and refunds below.</p>
        </header>

        {{-- No Refund Policy Block --}}
        <section class="no-refund-card" data-animate>
            <div class="nr-left">
                <div class="nr-header">
                    <span class="material-icons-outlined">gavel</span>
                    <h2>No Refund Policy</h2>
                </div>
                <p class="nr-text">At WP Maintenance, we are committed to providing immediate and high-quality WordPress engineering work. Because our services involve significant labor and technical resources allocated the moment you subscribe, <strong>all sales are final and non-refundable.</strong></p>
                <p class="nr-text" style="margin-bottom: 0;">By purchasing our services, you acknowledge and agree that no refunds will be issued for any reason, including but not limited to dissatisfaction with the service or early termination of the subscription cycle.</p>
            </div>
            <div class="nr-right">
                <div class="final-badge-card">
                    <span class="material-icons-outlined">lock</span>
                    <span class="badge-text">ALL SALES <br> ARE FINAL</span>
                </div>
            </div>
        </section>

        {{-- Terms & Transparency Layout --}}
        <div class="transparency-layout" data-animate>
            <aside class="tl-left">
                <h2>Terms & <br> Transparency</h2>
                <p>Our commitment to excellence means we start working on your site immediately. These terms ensure we can maintain our high standard of service for all clients.</p>
            </aside>
            <div class="tl-right">
                {{-- Point 01 --}}
                <div class="trans-card">
                    <span class="tc-number">01</span>
                    <div class="tc-content">
                        <h3>Immediate Value Delivery</h3>
                        <p>Access to our security monitoring tools, performance audits, and engineer time begins instantly upon subscription, representing immediate value that cannot be returned.</p>
                    </div>
                </div>
                {{-- Point 02 --}}
                <div class="trans-card">
                    <span class="tc-number">02</span>
                    <div class="tc-content">
                        <h3>Cancellation Policy</h3>
                        <p>You may cancel your subscription at any time to prevent future billing. However, no prorated refunds will be issued for the remaining duration of your current billing period.</p>
                    </div>
                </div>
                {{-- Point 03 --}}
                <div class="trans-card">
                    <span class="tc-number">03</span>
                    <div class="tc-content">
                        <h3>Service Continuity</h3>
                        <p>Upon cancellation, you will continue to have full access to our maintenance services until the end of your prepaid billing cycle.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Trust Banner --}}
        <footer class="billing-footer-banner" data-animate>
            <div class="bf-content">
                <h2>Have questions about your billing?</h2>
                <p>Our dedicated support team is available to help clarify any billing terms or subscription concerns.</p>
            </div>
            <div class="bf-actions">
                <a href="{{ route('contact') }}" class="btn-bf-white">Contact Support</a>
                <a href="{{ route('faq') }}" class="btn-bf-outline">Read FAQs</a>
            </div>
        </footer>
    </div>
</div>
@endsection
