@extends('layouts.app')

@section('title', 'Home')

@section('content')

<style>
  /* Home banner: show the FULL uploaded hero image without cropping */
  .home-banners-section .banner-slide {
    background-size: 100% 100% !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
    background-color: #1e2b30;
  }
  /* Home banner title — uppercase and bright for readability over photo */
  .home-banners-section .banner-slide-content {
    max-width: 1320px;
  }
  .home-banners-section .banner-slide-title {
    text-transform: uppercase;
    color: #FFD357;
    letter-spacing: 0.6px;
    text-shadow: 0 3px 14px rgba(0,0,0,0.55), 0 0 2px rgba(0,0,0,0.4);
    font-weight: 800;
    font-size: clamp(14px, 1.4vw, 20px);
    line-height: 1.3;
    max-width: 100%;
    text-wrap: balance;
  }
  @media (max-width: 768px) {
    .home-banners-section .banner-slide-title {
      font-size: 16px !important;
    }
  }
  .home-banners-section .banner-slide-description {
    color: #ffffff;
    text-shadow: 0 2px 10px rgba(0,0,0,0.5);
  }
</style>

<!-- Dynamic Hero Banner Section -->
<section id="home-banners-section" class="home-banners-section">
  <div class="banner-slider" id="bannerSlider">
    <div class="banner-slider-track">
      @if($banners->isNotEmpty())
        @foreach($banners as $index => $banner)
          <div class="banner-slide {{ $index === 0 ? 'is-active' : '' }}" style="background-image: url('{{ asset($banner->image) }}');">
            <div class="banner-slide-shell">
              <div class="banner-slide-content">
                <h1 class="banner-slide-title">{{ $banner->title }}</h1>
                <p class="banner-slide-description">{{ $banner->description }}</p>
                @if($banner->button_text)
                  <a href="{{ $banner->button_link ?? route('contact') }}" class="banner-slide-button">{{ $banner->button_text }}</a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="banner-slide is-active" style="background-image: url('{{ asset('storage/Hero Banner.jpeg') }}');">
          <div class="banner-slide-shell">
            <div class="banner-slide-content">
              <h1 class="banner-slide-title">Empowering Your Birth Journey</h1>
              <p class="banner-slide-description">Compassionate birth doula support, prenatal yoga, and childbirth education for your journey into motherhood.</p>
              <a href="#" class="banner-slide-button" data-calendly>Book Consultation</a>
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
    <div class="about-wrapper">
      <!-- Left: Content -->
      <div class="about-content-col reveal">
        <div class="about-eyebrow-row">
          <span class="about-eyebrow-line"></span>
          <span class="about-eyebrow-label">About Us</span>
        </div>
        <h2 class="about-section-title">Walking Alongside You</h2>
        <div class="about-text-body">
          <p>I am Anu &mdash; a Birth Doula, Prenatal Yoga Instructor, Childbirth Educator, Nutritionist, and a mother of two. I believe every woman deserves to feel seen, heard, and supported throughout her pregnancy, birth, and postpartum journey. My intention is to create a calm, safe, and nurturing space where you feel empowered without judgment and guided without pressure.</p>
        </div>
        <a href="{{ route('about') }}" class="btn-about-teal">Read More About Me</a>
      </div>
      <!-- Right: Circle Image -->
      <div class="about-image-col reveal d1">
        <div class="about-blob-wrap">
          <div class="about-blob-bg"></div>
          <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Anu - Birth Doula" class="about-blob-img">
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* About Us Section */
.about-us-section {
  padding: 100px 6%;
  background: linear-gradient(180deg, #fdf8f5 0%, #faf1ec 100%);
}
.about-wrapper {
  display: flex;
  align-items: center;
  gap: 70px;
  max-width: 1200px;
  margin: 0 auto;
}
.about-content-col { flex: 1; }
.about-image-col {
  flex: 1;
  display: flex;
  justify-content: center;
}
/* Eyebrow */
.about-eyebrow-row {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 18px;
}
.about-eyebrow-line {
  display: inline-block;
  width: 36px;
  height: 2px;
  background: #4DB6AC;
  border-radius: 2px;
}
.about-eyebrow-label {
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  color: #4DB6AC;
}
/* Title */
.about-section-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(36px, 5vw, 54px);
  color: #1a1a1a;
  line-height: 1.15;
  margin-bottom: 28px;
  font-weight: 700;
}
/* Body */
.about-text-body p {
  font-size: 17px;
  color: #555;
  line-height: 1.85;
  margin-bottom: 36px;
}
/* Button */
.btn-about-teal {
  display: inline-block;
  background: #4DB6AC;
  color: #ffffff;
  padding: 16px 36px;
  border-radius: 10px;
  font-weight: 600;
  font-size: 16px;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 6px 20px rgba(77, 182, 172, 0.25);
}
.btn-about-teal:hover {
  background: #3d918a;
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(77, 182, 172, 0.35);
  color: #fff;
}
/* Blob Circle Image */
.about-blob-wrap {
  position: relative;
  width: 100%;
  max-width: 480px;
}
.about-blob-bg {
  width: 420px;
  height: 420px;
  border-radius: 50%;
  background: rgba(77, 182, 172, 0.08);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 0;
}
.about-blob-img {
  width: 100%;
  max-width: 460px;
  height: 480px;
  object-fit: cover;
  object-position: top;
  border-radius: 50%;
  display: block;
  margin: 0 auto;
  position: relative;
  z-index: 1;
  box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}
@media (max-width: 991px) {
  .about-wrapper { flex-direction: column-reverse; gap: 40px; }
  .about-blob-img { max-width: 320px; height: 320px; }
  .about-blob-bg { width: 300px; height: 300px; }
}
</style>

<!-- Why Choose Us Section -->
<section class="why-choose-us-sec">
  <div class="container">
    <div class="why-header reveal">
      <span class="why-eyebrow">Why Families Choose Us</span>
      <h2 class="why-title">What Makes Us Different</h2>
      <p class="why-subtitle">Compassionate support for a calm, empowered birth journey.</p>
    </div>

    <div class="why-journey-grid why-journey-grid--four">
      <!-- Feature 1 — Personalized, One-on-One Support -->
      <div class="why-journey-step reveal d1">
        <div class="why-img-wrap why-icon-wrap">
          <img src="{{ asset('storage/why-choose/01.svg') }}" alt="Personalized, One-on-One Support" class="why-icon">
          <div class="why-badge">01</div>
        </div>
        <div class="why-arrow d-none-mobile">
          <span class="why-arrow-line"></span>
          <span class="why-arrow-tip"></span>
        </div>
        <h3 class="why-card-title">Personalized, One-on-One Support</h3>
        <p class="why-card-text">Every plan and session is tailored to your body, your needs, and your journey.</p>
      </div>

      <!-- Feature 2 — Holistic Approach to Wellness & Birth -->
      <div class="why-journey-step reveal d2">
        <div class="why-img-wrap why-icon-wrap">
          <img src="{{ asset('storage/why-choose/02.svg') }}" alt="Holistic Approach to Wellness & Birth" class="why-icon">
          <div class="why-badge">02</div>
        </div>
        <div class="why-arrow d-none-mobile">
          <span class="why-arrow-line"></span>
          <span class="why-arrow-tip"></span>
        </div>
        <h3 class="why-card-title">Holistic Approach to Wellness &amp; Birth</h3>
        <p class="why-card-text">A unique blend of nutrition, prenatal yoga, and doula support to guide you physically and emotionally.</p>
      </div>

      <!-- Feature 3 — Guided by Experience & Understanding -->
      <div class="why-journey-step reveal d3">
        <div class="why-img-wrap why-icon-wrap">
          <img src="{{ asset('storage/why-choose/03.svg') }}" alt="Guided by Experience & Understanding" class="why-icon">
          <div class="why-badge">03</div>
        </div>
        <div class="why-arrow d-none-mobile">
          <span class="why-arrow-line"></span>
          <span class="why-arrow-tip"></span>
        </div>
        <h3 class="why-card-title">Guided by Experience &amp; Understanding</h3>
        <p class="why-card-text">As a mother of two, I bring both professional knowledge and real-life empathy to every client I support &mdash; helping you make informed decisions for your birth.</p>
      </div>

      <!-- Feature 4 — Ongoing Support & Guidance -->
      <div class="why-journey-step reveal d4">
        <div class="why-img-wrap why-icon-wrap">
          <img src="{{ asset('storage/why-choose/04.svg') }}" alt="Ongoing Support & Guidance" class="why-icon">
          <div class="why-badge">04</div>
        </div>
        <h3 class="why-card-title">Ongoing Support &amp; Guidance</h3>
        <p class="why-card-text">You're never alone in your journey &mdash; I'm here to support you every step of the way.</p>
      </div>
    </div>
  </div>
</section>

<style>
/* why Choose Us - Circular Design Settings */
.why-choose-us-sec {
  padding: 100px 6%;
  background: linear-gradient(180deg, #fbf3ef 0%, #f5e6df 100%);
  position: relative;
  overflow: hidden;
}
.why-header {
  text-align: center;
  margin-bottom: 80px;
}
.why-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #4DB6AC;
  margin-bottom: 12px;
}
.why-eyebrow::before {
  content: '';
  width: 24px;
  height: 2px;
  background: #4DB6AC;
  border-radius: 2px;
}
.why-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(34px, 4.5vw, 48px);
  color: #2c3e50;
  margin-bottom: 20px;
}
.why-subtitle {
  color: #6b7280;
  font-size: 18px;
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.6;
}

.why-journey-grid {
  display: flex;
  justify-content: center;
  gap: 20px;
  max-width: 1300px;
  margin: 0 auto;
}
.why-journey-grid--four {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}
@media (max-width: 1200px) {
  .why-journey-grid,
  .why-journey-grid--four {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 60px 30px;
  }
}

.why-journey-step {
  flex: 1;
  text-align: center;
  position: relative;
}
.why-img-wrap {
  width: 220px;
  height: 220px;
  margin: 0 auto 30px;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px dashed #4DB6AC;
  border-radius: 50%;
  padding: 10px;
  background: #fff;
}
.why-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  box-shadow: 0 10px 20px rgba(0,0,0,0.06);
}
.why-icon-wrap .why-icon {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  display: block;
  box-shadow: 0 10px 20px rgba(0,0,0,0.06);
  background: #ffffff;
}
.why-badge {
  position: absolute;
  top: 5px;
  right: 5px;
  width: 50px;
  height: 50px;
  background: #4DB6AC;
  color: #ffffff;
  font-family: 'Outfit', sans-serif;
  font-size: 20px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  box-shadow: 0 6px 15px rgba(77, 182, 172, 0.4);
  z-index: 2;
  border: 2px solid #fff;
}
.why-arrow {
  position: absolute;
  top: 100px;
  left: calc(50% + 115px);
  width: calc(100% - 200px);
  height: 20px;
  display: flex;
  align-items: center;
  z-index: 10;
  pointer-events: none;
  overflow: visible;
}
.why-arrow-line {
  flex: 1;
  height: 0;
  border-top: 2px dotted #4DB6AC;
}
.why-arrow-tip {
  width: 0;
  height: 0;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-left: 9px solid #4DB6AC;
  margin-left: 2px;
}
.why-card-title {
  font-family: 'Playfair Display', serif;
  font-size: 21px;
  color: #2c3e50;
  margin-bottom: 14px;
}
.why-card-text {
  color: #6b7280;
  font-size: 14.5px;
  line-height: 1.7;
  margin: 0 auto;
  max-width: 280px;
}

@media (max-width: 1200px) {
  .why-arrow { display: none; }
}
@media (max-width: 600px) {
  .why-journey-grid {
    grid-template-columns: 1fr;
    gap: 50px;
  }
}
</style>





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

<!-- Book A Complimentary Consultation Section -->
<section class="book-appointment-section" id="book-appointment">
  <div class="container">
    <div class="appointment-wrapper">
      <div class="appointment-heading">
        <span class="appointment-eyebrow">Let's Connect</span>
        <h2 class="appointment-title">Book A Complimentary Consultation</h2>
        <p class="appointment-subtitle">Pick a date and a time that works for you — Anu will confirm your complimentary consultation shortly.</p>
      </div>

      <div class="appointment-split">
        <div class="appointment-image reveal">
          <img
            src="{{ asset('storage/Baby.jpeg') }}"
            alt="Book a complimentary consultation with Anu">
        </div>

        <div class="appointment-form-col reveal d1">

        <form action="{{ route('contact.store') }}" method="POST" class="appointment-form" id="complimentaryForm">
          @csrf
          <input type="hidden" name="subject" value="Complimentary Consultation Booking">

          <div class="appointment-form-row">
            <div class="appointment-field">
              <label>Full Name <span style="color:#e06b6b;">*</span></label>
              <input type="text" name="name" placeholder="Your full name" required>
            </div>
            <div class="appointment-field">
              <label>Phone Number</label>
              <div style="display:grid;grid-template-columns:100px 1fr;gap:8px;">
                <select name="country_code" style="padding:11px 8px;border:1.5px solid #e5e0d8;border-radius:8px;background:#fff;font-family:inherit;font-size:14px;color:#2b2b2b;outline:none;">
                  <option value="">Code</option>
                  <option value="+1">🇺🇸 +1</option>
                  <option value="+91" selected>🇮🇳 +91</option>
                  <option value="+44">🇬🇧 +44</option>
                  <option value="+61">🇦🇺 +61</option>
                  <option value="+1-CA">🇨🇦 +1</option>
                  <option value="+64">🇳🇿 +64</option>
                  <option value="+27">🇿🇦 +27</option>
                </select>
                <input type="tel" name="phone" placeholder="XXXXX XXXXX">
              </div>
            </div>
          </div>
          <div class="appointment-form-row">
            <div class="appointment-field">
              <label>Email Address <span style="color:#e06b6b;">*</span></label>
              <input type="email" name="email" placeholder="you@example.com" required>
            </div>
            <div class="appointment-field">
              <label>Service</label>
              <select name="service_selected">
                <option value="">Choose a service</option>
                @foreach($services as $service)
                  <option value="{{ $service->title }}">{{ $service->title }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- Pick a Date & Time — Calendly Integration -->
          <div class="appointment-field">
            <label>Pick a Date &amp; Time <span style="color:#e06b6b;">*</span></label>
            <div class="appointment-calendly-embed">
              <div data-calendly-inline-widget data-url="https://calendly.com/anusuyaashok/30min?hide_gdpr_banner=1" style="min-width:320px;height:630px;"></div>
            </div>
            <input type="hidden" name="preferred_time_label" class="jiva-pickdate__input" data-calendly-time>
          </div>

          <div class="appointment-field">
            <label>Other Notes</label>
            <textarea name="message" id="apptJourneyNote" rows="3" placeholder="Anything you'd like to share"></textarea>
          </div>

          <button type="submit" class="appointment-btn">Book Consultation</button>

          @if(session('success'))
            <div class="appt-alert appt-alert--ok">✓ Your consultation request has been received. Anu will reach out shortly.</div>
          @endif
          @if($errors->any())
            <div class="appt-alert appt-alert--err">
              @foreach($errors->all() as $error){{ $error }}<br>@endforeach
            </div>
          @endif
        </form>
        </div>
      </div>
    </div>
  </div>

  <style>
    .book-appointment-section {
      padding: 90px 6%;
      background: linear-gradient(180deg, #faf1ec 0%, #fdf8f5 100%);
    }
    .appointment-wrapper {
      max-width: 1180px;
      margin: 0 auto;
    }
    .appointment-heading { text-align: center; margin-bottom: 48px; }
    .appointment-split {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 48px;
      align-items: stretch;
    }
    .appointment-image {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(47,169,163,0.15);
      height: 100%;
    }
    .appointment-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }
    .appointment-form-col {
      display: flex;
      height: 100%;
    }
    .appointment-form-col .appointment-form {
      flex: 1;
      height: 100%;
    }
    @media (max-width: 860px) {
      .appointment-split { grid-template-columns: 1fr; gap: 28px; }
      .appointment-image { aspect-ratio: 4 / 3; height: auto; }
    }
    .appointment-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 3px;
      color: var(--teal);
      font-weight: 700;
      margin-bottom: 10px;
    }
    .appointment-eyebrow::before {
      content: '';
      width: 24px;
      height: 2px;
      background: var(--teal);
      border-radius: 2px;
    }
    .appointment-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(28px, 3.5vw, 42px);
      font-weight: 700;
      color: var(--navy, #1f3b38);
      line-height: 1.2;
      margin-bottom: 12px;
    }
    .appointment-subtitle {
      color: #6b7280;
      font-size: 16px;
      line-height: 1.7;
      max-width: 640px;
      margin: 0 auto;
    }
    .appointment-form {
      display: flex;
      flex-direction: column;
      gap: 18px;
      background: #ffffff;
      padding: 36px;
      border-radius: 20px;
      box-shadow: 0 20px 50px rgba(47,169,163,0.12);
    }
    .appointment-form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .appointment-field label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #3d2b2b;
      margin-bottom: 6px;
    }
    .appointment-field input,
    .appointment-field select,
    .appointment-field textarea {
      width: 100%;
      padding: 14px 16px;
      border: 1.5px solid #e4e4e4;
      border-radius: 10px;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      color: #2b2b2b;
      background: #fafafa;
      outline: none;
      box-sizing: border-box;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .appointment-field textarea {
      resize: vertical;
      min-height: 88px;
    }
    .appointment-field input:focus,
    .appointment-field select:focus,
    .appointment-field textarea:focus {
      border-color: var(--teal);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(77, 182, 172, 0.12);
    }
    .appointment-field select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='%237a6060'%3E%3Cpath d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 16px center;
      padding-right: 40px;
    }

    .appt-selected-summary {
      margin: 4px 0 0;
      font-size: 13px;
      color: #6b7280;
      line-height: 1.5;
    }
    .appt-selected-summary.is-ready {
      color: #1f3b38;
      font-weight: 600;
    }
    .appt-selected-summary.is-error {
      color: #c0392b;
      font-weight: 600;
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
      align-self: center;
      min-width: 280px;
    }
    .appointment-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 32px rgba(77, 182, 172, 0.4);
    }
    .appt-alert {
      margin-top: 12px;
      padding: 12px 14px;
      border-radius: 10px;
      font-size: 14px;
    }
    .appt-alert--ok { background: #e8f8ef; color: #2d7a4b; }
    .appt-alert--err { background: #fde8e8; color: #c0392b; }

    /* Inline Calendar */
    .appt-cal-wrap {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 16px;
      background: #f9f9f9;
      border: 1.5px solid #e5e0d8;
      border-radius: 12px;
      padding: 16px;
    }
    .appt-cal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    .appt-cal-label {
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      font-weight: 600;
      color: #2b2b2b;
    }
    .appt-cal-nav {
      background: none;
      border: 1.5px solid #e0e0e0;
      border-radius: 6px;
      width: 28px; height: 28px;
      font-size: 18px;
      cursor: pointer;
      color: #555;
      display: flex; align-items: center; justify-content: center;
      transition: all 0.2s;
    }
    .appt-cal-nav:hover { border-color: #4DB6AC; color: #2FA9A3; }
    .appt-cal-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      text-align: center;
      margin-bottom: 4px;
    }
    .appt-cal-days span {
      font-size: 11px;
      font-weight: 600;
      color: #999;
      padding: 3px 0;
    }
    .appt-cal-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 3px;
    }
    .appt-day {
      aspect-ratio: 1;
      border: none;
      background: none;
      border-radius: 6px;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      color: #2b2b2b;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.15s;
    }
    .appt-day:hover { background: #e8f7f5; color: #2FA9A3; }
    .appt-day--past { color: #ccc; cursor: default; }
    .appt-day--empty { background: none; cursor: default; }
    .appt-day--selected { background: #2FA9A3; color: #fff; font-weight: 700; }
    .appt-slot-label {
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      font-weight: 600;
      color: #2b2b2b;
      margin-bottom: 10px;
      padding-bottom: 8px;
      border-bottom: 1px solid #eee;
    }
    .appt-slots-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 6px;
      max-height: 220px;
      overflow-y: auto;
    }
    .appt-slot {
      padding: 8px 6px;
      background: #fff;
      border: 1.5px solid #e0e0e0;
      border-radius: 7px;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      color: #2b2b2b;
      cursor: pointer;
      text-align: center;
      transition: all 0.15s;
    }
    .appt-slot:hover { border-color: #4DB6AC; color: #2FA9A3; background: #f0fbfa; }
    .appt-slot.is-active { background: #2FA9A3; color: #fff; border-color: #2FA9A3; font-weight: 700; }

    @media (max-width: 860px) {
      .appointment-form { padding: 24px; }
      .appointment-form-row { grid-template-columns: 1fr; }
      .appointment-btn { width: 100%; min-width: 0; }
      .appt-cal-wrap { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
      .appointment-form { padding: 18px 16px; }
      .appointment-title { font-size: clamp(22px, 6vw, 28px); }
      .appointment-subtitle { font-size: 14px; }
      .appointment-btn {
        padding: 14px 18px;
        font-size: 14px;
        letter-spacing: 0.5px;
        white-space: normal;
        line-height: 1.3;
      }
      .appointment-field input,
      .appointment-field select,
      .appointment-field textarea {
        font-size: 15px;
        padding: 12px 14px;
      }
    }
  </style>

  <script>
  /* Home page booking form */
  (function() {
    const form = document.getElementById('complimentaryForm');
    if (!form) return;

    const nameInput = form.querySelector('input[name="name"]');
    const emailInput = form.querySelector('input[name="email"]');
    const phoneInput = form.querySelector('input[name="phone"]');
    const messageInput = form.querySelector('textarea[name="message"]');
    let isSubmitting = false;

    console.log('[Home Form] Complimentary form initialized');

    /* Auto-submit when Calendly completes a booking */
    window.addEventListener('message', function(e) {
      if (!e.data || e.data.event !== 'calendly.event_scheduled') return;

      console.log('[Home Form] Calendly booking completed');

      /* Set default message since Calendly captured the booking */
      if (messageInput && !messageInput.value.trim()) {
        messageInput.value = 'Booked via Calendly - Details confirmed in calendar invitation';
      }

      /* Auto-submit after a brief delay */
      setTimeout(() => {
        console.log('[Home Form] Auto-submitting form');
        form.submit();
      }, 500);
    });

    form.addEventListener('submit', (e) => {
      if (isSubmitting) {
        e.preventDefault();
        return;
      }

      /* Browser validation will handle required fields */
      /* Prevent double submission */
      isSubmitting = true;
      form.querySelectorAll('button[type="submit"]').forEach(btn => btn.disabled = true);

      console.log('[Home Form] Submitted');
    });
  })();
  </script>
</section>

<!-- Testimonials Section -->
<section class="htsd-sec">
  <!-- Background Grass/Leaf Decorations -->
  <div class="htsd-grass htsd-grass-left">
    <svg viewBox="0 0 200 500" fill="none"><path d="M120,500 Q100,400 110,300 Q115,200 105,100 Q100,50 110,0" stroke="#4DB6AC" stroke-width="2" opacity="0.15"/><path d="M110,300 Q70,270 40,210" stroke="#4DB6AC" stroke-width="1.5" opacity="0.12"/><path d="M110,300 Q70,270 40,210 Q80,260 110,300" fill="#4DB6AC" opacity="0.06"/><path d="M108,200 Q65,175 35,120" stroke="#4DB6AC" stroke-width="1.5" opacity="0.12"/><path d="M108,200 Q65,175 35,120 Q78,172 108,200" fill="#4DB6AC" opacity="0.06"/><path d="M112,400 Q75,375 45,320" stroke="#4DB6AC" stroke-width="1.5" opacity="0.10"/><path d="M112,400 Q75,375 45,320 Q82,370 112,400" fill="#4DB6AC" opacity="0.04"/></svg>
  </div>
  <div class="htsd-grass htsd-grass-right">
    <svg viewBox="0 0 200 500" fill="none"><path d="M80,500 Q100,400 90,300 Q85,200 95,100 Q100,50 90,0" stroke="#4DB6AC" stroke-width="2" opacity="0.12"/><path d="M90,300 Q130,270 160,210" stroke="#4DB6AC" stroke-width="1.5" opacity="0.10"/><path d="M90,300 Q130,270 160,210 Q120,260 90,300" fill="#4DB6AC" opacity="0.05"/><path d="M92,200 Q135,175 165,120" stroke="#4DB6AC" stroke-width="1.5" opacity="0.10"/><path d="M92,200 Q135,175 165,120 Q122,172 92,200" fill="#4DB6AC" opacity="0.05"/></svg>
  </div>

  <div class="container htsd-wrap">
    <!-- Centered heading -->
    <div class="htsd-header reveal">
      <span class="htsd-tag">Testimonial</span>
      <h2 class="htsd-title">Voices of the Families We've Supported</h2>
    </div>

    <div class="htsd-single">
      <!-- Review Slider -->
      <div class="htsd-review reveal d1">
        <div class="htsd-slider" id="htsdTrack">
          @if($testimonials->isNotEmpty())
            @php $pairs = $testimonials->chunk(2)->values(); @endphp
            @foreach($pairs as $pIndex => $pair)
            <div class="htsd-pair {{ $pIndex === 0 ? 'htsd-pair--active' : '' }}">
              @foreach($pair as $t)
              <div class="htsd-card">
                <div class="htsd-q">&ldquo;&rdquo;</div>
                <div class="htsd-stars">
                  @for($i = 0; $i < ($t->rating ?? 5); $i++)<span class="htsd-s filled">&#9733;</span>@endfor
                  @for($i = ($t->rating ?? 5); $i < 5; $i++)<span class="htsd-s">&#9733;</span>@endfor
                </div>
                <p class="htsd-msg">{{ Str::limit($t->message, 300) }}</p>
                <div class="htsd-author">
                  <div class="htsd-auth-img">
                    @if($t->image)<img src="{{ asset($t->image) }}" alt="{{ $t->name }}">
                    @else<span>{{ strtoupper(substr($t->name, 0, 1)) }}</span>@endif
                  </div>
                  <div>
                    <div class="htsd-auth-name">{{ $t->name }}</div>
                    <div class="htsd-auth-role">{{ $t->role ?? 'Mother of Two' }}</div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            @endforeach
          @else
            <div class="htsd-pair htsd-pair--active">
              <div class="htsd-card">
                <div class="htsd-q">&ldquo;&rdquo;</div>
                <div class="htsd-stars"><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span></div>
                <p class="htsd-msg">The prenatal yoga classes were a game-changer for my second pregnancy. I felt so much stronger and more prepared compared to my first.</p>
                <div class="htsd-author">
                  <div class="htsd-auth-img"><span>A</span></div>
                  <div><div class="htsd-auth-name">Ananya Reddy</div><div class="htsd-auth-role">Mother of Two</div></div>
                </div>
              </div>
              <div class="htsd-card">
                <div class="htsd-q">&ldquo;&rdquo;</div>
                <div class="htsd-stars"><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span><span class="htsd-s filled">&#9733;</span></div>
                <p class="htsd-msg">Anu's guidance during my pregnancy was priceless. Her breathing techniques and doula support made my birth journey calm and empowered.</p>
                <div class="htsd-author">
                  <div class="htsd-auth-img"><span>P</span></div>
                  <div><div class="htsd-auth-name">Priya Sharma</div><div class="htsd-auth-role">First-time Mother</div></div>
                </div>
              </div>
            </div>
          @endif
        </div>
        <div class="htsd-dots" id="htsdDots">
          @if($testimonials->isNotEmpty())
            @foreach($pairs as $pi => $pair)
              <button class="htsd-dot {{ $pi === 0 ? 'htsd-dot--active' : '' }}" data-index="{{ $pi }}"></button>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* ===== Testimonial Section - Dark ===== */
.htsd-sec {
  position: relative;
  padding: 80px 6%;
  background: linear-gradient(135deg, #e8f5f3 0%, #fdf0ee 35%, #f0faf8 65%, #fce8e6 100%);
  overflow: hidden;
  min-height: 520px;
  display: flex;
  align-items: center;
}
/* Background grass */
.htsd-grass {
  position: absolute;
  top: 0;
  width: 180px;
  height: 100%;
  z-index: 0;
  pointer-events: none;
}
.htsd-grass-left { left: 0; }
.htsd-grass-right { right: 0; }
.htsd-wrap {
  position: relative;
  z-index: 2;
  width: 100%;
}

/* Centered Header */
.htsd-header {
  text-align: center;
  max-width: 720px;
  margin: 0 auto 40px;
}
.htsd-header .htsd-title {
  margin-bottom: 0;
}
/* Single centered slider */
.htsd-single {
  max-width: 1080px;
  margin: 0 auto;
}
.htsd-pair {
  display: none;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
  animation: htsdIn 0.45s ease;
}
.htsd-pair--active {
  display: grid;
}
@media (max-width: 720px) {
  .htsd-pair { grid-template-columns: 1fr; }
  .htsd-single { max-width: 560px; }
}

.htsd-tag {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: #4DB6AC;
  background: transparent;
  padding: 0;
  margin-bottom: 12px;
}
.htsd-tag::before {
  content: '';
  width: 24px;
  height: 2px;
  background: #4DB6AC;
  border-radius: 2px;
}
.htsd-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(24px, 2.8vw, 38px);
  color: #3d2b2b;
  line-height: 1.3;
  margin-bottom: 30px;
  font-weight: 700;
}
.htsd-cta-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px 10px 24px;
  background: #ffffff;
  border-radius: 40px;
  color: #1a2e1a;
  font-family: 'Outfit', sans-serif;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s;
}
.htsd-cta-arrow {
  width: 34px;
  height: 34px;
  background: #4DB6AC;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  flex-shrink: 0;
}
.htsd-cta-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255,255,255,0.15);
}

/* Col 2: Rating Card */
.htsd-mid {
  display: flex;
  justify-content: center;
}
.htsd-rate-card {
  background: linear-gradient(160deg, #5ec4a0 0%, #4DB6AC 40%, #3d9e94 100%);
  border-radius: 16px 50px 16px 16px;
  padding: 36px 32px 28px;
  text-align: center;
  min-width: 190px;
  box-shadow: 0 20px 50px rgba(77,182,172,0.3);
}
.htsd-rate-num {
  font-family: 'Playfair Display', serif;
  font-size: 54px;
  font-weight: 900;
  color: #fff;
  line-height: 1;
  margin-bottom: 6px;
}
.htsd-rate-stars {
  color: #FFD700;
  font-size: 18px;
  margin-bottom: 16px;
  letter-spacing: 3px;
}
.htsd-rate-text {
  font-size: 13px;
  color: rgba(255,255,255,0.8);
  line-height: 1.5;
  margin-bottom: 20px;
}
.htsd-avatars {
  display: flex;
  justify-content: center;
}
.htsd-av {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 2.5px solid rgba(255,255,255,0.6);
  margin-left: -10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: 700;
  color: #fff;
}
.htsd-av:first-child { margin-left: 0; }
.htsd-av-more {
  background: rgba(0,0,0,0.25);
  font-size: 16px;
}

/* Col 3: Review Card */
.htsd-review { position: relative; }
.htsd-slider { position: relative; }
.htsd-card {
  background: #ffffff;
  border-radius: 20px;
  padding: 36px 32px;
  box-shadow: 0 16px 45px rgba(0,0,0,0.25);
  display: flex;
  flex-direction: column;
}
@keyframes htsdIn {
  from { opacity: 0; transform: translateX(14px); }
  to   { opacity: 1; transform: translateX(0); }
}
.htsd-q {
  font-family: 'Playfair Display', serif;
  font-size: 50px;
  line-height: 0.8;
  color: #4DB6AC;
  opacity: 0.3;
  margin-bottom: 10px;
}
.htsd-stars { display: flex; gap: 3px; margin-bottom: 16px; }
.htsd-s { font-size: 16px; color: #e0e0e0; }
.htsd-s.filled { color: #EAB308; }
.htsd-msg {
  font-size: 14.5px;
  line-height: 1.8;
  color: #555;
  margin-bottom: 24px;
  font-family: 'Outfit', sans-serif;
}
.htsd-author {
  display: flex;
  align-items: center;
  gap: 12px;
  border-top: 1px solid #f0f0f0;
  padding-top: 16px;
}
.htsd-auth-img {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  overflow: hidden;
  flex-shrink: 0;
  background: linear-gradient(135deg, #4DB6AC, #3d9e94);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 18px;
  font-weight: 700;
}
.htsd-auth-img img { width: 100%; height: 100%; object-fit: cover; }
.htsd-auth-name { font-size: 15px; font-weight: 700; color: #2b2b2b; }
.htsd-auth-role { font-size: 12px; color: #888; margin-top: 2px; }

/* Dots */
.htsd-dots {
  display: flex;
  gap: 8px;
  margin-top: 18px;
  justify-content: center;
}
.htsd-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: none;
  background: #d4d4d4;
  cursor: pointer;
  transition: all 0.3s;
  padding: 0;
}
.htsd-dot--active {
  background: #4DB6AC;
  width: 26px;
  border-radius: 5px;
}

/* Responsive */
@media (max-width: 991px) {
  .htsd-grass { display: none; }
  .htsd-single { max-width: 560px; }
}
@media (max-width: 720px) {
  .htsd-pair { grid-template-columns: 1fr; gap: 18px; }
  .htsd-single { max-width: 520px; }
  .htsd-title { font-size: clamp(22px, 6vw, 30px); }
  .htsd-tag { font-size: 10px; letter-spacing: 2px; }
}
@media (max-width: 600px) {
  .htsd-sec { padding: 48px 5%; min-height: 0; }
  .htsd-card { padding: 22px 18px; }
  .htsd-header { margin-bottom: 26px; }
  .htsd-q { font-size: 36px; }
  .htsd-msg { font-size: 14px; line-height: 1.7; margin-bottom: 18px; }
  .htsd-auth-img { width: 38px; height: 38px; font-size: 15px; }
  .htsd-auth-name { font-size: 14px; }
  .htsd-auth-role { font-size: 11px; }
  .htsd-dots { margin-top: 14px; gap: 6px; }
  .htsd-dot { width: 8px; height: 8px; }
  .htsd-dot--active { width: 22px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const pairs = document.querySelectorAll('.htsd-pair');
  const dots  = document.querySelectorAll('.htsd-dot');
  if (!pairs.length || pairs.length <= 1) return;
  let current = 0, timer;
  function goTo(idx) {
    pairs[current].classList.remove('htsd-pair--active');
    dots[current] && dots[current].classList.remove('htsd-dot--active');
    current = (idx + pairs.length) % pairs.length;
    pairs[current].classList.add('htsd-pair--active');
    dots[current] && dots[current].classList.add('htsd-dot--active');
  }
  function startTimer() { clearInterval(timer); timer = setInterval(() => goTo(current + 1), 5500); }
  dots.forEach((d, i) => d.addEventListener('click', () => { goTo(i); startTimer(); }));
  startTimer();
});
</script>

<!-- FAQ Section -->
<section class="home-faq-section">
  <div class="faq-bg-overlay"></div>
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
        @if(isset($faqs) && $faqs->isNotEmpty())
          @foreach($faqs as $faq)
          <div class="home-faq-item" data-faq>
            <button class="home-faq-question" type="button">
              <span>{{ $faq->question }}</span>
              <span class="home-faq-icon">+</span>
            </button>
            <div class="home-faq-answer">
              <p>{{ $faq->answer }}</p>
            </div>
          </div>
          @endforeach
        @else
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
        @endif
      </div>
    </div>
  </div>
</section>

<style>
/* ===== HOME FAQ ===== */
.home-faq-section {
  padding: 90px 6%;
  position: relative;
  background-image: url('{{ asset("images/banner-services.png") }}');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}
.faq-bg-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.60);
  z-index: 0;
}
.home-faq-grid {
  position: relative;
  z-index: 1;
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
  display: inline-flex;
  align-items: center;
  gap: 10px;
  color: var(--teal);
  font-size: 13px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 16px;
}
.home-faq-label::before {
  content: '';
  width: 24px;
  height: 2px;
  background: var(--teal);
  border-radius: 2px;
}
.home-faq-heading {
  font-family: 'Playfair Display', serif;
  font-size: clamp(28px, 3.5vw, 42px);
  color: #ffffff;
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
@media (max-width: 600px) {
  .home-faq-heading { font-size: clamp(26px, 7vw, 34px); line-height: 1.2; }
  .home-faq-touch { flex-direction: column; gap: 12px; }
  .home-faq-touch-btn { padding: 10px 20px; font-size: 13px; }
  .home-faq-touch-btn .home-faq-touch-btn-icon { width: 20px; height: 20px; margin-left: 6px; }
  .home-faq-question { padding: 14px 18px; font-size: 14px; gap: 12px; }
  .home-faq-icon { width: 28px; height: 28px; font-size: 15px; }
  .home-faq-answer p { padding: 0 18px 18px; font-size: 13.5px; line-height: 1.6; }
  .home-faq-item { border-radius: 22px; margin-bottom: 14px; }
}
@media (max-width: 380px) {
  .appointment-btn { font-size: 12px; padding: 12px 14px; letter-spacing: 0.3px; }
  .home-faq-touch-btn { font-size: 12px; padding: 10px 16px; }
  .home-faq-question { font-size: 13px; padding: 12px 14px; }
  .svc-cta-submit, .about-cta-submit, .testi-cta-submit { font-size: 12px; padding: 12px 14px; letter-spacing: 0.5px; }
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

@endsection
