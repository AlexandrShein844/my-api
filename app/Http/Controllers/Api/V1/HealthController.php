<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;

class HealthController extends Controller
{
    public function index()
    {
        return ApiResponse::success([
            'status' => 'ok'
        ]);
    }
}
