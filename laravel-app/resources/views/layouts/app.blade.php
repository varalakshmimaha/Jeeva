<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title') - Western Dental & Orthodontics</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body data-page-name="{{ $pageName ?? 'home' }}">

<div class="cursor-glow" id="cursorGlow"></div>

<!-- NAV -->
<nav id="mainNav">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="logo">
      <div class="logo-mark">
        @if(!empty($siteSettings['logo_url']))
          <img src="{{ $siteSettings['logo_url'] }}" alt="{{ $siteSettings['company_name'] }} logo" class="logo-image">
        @else
          &#127973;
        @endif
      </div>
      <div class="logo-words">
        <span class="logo-name">{{ $siteSettings['company_name'] }}</span>
        <span class="logo-tag">Orthodontics</span>
      </div>
    </a>
    <ul class="nav-links">
      <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
      <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog', 'blog.show') ? 'active' : '' }}">Blog</a></li>
      <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
      <li><a href="{{ route('contact') }}" class="nav-cta-btn">&#128222; Contact</a></li>
    </ul>
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="mob-menu" id="mobMenu">
  <a href="{{ route('home') }}">Home</a>
  <a href="{{ route('services') }}">Services</a>
  <a href="{{ route('blog') }}">Blog</a>
  <a href="{{ route('gallery') }}">Gallery</a>
  <a href="{{ route('contact') }}">Contact</a>
</div>

<!-- Main Content -->
@yield('content')

<x-footer-contact />

<script src="{{ asset('js/dental-data.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
