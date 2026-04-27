<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'nullable|string|max:6',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
            'preferred_date' => 'nullable|date',
            'preferred_time' => 'nullable|string|max:50',
            'service_selected' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['phone']) && !empty($validated['country_code'])) {
            $validated['phone'] = trim($validated['country_code']) . ' ' . trim($validated['phone']);
        }
        unset($validated['country_code']);

        $booking = ContactMessage::create($validated);

        $this->sendBookingEmail($booking);
        $this->sendConfirmationEmail($booking);

        $isBooking = !empty($validated['preferred_date']) || !empty($validated['preferred_time']) || !empty($validated['service_selected']);
        $successMessage = $isBooking
            ? 'Thank you! Your slot has been booked successfully.'
            : 'Thank you! Your message has been submitted. We\'ll reach out to you shortly.';
        $successKind = $isBooking ? 'booking' : 'enquiry';

        if (!empty($validated['subject']) && $validated['subject'] === 'Complimentary Consultation Booking') {
            return redirect(route('home') . '#book-appointment')
                ->with('success', $successMessage)
                ->with('success_kind', $successKind);
        }

        return redirect()->back()
            ->with('success', $successMessage)
            ->with('success_kind', $successKind);
    }

    private function getZoomLink(): string
    {
        return \App\Models\SiteSetting::where('key', 'zoom_link')->value('value') ?? '';
    }

    private function buildIcs($booking, string $zoomLink): string
    {
        if (!$booking->preferred_date || !$booking->preferred_time) {
            return '';
        }

        try {
            $dateStr  = \Carbon\Carbon::parse($booking->preferred_date)->format('Y-m-d');
            $timeStr  = date('H:i', strtotime($booking->preferred_time));
            $start    = \Carbon\Carbon::parse($dateStr . ' ' . $timeStr);
            $end      = $start->copy()->addMinutes(30);

            $dtStart  = $start->format('Ymd\THis');
            $dtEnd    = $end->format('Ymd\THis');
            $dtStamp  = now()->format('Ymd\THis\Z');
            $uid      = uniqid('jiva-', true) . '@jivabirthandbeyond.com';

            $title    = 'Consultation with Jiva Birth & Beyond';
            $service  = $booking->service_selected ?? 'Consultation';
            $location = $zoomLink ?: 'Zoom Meeting';

            $description = "Service: {$service}\\n";
            $description .= "Client: {$booking->name}\\n";
            if ($zoomLink) {
                $description .= "Join Zoom: {$zoomLink}\\n";
            }

            return implode("\r\n", [
                'BEGIN:VCALENDAR',
                'VERSION:2.0',
                'PRODID:-//Jiva Birth and Beyond//Booking//EN',
                'CALSCALE:GREGORIAN',
                'METHOD:REQUEST',
                'BEGIN:VEVENT',
                "DTSTART:{$dtStart}",
                "DTEND:{$dtEnd}",
                "DTSTAMP:{$dtStamp}",
                "UID:{$uid}",
                "SUMMARY:{$title}",
                "DESCRIPTION:{$description}",
                "LOCATION:{$location}",
                'STATUS:CONFIRMED',
                'END:VEVENT',
                'END:VCALENDAR',
            ]);
        } catch (\Exception $e) {
            return '';
        }
    }

    private function buildGcalLink($booking, string $zoomLink): string
    {
        if (!$booking->preferred_date || !$booking->preferred_time) {
            return '';
        }

        try {
            $dateStr = \Carbon\Carbon::parse($booking->preferred_date)->format('Y-m-d');
            $timeStr = date('H:i', strtotime($booking->preferred_time));
            $start   = \Carbon\Carbon::parse($dateStr . ' ' . $timeStr);
            $end     = $start->copy()->addMinutes(30);

            $service = $booking->service_selected ?? 'Consultation';
            $details = "Service: {$service}";
            if ($zoomLink) {
                $details .= "\nJoin Zoom: {$zoomLink}";
            }

            return 'https://calendar.google.com/calendar/render?' . http_build_query([
                'action'   => 'TEMPLATE',
                'text'     => 'Consultation with Jiva Birth & Beyond',
                'dates'    => $start->format('Ymd\THis') . '/' . $end->format('Ymd\THis'),
                'details'  => $details,
                'location' => $zoomLink ?: 'Zoom Meeting',
            ]);
        } catch (\Exception $e) {
            return '';
        }
    }

    private function sendBookingEmail($booking)
    {
        $adminEmail = \App\Models\SiteSetting::where('key', 'company_email')->value('value')
                      ?: config('mail.from.address')
                      ?: 'noreply@jivabirthandbeyond.com';
        $zoomLink   = $this->getZoomLink();
        $icsContent = $this->buildIcs($booking, $zoomLink);
        $gcalLink   = $this->buildGcalLink($booking, $zoomLink);

        try {
            Mail::send('emails.booking-notification', [
                'booking'  => $booking,
                'zoomLink' => $zoomLink,
                'gcalLink' => $gcalLink,
            ], function ($message) use ($adminEmail, $booking, $icsContent) {
                $message->to($adminEmail)
                        ->subject('New Booking Request: ' . ($booking->service_selected ?? $booking->subject ?? 'Contact Message'));
                if ($icsContent) {
                    $message->attachData(
                        $icsContent,
                        'consultation.ics',
                        ['mime' => 'text/calendar']
                    );
                }
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send booking email: ' . $e->getMessage());
        }
    }

    private function sendConfirmationEmail($booking)
    {
        if (empty($booking->email)) {
            return;
        }

        $zoomLink   = $this->getZoomLink();
        $icsContent = $this->buildIcs($booking, $zoomLink);
        $gcalLink   = $this->buildGcalLink($booking, $zoomLink);

        try {
            Mail::send('emails.booking-confirmation', [
                'booking'  => $booking,
                'zoomLink' => $zoomLink,
                'gcalLink' => $gcalLink,
            ], function ($message) use ($booking, $icsContent) {
                $message->to($booking->email, $booking->name)
                        ->subject('Your consultation booking with Jiva Birth & Beyond');
                if ($icsContent) {
                    $message->attachData(
                        $icsContent,
                        'consultation.ics',
                        ['mime' => 'text/calendar']
                    );
                }
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send confirmation email: ' . $e->getMessage());
        }
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'country_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'datetime' => 'nullable|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        $phone = trim($validated['country_code']) . ' ' . trim($validated['phone']);

        $message = 'Consultation Booking Request';
        if (!empty($validated['datetime'])) {
            $message .= "\nPreferred Date/Time: " . $validated['datetime'];
        }
        if (!empty($validated['notes'])) {
            $message .= "\nNotes: " . $validated['notes'];
        }

        ContactMessage::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $phone,
            'subject' => 'Consultation Booking',
            'message' => $message,
        ]);

        return redirect(route('contact') . '#book')->with('success', '✓ Thank you! We\'ll be in touch shortly.');
    }
}
