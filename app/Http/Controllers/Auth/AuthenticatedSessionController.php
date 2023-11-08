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

        if (auth()->user()->role_id == '1' || auth()->user()->role_id == '2') {
            return redirect()->intended(RouteServiceProvider::HOME);
        } elseif (Auth::user()->role_id == '3') {
            $today = Carbon::today()->timezone('Asia/Jakarta')->toDateString();
            $now = Carbon::now()->format('H:i');
            $patient = Patient::where('user_id', auth()->user()->id)->first();
            $praktik = Schedule::with('place')->whereDate('schedule_date', $today)
                ->where('schedule_time', '<=', $now)->first();
            if ($praktik != null) {
                $currentNumber = null;
                $myNumber = null;
                $schedule = Schedule::with(['place' => function ($query) {
                    $query->where('reservationable', 1);
                }])->whereDate('schedule_date', $today)
                    ->where('schedule_time', '<=', $now)->where('schedule_time_end', '>=', $now)
                    ->first();
                if ($schedule) {
                    $myReservation = Reservation::where('schedule_id', $schedule->id)
                        ->where('patient_id', $patient->id)->first();
                    if ($myReservation) {
                        $reservation = Reservation::where('schedule_id', $schedule->id)
                            ->where('status', 0)->orderBy('nomor_urut', 'asc')->first();
                        $currentNumber = $reservation->nomor_urut;
                        $myNumber = $myReservation->nomor_urut;
                    }
                }

                $count = ($praktik ? 1 : 0) + ($myNumber ? 1 : 0);

                session()->put('notification', [
                    'praktik' => $praktik,
                    'currentNumber' => $currentNumber,
                    'myNumber' => $myNumber,
                    'count' => $count
                ]);
            }
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
