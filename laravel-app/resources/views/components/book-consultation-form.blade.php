<div class="book-consultation-section">
  <div class="container">
    <div class="book-consultation-wrapper">
      <div class="book-consultation-header reveal">
        <h2 class="book-consultation-title">Book a Consultation</h2>
        <p class="book-consultation-subtitle">Share your details and schedule your free consultation with Anu</p>
      </div>

      <form id="bookConsultationForm" class="book-consultation-form reveal" action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="bcf-row">
          <div class="bcf-field">
            <input type="text" name="name" placeholder="Your Name *" class="bcf-input" required>
          </div>
          <div class="bcf-field">
            <input type="email" name="email" placeholder="Your Email *" class="bcf-input" required>
          </div>
        </div>

        <div class="bcf-row">
          <div class="bcf-field bcf-phone-group">
            <select name="country_code" class="bcf-input bcf-country-code" required>
              <option value="">Country Code</option>
              <option value="+1">🇺🇸 +1 (US)</option>
              <option value="+91">🇮🇳 +91 (India)</option>
              <option value="+44">🇬🇧 +44 (UK)</option>
              <option value="+61">🇦🇺 +61 (Australia)</option>
              <option value="+1-CA">🇨🇦 +1 (Canada)</option>
              <option value="+64">🇳🇿 +64 (New Zealand)</option>
              <option value="+27">🇿🇦 +27 (South Africa)</option>
            </select>
            <input type="tel" name="phone" placeholder="Phone Number *" class="bcf-input" required>
          </div>
          <div class="bcf-field">
            <input type="text" name="datetime" placeholder="Select Date & Time *" class="bcf-input" data-calendly readonly required>
          </div>
        </div>

        <div class="bcf-field">
          <textarea name="notes" placeholder="Other Notes (Optional)" class="bcf-input bcf-textarea" rows="3"></textarea>
        </div>

        <button type="submit" class="bcf-submit-btn">Book Consultation</button>
      </form>
    </div>
  </div>
</div>

<style>
  .book-consultation-section {
    padding: 80px 6%;
    background: linear-gradient(135deg, #f5fbfa 0%, #e8f7f5 100%);
    margin: 60px 0;
  }
  .book-consultation-wrapper {
    max-width: 720px;
    margin: 0 auto;
  }
  .book-consultation-header {
    text-align: center;
    margin-bottom: 48px;
  }
  .book-consultation-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 3vw, 38px);
    color: #2b2b2b;
    margin: 0 0 12px;
    line-height: 1.3;
  }
  .book-consultation-subtitle {
    font-size: 16px;
    color: #666;
    margin: 0;
    line-height: 1.6;
  }
  .book-consultation-form {
    background: #ffffff;
    padding: 40px 36px;
    border-radius: 20px;
    box-shadow: 0 16px 40px rgba(77, 182, 172, 0.12);
  }
  .bcf-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
  }
  .bcf-field {
    display: flex;
  }
  .bcf-field.bcf-phone-group {
    grid-column: 1 / -1;
    gap: 12px;
  }
  .bcf-country-code {
    flex: 0 0 100px;
  }
  .bcf-phone-group input {
    flex: 1;
  }
  .bcf-input,
  .bcf-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #e0e8e6;
    border-radius: 10px;
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    color: #2b2b2b;
    background: #fafbfb;
    transition: all 0.3s ease;
    outline: none;
  }
  .bcf-input::placeholder,
  .bcf-textarea::placeholder {
    color: #a8a8a8;
  }
  .bcf-input:focus,
  .bcf-textarea:focus {
    border-color: #4DB6AC;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(77, 182, 172, 0.1);
  }
  .bcf-textarea {
    resize: vertical;
    min-height: 80px;
  }
  .bcf-submit-btn {
    width: 100%;
    padding: 14px 28px;
    background: linear-gradient(135deg, #4DB6AC 0%, #3d9e94 100%);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 8px;
  }
  .bcf-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(77, 182, 172, 0.25);
  }
  @media (max-width: 768px) {
    .book-consultation-section { padding: 60px 5%; }
    .book-consultation-form { padding: 32px 24px; }
    .bcf-row { grid-template-columns: 1fr; }
    .bcf-field.bcf-phone-group { grid-column: 1; }
  }
</style>
