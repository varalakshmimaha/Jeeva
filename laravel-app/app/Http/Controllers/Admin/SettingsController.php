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
            'contact_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'expertise_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'why_choose_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'why_choose_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'why_choose_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'why_choose_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'whatsapp_link' => 'nullable|url|max:500',
            'instagram_link' => 'nullable|url|max:500',
            'facebook_link' => 'nullable|url|max:500',
            'twitter_link' => 'nullable|url|max:500',
            'youtube_link' => 'nullable|url|max:500',
            'map_embed' => 'nullable|string',
            'booking_time_slots' => 'nullable|string|max:1000',
            'cal_link'           => 'nullable|string|max:255',
            'zoom_link'          => 'nullable|url|max:500',
            'google_analytics_id'   => 'nullable|string|max:50',
            'ga4_property_id'       => 'nullable|string|max:30',
            'ga4_credentials_json'  => 'nullable|string',
            'admin_timezone'        => 'nullable|string|max:60',
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

        // Handle Contact page book consultation image upload
        if ($request->hasFile('contact_image')) {
            $contactImgPath = $request->file('contact_image')->store('contact', 'public');
            $this->saveSetting('contact_image', 'storage/' . $contactImgPath);
        }

        // Handle "What Makes Us Different" card images
        foreach ([1, 2, 3, 4] as $n) {
            if ($request->hasFile("why_choose_image_{$n}")) {
                $path = $request->file("why_choose_image_{$n}")->store('why-choose', 'public');
                $this->saveSetting("why_choose_image_{$n}", 'storage/' . $path);
            }
        }

        // Handle About-page Expertise yoga image upload
        if ($request->hasFile('expertise_image')) {
            $expertiseImgPath = $request->file('expertise_image')->store('expertise', 'public');
            $this->saveSetting('expertise_image', 'storage/' . $expertiseImgPath);
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
        $this->saveSetting('youtube_link', $validated['youtube_link'] ?? null);
        $this->saveSetting('map_embed', $validated['map_embed'] ?? null);
        $this->saveSetting('booking_time_slots', $validated['booking_time_slots'] ?? null);
        $this->saveSetting('cal_link', $validated['cal_link'] ?? null);
        $this->saveSetting('zoom_link', $validated['zoom_link'] ?? null);
        $this->saveSetting('google_analytics_id',  $validated['google_analytics_id']  ?? null);
        $this->saveSetting('ga4_property_id',      $validated['ga4_property_id']       ?? null);
        if (!empty($validated['ga4_credentials_json'])) {
            $this->saveSetting('ga4_credentials_json', $validated['ga4_credentials_json']);
        }
        if (!empty($validated['admin_timezone'])) {
            $this->saveSetting('admin_timezone', $validated['admin_timezone']);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully!');
    }

    public function registerCalendlyWebhook(Request $request)
    {
        $token          = trim($request->input('calendly_token', ''));
        $siteUrl        = rtrim(trim($request->input('site_url', '')), '/');
        $bookingLink    = trim($request->input('calendly_booking_link', ''));

        if (!$siteUrl) {
            $siteUrl = rtrim(SiteSetting::where('key', 'site_webhook_url')->value('value') ?? '', '/');
        }
        if (!$siteUrl) {
            $siteUrl = 'https://jivabirthandbeyond.bestprime.live';
        }

        if (!$token) {
            $token = SiteSetting::where('key', 'calendly_token')->value('value') ?? '';
        }
        if (!$token) {
            return back()->with('calendly_error', 'Please enter your Calendly Personal Access Token.');
        }

        // Save token, site URL, and booking link
        $this->saveSetting('calendly_token', $token);
        $this->saveSetting('site_webhook_url', $siteUrl);
        if ($bookingLink) {
            $this->saveSetting('calendly_booking_link', $bookingLink);
        }

        // Get current user from Calendly API
        $userResp = \Illuminate\Support\Facades\Http::withToken($token)
            ->get('https://api.calendly.com/users/me');

        if (!$userResp->successful()) {
            return back()->with('calendly_error', 'Invalid token or Calendly API error: ' . $userResp->body());
        }

        $userData    = $userResp->json();
        $userUri     = $userData['resource']['uri'] ?? '';
        $orgUri      = $userData['resource']['current_organization'] ?? '';

        $webhookUrl  = $siteUrl . '/webhooks/calendly';

        // Check if webhook already exists
        $listResp = \Illuminate\Support\Facades\Http::withToken($token)
            ->get('https://api.calendly.com/webhook_subscriptions', [
                'organization' => $orgUri,
                'scope'        => 'user',
                'user'         => $userUri,
            ]);

        if ($listResp->successful()) {
            foreach ($listResp->json()['collection'] ?? [] as $wh) {
                if (($wh['callback_url'] ?? '') === $webhookUrl) {
                    return back()->with('calendly_success', 'Webhook already registered! Bookings will appear in admin automatically.');
                }
            }
        }

        // Create webhook
        $createResp = \Illuminate\Support\Facades\Http::withToken($token)
            ->post('https://api.calendly.com/webhook_subscriptions', [
                'url'          => $webhookUrl,
                'events'       => ['invitee.created', 'invitee.canceled'],
                'organization' => $orgUri,
                'user'         => $userUri,
                'scope'        => 'user',
            ]);

        if ($createResp->successful()) {
            return back()->with('calendly_success', 'Calendly webhook registered! New bookings will now appear automatically in Admin → Messages.');
        }

        return back()->with('calendly_error', 'Failed to register webhook: ' . $createResp->body());
    }

    private function saveSetting($key, $value)
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
