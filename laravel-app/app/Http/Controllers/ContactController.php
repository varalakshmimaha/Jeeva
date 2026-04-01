<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:1000',
        ]);

        // In a real app, you would save this to database or send email
        // For now, we'll just store it in session and redirect
        
        // Example: Send email
        // Mail::send('emails.contact', $validated, function($message) use ($validated) {
        //     $message->subject('New Contact Form Submission')
        //             ->from($validated['email'])
        //             ->to('info@westerndental.com');
        // });

        // Example: Save to database
        // ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Thank you! We received your message.');
    }
}
