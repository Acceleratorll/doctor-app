<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::latest()->get();
        return view('pasien.index', compact('patients'));
    }


    public function create()
    {
        return view('pasien.create');
    }


    public function store(PatientRequest $request)
    {
        $today = Carbon::today()->toDateString();
        if ($request['birth_date'] > $today) {
            return back()->withErrors(['message' => 'Masukkan Tanggal Lahir dengan Benar !']);
        } else {
            $input = $request->validated();
            Patient::create($input);
            return redirect()->route('pasien.index');
        }
    }


    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $input = $request->validated();
        $patient->update($input);
        return redirect()->route('pasien.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();
        return back();
    }
}
