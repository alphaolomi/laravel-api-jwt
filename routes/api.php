<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

// /api/
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// Route::get('/auth/logout', ['middleware' => 'doNotCacheResponse', 'uses' => 'AuthController@getLogout']);

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::controller(AuthController::class)->group(function () {
        // /api/auth/login
        Route::post('login', 'login');
        // /api/auth/logout
        Route::post('logout', 'logout');
        // /api/auth/refresh
        Route::post('refresh', 'refresh');
        // /api/auth/me
        Route::post('me', 'me');
    });

    // /api/webhook
    Route::get('/webhook', [WebhookController::class, 'handle'])->name('api.webhook');

});

Route::get('users', function () {
    return \App\Models\User::all();
});

Route::get('whoop', function () {
    try {
        // Validate the value...
        $original = new RuntimeException('Whoops!');
    } catch (Throwable $e) {
        report($e);

        return response()->json(['failed' => 'bad'], 400);
    }
});




// Public facing API
// Route::group(function () {
    // Route::get('/search', [SearchController::class, 'search']);

    // Route::get('/products', [ProductController::class, "index"]);
    Route::resource('/products', ProductController::class);


    //
// });
