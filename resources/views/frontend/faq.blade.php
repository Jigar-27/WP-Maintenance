@extends('layouts.frontend')

@section('title', 'FAQ')
@section('meta_description', 'Find answers to frequently asked questions about WP Maintenance premium WordPress care services.')

@section('content')
<section class="section" style="padding-top: calc(var(--space-20) + 80px)">
    <div class="container container-narrow">
        <div class="text-center mb-8" data-animate>
            <h1 class="display-md">Frequently Asked Questions</h1>
            <p class="body-lg text-muted mt-4">Everything you need to know about our premium WordPress maintenance.</p>
        </div>

        <div data-animate>
            @php
            $faqs = [
                ['What does the maintenance plan include?', 'Our plans include core WordPress updates, plugin & theme updates, daily backups, security monitoring, uptime monitoring, performance optimization, and dedicated support. Higher tiers include priority support, WooCommerce optimization, and a dedicated account manager.'],
                ['How quickly do you respond to urgent issues?', 'Startup plan clients receive a response within 24 hours. Scaleup clients get priority with 4-hour response. Enterprise clients have a dedicated manager with a 1-hour SLA for critical issues.'],
                ['Can I change my plan later?', 'Yes, you can upgrade or downgrade your plan at any time. Changes take effect at the start of your next billing cycle, and we\'ll pro-rate any differences.'],
                ['Do you offer refunds?', 'We offer a 14-day money-back guarantee for all new subscriptions. If you\'re not satisfied with our service within the first 14 days, we\'ll issue a full refund. Please review our refund policy for complete details.'],
                ['What information do you need to get started?', 'We\'ll need your WordPress admin credentials, hosting provider details, and SFTP access. All credentials are stored with bank-grade encryption. Our onboarding form guides you through each step.'],
                ['Do you work with multisite installations?', 'Yes. Our Scaleup and Enterprise plans support WordPress multisite networks. We handle network-wide updates, security scanning, and performance optimization across all sites in your network.'],
                ['How are backups handled?', 'Startup plans include weekly backups, Scaleup includes daily backups, and Enterprise includes real-time (incremental) backups. All backups are stored in geographically distributed cloud storage with 90-day retention.'],
                ['What happens when my subscription expires?', 'You will receive email reminders at 15, 10, 5, and 0 days before expiry. If not renewed, your subscription data will be securely removed from our systems.'],
                ['Can I get a custom plan?', 'Absolutely. For agencies managing 5+ sites or requiring bespoke SLAs, contact us for a tailored enterprise agreement with volume pricing.'],
            ];
            @endphp

            @foreach($faqs as $index => $faq)
            <div class="accordion-item {{ $index === 0 ? 'active' : '' }}">
                <button class="accordion-header">
                    {{ $faq[0] }}
                    <span class="material-icons-outlined accordion-icon">expand_more</span>
                </button>
                <div class="accordion-body">{{ $faq[1] }}</div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8" data-animate>
            <p class="body-lg text-muted mb-4">Still have questions?</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">Contact Our Team</a>
        </div>
    </div>
</section>
@endsection
