<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">
<style>
:root {
    --brand:       #D4840A;
    --brand-dark:  #A86208;
    --brand-light: #F0A030;
    --gold:        #C47A1A;
    --gold-light:  #E09830;
    --bg:          #FFFBF0;
    --surface:     #FFFFFF;
    --surface2:    #FFFDF6;
    --border:      #ECD9A8;
    --border-2:    #F5EDD0;
    --text1:       #1E0E00;
    --text2:       #3A2000;
    --text3:       #7A5A28;
    --text4:       #B89860;
    --success:     #2D7A4F;
    --warning:     #C47A1A;
    --info:        #2A6B9A;
    --r-sm: 8px; --r-md: 14px; --r-lg: 20px; --r-xl: 28px;
    --sh-sm: 0 1px 4px rgba(30,14,0,.08);
    --sh-md: 0 4px 20px rgba(30,14,0,.11);
    --sh-lg: 0 8px 40px rgba(30,14,0,.14);
    --sh-xl: 0 20px 60px rgba(30,14,0,.18);
}

h1,h2,h3,h4,h5 { font-family: 'Playfair Display', Georgia, serif; }
.nav-logo { font-family: 'Playfair Display', serif; color: var(--brand); }

/* ── Warm saffron nav ── */
body[data-theme="saffron-spice"] .site-nav {
    background: rgba(255,251,240,.95);
    border-bottom: 2px solid rgba(212,132,10,.25);
}
body[data-theme="saffron-spice"] .nav-logo { color: var(--brand); }
body[data-theme="saffron-spice"] .nav-logo-icon { background: var(--brand); }
body[data-theme="saffron-spice"] .nav-links a { color: var(--text2); }
body[data-theme="saffron-spice"] .nav-links a:hover { color: var(--brand); background: rgba(212,132,10,.08); }
body[data-theme="saffron-spice"] .nav-links a.active { color: var(--brand); }
body[data-theme="saffron-spice"] .btn-nav-login:hover { border-color: var(--brand); color: var(--brand); }
body[data-theme="saffron-spice"] .btn-nav-register { background: var(--brand); }
body[data-theme="saffron-spice"] .btn-nav-register:hover { background: var(--brand-dark); }
body[data-theme="saffron-spice"] .nav-dropdown-menu { background: var(--surface); border-color: var(--border); }

/* ── Saffron buttons ── */
body[data-theme="saffron-spice"] .btn-primary {
    background: var(--brand);
    box-shadow: 0 2px 8px rgba(212,132,10,.30);
}
body[data-theme="saffron-spice"] .btn-primary:hover {
    background: var(--brand-dark);
    box-shadow: 0 4px 16px rgba(212,132,10,.42);
}
body[data-theme="saffron-spice"] .btn-outline { color: var(--brand); border-color: var(--brand); }
body[data-theme="saffron-spice"] .btn-outline:hover { background: rgba(212,132,10,.07); }
body[data-theme="saffron-spice"] .btn-gold { background: var(--gold); }

/* ── Decorative section backgrounds ── */
body[data-theme="saffron-spice"] .section-eyebrow { color: var(--brand); }
body[data-theme="saffron-spice"] .text-brand { color: var(--brand); }
body[data-theme="saffron-spice"] .text-gold { color: var(--gold); }

/* ── Footer — deep warm dark ── */
body[data-theme="saffron-spice"] .site-footer { background: #150900; }
body[data-theme="saffron-spice"] .footer-brand-icon { background: var(--brand); }
body[data-theme="saffron-spice"] .footer-social a:hover { background: var(--brand); border-color: var(--brand); }
body[data-theme="saffron-spice"] .footer-contact-item i { color: var(--gold); }

body[data-theme="saffron-spice"] .badge-brand { background: rgba(212,132,10,.12); color: var(--brand); }
body[data-theme="saffron-spice"] .badge-gold  { background: rgba(196,122,26,.14); color: #A86208; }
</style>
