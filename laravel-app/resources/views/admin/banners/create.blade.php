@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Add New Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="adm-back">&larr; Back to Banners</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="adm-card">
            <div class="adm-card-head">Banner Details</div>
            <div class="adm-card-body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Page *</label>
                        <select name="page" required class="adm-input">
                            <option value="">Select a page</option>
                            <option value="home" {{ old('page') == 'home' ? 'selected' : '' }}>Home</option>
                            <option value="about" {{ old('page') == 'about' ? 'selected' : '' }}>About Us</option>
                            <option value="services" {{ old('page') == 'services' ? 'selected' : '' }}>Services</option>
                            <option value="testimonials" {{ old('page') == 'testimonials' ? 'selected' : '' }}>Testimonials</option>
                            <option value="contact" {{ old('page') == 'contact' ? 'selected' : '' }}>Contact Us</option>
                            <option value="gallery" {{ old('page') == 'gallery' ? 'selected' : '' }}>Gallery</option>
                            <option value="blog" {{ old('page') == 'blog' ? 'selected' : '' }}>Blog</option>
                        </select>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="adm-input" placeholder="Banner heading text (optional)">
                    </div>
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-label">Description</label>
                    <textarea name="description" rows="3" class="adm-input" placeholder="Short description for the banner">{{ old('description') }}</textarea>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Button Text</label>
                        <input type="text" name="button_text" value="{{ old('button_text', 'Book Consultation') }}" class="adm-input" placeholder="e.g., Book Consultation">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Button Link</label>
                        <input type="text" name="button_link" value="{{ old('button_link', '/contact') }}" class="adm-input" placeholder="e.g., /contact or /services">
                    </div>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Banner Image</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="adm-input">
                        <p class="adm-hint">JPG, PNG or WebP. Recommended 1920×800 px. Min 800×300, max 4000×2500 px.</p>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="adm-input" placeholder="0">
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Create Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
