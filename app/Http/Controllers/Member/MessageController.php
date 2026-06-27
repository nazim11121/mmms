<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $conversations = Conversation::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->with(['user1.primaryPhoto', 'user2.primaryPhoto'])
            ->orderByDesc('last_message_at')
            ->get();

        return view('member.messages.index', compact('conversations', 'userId'));
    }

    public function show(User $user)
    {
        $conversation = Conversation::getOrCreate(
            min(auth()->id(), $user->id),
            max(auth()->id(), $user->id)
        );

        Message::where('conversation_id', $conversation->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();

        return view('member.messages.show', compact('conversation', 'messages', 'user'));
    }

    public function send(Request $request, User $user)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        $conversation = Conversation::getOrCreate(
            min(auth()->id(), $user->id),
            max(auth()->id(), $user->id)
        );

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'body' => $request->body,
        ]);

        $conversation->update([
            'last_message_id' => $message->id,
            'last_message_at' => now(),
        ]);

        return back()->with('success', 'Message sent!');
    }
}
