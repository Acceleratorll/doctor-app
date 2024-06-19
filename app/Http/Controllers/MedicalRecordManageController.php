<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\MedicalRecordRequest;
use App\Models\File;
use App\Models\Icd;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Reservation;
use Illuminate\Http\Request;

class MedicalRecordManageController extends Controller
{
    public function index()
    {
        $medical_records = MedicalRecord::with(['reservation', 'icd'])->latest()->get();
        return view('rekam_medis.index', compact('medical_records'));
    }

    public function create(Request $request)
    {
        if ($request->patient_id != null) {
            $patient = Patient::find($request->patient_id);
            $reservation = Reservation::find($request->reservation_id);
            $icds = Icd::all();
            $route = isset($request->route) ? $request->route : null;
            return view('rekam_medis.create', compact(['patient', 'icds', 'route', 'reservation']));
        } else {
            $patients = Patient::all();
            $icds = Icd::all();
            return view('rekam_medis.create', compact(['patients', 'icds']));
        }
    }

    public function store(MedicalRecordRequest $request, FileRequest $fileRequest)
    {
        $input = $request->validated();
        $record = MedicalRecord::where('reservation_id', $input['reservation_id'])->first();
        if (!$record) {
            $record = MedicalRecord::create($input);
        } else {
            $record->update($input);
        }

        if ($fileRequest->hasFile('files')) {
            foreach ($fileRequest->file('files') as $file) {
                $filePath = $file->store('record_files/' . $request->patient_id . '/' . $record->id, 'public');

                File::create([
                    'medical_record_id' => $record->id,
                    'title' => $this->sanitizeFilename($file->getClientOriginalName()),
                    'type' => $file->getClientOriginalExtension(),
                    'url' => $filePath,
                ]);
            }
        }


        if ($record->reservation->schedule->schedule_type->name == 'Umum') {
            $record->reservation->update(['status' => 2]);
            return redirect()->route('admin.medis.index')->with('success', 'Rekam Medis berhasil Ditambahkan !');
        } else {
            return redirect()->route('admin.rme.gigi.create', ['id' => $record->id]);
        }
    }

    private function sanitizeFilename($filename)
    {
        return preg_replace('/[^a-zA-Z0-9_.\-]/', '_', $filename);
    }

    public function show($id)
    {
        $medical_record = MedicalRecord::find($id);
        return view('rekam_medis.show', compact('medical_record'));
    }

    public function edit($id)
    {
        $medical_record = MedicalRecord::with('reservation', 'icd')->find($id);
        $patients = Patient::all();
        return view('rekam_medis.edit', compact(['medical_record', 'patients']));
    }

    public function update(MedicalRecordRequest $request, FileRequest $fileRequest, $id)
    {
        $medical_record = MedicalRecord::findOrFail($id);
        $input = $request->validated();
        if ($fileRequest->hasFile('files')) {
            foreach ($fileRequest->file('files') as $file) {
                $filePath = $file->store('record_files/' . $request->patient_id . '/' . $id, 'public');

                File::create([
                    'medical_record_id' => $id,
                    'title' => $this->sanitizeFilename($file->getClientOriginalName()),
                    'type' => $file->getClientOriginalExtension(),
                    'url' => $filePath,
                ]);
            }
        }
        $medical_record->update($input);
        return redirect()->route('admin.medis.index')->with('success', 'Rekam medis berhasil diupdate !');
    }

    public function destroy($id)
    {
        $data = MedicalRecord::where('id', $id)->first();

        if ($data) {
            if ($data->files) {
                $data->files()->delete();
            }

            if ($data->odontograms) {
                $data->odontograms()->each(function ($odontogram) {
                    $odontogram->symbols()->detach();
                });

                $data->odontograms()->delete();
            }

            $data->forceDelete();

            return back()->with('success', 'Rekam medis deleted successfully!');
        }

        return back()->with('error', 'Odontogram not found.');
    }
}
