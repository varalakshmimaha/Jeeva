@extends('layouts.app')

@section('title', 'Gallery - Jiva Birth and Beyond')

@section('content')

<x-page-banner
  :title="(isset($banner) && $banner) ? $banner->title : 'Our Gallery'"
  :subtitle="(isset($banner) && $banner && $banner->description) ? $banner->description : 'A glimpse into our prenatal yoga sessions, doula support, nutrition guidance, and childbirth education.'"
  :image="(isset($banner) && $banner && $banner->image) ? asset($banner->image) : asset('images/banner-gallery.png')"
  :breadcrumbs="[['label' => 'Gallery']]"
/>

<!-- Gallery Section -->
<section class="gallery-showcase-section">
  <div class="container">
    @php
      $categories = $galleryItems->pluck('category')->filter()->unique()->values();
    @endphp

    @if($categories->count() > 0)
    <div class="gallery-filters reveal">
      <button type="button" class="gallery-filter is-active" data-gallery-filter="all">All Photos</button>
      @foreach($categories as $cat)
        <button type="button" class="gallery-filter" data-gallery-filter="{{ $cat }}">{{ ucfirst($cat) }}</button>
      @endforeach
    </div>
    @endif

    <div class="gallery-grid gallery-grid-showcase" id="gallery-items">
      @forelse($galleryItems as $item)
          <article class="gallery-showcase-card reveal" data-gallery-category="{{ $item->category }}">
              <div class="gallery-showcase-surface">
                  <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="gallery-image-full">
              </div>
          </article>
      @empty
          <div class="no-gallery-items reveal">No gallery items found. Check back soon!</div>
      @endforelse
    </div>
  </div>
</section>

<style>
.gallery-image-full {
  position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
}
.gallery-showcase-card { position: relative; overflow: hidden; border-radius: 20px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('[data-gallery-filter]');
    const galleryCards = document.querySelectorAll('[data-gallery-category]');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.galleryFilter;
            filterBtns.forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');

            galleryCards.forEach(card => {
                if (filter === 'all' || card.dataset.galleryCategory === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<section class="cta-modern-section reveal">
  <div class="container container-cta-boxed">
    <div class="cta-modern-card">
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
      <div class="cta-content" style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Ready to Begin Your Journey?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Schedule your consultation and take the first step toward an empowered birth experience.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+14375534448" class="btn-ghost">Call Us</a>
          <a href="{{ route('contact') }}" class="btn-white-solid">Book Now</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
