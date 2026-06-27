@extends('layouts.member')
@section('title', 'Messages')
@section('page-title', 'Messages')
@section('content')
<style>
.conversations-list { display: flex; flex-direction: column; gap: 0; }
.conv-item {
    display: flex; align-items: center; gap: 14px; padding: 14px 20px;
    border-bottom: 1px solid var(--border-2); text-decoration: none; color: inherit;
    transition: background .15s; background: var(--surface);
}
.conv-item:first-child { border-radius: 14px 14px 0 0; }
.conv-item:last-child { border-bottom: none; border-radius: 0 0 14px 14px; }
.conv-item:hover { background: var(--bg); }
.conv-item.unread { background: rgba(181,52,26,.03); }
.conv-avatar-wrap { position: relative; flex-shrink: 0; }
.conv-avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); }
.conv-online { position: absolute; bottom: 1px; right: 1px; width: 11px; height: 11px; border-radius: 50%; background: #22c55e; border: 2px solid var(--surface); }
.conv-body { flex: 1; min-width: 0; }
.conv-name { font-size: .9rem; font-weight: 600; color: var(--text1); margin-bottom: 2px; display: flex; align-items: center; gap: 6px; }
.conv-name .unread-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--brand); flex-shrink: 0; }
.conv-preview { font-size: .8rem; color: var(--text3); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.conv-preview.unread { color: var(--text2); font-weight: 500; }
.conv-right { flex-shrink: 0; text-align: right; }
.conv-time { font-size: .72rem; color: var(--text4); margin-bottom: 4px; }
.conv-badge { background: var(--brand); color: #fff; border-radius: 10px; padding: 2px 7px; font-size: .7rem; font-weight: 700; }
</style>

<div style="background:var(--surface); border:1px solid var(--border); border-radius:14px; overflow:hidden;">
    @forelse($conversations as $conv)
    @php $other = $conv->getOtherUser(auth()->id()); $lastMsg = $conv->latestMessage; $hasUnread = $lastMsg && !$lastMsg->is_read && $lastMsg->sender_id !== auth()->id(); @endphp
    <a href="{{ route('member.messages.show', $other) }}" class="conv-item {{ $hasUnread ? 'unread' : '' }}">
        <div class="conv-avatar-wrap">
            <img src="{{ $other->photo_url }}" alt="{{ $other->name }}" class="conv-avatar">
            @if($other->is_online)<div class="conv-online"></div>@endif
        </div>
        <div class="conv-body">
            <div class="conv-name">
                {{ $other->name }}
                @if($hasUnread)<span class="unread-dot"></span>@endif
            </div>
            <div class="conv-preview {{ $hasUnread ? 'unread' : '' }}">
                @if($lastMsg)
                    {{ $lastMsg->sender_id === auth()->id() ? 'You: ' : '' }}{{ Str::limit($lastMsg->body, 55) }}
                @else
                    <em style="color:var(--text4);">Start a conversation...</em>
                @endif
            </div>
        </div>
        <div class="conv-right">
            <div class="conv-time">{{ $conv->updated_at->diffForHumans(null, true) }}</div>
            @if($hasUnread)<span class="conv-badge">New</span>@endif
        </div>
    </a>
    @empty
    <div style="text-align:center; padding:64px 20px;">
        <i class="fas fa-comments" style="font-size:3rem; color:var(--text4); margin-bottom:16px; display:block;"></i>
        <div style="font-family:'Playfair Display',serif; font-size:1.2rem; color:var(--text2); margin-bottom:8px;">No conversations yet</div>
        <p style="color:var(--text3); font-size:.9rem;">Connect with matches to start messaging.</p>
        <a href="{{ route('search') }}" style="display:inline-flex; align-items:center; gap:7px; margin-top:16px; padding:10px 22px; background:var(--brand); color:#fff; border-radius:9px; text-decoration:none; font-size:.875rem; font-weight:700;">
            <i class="fas fa-search"></i> Browse Profiles
        </a>
    </div>
    @endforelse
</div>
@endsection
