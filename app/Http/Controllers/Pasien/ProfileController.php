<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\Group;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Quadrant;
use App\Models\Reservation;
use App\Models\Symbol;
use App\Models\Teeth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $id = auth()->user()->patient->id;
        $today = Carbon::today()->toString();
        $records = Reservation::whereHas('medical_record')->where('patient_id', $id)->get()->sortByDesc(function ($reservation) {
            return $reservation->schedule->schedule_date;
        });

        $reservation = Reservation::with('schedule')
            ->where('patient_id', $id)
            ->whereHas('schedule', function ($query) use ($today) {
                $query->where('schedule_date', '>=', $today);
            })
            ->where('status', 0)
            ->orWhere('status', 1)
            ->get()
            ->sortByDesc(function ($reservation) {
                return $reservation->schedule->schedule_date;
            });

        $data = session()->get('data');
        session()->forget('data');

        return view('web.pasien.index', compact(['records', 'reservation', 'data']));
    }

    public function print($id)
    {
        $record = MedicalRecord::find($id);
        $pdf = App::make('dompdf.wrapper');

        if (auth()->user()->patient->access_code == null || $record == null) {
            return redirect()->back()->with('error', 'No medical records available or access code not set.');
        } else if ($record->reservation->schedule->schedule_type->name == 'Gigi') {
            $symbols = Symbol::all();

            $teethSymbols = [];
            $diastema = [];
            $anomali = [];
            $others = [];

            // Check if the medical record has odontograms
            if ($record->odontograms) {
                foreach ($record->odontograms as $odontogram) {
                    // Retrieve the symbols associated with the odontogram
                    $symbols = $odontogram->symbols;
                    // Map symbols to their corresponding teeth and store them in the $teethSymbols array
                    foreach ($symbols as $symbol) {
                        $teethSymbols[$odontogram->teeth_id][] = $symbol->short;
                    }

                    $teeth = Teeth::find($odontogram->teeth_id);
                    // Add descriptions to the corresponding array
                    if ($odontogram->diastema) {
                        $diastema[] = $teeth->fdi . ' ' . $odontogram->diastema;
                    }
                    if ($odontogram->anomali) {
                        $anomali[] = $teeth->fdi . ' ' . $odontogram->anomali;
                    }
                    if ($odontogram->others) {
                        $others[] = $teeth->fdi . ' ' . $odontogram->others;
                    }
                }
            }


            // Implode arrays to form comma-separated strings
            $diastemaValue = implode(', ', $diastema);
            $anomaliValue = implode(', ', $anomali);
            $othersValue = implode(', ', $others);

            $quadrants = Quadrant::with(['teeths' => function ($query) {
                $query->orderBy('quadrant_id')->orderBy('fdi');
            }])->get();

            $q1 = $quadrants->find(1)->teeths->sortBy('fdi');
            $q2 = $quadrants->find(2)->teeths->sortByDesc('fdi');
            $q3 = $quadrants->find(3)->teeths->sortBy('fdi');
            $q4 = $quadrants->find(4)->teeths->sortByDesc('fdi');
            $q5 = $quadrants->find(5)->teeths->sortBy('fdi');
            $q6 = $quadrants->find(6)->teeths->sortByDesc('fdi');
            $q7 = $quadrants->find(7)->teeths->sortBy('fdi');
            $q8 = $quadrants->find(8)->teeths->sortByDesc('fdi');

            $right = $q2->merge($q1);
            $mid1 = $q6->merge($q5);
            $mid2 = $q7->merge($q8);
            $left = $q4->merge($q3);

            $pdf->loadView('web.pasien.print', compact('record', 'symbols', 'teethSymbols', 'right', 'mid1', 'mid2', 'left', 'diastemaValue', 'anomaliValue', 'othersValue'));
        } else {
            $pdf->loadView('web.pasien.print', compact('record'));
        }

        return $pdf->stream('rekam_medis.pdf');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('web.pasien.edit');
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
        $records = $user->patient->reservations;
        $view = view('partial.medical', compact('records'))->render();
        return response()->json(['success' => true, 'html' => $view]);
    }

    public function destroy($id)
    {
        //
    }
}
