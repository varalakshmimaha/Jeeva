@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Banners</h1>
            <p class="adm-page-sub">Manage hero banners and visuals across your site pages.</p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="adm-btn adm-btn-primary">+ Create Banner</a>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif

    @if($banners->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty-icon">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
            <h3>No banners configured</h3>
            <p>Set up your first hero banner for your site pages.</p>
            <a href="{{ route('admin.banners.create') }}" class="adm-btn adm-btn-primary">Create First Banner</a>
        </div>
    @else
        <div class="adm-card">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Page</th>
                        <th>Title</th>
                        <th>Order</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td>
                            <div class="adm-thumb adm-thumb-wide">
                                @if($banner->image)
                                    <img src="{{ asset($banner->image) }}" alt="">
                                @endif
                            </div>
                        </td>
                        <td><span class="adm-badge adm-badge-teal" style="text-transform:capitalize;">{{ $banner->page }}</span></td>
                        <td>
                            <div style="font-weight:700;">{{ $banner->title }}</div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">{{ Str::limit($banner->description, 50) }}</div>
                        </td>
                        <td style="color:var(--muted);font-weight:600;">{{ $banner->order ?? 0 }}</td>
                        <td class="col-actions">
                            <div class="adm-actions">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="adm-btn adm-btn-dark adm-btn-sm">Edit</a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this banner?')">
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
