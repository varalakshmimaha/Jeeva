@extends('layouts.admin')

@section('admin-content')
@php
    $bookings = $messages->filter(function ($m) {
        return !empty($m->preferred_date) || !empty($m->preferred_time);
    })->values();
    $enquiries = $messages->reject(function ($m) {
        return !empty($m->preferred_date) || !empty($m->preferred_time);
    })->values();
    $activeTab = request('tab', 'bookings');
@endphp
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Messages</h1>
            <p class="adm-page-sub">All submissions from the booking form and Get in Touch form.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="adm-alert adm-alert-err">{{ session('error') }}</div>
    @endif

    <div class="msg-tabs">
        <button type="button" class="msg-tab {{ $activeTab === 'bookings' ? 'is-active' : '' }}" data-tab="bookings">
            📅 Book Consultations
            <span class="msg-tab-count">{{ $bookings->count() }}</span>
        </button>
        <button type="button" class="msg-tab {{ $activeTab === 'enquiries' ? 'is-active' : '' }}" data-tab="enquiries">
            💬 Get in Touch
            <span class="msg-tab-count">{{ $enquiries->count() }}</span>
        </button>
    </div>

    {{-- BOOKINGS TAB --}}
    <div id="tab-bookings" class="msg-panel {{ $activeTab === 'bookings' ? '' : 'is-hidden' }}">
        {{-- Bulk action toolbar --}}
        <form id="bulk-form-bookings" action="{{ route('admin.messages.bulk-destroy') }}" method="POST"
              onsubmit="return confirmBulk(this, 'booking')">
            @csrf
            <input type="hidden" name="tab" value="bookings">

            <div class="bulk-toolbar" id="bulk-toolbar-bookings">
                <span class="bulk-count" id="bulk-count-bookings">0 selected</span>
                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">🗑 Delete Selected</button>
                <button type="button" class="adm-btn adm-btn-sm" onclick="clearSelection('bookings')">Cancel</button>
            </div>

            <div class="adm-card">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th class="col-chk"><input type="checkbox" id="chk-all-bookings" title="Select all" onchange="toggleAll('bookings', this.checked)"></th>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Slot</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th class="col-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $msg)
                        <tr style="{{ !$msg->is_read ? 'background:#fdf8f8;' : '' }}">
                            <td class="col-chk">
                                <input type="checkbox" name="ids[]" value="{{ $msg->id }}" class="row-chk chk-bookings" onchange="updateBulkBar('bookings')">
                            </td>
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
                                    @if(str_contains(strtolower($msg->preferred_time), 'calendly'))
                                        <div style="margin-top:3px;">
                                            <span style="display:inline-flex;align-items:center;gap:5px;background:#e8f5f4;color:#006BFF;font-size:11px;font-weight:700;padding:2px 8px;border-radius:999px;">
                                                📆 Booked via Calendly
                                            </span>
                                        </div>
                                    @else
                                        <div style="color:#2FA9A3;font-weight:600;">🕐 {{ $msg->preferred_time }}</div>
                                    @endif
                                @endif
                                @if(!$msg->preferred_date && !$msg->preferred_time)
                                    <span style="color:var(--muted);">—</span>
                                @endif
                            </td>
                            <td style="color:var(--muted);font-size:13px;">{{ $msg->created_at->setTimezone($siteSettings['admin_timezone'] ?? 'UTC')->format('M d, Y h:i A') }}</td>
                            <td>
                                @php
                                    $statusConfig = [
                                        'pending' => ['label' => '⏳ Pending', 'class' => 'adm-badge-orange'],
                                        'consulted' => ['label' => '✓ Consulted', 'class' => 'adm-badge-green'],
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
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this booking? The slot will become available again for other clients.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:var(--muted);padding:40px;">No bookings yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    {{-- GET IN TOUCH TAB --}}
    <div id="tab-enquiries" class="msg-panel {{ $activeTab === 'enquiries' ? '' : 'is-hidden' }}">
        {{-- Bulk action toolbar --}}
        <form id="bulk-form-enquiries" action="{{ route('admin.messages.bulk-destroy') }}" method="POST"
              onsubmit="return confirmBulk(this, 'enquiry')">
            @csrf
            <input type="hidden" name="tab" value="enquiries">

            <div class="bulk-toolbar" id="bulk-toolbar-enquiries">
                <span class="bulk-count" id="bulk-count-enquiries">0 selected</span>
                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">🗑 Delete Selected</button>
                <button type="button" class="adm-btn adm-btn-sm" onclick="clearSelection('enquiries')">Cancel</button>
            </div>

            <div class="adm-card">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th class="col-chk"><input type="checkbox" id="chk-all-enquiries" title="Select all" onchange="toggleAll('enquiries', this.checked)"></th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Submitted</th>
                            <th class="col-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enquiries as $msg)
                        <tr style="{{ !$msg->is_read ? 'background:#fdf8f8;' : '' }}">
                            <td class="col-chk">
                                <input type="checkbox" name="ids[]" value="{{ $msg->id }}" class="row-chk chk-enquiries" onchange="updateBulkBar('enquiries')">
                            </td>
                            <td>
                                <div style="font-weight:{{ !$msg->is_read ? '700' : '500' }};">{{ $msg->name }}</div>
                                <div style="font-size:12px;color:var(--muted);font-weight:400;">{{ $msg->email }}</div>
                                @if($msg->phone)
                                    <div style="font-size:11px;color:var(--muted);font-weight:400;">{{ $msg->phone }}</div>
                                @endif
                            </td>
                            <td style="color:var(--muted);font-size:13px;">{{ $msg->subject ?? 'General Enquiry' }}</td>
                            <td style="color:var(--muted);font-size:13px;">{{ Str::limit($msg->message, 60) }}</td>
                            <td style="color:var(--muted);font-size:13px;">{{ $msg->created_at->setTimezone($siteSettings['admin_timezone'] ?? 'UTC')->format('M d, Y h:i A') }}</td>
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
                            <td colspan="6" style="text-align:center;color:var(--muted);padding:40px;">No enquiries yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<style>
.msg-tabs {
    display: flex;
    gap: 6px;
    margin-bottom: 20px;
    border-bottom: 2px solid var(--border, #e5e7eb);
}
.msg-tab {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 22px;
    background: transparent;
    border: none;
    border-bottom: 3px solid transparent;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    color: var(--muted, #6b7280);
    cursor: pointer;
    margin-bottom: -2px;
    transition: color .2s, border-color .2s;
}
.msg-tab:hover { color: #2FA9A3; }
.msg-tab.is-active {
    color: #2FA9A3;
    border-bottom-color: #2FA9A3;
}
.msg-tab-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 24px;
    height: 22px;
    padding: 0 8px;
    font-size: 12px;
    font-weight: 700;
    border-radius: 999px;
    background: #eef2f1;
    color: #475569;
}
.msg-tab.is-active .msg-tab-count {
    background: #2FA9A3;
    color: #ffffff;
}
.msg-panel.is-hidden { display: none; }

/* Bulk toolbar */
.bulk-toolbar {
    display: none;
    align-items: center;
    gap: 10px;
    background: #fff8e1;
    border: 1px solid #ffe082;
    border-radius: 8px;
    padding: 10px 16px;
    margin-bottom: 12px;
}
.bulk-toolbar.is-visible { display: flex; }
.bulk-count {
    font-size: 13px;
    font-weight: 600;
    color: #92400e;
    margin-right: 4px;
}

/* Checkbox column */
.col-chk {
    width: 36px;
    text-align: center;
    padding-left: 14px !important;
}
.col-chk input[type="checkbox"] {
    width: 15px;
    height: 15px;
    cursor: pointer;
    accent-color: #2FA9A3;
}
.adm-alert-err {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
    border-radius: 8px;
    padding: 10px 16px;
    margin-bottom: 16px;
    font-size: 14px;
}
</style>

<script>
/* Tab switching */
document.querySelectorAll('.msg-tab').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var tab = btn.getAttribute('data-tab');
        document.querySelectorAll('.msg-tab').forEach(function (t) { t.classList.remove('is-active'); });
        btn.classList.add('is-active');
        document.querySelectorAll('.msg-panel').forEach(function (p) { p.classList.add('is-hidden'); });
        var panel = document.getElementById('tab-' + tab);
        if (panel) panel.classList.remove('is-hidden');
        try {
            var url = new URL(window.location.href);
            url.searchParams.set('tab', tab);
            window.history.replaceState({}, '', url);
        } catch (e) {}
    });
});

/* Bulk select helpers */
function toggleAll(tab, checked) {
    document.querySelectorAll('.chk-' + tab).forEach(function (chk) {
        chk.checked = checked;
    });
    updateBulkBar(tab);
}

function updateBulkBar(tab) {
    var selected = document.querySelectorAll('.chk-' + tab + ':checked').length;
    var total    = document.querySelectorAll('.chk-' + tab).length;
    var toolbar  = document.getElementById('bulk-toolbar-' + tab);
    var counter  = document.getElementById('bulk-count-' + tab);
    var allChk   = document.getElementById('chk-all-' + tab);

    counter.textContent = selected + ' selected';
    toolbar.classList.toggle('is-visible', selected > 0);
    if (allChk) {
        allChk.indeterminate = selected > 0 && selected < total;
        allChk.checked = selected === total && total > 0;
    }
}

function clearSelection(tab) {
    document.querySelectorAll('.chk-' + tab).forEach(function (chk) { chk.checked = false; });
    var allChk = document.getElementById('chk-all-' + tab);
    if (allChk) { allChk.checked = false; allChk.indeterminate = false; }
    updateBulkBar(tab);
}

function confirmBulk(form, type) {
    var tab = form.querySelector('input[name="tab"]').value;
    var count = document.querySelectorAll('.chk-' + tab + ':checked').length;
    if (count === 0) { alert('Please select at least one ' + type + ' to delete.'); return false; }
    return confirm('Delete ' + count + ' selected ' + type + (count > 1 ? 'ies' : '') + '? This cannot be undone.');
}
</script>
@endsection
