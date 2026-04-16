@extends('layouts.app')

@section('title', 'Testimonials - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  title="What Mamas Say"
  subtitle="Heartfelt words from the families I have had the honour of supporting through their birth journeys."
  :image="asset('images/banner-about.png')"
  :breadcrumbs="[['label' => 'Testimonials']]"
/>

<!-- Testimonials Precision Grid (Matches Screenshot) -->
<section class="testi-precision-sec">
  <div class="container">
    <div class="tp-grid">
      @if($testimonials->isNotEmpty())
        @foreach($testimonials as $t)
          <div class="tp-card">
            <div class="tp-quote-container">
              <span class="tp-quote-icon">“</span>
            </div>
            <div class="tp-stars">
               @for($i=0; $i<($t->rating ?? 5); $i++)<span class="tp-star">&#9733;</span>@endfor
            </div>
            <p class="tp-msg">"{{ $t->message }}"</p>
            <div class="tp-author">
              <div class="tp-auth-img">
                @if($t->image)<img src="{{ asset($t->image) }}" alt="{{ $t->name }}">@else<span>{{ substr($t->name,0,1) }}</span>@endif
              </div>
              <div class="tp-auth-meta">
                <div class="tp-auth-name">{{ $t->name }}</div>
                <div class="tp-auth-role">{{ $t->role ?? ($t->location ?? 'New Mother') }}</div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="testi-empty">
          <div style="font-size: 48px; margin-bottom: 16px;">&#128156;</div>
          <h3>Testimonials Coming Soon</h3>
          <p>We are gathering heartfelt stories from the families we have supported. Check back soon!</p>
        </div>
      @endif
    </div>
  </div>
</section>

<!-- Book Consultation CTA -->
<section class="testi-cta-section">
  <div class="testi-cta-bg" style="background-image: url('{{ asset('images/mission_bg.png') }}');"></div>
  <div class="testi-cta-overlay"></div>
  <div class="container">
    <div class="testi-cta-grid">
      <!-- Left: Text -->
      <div class="testi-cta-text reveal">
        <span class="testi-cta-label">Begin Your Journey</span>
        <h2 class="testi-cta-title">Ready to Begin Your Journey?</h2>
        <p class="testi-cta-desc">Connect with Anu and experience the compassionate support that these families are talking about.</p>
        <div class="testi-cta-trust">
          <div class="testi-cta-trust-item">
            <svg width="24" height="24" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>Personalised birth plans</span>
          </div>
          <div class="testi-cta-trust-item">
            <svg width="24" height="24" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>Prenatal & postnatal support</span>
          </div>
          <div class="testi-cta-trust-item">
            <svg width="24" height="24" fill="none" stroke="#4DB6AC" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>Free initial consultation</span>
          </div>
        </div>
      </div>

      <!-- Right: Form -->
      <div class="testi-cta-form-wrap reveal d1">
        <h3 class="testi-cta-form-title">Book Consultation</h3>
        <p class="testi-cta-form-sub">Share your details and we'll respond with the right guidance for your journey.</p>
        <form action="{{ route('contact.store') }}" method="POST">
          @csrf
          <div class="testi-cta-row">
            <div class="testi-cta-field">
              <input type="text" name="name" placeholder="Your Name *" required>
            </div>
            <div class="testi-cta-field">
              <input type="tel" name="phone" placeholder="Phone Number">
            </div>
          </div>
          <div class="testi-cta-field">
            <input type="email" name="email" placeholder="Email Address *" required>
          </div>
          <div class="testi-cta-field">
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
          <div class="testi-cta-field">
            <textarea name="message" rows="3" placeholder="Tell us about your journey..." required></textarea>
          </div>
          <button type="submit" class="testi-cta-submit">Book My Consultation</button>
        </form>
      </div>
    </div>
  </div>
</section>

<style>
  .testi-cta-section {
    position: relative;
    padding: 80px 6%;
    overflow: hidden;
    min-height: 580px;
    display: flex;
    align-items: center;
    border-radius: 40px;
    margin: 0 4% 60px;
  }
  .testi-cta-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    border-radius: 40px;
    z-index: 0;
  }
  .testi-cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(30, 40, 35, 0.85) 0%, rgba(40, 55, 45, 0.7) 100%);
    border-radius: 40px;
    z-index: 1;
  }
  .testi-cta-section .container {
    position: relative;
    z-index: 2;
    width: 100%;
  }
  .testi-cta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
  }
  .testi-cta-label {
    display: inline-block;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 3px;
    color: #4DB6AC;
    margin-bottom: 16px;
  }
  .testi-cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 48px);
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 20px;
  }
  .testi-cta-desc {
    font-size: 17px;
    color: rgba(255,255,255,0.8);
    line-height: 1.75;
    margin-bottom: 32px;
    max-width: 480px;
  }
  .testi-cta-trust {
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  .testi-cta-trust-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: rgba(255,255,255,0.85);
    font-size: 15px;
    font-weight: 500;
  }
  .testi-cta-trust-item svg { flex-shrink: 0; }

  /* Form */
  .testi-cta-form-wrap {
    background: rgba(255,255,255,0.97);
    border-radius: 24px;
    padding: 40px 36px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
  }
  .testi-cta-form-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: #3d2b2b;
    margin-bottom: 8px;
  }
  .testi-cta-form-sub {
    font-size: 14px;
    color: #7a6060;
    margin-bottom: 28px;
    line-height: 1.6;
  }
  .testi-cta-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }
  .testi-cta-field {
    margin-bottom: 14px;
  }
  .testi-cta-field input,
  .testi-cta-field select,
  .testi-cta-field textarea {
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
  .testi-cta-field input::placeholder,
  .testi-cta-field textarea::placeholder {
    color: #b0a0a0;
  }
  .testi-cta-field input:focus,
  .testi-cta-field select:focus,
  .testi-cta-field textarea:focus {
    border-color: #4DB6AC;
    box-shadow: 0 0 0 3px rgba(77,182,172,0.12);
  }
  .testi-cta-field select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237a6060' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 40px;
  }
  .testi-cta-field textarea {
    resize: vertical;
    min-height: 80px;
  }
  .testi-cta-submit {
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
  .testi-cta-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(77,182,172,0.4);
    opacity: 0.9;
  }
  @media (max-width: 991px) {
    .testi-cta-grid {
      grid-template-columns: 1fr;
      gap: 40px;
    }
    .testi-cta-text { text-align: center; }
    .testi-cta-desc { margin-left: auto; margin-right: auto; }
    .testi-cta-trust { align-items: center; }
  }
  @media (max-width: 480px) {
    .testi-cta-row { grid-template-columns: 1fr; }
    .testi-cta-form-wrap { padding: 28px 22px; }
    .testi-cta-section { padding: 60px 5%; border-radius: 24px; margin: 0 3% 40px; }
  }
</style>

<style>
/* ===== Testimonials Precision Grid ===== */
.testi-precision-sec {
  padding: 80px 6%;
  background: #fdfaf8; 
}
.tp-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 40px 30px;
  max-width: 1300px;
  margin: 0 auto;
}
.tp-card {
  background: #ffffff;
  padding: 50px 45px;
  border-radius: 24px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.03);
  position: relative;
  transition: transform 0.3s ease;
  border: 1px solid rgba(0,0,0,0.01);
  display: flex;
  flex-direction: column;
}
.tp-card:hover { transform: translateY(-5px); }
.tp-quote-container { margin-bottom: 25px; }
.tp-quote-icon {
  font-family: 'Playfair Display', serif;
  font-size: 72px;
  color: #CDEB8E;
  line-height: 1;
  font-weight: 900;
}
.tp-stars { color: #FFB400; font-size: 18px; margin-bottom: 25px; display: flex; gap: 4px; }
.tp-msg {
  font-size: 17px;
  line-height: 1.8;
  color: #444;
  margin-bottom: 35px;
  font-family: 'Outfit', sans-serif;
  letter-spacing: 0.1px;
  flex-grow: 1;
}
.tp-author { display: flex; align-items: center; gap: 16px; border-top: 1px solid #f5f5f5; padding-top: 25px; }
.tp-auth-img { 
  width: 56px; height: 56px; border-radius: 50%; overflow: hidden; 
  background: #f0f0f0; border: 1.5px solid #CDEB8E; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
}
.tp-auth-img img { width: 100%; height: 100%; object-fit: cover; }
.tp-auth-img span { color: #4DB6AC; font-weight: 700; font-size: 20px; }
.tp-auth-name { font-weight: 800; font-size: 18px; color: #222; margin-bottom: 2px; }
.tp-auth-role { font-size: 14px; color: #888; text-transform: capitalize; font-weight: 500; }
.testi-empty { text-align: center; padding: 100px 20px; grid-column: 1 / -1; }
@media (max-width: 768px) {
  .tp-grid { grid-template-columns: 1fr; }
  .tp-card { padding: 40px 30px; }
}
</style>

@endsection
