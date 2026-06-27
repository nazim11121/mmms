<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Shortlist;
use App\Models\User;

class ShortlistController extends Controller
{
    public function index()
    {
        $shortlists = Shortlist::where('user_id', auth()->id())
            ->with('shortlistedUser.profile', 'shortlistedUser.primaryPhoto')
            ->latest()
            ->paginate(12);
        return view('member.shortlist', compact('shortlists'));
    }

    public function toggle(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot shortlist yourself.');
        }

        $existing = Shortlist::where('user_id', auth()->id())
            ->where('shortlisted_user_id', $user->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Removed from shortlist.');
        }

        Shortlist::create(['user_id' => auth()->id(), 'shortlisted_user_id' => $user->id]);
        return back()->with('success', 'Added to shortlist!');
    }
}
