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
  <div class="svc-cta-bg" style="background-image: url('{{ asset('storage/moutain.jpg') }}');"></div>
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
              <div style="display:grid;grid-template-columns:80px 1fr;gap:8px;width:100%;">
                <select name="country_code" style="padding:10px 8px;border:1.5px solid #d4e6e4;border-radius:12px;background:#ffffff;font-family:inherit;font-size:15px;color:#2b2b2b;outline:none;appearance:none;background-image:url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2712%27 height=%2712%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%237a6060%27 stroke-width=%272%27%3E%3Cpath d=%27M6 9l6 6 6-6%27/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 8px center;background-size:12px;padding-right:28px;">
                  <option value="">Code</option>
                  <option value="+1">+1</option>
                  <option value="+91" selected>+91</option>
                  <option value="+44">+44</option>
                  <option value="+61">+61</option>
                  <option value="+1-CA">+1</option>
                  <option value="+64">+64</option>
                  <option value="+27">+27</option>
                </select>
                <input type="tel" name="phone" placeholder="Phone Number" style="width:100%;">
              </div>
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
          <div class="svc-cta-field">
            <div class="jiva-pickdate" data-calendly tabindex="0" role="button" aria-label="Pick a date and time">
              <svg class="jiva-pickdate__ico" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <input type="text" name="preferred_time_label" class="jiva-pickdate__input" placeholder="Pick a Date &amp; Time *" readonly required data-calendly-time>
              <svg class="jiva-pickdate__chev" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
          </div>
          <div class="svc-cta-field">
            <textarea name="message" rows="4" placeholder="Other Notes"></textarea>
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
    padding: 25px 6%;
    overflow: hidden;
    min-height: 200px;
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
  .svc-cta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
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
