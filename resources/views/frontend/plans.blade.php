@extends('layouts.frontend')

@section('title', 'Simple & Transparent Pricing')
@section('meta_description', 'Select the service level that fits your business needs. All plans include 24/7 security and monthly reporting.')

@section('content')
<section class="section" style="padding-top: calc(var(--space-24) + 100px); padding-bottom: var(--space-20);">
    <div class="fp-container">
        {{-- Hero Header --}}
        <div class="text-center mb-32" data-animate>
            <h1 class="display-lg" style="color: #010101; margin-bottom: 2rem; font-weight: 800; line-height: 1.1; font-size: 3.25rem;">Simple & Transparent <br> Pricing</h1>
            <p class="body-lg text-muted" style="max-width: 600px; margin: 0 auto; line-height: 1.6; font-size: 0.95rem;">Select the service level that fits your business needs. All plans include 24/7 security and monthly reporting.</p>
        </div>

        {{-- Billing Cycle Toggle Hidden (Only Yearly) --}}


        {{-- Pricing Grid --}}
        <div class="pricing-grid" style="padding-top: 2rem; padding-bottom: 6rem; margin-bottom: 2rem;">
            @foreach($plans as $plan)
                <div class="pr-card {{ $plan->is_popular ? 'popular' : '' }}" data-animate>
                    @if($plan->is_popular)
                        <div class="pr-tag">MOST POPULAR</div>
                    @endif

                    <div class="pr-name">{{ $plan->name }}</div>
                    <span class="pr-desc">Best For: {{ $plan->best_for ?: 'WordPress Sites' }}</span>
                    <div class="pr-price">
                            <div class="pr-price">$<span>{{ number_format($plan->price, 0) }}</span><span class="price-period">/yr</span></div>

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

                    <a href="{{ route('onboard', ['plan' => $plan->slug, 'billing_cycle' => 'yearly']) }}" class="btn-secure {{ $plan->is_popular ? 'btn-pop' : 'btn-outline' }} pr-cta-link">
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
        <div id="technical-specs" class="mb-32" data-animate style="padding-top: 4rem;">
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
                            @foreach($techFeatures as $feature)
                            <tr>
                                <td>
                                    <div class="spec-feature-name">
                                        {{ $feature->name }}
                                        @if($feature->description)
                                        <span class="material-icons-outlined spec-info-icon" title="{{ $feature->description }}">info</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($feature->startup)
                                        <span class="material-icons-outlined spec-check">check_circle</span>
                                    @else
                                        <span class="spec-null">—</span>
                                    @endif
                                </td>
                                <td class="spec-highlight">
                                    @if($feature->scaleup)
                                        <span class="material-icons-outlined spec-check">check_circle</span>
                                    @else
                                        <span class="spec-null">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($feature->enterprise)
                                        <span class="material-icons-outlined spec-check">check_circle</span>
                                    @else
                                        <span class="spec-null">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background: #f8fafc; font-weight: 900;">
                                <td style="color: #ea580c; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; padding-left: 2.5rem;">Support Hours</td>
                                @foreach($plans as $plan)
                                    <td class="{{ $plan->is_popular ? 'spec-highlight' : '' }}" style="text-align: center;">{{ $plan->dev_hours ?: 0 }} hrs</td>
                                @endforeach
                            </tr>
                        </tfoot>

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
    .btn-pop { background: #ea580c; color: white !important; border: none; box-shadow: 0 8px 18px rgba(234, 88, 12, 0.35); transition: all 0.2s ease; }
    .btn-pop:hover { color: white !important; transform: translateY(-2px); box-shadow: 0 12px 24px rgba(234, 88, 12, 0.45); }
    .btn-pop span { color: white !important; }
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
    // Plans page effects
});
</script>
@endpush
