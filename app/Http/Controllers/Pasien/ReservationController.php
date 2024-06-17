<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Mail\StatusEmail;
use App\Models\Place;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Facade\FlareClient\View;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request)
    {
        $today = Carbon::today()->toDateString();

        $type = $request->type;
        $schedules = Schedule::with(['place' => function ($query) {
            $query->where('reservationable', 1);
        }, 'schedule_type'])
            ->where('place_id', $request->place_id)
            ->whereHas('schedule_type', function ($q) use ($type) {
                $q->where('name', $type);
            })
            ->where('schedule_date', '>=', $today)
            ->orderBy('schedule_date', 'asc')
            ->get(['schedule_date', 'schedule_time_end', 'id', 'place_id', 'schedule_type_id']);

        // Filter out duplicate schedule_date entries
        $schedules = $schedules->unique('schedule_date');
        $place_id = $request->place_id;

        return view('web.janji_temu', compact('schedules', 'type', 'place_id'));
    }

    public function getTime(Request $request)
    {
        $times = Schedule::with(['place' => function ($query) {
            $query->where('reservationable', 1);
        }, 'reservations'])
            ->where('place_id', $request->place_id)
            ->whereDate('schedule_date', $request['date'])
            ->whereHas('schedule_type', function ($q) use ($request) {
                $q->where('name', $request['jenis']);
            })
            ->get();

        $html = '<div class="row" id="schedule_time">';

        foreach ($times as $time) {
            $sum = $time->qty - $time->reservations->count();
            $html .= '<div class="col">
            <input class="form-check-input" type="radio" name="schedule_time" id="schedule_time' . $time->id . '" value="' . $time->schedule_time . '">
            <div class="card" style="border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 150px">
                <div class="card-body">
                    <label for="schedule_time' . $time->id . '">
                        <h5 class="card-title" style="font-size: medium;">' . $time->schedule_time . ' - ' . $time->schedule_time_end . '</h5>
                        <p class="caption">Sisa Kuota: ' . $sum . '</p>
                    </label>
                </div>
            </div>
        </div>';
        }

        $html .= '</div>';

        return response()->json($html);
    }

    public function confirm(Request $request)
    {
        if ($request == null || $request->schedule_date == null || $request->schedule_time == null) {
            return back()->with('error', 'Mohon untuk memilih Tanggal dan Waktu terlebih dahulu');
        }

        $schedule = Schedule::whereDate('schedule_date', $request->schedule_date)->where('schedule_time', $request->schedule_time)->first();
        $reservation = Reservation::where('schedule_id', $schedule->id)->get();
        $code = hexdec(substr(uniqid(), 6, 6));
        $antrian = 1;
        if ($reservation != null) {
            $antrian = $reservation->max('nomor_urut') + 1;
        }
        $doctor = User::role('superadmin')->first();
        return view('web.konfirmasi', compact(['request', 'doctor', 'antrian', 'code']));
    }

    public function store(Request $request)
    {
        $schedule = Schedule::whereDate('schedule_date', $request['schedule_date'])
            ->where('schedule_time', $request['schedule_time'])
            ->whereHas('schedule_type', function ($q) {
                $q->where('name', 'like', '%Gigi%');
            })
            ->first();

        $jumlah = Reservation::where('schedule_id', $schedule->id)->get()->count();
        $haveReservation = Reservation::where('schedule_id', $schedule->id)->where('patient_id', auth()->user()->patient->id)->first();
        if (isset($haveReservation)) {
            return redirect()->route('profile.index')->with('error', 'Maaf, kamu tidak dapat menambah reservasi karena kamu telah melakukan reservasi pada jadwal ini');
        }

        if ($jumlah < $schedule->qty) {
            if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid()) {
                $image = $request->file('bukti_pembayaran')->store('pembayaran_images', 'public');
                $reservation = Reservation::create([
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

                Mail::to($reservation->patient->user->email)->send(new StatusEmail($reservation));

                return redirect()->route('profile.index');
            } else if ($request->hasFile('ktp') && $request->hasFile('surat_rujukan') && $request->hasFile('bpjs_card')) {
                $imageKtp = $request->file('ktp')->store('bpjs', 'public');
                $imageSurat = $request->file('surat_rujukan')->store('bpjs', 'public');
                $imageBpjs = $request->file('bpjs_card')->store('bpjs', 'public');
                $reservation = Reservation::create([
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

                Mail::to($reservation->patient->user->email)->send(new StatusEmail($reservation));

                return redirect()->route('profile.index');
            } else {
                return redirect()->back()->with('error', 'Data tidak valid !');
            }
        } else {
            return back()->with('error', 'Reservasi telah mencapai batas kuota');
        }
    }

    public function cancel(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'status' => 3,
            'approve' => 1,
            'reject_reason' => $request->reason,
        ]);

        Mail::to($reservation->patient->user->email)->send(new StatusEmail($reservation));

        return response()->json(['success' => 'Reservation rejected successfully!']);
    }

    public function bukti(Request $request)
    {
        return view('web.bukti_pembayaran', compact(['request']));
    }

    public function chooseDoctor(Request $request)
    {
        $place_id = $request->place_id;
        return view('web.pilih_dokter', compact('place_id'));
    }
    public function choosePlace()
    {
        $place = Place::all();
        return view('web.pilih_tempat', compact('place'));
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
