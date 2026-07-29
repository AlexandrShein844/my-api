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

            dd([
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'username' => config('mail.mailers.smtp.username'),
                'owner' => config('mail.owner'),
            ]);

            Mail::to(config('mail.owner'))
                ->send(new ContactReceivedMail($contact));

            Mail::to($contact->email)
                ->send(new ContactConfirmationMail($contact));


            Log::info('Contact emails sent', [
                'contact_id' => $contact->id,
                'email' => $contact->email,
            ]);
        } catch (\Throwable $exception) {

            Log::error('Failed to send contact emails', [
                'contact_id' => $contact->id,
                'email' => $contact->email,
                'error' => $exception->getMessage(),
            ]);
            throw $exception;
        }
    }
}
