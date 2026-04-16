@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Edit Blog</h1>
        <a href="{{ route('admin.blogs.index') }}" class="adm-back">&larr; Back to Blogs</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="adm-card">
            <div class="adm-card-head">Article Details</div>
            <div class="adm-card-body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="adm-input">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Slug *</label>
                        <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}" required class="adm-input">
                        <p class="adm-hint">URL-friendly identifier. Lowercase letters and hyphens only.</p>
                    </div>
                </div>
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label class="adm-label">Category *</label>
                        <input type="text" name="category" value="{{ old('category', $blog->category) }}" required class="adm-input">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Featured Image</label>
                        @if($blog->image)
                            <div class="adm-img-preview" style="margin-bottom:10px;">
                                <img src="{{ asset($blog->image) }}" alt="Current image" style="max-width:200px;border-radius:8px;">
                                <span class="adm-img-tag">Current Image</span>
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="adm-input">
                        <p class="adm-hint">Leave empty to keep current image. JPG, PNG or WebP. Max 3MB.</p>
                    </div>
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-label">Content *</label>
                    <textarea name="content" required rows="10" class="adm-input">{{ old('content', $blog->content) }}</textarea>
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-check">
                        <input type="checkbox" name="published" value="1" {{ old('published', $blog->published) ? 'checked' : '' }}>
                        <span>Published (unchecked = Draft)</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Update Blog</button>
            <a href="{{ route('admin.blogs.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
