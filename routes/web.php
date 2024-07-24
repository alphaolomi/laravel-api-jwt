<?php

use App\Http\Controllers\MyWelcomeController;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckJsonResultsController;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;
use Spatie\WelcomeNotification\WelcomesNewUsers;

Route::get('/', function () {
    response()->noContent();
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
});

Route::get('healthy', HealthCheckResultsController::class)->name('hwelcome');
Route::get('healthj', HealthCheckJsonResultsController::class)->name('jwelcome');
