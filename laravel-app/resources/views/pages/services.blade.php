@extends('layouts.app')

@section('title', 'Services - Dental & Orthodontics')

@section('content')



<!-- Page Header (Hero Banner) -->
<div class="page-header" style="background: linear-gradient(135deg, rgba(10, 22, 40, 0.85) 0%, rgba(10, 22, 40, 0.7) 100%), url('{{ asset('images/blog_dental_hygiene.png') }}'); background-size: cover; background-position: center; min-height: 340px; display: flex; align-items: center;">
  <div class="page-header-body">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span class="breadcrumb-sep">&rsaquo;</span>
      <span class="breadcrumb-current">Services</span>
    </nav>
    <h1 style="text-shadow: 0 4px 12px rgba(0,0,0,0.3);">Our Dental Services</h1>
    <p style="color: rgba(255,255,255,0.9); font-size: 18px; max-width: 600px;">Comprehensive dental care from preventive check-ups to complete smile makeovers — all under one trusted roof.</p>
  </div>
</div>

<!-- Services Grid -->
<section>
  <div class="container">
    <div class="svc-full-grid">
      @foreach($services as $index => $service)
      <div class="svc-full-card reveal d{{ $index + 1 }}">
        <div class="svc-full-head">
          <div class="svc-full-ico" style="width: 50px; height: 50px; border-radius: 10px; overflow: hidden; background: var(--teal-pale);">
            <img src="{{ asset($service->icon) }}" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div>
            <h3>{{ $service->title }}</h3>
            <div class="sub">{{ $service->subtitle }}</div>
          </div>
        </div>
        <div class="svc-full-body">
          <p>{{ $service->description }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Modern CTA Section -->
<section class="cta-modern-section reveal">
  <div class="container">
    <div class="cta-modern-card">
      <!-- Subtle Decorative Circles -->
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
      
      <div class="cta-content" style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Not Sure Which Treatment?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Our doctors will guide you with a personalized consultation to find the best solution for your smile.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+917483211870" class="btn-ghost">
             📞 Call Us
          </a>
          <a href="{{ route('contact') }}" class="btn-white-solid">
            Book Appointment &rarr;
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
