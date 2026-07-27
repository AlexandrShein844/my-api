<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class ContactService
{
public function create(array $data): Contact
{
    $key = 'contact-email:' . $data['email'];

    if (RateLimiter::tooManyAttempts($key, 3)) {
        abort(response()->json([
            'message' => 'Too many requests from this email'
        ], 429));
    }

    RateLimiter::hit($key, 60);

    $contact = Contact::create($data);

    Log::info('New contact request created', [
        'contact_id' => $contact->id,
        'email' => $contact->email,
    ]);

    return $contact;
}
}