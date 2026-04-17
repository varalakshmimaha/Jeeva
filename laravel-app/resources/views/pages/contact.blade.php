@extends('layouts.app')

@section('title', 'Contact Us - Jiva Birth and Beyond')

@section('content')

  <x-page-banner
    :title="(isset($banner) && $banner) ? $banner->title : 'Get in Touch'"
    :subtitle="(isset($banner) && $banner && $banner->description) ? $banner->description : 'Have questions or ready to book a consultation? We are here to help you on your birth journey.'"
    :image="(isset($banner) && $banner && $banner->image) ? asset($banner->image) : asset('images/banner-services.png')"
    :breadcrumbs="[['label' => 'Contact Us']]"
  />

  <!-- Contact Section -->
  <section>
    <div class="contact-grid">
      <!-- Left: Contact Form -->
      <div class="contact-form-box">
        <h3>Send us a Message</h3>

        <form action="{{ route('contact.store') }}" method="POST">
          @csrf

          <div class="fg">
            <label class="fl">Full Name *</label>
            <input type="text" name="name" class="fi" placeholder="Your full name" required>
          </div>

          <div class="fg">
            <label class="fl">Email Address *</label>
            <input type="email" name="email" class="fi" placeholder="youremail@com" required>
          </div>

          <div class="fg">
            <label class="fl">Phone Number</label>
            <input type="tel" name="phone" class="fi" placeholder="+91 XXXXX XXXXX">
          </div>

          <div class="fg">
            <label class="fl">Subject *</label>
            <input type="text" name="subject" class="fi" placeholder="How can we help?" required>
          </div>

          <div class="fg">
            <label class="fl">Message *</label>
            <textarea name="message" class="ft" placeholder="Write your message here..." required></textarea>
          </div>

          <button type="submit" class="sub-btn">
            Send Message
          </button>

          @if($errors->any())
            <div class="form-ok" style="background:var(--white);border-color:#e57373;color:#e57373;display:block;">
              @foreach($errors->all() as $error)
                {{ $error }}<br>
              @endforeach
            </div>
          @endif

          @if(session('success'))
            <div class="form-ok" style="display:block;">
              ✓ Message received! We'll contact you within 2 hours.
            </div>
          @endif
        </form>
      </div>

      <!-- Right: Contact Info -->
      <div class="contact-info">
        <h3>Contact Information</h3>

        <div class="c-item">
          <div class="c-ico">📍</div>
          <div class="c-content">
            <div class="c-lbl">Address</div>
            <div class="c-val">{{ $siteSettings['address_main'] ?? 'Tippasandra, Bangalore' }}</div>
            <div class="c-sub">{{ $siteSettings['address_sub'] ?? 'Next to Central Park, Bangalore 560075' }}</div>
          </div>
        </div>

        <div class="c-item">
          <div class="c-ico">📞</div>
          <div class="c-content">
            <div class="c-lbl">Phone</div>
            <a href="tel:+917483211870" class="c-val">+91 74832 11870</a>
            <div class="c-sub">Available Mon-Sat, 9 AM - 9 PM</div>
          </div>
        </div>

        <div class="c-item">
          <div class="c-ico">📧</div>
          <div class="c-content">
            <div class="c-lbl">Email</div>
            <a href="mailto:info@jivabirthandbeyond.com" class="c-val">bengaluruldentalhome@gmail.com</a>
            <div class="c-sub">We'll respond within 2 hours</div>
          </div>
        </div>

        <div class="c-item">
          <div class="c-ico whatsapp-ico">💬</div>
          <div class="c-content">
            <div class="c-lbl">WhatsApp</div>
            <a href="https://wa.me/917483211870" target="_blank" class="c-val whatsapp-link">Chat with us ↗</a>
          </div>
        </div>

        <div class="c-item">
          <div class="c-ico">🕐</div>
          <div class="c-content">
            <div class="c-lbl">Working Hours</div>
            <div class="c-val">Mon - Sat: 9:00 AM - 6:00 PM</div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Map Section -->
  @if(!empty($siteSettings['map_embed']))
    <section class="map-section">
      <div class="map-container">
        {!! $siteSettings['map_embed'] !!}
      </div>
    </section>
  @else
    <div class="map-wrap">
      <div class="map-ph">
        <div class="map-ico">📍</div>
        <p>Our clinic is located at <strong>Tippasandra, Bangalore</strong></p>
        <a href="https://maps.google.com" target="_blank">Open in Google Maps</a>
      </div>
    </div>
  @endif

@endsection