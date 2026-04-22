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
        ]);

        if (!empty($validated['phone']) && !empty($validated['country_code'])) {
            $validated['phone'] = trim($validated['country_code']) . ' ' . trim($validated['phone']);
        }
        unset($validated['country_code']);

        $booking = ContactMessage::create($validated);

        /* Send email notification to admin */
        $this->sendBookingEmail($booking);

        if (!empty($validated['subject']) && $validated['subject'] === 'Complimentary Consultation Booking') {
            return redirect(route('home') . '#book-appointment')->with('success', '✓ Thank you! We\'ll be in touch shortly.');
        }

        return redirect()->back()->with('success', '✓ Thank you! We\'ll be in touch shortly.');
    }

    private function sendBookingEmail($booking)
    {
        $adminEmail = config('mail.from.address') ?? 'noreply@jivabirthandbeyond.com';

        try {
            Mail::send('emails.booking-notification', ['booking' => $booking], function ($message) use ($adminEmail) {
                $message->to($adminEmail)
                        ->subject('New Booking Request: ' . ($booking->subject ?? 'Contact Message'));
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send booking email: ' . $e->getMessage());
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
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $phone,
            'subject' => 'Consultation Booking',
            'message' => $message,
        ]);

        return redirect(route('contact') . '#book')->with('success', '✓ Thank you! We\'ll be in touch shortly.');
    }
}
