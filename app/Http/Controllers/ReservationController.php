<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\MedicalRecordRequest;
use App\Http\Requests\ReservationRequest;
use App\Models\File;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations_no = Reservation::with(['patient', 'schedule'])->where('status', 0)->where('approve', 1)->get();
        $reservations_yes = Reservation::with(['patient', 'schedule'])->where('status', 1)->where('approve', 1)->get();
        return view('reservasi.index', compact(['reservations_no', 'reservations_yes']));
    }

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
        $schedule = Schedule::findOrFail($request->schedule_id);
        $jumlah = Reservation::where('schedule_id', $schedule->id)->get()->count();

        if ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid()) {

            $image = $request->file('bukti_pembayaran')->store('pembayaran_images', 'public');
        }


        if ($jumlah < $schedule->qty) {
            Reservation::create([
                'patient_id' => $request->patient_id,
                'schedule_id' => $request->schedule_id,
                'reservation_code' => $request->reservation_code,
                'bukti_pembayaran' => $image,
                'status' => $request->status,
                'nomor_urut' => $request->nomor_urut,
            ]);

            return redirect()->route('admin.reservation.index');
        } else {
            return redirect()->back()->with('error', 'Maaf, kamu tidak dapat melakukan reservasi karena kamu sudah melewati batas reservasi');
        }
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
        $reservation = Reservation::with(['patient', 'schedule'])->findOrFail($id)->first();
        if ($reservation->status == 1 && $request['status'] == 0) {
            $medic = MedicalRecord::where('patient_id', $reservation->patient_id)->latest()->first();
            $medic->delete();

            File::where('medical_record_id', $medic->id)->delete();
        }

        $reservation->update($request->all());
        return redirect()->route('admin.reservation.index');
    }

    public function finish(Reservation $reservation)
    {
        $reservation["status"] = 1;
        $reservation->update();
        return response()->json("Reservation has been finished");
    }

    public function destroy($id)
    {
        Reservation::withTrashed()->findOrFail($id)->forceDelete();
        return back();
    }

    public function cancel()
    {
        $cancels = Reservation::onlyTrashed()->orderByDesc('deleted_at')->get();
        return view('reservasi.cancel', compact('cancels'));
    }

    public function wait()
    {
        $waits = Reservation::where('approve', 0)->latest()->get();
        return view('reservasi.wait', compact('waits'));
    }

    public function approve($id)
    {
        Reservation::findOrFail($id)->update(['approve' => 1]);
        return redirect()->route('admin.waiting-list');
    }

    public function restore($id)
    {
        Reservation::onlyTrashed()->where('id', $id)->restore();
        return redirect('admin/list-cancel');
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

    public function storeMed(MedicalRecordRequest $recordRequest, FileRequest $fileRequest)
    {
        $medicalData = $recordRequest->validated();
        $reservation = Reservation::findOrFail($recordRequest['reservation_id']);

        DB::beginTransaction();

        try {
            $reservation->update(['status' => 1]);
            $record = MedicalRecord::create($medicalData);

            foreach ($fileRequest->file('files') as $file) {
                $filePath = $file->store('record_files/' . $reservation->patient_id . '/' . $record->id, 'public');

                File::create([
                    'medical_record_id' => $record->id,
                    'title' => $this->sanitizeFilename($file->getClientOriginalName()),
                    'type' => $file->getClientOriginalExtension(),
                    'url' => $filePath,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.reservation.index');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e);

            return redirect()->back()->with('error', 'An error occurred while saving data.');
        }
    }

    private function sanitizeFilename($filename)
    {
        return preg_replace('/[^a-zA-Z0-9_.\-]/', '_', $filename);
    }
}
