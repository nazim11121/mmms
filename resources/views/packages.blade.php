@extends('layouts.app')
@section('title', 'Membership Packages — MMMS')
@push('styles')
<style>
.packages-hero {
    background: linear-gradient(140deg, #B5341A 0%, #7D1F3A 50%, #2C0D22 100%);
    padding: 64px 0; text-align: center; position: relative; overflow: hidden;
}
.packages-hero::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 26px 26px;
}
.packages-hero-inner { position: relative; z-index: 1; }
.packages-hero h1 { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 700; color: #fff; margin-bottom: 12px; }
.packages-hero p { color: rgba(255,255,255,.75); font-size: 1rem; max-width: 480px; margin: 0 auto; line-height: 1.7; }

.packages-section { padding: 72px 0; background: var(--bg); }

.plan-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 28px; max-width: 960px; margin: 0 auto; }

.pkg-card {
    background: var(--surface); border: 1.5px solid var(--border);
    border-radius: 20px; padding: 36px 28px; display: flex; flex-direction: column;
    position: relative; transition: transform .25s, box-shadow .25s;
}
.pkg-card:hover { transform: translateY(-7px); box-shadow: var(--sh-xl); }
.pkg-card.featured { border-color: var(--brand); }
.pkg-popular-badge {
    position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
    background: var(--brand); color: #fff; padding: 5px 18px; border-radius: 20px;
    font-size: .73rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; white-space: nowrap;
}
.pkg-plan-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 20px; }
.pkg-plan-icon.free { background: rgba(100,150,200,.12); color: #5588cc; }
.pkg-plan-icon.silver { background: rgba(150,150,160,.12); color: #8888aa; }
.pkg-plan-icon.gold { background: rgba(200,139,58,.12); color: var(--gold); }
.pkg-name { font-family: 'Playfair Display', serif; font-size: 1.25rem; font-weight: 700; color: var(--text1); margin-bottom: 6px; }
.pkg-tagline { font-size: .85rem; color: var(--text3); margin-bottom: 24px; line-height: 1.5; }
.pkg-price { margin-bottom: 28px; display: flex; align-items: baseline; gap: 4px; flex-wrap: wrap; }
.pkg-price-amount { font-family: 'Playfair Display', serif; font-size: 2.8rem; font-weight: 700; color: var(--brand); line-height: 1; }
.pkg-price-free { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--text3); }
.pkg-price-period { font-size: .83rem; color: var(--text4); align-self: flex-end; padding-bottom: 4px; }
.pkg-divider { height: 1px; background: var(--border); margin-bottom: 24px; }
.pkg-features { list-style: none; display: flex; flex-direction: column; gap: 11px; margin-bottom: 32px; flex: 1; }
.pkg-features li { display: flex; align-items: flex-start; gap: 10px; font-size: .875rem; color: var(--text2); }
.pkg-features li i { color: var(--success); font-size: .85rem; margin-top: 2px; flex-shrink: 0; }
.pkg-features li.disabled { color: var(--text4); }
.pkg-features li.disabled i { color: var(--text4); }
.pkg-cta {
    display: block; padding: 13px; text-align: center; border-radius: 12px;
    font-weight: 700; font-size: .93rem; text-decoration: none;
    transition: all .2s; font-family: inherit; cursor: pointer; border: none;
}
.pkg-cta.solid { background: var(--brand); color: #fff; box-shadow: 0 2px 12px rgba(181,52,26,.25); }
.pkg-cta.solid:hover { background: var(--brand-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(181,52,26,.35); }
.pkg-cta.outline { border: 2px solid var(--brand); color: var(--brand); }
.pkg-cta.outline:hover { background: rgba(181,52,26,.06); transform: translateY(-1px); }
.pkg-cta.muted { border: 2px solid var(--border); color: var(--text3); cursor: default; }

/* FAQ */
.faq-section { padding: 72px 0; background: var(--surface); }
.faq-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; max-width: 900px; margin: 0 auto; }
.faq-item { background: var(--bg); border: 1px solid var(--border); border-radius: 14px; padding: 22px 24px; }
.faq-q { font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 600; color: var(--text1); margin-bottom: 8px; }
.faq-a { font-size: .85rem; color: var(--text3); line-height: 1.65; }

@media (max-width: 600px) {
    .packages-hero { padding: 48px 0; }
    .plan-grid { grid-template-columns: 1fr; }
}
</style>
@endpush
@section('content')
<div class="packages-hero">
    <div class="container">
        <div class="packages-hero-inner">
            <h1>Membership Plans</h1>
            <p>Start free. Upgrade when you're serious about finding your life partner.</p>
        </div>
    </div>
</div>

<div class="packages-section">
    <div class="container">
        <div class="plan-grid">
            @foreach($plans as $plan)
            <div class="pkg-card {{ $plan->is_popular ? 'featured' : '' }}">
                @if($plan->is_popular)
                    <div class="pkg-popular-badge"><i class="fas fa-star"></i> Most Popular</div>
                @endif

                <div class="pkg-plan-icon {{ $plan->price == 0 ? 'free' : ($plan->is_popular ? 'gold' : 'silver') }}">
                    <i class="fas {{ $plan->price == 0 ? 'fa-user' : ($plan->is_popular ? 'fa-crown' : 'fa-gem') }}"></i>
                </div>
                <div class="pkg-name">{{ $plan->name }}</div>
                <div class="pkg-tagline">{{ $plan->description }}</div>

                <div class="pkg-price">
                    @if($plan->price == 0)
                        <span class="pkg-price-free">Free</span>
                        <span class="pkg-price-period">forever</span>
                    @else
                        <span class="pkg-price-amount">৳{{ number_format($plan->price) }}</span>
                        <span class="pkg-price-period">/ {{ $plan->duration_days }} days</span>
                    @endif
                </div>

                <div class="pkg-divider"></div>

                @if($plan->features)
                <ul class="pkg-features">
                    @foreach($plan->features as $f)
                    <li><i class="fas fa-check-circle"></i>{{ $f }}</li>
                    @endforeach
                </ul>
                @endif

                @guest
                    @if($plan->price == 0)
                        <a href="{{ route('register') }}" class="pkg-cta outline">Get Started Free</a>
                    @else
                        <a href="{{ route('register') }}" class="pkg-cta {{ $plan->is_popular ? 'solid' : 'outline' }}">
                            Register & Subscribe
                        </a>
                    @endif
                @else
                    @if($plan->price == 0)
                        <span class="pkg-cta muted">Basic Plan</span>
                    @else
                        <a href="#" class="pkg-cta {{ $plan->is_popular ? 'solid' : 'outline' }}">
                            Subscribe — ৳{{ number_format($plan->price) }}
                        </a>
                    @endif
                @endguest
            </div>
            @endforeach
        </div>

        <div style="text-align:center; margin-top: 40px; font-size: .875rem; color: var(--text4);">
            <i class="fas fa-shield-alt" style="color:var(--success); margin-right:6px;"></i>
            Secure payment &nbsp;·&nbsp;
            <i class="fas fa-undo" style="color:var(--success); margin-right:6px;"></i>
            Cancel anytime &nbsp;·&nbsp;
            <i class="fas fa-headset" style="color:var(--success); margin-right:6px;"></i>
            24/7 support
        </div>
    </div>
</div>

<!-- FAQ -->
<div class="faq-section">
    <div class="container">
        <div class="section-header">
            <div class="section-eyebrow">Got Questions?</div>
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>
        <div class="faq-grid">
            @foreach([
                ['Can I use MMMS for free?', 'Yes! The Free plan lets you create a profile and browse other profiles. Upgrade for messaging and advanced features.'],
                ['How do I upgrade my plan?', 'Sign in, go to your dashboard, and select your desired plan. Payment is processed securely.'],
                ['Can I cancel my subscription?', 'You can stop auto-renewal anytime from your account settings. Your plan stays active until expiry.'],
                ['Are profiles verified?', 'Yes. We review all new profiles and verify key information to ensure authenticity and safety.'],
                ['Is my personal data safe?', 'Absolutely. We use SSL encryption and never share your personal details without your consent.'],
                ['What payment methods are accepted?', 'We accept bKash, Nagad, Rocket, and major credit/debit cards through our secure gateway.'],
            ] as [$q, $a])
            <div class="faq-item">
                <div class="faq-q">{{ $q }}</div>
                <div class="faq-a">{{ $a }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
