<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4DB6AC; color: white; padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 30px; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 8px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #4DB6AC; font-size: 12px; text-transform: uppercase; }
        .value { margin-top: 5px; color: #555; }
        .divider { border-top: 1px solid #e0e0e0; margin: 20px 0; }
        .action-box { background: #e8f7f5; border: 2px solid #2FA9A3; border-radius: 10px; padding: 18px 20px; margin: 20px 0; text-align: center; }
        .action-box h3 { margin: 0 0 6px; font-size: 15px; color: #1f3b38; }
        .action-box p { margin: 0 0 14px; font-size: 13px; color: #4a7a75; }
        .btn-row { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
        .gcal-btn { display: inline-block; padding: 10px 22px; background: #2FA9A3; color: #ffffff; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 700; }
        .gcal-hint { display: block; margin-top: 8px; font-size: 11px; color: #4a7a75; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0; font-size: 12px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>{{ ($booking->preferred_date && $booking->preferred_time) ? 'New Booking Request' : 'New Enquiry Request' }}</h2>
        </div>

        <div class="content">
            <div class="field">
                <div class="label">Name</div>
                <div class="value">{{ $booking->name }}</div>
            </div>

            <div class="field">
                <div class="label">Email</div>
                <div class="value">{{ $booking->email }}</div>
            </div>

            <div class="field">
                <div class="label">Phone</div>
                <div class="value">{{ $booking->phone ?? 'Not provided' }}</div>
            </div>

            <div class="field">
                <div class="label">Service</div>
                <div class="value">{{ $booking->service_selected ?? $booking->subject ?? 'General Inquiry' }}</div>
            </div>

            @if($booking->preferred_date)
            <div class="field">
                <div class="label">Preferred Date</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('l, d M Y') }}</div>
            </div>
            @endif

            @if($booking->preferred_time)
            <div class="field">
                <div class="label">Preferred Time</div>
                <div class="value">{{ $booking->preferred_time }}</div>
            </div>
            @endif

            <div class="divider"></div>

            <div class="field">
                <div class="label">Message / Notes</div>
                <div class="value">{{ $booking->message ?? 'No additional notes' }}</div>
            </div>

            <div class="divider"></div>

            <div class="field">
                <div class="label">Submitted At</div>
                <div class="value">{{ $booking->created_at->format('M d, Y h:i A') }}</div>
            </div>
        </div>

        @if(!empty($gcalLink))
        <div class="action-box">
            <h3>📅 Add to Your Calendar</h3>
            <p>Save this session to your calendar.</p>
            <div class="btn-row">
                <a href="{{ $gcalLink }}" class="gcal-btn">➕ Add to Google Calendar</a>
            </div>
            <span class="gcal-hint">Or open the <strong>consultation.ics</strong> attachment to add to any calendar.</span>
        </div>
        @endif

        <div class="footer">
            <p>This is an automated booking notification from Jiva Birth &amp; Beyond</p>
        </div>
    </div>
</body>
</html>
