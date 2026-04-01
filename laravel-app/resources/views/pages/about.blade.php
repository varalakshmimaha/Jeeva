@extends('layouts.app')

@section('title', 'About Us - Western Dental & Orthodontics')

@section('content')

  <!-- Page Header (Hero Banner) -->
  <div class="page-header" style="background: linear-gradient(135deg, rgba(10, 22, 40, 0.85) 0%, rgba(10, 22, 40, 0.7) 100%), url('{{ asset('images/dentist_checking_patient.png') }}'); background-size: cover; background-position: center; min-height: 340px; display: flex; align-items: center;">
    <div class="page-header-body">
      <div class="breadcrumb">Home &rsaquo; <span>About Us</span></div>
      <h1 style="text-shadow: 0 4px 12px rgba(0,0,0,0.3);">About Western Dental</h1>
      <p style="color: rgba(255,255,255,0.9); font-size: 18px; max-width: 600px;">Providing compassionate, expert dental care to the Bangalore community since 2010.</p>
    </div>
  </div>

  <!-- About Section -->
  <section>
    <div class="container">
      <span class="sec-label reveal">Our Story</span>
      <h2 class="sec-title reveal d1">Bringing Smiles to Life</h2>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;margin:32px 0 0"
        class="reveal d2">
        <div style="text-align:center">
          <img src="{{ asset('images/dentist_checking_patient.png') }}" alt="Specialist Dentist checking patient"
            style="border-radius:12px;box-shadow:0 12px 40px rgba(0,0,0,0.15);width:100%;height:auto;object-fit:cover;border:1px solid rgba(255,255,255,0.1);">
        </div>

        <div style="line-height:1.85">
          <p style="margin-bottom:20px;color:var(--muted);">Western Dental & Orthodontics was founded with a simple
            mission: to provide world-class dental care with a personal touch. Located in the heart of Tippasandra,
            Bangalore, we've grown from a small clinic to one of the city's most trusted dental practices.</p>

          <p style="margin-bottom:20px;color:var(--muted);">Our team of experienced dentists and orthodontists are
            passionate about transforming smiles and improving oral health. We combine cutting-edge technology with
            compassionate care, ensuring every patient feels comfortable and confident in our hands.</p>

          <p style="color:var(--muted);">Whether you need a routine cleaning, complex orthodontics, or a complete smile
            makeover, we're committed to delivering results that exceed expectations. Your dental health and satisfaction
            are our top priorities.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="why-sec" style="background: var(--cream); padding: 80px 6%;">
    <div class="container">
      <span class="section-label reveal">Our Mission</span>
      <h2 class="section-title reveal d1">Excellence in Every Smile</h2>
      
      <div class="about-highlights" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 40px; margin-top: 40px;">
        <div class="highlight-item reveal d1">
          <div class="highlight-icon">
            <img src="{{ asset('images/dentist_checking_patient.png') }}" class="highlight-icon-img" alt="Award trophy clinical icon">
            <div class="highlight-icon-overlay"></div>
          </div>
          <div class="highlight-text">
            <h4>Award-Winning Clinic</h4>
            <p>Recognized for excellence in dental care and patient satisfaction by leading associations since 2010.</p>
          </div>
        </div>

        <div class="highlight-item reveal d2">
          <div class="highlight-icon">
            <img src="{{ asset('images/blog_dental_hygiene.png') }}" class="highlight-icon-img" alt="Expert Specialist portrait">
            <div class="highlight-icon-overlay"></div>
          </div>
          <div class="highlight-text">
            <h4>Expert Specialists</h4>
            <p>Led by highly qualified and certified dental professionals with international training and expertise.</p>
          </div>
        </div>

        <div class="highlight-item reveal d3">
          <div class="highlight-icon">
            <img src="{{ asset('images/blog_root_canal.png') }}" class="highlight-icon-img" alt="Advanced dental technology icon">
            <div class="highlight-icon-overlay"></div>
          </div>
          <div class="highlight-text">
            <h4>Latest Technology</h4>
            <p>Equipped with state-of-the-art diagnostic and treatment technology for precise, pain-free dental care.</p>
          </div>
        </div>

        <div class="highlight-item reveal d4">
          <div class="highlight-icon">
            <img src="{{ asset('images/blog_braces.png') }}" class="highlight-icon-img" alt="Patient-focused care icon">
            <div class="highlight-icon-overlay"></div>
          </div>
          <div class="highlight-text">
            <h4>Patient Focused</h4>
            <p>Every decision we make is guided by what's best for your individual health, comfort, and peace of mind.</p>
          </div>
        </div>
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
          <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Ready to Join Our Family?</h2>
          <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Schedule your first appointment and experience the difference quality dental care makes.</p>
          <a href="{{ route('contact') }}" class="btn-white-solid">
            Book Appointment &rarr;
          </a>
        </div>
      </div>
    </div>
  </section>

@endsection