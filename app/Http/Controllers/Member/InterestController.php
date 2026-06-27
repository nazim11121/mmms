<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function sent()
    {
        $interests = Interest::where('sender_id', auth()->id())
            ->with('receiver.profile', 'receiver.primaryPhoto')
            ->latest()
            ->paginate(12);
        return view('member.interests.sent', compact('interests'));
    }

    public function received()
    {
        $interests = Interest::where('receiver_id', auth()->id())
            ->with('sender.profile', 'sender.primaryPhoto')
            ->latest()
            ->paginate(12);
        return view('member.interests.received', compact('interests'));
    }

    public function send(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot send interest to yourself.');
        }

        $exists = Interest::where('sender_id', auth()->id())
            ->where('receiver_id', $user->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already sent an interest to this member.');
        }

        Interest::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Interest sent successfully!');
    }

    public function respond(Request $request, Interest $interest)
    {
        if ($interest->receiver_id !== auth()->id()) abort(403);

        $request->validate(['action' => 'required|in:accepted,rejected']);
        $interest->update(['status' => $request->action]);

        $msg = $request->action === 'accepted' ? 'Interest accepted!' : 'Interest declined.';
        return back()->with('success', $msg);
    }

    public function destroy(Interest $interest)
    {
        if ($interest->sender_id !== auth()->id()) abort(403);
        $interest->delete();
        return back()->with('success', 'Interest withdrawn.');
    }
}
