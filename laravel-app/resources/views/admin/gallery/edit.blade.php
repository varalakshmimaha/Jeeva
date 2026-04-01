@extends('layouts.admin')

@section('admin-content')
<div style="max-width: 600px;">
    <h1 style="color: #0a1628; margin-bottom: 30px; margin-top: 0; font-family: 'Playfair Display';">Edit Gallery Item</h1>
    
    @if($errors->any())
        <div style="background: #ffebee; color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #c62828;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.gallery.update', $item->id) }}" method="POST" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 20px;">
            <label for="title" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $item->title) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="description" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Description</label>
            <textarea id="description" name="description" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box; resize: vertical;">{{ old('description', $item->description) }}</textarea>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="icon" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Icon (emoji)</label>
            <input type="text" id="icon" name="icon" value="{{ old('icon', $item->icon) }}" maxlength="10" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="color_class" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Color Class *</label>
            <select id="color_class" name="color_class" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
                <option value="">Select a color</option>
                @foreach($colors as $color)
                    <option value="{{ $color }}" {{ old('color_class', $item->color_class) == $color ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 30px;">
            <label for="order" style="display: block; color: #0a1628; font-weight: 600; margin-bottom: 8px;">Display Order</label>
            <input type="number" id="order" name="order" value="{{ old('order', $item->order) }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #18b4d4; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 14px;">Update Item</button>
            <a href="{{ route('admin.gallery.index') }}" style="background: #ccc; color: #333; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 14px;">Cancel</a>
        </div>
    </form>
</div>
@endsection
