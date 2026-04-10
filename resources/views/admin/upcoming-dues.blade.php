@extends('layouts.admin')
@section('title', 'Upcoming Dues')

@push('styles')
<style>
/* Global Container */
.ud-wrapper {
    background: #f8f9ff;
    padding-bottom: var(--space-12);
    min-height: 100vh;
}

/* 3-Column Stats Grid */
.ud-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-6);
    margin-bottom: var(--space-10);
}
@media (max-width: 1024px) {
    .ud-stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .ud-stats-grid { grid-template-columns: 1fr; }
}
.ud-stat-card {
    background: #ffffff;
    border-radius: 20px;
    padding: var(--space-6) var(--space-8);
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.ud-stat-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 6px;
    border-radius: 6px 0 0 6px;
}
.sc-orange::before { background: #dd6b20; opacity: 0.5; }
.sc-blue::before { background: #4338ca; opacity: 0.5; }
.sc-red::before { background: #e53e3e; opacity: 0.5; }

.ud-stat-label {
    font-size: 0.75rem;
    font-weight: 800;
    color: #a0aec0;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: var(--space-3);
    position: relative; z-index: 2;
}
.ud-stat-val-row {
    display: flex;
    align-items: baseline;
    gap: var(--space-3);
    position: relative; z-index: 2;
}
.ud-stat-val {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1a233a;
    line-height: 1;
}
.val-red { color: #e53e3e; }
.ud-stat-sub { font-size: 0.8125rem; font-weight: 800; }
.sub-red { color: #dd6b20; }
.sub-blue { color: #a0aec0; }
.sub-alert { color: #e53e3e; }

/* Large faded icons */
.ud-stat-icon {
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 5rem;
    color: #f4f6fa;
    z-index: 1;
    pointer-events: none;
}

/* Main Table Card */
.ud-table-card {
    background: #ffffff;
    border-radius: 20px;
    padding: var(--space-8);
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    margin-bottom: var(--space-10);
}
.ud-tc-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-8);
}
.ud-tc-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #1a233a;
}
.ud-tc-actions { display: flex; gap: var(--space-3); }
.ud-action-btn {
    padding: 0.625rem 1rem;
    border-radius: var(--radius-md);
    font-size: 0.8125rem;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s;
}
.btn-export { background: #f0f4f8; color: #4a5568; }
.btn-export:hover { background: #e2e8f0; }
.btn-bulk { background: #eef2ff; color: #4338ca; }
.btn-bulk:hover { background: #e0e7ff; }

/* Table Configuration */
.ud-table { width: 100%; border-collapse: collapse; }
.ud-table th {
    text-align: left;
    font-size: 0.75rem;
    font-weight: 800;
    color: #a0aec0;
    letter-spacing: 0.05em;
    padding-bottom: var(--space-4);
    border-bottom: 1px solid #edf2f7;
    text-transform: uppercase;
}
.ud-table td {
    padding: 1.5rem 0;
    border-bottom: 2px solid #f8f9fa;
    vertical-align: middle;
}
.ud-table tr:last-child td { border-bottom: none; }

/* Client Info */
.ud-client-cell { display: flex; align-items: center; gap: var(--space-4); }
.ud-c-avatar {
    width: 48px; height: 48px;
    border-radius: 12px;
    background: #1a233a;
    display: flex; align-items: center; justify-content: center;
    position: relative;
}
.ud-c-core {
    width: 20px; height: 20px;
    background: rgba(255,255,255,0.15);
    border-radius: 4px;
    display: flex; align-items: center; justify-content: center;
    color: #ffffff; font-size: 0.75rem; font-weight: 800;
}
.ud-c-name { font-weight: 800; font-size: 0.9375rem; color: #1a202c; }
.ud-c-domain { font-size: 0.8125rem; color: #718096; margin-top: 2px; }

/* Plan Badges */
.ud-plan-badge { padding: 4px 12px; border-radius: var(--radius-full); font-size: 0.6875rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; }
.pl-enterprise { background: #fef3c7; color: #92400e; }
.pl-scaleup { background: #e0e7ff; color: #3730a3; }
.pl-startup { background: #fee2e2; color: #991b1b; }

/* Status */
.ud-status { font-size: 0.875rem; font-weight: 800; display: flex; align-items: center; gap: 6px; }
.ud-status::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
.s-overdue { color: #e53e3e; } .s-overdue::before { background: #e53e3e; }
.s-pending { color: #b45309; } .s-pending::before { background: #b45309; }
.s-processing { color: #4338ca; } .s-processing::before { background: #4338ca; }

/* Auto Renewal */
.ud-ar-badge { padding: 4px 8px; border-radius: 4px; font-size: 0.6875rem; font-weight: 800; letter-spacing: 0.05em; }
.ar-on { background: #e6fffa; color: #047481; }
.ar-off { background: #edf2f7; color: #a0aec0; }

/* Dates & Actions */
.ud-date { font-size: 0.875rem; color: #4a5568; line-height: 1.4; font-weight: 600; }
.ud-action-dot { color: #a0aec0; text-decoration: none; display: inline-flex; transition: color 0.2s; cursor: pointer; border: none; background: transparent; padding: 0; }
.ud-action-dot:hover { color: #2d3748; }
.ud-actions-menu-wrap { position: relative; display: inline-flex; }
.ud-row-menu {
    position: absolute;
    top: 1.55rem;
    right: 0;
    min-width: 180px;
    background: #ffffff;
    border: 1px solid #edf2f7;
    border-radius: 10px;
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
    display: none;
    z-index: 30;
    padding: 0.3rem 0;
}
.ud-row-menu.open { display: block; }
.ud-row-menu-item {
    width: 100%;
    display: block;
    border: none;
    background: transparent;
    text-align: left;
    text-decoration: none;
    color: #4a5568;
    font-size: 0.8125rem;
    font-weight: 700;
    padding: 0.5rem 0.8rem;
    cursor: pointer;
}
.ud-row-menu-item:hover {
    background: #f8fafc;
    color: #1a202c;
}

/* Pagination Area */
.ud-footer-area {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--space-8);
    padding-top: var(--space-6);
    border-top: 1px solid #edf2f7;
}
.ud-showing { font-size: 0.75rem; font-weight: 800; color: #718096; }
.ud-page-controls { display: flex; gap: var(--space-2); }
.ud-page-btn {
    width: 32px; height: 32px;
    border-radius: var(--radius-md);
    background: #ffffff;
    color: #4a5568; font-size: 0.8125rem; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; border: 1px solid #e2e8f0;
    transition: all 0.2s;
}
.ud-page-btn:hover { background: #f7fafc; }
.ud-page-btn.active { background: #b02f00; color: white; border-color: #b02f00; }

/* Help Footer Area */
.ud-help-card {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: var(--space-6) var(--space-8);
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
}
.ud-help-left { display: flex; align-items: center; gap: var(--space-6); }
.ud-av-group { display: flex; align-items: center; }
.ud-av { width: 40px; height: 40px; border-radius: 50%; border: 3px solid #ffffff; background: #e2e8f0; margin-left: -12px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; color: #4a5568; overflow: hidden; }
.ud-av:first-child { margin-left: 0; }
.ud-av img { width: 100%; height: 100%; object-fit: cover; }
.ud-h-title { font-size: 1rem; font-weight: 800; color: #1a202c; margin-bottom: 2px; }
.ud-h-sub { font-size: 0.8125rem; color: #718096; }
.ud-h-btn { background: #3b4a6b; color: white; border: none; padding: 0.875rem 1.5rem; border-radius: var(--radius-md); font-weight: 700; font-size: 0.9375rem; cursor: pointer; transition: background 0.2s; }
.ud-h-btn:hover { background: #2d3852; }

</style>
@endpush

@section('content')
<div class="ud-wrapper">

    {{-- Top Stats Cards --}}
    <div class="ud-stats-grid">
        <div class="ud-stat-card sc-orange">
            <span class="material-icons-outlined ud-stat-icon">account_balance_wallet</span>
            <div class="ud-stat-label">Total Outstanding</div>
            <div class="ud-stat-val-row">
                <div class="ud-stat-val">${{ number_format($totalOutstanding) }}</div>
                <div class="ud-stat-sub {{ $outstandingGrowth >= 0 ? 'sub-red' : 'sub-blue' }}">{{ $outstandingGrowth >= 0 ? '+' : '' }}{{ $outstandingGrowth }}% vs<br>last month</div>
            </div>
        </div>
        
        <div class="ud-stat-card sc-blue">
            <span class="material-icons-outlined ud-stat-icon">event_available</span>
            <div class="ud-stat-label">Due This Week</div>
            <div class="ud-stat-val-row">
                <div class="ud-stat-val">${{ number_format($dueThisWeek) }}</div>
                <div class="ud-stat-sub sub-blue">{{ $pendingSites }} pending sites</div>
            </div>
        </div>

        <div class="ud-stat-card sc-red">
            <span class="material-icons-outlined ud-stat-icon">report_problem</span>
            <div class="ud-stat-label">Overdue Amount</div>
            <div class="ud-stat-val-row">
                <div class="ud-stat-val val-red">${{ number_format($overdueAmount) }}</div>
                <div class="ud-stat-sub sub-alert">{{ $criticalAlerts }} critical alerts</div>
            </div>
        </div>
    </div>

    {{-- Main Billing Schedule Table --}}
    <div id="search-results-region">
    @if($search ?? false)
        <div style="margin-bottom: var(--space-4); font-size: 0.8125rem; font-weight: 800; color: #a0aec0; letter-spacing: 0.05em; text-transform: uppercase;">
            Searching for: <strong>"{{ $search }}"</strong> — 
            <a href="{{ route('admin.dues') }}" style="color: #b02f00; text-decoration: none;">Reset</a>
        </div>
    @endif
    <div class="ud-table-card">
        <div class="ud-tc-header">
            <div class="ud-tc-title">Client Billing Schedule</div>
            <div class="ud-tc-actions">
                <a href="{{ route('admin.dues', array_merge(request()->query(), ['export' => 'csv'])) }}" class="ud-action-btn btn-export">Export CSV</a>
                <a href="{{ route('admin.dues', array_merge(request()->query(), ['bulk' => 'reminders'])) }}" class="ud-action-btn btn-bulk">Bulk Reminders</a>
            </div>
        </div>

        <table class="ud-table" data-yajra="1">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Plan Tier</th>
                    <th>Status</th>
                    <th>Auto-Renewal</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dues as $due)
                @php
                    $hash = crc32($due->client->email);
                    
                    // Unified tier mapping from dynamic plan database
                    $tTier = strtoupper($due->plan->name ?? 'UNKNOWN');
                    $tClass = match(true) {
                        str_contains($tTier, 'ENTERPRISE') => 'pl-enterprise',
                        str_contains($tTier, 'SCALEUP') => 'pl-scaleup',
                        default => 'pl-startup',
                    };
                    
                    $days = $due->days_until_expiry ?? 0;
                    if ($days <= 0) {
                        $sLab = 'Overdue'; $sClass = 's-overdue';
                    } elseif ($days <= 10) {
                        $sLab = 'Pending'; $sClass = 's-pending';
                    } else {
                        $sLab = 'Processing'; $sClass = 's-processing';
                    }
                    
                    $isAuto = $due->auto_renew ?? false;
                    $domain = parse_url($due->client->website_url ?? 'https://generic.com', PHP_URL_HOST) ?? 'website.com';
                @endphp
                <tr>
                    <td>
                        <div class="ud-client-cell">
                            <div class="ud-c-avatar" style="background: {{ ['#101c38', '#113328', '#b59247'][$hash % 3] }}">
                                <div class="ud-c-core">{{ strtoupper(substr($due->client->company_name ?? $due->client->first_name, 0, 1)) }}</div>
                            </div>
                            <div>
                                <div class="ud-c-name">{{ $due->client->company_name ?? $due->client->full_name }}</div>
                                <div class="ud-c-domain">{{ $domain }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="ud-plan-badge {{ $tClass }}">{{ $tTier }}</span></td>
                    <td><span class="ud-status {{ $sClass }}">{{ $sLab }}</span></td>
                    <td>
                        <span class="ud-ar-badge {{ $isAuto ? 'ar-on' : 'ar-off' }}">{{ $isAuto ? 'ON' : 'OFF' }}</span>
                    </td>
                    <td>
                        <div class="ud-date">{{ $due->end_date->format('M d,') }}<br>{{ $due->end_date->format('Y') }}</div>
                    </td>
                    <td>
                        @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'manager']))
                            <div class="ud-actions-menu-wrap">
                                <button type="button" class="ud-action-dot ud-action-trigger" aria-label="More actions" aria-expanded="false">
                                    <span class="material-icons-outlined">more_horiz</span>
                                </button>
                                <div class="ud-row-menu">
                                    <form action="{{ route('admin.dues.send-reminder', $due->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="ud-row-menu-item">Send Reminder Email</button>
                                    </form>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.subscriptions.edit', $due->id) }}" class="ud-row-menu-item">Edit Subscription</a>
                                    @endif
                                </div>
                            </div>
                        @else
                            <span style="color:#cbd5e1;">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #a0aec0; padding: 4rem 0;">
                        @if($search ?? false)
                            No billing records match <strong>"{{ $search }}"</strong>.
                        @else
                            No billing records found.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="ud-footer-area yajra-table-footer"></div>
    </div>
    </div>


    {{-- Bottom Help Block --}}
    <div class="ud-help-card">
        <div class="ud-help-left">
            <div class="ud-av-group">
                <div class="ud-av"><img src="https://ui-avatars.com/api/?name=Alex&background=4338ca&color=fff" alt="A"></div>
                <div class="ud-av"><img src="https://ui-avatars.com/api/?name=Sarah&background=10b981&color=fff" alt="S"></div>
                <div class="ud-av" style="background:#f4f6fa;">+4</div>
            </div>
            <div>
                <div class="ud-h-title">Need help with collections?</div>
                <div class="ud-h-sub">Your concierge account managers are available.</div>
            </div>
        </div>
        <div>
            <a href="{{ route('contact') }}" class="ud-h-btn" style="display:inline-flex; align-items:center; text-decoration:none;">Contact Billing Specialist</a>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
(function () {
    function closeUpcomingDueMenus(exceptMenu) {
        document.querySelectorAll('.ud-row-menu.open').forEach(function (menu) {
            if (menu !== exceptMenu) {
                menu.classList.remove('open');
                const trigger = menu.closest('.ud-actions-menu-wrap')?.querySelector('.ud-action-trigger');
                if (trigger) {
                    trigger.setAttribute('aria-expanded', 'false');
                }
            }
        });
    }

    document.addEventListener('click', function (event) {
        const trigger = event.target.closest('.ud-action-trigger');
        if (trigger) {
            event.preventDefault();
            event.stopPropagation();

            const wrap = trigger.closest('.ud-actions-menu-wrap');
            if (!wrap) return;

            const menu = wrap.querySelector('.ud-row-menu');
            if (!menu) return;

            const shouldOpen = !menu.classList.contains('open');
            closeUpcomingDueMenus(menu);
            menu.classList.toggle('open', shouldOpen);
            trigger.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
            return;
        }

        if (!event.target.closest('.ud-actions-menu-wrap')) {
            closeUpcomingDueMenus();
        }
    });
})();
</script>
@endpush
