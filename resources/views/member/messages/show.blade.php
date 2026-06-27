@extends('layouts.member')
@section('title', 'Chat with ' . $user->name)
@section('page-title', 'Messages')
@section('content')
<style>
.chat-wrap { display: flex; flex-direction: column; height: calc(100vh - 200px); min-height: 500px; background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
.chat-header {
    padding: 14px 20px; border-bottom: 1px solid var(--border-2);
    display: flex; align-items: center; gap: 14px; background: var(--surface);
    flex-shrink: 0;
}
.chat-header-avatar { position: relative; }
.chat-header-avatar img { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); }
.chat-online { position: absolute; bottom: 0; right: 0; width: 11px; height: 11px; border-radius: 50%; background: #22c55e; border: 2px solid var(--surface); }
.chat-header-info { flex: 1; }
.chat-header-name a { font-weight: 700; font-size: .95rem; color: var(--text1); text-decoration: none; }
.chat-header-name a:hover { color: var(--brand); }
.chat-header-status { font-size: .75rem; color: var(--text4); display: flex; align-items: center; gap: 4px; }
.chat-back { padding: 7px 14px; background: var(--bg); border: 1px solid var(--border); border-radius: 8px; color: var(--text2); text-decoration: none; font-size: .82rem; font-weight: 600; display: flex; align-items: center; gap: 6px; transition: all .2s; }
.chat-back:hover { border-color: var(--text2); color: var(--text1); }

.chat-messages { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 12px; scroll-behavior: smooth; }
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-track { background: transparent; }
.chat-messages::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }

.msg-row { display: flex; gap: 8px; max-width: 72%; }
.msg-row.sent { margin-left: auto; flex-direction: row-reverse; }
.msg-avatar { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; flex-shrink: 0; align-self: flex-end; }
.msg-bubble {
    padding: 10px 14px; border-radius: 16px; font-size: .875rem; line-height: 1.5; word-break: break-word;
    max-width: 100%;
}
.msg-row.received .msg-bubble { background: var(--bg); color: var(--text1); border-radius: 4px 16px 16px 16px; }
.msg-row.sent .msg-bubble { background: var(--brand); color: #fff; border-radius: 16px 4px 16px 16px; }
.msg-time { font-size: .68rem; color: var(--text4); margin-top: 4px; display: block; text-align: right; }
.msg-row.received .msg-time { text-align: left; color: var(--text4); }
.msg-row.sent .msg-time { color: rgba(255,255,255,.6); }

.chat-footer { padding: 14px 16px; border-top: 1px solid var(--border-2); background: var(--surface); flex-shrink: 0; }
.chat-input-row { display: flex; gap: 10px; align-items: flex-end; }
.chat-textarea {
    flex: 1; padding: 10px 14px; border: 1.5px solid var(--border); border-radius: 12px;
    font-size: .875rem; font-family: inherit; resize: none; outline: none;
    min-height: 44px; max-height: 120px; background: var(--bg); color: var(--text1);
    transition: border-color .2s; line-height: 1.5; overflow-y: auto;
}
.chat-textarea:focus { border-color: var(--brand); }
.chat-send {
    width: 44px; height: 44px; background: var(--brand); color: #fff;
    border: none; border-radius: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: all .2s; font-size: .95rem;
}
.chat-send:hover { background: var(--brand-dark); transform: scale(1.04); }
.chat-send:disabled { opacity: .5; cursor: not-allowed; }

.chat-date-divider { text-align: center; margin: 6px 0; }
.chat-date-divider span { background: var(--border); color: var(--text4); padding: 2px 12px; border-radius: 10px; font-size: .72rem; }
</style>

<div class="chat-wrap">
    <!-- Header -->
    <div class="chat-header">
        <div class="chat-header-avatar">
            <img src="{{ $user->photo_url }}" alt="{{ $user->name }}">
            @if($user->is_online)<div class="chat-online"></div>@endif
        </div>
        <div class="chat-header-info">
            <div class="chat-header-name"><a href="{{ route('profile.show', $user) }}">{{ $user->name }}</a></div>
            <div class="chat-header-status">
                @if($user->is_online)
                    <span style="width:6px;height:6px;background:#22c55e;border-radius:50%;display:inline-block;"></span> Online
                @else
                    Last seen {{ $user->last_seen ? \Carbon\Carbon::parse($user->last_seen)->diffForHumans() : 'recently' }}
                @endif
            </div>
        </div>
        <a href="{{ route('member.messages.index') }}" class="chat-back"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Messages -->
    <div class="chat-messages" id="messagesBox">
        @forelse($messages as $msg)
        @php $isSent = $msg->sender_id === auth()->id(); @endphp
        <div class="msg-row {{ $isSent ? 'sent' : 'received' }}">
            @if(!$isSent)
            <img src="{{ $user->photo_url }}" alt="" class="msg-avatar">
            @endif
            <div>
                <div class="msg-bubble">{{ $msg->body }}</div>
                <span class="msg-time">{{ $msg->created_at->format('h:i A') }}</span>
            </div>
        </div>
        @empty
        <div style="text-align:center; padding:40px 20px; margin: auto;">
            <i class="fas fa-comment-dots" style="font-size:2.5rem; color:var(--text4); margin-bottom:12px; display:block;"></i>
            <div style="font-size:.9rem; color:var(--text3);">Send your first message to {{ $user->name }}</div>
        </div>
        @endforelse
    </div>

    <!-- Input -->
    <div class="chat-footer">
        <form method="POST" action="{{ route('member.messages.send', $user) }}" id="msgForm">
            @csrf
            <div class="chat-input-row">
                <textarea name="body" id="msgBody" class="chat-textarea" placeholder="Write a message..." rows="1" required></textarea>
                <button type="submit" class="chat-send" id="sendBtn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const box = document.getElementById('messagesBox');
box.scrollTop = box.scrollHeight;

const ta = document.getElementById('msgBody');
ta.addEventListener('input', () => {
    ta.style.height = 'auto';
    ta.style.height = Math.min(ta.scrollHeight, 120) + 'px';
});
ta.addEventListener('keydown', e => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); document.getElementById('msgForm').submit(); }
});
</script>
@endpush
@endsection
