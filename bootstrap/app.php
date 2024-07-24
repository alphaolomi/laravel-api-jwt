<?php

use App\Jobs\CallWebhook;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // laravel-http-logger
        $middleware->append(
            \Spatie\HttpLogger\Middlewares\HttpLogger::class
        );

        // $middleware->web(prepend: [
        // \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        // ]);

        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
        ]);

        //
    })
    ->withSchedule(function (Schedule $schedule) {
        //
        // $schedule->command('backup:clean')->timezone('Africa/Dar_es_salaam')->everyTwoMinutes();

        $schedule->command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->everyMinute();

        $schedule->call(function () {
            // DB::table('recent_users')->delete();
            // logger('test schedule: ' . time());
            // dispatch_sync(new CallWebhook);
        })->timezone('Africa/Dar_es_salaam')->everySecond();
        // $schedule->command('backup:clean')->timezone('Africa/Dar_es_salaam')->everyTwoMinutes();
        $schedule->command('backup:run')->timezone('Africa/Dar_es_salaam')->everyTwoMinutes()
            ->onFailure(function () {
                // ...
            })
            ->onSuccess(function () {
                // ...
            });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'code' => $e->getStatusCode(),
                    'message' => $e->getMessage(),
                ], 404);
            }
        });
    })->create();
