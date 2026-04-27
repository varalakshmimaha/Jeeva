<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Traits\SendsBookingEmails;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use SendsBookingEmails;
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
            'preferred_time' => 'nullable|string|max:100',
            'service_selected' => 'nullable|string|max:255',
            'calendly_event_uri' => 'nullable|string|max:500',
        ]);

        if (!empty($validated['phone']) && !empty($validated['country_code'])) {
            $validated['phone'] = trim($validated['country_code']) . ' ' . trim($validated['phone']);
        }
        unset($validated['country_code']);

        $eventUri = $validated['calendly_event_uri'] ?? '';
        unset($validated['calendly_event_uri']);

        if ($eventUri && (!empty($validated['preferred_time'])) && str_contains(strtolower($validated['preferred_time']), 'calendly')) {
            try {
                $token = \App\Models\SiteSetting::where('key', 'calendly_token')->value('value');
                if ($token) {
                    $uuid = basename(parse_url($eventUri, PHP_URL_PATH));
                    $resp = \Illuminate\Support\Facades\Http::withToken($token)
                        ->get("https://api.calendly.com/scheduled_events/{$uuid}");
                    if ($resp->successful()) {
                        $startTime = $resp->json('resource.start_time');
                        if ($startTime) {
                            $dt = \Carbon\Carbon::parse($startTime)->setTimezone('Asia/Kolkata');
                            $validated['preferred_date'] = $dt->format('Y-m-d');
                            $validated['preferred_time'] = $dt->format('h:i A');
                        }
                    }
                }
            } catch (\Exception $e) {
                \Log::warning('Could not resolve Calendly slot time at store: ' . $e->getMessage());
            }
        }

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

    public function calendlyEventTime(Request $request)
    {
        $eventUri = trim($request->query('event_uri', ''));
        if (!$eventUri) {
            return response()->json(['error' => 'missing uri'], 400);
        }

        $token = \App\Models\SiteSetting::where('key', 'calendly_token')->value('value');
        if (!$token) {
            \Log::warning('calendlyEventTime: no token in site_settings');
            return response()->json(['error' => 'no token'], 400);
        }

        $uuid     = basename(parse_url($eventUri, PHP_URL_PATH));
        $response = \Illuminate\Support\Facades\Http::withToken($token)
            ->get("https://api.calendly.com/scheduled_events/{$uuid}");

        if (!$response->successful()) {
            \Log::warning('calendlyEventTime: API error ' . $response->status() . ' — ' . $response->body());
            return response()->json(['error' => 'api error', 'status' => $response->status()], 400);
        }

        $startTime = $response->json('resource.start_time');
        if (!$startTime) {
            \Log::warning('calendlyEventTime: no start_time in response — ' . $response->body());
            return response()->json(['error' => 'no start_time'], 400);
        }

        $dt = \Carbon\Carbon::parse($startTime)->setTimezone('Asia/Kolkata');

        return response()->json([
            'date'  => $dt->format('Y-m-d'),
            'time'  => $dt->format('h:i A'),
            'label' => $dt->format('l, d M Y') . ' at ' . $dt->format('h:i A'),
        ]);
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
