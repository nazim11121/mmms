@extends('layouts.admin')
@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('content')
@php
    // $settings is a collection keyed by 'key' — helper to get value safely
    $s = fn($key, $default = '') => $settings->get($key)?->value ?? $default;
@endphp
<style>
.settings-wrap { max-width: 720px; }
.settings-tabs { display: flex; gap: 4px; background: var(--bg); border: 1px solid var(--border); border-radius: 10px; padding: 4px; margin-bottom: 24px; flex-wrap: wrap; }
.settings-tab { padding: 8px 18px; border-radius: 7px; font-size: .83rem; font-weight: 600; color: var(--text3); background: none; border: none; cursor: pointer; font-family: inherit; display: flex; align-items: center; gap: 6px; transition: all .2s; white-space: nowrap; }
.settings-tab.active { background: var(--surface); color: var(--brand); box-shadow: var(--sh-sm); }
.settings-tab:hover:not(.active) { color: var(--text1); }
.tab-pane { display: none; }
.tab-pane.active { display: block; }
.sf-field { margin-bottom: 18px; }
.sf-label { display: block; font-size: .8rem; font-weight: 600; color: var(--text2); margin-bottom: 6px; letter-spacing: .02em; }
.sf-input, .sf-textarea { width: 100%; padding: 10px 13px; border: 1.5px solid var(--border); border-radius: 9px; background: var(--surface); color: var(--text1); font-size: .875rem; font-family: inherit; outline: none; transition: border-color .2s; box-sizing: border-box; }
.sf-input:focus, .sf-textarea:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(181,52,26,.08); }
.sf-textarea { resize: vertical; min-height: 90px; }
.sf-hint { font-size: .75rem; color: var(--text4); margin-top: 4px; }
.sf-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.sf-submit { padding: 10px 24px; background: var(--brand); color: #fff; border: none; border-radius: 9px; font-size: .875rem; font-weight: 700; font-family: inherit; cursor: pointer; display: inline-flex; align-items: center; gap: 7px; transition: all .2s; }
.sf-submit:hover { background: var(--brand-dark); transform: translateY(-1px); }
</style>

<div class="settings-wrap">
    <div class="settings-tabs">
        <button class="settings-tab active" data-tab="general"><i class="fas fa-cog"></i> General</button>
        <button class="settings-tab" data-tab="contact"><i class="fas fa-envelope"></i> Contact</button>
        <button class="settings-tab" data-tab="social"><i class="fas fa-share-alt"></i> Social</button>
    </div>

    <!-- General -->
    <div class="tab-pane active" id="stab-general">
        <div class="panel">
            <div class="panel-title" style="margin-bottom:20px;"><i class="fas fa-cog"></i> General Settings</div>
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="sf-field">
                    <label class="sf-label">Site Name</label>
                    <input type="text" name="site_name" class="sf-input" value="{{ old('site_name', $s('site_name')) }}" placeholder="MMMS">
                </div>
                <div class="sf-field">
                    <label class="sf-label">Site Tagline</label>
                    <input type="text" name="site_tagline" class="sf-input" value="{{ old('site_tagline', $s('site_tagline')) }}" placeholder="Find Your Perfect Match">
                </div>
                <div class="sf-field">
                    <label class="sf-label">Footer Text</label>
                    <input type="text" name="footer_text" class="sf-input" value="{{ old('footer_text', $s('footer_text')) }}" placeholder="© 2025 MMMS. All rights reserved.">
                </div>
                <div class="sf-grid">
                    <div class="sf-field">
                        <label class="sf-label" style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="checkbox" name="registration_open" value="1" {{ $s('registration_open', '1') == '1' ? 'checked' : '' }} style="width:15px;height:15px;accent-color:var(--brand);">
                            Registration Open
                        </label>
                    </div>
                    <div class="sf-field">
                        <label class="sf-label" style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="checkbox" name="maintenance_mode" value="1" {{ $s('maintenance_mode') == '1' ? 'checked' : '' }} style="width:15px;height:15px;accent-color:var(--brand);">
                            Maintenance Mode
                        </label>
                    </div>
                </div>
                <div class="sf-field">
                    <label class="sf-label">Site Logo</label>
                    <input type="file" name="site_logo" class="sf-input" accept="image/*">
                    <div class="sf-hint">Leave blank to keep current logo</div>
                    @if($s('site_logo'))
                        <div style="margin-top:8px;">
                            <img src="{{ Storage::url($s('site_logo')) }}" style="height:40px; border-radius:4px;" alt="Current logo">
                        </div>
                    @endif
                </div>
                <div style="padding-top:14px; border-top:1px solid var(--border-2);">
                    <button type="submit" class="sf-submit"><i class="fas fa-save"></i> Save General Settings</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact -->
    <div class="tab-pane" id="stab-contact">
        <div class="panel">
            <div class="panel-title" style="margin-bottom:20px;"><i class="fas fa-envelope"></i> Contact Information</div>
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf @method('PUT')
                <div class="sf-field">
                    <label class="sf-label">Contact Email</label>
                    <input type="email" name="site_email" class="sf-input" value="{{ old('site_email', $s('site_email')) }}" placeholder="info@mmms.com">
                </div>
                <div class="sf-field">
                    <label class="sf-label">Contact Phone</label>
                    <input type="text" name="site_phone" class="sf-input" value="{{ old('site_phone', $s('site_phone')) }}" placeholder="+880 1XXX-XXXXXX">
                </div>
                <div class="sf-field">
                    <label class="sf-label">Office Address</label>
                    <textarea name="site_address" class="sf-textarea" placeholder="Full address...">{{ old('site_address', $s('site_address')) }}</textarea>
                </div>
                <div style="padding-top:14px; border-top:1px solid var(--border-2);">
                    <button type="submit" class="sf-submit"><i class="fas fa-save"></i> Save Contact Info</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Social -->
    <div class="tab-pane" id="stab-social">
        <div class="panel">
            <div class="panel-title" style="margin-bottom:20px;"><i class="fas fa-share-alt"></i> Social Media Links</div>
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf @method('PUT')
                @foreach(['facebook_url' => 'Facebook', 'instagram_url' => 'Instagram', 'twitter_url' => 'Twitter / X'] as $key => $label)
                <div class="sf-field">
                    <label class="sf-label">{{ $label }}</label>
                    <input type="url" name="{{ $key }}" class="sf-input" value="{{ old($key, $s($key)) }}" placeholder="https://...">
                </div>
                @endforeach
                <div style="padding-top:14px; border-top:1px solid var(--border-2);">
                    <button type="submit" class="sf-submit"><i class="fas fa-save"></i> Save Social Links</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.settings-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        const target = tab.dataset.tab;
        document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('stab-' + target)?.classList.add('active');
    });
});
</script>
@endpush
@endsection
