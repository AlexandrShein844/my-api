<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HealthController;

Route::get('/v1/health', [HealthController::class, 'index']);