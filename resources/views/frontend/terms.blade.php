@extends('layouts.frontend')
@section('title', 'Terms of Service')

@push('styles')
<style>
/* Base Variables & Reset for Legal Page */
.legal-page-wrapper {
    background-color: #f8fafc; /* Very light slate */
    color: #334155;
    font-family: 'Inter', -apple-system, sans-serif;
    padding-bottom: 6rem;
}

.legal-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 4rem 1.5rem;
}

/* Header Section */
.legal-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #e2e8f0;
}
.lh-left {
    max-width: 600px;
}
.lh-badge {
    color: #2563eb;
    font-size: 0.6875rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 1rem;
}
.lh-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 1rem 0;
    line-height: 1.1;
}
.lh-desc {
    font-size: 0.9375rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}
.lh-right {
    margin-bottom: 0.5rem;
}
.btn-legal-email {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: #0f172a;
    color: #fff;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 700;
    text-decoration: none;
    transition: background-color 0.2s;
}
.btn-legal-email:hover {
    background-color: #1e293b;
}

/* Layout */
.legal-grid {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 4rem;
}
@media (max-width: 768px) {
    .legal-grid { grid-template-columns: 1fr; gap: 2rem; }
}

/* Sidebar Navigation */
.nav-sidebar {
    position: sticky;
    top: 2rem;
}
.nav-title {
    font-size: 0.625rem;
    font-weight: 800;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 1rem;
}
.nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}
.nav-item {
    display: block;
    padding: 0.625rem 1rem;
    border-radius: 6px;
    font-size: 0.8125rem;
    font-weight: 600;
    color: #475569;
    text-decoration: none;
    transition: all 0.2s;
}
.nav-item:hover {
    color: #0f172a;
    background-color: #e2e8f0;
}
.nav-item.active {
    background-color: #eff6ff;
    color: #1d4ed8;
    font-weight: 700;
}

/* Content Area */
.legal-content .legal-section {
    margin-bottom: 2.5rem;
}
.card-section {
    background: #ffffff;
    border-radius: 12px;
    padding: 2.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
}

.sec-title-wrap {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.sec-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background-color: #0f172a;
    color: #fff;
    border-radius: 6px;
    font-size: 0.6875rem;
    font-weight: 800;
}
.sec-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}

.legal-text {
    font-size: 0.9375rem;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 1rem;
}
.legal-text:last-child { margin-bottom: 0; }

.legal-list {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0 0 0;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.legal-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: #475569;
    line-height: 1.6;
}
.list-check {
    color: #0f172a;
    margin-top: 2px;
}

/* Two Column Grid */
.two-col-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
}
@media (max-width: 640px) {
    .two-col-grid { grid-template-columns: 1fr; }
}

.sm-card {
    background: #f1f5f9;
    border-radius: 12px;
    padding: 2rem;
}
.sm-card .sec-number {
    margin: 0;
}
.icon-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background-color: #ffffff;
    color: #0f172a;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.icon-badge .material-icons-outlined {
    font-size: 16px;
}
.sm-card .sec-title {
    font-size: 1rem;
}

/* Bottom Banner */
.bottom-banner {
    background-color: #0f172a;
    border-radius: 20px;
    padding: 4rem 2rem;
    text-align: center;
    margin-top: 5rem;
    color: white;
}
.bb-icon-wrap {
    width: 48px;
    height: 48px;
    background-color: #2563eb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem auto;
}
.bb-icon-wrap .material-icons-outlined {
    font-size: 20px;
    font-weight: 800;
}
.bb-title {
    font-size: 1.75rem;
    font-weight: 800;
    margin: 0 0 1rem 0;
    color: white;
}
.bb-desc {
    color: #94a3b8;
    font-size: 0.9375rem;
    max-width: 400px;
    margin: 0 auto 2.5rem auto;
    line-height: 1.6;
}
.btn-contact {
    display: inline-flex;
    align-items: center;
    background-color: #020617;
    color: white;
    padding: 0.875rem 2rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid #1e293b;
}
.btn-contact:hover {
    background-color: #1e293b;
}

</style>
@endpush

@section('content')
<div class="legal-page-wrapper">
    <div class="legal-container">
        
        <!-- Header -->
        <div class="legal-header-flex">
            <div class="lh-left">
                <div class="lh-badge">Legal Documentation</div>
                <h1 class="lh-title">Terms of Service</h1>
                <p class="lh-desc">Last updated: October 24, 2024. These terms govern your use of the WP Maintenance concierge services and digital products.</p>
            </div>
            <div class="lh-right">
                <a href="mailto:legal@wpmaintenance.com" class="btn-legal-email">
                    <span class="material-icons-outlined" style="font-size:18px;">mail</span>
                    Email Legal Team
                </a>
            </div>
        </div>

        <div class="legal-grid">
            <!-- Sidebar Navigation -->
            <div class="legal-sidebar">
                <div class="nav-sidebar">
                    <div class="nav-title">Navigation</div>
                    <nav class="nav-list">
                        <a href="#acceptance" class="nav-item active">1. Acceptance</a>
                        <a href="#responsibilities" class="nav-item">2. User Responsibilities</a>
                        <a href="#service-levels" class="nav-item">3. Service Levels</a>
                        <a href="#payments" class="nav-item">4. Payments & Refunds</a>
                        <a href="#termination" class="nav-item">5. Termination</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="legal-content">
                
                <!-- Section 1: Acceptance -->
                <div class="legal-section" id="acceptance">
                    <div class="sec-title-wrap">
                        <div class="sec-number">01</div>
                        <h2 class="sec-title">Acceptance of Terms</h2>
                    </div>
                    <p class="legal-text">By accessing or using WP Maintenance services, you agree to be bound by these Terms of Service. If you do not agree with any part of these terms, you must immediately cease all use of our services.</p>
                    <p class="legal-text">We provide a "High-End Concierge" service for WordPress management, which includes monitoring, security, updates, and performance optimization. These terms constitute a legally binding agreement between you and WP Maintenance.</p>
                </div>

                <!-- Section 2: User Responsibilities -->
                <div class="legal-section card-section" id="responsibilities">
                    <div class="sec-title-wrap">
                        <div class="sec-number">02</div>
                        <h2 class="sec-title">User Responsibilities</h2>
                    </div>
                    <p class="legal-text">To provide our services effectively, you must provide accurate and complete information. You are responsible for:</p>
                    <ul class="legal-list">
                        <li>
                            <span class="material-icons-outlined list-check" style="font-size:18px;">check_circle</span>
                            Maintaining the security of your account credentials and notifying us immediately of any unauthorized access.
                        </li>
                        <li>
                            <span class="material-icons-outlined list-check" style="font-size:18px;">check_circle</span>
                            Granting necessary administrative access to your WordPress installations for maintenance purposes.
                        </li>
                        <li>
                            <span class="material-icons-outlined list-check" style="font-size:18px;">check_circle</span>
                            Ensuring your content does not violate any local, state, or international laws.
                        </li>
                    </ul>
                </div>

                <!-- Section 3: Service Levels & Maintenance -->
                <div class="legal-section" id="service-levels">
                    <div class="sec-title-wrap">
                        <div class="sec-number">03</div>
                        <h2 class="sec-title">Service Levels & Maintenance</h2>
                    </div>
                    <p class="legal-text">Our maintenance status monitoring is provided via a Glassmorphic Status Bar in your client dashboard. While we strive for 100% uptime, updates and maintenance tasks may occasionally cause brief periods of unavailability.</p>
                    <p class="legal-text">Emergency support is prioritized based on the service tier selected during signup. Routine maintenance (plugin updates, backups) is performed during low-traffic hours to minimize disruption.</p>
                </div>

                <!-- Section 4: Payments & Refunds -->
                <div class="two-col-grid" id="payments">
                    <div class="sm-card">
                        <div class="sec-title-wrap" style="margin-bottom:1rem; gap: 0.75rem;">
                            <div class="sec-number">04</div>
                            <h2 class="sec-title">Payments</h2>
                        </div>
                        <p class="legal-text" style="font-size:0.875rem;">Fees are billed in advance on a monthly or annual basis. All fees are non-refundable except where required by law or specified in our Refund Policy.</p>
                    </div>

                    <div class="sm-card">
                        <div class="sec-title-wrap" style="margin-bottom:1rem; gap: 0.75rem;">
                            <div class="icon-badge">
                                <span class="material-icons-outlined">gavel</span>
                            </div>
                            <h2 class="sec-title">Refunds</h2>
                        </div>
                        <p class="legal-text" style="font-size:0.875rem;">We offer a 30-day satisfaction guarantee for new subscribers. Refund requests must be submitted in writing within the first 30 days of service activation.</p>
                    </div>
                </div>

                <!-- Section 5: Termination -->
                <div class="legal-section" id="termination">
                    <div class="sec-title-wrap">
                        <div class="sec-number">05</div>
                        <h2 class="sec-title">Termination</h2>
                    </div>
                    <p class="legal-text">You may cancel your subscription at any time through your client portal. WP Maintenance reserves the right to suspend or terminate access to services for any violation of these terms or non-payment of fees. Upon termination, all rights granted to you will immediately cease.</p>
                </div>

                <!-- Bottom Banner -->
                <div class="bottom-banner">
                    <div class="bb-icon-wrap">
                        <span class="material-icons-outlined" style="color:white;">priority_high</span>
                    </div>
                    <h2 class="bb-title">Have questions about our terms?</h2>
                    <p class="bb-desc">Our legal and concierge teams are here to help you understand your rights and our obligations.</p>
                    <a href="{{ route('contact') }}" class="btn-contact">Contact Support</a>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.legal-section, .two-col-grid');
    const navItems = document.querySelectorAll('.nav-item');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (window.scrollY >= (sectionTop - 200)) {
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
