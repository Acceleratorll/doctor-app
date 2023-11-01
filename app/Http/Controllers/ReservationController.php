<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\MedicalRecordRequest;
use App\Http\Requests\ReservationRequest;
use App\Models\File;
use App\Models\Icd;
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
    public function index(Request $request)
    {
        if ($request->bpjs != null) {
            $reservations_no = Reservation::with(['patient', 'schedule'])
                ->where('bpjs', $request->bpjs)
                ->where('status', 0)
                ->where('approve', 1)
                ->orderBy('schedule_id', 'asc')
                ->orderBy('nomor_urut', 'asc')
                ->get();

            $reservations_yes = Reservation::with(['patient', 'schedule'])
                ->where('bpjs', $request->bpjs)
                ->where('status', 1)
                ->where('approve', 1)
                ->orderBy('schedule_id', 'asc')
                ->orderBy('nomor_urut', 'asc')
                ->get();
        } else {
            $reservations_no = Reservation::with(['patient', 'schedule'])
                ->where('status', 0)
                ->where('approve', 1)
                ->orderBy('schedule_id', 'asc')
                ->orderBy('nomor_urut', 'asc')
                ->get();

            $reservations_yes = Reservation::with(['patient', 'schedule'])
                ->where('status', 1)
                ->where('approve', 1)
                ->orderBy('schedule_id', 'asc')
                ->orderBy('nomor_urut', 'asc')
                ->get();
        }

        return view('reservasi.index', compact(['reservations_no', 'reservations_yes']));
    }

    public function create()
    {
        $today = Carbon::today()->toDateString();
        $integerCode = hexdec(substr(uniqid(), 6, 6));
        $schedules = Schedule::whereHas('place', function ($query) {
            $query->where('reservationable', 1);
        })->where('schedule_date', '>=', $today)->get();

        return view('reservasi.create', [
            'code' => $integerCode,
            'patients' => Patient::all(),
            'schedules' => $schedules,
        ]);
    }

    public function store(ReservationRequest $request)
    {
        $schedule = Schedule::findOrFail($request->schedule_id);
        $jumlah = Reservation::where('schedule_id', $schedule->id)->get()->count();

        if ($jumlah < $schedule->qty) {
            if ($request->hasFile('bukti_pembayaran')) {
                $reservation = Reservation::create([
                    'patient_id' => $request->patient_id,
                    'schedule_id' => $request->schedule_id,
                    'reservation_code' => $request->reservation_code,
                    'approve' => $request->approve,
                    'status' => $request->status,
                    'nomor_urut' => $request->nomor_urut,
                ]);
                $image = $request->file('bukti_pembayaran')->store('pembayaran_images', 'public');
                $reservation->update([
                    'bukti_pembayaran' => $image,
                ]);
                return redirect()->route('admin.reservation.index')->with('success', 'Reservation berhasil dibuat !');
            } elseif ($request->hasFile('ktp') && $request->hasFile('bpjs_card') && $request->hasFile('surat_rujukan')) {
                $reservation = Reservation::create([
                    'patient_id' => $request->patient_id,
                    'schedule_id' => $request->schedule_id,
                    'reservation_code' => $request->reservation_code,
                    'approve' => $request->approve,
                    'status' => $request->status,
                    'nomor_urut' => $request->nomor_urut,
                ]);
                $ktp = $request->file('ktp')->store('ktp', 'public');
                $surat_rujukan = $request->file('surat_rujukan')->store('surat_rujukan', 'public');
                $bpjs_card = $request->file('bpjs_card')->store('bpjs_card', 'public');
                $reservation->update([
                    'bpjs' => 1,
                    'ktp' => $ktp,
                    'surat_rujukan' => $surat_rujukan,
                    'bpjs_card' => $bpjs_card,
                ]);
                return redirect()->route('admin.reservation.index')->with('success', 'Reservation berhasil dibuat !');
            }
            return redirect()->route('admin.reservation.index')->with('error', 'Maaf, kamu tidak dapat menambah reservasi karena terdapat data yang kosong atau tidak tepat');
        }
        return redirect()->route('admin.reservation.index')->with('error', 'Maaf, kamu tidak dapat menambah reservasi karena kuota sudah penuh');
    }

    public function show($reservation)
    {
        $reservation = Reservation::with(['patient', 'schedule'])->where('id', $reservation)->first();
        return response()->json($reservation);
    }

    public function edit($id)
    {
        $today = Carbon::today()->toDateString();
        $reservation = Reservation::with(['patient', 'schedule'])->findOrFail($id);
        $schedules = Schedule::whereHas('place', function ($query) {
            $query->where('reservationable', 1);
        })->where('schedule_date', '>=', $today)->get();

        return view('reservasi.edit', [
            'reservation'   => $reservation,
            'patients' => Patient::all(),
            'schedules' => $schedules,
        ]);
    }

    public function update($id, ReservationRequest $request)
    {
        $reservation = Reservation::with(['patient', 'schedule'])->findOrFail($id)->first();
        if ($reservation->status == 1 && $request['status'] == 0) {
            $medic = MedicalRecord::where('patient_id', $reservation->patient_id)->latest()->first();
            $medic->delete();

            File::where('medical_record_id', $medic->id)->delete();

            if ($request->hide_button == 1) {
                if ($request->bpjs == 0 && $request->bukti_pembayaran != null) {
                    $reservation->update($request->all());
                    $image = $request->file('bukti_pembayaran')->store('pembayaran_images', 'public');
                    $reservation->update([
                        'bukti_pembayaran' => $image,
                        'bpjs' => $request->bpjs,
                        'ktp' => '',
                        'surat_rujukan' => '',
                        'bpjs_card' => '',
                    ]);

                    return redirect()->route('admin.reservation.index')->with('success', 'Reservation berhasil diubah !');
                } elseif ($request->ktp != null && $request->bpjs_card != null && $request->surat_rujukan != null) {
                    $reservation->update($request->all());
                    $ktp = $request->file('ktp')->store('ktp', 'public');
                    $surat_rujukan = $request->file('surat_rujukan')->store('surat_rujukan', 'public');
                    $bpjs_card = $request->file('bpjs_card')->store('bpjs_card', 'public');
                    $reservation->update([
                        'bukti_pembayaran' => '',
                        'bpjs' => $request->bpjs,
                        'ktp' => $ktp,
                        'surat_rujukan' => $surat_rujukan,
                        'bpjs_card' => $bpjs_card,
                    ]);
                    return redirect()->route('admin.reservation.index')->with('success', 'Reservation berhasil diubah !');
                }
                return redirect()->route('admin.reservation.index')->with('error', 'Maaf, kamu tidak dapat mengedit reservasi karena terdapat data yang kosong atau tidak tepat');
            }

            $reservation->update($request->all());
            return redirect()->route('admin.reservation.index')->with('success', 'Reservation berhasil diubah !');
        } else {
            if ($request->hide_button == 1) {
                if ($request->bpjs == 0 && $request->bukti_pembayaran != null) {
                    $reservation->update($request->all());
                    $image = $request->file('bukti_pembayaran')->store('pembayaran_images', 'public');
                    $reservation->update([
                        'bukti_pembayaran' => $image,
                        'bpjs' => $request->bpjs,
                        'ktp' => '',
                        'surat_rujukan' => '',
                        'bpjs_card' => '',
                    ]);

                    return redirect()->route('admin.reservation.index')->with('success', 'Reservation berhasil diubah !');
                } elseif ($request->ktp != null && $request->bpjs_card != null && $request->surat_rujukan != null) {
                    $reservation->update($request->all());
                    $ktp = $request->file('ktp')->store('ktp', 'public');
                    $surat_rujukan = $request->file('surat_rujukan')->store('surat_rujukan', 'public');
                    $bpjs_card = $request->file('bpjs_card')->store('bpjs_card', 'public');
                    $reservation->update([
                        'bukti_pembayaran' => '',
                        'bpjs' => $request->bpjs,
                        'ktp' => $ktp,
                        'surat_rujukan' => $surat_rujukan,
                        'bpjs_card' => $bpjs_card,
                    ]);
                    return redirect()->route('admin.reservation.index')->with('success', 'Reservation berhasil diubah !');
                }
                return redirect()->route('admin.reservation.index')->with('error', 'Maaf, kamu tidak dapat mengedit reservasi karena terdapat data yang kosong atau tidak tepat');
            }
        }
        return redirect()->route('admin.reservation.index')->with('error', 'Maaf, kamu tidak dapat mengedit reservasi karena terdapat data yang kosong atau tidak tepat');
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

    public function skip($id)
    {
        $reservation = Reservation::findOrFail($id);
        $last_no = Reservation::where('schedule_id', $reservation->schedule_id)->orderBy('nomor_urut', 'desc')->first();
        $reservation->update(['nomor_urut' => $last_no->nomor_urut + 1]);
        return redirect()->back()->with('success', 'Reservation skipped successfully');
    }

    public function storeMed(MedicalRecordRequest $recordRequest, FileRequest $fileRequest)
    {
        $medicalData = $recordRequest->validated();
        $reservation = Reservation::findOrFail($recordRequest['reservation_id']);

        DB::beginTransaction();

        try {
            $reservation->update(['status' => 1]);
            $record = MedicalRecord::create($medicalData);

            if ($fileRequest->hasFile('files')) {

                foreach ($fileRequest->file('files') as $file) {
                    $filePath = $file->store('record_files/' . $reservation->patient_id . '/' . $record->id, 'public');

                    File::create([
                        'medical_record_id' => $record->id,
                        'title' => $this->sanitizeFilename($file->getClientOriginalName()),
                        'type' => $file->getClientOriginalExtension(),
                        'url' => $filePath,
                    ]);
                }
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

    public function getReservationsByPatient(Request $request, $patient)
    {
        $searchTerm = $request->term;

        $reservations = Reservation::where('patient_id', $patient)
            ->where('reservation_code', 'LIKE', "%$searchTerm%")
            ->select('id', 'reservation_code as text')
            ->get();

        $formattedReservations = $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->id,
                'text' => $reservation->text,
            ];
        });

        return response()->json($formattedReservations);
    }

    public function getJsonReservationsByPatient($patient)
    {
        $reservations = Reservation::with(['schedule.employee.user', 'patient', 'medical_record'])
            ->where('patient_id', $patient)->orderBy('updated_at', 'desc')->limit(3)->get();

        return response()->json($reservations);
    }
}
