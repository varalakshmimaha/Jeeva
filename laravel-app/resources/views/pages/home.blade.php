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
  background: #ffffff;
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
      <span class="why-eyebrow">Why Jiva Birth & Beyond</span>
      <h2 class="why-title">Why Choose Us?</h2>
      <p class="why-subtitle">Providing a sanctuary of support, knowledge, and empowerment for your unique birthing journey.</p>
    </div>

    <div class="why-journey-grid">
      <!-- Feature 1 -->
      <div class="why-journey-step reveal d1">
        <div class="why-img-wrap">
          <img src="{{ asset('images/why_support.png') }}" alt="Compassionate Care">
          <div class="why-badge">01</div>
        </div>
        <div class="why-arrow d-none-mobile">
          <svg preserveAspectRatio="none" viewBox="0 0 100 40" style="width: 100%; height: 100%;">
            <path d="M0,38 Q50,-5 99,38" fill="none" stroke="#4DB6AC" stroke-width="1.5" vector-effect="non-scaling-stroke" />
          </svg>
          <svg class="why-arrow-head" viewBox="0 0 10 10">
            <polygon points="0,0 10,5 0,10" fill="#4DB6AC" />
          </svg>
        </div>
        <h3 class="why-card-title">Compassionate Care</h3>
        <p class="why-card-text">We provide deeply personal and empathetic support, ensuring you feel seen and heard at every step.</p>
      </div>

      <!-- Feature 2 -->
      <div class="why-journey-step reveal d2">
        <div class="why-img-wrap">
          <img src="{{ asset('images/why_advocacy.png') }}" alt="Expert Guidance">
          <div class="why-badge">02</div>
        </div>
        <div class="why-arrow d-none-mobile">
          <svg preserveAspectRatio="none" viewBox="0 0 100 40" style="width: 100%; height: 100%;">
            <path d="M0,38 Q50,-5 99,38" fill="none" stroke="#4DB6AC" stroke-width="1.5" vector-effect="non-scaling-stroke" />
          </svg>
          <svg class="why-arrow-head" viewBox="0 0 10 10">
            <polygon points="0,0 10,5 0,10" fill="#4DB6AC" />
          </svg>
        </div>
        <h3 class="why-card-title">Expert Guidance</h3>
        <p class="why-card-text">With professional training in doula care and nutrition, we offer knowledgeable guidance for a healthy journey.</p>
      </div>

      <!-- Feature 3 -->
      <div class="why-journey-step reveal d3">
        <div class="why-img-wrap">
          <img src="{{ asset('images/why_mindbody.png') }}" alt="Holistic Wellness">
          <div class="why-badge">03</div>
        </div>
        <div class="why-arrow d-none-mobile">
          <svg preserveAspectRatio="none" viewBox="0 0 100 40" style="width: 100%; height: 100%;">
            <path d="M0,38 Q50,-5 99,38" fill="none" stroke="#4DB6AC" stroke-width="1.5" vector-effect="non-scaling-stroke" />
          </svg>
          <svg class="why-arrow-head" viewBox="0 0 10 10">
            <polygon points="0,0 10,5 0,10" fill="#4DB6AC" />
          </svg>
        </div>
        <h3 class="why-card-title">Holistic Wellness</h3>
        <p class="why-card-text">From prenatal yoga to dietary advice, we nurture your physical, emotional, and spiritual well-being.</p>
      </div>

      <!-- Feature 4 -->
      <div class="why-journey-step reveal d4">
        <div class="why-img-wrap">
          <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Evidence-Based Support">
          <div class="why-badge">04</div>
        </div>
        <h3 class="why-card-title">Evidence-Based Support</h3>
        <p class="why-card-text">Our practices are grounded in research and experience, helping you make informed decisions for your birth.</p>
      </div>
    </div>
  </div>
</section>

<style>
/* why Choose Us - Circular Design Settings */
.why-choose-us-sec {
  padding: 100px 6%;
  background: linear-gradient(to bottom, #ffffff, #f9f7f4);
  position: relative;
  overflow: hidden;
}
.why-header {
  text-align: center;
  margin-bottom: 80px;
}
.why-eyebrow {
  display: inline-block;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #4DB6AC;
  margin-bottom: 12px;
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
@media (max-width: 1200px) {
  .why-journey-grid {
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
  top: 90px;
  left: calc(50% + 120px);
  width: calc(100% - 240px);
  height: 40px;
  z-index: 10;
  pointer-events: none;
}
.why-arrow-head {
  position: absolute;
  right: -3px;
  bottom: -1px;
  width: 12px;
  height: 12px;
  transform: rotate(38deg);
  transform-origin: center;
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

<!-- Stats Counter Section -->
<section class="home-stats-sec">
  <div class="stats-overlay"></div>
  <div class="stats-inner">
    <!-- Stat 1 -->
    <div class="stat-card reveal d1">
      <div class="stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="stat-num" data-target="12">0</div>
      <div class="stat-dot">•</div>
      <div class="stat-label">Years of Experience</div>
    </div>
    <!-- Stat 2 -->
    <div class="stat-card reveal d2">
      <div class="stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"/>
          <circle cx="9" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="stat-num" data-target="450">0</div>
      <div class="stat-dot">•</div>
      <div class="stat-label">Families Supported</div>
    </div>
    <!-- Stat 3 -->
    <div class="stat-card reveal d3">
      <div class="stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M9 11l3 3L22 4" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="stat-num" data-target="25">0</div>
      <div class="stat-dot">•</div>
      <div class="stat-label">Professional Certs</div>
    </div>
    <!-- Stat 4 -->
    <div class="stat-card reveal d4">
      <div class="stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M12 3c-4.97 0-9 3.185-9 7.115 0 2.557 1.52 4.82 3.889 6.178L6 21l4.5-2.25c.49.085.993.135 1.5.135 4.97 0 9-3.186 9-7.12S16.97 3 12 3Z" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="stat-num" data-target="1500" data-suffix="+">0</div>
      <div class="stat-dot">•</div>
      <div class="stat-label">Yoga Hours Taught</div>
    </div>
  </div>
</section>

<style>
/* Stats Counter — Greenscapes Card Design */
.home-stats-sec {
  position: relative;
  background-image: url('{{ asset("images/banner-about.png") }}');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  padding: 100px 5%;
}
.stats-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 0;
}
.stats-inner {
  position: relative;
  z-index: 1;
  display: flex;
  justify-content: center;
  align-items: stretch;
  gap: 20px;
  flex-wrap: wrap;
  max-width: 1300px;
  margin: 0 auto;
}
.stat-card {
  flex: 1;
  min-width: 200px;
  max-width: 260px;
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 16px;
  padding: 40px 24px;
  text-align: center;
  color: #ffffff;
  transition: transform 0.3s ease, background 0.3s ease;
}
.stat-card:hover {
  transform: translateY(-6px);
  background: rgba(255, 255, 255, 0.14);
}
.stat-icon {
  width: 56px;
  height: 56px;
  background: rgba(255, 255, 255, 0.12);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 24px;
}
.stat-icon svg {
  width: 28px;
  height: 28px;
  color: #4DB6AC;
  stroke: #4DB6AC;
}
.stat-num {
  font-family: 'Playfair Display', serif;
  font-size: clamp(42px, 5vw, 62px);
  font-weight: 700;
  color: #ffffff;
  line-height: 1;
  margin-bottom: 10px;
}
.stat-dot {
  color: #4DB6AC;
  font-size: 24px;
  line-height: 1;
  margin-bottom: 10px;
}
.stat-label {
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: rgba(255, 255, 255, 0.75);
  font-weight: 700;
}

@media (max-width: 860px) {
  .stats-inner { gap: 14px; }
  .stat-card { min-width: 160px; padding: 30px 16px; }
}
@media (max-width: 600px) {
  .home-stats-sec { padding: 70px 4%; background-attachment: scroll; }
  .stats-inner { gap: 12px; }
  .stat-card { min-width: 140px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const stats = document.querySelectorAll('.stat-num');
  const observerOptions = {
    threshold: 0.5
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = entry.target;
        const countTo = parseInt(target.getAttribute('data-target'));
        const suffix = target.getAttribute('data-suffix') || '';
        let count = 0;
        const duration = 2000; // 2 seconds
        const increment = countTo / (duration / 16); // 60fps

        const updateCount = () => {
          count += increment;
          if (count < countTo) {
            target.innerText = Math.floor(count) + suffix;
            requestAnimationFrame(updateCount);
          } else {
            target.innerText = countTo + suffix;
          }
        };
        updateCount();
        observer.unobserve(target);
      }
    });
  }, observerOptions);

  stats.forEach(stat => observer.observe(stat));
});
</script>








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

<!-- Testimonials Section - Theme Layout -->
<section class="htsd-section theme-bg">
  <div class="container htsd-container">
    <div class="htsd-3col-grid">
      <!-- Left: Info -->
      <div class="htsd-info-col reveal">
        <span class="htsd-label">Testimonial</span>
        <h2 class="htsd-heading">The Best Customers Says About Our Action</h2>
        <a href="{{ route('testimonials') }}" class="htsd-read-btn">
          <span>Read All Testimonials</span>
          <span class="htsd-read-icon-circle">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </span>
        </a>
      </div>

      <!-- Middle: Rating Card -->
      <div class="htsd-rating-col reveal d1">
        <div class="htsd-rating-card">
          <div class="htsd-rating-num">4.8</div>
          <div class="htsd-rating-stars">
            <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span class="half-star">&#9733;</span>
          </div>
          <p class="htsd-rating-text">From 3k Members,<br>Reviewed by Google</p>
          <div class="htsd-avatars-group">
            <div class="htsd-avatar"><img src="{{ asset('images/gallery/1.jpg') }}" alt="V" onerror="this.src='https://ui-avatars.com/api/?name=V&background=random'"></div>
            <div class="htsd-avatar"><img src="{{ asset('images/gallery/2.jpg') }}" alt="A" onerror="this.src='https://ui-avatars.com/api/?name=A&background=random'"></div>
            <div class="htsd-avatar"><img src="{{ asset('images/gallery/3.jpg') }}" alt="R" onerror="this.src='https://ui-avatars.com/api/?name=R&background=random'"></div>
            <div class="htsd-avatar"><img src="{{ asset('images/gallery/4.jpg') }}" alt="S" onerror="this.src='https://ui-avatars.com/api/?name=S&background=random'"></div>
            <div class="htsd-avatar htsd-avatar-more">+</div>
          </div>
        </div>
      </div>

      <!-- Right: Card Slider -->
      <div class="htsd-slider-col reveal d2">
        <div class="htsd-track" id="htsdTrack">
          @if($testimonials->isNotEmpty())
            @foreach($testimonials as $index => $t)
            <div class="htsd-card {{ $index === 0 ? 'htsd-card--active' : '' }}">
              <div class="htsd-card-quote">9999</div>
              <div class="htsd-card-stars">
                @for($i = 0; $i < ($t->rating ?? 5); $i++)<span class="htsd-star filled">&#9733;</span>@endfor
                @for($i = ($t->rating ?? 5); $i < 5; $i++)<span class="htsd-star">&#9733;</span>@endfor
              </div>
              <p class="htsd-card-msg">&ldquo;{{ Str::limit($t->message, 280) }}&rdquo;</p>
              <div class="htsd-card-author">
                <div class="htsd-card-avatar-s">
                  @if($t->image)<img src="{{ asset($t->image) }}" alt="{{ $t->name }}">
                  @else<span>{{ strtoupper(substr($t->name, 0, 1)) }}</span>@endif
                </div>
                <div class="htsd-card-meta">
                  <div class="htsd-card-name">{{ $t->name }}</div>
                  <div class="htsd-card-role">{{ $t->role ?? 'Happy Client' }}</div>
                </div>
              </div>
            </div>
            @endforeach
          @else
            <div class="htsd-card htsd-card--active">
              <div class="htsd-card-quote">9999</div>
              <div class="htsd-card-stars"><span class="htsd-star filled">&#9733;</span><span class="htsd-star filled">&#9733;</span><span class="htsd-star filled">&#9733;</span><span class="htsd-star filled">&#9733;</span><span class="htsd-star filled">&#9733;</span></div>
              <p class="htsd-card-msg">&ldquo;The prenatal yoga classes were a game-changer for my second pregnancy. I felt so much stronger and more prepared compared to my first. The breathing techniques helped immensely during labor.&rdquo;</p>
              <div class="htsd-card-author">
                <div class="htsd-card-avatar-s"><span>A</span></div>
                <div class="htsd-card-meta"><div class="htsd-card-name">Ananya Reddy</div><div class="htsd-card-role">Mother of Two</div></div>
              </div>
            </div>
          @endif
        </div>

        <!-- Dots -->
        <div class="htsd-dots" id="htsdDots">
          @if($testimonials->isNotEmpty())
            @foreach($testimonials as $i => $t)
              <button class="htsd-dot {{ $i === 0 ? 'htsd-dot--active' : '' }}" data-index="{{ $i }}"></button>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* ===== Home Testimonials - Split Dark Layout ===== */
.htsd-section {
  position: relative;
  padding: 80px 6%;
  overflow: hidden;
  min-height: 560px;
  display: flex;
  align-items: center;
}
.htsd-bg {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  z-index: 0;
}
.htsd-bg::after {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(60, 40, 30, 0.55);
}
.htsd-container {
  position: relative;
  z-index: 2;
  width: 100%;
}
.htsd-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 50px;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

/* Left Side */
.htsd-left { }
.htsd-left-inner {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 30px;
  align-items: start;
}
.htsd-text-col {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
.htsd-label {
  display: inline-block;
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 3px;
  color: #4DB6AC;
  margin-bottom: 18px;
  background: rgba(77,182,172,0.15);
  padding: 5px 14px;
  border-radius: 20px;
}
.htsd-heading {
  font-family: 'Playfair Display', serif;
  font-size: clamp(26px, 3vw, 38px);
  color: #ffffff;
  line-height: 1.3;
  margin-bottom: 30px;
  font-weight: 700;
}

/* Rating Box - Solid Teal Card */
.htsd-rating-box {
  background: linear-gradient(160deg, #4DB6AC 0%, #3d9e94 100%);
  border-radius: 20px;
  padding: 28px 28px 24px;
  text-align: center;
  min-width: 170px;
  box-shadow: 0 12px 35px rgba(77,182,172,0.35);
}
.htsd-rating-num {
  font-family: 'Playfair Display', serif;
  font-size: 48px;
  font-weight: 900;
  color: #ffffff;
  line-height: 1;
  margin-bottom: 4px;
}
.htsd-rating-stars {
  color: #FFD700;
  font-size: 16px;
  margin-bottom: 12px;
  display: flex;
  justify-content: center;
  gap: 2px;
}
.htsd-rating-text {
  font-size: 12px;
  color: rgba(255,255,255,0.75);
  line-height: 1.5;
  margin-bottom: 16px;
}
.htsd-social-icons {
  display: flex;
  gap: 8px;
  justify-content: center;
}
.htsd-social {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: rgba(0,0,0,0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  transition: all 0.3s;
  text-decoration: none;
}
.htsd-social:hover {
  background: rgba(0,0,0,0.35);
  transform: translateY(-2px);
}

/* Read All Button */
.htsd-read-btn {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  padding: 6px 24px 6px 6px;
  background: #ffffff;
  border: none;
  border-radius: 50px;
  color: #3d2b2b;
  font-family: 'Outfit', sans-serif;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s;
}
.htsd-read-icon-circle {
  width: 38px;
  height: 38px;
  background: #4DB6AC;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  flex-shrink: 0;
}
.htsd-read-icon-circle svg { stroke: #fff; }
.htsd-read-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

/* Right Card */
.htsd-card-area {
  position: relative;
}
.htsd-track {
  position: relative;
}
.htsd-card {
  display: none;
  background: #ffffff;
  border-radius: 20px;
  padding: 40px 36px;
  position: relative;
  box-shadow: 0 20px 50px rgba(0,0,0,0.2);
  animation: htsdFade 0.5s ease;
}
.htsd-card--active { display: block; }
@keyframes htsdFade {
  from { opacity: 0; transform: translateX(16px); }
  to   { opacity: 1; transform: translateX(0); }
}
.htsd-card-quote {
  font-family: 'Playfair Display', serif;
  font-size: 64px;
  line-height: 0.8;
  color: #4DB6AC;
  opacity: 0.3;
  margin-bottom: 14px;
  pointer-events: none;
}
.htsd-card-stars {
  display: flex;
  gap: 3px;
  margin-bottom: 18px;
}
.htsd-star { font-size: 17px; color: #E5E7EB; }
.htsd-star.filled { color: #EAB308; }
.htsd-card-msg {
  font-size: 15px;
  line-height: 1.8;
  color: #555;
  margin-bottom: 26px;
  font-style: italic;
  font-family: 'Outfit', sans-serif;
}
.htsd-card-author {
  display: flex;
  align-items: center;
  gap: 14px;
  border-top: 1px solid #f0f0f0;
  padding-top: 18px;
}
.htsd-card-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  overflow: hidden;
  flex-shrink: 0;
  background: linear-gradient(135deg, #4DB6AC, #3d9e94);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  font-weight: 700;
  box-shadow: 0 4px 12px rgba(77,182,172,0.3);
}
.htsd-card-avatar img { width: 100%; height: 100%; object-fit: cover; }
.htsd-card-name {
  font-family: 'Outfit', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: #2b2b2b;
}
.htsd-card-role {
  font-size: 12px;
  color: #888;
  font-weight: 500;
  margin-top: 2px;
}

/* Dots */
.htsd-dots {
  display: flex;
  gap: 8px;
  margin-top: 20px;
  justify-content: center;
}
.htsd-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: none;
  background: rgba(255,255,255,0.3);
  cursor: pointer;
  transition: all 0.3s;
  padding: 0;
}
.htsd-dot--active {
  background: #4DB6AC;
  width: 28px;
  border-radius: 5px;
}

/* Responsive */
@media (max-width: 991px) {
  .htsd-grid {
    grid-template-columns: 1fr;
    gap: 40px;
  }
  .htsd-left-inner {
    grid-template-columns: 1fr auto;
    gap: 24px;
  }
  .htsd-text-col { align-items: flex-start; }
}
@media (max-width: 768px) {
  .htsd-left-inner {
    grid-template-columns: 1fr;
    gap: 24px;
    text-align: center;
  }
  .htsd-text-col { align-items: center; }
  .htsd-rating-box { margin: 0 auto; }
}
@media (max-width: 480px) {
  .htsd-section { padding: 60px 5%; }
  .htsd-card { padding: 30px 24px; }
  .htsd-rating-box { padding: 22px 22px 18px; min-width: 150px; }
  .htsd-rating-num { font-size: 40px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const cards = document.querySelectorAll('.htsd-card');
  const dots  = document.querySelectorAll('.htsd-dot');
  if (!cards.length || cards.length <= 1) return;

  let current = 0;
  let timer;

  function goTo(idx) {
    cards[current].classList.remove('htsd-card--active');
    dots[current] && dots[current].classList.remove('htsd-dot--active');
    current = (idx + cards.length) % cards.length;
    cards[current].classList.add('htsd-card--active');
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
