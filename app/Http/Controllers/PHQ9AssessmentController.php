<?php

namespace App\Http\Controllers;

use App\Models\PHQ9Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PHQ9AssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'phq9_q1' => 'required|integer|min:0|max:3',
            'phq9_q2' => 'required|integer|min:0|max:3',
            'phq9_q3' => 'required|integer|min:0|max:3',
            'phq9_q4' => 'required|integer|min:0|max:3',
            'phq9_q5' => 'required|integer|min:0|max:3',
            'phq9_q6' => 'required|integer|min:0|max:3',
            'phq9_q7' => 'required|integer|min:0|max:3',
            'phq9_q8' => 'required|integer|min:0|max:3',
            'phq9_q9' => 'required|integer|min:0|max:3',
            'total_score' => 'required|integer|min:0|max:27',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $total = (int) $request->total_score;
        [$severity, $remarks] = $this->classify($total);

        // Suicide risk based on Q9
        $q9 = (int) $request->phq9_q9;
        $suicideRisk = 'Low Risk';
        if ($q9 >= 1) {
            $suicideRisk = $q9 === 3 ? 'HIGH RISK - Immediate evaluation needed' : 'Moderate Risk - Monitor closely';
            $remarks .= ' SUICIDE RISK ASSESSMENT REQUIRED';
        }

        $existing = PHQ9Assessment::where('patient_id', $request->patient_id)->first();
        $payload = array_merge($request->all(), [
            'severity' => $severity,
            'suicide_risk' => $suicideRisk,
            'remarks' => $remarks,
        ]);

        $assessment = $existing ? tap($existing)->update($payload) : PHQ9Assessment::create($payload);

        return response()->json(['success' => true, 'message' => 'PHQ-9 assessment saved successfully', 'data' => $assessment]);
    }

    public function show($patientId)
    {
        $assessment = PHQ9Assessment::where('patient_id', $patientId)->latest()->first();
        if (!$assessment) {
            return response()->json(['success' => false, 'message' => 'No PHQ-9 assessment found for this patient'], 404);
        }
        return response()->json(['success' => true, 'data' => $assessment]);
    }

    public function update(Request $request, $id)
    {
        $assessment = PHQ9Assessment::findOrFail($id);
        return $this->store($request->merge(['patient_id' => $assessment->patient_id]));
    }

    private function classify(int $total): array
    {
        if ($total <= 4) return ['Minimal Depression', 'No significant depressive symptoms. Continue monitoring if risk factors are present.'];
        if ($total <= 9) return ['Mild Depression', 'May reflect normal mood variation. Consider psychoeducation and self-care strategies.'];
        if ($total <= 14) return ['Moderate Depression', 'Likely to impact daily functioning. Consider counseling or evaluation.'];
        if ($total <= 19) return ['Moderately Severe Depression', 'Significant impairment likely. Prompt referral recommended.'];
        return ['Severe Depression', 'Severe impairment. Urgent referral essential; consider safety concerns.'];
    }
}


