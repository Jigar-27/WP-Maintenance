<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Agency Console</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-shared.css') }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36'><rect width='36' height='36' rx='8' fill='%23FF5722'/><text x='50%25' y='54%25' dominant-baseline='middle' text-anchor='middle' fill='white' font-family='Inter,sans-serif' font-weight='800' font-size='18'>W</text></svg>">
    @stack('stylesheets')
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
                @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'manager']))
                <li>
                    <a href="{{ route('admin.invoices') }}" class="sidebar-link {{ request()->routeIs('admin.invoices*') ? 'active' : '' }}">
                        <span class="material-icons-outlined">library_books</span>
                        All Invoices
                    </a>
                </li>
                @endif
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
                
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.create') }}" class="btn-sidebar-add">
                        <span class="material-icons-outlined" style="font-size: 1.125rem;">add</span>
                        Add New User
                    </a>
                @endif
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
                    @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'manager']))
                        <span class="material-icons-outlined admin-icon-btn">notifications</span>
                    @endif
                    <div class="admin-top-divider"></div>
                    <div class="admin-user">
                        <div class="admin-user-info">
                            <div class="admin-user-name">{{ auth()->user()->name ?? 'Agency Admin' }}</div>
                            <div class="admin-user-role">{{ strtoupper((string) (auth()->user()->role ?? 'admin')) }}</div>
                        </div>
                        <!-- Avatar -->
                        <a href="{{ route('admin.profile.edit') }}" class="admin-user-avatar" title="Edit Profile">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Agency Admin') }}&background=2e8b57&color=fff" alt="Avatar">
                        </a>
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
