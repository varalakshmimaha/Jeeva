<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Jiva Birth and Beyond</title>
    @php $faviconPath = \App\Models\SiteSetting::where('key','favicon_path')->value('value'); @endphp
    @if($faviconPath)
    <link rel="icon" href="{{ asset($faviconPath) }}" type="image/png">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ============================================================
           COMPLETE ADMIN RESET — No public site styles imported
           ============================================================ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:      #3d2b2b;
            --teal:      #4DB6AC;
            --teal-glow: rgba(77, 182, 172, 0.35);
            --teal-pale: rgba(77, 182, 172, 0.08);
            --muted:     #6b7280;
            --border:    #e5e7eb;
            --bg:        #f4f7fb;
            --white:     #ffffff;
            --font:      'Outfit', sans-serif;
            --serif:     'Playfair Display', serif;
        }

        html { height: 100%; }

        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--navy);
            min-height: 100vh;
            display: flex;
        }

        /* =================== SIDEBAR =================== */
        .adm-sidebar {
            width: 270px;
            min-width: 270px;
            background: #1e293b;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 4px 0 24px rgba(0,0,0,0.15);
        }
        .adm-sidebar::-webkit-scrollbar { width: 4px; }
        .adm-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }

        .adm-logo {
            padding: 28px 24px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .adm-logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal), #80cbc4);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(77,182,172,0.25);
        }
        .adm-logo-icon svg { width: 22px; height: 22px; }
        .adm-logo-text h2 {
            font-family: var(--serif);
            font-size: 17px;
            color: #ffffff;
            font-weight: 700;
            line-height: 1.2;
        }
        .adm-logo-text p {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            margin-top: 3px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .adm-nav { padding: 16px 12px; flex: 1; }
        .adm-nav-section-label {
            font-size: 10.5px;
            font-weight: 700;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
            letter-spacing: 1.4px;
            padding: 18px 14px 8px;
        }
        .adm-nav-section-label:first-child { padding-top: 4px; }

        .adm-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            border-radius: 10px;
            margin-bottom: 2px;
            transition: all 0.2s ease;
            position: relative;
        }
        .adm-nav-link:hover {
            color: rgba(255,255,255,0.9);
            background: rgba(255,255,255,0.06);
        }
        .adm-nav-link.is-active {
            color: #ffffff;
            background: linear-gradient(135deg, rgba(77,182,172,0.2), rgba(77,182,172,0.1));
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(77,182,172,0.12);
        }
        .adm-nav-link.is-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 3px;
            border-radius: 0 3px 3px 0;
            background: var(--teal);
        }
        .adm-nav-link .icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .adm-nav-link .icon svg { width: 17px; height: 17px; }
        .adm-nav-link:hover .icon {
            background: rgba(255,255,255,0.12);
        }
        .adm-nav-link.is-active .icon {
            background: rgba(77,182,172,0.25);
            color: var(--teal);
        }

        .adm-sidebar-foot {
            padding: 16px 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .adm-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            background: rgba(239,68,68,0.12);
            color: #f87171;
            border: none;
            border-radius: 10px;
            font-family: var(--font);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .adm-logout:hover { background: rgba(239,68,68,0.2); }

        /* =================== MAIN CONTENT =================== */
        .adm-main {
            margin-left: 270px;
            flex: 1;
            padding: 44px 40px;
            min-height: 100vh;
            width: calc(100% - 270px);
        }

        /* =================== UTILITY =================== */
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; }

        /* ============================================================
           SHARED ADMIN DESIGN SYSTEM
           ============================================================ */

        /* Page Header */
        .adm-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        .adm-page-title {
            font-family: var(--serif);
            font-size: 26px;
            color: var(--navy);
            margin: 0;
            line-height: 1.2;
        }
        .adm-page-sub {
            color: var(--muted);
            font-size: 13px;
            margin: 4px 0 0;
        }
        .adm-back {
            color: var(--teal);
            font-weight: 600;
            font-size: 14px;
        }
        .adm-back:hover { text-decoration: underline; }

        /* Buttons */
        .adm-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 22px;
            border-radius: 8px;
            font-family: var(--font);
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            line-height: 1.4;
        }
        .adm-btn-primary { background: var(--teal); color: #fff; }
        .adm-btn-primary:hover { background: #3d9e94; }
        .adm-btn-dark { background: var(--navy); color: #fff; }
        .adm-btn-dark:hover { opacity: 0.9; }
        .adm-btn-cancel { background: #f0f1f3; color: var(--navy); }
        .adm-btn-cancel:hover { background: #e4e5e9; }
        .adm-btn-danger { background: #fef2f2; color: #ef4444; border: 1px solid #fee2e2; }
        .adm-btn-danger:hover { background: #fee2e2; }
        .adm-btn-sm { padding: 7px 14px; font-size: 13px; }

        /* Alerts */
        .adm-alert {
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 22px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .adm-alert-ok { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
        .adm-alert-err { background: #fef2f2; color: #ef4444; border: 1px solid #fee2e2; }

        /* Cards */
        .adm-card {
            background: var(--white);
            border-radius: 10px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 22px;
        }
        .adm-card-head {
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 700;
            color: var(--navy);
            background: #f9fafb;
            border-bottom: 1px solid var(--border);
        }
        .adm-card-body { padding: 24px; }

        /* Tables */
        .adm-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .adm-table thead tr {
            background: #f9fafb;
            border-bottom: 1px solid var(--border);
        }
        .adm-table th {
            padding: 13px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .adm-table td {
            padding: 14px 20px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
            color: var(--navy);
        }
        .adm-table tbody tr:last-child td { border-bottom: none; }
        .adm-table tbody tr:hover { background: #fafbfc; }
        .adm-table .col-actions { text-align: right; white-space: nowrap; }
        .adm-table .col-center { text-align: center; }

        /* Table action buttons row */
        .adm-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            align-items: center;
        }
        .adm-actions form { display: inline; }

        /* Thumbnail in table */
        .adm-thumb {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            overflow: hidden;
            background: var(--teal-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .adm-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .adm-thumb-wide { width: 80px; height: 48px; border-radius: 6px; background: var(--navy); }
        .adm-thumb-round { border-radius: 50%; width: 44px; height: 44px; }

        /* Badges */
        .adm-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }
        .adm-badge-green { background: #f0fdf4; color: #16a34a; }
        .adm-badge-red { background: #fee2e2; color: #ef4444; }
        .adm-badge-amber { background: #fff8e7; color: #d97706; }
        .adm-badge-teal { background: rgba(77,182,172,0.12); color: var(--teal); }
        .adm-badge-blue { background: rgba(56,189,248,0.1); color: #0284c7; }

        /* Empty State */
        .adm-empty {
            padding: 60px 32px;
            text-align: center;
            background: var(--white);
            border: 1px dashed var(--border);
            border-radius: 10px;
        }
        .adm-empty-icon { font-size: 40px; margin-bottom: 14px; opacity: 0.6; }
        .adm-empty h3 { color: var(--navy); margin: 0 0 8px; font-size: 16px; }
        .adm-empty p { color: var(--muted); font-size: 14px; margin: 0 0 18px; }

        /* Form Layout */
        .adm-form-table {
            width: 100%;
            border-collapse: collapse;
        }
        .adm-form-table tr { border-bottom: 1px solid #f3f4f6; }
        .adm-form-table tr:last-child { border-bottom: none; }
        .adm-form-table .adm-fl {
            padding: 16px 14px 16px 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--navy);
            white-space: nowrap;
            width: 160px;
            vertical-align: middle;
        }
        .adm-form-table .adm-fi { padding: 12px 0; vertical-align: middle; }

        /* Inputs */
        .adm-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: var(--font);
            font-size: 14px;
            color: var(--navy);
            background: var(--white);
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .adm-input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px var(--teal-pale); }
        .adm-input::placeholder { color: #bbb; }
        textarea.adm-input { resize: vertical; min-height: 80px; }
        select.adm-input { cursor: pointer; }
        input[type="file"].adm-input { padding: 8px 12px; background: #f9fafb; cursor: pointer; }
        .adm-hint { font-size: 12px; color: #999; margin: 5px 0 0; }

        /* Two-column form row */
        .adm-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .adm-form-group { margin-bottom: 0; }
        .adm-form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 6px;
        }

        /* Toggle / Checkbox */
        .adm-check {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: var(--navy);
        }
        .adm-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--teal);
            cursor: pointer;
        }

        /* Form action row */
        .adm-form-actions {
            display: flex;
            gap: 12px;
            padding-top: 8px;
        }

        /* Image preview */
        .adm-img-preview {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            background: #f9fafb;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        .adm-img-preview img { max-width: 120px; height: auto; border-radius: 6px; }
        .adm-img-preview .adm-img-tag {
            font-size: 11px;
            color: var(--teal);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .adm-img-preview-round img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; }

        /* Detail view */
        .adm-detail-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .adm-detail-box {
            padding: 16px 18px;
            background: #f9fafb;
            border-radius: 8px;
            border: 1px solid #eee;
            color: var(--navy);
            line-height: 1.7;
            font-size: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .adm-main { padding: 24px 16px; }
            .adm-page-header { flex-direction: column; align-items: flex-start; gap: 14px; }
            .adm-form-grid { grid-template-columns: 1fr; }
            .adm-form-table, .adm-form-table tr, .adm-form-table td { display: block; width: 100%; }
            .adm-form-table .adm-fl { padding: 10px 0 2px; width: 100%; }
            .adm-form-table .adm-fi { padding: 2px 0 14px; }
            .adm-table { font-size: 13px; }
            .adm-table th, .adm-table td { padding: 10px 12px; }
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="adm-sidebar">
        <div class="adm-logo">
            <div class="adm-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <div class="adm-logo-text">
                <h2>Jiva Birth & Beyond</h2>
                <p>Admin Panel</p>
            </div>
        </div>

        <nav class="adm-nav">
            <div class="adm-nav-section-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}"
               class="adm-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg></span> Dashboard
            </a>

            <div class="adm-nav-section-label">Content</div>
            <a href="{{ route('admin.services.index') }}"
               class="adm-nav-link {{ request()->routeIs('admin.services.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></span> Services
            </a>
            <a href="{{ route('admin.banners.index') }}"
               class="adm-nav-link {{ request()->routeIs('admin.banners.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></span> Banners
            </a>
            <a href="{{ route('admin.blogs.index') }}"
               class="adm-nav-link {{ request()->routeIs('admin.blogs.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></span> Blogs
            </a>
            <a href="{{ route('admin.gallery.index') }}"
               class="adm-nav-link {{ request()->routeIs('admin.gallery.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></span> Gallery
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
               class="adm-nav-link {{ request()->routeIs('admin.testimonials.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></span> Testimonials
            </a>
            <a href="{{ route('admin.faqs.index') }}"
               class="adm-nav-link {{ request()->routeIs('admin.faqs.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></span> FAQs
            </a>

            <div class="adm-nav-section-label">System</div>
            <a href="{{ route('admin.messages.index') }}"
               class="adm-nav-link {{ request()->routeIs('admin.messages.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span> Messages
            </a>
            <a href="{{ route('admin.settings.edit') }}"
               class="adm-nav-link {{ request()->routeIs('admin.settings.*') ? 'is-active' : '' }}">
                <span class="icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></span> Settings
            </a>
        </nav>

        <div class="adm-sidebar-foot">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="adm-logout">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="adm-main">
        @yield('admin-content')
    </main>

</body>
</html>
