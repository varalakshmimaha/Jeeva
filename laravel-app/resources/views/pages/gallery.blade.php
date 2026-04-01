@extends('layouts.app')

@section('title', 'Gallery - Western Dental & Orthodontics')

@section('content')



<!-- Page Header (Hero Banner) -->
<div class="page-header" style="background: linear-gradient(135deg, rgba(10, 22, 40, 0.85) 0%, rgba(10, 22, 40, 0.7) 100%), url('{{ asset('images/blog_braces.png') }}'); background-size: cover; background-position: center; min-height: 340px; display: flex; align-items: center;">
  <div class="page-header-body">
    <div class="breadcrumb">Home &rsaquo; <span>Gallery</span></div>
    <h1 style="text-shadow: 0 4px 12px rgba(0,0,0,0.3);">Our Transformation Gallery</h1>
    <p style="color: rgba(255,255,255,0.9); font-size: 18px; max-width: 600px;">A look inside our modern clinic, equipment, and real patient smile transformations.</p>
  </div>
</div>

<!-- Gallery Section -->
<section class="gallery-showcase-section">
  <div class="container">
    <div class="gallery-filters reveal">
      <button type="button" class="gallery-filter is-active" data-gallery-filter="all">All Photos</button>
      <button type="button" class="gallery-filter" data-gallery-filter="clinic-interior">Clinic Interior</button>
      <button type="button" class="gallery-filter" data-gallery-filter="equipment">Equipment</button>
      <button type="button" class="gallery-filter" data-gallery-filter="before-after">Before &amp; After</button>
    </div>

    <div class="gallery-grid gallery-grid-showcase" id="dental-gallery">
      @forelse($galleryItems as $item)
          <article class="gallery-showcase-card reveal" data-gallery-category="{{ $item->category }}" tabindex="0">
              <div class="gallery-showcase-surface {{ $item->color_class }}">
                  <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="gallery-image-full">
                  <div class="gallery-info-overlay">
                      <h3 class="gallery-showcase-title">{{ $item->title }}</h3>
                  </div>
              </div>
          </article>
      @empty
          <div class="no-gallery-items reveal">No gallery items found. Check back soon for new patient transformations!</div>
      @endforelse
    </div>
  </div>
</section>

<!-- Lightbox Modal -->
<div id="gallery-lightbox" class="lightbox-container">
  <div class="lightbox-backdrop"></div>
  <button id="lightbox-close" class="lightbox-close-btn">&times;</button>
  <div class="lightbox-content">
    <img id="lightbox-img" src="" alt="Full view">
    <h3 id="lightbox-caption"></h3>
  </div>
</div>

<style>
/* Lightbox Styles */
.lightbox-container {
  position: fixed; inset: 0; z-index: 9999;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; pointer-events: none; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  padding: 40px;
}
.lightbox-container.is-active { opacity: 1; pointer-events: all; }
.lightbox-backdrop { position: absolute; inset: 0; background: rgba(10, 22, 40, 0.95); backdrop-filter: blur(8px); }
.lightbox-close-btn {
  position: absolute; top: 30px; right: 30px; 
  background: transparent; border: none; font-size: 48px; color: white;
  cursor: pointer; line-height: 1; z-index: 10;
  transition: transform 0.3s;
}
.lightbox-close-btn:hover { transform: scale(1.2) rotate(90deg); }
.lightbox-content { 
  position: relative; max-width: 900px; width: 100%; 
  transform: translateY(30px) scale(0.95); transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
  display: flex; flex-direction: column; align-items: center;
}
.lightbox-container.is-active .lightbox-content { transform: translateY(0) scale(1); }
.lightbox-content img { width: 100%; border-radius: 12px; box-shadow: 0 40px 100px rgba(0,0,0,0.6); object-fit: contain; max-height: 75vh; }
.lightbox-content h3 {
  color: white; font-family: 'Playfair Display', serif; text-align: center;
  margin-top: 24px; font-size: 26px; font-weight: 500;
  text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

/* Gallery Hover Styles */
.gallery-image-full {
  position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
  transition: transform 0.7s cubic-bezier(0.2, 0.7, 0.2, 1);
}
.gallery-info-overlay {
  position: absolute; inset: 0; background: linear-gradient(to top, rgba(10, 22, 40, 0.95), transparent 70%);
  display: flex; align-items: flex-end; padding: 24px;
  opacity: 0; pointer-events: none; transition: all 0.4s ease;
  transform: translateY(15px);
}
.gallery-showcase-card:hover .gallery-info-overlay {
  opacity: 1; transform: translateY(0);
}
.gallery-showcase-card:hover .gallery-image-full {
  transform: scale(1.12);
}
.gallery-showcase-title {
  color: white !important; font-size: 19px; font-weight: 600; margin: 0;
  text-shadow: 0 4px 8px rgba(0,0,0,0.5);
}
.gallery-showcase-card { cursor: pointer; outline: none; position: relative; overflow: hidden; border-radius: 20px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const lightbox = document.getElementById('gallery-lightbox');
    const lbImg = document.getElementById('lightbox-img');
    const lbCap = document.getElementById('lightbox-caption');
    const closeBtn = document.getElementById('lightbox-close');
    const cards = document.querySelectorAll('.gallery-showcase-card');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const img = card.querySelector('img');
            const title = card.querySelector('.gallery-showcase-title');
            
            if (img && title) {
                lbImg.src = img.src;
                lbCap.textContent = title.textContent;
                lightbox.classList.add('is-active');
                document.body.style.overflow = 'hidden'; 
            }
        });
    });

    const closeLightbox = () => {
        lightbox.classList.remove('is-active');
        document.body.style.overflow = '';
    };

    closeBtn.addEventListener('click', closeLightbox);
    lightbox.querySelector('.lightbox-backdrop').addEventListener('click', closeLightbox);
    
    // Filtering logic relies entirely on dental-data.js

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox.classList.contains('is-active')) {
            closeLightbox();
        }
    });
});
</script>

<section class="cta-modern-section reveal">
  <div class="container container-cta-boxed">
    <div class="cta-modern-card">
      <!-- Subtle Decorative Circles -->
      <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
      <div style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
      
      <div class="cta-content" style="position: relative; z-index: 1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(32px, 4vw, 48px); margin-bottom: 16px; color: white;">Ready to Visit Our Clinic?</h2>
        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 32px; line-height: 1.6;">Schedule your appointment and experience our world-class facilities firsthand.</p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
          <a href="tel:+917483211870" class="btn-ghost">
             📞 Call Us
          </a>
          <a href="{{ route('contact') }}" class="btn-white-solid">
            Book Now &rarr;
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
