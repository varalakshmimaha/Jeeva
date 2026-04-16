@extends('layouts.app')

@section('title', 'About Us - Anu | Birth Doula & Childbirth Educator')

@section('content')

  <x-page-banner
    title="My Story"
    subtitle="Walking Alongside You · Anu — Birth Doula"
    :image="asset('images/founder-portrait.jpeg')"
    :breadcrumbs="[['label' => 'About Us']]"
  />

  <!-- About Section -->
  <section style="padding: 90px 6%;">
    <div class="container">
      <div class="about-main-grid reveal">
        <div style="text-align:center">
          <img src="{{ asset('images/founder-portrait.jpeg') }}" alt="Anu - Birth Doula"
            style="border-radius:20px;box-shadow:0 16px 48px rgba(0,0,0,0.12);width:100%;max-height:520px;object-fit:cover;">
        </div>

        <div>
          <span class="sec-label">My Story</span>
          <h2 class="sec-title" style="margin-bottom:24px;">Walking Alongside You</h2>
          <p style="margin-bottom:20px;color:#6b7280;font-size:16px;line-height:1.85;">I am <strong style="color:#3d2b2b;">Anu</strong>, a Birth Doula, Prenatal Yoga Instructor, Childbirth Educator, and Nutritionist, and a mother of two teenage children. My journey as a mother, combined with my professional training and experience, allows me to offer deeply compassionate, knowledgeable, and grounded support to women during one of the most transformative phases of their lives.</p>
          <p style="color:#6b7280;font-size:16px;line-height:1.85;">I believe every woman deserves to feel seen, heard, and supported throughout her pregnancy, birth, and postpartum journey. I believe childbirth is not only a physical experience but also an emotional and spiritual transformation. Every journey is unique, and every woman deserves care that honours her choices, her body, and her voice.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Vision & Mission Section -->
  <section class="vm-section">
    <div class="container">
      <div class="vm-header">
        <span class="section-label reveal">What Drives Us</span>
        <h2 class="section-title reveal d1">Vision & Mission</h2>
      </div>
      <div class="vm-grid">
        <!-- Vision Card -->
        <div class="vm-card reveal d1">
          <div class="vm-icon-wrap">
            <svg width="36" height="36" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
          </div>
          <h3 class="vm-title">Our Vision</h3>
          <p class="vm-text">To create a world where every woman feels empowered, supported, and celebrated throughout her pregnancy, birth, and postpartum journey — embracing motherhood with confidence, strength, and joy.</p>
          <div class="vm-accent"></div>
        </div>
        <!-- Mission Card -->
        <div class="vm-card reveal d2">
          <div class="vm-icon-wrap">
            <svg width="36" height="36" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <h3 class="vm-title">Our Mission</h3>
          <p class="vm-text">To provide compassionate, holistic birth support through doula care, prenatal yoga, childbirth education, and nutrition guidance — helping families navigate one of life's most transformative experiences with trust and love.</p>
          <div class="vm-accent"></div>
        </div>
      </div>
    </div>
  </section>

  <style>
    /* Vision & Mission */
    .vm-section {
      padding: 100px 6%;
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
      position: relative;
      overflow: hidden;
    }
    .vm-section::before {
      content: '';
      position: absolute;
      top: -150px; right: -150px;
      width: 400px; height: 400px;
      border-radius: 50%;
      background: rgba(77,182,172,0.06);
    }
    .vm-section::after {
      content: '';
      position: absolute;
      bottom: -100px; left: -100px;
      width: 300px; height: 300px;
      border-radius: 50%;
      background: rgba(77,182,172,0.04);
    }
    .vm-header {
      text-align: center;
      margin-bottom: 60px;
      position: relative;
      z-index: 1;
    }
    .vm-header .section-label { color: #4DB6AC; }
    .vm-header .section-title { color: #ffffff; }
    .vm-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 36px;
      max-width: 960px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }
    .vm-card {
      background: rgba(255,255,255,0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 24px;
      padding: 48px 36px;
      position: relative;
      overflow: hidden;
      transition: all 0.4s ease;
    }
    .vm-card:hover {
      transform: translateY(-8px);
      background: rgba(255,255,255,0.08);
      box-shadow: 0 20px 50px rgba(77,182,172,0.12);
    }
    .vm-accent {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 4px;
      background: linear-gradient(90deg, #4DB6AC, #80cbc4);
      border-radius: 24px 24px 0 0;
    }
    .vm-icon-wrap {
      width: 72px; height: 72px;
      border-radius: 20px;
      background: rgba(77,182,172,0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
    }
    .vm-title {
      font-family: 'Playfair Display', serif;
      font-size: 24px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 16px;
    }
    .vm-text {
      color: rgba(255,255,255,0.6);
      font-size: 15px;
      line-height: 1.8;
    }
    @media (max-width: 768px) {
      .vm-grid { grid-template-columns: 1fr; gap: 24px; }
      .vm-card { padding: 36px 24px; }
      .vm-section { padding: 70px 5%; }
    }
  </style>

  <!-- My Approach Section -->
  <section class="why-sec" style="background: linear-gradient(135deg, #fdf5f5 0%, #f8dcda 100%); padding: 100px 6%; position: relative; overflow: hidden;">
    <!-- Decorative Orbs -->
    <div style="position: absolute; top: -100px; left: -100px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(77, 182, 172, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; right: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(77, 182, 172, 0.08) 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 1;">
      <div style="text-align: center; margin-bottom: 60px;">
        <span class="section-label reveal" style="display: inline-block; padding: 6px 16px; background: rgba(77, 182, 172, 0.1); color: #4DB6AC; border-radius: 30px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 16px;">My Approach</span>
        <h2 class="section-title reveal d1" style="font-family: 'Playfair Display', serif; font-size: clamp(36px, 5vw, 48px); color: #3d2b2b; margin-bottom: 24px;">Empowering Your Birth Journey</h2>
        <p class="reveal d2" style="max-width: 650px; margin: 0 auto; color: #7a6060; font-size: 18px; line-height: 1.7;">My intention is to create a calm, safe, and nurturing space where you feel supported without judgment and guided without pressure, while gently reminding families of their inner strength and helping them embrace birth as a confident, meaningful, and deeply empowering journey.</p>
      </div>

      <div class="about-highlights-grid" style="margin-top: 40px;">
        <!-- Card 1 -->
        <div class="mission-card reveal d1" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #4DB6AC, #3d9e94);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(77,182,172,0.15); border: 2px solid white;">
            <img src="https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=400&q=80" alt="Birth Doula" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #3d2b2b; margin-bottom: 12px;">Birth Doula</h4>
          <p style="color: #7a6060; font-size: 15px; line-height: 1.6; margin: 0;">Compassionate, hands-on support throughout your pregnancy, birth, and postpartum journey, honouring your choices and your voice.</p>
        </div>

        <!-- Card 2 -->
        <div class="mission-card reveal d2" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #4DB6AC, #3d9e94);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(77,182,172,0.15); border: 2px solid white;">
            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=400&q=80" alt="Prenatal Yoga" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #3d2b2b; margin-bottom: 12px;">Prenatal Yoga Instructor</h4>
          <p style="color: #7a6060; font-size: 15px; line-height: 1.6; margin: 0;">Gentle, strengthening yoga practices designed to prepare your body and mind for the beautiful journey of childbirth.</p>
        </div>

        <!-- Card 3 -->
        <div class="mission-card reveal d3" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #4DB6AC, #3d9e94);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(77,182,172,0.15); border: 2px solid white;">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=400&q=80" alt="Childbirth Education" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #3d2b2b; margin-bottom: 12px;">Childbirth Educator</h4>
          <p style="color: #7a6060; font-size: 15px; line-height: 1.6; margin: 0;">Empowering you with knowledge and confidence so you feel strong, grounded, and informed as you move through your birth experience.</p>
        </div>

        <!-- Card 4 -->
        <div class="mission-card reveal d4" style="background: #ffffff; border-radius: 24px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #4DB6AC, #3d9e94);"></div>
          <div style="width: 72px; height: 72px; border-radius: 20px; overflow: hidden; margin-bottom: 24px; box-shadow: 0 8px 16px rgba(77,182,172,0.15); border: 2px solid white;">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=400&q=80" alt="Nutritionist" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <h4 style="font-size: 22px; font-family: 'Outfit', sans-serif; font-weight: 700; color: #3d2b2b; margin-bottom: 12px;">Nutritionist</h4>
          <p style="color: #7a6060; font-size: 15px; line-height: 1.6; margin: 0;">Personalized nutrition guidance to nourish you and your baby throughout pregnancy, birth, and the postpartum period.</p>
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
      .mission-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(77,182,172,0.1); }

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

  <!-- Why Choose Us Section -->
  <section style="padding: 100px 6%; background: #ffffff; position: relative;">
    <div class="container">
      <div style="text-align: center; margin-bottom: 60px;">
        <span class="sec-label reveal">Why Choose Us</span>
        <h2 class="sec-title reveal d1" style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 44px); color: #3d2b2b;">Holistic Care for Mother and Baby</h2>
      </div>

      <div class="why-choose-us-grid">
        <div class="why-card reveal d1">
          <div class="why-icon">🪷</div>
          <h4 class="why-title">Personalized Support</h4>
          <p class="why-text">Every pregnancy and birth is unique. We provide tailored care that respects your individual preferences, cultural background, and medical needs.</p>
        </div>
        <div class="why-card reveal d2">
          <div class="why-icon">✨</div>
          <h4 class="why-title">Unwavering Advocacy</h4>
          <p class="why-text">Your voice matters. We ensure you feel informed and empowered to make decisions confidently, advocating for your birth plan in any setting.</p>
        </div>
        <div class="why-card reveal d3">
          <div class="why-icon">🌿</div>
          <h4 class="why-title">Mind & Body Connection</h4>
          <p class="why-text">Through prenatal yoga and focused childbirth education, we bridge physical preparation with mental resilience for a calmer labor experience.</p>
        </div>
      </div>
    </div>
    <style>
      .why-choose-us-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        max-width: 1100px;
        margin: 0 auto;
      }
      .why-card {
        background: #fdf5f5;
        padding: 40px 30px;
        border-radius: 20px;
        text-align: center;
        transition: transform 0.3s;
      }
      .why-card:hover {
        transform: translateY(-10px);
      }
      .why-icon {
        font-size: 40px;
        margin-bottom: 20px;
      }
      .why-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 22px;
        color: #3d2b2b;
        margin-bottom: 16px;
      }
      .why-text {
        font-size: 16px;
        color: #7a6060;
        line-height: 1.6;
      }
      @media (max-width: 860px) {
        .why-choose-us-grid {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </section>

@endsection
