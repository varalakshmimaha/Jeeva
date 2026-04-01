@extends('layouts.admin')

@section('admin-content')
<div>
    <h1 style="color: #0a1628; margin-bottom: 40px; margin-top: 0; font-family: 'Playfair Display';">Dashboard</h1>
    
    <!-- Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 50px;">
        <!-- Services Card -->
        <div style="background: linear-gradient(135deg, #18b4d4, #0a8fa6); color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 10px 0; font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Services</h3>
            <p style="margin: 0; font-size: 36px; font-weight: bold;">{{ $services ?? 0 }}</p>
            <a href="{{ route('admin.services.index') }}" style="display: inline-block; margin-top: 15px; color: white; text-decoration: none; font-weight: 500; border-bottom: 2px solid white; padding-bottom: 2px;">Manage →</a>
        </div>
        
        <!-- Banners Card -->
        <div style="background: linear-gradient(135deg, #f0a030, #d67e1c); color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 10px 0; font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Banners</h3>
            <p style="margin: 0; font-size: 36px; font-weight: bold;">{{ $banners ?? 0 }}</p>
            <a href="{{ route('admin.banners.index') }}" style="display: inline-block; margin-top: 15px; color: white; text-decoration: none; font-weight: 500; border-bottom: 2px solid white; padding-bottom: 2px;">Manage →</a>
        </div>
        
        <!-- Blogs Card -->
        <div style="background: linear-gradient(135deg, #4a90e2, #2e5c8a); color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 10px 0; font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Blogs</h3>
            <p style="margin: 0; font-size: 36px; font-weight: bold;">{{ $blogs ?? 0 }}</p>
            <a href="{{ route('admin.blogs.index') }}" style="display: inline-block; margin-top: 15px; color: white; text-decoration: none; font-weight: 500; border-bottom: 2px solid white; padding-bottom: 2px;">Manage →</a>
        </div>
        
        <!-- Gallery Card -->
        <div style="background: linear-gradient(135deg, #26c6da, #00a8b8); color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 10px 0; font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Gallery Items</h3>
            <p style="margin: 0; font-size: 36px; font-weight: bold;">{{ $gallery ?? 0 }}</p>
            <a href="{{ route('admin.gallery.index') }}" style="display: inline-block; margin-top: 15px; color: white; text-decoration: none; font-weight: 500; border-bottom: 2px solid white; padding-bottom: 2px;">Manage →</a>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div style="background: #f5f8fc; padding: 30px; border-radius: 10px; border-left: 4px solid #18b4d4;">
        <h2 style="color: #0a1628; margin-top: 0; margin-bottom: 20px;">Quick Actions</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <a href="{{ route('admin.services.create') }}" style="display: inline-block; background: #18b4d4; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none; text-align: center; font-weight: 500; transition: background 0.3s;">+ Add Service</a>
            <a href="{{ route('admin.banners.create') }}" style="display: inline-block; background: #f0a030; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none; text-align: center; font-weight: 500; transition: background 0.3s;">+ Add Banner</a>
            <a href="{{ route('admin.blogs.create') }}" style="display: inline-block; background: #4a90e2; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none; text-align: center; font-weight: 500; transition: background 0.3s;">+ Add Blog</a>
            <a href="{{ route('admin.gallery.create') }}" style="display: inline-block; background: #26c6da; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none; text-align: center; font-weight: 500; transition: background 0.3s;">+ Add Gallery Item</a>
        </div>
    </div>
</div>
@endsection
