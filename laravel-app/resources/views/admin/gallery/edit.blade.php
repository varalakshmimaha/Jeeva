@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Edit Gallery Item</h1>
        <a href="{{ route('admin.gallery.index') }}" class="adm-back">&larr; Back to Gallery</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.gallery.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="adm-card">
            <div class="adm-card-head">Gallery Item Details</div>
            <div class="adm-card-body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $item->title) }}" required class="adm-input">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Category *</label>
                        <input type="text" name="category" value="{{ old('category', $item->category) }}" required class="adm-input">
                    </div>
                </div>
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Image</label>
                        @if($item->image)
                            <div class="adm-img-preview" style="margin-bottom:10px;">
                                <img src="{{ asset($item->image) }}" alt="Current image" style="max-width:200px;border-radius:8px;">
                                <span class="adm-img-tag">Current Image</span>
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="adm-input">
                        <p class="adm-hint">Leave empty to keep current image. JPG, PNG or WebP. Max 3MB.</p>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $item->order) }}" class="adm-input">
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Update Item</button>
            <a href="{{ route('admin.gallery.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
