<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalRecordRequest;
use App\Models\Group;
use App\Models\MedicalRecord;
use App\Models\Odontogram;
use App\Models\Quadrant;
use App\Models\Symbol;
use App\Models\Teeth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Ramsey\Uuid\Uuid;

class OdontogramController extends Controller
{
    public function index()
    {
        return view('odontogram.index');
    }

    public function create()
    {
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

        return view('odontogram.create', compact(['groups', 'right', 'mid1', 'mid2', 'left']));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'reservation_id' => 'nullable|integer',
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

        // Create a new medical record
        $medicalRecord = MedicalRecord::create([
            'occlusi' => $validatedData['occlusi'],
            'palatum' => $validatedData['palatum'],
            'torus_palatinus' => $validatedData['torus_palatinus'],
            'torus_mandibularis' => $validatedData['torus_mandibularis'],
        ]);

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

        return redirect()->route('admin.rme.gigi.index')->with('success', 'Medical record and odontogram created successfully.');
    }

    // Helper method to get descriptions for a specific tooth
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
