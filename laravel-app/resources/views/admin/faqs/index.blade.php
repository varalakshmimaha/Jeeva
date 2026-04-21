@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">FAQs</h1>
            <p class="adm-page-sub">Manage frequently asked questions shown on the home page.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="adm-btn adm-btn-primary">+ Add FAQ</a>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif

    @if($faqs->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty-icon">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <h3>No FAQs yet</h3>
            <p>Add your first frequently asked question to display on the home page.</p>
            <a href="{{ route('admin.faqs.create') }}" class="adm-btn adm-btn-primary">Add First FAQ</a>
        </div>
    @else
        <div class="adm-card">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th class="col-center">Status</th>
                        <th class="col-center">Order</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                    <tr>
                        <td style="color:var(--muted);font-weight:600;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight:600;max-width:320px;">{{ $faq->question }}</div>
                        </td>
                        <td>
                            <div style="font-size:13px;color:var(--muted);max-width:300px;">{{ Str::limit($faq->answer, 80) }}</div>
                        </td>
                        <td class="col-center">
                            @if($faq->is_active)
                                <span class="adm-badge adm-badge-green">Active</span>
                            @else
                                <span class="adm-badge adm-badge-red">Hidden</span>
                            @endif
                        </td>
                        <td class="col-center" style="color:var(--muted);font-weight:600;">{{ $faq->order }}</td>
                        <td class="col-actions">
                            <div class="adm-actions">
                                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="adm-btn adm-btn-dark adm-btn-sm">Edit</a>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Delete this FAQ?')">
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
