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
                    <th>Service</th>
                    <th>Slot</th>
                    <th>Submitted</th>
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
                        @if($msg->phone)
                            <div style="font-size:11px;color:var(--muted);font-weight:400;">{{ $msg->phone }}</div>
                        @endif
                    </td>
                    <td style="color:var(--muted);">
                        {{ Str::limit($msg->service_selected ?? $msg->subject ?? '—', 40) }}
                    </td>
                    <td style="font-size:12px;">
                        @if($msg->preferred_date)
                            <div style="color:#2FA9A3;font-weight:600;">📅 {{ \Carbon\Carbon::parse($msg->preferred_date)->format('M d, Y') }}</div>
                        @endif
                        @if($msg->preferred_time)
                            <div style="color:#2FA9A3;font-weight:600;">🕐 {{ $msg->preferred_time }}</div>
                        @endif
                        @if(!$msg->preferred_date && !$msg->preferred_time)
                            <span style="color:var(--muted);">—</span>
                        @endif
                    </td>
                    <td style="color:var(--muted);font-size:13px;">{{ $msg->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        @php
                            $statusConfig = [
                                'pending' => ['label' => '⏳ Pending', 'class' => 'adm-badge-orange'],
                                'consulted' => ['label' => '✓ Consulted', 'class' => 'adm-badge-green'],
                                'scheduled' => ['label' => '📅 Scheduled', 'class' => 'adm-badge-blue'],
                                'no_response' => ['label' => '✗ No Response', 'class' => 'adm-badge-red'],
                            ];
                            $status = $msg->consultation_status ?? 'pending';
                            $config = $statusConfig[$status] ?? $statusConfig['pending'];
                        @endphp
                        <span class="adm-badge {{ $config['class'] }}">{{ $config['label'] }}</span>
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
                    <td colspan="6" style="text-align:center;color:var(--muted);padding:40px;">No messages yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
