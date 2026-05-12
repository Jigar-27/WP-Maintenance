@extends('layouts.frontend')
@section('title', 'Disclaimer — United WP agency')

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
    padding: 1.5rem 1.5rem 4rem 1.5rem;
}

/* Header Section */
.disc-header {
    margin-bottom: 2rem;
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

/* Card: General Notice */
.risk-card {
    background-color: #1e293b;
    border-radius: 12px;
    padding: 2.5rem;
    display: flex;
    gap: 1.5rem;
    color: white;
    margin-bottom: 2rem;
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
    margin-bottom: 4rem;
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
    background-color: #ea580c;
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
    line-height: 1.8;
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
            <p class="disc-desc">Last updated: April 19, 2026. This document outlines the limitations of liability and the terms of information usage for our services and digital assets.</p>
        </div>

        <!-- Section 1: Accuracy -->
        <div class="risk-card">
            <div class="risk-icon-wrap">
                <span class="material-icons-outlined">info</span>
            </div>
            <div class="risk-content">
                <h2 class="rc-title">1. Accuracy of Information</h2>
                <p class="rc-text">The content provided is for general informational purposes only. While we endeavor to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>
            </div>
        </div>

        <!-- Section 2: No Professional Advice -->
        <div class="disc-row">
            <div class="dr-left">
                <div class="dr-line"></div>
                <h2 class="dr-title">2. No Professional Advice</h2>
            </div>
            <div>
                <p class="dr-text">The information contained on this platform is not intended to be a substitute for professional cybersecurity, legal, or financial advice. All software and hardware security configurations should be reviewed by qualified personnel specifically trained for your organization’s unique environment.</p>
            </div>
        </div>

        <!-- Section 3: Limitation of Liability -->
        <div class="disc-row">
            <div class="dr-left">
                <div class="dr-line"></div>
                <h2 class="dr-title">3. Limitation of Liability</h2>
            </div>
            <div>
                <p class="dr-text">In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.</p>
                <p class="dr-text" style="margin-top: 1.5rem;">Through this website, you are able to link to other websites which are not under our control. We have no control over the nature, content, and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>
            </div>
        </div>

        <!-- Section 4: External Links -->
        <div class="disc-row" style="margin-bottom: 0;">
            <div class="dr-left">
                <div class="dr-line"></div>
                <h2 class="dr-title">4. External Links Disclaimer</h2>
            </div>
            <div>
                <p class="dr-text">Our service may contain links to external websites that are not provided or maintained by or in any way affiliated with us. Please note that we do not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.</p>
            </div>
        </div>

        <!-- Footer Banner -->
        <div class="disc-banner">
            <div class="db-left">
                <h2 class="db-title">Questions about this disclaimer?</h2>
                <p class="db-desc">Contact our support team at {{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}</p>
            </div>
            <div class="db-right">
                <a href="mailto:{{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}">
                    Email Support
                    <span class="material-icons-outlined">mail</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
