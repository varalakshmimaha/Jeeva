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
<!-- Modern Journey Together Section -->
<section class="home-journey-section">
  <div class="container">
    <div class="home-journey-header reveal">
      <span class="journey-eyebrow">Our Process</span>
      <h2 class="journey-main-title">Our Journey Together</h2>
      <p class="journey-subtitle">A guided, compassionate approach to your pregnancy, birth, and early parenthood.</p>
    </div>

    <div class="home-journey-grid">
      <!-- Step 1 -->
      <div class="home-journey-card reveal d1">
        <div class="journey-card-img">
          <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Consultation">
          <div class="journey-card-num">01</div>
        </div>
        <div class="journey-card-content">
          <h3 class="journey-card-title">Consultation & Assessment</h3>
          <p class="journey-card-text">Initial understanding of your needs, birth preferences, and a comprehensive discussion about your pregnancy journey.</p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="home-journey-card reveal d2">
        <div class="journey-card-img">
          <img src="{{ asset('images/founder-sitting.jpeg') }}" alt="Personalized Plan">
          <div class="journey-card-num">02</div>
        </div>
        <div class="journey-card-content">
          <h3 class="journey-card-title">Personalized Birth Plan</h3>
          <p class="journey-card-text">Creating a thoughtfully tailored plan focusing on your absolute comfort, personal choices, and desired birth experience.</p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="home-journey-card reveal d3">
        <div class="journey-card-img">
          <img src="{{ asset('images/founder-casual.jpeg') }}" alt="Birth Support">
          <div class="journey-card-num">03</div>
        </div>
        <div class="journey-card-content">
          <h3 class="journey-card-title">Birth & Postpartum</h3>
          <p class="journey-card-text">Continuous and unwavering physical and emotional support throughout labor, delivery, and early parenthood.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* Modern Journey Section */
.home-journey-section {
  padding: 110px 6%;
  background: #fdfdfc;
  position: relative;
  overflow: hidden;
}
.home-journey-header {
  text-align: center;
  margin-bottom: 70px;
}
.journey-eyebrow {
  display: inline-block;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #4DB6AC;
  margin-bottom: 12px;
}
.journey-main-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(34px, 4.5vw, 48px);
  color: #2b2b2b;
  margin-bottom: 20px;
  line-height: 1.2;
}
.journey-subtitle {
  color: #6b7280;
  font-size: 17px;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

.home-journey-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
  max-width: 1200px;
  margin: 0 auto;
  align-items: start;
}
.home-journey-card {
  background: #ffffff;
  border-radius: 20px;
  box-shadow: 0 10px 35px rgba(0,0,0,0.04);
  transition: all 0.4s ease;
  height: 100%;
}
.home-journey-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 45px rgba(0,0,0,0.08);
}
@media (min-width: 900px) {
  .home-journey-card:nth-child(2) {
    transform: translateY(40px);
  }
  .home-journey-card:nth-child(2):hover {
    transform: translateY(32px);
  }
}

.journey-card-img {
  position: relative;
  width: 100%;
  height: 250px;
  border-radius: 20px 20px 0 0;
  background: #f0f0f0;
}
.journey-card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 20px 20px 0 0;
}
.journey-card-num {
  position: absolute;
  right: 24px;
  bottom: -28px;
  width: 56px;
  height: 56px;
  background: #C5B499; /* elegant gold/tan */
  color: #ffffff;
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 700;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 4px solid #ffffff;
  box-shadow: 0 6px 15px rgba(197, 180, 153, 0.4);
  z-index: 2;
}

.journey-card-content {
  padding: 40px 30px 35px;
}
.journey-card-title {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  color: #2b2b2b;
  margin-bottom: 14px;
  line-height: 1.3;
}
.journey-card-text {
  color: #666;
  font-size: 15px;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 900px) {
  .home-journey-grid {
    grid-template-columns: 1fr;
    max-width: 480px;
    gap: 50px;
  }
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
