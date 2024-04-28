<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperadminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $userRoles = auth()->user()->getRoleNames();

        $allowedRoles = ['superadmin', 'pegawai', 'dokter_umum', 'dokter_gigi'];

        if ($userRoles->intersect($allowedRoles)->isNotEmpty()) {
            return $next($request);
        }

        return abort(401);
    }
}
