<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->email != null && $request->user()->email_verified_at == null) {
            return redirect()->route("verification.notice");
        } elseif ($request->user()->mobile != null && $request->user()->mobile_verification_code == null) {
            return redirect()->route("phone.verification.notice");
        }
        return $next($request);
    }
}
