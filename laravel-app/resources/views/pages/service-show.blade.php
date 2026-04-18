@extends('layouts.app')

@section('title', $service->title . ' - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  :title="$service->title"
  :subtitle="$service->subtitle ?? ''"
  :image="asset($service->icon)"
  :breadcrumbs="[['label' => 'Services', 'url' => route('services')], ['label' => $service->title]]"
/>

<!-- Service Detail - Full Width Stacked Layout -->
<section>
  <div class="container">
    <div class="svc-detail-page reveal">

      <!-- Big Image - Full Width -->
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
            <p class="svc-detail-packages-note">Personalized package details are shared during your consultation — reach out to discuss what best fits your journey.</p>
          @else
            <p>{{ $block }}</p>
          @endif
        @endforeach
      </div>
      @endif

      <!-- Actions -->
      <div style="margin-top: 36px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
        <a href="{{ route('services') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--teal); font-size: 14px; font-weight: 600; text-decoration: none;">&larr; Back to all services</a>
        <a href="{{ route('contact') }}" class="btn-white-solid" style="background: var(--teal); color: white; border: none; padding: 14px 36px; font-size: 15px; display: inline-block;">
          Book Consultation &rarr;
        </a>
      </div>

      <style>
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
        .svc-detail-full-content .svc-detail-packages-note {
          color: #6b7280;
          font-style: italic;
        }
        .svc-detail-full-content p {
          margin-bottom: 14px;
          line-height: 1.8;
          color: #3d3d3d;
        }
      </style>

    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-modern-section reveal">
  <div class="container">
    <div class="cta-modern-card">
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>

      <div class="cta-content" style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Interested in {{ $service->title }}?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Book a consultation and get personalized guidance for your birth journey.</p>
        <a href="{{ route('contact') }}" class="btn-white-solid">
          Book Consultation &rarr;
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
