@extends('layouts.app')

@section('title', $service->title . ' - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  :title="$service->title"
  :subtitle="$service->subtitle ?? ''"
  :image="asset($service->icon)"
  :breadcrumbs="[['label' => 'Services', 'url' => route('services')], ['label' => $service->title]]"
/>

<!-- Service Detail - Two Column Layout -->
<section>
  <div class="container">
    <div class="svc-detail-layout">

      <!-- Main Content -->
      <div class="svc-detail-main reveal">

        <!-- Big Image -->
        <div class="svc-detail-image-full">
          @if($service->icon)
            <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}">
          @endif
        </div>

        <!-- Category + Title -->
        <div class="svc-detail-cat">{{ $service->subtitle }}</div>
        <h2 class="svc-detail-title">{{ $service->title }}</h2>

        <!-- Short Description -->
        <p class="svc-detail-short">{{ $service->description }}</p>

        <!-- Full Detailed Content -->
        @if($service->content)
        <div class="svc-detail-full-content reveal d1">
          @php
            $blocks = preg_split('/\n\s*\n/', trim($service->content));
          @endphp
          @foreach($blocks as $block)
            @php $block = trim($block); @endphp
            @if($block === '') @continue @endif
            @if(\Illuminate\Support\Str::endsWith($block, '?') && strlen($block) < 100)
              <h3 class="svc-detail-heading">{{ $block }}</h3>
            @elseif(strtolower($block) === 'packages')
              <h3 class="svc-detail-heading svc-detail-packages">Packages</h3>
            @else
              <p>{{ $block }}</p>
            @endif
          @endforeach
        </div>
        @endif

        <!-- Doula Packages -->
        @if(str_contains(strtolower($service->title), 'birth doula') || str_contains(strtolower($service->title), 'doula'))
        <div class="doula-packages-section">
          <div class="doula-packages-grid">

            <!-- Complete Doula Package -->
            <div class="doula-pkg-card" data-pkg="Complete Doula Package" onclick="selectPackage(this)">
              <div class="doula-pkg-header">
                <h3>Complete Doula Package</h3>
              </div>
              <div class="doula-pkg-includes-badge">WHAT IT INCLUDES</div>
              <ul class="doula-pkg-list">
                <li>2 Prenatal Meetings to discuss what you want to have for your birth experience, discuss various pain management techniques as well as discussing the physiology of birth and what you can expect of the experience based on what your birth setting will be.</li>
                <li>Backup Doula Guarantee</li>
                <li>24/7 on call support from week 37</li>
                <li>Complete support throughout your labour and delivery up to approximately 2 hours after birth</li>
                <li>1 Postnatal follow up to go over your birth details and ensure you and baby are doing well</li>
              </ul>
              <div class="doula-pkg-divider"></div>
              <div class="doula-pkg-price">$1850</div>
            </div>

            <!-- Basic Doula Package -->
            <div class="doula-pkg-card" data-pkg="Basic Doula Package" onclick="selectPackage(this)">
              <div class="doula-pkg-header">
                <h3>Basic Doula Package</h3>
              </div>
              <div class="doula-pkg-includes-badge">WHAT IT INCLUDES</div>
              <ul class="doula-pkg-list">
                <li>1 Prenatal Meeting to discuss your birth, birth plan and various pain management techniques.</li>
                <li>Backup Doula Guarantee</li>
                <li>24/7 on call support from week 38</li>
                <li>Complete support throughout your labour and delivery up to approximately 2 hours after birth</li>
                <li>1 Postnatal follow up to go over your birth details and ensure you and baby are doing well</li>
              </ul>
              <div class="doula-pkg-divider"></div>
              <div class="doula-pkg-price">$1750</div>
            </div>

          </div>
        </div>
        @endif

        <!-- Actions -->
        <div style="margin-top: 36px; display: flex; flex-direction: column; align-items: center; gap: 10px;">
          <p class="pkg-select-hint" id="pkgHint">Please select a package above to continue</p>
          <button id="bookBtn" class="btn-white-solid pkg-book-btn" disabled onclick="window.location.href='{{ route('contact') }}#book'">
            Book Consultation
          </button>
        </div>

      </div>

      <!-- Sidebar: Related Services -->
      <aside class="svc-detail-sidebar">
        <div class="svc-related-box">
          <h3 class="svc-related-title">Other Services</h3>
          @forelse($relatedServices as $related)
          <a href="{{ route('service.show', $related->id) }}" class="svc-related-item">
            @if($related->icon)
            <div class="svc-related-thumb">
              <img src="{{ asset($related->icon) }}" alt="{{ $related->title }}">
            </div>
            @endif
            <div class="svc-related-info">
              @if($related->subtitle)
                <span class="svc-related-cat">{{ $related->subtitle }}</span>
              @endif
              <span class="svc-related-name">{{ $related->title }}</span>
            </div>
          </a>
          @empty
          <p style="color:#999;font-size:14px;">No other services available.</p>
          @endforelse
        </div>
      </aside>

    </div>
  </div>
</section>

<style>
  /* Two-column layout */
  .svc-detail-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 20px;
    align-items: start;
    padding: 40px 0 60px;
  }
  .svc-detail-main {
    min-width: 0;
  }

  /* Related Services Sidebar */
  .svc-detail-sidebar {
    position: sticky;
    top: 100px;
  }
  .svc-related-box {
    background: #fff;
    border: 1px solid #ede8e3;
    border-radius: 12px;
    padding: 0;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
  }
  .svc-related-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    padding: 20px 18px 14px;
    border-bottom: 2px solid #e5e5e5;
  }
  .svc-related-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 18px;
    border-bottom: 1px solid #f2eeeb;
    text-decoration: none;
  }
  .svc-related-item:last-child { border-bottom: none; padding-bottom: 0; }
  .svc-related-item:hover .svc-related-name { color: #4DB6AC; }
  .svc-related-thumb {
    width: 72px;
    height: 72px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
    background: #f5f0ec;
  }
  .svc-related-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .svc-related-info {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 5px;
    padding-top: 2px;
  }
  .svc-related-cat {
    font-family: 'Outfit', sans-serif;
    font-size: 12px;
    font-weight: 600;
    color: #4DB6AC;
  }
  .svc-related-name {
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #1a1a1a;
    line-height: 1.4;
    transition: color 0.2s;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }


  /* Doula Packages */
  .doula-packages-section { margin: 48px 0 12px; }
  .doula-packages-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
  }
  .doula-pkg-card {
    border: 2px solid #4DB6AC;
    border-radius: 18px;
    padding: 0 0 28px;
    background: #fff;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    cursor: pointer;
    transition: box-shadow 0.2s, transform 0.2s;
  }
  .doula-pkg-card:hover {
    box-shadow: 0 8px 28px rgba(77,182,172,0.2);
    transform: translateY(-2px);
  }
  .doula-pkg-card.is-selected {
    border-color: #2FA9A3;
    box-shadow: 0 0 0 4px rgba(47,169,163,0.2), 0 8px 28px rgba(77,182,172,0.18);
  }
  .doula-pkg-card.is-selected .doula-pkg-header { background: #1f8a85; }
  .pkg-select-hint {
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    color: #999;
    margin: 0;
  }
  .pkg-book-btn {
    background: #ccc !important;
    color: #fff !important;
    border: none !important;
    padding: 14px 48px;
    font-size: 16px;
    cursor: not-allowed;
    border-radius: 8px;
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    transition: background 0.2s;
  }
  .pkg-book-btn.is-ready {
    background: var(--teal) !important;
    cursor: pointer !important;
  }
  .doula-pkg-header {
    background: #4DB6AC;
    border-radius: 14px 14px 0 0;
    padding: 16px 24px;
    margin: 0;
  }
  .doula-pkg-header h3 {
    font-family: 'Outfit', sans-serif;
    font-style: normal;
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    letter-spacing: 0.3px;
  }
  .doula-pkg-includes-badge {
    background: #e8e8e8;
    color: #555;
    font-family: 'Outfit', sans-serif;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-align: center;
    padding: 8px 20px;
    border-radius: 6px;
    margin: 20px 24px 16px;
    align-self: center;
    width: fit-content;
  }
  .doula-pkg-list {
    list-style: none;
    padding: 0 24px;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
    flex: 1;
  }
  .doula-pkg-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    color: #3d3d3d;
    line-height: 1.6;
  }
  .doula-pkg-list li::before {
    content: '✓';
    color: #22a96b;
    font-size: 18px;
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 1px;
  }
  .doula-pkg-divider {
    border: none;
    border-top: 1px solid #ccc;
    margin: 24px 24px 0;
    position: relative;
  }
  .doula-pkg-divider::after {
    content: '〜〜〜';
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    background: #fff;
    padding: 0 8px;
    font-size: 12px;
    color: #aaa;
    letter-spacing: 2px;
  }
  .doula-pkg-price {
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    font-weight: 700;
    color: #1f3b38;
    text-align: center;
    margin-top: 20px;
  }
  .svc-detail-full-content .svc-detail-heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(22px, 2.4vw, 28px);
    color: #1f3b38;
    margin: 28px 0 14px;
    font-weight: 700;
  }
  .svc-detail-full-content .svc-detail-packages {
    margin-top: 36px;
    border-top: 1px solid rgba(77,182,172,0.2);
    padding-top: 22px;
  }
  .svc-detail-full-content p {
    margin-bottom: 14px;
    line-height: 1.8;
    color: #3d3d3d;
  }

  @media (max-width: 900px) {
    .svc-detail-layout {
      grid-template-columns: 1fr;
    }
    .svc-detail-sidebar {
      position: static;
    }
    .doula-packages-grid { grid-template-columns: 1fr; }
  }
</style>

<script>
function selectPackage(card) {
  document.querySelectorAll('.doula-pkg-card').forEach(function(c) {
    c.classList.remove('is-selected');
  });
  card.classList.add('is-selected');
  var btn = document.getElementById('bookBtn');
  var hint = document.getElementById('pkgHint');
  btn.disabled = false;
  btn.classList.add('is-ready');
  if (hint) hint.textContent = 'Selected: ' + card.dataset.pkg;
}
</script>
@endsection
