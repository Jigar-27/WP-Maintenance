@extends('layouts.frontend')

@section('title', 'Frequently Asked Questions — WP Maintenance')
@section('meta_description', 'Everything you need to know about our premium WordPress maintenance services and how we keep your digital assets secure.')

@section('content')
<section class="section faq-page">
    <div class="fp-container">
        {{-- Hero Header --}}
        <div class="text-center faq-hero" data-animate>
            <span class="badge-accent">SUPPORT CENTER</span>
            <h1 class="display-lg">Frequently Asked <span class="text-orange">Questions</span></h1>
            <p class="body-lg text-muted hero-sub">Everything you need to know about our premium WordPress <br> maintenance services and how we keep your digital assets secure.</p>
        </div>

        <div class="faq-layout">
            {{-- Left Sidebar --}}
            <aside class="faq-sidebar" data-animate>
                {{-- Status Card --}}
                <div class="faq-card status-card">
                    <div class="card-header">
                        <span class="dot-orange"></span>
                        <h3 class="card-title">Concierge Status</h3>
                    </div>
                    <p class="card-desc">Our maintenance team is currently monitoring 1,240+ sites with a 99.9% uptime record over the last 30 days.</p>
                    <div class="avatar-stack">
                        <img src="https://ui-avatars.com/api/?name=Alex+Carter&background=FFCCBC&color=BF360C" alt="Expert 1">
                        <img src="https://ui-avatars.com/api/?name=Jamie+Doe&background=C5CAE9&color=1A237E" alt="Expert 2">
                        <img src="https://ui-avatars.com/api/?name=Sam+Smith&background=B2DFDB&color=004D40" alt="Expert 3">
                    </div>
                    <p class="card-status-text">Experts available in working hours</p>
                </div>

                {{-- Question CTA Card --}}
                <div class="faq-card cta-card">
                    <h3 class="cta-title">Still have questions?</h3>
                    <p class="cta-desc">Our dedicated custodians are here to help you navigate your maintenance needs.</p>
                    <a href="{{ route('contact') }}" class="btn-support">Contact Support</a>
                    <div class="cta-bg-icon">
                        <span class="material-icons-outlined">chat</span>
                    </div>
                </div>
            </aside>

            {{-- Right FAQ List --}}
            <div class="faq-list" data-animate>
                @php
                $faqs = [
                    ['What is WordPress maintenance?', 'WordPress maintenance is the ongoing process of keeping your website secure, updated, and performing optimally. This includes core updates, plugin and theme management, security monitoring, cloud backups, and database optimization.'],
                    ['Why do I need a maintenance plan?', 'A maintenance plan prevents security vulnerabilities, ensures your site never breaks after an update, and keeps your load times fast. It allows you to focus on your business while experts handle the technical upkeep.'],
                    ['How often do you provide reports?', 'We provide comprehensive branded reports on a weekly or monthly basis, depending on your plan. These reports detail all updates performed, security scan results, and performance metrics.'],
                    ['Do you offer a refund?', 'Yes, we offer a 14-day 100% money-back guarantee. If you are not satisfied with our service within the first two weeks, we will issue a full refund, no questions asked.'],
                    ['What is included in the Startup plan?', 'The Startup plan includes core WordPress maintenance, basic security scanning, uptime monitoring, and monthly reporting. It\'s ideal for informative websites and blogs.'],
                    ['Can I change my plan later?', 'Absolutely. You can upgrade or downgrade your plan at any time through your client dashboard. Changes to subscription tiers take effect immediately.'],
                ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div class="faq-item {{ $index === 0 ? 'active' : '' }}">
                    <button class="faq-header">
                        <span>{{ $faq[0] }}</span>
                        <span class="material-icons-outlined chevron">expand_more</span>
                    </button>
                    <div class="faq-body">
                        <div class="faq-content">
                            {{ $faq[1] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    .faq-page { background: #f8fbff; padding-top: calc(var(--space-24) + 80px); min-height: 100vh; }
    
    /* Hero Header */
    .faq-hero { margin-bottom: 5rem; }
    .badge-accent {
        display: inline-block; background: #dbeafe; color: #1e40af; 
        font-size: 0.6875rem; font-weight: 800; padding: 6px 16px; border-radius: 99px;
        letter-spacing: 0.08em; margin-bottom: 1.5rem;
    }
    .faq-hero h1 { color: #0f172a; font-weight: 850; margin-bottom: 1.5rem; letter-spacing: -0.01em; }
    .text-orange { color: #f97316; }
    .hero-sub { color: #64748b; line-height: 1.6; max-width: 700px; margin: 0 auto; font-size: 1.125rem; }

    /* Layout */
    .faq-layout { display: grid; grid-template-columns: 320px 1fr; gap: 3rem; align-items: start; }

    /* Sidebar Cards */
    .faq-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }
    .faq-card { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03); }
    
    .status-card .card-header { display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; }
    .dot-orange { width: 8px; height: 8px; background: #fbbf24; border-radius: 50%; }
    .card-title { font-size: 1rem; font-weight: 800; color: #1e293b; margin: 0; }
    .card-desc { font-size: 0.8125rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem; }
    .avatar-stack { display: flex; align-items: center; margin-bottom: 1.25rem; }
    .avatar-stack img { width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-right: -8px; }
    .card-status-text { font-size: 0.75rem; font-weight: 700; color: #f97316; margin: 0; }

    .cta-card { background: #475569; color: white; position: relative; overflow: hidden; }
    .cta-title { font-size: 1.25rem; font-weight: 800; margin-bottom: 0.75rem; position: relative; z-index: 2; }
    .cta-desc { font-size: 0.875rem; color: #cbd5e1; line-height: 1.55; margin-bottom: 1.5rem; position: relative; z-index: 2; }
    .btn-support {
        display: block; width: 100%; text-align: center; background: white; color: #1e293b;
        padding: 0.875rem; border-radius: 10px; font-weight: 750; font-size: 0.8125rem;
        text-decoration: none; transition: all 0.2s; position: relative; z-index: 2;
    }
    .btn-support:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .cta-bg-icon {
        position: absolute; right: -10px; bottom: -10px; opacity: 0.1; font-size: 6rem; color: white;
    }
    .cta-bg-icon .material-icons-outlined { font-size: 6rem; }

    /* FAQ List */
    .faq-list { display: flex; flex-direction: column; gap: 0.75rem; }
    .faq-item { background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.02); transition: all 0.3s; }
    .faq-item:hover { transform: translateY(-1px); box-shadow: 0 10px 25px rgba(15, 23, 42, 0.04); }
    
    .faq-header {
        width: 100%; display: flex; justify-content: space-between; align-items: center;
        padding: 1.5rem 2rem; background: none; border: none; cursor: pointer;
        text-align: left; font-size: 1.0625rem; font-weight: 800; color: #1e293b;
    }
    .chevron { color: #f97316; transition: transform 0.3s; font-size: 1.25rem; }
    
    .faq-body { height: 0; overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .faq-content { padding: 0 2rem 2rem 2rem; font-size: 0.9375rem; color: #64748b; line-height: 1.7; border-top: 1px solid #f1f5f9; padding-top: 1.5rem; }

    .faq-item.active { box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06); }
    .faq-item.active .chevron { transform: rotate(180deg); }
    .faq-item.active .faq-body { height: auto; }

    @media (max-width: 992px) {
        .faq-layout { grid-template-columns: 1fr; }
        .faq-sidebar { order: 2; }
        .faq-list { order: 1; }
    }
</style>

<script>
    document.querySelectorAll('.faq-header').forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const isActive = item.classList.contains('active');
            
            // Close all
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
            document.querySelectorAll('.faq-body').forEach(b => b.style.height = '0');

            if (!isActive) {
                item.classList.add('active');
                const body = item.querySelector('.faq-body');
                const content = item.querySelector('.faq-content');
                body.style.height = (content.scrollHeight + 40) + 'px'; // +40 for top padding
            }
        });
    });

    // Initialize first item
    window.addEventListener('load', () => {
        const firstActiveBody = document.querySelector('.faq-item.active .faq-body');
        const firstContent = document.querySelector('.faq-item.active .faq-content');
        if (firstActiveBody && firstContent) {
            firstActiveBody.style.height = (firstContent.scrollHeight + 40) + 'px';
        }
    });
</script>
@endsection
