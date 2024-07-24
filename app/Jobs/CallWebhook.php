<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookServer\WebhookCall;

// TODO: fix Queue issues with this job, only sync works for now
class CallWebhook implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('WebhookCall: '.__CLASS__);
        WebhookCall::create()
            ->url('http://localhost:3000/webhooks')
            ->payload([
                'key' => 'value',
                'number' => str()->random(),
            ])
            ->useSecret('very-secret')
            ->dispatchSync();
    }
}
