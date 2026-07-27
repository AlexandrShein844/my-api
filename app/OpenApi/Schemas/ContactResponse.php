<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ContactResponse"
)]
class ContactResponse
{
    #[OA\Property(
        example: true
    )]
    public bool $success;

    #[OA\Property(
        example: "Contact request created"
    )]
    public string $message;

    #[OA\Property(
        type: "object"
    )]
    public object $data;
}