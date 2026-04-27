<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Traits\SendsBookingEmails;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendlyWebhookController extends Controller
{
    use SendsBookingEmails;
    public function handle(Request $request)
    {
        $data = $request->json()->all();

        $event = $data['event'] ?? '';

        if ($event === 'invitee.created') {
            $this->saveBooking($data['payload'] ?? []);
        }

        return response()->json(['status' => 'ok']);
    }

    private function saveBooking(array $payload): void
    {
        $invitee      = $payload['invitee'] ?? [];
        $scheduledEvt = $payload['scheduled_event'] ?? $payload['event'] ?? [];

        $name      = $invitee['name'] ?? 'Calendly Booking';
        $email     = $invitee['email'] ?? '';
        $timezone  = $invitee['timezone'] ?? 'Asia/Kolkata';

        // Phone — may come from questions_and_answers
        $phone = $invitee['phone_number'] ?? '';
        if (!$phone) {
            foreach ($payload['questions_and_answers'] ?? [] as $qa) {
                $q = strtolower($qa['question'] ?? '');
                if (str_contains($q, 'phone') || str_contains($q, 'mobile') || str_contains($q, 'number')) {
                    $phone = $qa['answer'] ?? '';
                    break;
                }
            }
        }

        // Notes from questions
        $notes = '';
        foreach ($payload['questions_and_answers'] ?? [] as $qa) {
            $q = strtolower($qa['question'] ?? '');
            if (!empty($qa['answer']) && !str_contains($q, 'phone') && !str_contains($q, 'mobile') && !str_contains($q, 'number')) {
                $notes .= $qa['question'] . ': ' . $qa['answer'] . "\n";
            }
        }

        // Parse date/time
        $startRaw = $scheduledEvt['start_time'] ?? '';
        $date = null;
        $time = null;

        if ($startRaw) {
            try {
                $dt   = Carbon::parse($startRaw)->setTimezone($timezone);
                $date = $dt->format('Y-m-d');
                $time = $dt->format('h:i A');
            } catch (\Exception $e) {
                $date = substr($startRaw, 0, 10);
                $time = substr($startRaw, 11, 5);
            }
        }

        $eventTypeName = $payload['event_type']['name'] ?? 'Calendly Booking';

        $booking = ContactMessage::create([
            'name'                => $name,
            'email'               => $email,
            'phone'               => $phone ?: null,
            'subject'             => 'Calendly: ' . $eventTypeName,
            'message'             => trim($notes) ?: 'Booked via Calendly.',
            'preferred_date'      => $date,
            'preferred_time'      => $time,
            'service_selected'    => $eventTypeName,
            'is_read'             => false,
            'consultation_status' => 'pending',
        ]);

        $this->sendBookingEmail($booking);
        $this->sendConfirmationEmail($booking);
    }
}
