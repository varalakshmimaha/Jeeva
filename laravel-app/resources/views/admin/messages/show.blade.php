@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Message from {{ $message->name }}</h1>
        <a href="{{ route('admin.messages.index') }}" class="adm-back">&larr; Back to Messages</a>
    </div>

    <div class="adm-card">
        <div class="adm-card-head" style="display:flex;justify-content:space-between;align-items:center;">
            <span>Message Details</span>
            <span style="font-size:12px;color:var(--muted);font-weight:400;">{{ $message->created_at->format('d M Y, h:i A') }}</span>
        </div>
        <div class="adm-card-body">
            <table class="adm-form-table">
                <tr>
                    <td class="adm-fl">Full Name</td>
                    <td class="adm-fi" style="font-weight:600;">{{ $message->name }}</td>
                </tr>
                <tr>
                    <td class="adm-fl">Email Address</td>
                    <td class="adm-fi">{{ $message->email }}</td>
                </tr>
                @if($message->phone)
                <tr>
                    <td class="adm-fl">Phone Number</td>
                    <td class="adm-fi">{{ $message->phone }}</td>
                </tr>
                @endif
                @if($message->subject)
                <tr>
                    <td class="adm-fl">Service</td>
                    <td class="adm-fi" style="font-weight:600;">{{ $message->subject }}</td>
                </tr>
                @endif

                @php
                    $bookingMatch = preg_match('/Selected Date & Time:\s*(.+?)\n/', $message->message, $matches);
                    $bookingDate = $bookingMatch ? trim($matches[1]) : null;

                    $notesMatch = preg_match('/Additional Notes:\s*(.+?)$/s', $message->message, $notesMatches);
                    $notes = $notesMatch ? trim($notesMatches[1]) : null;
                @endphp

                @if($bookingDate)
                <tr>
                    <td class="adm-fl">Pick a Date & Time</td>
                    <td class="adm-fi" style="font-weight:600;">{{ $bookingDate }}</td>
                </tr>
                @endif

                @if($notes)
                <tr>
                    <td class="adm-fl" style="vertical-align:top;padding-top:10px;">Other Notes</td>
                    <td class="adm-fi">
                        <div class="adm-detail-box">{{ $notes }}</div>
                    </td>
                </tr>
                @endif

                <tr>
                    <td class="adm-fl" style="vertical-align:top;padding-top:10px;">Full Message</td>
                    <td class="adm-fi">
                        <div class="adm-detail-box">{{ $message->message }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Consultation Status -->
    <div class="adm-card">
        <div class="adm-card-head">Consultation Status</div>
        <div class="adm-card-body">
            <form action="{{ route('admin.messages.update-status', $message->id) }}" method="POST" style="display: flex; gap: 12px; align-items: center;">
                @csrf @method('PUT')
                <select name="consultation_status" class="adm-input" style="flex: 1; max-width: 300px;">
                    <option value="pending" {{ $message->consultation_status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="consulted" {{ $message->consultation_status === 'consulted' ? 'selected' : '' }}>✓ Consulted</option>
                    <option value="scheduled" {{ $message->consultation_status === 'scheduled' ? 'selected' : '' }}>📅 Scheduled</option>
                    <option value="no_response" {{ $message->consultation_status === 'no_response' ? 'selected' : '' }}>✗ No Response</option>
                </select>
                <button type="submit" class="adm-btn adm-btn-primary">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
