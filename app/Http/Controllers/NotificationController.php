<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->timezone('Asia/Jakarta')->toDateString();
        $now = Carbon::now()->format('H:i');

        $reservation = Reservation::where('patient_id', auth()->user()->patient->id)
            ->whereHas('schedule', function ($query) use ($today) {
                $query->where('schedule_date', $today);
            })->first();

        if ($reservation !== null) {
            $queueNow = $reservation->schedule->reservations()
                ->where('status', 1)
                ->orderBy('nomor_urut', 'asc')
                ->first();
        }else{
            $queueNow = null;
        }

        $praktikUmum = Schedule::with('place', 'reservations')->whereHas('schedule_type', function ($q) {
            $q->where('name', 'Umum');
        })->whereDate('schedule_date', $today)
            ->where('schedule_time', '<=', $now)->where('schedule_time_end', '>=', $now)->get();

        $praktikGigi = Schedule::with('place', 'reservations')->whereHas('schedule_type', function ($q) {
            $q->where('name', 'Gigi');
        })->whereDate('schedule_date', $today)
            ->where('schedule_time', '<=', $now)->where('schedule_time_end', '>=', $now)->get();

        return view('web.notifikasi', compact(['today', 'praktikUmum', 'praktikGigi', 'reservation', 'queueNow']));
    }

    public function destroy(Request $request, $id)
    {
        if ($id == 1) {
            $request->session()->put('notification.praktik');
        } else {
            $request->session()->put('notification.currentNumber');
            $request->session()->put('notification.myNumber');
        }
        $count = session('notification.praktik' ? 1 : 0) + session('notification.myNumber' ? 1 : 0);
        session()->put('notification.count', $count);
        return redirect()->back();
    }
}
