<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => "mCMS 4.1",
            'address' => 'Bulgaria',
            'contact_number' => '+359 000 000 000',
            'contact_email' => 'info@example.com',
            'site_info' => 'Sample mCMS 4.1 website',
            'facebook' => '',
            'instagram' => '',
            'twitter' => '',
            'tiktok' => '',
            'linkedin' => '',
            'vkontakte' => '',
            'youtube' => '',
            'skype' => '',
            'footer_text1' => 'Mon - Fri 09:00 - 18:00',
            'footer_text2' => 'online support',
            'footer_text3' => 'Plovdiv, Blvd. XXXXXX',
        ]);
    }
}
