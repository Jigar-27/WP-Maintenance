@extends('layouts.frontend')
@section('title', 'WP Maintenance - Secure WP Infrastructure')

@push('styles')
<style>
/* Global Resets */
:root {
    --lp-primary: #ea580c;
    --lp-primary-hover: #c2410c;
    --lp-dark: #0f172a;
    --lp-text: #334155;
    --lp-text-light: #64748b;
    --lp-bg-light: #f8fafc;
    --lp-bg-blue: #f1f5f9;
}
.landing-wrap { color: var(--lp-text); }
.lp-container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }

/* Typography */
h1, h2, h3 { font-weight: 800; color: var(--lp-dark); line-height: 1.1; margin: 0; }
p { line-height: 1.6; margin: 0; }

/* 1. Hero Section */
.hero-sec { padding: 5rem 0; }
.hero-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
.hero-pill {
    background: #e0e7ff; color: #3730a3; padding: 4px 12px; border-radius: 4px;
    font-size: 0.6875rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;
    display: inline-block; margin-bottom: 1.5rem;
}
.hero-title { font-size: 3.5rem; letter-spacing: -0.02em; margin-bottom: 1.5rem; }
.hero-desc { font-size: 1.125rem; color: var(--lp-text-light); margin-bottom: 1rem; max-width: 500px; }
.hero-disclaimer { font-size: 0.8125rem; font-weight: 700; color: #94a3b8; margin-bottom: 2rem; }
.hero-btn-group { display: flex; gap: 1rem; }
.btn-primary { background: var(--lp-primary); color: white; padding: 0.875rem 2rem; border-radius: 6px; font-weight: 700; text-decoration: none; transition: background 0.2s; }
.btn-primary:hover { background: var(--lp-primary-hover); }
.btn-secondary { background: var(--lp-bg-blue); color: var(--lp-text); padding: 0.875rem 2rem; border-radius: 6px; font-weight: 700; text-decoration: none; transition: background 0.2s; }
.btn-secondary:hover { background: #e2e8f0; }

.hero-img-box {
    background: var(--lp-dark); border-radius: 24px; padding: 2rem; position: relative;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15); display: flex; align-items: center; justify-content: center;
    aspect-ratio: 4/3;
}
.hero-img-box img { width: 100%; max-width: 360px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5)); }
.hero-floating-badge {
    position: absolute; bottom: -1rem; left: 2rem; background: white; padding: 0.75rem 1rem;
    border-radius: 8px; display: flex; align-items: center; gap: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.fb-icon { width: 24px; height: 24px; background: #fef08a; color: #ca8a04; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; }
.fb-text-top { font-size: 0.625rem; color: var(--lp-text-light); text-transform: uppercase; font-weight: 700; }
.fb-text-bot { font-size: 0.8125rem; font-weight: 800; color: var(--lp-dark); }

/* 2. Infrastructure Strip */
.logos-sec {
    background: #dfe7f8;
    padding: 2.8rem 0 2.6rem;
    border-top: 1px solid #d5def2;
    border-bottom: 1px solid #d5def2;
    text-align: center;
}
.logos-title {
    font-size: 0.625rem;
    font-weight: 800;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.26em;
    margin-bottom: 1.4rem;
}
.logos-grid {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
}
.logo-item {
    display: flex;
    align-items: center;
    gap: 0.55rem;
    font-size: 1.75rem;
    font-weight: 700;
    color: #6b7280;
}
.logo-item span { font-size: 1.3rem; color: #8a93a5; }
.logo-item strong { font-size: 1.75rem; font-weight: 700; letter-spacing: 0.01em; }

/* 3. Pricing */
.pricing-sec { padding: 6rem 0; text-align: center; }
.pricing-title { font-size: 2.25rem; margin-bottom: 0.75rem; }
.pricing-subtitle { font-size: 1rem; color: var(--lp-text-light); margin-bottom: 4rem; }
.pricing-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; align-items: center; max-width: 1000px; margin: 0 auto; text-align: left; }
.pr-card { background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 2.5rem 2rem; position: relative; }
.pr-card.popular { border: 2px solid var(--lp-primary); transform: scale(1.05); box-shadow: 0 20px 40px rgba(234, 88, 12, 0.08); background: #fffcfb; }
.pr-tag {
    position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
    background: var(--lp-primary); color: white; padding: 4px 12px; border-radius: 20px;
    font-size: 0.6875rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;
}
.pr-name { font-size: 1.125rem; font-weight: 800; color: var(--lp-dark); margin-bottom: 0.25rem; }
.pr-desc { font-size: 0.8125rem; color: var(--lp-text-light); margin-bottom: 1.5rem; display: block; }
.pr-price { font-size: 2.5rem; font-weight: 800; color: var(--lp-dark); margin-bottom: 1.5rem; line-height: 1; }
.pr-price span { font-size: 1rem; color: var(--lp-text-light); font-weight: 600; }
.pr-feat { list-style: none; padding: 0; margin: 0 0 2rem 0; display: flex; flex-direction: column; gap: 0.875rem; }
.pr-feat li { display: flex; align-items: center; gap: 10px; font-size: 0.875rem; color: var(--lp-text); font-weight: 500;}
.pr-feat li span { color: var(--lp-primary); font-size: 1.125rem; }
.btn-outline { border: 2px solid #e2e8f0; color: var(--lp-primary); background: transparent; padding: 0.875rem; width: 100%; display: block; text-align: center; border-radius: 6px; font-weight: 700; text-decoration: none; transition: border-color 0.2s;}
.btn-outline:hover { border-color: var(--lp-primary); }
.btn-pop { background: var(--lp-primary); color: white; padding: 0.875rem; width: 100%; display: block; text-align: center; border-radius: 6px; font-weight: 700; text-decoration: none; border: 2px solid var(--lp-primary); transition: background 0.2s; }
.btn-pop:hover { background: var(--lp-primary-hover); border-color: var(--lp-primary-hover); }
.pr-link { display: block; text-align: center; font-size: 0.75rem; font-weight: 700; color: var(--lp-text-light); margin-top: 1rem; text-decoration: none; }

/* 4. Trust + Stats Band */
.stats-sec { background: #f0f4ff; padding: 4.5rem 0 4.8rem; text-align: center; }
.trusted-tools { margin-bottom: 2.8rem; }
.trusted-title {
    font-size: 0.625rem;
    font-weight: 800;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.24em;
    margin-bottom: 1.1rem;
}
.trusted-grid {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2.5rem;
}
.trusted-item {
    font-size: 1.75rem;
    font-weight: 700;
    color: #9ca3af;
}

.stats-flex {
    background: #dfe7f8;
    border: 1px solid #d3def5;
    border-radius: 1.8rem;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    margin-bottom: 3.2rem;
    overflow: hidden;
}
.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem 1.25rem 1.8rem;
    border-right: 1px solid #cfdaef;
}
.stat-item:last-child { border-right: none; }
.stat-icon { font-size: 1.2rem; margin-bottom: 0.45rem; color: #c2410c; }
.stat-item:nth-child(2) .stat-icon { color: #4d5e86; }
.stat-num { font-size: 2.55rem; font-weight: 800; color: var(--lp-dark); margin-bottom: 0.15rem; line-height: 1; }
.stat-label { font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.14em; }

.stats-card {
    background: #ffffff;
    border-radius: 2rem;
    border: 1px solid #e7ecf7;
    width: min(100%, 640px);
    margin: 0 auto;
    padding: 2.1rem 2.3rem 2.25rem;
    box-shadow: 0 18px 40px rgba(77, 94, 134, 0.07);
    text-align: center;
}
.sc-top {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: #e7f7ee;
    color: #0f172a;
    border: 1px solid #d3efdf;
    border-radius: 999px;
    padding: 0.68rem 1.2rem;
    font-weight: 800;
    font-size: 1.1rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 1.55rem;
}
.sc-top .material-icons-outlined { font-size: 1.05rem; color: #16a34a; }
.sc-bot {
    font-size: 0.625rem;
    font-weight: 800;
    color: #a8a29e;
    text-transform: uppercase;
    letter-spacing: 0.26em;
    margin-bottom: 0.85rem;
    display: block;
}
.sc-partner-logo {
    font-size: 1.7rem;
    font-weight: 700;
    color: #273956;
    letter-spacing: 0.01em;
    margin-bottom: 1.25rem;
}
.sc-divider { height: 1px; background: #eceff6; width: 100%; margin: 0 auto 1.25rem; }
.sc-logos {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.7rem;
    color: #9ca3af;
}
.sc-pay-chip {
    border: 1px solid #eceff6;
    border-radius: 0.45rem;
    padding: 0.28rem 0.52rem;
    font-size: 0.68rem;
    font-weight: 800;
    color: #6b7280;
}
.sc-more {
    font-size: 0.74rem;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: #8b8c90;
}

@media (max-width: 900px) {
    .stats-flex { grid-template-columns: 1fr; }
    .stat-item { border-right: none; border-bottom: 1px solid #cfdaef; }
    .stat-item:last-child { border-bottom: none; }
}

/* 5. FAQ */
.faq-sec { padding: 6rem 0; }
.faq-head { text-align: center; margin-bottom: 4rem; }
.faq-title { font-size: 2.25rem; margin-bottom: 0.75rem; }
.faq-sub { font-size: 1rem; color: var(--lp-text-light); }
.faq-list { max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 1rem; }
.faq-item { border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.5rem; cursor: pointer; transition: border-color 0.2s; }
.faq-item:hover { border-color: #cbd5e0; }
.faq-q { display: flex; justify-content: space-between; align-items: center; font-weight: 800; font-size: 1rem; color: var(--lp-dark); }
.faq-icon { color: var(--lp-primary); transition: transform 0.2s; }
.faq-a { margin-top: 1rem; font-size: 0.9375rem; color: var(--lp-text-light); display: none; line-height: 1.6; }
.faq-item.active .faq-a { display: block; }
.faq-item.active .faq-icon { transform: rotate(180deg); }

/* 6. Testimonials */
.test-sec { background: var(--lp-bg-light); padding: 6rem 0 8rem; text-align: center; }
.test-title { font-size: 2.25rem; margin-bottom: 4rem; }
.test-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; max-width: 1000px; margin: 0 auto; text-align: left; }
.test-card { background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); position: relative; }
.test-quote-icon { position: absolute; top: 2rem; right: 2rem; font-size: 3rem; color: #ffedd5; font-family: serif; font-weight: 800; line-height: 1; }
.test-text { font-size: 1rem; font-weight: 600; color: var(--lp-text); line-height: 1.6; margin-bottom: 2rem; position: relative; z-index: 2; }
.test-author { display: flex; align-items: center; gap: 1rem; }
.test-av { width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; object-fit: cover; }
.test-name { font-weight: 800; font-size: 0.9375rem; color: var(--lp-dark); }
.test-role { font-size: 0.75rem; font-weight: 600; color: var(--lp-text-light); }

</style>
@endpush

@section('content')
<div class="landing-wrap">

    {{-- 1. Hero --}}
    <section class="hero-sec">
        <div class="lp-container">
            <div class="hero-grid">
                <div>
                    <div class="hero-pill">24/7 System Expertise</div>
                    <h1 class="hero-title">AI is Chaotic.<br>Your WordPress<br>Foundation<br>Shouldn't Be.</h1>
                    <p class="hero-desc">A slow website doesn't just block you, it costs you. Protect your ROI with a lightning-fast, highly-secure WordPress instance.</p>
                    <div class="hero-disclaimer">* No hidden fees. Cancel anytime. Expert 24/7 emergency support.</div>
                    <div class="hero-btn-group">
                        <a href="#pricing" class="btn-primary">Explore Plans</a>
                        <a href="{{ route('contact') }}" class="btn-secondary">Contact Us</a>
                    </div>
                </div>
                <!-- Right Side Image Block -->
                <div class="hero-img-box" style="overflow: hidden; padding: 0;">
                    <!-- Premium AI-Generated Dashboard Image -->
                    <img src="{{ asset('images/hero_laptop_dashboard.png') }}" alt="Laptop Dashboard Graph" style="pointer-events:none; width: 100%; max-width: 100%; border-radius: 24px;">
                    
                    <div class="hero-floating-badge">
                        <div class="fb-icon"><span class="material-icons-outlined">check</span></div>
                        <div>
                            <div class="fb-text-top">System Overview Checked</div>
                            <div class="fb-text-bot">100% Secure & Optimized</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. Logos --}}
    <section class="logos-sec">
        <div class="lp-container">
            <div class="logos-title">Powered by Global Infrastructure</div>
            <div class="logos-grid">
                <div class="logo-item"><span class="material-icons-outlined">cloud</span><strong>Google Cloud</strong></div>
                <div class="logo-item"><span class="material-icons-outlined">radio_button_unchecked</span><strong>AWS</strong></div>
                <div class="logo-item"><span class="material-icons-outlined">cloud_queue</span><strong>Cloudflare</strong></div>
                <div class="logo-item"><span class="material-icons-outlined">verified_user</span><strong>PCI DSS</strong></div>
            </div>
        </div>
    </section>

    {{-- 3. Pricing --}}
    <section class="pricing-sec" id="pricing">
        <div class="lp-container">
            <h2 class="pricing-title">Simple, Transparent Investment</h2>
            <p class="pricing-subtitle">Choose the package that scales with your business. No hidden fees, ever.</p>
            
            <div class="pricing-grid">
                @foreach($plans as $plan)
                    <div class="pr-card {{ $plan->is_popular ? 'popular' : '' }}">
                        @if($plan->is_popular)
                            <div class="pr-tag">MOST POPULAR</div>
                        @endif

                        <div class="pr-name">{{ $plan->name }}</div>
                        <span class="pr-desc">{{ $plan->description ?: ('Best for ' . ($plan->best_for ?: 'growing businesses')) }}</span>
                        <div class="pr-price">${{ number_format($plan->price, 0) }}<span>/mo</span></div>

                        <ul class="pr-feat">
                            @forelse(collect($plan->features)->take(5) as $feature)
                                <li><span class="material-icons-outlined">check</span> {{ $feature }}</li>
                            @empty
                                <li><span class="material-icons-outlined">check</span> {{ $plan->dev_hours }} hours dev / maintenance</li>
                                <li><span class="material-icons-outlined">check</span> Ongoing security monitoring</li>
                                <li><span class="material-icons-outlined">check</span> Performance optimization</li>
                            @endforelse
                        </ul>

                        <a href="{{ route('onboard', $plan->slug) }}" class="{{ $plan->is_popular ? 'btn-pop' : 'btn-outline' }}">
                            {{ $plan->is_popular ? 'Choose ' . $plan->name : 'Select Plan' }}
                        </a>
                        <a href="{{ route('onboard', $plan->slug) }}" class="pr-link">View Plan breakdown &gt;</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. Stats --}}
    <section class="stats-sec">
        <div class="lp-container">
            <div class="trusted-tools">
                <div class="trusted-title">Trusted by agencies using</div>
                <div class="trusted-grid">
                    <div class="trusted-item">Elementor</div>
                    <div class="trusted-item">Divi</div>
                    <div class="trusted-item">Beaver Builder</div>
                    <div class="trusted-item">WPBakery</div>
                    <div class="trusted-item">Oxygen</div>
                </div>
            </div>

            <div class="stats-flex">
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">speed</span>
                    <div class="stat-num">99.9%</div>
                    <div class="stat-label">Uptime Maintained</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">verified_user</span>
                    <div class="stat-num">15,000+</div>
                    <div class="stat-label">Threats Blocked</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">bolt</span>
                    <div class="stat-num">&lt;2hr</div>
                    <div class="stat-label">Response Time</div>
                </div>
            </div>
            
            <div class="stats-card">
                <div class="sc-top">
                    <span class="material-icons-outlined">verified</span>
                    Secure Encrypted Checkout
                </div>
                <span class="sc-bot">Trusted Payment Partner</span>
                <div class="sc-partner-logo">Razorpay</div>
                <div class="sc-divider"></div>
                <div class="sc-logos">
                    <span class="sc-pay-chip">VISA</span>
                    <span class="sc-pay-chip">MC</span>
                    <span class="sc-more">&amp; MORE</span>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. FAQ --}}
    <section class="faq-sec">
        <div class="lp-container">
            <div class="faq-head">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-sub">Everything you need to know about our services, billing, and support process.</p>
            </div>
            <div class="faq-list">
                <div class="faq-item active" onclick="this.classList.toggle('active')">
                    <div class="faq-q">
                        What does a maintenance plan actually cover?
                        <span class="material-icons-outlined faq-icon">expand_more</span>
                    </div>
                    <div class="faq-a">
                        Our standard maintenance encompasses daily backups, theme & plugin updates, security monitoring, performance tuning, and access to our emergency hotfix team. All tasks are meticulously tracked and included in your monthly report.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('active')">
                    <div class="faq-q">
                        How fast is your response time?
                        <span class="material-icons-outlined faq-icon">expand_more</span>
                    </div>
                    <div class="faq-a">
                        Our standard SLA is less than 24 hours for normal requests. Agency and Enterprise partners typically see response and resolution times well under 2 hours.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('active')">
                    <div class="faq-q">
                        Can I cancel at any time?
                        <span class="material-icons-outlined faq-icon">expand_more</span>
                    </div>
                    <div class="faq-a">
                        Yes, our plans are month-to-month and can be canceled at any time with no penalties. We export a complete backup of your clean infrastructure for you upon leaving.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. Testimonials --}}
    <section class="test-sec">
        <div class="lp-container">
            <h2 class="test-title">Loved by Agency Owners.</h2>
            <div class="test-grid">
                <div class="test-card">
                    <div class="test-quote-icon">”</div>
                    <p class="test-text">"WP Maintenance is the only team I trust with my client sites. They operate with a level of precision and care that is rare in this industry!"</p>
                    <div class="test-author">
                        <img src="https://ui-avatars.com/api/?name=Justin+Williams&background=1e293b&color=fff" class="test-av" alt="Justin">
                        <div>
                            <div class="test-name">Justin Williams</div>
                            <div class="test-role">CEO, Zenith Brands</div>
                        </div>
                    </div>
                </div>
                
                <div class="test-card">
                    <div class="test-quote-icon">”</div>
                    <p class="test-text">"The performance enhancement on the Enterprise plan literally doubled our conversion rates. Their proactive approach is an absolute gamechanger!"</p>
                    <div class="test-author">
                        <img src="https://ui-avatars.com/api/?name=Marcus+Thomas&background=ea580c&color=fff" class="test-av" alt="Marcus">
                        <div>
                            <div class="test-name">Marcus Thomas</div>
                            <div class="test-role">Director, Global Web</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
