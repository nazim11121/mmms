@push('styles')
<style>
.hero-di {
    min-height: 100vh; position: relative; overflow: hidden;
    background: linear-gradient(140deg, var(--brand) 0%, var(--brand-dark) 45%, rgba(0,0,0,.82) 100%);
    display: flex; align-items: center;
}
.hero-di::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 28px 28px; pointer-events: none;
}
.hero-di-ring {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.06); pointer-events: none;
}
.hero-di-ring-1 { width: 560px; height: 560px; right: 4%; top: 50%; transform: translateY(-50%); }
.hero-di-ring-2 { width: 860px; height: 860px; right: -6%; top: 50%; transform: translateY(-50%); }
.hero-di-ring-3 { width: 1160px; height: 1160px; right: -16%; top: 50%; transform: translateY(-50%); }
.hero-di-content { position: relative; z-index: 1; max-width: 650px; padding: 100px 0 80px; }
.hero-di-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
    padding: 6px 16px; border-radius: 40px; margin-bottom: 28px;
    font-size: .76rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase;
    color: rgba(255,255,255,.82);
}
.hero-di-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); flex-shrink: 0; animation: heroPulse 2s ease infinite; }
@keyframes heroPulse { 0%,100%{opacity:1;} 50%{opacity:.35;} }
.hero-di-title {
    font-size: clamp(2.6rem, 5vw, 4.2rem); font-weight: 700; color: #fff;
    line-height: 1.1; margin-bottom: 22px; text-wrap: balance;
}
.hero-di-title em { font-style: italic; color: var(--gold-light, #F0C865); }
.hero-di-sub { font-size: 1.05rem; color: rgba(255,255,255,.7); line-height: 1.72; margin-bottom: 38px; max-width: 520px; }
.hero-di-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 52px; }
.hero-di-btn-p {
    padding: 14px 32px; background: #fff; color: var(--brand);
    border-radius: var(--r-md); font-weight: 700; font-size: .95rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: transform .2s, box-shadow .2s; box-shadow: 0 4px 24px rgba(0,0,0,.22);
}
.hero-di-btn-p:hover { transform: translateY(-2px); box-shadow: 0 8px 36px rgba(0,0,0,.32); }
.hero-di-btn-o {
    padding: 14px 28px; border: 1.5px solid rgba(255,255,255,.38);
    border-radius: var(--r-md); font-weight: 600; font-size: .95rem; color: #fff;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: background .2s, border-color .2s;
}
.hero-di-btn-o:hover { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.7); }
.hero-di-trust { display: flex; flex-wrap: wrap; gap: 24px; }
.hero-di-trust span { display: flex; align-items: center; gap: 8px; font-size: .82rem; color: rgba(255,255,255,.58); }
.hero-di-trust i { color: var(--gold); }
.hero-di-scroll {
    position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%);
    width: 28px; height: 46px; border: 2px solid rgba(255,255,255,.22);
    border-radius: 14px; display: flex; justify-content: center; padding-top: 8px;
}
.hero-di-scroll::after {
    content: ''; width: 4px; height: 8px; background: rgba(255,255,255,.45);
    border-radius: 2px; animation: scrollAnim 2s ease infinite;
}
@keyframes scrollAnim { 0%{opacity:1;transform:translateY(0);} 80%{opacity:0;transform:translateY(12px);} 100%{opacity:0;} }
@media (max-width: 600px) { .hero-di-title { font-size: 2.4rem; } }
</style>
@endpush
<section class="hero-di" id="hero">
    <div class="hero-di-ring hero-di-ring-1"></div>
    <div class="hero-di-ring hero-di-ring-2"></div>
    <div class="hero-di-ring hero-di-ring-3"></div>
    <div class="container">
        <div class="hero-di-content">
            <div class="hero-di-eyebrow">
                <span class="hero-di-dot"></span>
                {{ $heroSettings['badge'] ?? 'Bangladesh\'s Trusted Matrimonial Platform' }}
            </div>
            <h1 class="hero-di-title">{!! $heroSettings['title_html'] ?? 'Find Your <em>Perfect</em><br>Life Partner' !!}</h1>
            <p class="hero-di-sub">{{ $heroSettings['subtitle'] ?? 'Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform.' }}</p>
            <div class="hero-di-actions">
                @guest
                    <a href="{{ route('register') }}" class="hero-di-btn-p"><i class="fas fa-heart"></i> {{ $heroSettings['cta_primary'] ?? 'Register Free' }}</a>
                    <a href="{{ route('search') }}" class="hero-di-btn-o"><i class="fas fa-search"></i> Browse Profiles</a>
                @else
                    <a href="{{ route('search') }}" class="hero-di-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                    <a href="{{ route('member.dashboard') }}" class="hero-di-btn-o"><i class="fas fa-home"></i> My Dashboard</a>
                @endguest
            </div>
            <div class="hero-di-trust">
                <span><i class="fas fa-shield-alt"></i> Verified Profiles</span>
                <span><i class="fas fa-lock"></i> Private & Secure</span>
                <span><i class="fas fa-headset"></i> 24/7 Support</span>
            </div>
        </div>
    </div>
    <a href="#stats" class="hero-di-scroll" aria-label="Scroll"></a>
</section>
