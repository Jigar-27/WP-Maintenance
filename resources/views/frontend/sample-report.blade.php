@extends('layouts.frontend')

@section('title', 'Sample Maintenance Report — WP Maintenance')

@section('content')
<div class="report-wrapper">
    <div class="report-card">
        {{-- Header --}}
        <header class="report-header">
            <div class="rh-left">
                <div class="report-logo">
                    <div class="logo-icon-box">
                        <span class="material-icons-outlined">shield</span>
                    </div>
                    <div class="logo-text">
                        <span class="brand">WP Maintenance</span>
                        <span class="tagline">OFFICIAL SITE CUSTODIAN</span>
                    </div>
                </div>
            </div>
            <div class="rh-right">
                <h1 class="report-title">WEBSITE MAINTENANCE REPORT</h1>
                <div class="report-date">December 2025</div>
            </div>
        </header>

        {{-- Meta Stats Section --}}
        <div class="report-meta-grid">
            <div class="rm-column">
                <div class="meta-item">
                    <label>TARGET URL</label>
                    <div class="value">abc.com.au</div>
                </div>
                <div class="meta-item mt-24">
                    <label>REPORT GENERATED</label>
                    <div class="value">March 1, 2026</div>
                </div>
            </div>
            <div class="rm-column flex-end">
                <div class="health-score-card">
                    <div class="score-circle">
                        <span class="score">98</span>
                    </div>
                    <div class="score-label">
                        <span class="sl-title">SITE HEALTH SCORE</span>
                        <span class="sl-value">Excellent Condition</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Executive Summary --}}
        <section class="report-section">
            <h2 class="section-heading">Executive Summary</h2>
            <p class="section-p">
                During the month of February 2026, we performed comprehensive maintenance on <strong>abc.com.au</strong>. 
                Your site remains in optimal health with all core components updated to their latest stable versions. 
                We observed consistent uptime and performed three successful off-site backups to ensure total 
                data redundancy. No security threats or malware signatures were detected during our daily automated scans.
            </p>
        </section>

        {{-- Updates & Maintenance --}}
        <section class="report-section">
            <div class="flex-between">
                <h2 class="section-heading">Updates & Maintenance</h2>
                <span class="update-chip">7 PLUGINS UPDATED</span>
            </div>
            
            <div class="table-outer">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>COMPONENT NAME</th>
                            <th class="tablet-hide">TYPE</th>
                            <th>UPDATED VERSION</th>
                            <th class="text-right">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>AI Chatbot - WPBot</td>
                            <td class="tablet-hide">Plugin</td>
                            <td class="version-cell">7.7.5</td>
                            <td class="text-right"><span class="material-icons-outlined status-icon">check_circle</span></td>
                        </tr>
                        <tr>
                            <td>All-In-One Security</td>
                            <td class="tablet-hide">Plugin</td>
                            <td class="version-cell">5.4.6</td>
                            <td class="text-right"><span class="material-icons-outlined status-icon">check_circle</span></td>
                        </tr>
                        <tr>
                            <td>Contact Form CFDB7</td>
                            <td class="tablet-hide">Plugin</td>
                            <td class="version-cell">1.3.5</td>
                            <td class="text-right"><span class="material-icons-outlined status-icon">check_circle</span></td>
                        </tr>
                        <tr>
                            <td>Elementor</td>
                            <td class="tablet-hide">Page Builder</td>
                            <td class="version-cell">3.35.0</td>
                            <td class="text-right"><span class="material-icons-outlined status-icon">check_circle</span></td>
                        </tr>
                        <tr>
                            <td>Rank Math SEO</td>
                            <td class="tablet-hide">Plugin</td>
                            <td class="version-cell">1.0.243</td>
                            <td class="text-right"><span class="material-icons-outlined status-icon">check_circle</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Verification & Integrity --}}
        <section class="report-section">
            <h2 class="section-heading">Verification & Integrity</h2>
            <div class="integrity-grid">
                <div class="integrity-card">
                    <span class="material-icons-outlined ic-icon">verified_user</span>
                    <h3>SSL Verified</h3>
                    <p>Encryption valid until 2027. Secure connection maintained.</p>
                </div>
                <div class="integrity-card">
                    <span class="material-icons-outlined ic-icon">security</span>
                    <h3>Malware Clean</h3>
                    <p>Daily scans complete. No malicious code or threats found.</p>
                </div>
                <div class="integrity-card">
                    <span class="material-icons-outlined ic-icon">cloud_done</span>
                    <h3>Cloud Backup</h3>
                    <p>Created: Feb 28, 2026. Stored securely off-site.</p>
                </div>
            </div>
        </section>

        {{-- Recommendation Footer --}}
        <footer class="report-footer">
            <div class="footer-inner">
                <div class="fi-left">
                    <label>CUSTODIAN RECOMMENDATION</label>
                    <p>"Your website is performing in the top 5% of optimized WordPress sites. No immediate actions are required from your side. We will continue monitoring 24/7."</p>
                </div>
                <div class="fi-right">
                    <div class="signature">
                        <span class="name">Alex Carter</span>
                        <span class="pos">SENIOR CONCIERGE</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<style>
    .report-wrapper {
        background: #f8fafc;
        padding: 4.5rem 1rem;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        font-family: 'Inter', sans-serif;
    }
    .report-card {
        background: white;
        max-width: 820px;
        width: 100%;
        box-shadow: 0 10px 40px rgba(15, 23, 42, 0.04);
        border-radius: 12px;
        padding: 3.5rem;
    }

    /* Header Styling */
    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 3.5rem;
    }
    .report-logo { display: flex; align-items: center; gap: 14px; }
    .logo-icon-box {
        width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
        background: #fff5f2; color: #b02f00; border-radius: 10px;
    }
    .logo-text .brand { display: block; font-weight: 800; font-size: 1.25rem; color: #b02f00; margin-bottom: 2px; }
    .logo-text .tagline { display: block; font-size: 0.625rem; font-weight: 700; color: #94a3b8; letter-spacing: 0.12em; text-transform: uppercase; }
    
    .report-title { font-weight: 800; font-size: 1.45rem; color: #1e293b; text-align: right; margin: 0; line-height: 1.2; max-width: 300px; }
    .report-date { text-align: right; color: #f97316; font-weight: 700; font-size: 0.875rem; margin-top: 6px; }

    /* Meta Stats Grid */
    .report-meta-grid {
        background: #f8fbff;
        border-radius: 14px;
        padding: 2.25rem 2.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-bottom: 3.5rem;
    }
    .meta-item label { display: block; font-size: 0.625rem; font-weight: 800; color: #94a3b8; letter-spacing: 0.08em; margin-bottom: 6px; text-transform: uppercase; }
    .meta-item .value { font-weight: 700; color: #0f172a; font-size: 1.0625rem; }
    .mt-24 { margin-top: 1.75rem; }
    .flex-end { display: flex; justify-content: flex-end; align-items: center; }

    .health-score-card {
        background: white; border-radius: 12px; padding: 1rem 1.5rem;
        display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .score-circle {
        width: 58px; height: 58px; border: 3.5px solid #fff5f2; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
    .score-circle .score { font-weight: 800; font-size: 1.3rem; color: #0f172a; }
    .score-label { display: flex; flex-direction: column; }
    .sl-title { font-size: 0.5625rem; font-weight: 800; color: #94a3b8; letter-spacing: 0.06em; margin-bottom: 2px; }
    .sl-value { font-size: 0.8125rem; font-weight: 700; color: #f97316; }

    /* Report Sections */
    .report-section { margin-bottom: 3.5rem; }
    .section-heading {
        font-size: 1rem; font-weight: 800; color: #1e293b; margin-bottom: 1.5rem;
        position: relative; padding-left: 14px;
    }
    .section-heading::before {
        content: ''; position: absolute; left: 0; top: 3px; bottom: 3px; width: 3.5px;
        background: #f97316; border-radius: 10px;
    }
    .section-p { font-size: 0.9375rem; color: #475569; line-height: 1.75; margin: 0; }
    .flex-between { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }
    .update-chip {
        background: #fff8e6; color: #92400e; font-size: 0.5625rem; font-weight: 800;
        padding: 5px 12px; border-radius: 99px; letter-spacing: 0.05em;
    }

    /* Table Design */
    .table-outer { border-radius: 10px; overflow: hidden; border: 1px solid #f1f5f9; }
    .report-table { width: 100%; border-collapse: collapse; }
    .report-table th {
        background: #ebf3ff; font-size: 0.625rem; font-weight: 800; color: #64748b;
        text-align: left; padding: 14px 24px; text-transform: uppercase; letter-spacing: 0.08em;
    }
    .report-table td {
        padding: 16px 24px; font-size: 0.875rem; font-weight: 600; color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    .version-cell { color: #3b82f6 !important; }
    .status-icon { font-size: 1.25rem; color: #f97316; vertical-align: middle; }
    .text-right { text-align: right; }

    /* Integrity Grid Cards */
    .integrity-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
    .integrity-card {
        background: white; border: 1.5px solid #f1f5f9; border-radius: 12px; padding: 1.5rem; transition: transform 0.2s;
    }
    .integrity-card:hover { transform: translateY(-3px); }
    .ic-icon { font-size: 1.75rem; color: #f97316; margin-bottom: 14px; display: block; }
    .integrity-card h3 { font-size: 0.9375rem; font-weight: 800; color: #1e293b; margin-bottom: 8px; }
    .integrity-card p { font-size: 0.75rem; color: #64748b; line-height: 1.55; margin: 0; }

    /* Signature & Recommendation */
    .report-footer { margin-top: 1rem; }
    .footer-inner {
        background: #f8fbff; border-left: 5px solid #b02f00; padding: 2.5rem;
        display: flex; justify-content: space-between; align-items: flex-end; border-radius: 4px 14px 14px 4px;
    }
    .fi-left label { font-size: 0.5625rem; font-weight: 800; color: #94a3b8; letter-spacing: 0.1em; display: block; margin-bottom: 8px; }
    .fi-left p { font-size: 0.875rem; font-style: italic; color: #475569; margin: 0; max-width: 480px; line-height: 1.65; }
    .signature { text-align: right; }
    .signature .name { display: block; font-weight: 800; font-size: 1.125rem; color: #1e293b; margin-bottom: 2px; }
    .signature .pos { font-size: 0.625rem; font-weight: 700; color: #94a3b8; letter-spacing: 0.08em; text-transform: uppercase; }

    @media (max-width: 640px) {
        .report-header, .report-meta-grid, .footer-inner { flex-direction: column; align-items: stretch; gap: 2rem; }
        .report-title, .report-date, .flex-end, .signature { text-align: left; justify-content: flex-start; }
        .integrity-grid { grid-template-columns: 1fr; }
        .tablet-hide { display: none; }
    }
</style>
@endsection
