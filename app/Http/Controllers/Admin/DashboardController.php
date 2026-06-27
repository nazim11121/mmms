<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Interest;
use App\Models\Subscription;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => User::where('role', 'member')->count(),
            'active_members' => User::where('role', 'member')->where('status', 'active')->count(),
            'new_today' => User::where('role', 'member')->whereDate('created_at', today())->count(),
            'new_this_month' => User::where('role', 'member')->whereMonth('created_at', now()->month)->count(),
            'total_interests' => Interest::count(),
            'active_subscriptions' => Subscription::where('status', 'active')->where('expires_at', '>', now())->count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'total_revenue' => Subscription::where('status', 'active')->sum('amount'),
        ];

        $recentMembers = User::where('role', 'member')
            ->with('profile')
            ->latest()
            ->take(8)
            ->get();

        $recentSubscriptions = Subscription::with('user', 'plan')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentMembers', 'recentSubscriptions'));
    }
}
