<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    //     }

    //     $user = Auth::user();

    //     // Check if user_type is in the allowed roles
    //     if (!in_array($user->user_type, $roles)) {
    //         return response()->json(['message' => 'Forbidden - Access Denied'], Response::HTTP_FORBIDDEN);
    //     }

    //     return $next($request);
    // }
}