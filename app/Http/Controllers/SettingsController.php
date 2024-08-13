<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('admin');
    }

    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.settings', compact('settings'));
    }

    /**
     * Update the settings.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Check which action is being performed
        $action = $request->input('action');

        // Handle logo removal
        if ($action === 'remove_logo') {
            $settings = Setting::first();
            if ($settings && $settings->logo) {
                // Delete the logo from storage
                $logoPath = public_path($settings->logo);
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
                // Remove the logo path from the settings
                $settings->logo = null;
                $settings->save();
                Session::flash('success', 'Logo removed.');
            }
            return redirect()->back();
        }

        // Handle settings update
        $validatedData = $request->validate([
            'site_name' => 'required|string',
            'contact_number' => 'required|string',
            'contact_email' => 'required|email',
            'address' => 'required|string',
            'site_info' => 'required|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'vkontakte' => 'nullable|url',
            'youtube' => 'nullable|url',
            'skype' => 'nullable|string',
            'footer_text1' => 'required|string',
            'footer_text2' => 'required|string',
            'footer_text3' => 'required|string'
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->move(public_path('uploads'), $logo->getClientOriginalName());
            $validatedData['logo'] = 'uploads/' . $logo->getClientOriginalName();
        }

        // Update or create the settings
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }
        $settings->fill($validatedData);
        $settings->save();

        Session::flash('success', 'Settings updated.');
        return redirect()->back();
    }
}
