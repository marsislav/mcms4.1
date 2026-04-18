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
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo->move(public_path('Uploads'), $logo->getClientOriginalName());
            $validatedData['logo'] = 'Uploads/' . $logo->getClientOriginalName();
        }

        $settings = Setting::first() ?? new Setting();
        $settings->fill($validatedData);
        $settings->save();

        Session::flash('success', 'Settings updated.');
        return redirect()->back();
    }
}
