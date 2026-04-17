@extends('layouts.app')

@section('title', $testimonial->name . ' - Testimonial - Jiva Birth and Beyond')

@section('content')

@php
  $bImgs = is_array($testimonial->before_image) ? $testimonial->before_image : (empty($testimonial->before_image) ? [] : [$testimonial->before_image]);
  $aImgs = is_array($testimonial->after_image)  ? $testimonial->after_image  : (empty($testimonial->after_image)  ? [] : [$testimonial->after_image]);
  $gallery = array_merge(
    array_map(fn($img) => ['src' => $img, 'label' => 'Before'], $bImgs),
    array_map(fn($img) => ['src' => $img, 'label' => 'After'],  $aImgs)
  );
  $imgExists = $testimonial->image && file_exists(public_path($testimonial->image));
@endphp

<x-page-banner
  title="{{ $testimonial->name }}'s Story"
  subtitle="{{ $testimonial->role ?? 'New Mother' }}"
  :image="asset('images/banner-about.png')"
  :breadcrumbs="[['label' => 'Testimonials', 'url' => route('testimonials')], ['label' => $testimonial->name]]"
/>

<section class="ts-show-section">
  <div class="container">
    <div class="ts-show-grid">
      <div class="ts-show-img-col">
        @if($imgExists)
          <div class="ts-show-photo">
            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}">
          </div>
        @else
          <div class="ts-show-photo ts-show-photo-initial">
            <span>{{ substr($testimonial->name, 0, 1) }}</span>
          </div>
        @endif
      </div>
      <div class="ts-show-content-col">
        @if($testimonial->category)
          <span class="ts-show-cat">{{ $testimonial->category }}</span>
        @endif
        <h1 class="ts-show-name">{{ $testimonial->name }}</h1>
        <div class="ts-show-role">{{ $testimonial->role ?? 'New Mother' }}</div>
        <div class="ts-show-stars">
          @for($i=0; $i<($testimonial->rating ?? 5); $i++)<span>&#9733;</span>@endfor
        </div>
        <div class="ts-show-quote-icon">&ldquo;</div>
        <p class="ts-show-message">{{ $testimonial->message }}</p>
      </div>
    </div>

    @if(count($gallery))
      <div class="ts-show-gallery-wrap">
        <h2 class="ts-show-gallery-title">Journey Gallery</h2>
        <div class="ts-show-gallery">
          @foreach($gallery as $g)
            <a href="{{ asset($g['src']) }}" class="ts-show-gallery-item {{ strtolower($g['label']) }}" target="_blank" rel="noopener">
              <img src="{{ asset($g['src']) }}" alt="{{ $g['label'] }} — {{ $testimonial->name }}" loading="lazy">
              <span class="ts-show-gallery-label">{{ $g['label'] }}</span>
            </a>
          @endforeach
        </div>
      </div>
    @endif

    <div class="ts-show-back-wrap">
      <a href="{{ route('testimonials') }}" class="ts-show-back">&larr; Back to All Testimonials</a>
    </div>
  </div>
</section>

<style>
.ts-show-section {
  padding: 80px 6%;
  background: #fdfaf8;
}
.ts-show-grid {
  display: grid;
  grid-template-columns: 380px 1fr;
  gap: 50px;
  align-items: start;
  max-width: 1100px;
  margin: 0 auto 60px;
  background: #ffffff;
  padding: 48px;
  border-radius: 28px;
  box-shadow: 0 12px 50px rgba(0,0,0,0.05);
}
.ts-show-photo {
  width: 100%;
  aspect-ratio: 1 / 1;
  border-radius: 22px;
  overflow: hidden;
  background: #f5f1ee;
  border: 3px solid #CDEB8E;
  display: flex;
  align-items: center;
  justify-content: center;
}
.ts-show-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }
.ts-show-photo-initial span {
  color: #4DB6AC;
  font-weight: 700;
  font-size: 120px;
  font-family: 'Playfair Display', serif;
}
.ts-show-cat {
  display: inline-block;
  background: rgba(77,182,172,0.12);
  color: #2c7d75;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 999px;
  margin-bottom: 18px;
}
.ts-show-name {
  font-family: 'Playfair Display', serif;
  font-size: clamp(32px, 4vw, 44px);
  font-weight: 700;
  color: #222;
  line-height: 1.15;
  margin-bottom: 8px;
}
.ts-show-role {
  font-size: 16px;
  color: #7a6060;
  font-weight: 500;
  margin-bottom: 18px;
}
.ts-show-stars {
  color: #FFB400;
  font-size: 22px;
  margin-bottom: 24px;
  letter-spacing: 3px;
}
.ts-show-quote-icon {
  font-family: 'Playfair Display', serif;
  font-size: 80px;
  color: #CDEB8E;
  line-height: 0.5;
  font-weight: 900;
  margin-bottom: 18px;
}
.ts-show-message {
  font-size: 18px;
  line-height: 1.9;
  color: #3d3d3d;
  font-family: 'Outfit', sans-serif;
  white-space: pre-line;
}

.ts-show-gallery-wrap {
  max-width: 1100px;
  margin: 0 auto 60px;
  padding: 44px;
  background: #ffffff;
  border-radius: 28px;
  box-shadow: 0 12px 50px rgba(0,0,0,0.05);
}
.ts-show-gallery-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(24px, 3vw, 32px);
  color: #222;
  margin-bottom: 28px;
  text-align: center;
}
.ts-show-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 16px;
}
.ts-show-gallery-item {
  position: relative;
  display: block;
  aspect-ratio: 1 / 1;
  border-radius: 16px;
  overflow: hidden;
  background: #f5f1ee;
  text-decoration: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.ts-show-gallery-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 30px rgba(0,0,0,0.1);
}
.ts-show-gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.ts-show-gallery-label {
  position: absolute;
  top: 12px;
  left: 12px;
  background: rgba(255,255,255,0.95);
  font-size: 11px;
  font-weight: 800;
  padding: 5px 12px;
  border-radius: 999px;
  letter-spacing: 1.2px;
  text-transform: uppercase;
}
.ts-show-gallery-item.before .ts-show-gallery-label { color: #b8636b; }
.ts-show-gallery-item.after .ts-show-gallery-label  { color: #2c7d75; }

.ts-show-back-wrap {
  max-width: 1100px;
  margin: 0 auto;
  text-align: center;
}
.ts-show-back {
  display: inline-block;
  padding: 14px 30px;
  background: transparent;
  color: #2c7d75;
  border: 1.5px solid #4DB6AC;
  border-radius: 999px;
  font-family: 'Outfit', sans-serif;
  font-size: 14px;
  font-weight: 700;
  text-decoration: none;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  transition: all 0.25s ease;
}
.ts-show-back:hover {
  background: #4DB6AC;
  color: #fff;
  box-shadow: 0 8px 20px rgba(77,182,172,0.3);
}

@media (max-width: 860px) {
  .ts-show-grid {
    grid-template-columns: 1fr;
    gap: 30px;
    padding: 32px 22px;
    text-align: center;
  }
  .ts-show-photo { max-width: 280px; margin: 0 auto; }
  .ts-show-gallery-wrap { padding: 28px 20px; }
  .ts-show-gallery { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
}
</style>

@endsection
