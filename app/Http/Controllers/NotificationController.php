<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Schedule;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notif($notif)
    {
        $firstSchedule = Schedule::with('reservations')->orderBy('schedule_date', 'desc')->get();

        $idSchedule = 0;
        foreach ($firstSchedule as $first) {
            foreach ($first->reservations as $data) {
                if ($data->status == 0 && $data->patient_id == $notif) {
                    $idSchedule = $first->id;
                }
            }
        }

        $schedule = Schedule::with('reservations')->where('id', $idSchedule)->first();

        $reservationsCount = 0;
        foreach ($schedule->reservations as $sch) {
            if ($sch->status == 0) {
                $reservationsCount++;
            }
        }

        $no_antrian = Reservation::where('schedule_id', $idSchedule)->orderBy('reservation_code', 'asc')->where('status', 0)->first();

        return response()->json([
            "antrian_belum_selesai" => $reservationsCount,
            "no_antrian_saat_ini" => $no_antrian->reservation_code
        ]);
    }
}
