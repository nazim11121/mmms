{{-- Bold Editorial: stark white, oversized type, ink-red accent, magazine rulelines --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;0,900;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root {
    --brand:       #D40000;
    --brand-dark:  #A00000;
    --brand-light: #FF2020;
    --gold:        #B8860B;
    --gold-light:  #DAA520;
    --bg:          #FFFFFF;
    --surface:     #FFFFFF;
    --surface2:    #F8F8F8;
    --border:      #1A1A1A;
    --border-2:    #E0E0E0;
    --text1:       #0A0A0A;
    --text2:       #1A1A1A;
    --text3:       #5A5A5A;
    --text4:       #999999;
    --success:     #0A6A28;
    --warning:     #8B6914;
    --info:        #0A3A8A;
    --r-sm: 0px; --r-md: 0px; --r-lg: 0px; --r-xl: 0px;
    --sh-sm: none;
    --sh-md: none;
    --sh-lg: 0 2px 0 #1A1A1A;
    --sh-xl: 4px 4px 0 #1A1A1A;
}

/* ── Massive editorial headings ── */
body[data-theme="bold-editorial"] h1,
body[data-theme="bold-editorial"] h2,
body[data-theme="bold-editorial"] h3 {
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 900;
    letter-spacing: -.02em;
    line-height: 1.05;
}
body[data-theme="bold-editorial"] h4,
body[data-theme="bold-editorial"] h5 {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    font-size: .78rem;
}
body[data-theme="bold-editorial"] .nav-logo {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    color: var(--text1);
    font-size: 1.5rem;
    letter-spacing: -.04em;
    border-left: 4px solid var(--brand);
    padding-left: 10px;
}

/* ── Stark editorial nav — white with thick bottom rule ── */
body[data-theme="bold-editorial"] .site-nav {
    background: #FFFFFF;
    backdrop-filter: none;
    border-bottom: 3px solid #0A0A0A;
    box-shadow: none;
}
body[data-theme="bold-editorial"] .site-nav.scrolled { box-shadow: none; }
body[data-theme="bold-editorial"] .nav-logo-icon { display: none; }
body[data-theme="bold-editorial"] .nav-links a {
    color: var(--text2);
    font-size: .78rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .1em;
    border-radius: 0;
}
body[data-theme="bold-editorial"] .nav-links a:hover {
    color: var(--brand);
    background: transparent;
    text-decoration: underline;
    text-underline-offset: 3px;
}
body[data-theme="bold-editorial"] .nav-links a.active {
    color: var(--brand);
    text-decoration: underline;
    text-underline-offset: 3px;
}
body[data-theme="bold-editorial"] .btn-nav-login { border-radius: 0; border-color: var(--text1); font-size: .78rem; text-transform: uppercase; letter-spacing: .06em; }
body[data-theme="bold-editorial"] .btn-nav-login:hover { background: var(--text1); color: #fff; }
body[data-theme="bold-editorial"] .btn-nav-register { background: var(--brand); border-radius: 0; font-size: .78rem; text-transform: uppercase; letter-spacing: .06em; }
body[data-theme="bold-editorial"] .btn-nav-register:hover { background: var(--brand-dark); transform: none; }
body[data-theme="bold-editorial"] .nav-avatar-btn { border-radius: 0; border-color: var(--text1); }
body[data-theme="bold-editorial"] .nav-dropdown-menu { border-radius: 0; box-shadow: 4px 4px 0 #1A1A1A; border-color: var(--text1); }

/* ── Editorial buttons — flat with thick border ── */
body[data-theme="bold-editorial"] .btn {
    border-radius: 0;
    text-transform: uppercase;
    letter-spacing: .08em;
    font-size: .78rem;
    font-weight: 700;
    box-shadow: none;
}
body[data-theme="bold-editorial"] .btn:hover { transform: none; box-shadow: none; }
body[data-theme="bold-editorial"] .btn-primary { background: var(--brand); border: 2px solid var(--brand); }
body[data-theme="bold-editorial"] .btn-primary:hover { background: var(--brand-dark); border-color: var(--brand-dark); }
body[data-theme="bold-editorial"] .btn-outline { color: var(--text1); border: 2px solid var(--text1); }
body[data-theme="bold-editorial"] .btn-outline:hover { background: var(--text1); color: #fff; }
body[data-theme="bold-editorial"] .btn-ghost { border: 2px solid var(--border-2); }
body[data-theme="bold-editorial"] .btn-ghost:hover { border-color: var(--brand); color: var(--brand); background: transparent; }

/* ── Cards — offset shadow, no radius ── */
body[data-theme="bold-editorial"] .card {
    border-radius: 0;
    border: 1.5px solid #D0D0D0;
    box-shadow: none;
}
body[data-theme="bold-editorial"] .card-hover:hover {
    box-shadow: 4px 4px 0 #1A1A1A;
    transform: translate(-2px, -2px);
}

/* ── Section eyebrow — editorial label style ── */
body[data-theme="bold-editorial"] .section-eyebrow {
    color: var(--brand);
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .18em;
    text-transform: uppercase;
    border-bottom: 2px solid var(--brand);
    padding-bottom: 4px;
}

/* ── Footer — newspaper-style stark black ── */
body[data-theme="bold-editorial"] .site-footer { background: #0A0A0A; }
body[data-theme="bold-editorial"] .footer-brand-name { font-family: 'Playfair Display', serif; font-weight: 900; letter-spacing: -.03em; }
body[data-theme="bold-editorial"] .footer-brand-icon { background: var(--brand); border-radius: 0; }
body[data-theme="bold-editorial"] .footer-social a { border-radius: 0; }
body[data-theme="bold-editorial"] .footer-social a:hover { background: var(--brand); border-color: var(--brand); }

/* ── Misc ── */
body[data-theme="bold-editorial"] .text-brand { color: var(--brand); }
body[data-theme="bold-editorial"] .badge { border-radius: 0; }
body[data-theme="bold-editorial"] .badge-brand { background: rgba(212,0,0,.08); color: var(--brand); }
body[data-theme="bold-editorial"] .divider { border-width: 2px; border-color: var(--text1); }
</style>
