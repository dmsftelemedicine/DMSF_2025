<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\ReviewOfSystem;
use Carbon\Carbon;

class ReviewOfSystemController extends Controller
{
    /**
     * Get the three consultations for a patient, creating them if they don't exist
     */
    public function getConsultations(Patient $patient)
    {
        $consultations = Consultation::ensureThreeConsultations($patient->id);
        
        $response = [];
        foreach ($consultations as $consultation) {
            if (!$consultation) continue;
            
            $ros = $consultation->reviewOfSystems()->first();
            $consultationKey = 'ROS_' . $this->getConsultationSuffix($consultation->consultation_number);
            
            $response[$consultationKey] = [
                'consultation' => $consultation,
                'consultation_id' => $consultation->id,
                'consultation_number' => $consultation->consultation_number,
                'consultation_date' => $consultation->consultation_date->format('Y-m-d'),
                'symptoms' => $ros ? $ros->symptoms : []
            ];
        }
        
        return response()->json($response);
    }

    /**
     * Save Review of Systems for a specific consultation
     */
    public function saveReviewOfSystems(Request $request, Patient $patient)
    {
        $request->validate([
            'consultation_type' => 'required|in:ROS_1st,ROS_2nd,ROS_3rd',
            'symptoms' => 'nullable|array'
        ]);

        $consultationType = $request->consultation_type;
        $symptoms = $request->symptoms ?? [];

        // Extract consultation number from consultation type
        $consultationNumber = $this->getConsultationNumberFromType($consultationType);

        // Get the specific consultation by number
        $consultation = Consultation::where('patient_id', $patient->id)
            ->where('consultation_number', $consultationNumber)
            ->first();

        if (!$consultation) {
            // Create consultation if it doesn't exist
            $consultations = Consultation::ensureThreeConsultations($patient->id);
            $consultation = $consultations[$consultationNumber - 1] ?? null;
        }

        if (!$consultation) {
            return response()->json(['error' => 'Consultation not found'], 404);
        }

        // Get existing ROS or create new one
        $ros = $consultation->reviewOfSystems()->first();
        
        if ($ros) {
            // Update existing entry
            $ros->update([
                'symptoms' => $symptoms
            ]);
        } else {
            // Create new entry
            $ros = ReviewOfSystem::create([
                'patient_id' => $patient->id,
                'consultation_id' => $consultation->id,
                'symptoms' => $symptoms
            ]);
        }

        return response()->json([
            'message' => 'Review of Systems saved successfully for ' . $consultationType,
            'consultation_date' => $consultation->consultation_date->format('M d, Y'),
            'consultation_number' => $consultation->consultation_number
        ]);
    }

    /**
     * Get Review of Systems for a specific consultation
     */
    public function getReviewOfSystems(Patient $patient, $consultationType)
    {
        if (!in_array($consultationType, ['ROS_1st', 'ROS_2nd', 'ROS_3rd'])) {
            return response()->json(['error' => 'Invalid consultation type'], 400);
        }

        $consultationNumber = $this->getConsultationNumberFromType($consultationType);
        
        $consultation = Consultation::where('patient_id', $patient->id)
            ->where('consultation_number', $consultationNumber)
            ->first();

        if (!$consultation) {
            return response()->json(['symptoms' => []]);
        }

        $ros = $consultation->reviewOfSystems()->first();
        
        return response()->json([
            'symptoms' => $ros ? $ros->symptoms : [],
            'consultation_date' => $consultation->consultation_date->format('Y-m-d'),
            'consultation_number' => $consultation->consultation_number
        ]);
    }

    /**
     * Update consultation date
     */
    public function updateConsultationDate(Request $request, Patient $patient)
    {
        $request->validate([
            'consultation_type' => 'required|in:ROS_1st,ROS_2nd,ROS_3rd',
            'consultation_date' => 'required|date'
        ]);

        $consultationType = $request->consultation_type;
        $newDate = Carbon::parse($request->consultation_date);
        $consultationNumber = $this->getConsultationNumberFromType($consultationType);

        $consultation = Consultation::where('patient_id', $patient->id)
            ->where('consultation_number', $consultationNumber)
            ->first();

        if (!$consultation) {
            return response()->json(['error' => 'Consultation not found'], 404);
        }

        $consultation->update([
            'consultation_date' => $newDate
        ]);

        return response()->json([
            'message' => 'Consultation date updated successfully',
            'consultation_date' => $consultation->consultation_date->format('M d, Y'),
            'consultation_number' => $consultation->consultation_number
        ]);
    }

    /**
     * Convert consultation number to suffix (1 -> '1st', 2 -> '2nd', 3 -> '3rd')
     */
    private function getConsultationSuffix($number)
    {
        switch ($number) {
            case 1:
                return '1st';
            case 2:
                return '2nd';
            case 3:
                return '3rd';
            default:
                return $number . 'th';
        }
    }

    /**
     * Extract consultation number from consultation type (ROS_1st -> 1, ROS_2nd -> 2, etc.)
     */
    private function getConsultationNumberFromType($consultationType)
    {
        switch ($consultationType) {
            case 'ROS_1st':
                return 1;
            case 'ROS_2nd':
                return 2;
            case 'ROS_3rd':
                return 3;
            default:
                return 1;
        }
    }
} 