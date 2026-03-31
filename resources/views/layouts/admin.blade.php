<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Agency Console</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36'><rect width='36' height='36' rx='8' fill='%23FF5722'/><text x='50%25' y='54%25' dominant-baseline='middle' text-anchor='middle' fill='white' font-family='Inter,sans-serif' font-weight='800' font-size='18'>W</text></svg>">
    <style>
        .yajra-dt-bottom .dataTables_length,
        .yajra-dt-bottom .dataTables_paginate {
            float: none !important;
            margin: 0 !important;
        }
        .yajra-dt-bottom .dataTables_length {
            display: flex;
            align-items: center;
            min-height: 34px;
            margin-left: 1.5rem !important;
        }
        .yajra-dt-bottom .dataTables_length label {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #334155;
            margin: 0 !important;
            line-height: 34px;
            white-space: nowrap;
        }
        .yajra-dt-bottom .dataTables_length select {
            border: 1px solid transparent !important;
            border-radius: 999px !important;
            background: #f1f3f9 !important;
            color: #334155 !important;
            padding: 0.34rem 1.9rem 0.34rem 0.7rem !important;
            margin: 0 !important;
            font-size: 0.8125rem !important;
            font-weight: 700 !important;
            min-height: 34px;
            min-width: 72px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            background-size: 18px 18px;
            cursor: pointer;
            vertical-align: middle;
            line-height: 1;
        }
        .yajra-dt-bottom .dataTables_paginate {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        .yajra-dt-bottom .dataTables_paginate .paginate_button {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            border: 1px solid #dbe3f0 !important;
            border-radius: 999px !important;
            padding: 0 0.6rem !important;
            margin: 0 !important;
            color: #334155 !important;
            background: #f1f3f9 !important;
            font-size: 0.75rem;
            font-weight: 700;
            text-decoration: none !important;
            line-height: 1 !important;
        }
        .yajra-dt-bottom .dataTables_paginate .paginate_button.previous,
        .yajra-dt-bottom .dataTables_paginate .paginate_button.next {
            min-width: 72px;
            color: #b02f00 !important;
            border-color: #f3d3c9 !important;
            background: #fff7f3 !important;
        }
        .yajra-dt-bottom .dataTables_paginate .paginate_button:hover {
            border-color: #c6d2e4 !important;
            background: #e9eef8 !important;
            color: #1f2937 !important;
        }
        .yajra-dt-bottom .dataTables_paginate .paginate_button.current,
        .yajra-dt-bottom .dataTables_paginate .paginate_button.current:hover {
            background: #b02f00 !important;
            border-color: #b02f00 !important;
            color: #fff !important;
        }
        .yajra-dt-bottom .dataTables_paginate .paginate_button.disabled,
        .yajra-dt-bottom .dataTables_paginate .paginate_button.disabled:hover {
            opacity: 0.45;
            cursor: default !important;
            pointer-events: none;
            border-color: #e2e8f0 !important;
            color: #94a3b8 !important;
            background: #f8fafc !important;
        }
        .yajra-table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        .yajra-dt-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            gap: 0.75rem;
            padding-top: 0.5rem;
            min-height: 34px;
        }
        @media (max-width: 768px) {
            .yajra-dt-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-layout">
        {{-- ─── Sidebar ──────────────────────────────── --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-name">Agency Console</div>
                <div class="sidebar-brand-sub">Premium Custodian</div>
            </div>

            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="material-icons-outlined">analytics</span>
                        Analytics
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.subscriptions') }}" class="sidebar-link {{ request()->routeIs('admin.subscriptions*') ? 'active' : '' }}">
                        <span class="material-icons-outlined">payments</span>
                        Subscriptions
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.invoices') }}" class="sidebar-link {{ request()->routeIs('admin.invoices*') ? 'active' : '' }}">
                        <span class="material-icons-outlined">library_books</span>
                        All Invoices
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <span class="material-icons-outlined">people</span>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.clients') }}" class="sidebar-link {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
                        <span class="material-icons-outlined">account_circle</span>
                        Clients
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dues') }}" class="sidebar-link {{ request()->routeIs('admin.dues') ? 'active' : '' }}">
                        <span class="material-icons-outlined">calendar_today</span>
                        Upcoming Dues
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <span class="material-icons-outlined">settings</span>
                        Settings
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="sidebar-user-card">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=fce6da&color=b02f00" class="sidebar-user-img" alt="Avatar">
                    <div class="sidebar-user-meta">
                        <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Agency Admin' }}</div>
                        <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-link">Sign Out</button>
                        </form>
                    </div>
                </div>
                
                <a href="{{ route('admin.users.create') }}" class="btn-sidebar-add">
                    <span class="material-icons-outlined" style="font-size: 1.125rem;">add</span>
                    Add New User
                </a>
            </div>
        </aside>

        <!-- Overlay for mobile sidebar close -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

        {{-- ─── Main Content ─────────────────────────────────────────── --}}
        <main class="admin-main">
            {{-- Global Top Navigation Bar --}}
            <div class="admin-top-nav">
                <form method="GET" action="{{ request()->url() }}" id="global-search-form" style="flex:1; max-width:380px;">
                    <div class="admin-search-box">
                        <span class="material-icons-outlined">search</span>
                        <input
                            type="text"
                            name="search"
                            id="global-search-input"
                            placeholder="Search..."
                            value="{{ request()->query('search', '') }}"
                            autocomplete="off"
                        >
                        @if(request()->query('search'))
                        <a href="{{ request()->url() }}" style="display:flex;align-items:center;color:#a0aec0;flex-shrink:0;" title="Clear">
                            <span class="material-icons-outlined" style="font-size:1rem;">close</span>
                        </a>
                        @endif
                    </div>
                </form>
                <div class="admin-top-actions">
                    @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'developer'], true))
                    <span class="material-icons-outlined admin-icon-btn">notifications</span>
                    @endif
                    <div class="admin-top-divider"></div>
                    <div class="admin-user">
                        <div class="admin-user-info">
                            <div class="admin-user-name">{{ auth()->user()->name ?? 'Agency Admin' }}</div>
                            <div class="admin-user-role">Account Manager</div>
                        </div>
                        <!-- Avatar -->
                        <div class="admin-user-avatar">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Agency Admin') }}&background=2e8b57&color=fff" alt="Avatar">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Mobile sidebar toggle --}}
            <button class="mobile-toggle" id="sidebarToggle" onclick="toggleSidebar()" style="margin-bottom: var(--space-4);" aria-label="Open menu">
                <span class="material-icons-outlined">menu</span>
            </button>

            @if(session('success'))
                <div class="alert alert-success">
                    <span class="material-icons-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <span class="material-icons-outlined">error</span>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

            <footer class="universal-console-footer">
                <div>&copy; 2026 Reunited Tech. All Rights Reserved.</div>
                <div class="universal-console-footer-nav">
                    <a href="{{ route('terms') }}">Terms of Service</a>
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <a href="{{ route('contact') }}">Contact Support</a>
                </div>
            </footer>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        // Show toggle button on small screens
        function updateAdminToggle() {
            const toggle = document.getElementById('sidebarToggle');
            if (toggle) {
                toggle.style.display = window.innerWidth <= 1024 ? 'flex' : 'none';
            }
            if (window.innerWidth > 1024) {
                document.getElementById('sidebar').classList.remove('active');
                const overlay = document.getElementById('sidebarOverlay');
                if (overlay) overlay.classList.remove('active');
            }
        }
        updateAdminToggle();
        window.addEventListener('resize', updateAdminToggle);

        window.initYajraTables = function (root = document) {
            if (!window.jQuery || !jQuery.fn || !jQuery.fn.DataTable) return;
            if (!root || !root.querySelectorAll) return;

            const tables = root.querySelectorAll('table[data-yajra="1"]');
            tables.forEach(function (table) {
                if (jQuery.fn.DataTable.isDataTable(table)) return;

                const instance = jQuery(table).DataTable({
                    pageLength: 10,
                    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
                    ordering: false,
                    searching: false,
                    info: false,
                    autoWidth: false,
                    dom: 't<"yajra-dt-bottom"<"yajra-dt-length"l><"yajra-dt-pagination"p>>',
                    language: {
                        lengthMenu: 'Show _MENU_',
                        paginate: { previous: 'Previous', next: 'Next' },
                    },
                });

                const wrapper = table.closest('.dataTables_wrapper');
                const card = table.closest('.card, .subs-table-card, .ud-table-card, .um-team-card, .cl-table-card');
                const host = card ? card.querySelector('.yajra-table-footer') : null;
                const bottom = wrapper ? wrapper.querySelector('.yajra-dt-bottom') : null;

                if (host && bottom) {
                    host.innerHTML = '';
                    host.appendChild(bottom);
                }

                instance.draw(false);
            });
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () { window.initYajraTables(); });
        } else {
            window.initYajraTables();
        }

        // Global search — AJAX live search (no page reload)
        (function () {
            const input = document.getElementById('global-search-input');
            const form  = document.getElementById('global-search-form');
            if (!input || !form) return;

            let timer;

            function doSearch(query) {
                const url = new URL(form.action);
                if (query) {
                    url.searchParams.set('search', query);
                } else {
                    url.searchParams.delete('search');
                }

                // Update browser URL without reloading
                history.replaceState(null, '', url.toString());

                // Add subtle loading state
                input.style.opacity = '0.7';

                fetch(url.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(res) { return res.text(); })
                .then(function(html) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Replace the main content section
                    const incoming = doc.getElementById('search-results-region');
                    const current  = document.getElementById('search-results-region');
                    if (incoming && current) {
                        current.innerHTML = incoming.innerHTML;
                        if (window.initYajraTables) window.initYajraTables(current);
                    }

                    // Update subtitle if present
                    const incomingSubtitle = doc.querySelector('.admin-subtitle');
                    const currentSubtitle  = document.querySelector('.admin-subtitle');
                    if (incomingSubtitle && currentSubtitle) {
                        currentSubtitle.innerHTML = incomingSubtitle.innerHTML;
                    }

                    input.style.opacity = '1';
                    // Keep focus and cursor position
                    input.focus();
                })
                .catch(function() { input.style.opacity = '1'; });
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);
                const query = input.value.trim();
                timer = setTimeout(function () {
                    doSearch(query);
                }, 350);
            });

            // Enter key: trigger immediately
            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(timer);
                    doSearch(input.value.trim());
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
