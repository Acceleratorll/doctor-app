<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->timezone('Asia/Jakarta')->toDateString();
        $now = Carbon::now()->format('H:i');
        $praktikNow = Schedule::with('place')->whereDate('schedule_date', $today)
            ->where('schedule_time', '<=', $now)->first();
        return view('web.notifikasi', compact(['today', 'praktikNow']));
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
