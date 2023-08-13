<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->patient->id;
        $today = Carbon::today()->toString();
        $records = MedicalRecord::where('patient_id', $id)->latest()->get();
        $reservation = Reservation::with('schedule')
            ->where('patient_id', $id)
            ->whereHas('schedule', function ($query) use ($today) {
                $query->where('schedule_date', '>=', $today);
            })
            ->where('status', 0)
            ->first();

        $data = session()->get('data');
        session()->forget('data');

        return view('web.pasien.index', compact(['records', 'reservation', 'data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('web.pasien.edit');
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
        ]);

        $patient->update([
            'user_id' => $user->id,
            'height' => $input['height'],
            'weight' => $input['weight'],
        ]);
        return redirect()->route('profile.index');
    }

    public function getMedical(Request $request)
    {
        if ($request->access_code != null) {
            $user = auth()->user();
            $access_code = $user->patient->access_code;

            if ($request->access_code === $access_code) {
                return $this->fetchMedicalRecords($user);
            } else {
                return response()->json(['error' => 'Invalid PIN'], 400);
            }
        }
    }

    private function fetchMedicalRecords($user)
    {
        $records = $user->patient->records;

        $view = view('partial.medical', compact('records'))->render();
        return response()->json(['success' => true, 'html' => $view]);
    }

    public function destroy($id)
    {
        //
    }
}
