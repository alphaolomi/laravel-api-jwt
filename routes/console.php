<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// ...


   //
        // $schedule->command('backup:clean')->timezone('Africa/Dar_es_salaam')->everyTwoMinutes();

// $schedule->call(function () {
//             // DB::table('recent_users')->delete();
//             logger('test schedule: ' . time());
//         })->timezone('Africa/Dar_es_salaam')->everySecond();
//         // $schedule->command('backup:clean')->timezone('Africa/Dar_es_salaam')->everyTwoMinutes();

// $schedule->command('backup:run')->timezone('Africa/Dar_es_salaam')->everyTwoMinutes()
//             ->onFailure(function () {
//                 // ...
//             })
//             ->onSuccess(function () {
//                 // ...
//             });
