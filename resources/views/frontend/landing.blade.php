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

/* 2. Logos */
.logos-sec { background: #f8fafc; padding: 3rem 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; text-align: center; }
.logos-title { font-size: 0.6875rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.5rem; }
.logos-grid { display: flex; justify-content: center; gap: 4rem; flex-wrap: wrap; opacity: 0.6; }
.logo-item { display: flex; align-items: center; gap: 8px; font-size: 1.25rem; font-weight: 800; color: var(--lp-text-light); }

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

/* 4. Stats Band */
.stats-sec { background: var(--lp-bg-blue); padding: 5rem 0; text-align: center; }
.stats-flex { display: flex; justify-content: center; gap: 6rem; margin-bottom: 3rem; }
.stat-item { display: flex; flex-direction: column; align-items: center; }
.stat-icon { color: var(--lp-primary); font-size: 1.5rem; margin-bottom: 0.5rem; }
.stat-num { font-size: 2rem; font-weight: 800; color: var(--lp-dark); margin-bottom: 0.25rem; }
.stat-label { font-size: 0.8125rem; font-weight: 700; color: var(--lp-text-light); text-transform: uppercase; letter-spacing: 0.05em; }

.stats-card { background: white; border-radius: 12px; padding: 1.5rem 2rem; display: inline-block; box-shadow: 0 4px 20px rgba(0,0,0,0.03); text-align: center; }
.sc-top { display: inline-flex; align-items: center; gap: 8px; font-weight: 800; color: #15803d; font-size: 0.875rem; margin-bottom: 1rem; }
.sc-top span { background: #dcfce7; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px; }
.sc-divider { height: 1px; background: #f1f5f9; width: 100%; margin-bottom: 1rem; }
.sc-bot { font-size: 0.75rem; font-weight: 600; color: var(--lp-text-light); margin-bottom: 0.75rem; display: block;}
.sc-logos { display: flex; justify-content: center; gap: 1rem; opacity: 0.5; font-size: 0.75rem; font-weight: 800; }

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
            <div class="logos-title">Trusted by 500+ forward-thinking brands</div>
            <div class="logos-grid">
                <div class="logo-item"><span class="material-icons-outlined">cloud</span> Google Cloud</div>
                <div class="logo-item"><span class="material-icons-outlined">dns</span> AWS</div>
                <div class="logo-item"><span class="material-icons-outlined">security</span> Cloudflare</div>
                <div class="logo-item"><span class="material-icons-outlined">settings_applications</span> cPanel</div>
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
            <div class="stats-flex">
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">moving</span>
                    <div class="stat-num">99.9%</div>
                    <div class="stat-label">Uptime Guarantee</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">security</span>
                    <div class="stat-num">15,000+</div>
                    <div class="stat-label">Threats Blocked</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">flash_on</span>
                    <div class="stat-num">&lt;2hr</div>
                    <div class="stat-label">Response Time</div>
                </div>
            </div>
            
            <div class="stats-card">
                <div class="sc-top">
                    <span><i class="material-icons-outlined" style="font-size:14px; font-weight:800;">check</i></span> 
                    All included! No hidden cost!
                </div>
                <div class="sc-divider"></div>
                <span class="sc-bot">Powered by the best in the industry:</span>
                <div class="sc-logos">
                    <span>AWS</span> | <span>CLOUDFLARE</span> | <span>CPANEL</span>
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
