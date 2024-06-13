<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{

    public function create()
    {
        return view('login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $userRoles = auth()->user()->getRoleNames();

        $allowedRoles = ['superadmin', 'pegawai', 'dokter_umum', 'dokter_gigi'];

        $patientRoles = collect(['pasien'])
            ->map(function ($role) {
                return Str::lower($role); // Convert role names to lowercase
            });

        if ($userRoles->intersect($allowedRoles)->isNotEmpty()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } elseif ($userRoles->intersect($patientRoles)->isNotEmpty()) {
            return redirect()->route('dashboard');
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/dashboard');
    }
}
