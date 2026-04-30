<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Outfit', sans-serif, Arial; color: #333; margin: 0; padding: 0; background: #faf6f2; }
        .container { max-width: 600px; margin: 24px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #4DB6AC 0%, #2FA9A3 100%); color: #fff; padding: 32px 24px; text-align: center; }
        .header h2 { margin: 0 0 8px; font-size: 24px; font-weight: 700; }
        .header-brand { font-weight: 700; display: block; margin-bottom: 6px; }
        .header-services { color: #e0f2f1; font-size: 13px; opacity: 0.95; line-height: 1.5; max-width: 500px; margin: 0 auto; font-weight: 500; }
        .content { padding: 40px 32px; line-height: 1.8; color: #444; }
        .greeting { font-size: 18px; font-weight: 600; color: #1f3b38; margin-bottom: 24px; }
        .message-p { margin-bottom: 20px; font-size: 16px; }
        .signature { margin-top: 40px; padding-top: 24px; border-top: 1px solid #eee; }
        .signature-name { font-size: 18px; font-weight: 700; color: #2FA9A3; margin: 0; }
        .signature-logo { margin-top: 12px; height: 50px; width: auto; object-fit: contain; }
        .footer { padding: 20px 24px; border-top: 1px solid #eef2f1; font-size: 12px; color: #9aa0a0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>We've Received Your Enquiry</h2>
            <div class="header-services">
                <span class="header-brand">JIVA Birth & Beyond</span>
                Services --- Supporting your journey
            </div>
        </div>

        <div class="content">
            <p class="greeting">Hi {{ $booking->name }},</p>

            <p class="message-p">
                Thank you for reaching out! I've received your enquiry and will get back to you shortly.
            </p>

            <p class="message-p">
                I'm looking forward to understanding your goals and supporting you on your journey.
            </p>

            <div class="signature">
                <p class="signature-name">Warm regards,</p>
                <p class="signature-name" style="margin-top: 8px;">Anu</p>
                @php
                    $logoPath = \App\Models\SiteSetting::where('key', 'logo_path')->value('value');
                @endphp
                @if($logoPath)
                    <img src="{{ asset('storage/' . $logoPath) }}" alt="JIVA Birth & Beyond" class="signature-logo">
                @else
                    <p style="font-size: 14px; color: #2FA9A3; font-weight: 700; margin-top: 10px;">JIVA Birth & Beyond</p>
                @endif
            </div>
        </div>

        <div class="footer">
            <p>This is an automated reply to your enquiry submitted at jivabirthandbeyond.com</p>
        </div>
    </div>
</body>
</html>
