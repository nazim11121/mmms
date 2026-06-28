<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<style>
:root {
    --brand:       #D4AF37;
    --brand-dark:  #B8942A;
    --brand-light: #E8C84A;
    --gold:        #E8C84A;
    --gold-light:  #F5D96A;
    --bg:          #16130E;
    --surface:     #221E17;
    --surface2:    #2A2520;
    --border:      rgba(212,175,55,.22);
    --border-2:    rgba(212,175,55,.12);
    --text1:       #F5EFE0;
    --text2:       #D4C8A8;
    --text3:       #9A8C6A;
    --text4:       #6A5C40;
    --success:     #4ADE80;
    --warning:     #FCD34D;
    --info:        #60A5FA;
    --sh-sm: 0 1px 4px rgba(0,0,0,.5);
    --sh-md: 0 4px 20px rgba(0,0,0,.6);
    --sh-lg: 0 8px 40px rgba(0,0,0,.7);
    --sh-xl: 0 20px 60px rgba(0,0,0,.82);
}
h1,h2,h3,h4,h5 { font-family: 'Cormorant Garamond', Georgia, serif; letter-spacing: .01em; }
.nav-logo { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; color: var(--brand); }
.footer-brand-name { font-family: 'Cormorant Garamond', serif; }
.section-title { font-family: 'Cormorant Garamond', serif; }

/* Dark navigation */
.site-nav { background: rgba(22,19,14,.96); border-bottom-color: rgba(212,175,55,.15); }
.nav-links a { color: rgba(245,239,224,.6); }
.nav-links a:hover { color: var(--brand); background: rgba(212,175,55,.08); }
.nav-links a.active { color: var(--brand); }
.btn-nav-login { border-color: rgba(212,175,55,.3); color: rgba(245,239,224,.7); }
.btn-nav-login:hover { border-color: var(--brand); color: var(--brand); }
.btn-nav-register { background: var(--brand); color: #16130E; font-weight: 700; }
.btn-nav-register:hover { background: var(--brand-light); }
.nav-avatar-btn { border-color: rgba(212,175,55,.3); color: var(--text1); }
.nav-avatar-btn:hover { border-color: var(--brand); }
.nav-dropdown-menu { background: var(--surface); border-color: rgba(212,175,55,.2); }
.dropdown-item { color: var(--text2); }
.dropdown-item:hover { background: var(--surface2); color: var(--brand); }
.hamburger span { background: var(--text1); }
.mobile-menu { background: #1C1914; }
.mobile-menu a { color: var(--text2); }
.mobile-menu a:hover { background: rgba(212,175,55,.08); color: var(--brand); }

/* Footer */
.site-footer { background: #0E0C08; }
.footer-social a:hover { background: var(--brand); border-color: var(--brand); color: #0E0C08; }

/* Buttons */
.btn-primary { background: var(--brand); color: #16130E; box-shadow: 0 2px 8px rgba(212,175,55,.30); }
.btn-primary:hover { background: var(--brand-light); box-shadow: 0 4px 16px rgba(212,175,55,.40); }
.btn-outline { color: var(--brand); border-color: var(--brand); }
.btn-outline:hover { background: rgba(212,175,55,.08); }
.btn-ghost { color: var(--text2); border-color: var(--border); }
.btn-ghost:hover { border-color: var(--brand); color: var(--brand); background: rgba(212,175,55,.06); }
.btn-gold { background: var(--gold); color: #16130E; }

/* Section eyebrow */
.section-eyebrow { color: var(--brand); }
.text-brand { color: var(--brand); }
.text-gold { color: var(--gold); }
.badge-brand { background: rgba(212,175,55,.15); color: var(--brand); }
.badge-gold { background: rgba(232,200,74,.15); color: var(--gold); }

/* Card overrides */
.card { background: var(--surface); border-color: var(--border-2); }

/* Flash messages on dark */
.flash-item { background: var(--surface); border-color: var(--border-2); color: var(--text1); }
</style>
