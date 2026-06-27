<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $user = auth()->user();

        if ($user->status === 'suspended') {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account has been suspended. Contact support.');
        }

        if ($user->status === 'inactive') {
            return redirect()->route('login')->with('error', 'Your account is not active.');
        }

        return $next($request);
    }
}
