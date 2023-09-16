<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update($id, PatientRequest $patientRequest)
    {
        $patient = Patient::findOrFail($id);
        $input = $patientRequest->validated();
        $patient->update($input);
        return response()->json(['data' => $patient, 'success' => 'Patient updated successfully']);
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json(['data' => $patient]);
    }
}
