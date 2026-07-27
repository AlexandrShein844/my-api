<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;

use OpenApi\Attributes as OA;
use App\OpenApi\Schemas\ContactResponse;
use App\OpenApi\Schemas\ValidationErrorResponse;
use App\OpenApi\Schemas\RateLimitErrorResponse;


class ContactController extends Controller
{
    #[OA\Post(
        path: "/api/v1/contact",
        summary: "Create contact request",
        tags: ["Contact"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    "name",
                    "email",
                    "comment"
                ],
                properties: [
                    new OA\Property(
                        property: "name",
                        description: "User name",
                        type: "string",
                        example: "Александр"
                    ),
                    new OA\Property(
                        property: "phone",
                        description: "Phone number",
                        type: "string",
                        example: "+79999999999"
                    ),
                    new OA\Property(
                        property: "email",
                        description: "User email",
                        type: "string",
                        example: "test@example.com"
                    ),
                    new OA\Property(
                        property: "comment",
                        description: "Message text",
                        type: "string",
                        example: "Хочу заказать разработку сайта"
                    ),
                ]
            )
        ),
        responses: [
new OA\Response(
    response: 201,
    description: "Contact created",
    content: new OA\JsonContent(
        ref: "#/components/schemas/ContactResponse"
    )
),
            new OA\Response(
                response: 422,
                description: "Validation error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ValidationErrorResponse"
                )
            ),
            new OA\Response(
                response: 429,
                description: "Too many requests",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/RateLimitErrorResponse"
                )
            )
        ]
    )]

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
