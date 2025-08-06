<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SleepInitialAssessment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SleepInitialAssessmentController extends Controller
{
    /**
     * Store a newly created sleep initial assessment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'sleep_time' => 'required|date_format:H:i',
            'wake_up_time' => 'required|date_format:H:i',
            'usual_sleep_duration' => 'required|numeric|min:0|max:24',
            'sleep_quality_rating' => 'required|integer|min:1|max:10',
            'hygiene_activities' => 'nullable|array',
            'hygiene_activities.*' => 'string|in:alcohol,large_meal,coffee,gadgets,intense_exercise',
            'daytime_sleepiness' => 'required|in:yes,no',
            'blood_pressure' => 'nullable|string',
            'bmi' => 'nullable|numeric|min:15|max:60',
            'age' => 'nullable|integer|min:18|max:120',
            'neck_circumference' => 'nullable|numeric|min:20|max:60',
            'gender' => 'nullable|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if there's an existing assessment for this patient
        $existingAssessment = SleepInitialAssessment::where('patient_id', $request->patient_id)->first();

        if ($existingAssessment) {
            // Update existing assessment
            $existingAssessment->update($request->all());
            $assessment = $existingAssessment;
        } else {
            // Create new assessment
            $assessment = SleepInitialAssessment::create($request->all());
        }

        return response()->json([
            'success' => true,
            'message' => 'Sleep initial assessment saved successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Get the latest sleep initial assessment for a patient.
     */
    public function show($patientId)
    {
        $assessment = SleepInitialAssessment::where('patient_id', $patientId)
            ->latest()
            ->first();

        if (!$assessment) {
            return response()->json([
                'success' => false,
                'message' => 'No sleep initial assessment found for this patient'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $assessment
        ]);
    }

    /**
     * Update the specified sleep initial assessment.
     */
    public function update(Request $request, $id)
    {
        $assessment = SleepInitialAssessment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'sleep_time' => 'required|date_format:H:i',
            'wake_up_time' => 'required|date_format:H:i',
            'usual_sleep_duration' => 'required|numeric|min:0|max:24',
            'sleep_quality_rating' => 'required|integer|min:1|max:10',
            'hygiene_activities' => 'nullable|array',
            'hygiene_activities.*' => 'string|in:alcohol,large_meal,coffee,gadgets,intense_exercise',
            'daytime_sleepiness' => 'required|in:yes,no',
            'blood_pressure' => 'nullable|string',
            'bmi' => 'nullable|numeric|min:15|max:60',
            'age' => 'nullable|integer|min:18|max:120',
            'neck_circumference' => 'nullable|numeric|min:20|max:60',
            'gender' => 'nullable|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $assessment->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Sleep initial assessment updated successfully',
            'data' => $assessment
        ]);
    }
}
