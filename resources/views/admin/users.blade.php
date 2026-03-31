@extends('layouts.admin')
@section('title', 'Users Management')

@push('styles')
<style>
/* Global Container */
.um-wrapper {
    background: #f8f9ff;
    padding-bottom: var(--space-10);
}

/* Header Config */
.um-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: var(--space-8);
}
.um-supertext {
    font-size: 0.75rem;
    font-weight: 800;
    color: #cb4a26;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: var(--space-2);
}
.um-title {
    font-size: 2.25rem;
    font-weight: 800;
    color: #1a233a;
    line-height: 1.1;
}
.um-add-btn {
    background: #b02f00;
    color: white;
    padding: 0.875rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 0.9375rem;
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    box-shadow: 0 4px 12px rgba(176, 47, 0, 0.15);
    text-decoration: none;
    transition: background 0.2s;
}
.um-add-btn:hover { background: #8a2400; color: white; }

/* Team Overview Card */
.um-overview-card {
    background: #ffffff;
    border-radius: 20px;
    padding: var(--space-8);
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    margin-bottom: var(--space-10);
}
.um-ov-title {
    font-size: 1.125rem;
    font-weight: 800;
    color: #1a233a;
    margin-bottom: var(--space-3);
}
.um-ov-desc {
    font-size: 0.9375rem;
    color: #718096;
    max-width: 600px;
    line-height: 1.5;
    margin-bottom: 2rem;
}

/* Stats Row */
.um-stats-row {
    display: flex;
    align-items: center;
    gap: 3rem;
}
.um-stat-block {
    display: flex;
    flex-direction: column;
}
.um-stat-num {
    font-size: 2rem;
    font-weight: 800;
    color: #1a233a;
    line-height: 1;
    margin-bottom: var(--space-2);
}
.um-stat-label {
    font-size: 0.75rem;
    font-weight: 700;
    color: #a0aec0;
    text-transform: capitalize;
}
.um-stat-div {
    width: 1px;
    height: 40px;
    background: #edf2f7;
}

/* Active Team Members Card */
.um-team-card {
    background: #ffffff;
    border-radius: 20px;
    padding: var(--space-6) var(--space-8);
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
}
.um-team-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-6);
}
.um-team-title {
    font-size: 1.125rem;
    font-weight: 800;
    color: #1a233a;
}
.um-team-actions {
    color: #a0aec0;
    display: flex;
    gap: var(--space-4);
    position: relative;
}
.um-action-icon-btn {
    background: transparent;
    border: none;
    color: inherit;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}
.um-action-icon-btn:hover { color: #4a5568; }
.um-team-menu {
    position: absolute;
    top: 1.8rem;
    right: 0;
    min-width: 170px;
    background: #fff;
    border: 1px solid #edf2f7;
    border-radius: 10px;
    box-shadow: 0 10px 28px rgba(0,0,0,0.08);
    display: none;
    z-index: 20;
    padding: 0.3rem 0;
}
.um-team-menu.open { display: block; }
.um-team-menu a {
    display: block;
    padding: 0.5rem 0.8rem;
    text-decoration: none;
    color: #4a5568;
    font-size: 0.8125rem;
    font-weight: 700;
}
.um-team-menu a:hover {
    background: #f8fafc;
    color: #1a202c;
}

/* Users Table */
.um-table {
    width: 100%;
    border-collapse: collapse;
}
.um-table th {
    text-align: left;
    font-size: 0.75rem;
    font-weight: 800;
    color: #a0aec0;
    letter-spacing: 0.05em;
    padding-bottom: var(--space-4);
    border-bottom: 1px solid #edf2f7;
    text-transform: uppercase;
}
.um-table td {
    padding: 1.25rem 0;
    border-bottom: 1px solid #f8f9fa;
    vertical-align: middle;
}
.um-table tr:last-child td { border-bottom: none; }

/* Table Columns */
.td-user { display: flex; align-items: center; gap: var(--space-4); }
.um-avatar {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: #eef2ff;
    color: #c53030;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 1rem;
}
.um-name { font-weight: 800; font-size: 0.9375rem; color: #1a202c; }
.um-email { font-size: 0.8125rem; color: #a0aec0; margin-top: 2px; }

/* Role Badges */
.um-role-badge {
    padding: 4px 12px;
    border-radius: var(--radius-full);
    font-size: 0.6875rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    display: inline-block;
}
.rb-admin { background: #fee2e2; color: #b91c1c; }
.rb-manager { background: #e0e7ff; color: #4338ca; }
.rb-support { background: #fef3c7; color: #b45309; }

/* Status */
.um-status {
    font-size: 0.875rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
}
.um-status::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
.st-active { color: #10b981; }
.st-active::before { background: #10b981; }
.st-inactive { color: #9ca3af; }
.st-inactive::before { background: #9ca3af; }

/* Login IP */
.um-login-time { font-size: 0.875rem; font-weight: 600; color: #4a5568; }
.um-login-ip { font-size: 0.6875rem; font-family: monospace; color: #a0aec0; margin-top: 2px; }

/* Action */
.um-action-btn { color: #503d38; text-decoration: none; display: inline-flex; transition: color 0.2s; }
.um-action-btn:hover { color: #2d3748; }

/* Pagination Area */
.um-footer-area {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--space-4);
    padding-top: var(--space-4);
    border-top: 1px solid #edf2f7;
}
.um-showing { font-size: 0.75rem; font-weight: 800; color: #718096; letter-spacing: 0.05em; text-transform: uppercase; }
.um-page-controls { display: flex; gap: var(--space-4); font-size: 0.875rem; font-weight: 800; }
.um-page-link { color: #1a202c; text-decoration: none; cursor: pointer; }
.um-page-disabled { color: #cbd5e0; cursor: default; }

</style>
@endpush

@section('content')
<div class="um-wrapper">

    {{-- Main Header --}}
    <div class="um-header">
        <div>
            <div class="um-supertext">Internal Access</div>
            <h1 class="um-title">Users Management</h1>
        </div>
        <div>
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.users.create') }}" class="um-add-btn">
                    <span class="material-icons-outlined" style="font-size: 1.125rem;">person_add</span> Add New User
                </a>
            @endif
        </div>
    </div>

    {{-- Overview Stats Card --}}
    <div class="um-overview-card">
        <div class="um-ov-title">Team Overview</div>
        <div class="um-ov-desc">
            You have {{ $totalUsers }} active team members providing 24/7 concierge maintenance across all client instances.
        </div>
        
        <div class="um-stats-row">
            <div class="um-stat-block">
                <div class="um-stat-num">{{ $totalUsers }}</div>
                <div class="um-stat-label">Total Users</div>
            </div>
            <div class="um-stat-div"></div>
            <div class="um-stat-block">
                <div class="um-stat-num">{{ $admins }}</div>
                <div class="um-stat-label">Admins</div>
            </div>
            <div class="um-stat-div"></div>
            <div class="um-stat-block">
                <div class="um-stat-num">{{ $managers }}</div>
                <div class="um-stat-label">Managers</div>
            </div>
            <div class="um-stat-div"></div>
            <div class="um-stat-block">
                <div class="um-stat-num">{{ $support }}</div>
                <div class="um-stat-label">Support</div>
            </div>
        </div>
    </div>

    {{-- Main Team Table Card --}}
    <div id="search-results-region">
    @if($search ?? false)
        <div style="margin-bottom: var(--space-4); font-size: 0.875rem; font-weight: 800; color: #718096; letter-spacing: 0.05em; text-transform: uppercase;">
            Filtered by: <strong>"{{ $search }}"</strong> — 
            <a href="{{ route('admin.users') }}" style="color: #b02f00;">Reset</a>
        </div>
    @endif
    <div class="um-team-card">
        <div class="um-team-header">
            <div class="um-team-title">Active Team Members</div>
            <div class="um-team-actions">
                <button type="button" class="um-action-icon-btn" id="um-focus-search" title="Focus search" aria-label="Focus search">
                    <span class="material-icons-outlined" style="font-size:1.25rem;">filter_list</span>
                </button>
                <button type="button" class="um-action-icon-btn" id="um-menu-toggle" title="More actions" aria-label="More actions">
                    <span class="material-icons-outlined" style="font-size:1.25rem;">more_vert</span>
                </button>
                <div class="um-team-menu" id="um-team-menu">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('admin.users.create') }}">Add New User</a>
                    @endif
                    <a href="{{ route('admin.users') }}">Reset Filters</a>
                </div>
            </div>
        </div>

        <table class="um-table" data-yajra="1">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                @php
                    $initials = strtoupper(substr($user->name, 0, 1) . (strpos($user->name, ' ') ? substr($user->name, strpos($user->name, ' ') + 1, 1) : ''));
                    $hash = crc32($user->email);
                    $roleLabel = strtolower((string) $user->role);
                    $isActive = ($hash % 5) != 0;

                    $roleMap = [
                        'admin' => ['class' => 'rb-admin', 'text' => 'ADMIN'],
                        'manager' => ['class' => 'rb-manager', 'text' => 'MANAGER'],
                        'support' => ['class' => 'rb-support', 'text' => 'SUPPORT'],
                    ];
                    $roleClass = $roleMap[$roleLabel]['class'] ?? 'rb-support';
                    $roleText = $roleMap[$roleLabel]['text'] ?? strtoupper($roleLabel ?: 'SUPPORT');
                    $statusClass = $isActive ? 'st-active' : 'st-inactive';
                    $statusText = $isActive ? 'Active' : 'Inactive';
                    
                    $lastLogin = $isActive ? Carbon\Carbon::now()->subMinutes($hash % 3000)->diffForHumans() : 'May 12, 2024';
                    $ipBlock1 = 192;
                    $ipBlock2 = ($hash % 200);
                    $ipAddr = "{$ipBlock1}.168.{$ipBlock2}." . ($hash % 255);
                @endphp
                <tr>
                    <td>
                        <div class="td-user">
                            <div class="um-avatar" style="color: {{ ['#c53030', '#c05621', '#9c4221'][$hash % 3] }}">{{ $initials }}</div>
                            <div>
                                <div class="um-name">{{ $user->name }}</div>
                                <div class="um-email">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="um-role-badge {{ $roleClass }}">{{ $roleText }}</span>
                    </td>
                    <td>
                        <span class="um-status {{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    <td>
                        <div class="um-login-time">{{ $lastLogin }}</div>
                        <div class="um-login-ip">{{ $ipAddr }}</div>
                    </td>
                    <td>
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="um-action-btn" title="Edit user">
                                <span class="material-icons-outlined" style="font-size:1.125rem;">edit</span>
                            </a>
                        @else
                            <span style="color:#cbd5e1;">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 4rem 0; color: #a0aec0;">
                         @if($search ?? false)
                            No users found matching <strong>"{{ $search }}"</strong>
                        @else
                            No team members found.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="um-footer-area yajra-table-footer"></div>
    </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
(function () {
    const focusBtn = document.getElementById('um-focus-search');
    const globalSearch = document.getElementById('global-search-input');
    const menuToggle = document.getElementById('um-menu-toggle');
    const menu = document.getElementById('um-team-menu');

    if (focusBtn && globalSearch) {
        focusBtn.addEventListener('click', function () {
            globalSearch.focus();
            const len = globalSearch.value.length;
            globalSearch.setSelectionRange(len, len);
        });
    }

    if (menuToggle && menu) {
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!menu.contains(e.target) && e.target !== menuToggle) {
                menu.classList.remove('open');
            }
        });
    }
})();
</script>
@endpush
