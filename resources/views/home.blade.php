@extends('layouts.app')
@section('title', 'MMMS — Find Your Perfect Life Partner in Bangladesh')
@push('styles')
<style>
/* ─── HERO ─── */
.hero {
    min-height: 100vh; position: relative; overflow: hidden;
    background: linear-gradient(140deg, #B5341A 0%, #7D1F3A 45%, #3A0F30 80%, #1E0A20 100%);
    display: flex; align-items: center;
}
.hero::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.045) 1px, transparent 1px);
    background-size: 28px 28px;
}
.hero::after {
    content: ''; position: absolute; right: -10%; bottom: -10%;
    width: 55vw; height: 55vw; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.04);
    pointer-events: none;
}
.hero-ring {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.05); pointer-events: none;
}
.hero-ring-1 { width: 600px; height: 600px; right: 5%; top: 50%; transform: translateY(-50%); }
.hero-ring-2 { width: 900px; height: 900px; right: -5%; top: 50%; transform: translateY(-50%); }
.hero-content { position: relative; z-index: 1; max-width: 640px; }
.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
    padding: 5px 14px; border-radius: 20px; margin-bottom: 28px;
    font-size: .78rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: rgba(255,255,255,.8);
}
.hero-eyebrow-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); flex-shrink:0; animation: pulse 2s ease infinite; }
@keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:.4;} }
.hero-title {
    font-family: 'Playfair Display', serif; font-size: clamp(2.6rem, 5vw, 4rem);
    font-weight: 700; color: #fff; line-height: 1.12; margin-bottom: 22px;
    text-wrap: balance;
}
.hero-title em { font-style: italic; color: var(--gold-light, #F0C865); }
.hero-subtitle { font-size: 1.05rem; color: rgba(255,255,255,.72); line-height: 1.7; margin-bottom: 36px; max-width: 520px; }
.hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 52px; }
.btn-hero-primary {
    padding: 14px 32px; background: #fff; color: var(--brand);
    border-radius: 10px; font-weight: 700; font-size: .95rem; text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 20px rgba(0,0,0,.2);
}
.btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(0,0,0,.3); }
.btn-hero-outline {
    padding: 14px 28px; border: 1.5px solid rgba(255,255,255,.4);
    border-radius: 10px; font-weight: 600; font-size: .95rem; color: #fff; text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    transition: background .2s, border-color .2s;
}
.btn-hero-outline:hover { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.7); }
.hero-trust { display: flex; flex-wrap:wrap; gap: 24px; }
.hero-trust-item { display: flex; align-items: center; gap: 8px; font-size: .82rem; color: rgba(255,255,255,.6); }
.hero-trust-item i { color: var(--gold); }
.hero-scroll {
    position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%);
    width: 30px; height: 48px; border: 2px solid rgba(255,255,255,.25);
    border-radius: 15px; display: flex; justify-content: center; padding-top: 8px;
}
.hero-scroll::after {
    content: ''; width: 4px; height: 8px; background: rgba(255,255,255,.5);
    border-radius: 2px; animation: scrollDown 2s ease infinite;
}
@keyframes scrollDown { 0%{opacity:1;transform:translateY(0);} 80%{opacity:0;transform:translateY(12px);} 100%{opacity:0;transform:translateY(0);} }

/* ─── STATS ─── */
.stats-strip {
    background: var(--surface); border-bottom: 1px solid var(--border);
}
.stats-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 0; divide-x: 1px;
}
.stat-item {
    padding: 32px 24px; text-align: center;
    border-right: 1px solid var(--border);
}
.stat-item:last-child { border-right: none; }
.stat-num {
    font-family: 'Playfair Display', serif; font-size: 2.4rem; font-weight: 700;
    color: var(--brand); line-height: 1; margin-bottom: 6px;
}
.stat-desc { font-size: .8rem; font-weight: 500; color: var(--text3); text-transform: uppercase; letter-spacing: .06em; }

/* ─── PROFILES GRID ─── */
.profile-card {
    border-radius: 16px; overflow: hidden; position: relative;
    aspect-ratio: 3/4; display: block; background: #1A1714;
    box-shadow: var(--sh-sm); transition: transform .3s cubic-bezier(.4,0,.2,1), box-shadow .3s;
    text-decoration: none;
}
.profile-card:hover { transform: translateY(-8px) scale(1.01); box-shadow: var(--sh-xl); }
.profile-card img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform .5s ease, opacity .3s;
}
.profile-card:hover img { transform: scale(1.06); opacity: .9; }
.profile-card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,5,2,.88) 0%, rgba(10,5,2,.35) 40%, transparent 70%);
}
.profile-card-body { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px 16px; color: #fff; }
.profile-card-name { font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 600; margin-bottom: 3px; }
.profile-card-meta { font-size: .75rem; color: rgba(255,255,255,.65); display: flex; flex-wrap: wrap; gap: 6px; align-items: center; }
.profile-card-meta span { display: flex; align-items: center; gap: 4px; }
.profile-card-actions {
    position: absolute; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(181,52,26,.88); display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 10px;
    opacity: 0; transition: opacity .25s;
}
.profile-card:hover .profile-card-actions { opacity: 1; }
.profile-card-verified {
    position: absolute; top: 12px; right: 12px;
    background: rgba(45,122,79,.9); color: #fff; border-radius: 6px;
    padding: 3px 8px; font-size: .68rem; font-weight: 700;
    display: flex; align-items: center; gap: 4px; letter-spacing: .03em;
}
.profile-card-featured {
    position: absolute; top: 12px; left: 12px;
    background: rgba(200,139,58,.95); color: #fff; border-radius: 6px;
    padding: 3px 8px; font-size: .68rem; font-weight: 700;
    display: flex; align-items: center; gap: 4px;
}
.card-action-btn {
    padding: 9px 20px; border-radius: 8px; font-size: .82rem; font-weight: 600;
    display: flex; align-items: center; gap: 7px; cursor: pointer;
    text-decoration: none; transition: transform .15s, background .15s;
    border: none; font-family: inherit;
}
.card-action-btn:hover { transform: scale(1.03); }
.card-action-btn.primary { background: #fff; color: var(--brand); }
.card-action-btn.outline { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.4); }
.card-action-btn.icon-only { width: 38px; height: 38px; padding: 0; border-radius: 50%; justify-content: center; }

/* ─── HOW IT WORKS ─── */
.how-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px; position: relative; }
.how-grid::before {
    content: ''; position: absolute; top: 32px; left: 12.5%; right: 12.5%; height: 1px;
    background: linear-gradient(90deg, transparent, var(--border), var(--border), transparent);
}
.how-step { text-align: center; padding: 0 8px; }
.how-step-num {
    width: 64px; height: 64px; border-radius: 50%;
    background: var(--surface); border: 2px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px; position: relative; z-index: 1;
    font-size: 1.2rem; color: var(--brand);
    box-shadow: var(--sh-md); transition: all .25s;
}
.how-step:hover .how-step-num { background: var(--brand); color: #fff; border-color: var(--brand); transform: scale(1.08); }
.how-step-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 600; margin-bottom: 8px; }
.how-step-desc { font-size: .875rem; color: var(--text3); line-height: 1.65; }

/* ─── PACKAGES ─── */
.plan-card {
    background: var(--surface); border: 1.5px solid var(--border);
    border-radius: 20px; padding: 32px; display: flex; flex-direction: column;
    transition: transform .25s, box-shadow .25s;
}
.plan-card:hover { transform: translateY(-6px); box-shadow: var(--sh-xl); }
.plan-card.popular { border-color: var(--brand); position: relative; }
.plan-popular-tag {
    position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
    background: var(--brand); color: #fff; padding: 4px 16px; border-radius: 20px;
    font-size: .75rem; font-weight: 700; letter-spacing: .04em; white-space: nowrap;
}
.plan-name { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 600; margin-bottom: 6px; }
.plan-desc { font-size: .85rem; color: var(--text3); margin-bottom: 20px; }
.plan-price { display: flex; align-items: baseline; gap: 4px; margin-bottom: 24px; }
.plan-price-num { font-family: 'Playfair Display', serif; font-size: 2.6rem; font-weight: 700; color: var(--brand); line-height: 1; }
.plan-price-meta { font-size: .82rem; color: var(--text4); }
.plan-features { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 28px; flex: 1; }
.plan-features li { display: flex; align-items: flex-start; gap: 9px; font-size: .875rem; color: var(--text2); }
.plan-features li i { color: var(--success); font-size: .85rem; margin-top: 2px; flex-shrink: 0; }
.plan-cta {
    padding: 12px; border-radius: 10px; text-align: center; font-weight: 700;
    font-size: .9rem; text-decoration: none; display: block; transition: all .2s;
}
.plan-cta.solid { background: var(--brand); color: #fff; }
.plan-cta.solid:hover { background: var(--brand-dark); transform: translateY(-1px); }
.plan-cta.bordered { border: 2px solid var(--brand); color: var(--brand); }
.plan-cta.bordered:hover { background: rgba(181,52,26,.06); }

/* ─── CTA BANNER ─── */
.cta-banner {
    border-radius: 24px; overflow: hidden; position: relative;
    background: linear-gradient(130deg, #B5341A 0%, #7D1F3A 60%, #3A0F30 100%);
    padding: 60px 48px;
}
.cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 24px 24px;
}
.cta-banner-inner { position: relative; z-index: 1; max-width: 520px; }
.cta-banner-title { font-family: 'Playfair Display', serif; font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; color: #fff; margin-bottom: 12px; }
.cta-banner-sub { color: rgba(255,255,255,.75); font-size: .95rem; margin-bottom: 28px; line-height: 1.7; }

@media (max-width: 900px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .how-grid { grid-template-columns: repeat(2, 1fr); }
    .how-grid::before { display: none; }
}
@media (max-width: 600px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .hero-title { font-size: 2.4rem; }
    .cta-banner { padding: 36px 24px; }
}
</style>
@endpush
@section('content')

<!-- Hero -->
<section class="hero">
    <div class="hero-ring hero-ring-1"></div>
    <div class="hero-ring hero-ring-2"></div>
    <div class="container" style="padding-top:80px; padding-bottom:80px;">
        <div class="hero-content">
            <div class="hero-eyebrow">
                <span class="hero-eyebrow-dot"></span>
                Bangladesh's Trusted Matrimonial Platform
            </div>
            <h1 class="hero-title">
                Find Your <em>Perfect</em><br>Life Partner
            </h1>
            <p class="hero-subtitle">
                Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform built for Bangladeshi values.
            </p>
            <div class="hero-actions">
                @guest
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        <i class="fas fa-heart"></i> Register Free
                    </a>
                    <a href="{{ route('search') }}" class="btn-hero-outline">
                        <i class="fas fa-search"></i> Browse Profiles
                    </a>
                @else
                    <a href="{{ route('search') }}" class="btn-hero-primary">
                        <i class="fas fa-search"></i> Browse Profiles
                    </a>
                    <a href="{{ route('member.dashboard') }}" class="btn-hero-outline">
                        <i class="fas fa-home"></i> My Dashboard
                    </a>
                @endguest
            </div>
            <div class="hero-trust">
                <div class="hero-trust-item"><i class="fas fa-shield-alt"></i> Verified Profiles</div>
                <div class="hero-trust-item"><i class="fas fa-lock"></i> Private & Secure</div>
                <div class="hero-trust-item"><i class="fas fa-headset"></i> 24/7 Support</div>
            </div>
        </div>
    </div>
    <a href="#stats" class="hero-scroll" aria-label="Scroll down"></a>
</section>

<!-- Stats -->
<div class="stats-strip" id="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-num"><span data-counter data-target="{{ $stats['total_members'] }}" data-suffix="+">{{ $stats['total_members'] }}</span></div>
                <div class="stat-desc">Registered Members</div>
            </div>
            <div class="stat-item">
                <div class="stat-num"><span data-counter data-target="{{ $stats['total_marriages'] }}" data-suffix="+">{{ $stats['total_marriages'] }}</span></div>
                <div class="stat-desc">Successful Marriages</div>
            </div>
            <div class="stat-item">
                <div class="stat-num" style="color:var(--gold)"><span data-counter data-target="100" data-suffix="%">100</span></div>
                <div class="stat-desc">Verified Profiles</div>
            </div>
            <div class="stat-item">
                <div class="stat-num" style="color:var(--success)">24/7</div>
                <div class="stat-desc">Customer Support</div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Profiles -->
@if($featuredProfiles->count() > 0)
<section class="section" style="background: var(--bg);">
    <div class="container">
        <div class="section-header">
            <div class="section-eyebrow">Hand-picked</div>
            <h2 class="section-title">Featured Profiles</h2>
            <p class="section-subtitle">Verified members actively seeking their life partner</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            @foreach($featuredProfiles as $member)
            <div class="profile-card">
                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
                <div class="profile-card-overlay"></div>
                @if($member->profile?->is_verified)
                    <div class="profile-card-verified"><i class="fas fa-check"></i> Verified</div>
                @endif
                <div class="profile-card-featured"><i class="fas fa-star"></i> Featured</div>
                <div class="profile-card-body">
                    <div class="profile-card-name">{{ $member->name }}</div>
                    <div class="profile-card-meta">
                        <span><i class="fas fa-birthday-cake"></i> {{ $member->profile?->age }} yrs</span>
                        <span><i class="fas fa-map-marker-alt"></i> {{ $member->profile?->district ?? 'BD' }}</span>
                    </div>
                </div>
                <div class="profile-card-actions">
                    <a href="{{ route('profile.show', $member) }}" class="card-action-btn primary">
                        <i class="fas fa-eye"></i> View Profile
                    </a>
                    @auth
                    <form method="POST" action="{{ route('member.interests.send', $member) }}" style="margin:0">
                        @csrf
                        <button type="submit" class="card-action-btn outline">
                            <i class="fas fa-heart"></i> Send Interest
                        </button>
                    </form>
                    @else
                    <a href="{{ route('register') }}" class="card-action-btn outline">
                        <i class="fas fa-heart"></i> Connect
                    </a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top:40px;">
            <a href="{{ route('search') }}" class="btn btn-outline btn-lg" style="display:inline-flex; align-items:center; gap:8px; padding:12px 32px; border-radius:10px; border:1.5px solid var(--brand); color:var(--brand); font-size:.95rem; font-weight:600; text-decoration:none; transition:all .2s; font-family:Inter,sans-serif;">
                View All Profiles <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- How It Works -->
<section class="section" style="background: var(--surface);">
    <div class="container">
        <div class="section-header">
            <div class="section-eyebrow">Simple Process</div>
            <h2 class="section-title">How MMMS Works</h2>
            <p class="section-subtitle">Four simple steps to finding your life partner</p>
        </div>
        <div class="how-grid">
            @foreach([
                ['fas fa-user-plus', 'Create Profile', 'Register and build your detailed profile including education, career, preferences, and photos.'],
                ['fas fa-search', 'Browse Matches', 'Search and filter thousands of verified profiles by age, location, religion, and more.'],
                ['fas fa-heart', 'Send Interest', 'Connect by sending interest requests to profiles that match your preferences.'],
                ['fas fa-ring', 'Find Your Match', 'Communicate, meet, and start your beautiful journey together.'],
            ] as [$icon, $title, $desc])
            <div class="how-step">
                <div class="how-step-num"><i class="{{ $icon }}"></i></div>
                <div class="how-step-title">{{ $title }}</div>
                <p class="how-step-desc">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Packages -->
@if($plans->count() > 0)
<section class="section" style="background: var(--bg);">
    <div class="container">
        <div class="section-header">
            <div class="section-eyebrow">Membership</div>
            <h2 class="section-title">Choose Your Plan</h2>
            <p class="section-subtitle">Start free, upgrade when you're ready</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; max-width: 900px; margin: 0 auto;">
            @foreach($plans as $plan)
            <div class="plan-card {{ $plan->is_popular ? 'popular' : '' }}">
                @if($plan->is_popular)<span class="plan-popular-tag">Most Popular</span>@endif
                <div class="plan-name">{{ $plan->name }}</div>
                <div class="plan-desc">{{ $plan->description }}</div>
                <div class="plan-price">
                    @if($plan->price == 0)
                        <span class="plan-price-num">Free</span>
                    @else
                        <span class="plan-price-num">৳{{ number_format($plan->price) }}</span>
                        <span class="plan-price-meta">/ {{ $plan->duration_days }} days</span>
                    @endif
                </div>
                @if($plan->features)
                <ul class="plan-features">
                    @foreach($plan->features as $f)
                        <li><i class="fas fa-check-circle"></i>{{ $f }}</li>
                    @endforeach
                </ul>
                @endif
                @guest
                    <a href="{{ route('register') }}" class="plan-cta {{ $plan->is_popular ? 'solid' : 'bordered' }}">Get Started</a>
                @else
                    @if($plan->price == 0)
                        <span class="plan-cta bordered" style="color:var(--text4); border-color:var(--border); cursor:default;">Current Plan</span>
                    @else
                        <a href="#" class="plan-cta {{ $plan->is_popular ? 'solid' : 'bordered' }}">Subscribe Now</a>
                    @endif
                @endguest
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
@guest
<section style="padding: 80px 0; background: var(--surface);">
    <div class="container">
        <div class="cta-banner">
            <div class="cta-banner-inner">
                <h2 class="cta-banner-title">Begin Your Journey Today</h2>
                <p class="cta-banner-sub">Create a free account and connect with thousands of verified Bangladeshi profiles who share your values.</p>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('register') }}" class="btn-hero-primary" style="font-size:.9rem; padding:12px 28px;">
                        <i class="fas fa-heart"></i> Register Free
                    </a>
                    <a href="{{ route('search') }}" class="btn-hero-outline" style="font-size:.9rem; padding:12px 24px;">
                        Browse Profiles
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endguest

@endsection
