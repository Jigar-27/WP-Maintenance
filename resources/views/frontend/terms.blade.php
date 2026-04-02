@extends('layouts.frontend')

@section('title', 'Terms of Service — WP Maintenance')
@section('meta_description', 'These terms govern your use of the WP Maintenance concierge services and digital products.')

@push('styles')
<style>
    :root {
        --legal-bg: #ffffff;
        --legal-text-p: #64748b;
        --legal-text-h: #0f172a;
        --legal-blue: #3b82f6;
        --legal-card-bg: #eff6ff;
    }

    .legal-page { background: var(--legal-bg); color: var(--legal-text-h); padding-top: 1rem; padding-bottom: 6rem; font-family: 'Inter', sans-serif; }
    .legal-container { max-width: 1140px; margin: 0 auto; padding: 0 1.5rem; }

    /* Header Section - Minimal Spacing */
    .legal-header { 
        display: flex; justify-content: space-between; align-items: flex-end;
        padding-bottom: 1.5rem; border-bottom: 1px solid #f1f5f9; margin-bottom: 2rem;
    }
    .lh-badge { color: #2563eb; font-size: 0.625rem; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 0.5rem; display: block; }
    .lh-title { font-size: 3.25rem; font-weight: 850; color: #010101; margin: 0 0 0.75rem 0; letter-spacing: -0.03em; line-height: 1; }
    .lh-desc { font-size: 0.9375rem; color: #64748b; line-height: 1.6; max-width: 650px; margin: 0; }
    
    .btn-email-legal {
        display: inline-flex; align-items: center; gap: 10px; background: #0f172a; color: white;
        padding: 0.75rem 1.25rem; border-radius: 8px; font-size: 0.8125rem; font-weight: 750;
        text-decoration: none; transition: background 0.2s; margin-bottom: 0.5rem;
    }
    .btn-email-legal:hover { background: #1e293b; }
    .btn-email-legal .material-icons-outlined { font-size: 1.125rem; }

    /* Layout Grid - Removed Big Gaps */
    .legal-grid { display: grid; grid-template-columns: 240px 1fr; gap: 3rem; align-items: start; }

    /* Sidebar Navigation */
    .nav-sidebar { position: sticky; top: 100px; }
    .nav-title { font-size: 0.625rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 1.25rem; padding-left: 1.25rem; }
    .nav-list { display: flex; flex-direction: column; gap: 0.25rem; }
    .nav-item {
        display: block; padding: 0.75rem 1.25rem; border-radius: 8px; font-size: 0.8125rem;
        font-weight: 600; color: #64748b; text-decoration: none; transition: all 0.2s;
    }
    .nav-item:hover { color: #0f172a; }
    .nav-item.active { background: #eff6ff; color: #2563eb; font-weight: 750; }

    /* Content Area Sections - Tightened Vertical Spacing */
    .legal-content { display: flex; flex-direction: column; gap: 3rem; }
    .legal-section { margin: 0; }
    .sec-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 1.25rem; }
    .sec-number {
        width: 32px; height: 32px; background: #0f172a; color: white; border-radius: 6px;
        display: flex; align-items: center; justify-content: center; font-size: 0.6875rem; font-weight: 800; flex-shrink: 0;
    }
    .sec-title { font-size: 1.5rem; font-weight: 850; color: #0f172a; margin: 0; }
    .sec-p { font-size: 0.9375rem; color: #475569; line-height: 1.75; margin-bottom: 1.25rem; }
    
    /* White Card Variant (Section 02) */
    .legal-card-white {
        background: white; border: 1px solid #f1f5f9; border-radius: 16px; padding: 2.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    }
    .sec-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.125rem; }
    .sec-list li { display: flex; align-items: flex-start; gap: 14px; font-size: 0.875rem; color: #475569; line-height: 1.6; }
    .li-check-box {
        width: 18px; height: 18px; background: #0f172a; color: white; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 3px;
    }
    .li-check-box .material-icons-outlined { font-size: 0.75rem; font-weight: 900; }

    /* Two-Column Cards (Section 04) */
    .sec-cards-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .sec-card-blue { background: var(--legal-card-bg); border-radius: 16px; padding: 2rem; }
    .sc-header { display: flex; align-items: center; gap: 12px; margin-bottom: 1rem; }
    .sc-icon-circle { 
        width: 28px; height: 28px; background: white; border-radius: 50%; 
        display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .sc-icon-circle .material-icons-outlined { color: #0f172a; font-size: 1rem; }
    .sc-title { font-size: 1.125rem; font-weight: 850; color: #0f172a; margin: 0; }
    .sc-p { font-size: 0.8125rem; color: #64748b; line-height: 1.6; margin: 0; }

    /* Footer Trust Banner */
    .legal-footer-banner {
        background: #0f172a; border-radius: 20px; padding: 4rem 2rem; text-align: center;
        margin-top: 1rem;
    }
    .fb-icon-circle {
        width: 50px; height: 50px; background: #2563eb; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;
    }
    .fb-icon-circle::after { content: '?'; color: white; font-size: 1.5rem; font-weight: 800; }
    
    .fb-title { color: white; font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem; }
    .fb-desc { color: #94a3b8; font-size: 0.9375rem; max-width: 480px; margin: 0 auto 2rem auto; line-height: 1.6; }
    .btn-fb-contact {
        display: inline-block; background: #1e293b; color: white; padding: 0.8125rem 2rem;
        border-radius: 8px; font-size: 0.8125rem; font-weight: 750; text-decoration: none;
        border: 1px solid rgba(255,255,255,0.1); transition: all 0.2s;
    }
    .btn-fb-contact:hover { background: #334155; }

    @media (max-width: 992px) {
        .legal-header { flex-direction: column; align-items: flex-start; gap: 1.5rem; }
        .lh-title { font-size: 2.75rem; }
        .legal-grid { grid-template-columns: 1fr; gap: 3rem; }
        .nav-sidebar { position: static; }
        .sec-cards-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="legal-page">
    <div class="legal-container">
        {{-- Header --}}
        <header class="legal-header" data-animate>
            <div class="lh-left">
                <span class="lh-badge">LEGAL DOCUMENTATION</span>
                <h1 class="lh-title">Terms of Service</h1>
                <p class="lh-desc">Last updated: October 24, 2024. These terms govern your use of the WP Maintenance concierge services and digital products.</p>
            </div>
            <div class="lh-right">
                <a href="mailto:legal@wpmaintenance.com" class="btn-email-legal">
                    <span class="material-icons-outlined">mail</span>
                    Email Legal Team
                </a>
            </div>
        </header>

        <div class="legal-grid">
            {{-- Navigation Sidebar --}}
            <aside class="legal-sidebar" data-animate>
                <div class="nav-sidebar">
                    <div class="nav-title">NAVIGATION</div>
                    <nav class="nav-list">
                        <a href="#acceptance" class="nav-item active">1. Acceptance</a>
                        <a href="#responsibilities" class="nav-item">2. User Responsibilities</a>
                        <a href="#service-levels" class="nav-item">3. Service Levels</a>
                        <a href="#payments" class="nav-item">4. Payments & Refunds</a>
                        <a href="#termination" class="nav-item">5. Termination</a>
                    </nav>
                </div>
            </aside>

            {{-- Main Content Column --}}
            <div class="legal-content" data-animate>
                {{-- Section 1: Acceptance --}}
                <section class="legal-section" id="acceptance">
                    <div class="sec-header">
                        <div class="sec-number">01</div>
                        <h2 class="sec-title">Acceptance of Terms</h2>
                    </div>
                    <p class="sec-p">By accessing or using WP Maintenance services, you agree to be bound by these Terms of Service. If you do not agree with any part of these terms, you must immediately cease all use of our services. We provide a "High-End Concierge" service for WordPress management, which includes monitoring, security, updates, and performance optimization.</p>
                </section>

                {{-- Section 2: User Responsibilities --}}
                <section class="legal-section legal-card-white" id="responsibilities">
                    <div class="sec-header">
                        <div class="sec-number">02</div>
                        <h2 class="sec-title">User Responsibilities</h2>
                    </div>
                    <p class="sec-p">To provide our services effectively, you must provide accurate and complete information. You are responsible for:</p>
                    <ul class="sec-list">
                        <li>
                            <div class="li-check-box"><span class="material-icons-outlined">done</span></div>
                            Maintaining the security of your account credentials and notifying us immediately of any unauthorized access.
                        </li>
                        <li>
                            <div class="li-check-box"><span class="material-icons-outlined">done</span></div>
                            Granting necessary administrative access to your WordPress installations for maintenance purposes.
                        </li>
                        <li>
                            <div class="li-check-box"><span class="material-icons-outlined">done</span></div>
                            Ensuring your content does not violate any local, state, or international laws.
                        </li>
                    </ul>
                </section>

                {{-- Section 3: Service Levels & Maintenance --}}
                <section class="legal-section" id="service-levels">
                    <div class="sec-header">
                        <div class="sec-number">03</div>
                        <h2 class="sec-title">Service Levels & Maintenance</h2>
                    </div>
                    <p class="sec-p">Our maintenance status monitoring is provided via a Glassmorphic Status Bar in your client dashboard. While we strive for 100% uptime, updates and maintenance tasks may occasionally cause brief periods of unavailability.</p>
                </section>

                {{-- Section 4: Payments & Refunds --}}
                <div class="sec-cards-grid" id="payments">
                    <div class="sec-card-blue">
                        <div class="sc-header">
                            <div class="sec-number">04</div>
                            <h2 class="sc-title">Payments</h2>
                        </div>
                        <p class="sc-p">Fees are billed in advance on a monthly or annual basis. All fees are non-refundable except where required by law.</p>
                    </div>
                    <div class="sec-card-blue">
                        <div class="sc-header">
                            <div class="sc-icon-circle"><span class="material-icons-outlined">gavel</span></div>
                            <h2 class="sc-title">Refunds</h2>
                        </div>
                        <p class="sc-p">We offer a 30-day satisfaction guarantee for new subscribers. Refund requests must be submitted in writing within the first 30 days.</p>
                    </div>
                </div>

                {{-- Section 5: Termination --}}
                <section class="legal-section" id="termination">
                    <div class="sec-header">
                        <div class="sec-number">05</div>
                        <h2 class="sec-title">Termination</h2>
                    </div>
                    <p class="sec-p">You may cancel your subscription at any time through your client portal. WP Maintenance reserves the right to suspend or terminate access to services for any violation of these terms.</p>
                </section>

                {{-- Footer Banner --}}
                <div class="legal-footer-banner">
                    <div class="fb-icon-circle"></div>
                    <h2 class="fb-title">Have questions about our terms?</h2>
                    <p class="fb-desc">Our legal and concierge teams are here to help you understand your rights and our obligations.</p>
                    <a href="{{ route('contact') }}" class="btn-fb-contact">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('section.legal-section, .sec-cards-grid');
        const navItems = document.querySelectorAll('.nav-item');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= (sectionTop - 180)) {
                    current = section.getAttribute('id');
                }
            });

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href').substring(1) === current) {
                    item.classList.add('active');
                }
            });
        });
    });
</script>
@endsection
