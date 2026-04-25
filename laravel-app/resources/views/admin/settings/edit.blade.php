@extends('layouts.admin')

@section('admin-content')
<div>

    <div class="adm-page-header">
        <h1 class="adm-page-title">Site Settings</h1>
        <button type="submit" form="settingsForm" class="adm-btn adm-btn-primary">Save Changes</button>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form id="settingsForm" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tabs --}}
        <div class="st-tabs">
            <button type="button" class="st-tab is-active" data-tab="general">General</button>
            <button type="button" class="st-tab" data-tab="logo">Logo & Favicon</button>
            <button type="button" class="st-tab" data-tab="backgrounds">Background Images</button>
            <button type="button" class="st-tab" data-tab="social">Footer & Social</button>
            <button type="button" class="st-tab" data-tab="analytics">Analytics</button>
        </div>

        {{-- Panel: General --}}
        <div class="st-panel is-active" data-panel="general">
            <div class="adm-card">
                <div class="adm-card-head">General Settings</div>
                <div class="adm-card-body">
                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Site Name</td>
                            <td class="adm-fi">
                                <input type="text" name="company_name" class="adm-input"
                                    value="{{ old('company_name', $settings['company_name'] ?? '') }}"
                                    placeholder="Jiva Birth and Beyond">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">Site Tagline</td>
                            <td class="adm-fi">
                                <input type="text" name="company_hours" class="adm-input"
                                    value="{{ old('company_hours', $settings['company_hours'] ?? '') }}"
                                    placeholder="Birth Doula & Wellness">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">Site Email</td>
                            <td class="adm-fi">
                                <input type="email" name="company_email" class="adm-input"
                                    value="{{ old('company_email', $settings['company_email'] ?? '') }}"
                                    placeholder="contact@jivabirthandbeyond.com">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">Site Phone</td>
                            <td class="adm-fi">
                                <input type="text" name="company_phone" class="adm-input"
                                    value="{{ old('company_phone', $settings['company_phone'] ?? '') }}"
                                    placeholder="+91 XXXXX XXXXX">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">Site Address</td>
                            <td class="adm-fi">
                                <input type="text" name="company_address" class="adm-input"
                                    value="{{ old('company_address', $settings['company_address'] ?? '') }}"
                                    placeholder="Tippasandra, Bangalore 560075">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Google Map Embed Code</div>
                <div class="adm-card-body">
                    <textarea name="map_embed" class="adm-input" rows="3"
                        placeholder="Paste Google Maps embed iframe code here...">{{ old('map_embed', $settings['map_embed'] ?? '') }}</textarea>
                    <p class="adm-hint">Paste the full iframe embed code from Google Maps</p>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Cal.com Booking Link</div>
                <div class="adm-card-body">
                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Cal.com Link</td>
                            <td class="adm-fi">
                                <input type="text" name="cal_link" class="adm-input"
                                    value="{{ old('cal_link', $settings['cal_link'] ?? '') }}"
                                    placeholder="e.g. anusuyaashok/consultation">
                                <p class="adm-hint" style="margin-top:6px;">
                                    Enter your Cal.com username/event-type (e.g. <strong>anusuyaashok/30min</strong>).
                                    Sign up free at <strong>cal.com</strong> → create an event type → copy the link slug.
                                    Leave blank to use the built-in date picker instead.
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Zoom Meeting Link</div>
                <div class="adm-card-body">
                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Zoom Link</td>
                            <td class="adm-fi">
                                <input type="url" name="zoom_link" class="adm-input"
                                    value="{{ old('zoom_link', $settings['zoom_link'] ?? '') }}"
                                    placeholder="https://zoom.us/j/XXXXXXXXXX">
                                <p class="adm-hint">Paste your Zoom personal meeting link. It will be included in the booking confirmation emails sent to both you and the client.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Consultation Booking Time Slots <small style="font-weight:400;color:var(--muted);font-size:12px;">(used when Cal.com link is empty)</small></div>
                <div class="adm-card-body">
                    <textarea name="booking_time_slots" class="adm-input" rows="3"
                        placeholder="09:00 AM, 10:00 AM, 11:00 AM, 12:00 PM, 02:00 PM, 03:00 PM, 04:00 PM, 05:00 PM, 06:00 PM">{{ old('booking_time_slots', $settings['booking_time_slots'] ?? '') }}</textarea>
                    <p class="adm-hint">Comma-separated time slots for the built-in picker. Only used when no Cal.com link is set above.</p>
                </div>
            </div>
        </div>

        {{-- Panel: Logo --}}
        <div class="st-panel" data-panel="logo">
            <div class="adm-card">
                <div class="adm-card-head">Logo Upload</div>
                <div class="adm-card-body">
                    @if(isset($settings['logo_path']) && $settings['logo_path'])
                        <div class="adm-img-preview">
                            <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Current Logo">
                            <span class="adm-img-tag">Current Logo</span>
                        </div>
                    @endif

                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Upload Logo</td>
                            <td class="adm-fi">
                                <input type="file" name="logo" accept="image/*" class="adm-input">
                                <p class="adm-hint">JPEG, PNG or WebP. Recommended: <strong>400×400 px</strong> (square, transparent PNG preferred). Max 2MB.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Favicon Upload</div>
                <div class="adm-card-body">
                    @if(isset($settings['favicon_path']) && $settings['favicon_path'])
                        <div class="adm-img-preview">
                            <img src="{{ asset($settings['favicon_path']) }}" alt="Current Favicon" style="max-width:48px;">
                            <span class="adm-img-tag">Current Favicon</span>
                        </div>
                    @endif

                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Upload Favicon</td>
                            <td class="adm-fi">
                                <input type="file" name="favicon" accept="image/png,image/x-icon,image/jpeg" class="adm-input">
                                <p class="adm-hint">PNG or ICO format. Recommended: 32x32px or 64x64px. Max 1MB.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Footer Certifications / Accreditation Logos</div>
                <div class="adm-card-body">
                    @if(isset($settings['certifications_image_path']) && $settings['certifications_image_path'])
                        <div class="adm-img-preview">
                            <img src="{{ asset('storage/' . $settings['certifications_image_path']) }}" alt="Certifications" style="max-width:220px; background:#fff; padding:8px; border-radius:8px;">
                            <span class="adm-img-tag">Current Certifications Image</span>
                        </div>
                    @endif
                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Upload Image</td>
                            <td class="adm-fi">
                                <input type="file" name="certifications_image" accept="image/*" class="adm-input">
                                <p class="adm-hint">Upload logos/badges shown in the footer Contact Us column. PNG with transparent background recommended. Max 2MB.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Panel: Background Images --}}
        <div class="st-panel" data-panel="backgrounds">
            <div class="adm-card">
                <div class="adm-card-head">CTA Section Background Image</div>
                <div class="adm-card-body">
                    @if(isset($settings['cta_bg_image_path']) && $settings['cta_bg_image_path'])
                        <div class="adm-img-preview">
                            <img src="{{ asset('storage/' . $settings['cta_bg_image_path']) }}" alt="CTA Background" style="max-width:400px; max-height:250px;">
                            <span class="adm-img-tag">Current CTA Background</span>
                        </div>
                    @endif

                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Upload Image</td>
                            <td class="adm-fi">
                                <input type="file" name="cta_bg_image" accept="image/*" class="adm-input">
                                <p class="adm-hint">Background image for all Call-to-Action (CTA) sections. Recommended: 1600x900px or larger. Max 5MB.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Vision & Mission Section Background Image</div>
                <div class="adm-card-body">
                    @if(isset($settings['vision_mission_bg_image_path']) && $settings['vision_mission_bg_image_path'])
                        <div class="adm-img-preview">
                            <img src="{{ asset('storage/' . $settings['vision_mission_bg_image_path']) }}" alt="Vision & Mission Background" style="max-width:400px; max-height:250px;">
                            <span class="adm-img-tag">Current Vision & Mission Background</span>
                        </div>
                    @endif

                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Upload Image</td>
                            <td class="adm-fi">
                                <input type="file" name="vision_mission_bg_image" accept="image/*" class="adm-input">
                                <p class="adm-hint">Background image for Vision & Mission section on About page. Recommended: 1600x900px or larger. Max 5MB.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Contact Page - Book Consultation Image</div>
                <div class="adm-card-body">
                    @if(isset($settings['contact_image']) && $settings['contact_image'])
                        <div class="adm-img-preview">
                            <img src="{{ asset($settings['contact_image']) }}" alt="Book Consultation" style="max-width:400px; max-height:400px; object-fit: cover;">
                            <span class="adm-img-tag">Current Book Consultation Image</span>
                        </div>
                    @endif

                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Upload Image</td>
                            <td class="adm-fi">
                                <input type="file" name="contact_image" accept="image/*" class="adm-input">
                                <p class="adm-hint">Image displayed on the right side of the Book Consultation form on Contact page. Recommended: 450x450px (square). Max 3MB.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">About Page - Expertise Yoga Image</div>
                <div class="adm-card-body">
                    @if(isset($settings['expertise_image']) && $settings['expertise_image'])
                        <div class="adm-img-preview">
                            <img src="{{ asset($settings['expertise_image']) }}" alt="Expertise Yoga" style="max-width:400px; max-height:500px; object-fit: cover;">
                            <span class="adm-img-tag">Current Expertise Image</span>
                        </div>
                    @endif

                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Upload Image</td>
                            <td class="adm-fi">
                                <input type="file" name="expertise_image" accept="image/*" class="adm-input">
                                <p class="adm-hint">Image shown next to the "Expertise &amp; Qualifications" list on the About page. Recommended: <strong>800×1000 px</strong> (4:5 portrait). Max 3MB.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Panel: Footer & Social --}}
        <div class="st-panel" data-panel="social">
            <div class="adm-card">
                <div class="adm-card-head">Social Media Links</div>
                <div class="adm-card-body">
                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">
                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#25D366;margin-right:6px;vertical-align:middle;"></span> WhatsApp
                            </td>
                            <td class="adm-fi">
                                <input type="url" name="whatsapp_link" class="adm-input"
                                    value="{{ old('whatsapp_link', $settings['whatsapp_link'] ?? '') }}"
                                    placeholder="https://wa.me/91XXXXXXXXXX">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">
                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#E4405F;margin-right:6px;vertical-align:middle;"></span> Instagram
                            </td>
                            <td class="adm-fi">
                                <input type="url" name="instagram_link" class="adm-input"
                                    value="{{ old('instagram_link', $settings['instagram_link'] ?? '') }}"
                                    placeholder="https://instagram.com/yourprofile">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">
                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#1877F2;margin-right:6px;vertical-align:middle;"></span> Facebook
                            </td>
                            <td class="adm-fi">
                                <input type="url" name="facebook_link" class="adm-input"
                                    value="{{ old('facebook_link', $settings['facebook_link'] ?? '') }}"
                                    placeholder="https://facebook.com/yourpage">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">
                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#000;margin-right:6px;vertical-align:middle;"></span> Twitter / X
                            </td>
                            <td class="adm-fi">
                                <input type="url" name="twitter_link" class="adm-input"
                                    value="{{ old('twitter_link', $settings['twitter_link'] ?? '') }}"
                                    placeholder="https://x.com/yourprofile">
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">
                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#FF0000;margin-right:6px;vertical-align:middle;"></span> YouTube
                            </td>
                            <td class="adm-fi">
                                <input type="url" name="youtube_link" class="adm-input"
                                    value="{{ old('youtube_link', $settings['youtube_link'] ?? '') }}"
                                    placeholder="https://youtube.com/@yourchannel">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Panel: Analytics --}}
        <div class="st-panel" data-panel="analytics">
            <div class="adm-card">
                <div class="adm-card-head">Google Analytics 4 — Site Tracking</div>
                <div class="adm-card-body">
                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">Measurement ID</td>
                            <td class="adm-fi">
                                <input type="text" name="google_analytics_id" class="adm-input"
                                    value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}"
                                    placeholder="G-XXXXXXXXXX">
                                <p class="adm-hint">Tracks page views on the website. Find it in GA4 → Admin → Data Streams → your stream.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">Google Analytics 4 — Admin Dashboard Data</div>
                <div class="adm-card-body">
                    <p class="adm-hint" style="margin:0 0 16px;padding:12px 14px;background:#fff8ec;border:1px solid #f0c060;border-radius:8px;color:#5a3e00;font-size:13px;">
                        These two fields power the <strong>Analytics</strong> page in this admin panel where you can see visitors, sessions, top pages, traffic sources and countries — without leaving the admin.
                    </p>
                    <table class="adm-form-table">
                        <tr>
                            <td class="adm-fl">GA4 Property ID</td>
                            <td class="adm-fi">
                                <input type="text" name="ga4_property_id" class="adm-input"
                                    value="{{ old('ga4_property_id', $settings['ga4_property_id'] ?? '') }}"
                                    placeholder="123456789">
                                <p class="adm-hint">Numbers only. Find it in GA4 → Admin → Property Settings → Property ID.</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="adm-fl">Service Account JSON</td>
                            <td class="adm-fi">
                                <textarea name="ga4_credentials_json" rows="6" class="adm-input" style="font-family:monospace;font-size:12px;"
                                    placeholder='{"type":"service_account","project_id":"...","private_key":"-----BEGIN PRIVATE KEY-----\n...","client_email":"...@...iam.gserviceaccount.com",...}'>{{ old('ga4_credentials_json', $settings['ga4_credentials_json'] ?? '') }}</textarea>
                                <p class="adm-hint">Paste the entire contents of the JSON key file downloaded from Google Cloud Console → Service Accounts. <a href="{{ route('admin.analytics') }}" target="_blank">How to get this →</a></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </form>
</div>

<style>
/* Tabs */
.st-tabs {
    display: flex;
    gap: 0;
    border-bottom: 2px solid var(--border);
    margin-bottom: 24px;
}
.st-tab {
    padding: 12px 24px;
    border: none;
    background: none;
    font-family: var(--font);
    font-size: 14px;
    font-weight: 600;
    color: var(--muted);
    cursor: pointer;
    position: relative;
    transition: color 0.2s;
}
.st-tab:hover { color: var(--navy); }
.st-tab.is-active { color: var(--teal); }
.st-tab.is-active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0; right: 0;
    height: 2px;
    background: var(--teal);
    border-radius: 2px 2px 0 0;
}

/* Panels */
.st-panel { display: none; }
.st-panel.is-active { display: block; }

@media (max-width: 700px) {
    .st-tabs { overflow-x: auto; }
    .st-tab { padding: 10px 16px; font-size: 13px; white-space: nowrap; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.st-tab');
    const panels = document.querySelectorAll('.st-panel');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('is-active'));
            panels.forEach(p => p.classList.remove('is-active'));
            tab.classList.add('is-active');
            document.querySelector(`[data-panel="${tab.dataset.tab}"]`).classList.add('is-active');
        });
    });
});
</script>
@endsection
