@push('styles')
<style>
.hero-cin {
    min-height: 100vh; position: relative; overflow: hidden;
    background: var(--brand);
}
.hero-cin-slide {
    position: absolute; inset: 0; display: flex; align-items: center;
    opacity: 0; transition: opacity 1s ease;
    pointer-events: none;
}
.hero-cin-slide.cin-active { opacity: 1; pointer-events: auto; }
.hero-cin-slide:nth-child(1) { background: linear-gradient(140deg, var(--brand) 0%, var(--brand-dark) 55%, rgba(0,0,0,.82) 100%); }
.hero-cin-slide:nth-child(2) { background: linear-gradient(225deg, var(--brand) 0%, rgba(0,0,0,.88) 55%, var(--brand-dark) 100%); }
.hero-cin-slide:nth-child(3) { background: linear-gradient(170deg, rgba(0,0,0,.78) 0%, var(--brand-dark) 45%, var(--brand) 100%); }
.hero-cin-dots-bg {
    position: absolute; inset: 0; pointer-events: none;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 28px 28px;
}
.hero-cin-ring {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.07); pointer-events: none;
    right: 4%; top: 50%; transform: translateY(-50%);
}
.hero-cin-ring-1 { width: 480px; height: 480px; }
.hero-cin-ring-2 { width: 740px; height: 740px; }
.hero-cin-ring-3 { width: 1020px; height: 1020px; animation: cinRingSpin 40s linear infinite; transform-origin: center center; }
@keyframes cinRingSpin { from{ transform: translateY(-50%) rotate(0deg); } to{ transform: translateY(-50%) rotate(360deg); } }
.hero-cin-content { position: relative; z-index: 1; max-width: 660px; padding-top:80px; padding-bottom:80px; }
.hero-cin-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
    padding: 6px 16px; border-radius: 40px; margin-bottom: 28px;
    font-size: .76rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase;
    color: rgba(255,255,255,.85);
}
.hero-cin-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: rgba(255,220,100,.9); flex-shrink: 0; animation: heroPulse 2s ease infinite; }
.hero-cin-title {
    font-size: clamp(2.6rem, 5vw, 4.2rem); font-weight: 700; color: #fff;
    line-height: 1.1; margin-bottom: 22px; text-wrap: balance;
}
.hero-cin-title em { font-style: italic; color: var(--gold-light, #F0C865); }
.hero-cin-sub { font-size: 1.05rem; color: rgba(255,255,255,.7); line-height: 1.72; margin-bottom: 38px; max-width: 520px; }
.hero-cin-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 52px; }
.hero-cin-btn-p {
    padding: 14px 32px; background: #fff; color: var(--brand);
    border-radius: var(--r-md); font-weight: 700; font-size: .95rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: transform .2s, box-shadow .2s; box-shadow: 0 4px 24px rgba(0,0,0,.22);
}
.hero-cin-btn-p:hover { transform: translateY(-2px); box-shadow: 0 8px 36px rgba(0,0,0,.32); }
.hero-cin-btn-o {
    padding: 14px 28px; border: 1.5px solid rgba(255,255,255,.38);
    border-radius: var(--r-md); font-weight: 600; font-size: .95rem; color: #fff;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: background .2s, border-color .2s;
}
.hero-cin-btn-o:hover { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.7); }
.hero-cin-trust { display: flex; flex-wrap: wrap; gap: 24px; }
.hero-cin-trust span { display: flex; align-items: center; gap: 8px; font-size: .82rem; color: rgba(255,255,255,.58); }
.hero-cin-trust i { color: rgba(255,220,100,.8); }
/* Progress bar */
.hero-cin-bar {
    position: absolute; top: 0; left: 0; height: 3px; z-index: 20;
    background: rgba(255,255,255,.55); width: 0; will-change: width;
}
/* Arrows */
.hero-cin-arrow {
    position: absolute; top: 50%; transform: translateY(-50%);
    width: 52px; height: 52px; border-radius: 50%;
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2);
    backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center;
    cursor: pointer; z-index: 15; color: #fff; font-size: 1rem;
    transition: background .2s; user-select: none; outline: none;
}
.hero-cin-arrow:hover { background: rgba(255,255,255,.22); }
.hero-cin-arrow.prev { left: 24px; }
.hero-cin-arrow.next { right: 24px; }
/* Dot indicators */
.hero-cin-dots {
    position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
    display: flex; gap: 8px; z-index: 15; align-items: center;
}
.hero-cin-dot {
    width: 8px; height: 8px; border-radius: 4px;
    background: rgba(255,255,255,.3); border: none; cursor: pointer;
    transition: all .35s cubic-bezier(.4,0,.2,1); padding: 0;
}
.hero-cin-dot.cin-active { width: 28px; background: #fff; }
/* Side tick markers */
.hero-cin-ticks {
    position: absolute; top: 50%; right: 56px; transform: translateY(-50%);
    display: flex; flex-direction: column; gap: 14px; z-index: 15;
}
.hero-cin-tick {
    width: 2px; height: 18px; background: rgba(255,255,255,.2);
    border-radius: 1px; transition: all .35s; cursor: pointer; border: none; padding: 0;
}
.hero-cin-tick.cin-active { height: 38px; background: #fff; }
@media (max-width: 768px) { .hero-cin-arrow,.hero-cin-ticks{ display:none; } }
</style>
@endpush

@php
$cinSlides = [
    [
        'badge' => $heroSettings['badge']      ?? "Bangladesh's Trusted Matrimonial Platform",
        'title' => $heroSettings['title_html'] ?? 'Find Your <em>Perfect</em><br>Life Partner',
        'sub'   => $heroSettings['subtitle']   ?? 'Join thousands of families who found their match through MMMS — safe, verified, and family-oriented.',
        'cta'   => $heroSettings['cta_primary'] ?? 'Register Free',
    ],
    [
        'badge' => number_format($stats['total_marriages'] ?? 0) . '+ Successful Marriages',
        'title' => 'Thousands of <em>Happy</em><br>Families United',
        'sub'   => 'MMMS has connected countless hearts across Bangladesh. Your perfect match could be just one profile away — start browsing today.',
        'cta'   => 'Browse Profiles',
    ],
    [
        'badge' => '100% Verified · Safe & Private',
        'title' => 'A Platform Your<br><em>Family</em> Can Trust',
        'sub'   => 'Every profile is verified and contact details stay private until you choose to share them. Family-first, always.',
        'cta'   => 'Get Started Free',
    ],
];
@endphp

<section class="hero-cin" id="hero">
    <div class="hero-cin-bar" id="cinBar"></div>

    @foreach($cinSlides as $i => $slide)
    <div class="hero-cin-slide {{ $i === 0 ? 'cin-active' : '' }}">
        <div class="hero-cin-dots-bg"></div>
        <div class="hero-cin-ring hero-cin-ring-1"></div>
        <div class="hero-cin-ring hero-cin-ring-2"></div>
        <div class="hero-cin-ring hero-cin-ring-3"></div>
        <div class="container">
            <div class="hero-cin-content">
                <div class="hero-cin-badge"><span class="hero-cin-badge-dot"></span>{{ $slide['badge'] }}</div>
                <h1 class="hero-cin-title">{!! $slide['title'] !!}</h1>
                <p class="hero-cin-sub">{{ $slide['sub'] }}</p>
                <div class="hero-cin-actions">
                    @guest
                        <a href="{{ route('register') }}" class="hero-cin-btn-p"><i class="fas fa-heart"></i> {{ $slide['cta'] }}</a>
                        <a href="{{ route('search') }}" class="hero-cin-btn-o"><i class="fas fa-search"></i> Browse Profiles</a>
                    @else
                        <a href="{{ route('search') }}" class="hero-cin-btn-p"><i class="fas fa-search"></i> Browse Profiles</a>
                        <a href="{{ route('member.dashboard') }}" class="hero-cin-btn-o"><i class="fas fa-home"></i> My Dashboard</a>
                    @endguest
                </div>
                <div class="hero-cin-trust">
                    <span><i class="fas fa-shield-alt"></i> Verified Profiles</span>
                    <span><i class="fas fa-lock"></i> Private & Secure</span>
                    <span><i class="fas fa-headset"></i> 24/7 Support</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <button class="hero-cin-arrow prev" id="cinPrev" aria-label="Previous slide"><i class="fas fa-chevron-left"></i></button>
    <button class="hero-cin-arrow next" id="cinNext" aria-label="Next slide"><i class="fas fa-chevron-right"></i></button>

    <div class="hero-cin-ticks" id="cinTicks">
        <button class="hero-cin-tick cin-active" aria-label="Slide 1"></button>
        <button class="hero-cin-tick" aria-label="Slide 2"></button>
        <button class="hero-cin-tick" aria-label="Slide 3"></button>
    </div>

    <div class="hero-cin-dots" id="cinDots">
        <button class="hero-cin-dot cin-active" aria-label="Slide 1"></button>
        <button class="hero-cin-dot" aria-label="Slide 2"></button>
        <button class="hero-cin-dot" aria-label="Slide 3"></button>
    </div>
</section>

<script>
(function(){
    var TOTAL = 3, DURATION = 5500, cur = 0, autoTimer = null, barRaf = null, barStart = null;
    var slides = document.querySelectorAll('.hero-cin-slide');
    var dots   = document.querySelectorAll('#cinDots .hero-cin-dot');
    var ticks  = document.querySelectorAll('#cinTicks .hero-cin-tick');
    var bar    = document.getElementById('cinBar');
    var section = document.getElementById('hero');

    function setActive(n) {
        [slides, dots, ticks].forEach(function(list) {
            list[cur].classList.remove('cin-active');
            list[n].classList.add('cin-active');
        });
        cur = n;
    }

    function startBar() {
        cancelAnimationFrame(barRaf);
        bar.style.transition = 'none';
        bar.style.width = '0';
        barStart = null;
        barRaf = requestAnimationFrame(function step(ts) {
            if (!barStart) barStart = ts;
            var pct = Math.min(100, (ts - barStart) / DURATION * 100);
            bar.style.transition = 'none';
            bar.style.width = pct + '%';
            if (pct < 100) barRaf = requestAnimationFrame(step);
        });
    }

    function go(n) {
        setActive((n + TOTAL) % TOTAL);
        startBar();
    }
    function next() { go(cur + 1); }

    function startAuto() { autoTimer = setInterval(next, DURATION); }
    function stopAuto()  { clearInterval(autoTimer); cancelAnimationFrame(barRaf); bar.style.width = '0'; }

    document.getElementById('cinPrev').addEventListener('click', function(){ stopAuto(); go(cur - 1); startAuto(); });
    document.getElementById('cinNext').addEventListener('click', function(){ stopAuto(); go(cur + 1); startAuto(); });
    dots.forEach(function(d, i){ d.addEventListener('click', function(){ stopAuto(); go(i); startAuto(); }); });
    ticks.forEach(function(t, i){ t.addEventListener('click', function(){ stopAuto(); go(i); startAuto(); }); });

    section.addEventListener('mouseenter', stopAuto);
    section.addEventListener('mouseleave', function(){ startBar(); startAuto(); });

    startBar();
    startAuto();
})();
</script>
