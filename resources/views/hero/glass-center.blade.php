@push('styles')
<style>
.hero-glass {
    min-height: 100vh;
    background: linear-gradient(135deg, #0f0c29 0%, #302b63 40%, #1a1040 70%, #0f0c29 100%);
    background-attachment: fixed;
    display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden;
}
.hero-glass-orb {
    position: absolute; border-radius: 50%; pointer-events: none;
    filter: blur(80px);
}
.hero-glass-orb-1 { width: 500px; height: 500px; top: -150px; right: -80px; background: radial-gradient(circle, rgba(167,139,250,.45) 0%, transparent 70%); animation: orbFloat 10s ease-in-out infinite; }
.hero-glass-orb-2 { width: 400px; height: 400px; bottom: -100px; left: -80px; background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 70%); animation: orbFloat 14s ease-in-out infinite reverse; }
.hero-glass-orb-3 { width: 300px; height: 300px; top: 50%; left: 30%; background: radial-gradient(circle, rgba(245,158,11,.25) 0%, transparent 70%); animation: orbFloat 8s ease-in-out infinite 3s; }
@keyframes orbFloat { 0%,100%{transform:translate(0,0) scale(1);} 33%{transform:translate(20px,-30px) scale(1.05);} 66%{transform:translate(-15px,20px) scale(.95);} }
.hero-glass-card {
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(32px);
    -webkit-backdrop-filter: blur(32px);
    border: 1px solid rgba(255,255,255,.16);
    border-radius: 32px;
    padding: 56px 48px 48px;
    max-width: 700px; width: calc(100% - 48px);
    text-align: center;
    position: relative; z-index: 1;
    box-shadow: 0 32px 80px rgba(0,0,0,.4), inset 0 1px 0 rgba(255,255,255,.12);
}
.hero-glass-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2);
    padding: 5px 16px; border-radius: 40px; margin-bottom: 28px;
    font-size: .74rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase;
    color: rgba(255,255,255,.8);
}
.hero-glass-eyebrow-dot { width: 6px; height: 6px; border-radius: 50%; background: #A78BFA; flex-shrink: 0; animation: heroPulse 2s ease infinite; }
.hero-glass-title {
    font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 700; color: #fff;
    line-height: 1.1; margin-bottom: 18px; text-wrap: balance;
}
.hero-glass-title em { font-style: italic; color: #C4B5FD; }
.hero-glass-sub { font-size: .98rem; color: rgba(255,255,255,.65); line-height: 1.72; margin-bottom: 36px; max-width: 520px; margin-left: auto; margin-right: auto; }
.hero-glass-actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; margin-bottom: 40px; }
.hero-glass-btn-p {
    padding: 13px 30px; background: rgba(255,255,255,.95); color: #302b63;
    border-radius: var(--r-lg); font-weight: 700; font-size: .9rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: transform .2s, background .2s; box-shadow: 0 4px 20px rgba(0,0,0,.25);
}
.hero-glass-btn-p:hover { background: #fff; transform: translateY(-2px); box-shadow: 0 8px 32px rgba(0,0,0,.35); }
.hero-glass-btn-o {
    padding: 13px 26px; border: 1.5px solid rgba(255,255,255,.35);
    border-radius: var(--r-lg); font-weight: 600; font-size: .9rem; color: rgba(255,255,255,.9);
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: background .2s, border-color .2s;
    backdrop-filter: blur(8px);
}
.hero-glass-btn-o:hover { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.65); }
.hero-glass-divider { height: 1px; background: rgba(255,255,255,.1); margin: 0 -8px 28px; }
.hero-glass-stats { display: flex; gap: 0; }
.hero-glass-stat { flex: 1; text-align: center; padding: 0 12px; border-right: 1px solid rgba(255,255,255,.1); }
.hero-glass-stat:last-child { border-right: none; }
.hero-glass-stat-num { font-size: 1.8rem; font-weight: 700; color: #fff; line-height: 1; }
.hero-glass-stat-label { font-size: .7rem; color: rgba(255,255,255,.5); letter-spacing: .05em; text-transform: uppercase; margin-top: 4px; }
@media (max-width: 600px) {
    .hero-glass-card { padding: 36px 24px 32px; }
    .hero-glass-title { font-size: 2rem; }
    .hero-glass-stats { flex-wrap: wrap; gap: 16px; }
    .hero-glass-stat { border-right: none; flex: 0 0 45%; }
}
</style>
@endpush
<section class="hero-glass" id="hero">
    <div class="hero-glass-orb hero-glass-orb-1"></div>
    <div class="hero-glass-orb hero-glass-orb-2"></div>
    <div class="hero-glass-orb hero-glass-orb-3"></div>
    <div class="hero-glass-card">
        <div class="hero-glass-eyebrow">
            <span class="hero-glass-eyebrow-dot"></span>
            {{ $heroSettings['badge'] ?? 'Bangladesh\'s Trusted Matrimonial Platform' }}
        </div>
        <h1 class="hero-glass-title">{!! $heroSettings['title_html'] ?? 'Find Your <em>Perfect</em><br>Life Partner' !!}</h1>
        <p class="hero-glass-sub">{{ $heroSettings['subtitle'] ?? 'Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform.' }}</p>
        <div class="hero-glass-actions">
            @guest
                <a href="{{ route('register') }}" class="hero-glass-btn-p"><i class="fas fa-heart"></i> {{ $heroSettings['cta_primary'] ?? 'Register Free' }}</a>
                <a href="{{ route('search') }}" class="hero-glass-btn-o"><i class="fas fa-search"></i> Browse Profiles</a>
            @else
                <a href="{{ route('search') }}" class="hero-glass-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                <a href="{{ route('member.dashboard') }}" class="hero-glass-btn-o"><i class="fas fa-home"></i> My Dashboard</a>
            @endguest
        </div>
        <div class="hero-glass-divider"></div>
        <div class="hero-glass-stats">
            <div class="hero-glass-stat">
                <div class="hero-glass-stat-num" data-counter data-target="{{ $stats['total_members'] }}" data-suffix="+">{{ $stats['total_members'] }}</div>
                <div class="hero-glass-stat-label">Members</div>
            </div>
            <div class="hero-glass-stat">
                <div class="hero-glass-stat-num" data-counter data-target="{{ $stats['total_marriages'] }}" data-suffix="+">{{ $stats['total_marriages'] }}</div>
                <div class="hero-glass-stat-label">Marriages</div>
            </div>
            <div class="hero-glass-stat">
                <div class="hero-glass-stat-num">100%</div>
                <div class="hero-glass-stat-label">Verified</div>
            </div>
            <div class="hero-glass-stat">
                <div class="hero-glass-stat-num">24/7</div>
                <div class="hero-glass-stat-label">Support</div>
            </div>
        </div>
    </div>
</section>
