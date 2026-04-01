@extends('layouts.admin')

@section('admin-content')
<div style="max-width: 600px;">
    <h1 style="color: #0a1628; margin-bottom: 30px; margin-top: 0; font-family: 'Playfair Display';">Add New Blog</h1>
    
    @if($errors->any())
        <div style="background: #ffebee; color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #c62828;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.blogs.store') }}" method="POST" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label for="title" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="slug" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Slug *</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required placeholder="e.g., dental-care-tips" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="category" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Category *</label>
            <input type="text" id="category" name="category" value="{{ old('category') }}" required placeholder="e.g., Tips, News, Guide" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="content" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Content *</label>
            <textarea id="content" name="content" required rows="8" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box; resize: vertical;">{{ old('content') }}</textarea>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="icon" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Icon (emoji or char)</label>
            <input type="text" id="icon" name="icon" value="{{ old('icon') }}" maxlength="10" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 30px;">
            <label for="published" style="display: flex; align-items: center; color: #0a1628; font-weight: 600; cursor: pointer;">
                <input type="checkbox" id="published" name="published" value="1" {{ old('published') ? 'checked' : '' }} style="width: 18px; height: 18px; margin-right: 8px; cursor: pointer;">
                Publish immediately (unchecked = Draft)
            </label>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #18b4d4; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 14px;">Create Blog</button>
            <a href="{{ route('admin.blogs.index') }}" style="background: #ccc; color: #333; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 14px;">Cancel</a>
        </div>
    </form>
</div>
@endsection
