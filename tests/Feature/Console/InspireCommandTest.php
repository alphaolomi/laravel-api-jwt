<?php

// use Illuminate\Foundation\Inspiring;

test('inspire console command', function () {
    $this->artisan('inspire')
        ->assertExitCode(0);
});
// ->skip(fn () => class_exists(Inspiring::class));
