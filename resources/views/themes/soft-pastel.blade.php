<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
<style>
:root {
    --brand:       #9B59B6;
    --brand-dark:  #7D3C98;
    --brand-light: #BB8FCE;
    --gold:        #F39C12;
    --gold-light:  #F8C471;
    --bg:          #FBF5FF;
    --surface:     #FFFFFF;
    --surface2:    #FEF9FF;
    --border:      #E8D5F5;
    --border-2:    #F2E8FA;
    --text1:       #2C1A3E;
    --text2:       #4A2E60;
    --text3:       #7B5EA7;
    --text4:       #B09CC8;
    --success:     #27AE60;
    --warning:     #E67E22;
    --info:        #2E86C1;
    --r-sm: 16px; --r-md: 24px; --r-lg: 32px; --r-xl: 48px;
    --sh-sm: 0 2px 12px rgba(155,89,182,.1);
    --sh-md: 0 6px 28px rgba(155,89,182,.14);
    --sh-lg: 0 12px 50px rgba(155,89,182,.18);
    --sh-xl: 0 24px 80px rgba(155,89,182,.22);
}

/* ── Nunito for everything — round, friendly ── */
body[data-theme="soft-pastel"] {
    font-family: 'Nunito', system-ui, sans-serif;
}
body[data-theme="soft-pastel"] h1,
body[data-theme="soft-pastel"] h2,
body[data-theme="soft-pastel"] h3,
body[data-theme="soft-pastel"] h4,
body[data-theme="soft-pastel"] h5 {
    font-family: 'Nunito', system-ui, sans-serif;
    font-weight: 800;
    letter-spacing: -.01em;
}
body[data-theme="soft-pastel"] .nav-logo { font-family: 'Nunito', sans-serif; font-weight: 800; color: var(--brand); }
body[data-theme="soft-pastel"] .footer-brand-name { font-family: 'Nunito', sans-serif; font-weight: 800; }

/* ── Pastel nav ── */
body[data-theme="soft-pastel"] .site-nav {
    background: rgba(255,255,255,.92);
    border-bottom: 2px solid var(--border);
}
body[data-theme="soft-pastel"] .nav-logo { color: var(--brand); }
body[data-theme="soft-pastel"] .nav-logo-icon { background: var(--brand); border-radius: 50%; }
body[data-theme="soft-pastel"] .nav-links a { color: var(--text2); border-radius: 48px; }
body[data-theme="soft-pastel"] .nav-links a:hover { color: var(--brand); background: rgba(155,89,182,.08); }
body[data-theme="soft-pastel"] .nav-links a.active { color: var(--brand); }
body[data-theme="soft-pastel"] .btn-nav-login { border-radius: 48px; }
body[data-theme="soft-pastel"] .btn-nav-login:hover { border-color: var(--brand); color: var(--brand); }
body[data-theme="soft-pastel"] .btn-nav-register {
    background: var(--brand);
    border-radius: 48px;
}
body[data-theme="soft-pastel"] .btn-nav-register:hover { background: var(--brand-dark); }
body[data-theme="soft-pastel"] .nav-avatar-btn { border-radius: 48px; }
body[data-theme="soft-pastel"] .nav-dropdown-menu { border-radius: 24px; }

/* ── Pill buttons ── */
body[data-theme="soft-pastel"] .btn {
    border-radius: 48px;
    font-family: 'Nunito', sans-serif;
    font-weight: 700;
}
body[data-theme="soft-pastel"] .btn-primary {
    background: var(--brand);
    box-shadow: 0 4px 18px rgba(155,89,182,.30);
}
body[data-theme="soft-pastel"] .btn-primary:hover {
    background: var(--brand-dark);
    box-shadow: 0 6px 28px rgba(155,89,182,.45);
}
body[data-theme="soft-pastel"] .btn-outline { color: var(--brand); border-color: var(--brand); }
body[data-theme="soft-pastel"] .btn-outline:hover { background: rgba(155,89,182,.07); }
body[data-theme="soft-pastel"] .btn-ghost:hover { border-color: var(--brand); color: var(--brand); background: rgba(155,89,182,.05); }

/* ── Bubble cards ── */
body[data-theme="soft-pastel"] .card { border-radius: 28px; }

/* ── Footer ── */
body[data-theme="soft-pastel"] .site-footer { background: #2C1A3E; }
body[data-theme="soft-pastel"] .footer-brand-icon { background: var(--brand); border-radius: 50%; }
body[data-theme="soft-pastel"] .footer-social a:hover { background: var(--brand); border-color: var(--brand); }

/* ── Misc ── */
body[data-theme="soft-pastel"] .section-eyebrow { color: var(--brand); }
body[data-theme="soft-pastel"] .text-brand { color: var(--brand); }
body[data-theme="soft-pastel"] .badge-brand { background: rgba(155,89,182,.1); color: var(--brand); border-radius: 48px; }
body[data-theme="soft-pastel"] .badge-gold  { background: rgba(243,156,18,.1); color: #C0760A; border-radius: 48px; }
</style>
