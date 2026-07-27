<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "RateLimitErrorResponse",
    type: "object"
)]
class RateLimitErrorResponse
{
    #[OA\Property(
        example: "Too many requests from this email"
    )]
    public string $message;
}