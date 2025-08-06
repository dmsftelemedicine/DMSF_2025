<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ISI7Assessment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ISI7AssessmentController extends Controller
{
    /**
     * Store a newly created ISI-7 assessment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'isi_q1' => 'required|integer|min:0|max:4',
            'isi_q2' => 'required|integer|min:0|max:4',
            'isi_q3' => 'required|integer|min:0|max:4',
            'isi_q4' => 'required|integer|min:0|max:4',
            'isi_q5' => 'required|integer|min:0|max:4',
            'isi_q6' => 'required|integer|min:0|max:4',
            'isi_q7' => 'required|integer|min:0|max:4',
            'total_score' => 'required|integer|min:0|max:28',
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
        $existingAssessment = ISI7Assessment::where('patient_id', $request->patient_id)->first();

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
            $assessment = ISI7Assessment::create(array_merge($request->all(), [
                'severity' => $severity,
                'interpretation' => $interpretation,
                'recommendations' => $recommendations,
            ]));
        }

        return response()->json([
            'success' => true,
            'message' => 'ISI-7 assessment saved successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Get the latest ISI-7 assessment for a patient.
     */
    public function show($patientId)
    {
        $assessment = ISI7Assessment::where('patient_id', $patientId)
            ->latest()
            ->first();

        if (!$assessment) {
            return response()->json([
                'success' => false,
                'message' => 'No ISI-7 assessment found for this patient'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $assessment
        ]);
    }

    /**
     * Update the specified ISI-7 assessment.
     */
    public function update(Request $request, $id)
    {
        $assessment = ISI7Assessment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'isi_q1' => 'required|integer|min:0|max:4',
            'isi_q2' => 'required|integer|min:0|max:4',
            'isi_q3' => 'required|integer|min:0|max:4',
            'isi_q4' => 'required|integer|min:0|max:4',
            'isi_q5' => 'required|integer|min:0|max:4',
            'isi_q6' => 'required|integer|min:0|max:4',
            'isi_q7' => 'required|integer|min:0|max:4',
            'total_score' => 'required|integer|min:0|max:28',
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
            'message' => 'ISI-7 assessment updated successfully',
            'data' => $assessment
        ]);
    }

    /**
     * Calculate severity based on total score.
     */
    private function calculateSeverity($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 7) {
            return 'None';
        } elseif ($totalScore >= 8 && $totalScore <= 14) {
            return 'Mild';
        } elseif ($totalScore >= 15 && $totalScore <= 21) {
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
        if ($totalScore >= 0 && $totalScore <= 7) {
            return 'No clinically significant insomnia';
        } elseif ($totalScore >= 8 && $totalScore <= 14) {
            return 'Subthreshold insomnia';
        } elseif ($totalScore >= 15 && $totalScore <= 21) {
            return 'Clinical insomnia (moderate severity)';
        } else {
            return 'Clinical insomnia (severe)';
        }
    }

    /**
     * Get recommendations based on total score.
     */
    private function getRecommendations($totalScore)
    {
        if ($totalScore >= 0 && $totalScore <= 7) {
            return 'Your sleep appears to be within normal limits. Continue maintaining good sleep hygiene practices.';
        } elseif ($totalScore >= 8 && $totalScore <= 14) {
            return 'Consider implementing sleep hygiene improvements and stress management techniques. Monitor your sleep patterns.';
        } elseif ($totalScore >= 15 && $totalScore <= 21) {
            return 'Consider consulting with a healthcare provider about your sleep difficulties. Cognitive behavioral therapy for insomnia (CBT-I) may be beneficial.';
        } else {
            return 'Strongly recommend consulting with a healthcare provider or sleep specialist. Treatment options may include CBT-I, medication, or other interventions.';
        }
    }
}
