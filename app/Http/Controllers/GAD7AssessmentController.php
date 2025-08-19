<?php

namespace App\Http\Controllers;

use App\Models\GAD7Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GAD7AssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'gad7_q1' => 'required|integer|min:0|max:3',
            'gad7_q2' => 'required|integer|min:0|max:3',
            'gad7_q3' => 'required|integer|min:0|max:3',
            'gad7_q4' => 'required|integer|min:0|max:3',
            'gad7_q5' => 'required|integer|min:0|max:3',
            'gad7_q6' => 'required|integer|min:0|max:3',
            'gad7_q7' => 'required|integer|min:0|max:3',
            'gad7_difficulty' => 'nullable|in:not_difficult,somewhat_difficult,very_difficult,extremely_difficult',
            'total_score' => 'required|integer|min:0|max:21',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $totalScore = (int) $request->total_score;
        [$severity, $remarks] = $this->classify($totalScore);

        $existing = GAD7Assessment::where('patient_id', $request->patient_id)->first();
        $payload = array_merge($request->all(), compact('severity', 'remarks'));

        if ($existing) {
            $existing->update($payload);
            $assessment = $existing;
        } else {
            $assessment = GAD7Assessment::create($payload);
        }

        return response()->json(['success' => true, 'message' => 'GAD-7 assessment saved successfully', 'data' => $assessment]);
    }

    public function show($patientId)
    {
        $assessment = GAD7Assessment::where('patient_id', $patientId)->latest()->first();
        if (!$assessment) {
            return response()->json(['success' => false, 'message' => 'No GAD-7 assessment found for this patient'], 404);
        }
        return response()->json(['success' => true, 'data' => $assessment]);
    }

    public function update(Request $request, $id)
    {
        $assessment = GAD7Assessment::findOrFail($id);
        return $this->store($request->merge(['patient_id' => $assessment->patient_id]));
    }

    private function classify(int $total): array
    {
        if ($total <= 5) {
            return ['Mild Anxiety', 'May reflect normal worry or early signs of anxiety. Education and self-care strategies advised.'];
        }
        if ($total <= 10) {
            return ['Moderate Anxiety', 'May interfere with functioning. Consider psychoeducation, brief counseling, or referral.'];
        }
        if ($total <= 14) {
            return ['Moderately Severe Anxiety', 'Likely to impact daily life. Further evaluation recommended; CBT and/or medication may help.'];
        }
        return ['Severe Anxiety', 'Strong indication of anxiety disorder. Prompt referral; may require combined therapy.'];
    }
}


