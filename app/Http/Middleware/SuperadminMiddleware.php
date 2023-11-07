<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperadminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id === 1 || auth()->user()->role_id === 2) {
            return $next($request);
        }

        return abort(401);
    }

    // private function userHasAnyRole($user, $roles)
    // {
    //     foreach ($roles as $role) {
    //         if ($user->hasRole($role)) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }
}
