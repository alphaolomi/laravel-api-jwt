<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidateJsonPayload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the request content
        $content = $request->getContent();

        // Check if the content is valid JSON
        if (!empty($content)) {
            if (json_validate($content) === false) {
                throw new HttpResponseException(response()->json([
                    'message' => 'Invalid payload. JSON expected.',
                ], 400));
            }
        }

        return $next($request);
    }
}
