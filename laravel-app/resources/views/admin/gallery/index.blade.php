@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Gallery</h1>
            <p class="adm-page-sub">Manage photos and visual content for your gallery.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="adm-btn adm-btn-primary">+ Add Gallery Item</a>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty-icon">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
            </div>
            <h3>No gallery items yet</h3>
            <p>Start showcasing your work by uploading your first photo.</p>
            <a href="{{ route('admin.gallery.create') }}" class="adm-btn adm-btn-primary">Upload First Photo</a>
        </div>
    @else
        <div class="adm-card">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Title & Category</th>
                        <th>Color</th>
                        <th>Order</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>
                            <div class="adm-thumb" style="width:56px;height:56px;border-radius:10px;">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="">
                                @else
                                    <svg width="22" height="22" fill="none" stroke="var(--teal)" stroke-width="2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700;">{{ $item->title }}</div>
                            <span class="adm-badge adm-badge-teal" style="margin-top:4px;display:inline-block;text-transform:capitalize;">{{ str_replace('-', ' ', $item->category ?? '') }}</span>
                        </td>
                        <td style="color:var(--muted);font-weight:600;">{{ $item->color_class ?? '—' }}</td>
                        <td style="color:var(--muted);font-weight:600;">{{ $item->order ?? '0' }}</td>
                        <td class="col-actions">
                            <div class="adm-actions">
                                <a href="{{ route('admin.gallery.edit', $item->id) }}" class="adm-btn adm-btn-dark adm-btn-sm">Edit</a>
                                <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove from gallery?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
