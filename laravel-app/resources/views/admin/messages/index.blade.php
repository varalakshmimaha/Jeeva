@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Contact Messages</h1>
            <p class="adm-page-sub">Messages submitted through the contact form.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif

    <div class="adm-card">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="col-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr style="{{ !$msg->is_read ? 'background:#fdf8f8;' : '' }}">
                    <td>
                        <div style="font-weight:{{ !$msg->is_read ? '700' : '500' }};">{{ $msg->name }}</div>
                        <div style="font-size:12px;color:var(--muted);font-weight:400;">{{ $msg->email }}</div>
                    </td>
                    <td style="color:var(--muted);">{{ Str::limit($msg->subject ?? $msg->message, 40) }}</td>
                    <td style="color:var(--muted);font-size:13px;">{{ $msg->created_at->diffForHumans() }}</td>
                    <td>
                        @if(!$msg->is_read)
                            <span class="adm-badge adm-badge-red">Unread</span>
                        @else
                            <span class="adm-badge adm-badge-green">Read</span>
                        @endif
                    </td>
                    <td class="col-center">
                        <div class="adm-actions" style="justify-content:center;">
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="adm-btn adm-btn-dark adm-btn-sm">View</a>
                            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:var(--muted);padding:40px;">No messages yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
