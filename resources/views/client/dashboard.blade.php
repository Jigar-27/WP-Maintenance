@extends('layouts.client')

@section('title', 'Dashboard')

@push('styles')
<style>
    .cd-header { margin-bottom: 2rem; }
    .cd-title { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin-bottom: 0.25rem; }
    .cd-subtitle { font-size: 0.9375rem; color: #64748b; }

    .cd-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
    @media (max-width: 768px) { .cd-grid { grid-template-columns: 1fr; } }
    
    .cd-card { background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
    .cd-card-title { font-size: 1.125rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; justify-content: space-between; }
    
    .cd-status-hero {
        background: linear-gradient(135deg, #fffaf0 0%, #ffffff 100%);
        border: 1px solid #fce8cd;
        position: relative;
        overflow: hidden;
    }
    .cd-status-badge {
        display: inline-flex; align-items: center; gap: 6px; background: #dcfce7; color: #166534;
        padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
        margin-bottom: 1rem;
    }
    .cd-status-badge .material-icons-outlined { font-size: 14px; }
    
    .cd-metrics { display: flex; gap: 3rem; margin-top: 2rem; }
    .cd-metric-val { font-size: 2rem; font-weight: 800; color: #0f172a; line-height: 1; margin-bottom: 0.25rem; }
    .cd-metric-lbl { font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; }
    .cd-last-checked { font-size: 0.75rem; color: #94a3b8; margin-top: 1rem; text-align: right; }

    .cd-billing-card { display: flex; flex-direction: column; justify-content: center; text-align: center; }
    .cd-billing-title { font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .cd-billing-amount { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: 0.25rem; }
    .cd-billing-date { font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem; }
    .cd-btn { width: 100%; padding: 0.75rem; border-radius: 6px; font-weight: 600; font-size: 0.875rem; text-align: center; cursor: pointer; border: none; }
    .cd-btn-primary { background: #ea580c; color: white; transition: background 0.2s;}
    .cd-btn-primary:hover { background: #c2410c; }
    .cd-btn-secondary { background: #e0e7ff; color: #4338ca; transition: background 0.2s; margin-bottom: 0.5rem; }
    .cd-btn-secondary:hover { background: #c7d2fe; }

    .cd-update-item { display: flex; align-items: flex-start; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid #f1f5f9; }
    .cd-update-item:last-child { border-bottom: none; padding-bottom: 0; }
    .cd-update-icon {
        width: 32px; height: 32px; border-radius: 50%; background: #fff7ed; color: #ea580c;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .cd-update-content { flex: 1; }
    .cd-update-name { font-weight: 600; font-size: 0.875rem; color: #0f172a; margin-bottom: 0.25rem; }
    .cd-update-desc { font-size: 0.75rem; color: #64748b; line-height: 1.4; }
    .cd-update-time { font-size: 0.75rem; color: #94a3b8; white-space: nowrap; }

    .cd-form-group { margin-bottom: 1rem; }
    .cd-form-label { display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.25rem; text-transform: uppercase; }
    .cd-form-control { width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.875rem; color: #334155; font-family: 'Inter', sans-serif; box-sizing: border-box; }
    .cd-form-control:focus { outline: none; border-color: #ea580c; box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.1); }
</style>
@endpush

@section('content')
<div class="cd-header">
    <h1 class="cd-title">Welcome back, {{ auth()->user()->name ?? 'Custodian' }}</h1>
    <div class="cd-subtitle">Your WordPress ecosystem is currently optimized and secured.</div>
</div>

<div class="cd-grid">
    <div class="cd-card cd-status-hero">
        <div class="cd-status-badge">
            <span class="material-icons-outlined">verified</span>
            Secure & Online
        </div>
        <h2 class="cd-card-title" style="font-size: 1.5rem; margin-bottom: 0;">Your Site Status</h2>
        
        <div class="cd-metrics">
            <div>
                <div class="cd-metric-lbl">Uptime</div>
                <div class="cd-metric-val">99.99%</div>
            </div>
            <div>
                <div class="cd-metric-lbl">Response</div>
                <div class="cd-metric-val">340ms</div>
            </div>
        </div>
        <div class="cd-last-checked">Last checked: 3 mins ago</div>
    </div>
    
    <div class="cd-card cd-billing-card">
        <div class="cd-billing-title">Current Plan</div>
        @php
            $currentPrice = $activeSubscription->amount ?? optional($activeSubscription->plan)->price ?? 0;
            $renewalDate = optional($activeSubscription->end_date)->format('M d, Y') ?? 'N/A';
            $manageBillingUrl = route('payment', $activeSubscription->id);
            $upgradeUrl = $upgradePlan ? route('onboard', $upgradePlan->slug) : route('plans');
        @endphp
        <div class="cd-billing-amount">${{ number_format((float) ($currentPrice ?? 0), 2) }} <span style="font-size:1rem; color:#64748b; font-weight:600;">/mo</span></div>
        <div class="cd-billing-date">
            Next renewal: {{ $renewalDate }}
        </div>
        <a href="{{ $manageBillingUrl }}" class="cd-btn cd-btn-secondary" style="display:block; text-decoration:none;">Manage Billing</a>
        <a href="{{ $upgradeUrl }}" class="cd-btn cd-btn-primary" style="display:block; text-decoration:none; background:none; border:none; color:#ea580c; padding:0.5rem;">
            {{ $upgradePlan ? 'Upgrade Plan' : 'View Plans' }}
        </a>
    </div>
</div>

<div class="cd-grid">
    <div class="cd-card">
        <div class="cd-card-title">
            Latest Updates
            <span class="material-icons-outlined" style="color:#94a3b8; font-size:18px;">history</span>
        </div>
        
        <div class="cd-update-item">
            <div class="cd-update-icon"><span class="material-icons-outlined" style="font-size:16px;">cloud_sync</span></div>
            <div class="cd-update-content">
                <div style="display:flex; justify-content:space-between; margin-bottom:0.25rem;">
                    <div class="cd-update-name">Full System Backup</div>
                    <div class="cd-update-time">Today, 3:00 am</div>
                </div>
                <div class="cd-update-desc">Automated cloud-redundant backup completed successfully. Total size: 4.2GB.</div>
            </div>
        </div>
        
        <div class="cd-update-item">
            <div class="cd-update-icon"><span class="material-icons-outlined" style="font-size:16px;">security</span></div>
            <div class="cd-update-content">
                <div style="display:flex; justify-content:space-between; margin-bottom:0.25rem;">
                    <div class="cd-update-name">Malware Scan</div>
                    <div class="cd-update-time">Yesterday</div>
                </div>
                <div class="cd-update-desc">Deep scan: 45,120 files verified. No vulnerabilities detected in core or plugins.</div>
            </div>
        </div>
        
        <div class="cd-update-item">
            <div class="cd-update-icon"><span class="material-icons-outlined" style="font-size:16px;">speed</span></div>
            <div class="cd-update-content">
                <div style="display:flex; justify-content:space-between; margin-bottom:0.25rem;">
                    <div class="cd-update-name">Core Optimization</div>
                    <div class="cd-update-time">Tues 18</div>
                </div>
                <div class="cd-update-desc">Database tables optimized and cache purged. Performance increased by 12%.</div>
            </div>
        </div>
    </div>
    
    <div class="cd-card">
        <div class="cd-card-title">Support Ticket</div>
        <div style="font-size:0.875rem; color:#64748b; margin-bottom:1.5rem;">Need assistance? Our concierge team is ready to help.</div>
        
        <form>
            <div class="cd-form-group">
                <label class="cd-form-label">Subject</label>
                <input type="text" class="cd-form-control" placeholder="I need help with...">
            </div>
            <div class="cd-form-group">
                <label class="cd-form-label">Message</label>
                <textarea class="cd-form-control" rows="4" placeholder="Describe your request in detail..."></textarea>
            </div>
            <a href="{{ route('contact') }}" class="cd-btn cd-btn-primary" style="display:flex; align-items:center; justify-content:center; gap:8px; text-decoration:none;">
                <span class="material-icons-outlined" style="font-size:18px;">send</span>
                Submit Ticket
            </a>
        </form>
    </div>
</div>
@endsection
