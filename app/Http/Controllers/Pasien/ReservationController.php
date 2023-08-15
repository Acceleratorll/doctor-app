<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::today()->toDateString();
        $schedules = Schedule::where('place_id', 2)->where('schedule_date', '>=', $today)->orderBy('schedule_date', 'asc')->select(DB::raw('distinct(schedule_date)'))->get();
        return view('web.janji_temu', compact('schedules'));
    }

    public function getTime(Request $request)
    {
        $times = Schedule::where('place_id', 2)
            ->whereDate('schedule_date', $request['date'])
            ->get();

        $html = '<div class="row" id="schedule_time">';

        foreach ($times as $time) {
            $html .= '<div class="col-md-3">
                <a href="#">
                    <input class="form-check-input" type="radio" name="schedule_time" id="schedule_time' . $time->id . '" value="' . $time->schedule_time . '">
                    <label for="schedule_time' . $time->id . '">
                        <div class="card active-card">
                            <div class="card-body">
                                <p class="card-title">' . $time->schedule_time . ' Hingga ' . $time->schedule_time_end . '</p>
                            </div>
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
        $reservation = Reservation::where('schedule_id', $request->id)->get();
        if ($reservation->count() <= $reservation->schedule->qty) {
            $code = hexdec(substr(uniqid(), 6, 6));
            $antrian = 1;
            if ($reservation != null) {
                $antrian = $reservation->orderBy('nomor_urut', 'desc')->nomor_urut + 1;
            }
            $doctor = User::where('role_id', 1)->first();
            return view('web.konfirmasi', compact(['request', 'doctor', 'antrian', 'code']));
        } else {
            return back()->with('error', 'Reservasi telah mencapai batas kuota');
        }
    }

    public function store(Request $request)
    {
        $schedule = Schedule::whereDate('schedule_date', $request['schedule_date'])->where('schedule_time', $request['schedule_time'])->first();
        if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid()) {

            $imagePath = $request->file('bukti_pembayaran')->store('pembayaran_images', 'public');
        }

        Reservation::create([
            'patient_id' => auth()->user()->patient->id,
            'schedule_id' => $schedule->id,
            'reservation_code' => $request['reservation_code'],
            'bukti_pembayaran' => $imagePath,
            'nomor_urut' => $request['nomor_urut'],
        ]);


        return redirect()->route('jadwal.index');
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
