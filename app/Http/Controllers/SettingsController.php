<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting; // Ensure the namespace is correct

class SettingsController extends Controller
{
    public function __construct() 
    {
        // Ensure the 'admin' middleware exists and is properly defined
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
        // Validate request data
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
            'footer_text3' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048' // Validation for logo upload
        ]);

        // Get the first settings record
        $settings = Setting::first();

        // Check if a logo file was uploaded
        if ($request->hasFile('logo')) {
            // Store the uploaded logo in the 'public/logos' directory
            $logoPath = $request->file('logo')->store('logos', 'public');
            
            // Add the logo path to the validated data
            $validatedData['logo'] = $logoPath;

            // Optionally delete the old logo if it exists
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
        }

        // Update settings with validated data
        $settings->update($validatedData);

        // Flash a success message to the session
        Session::flash('success', 'Settings updated.');

        return redirect()->back();
    }
}
