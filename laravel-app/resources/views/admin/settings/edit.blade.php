@extends('layouts.admin')

@section('admin-content')
<div>
    <h1 style="color: #0a1628; margin-bottom: 30px; margin-top: 0; font-family: 'Playfair Display';">Settings</h1>
    
    @if(session('success'))
        <div style="background: #c8e6c9; color: #2e7d32; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #2e7d32;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #ffebee; color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #c62828;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 700px;">
        @csrf
        @method('PUT')
        
        <!-- Logo Section -->
        <div style="margin-bottom: 30px; padding-bottom: 30px; border-bottom: 2px solid #f0f0f0;">
            <h2 style="color: #0a1628; margin-top: 0; margin-bottom: 20px; font-size: 18px;">Logo</h2>
            
            @if(isset($settings['logo_path']) && $settings['logo_path'])
                <div style="margin-bottom: 15px;">
                    <p style="color: #666; font-size: 13px; margin-bottom: 10px;">Current Logo:</p>
                    <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Current Logo" style="max-width: 150px; height: auto; border-radius: 5px;">
                </div>
            @endif
            
            <div style="margin-bottom: 20px;">
                <label for="logo" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Upload Logo</label>
                <input type="file" id="logo" name="logo" accept="image/*" style="padding: 10px; border: 2px dashed #18b4d4; border-radius: 5px; width: 100%; box-sizing: border-box;">
                <p style="color: #999; font-size: 12px; margin-top: 5px;">Max 2MB. Formats: JPEG, PNG, JPG, GIF</p>
            </div>
        </div>
        
        <!-- Company Information Section -->
        <div style="margin-bottom: 30px;">
            <h2 style="color: #0a1628; margin-top: 0; margin-bottom: 20px; font-size: 18px;">Company Information</h2>
            
            <div style="margin-bottom: 20px;">
                <label for="company_name" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Company Name</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="company_email" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Email Address</label>
                <input type="email" id="company_email" name="company_email" value="{{ old('company_email', $settings['company_email'] ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="company_phone" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Phone Number</label>
                <input type="text" id="company_phone" name="company_phone" value="{{ old('company_phone', $settings['company_phone'] ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="company_address" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Address</label>
                <textarea id="company_address" name="company_address" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box; resize: vertical;">{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>
            </div>
            
            <div style="margin-bottom: 30px;">
                <label for="company_hours" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Business Hours</label>
                <textarea id="company_hours" name="company_hours" rows="3" placeholder="e.g., Mon-Fri: 9:00 AM - 6:00 PM&#10;Sat: 10:00 AM - 4:00 PM&#10;Sun: Closed" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box; resize: vertical;">{{ old('company_hours', $settings['company_hours'] ?? '') }}</textarea>
            </div>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #18b4d4; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 14px;">Save Settings</button>
            <a href="{{ route('admin.dashboard') }}" style="background: #ccc; color: #333; padding: 12px 30px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 14px;">Cancel</a>
        </div>
    </form>
</div>
@endsection
