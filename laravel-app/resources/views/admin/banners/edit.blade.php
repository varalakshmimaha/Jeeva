@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Edit Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="adm-back">&larr; Back to Banners</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="adm-card">
            <div class="adm-card-head">Banner Details</div>
            <div class="adm-card-body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Page *</label>
                        <select name="page" required class="adm-input">
                            <option value="">Select a page</option>
                            <option value="home" {{ old('page', $banner->page) == 'home' ? 'selected' : '' }}>Home</option>
                            <option value="services" {{ old('page', $banner->page) == 'services' ? 'selected' : '' }}>Services</option>
                            <option value="blog" {{ old('page', $banner->page) == 'blog' ? 'selected' : '' }}>Blog</option>
                            <option value="gallery" {{ old('page', $banner->page) == 'gallery' ? 'selected' : '' }}>Gallery</option>
                            <option value="contact" {{ old('page', $banner->page) == 'contact' ? 'selected' : '' }}>Contact</option>
                        </select>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $banner->title) }}" required class="adm-input">
                    </div>
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-label">Description</label>
                    <textarea name="description" rows="3" class="adm-input">{{ old('description', $banner->description) }}</textarea>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Button Text</label>
                        <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" class="adm-input" placeholder="e.g., Book Consultation">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Button Link</label>
                        <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" class="adm-input" placeholder="e.g., /contact or /services">
                    </div>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Banner Image</label>
                        @if($banner->image)
                            <div class="adm-img-preview" style="margin-bottom:10px;">
                                <img src="{{ asset($banner->image) }}" alt="Current banner" style="max-width:260px;border-radius:8px;">
                                <span class="adm-img-tag">Current Image</span>
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="adm-input">
                        <p class="adm-hint">Leave empty to keep current image. JPG, PNG or WebP. Max 3MB.</p>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $banner->order) }}" class="adm-input">
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Update Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
