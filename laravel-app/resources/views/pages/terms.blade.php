@extends('layouts.app')

@section('title', 'Terms & Conditions')

@section('content')

<div class="page-header">
  <div class="page-header-body">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-sep">&rsaquo;</span>
        <span class="breadcrumb-current">Terms &amp; Conditions</span>
      </nav>
    <h1>Terms &amp; Conditions</h1>
    <p>The basic terms that apply when you use our website, submit enquiries, or schedule services with our clinic.</p>
  </div>
</div>

<section>
  <div class="container">
    <article class="article-shell reveal">
      <div class="article-prose" style="margin-top:0;padding-top:0;border-top:none;">
        <p><strong>Last updated:</strong> {{ now()->format('F d, Y') }}</p>

        <h3>Website Use</h3>
        <p>This website is intended to provide general information about Jiva Birth and Beyond, our services, and contact options. The content is for informational purposes and should not be treated as a substitute for professional medical advice.</p>

        <h3>Consultations and Enquiries</h3>
        <p>Submitting a form or enquiry through this website does not guarantee a consultation until it is confirmed by Jiva Birth and Beyond. Consultation times, service availability, and schedules are subject to confirmation.</p>

        <h3>Medical Information</h3>
        <p>Information on this website may describe treatments and procedures in general terms. Individual treatment recommendations vary from patient to patient and should be confirmed only after professional consultation and examination.</p>

        <h3>Accuracy of Content</h3>
        <p>We aim to keep the website content accurate and current, but we do not guarantee that all information is complete, error-free, or up to date at all times. Content may be updated, modified, or removed without prior notice.</p>

        <h3>Intellectual Property</h3>
        <p>Website content, branding, design elements, and original text belong to our clinic unless otherwise stated. They may not be copied, reproduced, or reused for commercial purposes without prior written permission.</p>

        <h3>Third-Party Links</h3>
        <p>Our website may include links to third-party websites or platforms for convenience. We are not responsible for the content, privacy practices, or availability of those external services.</p>

        <h3>Limitation of Liability</h3>
        <p>We are not liable for losses or damages arising from the use of this website, website downtime, or reliance on general website content. Clinical decisions should always be based on direct consultation with qualified professionals.</p>

        <h3>Contact</h3>
        <p>For questions regarding these Terms &amp; Conditions, please contact us at <a href="mailto:{{ $siteSettings['company_email'] }}">{{ $siteSettings['company_email'] }}</a> or call <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['company_phone']) }}">{{ $siteSettings['company_phone'] }}</a>.</p>
      </div>
    </article>
  </div>
</section>

@endsection
