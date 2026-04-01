@php($footerYear = now()->year)

<footer class="site-footer">
  <div class="site-footer-main">
    <div class="container site-footer-grid">
      <div class="site-footer-brand">
        <h3 class="site-footer-title">About Us</h3>
        <a href="{{ route('home') }}" class="site-footer-brand-link">
          <div class="site-footer-brand-mark">
            @if(!empty($siteSettings['logo_url']))
              <img src="{{ $siteSettings['logo_url'] }}" alt="{{ $siteSettings['company_name'] }} logo" class="site-footer-brand-image">
            @else
              &#127973;
            @endif
          </div>
          <div>
            <div class="site-footer-brand-name">{{ $siteSettings['company_name'] }}</div>
            <div class="site-footer-brand-tag">Orthodontics</div>
          </div>
        </a>
        <p class="site-footer-brand-copy">
          Trusted dental care for your whole family with compassionate treatment, modern technology,
          and a warm clinic experience at {{ $siteSettings['company_address'] }}.
        </p>
      </div>

      <div class="site-footer-column">
        <h3 class="site-footer-title">Quick Links</h3>
        <ul class="site-footer-links">
          <li><a href="{{ route('home') }}"><span>&rsaquo;</span> Home</a></li>
          <li><a href="{{ route('services') }}"><span>&rsaquo;</span> Services</a></li>
          <li><a href="{{ route('blog') }}"><span>&rsaquo;</span> Blog</a></li>
          <li><a href="{{ route('gallery') }}"><span>&rsaquo;</span> Gallery</a></li>
          <li><a href="{{ route('contact') }}"><span>&rsaquo;</span> Contact Us</a></li>
        </ul>
      </div>

      <div class="site-footer-column">
        <h3 class="site-footer-title">Legal</h3>
        <ul class="site-footer-links">
          <li><a href="{{ route('privacy') }}"><span>&rsaquo;</span> Privacy Policy</a></li>
          <li><a href="{{ route('terms') }}"><span>&rsaquo;</span> Terms of Service</a></li>
        </ul>
      </div>

      <div class="site-footer-column">
        <h3 class="site-footer-title">Contact Us</h3>
        <div class="site-footer-contact-list">
          <div class="site-footer-contact-item">
            <span class="site-footer-contact-icon" aria-hidden="true">&#128205;</span>
            <div>
              <p>{{ $siteSettings['company_address'] }}</p>
            </div>
          </div>

          <div class="site-footer-contact-item">
            <span class="site-footer-contact-icon" aria-hidden="true">&#128222;</span>
            <div>
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['company_phone']) }}">{{ $siteSettings['company_phone'] }}</a>
            </div>
          </div>

          <div class="site-footer-contact-item">
            <span class="site-footer-contact-icon" aria-hidden="true">&#9993;</span>
            <div>
              <a href="mailto:{{ $siteSettings['company_email'] }}">{{ $siteSettings['company_email'] }}</a>
            </div>
          </div>

          <div class="site-footer-social-icons">
            @if(!empty($siteSettings['facebook_link']))
              <a href="{{ $siteSettings['facebook_link'] }}" target="_blank" class="site-footer-social-link" title="Facebook" aria-label="Follow us on Facebook">
                <span>f</span>
              </a>
            @endif
            @if(!empty($siteSettings['whatsapp_link']))
              <a href="{{ $siteSettings['whatsapp_link'] }}" target="_blank" class="site-footer-social-link" title="WhatsApp" aria-label="Contact us on WhatsApp">
                <span>💬</span>
              </a>
            @endif
            @if(!empty($siteSettings['instagram_link']))
              <a href="{{ $siteSettings['instagram_link'] }}" target="_blank" class="site-footer-social-link" title="Instagram" aria-label="Follow us on Instagram">
                <span>📷</span>
              </a>
            @endif
            @if(!empty($siteSettings['twitter_link']))
              <a href="{{ $siteSettings['twitter_link'] }}" target="_blank" class="site-footer-social-link" title="Twitter" aria-label="Follow us on Twitter">
                <span>𝕏</span>
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="site-footer-bottom">
    <div class="container site-footer-bottom-row">
      <p>&copy; {{ $footerYear }} {{ $siteSettings['company_name'] }}. All rights reserved.</p>
      <div class="site-footer-bottom-links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <a href="{{ route('terms') }}">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
</footer>
