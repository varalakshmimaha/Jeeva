@extends('layouts.app')

@section('title', 'Testimonials - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  class="testi-banner"
  :title="(isset($banner) && $banner) ? $banner->title : 'What our Client Says'"
  :subtitle="(isset($banner) && $banner && $banner->description) ? $banner->description : 'Heartfelt words from the families I have had the honour of supporting through their birth journeys.'"
  :image="(isset($banner) && $banner && $banner->image) ? asset($banner->image) : asset('storage/new born.jpg')"
  :breadcrumbs="[['label' => 'Testimonials']]"
/>

<style>
  /* Testimonials banner: show full newborn image, no cropping */
  .page-banner.testi-banner {
    background-size: 100% 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-color: #1e2b30;
  }
  .page-banner.testi-banner .page-banner-overlay {
    background: linear-gradient(90deg, rgba(20,30,35,0.55) 0%, rgba(20,30,35,0.25) 45%, rgba(20,30,35,0) 70%);
  }
  .page-banner.testi-banner .page-banner-title {
    text-shadow: 0 4px 20px rgba(0,0,0,0.55);
  }
  .page-banner.testi-banner .page-banner-subtitle {
    text-shadow: 0 2px 10px rgba(0,0,0,0.5);
  }
  @media (max-width: 768px) {
    .page-banner.testi-banner { background-size: cover; background-position: center; }
    .page-banner.testi-banner .page-banner-overlay {
      background: linear-gradient(180deg, rgba(20,30,35,0.55) 0%, rgba(20,30,35,0.35) 100%);
    }
  }
</style>

<!-- Testimonials Precision Grid -->
<section class="testi-precision-sec">
  <div class="container">
    @php
      $categories = $testimonials->pluck('category')->filter()->unique()->values();
    @endphp

    @if($categories->isNotEmpty())
      <div class="tp-filter-bar">
        <button type="button" class="tp-filter-chip is-active" data-filter="all">All</button>
        @foreach($categories as $cat)
          <button type="button" class="tp-filter-chip" data-filter="{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</button>
        @endforeach
      </div>
    @endif

    <div class="tp-grid">
      @if($testimonials->isNotEmpty())
        @foreach($testimonials as $t)
          @php $catSlug = $t->category ? \Illuminate\Support\Str::slug($t->category) : 'uncategorized'; @endphp
          <div class="tp-card" data-category="{{ $catSlug }}">
            @if($t->category)
              <span class="tp-cat-badge">{{ $t->category }}</span>
            @endif

            <div class="tp-top">
              <div class="tp-left">
                @php $imgExists = $t->image && file_exists(public_path($t->image)); @endphp
                @if($imgExists)
                  <div class="tp-left-photo"><img src="{{ asset($t->image) }}?v={{ @filemtime(public_path($t->image)) }}" alt="{{ $t->name }}" onerror="this.parentElement.classList.add('tp-left-photo-initial');this.parentElement.innerHTML='<span>{{ substr($t->name,0,1) }}</span>';"></div>
                @else
                  <div class="tp-left-photo tp-left-photo-initial"><span>{{ substr($t->name,0,1) }}</span></div>
                @endif
              </div>

              <div class="tp-right">
                <div class="tp-quote-container">
                  <span class="tp-quote-icon">“</span>
                </div>
                <div class="tp-stars">
                  @for($i=0; $i<($t->rating ?? 5); $i++)<span class="tp-star">&#9733;</span>@endfor
                </div>
                <p class="tp-msg">"{{ $t->message }}"</p>
                <div class="tp-author">
                  <div class="tp-auth-meta">
                    <div class="tp-auth-name">{{ $t->name }}</div>
                    <div class="tp-auth-role">{{ $t->role ?? 'New Mother' }}</div>
                  </div>
                </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  const chips = document.querySelectorAll('.tp-filter-chip');
  const cards = document.querySelectorAll('.tp-card');
  if (chips.length) {
    chips.forEach(chip => {
      chip.addEventListener('click', function() {
        chips.forEach(c => c.classList.remove('is-active'));
        this.classList.add('is-active');
        const filter = this.dataset.filter;
        cards.forEach(card => {
          card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
        });
      });
    });
  }

});
</script>

<!-- Book Consultation CTA -->
<section class="testi-cta-section">
  <div class="testi-cta-bg" style="background-image: url('{{ asset('storage/moutain.jpg') }}');"></div>
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
        <form action="{{ route('contact.store') }}" method="POST" class="js-cta-with-datetime">
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
            <div class="jiva-pickdate" data-calendly tabindex="0" role="button" aria-label="Pick a date and time">
              <svg class="jiva-pickdate__ico" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <input type="text" name="preferred_time_label" class="jiva-pickdate__input" placeholder="Pick a Date &amp; Time *" readonly required data-calendly-time>
              <svg class="jiva-pickdate__chev" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
          </div>
          <div class="testi-cta-field">
            <textarea name="message" rows="3" placeholder="Other Notes"></textarea>
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
    padding: 25px 6%;
    overflow: hidden;
    min-height: 200px;
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
    background: linear-gradient(135deg, rgba(30, 40, 35, 0.55) 0%, rgba(40, 55, 45, 0.45) 100%);
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
  .testi-cta-label::before {
    content: '';
    width: 24px;
    height: 2px;
    background: #4DB6AC;
    border-radius: 2px;
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
    .testi-cta-submit {
      padding: 14px 18px;
      font-size: 14px;
      letter-spacing: 1px;
      white-space: normal;
      line-height: 1.3;
    }
  }
</style>

<style>
/* ===== Testimonials Precision Grid ===== */
.testi-precision-sec {
  padding: 80px 6%;
  background: #fdfaf8; 
}
.tp-grid {
  display: flex;
  flex-direction: column;
  gap: 36px;
  max-width: 1100px;
  margin: 0 auto;
}
.tp-card {
  background: #ffffff;
  padding: 40px 44px;
  border-radius: 24px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.04);
  position: relative;
  transition: transform 0.3s ease;
  border: 1px solid rgba(0,0,0,0.01);
}
.tp-card:hover { transform: translateY(-4px); }

/* Top row: left image + right content */
.tp-top {
  display: grid;
  grid-template-columns: 260px 1fr;
  gap: 36px;
  align-items: center;
}
.tp-left-photo {
  width: 100%;
  aspect-ratio: 1 / 1;
  border-radius: 20px;
  overflow: hidden;
  background: #f5f1ee;
  border: 2px solid #CDEB8E;
  display: flex;
  align-items: center;
  justify-content: center;
}
.tp-left-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }
.tp-left-photo-initial span {
  color: #4DB6AC;
  font-weight: 700;
  font-size: 72px;
  font-family: 'Playfair Display', serif;
}

.tp-right { display: flex; flex-direction: column; }
.tp-quote-container { margin-bottom: 14px; }
.tp-quote-icon {
  font-family: 'Playfair Display', serif;
  font-size: 64px;
  color: #CDEB8E;
  line-height: 1;
  font-weight: 900;
}
.tp-stars { color: #FFB400; font-size: 18px; margin-bottom: 18px; display: flex; gap: 4px; }
.tp-msg {
  font-size: 17px;
  line-height: 1.8;
  color: #444;
  margin-bottom: 22px;
  font-family: 'Outfit', sans-serif;
  letter-spacing: 0.1px;
}
.tp-author { display: flex; align-items: center; gap: 16px; border-top: 1px solid #f5f5f5; padding-top: 18px; }
.tp-auth-name { font-weight: 800; font-size: 18px; color: #222; margin-bottom: 2px; }
.tp-auth-role { font-size: 14px; color: #888; text-transform: capitalize; font-weight: 500; }
.testi-empty { text-align: center; padding: 100px 20px; grid-column: 1 / -1; }

/* Category filter chips */
.tp-filter-bar {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
  max-width: 1100px;
  margin: 0 auto 45px;
}
.tp-filter-chip {
  border: 1.5px solid #e8d8d8;
  background: #ffffff;
  color: #5a4444;
  font-family: 'Outfit', sans-serif;
  font-size: 14px;
  font-weight: 600;
  padding: 9px 20px;
  border-radius: 999px;
  cursor: pointer;
  transition: all 0.25s ease;
  letter-spacing: 0.2px;
}
.tp-filter-chip:hover {
  border-color: #4DB6AC;
  color: #2c7d75;
}
.tp-filter-chip.is-active {
  background: #4DB6AC;
  border-color: #4DB6AC;
  color: #ffffff;
  box-shadow: 0 6px 16px rgba(77,182,172,0.25);
}

/* Category badge on card */
.tp-cat-badge {
  position: absolute;
  top: 20px;
  right: 20px;
  background: rgba(77,182,172,0.12);
  color: #2c7d75;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.6px;
  text-transform: uppercase;
  padding: 5px 11px;
  border-radius: 999px;
}

@media (max-width: 860px) {
  .tp-card { padding: 30px 22px; }
  .tp-top { grid-template-columns: 1fr; gap: 22px; text-align: center; }
  .tp-left-photo { max-width: 200px; margin: 0 auto; }
  .tp-author { justify-content: center; }
  .tp-filter-bar { margin-bottom: 30px; }
  .tp-cat-badge { position: static; display: inline-block; margin-bottom: 12px; }
}
</style>

<!-- Book Consultation CTA -->
<x-book-consultation-form />

@endsection
