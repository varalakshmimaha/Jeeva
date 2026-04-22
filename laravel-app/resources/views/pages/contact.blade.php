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

      <!-- Left: Calendly Calendar -->
      <div class="book-card book-form-card">
        <h3 class="book-title">Book Consultation</h3>
        <p class="book-sub">Share your details and pick a time that works best for you.</p>

        @if(session('success'))
          <div class="book-alert book-alert--ok">{{ session('success') }}</div>
        @endif
        @if($errors->any())
          <div class="book-alert book-alert--err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
          </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="book-form" id="bookConsultationForm">
          @csrf
          <input type="hidden" name="subject" value="Contact Page Booking">

          <div class="bf-row">
            <div class="bf-field">
              <label>Full Name *</label>
              <input type="text" name="name" placeholder="Your full name" value="{{ old('name') }}" required>
            </div>
            <div class="bf-field">
              <label>Email Address *</label>
              <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
          </div>

          <div class="bf-field">
            <label>Phone *</label>
            <div class="bf-phone-group">
              <select name="country_code" class="bf-phone-code" required>
                <option value="+91"  {{ old('country_code','+91') === '+91'  ? 'selected' : '' }}>IN +91</option>
                <option value="+1"   {{ old('country_code') === '+1'   ? 'selected' : '' }}>CA +1</option>
                <option value="+44"  {{ old('country_code') === '+44'  ? 'selected' : '' }}>UK +44</option>
                <option value="+61"  {{ old('country_code') === '+61'  ? 'selected' : '' }}>AU +61</option>
                <option value="+971" {{ old('country_code') === '+971' ? 'selected' : '' }}>AE +971</option>
                <option value="+65"  {{ old('country_code') === '+65'  ? 'selected' : '' }}>SG +65</option>
                <option value="+60"  {{ old('country_code') === '+60'  ? 'selected' : '' }}>MY +60</option>
                <option value="+64"  {{ old('country_code') === '+64'  ? 'selected' : '' }}>NZ +64</option>
                <option value="+49"  {{ old('country_code') === '+49'  ? 'selected' : '' }}>DE +49</option>
                <option value="+33"  {{ old('country_code') === '+33'  ? 'selected' : '' }}>FR +33</option>
              </select>
              <input type="tel" name="phone" class="bf-phone-number" placeholder="Phone Number" value="{{ old('phone') }}" required>
            </div>
          </div>

          <div class="bf-field">
            <label>Service *</label>
            <select name="service_selected" required>
              <option value="" disabled {{ old('service_selected') ? '' : 'selected' }}>Choose a service</option>
              @foreach(($services ?? []) as $service)
                <option value="{{ $service->title }}" {{ old('service_selected') === $service->title ? 'selected' : '' }}>{{ $service->title }}</option>
              @endforeach
            </select>
          </div>

          <div class="bf-row">
            <div class="bf-field">
              <label>Pick a Date *</label>
              <input type="date" name="preferred_date" id="bfDate" min="{{ date('Y-m-d') }}" value="{{ old('preferred_date') }}" required>
            </div>
            <div class="bf-field">
              <label>Pick a Time *</label>
              @php
                $defaultSlots = '09:00 AM, 10:00 AM, 11:00 AM, 12:00 PM, 02:00 PM, 03:00 PM, 04:00 PM, 05:00 PM, 06:00 PM';
                $slotsRaw = trim($siteSettings['booking_time_slots'] ?? '') ?: $defaultSlots;
                $timeSlots = array_values(array_filter(array_map('trim', explode(',', $slotsRaw))));
              @endphp
              <select name="preferred_time" id="bfTime" required>
                <option value="" disabled selected>Select a time</option>
                @foreach($timeSlots as $slot)
                  <option value="{{ $slot }}" {{ old('preferred_time') === $slot ? 'selected' : '' }}>{{ $slot }}</option>
                @endforeach
              </select>
              <small id="bfTimeHint" class="bf-hint">Pick a date to see available times.</small>
            </div>
          </div>

          <div class="bf-field">
            <label>Other Notes</label>
            <textarea name="message" rows="3" placeholder="Anything you'd like us to know...">{{ old('message') }}</textarea>
          </div>

          <button type="submit" class="book-submit">Book My Consultation</button>
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
      align-items: stretch;
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
      align-items: stretch;
      justify-content: center;
      height: 100%;
    }
    .book-image-wrapper {
      width: 100%;
      height: 100%;
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
    .book-sub { color: #7a6b65; font-size: 14px; margin: -4px 0 20px; font-family: 'Outfit', sans-serif; line-height: 1.6; }
    .book-alert { padding: 13px 16px; border-radius: 12px; font-size: 14px; margin-bottom: 16px; font-family: 'Outfit', sans-serif; }
    .book-alert--ok { background: #eafaf4; color: #1d6b52; border: 1px solid #bfeadb; }
    .book-alert--err { background: #fdecec; color: #a22d2d; border: 1px solid #f3c6c6; }
    .book-form {
      display: flex;
      flex-direction: column;
      gap: 18px;
      font-family: 'Outfit', sans-serif;
    }
    .bf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .bf-field { display: flex; flex-direction: column; }
    .bf-field label {
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: #1f3b38;
      margin-bottom: 8px;
      letter-spacing: .3px;
      text-transform: uppercase;
    }
    .bf-field input,
    .bf-field select,
    .bf-field textarea {
      width: 100%;
      padding: 14px 18px;
      border: 1.5px solid #ead9d1;
      border-radius: 999px;
      font-size: 14.5px;
      font-family: 'Outfit', sans-serif;
      font-weight: 400;
      background: #fdfaf8;
      color: #2b2b2b;
      transition: border-color .25s, box-shadow .25s, background .25s;
      letter-spacing: .2px;
    }
    .bf-field textarea {
      border-radius: 18px;
      min-height: 110px;
    }
    .bf-field input::placeholder,
    .bf-field textarea::placeholder { color: #b0a59f; font-weight: 400; }
    .bf-field input:focus,
    .bf-field select:focus,
    .bf-field textarea:focus {
      outline: none;
      border-color: #4DB6AC;
      box-shadow: 0 0 0 4px rgba(77,182,172,0.14);
      background: #ffffff;
    }
    .bf-field select {
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%232FA9A3' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 20px center;
      padding-right: 46px;
      cursor: pointer;
    }
    .bf-field textarea { resize: vertical; }
    .bf-hint { font-family: 'Outfit', sans-serif; font-size: 12px; color: #9d8f88; margin-top: 8px; font-style: italic; }
    .bf-phone-group {
      display: flex;
      align-items: stretch;
      border: 1.5px solid #ead9d1;
      border-radius: 999px;
      background: #fdfaf8;
      overflow: hidden;
      transition: border-color .25s, box-shadow .25s, background .25s;
    }
    .bf-phone-group:focus-within {
      border-color: #4DB6AC;
      box-shadow: 0 0 0 4px rgba(77,182,172,0.14);
      background: #ffffff;
    }
    .bf-phone-group .bf-phone-code {
      border: none !important;
      background: transparent !important;
      border-right: 1.5px solid #ead9d1 !important;
      border-radius: 0 !important;
      padding: 14px 40px 14px 18px !important;
      width: auto !important;
      min-width: 108px;
      font-weight: 600;
      font-size: 14px;
      color: #1f3b38;
      box-shadow: none !important;
      cursor: pointer;
      background-position: right 14px center !important;
    }
    .bf-phone-group .bf-phone-code:focus { outline: none; }
    .bf-phone-group .bf-phone-number {
      border: none !important;
      background: transparent !important;
      border-radius: 0 !important;
      flex: 1;
      padding: 14px 22px !important;
      box-shadow: none !important;
    }
    .bf-phone-group .bf-phone-number:focus { outline: none; }
    .book-submit {
      margin-top: 10px;
      padding: 16px 30px;
      background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%);
      color: #ffffff;
      border: none;
      border-radius: 999px;
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: .6px;
      text-transform: uppercase;
      cursor: pointer;
      transition: transform .25s cubic-bezier(.2,.7,.2,1), box-shadow .25s, background .3s;
      box-shadow: 0 14px 30px -10px rgba(47,169,163,0.55);
    }
    .book-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 22px 40px -12px rgba(47,169,163,0.65);
      background: linear-gradient(135deg, #33b8b1 0%, #238f89 100%);
    }
    @media (max-width: 560px) {
      .bf-row { grid-template-columns: 1fr; }
    }
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

<script>
(function () {
  var dateEl = document.getElementById('bfDate');
  var timeEl = document.getElementById('bfTime');
  var hintEl = document.getElementById('bfTimeHint');
  if (!dateEl || !timeEl) return;

  var allSlots = Array.prototype.slice.call(timeEl.querySelectorAll('option'))
    .filter(function (o) { return o.value; })
    .map(function (o) { return o.value; });

  function rebuildOptions(bookedSlots) {
    var current = timeEl.value;
    timeEl.innerHTML = '<option value="" disabled selected>Select a time</option>';
    allSlots.forEach(function (slot) {
      if (bookedSlots.indexOf(slot) !== -1) return;
      var opt = document.createElement('option');
      opt.value = slot;
      opt.textContent = slot;
      timeEl.appendChild(opt);
    });
    if (current && bookedSlots.indexOf(current) === -1) {
      timeEl.value = current;
    }
    if (!timeEl.querySelector('option[value]:not([disabled])')) {
      hintEl.textContent = 'All slots are booked for this date. Please pick another date.';
    } else {
      hintEl.textContent = 'Showing available times for the selected date.';
    }
  }

  function fetchBooked(date) {
    if (!date) return;
    hintEl.textContent = 'Checking available times...';
    fetch('{{ route('booked.slots') }}?date=' + encodeURIComponent(date), { headers: { 'Accept': 'application/json' } })
      .then(function (r) { return r.json(); })
      .then(function (data) { rebuildOptions(data.booked || []); })
      .catch(function () { rebuildOptions([]); });
  }

  dateEl.addEventListener('change', function () { fetchBooked(dateEl.value); });
  if (dateEl.value) fetchBooked(dateEl.value);
})();
</script>

@endsection
