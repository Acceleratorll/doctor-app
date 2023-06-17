<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RedirectToDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     // Cek apakah ada route yang terdaftar dengan URL saat ini
    //     if (!Route::has($request->path())) {
    //         // Jika tidak ada route yang terdaftar, redirect ke dashboard
    //         return redirect()->route('dashboard');
    //     }

    //     return $next($request);
    // }
}
