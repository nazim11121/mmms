<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interest;
use App\Models\Shortlist;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'member')
            ->where('status', 'active')
            ->with('profile', 'primaryPhoto');

        if ($request->gender) {
            $query->whereHas('profile', fn ($q) => $q->where('gender', $request->gender));
        }
        if ($request->age_from) {
            $query->whereHas('profile', fn ($q) => $q->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= ?', [$request->age_from]));
        }
        if ($request->age_to) {
            $query->whereHas('profile', fn ($q) => $q->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) <= ?', [$request->age_to]));
        }
        if ($request->religion) {
            $query->whereHas('profile', fn ($q) => $q->where('religion', $request->religion));
        }
        if ($request->district) {
            $query->whereHas('profile', fn ($q) => $q->where('district', 'like', "%{$request->district}%"));
        }
        if ($request->education) {
            $query->whereHas('profile', fn ($q) => $q->where('education_level', $request->education));
        }
        if ($request->marital_status) {
            $query->whereHas('profile', fn ($q) => $q->where('marital_status', $request->marital_status));
        }

        // Exclude own profile
        if (auth()->check()) {
            $query->where('id', '!=', auth()->id());
        }

        $members = $query->paginate(12)->withQueryString();

        // For authenticated users, fetch their interests and shortlists
        $sentInterestIds = [];
        $shortlistIds = [];
        if (auth()->check()) {
            $sentInterestIds = Interest::where('sender_id', auth()->id())->pluck('receiver_id')->toArray();
            $shortlistIds = Shortlist::where('user_id', auth()->id())->pluck('shortlisted_user_id')->toArray();
        }

        return view('search', compact('members', 'sentInterestIds', 'shortlistIds'));
    }

    public function show(User $user)
    {
        if ($user->role !== 'member' || $user->status !== 'active') abort(404);

        $user->load('profile', 'photos', 'partnerPreference');

        $interestSent = false;
        $isShortlisted = false;
        if (auth()->check() && auth()->id() !== $user->id) {
            $interestSent = Interest::where('sender_id', auth()->id())->where('receiver_id', $user->id)->exists();
            $isShortlisted = Shortlist::where('user_id', auth()->id())->where('shortlisted_user_id', $user->id)->exists();
        }

        return view('profile-detail', compact('user', 'interestSent', 'isShortlisted'));
    }
}
