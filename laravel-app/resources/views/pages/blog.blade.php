@extends('layouts.app')

@section('title', 'Blog - Dental Tips & Articles')

@section('content')



<!-- Page Header (Hero Banner) -->
<div class="page-header" style="background: linear-gradient(135deg, rgba(10, 22, 40, 0.85) 0%, rgba(10, 22, 40, 0.7) 100%), url('{{ asset('images/blog_implants.png') }}'); background-size: cover; background-position: center; min-height: 340px; display: flex; align-items: center;">
  <div class="page-header-body">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span class="breadcrumb-sep">&rsaquo;</span>
      <span class="breadcrumb-current">Blog</span>
    </nav>
    <h1 style="text-shadow: 0 4px 12px rgba(0,0,0,0.3);">Dental Care Insights</h1>
    <p style="color: rgba(255,255,255,0.9); font-size: 18px; max-width: 600px;">Expert insights on oral health, treatment options, and smile care tips from our dental specialists.</p>
  </div>
</div>

<!-- Blog Grid -->
<section>
  <div class="container">
    <div class="blog-grid" id="dental-blogs-blade">
      @foreach($blogs as $idx => $blog)
        <article class="blog-card reveal d{{ ($idx % 6) + 1 }}">
          <div class="blog-thumb">
            <img src="{{ asset($blog['image'] ?? 'images/blog_dental_hygiene.png') }}" alt="{{ $blog['title'] }}" class="blog-image">
          </div>
          <div class="blog-body">
            <div class="blog-cat">{{ $blog['category'] ?? 'Dental Tips' }}</div>
            <h3>{{ $blog['title'] }}</h3>
            <p>{{ $blog['excerpt'] }}</p>
            <div class="blog-footer">
              <span class="blog-meta">{{ $blog['date'] ?? '' }}</span>
              <a href="{{ route('blog.show', $blog['slug']) }}" class="read-more-btn">
                Read <span class="arrow">&rarr;</span>
              </a>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>

<!-- Modern CTA Section -->
<section class="cta-modern-section reveal">
  <div class="container">
    <div class="cta-modern-card">
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
      <div style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(30px, 4vw, 48px); margin-bottom: 16px; color: white;">Have Dental Questions?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.7;">Our experts are ready to answer. Schedule a free consultation today.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+917483211870" class="btn-ghost">
            📞 Call Us
          </a>
          <a href="{{ route('contact') }}" class="btn-white-solid">
            Book Consultation →
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
