@extends('layouts.app')

@section('title', 'About Us - Anu | Birth Doula & Childbirth Educator')

@section('content')

  <x-page-banner
    title="My Story"
    subtitle="Walking Alongside You · Anu — Birth Doula"
    :image="asset('images/banner-about.png')"
    :breadcrumbs="[['label' => 'About Us']]"
  />

  <!-- Founder Bio Section -->
  <section class="founder-bio-section">
    <div class="container">
      <div class="founder-bio-grid">
        <!-- Left: Image with decorative frame -->
        <div class="founder-bio-img-col reveal">
          <div class="founder-img-frame">
            <div class="founder-img-accent"></div>
            <div class="founder-img-dot founder-img-dot--1"></div>
            <div class="founder-img-dot founder-img-dot--2"></div>
            <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Anu - Birth Doula" class="founder-img">
          </div>
          <!-- Experience badge -->
          <div class="founder-exp-badge reveal d2">
            <span class="founder-exp-num">10+</span>
            <span class="founder-exp-label">Years of<br>Experience</span>
          </div>
        </div>

        <!-- Right: Content -->
        <div class="founder-bio-text-col reveal d1">
          <span class="founder-bio-label">About the Founder</span>
          <h2 class="founder-bio-title">Meet Anu, Your Birth Doula & Wellness Guide</h2>

          <!-- Quote -->
          <blockquote class="founder-quote">
            <svg class="founder-quote-icon" width="32" height="32" viewBox="0 0 24 24" fill="#4DB6AC" opacity="0.3"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>
            Every woman deserves to feel seen, heard, and supported throughout her birth journey.
          </blockquote>

          <div class="founder-bio-content">
            <p><strong>I am Anu</strong>, a Birth Doula, Prenatal Yoga Instructor, Childbirth Educator, and Nutritionist, and a mother of two teenage children. My journey as a mother, combined with my professional training and experience, allows me to offer deeply compassionate, knowledgeable, and grounded support to women during one of the most transformative phases of their lives.</p>
            <p>I believe childbirth is not only a physical experience but also an emotional and spiritual transformation. Every journey is unique, and every woman deserves care that honours her choices, her body, and her voice.</p>
          </div>

          <!-- Highlight tags -->
          <div class="founder-tags">
            <span class="founder-tag">Birth Doula</span>
            <span class="founder-tag">Prenatal Yoga</span>
            <span class="founder-tag">Childbirth Educator</span>
            <span class="founder-tag">Nutritionist</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
  .founder-bio-section {
    padding: 100px 6%;
    background: #fdfbfa;
    overflow: hidden;
    position: relative;
  }
  .founder-bio-section::before {
    content: '';
    position: absolute;
    top: -100px; right: -100px;
    width: 350px; height: 350px;
    border-radius: 50%;
    background: rgba(77,182,172,0.04);
    pointer-events: none;
  }
  .founder-bio-grid {
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 70px;
    align-items: center;
    max-width: 1240px;
    margin: 0 auto;
  }

  /* Image column */
  .founder-bio-img-col {
    position: relative;
    z-index: 1;
  }
  .founder-img-frame {
    position: relative;
  }
  .founder-img-accent {
    position: absolute;
    top: -16px; left: -16px;
    width: 100%; height: 100%;
    border-radius: 32px;
    border: 2px solid #4DB6AC;
    opacity: 0.2;
    z-index: -1;
  }
  .founder-img-dot {
    position: absolute;
    border-radius: 50%;
    z-index: -1;
  }
  .founder-img-dot--1 {
    width: 80px; height: 80px;
    background: rgba(245,213,213,0.5);
    top: -30px; right: -20px;
  }
  .founder-img-dot--2 {
    width: 50px; height: 50px;
    background: rgba(77,182,172,0.12);
    bottom: 40px; left: -25px;
  }
  .founder-img {
    width: 100%;
    max-height: 580px;
    border-radius: 32px;
    box-shadow: 0 24px 60px rgba(0,0,0,0.1);
    display: block;
    object-fit: cover;
    object-position: top;
  }

  /* Experience badge */
  .founder-exp-badge {
    position: absolute;
    bottom: -20px; right: -20px;
    background: #ffffff;
    border-radius: 20px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    border: 1px solid rgba(77,182,172,0.1);
    z-index: 5;
  }
  .founder-exp-num {
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    font-weight: 700;
    color: #4DB6AC;
    line-height: 1;
  }
  .founder-exp-label {
    font-size: 13px;
    font-weight: 600;
    color: #7a6060;
    line-height: 1.35;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Text column */
  .founder-bio-label {
    display: inline-block;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 3px;
    color: #4DB6AC;
    margin-bottom: 14px;
  }
  .founder-bio-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 44px);
    color: #2b2b2b;
    margin-bottom: 24px;
    line-height: 1.2;
  }

  /* Quote */
  .founder-quote {
    position: relative;
    font-family: 'Playfair Display', serif;
    font-size: 19px;
    font-style: italic;
    color: #3d2b2b;
    line-height: 1.7;
    padding: 20px 24px 20px 28px;
    margin: 0 0 28px 0;
    background: linear-gradient(135deg, rgba(245,213,213,0.25), rgba(77,182,172,0.06));
    border-left: 4px solid #4DB6AC;
    border-radius: 0 16px 16px 0;
  }
  .founder-quote-icon {
    position: absolute;
    top: 12px; right: 16px;
  }

  .founder-bio-content p {
    font-size: 16px;
    color: #666;
    line-height: 1.85;
    margin-bottom: 16px;
  }
  .founder-bio-content p strong {
    color: #3d2b2b;
  }

  /* Tags */
  .founder-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 28px;
  }
  .founder-tag {
    display: inline-block;
    padding: 8px 18px;
    border-radius: 100px;
    font-size: 13px;
    font-weight: 600;
    color: #4DB6AC;
    background: rgba(77,182,172,0.08);
    border: 1px solid rgba(77,182,172,0.15);
    transition: all 0.3s;
  }
  .founder-tag:hover {
    background: #4DB6AC;
    color: #fff;
    border-color: #4DB6AC;
  }

  @media (max-width: 991px) {
    .founder-bio-grid {
      grid-template-columns: 1fr;
      gap: 50px;
    }
    .founder-bio-img-col {
      max-width: 500px;
      margin: 0 auto;
    }
    .founder-exp-badge {
      bottom: -15px; right: 10px;
    }
  }
  @media (max-width: 480px) {
    .founder-bio-section { padding: 70px 5%; }
    .founder-exp-badge { padding: 14px 18px; }
    .founder-exp-num { font-size: 28px; }
    .founder-quote { font-size: 17px; padding: 16px 20px 16px 22px; }
  }
  </style>

  <!-- Vision & Mission Section -->
  <section class="vm-section" style="background-image: url('{{ asset('images/mission_bg.png') }}');">
    <div class="vm-overlay"></div>
    <div class="container">
      <div class="vm-header">
        <h2 class="section-title reveal d1" style="font-family: 'Playfair Display', serif; color: #ffffff; font-size: clamp(36px, 5vw, 56px); margin-bottom: 20px;">Our Mission & Vision</h2>
      </div>
      <div class="vm-grid">
        <!-- Mission Card -->
        <div class="vm-card reveal d1">
          <h3 class="vm-title">Our Mission</h3>
          <p class="vm-text">To provide compassionate, holistic birth support through doula care, prenatal yoga, childbirth education, and nutrition guidance — helping families navigate one of life's most transformative experiences with trust and love.</p>
        </div>
        <!-- Vision Card -->
        <div class="vm-card reveal d2">
          <h3 class="vm-title">Our Vision</h3>
          <p class="vm-text">To create a world where every woman feels empowered, supported, and celebrated throughout her pregnancy, birth, and postpartum journey — embracing motherhood with confidence, strength, and joy.</p>
        </div>
      </div>
    </div>
  </section>

  <style>
    /* Vision & Mission — Glassmorphism Theme */
    .vm-section {
      padding: 120px 6%;
      position: relative;
      background-size: cover;
      background-position: center;
      background-attachment: scroll;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 700px;
    }
    .vm-overlay {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.25); /* Adjusted to match screenshot styling gracefully */
      z-index: 1;
    }
    .vm-section .container {
      position: relative;
      z-index: 2;
      width: 100%;
    }
    .vm-header {
      text-align: center;
      margin-bottom: 60px;
    }
    .vm-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .vm-card {
      background: rgba(255, 255, 255, 0.15); /* Frosted glass */
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 20px;
      padding: 70px 50px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.25);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      transition: transform 0.4s ease;
    }
    .vm-card:hover {
      transform: translateY(-8px);
    }
    .vm-title {
      font-family: 'Outfit', sans-serif;
      font-size: 26px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 24px;
      letter-spacing: 0.5px;
    }
    .vm-text {
      color: rgba(255, 255, 255, 0.95);
      font-size: 17.5px;
      line-height: 1.85;
      margin: 0;
    }
    @media (max-width: 900px) {
      .vm-grid {
        grid-template-columns: 1fr;
        gap: 30px;
      }
      .vm-card {
        padding: 40px 30px;
      }
      .vm-section { padding: 80px 5%; min-height: auto; }
    }
  </style>

  <!-- Credentials & Training Section -->
  <section class="cred-section">
    <div class="container">
      <div class="cred-header">
        <span class="section-label reveal">Expertise & Qualifications</span>
        <h2 class="section-title reveal d1">Credentials & Training</h2>
      </div>
      <div class="cred-grid">
        <div class="cred-card reveal d1">
          <div class="cred-card-img">
            <img src="{{ asset('images/cred-doula.png') }}" alt="DONA Birth Doula">
          </div>
          <h4 class="cred-card-title">DONA-Trained Birth Doula</h4>
          <p class="cred-card-text">Certified through DONA International, the gold standard in birth doula training and support.</p>
        </div>
        <div class="cred-card reveal d2">
          <div class="cred-card-img">
            <img src="{{ asset('images/cred-stillbirthday.png') }}" alt="StillBirthday Doula">
          </div>
          <h4 class="cred-card-title">StillBirthday Certified Doula</h4>
          <p class="cred-card-text">Specialized training in bereavement support for families experiencing pregnancy or infant loss.</p>
        </div>
        <div class="cred-card reveal d3">
          <div class="cred-card-img">
            <img src="{{ asset('images/cred-prenatal-yoga.png') }}" alt="Prenatal Yoga">
          </div>
          <h4 class="cred-card-title">Prenatal & Postnatal Yoga Instructor</h4>
          <p class="cred-card-text">Guiding mothers through safe, nurturing yoga practices for strength and calm before and after birth.</p>
        </div>
        <div class="cred-card reveal d4">
          <div class="cred-card-img">
            <img src="{{ asset('images/cred-childbirth-edu.png') }}" alt="Childbirth Education">
          </div>
          <h4 class="cred-card-title">Childbirth Educator</h4>
          <p class="cred-card-text">Empowering families with evidence-based knowledge for confident, informed birth decisions.</p>
        </div>
        <div class="cred-card reveal d1">
          <div class="cred-card-img">
            <img src="{{ asset('images/cred-lactation.png') }}" alt="Lactation Education">
          </div>
          <h4 class="cred-card-title">Lactation Education</h4>
          <p class="cred-card-text">Supporting mothers with breastfeeding guidance and lactation knowledge for a smooth postpartum journey.</p>
        </div>
        <div class="cred-card reveal d2">
          <div class="cred-card-img">
            <img src="{{ asset('images/cred-therapeutic-yoga.png') }}" alt="Therapeutic Yoga">
          </div>
          <h4 class="cred-card-title">Therapeutic Yoga</h4>
          <p class="cred-card-text">Specialized yoga therapy for infertility and menopause, supporting women through every stage of life.</p>
        </div>
        <div class="cred-card reveal d3">
          <div class="cred-card-img">
            <img src="{{ asset('images/cred-advanced-yoga.png') }}" alt="Advanced Yoga Training">
          </div>
          <h4 class="cred-card-title">Advanced Yoga Teacher Training</h4>
          <p class="cred-card-text">Deepened practice and teaching skills through advanced-level yoga teacher certification and training.</p>
        </div>
      </div>
    </div>
  </section>

  <style>
    /* About Banner Large */
    .about-banner-lg.page-banner {
      min-height: 520px;
    }
    .about-banner-lg .page-banner-content {
      padding: 140px 6% 80px;
    }
    .about-banner-lg .page-banner-title {
      font-size: clamp(44px, 7vw, 76px);
    }
    .about-banner-lg .page-banner-subtitle {
      font-size: 20px;
      max-width: 680px;
    }
    @media (max-width: 768px) {
      .about-banner-lg.page-banner { min-height: 420px; }
      .about-banner-lg .page-banner-content { padding: 110px 5% 50px; }
      .about-banner-lg .page-banner-subtitle { font-size: 17px; }
    }

    /* About Main Grid */
    .about-main-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
      margin: 32px 0 0;
    }
    @media (max-width: 860px) {
      .about-main-grid { grid-template-columns: 1fr; gap: 24px; }
    }

    /* Credentials & Training */
    .cred-section {
      padding: 100px 6%;
      background: #ffffff;
    }
    .cred-header {
      text-align: center;
      margin-bottom: 40px;
    }
    .cred-img-wrap {
      max-width: 480px;
      margin: 0 auto 50px;
    }
    .cred-img-wrap img {
      width: 100%;
      height: auto;
      border-radius: 20px;
    }
    .cred-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      max-width: 1140px;
      margin: 0 auto;
    }
    .cred-card {
      background: #ffffff;
      border-radius: 20px;
      padding: 0 28px 32px;
      text-align: center;
      border: 1px solid #f0f0f0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .cred-card::before {
      content: '';
      position: absolute;
      bottom: 0; left: 0;
      width: 100%; height: 4px;
      background: linear-gradient(90deg, #4DB6AC, #80cbc4);
      opacity: 0;
      transition: opacity 0.3s;
    }
    .cred-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 16px 40px rgba(77,182,172,0.1);
      border-color: rgba(77,182,172,0.2);
    }
    .cred-card:hover::before { opacity: 1; }
    .cred-card-img {
      margin: 0 -28px 20px;
      width: calc(100% + 56px);
      overflow: hidden;
    }
    .cred-card-img img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      display: block;
    }
    .cred-card-title {
      font-family: 'Outfit', sans-serif;
      font-size: 17px;
      font-weight: 700;
      color: #3d2b2b;
      margin-bottom: 10px;
      line-height: 1.3;
    }
    .cred-card-text {
      color: #7a6060;
      font-size: 14px;
      line-height: 1.65;
      margin: 0;
    }

    @media (max-width: 1024px) {
      .cred-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
      .cred-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
      .cred-card { padding: 0 20px 24px; }
      .cred-card-img { margin: 0 -20px 16px; width: calc(100% + 40px); }
      .cred-section { padding: 70px 5%; }
    }
    @media (max-width: 480px) {
      .cred-grid { grid-template-columns: 1fr; }
    }
  </style>

  <!-- Our Journey Section -->
  <section class="journey-section">
    <div class="container">
      <div class="journey-header">
        <span class="sec-label reveal">Our Process</span>
        <h2 class="sec-title reveal d1" style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 44px); color: #3d2b2b;">Our Journey Together</h2>
      </div>
      
      <div class="journey-grid">
        <!-- Step 1 -->
        <div class="journey-step reveal d1">
          <div class="journey-img-wrap">
            <img src="{{ asset('images/step1_journey.png') }}" alt="Consultation">
            <div class="journey-badge">01</div>
          </div>
          
          <div class="journey-arrow d-none-mobile">
            <svg preserveAspectRatio="none" viewBox="0 0 100 40" style="width: 100%; height: 100%;">
              <path d="M0,38 Q50,-5 99,38" fill="none" stroke="#628575" stroke-width="1.5" vector-effect="non-scaling-stroke" />
            </svg>
            <svg class="arrow-head-svg" viewBox="0 0 10 10">
              <polygon points="0,0 10,5 0,10" fill="#628575" />
            </svg>
          </div>

          <h4 class="journey-title">Initial Consultation</h4>
          <p class="journey-text">We begin with a heartfelt conversation to understand your vision, needs, and desires for your birth experience, building a foundation of trust.</p>
        </div>

        <!-- Step 2 -->
        <div class="journey-step reveal d2">
          <div class="journey-img-wrap">
            <img src="{{ asset('images/step2_journey.png') }}" alt="Preparation">
            <div class="journey-badge">02</div>
          </div>

          <div class="journey-arrow d-none-mobile">
            <svg preserveAspectRatio="none" viewBox="0 0 100 40" style="width: 100%; height: 100%;">
              <path d="M0,38 Q50,-5 99,38" fill="none" stroke="#628575" stroke-width="1.5" vector-effect="non-scaling-stroke" />
            </svg>
            <svg class="arrow-head-svg" viewBox="0 0 10 10">
              <polygon points="0,0 10,5 0,10" fill="#628575" />
            </svg>
          </div>

          <h4 class="journey-title">Prenatal Preparation</h4>
          <p class="journey-text">Through childbirth education, prenatal yoga, and ongoing emotional support, you and your partner will feel prepared and empowered.</p>
        </div>

        <!-- Step 3 -->
        <div class="journey-step reveal d3">
          <div class="journey-img-wrap">
            <img src="{{ asset('images/step3_journey.png') }}" alt="Birth and Postpartum">
            <div class="journey-badge">03</div>
          </div>

          <h4 class="journey-title">Birth & Postpartum</h4>
          <p class="journey-text">Continuous, unwavering support during labor and birth, seamlessly transitioning into compassionate postpartum care as your family grows.</p>
        </div>
      </div>
    </div>
  </section>

  <style>
    .journey-section {
      padding: 100px 6%;
      background: #fdfefe; /* Very slight subtle background */
      position: relative;
      border-top: 1px solid #f0f0f0;
    }
    .journey-header {
      text-align: center;
      margin-bottom: 70px;
    }
    .journey-grid {
      display: flex;
      justify-content: center;
      gap: 30px;
      max-width: 1140px;
      margin: 0 auto;
    }
    .journey-step {
      flex: 1;
      text-align: center;
      position: relative;
    }
    .journey-img-wrap {
      width: 250px;
      height: 250px;
      margin: 0 auto 35px;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px dashed #89bbed;
      border-radius: 50%;
      padding: 12px;
    }
    .journey-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0 10px 20px rgba(0,0,0,0.06);
    }
    .journey-badge {
      position: absolute;
      top: 5px;
      right: 5px;
      width: 56px;
      height: 56px;
      background: #89bbed;
      color: #ffffff;
      font-family: 'Outfit', sans-serif;
      font-size: 22px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      box-shadow: 0 6px 15px rgba(137, 187, 237, 0.4);
      z-index: 2;
    }
    .journey-arrow {
      position: absolute;
      top: 100px;
      left: calc(50% + 140px);
      width: calc(100% - 280px);
      height: 40px;
      z-index: 10;
      pointer-events: none;
    }
    .arrow-head-svg {
      position: absolute;
      right: -3px;
      bottom: -1px;
      width: 12px;
      height: 12px;
      transform: rotate(38deg);
      transform-origin: center;
    }
    .journey-title {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
      font-size: 21px;
      color: #3d2b2b;
      margin-bottom: 16px;
      line-height: 1.3;
    }
    .journey-text {
      font-size: 15px;
      color: #7a6060;
      line-height: 1.7;
      margin: 0 auto;
      max-width: 320px;
    }
    @media (max-width: 991px) {
      .journey-grid {
        flex-direction: column;
        align-items: center;
        gap: 60px;
      }
      .journey-step {
        width: 100%;
        max-width: 450px;
      }
      .d-none-mobile {
        display: none;
      }
    }
  </style>

  <!-- Why Choose Us Section -->
  <section class="why-choose-section">
    <div class="container">
      <div class="why-choose-header">
        <span class="sec-label reveal">Why Choose Us</span>
        <h2 class="sec-title reveal d1" style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 44px); color: #3d2b2b;">Holistic Care for Mother and Baby</h2>
      </div>

      <div class="why-choose-us-grid">
        <div class="why-card reveal d1">
          <div class="why-card-img-wrapper">
             <img src="{{ asset('images/why_support.png') }}" class="why-card-img" alt="Personalized Support">
          </div>
          <div class="why-card-content">
            <h4 class="why-title">Personalized Support</h4>
            <p class="why-text">Every pregnancy and birth is unique. We provide tailored care that respects your individual preferences, cultural background, and medical needs.</p>
          </div>
        </div>
        <div class="why-card reveal d2">
          <div class="why-card-img-wrapper">
             <img src="{{ asset('images/why_advocacy.png') }}" class="why-card-img" alt="Unwavering Advocacy">
          </div>
          <div class="why-card-content">
            <h4 class="why-title">Unwavering Advocacy</h4>
            <p class="why-text">Your voice matters. We ensure you feel informed and empowered to make decisions confidently, advocating for your birth plan in any setting.</p>
          </div>
        </div>
        <div class="why-card reveal d3">
          <div class="why-card-img-wrapper">
             <img src="{{ asset('images/why_mindbody.png') }}" class="why-card-img" alt="Mind & Body Connection">
          </div>
          <div class="why-card-content">
            <h4 class="why-title">Mind & Body Connection</h4>
            <p class="why-text">Through prenatal yoga and focused childbirth education, we bridge physical preparation with mental resilience for a calmer labor experience.</p>
          </div>
        </div>
      </div>
    </div>
    <style>
      .why-choose-section {
        padding: 100px 6%;
        background: #fafafb;
        position: relative;
      }
      .why-choose-header {
        text-align: center;
        margin-bottom: 70px;
      }
      .why-choose-us-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 36px;
        max-width: 1160px;
        margin: 0 auto;
      }
      .why-card {
        background: #ffffff;
        border-radius: 20px;
        text-align: center;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.03);
      }
      .why-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(77, 182, 172, 0.15);
      }
      .why-card-img-wrapper {
        width: 100%;
        height: 240px;
        overflow: hidden;
        position: relative;
      }
      .why-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
      }
      .why-card:hover .why-card-img {
        transform: scale(1.05);
      }
      .why-card-content {
        padding: 40px 30px;
      }
      .why-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 22px;
        color: #3d2b2b;
        margin-bottom: 16px;
      }
      .why-text {
        font-size: 15.5px;
        color: #7a6060;
        line-height: 1.7;
        margin: 0;
      }
      @media (max-width: 991px) {
        .why-choose-us-grid {
          gap: 24px;
        }
      }
      @media (max-width: 860px) {
        .why-choose-us-grid {
          grid-template-columns: 1fr;
          max-width: 500px;
        }
        .why-choose-section {
          padding: 80px 5%;
        }
      }
    </style>
  </section>

  <!-- Book Consultation CTA -->
  <section class="about-cta-section">
    <div class="about-cta-bg" style="background-image: url('{{ asset('images/mission_bg.png') }}');"></div>
    <div class="about-cta-overlay"></div>
    <div class="container">
      <div class="about-cta-grid">
        <!-- Left: Text -->
        <div class="about-cta-text reveal">
          <span class="about-cta-label">Let's Connect</span>
          <h2 class="about-cta-title">Begin Your Empowered Birth Journey</h2>
          <p class="about-cta-desc">Whether you're expecting, planning, or simply curious — I'd love to hear from you. Let's create a birth experience that feels safe, supported, and truly yours.</p>
          <div class="about-cta-trust">
            <div class="about-cta-trust-item">
              <svg width="24" height="24" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              <span>Personalised birth plans</span>
            </div>
            <div class="about-cta-trust-item">
              <svg width="24" height="24" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              <span>Prenatal & postnatal support</span>
            </div>
            <div class="about-cta-trust-item">
              <svg width="24" height="24" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              <span>Free initial consultation</span>
            </div>
          </div>
        </div>

        <!-- Right: Form -->
        <div class="about-cta-form-wrap reveal d1">
          <h3 class="about-cta-form-title">Book Consultation</h3>
          <p class="about-cta-form-sub">Share your details and we'll respond with the right guidance for your journey.</p>
          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="about-cta-row">
              <div class="about-cta-field">
                <input type="text" name="name" placeholder="Your Name *" required>
              </div>
              <div class="about-cta-field">
                <input type="tel" name="phone" placeholder="Phone Number">
              </div>
            </div>
            <div class="about-cta-field">
              <input type="email" name="email" placeholder="Email Address *" required>
            </div>
            <div class="about-cta-field">
              <select name="subject">
                <option value="" disabled selected>What are you looking for? *</option>
                <option value="Birth Doula Support">Birth Doula Support</option>
                <option value="Prenatal Yoga">Prenatal Yoga</option>
                <option value="Childbirth Education">Childbirth Education</option>
                <option value="Postnatal Support">Postnatal Support</option>
                <option value="Lactation Support">Lactation Support</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="about-cta-field">
              <textarea name="message" rows="3" placeholder="Tell us about your journey..." required></textarea>
            </div>
            <button type="submit" class="about-cta-submit">Book My Consultation</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <style>
    .about-cta-section {
      position: relative;
      padding: 80px 6%;
      overflow: hidden;
      min-height: 580px;
      display: flex;
      align-items: center;
      border-radius: 40px;
      margin: 0 4% 60px;
    }
    .about-cta-bg {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      border-radius: 40px;
      z-index: 0;
    }
    .about-cta-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(30, 40, 35, 0.85) 0%, rgba(40, 55, 45, 0.7) 100%);
      border-radius: 40px;
      z-index: 1;
    }
    .about-cta-section .container {
      position: relative;
      z-index: 2;
      width: 100%;
    }
    .about-cta-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
    }
    .about-cta-label {
      display: inline-block;
      text-transform: uppercase;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 3px;
      color: #4DB6AC;
      margin-bottom: 16px;
    }
    .about-cta-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(32px, 4vw, 48px);
      color: #ffffff;
      line-height: 1.2;
      margin-bottom: 20px;
    }
    .about-cta-desc {
      font-size: 17px;
      color: rgba(255,255,255,0.8);
      line-height: 1.75;
      margin-bottom: 32px;
      max-width: 480px;
    }
    .about-cta-trust {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .about-cta-trust-item {
      display: flex;
      align-items: center;
      gap: 12px;
      color: rgba(255,255,255,0.85);
      font-size: 15px;
      font-weight: 500;
    }
    .about-cta-trust-item svg { flex-shrink: 0; }

    .about-cta-form-wrap {
      background: rgba(255,255,255,0.97);
      border-radius: 24px;
      padding: 40px 36px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .about-cta-form-title {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: #3d2b2b;
      margin-bottom: 8px;
    }
    .about-cta-form-sub {
      font-size: 14px;
      color: #7a6060;
      margin-bottom: 28px;
      line-height: 1.6;
    }
    .about-cta-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }
    .about-cta-field {
      margin-bottom: 14px;
    }
    .about-cta-field input,
    .about-cta-field select,
    .about-cta-field textarea {
      width: 100%;
      padding: 14px 16px;
      border: 1.5px solid #e8e0e0;
      border-radius: 12px;
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      color: #3d2b2b;
      background: #faf8f8;
      transition: border-color 0.3s, box-shadow 0.3s;
      outline: none;
      box-sizing: border-box;
    }
    .about-cta-field input::placeholder,
    .about-cta-field textarea::placeholder {
      color: #b0a0a0;
    }
    .about-cta-field input:focus,
    .about-cta-field select:focus,
    .about-cta-field textarea:focus {
      border-color: #4DB6AC;
      box-shadow: 0 0 0 3px rgba(77,182,172,0.12);
    }
    .about-cta-field select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237a6060' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 16px center;
      padding-right: 40px;
    }
    .about-cta-field textarea {
      resize: vertical;
      min-height: 80px;
    }
    .about-cta-submit {
      width: 100%;
      padding: 16px;
      background: var(--grad-teal);
      color: #ffffff;
      font-family: 'Outfit', sans-serif;
      font-size: 16px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 4px;
    }
    .about-cta-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(77,182,172,0.4);
      opacity: 0.9;
    }
    @media (max-width: 991px) {
      .about-cta-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      .about-cta-text { text-align: center; }
      .about-cta-desc { margin-left: auto; margin-right: auto; }
      .about-cta-trust { align-items: center; }
    }
    @media (max-width: 480px) {
      .about-cta-row { grid-template-columns: 1fr; }
      .about-cta-form-wrap { padding: 28px 22px; }
      .about-cta-section { padding: 60px 5%; border-radius: 24px; margin: 0 3% 40px; }
    }
  </style>

@endsection
