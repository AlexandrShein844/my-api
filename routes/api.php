<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\ContactController;

Route::get('/v1/health', [HealthController::class, 'index']);

Route::post('/v1/contact', [
  ContactController::class,
  'store'
])->middleware('contact.limit');

Route::get('/test-error', function () {
    throw new Exception('Test exception');
});
