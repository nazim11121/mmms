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
        $activeTheme      = SiteSetting::get('active_theme', 'elegant-rose');
        $activeHeroLayout = SiteSetting::get('active_hero_layout', '');
        $heroSettings = [
            'badge'    => SiteSetting::get('hero_badge',    "Bangladesh's Trusted Matrimonial Platform"),
            'title'    => SiteSetting::get('hero_title',    'Find Your <em>Perfect</em><br>Life Partner'),
            'subtitle' => SiteSetting::get('hero_subtitle', 'Join thousands of families who found their match through MMMS — a safe, verified, and family-oriented matrimonial platform built for Bangladeshi values.'),
            'cta'      => SiteSetting::get('hero_cta',      'Register Free'),
        ];
        return view('admin.settings.templates', compact('activeTheme', 'activeHeroLayout', 'heroSettings'));
    }

    public function updateTemplate(Request $request)
    {
        $request->validate([
            'theme' => ['required', 'in:elegant-rose,ocean-breeze,midnight-gold,emerald-garden,royal-violet,sunset-coral,arctic-minimal,rose-blush,glassmorphism,corporate-flat,saffron-spice,neon-noir,soft-pastel,bold-editorial'],
        ]);
        SiteSetting::set('active_theme', $request->theme);
        return back()->with('success', 'Theme activated successfully!');
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_layout'   => ['nullable', 'in:,dark-immersive,split-light,glass-center,neon-cyber,editorial-bold,soft-organic'],
            'hero_badge'    => ['nullable', 'string', 'max:120'],
            'hero_title'    => ['nullable', 'string', 'max:300'],
            'hero_subtitle' => ['nullable', 'string', 'max:500'],
            'hero_cta'      => ['nullable', 'string', 'max:60'],
        ]);

        SiteSetting::set('active_hero_layout', $request->hero_layout ?? '');
        SiteSetting::set('hero_badge',    $request->hero_badge    ?? '');
        SiteSetting::set('hero_title',    $request->hero_title    ?? '');
        SiteSetting::set('hero_subtitle', $request->hero_subtitle ?? '');
        SiteSetting::set('hero_cta',      $request->hero_cta      ?? '');

        return back()->with('success', 'Hero settings saved successfully!');
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
