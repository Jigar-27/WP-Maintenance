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
.btn-primary { background: var(--lp-primary); color: white; padding: 0.875rem 2rem; border-radius: 6px; font-weight: 700; text-decoration: none; }
.btn-primary:hover { color: white; }
.btn-secondary { background: var(--lp-bg-blue); color: var(--lp-text); padding: 0.875rem 2rem; border-radius: 6px; font-weight: 700; text-decoration: none; }
.btn-secondary:hover { color: var(--lp-text); }

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
.logos-grid {
    display: flex;
    justify-content: center;
    gap: 1.75rem;
    flex-wrap: wrap;
}
.logo-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 1.05rem;
    font-weight: 700;
    color: #c4cddbff;
}
.logo-item span { font-size: 1.15rem; color: #b1bbc9; }
.logo-item strong { font-size: 1.05rem; font-weight: 700; letter-spacing: 0.01em; color: #b1bbc9; }

/* 3. Pricing */
.pricing-sec { padding: 6rem 0; text-align: center; }
.pricing-title { font-size: 2.25rem; font-weight: 800; margin-bottom: 0.75rem; color: #1e293b; }
.pricing-subtitle { font-size: 1rem; color: var(--lp-text-light); margin-bottom: 4rem; }
.pricing-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem; align-items: stretch; width: 100%; margin: 0 auto; text-align: left; }

.pr-card { 
    background: white; border: 1px solid #e2e8f0; border-radius: 28px; padding: 2.2rem 2.6rem 2rem; 
    position: relative; transition: all 0.3s ease; display: flex; flex-direction: column;
}
.pr-card.popular { 
    border: 2px solid #b45309; transform: scale(1.03); 
    box-shadow: 0 25px 50px rgba(0,0,0,0.08); 
    z-index: 10;
}
.pr-tag {
    position: absolute; top: -15px; left: 50%; transform: translateX(-50%);
    background: #8c2f1b; color: white; padding: 6px 20px; border-radius: 99px;
    font-size: 0.6875rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em;
    white-space: nowrap;
}
.pr-name { font-size: 1.33rem; font-weight: 800; color: #0f172a; margin-bottom: 0.4rem; }
.pr-desc { font-size: 0.875rem; color: #64748b; margin-bottom: 1.25rem; display: block; font-weight: 500; font-style: italic; }
.pr-price { font-size: 2.43rem; font-weight: 800; color: #0f172a; margin-bottom: 1.75rem; line-height: 1; letter-spacing: -0.01em; }
.pr-price .pr-period { font-size: 1.125rem; color: #64748b; font-weight: 500; margin-left: 4px; }

.pr-feat { list-style: none; padding: 0; margin: 0 0 2.25rem 0; display: flex; flex-direction: column; gap: 0.85rem; }
.pr-feat li { display: flex; align-items: center; gap: 12px; font-size: 0.9375rem; color: #334155; font-weight: 600;}
.pr-feat li span { color: #b45309; font-size: 1.35rem; }

.btn-secure { 
    width: 100%; border-radius: 12px; padding: 1.1rem; 
    font-weight: 800; text-decoration: none; text-align: center; 
    display: flex; align-items: center; justify-content: center; gap: 10px;
    margin-top: auto; transition: 0.2s;
    font-size: 1rem;
}
.btn-outline { border: 1.5px solid #b45309; color: #b45309; background: transparent; }
.btn-outline:hover { background: #fff7ed; color: #b45309; }
.btn-pop { background: #ea580c; color: white; border: none; box-shadow: 0 10px 25px rgba(234, 88, 12, 0.2); }
.btn-pop:hover { opacity: 0.95; color: white; }

.pr-sla { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.75rem; font-weight: 700; color: #64748b; margin-top: 1.5rem; text-decoration: none; }
.pr-sla:hover { color: #334155; }

/* 4. Trust + Stats Band */
.stats-sec { background: #f0f4ff; padding: 4.5rem 0 4.8rem; text-align: center; }
.trusted-tools { margin-bottom: 8rem; }
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
    gap: 1.75rem;
}
.trusted-item {
    font-size: 1.05rem;
    font-weight: 700;
    color: #c4cddbff;
}

.stats-flex {
    background: #dfe7f8;
    border: 1px solid #d3def5;
    border-radius: 1.8rem;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    margin-bottom: 8rem;
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
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}
.sc-partner-logo img {
    height: 85px; 
    width: auto;
    object-fit: contain;
    transition: transform 0.2s ease;
}
.sc-partner-logo a:hover img { transform: scale(1.05); }
.sc-divider { height: 1px; background: #eceff6; width: 100%; margin: 2rem auto 2rem; }
.sc-logos {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.25rem;
}
.sc-logos .sc-chip {
    border: 1px solid #f1f5f9;
    background: white;
    padding: 6px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}
.sc-logos .sc-chip:hover { border-color: #cbd5e1; transform: translateY(-2px); }
.sc-logos .sc-chip img {
    height: 28px;
    width: auto;
    object-fit: contain;
}
.sc-more {
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    color: #94a3b8;
    text-transform: uppercase;
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
.faq-list { max-width: 1000px; margin: 0 auto; display: flex; flex-direction: column; gap: 1rem; }
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
.test-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; width: 100%; margin: 0 auto; text-align: left; }
.test-card { background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); position: relative; }
.test-quote-icon { position: absolute; top: 2rem; right: 2rem; font-size: 3rem; color: #ffedd5; font-family: serif; font-weight: 800; line-height: 1; }
.test-text { font-size: 1rem; font-weight: 600; color: var(--lp-text); line-height: 1.6; margin-bottom: 2rem; position: relative; z-index: 2; }
.test-author { display: flex; align-items: center; gap: 1rem; }
.test-av { width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; object-fit: cover; }
.test-name { font-weight: 800; font-size: 0.9375rem; color: var(--lp-dark); }
.test-role { font-size: 0.75rem; font-weight: 600; color: var(--lp-text-light); }

/* Billing Toggle */
.billing-toggle-wrap { display: flex; justify-content: center; margin-bottom: 3rem; }
.billing-toggle {
    display: inline-flex; position: relative; background: #f1f5f9; border-radius: 12px; padding: 4px;
    gap: 0; border: 1px solid #e2e8f0;
}
.billing-opt {
    position: relative; z-index: 2; padding: 0.65rem 1.5rem; border: none; background: none;
    font-weight: 700; font-size: 0.875rem; color: #64748b; cursor: pointer; border-radius: 10px;
    transition: color 0.3s; display: flex; align-items: center; gap: 6px; white-space: nowrap;
}
.billing-opt.active { color: #0f172a; }
.billing-slider {
    position: absolute; top: 4px; left: 4px; height: calc(100% - 8px);
    background: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); z-index: 1;
}
.save-badge {
    background: #dcfce7; color: #16a34a; font-size: 0.65rem; font-weight: 800;
    padding: 2px 6px; border-radius: 4px; letter-spacing: 0.02em;
}
.save-badge.save-best { background: #fef3c7; color: #d97706; }

/* Original price strikethrough */
.pr-original-price {
    font-size: 1rem; color: #94a3b8; text-decoration: line-through;
    margin-top: -1rem; margin-bottom: 1rem; font-weight: 600;
}

/* ═══════════════════════════════════════════════════
   ANIMATION SYSTEM — Premium Micro-Interactions
   ═══════════════════════════════════════════════════ */

html { scroll-behavior: smooth; }

/* ── Scroll Reveal Base ── */
.reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}
.reveal.visible {
    opacity: 1;
    transform: translateY(0);
}
.reveal-left { transform: translateX(-60px) !important; }
.reveal-left.visible { transform: translateX(0) !important; }
.reveal-right { transform: translateX(60px) !important; }
.reveal-right.visible { transform: translateX(0) !important; }
.reveal-scale { transform: scale(0.85) !important; }
.reveal-scale.visible { transform: scale(1) !important; }

/* Stagger children */
.stagger > .reveal:nth-child(1) { transition-delay: 0s; }
.stagger > .reveal:nth-child(2) { transition-delay: 0.1s; }
.stagger > .reveal:nth-child(3) { transition-delay: 0.2s; }
.stagger > .reveal:nth-child(4) { transition-delay: 0.3s; }
.stagger > .reveal:nth-child(5) { transition-delay: 0.4s; }

/* ── Hero Text Cascade ── */
@keyframes heroTextReveal {
    0% { opacity: 0; transform: translateY(30px) rotateX(15deg); filter: blur(8px); }
    100% { opacity: 1; transform: translateY(0) rotateX(0deg); filter: blur(0); }
}
@keyframes heroPillPop {
    0% { opacity: 0; transform: scale(0.7) translateY(10px); }
    60% { transform: scale(1.08) translateY(0); }
    100% { opacity: 1; transform: scale(1) translateY(0); }
}
@keyframes pulseRing {
    0% { box-shadow: 0 0 0 0 rgba(234, 88, 12, 0.4); }
    70% { box-shadow: 0 0 0 12px rgba(234, 88, 12, 0); }
    100% { box-shadow: 0 0 0 0 rgba(234, 88, 12, 0); }
}
.hero-pill { animation: heroPillPop 0.7s 0.1s cubic-bezier(0.34, 1.56, 0.64, 1) both; }
.hero-title { animation: heroTextReveal 0.9s 0.3s cubic-bezier(0.16, 1, 0.3, 1) both; perspective: 600px; }
.hero-desc { animation: heroTextReveal 0.9s 0.5s cubic-bezier(0.16, 1, 0.3, 1) both; }
.hero-disclaimer { animation: heroTextReveal 0.9s 0.65s cubic-bezier(0.16, 1, 0.3, 1) both; }
.hero-btn-group { animation: heroTextReveal 0.9s 0.8s cubic-bezier(0.16, 1, 0.3, 1) both; }
.btn-primary { animation: pulseRing 2s 2s infinite; }

/* ── Hero Image 3D Tilt ── */
@keyframes heroImgEntrance {
    0% { opacity: 0; transform: scale(0.88) rotateY(-8deg) translateX(40px); }
    100% { opacity: 1; transform: scale(1) rotateY(0deg) translateX(0); }
}
.hero-img-box {
    animation: heroImgEntrance 1.1s 0.4s cubic-bezier(0.16, 1, 0.3, 1) both;
    transition: transform 0.4s cubic-bezier(0.03, 0.98, 0.52, 0.99), box-shadow 0.4s ease;
    transform-style: preserve-3d;
    will-change: transform;
}

/* ── Floating Badge Bounce ── */
@keyframes badgeBounce {
    0% { opacity: 0; transform: translateY(20px) scale(0.8); }
    60% { transform: translateY(-4px) scale(1.04); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes badgeFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
.hero-floating-badge {
    animation: badgeBounce 0.7s 1.3s cubic-bezier(0.34, 1.56, 0.64, 1) both,
               badgeFloat 3s 2.5s ease-in-out infinite;
}

/* ── Floating Gradient Orbs ── */
@keyframes orbFloat1 {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -20px) scale(1.1); }
    66% { transform: translate(-20px, 15px) scale(0.95); }
}
@keyframes orbFloat2 {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(-25px, 25px) scale(0.9); }
    66% { transform: translate(35px, -10px) scale(1.05); }
}
.hero-sec { position: relative; overflow: hidden; }
.hero-sec::before,
.hero-sec::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.15;
    pointer-events: none;
    z-index: 0;
}
.hero-sec::before {
    width: 500px; height: 500px;
    background: radial-gradient(circle, #ea580c, transparent 70%);
    top: -100px; right: -100px;
    animation: orbFloat1 12s ease-in-out infinite;
}
.hero-sec::after {
    width: 400px; height: 400px;
    background: radial-gradient(circle, #3b82f6, transparent 70%);
    bottom: -80px; left: -60px;
    animation: orbFloat2 15s ease-in-out infinite;
}
.hero-grid { position: relative; z-index: 1; }

/* ── Logo Strip Shimmer ── */
@keyframes shimmerSlide {
    0% { background-position: -200% center; }
    100% { background-position: 200% center; }
}
.logos-sec .logo-item strong {
    background: linear-gradient(90deg, #b1bbc9 30%, #64748b 50%, #b1bbc9 70%);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: shimmerSlide 4s linear infinite;
}

/* ── Pricing Card Enhancements ── */
.pr-card {
    transition: all 0.5s cubic-bezier(0.03, 0.98, 0.52, 0.99);
    transform-style: preserve-3d;
    will-change: transform;
}
.pr-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.03);
}
.pr-card.popular:hover {
    transform: scale(1.03) translateY(-8px);
}

/* Price number morphing */
.pr-amount {
    display: inline-block;
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.pr-amount.morphing {
    transform: scale(1.15);
}

/* ── Stats Counter Glow ── */
@keyframes counterPulse {
    0%, 100% { text-shadow: 0 0 0px transparent; }
    50% { text-shadow: 0 0 20px rgba(234, 88, 12, 0.15); }
}
.stat-num.counted { animation: counterPulse 2s ease-in-out; }

/* ── FAQ Smooth Accordion ── */
.faq-a {
    display: block !important;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.5s cubic-bezier(0.16, 1, 0.3, 1),
                opacity 0.4s ease,
                margin 0.4s ease;
    margin-top: 0;
}
.faq-item.active .faq-a {
    max-height: 200px;
    opacity: 1;
    margin-top: 1rem;
}

/* ── Testimonial Cards ── */
@keyframes testimonialFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}
.test-card {
    transition: all 0.4s cubic-bezier(0.03, 0.98, 0.52, 0.99);
}
.test-card:hover {
    transform: translateY(-6px) rotate(-0.5deg);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
}

/* ── Button Hover Glow ── */
.btn-primary {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}
.btn-primary::after {
    content: '';
    position: absolute;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.2), transparent 60%);
    opacity: 0;
    transition: opacity 0.3s;
    pointer-events: none;
}
.btn-primary:hover::after { opacity: 1; }
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 88, 12, 0.35);
}
.btn-secondary {
    transition: transform 0.3s, background 0.3s;
}
.btn-secondary:hover {
    transform: translateY(-2px);
    background: #e2e8f0;
}

/* ── Cursor Glow (hero only) ── */
.hero-glow {
    position: absolute;
    width: 350px; height: 350px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(234, 88, 12, 0.08), transparent 70%);
    pointer-events: none;
    z-index: 0;
    opacity: 0;
    transition: opacity 0.4s;
    transform: translate(-50%, -50%);
    will-change: left, top;
}
.hero-sec:hover .hero-glow { opacity: 1; }

/* ── Billing Toggle Animation ── */
.billing-toggle-wrap {
    animation: heroTextReveal 0.9s 0.3s cubic-bezier(0.16, 1, 0.3, 1) both;
}

/* ═══════════════════════════════════════════════════
   ADVANCED ANIMATIONS — Level 2
   ═══════════════════════════════════════════════════ */

/* ── Scroll Progress Bar ── */
.scroll-progress {
    position: fixed; top: 0; left: 0; height: 3px; z-index: 9999;
    background: linear-gradient(90deg, #ea580c, #f59e0b, #ea580c);
    background-size: 200% 100%;
    animation: gradientShift 3s linear infinite;
    width: 0%; transition: none;
    box-shadow: 0 0 8px rgba(234, 88, 12, 0.4);
}
@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    100% { background-position: 200% 50%; }
}

/* ── Hero Particle Canvas ── */
.hero-particles {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%;
    pointer-events: none; z-index: 0;
}

/* ── Card Spotlight feature removed per user request ── */

/* ── Magnetic Buttons ── */
.btn-magnetic {
    transition: transform 0.2s cubic-bezier(0.03, 0.98, 0.52, 0.99);
    will-change: transform;
}

/* ── Button Ripple ── */
.btn-ripple { position: relative; overflow: hidden; }
.btn-ripple .ripple-ring {
    position: absolute; border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: scale(0); animation: rippleExpand 0.6s ease-out;
    pointer-events: none;
}
@keyframes rippleExpand {
    to { transform: scale(4); opacity: 0; }
}

/* ── Infinite Logo Marquee ── */
.logos-marquee-track {
    display: flex; gap: 3rem; width: max-content;
    animation: marqueeScroll 20s linear infinite;
}
@keyframes marqueeScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.logos-marquee-track:hover { animation-play-state: paused; }

/* ── Text Scramble ── */
.scramble-text {
    display: inline-block;
    font-family: 'Courier New', monospace;
    letter-spacing: 0.05em;
}

/* ── Section Wavy Dividers ── */
.wave-divider {
    position: relative; overflow: hidden; height: 60px;
    margin-top: -1px;
}
.wave-divider svg {
    position: absolute; bottom: 0; width: 100%; height: 100%;
}

/* ── Parallax Layer ── */
[data-parallax] {
    will-change: transform;
    transition: transform 0.1s linear;
}

/* ── Stats Highlight Beam ── */
@keyframes beamSweep {
    0% { left: -30%; }
    100% { left: 130%; }
}
.stats-flex { position: relative; overflow: hidden; }
.stats-flex::after {
    content: '';
    position: absolute; top: 0; width: 30%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
    animation: beamSweep 4s 1s ease-in-out infinite;
    pointer-events: none;
}

/* ── Enhanced FAQ Interaction ── */
.faq-item {
    transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s;
}
.faq-item:hover {
    border-color: #ea580c;
    box-shadow: 0 4px 15px rgba(234, 88, 12, 0.06);
    transform: translateX(4px);
}
.faq-item.active {
    border-color: #ea580c;
    background: linear-gradient(135deg, #fffbf5, #ffffff);
}

/* ── Testimonial Quote Glow ── */
.test-card::before {
    content: '';
    position: absolute; top: -50%; right: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(234, 88, 12, 0.03), transparent 60%);
    opacity: 0; transition: opacity 0.5s;
    pointer-events: none;
}
.test-card:hover::before { opacity: 1; }

/* ── Hero Title Word Highlight ── */
.hero-title .word-highlight {
    display: inline-block;
    background: linear-gradient(135deg, #ea580c, #f59e0b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── Stats Icon Spin on Hover ── */
.stat-item:hover .stat-icon {
    animation: iconBounce 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}
@keyframes iconBounce {
    0% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.3) rotate(-10deg); }
    100% { transform: scale(1) rotate(0deg); }
}

/* Pricing Card Popular Glow Removed */
/* ═══════════════════════════════════════════════════
   ADVANCED ANIMATIONS — Level 5 (Physics & Interactivity)
   ═══════════════════════════════════════════════════ */

/* ── Custom Spring Cursor ── */
body, a, button { cursor: none !important; }
#magic-cursor {
    position: fixed; top: 0; left: 0; width: 40px; height: 40px;
    border: 1px solid rgba(234, 88, 12, 0.4);
    border-radius: 50%; pointer-events: none; z-index: 10000;
    transform: translate(-50%, -50%);
    transition: width 0.3s, height 0.3s, border-color 0.3s, background-color 0.3s;
    mix-blend-mode: exclusion;
}
#magic-pointer {
    position: fixed; top: 0; left: 0; width: 8px; height: 8px;
    background: #ea580c; border-radius: 50%; pointer-events: none; z-index: 10001;
    transform: translate(-50%, -50%);
    transition: transform 0.1s;
}
.cursor-hover #magic-cursor {
    width: 60px; height: 60px; background-color: rgba(234, 88, 12, 0.1); border-color: transparent;
}
.cursor-hover #magic-pointer { transform: translate(-50%, -50%) scale(0.5); }

/* ── Cinematic Noise Overlay ── */
.noise-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    pointer-events: none; z-index: 9998; opacity: 0.04;
    background: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.85" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E');
}

/* ── Scroll Skew Wrapper ── */
.skew-wrapper {
    width: 100%; overflow: hidden;
    will-change: transform;
}
.skew-container {
    will-change: transform;
    transform-origin: 50% 50%;
}

</style>
@endpush

@section('content')
<div id="magic-cursor"></div>
<div id="magic-pointer"></div>
<div class="noise-overlay"></div>

<div class="skew-wrapper">
<div class="skew-container" id="skewContainer">
<div class="landing-wrap">
    {{-- Scroll Progress Bar --}}
    <div class="scroll-progress" id="scrollProgress"></div>

    {{-- 1. Hero --}}
    <section class="hero-sec">
        <canvas class="hero-particles" id="heroParticles"></canvas>
        <div class="hero-glow" id="heroGlow"></div>
        <div class="lp-container">
            <div class="hero-grid">
                <div>
                    <div class="hero-pill">24/7 System Expertise</div>
                    <h1 class="hero-title">AI is <span class="word-highlight">Chaotic.</span><br>Your WordPress<br>Foundation<br>Shouldn't Be.</h1>
                    <p class="hero-desc">A slow website doesn't just block you, it costs you. Protect your ROI with a lightning-fast, highly-secure WordPress instance.</p>
                    <div class="hero-disclaimer">* No hidden fees. Cancel anytime. Expert 24/7 emergency support.</div>
                    <div class="hero-btn-group">
                        <a href="#pricing" class="btn-primary btn-magnetic btn-ripple">Explore Plans</a>
                        <a href="{{ route('contact') }}" class="btn-secondary btn-magnetic">Contact Us</a>
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

    {{-- Wave Divider --}}
    <div class="wave-divider" style="background:#f3f6fc;">
        <svg viewBox="0 0 1200 60" preserveAspectRatio="none"><path d="M0,60 C300,0 900,0 1200,60 L1200,60 L0,60 Z" fill="#ffffff"/></svg>
    </div>

    {{-- 2. Logos — Infinite Marquee --}}
    <section class="logos-sec reveal" style="overflow:hidden;">
        <div class="lp-container">
            <div class="logos-title">Powered by Global Infrastructure</div>
            <div style="overflow:hidden; mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">
                <div class="logos-marquee-track">
                    <div class="logo-item"><span class="material-icons-outlined">cloud</span><strong>Google Cloud</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">radio_button_unchecked</span><strong>AWS</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">cloud_queue</span><strong>Cloudflare</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">verified_user</span><strong>PCI DSS</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">security</span><strong>ISO 27001</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">dns</span><strong>DigitalOcean</strong></div>
                    {{-- Duplicate for seamless loop --}}
                    <div class="logo-item"><span class="material-icons-outlined">cloud</span><strong>Google Cloud</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">radio_button_unchecked</span><strong>AWS</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">cloud_queue</span><strong>Cloudflare</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">verified_user</span><strong>PCI DSS</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">security</span><strong>ISO 27001</strong></div>
                    <div class="logo-item"><span class="material-icons-outlined">dns</span><strong>DigitalOcean</strong></div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Pricing --}}
    <section class="pricing-sec" id="pricing">
        <div class="lp-container">
            <h2 class="pricing-title reveal">Simple, Transparent Investment</h2>
            <p class="pricing-subtitle reveal">Choose the package that scales with your business. No hidden fees, ever.</p>

            {{-- Billing Cycle Toggle --}}
            <div class="billing-toggle-wrap">
                <div class="billing-toggle" id="billingToggle">
                    <button type="button" class="billing-opt active" data-cycle="monthly">Monthly</button>
                    <button type="button" class="billing-opt" data-cycle="quarterly">
                        Quarterly <span class="save-badge">Save {{ (int)($plans->first()->quarterly_discount ?? 10) }}%</span>
                    </button>
                    <button type="button" class="billing-opt" data-cycle="yearly">
                        Yearly <span class="save-badge save-best">Save {{ (int)($plans->first()->yearly_discount ?? 20) }}%</span>
                    </button>
                    <div class="billing-slider" id="billingSlider"></div>
                </div>
            </div>

            <div class="pricing-grid stagger reveal">
                @foreach($plans as $plan)
                    <div class="pr-card {{ $plan->is_popular ? 'popular' : '' }}">
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
                        <div class="pr-original-price" style="display:none;">
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
                        <a href="https://example.com/sla" class="pr-sla" target="_blank">
                            Service-level agreement <span class="material-icons-outlined" style="font-size: 0.8125rem;">open_in_new</span>
                        </a>
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

            <div class="stats-flex reveal reveal-scale">
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">speed</span>
                    <div class="stat-num" data-count="99.9" data-suffix="%">0%</div>
                    <div class="stat-label">Uptime Maintained</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">verified_user</span>
                    <div class="stat-num" data-count="{{ $totalSitesMonitored ?? 0 }}" data-suffix="+">0+</div>
                    <div class="stat-label">Sites Monitored</div>
                </div>
                <div class="stat-item">
                    <span class="material-icons-outlined stat-icon">bolt</span>
                    <div class="stat-num" data-count="{{ $activeSubs ?? 0 }}" data-suffix="+">0+</div>
                    <div class="stat-label">Active Subscriptions</div>
                </div>
            </div>
            
            <div class="stats-card reveal">
                <div class="sc-top">
                    <span class="material-icons-outlined">verified</span>
                    Secure Encrypted Checkout
                </div>
                <span class="sc-bot">Trusted Payment Partner</span>
                <div class="sc-partner-logo">
                    <a href="https://razorpay.com" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('images/razorpay_logo.png') }}" alt="Razorpay">
                    </a>
                </div>
                <div class="sc-divider"></div>
                <div class="sc-logos">
                    <a href="https://visa.com" target="_blank" rel="noopener noreferrer" class="sc-chip">
                        <img src="{{ asset('images/visa_logo.png') }}" alt="Visa">
                    </a>
                    <a href="https://mastercard.com" target="_blank" rel="noopener noreferrer" class="sc-chip">
                        <img src="{{ asset('images/mc_logo.png') }}" alt="Mastercard">
                    </a>
                    <span class="sc-more">&amp; MORE</span>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. FAQ --}}
    <section class="faq-sec">
        <div class="lp-container">
            <div class="faq-head reveal">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-sub">Everything you need to know about our services, billing, and support process.</p>
            </div>
            <div class="faq-list stagger">
                <div class="faq-item active reveal" onclick="this.classList.toggle('active')">
                    <div class="faq-q">
                        What does a maintenance plan actually cover?
                        <span class="material-icons-outlined faq-icon">expand_more</span>
                    </div>
                    <div class="faq-a">
                        Our standard maintenance encompasses daily backups, theme & plugin updates, security monitoring, performance tuning, and access to our emergency hotfix team. All tasks are meticulously tracked and included in your monthly report.
                    </div>
                </div>
                <div class="faq-item reveal" onclick="this.classList.toggle('active')">
                    <div class="faq-q">
                        How fast is your response time?
                        <span class="material-icons-outlined faq-icon">expand_more</span>
                    </div>
                    <div class="faq-a">
                        Our standard SLA is less than 24 hours for normal requests. Agency and Enterprise partners typically see response and resolution times well under 2 hours.
                    </div>
                </div>
                <div class="faq-item reveal" onclick="this.classList.toggle('active')">
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
            <h2 class="test-title reveal">Loved by Agency Owners.</h2>
            <div class="test-grid stagger">
                <div class="test-card reveal reveal-left">
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
                
                <div class="test-card reveal reveal-right">
                    <div class="test-quote-icon">&ldquo;</div>
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
</div> <!-- skew-container -->
</div> <!-- skew-wrapper -->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ═══════════════════════════════════════════════
    // 1. SCROLL REVEAL — IntersectionObserver
    // ═══════════════════════════════════════════════
    const revealEls = document.querySelectorAll('.reveal');
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(el => revealObs.observe(el));

    // ═══════════════════════════════════════════════
    // 2. ANIMATED COUNTERS — Stats numbers
    // ═══════════════════════════════════════════════
    const statNums = document.querySelectorAll('.stat-num[data-count]');
    let statsCounted = false;
    const statsObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !statsCounted) {
                statsCounted = true;
                statNums.forEach(el => animateCounter(el));
            }
        });
    }, { threshold: 0.5 });
    const statsSection = document.querySelector('.stats-flex');
    if (statsSection) statsObs.observe(statsSection);

    function animateCounter(el) {
        const target = parseFloat(el.dataset.count);
        const suffix = el.dataset.suffix || '';
        const isDecimal = String(target).includes('.');
        const duration = 2000;
        const start = performance.now();

        function tick(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            // Ease out cubic
            const ease = 1 - Math.pow(1 - progress, 3);
            const current = target * ease;
            el.textContent = (isDecimal ? current.toFixed(1) : Math.round(current)) + suffix;
            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                el.classList.add('counted');
            }
        }
        requestAnimationFrame(tick);
    }

    // ═══════════════════════════════════════════════
    // 3. HERO IMAGE 3D PARALLAX TILT
    // ═══════════════════════════════════════════════
    const heroBox = document.querySelector('.hero-img-box');
    const heroSec = document.querySelector('.hero-sec');
    if (heroBox && heroSec) {
        heroSec.addEventListener('mousemove', (e) => {
            const rect = heroBox.getBoundingClientRect();
            const cx = rect.left + rect.width / 2;
            const cy = rect.top + rect.height / 2;
            const dx = (e.clientX - cx) / rect.width;
            const dy = (e.clientY - cy) / rect.height;
            const rotateY = dx * 8;
            const rotateX = -dy * 6;
            heroBox.style.transform = `perspective(800px) rotateY(${rotateY}deg) rotateX(${rotateX}deg) scale(1.02)`;
            heroBox.style.boxShadow = `${-rotateY * 2}px ${rotateX * 2}px 40px rgba(15, 23, 42, 0.15)`;
        });
        heroSec.addEventListener('mouseleave', () => {
            heroBox.style.transform = 'perspective(800px) rotateY(0deg) rotateX(0deg) scale(1)';
            heroBox.style.boxShadow = '0 20px 40px rgba(15, 23, 42, 0.15)';
        });
    }

    // ═══════════════════════════════════════════════
    // 4. CURSOR GLOW — Follows mouse in hero
    // ═══════════════════════════════════════════════
    const glow = document.getElementById('heroGlow');
    if (glow && heroSec) {
        heroSec.addEventListener('mousemove', (e) => {
            const rect = heroSec.getBoundingClientRect();
            glow.style.left = (e.clientX - rect.left) + 'px';
            glow.style.top = (e.clientY - rect.top) + 'px';
        });
    }

    // ═══════════════════════════════════════════════
    // 5. PRICING CARD 3D MICRO-TILT
    // ═══════════════════════════════════════════════
    document.querySelectorAll('.pr-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            const isPopular = card.classList.contains('popular');
            const base = isPopular ? 'scale(1.03) ' : '';
            card.style.transform = `${base}translateY(-8px) rotateY(${x * 5}deg) rotateX(${-y * 5}deg)`;
        });
        card.addEventListener('mouseleave', () => {
            const isPopular = card.classList.contains('popular');
            card.style.transform = isPopular ? 'scale(1.03)' : '';
        });
    });

    // ═══════════════════════════════════════════════
    // 6. BILLING TOGGLE + PRICE MORPHING
    // ═══════════════════════════════════════════════
    const toggle = document.getElementById('billingToggle');
    const slider = document.getElementById('billingSlider');
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

            // Morph animation
            amountEl.classList.add('morphing');
            setTimeout(() => {
                amountEl.textContent = finalPrice.toLocaleString();
                periodEl.textContent = periodMap[cycle];
                setTimeout(() => amountEl.classList.remove('morphing'), 200);
            }, 150);

            if (originalEl) {
                originalEl.style.display = showOriginal ? 'block' : 'none';
            }
            if (savingsEl) {
                savingsEl.textContent = showOriginal ? 'You save $' + savings.toLocaleString() : '';
            }
        });

        ctaLinks.forEach(link => {
            link.href = link.dataset.baseHref + '?billing_cycle=' + cycle;
        });
    }

    // Init slider
    const activeBtn = toggle.querySelector('.billing-opt.active');
    if (activeBtn) updateSlider(activeBtn);

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            updateSlider(this);
            updatePrices(this.dataset.cycle);
        });
    });

    window.addEventListener('resize', () => {
        const active = toggle.querySelector('.billing-opt.active');
        if (active) updateSlider(active);
    });

    // ═══════════════════════════════════════════════
    // 7. SMOOTH SCROLL for anchor links
    // ═══════════════════════════════════════════════
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', (e) => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ═══════════════════════════════════════════════
    // 8. PARTICLE FIELD — Canvas-based hero particles
    // ═══════════════════════════════════════════════
    // ═══════════════════════════════════════════════
    // 8. LEVEL 6: WebGL Fragment Shader Background
    // ═══════════════════════════════════════════════
    const canvas = document.getElementById('heroParticles');
    if (canvas) {
        const gl = canvas.getContext('webgl');
        if (gl) {
            function resizeCanvas() {
                canvas.width = canvas.parentElement.offsetWidth;
                canvas.height = canvas.parentElement.offsetHeight;
                gl.viewport(0, 0, canvas.width, canvas.height);
            }
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            const vsSource = `
                attribute vec4 aVertexPosition;
                void main() {
                    gl_Position = aVertexPosition;
                }
            `;
            // Advanced Liquid Noise Shader
            const fsSource = `
                precision highp float;
                uniform vec2 u_resolution;
                uniform float u_time;
                uniform vec2 u_mouse;

                // Hash function for noise
                float hash(vec2 p) { return fract(1e4 * sin(17.0 * p.x + p.y * 0.1) * (0.1 + abs(sin(p.y * 13.0 + p.x)))); }
                // 2D Noise
                float noise(vec2 x) {
                    vec2 i = floor(x); vec2 f = fract(x);
                    float a = hash(i); float b = hash(i + vec2(1.0, 0.0));
                    float c = hash(i + vec2(0.0, 1.0)); float d = hash(i + vec2(1.0, 1.0));
                    vec2 u = f * f * (3.0 - 2.0 * f);
                    return mix(a, b, u.x) + (c - a) * u.y * (1.0 - u.x) + (d - b) * u.x * u.y;
                }

                void main() {
                    vec2 st = gl_FragCoord.xy / u_resolution.xy;
                    st.x *= u_resolution.x / u_resolution.y;

                    vec2 mouseTarget = u_mouse / u_resolution;
                    mouseTarget.x *= u_resolution.x / u_resolution.y;
                    mouseTarget.y = 1.0 - mouseTarget.y;

                    // Mouse distort effect
                    float dist = distance(st, mouseTarget);
                    vec2 warp = st + vec2(noise(st * 3.0 + u_time * 0.2)) * 0.2;
                    warp += (st - mouseTarget) * (0.05 / (dist + 0.1));

                    float n = noise(warp * 4.0 - u_time * 0.5);
                    
                    // Brand Colors: #ea580c (Orange), #0f172a (Slate Dark), #f8fafc (Light slate)
                    // We blend an ambient liquid organic shape
                    vec3 col1 = vec3(234.0/255.0, 88.0/255.0, 12.0/255.0); // primary
                    vec3 col2 = vec3(245.0/255.0, 158.0/255.0, 11.0/255.0); // amber
                    vec3 col3 = vec3(1.0, 1.0, 1.0);

                    // Masked to the bottom/right mostly
                    float opacityMask = smoothstep(0.4, 1.0, st.x) * smoothstep(0.8, 0.0, st.y);
                    
                    vec3 finalColor = mix(col3, mix(col1, col2, noise(warp * 10.0)), n);
                    
                    // Output with very low alpha to act as a watermark ambient effect
                    gl_FragColor = vec4(finalColor, n * opacityMask * 0.15);
                }
            `;

            function createShader(gl, type, source) {
                const shader = gl.createShader(type);
                gl.shaderSource(shader, source);
                gl.compileShader(shader);
                if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                    console.error('Shader parsing error:', gl.getShaderInfoLog(shader));
                    gl.deleteShader(shader);
                    return null;
                }
                return shader;
            }

            const vertexShader = createShader(gl, gl.VERTEX_SHADER, vsSource);
            const fragmentShader = createShader(gl, gl.FRAGMENT_SHADER, fsSource);

            const shaderProgram = gl.createProgram();
            gl.attachShader(shaderProgram, vertexShader);
            gl.attachShader(shaderProgram, fragmentShader);
            gl.linkProgram(shaderProgram);
            gl.useProgram(shaderProgram);

            // Fullscreen quad
            const positionBuffer = gl.createBuffer();
            gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);
            gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1.0, 1.0, 1.0, 1.0, -1.0, -1.0, 1.0, -1.0]), gl.STATIC_DRAW);

            const positionLocation = gl.getAttribLocation(shaderProgram, "aVertexPosition");
            gl.enableVertexAttribArray(positionLocation);
            gl.vertexAttribPointer(positionLocation, 2, gl.FLOAT, false, 0, 0);

            const resLoc = gl.getUniformLocation(shaderProgram, "u_resolution");
            const timeLoc = gl.getUniformLocation(shaderProgram, "u_time");
            const mouseLoc = gl.getUniformLocation(shaderProgram, "u_mouse");

            let mouseX = -1000, mouseY = -1000;
            const heroSecEl = document.querySelector('.hero-sec');
            heroSecEl.addEventListener('mousemove', (e) => {
                const rect = canvas.getBoundingClientRect();
                mouseX = e.clientX - rect.left;
                mouseY = e.clientY - rect.top;
            });

            const startTime = performance.now();
            function render() {
                gl.uniform2f(resLoc, canvas.width, canvas.height);
                gl.uniform1f(timeLoc, (performance.now() - startTime) / 1000.0);
                gl.uniform2f(mouseLoc, mouseX, mouseY);

                gl.clear(gl.COLOR_BUFFER_BIT);
                gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
                requestAnimationFrame(render);
            }
            render();
        }
    }

    // ═══════════════════════════════════════════════
    // 9. SCROLL PROGRESS BAR
    // ═══════════════════════════════════════════════
    const progressBar = document.getElementById('scrollProgress');
    if (progressBar) {
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            progressBar.style.width = (scrollTop / docHeight * 100) + '%';
        }, { passive: true });
    }

    // ═══════════════════════════════════════════════
    // 10. MAGNETIC BUTTONS — Attract toward cursor
    // ═══════════════════════════════════════════════
    document.querySelectorAll('.btn-magnetic').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });

    // ═══════════════════════════════════════════════
    // 11. BUTTON RIPPLE EFFECT
    // ═══════════════════════════════════════════════
    document.querySelectorAll('.btn-ripple').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.className = 'ripple-ring';
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });

    // ═══════════════════════════════════════════════
    // ═══════════════════════════════════════════════
    // 12. CARD SPOTLIGHT (Removed)
    // ═══════════════════════════════════════════════

    // ═══════════════════════════════════════════════
    // 13. PARALLAX ON SCROLL
    // ═══════════════════════════════════════════════
    const parallaxEls = [
        { el: document.querySelector('.hero-img-box'), speed: 0.05 },
        { el: document.querySelector('.hero-pill'), speed: -0.03 },
    ].filter(p => p.el);

    if (parallaxEls.length) {
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            parallaxEls.forEach(({ el, speed }) => {
                el.style.transform = `translateY(${scrollY * speed}px)`;
            });
        }, { passive: true });
    }

    // ═══════════════════════════════════════════════
    // 14. TEXT SCRAMBLE — Hero pill decodes on load
    // ═══════════════════════════════════════════════
    const heroScramble = document.querySelector('.hero-pill');
    if (heroScramble) {
        const finalText = heroScramble.textContent;
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let iteration = 0;
        const scrambleInterval = setInterval(() => {
            heroScramble.textContent = finalText
                .split('')
                .map((char, i) => {
                    if (i < iteration) return finalText[i];
                    return chars[Math.floor(Math.random() * chars.length)];
                })
                .join('');
            if (iteration >= finalText.length) clearInterval(scrambleInterval);
            iteration += 1 / 2;
        }, 30);
    }

    // ═══════════════════════════════════════════════
    // 15. LEVEL 5: SPRING MAGIC CURSOR
    // ═══════════════════════════════════════════════
    const mCursor = document.getElementById('magic-cursor');
    const mPointer = document.getElementById('magic-pointer');
    let mX = window.innerWidth / 2;
    let mY = window.innerHeight / 2;
    let cX = mX;
    let cY = mY;

    if (mCursor && mPointer) {
        window.addEventListener('mousemove', (e) => {
            mX = e.clientX;
            mY = e.clientY;
            mPointer.style.left = mX + 'px';
            mPointer.style.top = mY + 'px';
        });

        function renderCursor() {
            // Spring lerp
            cX += (mX - cX) * 0.15;
            cY += (mY - cY) * 0.15;
            mCursor.style.transform = `translate(${cX - 20}px, ${cY - 20}px)`; // offset for width/2
            requestAnimationFrame(renderCursor);
        }
        renderCursor();

        // Cursor hover states
        const interactiveEls = document.querySelectorAll('a, button, .faq-item');
        interactiveEls.forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
            el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
        });
    }

    // ═══════════════════════════════════════════════
    // 16. LEVEL 5: SKEW ON SCROLL PHYSICS
    // ═══════════════════════════════════════════════
    const skewContainer = document.getElementById('skewContainer');
    if (skewContainer) {
        let currentS = 0;
        let targetS = 0;
        let velocity = 0;
        let lastScrollY = window.scrollY;
        
        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            velocity = currentScrollY - lastScrollY;
            targetS = Math.max(-10, Math.min(10, velocity * 0.04));
            lastScrollY = currentScrollY;
        }, { passive: true });

        function renderSkew() {
            targetS *= 0.9; // decay velocity
            currentS += (targetS - currentS) * 0.1; // lerp
            // Only apply transform if significant, to save GPU
            if (Math.abs(currentS) > 0.01) {
                skewContainer.style.transform = `skewY(${currentS}deg)`;
            } else {
                skewContainer.style.transform = `skewY(0deg)`;
            }
            requestAnimationFrame(renderSkew);
        }
        renderSkew();
    }

});
</script>
@endpush

