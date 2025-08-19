<?php

namespace App\Http\Controllers;

use App\Models\PSS4Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PSS4AssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'pss4_q1' => 'required|integer|min:0|max:4',
            'pss4_q2' => 'required|integer|min:0|max:4',
            'pss4_q3' => 'required|integer|min:0|max:4',
            'pss4_q4' => 'required|integer|min:0|max:4',
            'total_score' => 'required|integer|min:0|max:16',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $total = (int) $request->total_score;
        [$stress_level, $stress_category, $interpretation] = $this->classify($total);

        $existing = PSS4Assessment::where('patient_id', $request->patient_id)->first();
        $payload = array_merge($request->all(), compact('stress_level', 'stress_category', 'interpretation'));

        if ($existing) {
            $existing->update($payload);
            $assessment = $existing;
        } else {
            $assessment = PSS4Assessment::create($payload);
        }

        return response()->json(['success' => true, 'message' => 'PSS-4 assessment saved successfully', 'data' => $assessment]);
    }

    public function show($patientId)
    {
        $assessment = PSS4Assessment::where('patient_id', $patientId)->latest()->first();
        if (!$assessment) {
            return response()->json(['success' => false, 'message' => 'No PSS-4 assessment found for this patient'], 404);
        }
        return response()->json(['success' => true, 'data' => $assessment]);
    }

    public function update(Request $request, $id)
    {
        $assessment = PSS4Assessment::findOrFail($id);
        return $this->store($request->merge(['patient_id' => $assessment->patient_id]));
    }

    private function classify(int $total): array
    {
        if ($total <= 4) {
            return ['Low Stress', 'Low', 'Low perceived stress; continue current strategies.'];
        }
        if ($total <= 8) {
            return ['Mild to Moderate Stress', 'Mild-Moderate', 'Normal range; consider stress management techniques.'];
        }
        if ($total <= 12) {
            return ['Moderate to High Stress', 'Moderate-High', 'Elevated stress; consider interventions, possibly professional guidance.'];
        }
        return ['High Stress', 'High', 'High stress; professional intervention recommended.'];
    }
}


