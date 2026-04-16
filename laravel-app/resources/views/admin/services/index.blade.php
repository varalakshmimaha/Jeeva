@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Services</h1>
            <p class="adm-page-sub">Manage your services and specialities.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="adm-btn adm-btn-primary">+ Add Service</a>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif

    @if($services->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty-icon">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <h3>No services yet</h3>
            <p>Start by adding your first service.</p>
            <a href="{{ route('admin.services.create') }}" class="adm-btn adm-btn-primary">Add Your First Service</a>
        </div>
    @else
        <div class="adm-card">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Service Title</th>
                        <th>Category</th>
                        <th>Order</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>
                            <div class="adm-thumb">
                                @if($service->icon)
                                    <img src="{{ asset($service->icon) }}" alt="">
                                @else
                                    <svg width="22" height="22" fill="none" stroke="var(--teal)" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700;">{{ $service->title }}</div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">{{ Str::limit($service->description, 55) }}</div>
                        </td>
                        <td><span class="adm-badge adm-badge-teal">{{ $service->subtitle ?? 'General' }}</span></td>
                        <td style="color:var(--muted);font-weight:600;">{{ $service->order ?? '0' }}</td>
                        <td class="col-actions">
                            <div class="adm-actions">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="adm-btn adm-btn-dark adm-btn-sm">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Delete this service?')">
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
