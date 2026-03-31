<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Premium WordPress maintenance and concierge service. Enterprise-grade security, backups, and performance optimization for your WordPress sites.')">
    <title>@yield('title', 'WP Maintenance') — Premium WordPress Concierge</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36'><rect width='36' height='36' rx='8' fill='%23FF5722'/><text x='50%25' y='54%25' dominant-baseline='middle' text-anchor='middle' fill='white' font-family='Inter,sans-serif' font-weight='800' font-size='18'>W</text></svg>">
    @stack('styles')
</head>
    <style>
        :root {
            --fp-primary: #ea580c;
            --fp-primary-hover: #c2410c;
            --fp-dark: #0f172a;
            --fp-bg: #f8fafc;
        }
        body { font-family: 'Inter', sans-serif; background: #ffffff; color: #334155; margin: 0; }
        .fp-container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        
        /* Navbar */
        .fp-nav {
            padding: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
        }
        .fp-brand {
            display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 1.25rem; color: var(--fp-dark); text-decoration: none;
        }
        .fp-brand-icon {
            width: 32px; height: 32px; background: var(--fp-dark); color: white; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        
        .fp-nav-links { display: flex; gap: 2.5rem; list-style: none; margin: 0; padding: 0; }
        .fp-nav-links a { text-decoration: none; font-size: 0.9375rem; font-weight: 600; color: #64748b; transition: color 0.2s; }
        .fp-nav-links a:hover { color: var(--fp-dark); }
        .fp-nav-links a.active { color: var(--fp-primary); }
        
        .fp-nav-right { display: flex; align-items: center; gap: 1.5rem; }
        .fp-login-link { text-decoration: none; font-size: 0.9375rem; font-weight: 600; color: #64748b; }
        .fp-login-link:hover { color: var(--fp-dark); }
        .fp-btn-trial {
            background: var(--fp-primary); color: white; text-decoration: none;
            padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 700; font-size: 0.9375rem;
            transition: background 0.2s;
        }
        .fp-btn-trial:hover { background: var(--fp-primary-hover); }

        /* Footer */
        .fp-footer {
            background: #0f172a; color: #94a3b8; padding: 4rem 0 2rem;
            margin-top: 4rem;
        }
        .fp-footer-grid {
            display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 4rem; margin-bottom: 3rem;
        }
        .fp-footer-brand {
            display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 1.25rem; color: white; margin-bottom: 1rem;
        }
        .fp-footer-desc { font-size: 0.875rem; line-height: 1.6; max-width: 300px; }
        
        .fp-footer-heading { color: white; font-weight: 700; font-size: 1rem; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .fp-footer-links { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem; }
        .fp-footer-links a { color: #94a3b8; text-decoration: none; font-size: 0.875rem; transition: color 0.2s; }
        .fp-footer-links a:hover { color: white; }
        
        .fp-footer-bottom {
            border-top: 1px solid #1e293b; padding-top: 2rem;
            display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="fp-nav">
        <div class="fp-container" style="display:flex; align-items:center; justify-content:space-between; width:100%; position:relative;">
            <a href="{{ route('home') }}" class="fp-brand">
                <div class="fp-brand-icon"><span class="material-icons-outlined" style="font-size:18px;">shield</span></div>
                WP Maintenance
            </a>
            
            <ul class="fp-nav-links" id="fpNavLinks">
                <li><a href="{{ route('home') }}" class="active">About</a></li>
                <li><a href="{{ route('plans') }}">Pricing</a></li>
                <li><a href="{{ route('faq') }}">FAQ</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            
            <div class="fp-nav-right">
                <a href="{{ route('admin.login') }}" class="fp-login-link">Login</a>
                <a href="{{ route('plans') }}" class="fp-btn-trial">Get Started</a>
                <button class="fp-mobile-toggle" id="fpMenuToggle" style="display:none; background:none; border:none; cursor:pointer; padding:4px;" aria-label="Toggle menu">
                    <span class="material-icons-outlined" style="font-size:1.75rem; color:#0f172a;">menu</span>
                </button>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="fp-footer">
        <div class="fp-container">
            <div class="fp-footer-grid">
                <div>
                    <div class="fp-footer-brand">
                        <div class="fp-brand-icon" style="background:white; color:#0f172a;"><span class="material-icons-outlined" style="font-size:18px;">shield</span></div>
                        WP Maintenance
                    </div>
                    <p class="fp-footer-desc">A secure scalable web hosting and plugin service. Priority care and the digital custodian.</p>
                </div>
                <div>
                    <div class="fp-footer-heading">FAQ</div>
                    <ul class="fp-footer-links">
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                        <li><a href="{{ route('refund') }}">Refund Default Account</a></li>
                    </ul>
                </div>
                <div>
                    <div class="fp-footer-heading">Support</div>
                    <ul class="fp-footer-links">
                        <li><a href="{{ route('contact') }}">Get in touch</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                        <li><a href="mailto:contact@wpmaintenance.com">contact@wpmaintenance.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="fp-footer-bottom">
                <div><div class="fp-footer-brand" style="margin:0; font-size:1rem;"><div class="fp-brand-icon" style="background:white; color:#0f172a; width:20px; height:20px;"><span class="material-icons-outlined" style="font-size:12px;">shield</span></div> WP Maintenance</div></div>
                <div>&copy; 2026 A product by ReUnited Technologies</div>
            </div>
        </div>
    </footer>

    <script>
        // ── Frontend mobile nav toggle ──
        const fpToggle = document.getElementById('fpMenuToggle');
        const fpNav = document.getElementById('fpNavLinks');
        if (fpToggle && fpNav) {
            fpToggle.addEventListener('click', () => {
                fpNav.classList.toggle('fp-nav-open');
            });
        }
        // Show/hide hamburger button based on screen size
        function updateFpToggle() {
            if (fpToggle) {
                fpToggle.style.display = window.innerWidth <= 768 ? 'flex' : 'none';
            }
        }
        updateFpToggle();
        window.addEventListener('resize', updateFpToggle);

        // Close nav when a link is clicked
        if (fpNav) {
            fpNav.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => fpNav.classList.remove('fp-nav-open'));
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
