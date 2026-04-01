@extends('layouts.app')

@section('title', $article['title'])

@section('content')

<div class="page-header">
  <div class="page-header-body">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Home</a> &rsaquo;
      <a href="{{ route('blog') }}">Blog</a> &rsaquo;
      <span>{{ $article['title'] }}</span>
    </div>
    <h1>{{ $article['title'] }}</h1>
    <p>{{ $article['excerpt'] }}</p>
  </div>
</div>

<section>
  <div class="container">
    <article class="article-shell reveal">
      <a href="{{ route('blog') }}" class="article-back">&larr; Back to all articles</a>

      <div class="article-hero">
        <div class="blog-thumb article-thumb {{ $article['thumb_class'] }}">
          @if(!empty($article['image']))
            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="blog-feature-image">
          @else
            <div class="ico-wrap">{{ $article['icon'] }}</div>
          @endif
        </div>

        <div class="article-intro">
          <div class="blog-cat">{{ $article['category'] }}</div>
          <h2>{{ $article['title'] }}</h2>
          <div class="article-meta">{{ $article['date'] }}</div>
          <p class="article-excerpt">{{ $article['excerpt'] }}</p>
        </div>
      </div>

      <div class="article-prose reveal d1">
        {!! nl2br(e($article['content'])) !!}
      </div>
    </article>
  </div>
</section>

<section class="cta-modern-section reveal">
  <div class="container">
    <div class="cta-modern-card">
      <!-- Subtle Decorative Circles -->
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
      
      <div class="cta-content" style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Need Personal Dental Advice?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Book a consultation and get guidance tailored to your smile, comfort, and treatment goals.</p>
        <a href="{{ route('contact') }}" class="btn-white-solid">
          Talk to Us &rarr;
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
