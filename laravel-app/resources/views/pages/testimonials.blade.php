@extends('layouts.app')

@section('title', 'Testimonials - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  class="testi-banner"
  :title="(isset($banner) && $banner) ? $banner->title : 'What our Client Says'"
  :subtitle="(isset($banner) && $banner && $banner->description) ? $banner->description : ''"
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
    align-items: flex-end !important;
  }
  .page-banner.testi-banner .page-banner-content {
    padding-bottom: 48px !important;
    padding-top: 60px !important;
  }
  .page-banner.testi-banner .page-banner-overlay {
    background: linear-gradient(90deg, rgba(20,30,35,0.55) 0%, rgba(20,30,35,0.25) 45%, rgba(20,30,35,0) 70%);
  }
  .page-banner.testi-banner .page-banner-title {
    font-size: clamp(53px, 6vw, 79px) !important;
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
    <div class="tp-section-head">
      <h2 class="tp-section-title">What Our Clients Say</h2>
    </div>

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
                    @if(!empty($t->role))<div class="tp-auth-role">{{ $t->role }}</div>@endif
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
  <div class="testi-cta-bg" style="background-image: url('{{ !empty($siteSettings['cta_bg_image_path']) ? asset('storage/' . $siteSettings['cta_bg_image_path']) : asset('storage/moutain.jpg') }}');"></div>
  <div class="testi-cta-overlay"></div>
  <div class="container">
    <div class="testi-cta-single">
      <div class="testi-cta-content reveal">
        <span class="testi-cta-label">Begin Your Journey</span>
        <h2 class="testi-cta-title">Ready to Begin Your Journey?</h2>
        <p class="testi-cta-desc">Experience the compassionate support our families are talking about. Book your consultation and take the first step towards an empowered birth experience.</p>
        <a href="{{ route('contact') }}" class="testi-cta-submit">Book Consultation</a>
      </div>
    </div>
  </div>
</section>

<style>
  .testi-cta-section {
    position: relative;
    padding: 0 6%;
    overflow: hidden;
    min-height: 450px;
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
  .testi-cta-single {
    max-width: 700px;
    margin: 0 auto;
  }
  .testi-cta-content {
    text-align: center;
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
    font-size: clamp(28px, 3.2vw, 40px);
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 20px;
    white-space: nowrap;
  }
  .testi-cta-desc {
    font-size: 16px;
    color: rgba(255,255,255,0.9);
    line-height: 1.75;
    margin: 0 auto 32px;
    max-width: 520px;
    font-weight: 500;
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
    margin-top: 4px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(77, 182, 172, 0.3);
  }
  .testi-cta-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s ease;
  }
  .testi-cta-submit:hover {
    background: rgba(77, 182, 172, 1);
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(77, 182, 172, 0.6), 0 0 40px rgba(77, 182, 172, 0.4);
  }
  .testi-cta-submit:hover::before {
    left: 100%;
  }
  .testi-cta-submit:active {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(77, 182, 172, 0.4);
  }
  .testi-cta-submit {
    display: block;
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    border-radius: 25px;
    text-decoration: none;
    text-align: center;
  }
  @media (max-width: 480px) {
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
  padding: 60px 6% 80px;
  background: #fdfaf8;
}
.tp-section-head {
  text-align: center;
  max-width: 680px;
  margin: 0 auto 48px;
}
.tp-section-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(28px, 3.5vw, 42px);
  color: #1f3b38;
  font-weight: 700;
  margin: 0 0 12px;
}
.tp-section-sub {
  font-family: 'Outfit', sans-serif;
  font-size: 16px;
  color: #6b5a5a;
  line-height: 1.7;
  margin: 0;
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

@endsection
