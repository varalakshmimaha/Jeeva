@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Edit Testimonial</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="adm-back">&larr; Back to Testimonials</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="adm-card">
            <div class="adm-card-head">Testimonial Details</div>
            <div class="adm-card-body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Client Name *</label>
                        <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required class="adm-input">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Role / Title</label>
                        <input type="text" name="role" value="{{ old('role', $testimonial->role) }}" class="adm-input" placeholder="e.g., First-time Mother">
                    </div>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Category</label>
                        <input type="text" name="category" value="{{ old('category', $testimonial->category) }}" class="adm-input" placeholder="e.g., Birth Doula Support">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Rating *</label>
                        <select name="rating" class="adm-input">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-label">Message *</label>
                    <textarea name="message" rows="5" required class="adm-input">{{ old('message', $testimonial->message) }}</textarea>
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-label">Client Photo</label>
                    @if($testimonial->image)
                        <div class="adm-img-preview adm-img-preview-round" style="margin-bottom:10px;">
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}">
                            <span class="adm-img-tag">Current Photo</span>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="adm-input">
                    <p class="adm-hint">Leave empty to keep current photo. JPG, PNG or WebP.</p>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Sort Order</label>
                        <input type="number" name="order" value="{{ old('order', $testimonial->order) }}" class="adm-input">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Visibility</label>
                        <label class="adm-check" style="margin-top:8px;">
                            <input type="checkbox" name="published" value="1" {{ old('published', $testimonial->published) ? 'checked' : '' }}>
                            <span>Published on website</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Update Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
