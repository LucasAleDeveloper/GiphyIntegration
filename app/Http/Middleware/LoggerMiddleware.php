<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$request->user()) {
            return $next($request);
        }

        $userId = $request->user()->id;

        DB::table('request_logs')->insert([
            'user_id' => $userId,
            'service' => $request->path(),
            'request_body' => $request->getContent(),
            'response_code' => $response->status(),
            'response_body' => $response->getContent(),
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $response;
    }
}
