@extends('layouts.member')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
<style>
.dash-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 28px; }
.dash-stat {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 14px; padding: 20px; display: flex; align-items: center; gap: 14px;
    transition: transform .2s, box-shadow .2s;
}
.dash-stat:hover { transform: translateY(-3px); box-shadow: var(--sh-md); }
.dash-stat-icon {
    width: 48px; height: 48px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;
}
.dash-stat-icon.red { background: rgba(181,52,26,.1); color: var(--brand); }
.dash-stat-icon.green { background: rgba(34,197,94,.1); color: #16a34a; }
.dash-stat-icon.gold { background: rgba(200,139,58,.1); color: var(--gold); }
.dash-stat-icon.blue { background: rgba(59,130,246,.1); color: #3b82f6; }
.dash-stat-num { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--text1); line-height: 1; }
.dash-stat-label { font-size: .78rem; color: var(--text3); font-weight: 500; text-transform: uppercase; letter-spacing: .04em; margin-top: 2px; }

.complete-prompt {
    background: linear-gradient(135deg, rgba(181,52,26,.06), rgba(200,139,58,.06));
    border: 1.5px solid rgba(181,52,26,.2); border-radius: 14px; padding: 20px 24px;
    display: flex; align-items: center; gap: 18px; margin-bottom: 24px;
}
.complete-prompt-icon { width: 44px; height: 44px; background: var(--brand); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem; flex-shrink: 0; }
.complete-progress { flex: 1; }
.complete-progress-bar-wrap { height: 6px; background: var(--border); border-radius: 3px; margin-top: 6px; overflow: hidden; }
.complete-progress-bar { height: 100%; background: linear-gradient(90deg, var(--brand), var(--gold)); border-radius: 3px; transition: width .5s ease; }

.section-label { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text4); margin-bottom: 14px; }
.recent-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }

.interest-item {
    background: var(--surface); border: 1px solid var(--border); border-radius: 12px;
    padding: 14px; display: flex; align-items: center; gap: 12px;
    transition: border-color .2s;
}
.interest-item:hover { border-color: rgba(181,52,26,.25); }
.interest-avatar { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid var(--border); }
.interest-name { font-size: .9rem; font-weight: 600; color: var(--text1); margin-bottom: 2px; }
.interest-meta { font-size: .75rem; color: var(--text3); }
.interest-badge { font-size: .7rem; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
.interest-badge.pending { background: rgba(245,158,11,.1); color: #d97706; }
.interest-badge.accepted { background: rgba(34,197,94,.1); color: #16a34a; }
.interest-badge.rejected { background: rgba(239,68,68,.1); color: #dc2626; }

.shortlist-row {
    display: flex; align-items: center; gap: 12px; padding: 12px 0;
    border-bottom: 1px solid var(--border-2);
}
.shortlist-row:last-child { border-bottom: none; }
.shortlist-row img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); }

@media (max-width: 700px) {
    .dash-stats { grid-template-columns: repeat(2, 1fr); }
    .recent-grid { grid-template-columns: 1fr; }
}
@media (max-width: 400px) {
    .dash-stats { grid-template-columns: 1fr 1fr; }
}
</style>

<!-- Stats -->
<div class="dash-stats">
    @php
    $dashCards = [
        [$stats['sent_interests'], 'Interests Sent', 'fa-paper-plane', 'red'],
        [$stats['received_interests'], 'New Interests', 'fa-heart', 'red'],
        [$stats['accepted_interests'], 'Connections', 'fa-handshake', 'green'],
        [$stats['shortlisted'], 'Shortlisted', 'fa-bookmark', 'gold'],
        [$stats['shortlisted_by'], 'Shortlisted By', 'fa-user-check', 'blue'],
        [$stats['unread_messages'], 'Unread Msgs', 'fa-envelope', $stats['unread_messages'] > 0 ? 'red' : 'blue'],
    ];
    @endphp
    @foreach($dashCards as [$val, $label, $icon, $color])
    <div class="dash-stat">
        <div class="dash-stat-icon {{ $color }}"><i class="fas {{ $icon }}"></i></div>
        <div>
            <div class="dash-stat-num" data-counter data-target="{{ $val }}">{{ $val }}</div>
            <div class="dash-stat-label">{{ $label }}</div>
        </div>
    </div>
    @endforeach
</div>

<!-- Profile completeness -->
@php $completeness = auth()->user()->profile_complete ?? 0; @endphp
@if($completeness < 80)
<div class="complete-prompt">
    <div class="complete-prompt-icon"><i class="fas fa-user-edit"></i></div>
    <div class="complete-progress" style="flex:1">
        <div style="font-size:.9rem; font-weight:600; color:var(--text1); margin-bottom:4px;">
            Your profile is {{ $completeness }}% complete
        </div>
        <div style="font-size:.8rem; color:var(--text3); margin-bottom:8px;">Complete your profile to get {{ 100 - $completeness }}% more visibility</div>
        <div class="complete-progress-bar-wrap">
            <div class="complete-progress-bar" style="width:{{ $completeness }}%"></div>
        </div>
    </div>
    <a href="{{ route('member.profile.edit') }}" style="flex-shrink:0; padding:9px 18px; background:var(--brand); color:#fff; border-radius:9px; font-size:.82rem; font-weight:700; text-decoration:none; white-space:nowrap; display:flex; align-items:center; gap:6px;">
        <i class="fas fa-arrow-right"></i> Complete Now
    </a>
</div>
@endif

<div class="recent-grid">
    <!-- Recent interests received -->
    <div>
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
            <div class="section-label">Recent Interests Received</div>
            <a href="{{ route('member.interests.received') }}" style="font-size:.78rem; color:var(--brand); text-decoration:none; font-weight:600;">View all</a>
        </div>
        @forelse($recentInterests as $interest)
        <div class="interest-item" style="margin-bottom:8px;">
            <img src="{{ $interest->sender->photo_url }}" alt="{{ $interest->sender->name }}" class="interest-avatar">
            <div style="flex:1; min-width:0;">
                <div class="interest-name">{{ $interest->sender->name }}</div>
                <div class="interest-meta">{{ $interest->created_at->diffForHumans() }}</div>
            </div>
            <span class="interest-badge {{ $interest->status }}">{{ ucfirst($interest->status) }}</span>
        </div>
        @empty
        <div style="text-align:center; padding:28px; color:var(--text4); font-size:.85rem;">
            <i class="fas fa-heart" style="font-size:1.5rem; margin-bottom:8px; display:block;"></i>
            No interests received yet
        </div>
        @endforelse
    </div>

    <!-- Shortlisted profiles -->
    <div>
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
            <div class="section-label">My Shortlist</div>
            <a href="{{ route('member.shortlist') }}" style="font-size:.78rem; color:var(--brand); text-decoration:none; font-weight:600;">View all</a>
        </div>
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:14px 16px;">
            @forelse($shortlisted as $item)
            <div class="shortlist-row">
                <img src="{{ $item->shortlistedUserUser->photo_url }}" alt="{{ $item->shortlistedUser->name }}">
                <div style="flex:1; min-width:0;">
                    <div style="font-size:.875rem; font-weight:600; color:var(--text1); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $item->shortlistedUser->name }}</div>
                    <div style="font-size:.75rem; color:var(--text3);">
                        {{ $item->shortlistedUser->profile?->age ? $item->shortlistedUser->profile->age . ' yrs' : '' }}
                        {{ $item->shortlistedUser->profile?->district ? '· ' . $item->shortlistedUser->profile->district : '' }}
                    </div>
                </div>
                <a href="{{ route('profile.show', $item->shortlistedUser) }}" style="font-size:.75rem; color:var(--brand); text-decoration:none; font-weight:600; white-space:nowrap;">View</a>
            </div>
            @empty
            <div style="text-align:center; padding:24px; color:var(--text4); font-size:.85rem;">
                <i class="fas fa-bookmark" style="font-size:1.5rem; margin-bottom:8px; display:block;"></i>
                No profiles shortlisted
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
