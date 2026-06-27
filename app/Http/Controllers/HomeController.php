<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Slider;
use App\Models\SubscriptionPlan;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('sort_order')->get();
        $featuredProfiles = User::where('role', 'member')
            ->where('status', 'active')
            ->whereHas('profile', fn ($q) => $q->where('is_featured', true))
            ->with('profile', 'primaryPhoto')
            ->take(8)
            ->get();
        $plans = SubscriptionPlan::where('is_active', true)->orderBy('sort_order')->get();
        $stats = [
            'total_members' => User::where('role', 'member')->where('status', 'active')->count(),
            'total_marriages' => (int) SiteSetting::get('success_marriages', 0),
        ];
        return view('home', compact('sliders', 'featuredProfiles', 'plans', 'stats'));
    }
}
