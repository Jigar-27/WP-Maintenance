@extends('layouts.frontend')

@section('title', 'Choose Your Digital Guardian Plan')
@section('meta_description', 'Select the service level that fits your business needs. All plans include 24/7 security and monthly reporting.')

@section('content')
<section class="section" style="padding-top: calc(var(--space-24) + 100px); padding-bottom: var(--space-20);">
    <div class="fp-container">
        {{-- Hero Header --}}
        <div class="text-center mb-32" data-animate>
            <h1 class="display-lg" style="color: #010101; margin-bottom: 2rem; font-weight: 800; line-height: 1.1; font-size: 3.25rem;">Choose Your Digital <br> Guardian Plan</h1>
            <p class="body-lg text-muted" style="max-width: 600px; margin: 0 auto; line-height: 1.6; font-size: 0.95rem;">Select the service level that fits your business needs. All plans include 24/7 security and monthly reporting.</p>
        </div>

        {{-- Billing Cycle Toggle --}}
        <div style="display:flex; justify-content:center; margin-bottom:3rem;">
            <div class="billing-toggle" id="billingToggle" style="display:inline-flex; position:relative; background:#f1f5f9; border-radius:12px; padding:4px; border:1px solid #e2e8f0;">
                <button type="button" class="billing-opt active" data-cycle="monthly" style="position:relative; z-index:2; padding:0.65rem 1.5rem; border:none; background:none; font-weight:700; font-size:0.875rem; color:#64748b; cursor:pointer; border-radius:10px; transition:color 0.3s; display:flex; align-items:center; gap:6px; white-space:nowrap;">Monthly</button>
                <button type="button" class="billing-opt" data-cycle="quarterly" style="position:relative; z-index:2; padding:0.65rem 1.5rem; border:none; background:none; font-weight:700; font-size:0.875rem; color:#64748b; cursor:pointer; border-radius:10px; transition:color 0.3s; display:flex; align-items:center; gap:6px; white-space:nowrap;">
                    Quarterly <span style="background:#dcfce7; color:#16a34a; font-size:0.65rem; font-weight:800; padding:2px 6px; border-radius:4px;">Save {{ (int)($plans->first()->quarterly_discount ?? 10) }}%</span>
                </button>
                <button type="button" class="billing-opt" data-cycle="yearly" style="position:relative; z-index:2; padding:0.65rem 1.5rem; border:none; background:none; font-weight:700; font-size:0.875rem; color:#64748b; cursor:pointer; border-radius:10px; transition:color 0.3s; display:flex; align-items:center; gap:6px; white-space:nowrap;">
                    Yearly <span style="background:#fef3c7; color:#d97706; font-size:0.65rem; font-weight:800; padding:2px 6px; border-radius:4px;">Save {{ (int)($plans->first()->yearly_discount ?? 20) }}%</span>
                </button>
                <div class="billing-slider" id="billingSlider" style="position:absolute; top:4px; left:4px; height:calc(100% - 8px); background:#fff; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08); transition:all 0.35s cubic-bezier(0.4,0,0.2,1); z-index:1;"></div>
            </div>
        </div>

        {{-- Pricing Grid --}}
        <div class="pricing-grid" style="padding-top: 2rem; padding-bottom: 6rem; margin-bottom: 2rem;">
            @foreach($plans as $plan)
                <div class="pr-card {{ $plan->is_popular ? 'popular' : '' }}" data-animate>
                    @if($plan->is_popular)
                        <div class="pr-tag">MOST POPULAR</div>
                    @endif

                    <div class="pr-name">{{ $plan->name }}</div>
                    <span class="pr-desc">Best For: {{ $plan->best_for ?: 'WordPress Sites' }}</span>
                    <div class="pr-price"
                         data-base="{{ $plan->price }}"
                         data-quarterly-discount="{{ $plan->quarterly_discount ?? 10 }}"
                         data-yearly-discount="{{ $plan->yearly_discount ?? 20 }}">
                        $<span class="pr-amount">{{ number_format($plan->price, 0) }}</span><span class="pr-period">/mo</span>
                    </div>
                    <div class="pr-original-price" style="display:none; font-size:1rem; color:#94a3b8; text-decoration:line-through; margin-top:-1rem; margin-bottom:1rem; font-weight:600;">
                        <span class="pr-original-amount"></span>
                        <span class="pr-savings" style="display:inline-block; background:#dcfce7; color:#16a34a; font-size:0.75rem; font-weight:800; padding:3px 8px; border-radius:6px; margin-left:8px; text-decoration:none;"></span>
                    </div>

                    <ul class="pr-feat">
                        @if(is_array($plan->features) && count($plan->features))
                            @foreach($plan->features as $feature)
                                <li><span class="material-icons-outlined">check_circle_outline</span> {{ $feature }}</li>
                            @endforeach
                        @else
                            @if($plan->name === 'The Startup')
                                <li><span class="material-icons-outlined">check_circle_outline</span> Standard Maintenance</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Basic Security</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Uptime Monitoring</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> {{ $plan->dev_hours ?: 60 }} hours development support</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Monthly reports</li>
                            @elseif($plan->name === 'The Scaleup')
                                <li><span class="material-icons-outlined">check_circle_outline</span> All features of The Startup</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Priority Support</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Daily Backups</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> {{ $plan->dev_hours ?: 120 }} hour development support</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Monthly reports</li>
                            @else
                                <li><span class="material-icons-outlined">check_circle_outline</span> All features of The Scaleup</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Ecommerce Optimization</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Dedicated Manager</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> {{ $plan->dev_hours ?: 200 }} hours development support</li>
                                <li><span class="material-icons-outlined">check_circle_outline</span> Monthly reports</li>
                            @endif
                        @endif
                    </ul>

                    <a href="{{ route('onboard', $plan->slug) }}" class="btn-secure {{ $plan->is_popular ? 'btn-pop' : 'btn-outline' }} pr-cta-link" data-base-href="{{ route('onboard', $plan->slug) }}">
                        @if($plan->is_popular)
                            <span class="material-icons-outlined">shopping_cart</span>
                        @endif
                        Secure WP Now
                    </a>
                    <a href="{{ route('terms') }}" class="pr-sla">
                        Service-level agreement <span class="material-icons-outlined" style="font-size: 0.8125rem;">open_in_new</span>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Active Concierge Maintenance Report Banner --}}
        <div class="monitoring-banner" style="margin-bottom: 4rem;" data-animate>
            <div class="mb-content">
                <div class="mb-icon-box">
                    <span class="material-icons-outlined">verified_user</span>
                </div>
                <div class="mb-text">
                    <h4>Active Concierge Maintenance Report</h4>
                    <p>Monthly report submitted to you including all updates</p>
                </div>
            </div>
            <a href="{{ route('sample.report') }}" target="_blank" class="btn-sample">VIEW SAMPLE REPORT</a>
        </div>

        {{-- Our Process --}}
        <div class="mb-48" data-animate style="padding: 4rem 0;">
            <div class="text-center mb-16">
                <h2 class="display-sm" style="color: #0f172a; margin-bottom: 0.75rem;">Our Process</h2>
                <div style="width: 50px; height: 3px; background: #f97316; margin: 0 auto; border-radius: 2px;"></div>
            </div>

            <div class="process-steps">
                <div class="process-line" style="top: 2.25rem;"></div>
                <div class="process-grid">
                    <div class="process-step">
                        <div class="ps-icon"><span class="material-icons-outlined">search</span></div>
                        <div class="ps-label">1. SELECT PLAN</div>
                        <p class="ps-desc">Choose the Startup, Scaleup, or Enterprise tier that fits your business growth.</p>
                    </div>
                    <div class="process-step">
                        <div class="ps-icon"><span class="material-icons-outlined">vpn_key</span></div>
                        <div class="ps-label">2. SECURE ONBOARDING</div>
                        <p class="ps-desc">Submit your site credentials through our encrypted, private intake vault.</p>
                    </div>
                    <div class="process-step">
                        <div class="ps-icon"><span class="material-icons-outlined">admin_panel_settings</span></div>
                        <div class="ps-label">3. ELITE AUDIT</div>
                        <p class="ps-desc">Our engineering hub performs a 50-point security and performance baseline audit.</p>
                    </div>
                    <div class="process-step">
                        <div class="ps-icon"><span class="material-icons-outlined">settings</span></div>
                        <div class="ps-label">4. SHIELD ACTIVE</div>
                        <p class="ps-desc">24/7 autonomous monitoring, daily cloud backups, and malware protection go live.</p>
                    </div>
                    <div class="process-step">
                        <div class="ps-icon"><span class="material-icons-outlined" style="color: #f97316;">description</span></div>
                        <div class="ps-label">5. TOTAL CLARITY</div>
                        <p class="ps-desc">Receive weekly branded reports showing your site's health while we handle the heavy lifting.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Technical Specs --}}
        <div class="mb-32" data-animate style="padding-top: 4rem;">
            <div class="text-center mb-12">
                <h2 class="display-sm" style="color: #0f172a; margin-bottom: 0.75rem;">Compare Technical Specifications</h2>
                <div style="width: 50px; height: 3px; background: #f97316; margin: 0 auto; border-radius: 2px;"></div>
            </div>

            <div class="spec-table-container">
                <div style="overflow-x: auto">
                    <table class="spec-table">
                        <thead>
                            <tr>
                                <th style="width: 32%">Key Features</th>
                                <th>The Startup</th>
                                <th class="spec-highlight">The Scaleup</th>
                                <th>The Enterprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="spec-feature-name">Core Updates <span class="material-icons-outlined spec-info-icon" title="Automated WordPress core and plugin updates">info</span></div></td>
                                <td><span class="material-icons-outlined spec-check">check</span></td>
                                <td class="spec-highlight"><span class="material-icons-outlined spec-check">check</span></td>
                                <td><span class="material-icons-outlined spec-check">check</span></td>
                            </tr>
                            <tr>
                                <td><div class="spec-feature-name">Safe Staging <span class="material-icons-outlined spec-info-icon" title="Test updates in a sandboxed environment">info</span></div></td>
                                <td><span class="material-icons-outlined spec-check">check</span></td>
                                <td class="spec-highlight"><span class="material-icons-outlined spec-check">check</span></td>
                                <td><span class="material-icons-outlined spec-check">check</span></td>
                            </tr>
                            <tr>
                                <td><div class="spec-feature-name">WAF (Web Application Firewall) <span class="material-icons-outlined spec-info-icon" title="Enterprise protection">info</span></div></td>
                                <td><span class="spec-null">—</span></td>
                                <td class="spec-highlight"><span class="material-icons-outlined spec-check">check</span></td>
                                <td><span class="material-icons-outlined spec-check">check</span></td>
                            </tr>
                            <tr>
                                <td><div class="spec-feature-name">PHP Optimization <span class="material-icons-outlined spec-info-icon" title="Continuous performance tuning">info</span></div></td>
                                <td><span class="spec-null">—</span></td>
                                <td class="spec-highlight"><span class="material-icons-outlined spec-check">check</span></td>
                                <td><span class="material-icons-outlined spec-check">check</span></td>
                            </tr>
                            <tr>
                                <td><div class="spec-feature-name">Visual Regression Testing <span class="material-icons-outlined spec-info-icon" title="Design integrity protection">info</span></div></td>
                                <td><span class="spec-null">—</span></td>
                                <td class="spec-highlight"><span class="spec-null">—</span></td>
                                <td><span class="material-icons-outlined spec-check">check</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Global Overrides for this page */
    .pricing-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    .pr-card { 
        background: white; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem 2rem; 
        position: relative; transition: all 0.3s ease; display: flex; flex-direction: column;
    }
    .pr-card.popular { border: 2.5px solid #854d0e; transform: translateY(-12px); box-shadow: 0 30px 60px rgba(133, 77, 14, 0.08); z-index: 10; }
    .pr-tag {
        position: absolute; top: -16px; left: 50%; transform: translateX(-50%);
        background: #854d0e; color: white; padding: 6px 20px; border-radius: 99px;
        font-size: 0.625rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.12em;
        white-space: nowrap; box-shadow: 0 4px 10px rgba(133, 77, 14, 0.2);
    }
    .pr-name { font-size: 1.21rem; font-weight: 800; color: #010101; margin-bottom: 0.25rem; }
    .pr-desc { font-size: 0.8125rem; font-style: italic; color: #64748b; margin-bottom: 1.5rem; display: block; }
    .pr-price { font-size: 2.43rem; font-weight: 800; color: #010101; margin-bottom: 2rem; line-height: 1; }
    .pr-price .pr-period { font-size: 1.125rem; color: #94a3b8; font-weight: 500; margin-left: 2px; }
    .pr-feat { list-style: none; padding: 0; margin: 0 0 2.5rem 0; display: flex; flex-direction: column; gap: 1rem; }
    .pr-feat li { display: flex; align-items: center; gap: 12px; font-size: 0.875rem; color: #475569; font-weight: 600;}
    .pr-feat li span { color: #f97316; font-size: 1rem; background: #fff7ed; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; }
    .btn-secure { 
        width: 100%; border-radius: 12px; padding: 1.1rem; 
        font-weight: 800; text-decoration: none; text-align: center; 
        display: flex; align-items: center; justify-content: center; gap: 10px;
        margin-top: auto; transition: 0.2s; font-size: 0.875rem;
    }
    .btn-outline { border: 1.5px solid #854d0e; color: #854d0e; background: transparent; }
    .btn-outline:hover { background: #fffbeb; }
    .btn-pop { background: #ea580c; color: white; border: none; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.3); }
    .btn-pop:hover { background: #c2410c; }
    .pr-sla { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.75rem; font-weight: 700; color: #64748b; margin-top: 1.5rem; text-decoration: none; }

    /* Monitoring Banner */
    .monitoring-banner {
        background: #eef2ff; border-radius: 20px; padding: 1.25rem 2.5rem;
        display: flex; align-items: center; justify-content: space-between;
    }
    .mb-content { display: flex; align-items: center; gap: 2rem; }
    .mb-icon-box { 
        background: white; width: 56px; height: 56px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; color: #eab308;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .mb-text h4 { font-size: 1rem; font-weight: 800; color: #1e293b; margin: 0; }
    .mb-text p { font-size: 0.8125rem; color: #64748b; margin: 4px 0 0 0; font-weight: 500; }
    .btn-sample {
        background: #dbeafe; color: #1e3a8a; padding: 0.75rem 1.75rem; border-radius: 8px;
        font-size: 0.6875rem; font-weight: 900; letter-spacing: 0.1em; text-decoration: none;
        transition: all 0.2s;
    }
    .btn-sample:hover { background: #bfdbfe; transform: translateY(-1px); }

    /* Our Process Flow */
    .process-steps { position: relative; padding-top: 2rem; }
    .process-line { position: absolute; top: 3.5rem; left: 10%; right: 10%; height: 1px; background: #e2e8f0; z-index: 1; }
    .process-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; position: relative; z-index: 2; }
    .process-step { text-align: center; }
    .ps-icon { 
        width: 48px; height: 48px; background: #f1f5f9; border-radius: 50%; border: 1px solid #e2e8f0;
        display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;
        color: #64748b; transition: all 0.3s;
    }
    .ps-label { font-size: 0.6875rem; font-weight: 900; color: #1e293b; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em; }
    .ps-desc { font-size: 0.75rem; color: #94a3b8; line-height: 1.4; font-weight: 500; max-width: 160px; margin: 0 auto; }
    .process-step:hover .ps-icon { background: white; border-color: #f97316; color: #f97316; transform: translateY(-2px); }

    /* Technical Specs (re-style for consistency) */
    .spec-table-container { background: white; border: 1px solid #f1f5f9; border-radius: 32px; overflow: hidden; margin-top: 2rem; }
    .spec-table { width: 100%; border-collapse: collapse; text-align: left; table-layout: fixed; }
    .spec-table th, .spec-table td { padding: 1.75rem 2.5rem; border-bottom: 2px solid #f8fafc; }
    .spec-table th { font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.12em; color: #94a3b8; font-weight: 900; }
    .spec-table th:not(:first-child) { font-size: 1.125rem; text-transform: none; color: #010101; text-align: center; letter-spacing: 0; font-weight: 800; }
    .spec-table td:not(:first-child) { text-align: center; }
    .spec-highlight { background: #fffaf9 !important; }
    .spec-feature-name { display: flex; align-items: center; gap: 10px; font-weight: 800; color: #334155; font-size: 0.9375rem; }
    .spec-info-icon { font-size: 0.8125rem; color: #cbd5e1; cursor: help; }
    .spec-check { color: #f97316; font-size: 1.125rem; font-weight: 900; }
    .spec-null { color: #cbd5e1; font-weight: 400; font-size: 1.125rem; }
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('billingToggle');
    const slider = document.getElementById('billingSlider');
    if (!toggle || !slider) return;
    const buttons = toggle.querySelectorAll('.billing-opt');
    const priceEls = document.querySelectorAll('.pr-price');
    const ctaLinks = document.querySelectorAll('.pr-cta-link');

    function updateSlider(btn) {
        slider.style.width = btn.offsetWidth + 'px';
        slider.style.left = btn.offsetLeft + 'px';
    }

    function updatePrices(cycle) {
        const periodMap = { monthly: '/mo', quarterly: '/qtr', yearly: '/yr' };
        const multiplierMap = { monthly: 1, quarterly: 3, yearly: 12 };

        priceEls.forEach(el => {
            const base = parseFloat(el.dataset.base);
            const qDiscount = parseFloat(el.dataset.quarterlyDiscount) / 100;
            const yDiscount = parseFloat(el.dataset.yearlyDiscount) / 100;
            const amountEl = el.querySelector('.pr-amount');
            const periodEl = el.querySelector('.pr-period');
            const originalEl = el.parentElement.querySelector('.pr-original-price');
            const originalAmtEl = originalEl ? originalEl.querySelector('.pr-original-amount') : null;
            const savingsEl = originalEl ? originalEl.querySelector('.pr-savings') : null;

            let finalPrice = base * multiplierMap[cycle];
            let showOriginal = false;
            let savings = 0;

            if (cycle === 'quarterly') {
                const original = base * 3;
                finalPrice = Math.round(original * (1 - qDiscount));
                savings = original - finalPrice;
                showOriginal = true;
                if (originalAmtEl) originalAmtEl.textContent = '$' + original.toLocaleString();
            } else if (cycle === 'yearly') {
                const original = base * 12;
                finalPrice = Math.round(original * (1 - yDiscount));
                savings = original - finalPrice;
                showOriginal = true;
                if (originalAmtEl) originalAmtEl.textContent = '$' + original.toLocaleString();
            }

            amountEl.textContent = finalPrice.toLocaleString();
            periodEl.textContent = periodMap[cycle];
            if (originalEl) originalEl.style.display = showOriginal ? 'block' : 'none';
            if (savingsEl) savingsEl.textContent = showOriginal ? 'You save $' + savings.toLocaleString() : '';
        });

        ctaLinks.forEach(link => {
            link.href = link.dataset.baseHref + '?billing_cycle=' + cycle;
        });
    }

    const activeBtn = toggle.querySelector('.billing-opt.active');
    if (activeBtn) updateSlider(activeBtn);

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            this.style.color = '#0f172a';
            buttons.forEach(b => { if (!b.classList.contains('active')) b.style.color = '#64748b'; });
            updateSlider(this);
            updatePrices(this.dataset.cycle);
        });
    });

    window.addEventListener('resize', () => {
        const active = toggle.querySelector('.billing-opt.active');
        if (active) updateSlider(active);
    });
});
</script>
@endpush
