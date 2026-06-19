<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Traits\SendsBookingEmails;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use SendsBookingEmails;

    private function adminTimezone(): string
    {
        return \App\Models\SiteSetting::where('key', 'admin_timezone')->value('value') ?: config('app.timezone', 'UTC');
    }

    private function phoneAlreadySubmittedToday(string $phone): bool
    {
        $digits = preg_replace('/\D/', '', $phone);
        if (strlen($digits) < 5) return false;

        return ContactMessage::whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(phone, ' ', ''), '-', ''), '(', ''), ')', '') LIKE ?", [
                '%' . $digits . '%'
            ])
            ->where('created_at', '>=', now()->subDay())
            ->exists();
    }

    public function store(Request $request)
    {
        // Honeypot: bots fill this hidden field, real users never see it
        if ($request->filled('website')) {
            return redirect()->back()
                ->with('success', 'Thank you! Your message has been submitted.')
                ->with('success_kind', 'enquiry');
        }

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'country_code'      => 'nullable|string|max:6',
            'phone'             => 'nullable|string|max:20',
            'subject'           => 'nullable|string|max:255',
            'message'           => 'nullable|string|max:1000',
            'preferred_date'    => 'nullable|date',
            'preferred_time'    => 'nullable|string|max:100',
            'service_selected'  => 'nullable|string|max:255',
            'calendly_event_uri'=> 'nullable|string|max:500',
        ]);

        if (!empty($validated['phone']) && !empty($validated['country_code'])) {
            $validated['phone'] = trim($validated['country_code']) . ' ' . trim($validated['phone']);
        }
        unset($validated['country_code']);

        // Block same phone number more than once per day
        if (!empty($validated['phone']) && $this->phoneAlreadySubmittedToday($validated['phone'])) {
            return redirect()->back()
                ->with('success', 'Thank you! Your message has been submitted.')
                ->with('success_kind', 'enquiry');
        }

        // Duplicate: same email + same message within 5 minutes
        if ($request->input('email') && $request->input('message')) {
            $isDuplicate = ContactMessage::where('email', $request->input('email'))
                ->where('message', $request->input('message'))
                ->where('created_at', '>=', now()->subMinutes(5))
                ->exists();

            if ($isDuplicate) {
                return redirect()->back()
                    ->with('success', 'Thank you! Your message has been submitted.')
                    ->with('success_kind', 'enquiry');
            }
        }

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
                            $dt = \Carbon\Carbon::parse($startTime)->setTimezone($this->adminTimezone());
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

        $hasSlot = !empty($validated['preferred_date']) && !empty($validated['preferred_time']);

        if ($hasSlot) {
            $this->sendConfirmationEmail($booking);
        } else {
            $this->sendEnquiryAutoReply($booking);
        }

        $isBooking = $hasSlot || !empty($validated['service_selected']);
        $successMessage = $isBooking
            ? 'Thank you! Your request has been submitted successfully.'
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

        $token = \App\Models\SiteSetting::where('key', 'calendly_token')->value('value')
            ?: env('CALENDLY_TOKEN');
        if (!$token) {
            \Log::warning('calendlyEventTime: no token configured (set CALENDLY_TOKEN in .env)');
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

        $dt = \Carbon\Carbon::parse($startTime)->setTimezone($this->adminTimezone());

        return response()->json([
            'date'  => $dt->format('Y-m-d'),
            'time'  => $dt->format('h:i A'),
            'label' => $dt->format('l, d M Y') . ' at ' . $dt->format('h:i A'),
        ]);
    }

    public function submit(Request $request)
    {
        // Honeypot check
        if ($request->filled('website')) {
            return redirect(route('contact') . '#book')->with('success', '✓ Thank you! We\'ll be in touch shortly.');
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'country_code'=> 'required|string|max:20',
            'phone'       => 'required|string|max:20',
            'datetime'    => 'nullable|string',
            'notes'       => 'nullable|string|max:1000',
        ]);

        $phone = trim($validated['country_code']) . ' ' . trim($validated['phone']);

        // Block same phone number more than once per day
        if ($this->phoneAlreadySubmittedToday($phone)) {
            return redirect(route('contact') . '#book')->with('success', '✓ Thank you! We\'ll be in touch shortly.');
        }

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
