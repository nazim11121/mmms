{{-- Arctic Minimal: ultra-clean monochrome — uses Inter for everything, no serif --}}
<style>
:root {
    --brand:       #1A1A1A;
    --brand-dark:  #000000;
    --brand-light: #444444;
    --gold:        #888888;
    --gold-light:  #AAAAAA;
    --bg:          #F7F7F7;
    --surface:     #FFFFFF;
    --surface2:    #FAFAFA;
    --border:      #E4E4E4;
    --border-2:    #EDEDED;
    --text1:       #0A0A0A;
    --text2:       #2A2A2A;
    --text3:       #6A6A6A;
    --text4:       #9A9A9A;
    --success:     #16A34A;
    --warning:     #CA8A04;
    --info:        #2563EB;
    --r-sm: 4px; --r-md: 8px; --r-lg: 12px; --r-xl: 16px;
    --sh-sm: 0 1px 3px rgba(0,0,0,.08);
    --sh-md: 0 4px 16px rgba(0,0,0,.10);
    --sh-lg: 0 8px 32px rgba(0,0,0,.12);
    --sh-xl: 0 16px 48px rgba(0,0,0,.16);
}
/* Override headings to use Inter instead of Playfair Display */
h1,h2,h3,h4,h5 {
    font-family: 'Inter', system-ui, sans-serif;
    font-weight: 700;
    letter-spacing: -.02em;
}
.nav-logo { font-family: 'Inter', sans-serif; font-weight: 800; letter-spacing: -.04em; color: var(--brand); }
.footer-brand-name { font-family: 'Inter', sans-serif; font-weight: 800; letter-spacing: -.03em; }
.section-title { font-family: 'Inter', sans-serif; font-weight: 700; letter-spacing: -.025em; }
.section-eyebrow { color: var(--text3); letter-spacing: .06em; }
/* Buttons — flat style */
.btn-primary { background: var(--brand); color: #fff; box-shadow: none; border-radius: 4px; }
.btn-primary:hover { background: var(--brand-dark); box-shadow: none; transform: none; }
.btn-outline { color: var(--brand); border-color: var(--brand); }
.btn-outline:hover { background: rgba(0,0,0,.04); transform: none; }
.btn:hover { transform: none; }
.btn-nav-register { background: var(--brand); border-radius: 4px; }
.btn-nav-register:hover { background: var(--brand-dark); }
.nav-links a:hover { color: var(--brand); background: rgba(0,0,0,.04); }
.nav-links a.active { color: var(--brand); }
.btn-nav-login:hover { border-color: var(--brand); color: var(--brand); }
.text-brand { color: var(--brand); }
.text-gold { color: var(--text3); }
.footer-social a:hover { background: var(--brand); border-color: var(--brand); }
.badge-brand { background: rgba(0,0,0,.07); color: var(--brand); }
.nav-logo-icon { background: var(--brand); border-radius: 4px; }
.footer-brand-icon { background: var(--brand); }
/* Nav accent */
.site-nav { border-bottom-color: #E0E0E0; }
.nav-avatar-btn { border-radius: 4px; }
.nav-dropdown-menu { border-radius: 4px; }
.card { border-radius: 8px; }
</style>
