@extends('layouts.frontend')
@section('title', 'Disclaimer')

@push('styles')
<style>
/* Base Variables & Reset for Disclaimer Page */
.disc-page-wrapper {
    background-color: #ffffff;
    color: #334155;
    font-family: 'Inter', -apple-system, sans-serif;
    padding-bottom: 6rem;
}

.disc-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 4rem 1.5rem;
}

/* Header Section */
.disc-header {
    margin-bottom: 3.5rem;
}
.disc-badge {
    display: inline-block;
    background-color: #f1f5f9;
    color: #475569;
    font-size: 0.625rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    padding: 0.35rem 0.75rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
}
.disc-title {
    font-size: 3rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 1rem 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}
.disc-desc {
    font-size: 1rem;
    color: #64748b;
    line-height: 1.6;
    max-width: 600px;
    margin: 0;
}

/* Card 1: Assumption of Risk */
.risk-card {
    background-color: #1e293b;
    border-radius: 12px;
    padding: 2.5rem;
    display: flex;
    gap: 1.5rem;
    color: white;
    margin-bottom: 4rem;
}
@media (max-width: 640px) {
    .risk-card { flex-direction: column; }
}
.risk-icon-wrap {
    width: 48px;
    height: 48px;
    background-color: #334155;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.risk-icon-wrap .material-icons-outlined {
    color: white;
    font-size: 24px;
}
.risk-content .rc-title {
    font-size: 1.25rem;
    font-weight: 800;
    margin: 0 0 0.75rem 0;
    color: white;
}
.risk-content .rc-text {
    font-size: 0.875rem;
    color: #cbd5e1;
    line-height: 1.6;
    margin: 0;
}

/* Row Sections (Line, Title, Text) */
.disc-row {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}
@media (max-width: 768px) {
    .disc-row { grid-template-columns: 1fr; gap: 1rem; }
}

.dr-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    align-self: start;
    padding-top: 0.25rem;
}
.dr-line {
    width: 20px;
    height: 3px;
    background-color: #2563eb;
    border-radius: 2px;
}
.dr-title {
    font-size: 1.125rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.dr-text {
    font-size: 0.9375rem;
    color: #475569;
    line-height: 1.7;
    margin: 0;
}
.dr-text-italic {
    font-style: italic;
}

/* Two Feature Cards */
.feat-cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin: 4rem 0;
}
@media (max-width: 640px) {
    .feat-cards-grid { grid-template-columns: 1fr; }
}
.fc-card {
    background-color: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
}
.fc-title-wrap {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}
.fc-icon {
    color: #2563eb;
    font-size: 20px;
}
.fc-title {
    font-size: 1rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.fc-text {
    font-size: 0.8125rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Footer Banner */
.disc-banner {
    background-color: #0f172a;
    border-radius: 12px;
    padding: 2.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
}
@media (max-width: 640px) {
    .disc-banner { flex-direction: column; align-items: flex-start; gap: 1.5rem; }
}
.db-left .db-title {
    font-size: 1.125rem;
    font-weight: 800;
    color: white;
    margin: 0 0 0.5rem 0;
}
.db-left .db-desc {
    font-size: 0.875rem;
    color: #94a3b8;
    margin: 0;
}
.db-right a {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-weight: 800;
    font-size: 0.875rem;
    text-decoration: none;
    transition: color 0.2s;
}
.db-right a:hover {
    color: #cbd5e1;
}
.db-right a .material-icons-outlined {
    font-size: 16px;
}

</style>
@endpush

@section('content')
<div class="disc-page-wrapper">
    <div class="disc-container">
        
        <!-- Header -->
        <div class="disc-header">
            <div class="disc-badge">Legal Documentation</div>
            <h1 class="disc-title">Disclaimer</h1>
            <p class="disc-desc">Last updated: October 24, 2023. Please read this legal disclaimer carefully before using the services provided by WP Maintenance.</p>
        </div>

        <!-- Assumption of Risk Card -->
        <div class="risk-card">
            <div class="risk-icon-wrap">
                <span class="material-icons-outlined">warning</span>
            </div>
            <div class="risk-content">
                <h2 class="rc-title">Assumption of Risk</h2>
                <p class="rc-text">Use of WP Maintenance services involves inherent risks associated with digital infrastructure, including but not limited to server downtime, software incompatibilities, and data vulnerability. By engaging our services, you acknowledge and assume full responsibility for the regular backup of your data and the ultimate security of your digital assets.</p>
            </div>
        </div>

        <!-- General Information -->
        <div class="disc-row">
            <div class="dr-left">
                <div class="dr-line"></div>
                <h2 class="dr-title">General Information</h2>
            </div>
            <div>
                <p class="dr-text">The information provided by WP Maintenance ("we," "us," or "our") on our website and through our service is for general informational purposes only. All information is provided in good faith, however, we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the site or our service platforms.</p>
            </div>
        </div>

        <!-- Two Feature Cards -->
        <div class="feat-cards-grid">
            <div class="fc-card">
                <div class="fc-title-wrap">
                    <span class="material-icons-outlined fc-icon">gpp_maybe</span>
                    <h3 class="fc-title">Service Limitations</h3>
                </div>
                <p class="fc-text">WP Maintenance provides technical support and maintenance for WordPress installations. We do not guarantee that our services will resolve all technical issues or that your website will be 100% secure from all cyber threats. Security is a continuous process, not a final destination.</p>
            </div>
            <div class="fc-card">
                <div class="fc-title-wrap">
                    <span class="material-icons-outlined fc-icon">stars</span>
                    <h3 class="fc-title">Professional Advice</h3>
                </div>
                <p class="fc-text">Our services do not constitute legal, financial, or professional security advice. Users should consult with appropriate professionals before making decisions based on technical data or security reports provided through our maintenance dashboard.</p>
            </div>
        </div>

        <!-- Third-Party Links -->
        <div class="disc-row">
            <div class="dr-left">
                <div class="dr-line"></div>
                <h2 class="dr-title">Third-Party Links</h2>
            </div>
            <div>
                <p class="dr-text">Our service may contain links to third-party websites or services that are not owned or controlled by WP Maintenance. We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third-party web sites or services. You further acknowledge and agree that WP Maintenance shall not be responsible or liable, directly or indirectly, for any damage or loss caused.</p>
            </div>
        </div>

        <!-- No Warranties -->
        <div class="disc-row" style="margin-bottom: 0;">
            <div class="dr-left">
                <div class="dr-line"></div>
                <h2 class="dr-title">No Warranties</h2>
            </div>
            <div>
                <p class="dr-text dr-text-italic">The service is provided on an "AS IS" and "AS AVAILABLE" basis. The service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.</p>
            </div>
        </div>

        <!-- Footer Banner -->
        <div class="disc-banner">
            <div class="db-left">
                <h2 class="db-title">Questions about this disclaimer?</h2>
                <p class="db-desc">Our legal team is available to clarify any points of concern.</p>
            </div>
            <div class="db-right">
                <a href="mailto:legal@wpmaintenance.com">
                    legal@wpmaintenance.com
                    <span class="material-icons-outlined">open_in_new</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
