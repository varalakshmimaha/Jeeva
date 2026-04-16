@extends('layouts.admin')

@section('admin-content')
<div class="db">

    <div class="db-top">
        <h1 class="db-title">Dashboard</h1>
        <div class="db-date">{{ date('l, d M Y') }}</div>
    </div>

    {{-- Stat Cards Grid --}}
    <div class="db-stats">
        <a href="{{ route('admin.services.index') }}" class="db-stat" style="border-left:4px solid #4DB6AC;">
            <div class="db-stat-body">
                <span class="db-stat-num">{{ $services ?? 0 }}</span>
                <span class="db-stat-lbl">Total Services</span>
            </div>
            <div class="db-stat-ico" style="color:#4DB6AC;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
        </a>

        <a href="{{ route('admin.banners.index') }}" class="db-stat" style="border-left:4px solid #f0a030;">
            <div class="db-stat-body">
                <span class="db-stat-num">{{ $banners ?? 0 }}</span>
                <span class="db-stat-lbl">Banners</span>
            </div>
            <div class="db-stat-ico" style="color:#f0a030;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
        </a>

        <a href="{{ route('admin.gallery.index') }}" class="db-stat" style="border-left:4px solid #ec4899;">
            <div class="db-stat-body">
                <span class="db-stat-num">{{ $gallery ?? 0 }}</span>
                <span class="db-stat-lbl">Gallery Images</span>
            </div>
            <div class="db-stat-ico" style="color:#ec4899;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
            </div>
        </a>

        <a href="{{ route('admin.messages.index') }}" class="db-stat" style="border-left:4px solid #ef4444;">
            <div class="db-stat-body">
                <span class="db-stat-num">{{ $messages ?? 0 }}</span>
                <span class="db-stat-lbl">Contact Messages</span>
            </div>
            <div class="db-stat-ico" style="color:#ef4444;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
        </a>

        <a href="{{ route('admin.testimonials.index') }}" class="db-stat" style="border-left:4px solid #f59e0b;">
            <div class="db-stat-body">
                <span class="db-stat-num">{{ $testimonials ?? 0 }}</span>
                <span class="db-stat-lbl">Testimonials</span>
            </div>
            <div class="db-stat-ico" style="color:#f59e0b;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
        </a>

        <a href="{{ route('admin.blogs.index') }}" class="db-stat" style="border-left:4px solid #6366f1;">
            <div class="db-stat-body">
                <span class="db-stat-num">{{ $blogs ?? 0 }}</span>
                <span class="db-stat-lbl">Blog Posts</span>
            </div>
            <div class="db-stat-ico" style="color:#6366f1;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
        </a>
    </div>

    {{-- Bottom Section: Recent Messages + Quick Actions --}}
    <div class="db-bottom">

        {{-- Recent Contact Messages --}}
        <div class="db-card">
            <div class="db-card-head">
                <h2 class="db-card-title">Recent Contact Messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="db-view-all">View All</a>
            </div>
            <table class="db-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $msg)
                    <tr>
                        <td>
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="db-msg-name">{{ $msg->name }}</a>
                        </td>
                        <td class="db-msg-subj">{{ Str::limit($msg->subject ?? $msg->message, 35) }}</td>
                        <td class="db-msg-date">{{ $msg->created_at->diffForHumans() }}</td>
                        <td>
                            @if(!$msg->is_read)
                                <span class="db-badge db-badge-unread">Unread</span>
                            @else
                                <span class="db-badge db-badge-read">Read</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center;color:var(--muted);padding:28px;">No messages yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Recently Added Services --}}
        <div class="db-card">
            <div class="db-card-head">
                <h2 class="db-card-title">Recently Added Services</h2>
                <a href="{{ route('admin.services.index') }}" class="db-view-all">View All</a>
            </div>
            <table class="db-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Added</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentServices as $svc)
                    <tr>
                        <td>
                            <a href="{{ route('admin.services.edit', $svc->id) }}" class="db-msg-name">{{ $svc->title }}</a>
                        </td>
                        <td class="db-msg-subj">{{ Str::limit($svc->subtitle ?? '—', 30) }}</td>
                        <td class="db-msg-date">{{ $svc->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center;color:var(--muted);padding:28px;">No services yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.db { max-width: 1100px; }

/* Top */
.db-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
}
.db-title {
    font-family: var(--serif);
    font-size: 28px;
    color: var(--navy);
    margin: 0;
}
.db-date {
    font-size: 13px;
    color: var(--muted);
    font-weight: 500;
}

/* Stats Grid */
.db-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 28px;
}
.db-stat {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    border-left: 4px solid;
    padding: 22px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
}
.db-stat:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
}
.db-stat-body {
    display: flex;
    flex-direction: column;
}
.db-stat-num {
    font-size: 32px;
    font-weight: 800;
    color: var(--navy);
    line-height: 1;
}
.db-stat-lbl {
    font-size: 13px;
    color: var(--muted);
    margin-top: 6px;
    font-weight: 500;
}
.db-stat-ico {
    opacity: 0.7;
}

/* Bottom Grid */
.db-bottom {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 20px;
}

/* Cards */
.db-card {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    overflow: hidden;
}
.db-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    border-bottom: 1px solid #f0f0f0;
}
.db-card-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--navy);
    margin: 0;
}
.db-view-all {
    font-size: 13px;
    font-weight: 600;
    color: var(--teal);
    text-decoration: none;
    padding: 5px 14px;
    border: 1px solid var(--teal);
    border-radius: 6px;
    transition: all 0.2s;
}
.db-view-all:hover {
    background: var(--teal);
    color: #fff;
}

/* Table */
.db-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.db-table thead tr {
    border-bottom: 1px solid #f0f0f0;
}
.db-table th {
    padding: 12px 18px;
    text-align: left;
    font-weight: 700;
    color: var(--navy);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.db-table td {
    padding: 12px 18px;
    border-bottom: 1px solid #f8f8f8;
    vertical-align: middle;
}
.db-table tr:last-child td { border-bottom: none; }
.db-msg-name {
    font-weight: 600;
    color: var(--navy);
    text-decoration: none;
}
.db-msg-name:hover { color: var(--teal); }
.db-msg-subj {
    color: var(--muted);
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.db-msg-date {
    color: var(--muted);
    font-size: 12px;
}

/* Badges */
.db-badge {
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
}
.db-badge-unread { background: #fee2e2; color: #ef4444; }
.db-badge-read { background: #f0fdf4; color: #16a34a; }

/* Responsive */
@media (max-width: 900px) {
    .db-stats { grid-template-columns: repeat(2, 1fr); }
    .db-bottom { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .db-stats { grid-template-columns: 1fr; }
    .db-top { flex-direction: column; align-items: flex-start; gap: 8px; }
}
</style>
@endsection
