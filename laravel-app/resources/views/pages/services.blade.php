@extends('layouts.app')

@section('title', 'Services - Dental & Orthodontics')

@section('content')



<!-- Page Header (Hero Banner) -->
<div class="page-header" style="background: linear-gradient(135deg, rgba(10, 22, 40, 0.85) 0%, rgba(10, 22, 40, 0.7) 100%), url('{{ asset('images/blog_dental_hygiene.png') }}'); background-size: cover; background-position: center; min-height: 340px; display: flex; align-items: center;">
  <div class="page-header-body">
    <div class="breadcrumb">Home &rsaquo; <span>Services</span></div>
    <h1 style="text-shadow: 0 4px 12px rgba(0,0,0,0.3);">Our Dental Services</h1>
    <p style="color: rgba(255,255,255,0.9); font-size: 18px; max-width: 600px;">Comprehensive dental care from preventive check-ups to complete smile makeovers — all under one trusted roof.</p>
  </div>
</div>

<!-- Services Grid -->
<section>
  <div class="container">
    <div class="svc-full-grid">
      <div class="svc-full-card reveal d1">
        <div class="svc-full-head"><div class="svc-full-ico">🦷</div><div><h3>Dental Braces & Aligners</h3><div class="sub">Orthodontic Treatment</div></div></div>
        <div class="svc-full-body"><p>Straighten your teeth and correct bite issues using advanced metal braces, ceramic braces, or Invisalign clear aligners. Our orthodontic treatments are customised for children, teens, and adults. Achieve a perfectly aligned smile with comfort and precision under expert guidance.</p></div>
      </div>
      <div class="svc-full-card reveal d2">
        <div class="svc-full-head"><div class="svc-full-ico">🔩</div><div><h3>Dental Implants</h3><div class="sub">Tooth Replacement</div></div></div>
        <div class="svc-full-body"><p>Dental implants offer a permanent, natural-looking solution for missing teeth. A titanium post is placed in the jawbone acting as an artificial root, topped with a realistic crown. Implants restore full chewing function, prevent bone loss, and blend seamlessly with your natural teeth for decades of confident smiling.</p></div>
      </div>
      <div class="svc-full-card reveal d3">
        <div class="svc-full-head"><div class="svc-full-ico">💊</div><div><h3>Root Canal Treatment</h3><div class="sub">Pain-Free Tooth Saving</div></div></div>
        <div class="svc-full-body"><p>Modern root canal treatment is virtually painless with the latest techniques and anaesthesia. We carefully remove the infected pulp, clean the root canals, and seal the tooth to prevent re-infection. RCT saves your natural tooth from extraction and relieves the pain caused by deep cavities or dental infections.</p></div>
      </div>
      <div class="svc-full-card reveal d4">
        <div class="svc-full-head"><div class="svc-full-ico">✨</div><div><h3>Smile Designing</h3><div class="sub">Cosmetic Dentistry</div></div></div>
        <div class="svc-full-body"><p>Transform your smile with a combination of cosmetic procedures tailored to your facial features. Includes teeth whitening, porcelain veneers, bonding, and gum contouring. We create a personalised treatment plan to give you a radiant, camera-ready smile that suits your personality.</p></div>
      </div>
      <div class="svc-full-card reveal d5">
        <div class="svc-full-head"><div class="svc-full-ico">🩺</div><div><h3>General Dentistry</h3><div class="sub">Preventive & Routine Care</div></div></div>
        <div class="svc-full-body"><p>Maintaining good oral health starts with regular check-ups and professional cleaning. Our general dentistry services include dental examinations, scaling and polishing, fillings, tooth extractions, and fluoride treatments. We focus on early detection and prevention to keep your teeth and gums healthy for life.</p></div>
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
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Not Sure Which Treatment?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Our doctors will guide you with a personalized consultation to find the best solution for your smile.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+917483211870" class="btn-ghost">
             📞 Call Us
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
