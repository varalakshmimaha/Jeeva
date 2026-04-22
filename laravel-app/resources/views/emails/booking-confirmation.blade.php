<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0; background: #faf6f2; }
        .container { max-width: 600px; margin: 24px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #2FA9A3 0%, #1f8c87 100%); color: #fff; padding: 32px 24px; text-align: center; }
        .header h2 { margin: 0 0 8px; font-size: 24px; font-weight: 700; }
        .header p { margin: 0; font-size: 14px; opacity: .9; }
        .content { padding: 28px 24px; }
        .greeting { font-size: 16px; margin-bottom: 18px; }
        .card { background: #f8faf9; border: 1px solid #e3ece9; border-radius: 10px; padding: 18px 20px; margin: 16px 0; }
        .row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eef2f1; font-size: 14px; }
        .row:last-child { border-bottom: none; }
        .label { color: #6b7280; font-weight: 600; }
        .value { color: #1f3b38; font-weight: 600; text-align: right; }
        .note { font-size: 14px; color: #555; line-height: 1.6; margin: 16px 0; }
        .footer { padding: 20px 24px; border-top: 1px solid #eef2f1; font-size: 12px; color: #9aa0a0; text-align: center; }
        .footer a { color: #2FA9A3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>✓ Booking Received</h2>
            <p>Thank you for reaching out to Jiva Birth &amp; Beyond</p>
        </div>

        <div class="content">
            <p class="greeting">Hi {{ $booking->name }},</p>

            <p class="note">
                Thank you for booking a consultation with us. I've received your request and will be in touch shortly to confirm your session. Here's a summary of your booking:
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
                    <span class="label">Preferred Date</span>
                    <span class="value">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('l, d M Y') }}</span>
                </div>
                @endif
                @if($booking->preferred_time)
                <div class="row">
                    <span class="label">Preferred Time</span>
                    <span class="value">{{ $booking->preferred_time }}</span>
                </div>
                @endif
                @if($booking->phone)
                <div class="row">
                    <span class="label">Phone</span>
                    <span class="value">{{ $booking->phone }}</span>
                </div>
                @endif
                <div class="row">
                    <span class="label">Email</span>
                    <span class="value">{{ $booking->email }}</span>
                </div>
            </div>

            @if($booking->message)
            <p class="note"><strong>Your notes:</strong><br>{{ $booking->message }}</p>
            @endif

            <p class="note">
                If anything changes or you have questions, simply reply to this email — I'll be happy to help.
            </p>

            <p class="note">
                Warmly,<br>
                <strong>Anu</strong><br>
                Jiva Birth &amp; Beyond
            </p>
        </div>

        <div class="footer">
            <p>This is an automated confirmation. Please don't reply if you received this in error.</p>
        </div>
    </div>
</body>
</html>
