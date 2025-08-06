<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SHI13Assessment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SHI13AssessmentController extends Controller
{
    /**
     * Store a newly created SHI-13 assessment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'shi_q1' => 'required|integer|min:1|max:5',
            'shi_q2' => 'required|integer|min:1|max:5',
            'shi_q3' => 'required|integer|min:1|max:5',
            'shi_q4' => 'required|integer|min:1|max:5',
            'shi_q5' => 'required|integer|min:1|max:5',
            'shi_q6' => 'required|integer|min:1|max:5',
            'shi_q7' => 'required|integer|min:1|max:5',
            'shi_q8' => 'required|integer|min:1|max:5',
            'shi_q9' => 'required|integer|min:1|max:5',
            'shi_q10' => 'required|integer|min:1|max:5',
            'shi_q11' => 'required|integer|min:1|max:5',
            'shi_q12' => 'required|integer|min:1|max:5',
            'shi_q13' => 'required|integer|min:1|max:5',
            'total_score' => 'required|integer|min:13|max:65',
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
        $existingAssessment = SHI13Assessment::where('patient_id', $request->patient_id)->first();

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
            $assessment = SHI13Assessment::create(array_merge($request->all(), [
                'severity' => $severity,
                'interpretation' => $interpretation,
                'recommendations' => $recommendations,
            ]));
        }

        return response()->json([
            'success' => true,
            'message' => 'SHI-13 assessment saved successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Get the latest SHI-13 assessment for a patient.
     */
    public function show($patientId)
    {
        $assessment = SHI13Assessment::where('patient_id', $patientId)
            ->latest()
            ->first();

        if (!$assessment) {
            return response()->json([
                'success' => false,
                'message' => 'No SHI-13 assessment found for this patient'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $assessment
        ]);
    }

    /**
     * Update the specified SHI-13 assessment.
     */
    public function update(Request $request, $id)
    {
        $assessment = SHI13Assessment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'shi_q1' => 'required|integer|min:1|max:5',
            'shi_q2' => 'required|integer|min:1|max:5',
            'shi_q3' => 'required|integer|min:1|max:5',
            'shi_q4' => 'required|integer|min:1|max:5',
            'shi_q5' => 'required|integer|min:1|max:5',
            'shi_q6' => 'required|integer|min:1|max:5',
            'shi_q7' => 'required|integer|min:1|max:5',
            'shi_q8' => 'required|integer|min:1|max:5',
            'shi_q9' => 'required|integer|min:1|max:5',
            'shi_q10' => 'required|integer|min:1|max:5',
            'shi_q11' => 'required|integer|min:1|max:5',
            'shi_q12' => 'required|integer|min:1|max:5',
            'shi_q13' => 'required|integer|min:1|max:5',
            'total_score' => 'required|integer|min:13|max:65',
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
            'message' => 'SHI-13 assessment updated successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Calculate severity based on total score.
     */
    private function calculateSeverity($totalScore)
    {
        if ($totalScore < 26) {
            return 'Good';
        } elseif ($totalScore >= 27 && $totalScore <= 34) {
            return 'Average';
        } else {
            return 'Poor';
        }
    }

    /**
     * Get interpretation based on total score.
     */
    private function getInterpretation($totalScore)
    {
        if ($totalScore < 26) {
            return 'Good sleep hygiene practices';
        } elseif ($totalScore >= 27 && $totalScore <= 34) {
            return 'Average sleep hygiene practices';
        } else {
            return 'Poor sleep hygiene practices';
        }
    }

    /**
     * Get recommendations based on total score.
     */
    private function getRecommendations($totalScore)
    {
        if ($totalScore < 26) {
            return 'Your sleep hygiene practices are good. Continue maintaining these healthy sleep habits.';
        } elseif ($totalScore >= 27 && $totalScore <= 34) {
            return 'Your sleep hygiene practices could be improved. Consider implementing better sleep habits such as maintaining a consistent sleep schedule, creating a relaxing bedtime routine, and optimizing your sleep environment.';
        } else {
            return 'Your sleep hygiene practices need significant improvement. Consider consulting with a healthcare provider or sleep specialist for guidance on improving your sleep habits. Focus on establishing a consistent sleep schedule, creating a relaxing bedtime routine, and optimizing your sleep environment.';
        }
    }
}
