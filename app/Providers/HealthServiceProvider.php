<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\BackupsCheck;
// use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;

use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
use Spatie\Health\Checks\Checks\DatabaseTableSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\FlareErrorOccurrenceCountCheck;
use Spatie\Health\Checks\Checks\HorizonCheck;
use Spatie\Health\Checks\Checks\MeiliSearchCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\RedisMemoryUsageCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class HealthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        Health::checks([

            BackupsCheck::new()->locatedAt(globPath: storage_path(path: config('backup.backup.name'))),
            DatabaseTableSizeCheck::new(),
            // MeiliSearchCheck::new(),
            // RedisMemoryUsageCheck::new(),

            CacheCheck::new(),
            DebugModeCheck::new(),
            OptimizedAppCheck::new(),
            ScheduleCheck::new(),

            DatabaseCheck::new(),
            EnvironmentCheck::new(),
            PingCheck::new()->url(config('app.url')),
            UsedDiskSpaceCheck::new(),

            DatabaseConnectionCountCheck::new(),
            // FlareErrorOccurrenceCountCheck::new(),
            QueueCheck::new(),

            DatabaseSizeCheck::new(),
            // HorizonCheck::new(),
            // RedisCheck::new(),
        ]);
    }
}
