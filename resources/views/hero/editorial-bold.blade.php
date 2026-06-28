@push('styles')
<style>
.hero-edit {
    min-height: 100vh; background: var(--bg);
    display: grid; grid-template-columns: 1.2fr .8fr; align-items: stretch;
    position: relative;
}
.hero-edit-left {
    padding: 120px 64px 80px max(24px, calc((100vw - 1200px)/2 + 24px));
    display: flex; flex-direction: column; justify-content: center;
    border-right: 3px solid var(--text1); position: relative;
}
.hero-edit-issue {
    font-size: .68rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase;
    color: var(--text4); margin-bottom: 20px;
    display: flex; align-items: center; gap: 12px;
}
.hero-edit-issue::after { content: ''; flex: 0 0 40px; height: 1px; background: var(--text4); }
.hero-edit-rule { width: 100%; height: 3px; background: var(--text1); margin-bottom: 28px; }
.hero-edit-title {
    font-size: clamp(3rem, 6.5vw, 5.5rem); font-weight: 900; color: var(--text1);
    line-height: .96; margin-bottom: 24px; letter-spacing: -.025em;
}
.hero-edit-title em { font-style: italic; color: var(--brand); }
.hero-edit-rule-sm { width: 64px; height: 4px; background: var(--brand); margin-bottom: 24px; }
.hero-edit-sub { font-size: 1.05rem; color: var(--text3); line-height: 1.68; margin-bottom: 36px; max-width: 480px; }
.hero-edit-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 44px; }
.hero-edit-btn-p {
    padding: 14px 32px; background: var(--text1); color: var(--bg);
    font-weight: 700; font-size: .9rem; border-radius: var(--r-sm);
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: background .2s;
}
.hero-edit-btn-p:hover { background: var(--brand); }
.hero-edit-btn-o {
    padding: 13px 28px; border: 2px solid var(--text1);
    font-weight: 600; font-size: .9rem; color: var(--text1);
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    border-radius: var(--r-sm); transition: all .2s;
}
.hero-edit-btn-o:hover { background: var(--text1); color: var(--bg); }
.hero-edit-meta { display: flex; flex-wrap: wrap; gap: 24px; }
.hero-edit-meta span { font-size: .78rem; color: var(--text4); display: flex; align-items: center; gap: 7px; letter-spacing: .03em; }
.hero-edit-meta i { color: var(--brand); }
/* Right column */
.hero-edit-right {
    background: var(--brand); padding: 80px 40px 80px 56px;
    display: flex; flex-direction: column; justify-content: center;
    padding-right: max(24px, calc((100vw - 1200px)/2 + 24px));
}
.hero-edit-right-label {
    font-size: .68rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase;
    color: rgba(255,255,255,.65); margin-bottom: 40px;
    display: flex; align-items: center; gap: 12px;
}
.hero-edit-right-label::after { content: ''; flex: 0 0 32px; height: 1px; background: rgba(255,255,255,.4); }
.hero-edit-stat-block { margin-bottom: 32px; padding-bottom: 32px; border-bottom: 1px solid rgba(255,255,255,.15); }
.hero-edit-stat-block:last-of-type { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
.hero-edit-big-num { font-size: clamp(3.2rem, 5.5vw, 5rem); font-weight: 900; color: #fff; line-height: 1; letter-spacing: -.04em; }
.hero-edit-big-label { font-size: .82rem; color: rgba(255,255,255,.65); text-transform: uppercase; letter-spacing: .07em; margin-top: 6px; }
@media (max-width: 900px) {
    .hero-edit { grid-template-columns: 1fr; }
    .hero-edit-left { padding: 100px 24px 60px; border-right: none; border-bottom: 3px solid var(--text1); }
    .hero-edit-right { padding: 60px 24px 80px; }
}
</style>
@endpush
<section class="hero-edit" id="hero">
    <div class="hero-edit-left">
        <div class="hero-edit-issue">
            {{ $heroSettings['badge'] ?? 'Trusted Matrimonial Service' }}
        </div>
        <div class="hero-edit-rule"></div>
        <h1 class="hero-edit-title">{!! $heroSettings['title_html'] ?? 'Find Your<br><em>Perfect</em><br>Partner' !!}</h1>
        <div class="hero-edit-rule-sm"></div>
        <p class="hero-edit-sub">{{ $heroSettings['subtitle'] ?? 'Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform.' }}</p>
        <div class="hero-edit-actions">
            @guest
                <a href="{{ route('register') }}" class="hero-edit-btn-p"><i class="fas fa-user-plus"></i> {{ $heroSettings['cta_primary'] ?? 'Register Free' }}</a>
                <a href="{{ route('search') }}" class="hero-edit-btn-o"><i class="fas fa-search"></i> Browse Profiles</a>
            @else
                <a href="{{ route('search') }}" class="hero-edit-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                <a href="{{ route('member.dashboard') }}" class="hero-edit-btn-o"><i class="fas fa-home"></i> My Dashboard</a>
            @endguest
        </div>
        <div class="hero-edit-meta">
            <span><i class="fas fa-shield-alt"></i> Verified</span>
            <span><i class="fas fa-lock"></i> Secure</span>
            <span><i class="fas fa-headset"></i> 24/7 Support</span>
        </div>
    </div>
    <div class="hero-edit-right">
        <div class="hero-edit-right-label">Our Story</div>
        <div class="hero-edit-stat-block">
            <div class="hero-edit-big-num" data-counter data-target="{{ $stats['total_members'] }}" data-suffix="+">{{ $stats['total_members'] }}</div>
            <div class="hero-edit-big-label">Registered Members</div>
        </div>
        <div class="hero-edit-stat-block">
            <div class="hero-edit-big-num" data-counter data-target="{{ $stats['total_marriages'] }}" data-suffix="+">{{ $stats['total_marriages'] }}</div>
            <div class="hero-edit-big-label">Successful Marriages</div>
        </div>
        <div class="hero-edit-stat-block">
            <div class="hero-edit-big-num">100%</div>
            <div class="hero-edit-big-label">Verified Profiles</div>
        </div>
    </div>
</section>
