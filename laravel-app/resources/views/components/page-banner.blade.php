@props(['title', 'subtitle' => '', 'breadcrumbs' => [], 'image' => ''])

<div class="page-banner {{ $attributes->get('class', '') }}" style="background-image: url('{{ $image }}');">
  <div class="page-banner-overlay"></div>
  <div class="page-banner-content">
    @if(count($breadcrumbs) > 0)
    <nav class="page-banner-breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      @foreach($breadcrumbs as $crumb)
        <span class="breadcrumb-sep">&rsaquo;</span>
        @if(isset($crumb['url']))
          <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
        @else
          <span class="breadcrumb-current">{{ $crumb['label'] }}</span>
        @endif
      @endforeach
    </nav>
    @endif
    <h1 class="page-banner-title">{{ $title }}</h1>
    @if($subtitle)
      <p class="page-banner-subtitle">{{ $subtitle }}</p>
    @endif
  </div>
</div>

<style>
.page-banner {
  position: relative;
  min-height: 380px;
  display: flex;
  align-items: center;
  background-size: cover;
  background-position: center;
  overflow: hidden;
}
.page-banner-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(61, 43, 43, 0.88) 0%, rgba(77, 182, 172, 0.45) 100%);
  z-index: 1;
}
.page-banner-content {
  position: relative;
  z-index: 2;
  max-width: 1240px;
  margin: 0 auto;
  padding: 100px 6% 60px;
  width: 100%;
}
.page-banner-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 20px;
  font-size: 14px;
}
.page-banner-breadcrumb a {
  color: rgba(255,255,255,0.75);
  transition: color 0.25s;
}
.page-banner-breadcrumb a:hover {
  color: #ffffff;
}
.page-banner-breadcrumb .breadcrumb-sep {
  color: rgba(255,255,255,0.4);
  font-size: 16px;
}
.page-banner-breadcrumb .breadcrumb-current {
  color: #4DB6AC;
  font-weight: 600;
}
.page-banner-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(38px, 6vw, 64px);
  font-weight: 700;
  color: #ffffff;
  line-height: 1.1;
  margin: 0 0 16px;
  text-shadow: 0 4px 20px rgba(0,0,0,0.25);
}
.page-banner-subtitle {
  color: rgba(255,255,255,0.9);
  font-size: 18px;
  line-height: 1.7;
  max-width: 620px;
  margin: 0;
}
@media (max-width: 768px) {
  .page-banner { min-height: 300px; }
  .page-banner-content { padding: 90px 5% 40px; }
  .page-banner-subtitle { font-size: 16px; }
}
</style>
