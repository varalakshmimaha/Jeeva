<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

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

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Thank you! We received your message.');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'country_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'datetime' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        $phone = trim($validated['country_code']) . ' ' . trim($validated['phone']);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $phone,
            'subject' => 'Consultation Booking',
            'message' => 'Preferred Date/Time: ' . $validated['datetime'] . "\n\nNotes: " . ($validated['notes'] ?? 'No additional notes'),
        ]);

        return redirect()->back()->with('success', 'Consultation booking submitted! We will contact you shortly.');
    }
}
