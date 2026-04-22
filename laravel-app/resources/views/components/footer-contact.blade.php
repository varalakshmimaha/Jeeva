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
          <div style="margin-top:18px;">
            <img src="{{ $siteSettings['certifications_image_url'] }}" alt="Certifications" style="max-width:220px;display:block;">
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
          <li><a href="{{ route('gallery') }}"><span class="link-arrow">&rsaquo;</span> Gallery</a></li>
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

      <!-- Column 4: Quick Contact Form -->
      <div class="site-footer-column" style="display:flex;flex-direction:column;gap:0;">
        <h3 class="site-footer-title">Book Consultation</h3>
        <form id="footerContactForm" class="footer-contact-form" action="{{ route('contact.submit') }}" method="POST">
          @csrf
          <div class="fcf-input-group">
            <input type="text" name="name" placeholder="Your Name" class="fcf-input" required>
          </div>
          <div class="fcf-input-group">
            <input type="email" name="email" placeholder="Your Email" class="fcf-input" required>
          </div>
          <div class="fcf-input-group fcf-phone-group">
            <select name="country_code" class="fcf-input fcf-country-select" required>
              <option value="">Country Code</option>
              <option value="+1">🇺🇸 +1 (US)</option>
              <option value="+91">🇮🇳 +91 (India)</option>
              <option value="+44">🇬🇧 +44 (UK)</option>
              <option value="+61">🇦🇺 +61 (Australia)</option>
              <option value="+1-CA">🇨🇦 +1 (Canada)</option>
              <option value="+64">🇳🇿 +64 (New Zealand)</option>
              <option value="+27">🇿🇦 +27 (South Africa)</option>
            </select>
            <input type="tel" name="phone" placeholder="Phone Number" class="fcf-input fcf-phone-input" required>
          </div>
          <div class="fcf-input-group">
            <input type="text" name="datetime" placeholder="Select Date & Time" class="fcf-input" data-calendly readonly required>
          </div>
          <div class="fcf-input-group">
            <textarea name="notes" placeholder="Other Notes (Optional)" class="fcf-input fcf-textarea" rows="2"></textarea>
          </div>
          <button type="submit" class="fcf-submit-btn">Book Now</button>
        </form>
        <div class="footer-contact-info" style="margin-top:18px;font-size:12px;line-height:1.6;">
          <p style="margin:6px 0;"><strong>Direct Contact:</strong></p>
          <p style="margin:4px 0;">📞 {{ $siteSettings['company_phone'] ?? '+91 XXXXX XXXXX' }}</p>
          <p style="margin:4px 0;"><a href="mailto:{{ $siteSettings['company_email'] }}" style="color:#4DB6AC;text-decoration:underline;">✉️ {{ $siteSettings['company_email'] }}</a></p>
        </div>
      </div>

    </div>
  </div>

  <!-- Copyright Bar -->
  <div class="site-footer-bottom">
    <div class="container site-footer-bottom-row">
      <p>Copyright &copy; {{ $footerYear }} Jiva Birth & Beyond. All rights reserved.</p>
    </div>
  </div>
</footer>
