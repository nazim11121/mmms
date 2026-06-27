<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\PartnerPreference;
use App\Models\SubscriptionPlan;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@mmms.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Sample Members
        $members = [
            ['name' => 'Arif Rahman', 'email' => 'arif@example.com', 'gender' => 'male', 'religion' => 'Islam', 'occupation' => 'Software Engineer', 'district' => 'Dhaka', 'dob' => '1992-05-15', 'featured' => true],
            ['name' => 'Fatema Begum', 'email' => 'fatema@example.com', 'gender' => 'female', 'religion' => 'Islam', 'occupation' => 'Doctor', 'district' => 'Chittagong', 'dob' => '1995-08-20', 'featured' => true],
            ['name' => 'Rahim Uddin', 'email' => 'rahim@example.com', 'gender' => 'male', 'religion' => 'Islam', 'occupation' => 'Teacher', 'district' => 'Rajshahi', 'dob' => '1990-03-10', 'featured' => true],
            ['name' => 'Sumaiya Khatun', 'email' => 'sumaiya@example.com', 'gender' => 'female', 'religion' => 'Islam', 'occupation' => 'Banker', 'district' => 'Sylhet', 'dob' => '1994-11-25', 'featured' => true],
            ['name' => 'Karim Hassan', 'email' => 'karim@example.com', 'gender' => 'male', 'religion' => 'Islam', 'occupation' => 'Businessman', 'district' => 'Khulna', 'dob' => '1988-07-08', 'featured' => false],
            ['name' => 'Nusrat Jahan', 'email' => 'nusrat@example.com', 'gender' => 'female', 'religion' => 'Islam', 'occupation' => 'Engineer', 'district' => 'Dhaka', 'dob' => '1996-02-14', 'featured' => false],
            ['name' => 'Rajan Kumar', 'email' => 'rajan@example.com', 'gender' => 'male', 'religion' => 'Hindu', 'occupation' => 'Accountant', 'district' => 'Dhaka', 'dob' => '1991-09-30', 'featured' => false],
            ['name' => 'Priya Das', 'email' => 'priya@example.com', 'gender' => 'female', 'religion' => 'Hindu', 'occupation' => 'Nurse', 'district' => 'Chittagong', 'dob' => '1993-04-18', 'featured' => false],
        ];

        foreach ($members as $m) {
            $user = User::create([
                'name' => $m['name'],
                'email' => $m['email'],
                'password' => Hash::make('password'),
                'role' => 'member',
                'status' => 'active',
                'email_verified_at' => now(),
                'profile_complete' => true,
            ]);

            Profile::create([
                'user_id' => $user->id,
                'gender' => $m['gender'],
                'date_of_birth' => $m['dob'],
                'religion' => $m['religion'],
                'occupation' => $m['occupation'],
                'district' => $m['district'],
                'country' => 'Bangladesh',
                'marital_status' => 'never_married',
                'education_level' => 'Bachelor',
                'nationality' => 'Bangladeshi',
                'about_me' => 'I am a sincere and family-oriented person looking for a life partner.',
                'is_featured' => $m['featured'],
                'completeness' => 80,
            ]);

            PartnerPreference::create([
                'user_id' => $user->id,
                'age_from' => 22,
                'age_to' => 35,
                'religion' => $m['religion'],
                'about_partner' => 'Looking for a kind, educated, and family-oriented partner.',
            ]);
        }

        // Subscription Plans
        SubscriptionPlan::create([
            'name' => 'Free', 'slug' => 'free',
            'description' => 'Basic access to get started',
            'price' => 0, 'duration_days' => 365,
            'features' => ['Browse profiles', 'Send 5 interests', 'Basic search'],
            'is_active' => true, 'sort_order' => 1,
        ]);

        SubscriptionPlan::create([
            'name' => 'Silver', 'slug' => 'silver',
            'description' => 'Enhanced features for serious seekers',
            'price' => 999, 'duration_days' => 30,
            'features' => ['Send 50 interests', 'Advanced search', 'View contact info', 'Priority listing'],
            'is_active' => true, 'is_popular' => false, 'sort_order' => 2,
        ]);

        SubscriptionPlan::create([
            'name' => 'Gold', 'slug' => 'gold',
            'description' => 'Full access with premium features',
            'price' => 2499, 'duration_days' => 90,
            'features' => ['Unlimited interests', 'Advanced search', 'View contact info', 'Priority listing', 'Featured profile badge', 'Direct messaging'],
            'is_active' => true, 'is_popular' => true, 'sort_order' => 3,
        ]);

        // Site Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Marriage Media Management System', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Find Your Perfect Life Partner', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'info@mmms.com', 'group' => 'general'],
            ['key' => 'site_phone', 'value' => '+880 1700-000000', 'group' => 'general'],
            ['key' => 'registration_open', 'value' => 'yes', 'group' => 'system'],
            ['key' => 'maintenance_mode', 'value' => 'no', 'group' => 'system'],
            ['key' => 'success_marriages', 'value' => '500', 'group' => 'general'],
        ];
        foreach ($settings as $s) {
            SiteSetting::create($s);
        }

        // Slider
        Slider::create([
            'title' => 'Find Your Perfect Life Partner',
            'subtitle' => 'Join thousands of families who found their match through our trusted platform',
            'image' => 'sliders/default.jpg',
            'button_text' => 'Register Free',
            'button_link' => '/register',
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }
}
