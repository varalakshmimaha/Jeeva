@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Add Testimonial</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="adm-back">&larr; Back to Testimonials</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="adm-card">
            <div class="adm-card-head">Testimonial Details</div>
            <div class="adm-card-body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Client Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="adm-input" placeholder="e.g., Priya Sharma">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Role / Title</label>
                        <input type="text" name="role" value="{{ old('role') }}" class="adm-input" placeholder="e.g., First-time Mother">
                    </div>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Client Photo</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="adm-input">
                        <p class="adm-hint">JPG, PNG or WebP. Max 2MB. Optional.</p>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Rating *</label>
                        <select name="rating" class="adm-input">
                            <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                        </select>
                    </div>
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-label">Message *</label>
                    <textarea name="message" rows="5" required class="adm-input" placeholder="Write the client's testimonial here...">{{ old('message') }}</textarea>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Sort Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="adm-input">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Visibility</label>
                        <label class="adm-check" style="margin-top:8px;">
                            <input type="checkbox" name="published" value="1" {{ old('published', true) ? 'checked' : '' }}>
                            <span>Published on website</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Save Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
