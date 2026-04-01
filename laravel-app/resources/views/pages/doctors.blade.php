@extends('layouts.app')

@section('title', 'Our Doctors - Western Dental & Orthodontics')

@section('content')

<!-- Page Header (Banner) -->
<div class="page-header">
  <div class="page-header-body">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-sep">&rsaquo;</span>
        <span class="breadcrumb-current">Our Doctors</span>
      </nav>
    <h1>Meet Our Expert Team</h1>
    <p>Highly qualified dentists and orthodontists dedicated to your best smile.</p>
  </div>
</div>

<!-- Doctors Section -->
<section>
  <div class="container">
    <span class="sec-label reveal">Expert Team</span>
    <h2 class="sec-title reveal d1">Passionate Dentists & Specialists</h2>
    <p class="sec-sub reveal d2">Our team brings together decades of combined expertise in all aspects of modern dentistry.</p>
    
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:30px;margin-top:52px;">
      <!-- Doctor 1 -->
      <div class="svc-full-card reveal d1" style="overflow:visible;">
        <div style="height:220px;background:linear-gradient(135deg,#e6f7f5,#b2ece4);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:80px;margin-bottom:24px">👨‍⚕️</div>
        <div style="padding:0;">
          <h3 style="font-size:20px;font-weight:700;color:var(--navy);margin-bottom:6px">Dr. Marcus Johnson</h3>
          <div style="font-size:13px;color:var(--teal);font-weight:600;margin-bottom:14px;text-transform:uppercase">BDS, MDS • Chief Orthodontist</div>
          <p style="color:var(--muted);line-height:1.75;font-size:14px;margin-bottom:16px;">Specialised in orthodontics with 18 years of experience. Expert in braces, Invisalign, and complex bite corrections. Published researcher in dental alignment techniques.</p>
          <div style="display:flex;gap:8px;font-size:18px;">
            <a href="#" style="text-decoration:none">👍</a>
            <a href="#" style="text-decoration:none">✉️</a>
          </div>
        </div>
      </div>

      <!-- Doctor 2 -->
      <div class="svc-full-card reveal d2" style="overflow:visible;">
        <div style="height:220px;background:linear-gradient(135deg,#fdf4e7,#f5ddb0);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:80px;margin-bottom:24px">👩‍⚕️</div>
        <div style="padding:0;">
          <h3 style="font-size:20px;font-weight:700;color:var(--navy);margin-bottom:6px">Dr. Sarah Williams</h3>
          <div style="font-size:13px;color:var(--teal);font-weight:600;margin-bottom:14px;text-transform:uppercase">BDS, PGDBS • Cosmetic Specialist</div>
          <p style="color:var(--muted);line-height:1.75;font-size:14px;margin-bottom:16px;">Expert in smile designing, teeth whitening, and veneers. 14 years of experience creating stunning smiles. Passionate about aesthetic dentistry and patient satisfaction.</p>
          <div style="display:flex;gap:8px;font-size:18px;">
            <a href="#" style="text-decoration:none">👍</a>
            <a href="#" style="text-decoration:none">✉️</a>
          </div>
        </div>
      </div>

      <!-- Doctor 3 -->
      <div class="svc-full-card reveal d3" style="overflow:visible;">
        <div style="height:220px;background:linear-gradient(135deg,#ede8f8,#c9bff0);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:80px;margin-bottom:24px">👨‍⚕️</div>
        <div style="padding:0;">
          <h3 style="font-size:20px;font-weight:700;color:var(--navy);margin-bottom:6px">Dr. Rajiv Sharma</h3>
          <div style="font-size:13px;color:var(--teal);font-weight:600;margin-bottom:14px;text-transform:uppercase">BDS, PGDBS • Implants & Surgery</div>
          <p style="color:var(--muted);line-height:1.75;font-size:14px;margin-bottom:16px;">Specialist in dental implants and oral surgery. 16 years of expertise in complex extractions and implant placement. Performs painless procedures with precision.</p>
          <div style="display:flex;gap:8px;font-size:18px;">
            <a href="#" style="text-decoration:none">👍</a>
            <a href="#" style="text-decoration:none">✉️</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Strip -->
<div class="cta-strip">
  <div class="cta-inner">
    <div class="cta-text reveal-left">
      <h2>Want to Consult?</h2>
      <p>Schedule an appointment with our expert doctors for a personalized treatment plan.</p>
    </div>
    <a href="{{ route('contact') }}" class="btn-white reveal-right">Book Appointment</a>
  </div>
</div>

@endsection
