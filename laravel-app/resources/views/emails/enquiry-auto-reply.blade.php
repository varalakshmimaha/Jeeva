<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Outfit', sans-serif, Arial; color: #333; margin: 0; padding: 0; background: #faf6f2; }
        .container { max-width: 600px; margin: 24px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #4DB6AC 0%, #2FA9A3 100%); color: #fff; padding: 32px 24px; text-align: center; }
        .header h2 { margin: 0 0 8px; font-size: 24px; font-weight: 700; }
        .header p { margin: 0; font-size: 14px; opacity: .9; }
        .content { padding: 40px 32px; line-height: 1.8; color: #444; }
        .greeting { font-size: 18px; font-weight: 600; color: #1f3b38; margin-bottom: 24px; }
        .message-p { margin-bottom: 20px; font-size: 16px; }
        .signature { margin-top: 40px; padding-top: 24px; border-top: 1px solid #eee; }
        .signature-name { font-size: 18px; font-weight: 700; color: #2FA9A3; margin: 0; }
        .signature-title { font-size: 14px; color: #777; margin: 4px 0 0; }
        .footer { padding: 20px 24px; border-top: 1px solid #eef2f1; font-size: 12px; color: #9aa0a0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>We've Received Your Enquiry</h2>
            <p>Jiva Birth & Beyond — Supporting your journey</p>
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
                <p class="signature-title">Jiva Birth & Beyond</p>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated reply to your enquiry submitted at jivabirthandbeyond.com</p>
        </div>
    </div>
</body>
</html>
