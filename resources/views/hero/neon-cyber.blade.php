@push('styles')
<style>
.hero-neon {
    min-height: 100vh; background: var(--bg);
    display: grid; grid-template-columns: 1.1fr .9fr; align-items: center;
    position: relative; overflow: hidden;
}
.hero-neon::before {
    content: ''; position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(0,229,204,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,229,204,.04) 1px, transparent 1px);
    background-size: 44px 44px; pointer-events: none;
}
.hero-neon::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0;
    height: 220px;
    background: linear-gradient(to top, rgba(0,229,204,.06), transparent);
    pointer-events: none;
}
.hero-neon-scanlines {
    position: absolute; inset: 0; pointer-events: none;
    background: repeating-linear-gradient(0deg, transparent 0px, transparent 3px, rgba(0,229,204,.015) 3px, rgba(0,229,204,.015) 4px);
}
.hero-neon-glow {
    position: absolute; width: 600px; height: 600px; border-radius: 50%;
    background: radial-gradient(circle, rgba(0,229,204,.12) 0%, transparent 65%);
    top: 50%; left: -100px; transform: translateY(-50%); pointer-events: none;
}
.hero-neon-left { padding: 120px 40px 80px 0; position: relative; z-index: 1; }
.hero-neon-tag {
    display: inline-flex; align-items: center; gap: 8px;
    border: 1px solid rgba(0,229,204,.35); padding: 5px 14px; border-radius: 3px;
    font-size: .7rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--brand); margin-bottom: 28px;
    box-shadow: 0 0 12px rgba(0,229,204,.15), inset 0 0 12px rgba(0,229,204,.04);
}
.hero-neon-tag-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--brand); flex-shrink: 0; animation: neonBlink 1.5s ease infinite; }
@keyframes neonBlink { 0%,100%{opacity:1; box-shadow: 0 0 8px rgba(0,229,204,.8);} 50%{opacity:.4; box-shadow: none;} }
.hero-neon-title {
    font-size: clamp(2.4rem, 4.5vw, 3.8rem); font-weight: 700;
    color: var(--text1); line-height: 1.08; margin-bottom: 20px;
    text-transform: uppercase; letter-spacing: .04em;
}
.hero-neon-title .neon-accent {
    color: var(--brand);
    text-shadow: 0 0 20px rgba(0,229,204,.6), 0 0 40px rgba(0,229,204,.3);
}
.hero-neon-line {
    width: 80px; height: 2px; background: var(--brand); margin-bottom: 24px;
    box-shadow: 0 0 12px rgba(0,229,204,.6);
}
.hero-neon-sub { font-size: .95rem; color: var(--text3); line-height: 1.7; margin-bottom: 36px; max-width: 460px; }
.hero-neon-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 44px; }
.hero-neon-btn-p {
    padding: 13px 30px; background: var(--brand); color: #07090E;
    border-radius: 3px; font-weight: 700; font-size: .88rem; font-family: inherit;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    text-transform: uppercase; letter-spacing: .06em;
    box-shadow: 0 0 20px rgba(0,229,204,.4); transition: all .2s;
}
.hero-neon-btn-p:hover { box-shadow: 0 0 36px rgba(0,229,204,.65); transform: translateY(-1px); }
.hero-neon-btn-o {
    padding: 12px 26px; border: 1.5px solid rgba(0,229,204,.35);
    border-radius: 3px; font-weight: 600; font-size: .88rem;
    color: var(--brand); text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    text-transform: uppercase; letter-spacing: .06em; transition: all .2s;
    box-shadow: 0 0 10px rgba(0,229,204,.12);
}
.hero-neon-btn-o:hover { border-color: var(--brand); box-shadow: 0 0 20px rgba(0,229,204,.3); }
.hero-neon-trust { display: flex; flex-wrap: wrap; gap: 18px; }
.hero-neon-trust span { display: flex; align-items: center; gap: 7px; font-size: .78rem; color: var(--text4); text-transform: uppercase; letter-spacing: .05em; }
.hero-neon-trust i { color: var(--brand); }
/* Right panel */
.hero-neon-right { padding: 120px 0 80px; position: relative; z-index: 1; }
.hero-neon-panel {
    border: 1px solid rgba(0,229,204,.2); border-radius: 8px;
    background: rgba(0,229,204,.03); padding: 32px;
    box-shadow: 0 0 40px rgba(0,229,204,.08), inset 0 1px 0 rgba(0,229,204,.1);
}
.hero-neon-panel-title {
    font-size: .68rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase;
    color: var(--brand); margin-bottom: 24px; display: flex; align-items: center; gap: 8px;
}
.hero-neon-panel-title::after { content: ''; flex: 1; height: 1px; background: rgba(0,229,204,.2); }
.hero-neon-stat-row { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid rgba(0,229,204,.08); }
.hero-neon-stat-row:last-child { border-bottom: none; }
.hero-neon-stat-label { font-size: .78rem; color: var(--text3); text-transform: uppercase; letter-spacing: .05em; }
.hero-neon-stat-val { font-size: 1.5rem; font-weight: 700; color: var(--brand); text-shadow: 0 0 16px rgba(0,229,204,.5); font-family: 'Rajdhani', 'Inter', sans-serif; }
@media (max-width: 900px) {
    .hero-neon { grid-template-columns: 1fr; }
    .hero-neon-left { padding: 100px 0 40px; }
    .hero-neon-right { padding: 0 0 80px; }
}
</style>
@endpush
<section class="hero-neon" id="hero">
    <div class="hero-neon-scanlines"></div>
    <div class="hero-neon-glow"></div>
    <div class="container" style="display:contents;">
        <div style="padding: 0 0 0 max(24px, calc((100vw - 1200px)/2 + 24px));">
            <div class="hero-neon-left">
                <div class="hero-neon-tag">
                    <span class="hero-neon-tag-dot"></span>
                    {{ $heroSettings['badge'] ?? 'Trusted Matrimonial Platform' }}
                </div>
                <h1 class="hero-neon-title">
                    {!! str_replace(['<em>', '</em>'], ['<span class="neon-accent">', '</span>'], ($heroSettings['title_html'] ?? 'Find Your <em>Perfect</em><br>Life Partner')) !!}
                </h1>
                <div class="hero-neon-line"></div>
                <p class="hero-neon-sub">{{ $heroSettings['subtitle'] ?? 'Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform.' }}</p>
                <div class="hero-neon-actions">
                    @guest
                        <a href="{{ route('register') }}" class="hero-neon-btn-p"><i class="fas fa-bolt"></i> {{ $heroSettings['cta_primary'] ?? 'Join Now' }}</a>
                        <a href="{{ route('search') }}" class="hero-neon-btn-o"><i class="fas fa-search"></i> Browse</a>
                    @else
                        <a href="{{ route('search') }}" class="hero-neon-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                        <a href="{{ route('member.dashboard') }}" class="hero-neon-btn-o"><i class="fas fa-home"></i> Dashboard</a>
                    @endguest
                </div>
                <div class="hero-neon-trust">
                    <span><i class="fas fa-shield-alt"></i> Verified</span>
                    <span><i class="fas fa-lock"></i> Secure</span>
                    <span><i class="fas fa-headset"></i> 24/7</span>
                </div>
            </div>
        </div>
        <div style="padding: 0 max(24px, calc((100vw - 1200px)/2 + 24px)) 0 48px;">
            <div class="hero-neon-right">
                <div class="hero-neon-panel">
                    <div class="hero-neon-panel-title">Live Stats</div>
                    <div class="hero-neon-stat-row">
                        <span class="hero-neon-stat-label">Registered Members</span>
                        <span class="hero-neon-stat-val" data-counter data-target="{{ $stats['total_members'] }}" data-suffix="+">{{ $stats['total_members'] }}</span>
                    </div>
                    <div class="hero-neon-stat-row">
                        <span class="hero-neon-stat-label">Successful Marriages</span>
                        <span class="hero-neon-stat-val" data-counter data-target="{{ $stats['total_marriages'] }}" data-suffix="+">{{ $stats['total_marriages'] }}</span>
                    </div>
                    <div class="hero-neon-stat-row">
                        <span class="hero-neon-stat-label">Verified Profiles</span>
                        <span class="hero-neon-stat-val">100%</span>
                    </div>
                    <div class="hero-neon-stat-row">
                        <span class="hero-neon-stat-label">Support Uptime</span>
                        <span class="hero-neon-stat-val">24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
