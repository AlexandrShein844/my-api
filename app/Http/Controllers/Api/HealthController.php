<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use OpenApi\Attributes as OA;

class HealthController extends Controller
{
    #[OA\Get(
        path: "/api/health",
        summary: "API health check",
        tags: ["System"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful response"
            )
        ]
    )]
    public function index()
    {
        return ApiResponse::success([
            'status' => 'ok'
        ]);
    }
}