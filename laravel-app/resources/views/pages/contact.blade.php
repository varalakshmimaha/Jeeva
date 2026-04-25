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
    @php
      $calLink   = trim($siteSettings['cal_link'] ?? '');
      $useCalCom = !empty($calLink);
      $rawSlots  = $siteSettings['booking_time_slots'] ?? '9:00 AM,10:00 AM,11:00 AM,12:00 PM,2:00 PM,3:00 PM,4:00 PM,5:00 PM';
      $timeSlots = array_values(array_filter(array_map('trim', explode(',', $rawSlots))));
    @endphp

    <div class="bk-split">

      <!-- Left: Form -->
      <div class="bk-form-card">
        <h3 class="bk-title">Book Consultation</h3>

        @if(session('success'))
          @php
            $successKind = session('success_kind', 'booking');
            $modalTitle  = $successKind === 'enquiry' ? 'Message Sent' : 'Slot Booked';
            $modalSub    = $successKind === 'enquiry' ? 'We\'ll review your message and get back to you as soon as possible.' : '';
          @endphp
          <div id="bookingSuccessModal" class="booking-modal-overlay">
            <div class="booking-modal-card">
              <div class="booking-modal-icon">
                <svg viewBox="0 0 52 52" width="46" height="46"><circle cx="26" cy="26" r="24" fill="none" stroke="#2FA9A3" stroke-width="3" class="bm-circle"/><path d="M14 27l8 8 16-18" fill="none" stroke="#2FA9A3" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" class="bm-check"/></svg>
              </div>
              <h3 class="booking-modal-title">{{ $modalTitle }}</h3>
              <p class="booking-modal-text">{{ session('success') }}</p>
              @if($modalSub)<p class="booking-modal-sub">{{ $modalSub }}</p>@endif
              <button type="button" class="booking-modal-btn" onclick="document.getElementById('bookingSuccessModal').remove()">Got it</button>
            </div>
          </div>
        @endif

        @if($errors->any())
          <div class="book-alert book-alert--err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
          </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="book-form" id="bookConsultationForm">
          @csrf
          <input type="hidden" name="subject" value="Contact Page Booking">
          <input type="hidden" name="preferred_date" id="bfDate" value="{{ old('preferred_date') }}">
          <input type="hidden" name="preferred_time" id="bfTime" value="{{ old('preferred_time') }}">

          <div class="bf-field">
            <label>Name</label>
            <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
          </div>

          <div class="bf-field">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
          </div>

          <div class="bf-field">
            <label>Phone</label>
            <div class="bf-phone-group">
              @include('partials.country-codes', ['default' => '+91'])
              <input type="tel" name="phone" class="bf-phone-number" placeholder="Phone Number" value="{{ old('phone') }}" required>
            </div>
          </div>

          <div class="bf-field">
            <label>Purpose</label>
            <select name="service_selected" required>
              <option value="" disabled {{ old('service_selected') ? '' : 'selected' }}>Consultation</option>
              @foreach(($services ?? []) as $service)
                <option value="{{ $service->title }}" {{ old('service_selected') === $service->title ? 'selected' : '' }}>{{ $service->title }}</option>
              @endforeach
            </select>
          </div>

          <div class="bf-field">
            <label>Selected Time</label>
            <input type="text" id="bfSelectedTimeDisplay" placeholder="Select date and time" readonly class="bk-time-display">
          </div>

          <div class="bf-field">
            <label>Notes</label>
            <textarea name="message" rows="2" placeholder="Anything you'd like us to know...">{{ old('message') }}</textarea>
          </div>

          <button type="submit" class="bk-submit-btn">Book Consultation</button>
        </form>
      </div>

      <!-- Right: Calendar (always visible) -->
      <div class="bk-cal-card">
        @if($useCalCom)
          <div style="width:100%;height:680px;overflow:scroll;" id="bfCalComWidget"></div>
        @else
          <div class="bk-cal-header">
            <button type="button" class="bk-cal-nav" id="bfCalPrev">&#8249;</button>
            <span class="bk-cal-month-label" id="bfCalLabel"></span>
            <button type="button" class="bk-cal-nav" id="bfCalNext">&#8250;</button>
          </div>
          <div class="bk-cal-dow">
            <span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span>
          </div>
          <div class="bk-cal-grid" id="bfCalGrid"></div>

          <div class="bk-ts-wrap" id="bfTsWrap" style="display:none;">
            <div class="bk-ts-grid" id="bfTsGrid">
              @foreach($timeSlots as $slot)
                <button type="button" class="bk-ts-pill" data-time="{{ $slot }}">{{ $slot }}</button>
              @endforeach
            </div>
          </div>

          <p class="bk-cal-footer" id="bfCalFooter">Select a Date</p>
        @endif
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
              @include('partials.country-codes', ['default' => '+91'])
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
      padding: 28px 4% 36px;
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
    /* ── Cal.com wrapper ── */
    .bf-cal-com-wrap {
      border: 1.5px solid #ead9d1;
      border-radius: 18px;
      overflow: hidden;
      background: #fff;
      margin-bottom: 10px;
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
      aspect-ratio: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      font-weight: 500;
      color: #2b2b2b;
      cursor: pointer;
      border: none;
      background: transparent;
      transition: background .18s, color .18s;
    }
    .bf-cal-day:hover:not(:disabled):not(.is-empty) {
      background: #e8f7f5;
      color: #2FA9A3;
    }
    .bf-cal-day.is-today {
      border: 1.5px solid #4DB6AC;
      color: #2FA9A3;
      font-weight: 700;
    }
    .bf-cal-day.is-selected {
      background: linear-gradient(135deg, #2FA9A3, #1f8c87) !important;
      color: #fff !important;
      font-weight: 700;
    }
    .bf-cal-day.is-empty,
    .bf-cal-day:disabled {
      color: #d5ccc8;
      cursor: default;
      background: transparent;
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
    .bk-form-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 20px 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    .bk-cal-card {
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
      display: flex;
      flex-direction: column;
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
      padding: 12px 16px 10px;
      background: linear-gradient(135deg, #2FA9A3, #1f8c87);
    }
    .bk-cal-month-label {
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      letter-spacing: .3px;
    }
    .bk-cal-nav {
      background: rgba(255,255,255,0.2);
      border: none;
      color: #fff;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      font-size: 22px;
      line-height: 1;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s;
    }
    .bk-cal-nav:hover { background: rgba(255,255,255,0.35); }
    .bk-cal-dow {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      background: #f2faf9;
      border-bottom: 1px solid #e5f5f3;
    }
    .bk-cal-dow span {
      text-align: center;
      font-family: 'Outfit', sans-serif;
      font-size: 10px;
      font-weight: 700;
      color: #2FA9A3;
      text-transform: uppercase;
      letter-spacing: .5px;
      padding: 5px 0;
    }
    .bk-cal-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      padding: 4px 8px 6px;
      gap: 1px;
    }
    .bk-ts-wrap {
      border-top: 1px solid #ede8e3;
      padding: 10px 12px 12px;
      background: #fdfaf8;
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
      text-align: center;
      font-family: 'Outfit', sans-serif;
      font-size: 12px;
      color: #9d8f88;
      padding: 7px 12px 10px;
      margin-top: auto;
      font-style: italic;
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

@if(empty($siteSettings['cal_link']))
<script>
(function () {
  var dateHidden  = document.getElementById('bfDate');
  var timeHidden  = document.getElementById('bfTime');
  var calGrid     = document.getElementById('bfCalGrid');
  var calLabel    = document.getElementById('bfCalLabel');
  var tsWrap      = document.getElementById('bfTsWrap');
  var tsGrid      = document.getElementById('bfTsGrid');
  var calFooter   = document.getElementById('bfCalFooter');
  var timeDisplay = document.getElementById('bfSelectedTimeDisplay');
  var form        = document.getElementById('bookConsultationForm');
  var calCard     = document.querySelector('.bk-cal-card');

  if (!calGrid) return;

  var today    = new Date(); today.setHours(0,0,0,0);
  var curYear  = today.getFullYear();
  var curMonth = today.getMonth();
  var selDate  = null;
  var bookedMap = {};

  var MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December'];

  function pad(n) { return ('0' + n).slice(-2); }
  function isoDate(d) { return d.getFullYear() + '-' + pad(d.getMonth()+1) + '-' + pad(d.getDate()); }

  function renderCalendar() {
    calLabel.textContent = MONTHS[curMonth] + ' ' + curYear;
    calGrid.innerHTML = '';
    var first = new Date(curYear, curMonth, 1);
    var startDow = first.getDay();
    var daysInMonth = new Date(curYear, curMonth + 1, 0).getDate();

    for (var i = 0; i < startDow; i++) {
      var blank = document.createElement('button');
      blank.type = 'button';
      blank.className = 'bf-cal-day is-empty';
      calGrid.appendChild(blank);
    }

    for (var d = 1; d <= daysInMonth; d++) {
      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'bf-cal-day';
      btn.textContent = d;
      var dt = new Date(curYear, curMonth, d);
      var iso = isoDate(dt);
      btn.dataset.iso = iso;

      if (dt < today) {
        btn.disabled = true;
      } else {
        if (dt.getTime() === today.getTime()) btn.classList.add('is-today');
        if (selDate && iso === isoDate(selDate)) btn.classList.add('is-selected');
        btn.addEventListener('click', function () { pickDate(this); });
      }
      calGrid.appendChild(btn);
    }
  }

  function pickDate(btn) {
    var iso = btn.dataset.iso;
    selDate = new Date(iso + 'T00:00:00');
    dateHidden.value = iso;
    timeHidden.value = '';

    document.querySelectorAll('.bk-ts-pill').forEach(function(p){ p.disabled = false; p.classList.remove('is-active'); });
    tsWrap.style.display = 'block';

    var dayLabel = selDate.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' });
    if (calFooter) calFooter.textContent = dayLabel + ' — pick a time below';
    if (timeDisplay) { timeDisplay.value = ''; timeDisplay.placeholder = 'Now select a time slot →'; }

    renderCalendar();

    if (bookedMap[iso] !== undefined) {
      applyBooked(iso, bookedMap[iso]);
    } else {
      fetch('/booked-slots?date=' + iso)
        .then(function(r){ return r.json(); })
        .then(function(data){
          bookedMap[iso] = data.booked || [];
          applyBooked(iso, bookedMap[iso]);
        })
        .catch(function(){});
    }

    tsWrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function applyBooked(iso, booked) {
    if (!selDate || isoDate(selDate) !== iso) return;
    document.querySelectorAll('.bk-ts-pill').forEach(function(p){
      p.disabled = booked.indexOf(p.dataset.time) !== -1;
    });
  }

  if (tsGrid) {
    tsGrid.addEventListener('click', function(e) {
      var pill = e.target.closest('.bk-ts-pill');
      if (!pill || pill.disabled) return;
      document.querySelectorAll('.bk-ts-pill').forEach(function(p){ p.classList.remove('is-active'); });
      pill.classList.add('is-active');
      timeHidden.value = pill.dataset.time;
      showConfirm();
    });
  }

  function showConfirm() {
    if (!selDate || !timeHidden.value) return;
    var label = selDate.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
    var full  = label + ' at ' + timeHidden.value;
    if (timeDisplay) timeDisplay.value = full;
    if (calFooter)   calFooter.textContent = '✓ ' + full;
  }

  document.getElementById('bfCalPrev').addEventListener('click', function() {
    curMonth--; if (curMonth < 0) { curMonth = 11; curYear--; }
    renderCalendar();
  });
  document.getElementById('bfCalNext').addEventListener('click', function() {
    curMonth++; if (curMonth > 11) { curMonth = 0; curYear++; }
    renderCalendar();
  });

  if (form) {
    form.addEventListener('submit', function(e) {
      if (!dateHidden.value || !timeHidden.value) {
        e.preventDefault();
        if (calCard) calCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        alert('Please pick both a date and a time slot before booking.');
      }
    });
  }

  renderCalendar();
})();
</script>
@endif

@if(!empty($siteSettings['cal_link']))
{{-- Cal.com embed script — only loaded when a link is configured --}}
<script type="text/javascript">
(function (C, A, L) {
  let p = function (a, ar) { a.q.push(ar); };
  let d = C.document;
  C.Cal = C.Cal || function () {
    let cal = C.Cal; let ar = arguments;
    if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement("script")).src = A; cal.loaded = true; }
    if (ar[0] === L) { const api = function () { p(api, arguments); }; const namespace = ar[1]; api.q = api.q || []; typeof namespace === "string" ? (cal.ns[namespace] = api) && p(api, ar) : p(cal, ar); return; }
    p(cal, ar);
  };
})(window, "https://app.cal.com/embed/embed.js", "init");

Cal("init", "jiva", { origin: "https://cal.com" });

Cal.ns.jiva("inline", {
  elementOrSelector: "#bfCalComWidget",
  config: { layout: "month_view" },
  calLink: "{{ $siteSettings['cal_link'] }}",
});

Cal.ns.jiva("ui", {
  styles: { branding: { brandColor: "#2FA9A3" } },
  hideEventTypeDetails: false,
  layout: "month_view"
});

// Capture booking details from Cal.com postMessage event
(function () {
  var dateHidden  = document.getElementById('bfDate');
  var timeHidden  = document.getElementById('bfTime');
  var confirmBox  = document.getElementById('bfSlotConfirm');
  var confirmText = document.getElementById('bfSlotConfirmText');
  var form        = document.getElementById('bookConsultationForm');

  window.addEventListener('message', function (e) {
    if (!e || !e.data) return;
    var data = e.data;
    // Cal.com fires cal:bookingSuccessfulV2
    if (data.type !== 'cal:bookingSuccessfulV2' && data.type !== 'booking_successful') return;

    var booking = data.data || data.booking || {};
    var startTime = booking.startTime || booking.start_time || '';
    if (!startTime) return;

    var d = new Date(startTime);
    if (isNaN(d.getTime())) return;

    var y   = d.getFullYear();
    var mo  = ('0' + (d.getMonth() + 1)).slice(-2);
    var day = ('0' + d.getDate()).slice(-2);
    dateHidden.value = y + '-' + mo + '-' + day;

    var h   = d.getHours();
    var min = ('0' + d.getMinutes()).slice(-2);
    var ap  = h >= 12 ? 'PM' : 'AM';
    var h12 = ('0' + (h % 12 === 0 ? 12 : h % 12)).slice(-2);
    timeHidden.value = h12 + ':' + min + ' ' + ap;

    if (confirmBox) {
      confirmBox.style.display = 'flex';
      if (confirmText) {
        confirmText.textContent = d.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) + ' at ' + h12 + ':' + min + ' ' + ap;
      }
    }
  });

  if (form) {
    form.addEventListener('submit', function (e) {
      if (!dateHidden.value || !timeHidden.value) {
        e.preventDefault();
        document.getElementById('bfCalComWidget').scrollIntoView({ behavior: 'smooth', block: 'center' });
        alert('Please complete your booking on the calendar above before submitting.');
      }
    });
  }
})();
</script>
@endif

@endsection
