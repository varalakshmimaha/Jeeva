<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Outfit', sans-serif, Arial; color: #333; margin: 0; padding: 0; background: #faf6f2; }
        .container { max-width: 600px; margin: 24px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #4DB6AC 0%, #2FA9A3 100%); color: #fff; padding: 32px 24px; text-align: center; }
        .header h2 { margin: 0 0 8px; font-size: 24px; font-weight: 700; }
        .header-brand { font-weight: 700; }
        .header-services { color: #e0f2f1; font-size: 13px; opacity: 0.95; line-height: 1.5; max-width: 100%; margin: 0 auto; font-weight: 500; white-space: nowrap; }
        .content { padding: 28px 24px; }
        .greeting { font-size: 16px; margin-bottom: 18px; font-weight: 600; color: #1f3b38; }
        .card { background: #f8faf9; border: 1px solid #e3ece9; border-radius: 10px; padding: 18px 20px; margin: 16px 0; }
        .row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eef2f1; font-size: 14px; }
        .row:last-child { border-bottom: none; }
        .label { color: #6b7280; font-weight: 600; }
        .value { color: #1f3b38; font-weight: 600; text-align: right; }
        .note { font-size: 14px; color: #555; line-height: 1.6; margin: 16px 0; }
        .action-box { background: #e8f7f5; border: 2px solid #2FA9A3; border-radius: 12px; padding: 22px 24px; margin: 24px 0; text-align: center; }
        .action-box h3 { margin: 0 0 6px; font-size: 16px; color: #1f3b38; }
        .action-box p { margin: 0 0 18px; font-size: 13px; color: #4a7a75; }
        .btn-row { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .gcal-btn { display: inline-block; padding: 12px 24px; background: #2FA9A3; color: #ffffff; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 700; }
        .signature { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eef2f1; }
        .signature-name { font-size: 16px; font-weight: 600; color: #333; margin: 0; }
        .signature-logo { margin-top: 10px; height: 100px; width: auto; object-fit: contain; }
        .signature-tagline { font-size: 13px; color: #555; line-height: 1.5; margin: 12px 0 8px; font-style: italic; }
        .signature-social { margin-top: 12px; display: flex; gap: 12px; align-items: center; }
        .social-icon { height: 20px; width: 20px; object-fit: contain; }
        .footer { padding: 20px 24px; border-top: 1px solid #eef2f1; font-size: 12px; color: #9aa0a0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>✓ Booking Confirmed</h2>
            <div class="header-services">
                <span class="header-brand">JIVA birth & beyond</span> services --- Supporting your journey
            </div>
        </div>

        <div class="content">
            <p class="greeting">Hi {{ $booking->name }},</p>

            <p class="note">
                Your consultation has been booked! Here's a summary of your session details:
            </p>

            <div class="card">
                @if($booking->service_selected)
                <div class="row">
                    <span class="label">Service</span>
                    <span class="value">{{ $booking->service_selected }}</span>
                </div>
                @endif
                @if($booking->preferred_date)
                <div class="row">
                    <span class="label">Date</span>
                    <span class="value">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('l, d M Y') }}</span>
                </div>
                @endif
                @if($booking->preferred_time)
                <div class="row">
                    <span class="label">Time</span>
                    <span class="value">{{ $booking->preferred_time }}</span>
                </div>
                @endif
                <div class="row">
                    <span class="label">Email</span>
                    <span class="value">{{ $booking->email }}</span>
                </div>
            </div>

            @if(!empty($gcalLink))
            <div class="action-box">
                <h3>📅 Add to Your Calendar</h3>
                <p>Save your session so you don't miss it.</p>
                <div class="btn-row">
                    <a href="{{ $gcalLink }}" class="gcal-btn">➕ Add to Google Calendar</a>
                </div>
            </div>
            @endif

            <p class="note">
                If anything changes or you have questions, simply reply to this email — I'll be happy to help.
            </p>

            <div class="signature">
                <p class="signature-name">Warm Regards,</p>
                <p class="signature-name" style="margin-top: 4px;">Anu</p>
                @php
                    $logoPath = \App\Models\SiteSetting::where('key', 'logo_path')->value('value');
                    $instagram = \App\Models\SiteSetting::where('key', 'instagram_link')->value('value');
                    $facebook = \App\Models\SiteSetting::where('key', 'facebook_link')->value('value');
                    $whatsapp = \App\Models\SiteSetting::where('key', 'whatsapp_link')->value('value');
                    $youtube = \App\Models\SiteSetting::where('key', 'youtube_link')->value('value');
                @endphp
                @if($logoPath)
                    <img src="{{ asset('storage/' . $logoPath) }}" alt="JIVA Birth & Beyond" class="signature-logo">
                @endif

                <div class="signature-tagline">
                    Supporting women through mindful movement, nourishing practices, and empowered birth experiences.<br>
                    Guiding every journey with yoga, nutrition, and compassionate doula care.
                </div>

                <div class="signature-social">
                    @if($instagram)
                        <a href="{{ $instagram }}">
                            <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram" class="social-icon">
                        </a>
                    @endif
                    @if($facebook)
                        <a href="{{ $facebook }}">
                            <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" class="social-icon">
                        </a>
                    @endif
                    @if($whatsapp)
                        <a href="{{ $whatsapp }}">
                            <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" class="social-icon">
                        </a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}">
                            <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube" class="social-icon">
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated confirmation from JIVA Birth & Beyond.</p>
        </div>
    </div>
</body>
</html>
