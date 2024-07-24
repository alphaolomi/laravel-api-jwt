<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AssignRequestId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $requestId = Str::uuid()->toString();


        Log::withContext([
            'request-id' => $requestId
        ]);


        Context::add('url', $request->url());
        Context::add('trace_id', $requestId);

        $response = $next($request);

        $response->headers->set('Request-Id', $requestId);

        return $response;
    }
}
