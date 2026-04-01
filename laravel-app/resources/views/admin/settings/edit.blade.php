@extends('layouts.admin')

@section('admin-content')
<div style="max-width: 900px; margin: 0 auto;">
    <div style="margin-bottom: 40px;">
        <h1 style="color: var(--navy); margin: 0; font-family: 'Playfair Display', serif; font-size: 32px;">Practice Settings</h1>
        <p style="color: var(--muted); margin: 5px 0 0 0; font-size: 14px;">Update your clinic's identity, contact details, and brand assets.</p>
    </div>

    @if(session('success'))
        <div style="background: #f0fdf4; color: #16a34a; padding: 16px 24px; border-radius: 12px; margin-bottom: 30px; border: 1px solid #dcfce7; display: flex; align-items: center; gap: 12px; font-weight: 500;">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #fef2f2; color: #ef4444; padding: 16px 24px; border-radius: 12px; margin-bottom: 30px; border: 1px solid #fee2e2; font-weight: 500;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Logo Section --}}
        <div style="background: white; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.05); padding: 40px; margin-bottom: 24px;">
            <h2 style="color: var(--navy); margin: 0 0 8px 0; font-size: 20px; font-weight: 700;">Brand Logo</h2>
            <p style="color: var(--muted); margin: 0 0 28px 0; font-size: 14px;">Upload your clinic logo (JPEG, PNG, max 2MB).</p>

            @if(isset($settings['logo_path']) && $settings['logo_path'])
                <div style="margin-bottom: 20px; padding: 16px; background: #fafcfe; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); display: inline-block;">
                    <p style="color: var(--muted); font-size: 12px; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Current Logo</p>
                    <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Logo" style="max-width: 160px; height: auto; display: block;">
                </div>
            @endif

            <div>
                <label for="logo" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 14px;">Upload New Logo</label>
                <input type="file" id="logo" name="logo" accept="image/*"
                    style="display: block; width: 100%; padding: 14px; border: 2px dashed var(--teal); border-radius: 12px; font-family: 'Outfit', sans-serif; font-size: 14px; background: rgba(125,211,252,0.04); box-sizing: border-box; cursor: pointer;">
            </div>
        </div>

        {{-- Clinic Information --}}
        <div style="background: white; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.05); padding: 40px; margin-bottom: 24px;">
            <h2 style="color: var(--navy); margin: 0 0 8px 0; font-size: 20px; font-weight: 700;">Clinic Information</h2>
            <p style="color: var(--muted); margin: 0 0 28px 0; font-size: 14px;">This information appears across the public site — footer, contact page, and more.</p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label for="company_name" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Clinic Name</label>
                    <input type="text" id="company_name" name="company_name"
                        value="{{ old('company_name', $settings['company_name'] ?? '') }}"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
                <div>
                    <label for="company_email" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Email Address</label>
                    <input type="email" id="company_email" name="company_email"
                        value="{{ old('company_email', $settings['company_email'] ?? '') }}"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
                <div>
                    <label for="company_phone" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Phone Number</label>
                    <input type="text" id="company_phone" name="company_phone"
                        value="{{ old('company_phone', $settings['company_phone'] ?? '') }}"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
                <div>
                    <label for="company_hours" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Business Hours</label>
                    <input type="text" id="company_hours" name="company_hours"
                        value="{{ old('company_hours', $settings['company_hours'] ?? '') }}"
                        placeholder="e.g., Mon-Sat: 10AM - 8PM"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
            </div>
            <div style="margin-top: 20px;">
                <label for="company_address" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Full Address</label>
                <textarea id="company_address" name="company_address" rows="2"
                    style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; resize: vertical; transition: border-color 0.2s;"
                    onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>
            </div>
        </div>

        {{-- Social Media Links --}}
        <div style="background: white; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.05); padding: 40px; margin-bottom: 24px;">
            <h2 style="color: var(--navy); margin: 0 0 8px 0; font-size: 20px; font-weight: 700;">Social Media Links</h2>
            <p style="color: var(--muted); margin: 0 0 28px 0; font-size: 14px;">These links will appear as icons in the website footer. Leave blank to hide the icon.</p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label for="whatsapp_link" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">WhatsApp Link</label>
                    <input type="url" id="whatsapp_link" name="whatsapp_link"
                        value="{{ old('whatsapp_link', $settings['whatsapp_link'] ?? '') }}"
                        placeholder="https://wa.me/yournumber"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
                <div>
                    <label for="instagram_link" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Instagram Link</label>
                    <input type="url" id="instagram_link" name="instagram_link"
                        value="{{ old('instagram_link', $settings['instagram_link'] ?? '') }}"
                        placeholder="https://instagram.com/yourprofile"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
                <div>
                    <label for="facebook_link" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Facebook Link</label>
                    <input type="url" id="facebook_link" name="facebook_link"
                        value="{{ old('facebook_link', $settings['facebook_link'] ?? '') }}"
                        placeholder="https://facebook.com/yourpage"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
                <div>
                    <label for="twitter_link" style="display: block; color: var(--navy); font-weight: 700; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Twitter/X Link</label>
                    <input type="url" id="twitter_link" name="twitter_link"
                        value="{{ old('twitter_link', $settings['twitter_link'] ?? '') }}"
                        placeholder="https://twitter.com/yourprofile"
                        style="width: 100%; padding: 14px 16px; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Outfit'; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='rgba(0,0,0,0.1)'">
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display: flex; gap: 12px; align-items: center;">
            <button type="submit"
                style="background: var(--teal); color: white; padding: 16px 36px; border: none; border-radius: 14px; cursor: pointer; font-weight: 700; font-size: 15px; font-family: 'Outfit'; box-shadow: 0 10px 25px rgba(125,211,252,0.4); transition: transform 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                Save Changes
            </button>
            <a href="{{ route('admin.dashboard') }}"
                style="padding: 16px 28px; border-radius: 14px; text-decoration: none; font-weight: 600; font-size: 15px; color: var(--muted); background: rgba(0,0,0,0.04);">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
