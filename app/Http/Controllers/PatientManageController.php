<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientManageController extends Controller
{
    public function index()
    {
        $patients = Patient::with('user')->latest()->get();
        return view('pasien.index', compact('patients'));
    }


    public function create()
    {
        return view('pasien.create');
    }

    public function store(PatientRequest $request)
    {
        $input = $request->validated();
        $user = User::create([
            'role_id' => $input['role_id'],
            'name' => $input['name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'birth_date' => $input['birth_date'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => bcrypt($input['password']),
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $imagePath = $request->file('image')->store('patient_images', 'public');
            $user->update([
                'image' => $imagePath
            ]);
        }

        Patient::create([
            'user_id' => $user->id,
            'height' => $input['height'],
            'weight' => $input['weight'],
        ]);
        return redirect()->route('admin.pasien.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return view('pasien.edit', compact('patient'));
    }

    public function update(PatientRequest $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $input = $request->validated();
        $user = User::findOrFail($patient->user_id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($patient->user->image && Storage::exists($patient->user->image)) {
                Storage::delete($patient->user->image);
            }

            $imagePath = $request->file('image')->store('patient_images', 'public');
            $patient->user->update([
                'image' => $imagePath
            ]);
        }

        $user->update([
            'role_id' => $input['role_id'],
            'name' => $input['name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'birth_date' => $input['birth_date'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => bcrypt($input['password']),
        ]);

        $patient->update([
            'user_id' => $user->id,
            'height' => $input['height'],
            'weight' => $input['weight'],
        ]);

        return redirect()->route('admin.pasien.index');
    }

    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();
        return back();
    }
}
