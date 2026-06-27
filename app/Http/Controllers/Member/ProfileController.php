<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\PartnerPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);
        $preference = $user->partnerPreference ?? new PartnerPreference(['user_id' => $user->id]);
        return view('member.profile.edit', compact('user', 'profile', 'preference'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'height' => 'nullable|numeric|min:100|max:250',
            'weight' => 'nullable|numeric|min:30|max:200',
            'about_me' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        $user->update(['name' => $request->name, 'phone' => $request->phone]);

        $profileData = $request->only([
            'gender', 'date_of_birth', 'height', 'weight', 'blood_group',
            'religion', 'caste', 'mother_tongue', 'nationality', 'country',
            'division', 'district', 'address', 'marital_status', 'have_children',
            'no_of_children', 'occupation', 'organization', 'annual_income',
            'education_level', 'university', 'about_me', 'profile_created_by',
        ]);

        Profile::updateOrCreate(['user_id' => $user->id], $profileData);
        $this->updateCompleteness($user);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePreferences(Request $request)
    {
        $prefData = $request->only([
            'age_from', 'age_to', 'height_from', 'height_to', 'religion', 'caste',
            'marital_status', 'education', 'occupation', 'country', 'district',
            'annual_income_from', 'annual_income_to', 'about_partner',
        ]);

        PartnerPreference::updateOrCreate(['user_id' => auth()->id()], $prefData);

        return back()->with('success', 'Partner preferences updated!');
    }

    private function updateCompleteness(mixed $user): void
    {
        $profile = $user->profile;
        if (!$profile) return;

        $fields = ['gender', 'date_of_birth', 'height', 'religion', 'occupation', 'education_level', 'about_me', 'district'];
        $filled = collect($fields)->filter(fn ($f) => !empty($profile->$f))->count();
        $percent = (int) (($filled / count($fields)) * 100);

        $profile->update(['completeness' => $percent]);
        $user->update(['profile_complete' => $percent >= 60]);
    }
}
