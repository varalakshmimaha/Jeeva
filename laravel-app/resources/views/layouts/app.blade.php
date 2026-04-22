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
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
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
      <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Our Services</a></li>
      <li><a href="{{ route('testimonials') }}" class="{{ request()->routeIs('testimonials') ? 'active' : '' }}">Testimonials</a></li>
      <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">CONTACT US</a></li>
    </ul>
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
      <span>CONTACT US</span>
      <span class="mob-menu-link-arrow">›</span>
    </a>
  </div>

  <!-- CTA Buttons -->
  <div class="mob-menu-cta">
    <a href="https://wa.me/917483211870?text=Hi%2C+I'd+like+to+connect+with+Jiva+Birth+and+Beyond" target="_blank" rel="noopener noreferrer" class="mob-menu-cta-call">
      📞 Call Now: 74832 11870
    </a>
    <a href="#" class="mob-menu-cta-book" data-calendly>
      📅 Book Consultation
    </a>
  </div>
</div>
<div class="mob-menu-backdrop" id="mobMenuBackdrop"></div>

<!-- Main Content -->
@yield('content')

<x-footer-contact />

<!-- Floating Social Icons -->
<div class="floating-social">
  @if(!empty($siteSettings['facebook_link']))
  <a href="{{ $siteSettings['facebook_link'] }}"
     class="social-float facebook-float"
     target="_blank"
     rel="noopener noreferrer"
     aria-label="Follow us on Facebook">
    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
      <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
    </svg>
  </a>
  @endif

  @if(!empty($siteSettings['instagram_link']))
  <a href="{{ $siteSettings['instagram_link'] }}"
     class="social-float instagram-float"
     target="_blank"
     rel="noopener noreferrer"
     aria-label="Follow us on Instagram">
    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
      <rect x="2" y="2" width="20" height="20" rx="5"/>
      <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
      <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
    </svg>
  </a>
  @endif

  <!-- WhatsApp Button -->
  <a href="https://wa.me/917483211870?text=Hi%2C+I'd+like+to+connect+with+Jiva+Birth+and+Beyond"
     class="social-float whatsapp-float"
     target="_blank"
     rel="noopener noreferrer"
     aria-label="Contact us on WhatsApp">
    <div class="whatsapp-pulse"></div>
    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.57-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
    </svg>
  </a>
</div>

<script src="{{ asset('js/dental-data.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

<script>
(function () {
  var CALENDLY_URL = 'https://calendly.com/anusuyaashok/30min?hide_gdpr_banner=1';
  window.openJivaCalendly = function () {
    if (typeof Calendly === 'undefined' || !Calendly.initPopupWidget) return false;
    Calendly.initPopupWidget({ url: CALENDLY_URL });
    return false;
  };

  document.querySelectorAll('[data-calendly]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      window.openJivaCalendly();
    });
    if (el.hasAttribute('tabindex')) {
      el.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          window.openJivaCalendly();
        }
      });
    }
  });

  /* Handle footer date/time input click */
  var footerDateInput = document.querySelector('input[name="datetime"]');
  if (footerDateInput) {
    footerDateInput.addEventListener('click', function (e) {
      e.preventDefault();
      window.openJivaCalendly();
    });
  }

  /* Auto-scroll to success/error messages */
  document.addEventListener('DOMContentLoaded', function() {
    var successAlert = document.querySelector('.bf-alert--ok');
    if (successAlert) {
      setTimeout(function() {
        successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }, 300);
    }
  });

  window.addEventListener('message', function (e) {
    if (!e.data || typeof e.data.event !== 'string') return;
    if (e.data.event.indexOf('calendly') !== 0) return;

    /* Handle event scheduled - booking is confirmed */
    if (e.data.event === 'calendly.event_scheduled') {
      var selectedDateTime = 'Date & time selected';
      var startTime = null;

      if (e.data.payload && e.data.payload.event && e.data.payload.event.start_time) {
        startTime = e.data.payload.event.start_time;
      } else if (e.data.payload && e.data.payload.start_time) {
        startTime = e.data.payload.start_time;
      }

      if (startTime) {
        var eventDate = new Date(startTime);
        if (!isNaN(eventDate.getTime())) {
          selectedDateTime = eventDate.toLocaleString('en-US', {
            weekday: 'short',
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
          });
        }
      }

      /* Fill all form date/time inputs with selected date */
      document.querySelectorAll('input[data-calendly-time]').forEach(function (input) {
        input.value = selectedDateTime;
        input.classList.add('is-filled');
        var wrap = input.closest('.jiva-pickdate');
        if (wrap) wrap.classList.add('is-filled');
      });

      /* Also handle footer form date input */
      if (footerDateInput) {
        footerDateInput.value = selectedDateTime;
      }

      /* Close popup after booking is confirmed */
      setTimeout(function() {
        var closeBtn = document.querySelector('.calendly-close-overlay');
        if (closeBtn) {
          closeBtn.click();
        } else if (typeof Calendly !== 'undefined' && Calendly.closePopupWidget) {
          Calendly.closePopupWidget();
        }
      }, 500);
    }
  });
})();
</script>
</body>
</html>
