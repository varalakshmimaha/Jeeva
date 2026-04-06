@extends('layouts.app')

@section('title', 'Home - Premium Dental & Orthodontics')

@section('content')

<!-- Dynamic Hero Banner Section -->
<section id="home-banners-section" class="home-banners-section">
  <div id="dental-banners" class="banner-container">
    @if($banners->isNotEmpty())
        @foreach($banners as $index => $banner)
            <div class="banner-slide @if($index === 0) active @endif" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.2)), url('{{ asset($banner->image) }}');">
                <div class="banner-content">
                    <h2 class="banner-title reveal">{{ $banner->title }}</h2>
                    <p class="banner-desc reveal">{{ $banner->description }}</p>
                    <div class="banner-btns reveal">
                        <a href="{{ route('services') }}" class="btn-primary">View Services &rarr;</a>
                        <a href="{{ route('contact') }}" class="btn-secondary">Book Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="banner-slide active" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url('{{ asset('images/dentist_checking_patient.png') }}');">
            <div class="banner-content">
                <h2 class="banner-title">Premium Dental Care</h2>
                <p class="banner-desc">Experience world-class treatment in the heart of Bangalore.</p>
                <a href="{{ route('services') }}" class="btn-primary">Our Services</a>
            </div>
        </div>
    @endif
  </div>
</section>

<!-- About Us Section -->
<section class="about-us-section">
  <div class="container">
    <div class="about-wrapper">
      <div class="about-image-col reveal">
        <div class="about-image-box">
          <div class="image-frame">
            <img src="{{ asset('images/dentist_checking_patient.png') }}" alt="Specialist Dentist checking patient" class="about-image" style="border-radius:12px;box-shadow:0 12px 40px rgba(0,0,0,0.15);width:100%;height:auto;object-fit:cover;border:1px solid rgba(255,255,255,0.1);">
          </div>
          <div class="about-badge">
            <span class="badge-text">15+ Years</span>
            <span class="badge-label">of Excellence</span>
          </div>
        </div>
      </div>
      <div class="about-content-col reveal">
        <div class="section-header">
          <span class="section-label">About Western Dental</span>
          <h2 class="section-title">Leading Dental Care Excellence</h2>
        </div>
        <p class="about-intro">At Western Dental & Orthodontics, we believe every smile tells a story. Our mission is to create beautiful, healthy smiles that last a lifetime.</p>
        
        <div class="about-highlights">
          <div class="highlight-item">
            <div class="highlight-icon">
              <img src="{{ asset('images/dentist_checking_patient.png') }}" class="highlight-icon-img" alt="Award trophy clinical icon">
              <div class="highlight-icon-overlay"></div>
            </div>
            <div class="highlight-text">
              <h4>Award-Winning Clinic</h4>
              <p>Recognized for excellence in dental care and patient satisfaction</p>
            </div>
          </div>
          <div class="highlight-item">
            <div class="highlight-icon">
              <img src="{{ asset('images/blog_braces.png') }}" class="highlight-icon-img" alt="Expert Specialist portrait">
              <div class="highlight-icon-overlay"></div>
            </div>
            <div class="highlight-text">
              <h4>Expert Specialists</h4>
              <p>Highly qualified and certified dental professionals</p>
            </div>
          </div>
          <div class="highlight-item">
            <div class="highlight-icon">
              <img src="{{ asset('images/blog_root_canal.png') }}" class="highlight-icon-img" alt="Advanced dental technology icon">
              <div class="highlight-icon-overlay"></div>
            </div>
            <div class="highlight-text">
              <h4>Latest Technology</h4>
              <p>State-of-the-art equipment for precise diagnosis and treatment</p>
            </div>
          </div>
        </div>
        
        <a href="{{ route('contact') }}" class="btn btn-primary">Schedule Your Visit</a>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-section">
  <div class="container">
    <div class="section-header text-center">
      <span class="section-label">Why Choose Us</span>
      <h2 class="section-title">Dentistry Built on Trust</h2>
    </div>

    <div class="features-grid-4">
      <!-- Card 1: Painless -->
      <div class="feature-card-v2 feature-card-painless reveal fade-up">
        <div class="feature-icon-v2">
          <img src="{{ asset('images/dentist_checking_patient.png') }}" class="feature-icon-img-v2" alt="Painless Treatment Photo">
          <div class="feature-icon-overlay-v2"></div>
        </div>
        <h3 class="feature-title">Painless Treatments</h3>
        <p class="feature-desc">Modern anaesthetic techniques for a completely comfortable, anxiety-free experience</p>
      </div>

      <!-- Card 2: Pricing -->
      <div class="feature-card-v2 feature-card-pricing reveal fade-up">
        <div class="feature-icon-v2">
          <img src="{{ asset('images/blog_dental_hygiene.png') }}" class="feature-icon-img-v2" alt="Healthy Smile Photo">
          <div class="feature-icon-overlay-v2"></div>
        </div>
        <h3 class="feature-title">Transparent Pricing</h3>
        <p class="feature-desc">No hidden charges. Clear, upfront costs so you can make informed decisions</p>
      </div>

      <!-- Card 3: Doctors -->
      <div class="feature-card-v2 feature-card-doctors reveal fade-up">
        <div class="feature-icon-v2">
          <img src="{{ asset('images/blog_braces.png') }}" class="feature-icon-img-v2" alt="Our Expert Doctor">
          <div class="feature-icon-overlay-v2"></div>
        </div>
        <h3 class="feature-title">Expert Doctors</h3>
        <p class="feature-desc">Led by specialists with 15+ years of combined dental expertise</p>
      </div>

      <!-- Card 4: Equipment -->
      <div class="feature-card-v2 feature-card-equipment reveal fade-up">
        <div class="feature-icon-v2">
          <img src="{{ asset('images/blog_implants.png') }}" class="feature-icon-img-v2" alt="Modern Medical Tech Photo">
          <div class="feature-icon-overlay-v2"></div>
        </div>
        <h3 class="feature-title">Modern Equipment</h3>
        <p class="feature-desc">Digital X-rays, advanced sterilisation, and cutting-edge technology</p>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section class="services-section">
  <div class="container">
    <div class="section-header text-center">
      <span class="section-label">What We Offer</span>
      <h2 class="section-title">Comprehensive Dental Services</h2>
      <p class="section-subtitle">From your first check-up to complete smile transformations — all under one trusted roof.</p>
    </div>

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
            <span style="font-size:12px;color:var(--muted);">Dental Care</span>
            <a href="{{ route('service.show', $service->id) }}" class="svc-learn-btn">
              Read More <span class="arrow">&rarr;</span>
            </a>
          </div>
        </div>
      </article>
      @endforeach
    </div>

    <div class="services-cta">
      <a href="{{ route('services') }}" class="btn btn-primary btn-lg">View All Services →</a>
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
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 52px); margin-bottom: 20px; color: white;">Ready to Transform Your Smile?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 700px; margin: 0 auto 32px; line-height: 1.8;">Schedule your consultation with our expert team today and start your journey to a healthier, more beautiful smile.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+917483211870" class="btn-ghost">
             ☎ Call Now
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
