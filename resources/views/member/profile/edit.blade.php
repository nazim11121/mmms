@extends('layouts.member')
@section('title', 'Edit Profile')
@section('page-title', 'My Profile')
@section('content')
<style>
.profile-tabs { display: flex; gap: 4px; background: var(--bg); border: 1px solid var(--border); border-radius: 12px; padding: 4px; margin-bottom: 28px; flex-wrap: wrap; }
.profile-tab {
    flex: 1; min-width: 110px; padding: 9px 14px; border-radius: 9px; font-size: .83rem; font-weight: 600;
    color: var(--text3); background: none; border: none; cursor: pointer; font-family: inherit;
    display: flex; align-items: center; gap: 6px; justify-content: center;
    transition: all .2s; white-space: nowrap;
}
.profile-tab.active { background: var(--surface); color: var(--brand); box-shadow: var(--sh-sm); }
.profile-tab:hover:not(.active) { color: var(--text1); background: rgba(255,255,255,.5); }
.tab-pane { display: none; }
.tab-pane.active { display: block; }

.form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
.form-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
.form-full { grid-column: 1 / -1; }
.field-group { display: flex; flex-direction: column; gap: 6px; }
.field-label { font-size: .8rem; font-weight: 600; color: var(--text2); letter-spacing: .02em; }
.field-label span { color: #dc3545; margin-left: 2px; }
.field-input, .field-select, .field-textarea {
    padding: 10px 13px; border: 1.5px solid var(--border); border-radius: 9px;
    background: var(--surface); color: var(--text1); font-size: .875rem; font-family: inherit;
    transition: border-color .2s, box-shadow .2s; outline: none; width: 100%; box-sizing: border-box;
    -webkit-appearance: none;
}
.field-input:focus, .field-select:focus, .field-textarea:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(181,52,26,.1); }
.field-textarea { resize: vertical; min-height: 100px; }
.field-error { font-size: .76rem; color: #dc3545; display: flex; align-items: center; gap: 4px; margin-top: 2px; }

.save-row { display: flex; align-items: center; gap: 12px; margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-2); }
.btn-save { padding: 10px 28px; background: var(--brand); color: #fff; border: none; border-radius: 9px; font-size: .9rem; font-weight: 700; font-family: inherit; cursor: pointer; display: flex; align-items: center; gap: 7px; transition: all .2s; }
.btn-save:hover { background: var(--brand-dark); transform: translateY(-1px); }

@media (max-width: 640px) {
    .form-grid, .form-grid-3 { grid-template-columns: 1fr; }
    .profile-tabs { gap: 2px; }
    .profile-tab { font-size: .78rem; padding: 8px 8px; }
}
</style>

<div class="profile-tabs" role="tablist">
    <button class="profile-tab active" data-tab="basic"><i class="fas fa-user"></i> Basic</button>
    <button class="profile-tab" data-tab="education"><i class="fas fa-graduation-cap"></i> Education</button>
    <button class="profile-tab" data-tab="family"><i class="fas fa-home"></i> Family</button>
    <button class="profile-tab" data-tab="partner"><i class="fas fa-heart"></i> Partner</button>
</div>

<!-- Tab: Basic Info -->
<div class="tab-pane active" id="tab-basic">
    <div class="panel">
        <div class="panel-title" style="margin-bottom:20px;"><i class="fas fa-user-circle"></i> Basic Information</div>
        @if($errors->has('basic'))
        <div style="background:rgba(220,53,69,.08);border:1.5px solid rgba(220,53,69,.25);border-radius:9px;padding:10px 14px;margin-bottom:16px;font-size:.83rem;color:#b02a37;display:flex;align-items:center;gap:8px;">
            <i class="fas fa-exclamation-circle"></i> {{ $errors->first('basic') }}
        </div>
        @endif
        <form method="POST" action="{{ route('member.profile.update') }}">
            @csrf @method('PUT')
            <input type="hidden" name="tab" value="basic">
            <div class="form-grid">
                <div class="field-group">
                    <label class="field-label" for="date_of_birth">Date of Birth <span>*</span></label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="field-input {{ $errors->has('date_of_birth') ? 'border-danger' : '' }}" value="{{ old('date_of_birth', $profile?->date_of_birth) }}">
                    @error('date_of_birth')<div class="field-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
                </div>
                <div class="field-group">
                    <label class="field-label">Height (cm)</label>
                    <input type="number" name="height" class="field-input" value="{{ old('height', $profile?->height) }}" placeholder="e.g. 170" min="100" max="220">
                </div>
                <div class="field-group">
                    <label class="field-label">Weight (kg)</label>
                    <input type="number" name="weight" class="field-input" value="{{ old('weight', $profile?->weight) }}" placeholder="e.g. 65">
                </div>
                <div class="field-group">
                    <label class="field-label">Blood Group</label>
                    <select name="blood_group" class="field-select">
                        <option value="">Select</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood_group', $profile?->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Complexion</label>
                    <select name="complexion" class="field-select">
                        <option value="">Select</option>
                        @foreach(['fair', 'wheatish', 'brown', 'dark'] as $c)
                            <option value="{{ $c }}" {{ old('complexion', $profile?->complexion) == $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Marital Status</label>
                    <select name="marital_status" class="field-select">
                        <option value="">Select</option>
                        @foreach(['never_married' => 'Never Married', 'divorced' => 'Divorced', 'widowed' => 'Widowed'] as $k => $v)
                            <option value="{{ $k }}" {{ old('marital_status', $profile?->marital_status) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Religion</label>
                    <select name="religion" class="field-select">
                        <option value="">Select</option>
                        @foreach(['islam' => 'Islam', 'hinduism' => 'Hinduism', 'christianity' => 'Christianity', 'buddhism' => 'Buddhism', 'other' => 'Other'] as $k => $v)
                            <option value="{{ $k }}" {{ old('religion', $profile?->religion) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Nationality</label>
                    <input type="text" name="nationality" class="field-input" value="{{ old('nationality', $profile?->nationality ?? 'Bangladeshi') }}">
                </div>
                <div class="field-group">
                    <label class="field-label">District</label>
                    <select name="district" class="field-select">
                        <option value="">Select</option>
                        @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Sylhet','Barishal','Mymensingh','Rangpur'] as $d)
                            <option value="{{ $d }}" {{ old('district', $profile?->district) == $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Phone (visible to matches)</label>
                    <input type="tel" name="phone" class="field-input" value="{{ old('phone', auth()->user()->phone) }}" placeholder="01XXXXXXXXX">
                </div>
                <div class="field-group form-full">
                    <label class="field-label">Address</label>
                    <input type="text" name="address" class="field-input" value="{{ old('address', $profile?->address) }}" placeholder="Your city/area">
                </div>
                <div class="field-group form-full">
                    <label class="field-label">About Yourself</label>
                    <textarea name="bio" class="field-textarea" placeholder="Write a short introduction about yourself, your values, and what you're looking for...">{{ old('bio', $profile?->bio) }}</textarea>
                </div>
            </div>
            <div class="save-row">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Basic Info</button>
            </div>
        </form>
    </div>
</div>

<!-- Tab: Education -->
<div class="tab-pane" id="tab-education">
    <div class="panel">
        <div class="panel-title" style="margin-bottom:20px;"><i class="fas fa-graduation-cap"></i> Education & Career</div>
        <form method="POST" action="{{ route('member.profile.update') }}">
            @csrf @method('PUT')
            <input type="hidden" name="tab" value="education">
            <div class="form-grid">
                <div class="field-group">
                    <label class="field-label">Highest Education</label>
                    <select name="education" class="field-select">
                        <option value="">Select</option>
                        @foreach(['SSC','HSC','Bachelor','Masters','PhD','Other'] as $e)
                            <option value="{{ $e }}" {{ old('education', $profile?->education) == $e ? 'selected' : '' }}>{{ $e }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Institution</label>
                    <input type="text" name="institution" class="field-input" value="{{ old('institution', $profile?->institution) }}" placeholder="University/College name">
                </div>
                <div class="field-group">
                    <label class="field-label">Profession</label>
                    <input type="text" name="profession" class="field-input" value="{{ old('profession', $profile?->profession) }}" placeholder="e.g. Software Engineer">
                </div>
                <div class="field-group">
                    <label class="field-label">Employer</label>
                    <input type="text" name="employer" class="field-input" value="{{ old('employer', $profile?->employer) }}" placeholder="Company name">
                </div>
                <div class="field-group">
                    <label class="field-label">Monthly Income (BDT)</label>
                    <input type="number" name="monthly_income" class="field-input" value="{{ old('monthly_income', $profile?->monthly_income) }}" placeholder="e.g. 50000">
                </div>
            </div>
            <div class="save-row">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Education Info</button>
            </div>
        </form>
    </div>
</div>

<!-- Tab: Family -->
<div class="tab-pane" id="tab-family">
    <div class="panel">
        <div class="panel-title" style="margin-bottom:20px;"><i class="fas fa-home"></i> Family Background</div>
        <form method="POST" action="{{ route('member.profile.update') }}">
            @csrf @method('PUT')
            <input type="hidden" name="tab" value="family">
            <div class="form-grid">
                <div class="field-group">
                    <label class="field-label">Family Type</label>
                    <select name="family_type" class="field-select">
                        <option value="">Select</option>
                        @foreach(['nuclear' => 'Nuclear', 'joint' => 'Joint', 'extended' => 'Extended'] as $k => $v)
                            <option value="{{ $k }}" {{ old('family_type', $profile?->family_type) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Family Status</label>
                    <select name="family_status" class="field-select">
                        <option value="">Select</option>
                        @foreach(['middle_class' => 'Middle Class', 'upper_middle' => 'Upper Middle', 'rich' => 'Rich', 'affluent' => 'Affluent'] as $k => $v)
                            <option value="{{ $k }}" {{ old('family_status', $profile?->family_status) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Father's Occupation</label>
                    <input type="text" name="father_occupation" class="field-input" value="{{ old('father_occupation', $profile?->father_occupation) }}">
                </div>
                <div class="field-group">
                    <label class="field-label">Mother's Occupation</label>
                    <input type="text" name="mother_occupation" class="field-input" value="{{ old('mother_occupation', $profile?->mother_occupation) }}">
                </div>
                <div class="field-group">
                    <label class="field-label">No. of Brothers</label>
                    <input type="number" name="num_brothers" class="field-input" value="{{ old('num_brothers', $profile?->num_brothers) }}" min="0">
                </div>
                <div class="field-group">
                    <label class="field-label">No. of Sisters</label>
                    <input type="number" name="num_sisters" class="field-input" value="{{ old('num_sisters', $profile?->num_sisters) }}" min="0">
                </div>
            </div>
            <div class="save-row">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Family Info</button>
            </div>
        </form>
    </div>
</div>

<!-- Tab: Partner Preferences -->
<div class="tab-pane" id="tab-partner">
    <div class="panel">
        <div class="panel-title" style="margin-bottom:20px;"><i class="fas fa-heart"></i> Partner Preferences</div>
        <form method="POST" action="{{ route('member.profile.update') }}">
            @csrf @method('PUT')
            <input type="hidden" name="tab" value="partner">
            <div class="form-grid">
                <div class="field-group">
                    <label class="field-label">Age — From</label>
                    <input type="number" name="pref_age_min" class="field-input" value="{{ old('pref_age_min', $preference?->age_min) }}" placeholder="18">
                </div>
                <div class="field-group">
                    <label class="field-label">Age — To</label>
                    <input type="number" name="pref_age_max" class="field-input" value="{{ old('pref_age_max', $preference?->age_max) }}" placeholder="35">
                </div>
                <div class="field-group">
                    <label class="field-label">Height — Min (cm)</label>
                    <input type="number" name="pref_height_min" class="field-input" value="{{ old('pref_height_min', $preference?->height_min) }}" placeholder="150">
                </div>
                <div class="field-group">
                    <label class="field-label">Height — Max (cm)</label>
                    <input type="number" name="pref_height_max" class="field-input" value="{{ old('pref_height_max', $preference?->height_max) }}" placeholder="190">
                </div>
                <div class="field-group">
                    <label class="field-label">Religion</label>
                    <select name="pref_religion" class="field-select">
                        <option value="">Any</option>
                        @foreach(['islam' => 'Islam', 'hinduism' => 'Hinduism', 'christianity' => 'Christianity', 'buddhism' => 'Buddhism'] as $k => $v)
                            <option value="{{ $k }}" {{ old('pref_religion', $preference?->religion) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Education</label>
                    <select name="pref_education" class="field-select">
                        <option value="">Any</option>
                        @foreach(['SSC','HSC','Bachelor','Masters','PhD'] as $e)
                            <option value="{{ $e }}" {{ old('pref_education', $preference?->education) == $e ? 'selected' : '' }}>{{ $e }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">District</label>
                    <select name="pref_district" class="field-select">
                        <option value="">Any</option>
                        @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Sylhet','Barishal','Mymensingh','Rangpur'] as $d)
                            <option value="{{ $d }}" {{ old('pref_district', $preference?->district) == $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Marital Status</label>
                    <select name="pref_marital_status" class="field-select">
                        <option value="">Any</option>
                        @foreach(['never_married' => 'Never Married', 'divorced' => 'Divorced', 'widowed' => 'Widowed'] as $k => $v)
                            <option value="{{ $k }}" {{ old('pref_marital_status', $preference?->marital_status) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group form-full">
                    <label class="field-label">Additional Preferences</label>
                    <textarea name="pref_additional_info" class="field-textarea" placeholder="Any specific preferences not listed above...">{{ old('pref_additional_info', $preference?->additional_info) }}</textarea>
                </div>
            </div>
            <div class="save-row">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Preferences</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const tabs = document.querySelectorAll('.profile-tab');
const panes = document.querySelectorAll('.tab-pane');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = tab.dataset.tab;
        tabs.forEach(t => t.classList.remove('active'));
        panes.forEach(p => p.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('tab-' + target)?.classList.add('active');
    });
});
// Restore active tab from URL hash
const hash = window.location.hash.replace('#', '');
if (hash) { document.querySelector(`[data-tab="${hash}"]`)?.click(); }
</script>
@endpush
@endsection
