<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessCodeRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class AccessCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('access_code.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('access_code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCode(Request $request)
    {
        $request->validate([
            'access_code' => 'required|numeric|digits:4',
        ]);

        $patient = Patient::findOrFail(auth()->user()->patient->id);
        $patient->update(['access_code' => $request->access_code]);
        return redirect()->route('profile.index')->with('success', 'Pin set up successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('access_code.edit');
    }

    public function verifyCode(AccessCodeRequest $request)
    {
        $id = auth()->user()->patient->id;
        $patient = Patient::findOrFail($id);
        if ($patient->access_code == $request->access_code) {
            session()->put('data', $patient->medical_records);
            return redirect()->route('profile.index');
        }
        return redirect()->back()->withErrors(['access_code' => 'Incorrect Pin.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccessCodeRequest $request, $id)
    {
        $id = auth()->user()->patient->id;
        $patient = Patient::findOrFail($id);
        if ($patient->access_code != $request->access_code) {
            return back()->with('failed', 'Pin Salah!');
        }

        $patient->update(['access_code' => $request->access_code_new]);
        return redirect()->route('profile.index')->with('success', 'Pin updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
