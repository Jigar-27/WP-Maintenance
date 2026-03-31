<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Client Dashboard') — Agency Console</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36'><rect width='36' height='36' rx='8' fill='%23FF5722'/><text x='50%25' y='54%25' dominant-baseline='middle' text-anchor='middle' fill='white' font-family='Inter,sans-serif' font-weight='800' font-size='18'>W</text></svg>">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #334155;
            margin: 0;
        }
        .client-shell {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        .client-top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            background: #ffffff;
            border-bottom: 1px solid #e7eaf1;
            padding: 1.25rem 1.5rem;
            margin: 0 calc(-1 * 1.5rem);
        }
        .client-search-form {
            flex: 1;
            max-width: 700px;
        }
        .client-nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .client-icon-btn {
            color: #5b4039;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .client-icon-btn:hover { color: #b02f00; }
        .client-top-divider {
            width: 2px;
            height: 40px;
            background: rgba(0, 0, 0, 0.08);
        }
        .client-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .client-user-info {
            text-align: right;
        }
        .client-user-name {
            font-weight: 800;
            font-size: 0.9rem;
            color: #0f172a;
            line-height: 1.2;
        }
        .client-user-role {
            font-size: 0.7rem;
            font-weight: 800;
            color: #5b4039;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        .client-user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            overflow: hidden;
            background: #2e8b57;
        }
        .client-user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .client-tabs {
            background: #ffffff;
            border-bottom: 1px solid #e7eaf1;
            display: flex;
            gap: 1.5rem;
            padding: 0.85rem 1.5rem;
            margin: 0 calc(-1 * 1.5rem);
        }
        .client-tab-link {
            text-decoration: none;
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 0.15rem;
        }
        .client-tab-link.active {
            color: #b02f00;
        }
        .client-tab-link.active::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -0.85rem;
            height: 2px;
            background: #b02f00;
        }

        .client-main {
            margin: 2rem auto 0;
            max-width: 1100px;
            padding: 0 1rem;
        }
        .client-logout {
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            padding: 0;
        }
        .client-logout:hover { color: #b02f00; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="client-shell">
        <div class="client-top-nav">
            <form method="GET" action="{{ request()->url() }}" class="client-search-form">
                <div class="admin-search-box" style="width:100%; max-width:none;">
                    <span class="material-icons-outlined">search</span>
                    <input
                        type="text"
                        name="search"
                        placeholder="Search..."
                        value="{{ request()->query('search', '') }}"
                        autocomplete="off"
                    >
                </div>
            </form>

            <div class="client-nav-actions">
                @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'developer'], true))
                <span class="material-icons-outlined client-icon-btn">notifications</span>
                @endif
                <div class="client-top-divider"></div>
                <div class="client-user">
                    <div class="client-user-info">
                        <div class="client-user-name">{{ auth()->user()->name ?? 'Agency Admin' }}</div>
                        <div class="client-user-role">Account Manager</div>
                    </div>
                    <div class="client-user-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=2e8b57&color=fff" alt="Avatar">
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="client-logout" title="Logout">
                        <span class="material-icons-outlined">logout</span>
                    </button>
                </form>
            </div>
        </div>

        <nav class="client-tabs">
            <a href="{{ route('client.dashboard') }}" class="client-tab-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('client.reports') }}" class="client-tab-link {{ request()->routeIs('client.reports') ? 'active' : '' }}">Reports</a>
            <a href="{{ route('client.settings') }}" class="client-tab-link {{ request()->routeIs('client.settings') ? 'active' : '' }}">Settings</a>
            <a href="{{ route('client.support') }}" class="client-tab-link {{ request()->routeIs('client.support') ? 'active' : '' }}">Support</a>
        </nav>

        <main class="client-main">
            @yield('content')
        </main>

        <footer class="universal-console-footer">
            <div>&copy; 2026 Reunited Tech. All Rights Reserved.</div>
            <div class="universal-console-footer-nav">
                <a href="{{ route('terms') }}">Terms of Service</a>
                <a href="{{ route('privacy') }}">Privacy Policy</a>
                <a href="{{ route('contact') }}">Contact Support</a>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
