<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\STOPBANGAssessment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class STOPBANGAssessmentController extends Controller
{
    /**
     * Store a newly created STOP-BANG assessment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'stopbang_q1' => 'required|integer|in:0,1',
            'stopbang_q2' => 'required|integer|in:0,1',
            'stopbang_q3' => 'required|integer|in:0,1',
            'stopbang_q4' => 'required|integer|in:0,1',
            'stopbang_q5' => 'required|integer|in:0,1',
            'stopbang_q6' => 'required|integer|in:0,1',
            'stopbang_q7' => 'required|integer|in:0,1',
            'stopbang_q8' => 'required|integer|in:0,1',
            'total_score' => 'required|integer|min:0|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculate risk level and interpretation
        $totalScore = $request->total_score;
        $riskLevel = $this->calculateRiskLevel($totalScore);
        $interpretation = $this->getInterpretation($totalScore);
        $recommendations = $this->getRecommendations($totalScore);

        // Check if there's an existing assessment for this patient
        $existingAssessment = STOPBANGAssessment::where('patient_id', $request->patient_id)->first();

        if ($existingAssessment) {
            // Update existing assessment
            $existingAssessment->update(array_merge($request->all(), [
                'risk_level' => $riskLevel,
                'interpretation' => $interpretation,
                'recommendations' => $recommendations,
            ]));
            $assessment = $existingAssessment;
        } else {
            // Create new assessment
            $assessment = STOPBANGAssessment::create(array_merge($request->all(), [
                'risk_level' => $riskLevel,
                'interpretation' => $interpretation,
                'recommendations' => $recommendations,
            ]));
        }

        return response()->json([
            'success' => true,
            'message' => 'STOP-BANG assessment saved successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Get the latest STOP-BANG assessment for a patient.
     */
    public function show($patientId)
    {
        $assessment = STOPBANGAssessment::where('patient_id', $patientId)
            ->latest()
            ->first();

        if (!$assessment) {
            return response()->json([
                'success' => false,
                'message' => 'No STOP-BANG assessment found for this patient'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $assessment
        ]);
    }

    /**
     * Update the specified STOP-BANG assessment.
     */
    public function update(Request $request, $id)
    {
        $assessment = STOPBANGAssessment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'stopbang_q1' => 'required|integer|in:0,1',
            'stopbang_q2' => 'required|integer|in:0,1',
            'stopbang_q3' => 'required|integer|in:0,1',
            'stopbang_q4' => 'required|integer|in:0,1',
            'stopbang_q5' => 'required|integer|in:0,1',
            'stopbang_q6' => 'required|integer|in:0,1',
            'stopbang_q7' => 'required|integer|in:0,1',
            'stopbang_q8' => 'required|integer|in:0,1',
            'total_score' => 'required|integer|min:0|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculate risk level and interpretation
        $totalScore = $request->total_score;
        $riskLevel = $this->calculateRiskLevel($totalScore);
        $interpretation = $this->getInterpretation($totalScore);
        $recommendations = $this->getRecommendations($totalScore);

        $assessment->update(array_merge($request->all(), [
            'risk_level' => $riskLevel,
            'interpretation' => $interpretation,
            'recommendations' => $recommendations,
        ]));

        return response()->json([
            'success' => true,
            'message' => 'STOP-BANG assessment updated successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Calculate risk level based on total score.
     */
    private function calculateRiskLevel($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 2) {
            return 'Low';
        } elseif ($totalScore >= 3 && $totalScore <= 4) {
            return 'Intermediate';
        } else {
            return 'High';
        }
    }

    /**
     * Get interpretation based on total score.
     */
    private function getInterpretation($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 2) {
            return 'Low risk of obstructive sleep apnea';
        } elseif ($totalScore >= 3 && $totalScore <= 4) {
            return 'Intermediate risk of obstructive sleep apnea';
        } else {
            return 'High risk of obstructive sleep apnea';
        }
    }

    /**
     * Get recommendations based on total score.
     */
    private function getRecommendations($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 2) {
            return 'Your risk of obstructive sleep apnea is low. Continue maintaining good sleep habits and regular health check-ups.';
        } elseif ($totalScore >= 3 && $totalScore <= 4) {
            return 'You have an intermediate risk of obstructive sleep apnea. Consider consulting with a healthcare provider for further evaluation. A sleep study may be recommended.';
        } else {
            return 'You have a high risk of obstructive sleep apnea. Strongly recommend consulting with a healthcare provider or sleep specialist for evaluation. A sleep study is likely needed to confirm the diagnosis and determine appropriate treatment options.';
        }
    }
}
