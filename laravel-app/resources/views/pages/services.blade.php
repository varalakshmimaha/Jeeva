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
  <div class="svc-cta-bg" style="background-image: url('{{ asset('images/banners/1776263096_Gemini_Generated_Image_ozfdjmozfdjmozfd.png') }}');"></div>
  <div class="svc-cta-overlay"></div>
  <div class="container">
    <div class="svc-cta-grid">
      <!-- Left: Text Content -->
      <div class="svc-cta-text reveal">
        <span class="svc-cta-label">Your Inquiry</span>
        <h2 class="svc-cta-title">Ready for Compassionate Support?</h2>
        <p class="svc-cta-desc">Let's plan your empowered birth journey. Book a one-on-one consultation today to discover how we can guide you into motherhood.</p>
      </div>

      <!-- Right: Consultation Form -->
      <div class="svc-cta-form-wrap reveal d1">
        <h3 class="svc-cta-form-title">Book Consultation</h3>
        <p class="svc-cta-form-sub">Share your details and we'll respond with the right guidance for your journey.</p>
        <form action="{{ route('contact.store') }}" method="POST" class="svc-cta-form js-cta-with-datetime">
          @csrf
          <div class="svc-cta-form-row">
            <div class="svc-cta-field">
              <input type="text" name="name" placeholder="Your Name *" required>
            </div>
            <div class="svc-cta-field">
              <input type="tel" name="phone" placeholder="Phone Number">
            </div>
          </div>
          <div class="svc-cta-field">
            <select name="subject">
              <option value="" disabled selected>Select Service *</option>
              @foreach($services as $service)
                <option value="{{ $service->title }}">{{ $service->title }}</option>
              @endforeach
            </select>
          </div>
          @php
            $defaultSlots = '09:00 AM, 10:00 AM, 11:00 AM, 12:00 PM, 02:00 PM, 03:00 PM, 04:00 PM, 05:00 PM, 06:00 PM';
            $slotsRaw = trim($siteSettings['booking_time_slots'] ?? '') ?: $defaultSlots;
            $timeSlots = array_values(array_filter(array_map('trim', explode(',', $slotsRaw))));
          @endphp
          <div class="svc-cta-form-row">
            <div class="svc-cta-field">
              <input type="date" name="preferred_date" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="svc-cta-field">
              <select name="preferred_time" required>
                <option value="" disabled selected>Pick a Time *</option>
                @foreach($timeSlots as $slot)
                  <option value="{{ $slot }}">{{ $slot }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="svc-cta-field">
            <textarea name="message" rows="4" placeholder="Tell us about your journey..." required></textarea>
          </div>
          <input type="hidden" name="email" value="consultation@jivabirthandbeyond.com">
          <button type="submit" class="svc-cta-submit">Book My Consultation</button>
        </form>
      </div>
    </div>
  </div>
</section>

<style>
  /* Service CTA - Split Layout */
  .svc-cta-section {
    position: relative;
    padding: 80px 6%;
    overflow: hidden;
    min-height: 580px;
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
    background: linear-gradient(135deg, rgba(30, 40, 35, 0.65) 0%, rgba(40, 55, 45, 0.5) 100%);
    border-radius: 40px;
    z-index: 1;
  }
  .svc-cta-section .container {
    position: relative;
    z-index: 2;
    width: 100%;
  }
  .svc-cta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
  }
  .svc-cta-label {
    display: inline-block;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 3px;
    color: #4DB6AC;
    margin-bottom: 16px;
  }
  .svc-cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 48px);
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 20px;
  }
  .svc-cta-desc {
    font-size: 17px;
    color: rgba(255,255,255,0.8);
    line-height: 1.75;
    margin-bottom: 32px;
    max-width: 480px;
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
  .svc-cta-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(77,182,172,0.4);
    opacity: 0.9;
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
