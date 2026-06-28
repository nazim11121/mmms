{{-- Neon Noir: near-black background, neon cyan/teal glow accents --}}
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --brand:       #00E5CC;
    --brand-dark:  #00B8A4;
    --brand-light: #4DFFF0;
    --gold:        #FFD700;
    --gold-light:  #FFE44D;
    --bg:          #07090E;
    --surface:     #0E1118;
    --surface2:    #141820;
    --border:      rgba(0,229,204,.18);
    --border-2:    rgba(0,229,204,.09);
    --text1:       #E8F0F8;
    --text2:       #B0C0D8;
    --text3:       #6A8098;
    --text4:       #384858;
    --success:     #00E5A0;
    --warning:     #FFD700;
    --info:        #00AAFF;
    --r-sm: 6px; --r-md: 10px; --r-lg: 14px; --r-xl: 20px;
    --sh-sm: 0 0 10px rgba(0,229,204,.12);
    --sh-md: 0 0 24px rgba(0,229,204,.18);
    --sh-lg: 0 0 48px rgba(0,229,204,.22);
    --sh-xl: 0 0 80px rgba(0,229,204,.28);
}

h1,h2,h3,h4,h5 {
    font-family: 'Rajdhani', 'Inter', sans-serif;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
}
.nav-logo { font-family: 'Rajdhani', sans-serif; font-weight: 700; letter-spacing: .08em; color: var(--brand); }
.footer-brand-name { font-family: 'Rajdhani', sans-serif; font-weight: 700; letter-spacing: .06em; }
.section-title { font-family: 'Rajdhani', sans-serif; letter-spacing: .05em; }

/* ── Dark nav with neon accent ── */
body[data-theme="neon-noir"] .site-nav {
    background: rgba(7,9,14,.92);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(0,229,204,.2);
    box-shadow: 0 1px 0 rgba(0,229,204,.1);
}
body[data-theme="neon-noir"] .site-nav.scrolled {
    box-shadow: 0 4px 24px rgba(0,229,204,.15);
}
body[data-theme="neon-noir"] .nav-logo { color: var(--brand); }
body[data-theme="neon-noir"] .nav-logo-icon { background: var(--brand); color: #07090E; }
body[data-theme="neon-noir"] .nav-links a { color: rgba(176,192,216,.65); }
body[data-theme="neon-noir"] .nav-links a:hover {
    color: var(--brand);
    background: rgba(0,229,204,.07);
    text-shadow: 0 0 12px rgba(0,229,204,.5);
}
body[data-theme="neon-noir"] .nav-links a.active {
    color: var(--brand);
    text-shadow: 0 0 16px rgba(0,229,204,.6);
}
body[data-theme="neon-noir"] .btn-nav-login {
    border-color: rgba(0,229,204,.25);
    color: rgba(176,192,216,.8);
}
body[data-theme="neon-noir"] .btn-nav-login:hover { border-color: var(--brand); color: var(--brand); }
body[data-theme="neon-noir"] .btn-nav-register {
    background: var(--brand);
    color: #07090E;
    font-weight: 700;
}
body[data-theme="neon-noir"] .btn-nav-register:hover { background: var(--brand-light); }
body[data-theme="neon-noir"] .nav-avatar-btn { border-color: rgba(0,229,204,.2); color: var(--text1); }
body[data-theme="neon-noir"] .nav-dropdown-menu {
    background: rgba(10,13,20,.95);
    backdrop-filter: blur(20px);
    border-color: rgba(0,229,204,.18);
}
body[data-theme="neon-noir"] .dropdown-item { color: rgba(176,192,216,.72); }
body[data-theme="neon-noir"] .dropdown-item:hover { background: rgba(0,229,204,.06); color: var(--brand); }
body[data-theme="neon-noir"] .dropdown-divider { border-color: rgba(0,229,204,.1); }
body[data-theme="neon-noir"] .hamburger span { background: var(--brand); }
body[data-theme="neon-noir"] .mobile-menu { background: #07090E; }
body[data-theme="neon-noir"] .mobile-menu a { color: rgba(176,192,216,.75); }
body[data-theme="neon-noir"] .mobile-menu a:hover { background: rgba(0,229,204,.06); color: var(--brand); }

/* ── Buttons with neon glow ── */
body[data-theme="neon-noir"] .btn-primary {
    background: var(--brand);
    color: #07090E;
    box-shadow: 0 0 16px rgba(0,229,204,.4);
}
body[data-theme="neon-noir"] .btn-primary:hover {
    background: var(--brand-light);
    box-shadow: 0 0 28px rgba(0,229,204,.6);
}
body[data-theme="neon-noir"] .btn-outline {
    color: var(--brand);
    border-color: var(--brand);
    box-shadow: 0 0 10px rgba(0,229,204,.2);
}
body[data-theme="neon-noir"] .btn-outline:hover {
    background: rgba(0,229,204,.08);
    box-shadow: 0 0 20px rgba(0,229,204,.35);
}
body[data-theme="neon-noir"] .btn-ghost { color: var(--text2); border-color: var(--border); }
body[data-theme="neon-noir"] .btn-ghost:hover { border-color: var(--brand); color: var(--brand); background: rgba(0,229,204,.06); }
body[data-theme="neon-noir"] .btn-gold { background: var(--gold); color: #07090E; }

/* ── Cards with neon border ── */
body[data-theme="neon-noir"] .card {
    background: var(--surface);
    border-color: var(--border);
}
body[data-theme="neon-noir"] .card-hover:hover {
    border-color: rgba(0,229,204,.4);
    box-shadow: 0 0 32px rgba(0,229,204,.2);
}

/* ── Footer ── */
body[data-theme="neon-noir"] .site-footer {
    background: #030507;
    border-top: 1px solid rgba(0,229,204,.12);
}
body[data-theme="neon-noir"] .footer-brand-icon { background: var(--brand); }
body[data-theme="neon-noir"] .footer-social a:hover {
    background: var(--brand);
    border-color: var(--brand);
    color: #07090E;
}
body[data-theme="neon-noir"] .footer-bottom { border-top-color: rgba(0,229,204,.08); }
body[data-theme="neon-noir"] .footer-contact-item i { color: var(--brand); }

/* ── Flash messages ── */
body[data-theme="neon-noir"] .flash-item {
    background: var(--surface);
    border-color: var(--border);
    color: var(--text1);
}

/* ── Misc ── */
body[data-theme="neon-noir"] .section-eyebrow { color: var(--brand); text-shadow: 0 0 12px rgba(0,229,204,.5); }
body[data-theme="neon-noir"] .text-brand { color: var(--brand); }
body[data-theme="neon-noir"] .divider { border-color: var(--border-2); }
body[data-theme="neon-noir"] .badge-brand { background: rgba(0,229,204,.12); color: var(--brand); }
body[data-theme="neon-noir"] .badge-gold  { background: rgba(255,215,0,.12); color: var(--gold); }
body[data-theme="neon-noir"] .badge-grey  { background: rgba(232,240,248,.07); color: var(--text3); }
</style>
