<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function store(ContactRequest $request): JsonResponse
    {
        $contact = $this->contactService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Contact request created',
            'data' => [
                'id' => $contact->id
            ]
        ], 201);
    }
}