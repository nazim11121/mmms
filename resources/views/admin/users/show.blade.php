@extends('layouts.admin')
@section('title', $user->name)
@section('page-title', 'Member Details')
@section('content')
<style>
.user-detail-layout { display: grid; grid-template-columns: 280px 1fr; gap: 20px; align-items: start; }
.user-profile-card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
.user-profile-photo { position: relative; aspect-ratio: 1; }
.user-profile-photo img { width: 100%; height: 100%; object-fit: cover; }
.user-profile-photo-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.6) 0%, transparent 55%); }
.user-profile-name { position: absolute; bottom: 0; left: 0; right: 0; padding: 14px; color: #fff; }
.user-profile-name h3 { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; margin-bottom: 2px; }
.user-profile-name small { font-size: .75rem; opacity: .8; }
.user-profile-body { padding: 16px; }
.user-profile-stat { display: flex; align-items: center; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border-2); font-size: .83rem; }
.user-profile-stat:last-child { border-bottom: none; }
.user-profile-stat label { color: var(--text4); font-weight: 600; }
.user-profile-stat span { color: var(--text1); font-weight: 500; }
.status-pill { padding: 3px 10px; border-radius: 20px; font-size: .72rem; font-weight: 700; }
.status-pill.active { background: rgba(34,197,94,.1); color: #16a34a; }
.status-pill.inactive { background: rgba(120,120,120,.1); color: #666; }
.status-pill.suspended { background: rgba(239,68,68,.1); color: #dc2626; }
.admin-action-btn { display: block; width: 100%; padding: 9px; border-radius: 9px; font-size: .83rem; font-weight: 700; font-family: inherit; cursor: pointer; border: none; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all .2s; margin-bottom: 7px; }
.admin-action-btn.danger { background: rgba(239,68,68,.1); color: #dc2626; border: 1px solid rgba(239,68,68,.25); }
.admin-action-btn.danger:hover { background: #dc2626; color: #fff; }
.admin-action-btn.success { background: rgba(34,197,94,.1); color: #16a34a; border: 1px solid rgba(34,197,94,.25); }
.admin-action-btn.success:hover { background: #16a34a; color: #fff; }
.info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
.info-item { padding: 12px 14px; background: var(--bg); border-radius: 10px; }
.info-item-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text4); margin-bottom: 3px; }
.info-item-value { font-size: .875rem; color: var(--text1); font-weight: 500; }
.info-item-value.empty { color: var(--text4); font-style: italic; font-weight: 400; }
@media (max-width: 900px) { .user-detail-layout { grid-template-columns: 1fr; } }
</style>

<div style="margin-bottom:20px;">
    <a href="{{ route('admin.users.index') }}" style="font-size:.83rem; color:var(--text3); text-decoration:none; display:inline-flex; align-items:center; gap:5px;">
        <i class="fas fa-arrow-left"></i> Back to Members
    </a>
</div>

<div class="user-detail-layout">
    <!-- Profile card -->
    <div>
        <div class="user-profile-card">
            <div class="user-profile-photo">
                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}">
                <div class="user-profile-photo-overlay"></div>
                <div class="user-profile-name">
                    <h3>{{ $user->name }}</h3>
                    <small>{{ $user->email }}</small>
                </div>
            </div>
            <div class="user-profile-body">
                <div class="user-profile-stat">
                    <label>Status</label>
                    <span class="status-pill {{ $user->status }}">{{ ucfirst($user->status) }}</span>
                </div>
                <div class="user-profile-stat">
                    <label>Role</label>
                    <span>{{ ucfirst($user->role) }}</span>
                </div>
                <div class="user-profile-stat">
                    <label>Profile</label>
                    <span>{{ $user->profile_complete ?? 0 }}% complete</span>
                </div>
                <div class="user-profile-stat">
                    <label>Joined</label>
                    <span>{{ $user->created_at->format('d M Y') }}</span>
                </div>
                <div class="user-profile-stat">
                    <label>Last Seen</label>
                    <span>{{ $user->last_seen ? \Carbon\Carbon::parse($user->last_seen)->diffForHumans() : 'N/A' }}</span>
                </div>
            </div>
        </div>
        <div style="padding:0 0 0 0; margin-top: 14px;">
            @if($user->status !== 'suspended')
            <form method="POST" action="{{ route('admin.users.status', $user) }}" onsubmit="return confirm('Suspend this user?')">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="suspended">
                <button type="submit" class="admin-action-btn danger"><i class="fas fa-ban"></i> Suspend Member</button>
            </form>
            @else
            <form method="POST" action="{{ route('admin.users.status', $user) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="active">
                <button type="submit" class="admin-action-btn success"><i class="fas fa-check"></i> Activate Member</button>
            </form>
            @endif
        </div>
    </div>

    <!-- Details -->
    <div>
        <div class="panel" style="margin-bottom:20px;">
            <div class="panel-title" style="margin-bottom:16px;"><i class="fas fa-user"></i> Personal Information</div>
            <div class="info-grid">
                @foreach([
                    'Phone' => $user->phone,
                    'Age' => $user->profile?->age ? $user->profile->age . ' years' : null,
                    'Gender' => $user->profile?->gender ? ucfirst($user->profile->gender) : null,
                    'District' => $user->profile?->district,
                    'Religion' => $user->profile?->religion ? ucfirst($user->profile->religion) : null,
                    'Marital Status' => $user->profile?->marital_status ? ucwords(str_replace('_', ' ', $user->profile->marital_status)) : null,
                    'Education' => $user->profile?->education,
                    'Profession' => $user->profile?->profession,
                ] as $lbl => $val)
                <div class="info-item">
                    <div class="info-item-label">{{ $lbl }}</div>
                    <div class="info-item-value {{ $val ? '' : 'empty' }}">{{ $val ?? 'Not provided' }}</div>
                </div>
                @endforeach
            </div>
        </div>

        @if($user->activeSubscription)
        <div class="panel" style="margin-bottom:20px;">
            <div class="panel-title" style="margin-bottom:16px;"><i class="fas fa-crown"></i> Active Subscription</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-item-label">Plan</div>
                    <div class="info-item-value">{{ $user->activeSubscription->plan?->name }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Expires</div>
                    <div class="info-item-value">{{ $user->activeSubscription->expires_at ? \Carbon\Carbon::parse($user->activeSubscription->expires_at)->format('d M Y') : 'N/A' }}</div>
                </div>
            </div>
        </div>
        @endif

        @if($user->photos?->count() > 0)
        <div class="panel">
            <div class="panel-title" style="margin-bottom:16px;"><i class="fas fa-images"></i> Photos</div>
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)); gap:10px;">
                @foreach($user->photos->take(12) as $photo)
                <div style="aspect-ratio:1; border-radius:8px; overflow:hidden; border:2px solid {{ $photo->is_primary ? 'var(--brand)' : 'var(--border)' }}">
                    <img src="{{ Storage::url($photo->photo_path) }}" style="width:100%;height:100%;object-fit:cover;" alt="">
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
