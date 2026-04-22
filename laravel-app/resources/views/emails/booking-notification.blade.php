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
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0; font-size: 12px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Booking Request</h2>
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
                <div class="label">Service / Subject</div>
                <div class="value">{{ $booking->subject ?? 'General Inquiry' }}</div>
            </div>

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

        <div class="footer">
            <p>This is an automated booking notification from Jiva Birth & Beyond</p>
        </div>
    </div>
</body>
</html>
