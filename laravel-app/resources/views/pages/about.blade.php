@extends('layouts.app')

@section('title', 'About Us - Western Dental & Orthodontics')

@section('content')

  <!-- Page Header (Hero Banner) -->
  <div class="page-header" style="background: linear-gradient(135deg, rgba(10, 22, 40, 0.85) 0%, rgba(10, 22, 40, 0.7) 100%), url('{{ asset('images/dentist_checking_patient.png') }}'); background-size: cover; background-position: center; min-height: 340px; display: flex; align-items: center;">
    <div class="page-header-body">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-sep">&rsaquo;</span>
        <span class="breadcrumb-current">About Us</span>
      </nav>
      <h1 style="text-shadow: 0 4px 12px rgba(0,0,0,0.3);">About Us &ndash; Western Dental</h1>
      <p style="color: rgba(255,255,255,0.9); font-size: 18px; max-width: 600px;">Your trusted destination for advanced dental care in Tippasandra, Bangalore.</p>
    </div>
  </div>

  <!-- About Section -->
  <section>
    <div class="container">
      <span class="sec-label reveal">Our Story</span>
      <h2 class="sec-title reveal d1">Bringing Smiles to Life</h2>

      <div class="about-main-grid reveal d2">
        <div style="text-align:center">
          <img src="{{ asset('images/dentist_checking_patient.png') }}" alt="Specialist Dentist checking patient"
            style="border-radius:12px;box-shadow:0 12px 40px rgba(0,0,0,0.15);width:100%;height:auto;object-fit:cover;border:1px solid rgba(255,255,255,0.1);">
        </div>

        <div style="line-height:1.85">
          <p style="margin-bottom:20px;color:var(--muted);">Welcome to <strong>Western Dental & Orthodontics</strong>, your trusted destination for advanced dental care in Tippasandra, Bangalore. We are committed to delivering high-quality, affordable, and patient-focused dental treatments designed to create confident, healthy smiles.</p>

          <p style="margin-bottom:20px;color:var(--muted);">Led by experienced orthodontists <strong>Dr. Yaseen Shariff (BDS, MDS)</strong> and <strong>Dr. Humera Tabassum (BDS, MDS)</strong>, our clinic combines clinical expertise with modern technology to provide world-class dental solutions. With affiliations to reputed institutions like Apollo Hospital and Sakra World Hospital, our team ensures precision, safety, and excellence in every treatment.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="why-sec" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 100px 6%; position: relative; overflow: hidden;">
    <!-- Decorative Orbs -->
    <div style="position: absolute; top: -100px; left: -100px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; right: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(14, 165, 233, 0.08) 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 1;">
      <div style="text-align: center; margin-bottom: 60px;">
        <span class="section-label reveal" style="display: inline-block; padding: 6px 16px; background: rgba(14, 165, 233, 0.1); color: #0ea5e9; border-radius: 30px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 16px;">Our Mission</span>
        <h2 class="section-title reveal d1" style="font-family: 'Playfair Display', serif; font-size: clamp(36px, 5vw, 48px); color: #0f172a; margin-bottom: 24px;">Excellence in Every Smile</h2>
        <p class="reveal d2" style="max-width: 650px; margin: 0 auto; color: #475569; font-size: 18px; line-height: 1.7;">Delivering world-class dental care with a personalized touch, ensuring our patients receive the highest standard of treatment in a comfortable, modern environment.</p>
      </div>
      
      <div class="about-highlights-grid" style="margin-top: 40px;">
        <!-- Card 1 -->
        <div class="mission-card reveal d1" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #0ea5e9, #38bdf8);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(14,165,233,0.15); border: 2px solid white;">
            <img src="{{ asset('images/dentist_checking_patient.png') }}" alt="Award" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Award-Winning Clinic</h4>
          <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin: 0;">Recognized for excellence in dental care and patient satisfaction by leading associations since 2010.</p>
        </div>

        <!-- Card 2 -->
        <div class="mission-card reveal d2" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #0ea5e9, #38bdf8);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(14,165,233,0.15); border: 2px solid white;">
            <img src="{{ asset('images/blog_dental_hygiene.png') }}" alt="Expert" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Expert Specialists</h4>
          <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin: 0;">Led by highly qualified and certified dental professionals with international training and expertise.</p>
        </div>

        <!-- Card 3 -->
        <div class="mission-card reveal d3" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #0ea5e9, #38bdf8);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(14,165,233,0.15); border: 2px solid white;">
            <img src="{{ asset('images/blog_root_canal.png') }}" alt="Technology" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Latest Technology</h4>
          <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin: 0;">Equipped with state-of-the-art diagnostic and treatment technology for precise, pain-free dental care.</p>
        </div>

        <!-- Card 4 -->
        <div class="mission-card reveal d4" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #0ea5e9, #38bdf8);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(14,165,233,0.15); border: 2px solid white;">
            <img src="{{ asset('images/blog_braces.png') }}" alt="Patient" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Patient Focused</h4>
          <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin: 0;">Every decision we make is guided by what's best for your individual health, comfort, and peace of mind.</p>
        </div>
      </div>
    </div>
    <style>
      /* Main About Grid - Image first on mobile */
      .about-main-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
        margin: 32px 0 0;
      }
      
      /* Mission Section Grid */
      .about-highlights-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
      }

      .mission-card { transition: all 0.3s ease; position: relative; top: 0; }
      .mission-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(14,165,233,0.1); }

      /* Mobile Optimizations */
      @media (max-width: 860px) {
        .about-main-grid {
          grid-template-columns: 1fr;
          gap: 24px;
        }
        
        /* Ensure image stays on top on mobile */
        .about-main-grid > div:first-child {
          order: 1;
        }
        .about-main-grid > div:last-child {
          order: 2;
        }

        .about-highlights-grid {
          grid-template-columns: 1fr; /* Single column for one row */
          gap: 16px;
        }
        
        .why-sec {
          padding: 60px 20px !important;
        }
        
        .mission-card {
          padding: 30px 20px !important;
        }
      }
    </style>
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