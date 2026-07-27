<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function create(array $data): Contact
    {
        $contact = Contact::create($data);

        Log::info('New contact request created', [
            'contact_id' => $contact->id,
            'email' => $contact->email,
        ]);

        return $contact;
    }
}