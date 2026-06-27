@extends('layouts.app')
@section('title', 'Register Free — MMMS')
@push('styles')
<style>
/* Reuse auth-wrap styles from login */
.auth-wrap { min-height: 100vh; display: flex; background: var(--bg); }
.auth-brand-panel {
    flex: 0 0 40%; display: flex; flex-direction: column;
    background: linear-gradient(150deg, #B5341A 0%, #7D1F3A 55%, #2C0D22 100%);
    padding: 48px; position: relative; overflow: hidden;
}
.auth-brand-panel::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 26px 26px;
}
.auth-brand-ring { position: absolute; border-radius: 50%; border: 1px solid rgba(255,255,255,.06); }
.auth-brand-panel-body { position: relative; z-index: 1; flex: 1; display: flex; flex-direction: column; }
.auth-brand-logo { margin-bottom: auto; }
.auth-brand-logo a { text-decoration: none; color: #fff; font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; display: inline-flex; align-items: center; gap: 10px; }
.auth-brand-logo a i { color: var(--gold); }
.auth-brand-headline { margin-bottom: 40px; }
.auth-brand-headline h2 { font-family: 'Playfair Display', serif; font-size: clamp(1.7rem, 2.5vw, 2.2rem); font-weight: 700; color: #fff; line-height: 1.2; margin-bottom: 14px; text-wrap: balance; }
.auth-brand-headline p { color: rgba(255,255,255,.7); font-size: .95rem; line-height: 1.7; }
.auth-steps { display: flex; flex-direction: column; gap: 16px; }
.auth-step { display: flex; align-items: flex-start; gap: 12px; }
.auth-step-num { width: 28px; height: 28px; border-radius: 50%; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: .75rem; font-weight: 700; color: #fff; flex-shrink: 0; margin-top: 2px; }
.auth-step-text strong { display: block; font-size: .88rem; color: #fff; margin-bottom: 2px; }
.auth-step-text span { font-size: .8rem; color: rgba(255,255,255,.6); }

.auth-form-panel { flex: 1; display: flex; align-items: flex-start; justify-content: center; padding: 48px 40px; background: var(--surface); overflow-y: auto; }
.auth-form-box { width: 100%; max-width: 460px; }
.auth-form-title { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--text1); margin-bottom: 6px; }
.auth-form-sub { color: var(--text3); font-size: .9rem; margin-bottom: 32px; }
.auth-form-sub a { color: var(--brand); text-decoration: none; font-weight: 600; }
.auth-form-sub a:hover { text-decoration: underline; }

.auth-form-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.auth-form-field { margin-bottom: 18px; }
.auth-form-label { display: block; font-size: .82rem; font-weight: 600; color: var(--text2); margin-bottom: 6px; letter-spacing: .02em; }
.auth-input-wrap { position: relative; }
.auth-input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text4); font-size: .9rem; pointer-events: none; }
.auth-input {
    width: 100%; padding: 11px 14px 11px 40px; border: 1.5px solid var(--border);
    border-radius: 10px; background: var(--surface); color: var(--text1);
    font-size: .9rem; font-family: inherit; transition: border-color .2s, box-shadow .2s;
    -webkit-appearance: none; outline: none; box-sizing: border-box;
}
.auth-input:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(181,52,26,.1); }
.auth-input.is-invalid { border-color: #dc3545; }
.auth-input.no-icon { padding-left: 14px; }
.auth-select { padding-left: 40px; cursor: pointer; }
.auth-field-error { font-size: .78rem; color: #dc3545; margin-top: 5px; display: flex; align-items: center; gap: 5px; }
.auth-toggle-pw { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text4); padding: 0; display: flex; align-items: center; }
.auth-toggle-pw:hover { color: var(--text2); }

.auth-terms { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 24px; padding: 14px; background: var(--bg); border: 1px solid var(--border); border-radius: 10px; }
.auth-terms input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--brand); cursor: pointer; flex-shrink: 0; margin-top: 1px; }
.auth-terms label { font-size: .84rem; color: var(--text2); line-height: 1.5; cursor: pointer; }
.auth-terms label a { color: var(--brand); text-decoration: none; font-weight: 500; }
.auth-terms label a:hover { text-decoration: underline; }

.btn-auth-submit {
    width: 100%; padding: 13px; background: var(--brand); color: #fff;
    border: none; border-radius: 10px; font-size: .95rem; font-weight: 700;
    font-family: inherit; cursor: pointer; display: flex; align-items: center;
    justify-content: center; gap: 8px;
    transition: background .2s, transform .15s, box-shadow .2s;
    box-shadow: 0 2px 12px rgba(181,52,26,.25);
}
.btn-auth-submit:hover { background: var(--brand-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(181,52,26,.35); }
.auth-bottom-link { text-align: center; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border-2); font-size: .87rem; color: var(--text3); }
.auth-bottom-link a { color: var(--brand); font-weight: 600; text-decoration: none; }
.auth-bottom-link a:hover { text-decoration: underline; }

@media (max-width: 768px) {
    .auth-wrap { flex-direction: column; }
    .auth-brand-panel { flex: 0 0 auto; padding: 28px 24px 32px; }
    .auth-steps { display: none; }
    .auth-brand-headline h2 { font-size: 1.5rem; margin-bottom: 8px; }
    .auth-brand-ring { display: none; }
    .auth-form-panel { padding: 28px 20px; }
    .auth-brand-logo { margin-bottom: 16px; }
    .auth-form-row2 { grid-template-columns: 1fr; gap: 0; }
}
</style>
@endpush
@section('content')
<div class="auth-wrap">
    <div class="auth-brand-panel">
        <div class="auth-brand-ring" style="width:500px;height:500px;right:-120px;top:-80px;"></div>
        <div class="auth-brand-ring" style="width:280px;height:280px;left:-60px;bottom:-60px;"></div>
        <div class="auth-brand-panel-body">
            <div class="auth-brand-logo">
                <a href="{{ route('home') }}"><i class="fas fa-heart"></i> MMMS</a>
            </div>
            <div class="auth-brand-headline">
                <h2>Start Your Love Story Here</h2>
                <p>Register in minutes and begin your journey toward finding the perfect life partner.</p>
            </div>
            <div class="auth-steps">
                <div class="auth-step">
                    <div class="auth-step-num">1</div>
                    <div class="auth-step-text">
                        <strong>Create Your Profile</strong>
                        <span>Share your background, values, and what you're looking for.</span>
                    </div>
                </div>
                <div class="auth-step">
                    <div class="auth-step-num">2</div>
                    <div class="auth-step-text">
                        <strong>Browse Matches</strong>
                        <span>Explore thousands of verified profiles filtered to your preferences.</span>
                    </div>
                </div>
                <div class="auth-step">
                    <div class="auth-step-num">3</div>
                    <div class="auth-step-text">
                        <strong>Connect Safely</strong>
                        <span>Send interest, chat, and meet your potential partner.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-form-panel">
        <div class="auth-form-box">
            <h1 class="auth-form-title">Create Account</h1>
            <p class="auth-form-sub">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>

            @if($errors->any())
            <div style="background:rgba(220,53,69,.08); border:1.5px solid rgba(220,53,69,.25); border-radius:10px; padding:12px 16px; margin-bottom:20px; font-size:.875rem; color:#b02a37; display:flex; align-items:flex-start; gap:10px;">
                <i class="fas fa-exclamation-circle" style="margin-top:2px; flex-shrink:0;"></i>
                <div>{{ $errors->first() }}</div>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="auth-form-row2">
                    <div class="auth-form-field">
                        <label class="auth-form-label" for="name">Full Name</label>
                        <div class="auth-input-wrap">
                            <i class="fas fa-user auth-input-icon"></i>
                            <input type="text" id="name" name="name"
                                class="auth-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ old('name') }}" placeholder="Your name" autocomplete="name" required>
                        </div>
                        @error('name')<div class="auth-field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                    </div>
                    <div class="auth-form-field">
                        <label class="auth-form-label" for="gender">Gender</label>
                        <div class="auth-input-wrap">
                            <i class="fas fa-venus-mars auth-input-icon"></i>
                            <select id="gender" name="gender"
                                class="auth-input auth-select {{ $errors->has('gender') ? 'is-invalid' : '' }}" required>
                                <option value="">Select</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        @error('gender')<div class="auth-field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="auth-form-field">
                    <label class="auth-form-label" for="email">Email Address</label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-envelope auth-input-icon"></i>
                        <input type="email" id="email" name="email"
                            class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required>
                    </div>
                    @error('email')<div class="auth-field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                </div>

                <div class="auth-form-field">
                    <label class="auth-form-label" for="phone">Phone Number</label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-phone auth-input-icon"></i>
                        <input type="tel" id="phone" name="phone"
                            class="auth-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                            value="{{ old('phone') }}" placeholder="01XXXXXXXXX">
                    </div>
                    @error('phone')<div class="auth-field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                </div>

                <div class="auth-form-row2">
                    <div class="auth-form-field">
                        <label class="auth-form-label" for="password">Password</label>
                        <div class="auth-input-wrap">
                            <i class="fas fa-lock auth-input-icon"></i>
                            <input type="password" id="password" name="password"
                                class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Min. 8 chars" autocomplete="new-password" required>
                            <button type="button" class="auth-toggle-pw" id="togglePw" aria-label="Toggle">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')<div class="auth-field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                    </div>
                    <div class="auth-form-field">
                        <label class="auth-form-label" for="password_confirmation">Confirm</label>
                        <div class="auth-input-wrap">
                            <i class="fas fa-lock auth-input-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="auth-input" placeholder="Repeat password" required>
                        </div>
                    </div>
                </div>

                <div class="auth-terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. I confirm all information provided is accurate and truthful.</label>
                </div>

                <button type="submit" class="btn-auth-submit">
                    <i class="fas fa-heart"></i> Create Free Account
                </button>
            </form>

            <div class="auth-bottom-link">
                Already registered? <a href="{{ route('login') }}">Sign in here</a>
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
