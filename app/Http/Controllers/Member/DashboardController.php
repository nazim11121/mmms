<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\Shortlist;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'sent_interests' => Interest::where('sender_id', $user->id)->count(),
            'received_interests' => Interest::where('receiver_id', $user->id)->where('status', 'pending')->count(),
            'accepted_interests' => Interest::where('receiver_id', $user->id)->where('status', 'accepted')
                ->orWhere(function ($q) use ($user) {
                    $q->where('sender_id', $user->id)->where('status', 'accepted');
                })->count(),
            'shortlisted' => Shortlist::where('user_id', $user->id)->count(),
            'shortlisted_by' => Shortlist::where('shortlisted_user_id', $user->id)->count(),
            'unread_messages' => Message::where('receiver_id', $user->id)->whereNull('read_at')->count(),
        ];

        $recentInterests = Interest::where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->with('sender.profile', 'sender.primaryPhoto')
            ->latest()
            ->take(5)
            ->get();

        $shortlisted = Shortlist::where('user_id', $user->id)
            ->with('shortlistedUser.profile', 'shortlistedUser.primaryPhoto')
            ->latest()
            ->take(5)
            ->get();

        return view('member.dashboard', compact('stats', 'recentInterests', 'shortlisted'));
    }
}
