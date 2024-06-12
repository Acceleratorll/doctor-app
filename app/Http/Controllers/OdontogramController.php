<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\MedicalRecord;
use App\Models\Odontogram;
use App\Models\Quadrant;
use App\Models\Reservation;
use App\Models\Teeth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OdontogramController extends Controller
{
    public function index()
    {
        $data = MedicalRecord::with('odontograms', 'reservation.schedule.schedule_type', 'reservation.patient.user', 'reservation.schedule.employee.user')
            ->whereHas('reservation', function ($q) {
                $q->whereHas('schedule', function ($q) {
                    $q->whereHas('schedule_type', function ($q) {
                        $q->where('name', 'like', '%Gigi%');
                    });
                });
            })
            ->whereHas('odontograms')
            ->get();

        return view('odontogram.index', compact('data'));
    }

    public function create($id)
    {
        $reservation = MedicalRecord::find($id)->reservation;
        $groups = Group::with('symbols')->get();
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

        return view('odontogram.create', compact(['groups', 'right', 'mid1', 'mid2', 'left', 'reservation', 'id']));
    }

    public function edit($id)
    {
        $medicalRecord = MedicalRecord::find($id);
        $groups = Group::with('symbols')->get();

        $teethSymbols = [];
        $diastema = [];
        $anomali = [];
        $others = [];

        // Check if the medical record has odontograms
        if ($medicalRecord->odontograms) {
            foreach ($medicalRecord->odontograms as $odontogram) {
                // Retrieve the symbols associated with the odontogram
                $symbols = $odontogram->symbols;
                // Map symbols to their corresponding teeth and store them in the $teethSymbols array
                foreach ($symbols as $symbol) {
                    $teethSymbols[$odontogram->teeth_id][] = $symbol->id;
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
        return view('odontogram.edit', compact('medicalRecord', 'groups', 'teethSymbols', 'right', 'mid1', 'mid2', 'left', 'diastemaValue', 'anomaliValue', 'othersValue'));
    }

    public function fetch($id)
    {
        $medicalRecord = MedicalRecord::whereHas('reservation.patient', function ($query) use ($id) {
            $query->where('id', $id);
        })->with('odontograms.teeth', 'odontograms.symbols')->latest()->first();

        if (!$medicalRecord) {
            return response()->json(['error' => 'Medical record not found'], 404);
        }

        // Transform the data as needed before returning
        $odontograms = $medicalRecord->odontograms->map(function ($odontogram) {
            return [
                'tooth_number' => $odontogram->teeth->fdi,
                'description' => $odontogram->symbols->pluck('short')->implode(', '),
            ];
        });

        $additionalData = [
            'palatum' => ucfirst($medicalRecord->palatum),
            'torus_mandibularis' => ucfirst($medicalRecord->torus_mandibularis),
            'torus_palatinus' => ucfirst($medicalRecord->torus_palatinus),
            'occlusi' => $medicalRecord->occlusi,
        ];

        return response()->json([
            'odontograms' => $odontograms,
            'additional_data' => $additionalData,
            'medical_record_id' => $medicalRecord->id,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'medical_record_id' => 'required|integer',
                'teeth' => 'array',
                'occlusi' => 'required|string',
                'torus_palatinus' => 'required|string',
                'torus_mandibularis' => 'required|string',
                'palatum' => 'required|string',
                'diastema' => 'nullable|string',
                'anomali' => 'nullable|string',
                'others' => 'nullable|string',
            ]);

            // Extract trimmed data from input strings
            $diastema = $this->getTrimmedData($validatedData['diastema']);
            $anomali = $this->getTrimmedData($validatedData['anomali']);
            $others = $this->getTrimmedData($validatedData['others']);

            DB::beginTransaction();

            $medicalRecord = MedicalRecord::find($request->medical_record_id);
            $medicalRecord->update([
                'occlusi' => $validatedData['occlusi'],
                'palatum' => $validatedData['palatum'],
                'torus_palatinus' => $validatedData['torus_palatinus'],
                'torus_mandibularis' => $validatedData['torus_mandibularis'],
            ]);

            if (isset($validatedData['teeth'])) {
                foreach ($validatedData['teeth'] as $teethId => $symbols) {
                    $fdi = Teeth::find($teethId)->fdi;
                    $diastemaValue = $this->getDescriptionForTooth($diastema, $fdi);
                    $anomaliValue = $this->getDescriptionForTooth($anomali, $fdi);
                    $othersValue = $this->getDescriptionForTooth($others, $fdi);

                    $odontogram = Odontogram::create([
                        'medical_record_id' => $medicalRecord->id,
                        'teeth_id' => $teethId,
                        'diastema' => implode(', ', $diastemaValue),
                        'anomali' => implode(', ', $anomaliValue),
                        'others' => implode(', ', $othersValue),
                    ]);

                    foreach ($symbols as $s) {
                        $odontogram->symbols()->attach($s);
                    }
                }
            }

            $medicalRecord->reservation->update(['status' => 2]);

            DB::commit();

            return redirect()->route('admin.rme.gigi.index')->with('success', 'Medical record and odontogram created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        $validatedData = $request->validate([
            'reservation_id' => 'required|integer',
            'teeth' => 'array',
            'occlusi' => 'required|string',
            'torus_palatinus' => 'required|string',
            'torus_mandibularis' => 'required|string',
            'palatum' => 'required|string',
            'diastema' => 'nullable|string',
            'anomali' => 'nullable|string',
            'others' => 'nullable|string',
        ]);

        $diastema = $this->getTrimmedData($validatedData['diastema']);
        $anomali = $this->getTrimmedData($validatedData['anomali']);
        $others = $this->getTrimmedData($validatedData['others']);

        // Check if $medicalRecord is not null before updating
        if ($medicalRecord) {
            $medicalRecord->update([
                'occlusi' => $validatedData['occlusi'],
                'palatum' => $validatedData['palatum'],
                'torus_palatinus' => $validatedData['torus_palatinus'],
                'torus_mandibularis' => $validatedData['torus_mandibularis'],
            ]);
        }

        $deletedOdontogramIds = Odontogram::where('medical_record_id', $medicalRecord->id)
            ->whereNotIn('teeth_id', array_keys($validatedData['teeth']))
            ->pluck('id');

        if (count($deletedOdontogramIds)) {
            // Disable foreign key check before deleting Odontograms
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Delete Odontogram if not in $validatedData['teeth']
            try {
                Odontogram::whereIn('id', $deletedOdontogramIds)->delete();
            } catch (\Illuminate\Database\QueryException $e) {
                // Ignore error about foreign key constraint
            }

            // Enable foreign key check after deleting Odontograms
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        if (isset($validatedData['teeth'])) {
            foreach ($validatedData['teeth'] as $teethId => $symbols) {
                $teeth = Teeth::find($teethId);
                if ($teeth) {
                    $fdi = $teeth->fdi;
                } else {
                    continue;
                }

                $diastemaValue = $this->getDescriptionForTooth($diastema, $fdi);
                $anomaliValue = $this->getDescriptionForTooth($anomali, $fdi);
                $othersValue = $this->getDescriptionForTooth($others, $fdi);

                $odontogram = Odontogram::where('medical_record_id', $medicalRecord->id)
                    ->where('teeth_id', $teethId)
                    ->first();

                if ($odontogram) {
                    $odontogram->update([
                        'diastema' => implode(', ', $diastemaValue),
                        'anomali' => implode(', ', $anomaliValue),
                        'others' => implode(', ', $othersValue),
                    ]);

                    $deletedSymbolIds = $odontogram->symbols->pluck('id')->diff($symbols);
                    $odontogram->symbols()->detach($deletedSymbolIds);
                    $odontogram->symbols()->sync($symbols);
                } else {
                    $odontogram = Odontogram::create([
                        'medical_record_id' => $medicalRecord->id,
                        'teeth_id' => $teethId,
                        'diastema' => implode(', ', $diastemaValue),
                        'anomali' => implode(', ', $anomaliValue),
                        'others' => implode(', ', $othersValue),
                    ]);

                    $odontogram->symbols()->attach($symbols);
                }
            }
        }

        return redirect()->route('admin.rme.gigi.index')->with('success', 'Medical record and odontogram updated successfully.');
    }

    public function destroy($id)
    {
        $data = MedicalRecord::where('id', $id)->first();

        if ($data) {
            if($data->files){
                $data->files()->delete();
            }

            $data->odontograms()->each(function ($odontogram) {
                $odontogram->symbols()->detach(); // Remove associations with symbols
            });

            $data->odontograms()->delete();
            
            return back()->with('success', 'Odontogram deleted successfully.');
        }

        return back()->with('error', 'Odontogram not found.');
    }

    private function getDescriptionForTooth($data, $toothNumber)
    {
        $descriptions = [];

        foreach ($data as $descriptionArray) {
            // Check if $descriptionArray is an array
            if ($descriptionArray['tooth_number'] == $toothNumber) {
                $descriptions[] = $descriptionArray['description'];
            }
        }

        return $descriptions;
    }

    private function getTrimmedData($input)
    {
        $data = [];

        if ($input !== '') {
            $parts = array_map('trim', explode(',', $input));
            foreach ($parts as $part) {
                $matches = [];
                if (preg_match('/^(\d+)\s+(.+)$/', $part, $matches)) {
                    $toothNumber = $matches[1];
                    $description = $matches[2];
                    $data[] = ['tooth_number' => $toothNumber, 'description' => $description];
                }
            }
        }
        return $data;
    }
}
