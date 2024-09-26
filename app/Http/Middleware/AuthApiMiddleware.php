<?php

namespace App\Http\Middleware;

use Closure;
use App\Common\ResponJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        if (!$request->expectsJson()) {
            // return parent::handle($request, $next);
            return $next($request);
        }

        if (!Auth::check()) {
            return new ResponJson(401, 'Unauthorize', 'Silakan Login Terlbih Dahulu', null, null);
        }

        return $next($request);

    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
