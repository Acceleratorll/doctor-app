<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordManageController extends Controller
{
    public function index()
    {
        $medical_records = MedicalRecord::with('patient')->latest()->first();
        return view('rekam_medis.index', compact('medical_records'));
    }

    public function create()
    {
        return view('rekam_medis.create');
    }

    public function store(Request $request)
    {
        MedicalRecord::create($request);
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
        $medical_record = MedicalRecord::find($id);
        $medical_record->update($request);
        return view();
    }

    public function destroy($id)
    {
        MedicalRecord::findOrFail($id)->delete();
        return back();
    }
}
