@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Testimonials</h1>
            <p class="adm-page-sub">Manage client reviews and testimonials.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="adm-btn adm-btn-primary">+ Add Testimonial</a>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif

    @if($testimonials->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty-icon">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <h3>No testimonials yet</h3>
            <p>Start by adding your first client testimonial.</p>
            <a href="{{ route('admin.testimonials.create') }}" class="adm-btn adm-btn-primary">Add First Testimonial</a>
        </div>
    @else
        <div class="adm-card">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Client</th>
                        <th>Message</th>
                        <th>Rating</th>
                        <th class="col-center">Status</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>
                            <div class="adm-thumb adm-thumb-round">
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" alt="">
                                @else
                                    <svg width="20" height="20" fill="none" stroke="var(--teal)" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700;">{{ $testimonial->name }}</div>
                            <div style="font-size:12px;color:var(--muted);">{{ $testimonial->role ?? 'Client' }}</div>
                        </td>
                        <td style="color:var(--muted);font-size:13px;max-width:260px;">{{ Str::limit($testimonial->message, 70) }}</td>
                        <td style="color:#f59e0b;font-size:15px;white-space:nowrap;">
                            @for($i = 0; $i < $testimonial->rating; $i++) &#9733; @endfor
                        </td>
                        <td class="col-center">
                            @if($testimonial->published)
                                <span class="adm-badge adm-badge-green">Published</span>
                            @else
                                <span class="adm-badge adm-badge-red">Draft</span>
                            @endif
                        </td>
                        <td class="col-actions">
                            <div class="adm-actions">
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="adm-btn adm-btn-dark adm-btn-sm">Edit</a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial?')">
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
