<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use stdClass;
use function Laravel\Prompts\{text, textarea, confirm, password};

class SendMessage extends Command
{
    protected $signature = 'app:send-msg';

    protected $description = 'Command description';

    public function handle()
    {
        $name = text(
            label: 'What is your name?',
            placeholder: 'E.g. Taylor Otwell',
            required: true,
            validate: fn (string $value) => match (true) {
                strlen($value) < 3 => 'The name must be at least 3 characters.',
                strlen($value) > 255 => 'The name must not exceed 255 characters.',
                default => null
            },
            hint: 'This will be displayed on your profile.'
        );

        $password = password(
            label: 'What is your password?',
            required: 'The password is required.'
        );

        $confirmed = confirm(
            label: 'Do you accept the terms?',
            default: false,
            yes: 'I accept',
            no: 'I decline',
            hint: 'The terms must be accepted to continue.'
        );

        $bio = textarea('Account Bio.');
        $this->info($name);
    }

    public function sayNiceJobFiveTimesPerMinute()
    {
        $user = (object) ['id' => 1];

        $executed = RateLimiter::attempt(
            'send-message:'.$user->id,
            $perMinute = 5,
            function () {
                // Send message...
                $message = 'Nice job!';

                Log::info($message);

                return $message;
            }
        );

        if (! $executed) {
            // return 'Too many messages sent!';
            $this->warn('Too many messages sent!');
        }

        $this->info($executed);
    }

    public function solution2(): void
    {
        $user = new stdClass(['id' => 1]);

        if (RateLimiter::tooManyAttempts('send-message:'.$user->id, $perMinute = 5)) {
            $seconds = RateLimiter::availableIn('send-message:'.$user->id);

            $return = 'You may try again in '.$seconds.' seconds.';
            // return 'You may try again in ' . $seconds . ' seconds.';

            $this->warn($return);
        }

        RateLimiter::increment('send-message:'.$user->id);

        // Send message...
    }

    public function clear(): void
    {
        RateLimiter::clear('send-message:'.'1');
    }
}
