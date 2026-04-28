@extends('layouts.app')

@section('title', 'Services - Jiva Birth and Beyond')

@section('content')



<x-page-banner
  :title="(isset($banner) && $banner) ? $banner->title : 'Our Services'"
  :subtitle="(isset($banner) && $banner && $banner->description) ? $banner->description : 'Compassionate birth support, prenatal yoga, childbirth education, and nutrition guidance for your journey.'"
  :image="(isset($banner) && $banner && $banner->image) ? asset($banner->image) : 'https://images.unsplash.com/photo-1542037104857-ffbb0b9155fb?q=80&w=1920&h=600&fit=crop'"
  :breadcrumbs="[['label' => 'Services']]"
/>

<!-- Services Grid -->
<section>
  <div class="container">
    <div class="svc-full-grid">
      @foreach($services as $index => $service)
      <article class="svc-full-card reveal d{{ ($index % 6) + 1 }}">
        <div class="svc-full-thumb">
          <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}">
        </div>
        <div class="svc-full-body">
          <div class="svc-full-cat">{{ $service->subtitle }}</div>
          <h3>{{ $service->title }}</h3>
          <p>{{ $service->description }}</p>
          <div class="svc-full-footer">
            <span style="font-size:12px;color:var(--muted);">Wellness</span>
            <a href="{{ route('service.show', $service->id) }}" class="svc-learn-btn">
              Explore <span class="arrow">&rarr;</span>
            </a>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

<!-- Book Consultation CTA Section -->
<section class="svc-cta-section">
  <div class="svc-cta-bg" style="background-image: url('{{ !empty($siteSettings['cta_bg_image_path']) ? asset('storage/' . $siteSettings['cta_bg_image_path']) : asset('storage/moutain.jpg') }}');"></div>
  <div class="svc-cta-overlay"></div>
  <div class="container">
    <div class="svc-cta-single">
      <div class="svc-cta-content reveal">
        <span class="svc-cta-label">Your Inquiry</span>
        <h2 class="svc-cta-title">Ready for Compassionate Support?</h2>
        <a href="{{ route('contact') }}" class="svc-cta-submit">Book Consultation</a>
      </div>
    </div>
  </div>
</section>

<style>
  /* Service CTA - Split Layout */
  .svc-cta-section {
    position: relative;
    padding: 0 6%;
    overflow: hidden;
    min-height: 450px;
    display: flex;
    align-items: center;
    border-radius: 40px;
    margin: 20px 4% 60px;
  }
  .svc-cta-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    border-radius: 40px;
    z-index: 0;
  }
  .svc-cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(30, 40, 35, 0.55) 0%, rgba(40, 55, 45, 0.45) 100%);
    border-radius: 40px;
    z-index: 1;
  }
  .svc-cta-section .container {
    position: relative;
    z-index: 2;
    width: 100%;
  }
  .svc-cta-single {
    max-width: 700px;
    margin: 0 auto;
  }
  .svc-cta-content {
    text-align: center;
  }
  .svc-cta-label {
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
  .svc-cta-label::before {
    content: '';
    width: 24px;
    height: 2px;
    background: #4DB6AC;
    border-radius: 2px;
  }
  .svc-cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3.2vw, 40px);
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 20px;
    white-space: nowrap;
  }
  .svc-cta-desc {
    font-size: 16px;
    color: rgba(255,255,255,0.9);
    line-height: 1.75;
    margin: 0 auto 32px;
    max-width: 520px;
    font-weight: 500;
  }
  /* Form Card */
  .svc-cta-form-wrap {
    background: rgba(255,255,255,0.97);
    border-radius: 24px;
    padding: 40px 36px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
  }
  .svc-cta-form-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: #3d2b2b;
    margin-bottom: 8px;
  }
  .svc-cta-form-sub {
    font-size: 14px;
    color: #7a6060;
    margin-bottom: 28px;
    line-height: 1.6;
  }
  .svc-cta-desc {
    font-size: 14px;
    color: rgba(255,255,255,0.8);
    margin-bottom: 24px;
    line-height: 1.7;
  }
  .svc-cta-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }
  .svc-cta-field {
    margin-bottom: 14px;
  }
  .svc-cta-field input,
  .svc-cta-field select,
  .svc-cta-field textarea {
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
  .svc-cta-field input::placeholder,
  .svc-cta-field textarea::placeholder {
    color: #b0a0a0;
  }
  .svc-cta-field input:focus,
  .svc-cta-field select:focus,
  .svc-cta-field textarea:focus {
    border-color: #4DB6AC;
    box-shadow: 0 0 0 3px rgba(77,182,172,0.12);
  }
  .svc-cta-field select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237a6060' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 40px;
  }
  .svc-cta-field textarea {
    resize: vertical;
    min-height: 100px;
  }
  .svc-cta-submit {
    width: 100%;
    max-width: 400px;
    padding: 16px 40px;
    background: rgba(77, 182, 172, 0.85);
    color: #ffffff;
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.2, 0.7, 0.2, 1);
    margin: 4px auto 0;
    display: block;
    text-decoration: none;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(77, 182, 172, 0.3);
  }
  .svc-cta-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s ease;
  }
  .svc-cta-submit:hover {
    background: rgba(77, 182, 172, 1);
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(77, 182, 172, 0.6), 0 0 40px rgba(77, 182, 172, 0.4);
  }
  .svc-cta-submit:hover::before {
    left: 100%;
  }
  .svc-cta-submit:active {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(77, 182, 172, 0.4);
  }

  @media (max-width: 991px) {
    .svc-cta-grid {
      grid-template-columns: 1fr;
      gap: 40px;
    }
    .svc-cta-text {
      text-align: center;
    }
    .svc-cta-desc {
      margin-left: auto;
      margin-right: auto;
    }
    .svc-cta-contact-info {
      align-items: center;
    }
  }
  @media (max-width: 480px) {
    .svc-cta-form-row {
      grid-template-columns: 1fr;
    }
    .svc-cta-form-wrap {
      padding: 28px 22px;
    }
    .svc-cta-section {
      padding: 60px 5%;
      border-radius: 24px;
      margin: 20px 3% 40px;
    }
    .svc-cta-submit {
      padding: 14px 18px;
      font-size: 14px;
      letter-spacing: 1px;
      white-space: normal;
      line-height: 1.3;
    }
    .svc-full-grid {
      grid-template-columns: 1fr;
      gap: 20px;
    }
    .svc-learn-btn {
      padding: 10px 16px;
      font-size: 13px;
    }
  }
</style>

@endsection
