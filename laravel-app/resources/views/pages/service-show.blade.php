@extends('layouts.app')

@section('title', $service->title . ' - Dental & Orthodontics')

@section('content')

<!-- Page Header -->
<div class="page-header" style="background: linear-gradient(135deg, rgba(10, 22, 40, 0.85) 0%, rgba(10, 22, 40, 0.7) 100%), url('{{ asset($service->icon) }}'); background-size: cover; background-position: center; min-height: 340px; display: flex; align-items: center;">
  <div class="page-header-body">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span class="breadcrumb-sep">&rsaquo;</span>
      <a href="{{ route('services') }}">Services</a>
      <span class="breadcrumb-sep">&rsaquo;</span>
      <span class="breadcrumb-current">{{ $service->title }}</span>
    </nav>
    <h1 style="text-shadow: 0 4px 12px rgba(0,0,0,0.3);">{{ $service->title }}</h1>
    <p style="color: rgba(255,255,255,0.9); font-size: 18px; max-width: 600px;">{{ $service->subtitle }}</p>
  </div>
</div>

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
        {!! nl2br(e($service->content)) !!}
      </div>
      @endif

      <!-- Actions -->
      <div style="margin-top: 36px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
        <a href="{{ route('services') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--teal); font-size: 14px; font-weight: 600; text-decoration: none;">&larr; Back to all services</a>
        <a href="{{ route('contact') }}" class="btn-white-solid" style="background: var(--teal); color: white; border: none; padding: 14px 36px; font-size: 15px; display: inline-block;">
          Book Appointment &rarr;
        </a>
      </div>

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
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Book a consultation and get personalized guidance from our expert dental team.</p>
        <a href="{{ route('contact') }}" class="btn-white-solid">
          Book Appointment &rarr;
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
