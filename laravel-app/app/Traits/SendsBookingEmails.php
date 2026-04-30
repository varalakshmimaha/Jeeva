<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait SendsBookingEmails
{
    private function buildIcs($booking): string
    {
        if (!$booking->preferred_date || !$booking->preferred_time) {
            return '';
        }

        try {
            $dateStr = Carbon::parse($booking->preferred_date)->format('Y-m-d');
            $timeStr = date('H:i', strtotime($booking->preferred_time));
            $start   = Carbon::parse($dateStr . ' ' . $timeStr);
            $end     = $start->copy()->addMinutes(30);

            $service     = $booking->service_selected ?? 'Consultation';
            $description = "Service: {$service}\\nClient: {$booking->name}\\n";

            return implode("\r\n", [
                'BEGIN:VCALENDAR',
                'VERSION:2.0',
                'PRODID:-//Jiva Birth and Beyond//Booking//EN',
                'CALSCALE:GREGORIAN',
                'METHOD:REQUEST',
                'BEGIN:VEVENT',
                'DTSTART:' . $start->format('Ymd\THis'),
                'DTEND:'   . $end->format('Ymd\THis'),
                'DTSTAMP:' . now()->format('Ymd\THis\Z'),
                'UID:' . uniqid('jiva-', true) . '@jivabirthandbeyond.com',
                'SUMMARY:Consultation with Jiva Birth & Beyond',
                "DESCRIPTION:{$description}",
                'LOCATION:Online Consultation',
                'STATUS:CONFIRMED',
                'END:VEVENT',
                'END:VCALENDAR',
            ]);
        } catch (\Exception $e) {
            return '';
        }
    }

    private function buildGcalLink($booking): string
    {
        if (!$booking->preferred_date || !$booking->preferred_time) {
            return '';
        }

        try {
            $dateStr = Carbon::parse($booking->preferred_date)->format('Y-m-d');
            $timeStr = date('H:i', strtotime($booking->preferred_time));
            $start   = Carbon::parse($dateStr . ' ' . $timeStr);
            $end     = $start->copy()->addMinutes(30);

            $service = $booking->service_selected ?? 'Consultation';

            return 'https://calendar.google.com/calendar/render?' . http_build_query([
                'action'   => 'TEMPLATE',
                'text'     => 'Consultation with Jiva Birth & Beyond',
                'dates'    => $start->format('Ymd\THis') . '/' . $end->format('Ymd\THis'),
                'details'  => "Service: {$service}",
                'location' => 'Online Consultation',
            ]);
        } catch (\Exception $e) {
            return '';
        }
    }

    private function sendBookingEmail($booking): void
    {
        $adminEmail = \App\Models\SiteSetting::where('key', 'company_email')->value('value')
                      ?: config('mail.from.address')
                      ?: 'noreply@jivabirthandbeyond.com';
        $icsContent = $this->buildIcs($booking);
        $gcalLink   = $this->buildGcalLink($booking);

        try {
            $isBooking = $booking->preferred_date && $booking->preferred_time;
            $subjectPrefix = $isBooking ? 'New Booking Request: ' : 'New Enquiry Request: ';

            Mail::send('emails.booking-notification', [
                'booking'  => $booking,
                'gcalLink' => $gcalLink,
            ], function ($message) use ($adminEmail, $booking, $icsContent, $subjectPrefix) {
                $message->to($adminEmail)
                        ->subject($subjectPrefix . ($booking->service_selected ?? $booking->subject ?? 'Contact Message'));
                if ($icsContent) {
                    $message->attachData($icsContent, 'consultation.ics', ['mime' => 'text/calendar']);
                }
            });
        } catch (\Exception $e) {
            Log::error('Failed to send booking email: ' . $e->getMessage());
        }
    }

    private function sendConfirmationEmail($booking): void
    {
        if (empty($booking->email)) {
            return;
        }

        $icsContent = $this->buildIcs($booking);
        $gcalLink   = $this->buildGcalLink($booking);

        try {
            Mail::send('emails.booking-confirmation', [
                'booking'  => $booking,
                'gcalLink' => $gcalLink,
            ], function ($message) use ($booking, $icsContent) {
                $message->to($booking->email, $booking->name)
                        ->subject('Your consultation booking with Jiva Birth & Beyond');
                if ($icsContent) {
                    $message->attachData($icsContent, 'consultation.ics', ['mime' => 'text/calendar']);
                }
            });
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation email: ' . $e->getMessage());
        }
    }

    private function sendEnquiryAutoReply($booking): void
    {
        if (empty($booking->email)) {
            return;
        }

        try {
            Mail::send('emails.enquiry-auto-reply', [
                'booking' => $booking,
            ], function ($message) use ($booking) {
                $message->to($booking->email, $booking->name)
                        ->subject("We've Received Your Enquiry");
            });
        } catch (\Exception $e) {
            Log::error('Failed to send enquiry auto-reply: ' . $e->getMessage());
        }
    }
}
