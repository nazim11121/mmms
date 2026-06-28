<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function templates()
    {
        $activeTheme = SiteSetting::get('active_theme', 'elegant-rose');
        return view('admin.settings.templates', compact('activeTheme'));
    }

    public function updateTemplate(Request $request)
    {
        $request->validate([
            'theme' => ['required', 'in:elegant-rose,ocean-breeze,midnight-gold,emerald-garden,royal-violet,sunset-coral,arctic-minimal,rose-blush,glassmorphism,corporate-flat,saffron-spice,neon-noir,soft-pastel,bold-editorial'],
        ]);
        SiteSetting::set('active_theme', $request->theme);
        return back()->with('success', 'Theme activated successfully!');
    }

    public function update(Request $request)
    {
        $settingsToSave = [
            'site_name', 'site_tagline', 'site_email', 'site_phone',
            'site_address', 'facebook_url', 'twitter_url', 'instagram_url',
            'footer_text', 'registration_open', 'maintenance_mode',
        ];

        foreach ($settingsToSave as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            SiteSetting::set('site_logo', $path);
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
