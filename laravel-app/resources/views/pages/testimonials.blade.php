@extends('layouts.app')

@section('title', 'Testimonials - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  title="What Mamas Say"
  subtitle="Heartfelt words from the families I have had the honour of supporting through their birth journeys."
  image="https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=1600&q=80"
  :breadcrumbs="[['label' => 'Testimonials']]"
/>

<!-- Testimonials Grid -->
<section style="padding: 90px 6%; background: var(--cream);">
  <div class="container">
    @if($testimonials->isNotEmpty())
      <div class="testimonials-grid">
        @foreach($testimonials as $index => $testimonial)
          <div class="testimonial-card reveal d{{ ($index % 4) + 1 }}">
            <div class="testimonial-quote-icon">&ldquo;</div>
            <div class="testimonial-stars">
              @for($i = 0; $i < $testimonial->rating; $i++)
                <span class="star-filled">&#9733;</span>
              @endfor
              @for($i = $testimonial->rating; $i < 5; $i++)
                <span class="star-empty">&#9733;</span>
              @endfor
            </div>
            <p class="testimonial-message">{{ $testimonial->message }}</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">
                @if($testimonial->image)
                  <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}">
                @else
                  <span>{{ strtoupper(substr($testimonial->name, 0, 1)) }}</span>
                @endif
              </div>
              <div>
                <div class="testimonial-name">{{ $testimonial->name }}</div>
                @if($testimonial->role)
                  <div class="testimonial-role">{{ $testimonial->role }}</div>
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
  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 28px;
  }
  .testimonial-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 36px 32px;
    border: 1px solid var(--border);
    position: relative;
    transition: all 0.35s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  }
  .testimonial-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(77, 182, 172, 0.12);
    border-color: rgba(77, 182, 172, 0.3);
  }
  .testimonial-quote-icon {
    font-family: 'Playfair Display', serif;
    font-size: 60px;
    line-height: 1;
    color: var(--teal);
    opacity: 0.25;
    position: absolute;
    top: 20px;
    right: 28px;
  }
  .testimonial-stars {
    margin-bottom: 16px;
    display: flex;
    gap: 2px;
  }
  .star-filled { color: #f59e0b; font-size: 18px; }
  .star-empty { color: #e5e7eb; font-size: 18px; }
  .testimonial-message {
    color: var(--muted);
    font-size: 15px;
    line-height: 1.75;
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
  }
  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 14px;
    padding-top: 20px;
    border-top: 1px solid var(--border);
  }
  .testimonial-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--grad-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 18px;
    overflow: hidden;
    flex-shrink: 0;
  }
  .testimonial-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .testimonial-name {
    font-weight: 700;
    font-size: 15px;
    color: var(--navy);
  }
  .testimonial-role {
    font-size: 12px;
    color: var(--muted);
    margin-top: 2px;
  }

  @media (max-width: 860px) {
    .testimonials-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

@endsection
