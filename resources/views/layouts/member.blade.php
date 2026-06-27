<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Member Area') — MMMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
        --brand: #B5341A; --brand-dark: #8B2614;
        --gold: #C88B3A;
        --bg: #F8F3EE; --surface: #FFFFFF; --surface2: #FDF8F4;
        --border: #E8DDD3; --border2: #F0EAE3;
        --text1: #1A1714; --text2: #4A3E35; --text3: #7A6858; --text4: #A89585;
        --success: #2D7A4F; --warning: #C47A1A;
        --r-sm: 8px; --r-md: 14px; --r-lg: 20px;
        --sh-sm: 0 1px 4px rgba(26,23,20,.07);
        --sh-md: 0 4px 20px rgba(26,23,20,.09);
        --sh-lg: 0 8px 40px rgba(26,23,20,.12);
        --sidebar-w: 256px;
    }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--text1); font-size: 14.5px; }
    h1,h2,h3,h4,h5 { font-family: 'Playfair Display', Georgia, serif; line-height: 1.3; }
    a { color: inherit; }
    img { max-width: 100%; display: block; }

    /* ─── SIDEBAR ─── */
    .m-sidebar {
        width: var(--sidebar-w); height: 100vh; position: fixed; top: 0; left: 0; z-index: 100;
        background: var(--surface); border-right: 1px solid var(--border2);
        display: flex; flex-direction: column; overflow-y: auto;
    }
    .sidebar-top {
        padding: 28px 20px 24px;
        background: linear-gradient(145deg, #B5341A 0%, #7D1F3A 60%, #4A1040 100%);
        position: relative; overflow: hidden;
    }
    .sidebar-top::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 22px 22px;
    }
    .sidebar-avatar-wrap { position: relative; width: 72px; height: 72px; margin-bottom: 14px; }
    .sidebar-avatar {
        width: 72px; height: 72px; border-radius: 50%; object-fit: cover;
        border: 3px solid rgba(255,255,255,.4);
        position: relative; z-index: 1;
    }
    .sidebar-avatar-ring {
        position: absolute; inset: -5px; border-radius: 50%;
        border: 2px solid rgba(255,255,255,.15);
    }
    .sidebar-name { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 600; color: #fff; margin-bottom: 3px; position: relative; }
    .sidebar-role {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: .72rem; font-weight: 600; letter-spacing: .04em;
        position: relative;
    }
    .sidebar-role.premium { color: var(--gold); }
    .sidebar-role.free { color: rgba(255,255,255,.6); }
    .completeness-wrap { margin-top: 14px; position: relative; }
    .completeness-label { display: flex; justify-content: space-between; font-size: .72rem; color: rgba(255,255,255,.7); margin-bottom: 5px; }
    .completeness-bar { height: 5px; border-radius: 3px; background: rgba(255,255,255,.2); overflow: hidden; }
    .completeness-fill { height: 100%; border-radius: 3px; background: linear-gradient(90deg, #E8A84E, #F0C865); transition: width 1s ease; }
    .sidebar-nav { flex: 1; padding: 12px 10px; }
    .nav-section-label { font-size: .68rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--text4); padding: 10px 12px 4px; }
    .sidebar-link {
        display: flex; align-items: center; gap: 11px;
        padding: 10px 12px; border-radius: var(--r-sm);
        font-size: .875rem; font-weight: 500; color: var(--text3);
        text-decoration: none; transition: all .15s;
        margin-bottom: 1px; position: relative;
    }
    .sidebar-link i { width: 18px; text-align: center; font-size: .9rem; transition: color .15s; }
    .sidebar-link:hover { background: var(--bg); color: var(--text1); }
    .sidebar-link:hover i { color: var(--brand); }
    .sidebar-link.active { background: rgba(181,52,26,.08); color: var(--brand); font-weight: 600; }
    .sidebar-link.active i { color: var(--brand); }
    .sidebar-link.active::before {
        content: ''; position: absolute; left: 0; top: 6px; bottom: 6px;
        width: 3px; border-radius: 0 2px 2px 0; background: var(--brand);
    }
    .sidebar-badge {
        margin-left: auto; background: var(--brand); color: #fff;
        font-size: .68rem; font-weight: 700; padding: 1px 7px; border-radius: 20px;
    }
    .sidebar-bottom { padding: 16px 10px; border-top: 1px solid var(--border2); }
    .sidebar-logout {
        display: flex; align-items: center; gap: 11px;
        padding: 10px 12px; border-radius: var(--r-sm);
        font-size: .875rem; font-weight: 500; color: var(--text3);
        width: 100%; background: none; border: none; cursor: pointer;
        font-family: inherit; transition: all .15s;
    }
    .sidebar-logout:hover { background: rgba(181,52,26,.08); color: var(--brand); }
    .sidebar-logout i { width: 18px; text-align: center; }

    /* ─── MAIN ─── */
    .m-main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
    .m-topbar {
        background: var(--surface); border-bottom: 1px solid var(--border2);
        padding: 0 28px; height: 60px;
        display: flex; align-items: center; justify-content: space-between;
        position: sticky; top: 0; z-index: 50;
    }
    .topbar-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 600; color: var(--text1); }
    .topbar-actions { display: flex; align-items: center; gap: 10px; }
    .topbar-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 7px 16px; border-radius: var(--r-sm);
        font-size: .8rem; font-weight: 600; font-family: inherit;
        background: var(--brand); color: #fff; border: none; cursor: pointer;
        text-decoration: none; transition: background .2s;
    }
    .topbar-btn:hover { background: var(--brand-dark); }
    .m-content { padding: 28px; flex: 1; }

    /* ─── FLASH ─── */
    .flash-stack {
        position: fixed; top: 70px; right: 20px; z-index: 9999;
        display: flex; flex-direction: column; gap: 8px; min-width: 300px;
    }
    .flash-item {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 13px 16px; border-radius: var(--r-md);
        background: var(--surface); border: 1px solid var(--border);
        box-shadow: var(--sh-lg); font-size: .875rem;
        animation: fadeSlide .25s ease;
    }
    @keyframes fadeSlide { from { opacity:0; transform: translateX(16px); } to { opacity:1; transform: none; } }
    .flash-item.success { border-left: 3px solid var(--success); }
    .flash-item.error   { border-left: 3px solid var(--brand); }
    .flash-icon { flex-shrink:0; margin-top:1px; }
    .flash-item.success .flash-icon { color: var(--success); }
    .flash-item.error .flash-icon { color: var(--brand); }
    .flash-close { margin-left:auto; background:none; border:none; cursor:pointer; color:var(--text4); }

    /* ─── CARD ─── */
    .panel { background: var(--surface); border: 1px solid var(--border2); border-radius: var(--r-lg); }
    .panel-header { padding: 18px 24px 0; display: flex; align-items: center; justify-content: space-between; }
    .panel-title { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 600; }
    .panel-body { padding: 20px 24px; }
    .panel-body-flush { padding: 0; }

    /* ─── STAT CARD ─── */
    .stat-card {
        background: var(--surface); border: 1px solid var(--border2);
        border-radius: var(--r-lg); padding: 20px;
        display: flex; flex-direction: column; gap: 10px;
    }
    .stat-icon-wrap {
        width: 46px; height: 46px; border-radius: var(--r-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }
    .stat-value { font-family: 'Playfair Display', serif; font-size: 1.85rem; font-weight: 700; line-height: 1; }
    .stat-label { font-size: .78rem; font-weight: 500; color: var(--text3); }

    /* ─── BUTTONS ─── */
    .btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 7px;
        padding: 9px 20px; border-radius: var(--r-sm);
        font-family: 'Inter', sans-serif; font-size: .83rem; font-weight: 600;
        cursor: pointer; border: none; text-decoration: none;
        transition: transform .15s, background .2s, border-color .2s;
    }
    .btn:hover { transform: translateY(-1px); }
    .btn-primary { background: var(--brand); color: #fff; }
    .btn-primary:hover { background: var(--brand-dark); }
    .btn-outline { background: transparent; color: var(--brand); border: 1.5px solid var(--brand); }
    .btn-outline:hover { background: rgba(181,52,26,.06); }
    .btn-ghost { background: transparent; color: var(--text2); border: 1.5px solid var(--border); }
    .btn-ghost:hover { border-color: var(--brand); color: var(--brand); }
    .btn-success { background: var(--success); color: #fff; }
    .btn-sm { padding: 6px 12px; font-size: .78rem; }
    .btn-block { width: 100%; }

    /* ─── FORM ─── */
    .form-group { margin-bottom: 18px; }
    .form-label { display: block; font-size: .8rem; font-weight: 600; color: var(--text2); margin-bottom: 6px; letter-spacing: .01em; }
    .form-control {
        width: 100%; padding: 9px 13px; border: 1.5px solid var(--border);
        border-radius: var(--r-sm); font-size: .875rem; font-family: inherit;
        color: var(--text1); background: var(--surface);
        transition: border-color .2s, box-shadow .2s;
        outline: none;
    }
    .form-control:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(181,52,26,.1); }
    select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237A6858' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; }

    /* ─── TABLE ─── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th { padding: 10px 16px; font-size: .72rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--text4); background: var(--bg); border-bottom: 1px solid var(--border2); text-align: left; }
    .data-table td { padding: 13px 16px; font-size: .875rem; border-bottom: 1px solid var(--border2); vertical-align: middle; }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background: var(--surface2); }

    /* ─── BADGE ─── */
    .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: .72rem; font-weight: 600; }
    .badge-green { background: rgba(45,122,79,.1); color: var(--success); }
    .badge-red   { background: rgba(181,52,26,.1); color: var(--brand); }
    .badge-gold  { background: rgba(200,139,58,.12); color: #9A6020; }
    .badge-grey  { background: rgba(26,23,20,.07); color: var(--text3); }

    /* ─── TABS ─── */
    .tabs { display: flex; gap: 4px; border-bottom: 2px solid var(--border2); margin-bottom: 24px; }
    .tab-link {
        padding: 10px 18px; font-size: .875rem; font-weight: 500; color: var(--text3);
        text-decoration: none; border-bottom: 2px solid transparent; margin-bottom: -2px;
        transition: color .15s;
    }
    .tab-link.active, .tab-link:hover { color: var(--brand); }
    .tab-link.active { border-bottom-color: var(--brand); font-weight: 600; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
        .m-sidebar { transform: translateX(-100%); transition: transform .3s; }
        .m-sidebar.open { transform: none; }
        .m-main { margin-left: 0; }
        .m-content { padding: 16px; }
    }
    @stack('extra-styles')
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="m-sidebar" id="memberSidebar">
    <div class="sidebar-top">
        <div class="sidebar-avatar-wrap">
            <img src="{{ auth()->user()->photo_url }}" class="sidebar-avatar" alt="{{ auth()->user()->name }}">
            <div class="sidebar-avatar-ring"></div>
        </div>
        <div class="sidebar-name">{{ auth()->user()->name }}</div>
        <div class="sidebar-role {{ auth()->user()->isPremium() ? 'premium' : 'free' }}">
            @if(auth()->user()->isPremium())
                <i class="fas fa-crown"></i> Premium Member
            @else
                <i class="fas fa-user"></i> Free Member
            @endif
        </div>
        @if($profile = auth()->user()->profile)
        <div class="completeness-wrap">
            <div class="completeness-label"><span>Profile Completion</span><span>{{ $profile->completeness }}%</span></div>
            <div class="completeness-bar"><div class="completeness-fill" style="width: {{ $profile->completeness }}%"></div></div>
        </div>
        @endif
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu</div>
        <a href="{{ route('member.dashboard') }}" class="sidebar-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('member.profile.edit') }}" class="sidebar-link {{ request()->routeIs('member.profile.*') ? 'active' : '' }}">
            <i class="fas fa-user-edit"></i> My Profile
        </a>
        <a href="{{ route('member.photos.index') }}" class="sidebar-link {{ request()->routeIs('member.photos.*') ? 'active' : '' }}">
            <i class="fas fa-images"></i> My Photos
        </a>
        <div class="nav-section-label">Connections</div>
        <a href="{{ route('member.interests.received') }}" class="sidebar-link {{ request()->routeIs('member.interests.*') ? 'active' : '' }}">
            <i class="fas fa-heart"></i> Interests
        </a>
        <a href="{{ route('member.shortlist.index') }}" class="sidebar-link {{ request()->routeIs('member.shortlist.*') ? 'active' : '' }}">
            <i class="fas fa-star"></i> Shortlist
        </a>
        <a href="{{ route('member.messages.index') }}" class="sidebar-link {{ request()->routeIs('member.messages.*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Messages
        </a>
        <div class="nav-section-label">Discover</div>
        <a href="{{ route('search') }}" class="sidebar-link">
            <i class="fas fa-search"></i> Browse Profiles
        </a>
        <a href="{{ route('packages') }}" class="sidebar-link">
            <i class="fas fa-crown"></i> Upgrade Plan
        </a>
    </nav>

    <div class="sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </button>
        </form>
    </div>
</aside>

<!-- Main -->
<div class="m-main">
    <div class="m-topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-actions">
            <a href="{{ route('search') }}" class="topbar-btn"><i class="fas fa-search"></i> Browse</a>
        </div>
    </div>

    <!-- Flash -->
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

    <div class="m-content">
        @yield('content')
    </div>
</div>

<script>
document.querySelectorAll('.flash-item').forEach(el => {
    setTimeout(() => { el.style.opacity='0'; el.style.transform='translateX(16px)'; setTimeout(()=>el.remove(),300); }, 4000);
});
</script>
@stack('scripts')
</body>
</html>
