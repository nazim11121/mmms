@extends('layouts.admin')
@section('title', 'Appearance')
@section('page-title', 'Appearance & Templates')
@section('content')
<style>
.tmpl-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
    gap: 20px;
}
.tmpl-card {
    background: var(--surface);
    border: 2px solid var(--border2);
    border-radius: var(--r-lg);
    overflow: hidden;
    transition: box-shadow .25s, border-color .25s, transform .2s;
    position: relative;
    cursor: default;
}
.tmpl-card:hover { box-shadow: var(--sh-lg); transform: translateY(-2px); }
.tmpl-card.active {
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(181,52,26,.12), var(--sh-md);
}

/* Mini browser */
.tmpl-preview { height: 172px; overflow: hidden; position: relative; flex-shrink: 0; }
.tmpl-browser-chrome {
    height: 26px; display: flex; align-items: center; gap: 4px; padding: 0 10px; flex-shrink: 0;
}
.tmpl-dot { width: 7px; height: 7px; border-radius: 50%; }
.tmpl-url { flex: 1; height: 12px; border-radius: 3px; margin-left: 6px; opacity: .38; }
.tmpl-mock-nav {
    height: 26px; display: flex; align-items: center; padding: 0 12px; gap: 8px;
}
.tmpl-mock-logo { height: 9px; width: 42px; border-radius: 2px; }
.tmpl-mock-links { display: flex; gap: 5px; margin-left: 10px; }
.tmpl-mock-link { height: 6px; width: 24px; border-radius: 2px; opacity: .35; }
.tmpl-mock-btn-nav { height: 14px; width: 38px; border-radius: 3px; margin-left: auto; }
.tmpl-mock-hero {
    height: 62px; margin: 5px 10px; border-radius: 5px;
    display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 5px;
}
.tmpl-mock-h1 { height: 9px; width: 110px; border-radius: 2px; opacity: .85; }
.tmpl-mock-sub { height: 5px; width: 75px; border-radius: 2px; opacity: .45; }
.tmpl-mock-cta { height: 14px; width: 48px; border-radius: 3px; margin-top: 3px; }
.tmpl-mock-cards-row { display: flex; gap: 5px; margin: 0 10px; }
.tmpl-mock-card-mini { flex: 1; height: 24px; border-radius: 4px; opacity: .38; border: 1px solid rgba(0,0,0,.07); }

/* Body */
.tmpl-body { padding: 14px 16px 16px; }
.tmpl-name {
    font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 700;
    color: var(--text1); margin-bottom: 3px;
}
.tmpl-desc { font-size: .75rem; color: var(--text3); line-height: 1.5; margin-bottom: 11px; }
.tmpl-palette { display: flex; gap: 4px; margin-bottom: 11px; }
.tmpl-swatch {
    flex: 1; height: 20px; border-radius: 4px; position: relative; cursor: default;
    transition: transform .15s;
}
.tmpl-swatch:hover { transform: scaleY(1.2); }
.tmpl-font-tag {
    display: inline-flex; align-items: center; gap: 4px;
    background: var(--bg); border: 1px solid var(--border2);
    padding: 2px 7px; border-radius: 20px; font-size: .67rem;
    color: var(--text3); font-weight: 500; margin-bottom: 12px;
}
.tmpl-actions { display: flex; align-items: center; gap: 10px; }
.tmpl-active-badge {
    position: absolute; top: 8px; right: 8px;
    background: var(--brand); color: #fff;
    font-size: .62rem; font-weight: 700; padding: 3px 9px;
    border-radius: 20px; letter-spacing: .04em; text-transform: uppercase;
    display: flex; align-items: center; gap: 4px; z-index: 2;
}
.page-hd { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 22px; gap: 16px; flex-wrap: wrap; }
.page-hd h2 { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; color: var(--text1); margin-bottom: 3px; }
.page-hd p { font-size: .8rem; color: var(--text3); }
</style>

<div class="page-hd">
    <div>
        <h2>Frontend Templates</h2>
        <p>Choose the visual theme for your public website. Changes apply instantly to all visitors.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-ghost btn-sm">
        <i class="fas fa-external-link-alt"></i> Preview Site
    </a>
</div>

<div class="tmpl-grid">

{{-- ─────────────────────────── 1. ELEGANT ROSE ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'elegant-rose' ? 'active' : '' }}">
    @if($activeTheme === 'elegant-rose')<div class="tmpl-active-badge"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#F8F3EE;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#EDE8E3;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#C8BEB5;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:1px solid #E8DDD3;">
                <div class="tmpl-mock-logo" style="background:#B5341A;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#7A6858;"></div><div class="tmpl-mock-link" style="background:#7A6858;"></div><div class="tmpl-mock-link" style="background:#7A6858;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#B5341A;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#B5341A,#8B2614);">
                <div class="tmpl-mock-h1" style="background:#fff;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);"></div>
                <div class="tmpl-mock-cta" style="background:#C88B3A;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;"></div><div class="tmpl-mock-card-mini" style="background:#fff;"></div><div class="tmpl-mock-card-mini" style="background:#fff;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Elegant Rose</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Playfair Display + Inter</div>
        <div class="tmpl-desc">Warm cream canvas with deep crimson and gold. Traditional editorial elegance — the signature look for a premium matrimonial brand.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#B5341A;" title="Brand"></div>
            <div class="tmpl-swatch" style="background:#C88B3A;" title="Gold"></div>
            <div class="tmpl-swatch" style="background:#F8F3EE;" title="BG" ></div>
            <div class="tmpl-swatch" style="background:#1A1714;" title="Text"></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'elegant-rose')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="elegant-rose">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 2. OCEAN BREEZE ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'ocean-breeze' ? 'active' : '' }}">
    @if($activeTheme === 'ocean-breeze')<div class="tmpl-active-badge"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#EEF3FB;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#DCE8F5;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#8AA0B8;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:1px solid #C8D8EE;border-radius:0 18px 0 0;">
                <div class="tmpl-mock-logo" style="background:#1B4E8C;border-radius:18px;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#4A6080;"></div><div class="tmpl-mock-link" style="background:#4A6080;"></div><div class="tmpl-mock-link" style="background:#4A6080;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#1B4E8C;border-radius:18px;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#1B4E8C,#0E2D5A);border-radius:5px 18px 18px 5px;">
                <div class="tmpl-mock-h1" style="background:#fff;border-radius:9px;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);border-radius:9px;"></div>
                <div class="tmpl-mock-cta" style="background:#0891B2;border-radius:9px;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#C8D8EE;border-radius:18px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#C8D8EE;border-radius:18px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#C8D8EE;border-radius:18px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Ocean Breeze</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Libre Baskerville + Inter</div>
        <div class="tmpl-desc">Deep navy and teal on a cool blue-tinted canvas. Rounded corners and crisp whites convey trust, modernity, and reliability.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#1B4E8C;" title="Brand"></div>
            <div class="tmpl-swatch" style="background:#0891B2;" title="Teal"></div>
            <div class="tmpl-swatch" style="background:#EEF3FB;" title="BG"  ></div>
            <div class="tmpl-swatch" style="background:#0E1E36;" title="Text"></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'ocean-breeze')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="ocean-breeze">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 3. MIDNIGHT GOLD ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'midnight-gold' ? 'active' : '' }}" style="{{ $activeTheme === 'midnight-gold' ? 'border-color:#D4AF37;box-shadow:0 0 0 3px rgba(212,175,55,.15),0 4px 20px rgba(0,0,0,.2);' : '' }}">
    @if($activeTheme === 'midnight-gold')<div class="tmpl-active-badge" style="background:#D4AF37;color:#16130E;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#16130E;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#0E0C08;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#3A3020;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(22,19,14,.96);border-bottom:1px solid rgba(212,175,55,.2);">
                <div class="tmpl-mock-logo" style="background:#D4AF37;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#9A8C6A;"></div><div class="tmpl-mock-link" style="background:#9A8C6A;"></div><div class="tmpl-mock-link" style="background:#9A8C6A;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#D4AF37;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,rgba(212,175,55,.12),rgba(212,175,55,.04));border:1px solid rgba(212,175,55,.2);">
                <div class="tmpl-mock-h1" style="background:#F5EFE0;"></div>
                <div class="tmpl-mock-sub" style="background:#6A5C40;"></div>
                <div class="tmpl-mock-cta" style="background:#D4AF37;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#221E17;border-color:rgba(212,175,55,.2);"></div><div class="tmpl-mock-card-mini" style="background:#221E17;border-color:rgba(212,175,55,.2);"></div><div class="tmpl-mock-card-mini" style="background:#221E17;border-color:rgba(212,175,55,.2);"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Midnight Gold</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Cormorant Garamond + Inter</div>
        <div class="tmpl-desc">Dark charcoal with luminous gold. Ultra-premium dark luxury aesthetic — commands attention, exudes exclusivity and high-end prestige.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#D4AF37;" title="Gold"   ></div>
            <div class="tmpl-swatch" style="background:#E8C84A;" title="Light"  ></div>
            <div class="tmpl-swatch" style="background:#221E17;" title="Surface"></div>
            <div class="tmpl-swatch" style="background:#16130E;" title="BG"     ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'midnight-gold')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="midnight-gold">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 4. EMERALD GARDEN ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'emerald-garden' ? 'active' : '' }}">
    @if($activeTheme === 'emerald-garden')<div class="tmpl-active-badge"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#F0F7F2;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#DAEAE0;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#8AB09A;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:1px solid #C8DDD2;">
                <div class="tmpl-mock-logo" style="background:#1E6B47;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#4A7A5A;"></div><div class="tmpl-mock-link" style="background:#4A7A5A;"></div><div class="tmpl-mock-link" style="background:#4A7A5A;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#1E6B47;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#1E6B47,#0F3D28);">
                <div class="tmpl-mock-h1" style="background:#fff;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);"></div>
                <div class="tmpl-mock-cta" style="background:#B5891A;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#C8DDD2;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#C8DDD2;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#C8DDD2;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Emerald Garden</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Lora + Inter</div>
        <div class="tmpl-desc">Fresh forest greens with warm amber gold on a botanical canvas. Evokes nature, growth, and harmony — deeply calming and trustworthy.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#1E6B47;" title="Brand"></div>
            <div class="tmpl-swatch" style="background:#B5891A;" title="Gold" ></div>
            <div class="tmpl-swatch" style="background:#F0F7F2;" title="BG"   ></div>
            <div class="tmpl-swatch" style="background:#0F2B1A;" title="Text" ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'emerald-garden')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="emerald-garden">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 5. ROYAL VIOLET ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'royal-violet' ? 'active' : '' }}">
    @if($activeTheme === 'royal-violet')<div class="tmpl-active-badge" style="background:#6B35A8;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#F7F2FF;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#E8E0F8;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#9A7AB8;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:1px solid #D8CBF0;">
                <div class="tmpl-mock-logo" style="background:#6B35A8;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#6A4A8A;"></div><div class="tmpl-mock-link" style="background:#6A4A8A;"></div><div class="tmpl-mock-link" style="background:#6A4A8A;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#6B35A8;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#6B35A8,#4E2080);">
                <div class="tmpl-mock-h1" style="background:#fff;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);"></div>
                <div class="tmpl-mock-cta" style="background:#C88B3A;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#D8CBF0;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#D8CBF0;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#D8CBF0;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Royal Violet</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> EB Garamond + Inter</div>
        <div class="tmpl-desc">Rich deep violet on soft lavender — regal, mysterious, and sophisticated. The colour of royalty, ceremony, and lasting commitment.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#6B35A8;" title="Brand"  ></div>
            <div class="tmpl-swatch" style="background:#C88B3A;" title="Gold"   ></div>
            <div class="tmpl-swatch" style="background:#F7F2FF;" title="BG"     ></div>
            <div class="tmpl-swatch" style="background:#1A0F2E;" title="Text"   ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'royal-violet')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="royal-violet">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 6. SUNSET CORAL ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'sunset-coral' ? 'active' : '' }}">
    @if($activeTheme === 'sunset-coral')<div class="tmpl-active-badge" style="background:#D4522A;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#FFF6F0;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#FAE8DC;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#B08070;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:1px solid #F0D8CC;border-radius:0 16px 0 0;">
                <div class="tmpl-mock-logo" style="background:#D4522A;border-radius:9px;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#7A4A38;"></div><div class="tmpl-mock-link" style="background:#7A4A38;"></div><div class="tmpl-mock-link" style="background:#7A4A38;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#D4522A;border-radius:9px;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#D4522A,#A83C1A);border-radius:5px 16px 16px 5px;">
                <div class="tmpl-mock-h1" style="background:#fff;border-radius:8px;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);border-radius:8px;"></div>
                <div class="tmpl-mock-cta" style="background:#E8A430;border-radius:8px;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#F0D8CC;border-radius:16px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#F0D8CC;border-radius:16px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#F0D8CC;border-radius:16px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Sunset Coral</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> DM Serif Display + Inter</div>
        <div class="tmpl-desc">Warm coral-orange on a sun-kissed peach canvas. Vibrant, modern, and energetic — radiates warmth, joy, and youthful vitality.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#D4522A;" title="Brand"></div>
            <div class="tmpl-swatch" style="background:#E8A430;" title="Gold" ></div>
            <div class="tmpl-swatch" style="background:#FFF6F0;" title="BG"   ></div>
            <div class="tmpl-swatch" style="background:#1E0F08;" title="Text" ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'sunset-coral')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="sunset-coral">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 7. ARCTIC MINIMAL ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'arctic-minimal' ? 'active' : '' }}" style="{{ $activeTheme === 'arctic-minimal' ? 'border-color:#1A1A1A;box-shadow:0 0 0 3px rgba(0,0,0,.08),0 4px 20px rgba(0,0,0,.1);' : '' }}">
    @if($activeTheme === 'arctic-minimal')<div class="tmpl-active-badge" style="background:#1A1A1A;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#F7F7F7;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#EDEDED;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#9A9A9A;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:1px solid #E4E4E4;">
                <div class="tmpl-mock-logo" style="background:#1A1A1A;border-radius:2px;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#6A6A6A;"></div><div class="tmpl-mock-link" style="background:#6A6A6A;"></div><div class="tmpl-mock-link" style="background:#6A6A6A;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#1A1A1A;border-radius:2px;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:#111111;border-radius:2px;">
                <div class="tmpl-mock-h1" style="background:#fff;border-radius:1px;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.45);border-radius:1px;"></div>
                <div class="tmpl-mock-cta" style="background:#888888;border-radius:2px;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#E4E4E4;border-radius:2px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#E4E4E4;border-radius:2px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#E4E4E4;border-radius:2px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Arctic Minimal</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Inter only (no serif)</div>
        <div class="tmpl-desc">Pure monochrome minimalism — no serifs, sharp corners, near-black on cool white. Bold, confident, and utterly stripped of decoration.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#1A1A1A;" title="Brand"  ></div>
            <div class="tmpl-swatch" style="background:#888888;" title="Silver" ></div>
            <div class="tmpl-swatch" style="background:#F7F7F7;" title="BG"     ></div>
            <div class="tmpl-swatch" style="background:#FFFFFF;border:1px solid #E4E4E4;" title="White"></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'arctic-minimal')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="arctic-minimal">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 8. ROSE BLUSH ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'rose-blush' ? 'active' : '' }}">
    @if($activeTheme === 'rose-blush')<div class="tmpl-active-badge" style="background:#C4366A;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#FFF0F5;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#FAE0EC;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#B08090;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:1px solid #F0CCDA;border-radius:0 16px 0 0;">
                <div class="tmpl-mock-logo" style="background:#C4366A;border-radius:10px;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#7A4A5A;"></div><div class="tmpl-mock-link" style="background:#7A4A5A;"></div><div class="tmpl-mock-link" style="background:#7A4A5A;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#C4366A;border-radius:10px;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#C4366A,#9A2450);border-radius:5px 16px 16px 5px;">
                <div class="tmpl-mock-h1" style="background:#fff;border-radius:8px;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);border-radius:8px;"></div>
                <div class="tmpl-mock-cta" style="background:#D4903A;border-radius:8px;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#F0CCDA;border-radius:16px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#F0CCDA;border-radius:16px;"></div><div class="tmpl-mock-card-mini" style="background:#fff;border-color:#F0CCDA;border-radius:16px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Rose Blush</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Merriweather + Inter</div>
        <div class="tmpl-desc">Deep rose-pink on the softest blush canvas. Romantic, premium, and feminine — radiates intimacy, care, and heartfelt sincerity.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#C4366A;" title="Brand"></div>
            <div class="tmpl-swatch" style="background:#D4903A;" title="Gold" ></div>
            <div class="tmpl-swatch" style="background:#FFF0F5;" title="BG"   ></div>
            <div class="tmpl-swatch" style="background:#1E0A14;" title="Text" ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'rose-blush')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="rose-blush">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>


{{-- ─────────────────────────── 9. GLASSMORPHISM ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'glassmorphism' ? 'active' : '' }}" style="{{ $activeTheme === 'glassmorphism' ? 'border-color:#A78BFA;box-shadow:0 0 0 3px rgba(167,139,250,.15),0 4px 20px rgba(0,0,0,.15);' : '' }}">
    @if($activeTheme === 'glassmorphism')<div class="tmpl-active-badge" style="background:#7C3AED;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:linear-gradient(135deg,#0f0c29,#302b63,#24243e);height:100%;">
            <div class="tmpl-browser-chrome" style="background:rgba(0,0,0,.4);">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:rgba(255,255,255,.2);"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.06);backdrop-filter:blur(12px);border-bottom:1px solid rgba(255,255,255,.1);">
                <div class="tmpl-mock-logo" style="background:#A78BFA;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:rgba(255,255,255,.45);"></div><div class="tmpl-mock-link" style="background:rgba(255,255,255,.45);"></div><div class="tmpl-mock-link" style="background:rgba(255,255,255,.45);"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#A78BFA;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:rgba(255,255,255,.08);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15);border-radius:12px;margin:5px 10px;">
                <div class="tmpl-mock-h1" style="background:rgba(255,255,255,.9);border-radius:6px;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.4);border-radius:6px;"></div>
                <div class="tmpl-mock-cta" style="background:#A78BFA;border-radius:6px;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.18);border-radius:12px;backdrop-filter:blur(8px);"></div>
                <div class="tmpl-mock-card-mini" style="background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.18);border-radius:12px;"></div>
                <div class="tmpl-mock-card-mini" style="background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.18);border-radius:12px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Glassmorphism</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Playfair Display + Inter</div>
        <div class="tmpl-desc">Animated deep-space gradient canvas with frosted glass panels. Every card and nav bar is a translucent pane — ultra-modern, immersive, otherworldly.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#A78BFA;" title="Violet" ></div>
            <div class="tmpl-swatch" style="background:#F59E0B;" title="Gold"   ></div>
            <div class="tmpl-swatch" style="background:linear-gradient(135deg,#0f0c29,#302b63);" title="BG"></div>
            <div class="tmpl-swatch" style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);" title="Glass"></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'glassmorphism')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="glassmorphism">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 10. CORPORATE FLAT ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'corporate-flat' ? 'active' : '' }}" style="{{ $activeTheme === 'corporate-flat' ? 'border-color:#0057B7;box-shadow:0 0 0 3px rgba(0,87,183,.1),0 4px 20px rgba(0,0,0,.08);' : '' }}">
    @if($activeTheme === 'corporate-flat')<div class="tmpl-active-badge" style="background:#0057B7;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#F0F2F5;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#E4E7EC;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#96A0AD;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:#fff;border-bottom:2px solid #0057B7;border-radius:0;">
                <div class="tmpl-mock-logo" style="background:#0057B7;border-radius:0;height:8px;width:60px;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#5A6472;border-radius:0;"></div><div class="tmpl-mock-link" style="background:#5A6472;border-radius:0;"></div><div class="tmpl-mock-link" style="background:#5A6472;border-radius:0;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#0057B7;border-radius:1px;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:#0057B7;border-radius:0;margin:5px 10px;">
                <div class="tmpl-mock-h1" style="background:#fff;border-radius:0;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);border-radius:0;"></div>
                <div class="tmpl-mock-cta" style="background:#F59E0B;border-radius:1px;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#D4D8DE;border-radius:1px;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#D4D8DE;border-radius:1px;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#D4D8DE;border-radius:1px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Corporate Flat</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Inter only (no serif)</div>
        <div class="tmpl-desc">Pure flat design — zero shadows, zero border radius, sharp edges everywhere. Corporate navy on clean white: maximum professional credibility.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#0057B7;" title="Navy"   ></div>
            <div class="tmpl-swatch" style="background:#F59E0B;" title="Amber"  ></div>
            <div class="tmpl-swatch" style="background:#F0F2F5;" title="BG"     ></div>
            <div class="tmpl-swatch" style="background:#0A0E14;" title="Text"   ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'corporate-flat')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="corporate-flat">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 11. SAFFRON SPICE ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'saffron-spice' ? 'active' : '' }}" style="{{ $activeTheme === 'saffron-spice' ? 'border-color:#D4840A;box-shadow:0 0 0 3px rgba(212,132,10,.12),0 4px 20px rgba(30,14,0,.1);' : '' }}">
    @if($activeTheme === 'saffron-spice')<div class="tmpl-active-badge" style="background:#D4840A;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#FFFBF0;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#F5EDD0;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#B89860;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,251,240,.95);border-bottom:2px solid rgba(212,132,10,.3);">
                <div class="tmpl-mock-logo" style="background:#D4840A;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#7A5A28;"></div><div class="tmpl-mock-link" style="background:#7A5A28;"></div><div class="tmpl-mock-link" style="background:#7A5A28;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#D4840A;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#D4840A,#A86208);">
                <div class="tmpl-mock-h1" style="background:#fff;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);"></div>
                <div class="tmpl-mock-cta" style="background:#C47A1A;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#ECD9A8;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#ECD9A8;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#ECD9A8;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Saffron Spice</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Playfair Display + Inter</div>
        <div class="tmpl-desc">Warm turmeric saffron on ivory cream — rooted in South Asian tradition. Evokes festivity, auspiciousness, and the warmth of family celebrations.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#D4840A;" title="Saffron"></div>
            <div class="tmpl-swatch" style="background:#C47A1A;" title="Gold"   ></div>
            <div class="tmpl-swatch" style="background:#FFFBF0;" title="Ivory"  ></div>
            <div class="tmpl-swatch" style="background:#1E0E00;" title="Mahog." ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'saffron-spice')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="saffron-spice">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 12. NEON NOIR ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'neon-noir' ? 'active' : '' }}" style="{{ $activeTheme === 'neon-noir' ? 'border-color:#00E5CC;box-shadow:0 0 0 3px rgba(0,229,204,.15),0 0 32px rgba(0,229,204,.12);' : '' }}">
    @if($activeTheme === 'neon-noir')<div class="tmpl-active-badge" style="background:#00E5CC;color:#07090E;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#07090E;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#030507;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#384858;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(7,9,14,.92);border-bottom:1px solid rgba(0,229,204,.2);box-shadow:0 1px 0 rgba(0,229,204,.1);">
                <div class="tmpl-mock-logo" style="background:#00E5CC;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#6A8098;"></div><div class="tmpl-mock-link" style="background:#6A8098;"></div><div class="tmpl-mock-link" style="background:#6A8098;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#00E5CC;border:none;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:#0E1118;border:1px solid rgba(0,229,204,.2);margin:5px 10px;border-radius:6px;box-shadow:0 0 20px rgba(0,229,204,.12);">
                <div class="tmpl-mock-h1" style="background:#E8F0F8;border-radius:2px;"></div>
                <div class="tmpl-mock-sub" style="background:#6A8098;border-radius:2px;"></div>
                <div class="tmpl-mock-cta" style="background:#00E5CC;border-radius:2px;box-shadow:0 0 8px rgba(0,229,204,.5);"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#0E1118;border-color:rgba(0,229,204,.2);border-radius:6px;"></div>
                <div class="tmpl-mock-card-mini" style="background:#0E1118;border-color:rgba(0,229,204,.2);border-radius:6px;"></div>
                <div class="tmpl-mock-card-mini" style="background:#0E1118;border-color:rgba(0,229,204,.2);border-radius:6px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Neon Noir</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Rajdhani + Inter</div>
        <div class="tmpl-desc">Near-black darkness lit by neon cyan glow. Uppercase Rajdhani headings, glowing CTA buttons, and neon border pulses — cyberpunk meets matrimonial.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#00E5CC;box-shadow:0 0 8px rgba(0,229,204,.5);" title="Neon"></div>
            <div class="tmpl-swatch" style="background:#FFD700;" title="Gold"  ></div>
            <div class="tmpl-swatch" style="background:#0E1118;" title="Surface"></div>
            <div class="tmpl-swatch" style="background:#07090E;" title="BG"    ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'neon-noir')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="neon-noir">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 13. SOFT PASTEL ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'soft-pastel' ? 'active' : '' }}" style="{{ $activeTheme === 'soft-pastel' ? 'border-color:#9B59B6;box-shadow:0 0 0 3px rgba(155,89,182,.12),0 4px 20px rgba(155,89,182,.1);' : '' }}">
    @if($activeTheme === 'soft-pastel')<div class="tmpl-active-badge" style="background:#9B59B6;border-radius:20px;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#FBF5FF;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#F2E8FA;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#B09CC8;border-radius:8px;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:rgba(255,255,255,.92);border-bottom:2px solid #E8D5F5;border-radius:0 32px 0 0;">
                <div class="tmpl-mock-logo" style="background:#9B59B6;border-radius:48px;height:10px;width:50px;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#7B5EA7;border-radius:48px;"></div><div class="tmpl-mock-link" style="background:#7B5EA7;border-radius:48px;"></div><div class="tmpl-mock-link" style="background:#7B5EA7;border-radius:48px;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#9B59B6;border-radius:48px;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:linear-gradient(135deg,#9B59B6,#7D3C98);border-radius:5px 32px 32px 5px;">
                <div class="tmpl-mock-h1" style="background:#fff;border-radius:24px;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.55);border-radius:24px;"></div>
                <div class="tmpl-mock-cta" style="background:#F39C12;border-radius:48px;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#E8D5F5;border-radius:28px;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#E8D5F5;border-radius:28px;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border-color:#E8D5F5;border-radius:28px;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Soft Pastel</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Nunito + Nunito</div>
        <div class="tmpl-desc">Dreamy lavender canvas with extreme pill-shaped corners on every button and card. Rounded, friendly Nunito font — gentle, warm, and utterly approachable.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#9B59B6;" title="Violet" ></div>
            <div class="tmpl-swatch" style="background:#F39C12;" title="Amber"  ></div>
            <div class="tmpl-swatch" style="background:#FBF5FF;" title="Lavender"></div>
            <div class="tmpl-swatch" style="background:#2C1A3E;" title="Text"   ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'soft-pastel')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="soft-pastel">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

{{-- ─────────────────────────── 14. BOLD EDITORIAL ─────────────────────────── --}}
<div class="tmpl-card {{ $activeTheme === 'bold-editorial' ? 'active' : '' }}" style="{{ $activeTheme === 'bold-editorial' ? 'border-color:#D40000;box-shadow:0 0 0 3px rgba(212,0,0,.1),0 4px 20px rgba(0,0,0,.08);' : '' }}">
    @if($activeTheme === 'bold-editorial')<div class="tmpl-active-badge" style="background:#D40000;border-radius:0;"><i class="fas fa-check"></i> Active</div>@endif
    <div class="tmpl-preview">
        <div style="background:#FFFFFF;height:100%;">
            <div class="tmpl-browser-chrome" style="background:#F0F0F0;">
                <div class="tmpl-dot" style="background:#FF6057;"></div><div class="tmpl-dot" style="background:#FEBC2E;"></div><div class="tmpl-dot" style="background:#28C840;"></div>
                <div class="tmpl-url" style="background:#999;border-radius:0;"></div>
            </div>
            <div class="tmpl-mock-nav" style="background:#fff;border-bottom:3px solid #0A0A0A;border-radius:0;">
                <div class="tmpl-mock-logo" style="background:#0A0A0A;border-radius:0;border-left:3px solid #D40000;height:12px;width:55px;margin-left:3px;"></div>
                <div class="tmpl-mock-links"><div class="tmpl-mock-link" style="background:#5A5A5A;border-radius:0;height:5px;"></div><div class="tmpl-mock-link" style="background:#5A5A5A;border-radius:0;height:5px;"></div><div class="tmpl-mock-link" style="background:#5A5A5A;border-radius:0;height:5px;"></div></div>
                <div class="tmpl-mock-btn-nav" style="background:#D40000;border-radius:0;"></div>
            </div>
            <div class="tmpl-mock-hero" style="background:#0A0A0A;border-radius:0;margin:5px 10px;">
                <div class="tmpl-mock-h1" style="background:#fff;border-radius:0;height:12px;width:130px;"></div>
                <div class="tmpl-mock-sub" style="background:rgba(255,255,255,.4);border-radius:0;"></div>
                <div class="tmpl-mock-cta" style="background:#D40000;border-radius:0;border:none;"></div>
            </div>
            <div class="tmpl-mock-cards-row">
                <div class="tmpl-mock-card-mini" style="background:#fff;border:1.5px solid #D0D0D0;border-radius:0;box-shadow:3px 3px 0 #1A1A1A;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border:1.5px solid #D0D0D0;border-radius:0;box-shadow:3px 3px 0 #1A1A1A;"></div>
                <div class="tmpl-mock-card-mini" style="background:#fff;border:1.5px solid #D0D0D0;border-radius:0;box-shadow:3px 3px 0 #1A1A1A;"></div>
            </div>
        </div>
    </div>
    <div class="tmpl-body">
        <div class="tmpl-name">Bold Editorial</div>
        <div class="tmpl-font-tag"><i class="fas fa-font"></i> Playfair Display 900 + Inter</div>
        <div class="tmpl-desc">High-contrast ink-red on stark white with heavy rules and offset shadows. Inspired by Vogue and broadsheet newspapers — commanding and authoritative.</div>
        <div class="tmpl-palette">
            <div class="tmpl-swatch" style="background:#D40000;" title="Red"    ></div>
            <div class="tmpl-swatch" style="background:#B8860B;" title="Gold"   ></div>
            <div class="tmpl-swatch" style="background:#FFFFFF;border:1.5px solid #D0D0D0;" title="White"></div>
            <div class="tmpl-swatch" style="background:#0A0A0A;" title="Ink"    ></div>
        </div>
        <div class="tmpl-actions">
            @if($activeTheme !== 'bold-editorial')
            <form method="POST" action="{{ route('admin.settings.template.update') }}">@csrf<input type="hidden" name="theme" value="bold-editorial">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Activate</button>
            </form>
            @else
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;color:var(--success);"><i class="fas fa-circle-check"></i> Currently Active</span>
            @endif
        </div>
    </div>
</div>

</div>{{-- /tmpl-grid --}}

<div class="panel" style="margin-top:24px;padding:16px 20px;">
    <div style="display:flex;align-items:center;gap:12px;">
        <div style="width:34px;height:34px;background:rgba(42,107,154,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--info);flex-shrink:0;">
            <i class="fas fa-circle-info"></i>
        </div>
        <div style="font-size:.8rem;color:var(--text3);line-height:1.55;">
            <strong style="color:var(--text2);">How themes work:</strong>
            Each theme overrides the public site's color palette, typography (heading font), and visual rhythm — border radii, shadows, spacing. The admin panel always keeps its own fixed design. Changes apply instantly — no rebuild, no cache flush needed. Fonts load from Google Fonts CDN.
        </div>
    </div>
</div>
@endsection
