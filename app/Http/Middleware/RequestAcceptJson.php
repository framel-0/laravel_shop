<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestAcceptJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->headers->has('Accept')) {
            $request->headers->set('Accept', 'application/vnd.api+json');
        }

        if (!$request->headers->has('Content-Type')) {
            $request->headers->set('Content-Type', 'application/vnd.api+json');
        }
        return $next($request);
    }
}
