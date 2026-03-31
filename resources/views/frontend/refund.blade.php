@extends('layouts.frontend')
@section('title', 'Refund Policy')

@push('styles')
<style>
.refund-page-wrapper {
    background-color: #ffffff;
    color: #334155;
    font-family: 'Inter', -apple-system, sans-serif;
    padding-bottom: 6rem;
}
.refund-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 4rem 1.5rem;
}

/* Header */
.refund-header { margin-bottom: 3.5rem; }
.refund-badge {
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
.refund-title {
    font-size: 3rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 1rem 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}
.refund-desc {
    font-size: 1rem;
    color: #64748b;
    line-height: 1.6;
    max-width: 600px;
    margin: 0;
}

/* Highlight Card (30-day guarantee) */
.guarantee-card {
    background-color: #1e293b;
    border-radius: 12px;
    padding: 2.5rem;
    display: flex;
    gap: 1.5rem;
    color: white;
    margin-bottom: 4rem;
}
@media (max-width: 640px) { .guarantee-card { flex-direction: column; } }
.gc-icon-wrap {
    width: 48px;
    height: 48px;
    background-color: #334155;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.gc-icon-wrap .material-icons-outlined { color: white; font-size: 24px; }
.gc-content .gc-title {
    font-size: 1.25rem;
    font-weight: 800;
    margin: 0 0 0.75rem 0;
    color: white;
}
.gc-content .gc-text {
    font-size: 0.875rem;
    color: #cbd5e1;
    line-height: 1.6;
    margin: 0;
}

/* Row Sections */
.refund-row {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}
@media (max-width: 768px) { .refund-row { grid-template-columns: 1fr; gap: 1rem; } }
.rr-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    align-self: start;
    padding-top: 0.25rem;
}
.rr-line {
    width: 20px;
    height: 3px;
    background-color: #2563eb;
    border-radius: 2px;
    flex-shrink: 0;
}
.rr-title {
    font-size: 1.125rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.rr-text {
    font-size: 0.9375rem;
    color: #475569;
    line-height: 1.7;
    margin: 0;
}

/* Non-Refundable List */
.non-refund-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.875rem;
}
.non-refund-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: #475569;
    line-height: 1.5;
}
.non-refund-list .material-icons-outlined {
    color: #ef4444;
    font-size: 18px;
    flex-shrink: 0;
}

/* Feature Cards */
.rfeat-cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin: 4rem 0;
}
@media (max-width: 640px) { .rfeat-cards-grid { grid-template-columns: 1fr; } }
.rfc-card {
    background-color: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
}
.rfc-title-wrap {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}
.rfc-icon { color: #2563eb; font-size: 20px; }
.rfc-title {
    font-size: 1rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.rfc-text {
    font-size: 0.8125rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Footer Banner */
.refund-banner {
    background-color: #0f172a;
    border-radius: 12px;
    padding: 2.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
}
@media (max-width: 640px) { .refund-banner { flex-direction: column; align-items: flex-start; gap: 1.5rem; } }
.rb-left .rb-title {
    font-size: 1.125rem;
    font-weight: 800;
    color: white;
    margin: 0 0 0.5rem 0;
}
.rb-left .rb-desc { font-size: 0.875rem; color: #94a3b8; margin: 0; }
.rb-right a {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-weight: 800;
    font-size: 0.875rem;
    text-decoration: none;
    transition: color 0.2s;
}
.rb-right a:hover { color: #cbd5e1; }
.rb-right a .material-icons-outlined { font-size: 16px; }
</style>
@endpush

@section('content')
<div class="refund-page-wrapper">
    <div class="refund-container">

        <!-- Header -->
        <div class="refund-header">
            <div class="refund-badge">Legal Documentation</div>
            <h1 class="refund-title">Refund Policy</h1>
            <p class="refund-desc">Last updated: October 24, 2023. We want you to be completely satisfied with our services. Please read this policy carefully before subscribing.</p>
        </div>

        <!-- 30-Day Guarantee Card -->
        <div class="guarantee-card">
            <div class="gc-icon-wrap">
                <span class="material-icons-outlined">verified</span>
            </div>
            <div class="gc-content">
                <h2 class="gc-title">30-Day Satisfaction Guarantee</h2>
                <p class="gc-text">All new subscriptions come with a 30-day money-back guarantee. If you are not satisfied with our service within the first 30 days of your initial subscription, you may request a full refund — no questions asked. We stand behind the quality of our WordPress concierge services.</p>
            </div>
        </div>

        <!-- How to Request -->
        <div class="refund-row">
            <div class="rr-left">
                <div class="rr-line"></div>
                <h2 class="rr-title">How to Request a Refund</h2>
            </div>
            <div>
                <p class="rr-text">To request a refund, contact our billing team at <a href="mailto:billing@wpmaintenance.com" style="color:#2563eb; font-weight:700;">billing@wpmaintenance.com</a> with your subscription details and reason for the request. Refund requests must be submitted within the 30-day guarantee window. Our team will respond within 1–2 business days to confirm and initiate the process.</p>
            </div>
        </div>

        <!-- Feature Cards: Processing Time & Plan Downgrades -->
        <div class="rfeat-cards-grid">
            <div class="rfc-card">
                <div class="rfc-title-wrap">
                    <span class="material-icons-outlined rfc-icon">schedule</span>
                    <h3 class="rfc-title">Processing Time</h3>
                </div>
                <p class="rfc-text">Approved refunds are processed within 5–10 business days and credited back to the original payment method used during subscription.</p>
            </div>
            <div class="rfc-card">
                <div class="rfc-title-wrap">
                    <span class="material-icons-outlined rfc-icon">trending_down</span>
                    <h3 class="rfc-title">Plan Downgrades</h3>
                </div>
                <p class="rfc-text">If you downgrade your plan, the price difference is not refunded but applied as credit toward future billing cycles, effective at next renewal.</p>
            </div>
        </div>

        <!-- Non-Refundable Items -->
        <div class="refund-row">
            <div class="rr-left">
                <div class="rr-line"></div>
                <h2 class="rr-title">Non-Refundable Items</h2>
            </div>
            <div>
                <ul class="non-refund-list">
                    <li>
                        <span class="material-icons-outlined">cancel</span>
                        Subscriptions cancelled beyond the 30-day guarantee period
                    </li>
                    <li>
                        <span class="material-icons-outlined">cancel</span>
                        Custom development work that has already been completed
                    </li>
                    <li>
                        <span class="material-icons-outlined">cancel</span>
                        Emergency support hours that have already been consumed
                    </li>
                    <li>
                        <span class="material-icons-outlined">cancel</span>
                        Renewal charges (cancellation must be requested before the renewal date)
                    </li>
                </ul>
            </div>
        </div>

        <!-- Partial Refunds -->
        <div class="refund-row" style="margin-bottom: 0;">
            <div class="rr-left">
                <div class="rr-line"></div>
                <h2 class="rr-title">Partial Refunds</h2>
            </div>
            <div>
                <p class="rr-text" style="font-style: italic;">Partial refunds may be considered on a case-by-case basis for subscriptions cancelled mid-cycle after the guarantee period has elapsed. Please contact our billing team to discuss your specific situation — we are committed to fair resolution.</p>
            </div>
        </div>

        <!-- Footer Banner -->
        <div class="refund-banner">
            <div class="rb-left">
                <h2 class="rb-title">Questions about a refund?</h2>
                <p class="rb-desc">Our billing team is available to assist you with any concerns.</p>
            </div>
            <div class="rb-right">
                <a href="mailto:billing@wpmaintenance.com">
                    billing@wpmaintenance.com
                    <span class="material-icons-outlined">open_in_new</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
