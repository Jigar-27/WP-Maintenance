@extends('layouts.frontend')

@section('title', 'Choose Your Plan')
@section('meta_description', 'Select the perfect WordPress maintenance plan for your business. Startup, Scaleup, or Enterprise — each designed to scale with your ambition.')

@section('content')
<section class="section" style="padding-top: calc(var(--space-20) + 80px)">
    <div class="container">
        <div class="text-center mb-8" data-animate>
            <div class="hero-overline" style="display:inline-flex; margin-bottom: var(--space-4)">
                <span class="pulse"></span>
                Select Your Plan
            </div>
            <h1 class="display-md">Choose the Right Plan for Your Business.</h1>
            <p class="body-lg text-muted mt-4" style="max-width:560px; margin:var(--space-4) auto 0">Three tiers designed to scale with your ambition. No hidden fees, just expert care.</p>
        </div>

        <div class="grid-3">
            @foreach($plans as $plan)
            <div class="pricing-card {{ $plan->is_popular ? 'popular' : '' }}" data-animate>
                @if($plan->is_popular)
                    <span class="pricing-badge">Most Popular</span>
                @else
                    <span class="pricing-badge">Best For: {{ $plan->best_for }}</span>
                @endif
                <div class="pricing-name">{{ $plan->name }}</div>
                <div class="pricing-price">${{ number_format($plan->price) }}<span>/mo</span></div>
                <p class="pricing-label">{{ $plan->description }}</p>

                <ul class="pricing-features">
                    @foreach($plan->features as $feature)
                    <li class="pricing-feature">
                        <span class="material-icons-outlined">check_circle</span>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('onboard', $plan->slug) }}" class="btn btn-primary btn-block">
                    Select {{ $plan->name }}
                </a>
                <a href="{{ route('terms') }}" class="btn btn-ghost" style="margin-top: var(--space-3); font-size: 0.8125rem;">
                    Service-level agreement
                    <span class="material-icons-outlined" style="font-size:1rem">open_in_new</span>
                </a>
            </div>
            @endforeach
        </div>

        {{-- Technical Specs --}}
        <div class="mt-8" data-animate>
            <div class="card" style="padding: var(--space-8)">
                <h3 class="headline-md mb-6">Technical Specifications</h3>
                <div class="data-table" style="overflow-x: auto">
                    <table class="data-table" style="min-width:600px">
                        <thead>
                            <tr>
                                <th>Feature</th>
                                <th>The Startup</th>
                                <th>The Scaleup</th>
                                <th>The Enterprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Core & Plugin Updates</td><td>Weekly</td><td>Bi-weekly</td><td>Real-time</td></tr>
                            <tr><td>Backups</td><td>Weekly</td><td>Daily</td><td>Real-time</td></tr>
                            <tr><td>Security Scanning</td><td>Basic</td><td>Advanced</td><td>Enterprise WAF</td></tr>
                            <tr><td>Uptime Monitoring</td><td>5 min interval</td><td>1 min interval</td><td>30 sec interval</td></tr>
                            <tr><td>Dev Support Hours</td><td>60 hrs</td><td>120 hrs</td><td>200 hrs</td></tr>
                            <tr><td>Response SLA</td><td>24 hours</td><td>4 hours</td><td>1 hour</td></tr>
                            <tr><td>Dedicated Manager</td><td>—</td><td>—</td><td><span class="material-icons-outlined" style="color:var(--primary-container);font-size:1.125rem">check_circle</span></td></tr>
                            <tr><td>Monthly Reports</td><td><span class="material-icons-outlined" style="color:var(--primary-container);font-size:1.125rem">check_circle</span></td><td><span class="material-icons-outlined" style="color:var(--primary-container);font-size:1.125rem">check_circle</span></td><td><span class="material-icons-outlined" style="color:var(--primary-container);font-size:1.125rem">check_circle</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
