<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Setting;
use App\Models\Page;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $pages    = Page::orderBy('name')->get();
        return view('admin.settings.settings', compact('settings', 'pages'));
    }

    public function update(Request $request)
    {
        $action = $request->input('action');

        // Handle logo removal
        if ($action === 'remove_logo') {
            $settings = Setting::first();
            if ($settings && $settings->logo) {
                $logoPath = public_path($settings->logo);
                if (file_exists($logoPath)) unlink($logoPath);
                $settings->logo = null;
                $settings->save();
                Session::flash('success', 'Logo removed.');
            }
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'site_name'      => 'required|string',
            'contact_number' => 'required|string',
            'contact_email'  => 'required|email',
            'address'        => 'required|string',
            'site_info'      => 'required|string',
            'facebook'       => 'nullable|url',
            'instagram'      => 'nullable|url',
            'twitter'        => 'nullable|url',
            'tiktok'         => 'nullable|url',
            'linkedin'       => 'nullable|url',
            'vkontakte'      => 'nullable|url',
            'youtube'        => 'nullable|url',
            'skype'          => 'nullable|string',
            'footer_text1'   => 'required|string',
            'footer_text2'   => 'required|string',
            'footer_text3'   => 'required|string',
            'homepage_type'  => 'required|in:posts,page',
            'homepage_id'    => 'nullable|exists:pages,id',
            'mail_host'      => 'nullable|string',
            'mail_port'      => 'nullable|string',
            'mail_username'  => 'nullable|string',
            'mail_password'  => 'nullable|string',
            'mail_encryption'=> 'nullable|in:tls,ssl,',
            'mail_from_address' => 'nullable|email',
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            if (!is_dir(base_path('Uploads'))) { mkdir(base_path('Uploads'), 0775, true); }
            $logo->move(base_path('Uploads'), $logo->getClientOriginalName());
            $validatedData['logo'] = 'Uploads/' . $logo->getClientOriginalName();
        }

        $settings = Setting::first() ?? new Setting();
        $settings->fill($validatedData);
        $settings->save();

        // Write mail settings to .env so Laravel uses them
        if ($request->filled('mail_username')) {
            $envPath = base_path('.env');
            $envContent = file_get_contents($envPath);
            $updates = [
                'MAIL_HOST'         => $request->mail_host ?? 'smtp.gmail.com',
                'MAIL_PORT'         => $request->mail_port ?? '587',
                'MAIL_USERNAME'     => $request->mail_username,
                'MAIL_PASSWORD'     => $request->mail_password,
                'MAIL_ENCRYPTION'   => $request->mail_encryption ?? 'tls',
                'MAIL_FROM_ADDRESS' => $request->mail_from_address ?? $request->mail_username,
            ];
            foreach ($updates as $key => $value) {
                $envContent = preg_replace('/^' . $key . '=.*/m', $key . '=' . $value, $envContent);
            }
            file_put_contents($envPath, $envContent);
        }

        Session::flash('success', 'Settings updated.');
        return redirect()->back();
    }
}
