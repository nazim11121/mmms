@push('styles')
<style>
.hero-mag {
    min-height: 100vh; background: var(--bg);
    display: grid; grid-template-columns: 1.1fr .9fr; align-items: stretch;
    position: relative; overflow: hidden;
}
/* Left sliding panel */
.hero-mag-left {
    display: flex; flex-direction: column; justify-content: center;
    padding: 120px 56px 80px max(24px, calc((100vw - 1200px)/2 + 24px));
    position: relative;
}
.hero-mag-left::after {
    content: ''; position: absolute; right: 0; top: 10%; bottom: 10%;
    width: 1px; background: linear-gradient(to bottom, transparent, var(--border), transparent);
}
.hero-mag-slidearea { position: relative; min-height: 340px; overflow: hidden; }
.hero-mag-slide {
    position: absolute; top: 0; left: 0; right: 0;
    opacity: 0; transform: translateY(24px);
    transition: opacity .65s ease, transform .65s ease;
    pointer-events: none;
}
.hero-mag-slide.mag-active { opacity: 1; transform: translateY(0); pointer-events: auto; position: relative; }
.hero-mag-eyebrow {
    display: flex; align-items: center; gap: 10px; margin-bottom: 20px;
    font-size: .7rem; font-weight: 700; letter-spacing: .13em; text-transform: uppercase; color: var(--brand);
}
.hero-mag-eyebrow-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--brand); flex-shrink: 0; animation: heroPulse 2s ease infinite; }
.hero-mag-slide-num {
    font-size: 5rem; font-weight: 900; line-height: 1; color: var(--border);
    letter-spacing: -.04em; margin-bottom: 0; user-select: none;
}
.hero-mag-rule { width: 48px; height: 3px; background: var(--brand); margin: 10px 0 22px; border-radius: 2px; }
.hero-mag-title {
    font-size: clamp(2.2rem, 4vw, 3.6rem); font-weight: 700; color: var(--text1);
    line-height: 1.1; margin-bottom: 20px; text-wrap: balance;
}
.hero-mag-title em { font-style: italic; color: var(--brand); }
.hero-mag-sub { font-size: 1rem; color: var(--text3); line-height: 1.7; margin-bottom: 34px; max-width: 440px; }
.hero-mag-actions { display: flex; flex-wrap: wrap; gap: 12px; }
.hero-mag-btn-p {
    padding: 13px 30px; background: var(--brand); color: #fff;
    border-radius: var(--r-md); font-weight: 700; font-size: .9rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: background .2s, transform .2s;
}
.hero-mag-btn-p:hover { background: var(--brand-dark); transform: translateY(-2px); }
.hero-mag-btn-o {
    padding: 12px 24px; border: 1.5px solid var(--border);
    border-radius: var(--r-md); font-weight: 600; font-size: .9rem;
    color: var(--text2); text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px; transition: border-color .2s, color .2s;
}
.hero-mag-btn-o:hover { border-color: var(--brand); color: var(--brand); }
/* Controls row */
.hero-mag-controls {
    display: flex; align-items: center; gap: 14px; margin-top: 36px;
}
.hero-mag-ctrl {
    width: 42px; height: 42px; border-radius: 50%;
    border: 1.5px solid var(--border); background: var(--surface);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text2); font-size: .88rem; transition: all .2s; flex-shrink: 0;
}
.hero-mag-ctrl:hover { border-color: var(--brand); color: var(--brand); }
.hero-mag-track { flex: 1; height: 2px; background: var(--border); border-radius: 1px; overflow: hidden; }
.hero-mag-fill { height: 100%; background: var(--brand); width: 0; border-radius: 1px; will-change: width; }
.hero-mag-counter { font-size: .72rem; font-weight: 700; color: var(--text4); letter-spacing: .05em; min-width: 34px; text-align: right; }
/* Right decorative panel */
.hero-mag-right {
    background: var(--surface); border-left: 1px solid var(--border);
    display: flex; flex-direction: column;
}
.hero-mag-right-hero {
    flex: 1.2; background: linear-gradient(140deg, var(--brand) 0%, var(--brand-dark) 100%);
    display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden; padding: 48px 40px;
}
.hero-mag-right-ring {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.08); pointer-events: none;
}
.hero-mag-right-ring-1 { width: 280px; height: 280px; right: -80px; top: -80px; }
.hero-mag-right-ring-2 { width: 480px; height: 480px; right: -180px; top: -180px; }
.hero-mag-featured {
    position: relative; z-index: 1; text-align: center;
}
.hero-mag-feat-num { font-size: 5.5rem; font-weight: 900; color: #fff; line-height: 1; letter-spacing: -.03em; }
.hero-mag-feat-label { font-size: .82rem; color: rgba(255,255,255,.65); text-transform: uppercase; letter-spacing: .1em; margin-top: 6px; }
.hero-mag-feat-divider { width: 48px; height: 2px; background: rgba(255,255,255,.35); margin: 14px auto; }
.hero-mag-feat-sub { font-size: .78rem; color: rgba(255,255,255,.5); max-width: 160px; margin: 0 auto; line-height: 1.55; }
/* Stats grid */
.hero-mag-stats-grid { display: grid; grid-template-columns: 1fr 1fr; border-top: 1px solid var(--border); }
.hero-mag-stat-cell {
    padding: 24px 28px; border-right: 1px solid var(--border); border-bottom: 1px solid var(--border);
}
.hero-mag-stat-cell:nth-child(even)  { border-right: none; }
.hero-mag-stat-cell:nth-child(3),
.hero-mag-stat-cell:nth-child(4) { border-bottom: none; }
.hero-mag-stat-num { font-size: 2rem; font-weight: 700; color: var(--brand); line-height: 1; margin-bottom: 4px; }
.hero-mag-stat-label { font-size: .68rem; color: var(--text4); text-transform: uppercase; letter-spacing: .07em; }
@media (max-width: 900px) {
    .hero-mag { grid-template-columns: 1fr; }
    .hero-mag-left { padding: 100px 24px 60px; }
    .hero-mag-left::after { display: none; }
    .hero-mag-right { display: none; }
}
</style>
@endpush

@php
$magSlides = [
    [
        'num'   => '01',
        'badge' => $heroSettings['badge']      ?? "Bangladesh's Trusted Matrimonial Platform",
        'title' => $heroSettings['title_html'] ?? 'Find Your <em>Perfect</em><br>Life Partner',
        'sub'   => $heroSettings['subtitle']   ?? 'Join thousands of families who found their match through MMMS — safe, verified, and family-oriented.',
        'cta'   => $heroSettings['cta_primary'] ?? 'Register Free',
    ],
    [
        'num'   => '02',
        'badge' => number_format($stats['total_members'] ?? 0) . '+ Registered Members',
        'title' => 'Thousands of <em>Verified</em><br>Profiles Waiting',
        'sub'   => 'Browse by age, location, education, and religion. Advanced filters help you find exactly who you are looking for — effortlessly.',
        'cta'   => 'Browse Profiles',
    ],
    [
        'num'   => '03',
        'badge' => '100% Verified · Secure Platform',
        'title' => 'Safe, Private &<br><em>Family-Oriented</em>',
        'sub'   => 'Your privacy is our priority. Contact details stay hidden until you choose to connect. Trusted by thousands of families across Bangladesh.',
        'cta'   => 'Get Started Free',
    ],
];
@endphp

<section class="hero-mag" id="hero">
    <div class="hero-mag-left">
        <div class="hero-mag-slidearea" id="magSlideArea">
            @foreach($magSlides as $i => $slide)
            <div class="hero-mag-slide {{ $i === 0 ? 'mag-active' : '' }}">
                <div class="hero-mag-eyebrow">
                    <span class="hero-mag-eyebrow-dot"></span>
                    {{ $slide['badge'] }}
                </div>
                <div class="hero-mag-slide-num">{{ $slide['num'] }}</div>
                <div class="hero-mag-rule"></div>
                <h1 class="hero-mag-title">{!! $slide['title'] !!}</h1>
                <p class="hero-mag-sub">{{ $slide['sub'] }}</p>
                <div class="hero-mag-actions">
                    @guest
                        <a href="{{ route('register') }}" class="hero-mag-btn-p"><i class="fas fa-heart"></i> {{ $slide['cta'] }}</a>
                        <a href="{{ route('search') }}" class="hero-mag-btn-o"><i class="fas fa-search"></i> Explore</a>
                    @else
                        <a href="{{ route('search') }}" class="hero-mag-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                        <a href="{{ route('member.dashboard') }}" class="hero-mag-btn-o"><i class="fas fa-home"></i> Dashboard</a>
                    @endguest
                </div>
            </div>
            @endforeach
        </div>
        <div class="hero-mag-controls">
            <button class="hero-mag-ctrl" id="magPrev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
            <button class="hero-mag-ctrl" id="magNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
            <div class="hero-mag-track"><div class="hero-mag-fill" id="magFill"></div></div>
            <span class="hero-mag-counter" id="magCounter">1 / {{ count($magSlides) }}</span>
        </div>
    </div>

    <div class="hero-mag-right">
        <div class="hero-mag-right-hero">
            <div class="hero-mag-right-ring hero-mag-right-ring-1"></div>
            <div class="hero-mag-right-ring hero-mag-right-ring-2"></div>
            <div class="hero-mag-featured">
                <div class="hero-mag-feat-num" data-counter data-target="{{ $stats['total_marriages'] }}" data-suffix="+">{{ $stats['total_marriages'] }}</div>
                <div class="hero-mag-feat-label">Successful Marriages</div>
                <div class="hero-mag-feat-divider"></div>
                <div class="hero-mag-feat-sub">Families united across Bangladesh since founding</div>
            </div>
        </div>
        <div class="hero-mag-stats-grid">
            <div class="hero-mag-stat-cell">
                <div class="hero-mag-stat-num" data-counter data-target="{{ $stats['total_members'] }}" data-suffix="+">{{ $stats['total_members'] }}</div>
                <div class="hero-mag-stat-label">Members</div>
            </div>
            <div class="hero-mag-stat-cell">
                <div class="hero-mag-stat-num">100%</div>
                <div class="hero-mag-stat-label">Verified</div>
            </div>
            <div class="hero-mag-stat-cell">
                <div class="hero-mag-stat-num">24/7</div>
                <div class="hero-mag-stat-label">Support</div>
            </div>
            <div class="hero-mag-stat-cell">
                <div class="hero-mag-stat-num">Free</div>
                <div class="hero-mag-stat-label">To Join</div>
            </div>
        </div>
    </div>
</section>

<script>
(function(){
    var TOTAL = {{ count($magSlides) }}, DURATION = 5800, cur = 0, autoTimer = null, fillRaf = null, fillStart = null;
    var slides  = document.querySelectorAll('#magSlideArea .hero-mag-slide');
    var fill    = document.getElementById('magFill');
    var counter = document.getElementById('magCounter');
    var section = document.getElementById('hero');

    function go(n) {
        slides[cur].classList.remove('mag-active');
        cur = (n + TOTAL) % TOTAL;
        slides[cur].classList.add('mag-active');
        counter.textContent = (cur + 1) + ' / ' + TOTAL;
        startFill();
    }

    function startFill() {
        cancelAnimationFrame(fillRaf);
        fill.style.width = '0';
        fillStart = null;
        fillRaf = requestAnimationFrame(function step(ts) {
            if (!fillStart) fillStart = ts;
            var pct = Math.min(100, (ts - fillStart) / DURATION * 100);
            fill.style.width = pct + '%';
            if (pct < 100) fillRaf = requestAnimationFrame(step);
        });
    }

    function startAuto() { stopAuto(); autoTimer = setInterval(function(){ go(cur + 1); }, DURATION); }
    function stopAuto()  { clearInterval(autoTimer); cancelAnimationFrame(fillRaf); fill.style.width = '0'; }

    document.getElementById('magPrev').addEventListener('click', function(){ stopAuto(); go(cur - 1); startAuto(); });
    document.getElementById('magNext').addEventListener('click', function(){ stopAuto(); go(cur + 1); startAuto(); });

    section.addEventListener('mouseenter', stopAuto);
    section.addEventListener('mouseleave', function(){ startFill(); startAuto(); });

    startFill();
    startAuto();
})();
</script>
