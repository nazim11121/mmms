@extends('layouts.member')
@section('title', 'Interests Received')
@section('page-title', 'Interests')
@section('content')
<style>
.interest-tabs { display: flex; gap: 4px; background: var(--bg); border: 1px solid var(--border); border-radius: 10px; padding: 4px; margin-bottom: 24px; width: fit-content; }
.interest-tab-link { padding: 8px 20px; border-radius: 7px; font-size: .85rem; font-weight: 600; color: var(--text3); text-decoration: none; transition: all .2s; display: flex; align-items: center; gap: 6px; }
.interest-tab-link.active { background: var(--surface); color: var(--brand); box-shadow: var(--sh-sm); }
.interest-tab-link:hover:not(.active) { color: var(--text1); }

.interests-list { display: flex; flex-direction: column; gap: 12px; }
.interest-card {
    background: var(--surface); border: 1px solid var(--border); border-radius: 14px;
    padding: 16px 20px; display: flex; align-items: center; gap: 16px;
    transition: border-color .2s, box-shadow .2s;
}
.interest-card:hover { border-color: rgba(181,52,26,.2); box-shadow: var(--sh-sm); }
.interest-card-avatar { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid var(--border); }
.interest-card-body { flex: 1; min-width: 0; }
.interest-card-name { font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 600; color: var(--text1); margin-bottom: 3px; }
.interest-card-meta { font-size: .8rem; color: var(--text3); display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-bottom: 4px; }
.interest-card-meta span { display: flex; align-items: center; gap: 4px; }
.interest-card-time { font-size: .75rem; color: var(--text4); }
.interest-status { padding: 4px 12px; border-radius: 20px; font-size: .75rem; font-weight: 700; flex-shrink: 0; }
.interest-status.pending { background: rgba(245,158,11,.1); color: #d97706; }
.interest-status.accepted { background: rgba(34,197,94,.1); color: #16a34a; }
.interest-status.rejected { background: rgba(239,68,68,.1); color: #dc2626; }
.interest-actions { display: flex; gap: 8px; flex-shrink: 0; }
.int-btn {
    padding: 7px 14px; border-radius: 8px; font-size: .8rem; font-weight: 700;
    cursor: pointer; border: none; font-family: inherit; display: flex; align-items: center; gap: 5px;
    transition: all .2s; text-decoration: none;
}
.int-btn.accept { background: rgba(34,197,94,.1); color: #16a34a; border: 1px solid rgba(34,197,94,.3); }
.int-btn.accept:hover { background: #16a34a; color: #fff; }
.int-btn.reject { background: rgba(239,68,68,.1); color: #dc2626; border: 1px solid rgba(239,68,68,.3); }
.int-btn.reject:hover { background: #dc2626; color: #fff; }
.int-btn.view { background: var(--bg); color: var(--text2); border: 1px solid var(--border); }
.int-btn.view:hover { border-color: var(--brand); color: var(--brand); }

@media (max-width: 600px) {
    .interest-card { flex-wrap: wrap; gap: 12px; }
    .interest-actions { width: 100%; }
}
</style>

<div class="interest-tabs">
    <a href="{{ route('member.interests.received') }}" class="interest-tab-link active"><i class="fas fa-inbox"></i> Received</a>
    <a href="{{ route('member.interests.sent') }}" class="interest-tab-link"><i class="fas fa-paper-plane"></i> Sent</a>
</div>

@if($interests->count() > 0)
<div class="interests-list">
    @foreach($interests as $interest)
    <div class="interest-card">
        <img src="{{ $interest->sender->photo_url }}" alt="{{ $interest->sender->name }}" class="interest-card-avatar">
        <div class="interest-card-body">
            <div class="interest-card-name">{{ $interest->sender->name }}</div>
            <div class="interest-card-meta">
                @if($interest->sender->profile?->age)
                    <span><i class="fas fa-birthday-cake"></i> {{ $interest->sender->profile->age }} yrs</span>
                @endif
                @if($interest->sender->profile?->district)
                    <span><i class="fas fa-map-marker-alt"></i> {{ $interest->sender->profile->district }}</span>
                @endif
                @if($interest->sender->profile?->profession)
                    <span><i class="fas fa-briefcase"></i> {{ $interest->sender->profile->profession }}</span>
                @endif
            </div>
            <div class="interest-card-time"><i class="fas fa-clock" style="margin-right:4px;"></i>{{ $interest->created_at->diffForHumans() }}</div>
        </div>
        <div class="interest-actions">
            <a href="{{ route('profile.show', $interest->sender) }}" class="int-btn view"><i class="fas fa-eye"></i></a>
            @if($interest->status === 'pending')
                <form method="POST" action="{{ route('member.interests.respond', $interest) }}" style="margin:0;">
                    @csrf @method('PATCH')
                    <input type="hidden" name="action" value="accept">
                    <button type="submit" class="int-btn accept"><i class="fas fa-check"></i> Accept</button>
                </form>
                <form method="POST" action="{{ route('member.interests.respond', $interest) }}" style="margin:0;">
                    @csrf @method('PATCH')
                    <input type="hidden" name="action" value="reject">
                    <button type="submit" class="int-btn reject" onclick="return confirm('Decline this interest?')"><i class="fas fa-times"></i></button>
                </form>
            @else
                <span class="interest-status {{ $interest->status }}">{{ ucfirst($interest->status) }}</span>
            @endif
        </div>
    </div>
    @endforeach
</div>
<div style="margin-top:24px;">
    {{ $interests->links() }}
</div>
@else
<div style="text-align:center; padding:64px 20px;">
    <i class="fas fa-inbox" style="font-size:3rem; color:var(--text4); margin-bottom:16px; display:block;"></i>
    <div style="font-family:'Playfair Display',serif; font-size:1.2rem; color:var(--text2); margin-bottom:8px;">No interests yet</div>
    <p style="color:var(--text3); font-size:.9rem;">When someone sends you an interest, it will appear here.</p>
    <a href="{{ route('search') }}" style="display:inline-flex; align-items:center; gap:7px; margin-top:16px; padding:10px 22px; background:var(--brand); color:#fff; border-radius:9px; text-decoration:none; font-size:.875rem; font-weight:700;">
        <i class="fas fa-search"></i> Browse Profiles
    </a>
</div>
@endif
@endsection
