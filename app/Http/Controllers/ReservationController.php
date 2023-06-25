<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Schedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::with(['patient', 'schedule'])->get();
        // $reservations_no = Reservation::with(['patient', 'schedule'])->where('status', 0)->get();
        // $reservations_yes = Reservation::with(['patient', 'schedule'])->where('status', 1)->get();
        return view('reservasi.index', compact(['reservations']));
    }

    // public function reservation_view()
    // {
    //     $reservations = Reservation::with(['patient', 'schedule.employee'])->where('patient_id', Auth::user()->id)->get();
    //     return view('reservasi.index', [
    //         'reservations' => $reservations
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::today()->toDateString();
        // $code = uniqid();
        $integerCode = hexdec(substr(uniqid(), 6, 6));
        return view('reservasi.create', [
            'code' => $integerCode,
            'patients' => Patient::all(),
            'schedules' => Schedule::where('place_id', 2)->where('schedule_date', '>=', $today)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        Reservation::create($request->all());
        return redirect()->route('admin.reservation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($reservation)
    {
        $reservation = Reservation::with(['patient', 'schedule'])->where('id', $reservation)->first();
        return response()->json($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $today = Carbon::today()->toDateString();
        $reservation = Reservation::with(['patient', 'schedule'])->findOrFail($id);
        return view('reservasi.edit', [
            'reservation'   => $reservation,
            'patients' => Patient::all(),
            'schedules' => Schedule::where('schedule_date', '>=', $today)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update($id, ReservationRequest $request)
    {
        Reservation::with(['patient', 'schedule'])->findOrFail($id)->update($request->all());
        return redirect()->route('admin.reservation.index');
    }

    public function finish(Reservation $reservation)
    {
        $reservation["status"] = 1;
        $reservation->update();
        return response()->json("Reservation has been finished");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($reservation)
    {
        return response()->json('Not Found', 400);
    }

    private function checkData($patient, $schedule)
    {
        /* 
            // check apakah data pasien atau data jadwal tidak ada 
            */
        $patient_data   = Patient::find($patient);
        $schedule_data  = Schedule::find($schedule);
        if (!$patient_data || !$schedule_data) {
            return response()->json('The data you provided was not found', 400);
        }
        /* 
        // end check 
        */


        /* 
        // check apakah pasien daftar 2x pada reservasi tersebut 
        */
        $reservationExists    = Reservation::where('patient_id', $patient)->where('schedule_id', $schedule)->where('status', 0)->first();

        if ($reservationExists) {
            return response()->json('You have signed up for the schedule', 403);
        }
        /* 
        // end check 
        */
    }


    public function check_queue(Request $request)
    {
        $patient_id = Auth::user()->id;

        //Check if patient has reservation
        $reservation = Reservation::where('patient_id', $patient_id)->where('status', 0)->first();
        if (!$reservation) {
            return response()->json([
                'data'  =>  [],
                'new_notification' => -1
            ], 200);
        }


        //Jika ada ambil semua reservasi yang jadwal nya sama
        $reservationId = $reservation->id;
        $reservations = Reservation::where('schedule_id', $reservation->schedule_id)->where('status', 0)->get();
        $reservationIndex = $reservations->search(function ($reservation) use ($reservationId) {
            return $reservation->id === $reservationId;
        });


        if ($request->queue == ($reservationIndex + 1)) {
            return response()->json([
                'queue'    => $reservationIndex + 1,
                'total'     => count($reservations),
                'new_notification'       => 0
            ], 200);
        }


        return response()->json([
            'queue'    => $reservationIndex + 1,
            'total'     => count($reservations),
            'new_notification'       => 1
        ], 200);
    }

    public function getAntrian(Request $request)
    {
        $reservation = Reservation::where('schedule_id', $request->id)->orderBy('nomor_urut', 'desc')->first();
        $antrian = 1;
        if ($reservation != null) {
            $antrian = $reservation->nomor_urut + 1;
        }
        return response()->json($antrian);
    }
}
