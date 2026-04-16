@extends('layouts.app')

@section('title', 'Services - Jiva Birth and Beyond')

@section('content')



<x-page-banner
  title="Our Services"
  subtitle="Compassionate birth support, prenatal yoga, childbirth education, and nutrition guidance for your journey."
  image="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=1600&q=80"
  :breadcrumbs="[['label' => 'Services']]"
/>

<!-- Services Grid -->
<section>
  <div class="container">
    <div class="svc-full-grid">
      @foreach($services as $index => $service)
      <article class="svc-full-card reveal d{{ ($index % 6) + 1 }}">
        <div class="svc-full-thumb">
          <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}">
        </div>
        <div class="svc-full-body">
          <div class="svc-full-cat">{{ $service->subtitle }}</div>
          <h3>{{ $service->title }}</h3>
          <p>{{ $service->description }}</p>
          <div class="svc-full-footer">
            <span style="font-size:12px;color:var(--muted);">Wellness</span>
            <a href="{{ route('service.show', $service->id) }}" class="svc-learn-btn">
              Read More <span class="arrow">&rarr;</span>
            </a>
          </div>
        </div>
      </article>
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
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Ready for Compassionate Support?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Let's plan your empowered birth journey. Book a one-on-one consultation today to discover how we can guide you into motherhood.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+917483211870" class="btn-ghost">
             📞 Call Us
          </a>
          <a href="{{ route('contact') }}" class="btn-white-solid">
            Book Consultation &rarr;
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
