{{-- Corporate Flat: pure white, zero shadows, zero radius, professional blue --}}
<style>
:root {
    --brand:       #0057B7;
    --brand-dark:  #003D8A;
    --brand-light: #1A72D4;
    --gold:        #F59E0B;
    --gold-light:  #FCD34D;
    --bg:          #F0F2F5;
    --surface:     #FFFFFF;
    --surface2:    #F8F9FB;
    --border:      #D4D8DE;
    --border-2:    #E4E7EC;
    --text1:       #0A0E14;
    --text2:       #1E2A3A;
    --text3:       #5A6472;
    --text4:       #96A0AD;
    --success:     #0F7438;
    --warning:     #C47A00;
    --info:        #0057B7;
    --r-sm: 2px; --r-md: 3px; --r-lg: 4px; --r-xl: 6px;
    --sh-sm: none;
    --sh-md: none;
    --sh-lg: 0 2px 8px rgba(0,0,0,.08);
    --sh-xl: 0 4px 16px rgba(0,0,0,.10);
}

/* Override heading font — Inter only, no serif */
h1,h2,h3,h4,h5 {
    font-family: 'Inter', system-ui, sans-serif;
    font-weight: 700;
    letter-spacing: -.02em;
}
.section-title { font-family: 'Inter', system-ui, sans-serif; }
.nav-logo { font-family: 'Inter', sans-serif; font-weight: 800; letter-spacing: -.04em; }
.footer-brand-name { font-family: 'Inter', sans-serif; font-weight: 800; }

/* ── Flat nav — thick bottom border, no blur ── */
body[data-theme="corporate-flat"] .site-nav {
    background: #FFFFFF;
    backdrop-filter: none;
    border-bottom: 2px solid var(--brand);
    box-shadow: none;
}
body[data-theme="corporate-flat"] .nav-logo { color: var(--brand); }
body[data-theme="corporate-flat"] .nav-logo-icon { background: var(--brand); border-radius: 2px; }
body[data-theme="corporate-flat"] .nav-links a:hover { color: var(--brand); background: rgba(0,87,183,.06); border-radius: 2px; }
body[data-theme="corporate-flat"] .nav-links a.active { color: var(--brand); }
body[data-theme="corporate-flat"] .btn-nav-login { border-color: var(--border); border-radius: 2px; }
body[data-theme="corporate-flat"] .btn-nav-login:hover { border-color: var(--brand); color: var(--brand); }
body[data-theme="corporate-flat"] .btn-nav-register { background: var(--brand); border-radius: 2px; }
body[data-theme="corporate-flat"] .btn-nav-register:hover { background: var(--brand-dark); transform: none; }
body[data-theme="corporate-flat"] .nav-avatar-btn { border-radius: 2px; }
body[data-theme="corporate-flat"] .nav-dropdown-menu { border-radius: 2px; box-shadow: 0 4px 12px rgba(0,0,0,.12); }

/* ── Flat buttons — no hover lift ── */
body[data-theme="corporate-flat"] .btn { border-radius: 2px; box-shadow: none; }
body[data-theme="corporate-flat"] .btn:hover { transform: none; }
body[data-theme="corporate-flat"] .btn-primary { background: var(--brand); box-shadow: none; }
body[data-theme="corporate-flat"] .btn-primary:hover { background: var(--brand-dark); box-shadow: none; }
body[data-theme="corporate-flat"] .btn-outline { color: var(--brand); border-color: var(--brand); }
body[data-theme="corporate-flat"] .btn-outline:hover { background: rgba(0,87,183,.06); }
body[data-theme="corporate-flat"] .btn-ghost { border-radius: 2px; }

/* ── Flat cards ── */
body[data-theme="corporate-flat"] .card { border-radius: 2px; box-shadow: none; }
body[data-theme="corporate-flat"] .card-hover:hover { transform: none; box-shadow: 0 2px 8px rgba(0,0,0,.08); }

/* ── Footer ── */
body[data-theme="corporate-flat"] .site-footer { background: #0A0E14; }
body[data-theme="corporate-flat"] .footer-social a:hover { background: var(--brand); border-color: var(--brand); }

/* ── Misc ── */
body[data-theme="corporate-flat"] .section-eyebrow { color: var(--brand); }
body[data-theme="corporate-flat"] .text-brand { color: var(--brand); }
body[data-theme="corporate-flat"] .badge-brand { background: rgba(0,87,183,.1); color: var(--brand); }
body[data-theme="corporate-flat"] .nav-logo-icon { border-radius: 2px; }
body[data-theme="corporate-flat"] .footer-brand-icon { border-radius: 2px; }
</style>
