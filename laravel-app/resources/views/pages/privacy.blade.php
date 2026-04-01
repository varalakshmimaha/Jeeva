@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')

<div class="page-header">
  <div class="page-header-body">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-sep">&rsaquo;</span>
        <span class="breadcrumb-current">Privacy Policy</span>
      </nav>
    <h1>Privacy Policy</h1>
    <p>How we collect, use, and protect your personal information when you interact with our clinic and website.</p>
  </div>
</div>

<section>
  <div class="container">
    <article class="article-shell reveal">
      <div class="article-prose" style="margin-top:0;padding-top:0;border-top:none;">
        <p><strong>Last updated:</strong> {{ now()->format('F d, Y') }}</p>

        <h3>Information We Collect</h3>
        <p>We may collect your name, phone number, email address, appointment details, and any information you provide through our contact or enquiry forms. We may also collect limited technical data such as browser type, device information, and pages visited for website performance and security.</p>

        <h3>How We Use Your Information</h3>
        <p>We use your information to respond to enquiries, schedule appointments, provide dental care support, improve our services, and communicate important updates related to your requests or visits.</p>

        <h3>Sharing of Information</h3>
        <p>We do not sell or rent your personal information. We may share information only when required for clinic operations, legal compliance, safety, or with trusted service providers who help us operate the website or manage communications.</p>

        <h3>Data Security</h3>
        <p>We take reasonable administrative and technical steps to protect your information from unauthorized access, misuse, or disclosure. However, no internet-based system can be guaranteed to be completely secure.</p>

        <h3>Cookies and Website Usage</h3>
        <p>Our website may use basic cookies or similar technologies to improve functionality, remember preferences, and understand usage patterns. You can control cookies through your browser settings.</p>

        <h3>Your Choices</h3>
        <p>You may contact us to update or correct your information, or to ask questions about how your information is handled. If you no longer wish to receive non-essential communications, you may request that at any time.</p>

        <h3>Contact Us</h3>
        <p>If you have any questions about this Privacy Policy, please contact us at <a href="mailto:{{ $siteSettings['company_email'] }}">{{ $siteSettings['company_email'] }}</a> or call <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['company_phone']) }}">{{ $siteSettings['company_phone'] }}</a>.</p>
      </div>
    </article>
  </div>
</section>

@endsection
