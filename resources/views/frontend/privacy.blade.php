@extends('layouts.frontend')
@section('title', 'Privacy Policy — United WPAgency')

@push('styles')
<style>
/* Base Variables & Reset */
.privacy-page-wrapper {
    background-color: #ffffff;
    color: #334155;
    font-family: 'Inter', -apple-system, sans-serif;
    padding-bottom: 6rem;
}

.privacy-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 3rem 1.5rem;
}

/* Header Section */
.priv-header {
    margin-bottom: 2rem;
    text-align: center;
}
.priv-badge {
    display: inline-block;
    background-color: #f1f5f9;
    color: #475569;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    padding: 0.4rem 1rem;
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
.priv-desc {
    font-size: 1.125rem;
    color: #64748b;
    line-height: 1.6;
    max-width: 700px;
    margin: 0 auto;
}

/* Content Layout */
.priv-content-block {
    margin-bottom: 2rem;
}
.p-sec-num {
    font-size: 0.875rem;
    font-weight: 900;
    color: #ea580c;
    margin-bottom: 0.75rem;
    display: block;
    letter-spacing: 0.05em;
}
.p-sec-title {
    font-size: 1.75rem;
    font-weight: 850;
    color: #0f172a;
    margin: 0 0 1.5rem 0;
}
.p-sec-text {
    font-size: 1.0625rem;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

/* List Style */
.p-list {
    list-style: none;
    padding: 0;
    margin: 2rem 0;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.p-list li {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    background: #f8fafc;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    border: 1px solid #edf2f7;
}
.p-list li::before {
    content: 'check_circle';
    font-family: 'Material Icons';
    color: #ea580c;
    font-size: 20px;
}

/* Footnote/Contact */
.priv-contact-box {
    background-color: #0f172a;
    border-radius: 20px;
    padding: 4rem 2rem;
    text-align: center;
    color: white;
    margin-top: 6rem;
}
.pc-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 1rem;
    color: white;
}
.pc-desc {
    font-size: 1rem;
    color: #94a3b8;
    margin-bottom: 2rem;
    line-height: 1.6;
}
.pc-email {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: #ea580c;
    color: white;
    padding: 1rem 2rem;
    border-radius: 99px;
    font-weight: 800;
    text-decoration: none;
    transition: transform 0.2s;
}
.pc-email:hover {
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .priv-title { font-size: 2.75rem; }
}
</style>
@endpush

@section('content')
<div class="privacy-page-wrapper">
    <div class="privacy-container">
        
        <!-- Header -->
        <header class="priv-header">
            <div class="priv-badge">Data Protection</div>
            <h1 class="priv-title">Privacy Policy</h1>
            <p class="priv-desc">We are committed to protecting your privacy and ensuring the security of your data through architectural excellence and transparency.</p>
        </header>

        <!-- Section 1: Overview -->
        <article class="priv-content-block">
            <span class="p-sec-num">01. OVERVIEW</span>
            <h2 class="p-sec-title">Operational Context</h2>
            <p class="p-sec-text">This Privacy Policy describes how ReUnited (“we”, “us”, or “our”) collects, uses, and discloses your personal information when you use our website and services.</p>
        </article>

        <!-- Section 2: Collection (User requested 'No Professional Advice' header) -->
        <article class="priv-content-block">
            <span class="p-sec-num">02. COLLECTION</span>
            <h2 class="p-sec-title">No Professional Advice</h2>
            <p class="p-sec-text">We collect information that you provide directly to us, such as when you subscribe to our newsletter or contact our support team. This may include:</p>
            <ul class="p-list">
                <li>Name and contact information</li>
                <li>Professional credentials and affiliations</li>
                <li>Communication preferences and history</li>
                <li>Technical data including IP addresses and browser types</li>
            </ul>
        </article>

        <!-- Section 3: Use -->
        <article class="priv-content-block">
            <span class="p-sec-num">03. UTILIZATION</span>
            <h2 class="p-sec-title">Use of Information</h2>
            <p class="p-sec-text">Your information is used solely to provide and improve our services. We do not sell your personal data to third parties. Our usage patterns focus on service execution, threat mitigation, and structural optimization of our platform.</p>
        </article>

        <!-- Section 4: Security -->
        <article class="priv-content-block">
            <span class="p-sec-num">04. SAFEGUARDING</span>
            <h2 class="p-sec-title">Security</h2>
            <p class="p-sec-text">We implement industry-standard security measures, including AES-256 encryption and zero-trust protocols, to protect your data. While we strive to use commercially acceptable means to protect your personal information, we cannot guarantee its absolute security.</p>
        </article>

        <!-- CONTACT -->
        <footer class="priv-contact-box">
            <h2 class="pc-title">Contact</h2>
            <p class="pc-desc">For questions regarding these policies, please reach out to our privacy office.</p>
            <a href="mailto:support@unitedwpagency.com" class="pc-email">
                <span class="material-icons-outlined">mail</span>
                support@unitedwpagency.com
            </a>
        </footer>

    </div>
</div>
@endsection
