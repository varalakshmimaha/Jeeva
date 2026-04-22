@extends('layouts.app')

@section('title', 'Contact Us - Jiva Birth and Beyond')

@section('content')

  <x-page-banner
    :title="(isset($banner) && $banner) ? $banner->title : 'Contact Us'"
    :subtitle="(isset($banner) && $banner && $banner->description) ? $banner->description : 'We\'d love to support you on your journey — reach out with your questions, thoughts, or to book a consultation today.'"
    :image="(isset($banner) && $banner && $banner->image) ? asset($banner->image) : asset('storage/moutain.jpg')"
    :breadcrumbs="[['label' => 'Contact Us']]"
  />

  <!-- Book Consultation + Calendar -->
  <section class="book-wrap" id="book">
    <div class="book-grid">

      <!-- Left: Form -->
      <div class="book-card book-form-card">
        <h3 class="book-title">Book Consultation</h3>
        <form action="{{ route('contact.store') }}" method="POST" class="book-form">
          @csrf
          <div class="bf-field">
            <label class="bf-label">Name <span class="bf-req">*</span></label>
            <input type="text" name="name" class="bf-input" placeholder="Enter your name" required>
          </div>
          <div class="bf-field">
            <label class="bf-label">Email <span class="bf-req">*</span></label>
            <input type="email" name="email" class="bf-input" placeholder="Enter your email" required>
          </div>
          <div class="bf-field">
            <label class="bf-label">Phone <span class="bf-req">*</span></label>
            <div class="phone-row">
              <select name="country_code" class="bf-input phone-cc" required>
                <option value="">Code</option>
                <option value="+1">+1</option>
                <option value="+91" selected>+91</option>
                <option value="+44">+44</option>
                <option value="+61">+61</option>
                <option value="+1-CA">+1</option>
                <option value="+64">+64</option>
                <option value="+27">+27</option>
              </select>
              <input type="tel" name="phone" class="bf-input" placeholder="Phone Number" required>
            </div>
          </div>
          <div class="bf-field">
            <label class="bf-label">Service <span class="bf-req">*</span></label>
            <select name="subject" class="bf-input" required>
              <option value="Birth Doula Package">Birth Doula Package</option>
              <option value="Prenatal Yoga">Prenatal Yoga</option>
              <option value="Labour Management & Comfort Measures">Labour Management &amp; Comfort Measures</option>
              <option value="Postpartum Rebalance">Postpartum Rebalance</option>
              <option value="Fat Loss program">Fat Loss program</option>
            </select>
          </div>
          <div class="bf-field">
            <label class="bf-label">Select Date & Time <span class="bf-req">*</span></label>
            <div class="jiva-pickdate" data-calendly tabindex="0" role="button" aria-label="Pick a date and time">
              <svg class="jiva-pickdate__ico" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <input type="text" name="preferred_time_label" class="jiva-pickdate__input" placeholder="Pick a Date & Time *" readonly required data-calendly-time>
              <svg class="jiva-pickdate__chev" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
          </div>
          <div class="bf-field">
            <label class="bf-label">Other Notes</label>
            <textarea name="message" class="bf-input bf-textarea" rows="3" placeholder="Anything you'd like to share"></textarea>
          </div>
          <button type="submit" class="bf-submit">Book Consultation</button>

          @if($errors->any())
            <div class="bf-alert bf-alert--err">
              @foreach($errors->all() as $error){{ $error }}<br>@endforeach
            </div>
          @endif
          @if(session('success'))
            <div class="bf-alert bf-alert--ok">✓ Thank you! We'll be in touch shortly.</div>
          @endif
        </form>
      </div>

      <!-- Right: Image -->
      <div class="book-image-card">
        <div class="book-image-wrapper">
          @if(!empty($siteSettings['contact_image']))
            <img src="{{ asset($siteSettings['contact_image']) }}" alt="Book Consultation" class="book-image">
          @else
            <img src="https://images.unsplash.com/photo-1494623930402-ab7213d7d44d?w=500&h=500&fit=crop" alt="Book Consultation" class="book-image">
          @endif
        </div>
      </div>

    </div>
  </section>



  <!-- Get in Touch + Send Enquiry -->
  <section class="touch-wrap">
    <div class="touch-grid">
      <!-- Left: Info -->
      <div class="touch-info">
        <h2 class="touch-title">Get in Touch</h2>
        <p class="touch-desc">We'd love to support you on your journey — reach out with your questions, thoughts, or to book a consultation today.</p>

        <div class="touch-item">
          <div class="touch-ico">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div class="touch-item-body">
            <div class="touch-item-lbl">Phone</div>
            <a href="tel:+14375534448" class="touch-item-val">+1 (437) 553-4448</a>
          </div>
        </div>

        <div class="touch-item">
          <div class="touch-ico">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div class="touch-item-body">
            <div class="touch-item-lbl">Email</div>
            <a href="mailto:anusuyaashok@gmail.com" class="touch-item-val">anusuyaashok@gmail.com</a>
          </div>
        </div>

        <div class="touch-item">
          <div class="touch-ico">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div class="touch-item-body">
            <div class="touch-item-lbl">Location</div>
            <div class="touch-item-val">Toronto, Canada</div>
          </div>
        </div>

        <div class="touch-item">
          <div class="touch-ico">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4DB6AC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </div>
          <div class="touch-item-body">
            <div class="touch-item-lbl">Instagram</div>
            <a href="{{ $siteSettings['instagram_link'] ?? '#' }}" target="_blank" class="touch-item-val">Follow on Instagram</a>
          </div>
        </div>

        <div class="touch-item">
          <div class="touch-ico">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="#4DB6AC"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </div>
          <div class="touch-item-body">
            <div class="touch-item-lbl">Facebook</div>
            <a href="{{ $siteSettings['facebook_link'] ?? '#' }}" target="_blank" class="touch-item-val">Follow on Facebook</a>
          </div>
        </div>
      </div>

      <!-- Right: Enquiry form -->
      <div class="touch-form-card">
        <h3 class="touch-form-title">Send Us Your Enquiry</h3>
        <form action="{{ route('contact.store') }}" method="POST" class="touch-form">
          @csrf
          <input type="hidden" name="subject" value="General Enquiry">
          <div class="bf-field">
            <label class="bf-label">Name</label>
            <input type="text" name="name" class="bf-input" placeholder="Name" required>
          </div>
          <div class="bf-field">
            <label class="bf-label">Email</label>
            <input type="email" name="email" class="bf-input" placeholder="Email" required>
          </div>
          <div class="bf-field">
            <label class="bf-label">Phone</label>
            <div class="phone-row">
              <select name="country_code" class="bf-input phone-cc" aria-label="Country code">
                <option value="+1" selected>🇨🇦 +1 Canada</option>
                <option value="+1">🇺🇸 +1 USA</option>
                <option value="+91">🇮🇳 +91 India</option>
                <option value="+44">🇬🇧 +44 UK</option>
                <option value="+61">🇦🇺 +61 Australia</option>
                <option value="+64">🇳🇿 +64 New Zealand</option>
                <option value="+971">🇦🇪 +971 UAE</option>
                <option value="+65">🇸🇬 +65 Singapore</option>
                <option value="+60">🇲🇾 +60 Malaysia</option>
                <option value="+49">🇩🇪 +49 Germany</option>
                <option value="+33">🇫🇷 +33 France</option>
                <option value="+39">🇮🇹 +39 Italy</option>
                <option value="+34">🇪🇸 +34 Spain</option>
                <option value="+31">🇳🇱 +31 Netherlands</option>
                <option value="+46">🇸🇪 +46 Sweden</option>
                <option value="+41">🇨🇭 +41 Switzerland</option>
                <option value="+81">🇯🇵 +81 Japan</option>
                <option value="+82">🇰🇷 +82 S. Korea</option>
                <option value="+86">🇨🇳 +86 China</option>
                <option value="+852">🇭🇰 +852 Hong Kong</option>
                <option value="+966">🇸🇦 +966 Saudi Arabia</option>
                <option value="+974">🇶🇦 +974 Qatar</option>
                <option value="+973">🇧🇭 +973 Bahrain</option>
                <option value="+968">🇴🇲 +968 Oman</option>
                <option value="+27">🇿🇦 +27 S. Africa</option>
                <option value="+55">🇧🇷 +55 Brazil</option>
                <option value="+52">🇲🇽 +52 Mexico</option>
              </select>
              <input type="tel" name="phone" class="bf-input phone-num" placeholder="Phone Number">
            </div>
          </div>
          <div class="bf-field">
            <label class="bf-label">Message</label>
            <textarea name="message" class="bf-input bf-textarea" rows="4" placeholder="Write message..."></textarea>
          </div>
          <button type="submit" class="bf-submit">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <style>
    /* Book Consultation */
    .book-wrap {
      padding: 40px 4% 60px;
      background: linear-gradient(180deg, #fcefe6 0%, #fdf6ef 100%);
    }
    .book-grid {
      max-width: 1100px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      align-items: start;
    }
    .book-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 24px 22px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    .book-title {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      color: #2b2b2b;
      margin: 0 0 16px;
      font-weight: 700;
    }
    .book-image-card {
      padding: 0 !important;
      box-shadow: none;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .book-image-wrapper {
      width: 100%;
      max-width: 450px;
      height: 450px;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .book-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 16px;
    }
    .bf-field { margin-bottom: 12px; }
    .bf-req { color: #e05252; font-weight: 700; margin-left: 2px; }
    .bf-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #4a4a4a;
      margin-bottom: 6px;
    }
    .bf-input {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid #e5e0d8;
      border-radius: 8px;
      background: #ffffff;
      font-family: inherit;
      font-size: 14px;
      color: #2b2b2b;
      outline: none;
      transition: border-color .25s, box-shadow .25s;
      box-sizing: border-box;
    }
    .bf-input:focus {
      border-color: #4DB6AC;
      box-shadow: 0 0 0 3px rgba(77,182,172,0.12);
    }
    .bf-textarea { resize: vertical; min-height: 60px; font-family: inherit; }
    select.bf-input {
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237a6060' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      padding-right: 36px;
      cursor: pointer;
    }
    .bf-selected-time {
      background: #f5fbfa;
      color: #2FA9A3;
      font-weight: 500;
      cursor: default;
    }
    .bf-selected-time.is-filled {
      background: #e8f7f5;
      border-color: #4DB6AC;
      color: #2FA9A3;
      font-weight: 600;
    }
    .bf-submit {
      width: 100%;
      padding: 14px 16px;
      background: linear-gradient(135deg, #4DB6AC 0%, #2FA9A3 100%);
      color: #ffffff;
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: 0.5px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: box-shadow .25s, transform .2s, filter .25s;
      margin-top: 6px;
      box-shadow: 0 6px 18px rgba(77,182,172,0.28);
    }
    .bf-submit:hover {
      filter: brightness(1.05);
      transform: translateY(-1px);
      box-shadow: 0 10px 24px rgba(77,182,172,0.35);
    }
    .bf-alert {
      margin-top: 14px;
      padding: 10px 12px;
      border-radius: 8px;
      font-size: 13px;
    }
    .bf-alert--ok { background: #e8f8ef; color: #2d7a4b; }
    .bf-alert--err { background: #fde8e8; color: #c0392b; }
    @media (max-width: 520px) {
      .cal-slots-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* Phone row */
    .phone-row {
      display: grid;
      grid-template-columns: 100px 1fr;
      gap: 8px;
    }
    .phone-cc {
      padding: 11px 10px;
      font-size: 12.5px;
      padding-right: 28px;
    }
    .phone-cc option {
      padding: 2px 6px;
    }

    /* Get in Touch */
    .touch-wrap {
      padding: 80px 6% 100px;
      background: linear-gradient(180deg, #fdf6ef 0%, #fcefe6 100%);
    }
    .touch-grid {
      max-width: 1240px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: start;
    }
    .touch-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(36px, 4.5vw, 48px);
      color: #2b2b2b;
      margin: 0 0 16px;
      font-weight: 700;
    }
    .touch-desc {
      font-size: 15px;
      color: #6b5a5a;
      line-height: 1.7;
      margin: 0 0 30px;
      max-width: 440px;
    }
    .touch-item {
      display: flex;
      align-items: center;
      gap: 18px;
      padding: 14px 0;
      border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    .touch-item:last-of-type { border-bottom: none; }
    .touch-ico {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: #ffffff;
      box-shadow: 0 4px 14px rgba(0,0,0,0.06);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .touch-item-body { flex: 1; }
    .touch-item-lbl {
      font-size: 15px;
      font-weight: 700;
      color: #2b2b2b;
      margin-bottom: 2px;
    }
    .touch-item-val {
      font-size: 14px;
      color: #6b5a5a;
      text-decoration: none;
      transition: color .2s;
    }
    .touch-item-val:hover { color: #4DB6AC; }

    .touch-form-card {
      background: #ffffff;
      border: 1.5px solid rgba(77,182,172,0.28);
      border-radius: 16px;
      padding: 36px 32px;
      box-shadow: 0 10px 30px rgba(77,182,172,0.08);
    }
    .touch-form-title {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      color: #2b2b2b;
      margin: 0 0 22px;
      font-weight: 700;
    }

    @media (max-width: 768px) {
      .book-grid { grid-template-columns: 1fr !important; gap: 30px; }
      .touch-grid { grid-template-columns: 1fr !important; gap: 30px; }
      .touch-form-card { padding: 26px 20px; }
      .book-card { padding: 22px; }
    }
  </style>


@endsection
