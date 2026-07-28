<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "MetricsResponse"
)]
class MetricsResponse
{
    #[OA\Property(
        example: true
    )]
    public bool $success;


    #[OA\Property(
        example: "Success"
    )]
    public string $message;


    #[OA\Property(
        type: "object",
        properties: [
            new OA\Property(
                property: "total_contacts",
                type: "integer",
                example: 32
            ),

            new OA\Property(
                property: "today_contacts",
                type: "integer",
                example: 5
            ),

            new OA\Property(
                property: "sentiment",
                type: "object",
                properties: [
                    new OA\Property(
                        property: "positive",
                        type: "integer",
                        example: 10
                    ),

                    new OA\Property(
                        property: "neutral",
                        type: "integer",
                        example: 15
                    ),

                    new OA\Property(
                        property: "negative",
                        type: "integer",
                        example: 2
                    ),

                    new OA\Property(
                        property: "unknown",
                        type: "integer",
                        example: 5
                    ),
                ]
            )
        ]
    )]
    public object $data;
}