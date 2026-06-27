<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — MMMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
        --brand: #B5341A; --brand-dark: #8B2614;
        --gold: #C88B3A;
        --sidebar: #16120F; --sidebar-2: #1F1A16; --sidebar-border: rgba(255,255,255,.07);
        --bg: #F4EFE9; --surface: #FFFFFF; --surface2: #FDF8F4;
        --border: #E8DDD3; --border2: #F0EAE3;
        --text1: #1A1714; --text2: #4A3E35; --text3: #7A6858; --text4: #A89585;
        --success: #2D7A4F; --warning: #C47A1A; --info: #2A6B9A;
        --r-sm: 8px; --r-md: 14px; --r-lg: 20px;
        --sh-sm: 0 1px 4px rgba(26,23,20,.07);
        --sh-md: 0 4px 20px rgba(26,23,20,.09);
        --sh-lg: 0 8px 40px rgba(26,23,20,.12);
        --admin-sidebar-w: 240px;
    }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--text1); font-size: 14.5px; }
    h1,h2,h3,h4,h5 { font-family: 'Playfair Display', Georgia, serif; line-height: 1.3; }
    a { color: inherit; text-decoration: none; }
    img { max-width: 100%; display: block; }

    /* ─── ADMIN SIDEBAR ─── */
    .a-sidebar {
        width: var(--admin-sidebar-w); height: 100vh; position: fixed; top: 0; left: 0; z-index: 100;
        background: var(--sidebar); display: flex; flex-direction: column; overflow-y: auto;
    }
    .a-sidebar-brand {
        padding: 20px 18px; border-bottom: 1px solid var(--sidebar-border);
        display: flex; align-items: center; gap: 10px;
    }
    .a-sidebar-brand-icon {
        width: 34px; height: 34px; border-radius: 8px;
        background: var(--brand); display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: .8rem; flex-shrink: 0;
    }
    .a-sidebar-brand-name { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 700; color: #fff; }
    .a-sidebar-brand-sub { font-size: .68rem; color: rgba(255,255,255,.35); letter-spacing: .04em; }
    .a-nav { flex: 1; padding: 12px 10px; }
    .a-nav-section { font-size: .65rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.28); padding: 10px 10px 4px; }
    .a-nav-link {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 11px; border-radius: 8px;
        font-size: .84rem; font-weight: 500; color: rgba(255,255,255,.55);
        transition: all .15s; margin-bottom: 1px; position: relative;
    }
    .a-nav-link i { width: 18px; text-align: center; font-size: .88rem; flex-shrink: 0; }
    .a-nav-link:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
    .a-nav-link.active { background: rgba(181,52,26,.25); color: #fff; font-weight: 600; }
    .a-nav-link.active::before { content:''; position:absolute; left:0; top:5px; bottom:5px; width:3px; background:var(--brand); border-radius:0 2px 2px 0; }
    .a-nav-badge { margin-left:auto; background:var(--brand); color:#fff; font-size:.65rem; font-weight:700; padding:1px 7px; border-radius:20px; }
    .a-sidebar-footer { padding: 14px 10px; border-top: 1px solid var(--sidebar-border); }
    .a-sidebar-user {
        display: flex; align-items: center; gap: 10px; padding: 10px;
        border-radius: 8px; transition: background .15s; margin-bottom: 8px;
    }
    .a-sidebar-user:hover { background: rgba(255,255,255,.06); }
    .a-sidebar-user img { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1.5px solid rgba(255,255,255,.15); }
    .a-sidebar-user-name { font-size: .83rem; font-weight: 500; color: rgba(255,255,255,.8); }
    .a-sidebar-user-role { font-size: .7rem; color: rgba(255,255,255,.35); }
    .a-logout {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 11px; border-radius: 8px;
        font-size: .84rem; font-weight: 500; color: rgba(255,255,255,.4);
        background: none; border: none; cursor: pointer; font-family: inherit;
        width: 100%; text-align: left; transition: all .15s;
    }
    .a-logout:hover { background: rgba(181,52,26,.2); color: rgba(255,255,255,.8); }
    .a-logout i { width: 18px; text-align: center; font-size: .88rem; }

    /* ─── ADMIN MAIN ─── */
    .a-main { margin-left: var(--admin-sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
    .a-topbar {
        background: var(--surface); border-bottom: 1px solid var(--border2);
        padding: 0 28px; height: 60px;
        display: flex; align-items: center; justify-content: space-between;
        position: sticky; top: 0; z-index: 50;
    }
    .a-topbar-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 600; }
    .a-topbar-right { display: flex; align-items: center; gap: 14px; }
    .a-breadcrumb { font-size: .8rem; color: var(--text4); }
    .a-content { padding: 28px; flex: 1; }

    /* ─── FLASH ─── */
    .flash-stack { position: fixed; top: 70px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 8px; min-width: 300px; }
    .flash-item { display: flex; align-items: flex-start; gap: 12px; padding: 13px 16px; border-radius: var(--r-md); background: var(--surface); border: 1px solid var(--border); box-shadow: var(--sh-lg); font-size: .875rem; animation: fadeSlide .25s ease; }
    @keyframes fadeSlide { from { opacity:0; transform:translateX(16px); } to { opacity:1; transform:none; } }
    .flash-item.success { border-left: 3px solid var(--success); }
    .flash-item.error   { border-left: 3px solid var(--brand); }
    .flash-icon { flex-shrink:0; margin-top:1px; }
    .flash-item.success .flash-icon { color: var(--success); }
    .flash-item.error .flash-icon { color: var(--brand); }
    .flash-close { margin-left:auto; background:none; border:none; cursor:pointer; color:var(--text4); }

    /* ─── COMPONENTS ─── */
    .panel { background: var(--surface); border: 1px solid var(--border2); border-radius: var(--r-lg); overflow: hidden; }
    .panel-header { padding: 16px 20px; border-bottom: 1px solid var(--border2); display: flex; align-items: center; justify-content: space-between; }
    .panel-title { font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 600; }
    .panel-body { padding: 20px; }
    .stat-card { background: var(--surface); border: 1px solid var(--border2); border-radius: var(--r-lg); padding: 20px; }
    .stat-icon-wrap { width: 46px; height: 46px; border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; margin-bottom: 14px; }
    .stat-value { font-family: 'Playfair Display', serif; font-size: 1.85rem; font-weight: 700; line-height: 1; margin-bottom: 4px; }
    .stat-label { font-size: .78rem; color: var(--text3); font-weight: 500; }
    .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 8px 18px; border-radius: var(--r-sm); font-family: 'Inter', sans-serif; font-size: .83rem; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: transform .15s, background .2s; }
    .btn:hover { transform: translateY(-1px); }
    .btn-primary { background: var(--brand); color: #fff; }
    .btn-primary:hover { background: var(--brand-dark); }
    .btn-outline { background: transparent; color: var(--brand); border: 1.5px solid var(--brand); }
    .btn-outline:hover { background: rgba(181,52,26,.06); }
    .btn-ghost { background: transparent; color: var(--text2); border: 1.5px solid var(--border); }
    .btn-ghost:hover { border-color: var(--brand); color: var(--brand); }
    .btn-sm { padding: 5px 12px; font-size: .78rem; }
    .btn-block { width: 100%; }
    .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: .7rem; font-weight: 600; }
    .badge-green { background: rgba(45,122,79,.1); color: var(--success); }
    .badge-red   { background: rgba(181,52,26,.1); color: var(--brand); }
    .badge-gold  { background: rgba(200,139,58,.12); color: #9A6020; }
    .badge-grey  { background: rgba(26,23,20,.07); color: var(--text3); }
    .badge-blue  { background: rgba(42,107,154,.1); color: var(--info); }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th { padding: 10px 16px; font-size: .7rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: var(--text4); background: var(--bg); border-bottom: 1px solid var(--border2); text-align: left; }
    .data-table td { padding: 13px 16px; font-size: .875rem; border-bottom: 1px solid var(--border2); vertical-align: middle; }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background: var(--surface2); }
    .form-label { display: block; font-size: .8rem; font-weight: 600; color: var(--text2); margin-bottom: 6px; }
    .form-control { width: 100%; padding: 9px 13px; border: 1.5px solid var(--border); border-radius: var(--r-sm); font-size: .875rem; font-family: inherit; color: var(--text1); background: var(--surface); transition: border-color .2s, box-shadow .2s; outline: none; }
    .form-control:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(181,52,26,.1); }
    select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237A6858' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; }
    .grid-auto { display: grid; gap: 18px; }
    .grid-2 { grid-template-columns: repeat(2, 1fr); }
    .grid-3 { grid-template-columns: repeat(3, 1fr); }
    .grid-4 { grid-template-columns: repeat(4, 1fr); }
    @media (max-width: 1200px) { .grid-4 { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 900px) { .grid-3 { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px) { .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; } }
    @stack('extra-styles')
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="a-sidebar">
    <div class="a-sidebar-brand">
        <div class="a-sidebar-brand-icon"><i class="fas fa-heart"></i></div>
        <div>
            <div class="a-sidebar-brand-name">MMMS</div>
            <div class="a-sidebar-brand-sub">ADMIN PANEL</div>
        </div>
    </div>

    <nav class="a-nav">
        <div class="a-nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="a-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <div class="a-nav-section">Members</div>
        <a href="{{ route('admin.users.index') }}" class="a-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> All Members
        </a>
        <a href="{{ route('admin.reports.index') }}" class="a-nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <i class="fas fa-flag"></i> Reports
        </a>
        <div class="a-nav-section">Finance</div>
        <a href="{{ route('admin.plans.index') }}" class="a-nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
            <i class="fas fa-crown"></i> Subscription Plans
        </a>
        <div class="a-nav-section">System</div>
        <a href="{{ route('admin.settings.index') }}" class="a-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fas fa-sliders-h"></i> Site Settings
        </a>
        <a href="{{ route('home') }}" class="a-nav-link">
            <i class="fas fa-external-link-alt"></i> View Site
        </a>
    </nav>

    <div class="a-sidebar-footer">
        <div class="a-sidebar-user">
            <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}">
            <div>
                <div class="a-sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="a-sidebar-user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="a-logout"><i class="fas fa-sign-out-alt"></i> Sign Out</button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<div class="a-main">
    <div class="a-topbar">
        <div class="a-topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="a-topbar-right">
            <span class="a-breadcrumb">{{ date('l, F j Y') }}</span>
        </div>
    </div>

    <div class="flash-stack">
        @foreach(['success' => 'circle-check', 'error' => 'circle-xmark', 'warning' => 'triangle-exclamation'] as $type => $icon)
            @if(session($type))
            <div class="flash-item {{ $type }}">
                <i class="fas fa-{{ $icon }} flash-icon"></i>
                <span>{{ session($type) }}</span>
                <button class="flash-close" onclick="this.closest('.flash-item').remove()"><i class="fas fa-xmark"></i></button>
            </div>
            @endif
        @endforeach
    </div>

    <div class="a-content">
        @yield('content')
    </div>
</div>

<script>
document.querySelectorAll('.flash-item').forEach(el => {
    setTimeout(() => { el.style.opacity='0'; el.style.transform='translateX(16px)'; setTimeout(()=>el.remove(),300); }, 4000);
});
function animateCounter(el) {
    const target = parseInt(el.dataset.target || el.textContent.replace(/[^0-9]/g,''));
    const suffix = el.dataset.suffix || '';
    const duration = 1600;
    const start = performance.now();
    function update(now) {
        const p = Math.min((now-start)/duration,1);
        const ease = 1-Math.pow(1-p,3);
        el.textContent = Math.floor(ease*target).toLocaleString() + (p>=1 ? suffix : '');
        if(p<1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
}
new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting) { animateCounter(e.target); } });
}, {threshold:.5}).observe && document.querySelectorAll('[data-counter]').forEach(el => {
    new IntersectionObserver(entries => entries.forEach(e => { if(e.isIntersecting) animateCounter(e.target); }), {threshold:.5}).observe(el);
});
</script>
@stack('scripts')
</body>
</html>
