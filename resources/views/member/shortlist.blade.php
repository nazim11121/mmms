@extends('layouts.member')
@section('title', 'My Shortlist')
@section('page-title', 'My Shortlist')
@section('content')
<style>
.shortlist-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 18px; }
.shortlist-card { background: var(--surface); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; transition: transform .25s, box-shadow .25s; }
.shortlist-card:hover { transform: translateY(-5px); box-shadow: var(--sh-xl); }
.shortlist-card-photo { position: relative; aspect-ratio: 3/4; }
.shortlist-card-photo img { width: 100%; height: 100%; object-fit: cover; }
.shortlist-card-photo-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.65) 0%, transparent 55%); }
.shortlist-card-body { padding: 12px 14px 14px; }
.shortlist-card-name { font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 600; color: var(--text1); margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.shortlist-card-meta { font-size: .75rem; color: var(--text3); display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 10px; }
.shortlist-card-meta span { display: flex; align-items: center; gap: 3px; }
.shortlist-card-actions { display: flex; gap: 6px; }
.sc-btn { flex:1; padding:7px 4px; border-radius:7px; font-size:.75rem; font-weight:700; text-align:center; cursor:pointer; border:none; font-family:inherit; text-decoration:none; display:flex; align-items:center; justify-content:center; gap:4px; transition:all .2s; }
.sc-btn.view { background:var(--brand); color:#fff; }
.sc-btn.view:hover { background:var(--brand-dark); }
.sc-btn.remove { background:var(--bg); color:var(--text3); border:1px solid var(--border); width:32px; flex:0 0 32px; }
.sc-btn.remove:hover { color:#dc2626; border-color:#dc2626; background:rgba(220,53,69,.05); }
</style>

@if($shortlists->count() > 0)
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
    <div style="font-size:.875rem; color:var(--text3);">{{ $shortlists->total() }} profile{{ $shortlists->total() != 1 ? 's' : '' }} shortlisted</div>
</div>
<div class="shortlist-grid">
    @foreach($shortlists as $item)
    @php $member = $item->shortlistedUser; @endphp
    <div class="shortlist-card">
        <div class="shortlist-card-photo">
            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
            <div class="shortlist-card-photo-overlay"></div>
        </div>
        <div class="shortlist-card-body">
            <div class="shortlist-card-name">{{ $member->name }}</div>
            <div class="shortlist-card-meta">
                @if($member->profile?->age)
                    <span><i class="fas fa-birthday-cake"></i> {{ $member->profile->age }} yrs</span>
                @endif
                @if($member->profile?->district)
                    <span><i class="fas fa-map-marker-alt"></i> {{ $member->profile->district }}</span>
                @endif
            </div>
            <div class="shortlist-card-actions">
                <a href="{{ route('profile.show', $member) }}" class="sc-btn view"><i class="fas fa-eye"></i> View</a>
                <form method="POST" action="{{ route('member.shortlist.toggle', $member) }}" style="margin:0;" onsubmit="return confirm('Remove from shortlist?')">
                    @csrf
                    <button type="submit" class="sc-btn remove" title="Remove"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div style="margin-top:28px;">{{ $shortlists->links() }}</div>
@else
<div style="text-align:center; padding:64px 20px;">
    <i class="fas fa-bookmark" style="font-size:3rem; color:var(--text4); margin-bottom:16px; display:block;"></i>
    <div style="font-family:'Playfair Display',serif; font-size:1.2rem; color:var(--text2); margin-bottom:8px;">Your shortlist is empty</div>
    <p style="color:var(--text3); font-size:.9rem;">Bookmark profiles you like to revisit them easily.</p>
    <a href="{{ route('search') }}" style="display:inline-flex; align-items:center; gap:7px; margin-top:16px; padding:10px 22px; background:var(--brand); color:#fff; border-radius:9px; text-decoration:none; font-size:.875rem; font-weight:700;">
        <i class="fas fa-search"></i> Browse Profiles
    </a>
</div>
@endif
@endsection
