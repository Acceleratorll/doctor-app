<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Facade\FlareClient\View;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{
    public function index()
    {
        // 
    }

    public function showQueue()
    {
        $today = date('Y-m-d');
        $current_time = date('H:i:s');

        $schedule = Schedule::where('schedule_date', $today)
            ->where('schedule_time', '<=', $current_time)
            ->where('schedule_time_end', '>=', $current_time)
            ->first();


        if (!$schedule) {
            return view('web.lihat-antrian');
        }

        $current_queue = $schedule->reservations()->orderBy('nomor_urut', 'desc')->first();
        if ($current_queue) {
            $current_queue = $current_queue->nomor_urut;
            return view('web.lihat-antrian', compact('schedule', 'current_queue'));
        } else {
            $current_queue = 0;
            return view('web.lihat-antrian', compact('schedule', 'current_queue'));
        }
    }

    public function create()
    {
        $today = Carbon::today()->toDateString();
        $schedules = Schedule::with(['place' => function ($query) {
            $query->where('reservationable', 1);
        }])->where('schedule_date', '>=', $today)->orderBy('schedule_date', 'asc')->select(DB::raw('distinct(schedule_date)'))->get();
        return view('web.janji_temu', compact('schedules'));
    }

    public function getTime(Request $request)
    {
        $times = Schedule::with(['place' => function ($query) {
            $query->where('reservationable', 1);
        }, 'reservations'])
            ->whereDate('schedule_date', $request['date'])
            ->get();

        $html = '<div class="row" id="schedule_time">';

        foreach ($times as $time) {
            $sum = $time->qty - $time->reservations->count();
            $html .= '<div class="col-md-3">
            <a href="#">
            <input class="form-check-input" type="radio" name="schedule_time" id="schedule_time' . $time->id . '" value="' . $time->schedule_time . '">
            <label for="schedule_time' . $time->id . '">
            <div class="card active-card">
            <div class="card-body">
            <p class="card-title">' . $time->schedule_time . ' Hingga ' . $time->schedule_time_end . '</p>
            </div>
            <caption>Sisa Kuota : ' . $sum . '</caption>
            </div>
            </label>
            </a>
            </div>&nbsp';
        }

        $html .= '</div>';

        return response()->json($html);
    }

    public function confirm(Request $request)
    {
        $schedule = Schedule::whereDate('schedule_date', $request->schedule_date)->where('schedule_time', $request->schedule_time)->first();
        $reservation = Reservation::where('schedule_id', $schedule->id)->get();
        $code = hexdec(substr(uniqid(), 6, 6));
        $antrian = 1;
        if ($reservation != null) {
            $antrian = $reservation->max('nomor_urut') + 1;
        }
        $doctor = User::where('role_id', 1)->first();
        return view('web.konfirmasi', compact(['request', 'doctor', 'antrian', 'code']));
    }

    public function store(Request $request)
    {
        $schedule = Schedule::whereDate('schedule_date', $request['schedule_date'])->where('schedule_time', $request['schedule_time'])->first();
        $jumlah = Reservation::where('schedule_id', $schedule->id)->get()->count();

        if ($jumlah < $schedule->qty) {
            if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid()) {
                $image = $request->file('bukti_pembayaran')->store('pembayaran_images', 'public');
                Reservation::create([
                    'patient_id' => auth()->user()->patient->id,
                    'schedule_id' => $schedule->id,
                    'reservation_code' => $request['reservation_code'],
                    'bpjs' => 0,
                    'bukti_pembayaran' => $image,
                    'ktp' => '',
                    'surat_rujukan' => '',
                    'bpjs_card' => '',
                    'nomor_urut' => $request['nomor_urut'],
                ]);

                return redirect()->route('profile.index');
            } else if ($request->hasFile('ktp') && $request->hasFile('surat_rujukan') && $request->hasFile('bpjs_card')) {
                $imageKtp = $request->file('ktp')->store('bpjs', 'public');
                $imageSurat = $request->file('surat_rujukan')->store('bpjs', 'public');
                $imageBpjs = $request->file('bpjs_card')->store('bpjs', 'public');
                Reservation::create([
                    'patient_id' => auth()->user()->patient->id,
                    'schedule_id' => $schedule->id,
                    'reservation_code' => $request['reservation_code'],
                    'bpjs' => 1,
                    'bukti_pembayaran' => '',
                    'ktp' => $imageKtp,
                    'surat_rujukan' => $imageSurat,
                    'bpjs_card' => $imageBpjs,
                    'nomor_urut' => $request['nomor_urut'],
                ]);
                return redirect()->route('profile.index');
            } else {
                return redirect()->back()->with('error', 'Data tidak valid !');
            }
        } else {
            return back()->with('error', 'Reservasi telah mencapai batas kuota');
        }
    }

    public function cancel($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->route('profile.index');
    }

    public function bukti(Request $request)
    {
        return view('web.bukti_pembayaran', compact(['request']));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
