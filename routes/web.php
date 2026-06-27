<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Member\DashboardController as MemberDashboard;
use App\Http\Controllers\Member\ProfileController as MemberProfile;
use App\Http\Controllers\Member\PhotoController;
use App\Http\Controllers\Member\InterestController;
use App\Http\Controllers\Member\ShortlistController;
use App\Http\Controllers\Member\MessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\PlanController as AdminPlan;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Http\Controllers\Admin\ReportController as AdminReport;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/profile/{user}', [SearchController::class, 'show'])->name('profile.show');
Route::get('/packages', function () {
    $plans = \App\Models\SubscriptionPlan::where('is_active', true)->orderBy('sort_order')->get();
    return view('packages', compact('plans'));
})->name('packages');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Member Routes
Route::prefix('member')->name('member.')->middleware(['auth', 'member'])->group(function () {
    Route::get('/dashboard', [MemberDashboard::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile/edit', [MemberProfile::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [MemberProfile::class, 'update'])->name('profile.update');
    Route::put('/profile/preferences', [MemberProfile::class, 'updatePreferences'])->name('profile.preferences');

    // Photos
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::patch('/photos/{photo}/primary', [PhotoController::class, 'setPrimary'])->name('photos.primary');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

    // Interests
    Route::get('/interests/received', [InterestController::class, 'received'])->name('interests.received');
    Route::get('/interests/sent', [InterestController::class, 'sent'])->name('interests.sent');
    Route::post('/interests/send/{user}', [InterestController::class, 'send'])->name('interests.send');
    Route::patch('/interests/{interest}/respond', [InterestController::class, 'respond'])->name('interests.respond');
    Route::delete('/interests/{interest}', [InterestController::class, 'destroy'])->name('interests.destroy');

    // Shortlist
    Route::get('/shortlist', [ShortlistController::class, 'index'])->name('shortlist.index');
    Route::post('/shortlist/{user}', [ShortlistController::class, 'toggle'])->name('shortlist.toggle');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}/send', [MessageController::class, 'send'])->name('messages.send');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [AdminUser::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUser::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/status', [AdminUser::class, 'updateStatus'])->name('users.status');
    Route::patch('/users/{user}/verify', [AdminUser::class, 'verifyProfile'])->name('users.verify');
    Route::patch('/users/{user}/feature', [AdminUser::class, 'featureProfile'])->name('users.feature');
    Route::delete('/users/{user}', [AdminUser::class, 'destroy'])->name('users.destroy');

    // Plans
    Route::resource('/plans', AdminPlan::class);

    // Reports
    Route::get('/reports', [AdminReport::class, 'index'])->name('reports.index');
    Route::patch('/reports/{report}', [AdminReport::class, 'update'])->name('reports.update');

    // Settings
    Route::get('/settings', [AdminSetting::class, 'index'])->name('settings.index');
    Route::put('/settings', [AdminSetting::class, 'update'])->name('settings.update');
});
