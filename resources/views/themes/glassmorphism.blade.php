{{-- Glassmorphism: animated gradient bg, frosted glass panels, light text throughout --}}
<style>
:root {
    --brand:       #A78BFA;
    --brand-dark:  #7C3AED;
    --brand-light: #C4B5FD;
    --gold:        #F59E0B;
    --gold-light:  #FCD34D;
    --bg:          transparent;
    --surface:     rgba(255,255,255,.11);
    --surface2:    rgba(255,255,255,.07);
    --border:      rgba(255,255,255,.22);
    --border-2:    rgba(255,255,255,.12);
    --text1:       #FFFFFF;
    --text2:       rgba(255,255,255,.88);
    --text3:       rgba(255,255,255,.60);
    --text4:       rgba(255,255,255,.38);
    --success:     #34D399;
    --warning:     #FBBF24;
    --info:        #60A5FA;
    --r-sm: 12px; --r-md: 18px; --r-lg: 24px; --r-xl: 36px;
    --sh-sm: 0 2px 12px rgba(0,0,0,.25);
    --sh-md: 0 8px 32px rgba(0,0,0,.35);
    --sh-lg: 0 16px 56px rgba(0,0,0,.45);
    --sh-xl: 0 24px 80px rgba(0,0,0,.55);
}

/* ── Gradient canvas ── */
body[data-theme="glassmorphism"] {
    background: linear-gradient(135deg, #0f0c29, #302b63, #24243e, #1a1a3e);
    background-attachment: fixed;
    min-height: 100vh;
}

/* ── Glass nav ── */
body[data-theme="glassmorphism"] .site-nav {
    background: rgba(255,255,255,.06);
    backdrop-filter: blur(28px);
    -webkit-backdrop-filter: blur(28px);
    border-bottom: 1px solid rgba(255,255,255,.1);
    box-shadow: none;
}
body[data-theme="glassmorphism"] .site-nav.scrolled { box-shadow: 0 4px 32px rgba(0,0,0,.3); }
body[data-theme="glassmorphism"] .nav-logo { color: #fff; }
body[data-theme="glassmorphism"] .nav-logo-icon { background: var(--brand); }
body[data-theme="glassmorphism"] .nav-links a { color: rgba(255,255,255,.65); }
body[data-theme="glassmorphism"] .nav-links a:hover { color: #fff; background: rgba(255,255,255,.1); }
body[data-theme="glassmorphism"] .nav-links a.active { color: var(--brand-light); }
body[data-theme="glassmorphism"] .btn-nav-login { border-color: rgba(255,255,255,.25); color: rgba(255,255,255,.8); }
body[data-theme="glassmorphism"] .btn-nav-login:hover { border-color: var(--brand); color: var(--brand-light); }
body[data-theme="glassmorphism"] .btn-nav-register { background: var(--brand); color: #fff; }
body[data-theme="glassmorphism"] .btn-nav-register:hover { background: var(--brand-dark); }
body[data-theme="glassmorphism"] .nav-avatar-btn { border-color: rgba(255,255,255,.2); color: #fff; }
body[data-theme="glassmorphism"] .nav-dropdown-menu {
    background: rgba(20,16,50,.88);
    backdrop-filter: blur(24px);
    border-color: rgba(255,255,255,.14);
}
body[data-theme="glassmorphism"] .dropdown-item { color: rgba(255,255,255,.72); }
body[data-theme="glassmorphism"] .dropdown-item:hover { background: rgba(255,255,255,.08); color: #fff; }
body[data-theme="glassmorphism"] .dropdown-divider { border-color: rgba(255,255,255,.1); }
body[data-theme="glassmorphism"] .hamburger span { background: #fff; }
body[data-theme="glassmorphism"] .mobile-menu { background: rgba(12,10,35,.96); }
body[data-theme="glassmorphism"] .mobile-menu a { color: rgba(255,255,255,.75); }
body[data-theme="glassmorphism"] .mobile-menu a:hover { background: rgba(255,255,255,.07); color: #fff; }

/* ── Glass cards & panels ── */
body[data-theme="glassmorphism"] .card {
    background: rgba(255,255,255,.1);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-color: rgba(255,255,255,.18);
}
body[data-theme="glassmorphism"] .panel {
    background: rgba(255,255,255,.09);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-color: rgba(255,255,255,.15);
}

/* ── Buttons ── */
body[data-theme="glassmorphism"] .btn-primary {
    background: var(--brand);
    box-shadow: 0 4px 20px rgba(124,58,237,.5);
}
body[data-theme="glassmorphism"] .btn-primary:hover {
    background: var(--brand-dark);
    box-shadow: 0 6px 28px rgba(124,58,237,.65);
}
body[data-theme="glassmorphism"] .btn-outline { color: var(--brand-light); border-color: var(--brand); }
body[data-theme="glassmorphism"] .btn-outline:hover { background: rgba(167,139,250,.12); }
body[data-theme="glassmorphism"] .btn-ghost { color: rgba(255,255,255,.7); border-color: rgba(255,255,255,.2); }
body[data-theme="glassmorphism"] .btn-ghost:hover { border-color: var(--brand); color: var(--brand-light); background: rgba(167,139,250,.08); }

/* ── Footer ── */
body[data-theme="glassmorphism"] .site-footer {
    background: rgba(0,0,0,.5);
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(255,255,255,.08);
}
body[data-theme="glassmorphism"] .footer-social a:hover { background: var(--brand); border-color: var(--brand); }
body[data-theme="glassmorphism"] .footer-bottom { border-top-color: rgba(255,255,255,.06); }

/* ── Misc ── */
body[data-theme="glassmorphism"] .section-eyebrow { color: var(--brand-light); }
body[data-theme="glassmorphism"] .text-brand { color: var(--brand-light); }
body[data-theme="glassmorphism"] .flash-item {
    background: rgba(20,16,50,.9);
    backdrop-filter: blur(20px);
    border-color: rgba(255,255,255,.12);
    color: #fff;
}
body[data-theme="glassmorphism"] .badge-brand { background: rgba(167,139,250,.2); color: var(--brand-light); }
body[data-theme="glassmorphism"] .badge-gold  { background: rgba(245,158,11,.2);  color: var(--gold); }
body[data-theme="glassmorphism"] .divider { border-color: rgba(255,255,255,.1); }
h1,h2,h3,h4,h5 { font-family: 'Playfair Display', Georgia, serif; }
</style>
