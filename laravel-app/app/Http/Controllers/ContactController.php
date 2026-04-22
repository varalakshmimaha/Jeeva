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
            'preferred_time' => 'nullable|string|max:20',
            'service_selected' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['phone']) && !empty($validated['country_code'])) {
            $validated['phone'] = trim($validated['country_code']) . ' ' . trim($validated['phone']);
        }
        unset($validated['country_code']);

        if (!empty($validated['preferred_date']) && !empty($validated['preferred_time'])) {
            $taken = ContactMessage::whereDate('preferred_date', $validated['preferred_date'])
                ->where('preferred_time', $validated['preferred_time'])
                ->exists();
            if ($taken) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['preferred_time' => 'Sorry, that slot was just booked. Please pick another time.']);
            }
        }

        if (!empty($validated['phone']) && !empty($validated['preferred_date'])) {
            $normalizedPhone = preg_replace('/\D+/', '', $validated['phone']);

            $duplicatePhone = ContactMessage::whereNotNull('phone')
                ->whereDate('preferred_date', $validated['preferred_date'])
                ->get()
                ->first(function ($m) use ($normalizedPhone) {
                    return preg_replace('/\D+/', '', (string) $m->phone) === $normalizedPhone;
                });

            if ($duplicatePhone) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['phone' => 'This phone number already has a booking for the selected date. Only one booking per day is allowed. Please pick a different date or contact us if you need to reschedule.']);
            }
        }

        $booking = ContactMessage::create($validated);

        /* Send email notification to admin + confirmation to user */
        $this->sendBookingEmail($booking);
        $this->sendConfirmationEmail($booking);

        if (!empty($validated['subject']) && $validated['subject'] === 'Complimentary Consultation Booking') {
            return redirect(route('home') . '#book-appointment')->with('success', 'Thank you! Your slot has been booked successfully.');
        }

        return redirect()->back()->with('success', 'Thank you! Your slot has been booked successfully.');
    }

    private function sendBookingEmail($booking)
    {
        $adminEmail = config('mail.from.address') ?? 'noreply@jivabirthandbeyond.com';

        try {
            Mail::send('emails.booking-notification', ['booking' => $booking], function ($message) use ($adminEmail) {
                $message->to($adminEmail)
                        ->subject('New Booking Request: ' . ($booking->service_selected ?? $booking->subject ?? 'Contact Message'));
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

        try {
            Mail::send('emails.booking-confirmation', ['booking' => $booking], function ($message) use ($booking) {
                $message->to($booking->email, $booking->name)
                        ->subject('Your consultation booking with Jiva Birth & Beyond');
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
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $phone,
            'subject' => 'Consultation Booking',
            'message' => $message,
        ]);

        return redirect(route('contact') . '#book')->with('success', '✓ Thank you! We\'ll be in touch shortly.');
    }
}
