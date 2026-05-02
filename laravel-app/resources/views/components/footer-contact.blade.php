@php($footerYear = now()->year)

<footer class="site-footer">
  <!-- Main Footer Content -->
  <div class="site-footer-main">
    <div class="container site-footer-grid">

      <!-- Column 1: About -->
      <div class="site-footer-brand">
        <a href="{{ route('home') }}" class="site-footer-brand-link">
          @if(!empty($siteSettings['logo_url']))
            <img src="{{ $siteSettings['logo_url'] }}" alt="Jiva Birth & Beyond" class="footer-logo-img">
          @endif
        </a>
        <p class="site-footer-brand-copy">
          Supporting you through the intensity and beauty of birth, with grounding care that helps you feel calm, safe, and in control.
        </p>
        @if(!empty($siteSettings['certifications_image_url']))
          <div style="margin-top:0;">
            <img src="{{ $siteSettings['certifications_image_url'] }}" alt="Certifications" style="width:100%;max-width:200px;max-height:90px;object-fit:contain;display:block;">
          </div>
        @endif
      </div>

      <!-- Column 2: Quick Links -->
      <div class="site-footer-column">
        <h3 class="site-footer-title">Quick Links</h3>
        <ul class="site-footer-links">
          <li><a href="{{ route('home') }}"><span class="link-arrow">&rsaquo;</span> Home</a></li>
          <li><a href="{{ route('about') }}"><span class="link-arrow">&rsaquo;</span> About Us</a></li>
          <li><a href="{{ route('services') }}"><span class="link-arrow">&rsaquo;</span> Services</a></li>
        </ul>
      </div>

      <!-- Column 3: Explore -->
      <div class="site-footer-column">
        <h3 class="site-footer-title">Explore</h3>
        <ul class="site-footer-links">
          <li><a href="{{ route('blog') }}"><span class="link-arrow">&rsaquo;</span> Blogs</a></li>
          <li><a href="{{ route('testimonials') }}"><span class="link-arrow">&rsaquo;</span> Testimonials</a></li>
          <li><a href="{{ route('contact') }}"><span class="link-arrow">&rsaquo;</span> Contact Us</a></li>
        </ul>
      </div>

      <!-- Column 4: Contact Us -->
      <div class="site-footer-column site-footer-column--wide">
        <h3 class="site-footer-title">Contact Us</h3>
        <div class="site-footer-contact-list">
          <div class="site-footer-contact-item footer-contact-icon-row">
            <svg class="footer-contact-ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>{{ $siteSettings['company_address'] }}</span>
          </div>
          <div class="site-footer-contact-item footer-contact-icon-row">
            <svg class="footer-contact-ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['company_phone']) }}">{{ $siteSettings['company_phone'] }}</a>
          </div>
          <div class="site-footer-contact-item footer-contact-icon-row">
            <svg class="footer-contact-ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <a href="mailto:{{ $siteSettings['company_email'] }}">{{ $siteSettings['company_email'] }}</a>
          </div>
        </div>
        <div class="footer-follow" style="margin-top:18px;">
          <span class="footer-follow-label">Follow Us</span>
          <div class="site-footer-social-icons">
            @if(!empty($siteSettings['facebook_link']))
              <a href="{{ $siteSettings['facebook_link'] }}" target="_blank" class="site-footer-social-link" title="Facebook" aria-label="Facebook">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
              </a>
            @endif
            @if(!empty($siteSettings['instagram_link']))
              <a href="{{ $siteSettings['instagram_link'] }}" target="_blank" class="site-footer-social-link" title="Instagram" aria-label="Instagram">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
              </a>
            @endif
            @if(!empty($siteSettings['whatsapp_link']))
              <a href="{{ $siteSettings['whatsapp_link'] }}" target="_blank" class="site-footer-social-link" title="WhatsApp" aria-label="WhatsApp">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.57-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
              </a>
            @endif
            @if(!empty($siteSettings['twitter_link']))
              <a href="{{ $siteSettings['twitter_link'] }}" target="_blank" class="site-footer-social-link" title="Twitter" aria-label="Twitter">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
              </a>
            @endif
            @if(!empty($siteSettings['youtube_link']))
              <a href="{{ $siteSettings['youtube_link'] }}" target="_blank" class="site-footer-social-link" title="YouTube" aria-label="YouTube">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
              </a>
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Copyright Bar -->
  <div class="site-footer-bottom">
    <div class="container site-footer-bottom-row">
      <p>&copy; {{ $footerYear }} Jiva Birth &amp; Beyond. All rights reserved.</p>
      <div class="site-footer-bottom-links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <a href="{{ route('terms') }}">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
</footer>
