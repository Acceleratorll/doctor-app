<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalRecordRequest;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // $request['employee_id'] = auth()->user()->id;
        $request['employee_id'] = 1;
        $input = $request->validated();
        MedicalRecord::create($input);
        return redirect()->route('rekam_medis.index');
    }

    public function show($id)
    {
        $medical_record = MedicalRecord::find($id);
        return view('rekam_medis.show', compact('medical_record'));
    }

    public function edit($id)
    {
        $medical_record = MedicalRecord::find($id);
        return view('rekam_medis.edit', compact('medical_record'));
    }

    public function update(Request $request, $id)
    {
        $medical_record = MedicalRecord::findOrFail($id);
        $medical_record->update($request);
        return view();
    }

    public function destroy($id)
    {
        MedicalRecord::findOrFail($id)->delete();
        return back();
    }
}
