<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Diagnosis;
use App\Models\Icd10;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssessmentController extends Controller
{
   public function index()
    {
        
    }

    public function store(Request $request)
    {
        // Debug: Log incoming request data
        Log::info('Assessment store request received', [
            'request_data' => $request->all(),
            'patient_id' => $request->patient_id
        ]);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_diagnosis' => 'required|array|min:1',
            'medical_diagnosis.*' => 'required|string',
            'medical_other_diagnosis_info' => 'nullable|array',
            'medical_other_diagnosis_info.*' => 'nullable|string',
            'lifestyle_diagnosis' => 'required|array|min:1',
            'lifestyle_diagnosis.*' => 'required|string',
            'lifestyle_other_diagnosis_info' => 'nullable|array',
            'lifestyle_other_diagnosis_info.*' => 'nullable|string',
        ]);

        DB::beginTransaction();
        
        try {
            // Create the assessment
            $assessment = Assessment::create([
                'patient_id' => $validated['patient_id']
            ]);

            // Create medical diagnoses
            foreach ($validated['medical_diagnosis'] as $index => $diagnosisText) {
                $assessment->diagnoses()->create([
                    'type' => 'medical',
                    'diagnosis_text' => $diagnosisText,
                    'other_info' => $validated['medical_other_diagnosis_info'][$index] ?? null
                ]);
            }

            // Create lifestyle diagnoses
            foreach ($validated['lifestyle_diagnosis'] as $index => $diagnosisText) {
                $assessment->diagnoses()->create([
                    'type' => 'lifestyle',
                    'diagnosis_text' => $diagnosisText,
                    'other_info' => $validated['lifestyle_other_diagnosis_info'][$index] ?? null
                ]);
            }

            $assessment->load(['patient', 'diagnoses']);
            
            DB::commit();
            
            Log::info('Assessment created successfully', [
                'assessment_id' => $assessment->id,
                'patient_id' => $assessment->patient_id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Assessment saved successfully!',
                'data' => $assessment
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Assessment creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create assessment: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByPatient($patientId)
    {
        $assessments = Assessment::with(['patient', 'diagnoses'])
            ->where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($assessments);
    }

    public function searchIcd10(Request $request)
    {
        $query = $request->get('query', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = Icd10::where(function($q) use ($query) {
            $q->where('code', 'LIKE', '%' . $query . '%')
              ->orWhere('description', 'LIKE', '%' . $query . '%');
        })
        ->where(function($q) {
            // Only include specific diagnostic codes (letter + numbers)
            $q->where('code', 'REGEXP', '^[A-Z][0-9]+')                  // Must start with letter followed by numbers
              ->where('code', 'NOT LIKE', '%-%')                         // No ranges
              ->whereRaw('LENGTH(code) >= 3')                            // At least 3 characters
              ->where('description', 'NOT REGEXP', '^[IVX]+[\\. ]')      // Exclude Roman numerals at start
              ->where('description', 'NOT LIKE', 'Chapter%');            // Exclude chapter descriptions
        })
        ->limit(10)
        ->get(['code', 'description']);

        return response()->json($results);
    }
}
