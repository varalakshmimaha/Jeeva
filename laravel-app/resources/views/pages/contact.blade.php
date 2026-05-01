@extends('layouts.app')

@section('title', 'Contact Us - Jiva Birth and Beyond')

@section('content')

  <x-page-banner
    :title="(isset($banner) && $banner) ? $banner->title : 'Contact Us'"
    :subtitle="(isset($banner) && $banner && $banner->description) ? $banner->description : 'We\'d love to support you on your journey — reach out with your questions, thoughts, or to book a consultation today.'"
    :image="(isset($banner) && $banner && $banner->image) ? asset($banner->image) : asset('storage/moutain.jpg')"
    :breadcrumbs="[['label' => 'Contact Us']]"
  />

  <!-- Book Consultation -->
  <section class="book-wrap" id="book">
    <div class="bk-split">

      <!-- Left: Booking Form -->
      <div class="bk-form-col">
        <div class="bk-form-card">
          <span class="bk-eyebrow">Schedule a Session</span>
          <h2 class="bk-main-title">Book Your Consultation</h2>

          @if(session('success') && session('success_kind') !== 'enquiry')
            <div class="bk-success-box">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              {{ session('success') }}
            </div>
          @endif
          @if($errors->any())
            <div class="bk-err-box">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
          @endif

          <form action="{{ route('contact.store') }}" method="POST" id="bkForm">
            @csrf
            <input type="hidden" name="subject" value="Consultation Booking">
            <input type="hidden" name="preferred_date" id="bkDate" value="{{ old('preferred_date') }}">
            <input type="hidden" name="preferred_time" id="bkTime" value="{{ old('preferred_time') }}">
            <input type="hidden" name="calendly_event_uri" id="bkEventUri" value="{{ old('calendly_event_uri') }}">

            {{-- Full Name --}}
            <div class="bk-field">
              <label class="bk-label">Full Name <span class="bk-req">*</span></label>
              <input type="text" name="name" class="bk-input" placeholder="Your full name" value="{{ old('name') }}" required>
            </div>

            {{-- Email --}}
            <div class="bk-field">
              <label class="bk-label">Email Address <span class="bk-req">*</span></label>
              <input type="email" name="email" class="bk-input" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>

            {{-- Phone --}}
            <div class="bk-field">
              <label class="bk-label">Phone <span class="bk-req">*</span></label>
              <div class="bk-phone-row">
                <div class="bk-cc-wrap">
                  @include('partials.country-codes', ['default' => '+1'])
                </div>
                <input type="tel" name="phone" class="bk-input bk-phone-num" placeholder="Phone Number" value="{{ old('phone') }}" required>
              </div>
            </div>

            {{-- Service --}}
            <div class="bk-field">
              <label class="bk-label">Service <span class="bk-req">*</span></label>
              <select name="service_selected" class="bk-input bk-select" required>
                <option value="" disabled {{ old('service_selected') ? '' : 'selected' }}>Choose a service</option>
                @foreach(($services ?? []) as $service)
                  <option value="{{ $service->title }}" {{ old('service_selected') === $service->title ? 'selected' : '' }}>{{ $service->title }}</option>
                @endforeach
              </select>
            </div>

            {{-- Date & Time via Calendly popup --}}
            <div class="bk-field">
              <label class="bk-label">Pick a Date &amp; Time <span class="bk-req">*</span></label>
              <button type="button" class="bk-input bk-cal-trigger" id="bkOpenCal">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span id="bkCalBtnText">Select a date &amp; time</span>
                <svg class="bk-cal-chev" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div id="bkTimeConfirm" class="bk-time-confirm" style="display:none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                <span id="bkTimeLabel">Appointment scheduled</span>
                <button type="button" class="bk-change-btn" id="bkChangeSlot">Change</button>
              </div>
            </div>

            {{-- Notes --}}
            <div class="bk-field">
              <label class="bk-label">Other Notes</label>
              <textarea name="message" class="bk-input bk-textarea" rows="3" placeholder="Anything you'd like us to know...">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="bk-submit-btn" id="bkSubmit">Book Consultation</button>
          </form>
        </div>
      </div>

      <!-- Right: Contact image -->
      <div class="bk-img-col">
        @php $contactImg = $siteSettings['contact_image'] ?? ''; @endphp
        <div class="bk-img-wrap">
          <img src="{{ $contactImg ? asset($contactImg) : asset('storage/moutain.jpg') }}" alt="Book Consultation" class="bk-contact-img">
        </div>
      </div>

    </div>
  </section>
  <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
  <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript"></script>
  <script>
  (function () {
    var openBtn    = document.getElementById('bkOpenCal');
    var confirm    = document.getElementById('bkTimeConfirm');
    var timeLabel  = document.getElementById('bkTimeLabel');
    var changeBtn  = document.getElementById('bkChangeSlot');
    var dateHid    = document.getElementById('bkDate');
    var timeHid    = document.getElementById('bkTime');
    var eventUriHid = document.getElementById('bkEventUri');
    var form       = document.getElementById('bkForm');

    if (openBtn) {
      openBtn.addEventListener('click', function () {
        Calendly.initPopupWidget({
          url: '{{ rtrim($siteSettings["calendly_booking_link"] ?? "https://calendly.com/varalakshmivaru231020/30min", "/") }}?hide_gdpr_banner=1&primary_color=2fa9a3'
        });
      });
    }

    window.addEventListener('message', function (e) {
      if (!e.data || e.data.event !== 'calendly.event_scheduled') return;
      var payload  = e.data.payload || {};
      var eventUri = (payload.event && payload.event.uri) ? payload.event.uri : '';

      console.log('[Calendly] event_scheduled fired. eventUri:', eventUri, 'full payload:', JSON.stringify(e.data));
      if (eventUriHid && eventUri) eventUriHid.value = eventUri;

      function applyTime(date, time, label) {
        dateHid.value         = date;
        timeHid.value         = time;
        timeLabel.textContent = label;
        if (openBtn) openBtn.style.display = 'none';
        if (confirm) confirm.style.display = 'flex';
      }

      function fallback() {
        var now = new Date();
        applyTime(
          now.getFullYear() + '-' + ('0'+(now.getMonth()+1)).slice(-2) + '-' + ('0'+now.getDate()).slice(-2),
          'Scheduled via Calendly',
          'Calendly appointment confirmed!'
        );
      }

      if (eventUri) {
        applyTime(
          new Date().toISOString().slice(0,10),
          'Scheduled via Calendly',
          'Fetching your slot...'
        );
        if (confirm) confirm.style.display = 'flex';
        if (openBtn) openBtn.style.display  = 'none';

        function tryFetch(attemptsLeft) {
          setTimeout(function () {
            fetch('/calendly/event-time?event_uri=' + encodeURIComponent(eventUri))
            .then(function (r) { return r.json(); })
            .then(function (data) {
              console.log('[Calendly] event-time response (attempts left ' + attemptsLeft + '):', JSON.stringify(data));
              if (data.date && data.time) {
                applyTime(data.date, data.time, data.label);
              } else if (attemptsLeft > 0) {
                tryFetch(attemptsLeft - 1);
              } else {
                fallback();
              }
            })
            .catch(function (err) {
              console.log('[Calendly] fetch error (attempts left ' + attemptsLeft + '):', err);
              if (attemptsLeft > 0) { tryFetch(attemptsLeft - 1); } else { fallback(); }
            });
          }, 2500);
        }
        tryFetch(2);
      } else {
        fallback();
      }
    });

    if (changeBtn) {
      changeBtn.addEventListener('click', function () {
        dateHid.value = '';
        timeHid.value = '';
        if (confirm) confirm.style.display = 'none';
        if (openBtn) openBtn.style.display  = 'flex';
        Calendly.initPopupWidget({
          url: '{{ rtrim($siteSettings["calendly_booking_link"] ?? "https://calendly.com/varalakshmivaru231020/30min", "/") }}?hide_gdpr_banner=1&primary_color=2fa9a3'
        });
      });
    }

    if (form) {
      form.addEventListener('submit', function (e) {
        if (!dateHid.value || !timeHid.value) {
          e.preventDefault();
          if (openBtn) openBtn.scrollIntoView({ behavior: 'smooth', block: 'center' });
          alert('Please select a date and time first.');
        }
      });
    }
  })();
  </script>



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
              @include('partials.country-codes', ['default' => '+1'])
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

  {{-- Enquiry success modal --}}
  @if(session('success') && session('success_kind') === 'enquiry')
  <div class="booking-modal-overlay" id="enquirySuccessModal">
    <div class="booking-modal-card">
      <div class="booking-modal-icon">
        <svg width="52" height="52" viewBox="0 0 52 52" fill="none">
          <circle class="bm-circle" cx="26" cy="26" r="24" stroke="#2FA9A3" stroke-width="2.5" fill="none"/>
          <polyline class="bm-check" points="14,27 22,35 38,18" stroke="#2FA9A3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </div>
      <h2 class="booking-modal-title">Message Sent!</h2>
      <p class="booking-modal-text">Thank you for reaching out.</p>
      <p class="booking-modal-sub">We've received your enquiry and will get back to you shortly.</p>
      <button class="booking-modal-btn" onclick="document.getElementById('enquirySuccessModal').remove()">Close</button>
    </div>
  </div>
  @endif

  <style>
    /* ── Book Consultation (Calendly layout) ── */
    .book-wrap {
      padding: 60px 5% 70px;
      background: linear-gradient(180deg, #fcefe6 0%, #fdf6ef 100%);
    }
    .bk-split {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 55% 1fr;
      gap: 40px;
      align-items: start;
    }
    .bk-left-col { display: flex; flex-direction: column; gap: 28px; }
    .bk-info-head { }
    .bk-eyebrow {
      display: inline-block;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: #4DB6AC;
      margin-bottom: 10px;
    }
    .bk-main-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(26px, 3vw, 36px);
      font-weight: 700;
      color: #1f3b38;
      margin: 0 0 12px;
      line-height: 1.2;
    }
    .bk-main-desc {
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      color: #6b5a5a;
      line-height: 1.75;
      margin: 0;
      max-width: 520px;
    }
    .bk-steps {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .bk-step {
      display: flex;
      align-items: flex-start;
      gap: 14px;
    }
    .bk-step-num {
      width: 32px;
      height: 32px;
      min-width: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2FA9A3, #1f8c87);
      color: #fff;
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .bk-step div { display: flex; flex-direction: column; gap: 2px; }
    .bk-step strong {
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      font-weight: 700;
      color: #1f3b38;
    }
    .bk-step span {
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      color: #7a6b65;
    }
    .bk-calendly-wrap {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.07);
      background: #fff;
    }
    /* Right: Contact image — fills full height of the grid row */
    .bk-img-col {
      display: flex;
      flex-direction: column;
    }
    .bk-img-wrap {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(0,0,0,0.12);
      flex: 1;
      min-height: 400px;
    }
    .bk-contact-img {
      width: 100%;
      height: 100%;
      position: absolute;
      inset: 0;
      object-fit: cover;
      display: block;
    }
    .bk-img-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(20,40,35,0.45) 0%, transparent 60%);
    }
    .bk-img-badge {
      position: absolute;
      bottom: 24px;
      left: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
      background: rgba(47,169,163,0.92);
      backdrop-filter: blur(6px);
      color: #fff;
      padding: 12px 18px;
      border-radius: 12px;
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 700;
      line-height: 1.4;
    }
    @media (max-width: 960px) {
      .bk-split { grid-template-columns: 1fr; }
      .bk-img-wrap { min-height: 280px; }
    }
    @media (max-width: 560px) {
      .book-wrap { padding: 40px 4% 50px; }
    }

    /* ── Shared field/input styles (used in Get in Touch) ── */
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
    .book-alert--err { background: #fdecec; color: #a22d2d; border: 1px solid #f3c6c6; }

    /* Booking success modal */
    .booking-modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(24, 43, 40, 0.55);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10000;
      padding: 20px;
      font-family: 'Outfit', sans-serif;
      animation: bmFadeIn .28s ease;
    }
    .booking-modal-card {
      background: #ffffff;
      border-radius: 24px;
      max-width: 440px;
      width: 100%;
      padding: 44px 36px 36px;
      text-align: center;
      box-shadow: 0 40px 100px -20px rgba(0,0,0,0.35);
      animation: bmSlideUp .4s cubic-bezier(.2,.7,.2,1);
    }
    .booking-modal-icon {
      width: 84px;
      height: 84px;
      margin: 0 auto 20px;
      border-radius: 50%;
      background: linear-gradient(135deg, #eafaf8 0%, #d4f3ef 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .booking-modal-icon .bm-circle {
      stroke-dasharray: 160;
      stroke-dashoffset: 160;
      animation: bmDraw .6s ease-out .1s forwards;
    }
    .booking-modal-icon .bm-check {
      stroke-dasharray: 50;
      stroke-dashoffset: 50;
      animation: bmDraw .4s ease-out .5s forwards;
    }
    @keyframes bmDraw { to { stroke-dashoffset: 0; } }
    .booking-modal-title {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: #1f3b38;
      margin: 0 0 10px;
      letter-spacing: .3px;
    }
    .booking-modal-text {
      color: #2b4a47;
      font-size: 15px;
      line-height: 1.6;
      margin: 0 0 8px;
      font-weight: 500;
    }
    .booking-modal-sub {
      color: #6f8481;
      font-size: 13.5px;
      line-height: 1.65;
      margin: 0 0 28px;
    }
    .booking-modal-btn {
      display: inline-block;
      padding: 13px 38px;
      background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%);
      color: #ffffff;
      border: none;
      border-radius: 999px;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: .6px;
      text-transform: uppercase;
      cursor: pointer;
      transition: transform .2s, box-shadow .2s;
      box-shadow: 0 10px 24px -8px rgba(47,169,163,0.5);
    }
    .booking-modal-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 16px 32px -10px rgba(47,169,163,0.6);
    }
    @keyframes bmFadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes bmSlideUp {
      from { transform: translateY(20px) scale(.96); opacity: 0; }
      to { transform: translateY(0) scale(1); opacity: 1; }
    }
    .book-form {
      display: flex;
      flex-direction: column;
      gap: 8px;
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
    /* Compact styles scoped only to the booking form */
    .book-form .bf-field label {
      font-size: 11px;
      margin-bottom: 3px;
    }
    .book-form .bf-field input,
    .book-form .bf-field select,
    .book-form .bf-field textarea {
      padding: 8px 14px;
      font-size: 13px;
    }
    .book-form .bf-field textarea {
      border-radius: 12px;
      min-height: 52px;
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
    .bf-time-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(96px, 1fr));
      gap: 10px;
    }
    .bf-time-pill {
      padding: 11px 14px;
      border: 1.5px solid #ead9d1;
      background: #fdfaf8;
      color: #1f3b38;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      font-weight: 600;
      border-radius: 999px;
      cursor: pointer;
      transition: all .2s;
    }
    .bf-time-pill:hover:not(:disabled) {
      border-color: #4DB6AC;
      background: #ffffff;
      color: #2FA9A3;
    }
    .bf-time-pill.is-active {
      background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%);
      border-color: #2FA9A3;
      color: #ffffff;
    }
    .bf-time-pill:disabled,
    .bf-time-pill.is-disabled {
      opacity: 0.35;
      text-decoration: line-through;
      cursor: not-allowed;
    }
    .bf-slot-confirm {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 18px;
      border-radius: 12px;
      background: #eafaf4;
      border: 1px solid #bfeadb;
      color: #1d6b52;
      font-family: 'Outfit', sans-serif;
    }
    .bf-slot-confirm strong { display: block; font-size: 14px; margin-bottom: 2px; }
    .bf-slot-confirm span { font-size: 13px; color: #2b6b58; }
    .bf-slot-confirm-icon {
      display: inline-flex; align-items: center; justify-content: center;
      width: 28px; height: 28px; min-width: 28px; border-radius: 50%;
      background: #2FA9A3; color: #fff; font-weight: 700; font-size: 14px;
    }

    /* ── Custom date/time picker ── */
    .bf-dropdown-wrap { position: relative; }
    .bf-dt-trigger {
      display: flex; align-items: center; gap: 10px;
      width: 100%; padding: 12px 16px;
      border: 1.5px solid #ead9d1; border-radius: 12px;
      background: #fff; cursor: pointer; font-size: 14px; color: #888;
      text-align: left; transition: border-color .2s, color .2s; font-family: inherit;
    }
    .bf-dt-trigger:hover, .bf-dt-trigger.is-open { border-color: #4DB6AC; }
    .bf-dt-trigger.has-value { color: #1f3b38; font-weight: 600; }
    .bf-dt-chev { margin-left: auto; flex-shrink: 0; transition: transform .2s; }
    .bf-dt-trigger.is-open .bf-dt-chev { transform: rotate(180deg); }
    .bf-picker {
      position: absolute; top: calc(100% + 6px); left: 0; right: 0; z-index: 200;
      border: 1.5px solid #ead9d1; border-radius: 18px; overflow: hidden;
      background: #fff; box-shadow: 0 8px 32px rgba(47,169,163,0.18);
    }
    .bf-cal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 20px 12px;
      background: linear-gradient(135deg, #2FA9A3, #1f8c87);
    }
    .bf-cal-month-label {
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      letter-spacing: .3px;
    }
    .bf-cal-nav {
      background: rgba(255,255,255,0.2);
      border: none;
      color: #fff;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      font-size: 20px;
      line-height: 1;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s;
    }
    .bf-cal-nav:hover { background: rgba(255,255,255,0.35); }
    .bf-cal-dow {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      background: #f2faf9;
      border-bottom: 1px solid #e5f5f3;
    }
    .bf-cal-dow span {
      text-align: center;
      font-family: 'Outfit', sans-serif;
      font-size: 11px;
      font-weight: 700;
      color: #2FA9A3;
      text-transform: uppercase;
      letter-spacing: .5px;
      padding: 8px 0;
    }
    .bf-cal-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      padding: 8px 10px 12px;
      gap: 4px;
    }
    .bf-cal-day {
      width: 36px;
      height: 36px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 400;
      color: #2b2b2b;
      cursor: pointer;
      border: none;
      background: transparent;
      transition: background .18s, color .18s;
    }
    .bf-cal-day:not(:disabled):not(.is-empty) {
      background: #edf1f5;
      font-weight: 500;
    }
    .bf-cal-day:hover:not(:disabled):not(.is-empty) {
      background: #d4eeec;
      color: #2FA9A3;
    }
    .bf-cal-day.is-today {
      background: #e4f5f3 !important;
      color: #2FA9A3 !important;
      font-weight: 700 !important;
      border: 1.5px solid #4DB6AC !important;
      border-radius: 50% !important;
    }
    .bf-cal-day.is-selected {
      background: #2FA9A3 !important;
      color: #fff !important;
      font-weight: 700 !important;
      border-radius: 50% !important;
      border: none !important;
    }
    .bf-cal-day.is-empty,
    .bf-cal-day:disabled {
      color: #cdc6c0;
      cursor: default;
      background: transparent !important;
      font-weight: 400;
    }
    .bf-cal-day.is-empty { pointer-events: none; }
    /* Time slots */
    .bf-ts-wrap {
      border-top: 1px solid #ede8e3;
      padding: 16px 18px 18px;
      background: #fdfaf8;
    }
    .bf-ts-heading {
      display: flex;
      align-items: center;
      gap: 7px;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      font-weight: 700;
      color: #2FA9A3;
      text-transform: uppercase;
      letter-spacing: .8px;
      margin-bottom: 12px;
    }
    .bf-ts-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
      gap: 8px;
    }
    .bf-ts-pill {
      padding: 9px 10px;
      border: 1.5px solid #ead9d1;
      background: #fff;
      color: #2b2b2b;
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 600;
      border-radius: 999px;
      cursor: pointer;
      transition: all .18s;
      text-align: center;
    }
    .bf-ts-pill:hover:not(:disabled) {
      border-color: #4DB6AC;
      background: #eafaf8;
      color: #2FA9A3;
    }
    .bf-ts-pill.is-active {
      background: linear-gradient(135deg, #2FA9A3, #1f8c87);
      border-color: #2FA9A3;
      color: #fff;
    }
    .bf-ts-pill:disabled {
      opacity: .32;
      text-decoration: line-through;
      cursor: not-allowed;
    }
    .bf-ts-note {
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      color: #e07c2e;
      margin: 10px 0 0;
      font-style: italic;
    }
    /* Confirmation bar */
    .bf-pick-confirm {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 18px;
      background: #eafaf4;
      border-top: 1px solid #bfeadb;
      font-family: 'Outfit', sans-serif;
    }
    .bf-pick-confirm-icon {
      width: 28px;
      height: 28px;
      min-width: 28px;
      border-radius: 50%;
      background: #2FA9A3;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 14px;
    }
    .bf-pick-confirm strong { font-size: 13.5px; color: #1d5c4e; display: block; }
    .bf-pick-confirm span  { font-size: 12.5px; color: #2b6b58; }
    .bf-pick-confirm-reset {
      margin-left: auto;
      background: transparent;
      border: 1.5px solid #4DB6AC;
      color: #2FA9A3;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      font-weight: 600;
      padding: 5px 14px;
      border-radius: 999px;
      cursor: pointer;
      transition: background .18s, color .18s;
    }
    .bf-pick-confirm-reset:hover { background: #2FA9A3; color: #fff; }
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
      padding: 8px 32px 8px 14px !important;
      width: auto !important;
      min-width: 96px;
      font-weight: 600;
      font-size: 13px;
      color: #1f3b38;
      box-shadow: none !important;
      cursor: pointer;
      background-position: right 10px center !important;
    }
    .bf-phone-group .bf-phone-code:focus { outline: none; }
    .bf-phone-group .bf-phone-number {
      border: none !important;
      background: transparent !important;
      border-radius: 0 !important;
      flex: 1;
      padding: 8px 16px !important;
      box-shadow: none !important;
    }
    /* Override compact input size for phone group inside booking form */
    .book-form .bf-phone-group { font-size: 13px; }
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

    /* ── New split layout ── */
    .bk-split {
      max-width: 1160px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      align-items: stretch;
    }
    .bk-form-col { display: flex; flex-direction: column; }
    .bk-form-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 20px 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    .bk-cal-card {
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
      display: flex;
      flex-direction: column;
      align-items: stretch;
      padding: 22px 22px 0;
    }
    .bk-title {
      font-family: 'Playfair Display', serif;
      font-size: 18px;
      color: #2b2b2b;
      margin: 0 0 12px;
      font-weight: 700;
    }
    .bk-cal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 0 14px;
      background: transparent;
    }
    .bk-cal-month-label {
      font-family: 'Playfair Display', serif;
      font-size: 17px;
      font-weight: 600;
      color: #1f3b38;
      letter-spacing: .2px;
    }
    .bk-cal-nav {
      width: 30px;
      height: 30px;
      border: 1.5px solid #d5cec8;
      border-radius: 6px;
      background: #fff;
      color: #666;
      font-size: 17px;
      line-height: 1;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: border-color .2s, color .2s, background .2s;
    }
    .bk-cal-nav:hover { border-color: #2FA9A3; color: #2FA9A3; background: #f2faf9; }
    .bk-cal-dow {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      background: transparent;
      border-bottom: 1px solid #f0ebe6;
      padding: 0;
    }
    .bk-cal-dow span {
      text-align: center;
      font-family: 'Outfit', sans-serif;
      font-size: 11px;
      font-weight: 600;
      color: #9d8f88;
      text-transform: uppercase;
      letter-spacing: .5px;
      padding: 0 0 8px;
    }
    .bk-cal-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      padding: 8px 0 10px;
      gap: 3px;
      justify-items: center;
      align-items: center;
    }
    .bk-ts-wrap {
      border-top: 1px solid #f0ebe6;
      padding: 12px 0 4px;
      background: transparent;
    }
    .bk-ts-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
      gap: 6px;
    }
    .bk-ts-pill {
      padding: 7px 8px;
      border: 1.5px solid #ead9d1;
      background: #fff;
      color: #2b2b2b;
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 600;
      border-radius: 999px;
      cursor: pointer;
      transition: all .18s;
      text-align: center;
    }
    .bk-ts-pill:hover:not(:disabled) {
      border-color: #4DB6AC;
      background: #eafaf8;
      color: #2FA9A3;
    }
    .bk-ts-pill.is-active {
      background: linear-gradient(135deg, #2FA9A3, #1f8c87);
      border-color: #2FA9A3;
      color: #fff;
    }
    .bk-ts-pill:disabled {
      opacity: .32;
      text-decoration: line-through;
      cursor: not-allowed;
    }
    .bk-cal-footer {
      text-align: left;
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: #2FA9A3;
      padding: 10px 0 18px;
      margin-top: auto;
      font-style: normal;
    }
    .bk-submit-btn {
      width: 100%;
      margin-top: 4px;
      padding: 11px 20px;
      background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%);
      color: #ffffff;
      border: none;
      border-radius: 999px;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: .6px;
      text-transform: uppercase;
      cursor: pointer;
      transition: transform .25s, box-shadow .25s;
      box-shadow: 0 12px 26px -10px rgba(47,169,163,0.55);
    }
    .bk-submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 36px -10px rgba(47,169,163,0.65);
    }
    .bk-time-display {
      background: #f5fbfa !important;
      color: #2FA9A3 !important;
      font-weight: 600 !important;
      cursor: default;
    }
    @media (max-width: 860px) {
      .bk-split { grid-template-columns: 1fr; gap: 20px; }
    }
    @media (max-width: 480px) {
      .bk-form-card { padding: 20px 16px; }
    }

    /* Phone row (Get in Touch) */
    .phone-row {
      display: flex;
      align-items: stretch;
      gap: 0;
      border: 1.5px solid #ead9d1;
      border-radius: 999px;
      background: #fdfaf8;
      transition: border-color .25s, box-shadow .25s, background .25s;
      position: relative;
    }
    .phone-row:focus-within {
      border-color: #4DB6AC;
      box-shadow: 0 0 0 4px rgba(77,182,172,0.14);
      background: #ffffff;
    }
    .phone-row .cc-wrap {
      flex-shrink: 0;
      border-right: 1.5px solid #ead9d1;
    }
    .phone-row .cc-trigger {
      min-height: 50px;
      padding: 0 14px 0 18px;
      background: transparent;
      border-radius: 999px 0 0 999px;
      border: none;
    }
    .phone-row .phone-num {
      border: none !important;
      border-radius: 0 999px 999px 0 !important;
      box-shadow: none !important;
      background: transparent !important;
      flex: 1;
      min-width: 0;
      padding: 14px 18px !important;
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

    /* ── New Booking Form Fields ── */
    .bk-form-col { display: flex; flex-direction: column; }
    .bk-field {
      display: flex;
      flex-direction: column;
      margin-bottom: 18px;
    }
    .bk-label {
      display: block;
      font-family: 'Outfit', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: #1f3b38;
      margin-bottom: 7px;
      letter-spacing: .2px;
    }
    .bk-req { color: #e05252; margin-left: 2px; }
    .bk-input {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid #e5e0d8;
      border-radius: 10px;
      background: #ffffff;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      color: #2b2b2b;
      outline: none;
      transition: border-color .25s, box-shadow .25s;
      box-sizing: border-box;
    }
    .bk-input:focus {
      border-color: #4DB6AC;
      box-shadow: 0 0 0 3px rgba(77,182,172,0.12);
    }
    .bk-input::placeholder { color: #b0a59f; }
    select.bk-input, .bk-select {
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237a6060' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      padding-right: 38px;
      cursor: pointer;
    }
    .bk-textarea { resize: vertical; min-height: 80px; border-radius: 10px !important; }

    /* Booking form phone row */
    .bk-phone-row {
      display: flex;
      align-items: stretch;
      border: 1.5px solid #e5e0d8;
      border-radius: 10px;
      background: #ffffff;
      transition: border-color .25s, box-shadow .25s;
      position: relative;
    }
    .bk-phone-row:focus-within {
      border-color: #4DB6AC;
      box-shadow: 0 0 0 3px rgba(77,182,172,0.12);
    }
    .bk-cc-wrap {
      flex-shrink: 0;
      border-right: 1.5px solid #e5e0d8;
    }
    .bk-cc-wrap .cc-trigger {
      min-height: 46px;
      padding: 0 14px;
      background: transparent;
      border-radius: 10px 0 0 10px;
      border: none;
    }
    .bk-phone-row .bk-phone-num {
      border: none !important;
      border-radius: 0 !important;
      box-shadow: none !important;
      flex: 1;
      background: transparent !important;
      min-width: 0;
    }

    /* Calendly popup trigger button */
    .bk-cal-trigger {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      text-align: left;
      color: #b0a59f;
      background: #ffffff;
    }
    .bk-cal-trigger.has-value { color: #2b2b2b; }
    .bk-cal-chev { margin-left: auto; flex-shrink: 0; color: #9ca3af; }

    /* Time slot confirmation */
    .bk-time-confirm {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 16px;
      border-radius: 10px;
      background: #eafaf4;
      border: 1.5px solid #bfeadb;
      color: #1d6b52;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 8px;
    }
    .bk-change-btn {
      margin-left: auto;
      background: transparent;
      border: 1.5px solid #4DB6AC;
      color: #2FA9A3;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      font-weight: 600;
      padding: 4px 14px;
      border-radius: 999px;
      cursor: pointer;
      transition: background .18s, color .18s;
      white-space: nowrap;
    }
    .bk-change-btn:hover { background: #2FA9A3; color: #fff; }

    /* Alert boxes inside booking form */
    .bk-success-box {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 12px 16px;
      border-radius: 10px;
      background: #eafaf4;
      border: 1px solid #bfeadb;
      color: #1d6b52;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      margin-bottom: 16px;
    }
    .bk-err-box {
      padding: 12px 16px;
      border-radius: 10px;
      background: #fde8e8;
      border: 1px solid #f3c6c6;
      color: #a22d2d;
      font-family: 'Outfit', sans-serif;
      font-size: 13.5px;
      margin-bottom: 16px;
      line-height: 1.5;
    }
  </style>


@endsection
