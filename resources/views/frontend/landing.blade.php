@extends('layouts.frontend')
@section('title', 'United WP agency - Secure WP Infrastructure')

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
.lp-container { max-width: 1400px; margin: 0 auto; padding: 0 1.5rem; }

/* Typography */
h1, h2, h3 { font-weight: 800; color: var(--lp-dark); line-height: 1.1; margin: 0; }
p { line-height: 1.6; margin: 0; }

/* 1. Hero Section */
.hero-sec { padding: 5rem 0; }
.hero-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
.hero-pill {
    background: #dae0f5ff; color: #3730a3; padding: 4px 12px; border-radius: 4px;
    font-size: 0.6875rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;
    display: inline-block; margin-bottom: 1.5rem;
}
.hero-title { font-size: 3.5rem; letter-spacing: -0.02em; margin-bottom: 1.5rem; }
.hero-desc { font-size: 1.125rem; color: var(--lp-text-light); margin-bottom: 1rem; max-width: 500px; }
.hero-disclaimer { font-size: 0.8125rem; font-weight: 700; color: #94a3b8; margin-bottom: 2rem; }
.hero-btn-group { display: flex; gap: 1rem; }
.btn-primary { background: var(--lp-primary); color: white; padding: 0.875rem 2rem; border-radius: 6px; font-weight: 700; text-decoration: none; box-shadow: 0 8px 18px rgba(234, 88, 12, 0.35); transition: all 0.2s ease; }
.btn-primary:hover { color: white; transform: translateY(-2px); box-shadow: 0 12px 24px rgba(234, 88, 12, 0.45); }
.btn-secondary { background: var(--lp-bg-blue); color: var(--lp-text); padding: 0.875rem 2rem; border-radius: 6px; font-weight: 700; text-decoration: none; }
.btn-secondary:hover { color: var(--lp-text); }

.hero-img-box {
    background: var(--lp-dark); border-radius: 24px; padding: 0; position: relative;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15); display: flex; align-items: center; justify-content: center;
    aspect-ratio: 4/3;
}
.hero-img-box img { width: 100%; height: 100%; object-fit: cover; border-radius: 24px; }


.hero-floating-badge {
    position: absolute; bottom: -1rem; left: 2rem; background: white; padding: 0.75rem 1rem;
    border-radius: 8px; display: flex; align-items: center; gap: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.fb-icon { width: 24px; height: 24px; background: #fef08a; color: #ca8a04; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; }
.fb-text-top { font-size: 0.625rem; color: var(--lp-text-light); text-transform: uppercase; font-weight: 700; }
.fb-text-bot { font-size: 0.8125rem; font-weight: 800; color: var(--lp-dark); }

/* 2. Infrastructure Strip */
.logos-sec {
    background: #f3f6fc;
    padding: 1.95rem 0 1.8rem;
    border-top: 1px solid #eef2f8;
    border-bottom: 1px solid #eef2f8;
    text-align: center;
}
.logos-title {
    font-size: 0.625rem;
    font-weight: 800;
    color: #c5cdd7ff;
    text-transform: uppercase;
    letter-spacing: 0.26em;
    margin-bottom: 0.7rem;
}
.logos-flex {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    align-items: center;
}
.logo-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 1rem;
    font-weight: 700;
    color: #b1bbc9;
}
.logo-item span { font-size: 1.15rem; color: #b1bbc9; }

/* 3. Pricing */
.pricing-sec { padding: 6rem 0; text-align: center; }
.pricing-title { font-size: 2.25rem; font-weight: 800; margin-bottom: 0.75rem; color: #1e293b; }
.pricing-subtitle { font-size: 1rem; color: var(--lp-text-light); margin-bottom: 4rem; }
.pricing-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem; align-items: stretch; width: 100%; margin: 0 auto; text-align: left; }

.pr-card { 
    background: white; border: 1px solid #e2e8f0; border-radius: 20px; padding: 3rem 2.8rem 2.5rem; 
    position: relative; display: flex; flex-direction: column; transition: transform 0.2s;
}
.pr-card.popular { 
    border: 2px solid #8c2f1b; 
    box-shadow: 0 15px 40px rgba(140, 47, 27, 0.12);
    z-index: 10;
}
.pr-tag {
    position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
    background: #8c2f1b; color: white; padding: 6px 20px; border-radius: 10px;
    font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;
    white-space: nowrap; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.pr-name { font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem; }
.pr-desc { font-size: 0.81rem; color: #94a3b8; margin-bottom: 2.2rem; display: block; font-weight: 600; font-style: italic; }

.pr-price { font-size: 3.75rem; font-weight: 900; color: #0f172a; margin-bottom: 2.5rem; line-height: 0.9; letter-spacing: -0.03em; display: flex; align-items: baseline; }
.pr-currency { font-size: 1.8rem; margin-right: 2px; font-weight: 800; margin-top: 10px; }
.pr-period { font-size: 1.25rem; color: #1e293b; font-weight: 600; margin-left: 2px; }

.pr-feat { display: flex; flex-direction: column; gap: 1.1rem; list-style: none; padding: 0; margin: 0 0 3.5rem 0; flex-grow: 1; }
.pr-feat li { display: flex; align-items: center; gap: 12px; font-size: 0.91rem; color: #475569; font-weight: 600; }
.pr-feat li span { color: #f97316; font-size: 1.2rem; }

.btn-secure { 
    width: 100%; border-radius: 12px; padding: 1rem; 
    font-weight: 800; text-decoration: none; text-align: center; 
    display: flex; align-items: center; justify-content: center; gap: 10px;
    font-size: 0.9rem;
}
.btn-outline { border: 1.5px solid #8c2f1b; color: #8c2f1b; background: transparent; }
.btn-pop { background: #ea580c; color: white !important; border: none; box-shadow: 0 8px 18px rgba(234, 88, 12, 0.35); transition: all 0.2s ease; }
.btn-pop:hover { color: white !important; transform: translateY(-2px); box-shadow: 0 12px 24px rgba(234, 88, 12, 0.45); }

.pr-sla { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.65rem; font-weight: 700; color: #64748b; margin-top: 1.2rem; text-decoration: none; opacity: 0.8; }
.pr-sla:hover { opacity: 1; }
.pr-sla span { font-size: 0.85rem; }

/* 4. Trust + Stats Band */
.stats-sec { background: #f0f4ff; padding: 4.5rem 0 4.8rem; text-align: center; }
.trusted-tools { margin-bottom: 4rem; }
.trusted-title {
    font-size: 0.625rem;
    font-weight: 800;
    color: #c5cdd7ff;
    text-transform: uppercase;
    letter-spacing: 0.26em;
    margin-bottom: 0.7rem;
}
.trusted-grid {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 4.5rem;
}
.trusted-item { font-size: 1rem; font-weight: 700; color: #b1bbc9; }

.stats-flex {
    background: transparent;
    border: none;
    border-radius: 0;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    margin-bottom: 5rem;
}
.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem 1.25rem 1.8rem;
    border-right: 1px solid #dbeafe; /* Subtle blue separator */
}
.stat-item:last-child { border-right: none; }
.stat-icon { font-size: 1.5rem; margin-bottom: 0.75rem; }
.stat-num { font-size: 2.5rem; font-weight: 800; color: var(--lp-dark); margin-bottom: 0.25rem; line-height: 1; }
.stat-label { font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.14em; }


/* Challenges Section */
.challenges-sec { background: #ffffff; padding: 7rem 0; text-align: center; }
.challenges-title { font-size: 2.75rem; font-weight: 800; color: #0f172a; margin-bottom: 1.5rem; letter-spacing: -0.02em; }
.challenges-subtitle { font-size: 1.0625rem; color: #64748b; max-width: 650px; margin: 0 auto 5rem; line-height: 1.6; }
.challenges-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem; }
.challenge-card { background: white; border-radius: 2rem; padding: 3.5rem 2.5rem; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12); display: flex; flex-direction: column; align-items: flex-start; text-align: left; transition: all 0.3s ease; border: 1px solid #f1f5f9; }
.challenge-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18); }
.challenge-icon-box { width: 56px; height: 56px; background: #fff7ed; color: #f97316; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; }
.challenge-card-title { font-size: 1.375rem; font-weight: 800; color: #0f172a; margin-bottom: 1.25rem; line-height: 1.3; }
.challenge-card-desc { font-size: 0.9375rem; color: #64748b; line-height: 1.7; }

/* 4.5 Our Process */
.process-sec { background: #f8fafc; padding: 6rem 0; text-align: center; }
.process-overline { font-size: 0.625rem; font-weight: 800; color: #ea580c; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem; display: block;}
.process-title { font-size: 2.5rem; font-weight: 800; color: #0f172a; margin-bottom: 4rem; }
.process-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; position: relative; }
.process-card { background: white; border-radius: 1.5rem; padding: 6.5rem 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; height: 100%; box-sizing: border-box; }
.process-icon-box { width: 64px; height: 64px; background: #fff1eb; color: #ea580c; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; }
.process-card-step { font-size: 1.125rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem; }
.process-card-desc { font-size: 0.9375rem; color: #64748b; line-height: 1.6; }
.process-num { position: absolute; bottom: 1.5rem; left: 50%; transform: translateX(-50%); font-size: 4rem; font-weight: 800; color: #f1f5f9; z-index: -1; line-height: 1; }
.process-line { display: none; }

@media (max-width: 1024px) {
    .challenges-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .challenges-grid { grid-template-columns: 1fr; }
    .challenge-card { align-items: center; text-align: center; }
    .process-grid { grid-template-columns: 1fr; gap: 3rem; }
    .process-line { display: none; }
}



@media (max-width: 900px) {
    .hero-grid, .pricing-grid, .test-grid { grid-template-columns: 1fr; }
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
.faq-item { border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; cursor: pointer; transition: background 0.2s; }
.faq-item:hover { background: #f8fafc; }
.faq-q { display: flex; justify-content: space-between; align-items: center; font-weight: 800; font-size: 1rem; color: var(--lp-dark); }
.faq-icon { color: var(--lp-primary); transition: transform 0.2s; }
.faq-a { margin-top: 1rem; font-size: 0.9375rem; color: var(--lp-text-light); display: none; line-height: 1.6; }
.faq-item.active .faq-a { display: block; }
.faq-item.active .faq-icon { transform: rotate(180deg); }

/* 6. Testimonials */
.test-sec { background: var(--lp-bg-light); padding: 6rem 0; text-align: center; }
.test-title { font-size: 2.25rem; margin-bottom: 4rem; }
.test-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
.test-card { background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); text-align: left; position: relative; }
.test-quote-icon { position: absolute; top: 2rem; right: 2rem; font-size: 3rem; color: #ffedd5; font-family: serif; font-weight: 800; line-height: 1; }
.test-text { font-size: 1rem; font-weight: 600; color: var(--lp-text); line-height: 1.6; margin-bottom: 2rem; }
.test-author { display: flex; align-items: center; gap: 1rem; }
.test-av { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
.test-name { font-weight: 800; font-size: 0.9375rem; color: var(--lp-dark); }
.test-role { font-size: 0.75rem; font-weight: 600; color: var(--lp-text-light); }

/* Billing Toggle */
.billing-toggle-wrap { display: flex; justify-content: center; margin-bottom: 3rem; }
.billing-toggle {
    display: inline-flex; position: relative; background: #f1f5f9; border-radius: 12px; padding: 4px; border: 1px solid #e2e8f0;
}
.billing-opt {
    position: relative; z-index: 2; padding: 0.65rem 1.5rem; border: none; background: none;
    font-weight: 700; font-size: 0.875rem; color: #64748b; cursor: pointer; border-radius: 10px;
}
.billing-opt.active { color: #0f172a; }
.billing-slider {
    position: absolute; top: 4px; left: 4px; height: calc(100% - 8px);
    background: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease; z-index: 1;
}
.save-badge { background: #dcfce7; color: #16a34a; font-size: 0.65rem; font-weight: 800; padding: 2px 6px; border-radius: 4px; }
.save-badge.save-best { background: #fef3c7; color: #d97706; }

.pr-original-price { font-size: 1rem; color: #94a3b8; text-decoration: line-through; margin-top: -1rem; margin-bottom: 1rem; font-weight: 600; }
html { scroll-behavior: smooth; }
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
                    <h1 class="hero-title">AI is Chaos.<br>Your WordPress<br>Foundation<br>Shouldn't Be.</h1>
                    <p class="hero-desc">Starting at only ${{ number_format($plans->min('price'), 0) }}/yr. Protect your ROI with a lightning-fast, highly-secure WordPress instance that doesn't just block issues—it accelerates growth.</p>


                    <div class="hero-disclaimer">* No hidden fees. Cancel anytime. Expert 24/7 emergency support.</div>
                    <div class="hero-btn-group">
                        <a href="#pricing" class="btn-primary">Explore Plans</a>
                        <a href="{{ route('contact') }}" class="btn-secondary">Contact Us</a>
                    </div>


                </div>
                <div class="hero-img-box">
                    <img src="{{ asset('images/hero_laptop_dashboard.png') }}" alt="Dashboard">
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
            <div class="logos-flex">
                <div class="logo-item"><span class="material-icons-outlined">cloud</span> Google Cloud</div>
                <div class="logo-item"><span class="material-icons-outlined">radio_button_unchecked</span> AWS</div>
                <div class="logo-item"><span class="material-icons-outlined">cloud_queue</span> Cloudflare</div>
                <div class="logo-item"><span class="material-icons-outlined">dns</span> DigitalOcean</div>
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
                        <span class="pr-desc">Best For: {{ $plan->best_for ?: 'WordPress Sites' }}</span>

                        <div class="pr-price">
                            <span class="pr-currency">$</span>
                            <span class="pr-amount">{{ number_format($plan->price, 0) }}</span>
                            <span class="pr-period">/yr</span>
                        </div>







                        <ul class="pr-feat">
                            @if(is_array($plan->features) && count($plan->features))
                                @foreach($plan->features as $feature)
                                    <li><span class="material-icons">check_circle</span> {{ $feature }}</li>
                                @endforeach
                            @else
                                @if($plan->name === 'The Startup')
                                    <li><span class="material-icons">check_circle</span> Standard Maintenance</li>
                                    <li><span class="material-icons">check_circle</span> Basic Security</li>
                                    <li><span class="material-icons">check_circle</span> Uptime Monitoring</li>
                                    <li><span class="material-icons">check_circle</span> {{ $plan->dev_hours ?: 60 }} hours development support</li>
                                    <li><span class="material-icons">check_circle</span> Monthly reports</li>
                                @elseif($plan->name === 'The Scaleup')
                                    <li><span class="material-icons">check_circle</span> All features of The Startup</li>
                                    <li><span class="material-icons">check_circle</span> Priority Support</li>
                                    <li><span class="material-icons">check_circle</span> Daily Backups</li>
                                    <li><span class="material-icons">check_circle</span> {{ $plan->dev_hours ?: 120 }} hour development support</li>
                                    <li><span class="material-icons">check_circle</span> Monthly reports</li>
                                @else
                                    <li><span class="material-icons">check_circle</span> All features of The Scaleup</li>
                                    <li><span class="material-icons">check_circle</span> Ecommerce Optimization</li>
                                    <li><span class="material-icons">check_circle</span> Dedicated Manager</li>
                                    <li><span class="material-icons">check_circle</span> {{ $plan->dev_hours ?: 200 }} hours development support</li>
                                    <li><span class="material-icons">check_circle</span> Monthly reports</li>
                                @endif
                            @endif
                        </ul>


                        <a href="{{ route('onboard', ['plan' => $plan->slug, 'billing_cycle' => 'yearly']) }}" class="btn-secure {{ $plan->is_popular ? 'btn-pop' : 'btn-outline' }} pr-cta-link">
                            @if($plan->is_popular) <span class="material-icons">shopping_cart</span> @endif
                            Secure WP Now
                        </a>

                        <a href="#" class="pr-sla">Service-level agreement <span class="material-icons">open_in_new</span></a>

                    </div>
                @endforeach
            </div>

            <div class="text-center" style="margin-top: 2.5rem;">
                <a href="{{ route('plans') }}#technical-specs" style="color: #ea580c; font-weight: 800; font-size: 1.1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: opacity 0.2s;">
                    Full feature list <span class="material-icons-outlined" style="font-size: 1.25rem;">arrow_forward</span>
                </a>
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
                    <span class="material-icons stat-icon" style="color: #ea580c;">speed</span>
                    <div class="stat-num">99.9%</div>
                    <div class="stat-label">Uptime Maintained</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons stat-icon" style="color: #3b82f6;">security</span>
                    <div class="stat-num">15,000+</div>
                    <div class="stat-label">Threats Blocked</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons stat-icon" style="color: #ea580c;">bolt</span>
                    <div class="stat-num">&lt;2hr</div>
                    <div class="stat-label">Response Time</div>
                </div>
            </div>

        </div>
    </section>

    {{-- 4.5 Process --}}
    <section class="process-sec">
        <div class="lp-container">
            <span class="process-overline">Simplicity Redefined</span>
            <h2 class="process-title">Our Process</h2>
            
            <div class="process-grid">
                {{-- Removed process-line dots --}}
                
                {{-- Step 1 --}}
                <div class="process-card">
                    <div class="process-icon-box">
                        <span class="material-icons-outlined">list_alt</span>
                    </div>
                    <div class="process-card-step">Step 1: Choose Your Tier</div>
                    <p class="process-card-desc">Select the Startup, Scaleup, or Enterprise plan that fits your business needs. Each tier is precision-engineered for growth.</p>
                    <div class="process-num">01</div>
                </div>

                {{-- Step 2 --}}
                <div class="process-card">
                    <div class="process-icon-box">
                        <span class="material-icons-outlined">monitor_heart</span>
                    </div>
                    <div class="process-card-step">Step 2: Monitoring Active</div>
                    <p class="process-card-desc">24/7 autonomous monitoring and daily cloud backups go live instantly. Relax while your WP Maintenance takes the lead.</p>
                    <div class="process-num">02</div>
                </div>

                {{-- Step 3 --}}
                <div class="process-card">
                    <div class="process-icon-box">
                        <span class="material-icons-outlined">description</span>
                    </div>
                    <div class="process-card-step">Step 3: Monthly Reports</div>
                    <p class="process-card-desc">Receive comprehensive monthly reports detailing your site's health, completed updates, and performance optimizations performed by our team.</p>
                    <div class="process-num">03</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Challenges Section --}}
    <section class="challenges-sec">
        <div class="lp-container">
            <h2 class="challenges-title">Common WordPress Challenges We Solve</h2>
            <p class="challenges-subtitle">From failed updates and hacked plugins to downtime and speed loss, United WP agency gives you one place to keep your site stable and business-ready.</p>
            
            <div class="challenges-grid">
                {{-- Card 1 --}}
                <div class="challenge-card">
                    <div class="challenge-icon-box">
                        <span class="material-icons-outlined">handyman</span>
                    </div>
                    <div class="challenge-card-title">Safe Plugin & Theme Updates</div>
                    <p class="challenge-card-desc">We update WordPress core, themes, and plugins carefully with compatibility checks and rollback protection.</p>
                </div>

                {{-- Card 2 --}}
                <div class="challenge-card">
                    <div class="challenge-icon-box">
                        <span class="material-icons-outlined">lock</span>
                    </div>
                    <div class="challenge-card-title">Security Hardening</div>
                    <p class="challenge-card-desc">Malware scans, brute-force protection, firewall setup, and suspicious activity monitoring help reduce risk.</p>
                </div>

                {{-- Card 3 --}}
                <div class="challenge-card">
                    <div class="challenge-icon-box">
                        <span class="material-icons-outlined">save</span>
                    </div>
                    <div class="challenge-card-title">Automated Backups</div>
                    <p class="challenge-card-desc">Daily or real-time backups ensure your site can be restored quickly when something goes wrong.</p>
                </div>

                {{-- Card 4 --}}
                <div class="challenge-card">
                    <div class="challenge-icon-box">
                        <span class="material-icons-outlined">bolt</span>
                    </div>
                    <div class="challenge-card-title">Speed Optimization</div>
                    <p class="challenge-card-desc">We improve performance using caching, image optimization, database cleanup, and front-end best practices.</p>
                </div>

                {{-- Card 5 --}}
                <div class="challenge-card">
                    <div class="challenge-icon-box">
                        <span class="material-icons-outlined">bar_chart</span>
                    </div>
                    <div class="challenge-card-title">Monthly Health Reports</div>
                    <p class="challenge-card-desc">Get clean reports with completed updates, uptime data, backups, scan logs, and recommendations.</p>
                </div>

                {{-- Card 6 --}}
                <div class="challenge-card">
                    <div class="challenge-icon-box">
                        <span class="material-icons-outlined">support_agent</span>
                    </div>
                    <div class="challenge-card-title">Technical Support</div>
                    <p class="challenge-card-desc">Need help with broken layouts, plugin issues, forms, or WooCommerce glitches? We step in quickly.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="faq-sec">
        <div class="lp-container">
            <div class="faq-head">
                <h2 class="faq-title">Frequently Asked Questions</h2>
            </div>
            <div class="faq-list">
                @php
                    $faqs = [
                        ['q' => 'What does a maintenance plan cover?', 'a' => 'Daily backups, security monitoring, theme & plugin updates, and performance tuning.'],
                        ['q' => 'How fast is your response time?', 'a' => 'Under 24 hours for normal requests, often under 2 hours for priority support.'],
                        ['q' => 'Can I cancel at any time?', 'a' => 'Yes, though our plans are billed annually to ensure long-term stability and performance for your WordPress infrastructure.']

                    ];
                @endphp
                @foreach($faqs as $faq)
                    <div class="faq-item" onclick="this.classList.toggle('active')">
                        <div class="faq-q">{{ $faq['q'] }} <span class="material-icons-outlined faq-icon">expand_more</span></div>
                        <div class="faq-a">{{ $faq['a'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 6. Testimonials --}}
    <section class="test-sec">
        <div class="lp-container">
            <h2 class="test-title">Loved by Agency Owners</h2>
            <div class="test-grid">
                <div class="test-card">
                    <div class="test-quote-icon">”</div>
                    <p class="test-text">"Precision and care that is rare. The only team I trust with my client sites."</p>
                    <div class="test-author">
                        <img src="https://ui-avatars.com/api/?name=Justin+Williams" class="test-av" alt="Justin">
                        <div>
                            <div class="test-name">Justin Williams</div>
                            <div class="test-role">CEO, Zenith Brands</div>
                        </div>
                    </div>
                </div>
                <div class="test-card">
                    <div class="test-quote-icon">”</div>
                    <p class="test-text">"Proactive approach is an absolute gamechanger for our infrastructure."</p>
                    <div class="test-author">
                        <img src="https://ui-avatars.com/api/?name=Marcus+Thomas" class="test-av" alt="Marcus">
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

@push('scripts')


@endpush
