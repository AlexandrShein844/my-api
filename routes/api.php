<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\MetricsController;

Route::get('/health', [HealthController::class, 'index']);

Route::post('/contact', [
  ContactController::class,
  'store'
])->middleware('contact.limit');

Route::get(
    '/metrics',
    [MetricsController::class, 'index']
);

Route::get('/test-error', function () {
    throw new Exception('Test exception');
});

Route::get('/mail-config', function () {
    return config('mail');
});

Route::get('/smtp', function () {
    $fp = @fsockopen('smtp.yandex.ru', 587, $errno, $errstr, 10);

    return [
        'connected' => (bool)$fp,
        'errno' => $errno,
        'errstr' => $errstr,
    ];
});

Route::get('/dns-test', function () {
    return response()->json([
        'host' => 'smtp.yandex.ru',
        'ip' => gethostbyname('smtp.yandex.ru'),
    ]);
});

Route::get('/google-test', function () {
    $fp = @fsockopen('google.com', 443, $errno, $errstr, 10);

    return response()->json([
        'connected' => (bool) $fp,
        'errno' => $errno,
        'errstr' => $errstr,
    ]);
});

Route::get('/gmail-test', function () {
    $fp = @fsockopen('smtp.gmail.com', 587, $errno, $errstr, 10);

    return response()->json([
        'connected' => (bool) $fp,
        'errno' => $errno,
        'errstr' => $errstr,
    ]);
});

Route::get('/resend-test', function () {
    $fp = @fsockopen('api.resend.com', 443, $errno, $errstr, 10);

    return [
        'connected' => (bool) $fp,
        'errno' => $errno,
        'errstr' => $errstr,
    ];
});

use Illuminate\Support\Facades\Mail;

Route::get('/send-test', function () {
    try {
        Mail::raw('Test from Resend', function ($message) {
            $message->to('Al3xandrShein@yandex.ru')
                    ->subject('Resend Test');
        });

        return ['success' => true];
    } catch (\Throwable $e) {
        return [
            'success' => false,
            'class' => get_class($e),
            'message' => $e->getMessage(),
            'previous' => $e->getPrevious()?->getMessage(),
        ];
    }
});