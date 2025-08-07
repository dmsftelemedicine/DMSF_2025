<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ESS8Assessment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ESS8AssessmentController extends Controller
{
    /**
     * Store a newly created ESS-8 assessment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'ess_q1' => 'required|integer|min:0|max:3',
            'ess_q2' => 'required|integer|min:0|max:3',
            'ess_q3' => 'required|integer|min:0|max:3',
            'ess_q4' => 'required|integer|min:0|max:3',
            'ess_q5' => 'required|integer|min:0|max:3',
            'ess_q6' => 'required|integer|min:0|max:3',
            'ess_q7' => 'required|integer|min:0|max:3',
            'ess_q8' => 'required|integer|min:0|max:3',
            'total_score' => 'required|integer|min:0|max:24',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculate severity and interpretation
        $totalScore = $request->total_score;
        $severity = $this->calculateSeverity($totalScore);
        $interpretation = $this->getInterpretation($totalScore);
        $recommendations = $this->getRecommendations($totalScore);

        // Check if there's an existing assessment for this patient
        $existingAssessment = ESS8Assessment::where('patient_id', $request->patient_id)->first();

        if ($existingAssessment) {
            // Update existing assessment
            $existingAssessment->update(array_merge($request->all(), [
                'severity' => $severity,
                'interpretation' => $interpretation,
                'recommendations' => $recommendations,
            ]));
            $assessment = $existingAssessment;
        } else {
            // Create new assessment
            $assessment = ESS8Assessment::create(array_merge($request->all(), [
                'severity' => $severity,
                'interpretation' => $interpretation,
                'recommendations' => $recommendations,
            ]));
        }

        return response()->json([
            'success' => true,
            'message' => 'ESS-8 assessment saved successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Get the latest ESS-8 assessment for a patient.
     */
    public function show($patientId)
    {
        $assessment = ESS8Assessment::where('patient_id', $patientId)
            ->latest()
            ->first();

        if (!$assessment) {
            return response()->json([
                'success' => false,
                'message' => 'No ESS-8 assessment found for this patient'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $assessment
        ]);
    }

    /**
     * Update the specified ESS-8 assessment.
     */
    public function update(Request $request, $id)
    {
        $assessment = ESS8Assessment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'ess_q1' => 'required|integer|min:0|max:3',
            'ess_q2' => 'required|integer|min:0|max:3',
            'ess_q3' => 'required|integer|min:0|max:3',
            'ess_q4' => 'required|integer|min:0|max:3',
            'ess_q5' => 'required|integer|min:0|max:3',
            'ess_q6' => 'required|integer|min:0|max:3',
            'ess_q7' => 'required|integer|min:0|max:3',
            'ess_q8' => 'required|integer|min:0|max:3',
            'total_score' => 'required|integer|min:0|max:24',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculate severity and interpretation
        $totalScore = $request->total_score;
        $severity = $this->calculateSeverity($totalScore);
        $interpretation = $this->getInterpretation($totalScore);
        $recommendations = $this->getRecommendations($totalScore);

        $assessment->update(array_merge($request->all(), [
            'severity' => $severity,
            'interpretation' => $interpretation,
            'recommendations' => $recommendations,
        ]));

        return response()->json([
            'success' => true,
            'message' => 'ESS-8 assessment updated successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Calculate severity based on total score.
     */
    private function calculateSeverity($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 5) {
            return 'Normal';
        } elseif ($totalScore >= 6 && $totalScore <= 10) {
            return 'Mild';
        } elseif ($totalScore >= 11 && $totalScore <= 15) {
            return 'Moderate';
        } else {
            return 'Severe';
        }
    }

    /**
     * Get interpretation based on total score.
     */
    private function getInterpretation($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 5) {
            return 'Lower normal daytime sleepiness';
        } elseif ($totalScore >= 6 && $totalScore <= 10) {
            return 'Higher normal daytime sleepiness';
        } elseif ($totalScore >= 11 && $totalScore <= 15) {
            return 'Mild excessive daytime sleepiness';
        } else {
            return 'Moderate to severe excessive daytime sleepiness';
        }
    }

    /**
     * Get recommendations based on total score.
     */
    private function getRecommendations($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 5) {
            return 'Your daytime sleepiness is within normal limits. Continue maintaining good sleep habits and regular sleep schedule.';
        } elseif ($totalScore >= 6 && $totalScore <= 10) {
            return 'You may have slightly elevated daytime sleepiness. Consider improving sleep hygiene and ensuring adequate sleep duration.';
        } elseif ($totalScore >= 11 && $totalScore <= 15) {
            return 'You have mild excessive daytime sleepiness. Consider consulting with a healthcare provider. This may indicate underlying sleep disorders or insufficient sleep.';
        } else {
            return 'You have moderate to severe excessive daytime sleepiness. Strongly recommend consulting with a healthcare provider or sleep specialist. This may indicate sleep disorders such as sleep apnea, narcolepsy, or other conditions.';
        }
    }
}
