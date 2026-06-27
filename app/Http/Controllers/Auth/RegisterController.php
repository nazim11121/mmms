<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\PartnerPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date|before:-18 years',
            'profile_created_by' => 'required|in:self,parent,sibling,friend',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'member',
            'status' => 'active',
        ]);

        Profile::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'profile_created_by' => $request->profile_created_by,
        ]);

        PartnerPreference::create(['user_id' => $user->id]);

        Auth::login($user);

        return redirect()->route('member.profile.edit')
            ->with('success', 'Registration successful! Please complete your profile.');
    }
}
