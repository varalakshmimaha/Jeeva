@extends('layouts.app')

@section('content')
<div style="display: flex; min-height: calc(100vh - 100px); background: #f5f8fc;">
    <!-- Sidebar -->
    <div style="width: 250px; background: #0a1628; color: white; padding: 30px 0; box-shadow: 2px 0 10px rgba(0,0,0,0.1);">
        <div style="padding: 0 20px; margin-bottom: 30px;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 600;">Admin Panel</h2>
            <p style="margin: 5px 0 0 0; font-size: 12px; opacity: 0.7;">Content Management</p>
        </div>
        
        <nav style="display: flex; flex-direction: column;">
            <a href="{{ route('admin.dashboard') }}" style="padding: 15px 20px; color: white; text-decoration: none; display: flex; align-items: center; transition: background 0.3s; {{ request()->routeIs('admin.dashboard') ? 'background: #18b4d4;' : 'border-left: 3px solid transparent;' }} @if(!request()->routeIs('admin.dashboard')) hover { background: rgba(255,255,255,0.05); } @endif">
                <span style="margin-right: 10px; font-size: 18px;">📊</span>
                Dashboard
            </a>
            <a href="{{ route('admin.services.index') }}" style="padding: 15px 20px; color: white; text-decoration: none; display: flex; align-items: center; transition: background 0.3s; {{ request()->routeIs('admin.services.*') ? 'background: #18b4d4;' : 'border-left: 3px solid transparent;' }}">
                <span style="margin-right: 10px; font-size: 18px;">🦷</span>
                Services
            </a>
            <a href="{{ route('admin.banners.index') }}" style="padding: 15px 20px; color: white; text-decoration: none; display: flex; align-items: center; transition: background 0.3s; {{ request()->routeIs('admin.banners.*') ? 'background: #18b4d4;' : 'border-left: 3px solid transparent;' }}">
                <span style="margin-right: 10px; font-size: 18px;">🖼️</span>
                Banners
            </a>
            <a href="{{ route('admin.blogs.index') }}" style="padding: 15px 20px; color: white; text-decoration: none; display: flex; align-items: center; transition: background 0.3s; {{ request()->routeIs('admin.blogs.*') ? 'background: #18b4d4;' : 'border-left: 3px solid transparent;' }}">
                <span style="margin-right: 10px; font-size: 18px;">📝</span>
                Blogs
            </a>
            <a href="{{ route('admin.gallery.index') }}" style="padding: 15px 20px; color: white; text-decoration: none; display: flex; align-items: center; transition: background 0.3s; {{ request()->routeIs('admin.gallery.*') ? 'background: #18b4d4;' : 'border-left: 3px solid transparent;' }}">
                <span style="margin-right: 10px; font-size: 18px;">🖼️</span>
                Gallery
            </a>
            <a href="{{ route('admin.settings.edit') }}" style="padding: 15px 20px; color: white; text-decoration: none; display: flex; align-items: center; transition: background 0.3s; {{ request()->routeIs('admin.settings.*') ? 'background: #18b4d4;' : 'border-left: 3px solid transparent;' }}">
                <span style="margin-right: 10px; font-size: 18px;">⚙️</span>
                Settings
            </a>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div style="flex: 1; padding: 30px; overflow-y: auto;">
        @yield('admin-content')
    </div>
</div>
@endsection
