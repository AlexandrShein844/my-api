<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
  schema: "ValidationErrorResponse",
  type: "object"
)]
class ValidationErrorResponse
{
  #[OA\Property(
    example: "Validation failed"
  )]
  public string $message;

  #[OA\Property(
    type: "object",
    example: [
      "name" => [
        "Имя обязательно для заполнения"
      ],
      "email" => [
        "Некорректный формат email"
      ],
      "comment" => [
        "Комментарий обязателен"
      ]
    ]
  )]
  public object $errors;
}
