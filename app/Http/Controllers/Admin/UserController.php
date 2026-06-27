<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'member')->with('profile');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->gender) {
            $query->whereHas('profile', fn ($q) => $q->where('gender', $request->gender));
        }

        $users = $query->latest()->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('profile', 'photos', 'partnerPreference', 'activeSubscription.plan');
        return view('admin.users.show', compact('user'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:active,inactive,suspended']);
        $user->update(['status' => $request->status]);
        return back()->with('success', "User status updated to {$request->status}.");
    }

    public function verifyProfile(User $user)
    {
        if ($user->profile) {
            $user->profile->update(['is_verified' => !$user->profile->is_verified]);
        }
        return back()->with('success', 'Profile verification status updated.');
    }

    public function featureProfile(User $user)
    {
        if ($user->profile) {
            $user->profile->update(['is_featured' => !$user->profile->is_featured]);
        }
        return back()->with('success', 'Profile featured status updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Member deleted.');
    }
}
