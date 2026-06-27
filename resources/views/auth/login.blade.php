@extends('layouts.app')
@section('title', 'Sign In — MMMS')
@push('styles')
<style>
.auth-wrap {
    min-height: 100vh; display: flex;
    background: var(--bg);
}
.auth-brand-panel {
    flex: 0 0 44%; display: flex; flex-direction: column;
    background: linear-gradient(150deg, #B5341A 0%, #7D1F3A 50%, #2C0D22 100%);
    padding: 48px; position: relative; overflow: hidden;
}
.auth-brand-panel::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 26px 26px;
}
.auth-brand-ring {
    position: absolute; border-radius: 50%; border: 1px solid rgba(255,255,255,.06);
}
.auth-brand-panel-body { position: relative; z-index: 1; flex: 1; display: flex; flex-direction: column; }
.auth-brand-logo { margin-bottom: auto; }
.auth-brand-logo a { text-decoration: none; color: #fff; font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; display: inline-flex; align-items: center; gap: 10px; }
.auth-brand-logo a i { color: var(--gold); }
.auth-brand-headline { margin-bottom: 40px; }
.auth-brand-headline h2 {
    font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 700;
    color: #fff; line-height: 1.2; margin-bottom: 14px; text-wrap: balance;
}
.auth-brand-headline p { color: rgba(255,255,255,.7); font-size: .95rem; line-height: 1.7; }
.auth-brand-trust { display: flex; flex-direction: column; gap: 12px; }
.auth-brand-trust-item {
    display: flex; align-items: center; gap: 12px;
    background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px; padding: 12px 16px;
    color: rgba(255,255,255,.85); font-size: .85rem;
}
.auth-brand-trust-item i { color: var(--gold); font-size: 1rem; flex-shrink: 0; }

.auth-form-panel {
    flex: 1; display: flex; align-items: center; justify-content: center;
    padding: 48px 40px; background: var(--surface);
}
.auth-form-box { width: 100%; max-width: 420px; }
.auth-form-title { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--text1); margin-bottom: 6px; }
.auth-form-sub { color: var(--text3); font-size: .9rem; margin-bottom: 32px; }
.auth-form-sub a { color: var(--brand); text-decoration: none; font-weight: 600; }
.auth-form-sub a:hover { text-decoration: underline; }

.auth-form-field { margin-bottom: 20px; }
.auth-form-label { display: block; font-size: .82rem; font-weight: 600; color: var(--text2); margin-bottom: 6px; letter-spacing: .02em; }
.auth-input-wrap { position: relative; }
.auth-input-wrap .auth-input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text4); font-size: .9rem; pointer-events: none; }
.auth-input {
    width: 100%; padding: 11px 14px 11px 40px; border: 1.5px solid var(--border);
    border-radius: 10px; background: var(--surface); color: var(--text1);
    font-size: .9rem; font-family: inherit; transition: border-color .2s, box-shadow .2s;
    -webkit-appearance: none; outline: none; box-sizing: border-box;
}
.auth-input:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(181,52,26,.1); }
.auth-input.is-invalid { border-color: #dc3545; }
.auth-field-error { font-size: .78rem; color: #dc3545; margin-top: 5px; display: flex; align-items: center; gap: 5px; }
.auth-toggle-pw { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text4); padding: 0; display: flex; align-items: center; }
.auth-toggle-pw:hover { color: var(--text2); }

.auth-form-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; gap: 12px; }
.auth-check { display: flex; align-items: center; gap: 8px; cursor: pointer; }
.auth-check input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--brand); cursor: pointer; }
.auth-check span { font-size: .85rem; color: var(--text2); }
.auth-forgot { font-size: .85rem; color: var(--brand); text-decoration: none; font-weight: 500; white-space: nowrap; }
.auth-forgot:hover { text-decoration: underline; }

.btn-auth-submit {
    width: 100%; padding: 13px; background: var(--brand); color: #fff;
    border: none; border-radius: 10px; font-size: .95rem; font-weight: 700;
    font-family: inherit; cursor: pointer; display: flex; align-items: center;
    justify-content: center; gap: 8px;
    transition: background .2s, transform .15s, box-shadow .2s;
    box-shadow: 0 2px 12px rgba(181,52,26,.25);
}
.btn-auth-submit:hover { background: var(--brand-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(181,52,26,.35); }
.btn-auth-submit:active { transform: translateY(0); }

.auth-bottom-link {
    text-align: center; margin-top: 24px; padding-top: 24px;
    border-top: 1px solid var(--border-2);
    font-size: .87rem; color: var(--text3);
}
.auth-bottom-link a { color: var(--brand); font-weight: 600; text-decoration: none; }
.auth-bottom-link a:hover { text-decoration: underline; }

@media (max-width: 768px) {
    .auth-wrap { flex-direction: column; }
    .auth-brand-panel { flex: 0 0 auto; padding: 28px 24px 32px; }
    .auth-brand-trust { display: none; }
    .auth-brand-headline h2 { font-size: 1.6rem; margin-bottom: 8px; }
    .auth-brand-ring { display: none; }
    .auth-form-panel { padding: 32px 20px; }
    .auth-brand-logo { margin-bottom: 20px; }
}
</style>
@endpush
@section('content')
<div class="auth-wrap">
    <div class="auth-brand-panel">
        <div class="auth-brand-ring" style="width:500px;height:500px;right:-100px;top:-100px;"></div>
        <div class="auth-brand-ring" style="width:300px;height:300px;right:50px;bottom:-50px;"></div>
        <div class="auth-brand-panel-body">
            <div class="auth-brand-logo">
                <a href="{{ route('home') }}"><i class="fas fa-heart"></i> MMMS</a>
            </div>
            <div class="auth-brand-headline">
                <h2>Welcome Back to Your Journey</h2>
                <p>Sign in to continue exploring profiles and connect with your potential life partner.</p>
            </div>
            <div class="auth-brand-trust">
                <div class="auth-brand-trust-item"><i class="fas fa-shield-alt"></i> 100% verified profiles</div>
                <div class="auth-brand-trust-item"><i class="fas fa-lock"></i> Your data is always private</div>
                <div class="auth-brand-trust-item"><i class="fas fa-users"></i> Join 5,000+ happy members</div>
            </div>
        </div>
    </div>

    <div class="auth-form-panel">
        <div class="auth-form-box">
            <h1 class="auth-form-title">Sign In</h1>
            <p class="auth-form-sub">New here? <a href="{{ route('register') }}">Create a free account</a></p>

            @if($errors->any())
            <div style="background:rgba(220,53,69,.08); border:1.5px solid rgba(220,53,69,.25); border-radius:10px; padding:12px 16px; margin-bottom:20px; font-size:.875rem; color:#b02a37; display:flex; align-items:flex-start; gap:10px;">
                <i class="fas fa-exclamation-circle" style="margin-top:2px; flex-shrink:0;"></i>
                <div>{{ $errors->first() }}</div>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                <div class="auth-form-field">
                    <label class="auth-form-label" for="email">Email Address</label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-envelope auth-input-icon"></i>
                        <input type="email" id="email" name="email"
                            class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email') }}" placeholder="you@example.com"
                            autocomplete="email" required>
                    </div>
                    @error('email')<div class="auth-field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                </div>

                <div class="auth-form-field">
                    <label class="auth-form-label" for="password">Password</label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-lock auth-input-icon"></i>
                        <input type="password" id="password" name="password"
                            class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="••••••••" autocomplete="current-password" required>
                        <button type="button" class="auth-toggle-pw" id="togglePw" aria-label="Toggle password visibility">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')<div class="auth-field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                </div>

                <div class="auth-form-row">
                    <label class="auth-check">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="auth-forgot">Forgot password?</a>
                </div>

                <button type="submit" class="btn-auth-submit">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>

            <div class="auth-bottom-link">
                Don't have an account? <a href="{{ route('register') }}">Register for free</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('togglePw')?.addEventListener('click', function() {
    const pw = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (pw.type === 'password') { pw.type = 'text'; icon.className = 'fas fa-eye-slash'; }
    else { pw.type = 'password'; icon.className = 'fas fa-eye'; }
});
</script>
@endpush
