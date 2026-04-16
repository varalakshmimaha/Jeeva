@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Add Gallery Item</h1>
        <a href="{{ route('admin.gallery.index') }}" class="adm-back">&larr; Back to Gallery</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="adm-card">
            <div class="adm-card-head">Gallery Item Details</div>
            <div class="adm-card-body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="adm-input" placeholder="Photo or item title">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Category</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="adm-input" placeholder="e.g., prenatal, postnatal, wellness">
                    </div>
                </div>
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Image *</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="adm-input" required>
                        <p class="adm-hint">JPG, PNG or WebP. Max 3MB.</p>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="adm-input" placeholder="0">
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Create Item</button>
            <a href="{{ route('admin.gallery.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
