@extends('layouts.admin')
@section('title', 'Internal Management')

@push('stylesheets')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush

@section('content')
<div class="im-dashboard">
    <div class="im-header">
        <div>
            <h1 class="im-title">Internal Management</h1>
            <p class="im-subtitle">Welcome back. Here is the status of your fleet today.</p>
        </div>
        <div class="im-concierge">
            <span class="material-icons-outlined">shield</span>
            Concierge Active
        </div>
    </div>

    <div class="im-top-grid">
        <div class="im-card im-chart-card">
            <div class="im-chart-head">
                <div>
                    <div class="im-chart-title">Growth Analytics</div>
                    <div class="im-chart-sub">Year-over-year subscription trajectory</div>
                </div>
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <select name="period" class="im-period-select" onchange="this.form.submit()">
                        <option value="3" {{ (int)($chartPeriod ?? 6) === 3 ? 'selected' : '' }}>Last 3 Months</option>
                        <option value="6" {{ (int)($chartPeriod ?? 6) === 6 ? 'selected' : '' }}>Last 6 Months</option>
                        <option value="12" {{ (int)($chartPeriod ?? 6) === 12 ? 'selected' : '' }}>Last 12 Months</option>
                    </select>
                </form>
            </div>

            @php
                $maxRevenue = max(array_column($chartData, 'revenue')) ?: 1;
            @endphp
            <div class="im-bars">
                @foreach($chartData as $point)
                    @php
                        $height = max(18, round(($point['revenue'] / $maxRevenue) * 100));
                    @endphp
                    <div class="im-bar-col">
                        <div class="im-bar-wrap">
                            <div class="im-bar {{ $loop->last ? 'active' : '' }}" style="height: {{ $height }}%;"></div>
                        </div>
                        <div class="im-bar-label">{{ strtoupper($point['month']) }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="im-kpi-stack">
            <div class="im-kpi primary">
                <div class="im-kpi-label">Total Subscriptions</div>
                <div class="im-kpi-value-row">
                    <div class="im-kpi-value">{{ $totalSubscriptions }}</div>
                    <div class="im-kpi-growth">
                        <span class="material-icons-outlined">trending_up</span>
                        {{ $subscriptionGrowth }}%
                    </div>
                </div>
            </div>

            <div class="im-kpi">
                <div class="im-kpi-label">Total Revenue</div>
                <div class="im-kpi-value-row">
                    <div class="im-kpi-value">${{ number_format($totalRevenue) }}</div>
                    <div class="im-kpi-sub">USD</div>
                </div>
            </div>

            <div class="im-kpi">
                <div class="im-kpi-label">Total Clients</div>
                <div class="im-kpi-value-row">
                    <div class="im-kpi-value">{{ $totalClients }}</div>
                    <div class="im-kpi-avatars">
                        <img src="https://ui-avatars.com/api/?name=A&background=f0f3ff&color=2d3a5a" alt="Client A">
                        <img src="https://ui-avatars.com/api/?name=B&background=e9eefc&color=2d3a5a" alt="Client B">
                        <img src="https://ui-avatars.com/api/?name=C&background=f3eefc&color=2d3a5a" alt="Client C">
                        <span>+{{ max(0, $totalClients - 3) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="im-bottom-grid">
        <div class="im-card im-table-card">
            <div class="im-table-title">Client Subscriptions</div>
            <table class="im-table" data-yajra="1">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Domain</th>
                        <th>Plan</th>
                        <th>Renewal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSubscriptions as $sub)
                        <tr>
                            <td class="im-client">{{ $sub->client->company_name ?: $sub->client->full_name }}</td>
                            <td class="im-domain">{{ parse_url($sub->client->website_url ?? '', PHP_URL_HOST) ?: ($sub->client->website_url ?: '—') }}</td>
                            <td><span class="im-price-pill">${{ number_format($sub->amount ?: $sub->plan->price) }}</span></td>
                            <td class="im-renew">{{ optional($sub->end_date)->format('M d, Y') ?: '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="im-empty-row">No active subscriptions yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="im-dues-card">
            <div class="im-dues-head">
                <span class="material-icons-outlined">notifications_active</span>
                Upcoming Dues
            </div>

            @forelse($upcomingDues as $due)
                <div class="im-due-item">
                    <div>
                        <div class="im-due-name">{{ $due->client->company_name ?: $due->client->full_name }}</div>
                        <div class="im-due-sub">Expiring in {{ now()->diffInDays($due->end_date) }} days</div>
                    </div>
                    <div>
                        <div class="im-due-amount">${{ number_format($due->amount ?: $due->plan->price) }}</div>
                        <div class="im-due-method">{{ strtoupper($due->payment_method ?: 'INVOICING') }}</div>
                    </div>
                </div>
            @empty
                <div class="im-due-item">
                    <div class="im-due-sub">No upcoming dues.</div>
                </div>
            @endforelse

            <a href="{{ route('admin.dues') }}" class="im-dues-link">View All Dues</a>
        </div>
    </div>

</div>
@endsection
