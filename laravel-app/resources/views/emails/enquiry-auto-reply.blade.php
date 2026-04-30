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
        .content { padding: 40px 32px; line-height: 1.8; color: #444; }
        .greeting { font-size: 18px; font-weight: 600; color: #1f3b38; margin-bottom: 24px; }
        .message-p { margin-bottom: 20px; font-size: 16px; }
        .signature { margin-top: 40px; padding-top: 24px; border-top: 1px solid #eee; }
        .signature-name { font-size: 17px; font-weight: 500; color: #444; margin: 0; }
        .signature-logo { margin-top: 18px; height: 130px; width: auto; object-fit: contain; }
        .signature-social { margin-top: 20px; display: flex; gap: 14px; align-items: center; }
        .social-icon { height: 36px; width: 36px; object-fit: contain; border-radius: 6px; }
        .footer { padding: 20px 24px; border-top: 1px solid #eef2f1; font-size: 12px; color: #9aa0a0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>We've Received Your Enquiry</h2>
            <div class="header-services">
                <span class="header-brand">JIVA birth & beyond</span> services --- Supporting your journey
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
                    <img src="{{ asset('storage/' . $logoPath) }}" alt="JIVA birth & beyond" class="signature-logo">
                @else
                    <p style="font-size: 16px; color: #333; font-weight: 700; margin-top: 10px;">JIVA birth & beyond</p>
                @endif

                <div class="signature-social">
                    @if($instagram)
                        <a href="{{ $instagram }}">
                            <img src="https://img.icons8.com/color/96/instagram-new.png" alt="Instagram" class="social-icon">
                        </a>
                    @endif
                    @if($facebook)
                        <a href="{{ $facebook }}">
                            <img src="https://img.icons8.com/color/96/facebook-new.png" alt="Facebook" class="social-icon">
                        </a>
                    @endif
                    @if($whatsapp)
                        <a href="{{ $whatsapp }}">
                            <img src="https://img.icons8.com/color/96/whatsapp.png" alt="WhatsApp" class="social-icon">
                        </a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}">
                            <img src="https://img.icons8.com/color/96/youtube-play.png" alt="YouTube" class="social-icon">
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated reply to your enquiry submitted at jivabirthandbeyond.com</p>
        </div>
    </div>
</body>
</html>
