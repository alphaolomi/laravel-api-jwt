<?php

namespace App\Http\Controllers;

use App\Events\WebhookHit;
use App\Jobs\ProcessWebhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // TODO: Validate the data if needed (e.g. validate a signed request)

        // Save webhook to storage (likely s3 or similar)
        $payload = [
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            // String representation of the body,
            // I'm assuming no files are sent.
            // An alternative to this would be base64'ing
            // a binary format of the body
            'body' => $request->getContent(),
            'uri' => $request->getUri(),
        ];
        $webhook = json_encode($payload);

        $reqId = $request->header('fly-request-id') ?: Str::uuid()->toString();

        // organise by /year/month/day/reqId.json
        $file = sprintf("%s.json", $reqId);

        // An S3 (compatible) storage
        Storage::disk('webhook')->put($file, $webhook);

        // TODO: complete this code
        dispatch(new WebhookHit($payload));

        // Queue a job to process the webhook
        ProcessWebhook::dispatch($file);

        return response()->noContent();
    }
}
