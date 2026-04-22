@extends('layouts.app')

@section('title', 'About Us - Anu | Birth Doula & Childbirth Educator')

@section('content')

  <!-- Founder Bio Section -->
  <section class="founder-bio-section">
    <div class="container">
      <div class="founder-bio-grid">
        <!-- Left: "I am Anu" heading, then standing image -->
        <div class="founder-bio-img-col reveal">
          <h2 class="founder-bio-name">I am Anu</h2>
          <div class="founder-standing-wrap">
            <div class="founder-img-frame-outer">
              <img
                src="{{ asset('storage/Fonder Note.jpeg') }}"
                alt="Anu — Birth Doula & Childbirth Educator"
                class="founder-standing-img">
            </div>
          </div>
        </div>

        <!-- Right: Content, "Founder Note" aligns to top of image -->
        <div class="founder-bio-text-col reveal d1">
          <span class="founder-bio-label">Founder Note</span>
          <div class="founder-bio-content">
            <p>A Birth Doula, Prenatal Yoga Instructor, Childbirth Educator, Nutritionist, and a mother of two teenage children. My journey as a mother, combined with my professional training and experience, allows me to offer deeply compassionate, knowledgeable, and grounded support to women during one of the most transformative phases of their lives.</p>
            <p>I believe childbirth is not only a physical experience but also an emotional and spiritual transformation. Every journey is unique, and every woman deserves care that honours her choices, her body, and her voice.</p>
          </div>

          <div class="founder-bio-content founder-bio-beyond">
            <h3 class="founder-beyond-inline-title"><strong>Beyond the Profession</strong></h3>
            <p class="founder-beyond-inline-sub">A Life of Strength &amp; Stillness</p>
            <p>Beyond my work, I find strength in ultramarathons, mountain climbing, and exploring new places. These experiences have deeply shaped my resilience and mindset, allowing me to bring calm, steady, and grounded support to every birth journey.</p>
          </div>

          <!-- Founder quote, inline at end of this slide -->
          <blockquote class="founder-inline-quote">
            "Dear mama, I look forward to being part of your journey—reminding you that you are powerful, capable, and made for this sacred work of bringing life into the world."
          </blockquote>
        </div>

      </div>

    </div>
  </section>

  <style>
  /* Wrap CTA in white background to hide page pink */
  .about-cta-wrap {
    background: #ffffff;
    padding: 60px 0 100px;
  }
  /* Light CTA override (about page) — light teal/logo-blue tint */
  .cta-modern-card.cta-modern-card--light {
    background: linear-gradient(135deg, #e6f6f5 0%, #d8efec 55%, #e9f4f3 100%);
    box-shadow: 0 20px 50px -18px rgba(47, 169, 163, 0.25);
  }
  .cta-modern-card.cta-modern-card--light p.cta-quote-light {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: clamp(18px, 2vw, 24px);
    color: #000 !important;
    max-width: 760px;
    margin: 0 auto;
    line-height: 1.75;
  }
  .cta-title-light {
    font-family: 'Playfair Display', serif;
    font-size: clamp(30px, 4vw, 44px);
    margin-bottom: 14px;
    color: #2b2b2b;
  }
  .cta-sub-light {
    font-size: 17px;
    color: #666;
    max-width: 600px;
    margin: 0 auto 32px;
    line-height: 1.6;
  }
  /* About-page Book Consultation CTA (heading + desc + button) */
  .about-book-cta {
    max-width: 980px;
    margin: 110px auto 0;
    padding: 56px 48px;
    text-align: center;
    background: linear-gradient(135deg, #e6f6f5 0%, #d8efec 55%, #e9f4f3 100%);
    border-radius: 32px;
    box-shadow: 0 20px 50px -18px rgba(47,169,163,0.22);
  }
  .about-book-cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(24px, 3vw, 34px);
    color: #1f3b38;
    line-height: 1.35;
    margin: 0 0 18px;
    font-weight: 700;
  }
  .about-book-cta-desc {
    font-size: 17px;
    line-height: 1.75;
    color: #3d3d3d;
    max-width: 720px;
    margin: 0 auto 28px;
  }
  .about-book-cta-btn {
    display: inline-flex;
  }
  @media (max-width: 767px) {
    .about-book-cta { padding: 38px 24px; margin-top: 70px; border-radius: 24px; }
    .about-book-cta-desc { font-size: 15px; }
  }

  /* About-page Book Consultation form */
  .about-book-section {
    max-width: 1240px;
    margin: 110px auto 0;
    padding: 50px;
    background: linear-gradient(135deg, #e6f6f5 0%, #d8efec 55%, #e9f4f3 100%);
    border-radius: 32px;
    box-shadow: 0 20px 50px -18px rgba(47,169,163,0.22);
  }
  .about-book-grid {
    display: grid;
    grid-template-columns: 1fr 1.05fr;
    gap: 50px;
    align-items: center;
  }
  .about-book-img {
    width: 100%;
    border-radius: 24px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.12);
    display: block;
    object-fit: cover;
    aspect-ratio: 1 / 1.05;
  }
  .about-book-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(26px, 3vw, 34px);
    color: #2b2b2b;
    margin: 0 0 12px;
    line-height: 1.25;
  }
  .about-book-sub {
    font-size: 15.5px;
    color: #555;
    line-height: 1.7;
    margin: 0 0 24px;
  }
  .about-book-form .abf-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
  }
  .about-book-form .abf-field {
    margin-bottom: 14px;
  }
  .about-book-form .abf-field label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 6px;
    letter-spacing: .2px;
  }
  .about-book-form input,
  .about-book-form textarea,
  .about-book-form select {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid #d4e6e4;
    border-radius: 12px;
    background: #ffffff;
    font-size: 15px;
    color: #2b2b2b;
    font-family: inherit;
    transition: border-color .25s, box-shadow .25s;
    outline: none;
  }
  .about-book-form input:focus,
  .about-book-form textarea:focus,
  .about-book-form select:focus {
    border-color: #2FA9A3;
    box-shadow: 0 0 0 4px rgba(47,169,163,0.12);
  }
  .abf-phone {
    display: grid;
    grid-template-columns: 80px 1fr;
    gap: 6px;
  }
  .abf-phone .abf-cc {
    padding: 12px 6px 12px 10px;
    font-size: 13px;
    appearance: none;
    -webkit-appearance: none;
    background-image: linear-gradient(45deg, transparent 50%, #2FA9A3 50%), linear-gradient(135deg, #2FA9A3 50%, transparent 50%);
    background-position: calc(100% - 10px) center, calc(100% - 6px) center;
    background-size: 4px 4px, 4px 4px;
    background-repeat: no-repeat;
    padding-right: 20px;
    cursor: pointer;
  }
  .about-book-form input[type="date"] {
    font-family: inherit;
    color: #2b2b2b;
  }
  .about-book-form textarea { resize: vertical; }
  .about-book-form .cta-book-btn {
    border: none;
    margin-top: 8px;
    cursor: pointer;
  }
  .abf-alert {
    margin-top: 16px;
    padding: 12px 14px;
    border-radius: 10px;
    font-size: 14px;
  }
  .abf-alert--ok { background: #e8f8ef; color: #2d7a4b; }
  .abf-alert--err { background: #fde8e8; color: #c0392b; }
  @media (max-width: 860px) {
    .about-book-section { padding: 28px; margin-top: 60px; }
    .about-book-grid { grid-template-columns: 1fr; gap: 28px; }
    .about-book-form .abf-row { grid-template-columns: 1fr; }
  }

  .cta-book-btn {
    display: inline-block;
    background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%);
    color: #fff;
    text-decoration: none;
    padding: 16px 44px;
    border-radius: 100px;
    font-weight: 700;
    font-size: 16px;
    letter-spacing: .3px;
    transition: transform .3s cubic-bezier(.2,.7,.2,1), box-shadow .3s, background .3s;
    box-shadow: 0 12px 28px -6px rgba(47,169,163,0.45);
  }
  .cta-book-btn:hover {
    transform: translateY(-3px);
    background: linear-gradient(135deg, #33b8b1 0%, #25a09a 100%);
    box-shadow: 0 18px 40px -6px rgba(47,169,163,0.55);
    color: #fff;
  }

  .founder-bio-section {
    padding: 130px 6% 70px;
    background: #fdfbfa;
    overflow: hidden;
    position: relative;
  }
  @media (max-width: 768px) {
    .founder-bio-section { padding-top: 110px; }
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
    align-items: start;
    max-width: 1240px;
    margin: 0 auto;
  }

  /* Image column */
  .founder-bio-img-col {
    position: relative;
    z-index: 1;
  }
  .founder-bio-img-col .founder-bio-name {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 44px);
    font-weight: 700;
    color: #1f3b38;
    line-height: 1.15;
    margin: 0 0 22px;
    text-align: center;
  }
  .founder-standing-wrap {
    width: 100%;
    display: flex;
    justify-content: center;
  }
  .founder-img-frame-outer {
    position: relative;
    display: inline-block;
    background: #f5f5f5;
    border-radius: 26px;
    border-top: 2px solid rgba(77,182,172,0.55);
    border-left: 2px solid rgba(77,182,172,0.55);
    border-right: none;
    border-bottom: none;
    padding: 8px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.08);
  }
  /* Pink blob — top right */
  .founder-img-frame-outer::before {
    content: '';
    position: absolute;
    top: -14px;
    right: -14px;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: rgba(245, 200, 200, 0.55);
    z-index: 3;
    pointer-events: none;
  }
  /* Teal blob — bottom left */
  .founder-img-frame-outer::after {
    content: '';
    position: absolute;
    bottom: -14px;
    left: -14px;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: rgba(77, 182, 172, 0.25);
    z-index: 3;
    pointer-events: none;
  }
  .founder-standing-img {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 420px;
    height: 560px;
    border-radius: 20px;
    object-fit: cover;
    object-position: top center;
    display: block;
  }
  /* Right column sits a bit higher than image so bio fills vertical space */
  .founder-bio-text-col {
    padding-top: 18px;
  }
  @media (max-width: 991px) {
    .founder-bio-text-col { padding-top: 0; }
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
  .founder-img-accent--right {
    left: auto; right: -16px;
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

  /* Text column */
  .founder-bio-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-transform: uppercase;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2.5px;
    color: #4DB6AC;
    margin-bottom: 14px;
  }
  .founder-bio-label::before {
    content: '';
    width: 24px;
    height: 2px;
    background: #4DB6AC;
    border-radius: 2px;
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
    font-size: 16.5px;
    color: #666;
    line-height: 1.75;
    margin-bottom: 12px;
  }
  .founder-bio-content p strong {
    color: #3d2b2b;
  }
  .founder-mountain-col {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 60px;
  }
  .founder-mountain-polaroid {
    background: #fff;
    padding: 10px 10px 40px;
    border-radius: 4px;
    box-shadow: 0 20px 50px rgba(15,35,45,0.18), 0 4px 12px rgba(0,0,0,0.08);
    transform: rotate(3deg);
    transition: transform 0.3s ease;
    max-width: 180px;
    position: relative;
  }
  .founder-mountain-polaroid:hover {
    transform: rotate(0deg) scale(1.03);
  }
  .founder-mountain-img {
    width: 160px;
    height: 200px;
    object-fit: cover;
    object-position: center 20%;
    display: block;
    border-radius: 2px;
  }
  .founder-mountain-caption {
    text-align: center;
    font-family: 'Outfit', sans-serif;
    font-size: 12px;
    color: #888;
    margin-top: 8px;
    letter-spacing: 0.5px;
  }
  .founder-inline-quote {
    position: relative;
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: clamp(15px, 1.3vw, 17px);
    color: #1f3b38;
    line-height: 1.65;
    margin: 22px 0 0;
    padding: 16px 20px;
    background: linear-gradient(135deg, rgba(245,213,213,0.3), rgba(77,182,172,0.08));
    border-left: 4px solid #4DB6AC;
    border-radius: 0 16px 16px 0;
  }
  .founder-bio-beyond { margin-top: 18px; }
  .founder-beyond-inline-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(18px, 1.8vw, 22px);
    color: #2b2b2b;
    line-height: 1.3;
    margin: 0 0 4px;
    font-weight: 600;
  }
  .founder-beyond-inline-title strong {
    font-weight: 700;
    color: #1f3b38;
  }
  .founder-beyond-inline-sub {
    font-family: 'Playfair Display', serif;
    font-size: clamp(17px, 1.8vw, 22px);
    font-style: italic;
    font-weight: 500;
    color: #4DB6AC;
    margin: 0 0 12px !important;
    line-height: 1.25;
    letter-spacing: 0.3px;
  }

  /* Beyond the profession */
  .founder-beyond-grid {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 70px;
    align-items: center;
    max-width: 1240px;
    margin: 110px auto 0;
  }
  .founder-beyond-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3.4vw, 38px);
    color: #2b2b2b;
    margin: 0 0 20px;
    line-height: 1.25;
  }
  .founder-beyond-text-col p {
    font-size: 16px;
    color: #666;
    line-height: 1.85;
    margin: 0;
  }

  /* Beyond the Profession — single image */
  .beyond-single {
    position: relative;
    width: 100%;
    max-width: 520px;
    margin: 0 auto;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 24px 60px rgba(47,169,163,0.18);
  }
  .beyond-single img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
  }

  /* Slide-in animations (heading from left, image from right) */
  .beyond-anim-left,
  .beyond-anim-right {
    opacity: 0;
    transition: opacity .9s cubic-bezier(.2,.7,.2,1), transform .9s cubic-bezier(.2,.7,.2,1);
  }
  .beyond-anim-left  { transform: translateX(-60px); }
  .beyond-anim-right { transform: translateX(60px); transition-delay: .15s; }
  .beyond-anim-left.is-visible,
  .beyond-anim-right.is-visible {
    opacity: 1;
    transform: translateX(0);
  }

  /* Blob collage for Beyond the Profession */
  .beyond-blob-stack {
    position: relative;
    width: 100%;
    max-width: 520px;
    margin: 0 auto;
    aspect-ratio: 1 / 1.15;
  }
  .beyond-blob {
    position: absolute;
    overflow: hidden;
    box-shadow: 0 18px 48px rgba(47,169,163,0.18);
  }
  .beyond-blob img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .beyond-blob--person {
    top: 0;
    left: 0;
    width: 62%;
    height: 72%;
    border-radius: 58% 42% 55% 45% / 52% 60% 40% 48%;
    z-index: 2;
  }
  .beyond-blob--scene {
    right: 0;
    bottom: 0;
    width: 62%;
    height: 62%;
    border-radius: 48% 52% 42% 58% / 60% 45% 55% 40%;
    z-index: 1;
  }

  @media (max-width: 640px) {
    .beyond-blob-stack { max-width: 380px; aspect-ratio: 1 / 1.2; }
  }

  /* Closing quote + CTA */
  .founder-closing {
    max-width: 900px;
    margin: 110px auto 0;
    text-align: center;
  }
  .founder-closing-quote {
    position: relative;
    font-family: 'Playfair Display', serif;
    font-size: clamp(20px, 2.2vw, 26px);
    font-style: italic;
    color: #3d2b2b;
    line-height: 1.7;
    padding: 32px 36px;
    margin: 0 0 32px;
    background: linear-gradient(135deg, rgba(245,213,213,0.3), rgba(77,182,172,0.08));
    border-radius: 20px;
    border: 1px solid rgba(77,182,172,0.15);
  }
  .founder-closing-btn {
    display: inline-block;
    padding: 16px 40px;
    background: var(--grad-teal);
    color: #ffffff;
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 8px 24px rgba(77,182,172,0.25);
  }
  .founder-closing-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(77,182,172,0.4);
    opacity: 0.95;
  }

  @media (max-width: 991px) {
    .founder-bio-grid,
    .founder-beyond-grid {
      grid-template-columns: 1fr;
      gap: 50px;
    }
    .founder-mountain-col { display: none; }
    .founder-beyond-grid {
      margin-top: 80px;
    }
    .founder-beyond-img-col {
      order: -1;
      max-width: 500px;
      margin: 0 auto;
    }
    .founder-bio-img-col {
      max-width: 500px;
      margin: 0 auto;
    }
    .founder-closing { margin-top: 80px; }
  }
  @media (max-width: 480px) {
    .founder-bio-section { padding: 100px 5% 70px; }
    .founder-quote { font-size: 17px; padding: 16px 20px 16px 22px; }
    .founder-closing-quote { padding: 24px 22px; }
  }
  </style>

  <!-- Credentials & Training Section -->
  <section class="cred-section">
    <div class="container">
      <div class="cred-header">
        <span class="section-label reveal">Expertise & Qualifications</span>
        <h2 class="section-title reveal d1">Professional Training & Certifications</h2>
      </div>

      <div class="cred-layout">
        <!-- LEFT: Yoga Image (background removed via mix-blend-mode) -->
        <div class="cred-side-img reveal">
          <img src="{{ asset('storage/yoga-pose.jpeg.jpeg') }}" alt="Anu practicing yoga">
        </div>

        <!-- RIGHT: All certifications stacked with logo -->
        <div class="cred-features-wrapper">
          <div class="cred-features">
            <div class="cred-item reveal-right">
              <div class="cred-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="6" r="3"></circle><path d="M8.5 11.5a4.5 4.5 0 0 0 7 0"></path><path d="M6 21c0-3.5 1.5-6.5 4-8.5"></path><path d="M18 21c0-3.5-1.5-6.5-4-8.5"></path><path d="M9 21c0-2.5 1.5-4 3-4s3 1.5 3 4"></path></svg>
              </div>
              <div class="cred-item-body">
                <h4 class="cred-item-title">DONA-Trained and Certified Birth Doula</h4>
              </div>
            </div>
            <div class="cred-item reveal-right d1">
              <div class="cred-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 7.5a4.5 4.5 0 1 1 4.5 4.5M12 7.5A4.5 4.5 0 1 0 7.5 12M12 7.5V9m-4.5 3a4.5 4.5 0 1 0 4.5 4.5M7.5 12H9m7.5 0a4.5 4.5 0 1 1-4.5 4.5m4.5-4.5H15m-3 4.5V15"/></svg>
              </div>
              <div class="cred-item-body">
                <h4 class="cred-item-title">StillBirthday Certified Doula</h4>
              </div>
            </div>
            <div class="cred-item reveal-right d2">
              <div class="cred-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21c-2.3-2.3-6-5-6-9 0-3.3 2.7-6 6-6s6 2.7 6 6c0 4-3.7 6.7-6 9z"></path></svg>
              </div>
              <div class="cred-item-body">
                <h4 class="cred-item-title">International Certified Prenatal &amp; Postnatal Yoga Instructor</h4>
              </div>
            </div>
            <div class="cred-item reveal-right d3">
              <div class="cred-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
              </div>
              <div class="cred-item-body">
                <h4 class="cred-item-title">Childbirth Educator</h4>
              </div>
            </div>
            <div class="cred-item reveal-right d4">
              <div class="cred-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path></svg>
              </div>
              <div class="cred-item-body">
                <h4 class="cred-item-title">Lactation Education</h4>
              </div>
            </div>
            <div class="cred-item reveal-right d5">
              <div class="cred-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 5 9.04 9.2a2 2 0 0 0-.27 1.35V13h3.29a2 2 0 0 0 1.2-.4l3-2.6"/></svg>
              </div>
              <div class="cred-item-body">
                <h4 class="cred-item-title">International Certified Therapeutic Yoga (PCOD/PCOS, Infertility, Postpartum &amp; Menopause)</h4>
              </div>
            </div>
            <div class="cred-item reveal-right d6">
              <div class="cred-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
              </div>
              <div class="cred-item-body">
                <h4 class="cred-item-title">International Certified Advanced Yoga Teacher Training</h4>
              </div>
            </div>
          </div>
          @if(!empty($siteSettings['certifications_image_url']))
            <div class="cred-cert-logo">
              <img src="{{ $siteSettings['certifications_image_url'] }}" alt="Certifications" style="max-width: 100%; display: block;">
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <style>
    .cred-section {
      padding: 100px 6%;
      background: #ffffff;
    }
    .cred-header {
      text-align: center;
      margin-bottom: 60px;
    }
    .cred-layout {
      display: grid;
      grid-template-columns: 0.85fr 1.15fr;
      gap: 48px;
      align-items: flex-start;
      max-width: 1240px;
      margin: 0 auto;
    }
    .cred-side-img {
      border-radius: 20px;
      overflow: hidden;
      display: flex;
      align-items: center;
      margin-top: -20px;
    }
    .cred-side-img img {
      width: 100%;
      height: auto;
      object-fit: contain;
      object-position: center;
      display: block;
      border-radius: 20px;
    }
    .cred-features-wrapper { display: grid; grid-template-columns: 1fr 220px; gap: 24px; align-items: flex-start; }
    .cred-features { display: flex; flex-direction: column; gap: 10px; }
    .cred-item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 2px;
    }
    .cred-item-icon {
      flex-shrink: 0;
      width: 54px;
      height: 54px;
      border-radius: 50%;
      background: #ffffff;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3px;
      transition: all 0.3s ease;
    }
    .cred-item:hover .cred-item-icon {
      background: rgba(77, 182, 172, 0.1);
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(77, 182, 172, 0.15);
    }
    .cred-item-icon svg { width: 26px; height: 26px; stroke: #4DB6AC; transition: all 0.3s ease; }
    .cred-item:hover .cred-item-icon svg { transform: scale(1.1); }
    .cred-item-body { flex: 1; }
    .cred-item-title {
      font-family: 'Playfair Display', serif;
      font-size: 17px;
      font-weight: 700;
      color: #2c3e3a;
      margin: 0;
      line-height: 1.3;
    }

    @media (max-width: 900px) {
      .cred-layout { grid-template-columns: 1fr; gap: 36px; }
      .cred-side-img { order: -1; max-width: 420px; margin: 0 auto; }
      .cred-item-title { font-size: 18px; }
    }
    @media (max-width: 480px) {
      .cred-section { padding: 70px 5%; }
      .cred-header { margin-bottom: 40px; }
      .cred-item-icon { width: 60px; height: 60px; padding: 3px; }
      .cred-item-title { font-size: 17px; }
    }
  </style>

  <!-- Vision & Mission Section -->
  <section class="vm-section">
    <img src="{{ asset('storage/vi and mi.jpg') }}" alt="Our Mission & Vision" class="vm-bg-img">
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
      <div class="vm-cta-wrap reveal d3">
        <a href="{{ route('services') }}" class="vm-cta-btn">Explore Our Services</a>
      </div>
    </div>
  </section>

  <style>
    /* Vision & Mission */
    .vm-section {
      display: grid;
      overflow: hidden;
    }
    .vm-bg-img {
      grid-area: 1 / 1;
      display: block;
      width: 100%;
      height: 560px;
      object-fit: cover;
      object-position: center top;
      z-index: 0;
    }
    .vm-overlay {
      grid-area: 1 / 1;
      background: rgba(0, 0, 0, 0.45);
      z-index: 1;
    }
    .vm-section .container {
      grid-area: 1 / 1;
      position: relative;
      z-index: 2;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px 6%;
      box-sizing: border-box;
    }
    .vm-header {
      text-align: center;
      margin-bottom: 36px;
    }
    .vm-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .vm-card {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 40px 36px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.25);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
      transition: transform 0.4s ease;
    }
    .vm-card:hover {
      transform: translateY(-6px);
    }
    .vm-title {
      font-family: 'Outfit', sans-serif;
      font-size: 24px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 16px;
      letter-spacing: 0.5px;
    }
    .vm-text {
      color: rgba(255, 255, 255, 0.92);
      font-size: 16.5px;
      line-height: 1.85;
      margin: 0;
    }
    .vm-cta-wrap {
      text-align: center;
      margin-top: 32px;
    }
    .vm-cta-btn {
      display: inline-block;
      padding: 16px 42px;
      background: #ffffff;
      color: #4DB6AC;
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      border-radius: 12px;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .vm-cta-btn:hover {
      transform: translateY(-2px);
      background: #4DB6AC;
      color: #ffffff;
      box-shadow: 0 14px 36px rgba(77,182,172,0.45);
    }
    @media (max-width: 900px) {
      .vm-grid {
        grid-template-columns: 1fr;
        gap: 30px;
      }
      .vm-card {
        padding: 40px 30px;
      }
      .vm-bg-img { height: 500px; }
      .vm-section .container { padding: 40px 5%; }
      .vm-cta-wrap { margin-top: 40px; }
    }
  </style>

  <!-- Book Consultation CTA -->
  <section class="about-cta-section">
    <div class="about-cta-bg" style="background-image: url('{{ asset('storage/moutain.jpg') }}');"></div>
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
              <span>Free initial consultation</span>
            </div>
          </div>
        </div>

        <!-- Right: Form -->
        <div class="about-cta-form-wrap reveal d1">
          <h3 class="about-cta-form-title">Book Consultation</h3>
          <p class="about-cta-form-sub">Share your details and we'll respond with the right guidance for your journey.</p>
          <form action="{{ route('contact.store') }}" method="POST" class="js-cta-with-datetime">
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
              <select name="subject" required>
                <option value="" disabled selected>What are you looking for? *</option>
                <option value="Birth Doula Package">Birth Doula Package</option>
                <option value="Prenatal Yoga">Prenatal Yoga</option>
                <option value="Labour Management & Comfort Measures">Labour Management &amp; Comfort Measures</option>
                <option value="Postpartum Rebalance">Postpartum Rebalance</option>
                <option value="Fat Loss program">Fat Loss program</option>
              </select>
            </div>
            <div class="about-cta-field">
              <div class="jiva-pickdate" data-calendly tabindex="0" role="button" aria-label="Pick a date and time">
                <svg class="jiva-pickdate__ico" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <input type="text" name="preferred_time_label" class="jiva-pickdate__input" placeholder="Pick a Date &amp; Time *" readonly required data-calendly-time>
                <svg class="jiva-pickdate__chev" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
              </div>
            </div>
            <div class="about-cta-field">
              <textarea name="message" rows="3" placeholder="Other Notes"></textarea>
            </div>
            <button type="submit" class="about-cta-submit">Book Consultation</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <style>
    .about-cta-section {
      position: relative;
      padding: 25px 6%;
      overflow: hidden;
      min-height: 200px;
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
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-transform: uppercase;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 3px;
      color: #4DB6AC;
      margin-bottom: 16px;
    }
    .about-cta-label::before {
      content: '';
      width: 24px;
      height: 2px;
      background: #4DB6AC;
      border-radius: 2px;
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
      padding: 24px 28px;
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
      margin-bottom: 10px;
    }
    .about-cta-field input,
    .about-cta-field select,
    .about-cta-field textarea {
      width: 100%;
      padding: 10px 14px;
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
      min-height: 60px;
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
    .about-cta-pickdate-btn {
      width: 100%;
      padding: 14px 16px;
      background: #ffffff;
      color: #2b2b2b;
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      font-weight: 600;
      border: 1.5px solid #4DB6AC;
      border-radius: 12px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all 0.25s ease;
    }
    .about-cta-pickdate-btn:hover {
      background: #4DB6AC;
      color: #ffffff;
      box-shadow: 0 8px 22px rgba(77,182,172,0.3);
    }
    .about-cta-pickdate-btn svg { color: #4DB6AC; transition: color 0.25s; }
    .about-cta-pickdate-btn:hover svg { color: #ffffff; }
    .about-cta-selected-time {
      width: 100%;
      padding: 12px 14px;
      margin-top: 10px;
      background: #f5fbfa;
      border: 1.5px solid #e5e0d8;
      border-radius: 10px;
      color: #2FA9A3;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      font-weight: 500;
      text-align: center;
      cursor: default;
      outline: none;
      box-sizing: border-box;
    }
    .about-cta-selected-time.is-filled {
      background: #e8f7f5;
      border-color: #4DB6AC;
      color: #2FA9A3;
      font-weight: 600;
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
      .about-cta-submit {
        padding: 14px 18px;
        font-size: 14px;
        letter-spacing: 1px;
        white-space: normal;
        line-height: 1.3;
      }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const items = document.querySelectorAll('.beyond-anim-left, .beyond-anim-right');
      if (!('IntersectionObserver' in window)) {
        items.forEach(el => el.classList.add('is-visible'));
        return;
      }
      const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 });
      items.forEach(el => io.observe(el));
    });
  </script>

@endsection
