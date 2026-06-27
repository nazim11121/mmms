<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MMMS — Find Your Perfect Match')</title>
    <meta name="description" content="@yield('meta_description', 'Marriage Media Management System — trusted matrimonial platform')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
        --brand:       #B5341A;
        --brand-dark:  #8B2614;
        --brand-light: #D94A2E;
        --gold:        #C88B3A;
        --gold-light:  #E8A84E;
        --bg:          #F8F3EE;
        --surface:     #FFFFFF;
        --surface2:    #FDF8F4;
        --border:      #E8DDD3;
        --border-2:    #F0EAE3;
        --text1:       #1A1714;
        --text2:       #4A3E35;
        --text3:       #7A6858;
        --text4:       #A89585;
        --success:     #2D7A4F;
        --warning:     #C47A1A;
        --info:        #2A6B9A;
        --r-sm: 8px; --r-md: 14px; --r-lg: 20px; --r-xl: 28px;
        --sh-sm: 0 1px 4px rgba(26,23,20,.07);
        --sh-md: 0 4px 20px rgba(26,23,20,.09);
        --sh-lg: 0 8px 40px rgba(26,23,20,.12);
        --sh-xl: 0 20px 60px rgba(26,23,20,.16);
    }
    html { scroll-behavior: smooth; }
    body {
        font-family: 'Inter', system-ui, sans-serif;
        background: var(--bg);
        color: var(--text1);
        line-height: 1.6;
        font-size: 15px;
    }
    h1,h2,h3,h4,h5 { font-family: 'Playfair Display', Georgia, serif; line-height: 1.25; text-wrap: balance; }
    a { color: inherit; }
    img { max-width: 100%; display: block; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

    /* ─── NAV ─── */
    .site-nav {
        position: sticky; top: 0; z-index: 900;
        background: rgba(255,255,255,.92);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--border-2);
        transition: box-shadow .3s;
    }
    .site-nav.scrolled { box-shadow: var(--sh-md); }
    .nav-inner {
        display: flex; align-items: center; gap: 32px;
        height: 66px;
    }
    .nav-logo {
        display: flex; align-items: center; gap: 10px;
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem; font-weight: 700;
        color: var(--brand); text-decoration: none;
        flex-shrink: 0;
    }
    .nav-logo-icon {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--brand);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: .85rem;
    }
    .nav-links {
        display: flex; align-items: center; gap: 4px; flex: 1;
        list-style: none;
    }
    .nav-links a {
        display: block; padding: 6px 14px;
        font-size: .875rem; font-weight: 500; color: var(--text2);
        text-decoration: none; border-radius: 8px;
        position: relative; transition: color .2s, background .2s;
    }
    .nav-links a:hover { color: var(--brand); background: rgba(181,52,26,.06); }
    .nav-links a.active { color: var(--brand); }
    .nav-actions { display: flex; align-items: center; gap: 10px; margin-left: auto; flex-shrink: 0; }
    .btn-nav-login {
        padding: 7px 18px; border: 1.5px solid var(--border);
        border-radius: 8px; font-size: .875rem; font-weight: 500;
        color: var(--text2); text-decoration: none;
        transition: border-color .2s, color .2s;
    }
    .btn-nav-login:hover { border-color: var(--brand); color: var(--brand); }
    .btn-nav-register {
        padding: 7px 20px; background: var(--brand);
        border-radius: 8px; font-size: .875rem; font-weight: 600;
        color: #fff; text-decoration: none;
        transition: background .2s, transform .15s;
    }
    .btn-nav-register:hover { background: var(--brand-dark); transform: translateY(-1px); }
    .nav-avatar-btn {
        display: flex; align-items: center; gap: 9px;
        padding: 5px 14px 5px 5px;
        border: 1.5px solid var(--border); border-radius: 40px;
        background: none; cursor: pointer;
        font-size: .875rem; font-weight: 500;
        color: var(--text1); text-decoration: none;
        transition: border-color .2s, box-shadow .2s;
    }
    .nav-avatar-btn:hover { border-color: var(--brand); box-shadow: var(--sh-sm); }
    .nav-avatar-btn img { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
    .nav-dropdown { position: relative; }
    .nav-dropdown-menu {
        display: none; position: absolute; top: calc(100% + 8px); right: 0;
        width: 220px; background: var(--surface);
        border: 1px solid var(--border); border-radius: var(--r-md);
        box-shadow: var(--sh-lg); overflow: hidden;
        animation: dropFade .15s ease;
    }
    @keyframes dropFade { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: none; } }
    .nav-dropdown:hover .nav-dropdown-menu,
    .nav-dropdown-menu:hover { display: block; }
    .dropdown-item {
        display: flex; align-items: center; gap: 10px;
        padding: 11px 16px; font-size: .875rem; color: var(--text2);
        text-decoration: none; transition: background .15s;
    }
    .dropdown-item:hover { background: var(--bg); color: var(--brand); }
    .dropdown-item i { width: 16px; color: var(--text4); }
    .dropdown-divider { border: none; border-top: 1px solid var(--border-2); margin: 4px 0; }
    .btn-logout-inline {
        width: 100%; text-align: left; background: none; border: none;
        cursor: pointer; font-family: inherit;
    }
    .btn-logout-inline:hover { color: var(--brand) !important; }
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        background: none; border: none; cursor: pointer; padding: 4px;
    }
    .hamburger span { display: block; width: 24px; height: 2px; background: var(--text1); border-radius: 2px; transition: .3s; }

    /* ─── FLASH ─── */
    .flash-stack {
        position: fixed; top: 78px; right: 20px; z-index: 9999;
        display: flex; flex-direction: column; gap: 8px; min-width: 300px;
    }
    .flash-item {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 14px 16px; border-radius: var(--r-md);
        background: var(--surface); border: 1px solid var(--border);
        box-shadow: var(--sh-lg); animation: slideIn .25s ease;
        font-size: .875rem;
    }
    @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: none; } }
    .flash-item.success { border-left: 3px solid var(--success); }
    .flash-item.error   { border-left: 3px solid var(--brand); }
    .flash-item.warning { border-left: 3px solid var(--warning); }
    .flash-item.info    { border-left: 3px solid var(--info); }
    .flash-icon { font-size: 1rem; margin-top: 1px; flex-shrink: 0; }
    .flash-item.success .flash-icon { color: var(--success); }
    .flash-item.error   .flash-icon { color: var(--brand); }
    .flash-item.warning .flash-icon { color: var(--warning); }
    .flash-close {
        margin-left: auto; background: none; border: none; cursor: pointer;
        color: var(--text4); font-size: .85rem; padding: 0 2px;
        transition: color .15s; flex-shrink: 0;
    }
    .flash-close:hover { color: var(--text1); }

    /* ─── BUTTONS ─── */
    .btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 7px;
        padding: 10px 22px; border-radius: var(--r-sm);
        font-family: 'Inter', sans-serif; font-size: .875rem; font-weight: 600;
        cursor: pointer; border: none; text-decoration: none;
        transition: transform .15s, box-shadow .15s, background .2s, border-color .2s;
    }
    .btn:hover { transform: translateY(-1px); }
    .btn-primary { background: var(--brand); color: #fff; box-shadow: 0 2px 8px rgba(181,52,26,.30); }
    .btn-primary:hover { background: var(--brand-dark); box-shadow: 0 4px 16px rgba(181,52,26,.40); }
    .btn-outline { background: transparent; color: var(--brand); border: 1.5px solid var(--brand); }
    .btn-outline:hover { background: rgba(181,52,26,.06); }
    .btn-ghost { background: transparent; color: var(--text2); border: 1.5px solid var(--border); }
    .btn-ghost:hover { border-color: var(--brand); color: var(--brand); background: rgba(181,52,26,.04); }
    .btn-gold { background: var(--gold); color: #fff; box-shadow: 0 2px 8px rgba(200,139,58,.30); }
    .btn-gold:hover { background: #b8783a; }
    .btn-sm { padding: 6px 14px; font-size: .8rem; }
    .btn-lg { padding: 14px 32px; font-size: 1rem; }
    .btn-block { width: 100%; }
    .btn-icon { width: 38px; height: 38px; padding: 0; border-radius: var(--r-sm); }
    .btn-icon.sm { width: 32px; height: 32px; }

    /* ─── CARDS ─── */
    .card {
        background: var(--surface); border: 1px solid var(--border-2);
        border-radius: var(--r-lg); overflow: hidden;
    }
    .card-hover { transition: transform .25s, box-shadow .25s; }
    .card-hover:hover { transform: translateY(-5px); box-shadow: var(--sh-xl); }

    /* ─── BADGE ─── */
    .badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 9px; border-radius: 20px;
        font-size: .72rem; font-weight: 600; letter-spacing: .02em;
    }
    .badge-brand  { background: rgba(181,52,26,.1); color: var(--brand); }
    .badge-gold   { background: rgba(200,139,58,.12); color: #9A6020; }
    .badge-green  { background: rgba(45,122,79,.1); color: var(--success); }
    .badge-grey   { background: rgba(26,23,20,.06); color: var(--text3); }

    /* ─── FOOTER ─── */
    .site-footer { background: var(--text1); color: rgba(255,255,255,.7); }
    .footer-main { padding: 64px 0 48px; }
    .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 48px; }
    .footer-brand-name {
        font-family: 'Playfair Display', serif; font-size: 1.4rem;
        font-weight: 700; color: #fff; display: flex; align-items: center; gap: 10px; margin-bottom: 14px;
    }
    .footer-brand-icon {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--brand); display: flex; align-items: center;
        justify-content: center; color: #fff; font-size: .8rem;
    }
    .footer-tagline { font-size: .875rem; line-height: 1.7; margin-bottom: 20px; }
    .footer-social { display: flex; gap: 10px; }
    .footer-social a {
        width: 36px; height: 36px; border-radius: 8px;
        border: 1px solid rgba(255,255,255,.12); display: flex;
        align-items: center; justify-content: center;
        color: rgba(255,255,255,.6); font-size: .875rem;
        transition: background .2s, color .2s, border-color .2s;
        text-decoration: none;
    }
    .footer-social a:hover { background: var(--brand); border-color: var(--brand); color: #fff; }
    .footer-heading { color: #fff; font-size: .8rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; margin-bottom: 16px; }
    .footer-links { list-style: none; display: flex; flex-direction: column; gap: 8px; }
    .footer-links a { font-size: .875rem; text-decoration: none; color: rgba(255,255,255,.6); transition: color .2s; }
    .footer-links a:hover { color: #fff; }
    .footer-contact-item { display: flex; align-items: flex-start; gap: 10px; font-size: .875rem; margin-bottom: 10px; }
    .footer-contact-item i { color: var(--gold); margin-top: 3px; flex-shrink: 0; }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,.08);
        padding: 20px 0; font-size: .8rem;
        display: flex; align-items: center; justify-content: space-between;
        color: rgba(255,255,255,.4);
    }

    /* ─── MOBILE NAV ─── */
    .mobile-menu {
        display: none; position: fixed; inset: 0; z-index: 890;
        background: var(--surface); padding: 80px 24px 32px;
        flex-direction: column; gap: 4px;
    }
    .mobile-menu.open { display: flex; }
    .mobile-menu a {
        padding: 13px 16px; font-weight: 500; font-size: 1rem;
        color: var(--text2); text-decoration: none; border-radius: var(--r-sm);
        transition: background .2s;
    }
    .mobile-menu a:hover { background: var(--bg); color: var(--brand); }
    .mobile-menu-actions { margin-top: 16px; display: flex; flex-direction: column; gap: 10px; }

    /* ─── UTILITY ─── */
    .section { padding: 80px 0; }
    .section-sm { padding: 48px 0; }
    .section-header { text-align: center; margin-bottom: 56px; }
    .section-eyebrow {
        display: inline-block; font-size: .78rem; font-weight: 600;
        letter-spacing: .1em; text-transform: uppercase; color: var(--brand);
        margin-bottom: 12px;
    }
    .section-title { font-size: clamp(1.75rem, 3vw, 2.5rem); color: var(--text1); }
    .section-subtitle { font-size: 1rem; color: var(--text3); margin-top: 10px; }
    .divider { border: none; border-top: 1px solid var(--border); margin: 0; }
    .text-brand { color: var(--brand); }
    .text-gold { color: var(--gold); }
    .text-muted { color: var(--text3); }

    @media (max-width: 768px) {
        .nav-links, .nav-actions { display: none; }
        .hamburger { display: flex; margin-left: auto; }
        .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
        .section { padding: 56px 0; }
    }
    @media (max-width: 480px) {
        .footer-grid { grid-template-columns: 1fr; }
    }
    @stack('extra-styles')
    </style>
    @stack('styles')
</head>
<body>

<!-- Mobile menu overlay -->
<div class="mobile-menu" id="mobileMenu">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('search') }}">Browse Profiles</a>
    <a href="{{ route('packages') }}">Packages</a>
    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
        @else
            <a href="{{ route('member.dashboard') }}">Dashboard</a>
            <a href="{{ route('member.profile.edit') }}">My Profile</a>
            <a href="{{ route('member.messages.index') }}">Messages</a>
        @endif
        <div class="mobile-menu-actions">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline btn-block">Sign Out</button>
            </form>
        </div>
    @else
        <div class="mobile-menu-actions">
            <a href="{{ route('login') }}" class="btn btn-ghost btn-block">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-block">Register Free</a>
        </div>
    @endguest
</div>

<!-- Navbar -->
<nav class="site-nav" id="siteNav">
    <div class="container nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            <span class="nav-logo-icon"><i class="fas fa-heart"></i></span>
            MMMS
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'active' : '' }}">Browse Profiles</a></li>
            <li><a href="{{ route('packages') }}" class="{{ request()->routeIs('packages') ? 'active' : '' }}">Packages</a></li>
        </ul>

        <div class="nav-actions">
            @guest
                <a href="{{ route('login') }}" class="btn-nav-login">Login</a>
                <a href="{{ route('register') }}" class="btn-nav-register">Register Free</a>
            @else
                <div class="nav-dropdown">
                    <a class="nav-avatar-btn" href="#">
                        <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}">
                        <span>{{ Str::words(auth()->user()->name, 1, '') }}</span>
                        <i class="fas fa-chevron-down" style="font-size:.65rem; color:var(--text4)"></i>
                    </a>
                    <div class="nav-dropdown-menu">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item"><i class="fas fa-tachometer-alt"></i> Admin Panel</a>
                        @else
                            <a href="{{ route('member.dashboard') }}" class="dropdown-item"><i class="fas fa-home"></i> Dashboard</a>
                            <a href="{{ route('member.profile.edit') }}" class="dropdown-item"><i class="fas fa-user-edit"></i> Edit Profile</a>
                            <a href="{{ route('member.messages.index') }}" class="dropdown-item"><i class="fas fa-envelope"></i> Messages</a>
                        @endif
                        <hr class="dropdown-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item btn-logout-inline" style="color:var(--brand)">
                                <i class="fas fa-sign-out-alt" style="color:var(--brand)"></i> Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>

        <button class="hamburger" id="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Flash Messages -->
<div class="flash-stack">
    @foreach(['success' => 'circle-check', 'error' => 'circle-xmark', 'warning' => 'triangle-exclamation', 'info' => 'circle-info'] as $type => $icon)
        @if(session($type))
        <div class="flash-item {{ $type }}" id="flash-{{ $type }}">
            <i class="fas fa-{{ $icon }} flash-icon"></i>
            <span>{{ session($type) }}</span>
            <button class="flash-close" onclick="this.closest('.flash-item').remove()"><i class="fas fa-xmark"></i></button>
        </div>
        @endif
    @endforeach
</div>

@yield('content')

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-name">
                        <span class="footer-brand-icon"><i class="fas fa-heart"></i></span>
                        MMMS
                    </div>
                    <p class="footer-tagline">Marriage Media Management System — helping families across Bangladesh find trusted, compatible life partners with dignity and care.</p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <p class="footer-heading">Navigate</p>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('search') }}">Browse Profiles</a></li>
                        <li><a href="{{ route('packages') }}">Packages</a></li>
                        <li><a href="{{ route('register') }}">Register Free</a></li>
                    </ul>
                </div>
                <div>
                    <p class="footer-heading">Account</p>
                    <ul class="footer-links">
                        @guest
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                        <li><a href="{{ route('register') }}">Create Account</a></li>
                        @else
                        <li><a href="{{ route('member.dashboard') }}">My Dashboard</a></li>
                        <li><a href="{{ route('member.profile.edit') }}">My Profile</a></li>
                        <li><a href="{{ route('member.interests.received') }}">Interests</a></li>
                        <li><a href="{{ route('member.messages.index') }}">Messages</a></li>
                        @endguest
                    </ul>
                </div>
                <div>
                    <p class="footer-heading">Contact</p>
                    <div class="footer-contact-item"><i class="fas fa-envelope"></i><span>info@mmms.com</span></div>
                    <div class="footer-contact-item"><i class="fas fa-phone"></i><span>+880 1700-000000</span></div>
                    <div class="footer-contact-item"><i class="fas fa-map-marker-alt"></i><span>Dhaka, Bangladesh</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container footer-bottom">
        <span>&copy; {{ date('Y') }} MMMS. All rights reserved.</span>
        <span>Made with <i class="fas fa-heart" style="color:var(--brand)"></i> in Bangladesh</span>
    </div>
</footer>

<script>
const nav = document.getElementById('siteNav');
const ham = document.getElementById('hamburger');
const mob = document.getElementById('mobileMenu');

window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 20);
});

ham.addEventListener('click', () => {
    mob.classList.toggle('open');
    const spans = ham.querySelectorAll('span');
    const open = mob.classList.contains('open');
    spans[0].style.transform = open ? 'rotate(45deg) translate(5px, 5px)' : '';
    spans[1].style.opacity = open ? '0' : '1';
    spans[2].style.transform = open ? 'rotate(-45deg) translate(5px, -5px)' : '';
});

// Auto-dismiss flash messages
document.querySelectorAll('.flash-item').forEach(el => {
    setTimeout(() => { el.style.opacity = '0'; el.style.transform = 'translateX(20px)';
        setTimeout(() => el.remove(), 300); }, 4000);
});

// Animate counters
function animateCounter(el) {
    const target = parseInt(el.dataset.target || el.textContent);
    const duration = 1800;
    const start = performance.now();
    function update(now) {
        const progress = Math.min((now - start) / duration, 1);
        const ease = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(ease * target).toLocaleString();
        if (progress < 1) requestAnimationFrame(update);
        else el.textContent = target.toLocaleString() + (el.dataset.suffix || '');
    }
    requestAnimationFrame(update);
}

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { animateCounter(e.target); counterObserver.unobserve(e.target); } });
}, { threshold: 0.5 });
document.querySelectorAll('[data-counter]').forEach(el => counterObserver.observe(el));
</script>
@stack('scripts')
</body>
</html>
