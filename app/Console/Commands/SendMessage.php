<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use stdClass;

class SendMessage extends Command
{
    protected $signature = 'app:send-msg';

    protected $description = 'Command description';


    public function handle()
    {
    }

    public function sayNiceJobFiveTimesPerMinute()
    {
        $user = (object)['id' => 1];

        $executed = RateLimiter::attempt(
            'send-message:' . $user->id,
            $perMinute = 5,
            function () {
                // Send message...
                $message = "Nice job!";

                Log::info($message);

                return $message;
            }
        );

        if (!$executed) {
            // return 'Too many messages sent!';
            $this->warn('Too many messages sent!');
        }

        $this->info($executed);
    }


    function solution2(): void
    {
        $user = new stdClass(["id"=>1]);

        if (RateLimiter::tooManyAttempts('send-message:' . $user->id, $perMinute = 5)) {
            $seconds = RateLimiter::availableIn('send-message:' . $user->id);

            $return =  'You may try again in ' . $seconds . ' seconds.';
            // return 'You may try again in ' . $seconds . ' seconds.';

            $this->warn($return);
        }

        RateLimiter::increment('send-message:' . $user->id);

        // Send message...
    }

    function clear(): void
    {
        RateLimiter::clear('send-message:' . '1');
    }
}
