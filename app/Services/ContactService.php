<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use App\Services\Mail\ContactMailService;
use App\Services\AI\AiService;

class ContactService
{
    public function __construct(
        private ContactMailService $mailService,
        private AiService $aiService
    ) {}

    public function create(array $data): Contact
    {
        $key = 'contact-email:' . $data['email'];

        if (RateLimiter::tooManyAttempts($key, 3)) {
            abort(response()->json([
                'message' => 'Too many requests from this email'
            ], 429));
        }

        RateLimiter::hit($key, 60);


        $aiResult = $this->aiService->analyze(
            $data['comment']
        );

        $contact = Contact::create([
            ...$data,
            'ai_sentiment' => $aiResult['sentiment'],
            'ai_response' => $aiResult['response'],
        ]);

        Log::info('New contact request created', [
            'contact_id' => $contact->id,
            'email' => $contact->email,
            'sentiment' => $contact->ai_sentiment,
        ]);

        $this->mailService->send($contact);

        return $contact;
    }
}
