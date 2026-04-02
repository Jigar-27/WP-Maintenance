@extends('layouts.frontend')
@section('title', 'Privacy Policy')

@push('styles')
<style>
/* Base Variables & Reset */
.privacy-page-wrapper {
    background-color: #f8fafc;
    color: #334155;
    font-family: 'Inter', -apple-system, sans-serif;
    padding-bottom: 6rem;
}

.privacy-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 1.5rem 1.5rem 4rem 1.5rem;
}

/* Header Section */
.priv-header {
    margin-bottom: 2rem;
}
.priv-badge {
    display: inline-block;
    background-color: #e0e7ff;
    color: #4f46e5;
    font-size: 0.6875rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    padding: 0.35rem 0.75rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
}
.priv-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 1rem 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}
.priv-title span {
    color: #ea580c;
}
.priv-desc {
    font-size: 1.125rem;
    color: #64748b;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 0 2rem 0;
}
.priv-date {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    font-weight: 700;
    color: #0f172a;
}
.priv-date .material-icons-outlined {
    font-size: 18px;
    color: #ea580c;
}

/* Layout Grid */
.priv-grid {
    display: grid;
    grid-template-columns: 200px 1fr;
    gap: 4rem;
    margin-bottom: 4rem;
}
@media (max-width: 768px) {
    .priv-grid { grid-template-columns: 1fr; gap: 1rem; }
}

/* Left Column Numbers */
.priv-num {
    font-size: 2rem;
    font-weight: 800;
    color: #cbd5e1;
    position: sticky;
    top: 2rem;
    margin: 0;
    line-height: 1.2;
}

/* Right Column Content */
.priv-sec-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 1rem 0;
}
.priv-text {
    font-size: 0.9375rem;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 2rem;
}

/* Section specific styling */
.collection-box {
    background-color: #eff6ff;
    border-radius: 12px;
    padding: 2rem;
}
.collection-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.collection-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: #1e293b;
}
.collection-list .material-icons-outlined {
    color: #ea580c;
    font-size: 20px;
}

/* Two Cards Grid */
.cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}
@media (max-width: 640px) {
    .cards-grid { grid-template-columns: 1fr; }
}
.priv-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -2px rgba(0,0,0,0.02);
}
.pc-icon {
    color: #ea580c;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}
.pc-title {
    font-size: 0.9375rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 0.5rem 0;
}
.pc-desc {
    font-size: 0.8125rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
}

/* Dark Box */
.zero-leak-box {
    background-color: #0f172a;
    border-radius: 12px;
    padding: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: white;
}
@media (max-width: 640px) {
    .zero-leak-box { flex-direction: column; align-items: flex-start; gap: 1.5rem; }
}
.zl-title {
    font-size: 1.125rem;
    font-weight: 800;
    margin: 0 0 0.5rem 0;
}
.zl-desc {
    font-size: 0.875rem;
    color: #94a3b8;
    margin: 0;
    max-width: 300px;
    line-height: 1.5;
}
.zl-icon {
    font-size: 3rem;
    color: #334155;
}

/* Rights List */
.rights-list {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}
.right-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
}
.ri-icon-wrap {
    width: 40px;
    height: 40px;
    background-color: #fff7ed;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.ri-icon-wrap .material-icons-outlined {
    color: #ea580c;
    font-size: 20px;
}
.ri-title {
    font-size: 0.9375rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 0.25rem 0;
}
.ri-desc {
    font-size: 0.8125rem;
    color: #64748b;
    margin: 0;
    line-height: 1.5;
}

/* Bottom Banner */
.priv-banner {
    background-color: #0f172a;
    border-radius: 20px;
    padding: 4rem 2rem;
    text-align: center;
    margin-top: 2rem;
}
.pb-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: white;
    margin: 0 0 1rem 0;
}
.pb-desc {
    font-size: 0.9375rem;
    color: #94a3b8;
    max-width: 400px;
    margin: 0 auto 2rem auto;
    line-height: 1.6;
}
.btn-email-white {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: white;
    color: #0f172a;
    padding: 0.875rem 2rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 800;
    text-decoration: none;
    transition: background-color 0.2s;
}
.btn-email-white:hover {
    background-color: #f1f5f9;
}
</style>
@endpush

@section('content')
<div class="privacy-page-wrapper">
    <div class="privacy-container">
        
        <!-- Header -->
        <div class="priv-header">
            <div class="priv-badge">Legal Framework</div>
            <h1 class="priv-title">Privacy <span>Policy.</span></h1>
            <p class="priv-desc">Your trust is our most valuable asset. This policy outlines how WP Maintenance handles your data with the precision and care of a digital custodian.</p>
            <div class="priv-date">
                <span class="material-icons-outlined">schedule</span>
                Last Updated: May 24, 2024
            </div>
        </div>

        <!-- Section 1 -->
        <div class="priv-grid">
            <div class="priv-num">01. Collection</div>
            <div>
                <h2 class="priv-sec-title">Data Gathering & Sources</h2>
                <p class="priv-text">We collect information necessary to provide high-end WordPress concierge services. This includes personal identifiers (name, email), billing information, and technical credentials required for site maintenance.</p>
                <div class="collection-box">
                    <ul class="collection-list">
                        <li>
                            <span class="material-icons-outlined">check_circle</span>
                            Account Details & Contact Information
                        </li>
                        <li>
                            <span class="material-icons-outlined">check_circle</span>
                            Server & CMS Administrative Credentials
                        </li>
                        <li>
                            <span class="material-icons-outlined">check_circle</span>
                            Usage Logs & Performance Metadata
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="priv-grid">
            <div class="priv-num">02. Utilization</div>
            <div>
                <h2 class="priv-sec-title">How We Use Your Data</h2>
                <p class="priv-text">Processing is limited to the fulfillment of our maintenance contract. Your data is used exclusively to ensure the security, stability, and speed of your digital properties.</p>
                <div class="cards-grid">
                    <div class="priv-card">
                        <div class="material-icons-outlined pc-icon">bolt</div>
                        <h3 class="pc-title">Service Optimization</h3>
                        <p class="pc-desc">Real-time monitoring and proactive performance tuning.</p>
                    </div>
                    <div class="priv-card">
                        <div class="material-icons-outlined pc-icon">security</div>
                        <h3 class="pc-title">Security Audits</h3>
                        <p class="pc-desc">Scanning for vulnerabilities and preventing unauthorized access.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3 -->
        <div class="priv-grid">
            <div class="priv-num">03. Safeguarding</div>
            <div>
                <h2 class="priv-sec-title">Encryption & Protection</h2>
                <p class="priv-text">We employ industry-standard AES-256 encryption for all sensitive data. Access is strictly governed by the principle of least privilege, ensuring only necessary personnel interact with your environment.</p>
                <div class="zero-leak-box">
                    <div>
                        <h3 class="zl-title">Zero-Leak Philosophy</h3>
                        <p class="zl-desc">Our internal protocols exceed GDPR and CCPA standards for digital safety.</p>
                    </div>
                    <span class="material-icons-outlined zl-icon">verified_user</span>
                </div>
            </div>
        </div>

        <!-- Section 4 -->
        <div class="priv-grid">
            <div class="priv-num">04. Rights</div>
            <div>
                <h2 class="priv-sec-title">Your Control</h2>
                <p class="priv-text">As the owner of your data, you possess the right to access, rectify, or request the deletion of your personal information at any time through our support portal.</p>
                <div class="rights-list">
                    <div class="right-item">
                        <div class="ri-icon-wrap">
                            <span class="material-icons-outlined">vpn_key</span>
                        </div>
                        <div>
                            <h3 class="ri-title">Right to Access</h3>
                            <p class="ri-desc">Request a complete copy of all stored data associated with your profile.</p>
                        </div>
                    </div>
                    <div class="right-item">
                        <div class="ri-icon-wrap">
                            <span class="material-icons-outlined">edit</span>
                        </div>
                        <div>
                            <h3 class="ri-title">Right to Correction</h3>
                            <p class="ri-desc">Update outdated or incorrect information in real-time.</p>
                        </div>
                    </div>
                    <div class="right-item">
                        <div class="ri-icon-wrap">
                            <span class="material-icons-outlined">delete_outline</span>
                        </div>
                        <div>
                            <h3 class="ri-title">Right to Erasure</h3>
                            <p class="ri-desc">Request permanent deletion of your account and associated records.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Banner -->
        <div class="priv-banner">
            <h2 class="pb-title">Questions about your privacy?</h2>
            <p class="pb-desc">Our Data Protection Officer is available to discuss our security protocols in detail.</p>
            <a href="mailto:privacy@wpmaintenance.com" class="btn-email-white">
                <span class="material-icons-outlined">mail</span>
                privacy@wpmaintenance.com
            </a>
        </div>

    </div>
</div>
@endsection
