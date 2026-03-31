@extends('layouts.admin')
@section('title', 'Clients Management')

@push('styles')
<style>
/* Clients Section Styles */
.cl-container {
    background: #f8f9fc;
    min-height: auto;
    padding-bottom: 0;
    overflow-x: hidden;
    width: 100%;
    box-sizing: border-box;
}

/* Header Config */
.cl-header-wrap {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: var(--space-8);
    flex-wrap: wrap;
    gap: var(--space-4);
    width: 100%;
    min-width: 0;
}
.cl-title { font-size: 2.25rem; font-weight: 800; color: #1a233a; }
.cl-subtitle {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    color: var(--on-surface-variant);
    font-size: 0.9375rem;
    margin-top: var(--space-2);
}
.cl-subtitle strong { color: #1a233a; }
.cl-concierge-pill {
    background: #eefdf4;
    color: #16a34a;
    font-size: 0.6875rem;
    font-weight: 800;
    padding: 6px 12px;
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    gap: 6px;
    letter-spacing: 0.05em;
}
.cl-concierge-pill::before { content: ''; width: 6px; height: 6px; background: #16a34a; border-radius: 50%; }

/* Header Controls */
.cl-controls {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    flex-wrap: wrap;
    min-width: 0;
    overflow: visible;
}
.cl-filter-form {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    flex-wrap: wrap;
}
.cl-search {
    display: flex;
    align-items: center;
    background: #f1f3f9;
    padding: 0.625rem 1rem;
    border-radius: var(--radius-lg);
    width: 180px;
    min-width: 120px;
    gap: 8px;
    flex-shrink: 1;
}
.cl-search input { border: none; background: transparent; outline: none; font-size: 0.875rem; color: var(--on-surface); width: 100%; }
.cl-search .material-icons-outlined { color: #a0aec0; font-size: 1.125rem; }

.cl-filter-select {
    background: #f1f3f9;
    padding: 1rem 3rem 1rem 1.25rem;
    border-radius: 999px;
    font-size: 0.9375rem;
    font-weight: 700;
    color: #334155;
    min-height: 56px;
    min-width: 250px;
    border: 1px solid transparent;
    cursor: pointer;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='22' height='22' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 20px 20px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.cl-filter-select:hover {
    border-color: #d8deea;
}
.cl-filter-select:focus {
    border-color: #c4cedf;
    box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.15);
}
.cl-apply-btn {
    background: #1a233a;
    color: #fff;
    padding: 0.625rem 1rem;
    border-radius: var(--radius-lg);
    font-size: 0.8125rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
}

/* 2-Column Main Layout */
.cl-main-grid {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
    gap: var(--space-6);
    margin-bottom: var(--space-8);
    width: 100%;
    min-width: 0;
}

/* Table scroll wrapper for small screens */
.cl-table-scroll {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Responsive Breakpoints */
@media (max-width: 1280px) {
    .cl-main-grid {
        grid-template-columns: minmax(0, 3fr) minmax(0, 2fr);
        gap: var(--space-4);
    }
}

@media (max-width: 1024px) {
    .cl-main-grid {
        grid-template-columns: 1fr;
    }
    .cl-detail-card {
        position: static;
    }
    .cl-controls {
        overflow-x: auto;
        padding-bottom: 4px;
    }
}

@media (max-width: 768px) {
    .cl-header-wrap {
        flex-direction: column;
        align-items: flex-start;
    }
    .cl-controls {
        width: 100%;
        justify-content: flex-start;
    }
    .cl-search {
        flex: 1;
        min-width: 0;
    }
    .cl-title {
        font-size: 1.75rem;
    }
    .cl-table th:nth-child(3),
    .cl-table td:nth-child(3),
    .cl-table th:nth-child(4),
    .cl-table td:nth-child(4) {
        display: none;
    }
    .cl-recent-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .cl-controls {
        flex-direction: column;
        align-items: stretch;
    }
    .cl-search {
        width: 100%;
    }
    .cl-filter-select {
        width: 100%;
        min-width: 0;
    }
    .cl-table th:nth-child(2),
    .cl-table td:nth-child(2) {
        display: none;
    }
    .cl-recent-grid {
        grid-template-columns: 1fr;
    }
    .dt-stats {
        flex-direction: column;
    }
    .cl-av-box {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}

/* Left Table Card */
.cl-table-card {
    background: #ffffff;
    border-radius: 20px;
    padding: var(--space-6);
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
}
.cl-table { width: 100%; border-collapse: collapse; }
.cl-table th {
    text-align: left;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    color: #a0aec0;
    padding: var(--space-4) var(--space-4) var(--space-6);
    border-bottom: 1px solid #edf2f7;
    text-transform: uppercase;
}
.cl-table td { padding: 1.25rem var(--space-4); border-bottom: 1px solid #f8f9fa; vertical-align: middle; }
.cl-tr.active { background: #eef2ff; border-radius: var(--radius-lg); }
.cl-tr.active td:first-child { border-top-left-radius: var(--radius-lg); border-bottom-left-radius: var(--radius-lg); }
.cl-tr.active td:last-child { border-top-right-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg); }
.cl-tr:last-child td { border-bottom: none; }
.cl-tr.active td { border-bottom: none; }
.cl-tr:hover:not(.active) { background: #fafbfc; position: relative; } /* hover for non-active */

/* Client Box inside Table */
.cl-client-box { display: flex; align-items: center; gap: var(--space-4); text-decoration: none; color: inherit; }
.cl-av-box {
    width: 48px; height: 48px; border-radius: var(--radius-md);
    background: #1a202c; color: white; display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; font-weight: 800;
}
.cl-av-green { background: #2f855a; }
.cl-av-light { background: #ffffff; color: #2f855a; border: 1px solid #e2e8f0; }

.cl-client-name { font-weight: 800; font-size: 1rem; color: #1a202c; }
.cl-client-url { font-size: 0.8125rem; color: #a0aec0; margin-top: 2px; }

/* Status Badges */
.cl-badge { font-size: 0.6875rem; font-weight: 800; padding: 6px 14px; border-radius: var(--radius-full); letter-spacing: 0.05em; text-transform: uppercase; }
.b-active { background: #eefdf4; color: #16a34a; }
.b-overdue { background: #fff5f5; color: #e53e3e; }
.b-pending { background: #fffaf0; color: #dd6b20; }

/* Plan Tier */
.cl-plan-cell { color: #4a6fa5; font-size: 0.9375rem; font-weight: 600; }
.cl-date-cell { font-size: 0.875rem; color: #718096; line-height: 1.4; }

/* Right Panel Selected Card */
.cl-detail-card {
    background: #ffffff;
    border-radius: 20px;
    padding: var(--space-8);
    box-shadow: 0 4px 30px rgba(0,0,0,0.06);
    position: sticky;
    top: var(--space-8);
}
.dt-super { font-size: 0.75rem; font-weight: 800; color: #e53e3e; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: var(--space-2); }
.dt-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--space-2); }
.dt-title { font-size: 1.75rem; font-weight: 800; color: #1a202c; line-height: 1.2; }
.dt-sub { font-size: 0.875rem; color: #718096; margin-bottom: var(--space-6); }

/* Double Stat Blocks */
.dt-stats { display: flex; gap: var(--space-4); margin-bottom: var(--space-8); }
.dt-stat-box { flex: 1; background: #f4f6fa; border-radius: var(--radius-lg); padding: var(--space-4); }
.dt-stat-label { font-size: 0.6875rem; font-weight: 800; color: #a0aec0; letter-spacing: 0.05em; margin-bottom: var(--space-1); }
.dt-stat-val { font-size: 0.9375rem; font-weight: 800; color: #1a202c; display: flex; align-items: center; gap: 4px; }
.dt-stat-val .dot { width: 6px; height: 6px; background: #16a34a; border-radius: 50%; display: inline-block; }

/* Invoice History */
.dt-hist-title { font-size: 0.8125rem; font-weight: 800; color: #1a202c; text-transform: uppercase; margin-bottom: var(--space-4); }
.dt-hist-list { display: flex; flex-direction: column; gap: var(--space-4); margin-bottom: var(--space-8); }
.dt-inv-item { display: flex; align-items: center; gap: var(--space-3); }
.dt-inv-icon { width: 28px; height: 28px; background: #eef2ff; color: #4a6fa5; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.dt-inv-icon .material-icons-outlined { font-size: 0.875rem; font-weight: bold; }
.dt-inv-info { flex: 1; }
.dt-inv-month { font-size: 0.875rem; font-weight: 800; color: #1a202c; }
.dt-inv-sub { font-size: 0.75rem; color: #a0aec0; }
.dt-inv-amt { font-size: 0.875rem; font-weight: 800; color: #1a202c; }

/* Detail Buttons */
.dt-btn { width: 100%; padding: 0.875rem; border-radius: var(--radius-lg); font-size: 0.875rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; border: none; transition: background 0.2s; text-decoration: none; }
.btn-slate { background: #3b4a6b; color: white; margin-bottom: var(--space-3); box-shadow: 0 4px 12px rgba(59, 74, 107, 0.2); }
.btn-slate:hover { background: #2d3852; }
.btn-light { background: #f0f4f8; color: #4a5568; margin-bottom: var(--space-6); }
.btn-light:hover { background: #e2e8f0; }

.dt-footer-actions { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #edf2f7; padding-top: var(--space-5); }
.dt-btn-outline { font-size: 0.8125rem; font-weight: 700; color: #4a5568; padding: 6px 16px; border: 1px solid #e2e8f0; border-radius: var(--radius-full); text-decoration: none; }
.dt-btn-suspend { font-size: 0.8125rem; font-weight: 700; color: #e53e3e; text-decoration: none; }

/* Recently Onboarded Component */
.cl-recent-sec { margin-top: var(--space-8); }
.cl-recent-title { font-size: 1.5rem; font-weight: 800; color: #1a233a; margin-bottom: var(--space-6); }
.cl-recent-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--space-6); }
@media (max-width: 768px) { .cl-recent-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .cl-recent-grid { grid-template-columns: 1fr; } }
.cl-recent-card { background: #ffffff; border-radius: var(--radius-xl); padding: var(--space-6); box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; align-items: center; gap: var(--space-4); position: relative; }
.cl-r-avatar { width: 48px; height: 48px; border-radius: 50%; background: #fdf6b2; overflow: hidden; }
.cl-r-avatar img { width: 100%; height: 100%; object-fit: cover; }
.cl-r-info { flex: 1; }
.cl-r-name { font-size: 1rem; font-weight: 800; color: #1a202c; }
.cl-r-plan { font-size: 0.8125rem; color: #718096; margin-bottom: var(--space-2); }
.cl-r-status { font-size: 0.625rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 4px; }
.r-status-pending { color: #dd6b20; }
.r-status-active { color: #16a34a; }

/* Keep footer aligned tightly below clients content */
.cl-container + .universal-console-footer {
    margin-top: var(--space-6);
}
</style>
@endpush

@section('content')
@php
    $canManageClients = auth()->check() && auth()->user()->hasAnyRole(['admin', 'manager']);
    $canAccessInvoices = auth()->check() && auth()->user()->hasAnyRole(['admin', 'manager']);
@endphp
<div class="cl-container">
    {{-- Header Row --}}
    <div class="cl-header-wrap">
        <div>
            <h1 class="cl-title">Clients Management</h1>
            <div class="cl-subtitle">
                Displaying <strong>{{ $activeClientsCount }}</strong> active clients in your roster
                <div class="cl-concierge-pill">CONCIERGE ACTIVE</div>
            </div>
        </div>
        
        <div class="cl-controls">
            <form method="GET" action="{{ route('admin.clients') }}" id="cl-search-form" class="cl-filter-form">
                <div class="cl-search">
                    <span class="material-icons-outlined">search</span>
                    <input
                        type="text"
                        name="search"
                        id="cl-search-input"
                        placeholder="Search clients…"
                        value="{{ $search ?? '' }}"
                        autocomplete="off"
                    >
                    @if($search ?? false)
                        <a href="{{ route('admin.clients') }}" style="color:#a0aec0; display:flex; align-items:center;" title="Clear search">
                            <span class="material-icons-outlined" style="font-size:1rem;">close</span>
                        </a>
                    @endif
                </div>

                <select class="cl-filter-select" name="scope">
                    <option value="all" {{ ($scope ?? 'all') === 'all' ? 'selected' : '' }}>All Clients</option>
                    <option value="agency" {{ ($scope ?? 'all') === 'agency' ? 'selected' : '' }}>By Agency</option>
                </select>

                <select class="cl-filter-select" name="plan">
                    <option value="all" {{ ($planFilter ?? 'all') === 'all' ? 'selected' : '' }}>Plan: All</option>
                    @foreach(($planOptions ?? collect()) as $optPlan)
                        <option value="{{ $optPlan->slug }}" {{ ($planFilter ?? 'all') === $optPlan->slug ? 'selected' : '' }}>
                            Plan: {{ $optPlan->name }}
                        </option>
                    @endforeach
                </select>

            </form>
        </div>

    </div>

    {{-- Main Grid Content --}}
    <div id="search-results-region">
    <div class="cl-main-grid">
        
        {{-- LEFT COLUMN: Clients Table --}}
        <div>
            <div class="cl-table-card">
                <div class="cl-table-scroll">
                <table class="cl-table" data-yajra="1">
                    <thead>
                        <tr>
                            <th>CLIENT IDENTITY</th>
                            <th>STATUS</th>
                            <th>PLAN TIER</th>
                            <th>ENROLLED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                        @php
                            $isActiveReq = $selectedClient && $selectedClient->id === $client->id;
                            $statusMap = [
                                'active' => ['class' => 'b-active', 'label' => 'ACTIVE'],
                                'overdue' => ['class' => 'b-overdue', 'label' => 'OVERDUE'],
                                'pending' => ['class' => 'b-pending', 'label' => 'PENDING'],
                            ];
                            $statConf = $statusMap[strtolower($client->status)] ?? $statusMap['active'];
                            $host = parse_url($client->website_url ?? 'https://unknown.com', PHP_URL_HOST) ?? $client->website_url;
                            $firstLetter = strtoupper(substr($client->company_name ?? $client->first_name, 0, 1));
                        @endphp
                        <tr class="cl-tr {{ $isActiveReq ? 'active' : '' }}">
                            <td>
                                <a href="{{ route('admin.clients', array_merge(request()->query(), ['selected' => $client->id])) }}" class="cl-client-box">
                                    <div class="cl-av-box {{ $loop->index % 3 == 1 ? 'cl-av-green' : ($loop->index % 3 == 2 ? 'cl-av-light' : '') }}">
                                        {{ $firstLetter }}
                                    </div>
                                    <div>
                                        <div class="cl-client-name">{{ $client->company_name ?? $client->full_name }}</div>
                                        <div class="cl-client-url">{{ $host }}</div>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <span class="cl-badge {{ $statConf['class'] }}">{{ $statConf['label'] }}</span>
                            </td>
                            <td class="cl-plan-cell">
                                {{ $client->activeSubscription?->plan?->name ?? 'Standard' }}
                            </td>
                            <td class="cl-date-cell">
                                {{ $client->created_at->format('M d,') }}<br>
                                {{ $client->created_at->format('Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding: 3rem; color: #a0aec0;">No clients found in the system.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
                
                <div class="yajra-table-footer" style="margin-top:var(--space-6);"></div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Selected Portfolio Details --}}
        <div>
            @if($selectedClient)
            <div class="cl-detail-card">
                <div class="dt-super">Selected Portfolio</div>
                <div class="dt-head">
                    <div>
                        <div class="dt-title">{{ $selectedClient->company_name ?? $selectedClient->full_name }}</div>
                        <div class="dt-sub">Managing since {{ $selectedClient->created_at->format('M Y') }}</div>
                    </div>
                    <div class="cl-av-box cl-av-green" style="border-radius:12px;">{{ strtoupper(substr($selectedClient->company_name ?? $selectedClient->first_name, 0, 1)) }}</div>
                </div>

                {{-- Feature Blocks --}}
                <div class="dt-stats">
                    <div class="dt-stat-box">
                        <div class="dt-stat-label">CURRENT PLAN</div>
                        <div class="dt-stat-val">
                            {{ $selectedClient->activeSubscription?->plan?->name ?? 'Pro' }}<br>
                            <span style="font-size:0.8125rem; font-weight:600; color:#718096;">(${{ rtrim(rtrim(number_format($selectedClient->activeSubscription?->amount ?? 499, 2), '0'), '.') }}/mo)</span>
                        </div>
                    </div>
                    <div class="dt-stat-box">
                        <div class="dt-stat-label">SERVER HEALTH</div>
                        <div class="dt-stat-val"><span class="dot"></span> 99.9%</div>
                    </div>
                </div>

                <div class="dt-hist-title">Subscription History</div>
                <div class="dt-hist-list">
                    @forelse($selectedClient->invoices ?? [] as $invoice)
                    <div class="dt-inv-item">
                        <div class="dt-inv-icon"><span class="material-icons-outlined">check</span></div>
                        <div class="dt-inv-info">
                            <div class="dt-inv-month">{{ $invoice->due_date->format('F Y') }}</div>
                            <div class="dt-inv-sub">Paid via {{ $invoice->payment_method ?? 'Stripe' }}</div>
                        </div>
                        <div class="dt-inv-amt">${{ number_format($invoice->total, 2) }}</div>
                    </div>
                    @empty
                    <div class="dt-inv-item">
                        <div class="dt-inv-icon"><span class="material-icons-outlined">check</span></div>
                        <div class="dt-inv-info">
                            <div class="dt-inv-month">March 2024</div>
                            <div class="dt-inv-sub">Paid via Stripe</div>
                        </div>
                        <div class="dt-inv-amt">$499.00</div>
                    </div>
                    <div class="dt-inv-item">
                        <div class="dt-inv-icon"><span class="material-icons-outlined">check</span></div>
                        <div class="dt-inv-info">
                            <div class="dt-inv-month">February 2024</div>
                            <div class="dt-inv-sub">Paid via Stripe</div>
                        </div>
                        <div class="dt-inv-amt">$499.00</div>
                    </div>
                    <div class="dt-inv-item">
                        <div class="dt-inv-icon"><span class="material-icons-outlined">check</span></div>
                        <div class="dt-inv-info">
                            <div class="dt-inv-month">January 2024</div>
                            <div class="dt-inv-sub">Setup & First Month</div>
                        </div>
                        <div class="dt-inv-amt">$899.00</div>
                    </div>
                    @endforelse
                </div>

                @if($canAccessInvoices)
                    <a href="{{ $selectedClient->invoices->first() ? route('admin.invoices.show', $selectedClient->invoices->first()->id) : route('admin.invoices') }}" class="dt-btn btn-slate">
                        <span class="material-icons-outlined" style="font-size:1.125rem">send</span> Resend Latest Invoice
                    </a>
                    <a href="{{ route('admin.invoices', ['search' => $selectedClient->email]) }}" class="dt-btn btn-light">View Billing History</a>
                @endif

                @if($canManageClients)
                    <div class="dt-footer-actions">
                        <a href="{{ route('admin.clients.edit', $selectedClient->id) }}" class="dt-btn-outline">Edit Details</a>
                        <form action="{{ route('admin.clients.suspend', $selectedClient->id) }}" method="POST" style="margin:0;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="dt-btn-suspend" style="background:none;border:none;cursor:pointer;">Suspend Account</button>
                        </form>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>

    {{-- Bottom Recently Onboarded Section --}}
    <div class="cl-recent-sec">
        <h2 class="cl-recent-title">Recently Onboarded</h2>
        <div class="cl-recent-grid">
            @foreach($recentClients as $recent)
            <div class="cl-recent-card border-none">
                <div class="cl-r-avatar">
                   {{-- Mock placeholder for user portrait --}}
                   <img src="https://ui-avatars.com/api/?name={{ urlencode($recent->company_name ?? $recent->first_name) }}&background=fdf6b2&color=dd6b20" alt="Avatar">
                </div>
                <div class="cl-r-info">
                    <div class="cl-r-name">{{ $recent->company_name ?? $recent->full_name }}</div>
                    <div class="cl-r-plan">{{ $recent->activeSubscription?->plan?->name ?? 'Startup' }} Plan • {{ $recent->created_at->diffForHumans() }}</div>
                    
                    @if($loop->first)
                        <div class="cl-r-status r-status-pending"><span class="status-dot" style="background:#dd6b20;width:6px;height:6px;border-radius:50%;display:inline-block;"></span> CONFIGURATION PENDING</div>
                    @else
                        <div class="cl-r-status r-status-active"><span class="status-dot" style="background:#16a34a;width:6px;height:6px;border-radius:50%;display:inline-block;"></span> 
                            {{ $loop->index == 1 ? 'DNS PROPAGATED' : 'ACTIVE MONITORING' }}
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
            
            @if($recentClients->count() < 3)
                @for($i = $recentClients->count(); $i < 3; $i++)
                <div class="cl-recent-card">
                    <div class="cl-r-avatar">
                        <img src="https://ui-avatars.com/api/?name=Generic&background=e2e8f0&color=a0aec0" alt="Avatar">
                    </div>
                    <div class="cl-r-info">
                        <div class="cl-r-name">Generic Client</div>
                        <div class="cl-r-plan">Basic Plan • 1w ago</div>
                        <div class="cl-r-status r-status-active"><span class="status-dot" style="background:#16a34a;width:6px;height:6px;border-radius:50%;display:inline-block;"></span> ACTIVE MONITORING</div>
                    </div>
                </div>
                @endfor
            @endif
    </div>
    </div> <!-- Close search-results-region -->
</div>
@endsection

@push('scripts')
<script>
(function () {
    const input = document.getElementById('cl-search-input');
    const form  = document.getElementById('cl-search-form');
    const selects = form ? form.querySelectorAll('select[name=\"scope\"], select[name=\"plan\"]') : [];
    if (!input || !form) return;

    let timer;
    input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            form.submit();
        }, 400); // 400ms debounce
    });

    // Submit immediately on Enter key
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            clearTimeout(timer);
            form.submit();
        }
    });

    // Auto-focus at end of input value on page load (so cursor is after existing text)
    if (input.value) {
        const len = input.value.length;
        input.focus();
        input.setSelectionRange(len, len);
    }

    selects.forEach(function (select) {
        select.addEventListener('change', function () {
            clearTimeout(timer);
            form.submit();
        });
    });
})();
</script>
@endpush
