@push('styles')
<style>
.hero-soft {
    min-height: 100vh; background: var(--bg);
    display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden; text-align: center;
}
.hero-soft-blob {
    position: absolute; border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%;
    pointer-events: none; filter: blur(60px); opacity: .55;
}
.hero-soft-blob-1 { width: 480px; height: 480px; top: -100px; left: -100px; background: var(--brand); opacity: .22; animation: blobMorph 12s ease-in-out infinite; }
.hero-soft-blob-2 { width: 380px; height: 380px; bottom: -80px; right: -80px; background: var(--brand-dark); opacity: .2; animation: blobMorph 16s ease-in-out infinite reverse 4s; }
.hero-soft-blob-3 { width: 280px; height: 280px; top: 40%; left: 60%; background: var(--brand); opacity: .15; animation: blobMorph 10s ease-in-out infinite 2s; }
@keyframes blobMorph {
    0%,100%{border-radius:60% 40% 70% 30%/50% 60% 40% 50%; transform:translate(0,0) rotate(0deg);}
    25%{border-radius:30% 70% 40% 60%/60% 30% 70% 40%; transform:translate(20px,-15px) rotate(5deg);}
    50%{border-radius:50% 50% 60% 40%/40% 50% 50% 60%; transform:translate(-10px,20px) rotate(-3deg);}
    75%{border-radius:70% 30% 50% 50%/30% 70% 40% 60%; transform:translate(15px,5px) rotate(8deg);}
}
.hero-soft-inner { position: relative; z-index: 1; max-width: 680px; padding: 0 24px; }
.hero-soft-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--surface); border: 1px solid var(--border);
    padding: 7px 20px; border-radius: 999px; margin-bottom: 28px;
    font-size: .74rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
    color: var(--brand); box-shadow: var(--sh-sm);
}
.hero-soft-badge-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--brand); flex-shrink: 0; animation: heroPulse 2s ease infinite; }
.hero-soft-title {
    font-size: clamp(2.6rem, 5.5vw, 4.4rem); font-weight: 700; color: var(--text1);
    line-height: 1.1; margin-bottom: 20px; text-wrap: balance;
}
.hero-soft-title em { font-style: italic; color: var(--brand); }
.hero-soft-sub { font-size: 1.05rem; color: var(--text3); line-height: 1.72; margin-bottom: 40px; max-width: 520px; margin-left: auto; margin-right: auto; }
.hero-soft-actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; margin-bottom: 44px; }
.hero-soft-btn-p {
    padding: 15px 36px; background: var(--brand); color: #fff;
    border-radius: var(--r-xl); font-weight: 700; font-size: .95rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 9px;
    transition: background .2s, transform .2s, box-shadow .2s;
    box-shadow: 0 6px 24px rgba(0,0,0,.12);
}
.hero-soft-btn-p:hover { background: var(--brand-dark); transform: translateY(-2px); box-shadow: 0 10px 36px rgba(0,0,0,.18); }
.hero-soft-btn-o {
    padding: 14px 30px; border: 2px solid var(--border);
    border-radius: var(--r-xl); font-weight: 600; font-size: .95rem;
    color: var(--text2); text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    transition: border-color .2s, color .2s;
}
.hero-soft-btn-o:hover { border-color: var(--brand); color: var(--brand); }
.hero-soft-stats { display: flex; flex-wrap: wrap; gap: 0; justify-content: center; background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 28px 0; box-shadow: var(--sh-sm); }
.hero-soft-stat { flex: 1; min-width: 120px; text-align: center; padding: 0 24px; border-right: 1px solid var(--border); }
.hero-soft-stat:last-child { border-right: none; }
.hero-soft-stat-num { font-size: 2rem; font-weight: 700; color: var(--brand); line-height: 1; }
.hero-soft-stat-label { font-size: .7rem; color: var(--text4); text-transform: uppercase; letter-spacing: .07em; margin-top: 5px; }
@media (max-width: 600px) {
    .hero-soft-title { font-size: 2.4rem; }
    .hero-soft-stats { padding: 20px 0; }
    .hero-soft-stat { padding: 0 16px; min-width: 90px; }
    .hero-soft-stat-num { font-size: 1.5rem; }
}
</style>
@endpush
<section class="hero-soft" id="hero">
    <div class="hero-soft-blob hero-soft-blob-1"></div>
    <div class="hero-soft-blob hero-soft-blob-2"></div>
    <div class="hero-soft-blob hero-soft-blob-3"></div>
    <div class="hero-soft-inner">
        <div class="hero-soft-badge">
            <span class="hero-soft-badge-dot"></span>
            {{ $heroSettings['badge'] ?? 'Bangladesh\'s Trusted Matrimonial Platform' }}
        </div>
        <h1 class="hero-soft-title">{!! $heroSettings['title_html'] ?? 'Find Your <em>Perfect</em><br>Life Partner' !!}</h1>
        <p class="hero-soft-sub">{{ $heroSettings['subtitle'] ?? 'Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform.' }}</p>
        <div class="hero-soft-actions">
            @guest
                <a href="{{ route('register') }}" class="hero-soft-btn-p"><i class="fas fa-heart"></i> {{ $heroSettings['cta_primary'] ?? 'Register Free' }}</a>
                <a href="{{ route('search') }}" class="hero-soft-btn-o"><i class="fas fa-search"></i> Browse Profiles</a>
            @else
                <a href="{{ route('search') }}" class="hero-soft-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                <a href="{{ route('member.dashboard') }}" class="hero-soft-btn-o"><i class="fas fa-home"></i> My Dashboard</a>
            @endguest
        </div>
        <div class="hero-soft-stats">
            <div class="hero-soft-stat">
                <div class="hero-soft-stat-num" data-counter data-target="{{ $stats['total_members'] }}" data-suffix="+">{{ $stats['total_members'] }}</div>
                <div class="hero-soft-stat-label">Members</div>
            </div>
            <div class="hero-soft-stat">
                <div class="hero-soft-stat-num" data-counter data-target="{{ $stats['total_marriages'] }}" data-suffix="+">{{ $stats['total_marriages'] }}</div>
                <div class="hero-soft-stat-label">Marriages</div>
            </div>
            <div class="hero-soft-stat">
                <div class="hero-soft-stat-num">100%</div>
                <div class="hero-soft-stat-label">Verified</div>
            </div>
            <div class="hero-soft-stat">
                <div class="hero-soft-stat-num">24/7</div>
                <div class="hero-soft-stat-label">Support</div>
            </div>
        </div>
    </div>
</section>
