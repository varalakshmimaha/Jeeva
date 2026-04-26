@extends('layouts.app')

@section('title', $service->title . ' - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  :title="$service->title"
  :subtitle="$service->subtitle ?? ''"
  :image="asset($service->icon)"
  :breadcrumbs="[['label' => 'Services', 'url' => route('services')], ['label' => $service->title]]"
/>

@php
  $benefitsList = [];
  if (!empty($service->benefits)) {
    $benefitsList = array_values(array_filter(array_map('trim', preg_split('/\r?\n/', $service->benefits))));
  }
  $servicePackages = is_array($service->packages) ? array_filter($service->packages, fn($p) => !empty($p['title']) || !empty($p['price'])) : [];
@endphp

<section class="svc-show-section">
  <div class="container">
    <div class="svc-detail-main reveal">

        <!-- Hero split: image left, content right -->
        <div class="svc-hero-split">
          @if($service->icon)
            <div class="svc-hero-image">
              <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}">
            </div>
          @endif
          <div class="svc-hero-text">
            @if($service->subtitle)
              <div class="svc-detail-cat">{{ $service->subtitle }}</div>
            @endif
            <h2 class="svc-detail-title">{{ $service->title }}</h2>
            <p class="svc-detail-short">{{ $service->description }}</p>
          </div>
        </div>

        <!-- Detailed content (paragraphs) -->
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
              @else
                <p>{{ $block }}</p>
              @endif
            @endforeach
          </div>
        @endif

        <!-- Benefits as bullets -->
        @if(!empty($benefitsList))
          <div class="svc-benefits reveal d2">
            <h3 class="svc-detail-heading">Benefits</h3>
            <ul class="svc-benefits-list">
              @foreach($benefitsList as $benefit)
                <li>{{ $benefit }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Packages (dynamic from admin) -->
        @if(!empty($servicePackages))
          <div class="svc-packages-section reveal d3">
            <h3 class="svc-detail-heading svc-detail-packages">Packages</h3>
            <div class="svc-packages-grid svc-packages-grid--count-{{ min(count($servicePackages), 3) }}">
              @foreach($servicePackages as $pkg)
                <div class="svc-pkg-wrap {{ !empty($pkg['featured']) ? 'is-featured-wrap' : '' }}">
                  @if(!empty($pkg['featured']))
                    <div class="svc-pkg-popular-badge">Most Popular</div>
                  @endif
                  <div class="svc-pkg-card {{ !empty($pkg['featured']) ? 'is-featured' : '' }}" data-pkg="{{ $pkg['title'] ?? '' }}" onclick="selectPackage(this)">
                    <div class="svc-pkg-header">
                      <h3>{{ $pkg['title'] ?? '' }}</h3>
                    </div>
                    @if(!empty($pkg['includes']) && is_array($pkg['includes']))
                      <div class="svc-pkg-includes-badge">WHAT IT INCLUDES</div>
                      <ul class="svc-pkg-list">
                        @foreach($pkg['includes'] as $line)
                          <li>{{ $line }}</li>
                        @endforeach
                      </ul>
                    @endif
                    @if(!empty($pkg['price']))
                      <div class="svc-pkg-divider"></div>
                      <div class="svc-pkg-price">{{ $pkg['price'] }}</div>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Actions -->
        <div class="svc-detail-cta">
          @if(!empty($servicePackages))
            <p class="pkg-select-hint" id="pkgHint">Please select a package above to continue</p>
            <button id="bookBtn" class="pkg-book-btn" disabled onclick="window.location.href='{{ route('contact') }}#book'">
              Book Consultation
            </button>
          @else
            <a href="{{ route('contact') }}#book" class="pkg-book-btn is-ready">Book Consultation</a>
          @endif
        </div>

        <!-- Other Services — below CTA -->
        @if($relatedServices->isNotEmpty())
        <div class="svc-other-section reveal">
          <div class="svc-other-header">
            <h3 class="svc-other-title">Other Services</h3>
            <a href="{{ route('services') }}" class="svc-other-viewall">View All &rarr;</a>
          </div>
          <div class="svc-other-grid">
            @foreach($relatedServices as $related)
            <a href="{{ route('service.show', $related->id) }}" class="svc-other-card">
              <div class="svc-other-thumb">
                @if($related->icon)
                  <img src="{{ asset($related->icon) }}" alt="{{ $related->title }}">
                @else
                  <div class="svc-other-thumb-placeholder"></div>
                @endif
              </div>
              <div class="svc-other-info">
                @if($related->subtitle)
                  <span class="svc-other-cat">{{ $related->subtitle }}</span>
                @endif
                <span class="svc-other-name">{{ $related->title }}</span>
              </div>
            </a>
            @endforeach
          </div>
        </div>
        @endif

    </div>
  </div>
</section>

<style>
  .svc-show-section { padding: 60px 0 80px; background: #fdfaf7; }
  .svc-show-section .container { padding: 0 4%; max-width: 1320px; margin: 0 auto; }

  /* Base font lock — all text inherits Outfit unless overridden */
  .svc-show-section,
  .svc-show-section p,
  .svc-show-section li,
  .svc-show-section span,
  .svc-show-section a,
  .svc-show-section div {
    font-family: 'Outfit', sans-serif;
  }
  .svc-show-section h2,
  .svc-show-section h3,
  .svc-show-section h4 {
    font-family: 'Playfair Display', serif;
  }

  .svc-detail-main {
    max-width: 1240px;
    margin: 0 auto;
    min-width: 0;
  }

  /* Hero split — image left, content right */
  .svc-hero-split {
    display: grid;
    grid-template-columns: 580px 1fr;
    gap: 48px;
    align-items: center;
    margin-bottom: 48px;
  }
  .svc-hero-text {
    display: flex;
    flex-direction: column;
  }
  .svc-detail-cat {
    display: inline-block;
    font-family: 'Outfit', sans-serif;
    font-size: 12px;
    font-weight: 700;
    color: #2FA9A3;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 10px;
  }
  .svc-detail-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3.2vw, 42px);
    color: #1f3b38;
    margin: 0 0 14px;
    line-height: 1.2;
    font-weight: 700;
  }
  .svc-detail-short {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    color: #4a5656;
    line-height: 1.8;
    margin: 0;
    padding-bottom: 0;
    border-bottom: none;
    text-align: justify;
  }
  .svc-hero-image {
    border-radius: 16px;
    overflow: hidden;
    width: 100%;
    aspect-ratio: 5 / 4;
    background: #f5f0ec;
  }
  .svc-hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .svc-detail-full-content .svc-detail-heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(22px, 2.2vw, 26px);
    color: #1f3b38;
    margin: 28px 0 14px;
    font-weight: 700;
  }
  .svc-detail-full-content p {
    font-family: 'Outfit', sans-serif;
    margin-bottom: 14px;
    line-height: 1.85;
    color: #3d3d3d;
    font-size: 16px;
  }
  .svc-detail-heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(22px, 2.2vw, 26px);
    color: #1f3b38;
    margin: 36px 0 16px;
    font-weight: 700;
  }

  /* Benefits */
  .svc-benefits { margin-top: 24px; }
  .svc-benefits-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0;
  }
  .svc-benefits-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    color: #3d3d3d;
    line-height: 1.7;
    padding: 10px 0;
    border-bottom: 1px solid #f0ebe6;
  }
  .svc-benefits-list li:last-child { border-bottom: none; }
  .svc-benefits-list li::before {
    content: '✓';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    min-width: 24px;
    border-radius: 50%;
    background: #e6f6f5;
    color: #2FA9A3;
    font-weight: 700;
    font-size: 13px;
    margin-top: 2px;
  }

  /* Packages */
  .svc-packages-section { margin: 40px auto 0; max-width: 860px; }
  .svc-detail-packages {
    margin-top: 0;
    padding-top: 10px;
    text-align: center;
  }
  .svc-packages-grid {
    display: grid;
    gap: 20px;
  }
  .svc-packages-grid--count-1 { grid-template-columns: minmax(0, 420px); }
  .svc-packages-grid--count-2 { grid-template-columns: 1fr 1fr; }
  .svc-packages-grid--count-3 { grid-template-columns: repeat(3, 1fr); }

  /* Wrapper sits in the grid cell — controls equal height */
  .svc-pkg-wrap {
    display: flex;
    flex-direction: column;
    position: relative;
  }
  .is-featured-wrap { padding-top: 18px; }

  /* Card fills its wrapper 100% — guarantees equal height */
  .svc-pkg-card {
    border: 2px solid #4DB6AC;
    border-radius: 18px;
    padding: 0 0 26px;
    background: #fff;
    display: flex;
    flex-direction: column;
    flex: 1;
    overflow: hidden;
    cursor: pointer;
    transition: box-shadow .25s, transform .25s;
    box-sizing: border-box;
  }
  .svc-pkg-card:hover {
    box-shadow: 0 16px 36px -12px rgba(77,182,172,0.28);
    transform: translateY(-3px);
  }
  .svc-pkg-card.is-selected {
    border-color: #2FA9A3;
    box-shadow: 0 0 0 4px rgba(47,169,163,0.22), 0 16px 36px -12px rgba(77,182,172,0.28);
  }
  .svc-pkg-card.is-selected .svc-pkg-header { background: #1f8a85; }
  .svc-pkg-card.is-featured {
    border-color: #e6a800;
    box-shadow: 0 8px 28px -8px rgba(230,168,0,0.22);
  }
  .svc-pkg-card.is-featured .svc-pkg-header { background: linear-gradient(135deg, #2FA9A3, #1f3b38); }
  .svc-pkg-popular-badge {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #e6a800, #c98b00);
    color: #fff;
    font-family: 'Outfit', sans-serif;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    padding: 5px 16px;
    border-radius: 999px;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(230,168,0,0.4);
    z-index: 2;
  }
  .svc-pkg-header {
    background: #4DB6AC;
    padding: 16px 22px;
    margin: 0;
  }
  .svc-pkg-header h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    letter-spacing: .3px;
  }
  .svc-pkg-includes-badge {
    background: #eef2f1;
    color: #555;
    font-family: 'Outfit', sans-serif;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 1.3px;
    text-align: center;
    padding: 6px 18px;
    border-radius: 6px;
    margin: 18px 22px 14px;
    align-self: center;
    width: fit-content;
  }
  .svc-pkg-list {
    list-style: none;
    padding: 0 22px;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
    flex: 1;
  }
  .svc-pkg-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    color: #3d3d3d;
    line-height: 1.65;
  }
  .svc-pkg-list li::before {
    content: '✓';
    color: #22a96b;
    font-size: 16px;
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 1px;
  }
  .svc-pkg-divider {
    border: none;
    margin: 16px 0 0;
    margin-top: auto;
  }
  .svc-pkg-price {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 700;
    color: #1f3b38;
    text-align: center;
    margin-top: 18px;
  }

  /* CTA */
  .svc-detail-cta {
    margin: 36px auto 0;
    max-width: 860px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
  }
  .pkg-select-hint {
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    color: #888;
    margin: 0;
  }
  .pkg-book-btn {
    display: inline-block;
    background: #cfcfcf;
    color: #fff !important;
    border: none;
    padding: 14px 42px;
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: .5px;
    text-transform: uppercase;
    border-radius: 999px;
    cursor: not-allowed;
    text-decoration: none;
    transition: background .25s, transform .25s, box-shadow .25s;
  }
  .pkg-book-btn.is-ready {
    background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%);
    cursor: pointer;
    box-shadow: 0 12px 28px -8px rgba(47,169,163,0.5);
  }
  .pkg-book-btn.is-ready:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 36px -10px rgba(47,169,163,0.6);
  }

  /* Other Services — full width below CTA */
  .svc-other-section {
    margin-top: 56px;
    padding-top: 40px;
  }
  .svc-other-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
  }
  .svc-other-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(22px, 2.2vw, 28px);
    font-weight: 700;
    color: #1f3b38;
    margin: 0;
  }
  .svc-other-viewall {
    font-family: 'Outfit', sans-serif;
    font-size: 13.5px;
    font-weight: 600;
    color: #2FA9A3;
    text-decoration: none;
    transition: color .18s;
  }
  .svc-other-viewall:hover { color: #1f8a85; }
  .svc-other-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 18px;
  }
  .svc-other-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #ede8e3;
    border-radius: 14px;
    overflow: hidden;
    text-decoration: none;
    transition: box-shadow .2s, transform .2s;
  }
  .svc-other-card:hover {
    box-shadow: 0 8px 28px rgba(47,169,163,0.14);
    transform: translateY(-3px);
  }
  .svc-other-thumb {
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: #f0ece6;
  }
  .svc-other-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .3s; }
  .svc-other-card:hover .svc-other-thumb img { transform: scale(1.04); }
  .svc-other-thumb-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, #e8f5f4, #d4ecea); }
  .svc-other-info {
    padding: 14px 14px 16px;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .svc-other-cat {
    font-family: 'Outfit', sans-serif;
    font-size: 10.5px;
    font-weight: 700;
    color: #4DB6AC;
    text-transform: uppercase;
    letter-spacing: .7px;
  }
  .svc-other-name {
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #1a1a1a;
    line-height: 1.4;
    transition: color .18s;
  }
  .svc-other-card:hover .svc-other-name { color: #2FA9A3; }

  @media (max-width: 980px) {
    .svc-packages-grid--count-3 { grid-template-columns: 1fr 1fr; }
    .svc-other-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
  }
  @media (max-width: 720px) {
    .svc-hero-split { grid-template-columns: 1fr; gap: 24px; }
    .svc-hero-image { aspect-ratio: 4 / 3; max-width: 520px; margin: 0 auto; }
    .svc-packages-grid--count-2,
    .svc-packages-grid--count-3 { grid-template-columns: 1fr; }
    .svc-benefits-list { gap: 0; }
    .is-featured-wrap { padding-top: 14px; }
  }
</style>

<script>
function selectPackage(card) {
  document.querySelectorAll('.svc-pkg-card').forEach(function (c) { c.classList.remove('is-selected'); });
  card.classList.add('is-selected');
  var btn = document.getElementById('bookBtn');
  var hint = document.getElementById('pkgHint');
  if (btn) {
    btn.disabled = false;
    btn.classList.add('is-ready');
  }
  if (hint) hint.textContent = 'Selected: ' + (card.dataset.pkg || 'Package');
}
</script>
@endsection
