<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Support\Facades\Log;

class ConsultationController extends Controller
{
    /**
     * Update consultation date
     */
    public function updateDate(Request $request, Consultation $consultation)
    {
        $request->validate([
            'consultation_date' => 'required|date',
        ]);

        $oldDate = $consultation->consultation_date;
        $newDate = $request->consultation_date;

        $consultation->update([
            'consultation_date' => $newDate,
        ]);

        Log::info("Consultation date updated", [
            'consultation_id' => $consultation->id,
            'patient_id' => $consultation->patient_id,
            'consultation_number' => $consultation->consultation_number,
            'old_date' => $oldDate,
            'new_date' => $newDate,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Consultation date updated successfully',
            'consultation' => $consultation->fresh(),
            'old_date' => $oldDate,
            'new_date' => $newDate
        ]);
    }

    /**
     * Check if consultation has screening tool data
     */
    public function hasScreeningData(Consultation $consultation)
    {
        $hasData = $consultation->hasScreeningToolData();

        return response()->json([
            'hasData' => $hasData,
            'consultation_id' => $consultation->id,
            'consultation_date' => $consultation->consultation_date->format('Y-m-d')
        ]);
    }

    /**
     * Get or create consultations for a patient
     */
    public function ensureConsultations(Patient $patient)
    {
        $consultations = Consultation::ensureThreeConsultations($patient->id);
        
        return response()->json([
            'success' => true,
            'consultations' => $consultations
        ]);
    }

    /**
     * Get consultation details with screening data
     */
    public function getConsultationData(Consultation $consultation)
    {
        $consultation->load([
            'nutritions',
            'qualityOfLifeRecords', 
            'telemedicinePerceptions',
            'physicalActivities.details.description'
        ]);

        return response()->json([
            'consultation' => $consultation,
            'hasData' => $consultation->hasScreeningToolData(),
            'dataCount' => [
                'nutrition' => $consultation->nutritions->count(),
                'qualityOfLife' => $consultation->qualityOfLifeRecords->count(),
                'telemedicine' => $consultation->telemedicinePerceptions->count(),
                'physicalActivity' => $consultation->physicalActivities->count(),
            ]
        ]);
    }


}
