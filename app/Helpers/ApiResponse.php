<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(
        mixed $data = null,
        string $message = 'Success'
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function error(
        string $message,
        int $code = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}