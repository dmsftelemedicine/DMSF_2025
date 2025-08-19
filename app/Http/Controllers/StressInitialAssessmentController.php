<?php

namespace App\Http\Controllers;

use App\Models\StressInitialAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StressInitialAssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'stress_rating' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $existing = StressInitialAssessment::where('patient_id', $request->patient_id)->first();
        $assessment = $existing ? tap($existing)->update($request->all()) : StressInitialAssessment::create($request->all());

        return response()->json(['success' => true, 'message' => 'Stress initial assessment saved successfully', 'data' => $assessment]);
    }

    public function show($patientId)
    {
        $assessment = StressInitialAssessment::where('patient_id', $patientId)->latest()->first();
        if (!$assessment) {
            return response()->json(['success' => false, 'message' => 'No stress initial assessment found for this patient'], 404);
        }
        return response()->json(['success' => true, 'data' => $assessment]);
    }

    public function update(Request $request, $id)
    {
        $assessment = StressInitialAssessment::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'stress_rating' => 'required|integer|min:1|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $assessment->update($request->all());
        return response()->json(['success' => true, 'message' => 'Stress initial assessment updated successfully', 'data' => $assessment]);
    }
}


