@extends('layouts.app')
@section('title', $user->name . ' — Profile — MMMS')
@push('styles')
<style>
.profile-detail-page { padding: 40px 0 72px; background: var(--bg); min-height: 80vh; }
.profile-layout { display: grid; grid-template-columns: 300px 1fr; gap: 28px; align-items: start; }

/* Profile photo card */
.profile-photo-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 18px; overflow: hidden; position: sticky; top: 80px;
}
.profile-photo-main { position: relative; aspect-ratio: 3/4; }
.profile-photo-main img { width: 100%; height: 100%; object-fit: cover; display: block; }
.profile-photo-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.5) 0%, transparent 60%); }
.profile-photo-badges { position: absolute; top: 12px; left: 12px; display: flex; flex-direction: column; gap: 6px; }
.profile-badge {
    display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px;
    border-radius: 6px; font-size: .7rem; font-weight: 700; backdrop-filter: blur(6px);
}
.profile-badge.verified { background: rgba(45,122,79,.88); color: #fff; }
.profile-badge.premium { background: rgba(200,139,58,.9); color: #fff; }
.profile-photo-name { position: absolute; bottom: 0; left: 0; right: 0; padding: 16px; }
.profile-photo-name h1 { font-family: 'Playfair Display', serif; font-size: 1.25rem; font-weight: 700; color: #fff; margin-bottom: 2px; }
.profile-photo-name p { font-size: .8rem; color: rgba(255,255,255,.75); display: flex; align-items: center; gap: 5px; }

.profile-photo-thumbnails { display: flex; gap: 8px; padding: 12px; overflow-x: auto; }
.profile-thumb { width: 56px; height: 56px; border-radius: 8px; overflow: hidden; cursor: pointer; border: 2px solid transparent; flex-shrink: 0; transition: border-color .2s; }
.profile-thumb:hover, .profile-thumb.active { border-color: var(--brand); }
.profile-thumb img { width: 100%; height: 100%; object-fit: cover; }

.profile-card-actions { padding: 16px; border-top: 1px solid var(--border-2); display: flex; flex-direction: column; gap: 8px; }
.profile-action-btn {
    width: 100%; padding: 10px; border-radius: 10px; font-size: .875rem; font-weight: 700;
    font-family: inherit; cursor: pointer; border: none; display: flex; align-items: center;
    justify-content: center; gap: 8px; text-decoration: none; transition: all .2s;
}
.profile-action-btn.solid { background: var(--brand); color: #fff; }
.profile-action-btn.solid:hover { background: var(--brand-dark); transform: translateY(-1px); }
.profile-action-btn.outline { border: 1.5px solid var(--brand); color: var(--brand); background: transparent; }
.profile-action-btn.outline:hover { background: rgba(181,52,26,.06); transform: translateY(-1px); }
.profile-action-btn.ghost { border: 1.5px solid var(--border); color: var(--text3); background: transparent; }
.profile-action-btn.ghost:hover { border-color: var(--text2); color: var(--text2); }

/* Main content */
.profile-section-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 16px; padding: 24px 28px; margin-bottom: 20px;
}
.profile-section-title {
    font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 700;
    color: var(--text1); margin-bottom: 18px; display: flex; align-items: center; gap: 8px;
    padding-bottom: 14px; border-bottom: 1px solid var(--border-2);
}
.profile-section-title i { color: var(--brand); font-size: .9rem; }

.profile-attrs { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
.profile-attr { display: flex; flex-direction: column; gap: 2px; }
.profile-attr-label { font-size: .75rem; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; color: var(--text4); }
.profile-attr-value { font-size: .9rem; color: var(--text1); font-weight: 500; }
.profile-attr-value.empty { color: var(--text4); font-style: italic; font-weight: 400; }

.profile-bio { font-size: .9rem; color: var(--text2); line-height: 1.75; }

/* Partner preference highlights */
.pref-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.pref-tag { background: rgba(181,52,26,.08); color: var(--brand); border: 1px solid rgba(181,52,26,.2); border-radius: 20px; padding: 5px 12px; font-size: .8rem; font-weight: 500; display: flex; align-items: center; gap: 5px; }
.pref-tag i { font-size: .75rem; }

/* Online indicator */
.online-dot { width: 10px; height: 10px; border-radius: 50%; background: #22c55e; display: inline-block; flex-shrink: 0; box-shadow: 0 0 0 2px rgba(34,197,94,.3); }

@media (max-width: 900px) {
    .profile-layout { grid-template-columns: 1fr; }
    .profile-photo-card { position: static; }
    .profile-photo-main { aspect-ratio: 4/3; max-height: 360px; }
    .profile-attrs { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
    .profile-attrs { grid-template-columns: 1fr 1fr; }
    .profile-section-card { padding: 20px 18px; }
}
</style>
@endpush
@section('content')
<div class="profile-detail-page">
    <div class="container">
        <!-- Breadcrumb -->
        <nav style="margin-bottom:20px; font-size:.83rem; color:var(--text3); display:flex; align-items:center; gap:8px;">
            <a href="{{ route('home') }}" style="color:var(--text3); text-decoration:none;">Home</a>
            <i class="fas fa-chevron-right" style="font-size:.65rem;"></i>
            <a href="{{ route('search') }}" style="color:var(--text3); text-decoration:none;">Browse Profiles</a>
            <i class="fas fa-chevron-right" style="font-size:.65rem;"></i>
            <span style="color:var(--text1); font-weight:500;">{{ $user->name }}</span>
        </nav>

        <div class="profile-layout">
            <!-- Photo column -->
            <div>
                <div class="profile-photo-card">
                    <div class="profile-photo-main">
                        <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" id="mainPhoto">
                        <div class="profile-photo-overlay"></div>
                        <div class="profile-photo-badges">
                            @if($user->profile?->is_verified)
                                <span class="profile-badge verified"><i class="fas fa-check"></i> Verified</span>
                            @endif
                            @if($user->isPremium())
                                <span class="profile-badge premium"><i class="fas fa-crown"></i> Premium</span>
                            @endif
                        </div>
                        <div class="profile-photo-name">
                            <h1>{{ $user->name }}</h1>
                            <p>
                                @if($user->is_online)
                                    <span class="online-dot"></span> Online now
                                @else
                                    <i class="fas fa-clock"></i>
                                    Last seen {{ $user->last_seen ? \Carbon\Carbon::parse($user->last_seen)->diffForHumans() : 'recently' }}
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($user->photos && $user->photos->count() > 1)
                    <div class="profile-photo-thumbnails">
                        @foreach($user->photos->where('visibility', '!=', 'private')->take(8) as $photo)
                        <div class="profile-thumb {{ $photo->is_primary ? 'active' : '' }}" onclick="switchPhoto('{{ Storage::url($photo->photo_path) }}', this)">
                            <img src="{{ Storage::url($photo->photo_path) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="profile-card-actions">
                        @auth
                            @if(auth()->id() !== $user->id)
                                <form method="POST" action="{{ route('member.interests.send', $user) }}" style="margin:0">
                                    @csrf
                                    <button type="submit" class="profile-action-btn solid">
                                        <i class="fas fa-heart"></i> Send Interest
                                    </button>
                                </form>
                                <a href="{{ route('member.messages.show', $user) }}" class="profile-action-btn outline">
                                    <i class="fas fa-comment"></i> Send Message
                                </a>
                                <form method="POST" action="{{ route('member.shortlist.toggle', $user) }}" style="margin:0">
                                    @csrf
                                    <button type="submit" class="profile-action-btn ghost">
                                        <i class="fas fa-bookmark"></i> Shortlist
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="profile-action-btn solid">
                                <i class="fas fa-heart"></i> Send Interest
                            </a>
                            <a href="{{ route('login') }}" class="profile-action-btn outline">
                                <i class="fas fa-comment"></i> Send Message
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Detail column -->
            <div>
                <!-- Basic info summary -->
                <div class="profile-section-card" style="border-top: 3px solid var(--brand); padding-top: 22px;">
                    <div style="display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
                        <div>
                            <h2 style="font-family:'Playfair Display',serif; font-size:1.6rem; font-weight:700; color:var(--text1); margin-bottom:4px;">{{ $user->name }}</h2>
                            <div style="display:flex; flex-wrap:wrap; gap:12px; font-size:.85rem; color:var(--text3);">
                                @if($user->profile?->age)
                                    <span><i class="fas fa-birthday-cake" style="color:var(--brand); margin-right:4px;"></i>{{ $user->profile->age }} years</span>
                                @endif
                                @if($user->profile?->district)
                                    <span><i class="fas fa-map-marker-alt" style="color:var(--brand); margin-right:4px;"></i>{{ $user->profile->district }}</span>
                                @endif
                                @if($user->profile?->religion)
                                    <span><i class="fas fa-pray" style="color:var(--brand); margin-right:4px;"></i>{{ ucfirst($user->profile->religion) }}</span>
                                @endif
                            </div>
                        </div>
                        <div style="background: rgba(181,52,26,.08); border-radius: 10px; padding: 10px 16px; text-align:center; min-width:80px;">
                            <div style="font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; color:var(--brand); line-height:1;">{{ $user->profile_complete ?? 0 }}%</div>
                            <div style="font-size:.72rem; color:var(--text4); font-weight:600; text-transform:uppercase; letter-spacing:.04em; margin-top:2px;">Complete</div>
                        </div>
                    </div>
                    @if($user->profile?->bio)
                    <p class="profile-bio">{{ $user->profile->bio }}</p>
                    @endif
                </div>

                <!-- Personal details -->
                <div class="profile-section-card">
                    <div class="profile-section-title"><i class="fas fa-user"></i> Personal Information</div>
                    <div class="profile-attrs">
                        @php
                        $attrs = [
                            'Date of Birth' => $user->profile?->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d M, Y') : null,
                            'Height' => $user->profile?->height_ft,
                            'Weight' => $user->profile?->weight ? $user->profile->weight . ' kg' : null,
                            'Complexion' => $user->profile?->complexion ? ucfirst($user->profile->complexion) : null,
                            'Blood Group' => $user->profile?->blood_group,
                            'Marital Status' => $user->profile?->marital_status ? ucwords(str_replace('_', ' ', $user->profile->marital_status)) : null,
                            'Nationality' => $user->profile?->nationality ?? 'Bangladeshi',
                            'Religion' => $user->profile?->religion ? ucfirst($user->profile->religion) : null,
                        ];
                        @endphp
                        @foreach($attrs as $label => $value)
                        <div class="profile-attr">
                            <span class="profile-attr-label">{{ $label }}</span>
                            <span class="profile-attr-value {{ $value ? '' : 'empty' }}">{{ $value ?? 'Not specified' }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Education & Career -->
                <div class="profile-section-card">
                    <div class="profile-section-title"><i class="fas fa-graduation-cap"></i> Education & Career</div>
                    <div class="profile-attrs">
                        @php
                        $eduAttrs = [
                            'Education' => $user->profile?->education,
                            'Institution' => $user->profile?->institution,
                            'Profession' => $user->profile?->profession,
                            'Employer' => $user->profile?->employer,
                            'Monthly Income' => $user->profile?->monthly_income ? '৳' . number_format($user->profile->monthly_income) : null,
                        ];
                        @endphp
                        @foreach($eduAttrs as $label => $value)
                        <div class="profile-attr">
                            <span class="profile-attr-label">{{ $label }}</span>
                            <span class="profile-attr-value {{ $value ? '' : 'empty' }}">{{ $value ?? 'Not specified' }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Location & Family -->
                <div class="profile-section-card">
                    <div class="profile-section-title"><i class="fas fa-home"></i> Location & Family</div>
                    <div class="profile-attrs">
                        @php
                        $locAttrs = [
                            'District' => $user->profile?->district,
                            'Address' => $user->profile?->address,
                            'Family Type' => $user->profile?->family_type ? ucfirst($user->profile->family_type) : null,
                            'Family Status' => $user->profile?->family_status ? ucwords(str_replace('_', ' ', $user->profile->family_status)) : null,
                            'Father\'s Occupation' => $user->profile?->father_occupation,
                            'Mother\'s Occupation' => $user->profile?->mother_occupation,
                            'No. of Brothers' => $user->profile?->num_brothers,
                            'No. of Sisters' => $user->profile?->num_sisters,
                        ];
                        @endphp
                        @foreach($locAttrs as $label => $value)
                        <div class="profile-attr">
                            <span class="profile-attr-label">{{ $label }}</span>
                            <span class="profile-attr-value {{ $value ? '' : 'empty' }}">{{ $value ?? 'Not specified' }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Partner Preferences -->
                @if($user->partnerPreference)
                <div class="profile-section-card">
                    <div class="profile-section-title"><i class="fas fa-heart"></i> Partner Preferences</div>
                    <div class="pref-tags">
                        @if($user->partnerPreference->age_min && $user->partnerPreference->age_max)
                            <span class="pref-tag"><i class="fas fa-birthday-cake"></i> Age: {{ $user->partnerPreference->age_min }}–{{ $user->partnerPreference->age_max }} yrs</span>
                        @endif
                        @if($user->partnerPreference->height_min && $user->partnerPreference->height_max)
                            <span class="pref-tag"><i class="fas fa-ruler-vertical"></i> Height: {{ $user->partnerPreference->height_min }}–{{ $user->partnerPreference->height_max }} cm</span>
                        @endif
                        @if($user->partnerPreference->religion)
                            <span class="pref-tag"><i class="fas fa-pray"></i> {{ ucfirst($user->partnerPreference->religion) }}</span>
                        @endif
                        @if($user->partnerPreference->education)
                            <span class="pref-tag"><i class="fas fa-graduation-cap"></i> Min: {{ $user->partnerPreference->education }}</span>
                        @endif
                        @if($user->partnerPreference->district)
                            <span class="pref-tag"><i class="fas fa-map-marker-alt"></i> {{ $user->partnerPreference->district }}</span>
                        @endif
                        @if($user->partnerPreference->marital_status)
                            <span class="pref-tag"><i class="fas fa-ring"></i> {{ ucwords(str_replace('_', ' ', $user->partnerPreference->marital_status)) }}</span>
                        @endif
                    </div>
                    @if($user->partnerPreference->additional_info)
                    <p class="profile-bio" style="margin-top:16px;">{{ $user->partnerPreference->additional_info }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function switchPhoto(src, thumbEl) {
    document.getElementById('mainPhoto').src = src;
    document.querySelectorAll('.profile-thumb').forEach(t => t.classList.remove('active'));
    thumbEl.classList.add('active');
}
</script>
@endpush
