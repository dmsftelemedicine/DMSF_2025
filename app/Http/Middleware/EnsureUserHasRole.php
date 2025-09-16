<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! auth()->check()) {
            abort(403, 'Unauthenticated.');
        }

        // Normalize roles: supports both comma and pipe separators,
        // and supports either multiple params (role:admin,doctor) or one param 'admin|doctor'.
        $allowed = collect($roles)
            ->flatMap(fn($r) => preg_split('/[|,]/', $r))
            ->map(fn($r) => trim($r))
            ->filter()
            ->unique()
            ->values()
            ->all();

        // If you use spatie/laravel-permission, use its helper method
        if (method_exists(auth()->user(), 'hasAnyRole')) {
            if (! auth()->user()->hasAnyRole($allowed)) {
                abort(403, 'Unauthorized.');
            }
            return $next($request);
        }

        // Fallback: check single role column on users table
        $userRole = auth()->user()->role ?? null;
        if (! $userRole || ! in_array($userRole, $allowed, true)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
