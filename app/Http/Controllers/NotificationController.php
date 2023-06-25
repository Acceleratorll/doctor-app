<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->timezone('Asia/Jakarta')->toDateString();
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        $praktikNow = Schedule::with('place')->whereDate('schedule_date', $today)->first();
        $schedule = Schedule::where('place_id', 2)->whereDate('schedule_date', $today)->first();
        if ($schedule != null) {
            $myReservation = Reservation::where('schedule_id', $schedule->id)->where('patient_id', $patient->id)->first();
            $currentNumber = null;
            $myNumber = null;
            if ($myReservation) {
                $reservation = Reservation::where('schedule_id', $schedule->id)->where('status', 0)->orderBy('nomor_urut', 'asc')->first();
                $currentNumber = $reservation->nomor_urut;
                $myNumber = $myReservation->nomor_urut;
            }

            session()->flash('notification', [
                'praktik' => $schedule,
                'currentNumber' => $currentNumber,
                'myNumber' => $myNumber,
            ]);
        }
        return view('web.notifikasi', compact(['today', 'praktikNow']));
    }

    public function destroy(Request $request, $id)
    {
        if ($id == 1) {
            $request->session()->forget('notification.praktik');
        } else {
            $request->session()->forget('notification.currentNumber');
            $request->session()->forget('notification.myNumber');
        }
        return redirect()->back();
    }
}
