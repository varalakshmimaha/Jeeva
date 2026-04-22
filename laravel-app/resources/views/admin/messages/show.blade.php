@extends('layouts.admin')

@section('admin-content')
<div>
    @if(session('success'))
      <div id="admToast" class="adm-toast">
        <span class="adm-toast-icon">✓</span>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <div class="adm-page-header">
        <h1 class="adm-page-title">Message from {{ $message->name }}</h1>
        <a href="{{ route('admin.messages.index') }}" class="adm-back">&larr; Back to Messages</a>
    </div>

    <div class="adm-card">
        <div class="adm-card-head" style="display:flex;justify-content:space-between;align-items:center;">
            <span>Booking Details</span>
            <span style="font-size:12px;color:var(--muted);font-weight:400;">Submitted {{ $message->created_at->format('d M Y, h:i A') }}</span>
        </div>
        <div class="adm-card-body">
            <table class="adm-form-table">
                <tr>
                    <td class="adm-fl">Full Name</td>
                    <td class="adm-fi" style="font-weight:600;">{{ $message->name }}</td>
                </tr>
                <tr>
                    <td class="adm-fl">Email Address</td>
                    <td class="adm-fi"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                </tr>
                @if($message->phone)
                <tr>
                    <td class="adm-fl">Phone Number</td>
                    <td class="adm-fi"><a href="tel:{{ $message->phone }}">{{ $message->phone }}</a></td>
                </tr>
                @endif
                @if($message->service_selected)
                <tr>
                    <td class="adm-fl">Service</td>
                    <td class="adm-fi" style="font-weight:600;">{{ $message->service_selected }}</td>
                </tr>
                @elseif($message->subject)
                <tr>
                    <td class="adm-fl">Subject</td>
                    <td class="adm-fi" style="font-weight:600;">{{ $message->subject }}</td>
                </tr>
                @endif

                @if($message->preferred_date)
                <tr>
                    <td class="adm-fl">Preferred Date</td>
                    <td class="adm-fi" style="font-weight:600;color:#2FA9A3;">📅 {{ \Carbon\Carbon::parse($message->preferred_date)->format('l, d M Y') }}</td>
                </tr>
                @endif
                @if($message->preferred_time)
                <tr>
                    <td class="adm-fl">Preferred Time</td>
                    <td class="adm-fi" style="font-weight:600;color:#2FA9A3;">🕐 {{ $message->preferred_time }}</td>
                </tr>
                @endif

                @if($message->message)
                <tr>
                    <td class="adm-fl" style="vertical-align:top;padding-top:10px;">Other Notes</td>
                    <td class="adm-fi">
                        <div class="adm-detail-box">{{ $message->message }}</div>
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>

    <!-- Consultation Status -->
    <div class="adm-card">
        <div class="adm-card-head" style="display:flex;justify-content:space-between;align-items:center;">
            <span>Consultation Status</span>
            @php
                $statusBadge = [
                    'pending' => ['label' => '⏳ Pending', 'color' => '#b9770e', 'bg' => '#fdf2e5'],
                    'consulted' => ['label' => '✓ Consulted', 'color' => '#1d7b52', 'bg' => '#e8f7ef'],
                    'scheduled' => ['label' => '📅 Scheduled', 'color' => '#1f6b93', 'bg' => '#e8f1f9'],
                    'no_response' => ['label' => '✗ No Response', 'color' => '#a52d2d', 'bg' => '#fdecec'],
                ];
                $curStatus = $message->consultation_status ?? 'pending';
                $b = $statusBadge[$curStatus] ?? $statusBadge['pending'];
            @endphp
            <span style="font-size:12px;font-weight:600;padding:4px 10px;border-radius:999px;background:{{ $b['bg'] }};color:{{ $b['color'] }};">Current: {{ $b['label'] }}</span>
        </div>
        <div class="adm-card-body">
            <form action="{{ route('admin.messages.update-status', $message->id) }}" method="POST" style="display: flex; gap: 12px; align-items: center;">
                @csrf @method('PUT')
                <select name="consultation_status" class="adm-input" style="flex: 1; max-width: 300px;">
                    <option value="pending" {{ $curStatus === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="consulted" {{ $curStatus === 'consulted' ? 'selected' : '' }}>✓ Consulted</option>
                    <option value="scheduled" {{ $curStatus === 'scheduled' ? 'selected' : '' }}>📅 Scheduled</option>
                    <option value="no_response" {{ $curStatus === 'no_response' ? 'selected' : '' }}>✗ No Response</option>
                </select>
                <button type="submit" class="adm-btn adm-btn-primary">Update Status</button>
            </form>
        </div>
    </div>
</div>

<style>
.adm-toast {
  position: fixed;
  top: 24px;
  right: 24px;
  z-index: 9999;
  display: flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%);
  color: #ffffff;
  padding: 14px 22px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 600;
  box-shadow: 0 18px 40px -10px rgba(47,169,163,0.45);
  animation: admToastIn .35s ease, admToastOut .35s ease 3.3s forwards;
}
.adm-toast-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  background: rgba(255,255,255,0.22);
  font-size: 13px;
}
@keyframes admToastIn {
  from { transform: translateY(-12px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}
@keyframes admToastOut {
  to { transform: translateY(-12px); opacity: 0; visibility: hidden; }
}
</style>

<script>
setTimeout(function () {
  var t = document.getElementById('admToast');
  if (t) t.style.display = 'none';
}, 3800);
</script>
@endsection
