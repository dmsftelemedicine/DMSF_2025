<?php

namespace App\Http\Controllers;

use App\Models\ExclusionCriteria;
use App\Models\Patient;
use Illuminate\Http\Request;

class ResearchExclusionController extends Controller
{
    public function check($patientId)
    {
        // Check if the patient has already submitted the form
        $exclusion = ExclusionCriteria::where('patient_id', $patientId)->first();

        if ($exclusion) {
            // Return the existing data if it exists
            return response()->json(['form_exists' => true, 'data' => $exclusion]);
        }

        // Return false if the form has not been submitted yet
        return response()->json(['form_exists' => false]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'emergency_unstable_case' => 'required|in:yes,no,na',
            'psychiatric_neuro_condition' => 'required|in:yes,no,na',
            'unable_complete_data' => 'required|in:yes,no,na',
            'confined_or_no_activity' => 'required|in:yes,no,na',
            'unable_feed_cook_decide' => 'required|in:yes,no,na',
            'pregnant_woman' => 'required|in:yes,no,na',
        ]);

        // Check if a record already exists for this patient
        $existingRecord = ExclusionCriteria::where('patient_id', $request->patient_id)->first();
        if ($existingRecord) {
            return response()->json(['message' => 'Exclusion criteria already exists for this patient.'], 409);
        }

        // Create the exclusion criteria record
        $exclusion = ExclusionCriteria::create($validated);

        return response()->json([
            'message' => 'Exclusion criteria saved successfully!',
            'data' => $exclusion
        ]);
    }
} 