@extends('layouts.admin')

@section('admin-content')
<div>
  <div class="adm-page-header">
    <div>
      <h1 class="adm-page-title">Analytics</h1>
      <p class="adm-page-sub">Last 30 days — powered by Google Analytics 4</p>
    </div>
    <a href="{{ route('admin.settings.edit') }}?tab=analytics" class="adm-btn adm-btn-cancel adm-btn-sm">Settings</a>
  </div>

  @if(!$configured)
    <div class="an-setup-card">
      <div class="an-setup-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 3v18h18"/><path d="M18 9l-5 5-3-3-5 5"/></svg>
      </div>
      <h2>Connect Google Analytics</h2>
      <p>To see your visitor stats here, you need to connect Google Analytics 4.</p>
      <div class="an-steps">
        <div class="an-step"><span class="an-step-n">1</span><span>Go to <a href="https://console.cloud.google.com" target="_blank">console.cloud.google.com</a> → Create a project</span></div>
        <div class="an-step"><span class="an-step-n">2</span><span>Enable the <strong>Google Analytics Data API</strong></span></div>
        <div class="an-step"><span class="an-step-n">3</span><span>Create a <strong>Service Account</strong> → Download the JSON key file</span></div>
        <div class="an-step"><span class="an-step-n">4</span><span>In Google Analytics → Admin → Property Access Management → add the service account email with <strong>Viewer</strong> role</span></div>
        <div class="an-step"><span class="an-step-n">5</span><span>In Google Analytics → Admin → Property Settings → copy your <strong>Property ID</strong> (a number like 123456789)</span></div>
        <div class="an-step"><span class="an-step-n">6</span><span>Go to <a href="{{ route('admin.settings.edit') }}">Settings</a> → Analytics tab → paste the Property ID and the JSON key contents</span></div>
      </div>
      <a href="{{ route('admin.settings.edit') }}" class="adm-btn adm-btn-primary" style="margin-top:10px;">Go to Settings</a>
    </div>

  @elseif(isset($error))
    <div class="adm-alert adm-alert-err">
      <strong>API Error:</strong> {{ $error }}<br>
      <small>Check that your Service Account JSON is correct and the service account has been granted Viewer access in Google Analytics.</small>
    </div>

  @else
    @php
      $s30 = $summary['30d'] ?? [];
      $s7  = $summary['7d']  ?? [];
    @endphp

    {{-- Summary cards --}}
    <div class="an-cards">
      <div class="an-card">
        <div class="an-card-label">Active Users (30d)</div>
        <div class="an-card-val">{{ number_format($s30['activeUsers'] ?? 0) }}</div>
        <div class="an-card-sub">Last 7 days: <strong>{{ number_format($s7['activeUsers'] ?? 0) }}</strong></div>
      </div>
      <div class="an-card">
        <div class="an-card-label">Sessions (30d)</div>
        <div class="an-card-val">{{ number_format($s30['sessions'] ?? 0) }}</div>
        <div class="an-card-sub">Last 7 days: <strong>{{ number_format($s7['sessions'] ?? 0) }}</strong></div>
      </div>
      <div class="an-card">
        <div class="an-card-label">Page Views (30d)</div>
        <div class="an-card-val">{{ number_format($s30['pageViews'] ?? 0) }}</div>
        <div class="an-card-sub">Last 7 days: <strong>{{ number_format($s7['pageViews'] ?? 0) }}</strong></div>
      </div>
      <div class="an-card">
        <div class="an-card-label">Bounce Rate (30d)</div>
        <div class="an-card-val">{{ $s30['bounceRate'] ?? 0 }}%</div>
        <div class="an-card-sub">Last 7 days: <strong>{{ $s7['bounceRate'] ?? 0 }}%</strong></div>
      </div>
    </div>

    <div class="an-grid">

      {{-- Top Pages --}}
      <div class="adm-card">
        <div class="adm-card-head">Top Pages <span class="an-badge">Last 30 days</span></div>
        <div class="adm-card-body" style="padding:0;">
          @if(empty($pages))
            <p style="padding:20px;color:var(--muted);font-size:13px;">No page data yet.</p>
          @else
            @php $maxViews = $pages[0]['views'] ?? 1; @endphp
            @foreach($pages as $p)
            <div class="an-row">
              <div class="an-row-info">
                <span class="an-page-path">{{ $p['page'] }}</span>
                <span class="an-row-count">{{ number_format($p['views']) }} views</span>
              </div>
              <div class="an-bar-wrap">
                <div class="an-bar" style="width:{{ round(($p['views']/$maxViews)*100) }}%"></div>
              </div>
            </div>
            @endforeach
          @endif
        </div>
      </div>

      {{-- Traffic Sources --}}
      <div class="adm-card">
        <div class="adm-card-head">Traffic Sources <span class="an-badge">Last 30 days</span></div>
        <div class="adm-card-body" style="padding:0;">
          @if(empty($sources))
            <p style="padding:20px;color:var(--muted);font-size:13px;">No source data yet.</p>
          @else
            @php $maxSrc = $sources[0]['sessions'] ?? 1; @endphp
            @foreach($sources as $s)
            <div class="an-row">
              <div class="an-row-info">
                <span class="an-source-label">
                  @php
                    $icons = [
                      'Organic Search' => '🔍',
                      'Direct'         => '🔗',
                      'Organic Social' => '📱',
                      'Email'          => '📧',
                      'Referral'       => '↗️',
                      'Paid Search'    => '💰',
                      'Display'        => '🖥️',
                    ];
                  @endphp
                  {{ $icons[$s['source']] ?? '🌐' }} {{ $s['source'] }}
                </span>
                <span class="an-row-count">{{ number_format($s['sessions']) }} sessions</span>
              </div>
              <div class="an-bar-wrap">
                <div class="an-bar an-bar-teal" style="width:{{ round(($s['sessions']/$maxSrc)*100) }}%"></div>
              </div>
            </div>
            @endforeach
          @endif
        </div>
      </div>

      {{-- Countries --}}
      <div class="adm-card">
        <div class="adm-card-head">Top Countries <span class="an-badge">Last 30 days</span></div>
        <div class="adm-card-body" style="padding:0;">
          @if(empty($countries))
            <p style="padding:20px;color:var(--muted);font-size:13px;">No country data yet.</p>
          @else
            @php $maxC = $countries[0]['sessions'] ?? 1; @endphp
            @foreach($countries as $c)
            <div class="an-row">
              <div class="an-row-info">
                <span style="font-size:13px;font-weight:500;color:#1f3b38;">{{ $c['country'] }}</span>
                <span class="an-row-count">{{ number_format($c['sessions']) }} sessions</span>
              </div>
              <div class="an-bar-wrap">
                <div class="an-bar an-bar-gold" style="width:{{ round(($c['sessions']/$maxC)*100) }}%"></div>
              </div>
            </div>
            @endforeach
          @endif
        </div>
      </div>

    </div>
  @endif
</div>

<style>
.adm-page-sub { font-size:13px;color:var(--muted);margin-top:2px; }

/* Setup card */
.an-setup-card {
  background:#fff;border:1px solid var(--border);border-radius:16px;
  padding:48px 40px;max-width:680px;text-align:center;
}
.an-setup-icon {
  width:64px;height:64px;border-radius:50%;background:#e8f5f4;
  display:flex;align-items:center;justify-content:center;margin:0 auto 20px;
}
.an-setup-icon svg { width:32px;height:32px;color:#2FA9A3; }
.an-setup-card h2 { font-family:'Playfair Display',serif;font-size:22px;color:#1f3b38;margin-bottom:10px; }
.an-setup-card p { font-size:14px;color:var(--muted);margin-bottom:24px; }
.an-steps { text-align:left;display:flex;flex-direction:column;gap:12px;margin-bottom:24px; }
.an-step { display:flex;align-items:flex-start;gap:12px;font-size:13.5px;color:#3d3d3d;line-height:1.5; }
.an-step-n {
  min-width:24px;height:24px;border-radius:50%;background:#2FA9A3;color:#fff;
  font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;
}
.an-step a { color:#2FA9A3;font-weight:600;text-decoration:none; }

/* Summary cards */
.an-cards { display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:24px; }
.an-card {
  background:#fff;border:1px solid var(--border);border-radius:14px;padding:22px 20px;
  transition:box-shadow .2s;
}
.an-card:hover { box-shadow:0 4px 20px rgba(0,0,0,0.07); }
.an-card-label { font-size:12px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.6px;margin-bottom:8px; }
.an-card-val { font-family:'Playfair Display',serif;font-size:32px;font-weight:700;color:#1f3b38;line-height:1; }
.an-card-sub { font-size:12px;color:var(--muted);margin-top:8px; }
.an-card-sub strong { color:#2FA9A3; }

/* Grid layout for tables */
.an-grid { display:grid;grid-template-columns:1fr 1fr;gap:24px; }
.an-grid .adm-card:first-child { grid-column:1/-1; }

/* Badge */
.an-badge {
  display:inline-block;font-size:11px;font-weight:600;
  background:#eef2f1;color:#475569;border-radius:999px;
  padding:3px 10px;margin-left:8px;vertical-align:middle;
}

/* Data rows */
.an-row { padding:11px 20px;border-bottom:1px solid #f5f2ef; }
.an-row:last-child { border-bottom:none; }
.an-row-info { display:flex;justify-content:space-between;align-items:center;margin-bottom:6px; }
.an-page-path { font-family:'Outfit',monospace;font-size:13px;font-weight:500;color:#1f3b38; }
.an-source-label { font-size:13px;font-weight:500;color:#1f3b38; }
.an-row-count { font-size:12px;color:var(--muted);font-weight:600; }
.an-bar-wrap { height:6px;background:#f0ece8;border-radius:999px;overflow:hidden; }
.an-bar { height:100%;border-radius:999px;background:linear-gradient(90deg,#4DB6AC,#2FA9A3);transition:width .4s; }
.an-bar-teal { background:linear-gradient(90deg,#2FA9A3,#1f8a85); }
.an-bar-gold { background:linear-gradient(90deg,#e6a800,#c98b00); }

@media(max-width:900px){
  .an-cards { grid-template-columns:1fr 1fr; }
  .an-grid  { grid-template-columns:1fr; }
  .an-grid .adm-card:first-child { grid-column:auto; }
}
@media(max-width:560px){
  .an-cards { grid-template-columns:1fr; }
}
</style>
@endsection
