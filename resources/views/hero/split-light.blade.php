@push('styles')
<style>
.hero-split {
    min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr;
}
.hero-split-left {
    background: var(--bg); display: flex; align-items: center;
    padding: 120px 56px 80px; position: relative;
}
.hero-split-left::after {
    content: ''; position: absolute; right: 0; top: 10%; bottom: 10%;
    width: 1px; background: linear-gradient(to bottom, transparent, var(--border), transparent);
}
.hero-split-right {
    background: linear-gradient(140deg, var(--brand) 0%, var(--brand-dark) 60%, rgba(0,0,0,.6) 100%);
    display: flex; align-items: center; justify-content: center;
    padding: 80px 48px; position: relative; overflow: hidden;
}
.hero-split-right::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 24px 24px;
}
.hero-split-right-circle {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.07); pointer-events: none;
}
.hero-split-right-circle-1 { width: 400px; height: 400px; right: -80px; bottom: -80px; }
.hero-split-right-circle-2 { width: 600px; height: 600px; right: -180px; bottom: -180px; }
.hero-split-eyebrow {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(0,0,0,.05); border: 1px solid var(--border);
    padding: 5px 14px; border-radius: 40px; margin-bottom: 24px;
    font-size: .74rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase;
    color: var(--brand);
}
.hero-split-eyebrow-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--brand); flex-shrink: 0; animation: heroPulse 2s ease infinite; }
.hero-split-title {
    font-size: clamp(2.4rem, 4vw, 3.8rem); font-weight: 700;
    color: var(--text1); line-height: 1.1; margin-bottom: 20px; text-wrap: balance;
}
.hero-split-title em { font-style: italic; color: var(--brand); }
.hero-split-sub { font-size: 1rem; color: var(--text3); line-height: 1.72; margin-bottom: 36px; }
.hero-split-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 40px; }
.hero-split-btn-p {
    padding: 13px 30px; background: var(--brand); color: #fff;
    border-radius: var(--r-md); font-weight: 700; font-size: .9rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: background .2s, transform .2s;
    box-shadow: 0 4px 18px rgba(0,0,0,.14);
}
.hero-split-btn-p:hover { background: var(--brand-dark); transform: translateY(-2px); }
.hero-split-btn-o {
    padding: 13px 26px; border: 1.5px solid var(--border);
    border-radius: var(--r-md); font-weight: 600; font-size: .9rem;
    color: var(--text2); text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    transition: border-color .2s, color .2s;
}
.hero-split-btn-o:hover { border-color: var(--brand); color: var(--brand); }
.hero-split-trust { display: flex; flex-wrap: wrap; gap: 20px; }
.hero-split-trust span { display: flex; align-items: center; gap: 7px; font-size: .8rem; color: var(--text4); }
.hero-split-trust i { color: var(--brand); }
/* Right panel stat cards */
.hero-split-cards { display: flex; flex-direction: column; gap: 16px; position: relative; z-index: 1; width: 100%; max-width: 280px; }
.hero-split-stat-card {
    background: rgba(255,255,255,.12); backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,.2); border-radius: var(--r-md);
    padding: 20px 24px; color: #fff;
}
.hero-split-stat-num {
    font-size: 2.4rem; font-weight: 700; line-height: 1; margin-bottom: 4px;
}
.hero-split-stat-label { font-size: .78rem; opacity: .72; letter-spacing: .04em; text-transform: uppercase; }
.hero-split-feature-pill {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
    padding: 8px 16px; border-radius: 40px; color: #fff;
    font-size: .8rem; font-weight: 600;
}
.hero-split-feature-pill i { color: var(--gold); }
@media (max-width: 900px) {
    .hero-split { grid-template-columns: 1fr; }
    .hero-split-left { padding: 100px 24px 60px; }
    .hero-split-left::after { display: none; }
    .hero-split-right { min-height: 340px; }
    .hero-split-cards { flex-direction: row; flex-wrap: wrap; max-width: 100%; }
    .hero-split-stat-card { flex: 1; min-width: 120px; }
}
</style>
@endpush
<section class="hero-split" id="hero">
    <div class="hero-split-left">
        <div style="max-width:520px; width:100%;">
            <div class="hero-split-eyebrow">
                <span class="hero-split-eyebrow-dot"></span>
                {{ $heroSettings['badge'] ?? 'Bangladesh\'s Trusted Matrimonial Platform' }}
            </div>
            <h1 class="hero-split-title">{!! $heroSettings['title_html'] ?? 'Find Your <em>Perfect</em><br>Life Partner' !!}</h1>
            <p class="hero-split-sub">{{ $heroSettings['subtitle'] ?? 'Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform.' }}</p>
            <div class="hero-split-actions">
                @guest
                    <a href="{{ route('register') }}" class="hero-split-btn-p"><i class="fas fa-heart"></i> {{ $heroSettings['cta_primary'] ?? 'Register Free' }}</a>
                    <a href="{{ route('search') }}" class="hero-split-btn-o"><i class="fas fa-search"></i> Browse Profiles</a>
                @else
                    <a href="{{ route('search') }}" class="hero-split-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                    <a href="{{ route('member.dashboard') }}" class="hero-split-btn-o"><i class="fas fa-home"></i> My Dashboard</a>
                @endguest
            </div>
            <div class="hero-split-trust">
                <span><i class="fas fa-shield-alt"></i> Verified Profiles</span>
                <span><i class="fas fa-lock"></i> Private & Secure</span>
                <span><i class="fas fa-headset"></i> 24/7 Support</span>
            </div>
        </div>
    </div>
    <div class="hero-split-right">
        <div class="hero-split-right-circle hero-split-right-circle-1"></div>
        <div class="hero-split-right-circle hero-split-right-circle-2"></div>
        <div class="hero-split-cards">
            <div class="hero-split-stat-card">
                <div class="hero-split-stat-num" data-counter data-target="{{ $stats['total_members'] }}" data-suffix="+">{{ $stats['total_members'] }}</div>
                <div class="hero-split-stat-label">Registered Members</div>
            </div>
            <div class="hero-split-stat-card">
                <div class="hero-split-stat-num" data-counter data-target="{{ $stats['total_marriages'] }}" data-suffix="+">{{ $stats['total_marriages'] }}</div>
                <div class="hero-split-stat-label">Successful Marriages</div>
            </div>
            <div class="hero-split-feature-pill"><i class="fas fa-star"></i> Trusted by Bangladeshi Families</div>
            <div class="hero-split-feature-pill"><i class="fas fa-check-circle"></i> 100% Verified Profiles</div>
        </div>
    </div>
</section>
