@extends('layouts.app')

@section('title', 'Testimonials - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  title="What Mamas Say"
  subtitle="Heartfelt words from the families I have had the honour of supporting through their birth journeys."
  :image="asset('images/banner-about.png')"
  :breadcrumbs="[['label' => 'Testimonials']]"
/>

<!-- Modern Testimonials Grid -->
<section class="testi-modern-sec">
  <div class="container">
    <div class="testi-header">
      <h2 class="testi-main-title">Stories of Strength & Joy</h2>
      <p class="testi-sub-title">Real experiences from mothers who trusted us on their sacred journey into motherhood.</p>
    </div>

    @if($testimonials->isNotEmpty())
      <div class="testi-masonry">
        @foreach($testimonials as $index => $testimonial)
          <div class="testi-modern-card reveal d{{ ($index % 3) + 1 }}">
            <!-- Background Quote Mark -->
            <div class="testi-bg-quote">&ldquo;</div>
            
            <div class="testi-stars">
              @for($i = 0; $i < $testimonial->rating; $i++)
                <span class="star-filled">&#9733;</span>
              @endfor
              @for($i = $testimonial->rating; $i < 5; $i++)
                <span class="star-empty">&#9733;</span>
              @endfor
            </div>
            
            <p class="testi-modern-text">"{{ $testimonial->message }}"</p>
            
            <div class="testi-modern-author">
              <div class="testi-modern-avatar">
                @if($testimonial->image)
                  <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}">
                @else
                  <span>{{ strtoupper(substr($testimonial->name, 0, 1)) }}</span>
                @endif
              </div>
              <div class="testi-modern-meta">
                <div class="testi-modern-name">{{ $testimonial->name }}</div>
                @if($testimonial->role)
                  <div class="testi-modern-role">{{ $testimonial->role }}</div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div style="text-align: center; padding: 60px 20px;">
        <div style="font-size: 48px; margin-bottom: 16px;">&#128156;</div>
        <h3 style="font-family: 'Playfair Display', serif; color: var(--navy); margin-bottom: 12px;">Testimonials Coming Soon</h3>
        <p style="color: var(--muted); max-width: 500px; margin: 0 auto;">We are gathering heartfelt stories from the families we have supported. Check back soon!</p>
      </div>
    @endif
  </div>
</section>

<!-- CTA Section -->
<section class="cta-modern-section reveal">
  <div class="container">
    <div class="cta-modern-card">
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
      <div class="cta-content" style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Ready to Begin Your Journey?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Connect with Anu and experience the compassionate support that these families are talking about.</p>
        <a href="{{ route('contact') }}" class="btn-white-solid">
          Get in Touch &rarr;
        </a>
      </div>
    </div>
  </div>
</section>

<style>
  /* Modern Testimonials CSS */
  .testi-modern-sec {
    padding: 100px 6% 120px;
    background: linear-gradient(180deg, #FAFAFA 0%, #F3F0E9 100%);
    position: relative;
  }
  .testi-header {
    text-align: center;
    margin-bottom: 80px;
  }
  .testi-main-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(34px, 5vw, 48px);
    font-weight: 700;
    color: #2b2b2b;
    margin-bottom: 16px;
  }
  .testi-sub-title {
    color: #6b7280;
    font-size: 18px;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
  }
  .testi-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 40px;
    max-width: 1240px;
    margin: 0 auto;
  }
  @media (min-width: 1024px) {
    .testi-modern-card:nth-child(3n+2) {
      transform: translateY(40px);
    }
  }
  .testi-modern-card {
    background: #ffffff;
    border-radius: 28px;
    padding: 50px 40px;
    position: relative;
    box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid rgba(0,0,0,0.02);
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
  }
  .testi-modern-card:hover {
    box-shadow: 0 25px 60px rgba(0,0,0,0.08);
  }
  @media (min-width: 1024px) {
    .testi-modern-card:hover {
      transform: translateY(-8px);
    }
    .testi-modern-card:nth-child(3n+2):hover {
      transform: translateY(32px);
    }
  }
  .testi-bg-quote {
    position: absolute;
    top: 10px;
    right: 20px;
    font-family: 'Playfair Display', serif;
    font-size: 140px;
    line-height: 1;
    color: #DCD0BC;
    opacity: 0.15;
    pointer-events: none;
    user-select: none;
  }
  .testi-stars {
    margin-bottom: 24px;
    display: flex;
    gap: 4px;
    z-index: 2;
    position: relative;
  }
  .star-filled { color: #EAB308; font-size: 20px; text-shadow: 0 2px 4px rgba(234, 179, 8, 0.2); }
  .star-empty { color: #E5E7EB; font-size: 20px; }
  
  .testi-modern-text {
    font-family: 'Playfair Display', serif;
    font-size: 19px;
    line-height: 1.8;
    color: #4a4a4a;
    font-style: italic;
    margin-bottom: 40px;
    position: relative;
    z-index: 2;
    flex-grow: 1;
  }
  
  .testi-modern-author {
    display: flex;
    align-items: center;
    gap: 16px;
    position: relative;
    z-index: 2;
  }
  .testi-modern-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4DB6AC, #628575);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 700;
    font-size: 22px;
    box-shadow: 0 8px 20px rgba(77, 182, 172, 0.3);
    flex-shrink: 0;
  }
  .testi-modern-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
  }
  .testi-modern-name {
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 17px;
    color: #2b2b2b;
  }
  .testi-modern-role {
    font-size: 13px;
    color: #888;
    margin-top: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
  }
  @media (max-width: 860px) {
    .testi-masonry {
      grid-template-columns: 1fr;
      gap: 30px;
    }
    .testi-modern-card {
      padding: 40px 30px;
    }
  }
</style>

@endsection
