<?php

use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\MyWelcomeController;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;
use Spatie\Health\Http\Controllers\HealthCheckJsonResultsController;

Route::get('/', function () {
    response()->noContent();
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
});


Route::get('healthy', HealthCheckResultsController::class)->name('hwelcome');
Route::get('healthj', HealthCheckJsonResultsController::class)->name('jwelcome');
