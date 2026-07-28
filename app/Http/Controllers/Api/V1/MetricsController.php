<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\MetricsService;
use Illuminate\Http\JsonResponse;

use OpenApi\Attributes as OA;
use App\OpenApi\Schemas\MetricsResponse;


class MetricsController extends Controller
{
    #[OA\Get(
        path: "/api/v1/metrics",
        summary: "Get API metrics",
        tags: ["Metrics"],

        responses: [
            new OA\Response(
                response: 200,
                description: "Metrics received",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/MetricsResponse"
                )
            )
        ]
    )]

    public function __construct(
        private MetricsService $metricsService
    ) {}

    public function index(): JsonResponse
    {
        return ApiResponse::success(
            $this->metricsService->get()
        );
    }
}
