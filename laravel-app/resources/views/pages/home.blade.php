@extends('layouts.app')

@section('title', 'Home - Jiva Birth and Beyond')

@section('content')

<!-- Dynamic Hero Banner Section -->
<section id="home-banners-section" class="home-banners-section">
  <div class="banner-slider" id="bannerSlider">
    <div class="banner-slider-track">
      @if($banners->isNotEmpty())
        @foreach($banners as $index => $banner)
          <div class="banner-slide {{ $index === 0 ? 'is-active' : '' }}" style="background-image: url('{{ asset($banner->image) }}');">
            <div class="banner-slide-shell">
              <div class="banner-slide-content">
                <div class="banner-slide-eyebrow">Jiva Birth and Beyond</div>
                <h1 class="banner-slide-title">{{ $banner->title }}</h1>
                <p class="banner-slide-description">{{ $banner->description }}</p>
                @if($banner->button_text)
                  <a href="{{ $banner->button_link ?? route('contact') }}" class="banner-slide-button">{{ $banner->button_text }} <span>&rarr;</span></a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="banner-slide is-active" style="background-image: url('{{ asset('images/founder-sitting.jpeg') }}');">
          <div class="banner-slide-shell">
            <div class="banner-slide-content">
              <div class="banner-slide-eyebrow">Jiva Birth and Beyond</div>
              <h1 class="banner-slide-title">Empowering Your Birth Journey</h1>
              <p class="banner-slide-description">Compassionate birth doula support, prenatal yoga, and childbirth education for your journey into motherhood.</p>
              <a href="{{ route('contact') }}" class="banner-slide-button">Book Consultation <span>&rarr;</span></a>
            </div>
          </div>
        </div>
      @endif
    </div>

    @if($banners->count() > 1)
      <button class="banner-slider-control is-prev" id="bannerPrev" aria-label="Previous">&lsaquo;</button>
      <button class="banner-slider-control is-next" id="bannerNext" aria-label="Next">&rsaquo;</button>
      <div class="banner-slider-dots" id="bannerDots">
        @foreach($banners as $index => $banner)
          <button class="banner-dot {{ $index === 0 ? 'is-active' : '' }}" data-index="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
      </div>
    @endif
  </div>
</section>

<!-- About Us Section -->
<section class="about-us-section">
  <div class="container">
    <div class="about-wrapper about-wrapper--reversed">
      <div class="about-content-col reveal">
        <div class="section-header">
          <span class="section-label">About Us</span>
          <h2 class="section-title">Walking Alongside You</h2>
        </div>
        <div class="about-text-body">
          <p>I am Anu — a Birth Doula, Prenatal Yoga Instructor, Childbirth Educator, Nutritionist, and a mother of two. I believe every woman deserves to feel seen, heard, and supported throughout her pregnancy, birth, and postpartum journey. My intention is to create a calm, safe, and nurturing space where you feel empowered without judgment and guided without pressure.</p>
        </div>
        <a href="{{ route('about') }}" class="btn btn-primary">Read More About Me</a>
      </div>
      <div class="about-image-col reveal">
        <div class="about-circle-wrap">
          <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Anu - Birth Doula" class="about-circle-img">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us / Our Process Section -->
<section class="proc-section">
  <div class="proc-container">
    <h2 class="proc-heading">Our Journey Together</h2>

    <div class="proc-row">
      <!-- Step 1 -->
      <div class="proc-item reveal fade-up">
        <div class="proc-img-wrap">
          <div class="proc-img-outer">
            <div class="proc-img-inner">
              <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Consultation & Assessment">
            </div>
          </div>
          <span class="proc-badge">01</span>
        </div>
        <h3 class="proc-name">Consultation &amp; Assessment</h3>
        <p class="proc-text">Initial understanding of your needs, birth preferences, and a comprehensive discussion about your journey.</p>
      </div>

      <!-- Arrow 1 -->
      <div class="proc-arrow">
        <svg viewBox="0 0 80 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 12h65" stroke="#4DB6AC" stroke-width="2" stroke-dasharray="6 4"/>
          <path d="M60 4l14 8-14 8" stroke="#4DB6AC" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>

      <!-- Step 2 -->
      <div class="proc-item reveal fade-up" style="animation-delay:0.15s;">
        <div class="proc-img-wrap">
          <div class="proc-img-outer">
            <div class="proc-img-inner">
              <img src="{{ asset('images/founder-sitting.jpeg') }}" alt="Personalized Birth Plan">
            </div>
          </div>
          <span class="proc-badge">02</span>
        </div>
        <h3 class="proc-name">Personalized Birth Plan</h3>
        <p class="proc-text">Creating a tailored plan focusing on your comfort, choices, and desired birth experience.</p>
      </div>

      <!-- Arrow 2 -->
      <div class="proc-arrow">
        <svg viewBox="0 0 80 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 12h65" stroke="#4DB6AC" stroke-width="2" stroke-dasharray="6 4"/>
          <path d="M60 4l14 8-14 8" stroke="#4DB6AC" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>

      <!-- Step 3 -->
      <div class="proc-item reveal fade-up" style="animation-delay:0.3s;">
        <div class="proc-img-wrap">
          <div class="proc-img-outer">
            <div class="proc-img-inner">
              <img src="{{ asset('images/founder-casual.jpeg') }}" alt="Birth & Postpartum Support">
            </div>
          </div>
          <span class="proc-badge">03</span>
        </div>
        <h3 class="proc-name">Birth &amp; Postpartum Support</h3>
        <p class="proc-text">Continuous physical and emotional support during labor, delivery, recovery, and early parenthood.</p>
      </div>
    </div>
  </div>
</section>

<style>
/* ===== WHY CHOOSE US — Exact Reference Design ===== */
.proc-section {
  padding: 90px 5%;
  background: #ffffff;
}
.proc-container {
  max-width: 1140px;
  margin: 0 auto;
}
.proc-heading {
  text-align: center;
  font-family: 'Playfair Display', serif;
  font-size: clamp(30px, 4vw, 46px);
  font-weight: 700;
  color: #1a1a2e;
  margin-bottom: 70px;
}

/* Row: items + arrows in a single flex line */
.proc-row {
  display: flex;
  align-items: flex-start;
  justify-content: center;
  gap: 0;
}

/* Each step column */
.proc-item {
  flex: 0 0 280px;
  text-align: center;
  padding: 0 10px;
}

/* Dashed arrow between steps */
.proc-arrow {
  flex: 0 0 80px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding-top: 110px; /* vertically center with circles */
}
.proc-arrow svg {
  width: 80px;
  height: 24px;
}

/* Circle image container */
.proc-img-wrap {
  position: relative;
  width: 230px;
  height: 230px;
  margin: 0 auto 28px;
}

/* Outer ring */
.proc-img-outer {
  width: 230px;
  height: 230px;
  border-radius: 50%;
  border: 3px solid #4DB6AC;
  padding: 8px;
  background: transparent;
  position: relative;
}

/* Inner image circle */
.proc-img-inner {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  overflow: hidden;
  background: #f0f0f0;
}
.proc-img-inner img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.proc-item:hover .proc-img-inner img {
  transform: scale(1.08);
}

/* Number badge */
.proc-badge {
  position: absolute;
  top: 4px;
  right: 4px;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, #f5a623, #e8913a);
  color: #fff;
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 3px solid #ffffff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  z-index: 3;
}

/* Title */
.proc-name {
  font-family: 'Playfair Display', serif;
  font-size: 19px;
  font-weight: 700;
  color: #1a1a2e;
  margin-bottom: 12px;
  line-height: 1.3;
}

/* Description */
.proc-text {
  color: #6b7280;
  font-size: 14px;
  line-height: 1.75;
  max-width: 260px;
  margin: 0 auto;
}

/* ===== Responsive ===== */
@media (max-width: 960px) {
  .proc-arrow { display: none; }
  .proc-row {
    flex-wrap: wrap;
    gap: 50px;
    justify-content: center;
  }
  .proc-item { flex: 0 0 260px; }
}
@media (max-width: 600px) {
  .proc-section { padding: 60px 4%; }
  .proc-heading { margin-bottom: 40px; }
  .proc-row { flex-direction: column; align-items: center; gap: 45px; }
  .proc-item { flex: 0 0 100%; }
  .proc-img-wrap, .proc-img-outer { width: 200px; height: 200px; }
}
</style>

<!-- Book an Appointment Section -->
<section class="book-appointment-section" id="book-appointment">
  <div class="container">
    <div class="appointment-wrapper">
      <!-- Left: Form -->
      <div class="appointment-form-col reveal">
        <h2 class="appointment-title">Book consultation <span style="color: var(--teal);">today!</span></h2>
        <p class="appointment-subtitle">Scheduling your session is quick and easy&mdash;connect with Anu today and take the first step toward your empowered birth journey.</p>

        <form action="{{ route('contact') }}" method="GET" class="appointment-form">
          <div class="appointment-form-row">
            <div class="appointment-field">
              <input type="text" name="first_name" placeholder="First Name" required>
            </div>
            <div class="appointment-field">
              <input type="text" name="last_name" placeholder="Last Name">
            </div>
          </div>
          <div class="appointment-form-row">
            <div class="appointment-field">
              <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="appointment-field">
              <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
          </div>
          <div class="appointment-field">
            <select name="service">
              <option value="" disabled selected>Choose Services</option>
              @foreach($services as $service)
                <option value="{{ $service->title }}">{{ $service->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="appointment-field">
            <input type="date" name="preferred_date" min="{{ date('Y-m-d') }}">
          </div>
          <button type="submit" class="appointment-btn">Book A Consultation</button>
        </form>
      </div>

      <!-- Right: Image & Hours -->
      <div class="appointment-image-col reveal d2">
        <div class="appointment-image-box">
          <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Anu - Birth Doula & Wellness Expert">
        </div>
      </div>
    </div>
  </div>

  <style>
    .book-appointment-section {
      padding: 90px 6%;
      background: #ffffff;
    }
    .appointment-wrapper {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: stretch;
      max-width: 1240px;
      margin: 0 auto;
    }
    .appointment-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(32px, 4vw, 48px);
      font-weight: 700;
      color: var(--navy);
      line-height: 1.15;
      margin-bottom: 14px;
    }
    .appointment-subtitle {
      color: var(--muted);
      font-size: 15px;
      line-height: 1.7;
      margin-bottom: 32px;
    }
    .appointment-form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .appointment-form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .appointment-field input,
    .appointment-field select {
      width: 100%;
      padding: 14px 18px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      color: var(--text);
      background: #fff;
      transition: border-color 0.3s, box-shadow 0.3s;
      outline: none;
      box-sizing: border-box;
    }
    .appointment-field input:focus,
    .appointment-field select:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 3px rgba(77, 182, 172, 0.12);
    }
    .appointment-field input::placeholder {
      color: #a0a0a0;
    }
    .appointment-field select {
      color: #a0a0a0;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='%237a6060'%3E%3Cpath d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 16px center;
      padding-right: 40px;
    }
    .appointment-field select option:not(:first-child) {
      color: var(--text);
    }
    .appointment-btn {
      padding: 16px 32px;
      background: var(--grad-teal);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-family: 'Outfit', sans-serif;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 8px 24px rgba(77, 182, 172, 0.3);
      transition: all 0.3s;
      align-self: flex-start;
    }
    .appointment-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 32px rgba(77, 182, 172, 0.4);
    }
    .appointment-image-col {
      display: flex;
      flex-direction: column;
    }
    .appointment-image-box {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1);
      flex: 1;
    }
    .appointment-image-box img {
      width: 100%;
      height: 100%;
      display: block;
      object-fit: cover;
    }

    @media (max-width: 860px) {
      .appointment-wrapper {
        grid-template-columns: 1fr;
        gap: 32px;
      }
      .appointment-form-row {
        grid-template-columns: 1fr;
      }
      .appointment-image-col {
        order: -1;
      }
      .appointment-btn {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</section>

<!-- Services Section -->
<section class="services-section">
  <div class="container">
    <div class="section-header text-center">
      <span class="section-label">What We Offer</span>
      <h2 class="section-title">Our Services</h2>
      <p class="section-subtitle">From your first check-up to complete smile transformations — all under one trusted roof.</p>
    </div>

    <div class="svc-full-grid">
      @foreach($services->take(3) as $index => $service)
      <article class="svc-full-card reveal d{{ ($index % 6) + 1 }}">
        <div class="svc-full-thumb">
          <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}">
        </div>
        <div class="svc-full-body">
          <div class="svc-full-cat">{{ $service->subtitle }}</div>
          <h3>{{ $service->title }}</h3>
          <p>{{ $service->description }}</p>
          <div class="svc-full-footer" style="justify-content:center;">
            <a href="{{ route('service.show', $service->id) }}" class="svc-learn-btn">
              Explore
            </a>
          </div>
        </div>
      </article>
      @endforeach
    </div>

    <div class="services-cta">
      <a href="{{ route('services') }}" class="btn btn-primary btn-lg">View All Services &rarr;</a>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="home-testimonials-section">
  <div class="home-testimonials-overlay"></div>
  <div class="container" style="position: relative; z-index: 2;">
    <div class="home-testi-grid">
      <!-- Left Column -->
      <div class="home-testi-left reveal">
        <span class="home-testi-label"><i>&#9679;</i> Testimonial</span>
        <h2 class="home-testi-heading">The Best Customers<br>Says About Our Action</h2>
        <a href="{{ route('testimonials') }}" class="home-testi-readall">
          Read All Testimonials 
          <span class="home-testi-readall-icon">&nearr;</span>
        </a>
      </div>

      <!-- Center: Rating Card -->
      <div class="home-testi-rating-card reveal d1">
        <div class="home-testi-stars-top" style="display:none;"></div>
        <div class="home-testi-score">4.8</div>
        <div class="home-testi-score-stars" style="display: flex; justify-content: center; gap: 4px; margin-bottom: 24px; color: #123C51;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/><path d="M12 2v15.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="currentColor"/></svg>
        </div>
        <p class="home-testi-members">From 3k Members,</p>
        <p class="home-testi-reviewed">Reviewed by Google</p>
        <div class="home-testi-avatars">
          @foreach($testimonials->take(4) as $t)
            @if($t->image)
              <img src="{{ asset($t->image) }}" alt="{{ $t->name }}" class="home-testi-avatar">
            @else
              <span class="home-testi-avatar-placeholder">{{ strtoupper(substr($t->name, 0, 1)) }}</span>
            @endif
          @endforeach
          @if($testimonials->count() < 4)
            @for($i = 0; $i < 4 - $testimonials->count(); $i++)
              <span class="home-testi-avatar-placeholder" style="background:#fff;"><svg viewBox="0 0 24 24" width="24" height="24" fill="#a0a0a0"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg></span>
            @endfor
          @endif
          <span class="home-testi-avatar-placeholder home-testi-avatar-add" style="width: 36px; height: 36px; border: none; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-left:-8px; z-index: 10;">+</span>
        </div>
      </div>

      <!-- Right: Featured Review -->
      <div class="home-testi-review-card reveal d2">
        <span class="home-testi-quote-icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="#C1E8FF"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>
        </span>
        <div class="home-testi-review-stars" style="display: flex; gap: 4px; margin-bottom: 24px; color: #C1E8FF;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        @if($testimonials->count() > 0)
          <div class="home-testi-slider-container" style="position: relative; min-height: 220px;">
            <div class="home-testi-slider-track" id="testimonialSliderTrack">
              @foreach($testimonials as $index => $t)
                <div class="home-testi-slide" style="display: {{ $index === 0 ? 'block' : 'none' }}; opacity: {{ $index === 0 ? '1' : '0' }}; transition: opacity 0.5s ease-in-out; width: 100%;">
                  <p class="home-testi-review-text">"{{ Str::limit($t->message, 220) }}"</p>
                  <div class="home-testi-reviewer">
                    <div class="home-testi-reviewer-img-wrap">
                      @if($t->image)
                        <img src="{{ asset($t->image) }}" alt="{{ $t->name }}" class="home-testi-reviewer-img">
                      @else
                        <span class="home-testi-reviewer-placeholder">{{ strtoupper(substr($t->name, 0, 1)) }}</span>
                      @endif
                    </div>
                    <div>
                      <strong class="home-testi-reviewer-name">{{ $t->name }}</strong>
                      <span class="home-testi-reviewer-role">{{ $t->role }}</span>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            
            <div class="home-testi-dots" id="testimonialDots" style="position: absolute; bottom: 0px; right: 0px;">
              @if($testimonials->count() > 1)
                @foreach($testimonials as $index => $t)
                  <span class="home-testi-dot {{ $index === 0 ? 'active' : '' }}" onclick="goToTestiSlide({{ $index }})" style="cursor:pointer;"></span>
                @endforeach
              @endif
            </div>
          </div>
        @else
          <div class="home-testi-slider-container" style="position: relative;">
            <div class="home-testi-slide" style="display: block; opacity: 1;">
              <p class="home-testi-review-text">"Anu provided such compassionate guidance during my pregnancy. The prenatal yoga sessions kept me grounded, and her doula support during childbirth was incredibly empowering and peaceful."</p>
              <div class="home-testi-reviewer">
                <div class="home-testi-reviewer-img-wrap">
                  <span class="home-testi-reviewer-placeholder" style="background: url('https://images.unsplash.com/photo-1599566150163-29194dcaad36?auto=format&fit=crop&w=150&q=80') center/cover;"></span>
                </div>
                <div>
                  <strong class="home-testi-reviewer-name">Sarah Jenkins</strong>
                  <span class="home-testi-reviewer-role">New Mother</span>
                </div>
              </div>
            </div>
            <div class="home-testi-dots" style="position: absolute; bottom: 0px; right: 0px;">
              <span class="home-testi-dot active"></span>
            </div>
          </div>
        @endif
      </div>
      
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          const slides = document.querySelectorAll('.home-testi-slide');
          const dots = document.querySelectorAll('#testimonialDots .home-testi-dot');
          if(slides.length <= 1) return;
          
          let currentSlide = 0;
          let slideInterval;
          
          window.goToTestiSlide = function(index) {
              if (index === currentSlide) return;
              clearInterval(slideInterval);
              
              slides[currentSlide].style.opacity = 0;
              setTimeout(() => {
                  slides[currentSlide].style.display = 'none';
                  if(dots[currentSlide]) dots[currentSlide].classList.remove('active');
                  
                  currentSlide = index;
                  
                  slides[currentSlide].style.display = 'block';
                  if(dots[currentSlide]) dots[currentSlide].classList.add('active');
                  
                  // Force reflow for transition
                  void slides[currentSlide].offsetWidth; 
                  slides[currentSlide].style.opacity = 1;
                  
                  startSlideTimer();
              }, 300); // Wait for fade out
          }
          
          function startSlideTimer() {
              slideInterval = setInterval(() => {
                  let next = (currentSlide + 1) % slides.length;
                  window.goToTestiSlide(next);
              }, 5000);
          }
          
          startSlideTimer();
      });
      </script>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="home-faq-section">
  <div class="container">
    <div class="home-faq-grid">
      <!-- Left Column -->
      <div class="home-faq-left reveal">
        <span class="home-faq-label">FAQ's</span>
        <h2 class="home-faq-heading">Frequently Asked<br>Questions</h2>
        <div class="home-faq-image-wrap">
          <img src="{{ asset('images/founder-sitting.jpeg') }}" alt="Anu - Birth Doula" class="home-faq-image">
        </div>
        <div class="home-faq-touch">
          <a href="{{ route('contact') }}" class="home-faq-touch-btn">Get In Touch <span class="home-faq-touch-btn-icon">&rarr;</span></a>
          <span class="home-faq-touch-text">Have Any Question<br>on Your Minds?</span>
        </div>
      </div>

      <!-- Right: Accordion -->
      <div class="home-faq-right reveal d1">
        <div class="home-faq-item" data-faq>
          <button class="home-faq-question" type="button">
            <span>What is a birth doula and how can one help me?</span>
            <span class="home-faq-icon">+</span>
          </button>
          <div class="home-faq-answer">
            <p>A birth doula provides continuous physical, emotional, and informational support during pregnancy, labor, and the postpartum period. Anu helps you feel calm, informed, and empowered throughout your birthing journey.</p>
          </div>
        </div>

        <div class="home-faq-item" data-faq>
          <button class="home-faq-question" type="button">
            <span>When should I hire a birth doula?</span>
            <span class="home-faq-icon">+</span>
          </button>
          <div class="home-faq-answer">
            <p>Ideally, connect with your doula during the second trimester so there's enough time for prenatal sessions, birth planning, and building a trusting relationship before your due date.</p>
          </div>
        </div>

        <div class="home-faq-item" data-faq>
          <button class="home-faq-question" type="button">
            <span>Do you offer prenatal yoga and nutrition guidance?</span>
            <span class="home-faq-icon">+</span>
          </button>
          <div class="home-faq-answer">
            <p>Yes! Jiva Birth and Beyond offers prenatal yoga sessions and personalized nutrition consultations to support your physical and mental well-being throughout pregnancy.</p>
          </div>
        </div>

        <div class="home-faq-item" data-faq>
          <button class="home-faq-question" type="button">
            <span>Can I book a consultation before deciding?</span>
            <span class="home-faq-icon">+</span>
          </button>
          <div class="home-faq-answer">
            <p>Absolutely. We offer a free initial consultation where you can discuss your needs, ask questions, and understand how Anu can support your unique birth plan.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* ===== HOME TESTIMONIALS ===== */
.home-testimonials-section {
  padding: 100px 6%;
  background: #f9ebeb url('https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
  position: relative;
  overflow: hidden;
}
.home-testimonials-overlay {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(90, 62, 74, 0.85); /* Dark plum/rose overlay to let light pink accents pop */
}
.home-testi-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1.3fr;
  gap: 40px;
  align-items: center;
  max-width: 1240px;
  margin: 0 auto;
}
.home-testi-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
  border: none;
  font-size: 13px;
  font-weight: 600;
  padding: 8px 20px;
  border-radius: 30px;
  text-transform: uppercase;
  margin-bottom: 24px;
}
.home-testi-label i {
  color: #C1E8FF;
  font-style: normal;
  font-size: 14px;
}
.home-testi-heading {
  font-family: 'Outfit', sans-serif;
  font-size: clamp(32px, 4vw, 48px);
  color: #fff;
  line-height: 1.2;
  font-weight: 800;
  margin-bottom: 36px;
}
.home-testi-readall {
  display: inline-flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding: 10px 10px 10px 24px;
  border: none;
  border-radius: 40px;
  background: #fff;
  color: #123C51;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: transform 0.3s;
}
.home-testi-readall:hover {
  transform: translateY(-2px);
  background: #fff;
}
.home-testi-readall-icon {
  width: 38px;
  height: 38px;
  background: #C1E8FF;
  color: #123C51;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}

/* Rating Card */
.home-testi-rating-card {
  background: #C1E8FF;
  border-radius: 20px 80px 20px 80px;
  padding: 50px 30px;
  text-align: center;
  color: #123C51;
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
}
.home-testi-score {
  font-family: 'Outfit', sans-serif;
  font-size: 72px;
  font-weight: 900;
  line-height: 1;
  margin-bottom: 8px;
  color: #123C51;
}
.home-testi-score-stars {
  font-size: 20px;
  letter-spacing: 2px;
  color: #123C51;
  margin-bottom: 24px;
}
.home-testi-members {
  font-size: 15px;
  font-weight: 800;
  margin-bottom: 6px;
  color: #123C51;
}
.home-testi-reviewed {
  font-size: 14px;
  opacity: 0.8;
  margin-bottom: 24px;
  color: #123C51;
}
.home-testi-avatars {
  display: flex;
  justify-content: center;
  align-items: center;
}
.home-testi-avatar, .home-testi-avatar-placeholder {
  width: 44px; height: 44px;
  border-radius: 50%;
  border: 3px solid #C1E8FF;
  margin-left: -12px;
  object-fit: cover;
  background: #fff;
  color: #123C51;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
}
.home-testi-avatar:first-child, .home-testi-avatar-placeholder:first-child { margin-left: 0; }
.home-testi-avatar-add {
  font-size: 20px;
  color: #123C51;
}

/* Review Card */
.home-testi-review-card {
  border: none;
  background: transparent;
  padding: 20px 0;
  position: relative;
}
.home-testi-quote-icon {
  margin-bottom: 16px;
  display: block;
  fill: #C1E8FF;
}
.home-testi-review-stars {
  font-size: 18px;
  letter-spacing: 3px;
  color: #fff;
  margin-bottom: 24px;
}
.home-testi-review-stars svg path {
  fill: #C1E8FF !important;
}
.home-testi-review-text {
  color: rgba(255,255,255,0.9);
  font-size: 15px;
  line-height: 1.8;
  margin-bottom: 30px;
}
.home-testi-reviewer {
  display: flex;
  align-items: center;
  gap: 16px;
  padding-top: 10px;
}
.home-testi-reviewer-img-wrap {
  width: 56px; height: 56px;
  border-radius: 50%;
  padding: 0;
}
.home-testi-reviewer-img {
  width: 100%; height: 100%;
  border-radius: 50%;
  object-fit: cover;
}
.home-testi-reviewer-placeholder {
  width: 100%; height: 100%;
  border-radius: 50%;
  background: #C1E8FF;
  color: #123C51;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 20px;
}
.home-testi-reviewer-name {
  display: block;
  color: #fff;
  font-size: 17px;
  font-weight: 700;
  margin-bottom: 4px;
}
.home-testi-reviewer-role {
  display: block;
  color: rgba(255,255,255,0.7);
  font-size: 13px;
}
.home-testi-dots {
  display: flex;
  justify-content: center;
  gap: 8px;
  position: absolute;
  bottom: 0px;
  right: 0px;
}
.home-testi-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255,255,255,0.3);
  transition: all 0.3s ease;
}
.home-testi-dot.active {
  width: 24px;
  background: #C1E8FF;
  border-radius: 8px;
}

/* ===== HOME FAQ ===== */
.home-faq-section {
  padding: 90px 6%;
  background: linear-gradient(135deg, #f5d5d5 0%, #f0c4c4 100%);
}
.home-faq-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 60px;
  align-items: start;
  max-width: 1240px;
  margin: 0 auto;
}
.home-faq-label {
  display: inline-block;
  background: #fff;
  color: var(--teal);
  font-size: 13px;
  font-weight: 800;
  padding: 6px 20px;
  border-radius: 30px;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 16px;
}
.home-faq-heading {
  font-family: 'Playfair Display', serif;
  font-size: clamp(28px, 3.5vw, 42px);
  color: #3d2b2b;
  line-height: 1.2;
  margin-bottom: 40px;
}
.home-faq-image-wrap {
  width: 260px;
  height: 260px;
  border-radius: 50%;
  overflow: hidden;
  margin-bottom: 30px;
  position: relative;
  border: 4px solid #4DB6AC;
  box-shadow: 0 8px 30px rgba(77, 182, 172, 0.2);
}
.home-faq-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.home-faq-touch {
  display: flex;
  align-items: center;
  gap: 16px;
}
.home-faq-touch-btn {
  display: inline-block;
  padding: 12px 28px;
  background: var(--teal);
  color: #fff;
  border-radius: 30px;
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  transition: transform 0.3s, box-shadow 0.3s;
}
.home-faq-touch-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(77, 182, 172, 0.3);
}
.home-faq-touch-btn .home-faq-touch-btn-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  background: rgba(255,255,255,0.3);
  color: #fff;
  border-radius: 50%;
  margin-left: 8px;
}
.home-faq-touch-text {
  font-size: 14px;
  font-weight: 500;
  color: #5a3a3a;
  line-height: 1.5;
}

/* FAQ Accordion */
.home-faq-item {
  border: 1.5px solid rgba(77, 182, 172, 0.25);
  border-radius: 40px;
  margin-bottom: 20px;
  overflow: hidden;
  background: #ffffff;
  transition: background 0.3s, border-color 0.3s, box-shadow 0.3s;
}
.home-faq-item:hover {
  box-shadow: 0 4px 16px rgba(77, 182, 172, 0.1);
}
.home-faq-item.is-open {
  background: #ffffff;
  border-color: var(--teal);
  box-shadow: 0 6px 24px rgba(77, 182, 172, 0.15);
}
.home-faq-question {
  width: 100%;
  padding: 20px 28px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: none;
  border: none;
  cursor: pointer;
  font-family: 'Outfit', sans-serif;
  font-size: 17px;
  font-weight: 600;
  color: #3d2b2b;
  text-align: left;
}
.home-faq-icon {
  width: 36px; height: 36px;
  border-radius: 50%;
  background: rgba(77, 182, 172, 0.15);
  color: var(--teal);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  font-weight: 700;
  flex-shrink: 0;
  transition: transform 0.3s, background 0.3s, color 0.3s;
}
.home-faq-item.is-open .home-faq-icon {
  transform: rotate(45deg);
  background: var(--teal);
  color: #fff;
}
.home-faq-answer {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s ease, padding 0.3s ease;
}
.home-faq-answer p {
  padding: 0 28px 24px;
  margin: 0;
  color: #7a6060;
  font-size: 15px;
  line-height: 1.7;
}
.home-faq-item.is-open .home-faq-answer {
  max-height: 300px;
}

/* Responsive */
@media (max-width: 900px) {
  .home-testi-grid {
    grid-template-columns: 1fr;
    gap: 28px;
    text-align: center;
  }
  .home-testi-heading { font-size: 28px; }
  .home-testi-rating-card { max-width: 280px; margin: 0 auto; }
  .home-faq-grid {
    grid-template-columns: 1fr;
    gap: 36px;
  }
  .home-faq-left { text-align: center; }
  .home-faq-image-wrap { margin: 0 auto 28px; }
  .home-faq-touch { justify-content: center; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-faq]').forEach(item => {
    item.querySelector('.home-faq-question').addEventListener('click', () => {
      const wasOpen = item.classList.contains('is-open');
      document.querySelectorAll('[data-faq]').forEach(i => i.classList.remove('is-open'));
      if (!wasOpen) item.classList.add('is-open');
    });
  });
});
</script>

<!-- Modern CTA Section -->
<section class="cta-modern-section reveal">
  <div class="container">
    <div class="cta-modern-card">
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>

      <div class="cta-content" style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 52px); margin-bottom: 20px; color: white;">Ready to Begin Your Journey?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 700px; margin: 0 auto 32px; line-height: 1.8;">Connect with Anu today and take the first step toward a calm, confident, and empowered birth experience.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+917483211870" class="btn-ghost">
             ☎ Call Now
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
