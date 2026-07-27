<?php

namespace App\Services\Mail;

use App\Mail\ContactConfirmationMail;
use App\Mail\ContactReceivedMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactMailService
{
public function send(Contact $contact): void
{
    try {
        Mail::to(config('mail.owner'))
            ->send(new ContactReceivedMail($contact));

        Mail::to($contact->email)
            ->send(new ContactConfirmationMail($contact));

    } catch (\Throwable $exception) {

        Log::error('Failed to send contact emails', [
            'contact_id' => $contact->id,
            'email' => $contact->email,
            'error' => $exception->getMessage(),
        ]);
    }
}
}