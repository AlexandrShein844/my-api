<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\MetricsController;

Route::get('/v1/health', [HealthController::class, 'index']);

Route::post('/v1/contact', [
  ContactController::class,
  'store'
])->middleware('contact.limit');

Route::get(
    '/v1/metrics',
    [MetricsController::class, 'index']
);

Route::get('/test-error', function () {
    throw new Exception('Test exception');
});
