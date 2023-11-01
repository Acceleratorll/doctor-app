<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessCodeRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class AccessCodeController extends Controller
{
    public function index()
    {
        return view('access_code.index');
    }

    public function create()
    {
        return view('access_code.create');
    }

    public function saveCode(Request $request)
    {
        $request->validate([
            'access_code' => 'required|numeric|digits:4',
        ]);

        $patient = Patient::findOrFail(auth()->user()->patient->id);
        $patient->update(['access_code' => $request->access_code]);
        return redirect()->route('profile.index')->with('success', 'Pin set up successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('access_code.edit');
    }

    public function verifyCode(AccessCodeRequest $request)
    {
        $id = auth()->user()->patient->id;
        $patient = Patient::findOrFail($id);
        if ($patient->access_code == $request->access_code) {
            session()->put('data', $patient->reservations);
            return redirect()->route('profile.index')->with('success', 'Access code match !');
        }
        return redirect()->back()->withErrors(['access_code' => 'Incorrect Pin.']);
    }

    public function update(AccessCodeRequest $request, $id)
    {
        $id = auth()->user()->patient->id;
        $patient = Patient::findOrFail($id);
        if ($patient->access_code !== (int)$request->access_code) {
            return response()->json('error', 'Pin Salah!');
        } else {
            $patient->update(['access_code' => $request->access_code_new]);
            return redirect()->route('profile.index')->with('success', 'Pin updated successfully!');
        }
    }

    public function destroy($id)
    {
        //
    }
}
