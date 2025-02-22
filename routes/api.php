<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// /api/
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::group(['prefix' => 'auth'], function () {
    // /api/auth/login
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'api'], function () {
        Route::controller(AuthController::class)->group(function () {
            // /api/auth/logout
            Route::post('logout', 'logout');
            // /api/auth/refresh
            Route::post('refresh', 'refresh');
            // /api/auth/me
            Route::post('me', 'me');
        });
    });
});

// /api/webhook
Route::get('/webhook', [WebhookController::class, "handle"])->name('api.webhook');
