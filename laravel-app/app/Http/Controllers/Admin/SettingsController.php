<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'company_email' => 'nullable|email',
            'company_phone' => 'nullable|string|max:20',
            'company_address' => 'nullable|string',
            'company_hours' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024',
            'certifications_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'cta_bg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'vision_mission_bg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'whatsapp_link' => 'nullable|url|max:500',
            'instagram_link' => 'nullable|url|max:500',
            'facebook_link' => 'nullable|url|max:500',
            'twitter_link' => 'nullable|url|max:500',
            'map_embed' => 'nullable|string',
            'booking_time_slots' => 'nullable|string|max:1000',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logo', 'public');
            $this->saveSetting('logo_path', $logoPath);
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = 'favicon.' . $file->getClientOriginalExtension();
            $file->move(public_path(), $filename);
            $this->saveSetting('favicon_path', $filename);
        }

        // Handle certifications image upload
        if ($request->hasFile('certifications_image')) {
            $certPath = $request->file('certifications_image')->store('certifications', 'public');
            $this->saveSetting('certifications_image_path', $certPath);
        }

        // Handle CTA background image upload
        if ($request->hasFile('cta_bg_image')) {
            $ctaBgPath = $request->file('cta_bg_image')->store('backgrounds/cta', 'public');
            $this->saveSetting('cta_bg_image_path', $ctaBgPath);
        }

        // Handle Vision & Mission background image upload
        if ($request->hasFile('vision_mission_bg_image')) {
            $visionBgPath = $request->file('vision_mission_bg_image')->store('backgrounds/vision', 'public');
            $this->saveSetting('vision_mission_bg_image_path', $visionBgPath);
        }

        // Save other settings
        $this->saveSetting('company_name', $validated['company_name'] ?? null);
        $this->saveSetting('company_email', $validated['company_email'] ?? null);
        $this->saveSetting('company_phone', $validated['company_phone'] ?? null);
        $this->saveSetting('company_address', $validated['company_address'] ?? null);
        $this->saveSetting('company_hours', $validated['company_hours'] ?? null);
        $this->saveSetting('whatsapp_link', $validated['whatsapp_link'] ?? null);
        $this->saveSetting('instagram_link', $validated['instagram_link'] ?? null);
        $this->saveSetting('facebook_link', $validated['facebook_link'] ?? null);
        $this->saveSetting('twitter_link', $validated['twitter_link'] ?? null);
        $this->saveSetting('map_embed', $validated['map_embed'] ?? null);
        $this->saveSetting('booking_time_slots', $validated['booking_time_slots'] ?? null);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully!');
    }

    private function saveSetting($key, $value)
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
