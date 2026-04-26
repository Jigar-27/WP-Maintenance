@extends('layouts.admin')
@section('title', 'Subscriptions')

@push('styles')
<style>
/* Subscriptions specific styles */
.subs-container {
    background: #f8f9ff;
    min-height: 100vh;
}
/* Header & Add Button */
.subs-header-area {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-8);
}
.subs-header-title { font-size: 2rem; font-weight: 800; color: var(--secondary-deep); letter-spacing: -0.02em; }
.subs-header-sub { font-size: 1rem; color: var(--on-surface-variant); margin-top: var(--space-1); }
.btn-red-add { padding: 0.875rem 1.5rem; background: #b02f00; color: white; display: inline-flex; align-items: center; gap: var(--space-2); border-radius: var(--radius-md); font-weight: 600; font-size: 0.9375rem; border: none; cursor: pointer; }
.btn-red-add:hover { background: #8a2400; }

/* Plan Cards Grid */
.plan-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-6);
    margin-bottom: var(--space-10);
}
.plan-stat-card {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    border: 1.5px solid rgba(228, 190, 180, 0.4);
    position: relative;
    display: flex;
    flex-direction: column;
}
.plan-stat-card.popular {
    border-color: rgba(176, 47, 0, 0.2);
    box-shadow: 0 12px 30px rgba(176, 47, 0, 0.06);
}
.popular-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: #b02f00;
    color: white;
    padding: 4px 12px;
    border-radius: var(--radius-full);
    font-size: 0.6875rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.plan-card-name { font-size: 1.5rem; font-weight: 800; color: var(--on-surface); margin-bottom: 2px; }
.plan-card-bestfor { font-size: 0.8125rem; color: var(--on-surface-variant); font-style: italic; margin-bottom: var(--space-6); }
.plan-card-label { font-size: 0.8125rem; font-weight: 700; color: var(--secondary-deep); margin-bottom: var(--space-2); }
.plan-card-number { font-size: 3rem; font-weight: 800; color: var(--secondary-deep); line-height: 1; margin-bottom: var(--space-5); }
.plan-edit-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    color: #b02f00;
    font-weight: 700;
    font-size: 0.8125rem;
    text-decoration: none;
    margin-top: auto;
}
.plan-card-line {
    width: 32px;
    height: 4px;
    background: rgba(228, 190, 180, 0.5);
    border-radius: 4px;
    margin-top: var(--space-5);
}
.plan-stat-card.popular .plan-card-line { background: #b02f00; width: 48px; }

/* Table Section */
.subs-table-card {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    box-shadow: var(--shadow-sm);
}
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-8);
}
.filter-group { display: flex; gap: var(--space-4); align-items: center; flex-wrap: wrap; }

.filter-input-wrap {
    display: flex;
    align-items: center;
    background: #f4f6fa;
    padding: 0.625rem 1rem;
    border-radius: var(--radius-md);
    width: 260px;
    gap: var(--space-2);
}
.filter-input-wrap input { border: none; background: none; outline: none; font-size: 0.875rem; width: 100%; color: var(--on-surface); }
.filter-input-wrap span { color: var(--on-surface-variant); font-size: 1.125rem; }

.filter-select {
    background: #f4f6fa;
    padding: 0.625rem 2rem 0.625rem 0.875rem;
    border-radius: var(--radius-md);
    border: none;
    outline: none;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--on-surface);
    min-width: 140px;
    cursor: pointer;
}
.btn-apply {
    background: #f4f6fa;
    color: var(--secondary-deep);
    font-weight: 700;
    font-size: 0.875rem;
    padding: 0.625rem 1rem;
    border-radius: var(--radius-md);
    border: none;
    cursor: pointer;
}
.btn-export {
    background: #e6f0ff;
    color: #1e5dd1;
    font-weight: 700;
    font-size: 0.875rem;
    padding: 0.625rem 1.25rem;
    border-radius: var(--radius-md);
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    border: none;
    cursor: pointer;
}

/* Data Table Overrides */
.subs-data-table { width: 100%; border-collapse: collapse; }
.subs-data-table th {
    text-align: left;
    padding: 0 0 var(--space-5) 0;
    font-size: 0.8125rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--outline);
    border-bottom: 2px solid #f4f6fa;
}
.subs-data-table td {
    padding: var(--space-5) 0;
    vertical-align: middle;
    border-bottom: 1px solid #f8f9fc;
}
.subs-data-table tr:hover td { background: rgba(0,0,0,0.01); }

/* Column Specifics */
.client-col { display: flex; align-items: center; gap: var(--space-4); }
.client-avatar { width: 40px; height: 40px; border-radius: 50%; background: #eef2fb; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1rem; color: #b02f00; }
.client-name { font-weight: 800; font-size: 0.9375rem; color: var(--secondary-deep); }
.client-id { font-size: 0.75rem; font-weight: 600; color: var(--on-surface-variant); margin-top: 2px; }

.domain-text { font-size: 0.875rem; color: var(--on-surface-variant); }
.plan-tier-badge {
    background: #eef2fb;
    color: #4a6fa5;
    font-size: 0.6875rem;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: var(--radius-full);
}
.price-text { font-size: 1rem; font-weight: 800; color: var(--secondary-deep); }

/* Status */
.status-indicator { display: inline-flex; align-items: center; gap: 6px; font-weight: 700; font-size: 0.8125rem; }
.status-dot { width: 8px; height: 8px; border-radius: 50%; }
.status-active .status-dot { background: #16a34a; }
.status-active { color: #16a34a; }
.status-expiring { background: #fff0eb; color: #ea580c; padding: 4px 10px; border-radius: var(--radius-md); }
.status-expiring .status-dot { background: #ea580c; display: none; } /* Dot inside pill layout */
.status-expiring::before { content: '!'; display: inline-flex; align-items: center; justify-content: center; width: 14px; height: 14px; background: #ea580c; color: white; border-radius: 50%; font-size: 10px; margin-right: 4px; }

.status-pending .status-dot { background: #f59e0b; }
.status-pending { color: #b45309; }
.status-expired .status-dot { background: #ef4444; }
.status-expired { color: #dc2626; }
.status-cancelled .status-dot { background: #94a3b8; }
.status-cancelled { color: #64748b; }

/* Pagination Footer */
.table-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--space-8);
}
.footer-text { font-size: 0.875rem; color: var(--on-surface-variant); }
.page-nav { display: flex; gap: 4px; }
.page-btn {
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.875rem; font-weight: 700;
    color: var(--on-surface-variant);
    background: #f4f6fa;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
}
.page-btn.active { background: #b02f00; color: white; }
.page-btn:hover:not(.active) { background: #e0e6ed; }

@media (max-width: 1100px) {
    .table-controls { flex-direction: column; align-items: stretch; gap: var(--space-4); }
}

</style>
@endpush

@section('content')
@php
    $isAdminUser = auth()->check() && auth()->user()->isAdmin();
@endphp
<div class="subs-container">
    {{-- Main Header --}}
    <div class="subs-header-area">
        <div>
            <h1 class="subs-header-title">Subscriptions Management</h1>
            <p class="subs-header-sub">Admin Hub for managing client plan tiers, pricing, and lifecycle status.</p>
        </div>
        @if($isAdminUser)
            <a href="{{ route('admin.subscriptions.create') }}" class="btn-red-add">
                <span class="material-icons-outlined" style="font-size: 1.25rem;">add</span>
                Add Subscription
            </a>
        @endif
    </div>

    {{-- Plan Analytics Cards --}}
    <div class="plan-cards-grid">
        @foreach($plans as $plan)
        @php
            $isPopular = (bool) $plan->is_popular;
        @endphp
        <div class="plan-stat-card {{ $isPopular ? 'popular' : '' }}">
            @if($isPopular)
                <div class="popular-badge">MOST POPULAR</div>
            @endif
            <div class="plan-card-name">{{ $plan->name }}</div>
            <div class="plan-card-bestfor">Best For: {{ $plan->best_for ?? 'Growing Businesses' }}</div>
            
            <div class="plan-card-label">Active Subscriptions</div>
            <div class="plan-card-number">{{ $plan->subscriptions_count ?? 0 }}</div>
            
            @if($isAdminUser)
                <a href="{{ route('admin.plans.edit', $plan->id) }}" class="plan-edit-link">
                    <span class="material-icons-outlined" style="font-size: 0.875rem;">edit</span> Edit Plan
                </a>
            @endif
            
            <div class="plan-card-line"></div>
        </div>
        @endforeach

        {{-- Fallback cards if less than 3 plans in database --}}
        @if($plans->count() < 3)
            @for($i = $plans->count(); $i < 3; $i++)
            <div class="plan-stat-card">
                <div class="plan-card-name">Template Plan</div>
                <div class="plan-card-bestfor">Best For: Template use case</div>
                <div class="plan-card-label">Active Subscriptions</div>
                <div class="plan-card-number">0</div>
                @if($isAdminUser && $plans->isNotEmpty())
                    <a href="{{ route('admin.plans.edit', $plans->first()->id) }}" class="plan-edit-link"><span class="material-icons-outlined" style="font-size: 0.875rem;">edit</span> Edit Plan</a>
                @else
                    <span class="plan-edit-link" style="opacity: .5; cursor: not-allowed;"><span class="material-icons-outlined" style="font-size: 0.875rem;">edit</span> Edit Plan</span>
                @endif
                <div class="plan-card-line"></div>
            </div>
            @endfor
        @endif
    </div>

    {{-- Data Table --}}
    <div id="search-results-region">
    @if(($search ?? false) || ($selectedPlan ?? false) || ($selectedStatus ?? false))
        <div style="margin-bottom: var(--space-4); font-size: 0.9375rem; color: var(--on-surface-variant);">
            Filtered subscriptions view —
            <a href="{{ route('admin.subscriptions') }}" style="color: #b02f00; font-weight: 700;">Clear filter</a>
        </div>
    @endif
    <div class="subs-table-card">
        <div class="table-controls">
            <form method="GET" action="{{ route('admin.subscriptions') }}" class="filter-group" id="subs-filter-form">
                <div class="filter-input-wrap">
                    <span class="material-icons-outlined">search</span>
                    <input type="text" name="search" id="subs-search-input" placeholder="Search by name or domain..." value="{{ $search ?? '' }}">
                </div>

                <select class="filter-select" name="plan_id">
                    <option value="">All Plans</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ (string) ($selectedPlan ?? '') === (string) $plan->id ? 'selected' : '' }}>
                            {{ $plan->name }}
                        </option>
                    @endforeach
                </select>

                <select class="filter-select" name="status">
                    <option value="">All Status</option>
                    @foreach(['active' => 'Active', 'expiring' => 'Expiring', 'pending' => 'Pending', 'expired' => 'Expired', 'cancelled' => 'Cancelled'] as $statusValue => $statusLabel)
                        <option value="{{ $statusValue }}" {{ (string) ($selectedStatus ?? '') === $statusValue ? 'selected' : '' }}>
                            {{ $statusLabel }}
                        </option>
                    @endforeach
                </select>

            </form>

            <form method="GET" action="{{ route('admin.subscriptions') }}">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <input type="hidden" name="plan_id" value="{{ $selectedPlan ?? '' }}">
                <input type="hidden" name="status" value="{{ $selectedStatus ?? '' }}">
                <button type="submit" class="btn-export" name="export" value="csv">
                    <span class="material-icons-outlined" style="font-size:1.125rem">file_download</span>
                    Export CSV
                </button>
            </form>
        </div>

        <table class="subs-data-table" data-yajra="1">
            <thead>
                <tr>
                    <th>CLIENT & ID</th>
                    <th>DOMAIN</th>
                    <th>PLAN TIER</th>
                    <th>ANNUAL PRICE</th>

                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscriptions as $sub)
                @php
                    // Dynamic status computation
                    $now = \Carbon\Carbon::now();
                    $daysLeft = $sub->end_date ? $now->diffInDays($sub->end_date, false) : 999;
                    $clientSuspended = ($sub->client?->status === 'suspended');
                    $endPassed = $sub->end_date && $sub->end_date->isPast();

                    if ($clientSuspended) {
                        $computedStatus = 'cancelled';
                    } elseif ($endPassed) {
                        $computedStatus = 'expired';
                    } elseif ($daysLeft <= 15 && $sub->auto_renew) {
                        $computedStatus = 'pending';
                    } elseif ($daysLeft <= 15) {
                        $computedStatus = 'expiring';
                    } else {
                        $computedStatus = 'active';
                    }
                @endphp
                <tr>
                    <td>
                        <div class="client-col">
                            <div class="client-avatar">{{ strtoupper(substr($sub->client?->company_name ?? $sub->client?->full_name ?? 'C', 0, 1)) }}</div>
                            <div>
                                <div class="client-name">{{ $sub->client?->company_name ?? $sub->client?->full_name ?? 'Unknown Client' }}</div>
                                <div class="client-id">#SUB-{{ str_pad($sub->id, 4, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="domain-text">{{ parse_url($sub->client?->website_url ?? 'https://unknown.com', PHP_URL_HOST) ?? $sub->client?->website_url ?? '—' }}</div>
                    </td>
                    <td>
                        <span class="plan-tier-badge">{{ strtoupper($sub->plan?->name ?? 'STANDARD') }}</span>
                    </td>
                    <td>
                        <div class="price-text">${{ number_format($sub->amount ?? $sub->plan?->price ?? 0, 0) }}</div>
                    </td>
                    <td>
                        @if($computedStatus === 'active')
                            <div class="status-indicator status-active"><span class="status-dot"></span>Active</div>
                        @elseif($computedStatus === 'expiring')
                            <div class="status-indicator status-expiring">EXPIRING</div>
                        @elseif($computedStatus === 'pending')
                            <div class="status-indicator status-pending"><span class="status-dot"></span>Pending</div>
                        @elseif($computedStatus === 'expired')
                            <div class="status-indicator status-expired"><span class="status-dot"></span>Expired</div>
                        @elseif($computedStatus === 'cancelled')
                            <div class="status-indicator status-cancelled"><span class="status-dot"></span>Cancelled</div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 3rem 0; color: var(--on-surface-variant);">
                        @if($search ?? false)
                            No subscriptions found matching <strong>"{{ $search }}"</strong>.
                        @else
                            No subscriptions found.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="table-footer yajra-table-footer"></div>
    </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    function bindSubscriptionsAjax() {
        const filterForm = document.getElementById('subs-filter-form');
        if (!filterForm) return;

        const resultsRegion = document.getElementById('search-results-region');
        const searchInput = document.getElementById('subs-search-input');
        const selectInputs = filterForm.querySelectorAll('select[name="plan_id"], select[name="status"]');
        let timer;

        function fetchAndReplace(url) {
            if (!resultsRegion) {
                window.location.href = url;
                return;
            }

            resultsRegion.style.opacity = '0.65';

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function (res) { return res.text(); })
                .then(function (html) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const incoming = doc.getElementById('search-results-region');

                    if (!incoming) {
                        window.location.href = url;
                        return;
                    }

                    resultsRegion.outerHTML = incoming.outerHTML;
                    history.replaceState(null, '', url);
                    if (window.initYajraTables) {
                        window.initYajraTables(document.getElementById('search-results-region'));
                    }
                    bindSubscriptionsAjax();
                })
                .catch(function () {
                    window.location.href = url;
                });
        }

        function submitFilters() {
            const url = new URL(filterForm.action, window.location.origin);
            const formData = new FormData(filterForm);

            formData.forEach(function (value, key) {
                if (String(value).trim() !== '') {
                    url.searchParams.set(key, value);
                }
            });

            fetchAndReplace(url.toString());
        }

        filterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            submitFilters();
        });

        selectInputs.forEach(function (select) {
            select.addEventListener('change', submitFilters);
        });

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(submitFilters, 350);
            });

            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(timer);
                    submitFilters();
                }
            });
        }

        const paginationLinks = document.querySelectorAll('#search-results-region .page-nav a.page-btn');
        paginationLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                fetchAndReplace(link.href);
            });
        });

        const clearLink = document.querySelector('#search-results-region a[href*="admin/subscriptions"]');
        if (clearLink && clearLink.textContent.toLowerCase().includes('clear')) {
            clearLink.addEventListener('click', function (e) {
                e.preventDefault();
                fetchAndReplace(clearLink.href);
            });
        }
    }

    bindSubscriptionsAjax();
    if (window.initYajraTables) {
        window.initYajraTables(document.getElementById('search-results-region'));
    }
})();
</script>
@endpush
