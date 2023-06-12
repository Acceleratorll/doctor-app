<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalRecordRequest;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordManageController extends Controller
{
    public function index()
    {
        $medical_records = MedicalRecord::with('patient')->latest()->get();
        return view('rekam_medis.index', compact('medical_records'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('rekam_medis.create', compact('patients'));
    }

    public function store(MedicalRecordRequest $request)
    {
        $input = $request->validated();
        MedicalRecord::create($input);
        return redirect()->route('admin.medis.index');
    }

    public function show($id)
    {
        $medical_record = MedicalRecord::find($id);
        return view('rekam_medis.show', compact('medical_record'));
    }

    public function edit($id)
    {
        $medical_record = MedicalRecord::with('patient')->find($id);
        $patients = Patient::all();
        return view('rekam_medis.edit', compact(['medical_record', 'patients']));
    }

    public function update(MedicalRecordRequest $request, $id)
    {
        $medical_record = MedicalRecord::findOrFail($id);
        $input = $request->validated();
        $medical_record->update($input);
        return redirect()->route('admin.medis.index');
    }

    public function destroy($id)
    {
        MedicalRecord::findOrFail($id)->delete();
        return back();
    }
}
