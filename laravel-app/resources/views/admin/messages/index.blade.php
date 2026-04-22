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
                    <td style="color:var(--muted);">
                        <div>{{ Str::limit($msg->subject ?? $msg->message, 40) }}</div>
                        @php
                            $bookingMatch = preg_match('/Selected Date & Time:\s*(.+?)\n/', $msg->message, $matches);
                            $bookingDate = $bookingMatch ? trim($matches[1]) : null;
                        @endphp
                        @if($bookingDate)
                            <div style="font-size:11px;color:#4DB6AC;margin-top:4px;">📅 {{ $bookingDate }}</div>
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
                    <td colspan="5" style="text-align:center;color:var(--muted);padding:40px;">No messages yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
