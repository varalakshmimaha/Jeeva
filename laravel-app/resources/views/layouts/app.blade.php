<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title') - Jiva Birth & Beyond</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
@if(!empty($siteSettings['favicon_path']))
<link rel="icon" href="{{ asset($siteSettings['favicon_path']) }}" type="image/png">
@endif
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ @filemtime(public_path('css/style.css')) ?: time() }}">
</head>
<body data-page-name="{{ $pageName ?? 'home' }}">

<div class="cursor-glow" id="cursorGlow"></div>

<!-- NAV -->
<nav id="mainNav">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="logo">
      @if(!empty($siteSettings['logo_url']))
        <img src="{{ $siteSettings['logo_url'] }}" alt="Jiva Birth & Beyond" class="logo-img">
      @endif
    </a>
    <ul class="nav-links">
      <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
      <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
      <li><a href="{{ route('testimonials') }}" class="{{ request()->routeIs('testimonials') ? 'active' : '' }}">Testimonials</a></li>
    </ul>
    <a href="{{ route('contact') }}" class="nav-cta-btn">Contact Us</a>
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="mob-menu" id="mobMenu" role="navigation" aria-label="Mobile navigation">
  <!-- Menu Header -->
  <div class="mob-menu-header">
    <a href="{{ route('home') }}" class="mob-menu-brand">
      @if(!empty($siteSettings['logo_url']))
        <img src="{{ $siteSettings['logo_url'] }}" alt="Jiva Birth & Beyond" style="height:44px;width:auto;object-fit:contain;">
      @endif
    </a>
    <button class="mob-menu-close" id="mobMenuClose" aria-label="Close navigation menu">&#10005;</button>
  </div>

  <!-- Nav Links -->
  <div class="mob-menu-links">
    <a href="{{ route('home') }}" class="mob-menu-link {{ request()->routeIs('home') ? 'mob-menu-link--active' : '' }}">
      <span>Home</span>
      <span class="mob-menu-link-arrow">›</span>
    </a>
    <a href="{{ route('about') }}" class="mob-menu-link {{ request()->routeIs('about') ? 'mob-menu-link--active' : '' }}">
      <span>About Us</span>
      <span class="mob-menu-link-arrow">›</span>
    </a>
    <a href="{{ route('services') }}" class="mob-menu-link {{ request()->routeIs('services') ? 'mob-menu-link--active' : '' }}">
      <span>Services</span>
      <span class="mob-menu-link-arrow">›</span>
    </a>
    <a href="{{ route('testimonials') }}" class="mob-menu-link {{ request()->routeIs('testimonials') ? 'mob-menu-link--active' : '' }}">
      <span>Testimonials</span>
      <span class="mob-menu-link-arrow">›</span>
    </a>
    <a href="{{ route('contact') }}" class="mob-menu-link {{ request()->routeIs('contact') ? 'mob-menu-link--active' : '' }}">
      <span>Contact</span>
      <span class="mob-menu-link-arrow">›</span>
    </a>
  </div>

  <!-- CTA Buttons -->
  <div class="mob-menu-cta">
    <a href="tel:+917483211870" class="mob-menu-cta-call">
      📞 Call Now: +91 74832 11870
    </a>
    <a href="{{ route('contact') }}" class="mob-menu-cta-book">
      📅 Book Consultation
    </a>
  </div>

  <!-- Footer Info -->
  <div class="mob-menu-info">
    <p>🕐 Mon–Sat: 9:00 AM – 8:00 PM</p>
    <p>📍 Tippasandra, Bangalore 560075</p>
  </div>
</div>
<div class="mob-menu-backdrop" id="mobMenuBackdrop"></div>

<!-- Main Content -->
@yield('content')

<x-footer-contact />

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/917483211870?text=Hi%2C+I'd+like+to+connect+with+Jiva+Birth+and+Beyond" 
   class="whatsapp-float" 
   target="_blank" 
   rel="noopener noreferrer"
   aria-label="Contact us on WhatsApp">
  <div class="whatsapp-pulse"></div>
  <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.57-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
  </svg>
</a>

<script src="{{ asset('js/dental-data.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
