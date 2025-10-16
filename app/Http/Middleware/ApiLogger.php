<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiLogger
{
    /**
     * Handle an incoming request and log API activity
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        // Process request
        $response = $next($request);

        $duration = round((microtime(true) - $startTime) * 1000, 2); // milliseconds

        // Log API request
        $logData = [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => $request->user()?->id,
            'status_code' => $response->getStatusCode(),
            'duration_ms' => $duration,
            'timestamp' => now()->toISOString(),
        ];

        // Log based on status code
        if ($response->getStatusCode() >= 500) {
            Log::error('API Error', $logData);
        } elseif ($response->getStatusCode() >= 400) {
            Log::warning('API Client Error', $logData);
        } elseif ($duration > 1000) {
            Log::warning('API Slow Response', $logData);
        } else {
            Log::info('API Request', $logData);
        }

        // Add response time header
        $response->headers->set('X-Response-Time', $duration . 'ms');

        return $response;
    }
}
