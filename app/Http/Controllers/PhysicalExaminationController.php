<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PhysicalExamination;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PhysicalExaminationController extends Controller
{
    /**
     * Store or update a specific section of physical examination.
     */
    public function storeSection(Request $request, Patient $patient, string $section): JsonResponse
    {
        try {
            // Validate the request
            $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'consultation_id' => 'nullable|exists:consultations,id',
            ]);

            $consultationId = $request->consultation_id;

            // Get or create physical examination record for this consultation
            $physicalExamination = PhysicalExamination::firstOrCreate(
                [
                    'patient_id' => $patient->id,
                    'consultation_id' => $consultationId
                ],
                [
                    'patient_id' => $patient->id,
                    'consultation_id' => $consultationId
                ]
            );

            // Process the section data
            $sectionData = $this->processSectionData($request, $section);

            // Update the specific section
            $physicalExamination->updateSection($section, $sectionData);

            return response()->json([
                'success' => true,
                'message' => ucfirst(str_replace('_', ' ', $section)) . ' examination saved successfully!',
                'data' => $sectionData,
                'consultation_id' => $consultationId
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving ' . ucfirst(str_replace('_', ' ', $section)) . ' examination: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific section of physical examination for a consultation.
     */
    public function getSection(Patient $patient, string $section, Request $request): JsonResponse
    {
        try {
            $consultationId = $request->query('consultation_id');
            
            $physicalExamination = PhysicalExamination::where('patient_id', $patient->id)
                ->where('consultation_id', $consultationId)
                ->first();

            if (!$physicalExamination) {
                return response()->json([
                    'success' => true,
                    'data' => []
                ]);
            }

            $sectionData = $physicalExamination->getSection($section);

            return response()->json([
                'success' => true,
                'data' => $sectionData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving ' . ucfirst(str_replace('_', ' ', $section)) . ' examination: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all physical examination data for a patient and consultation.
     */
    public function getAll(Patient $patient, Request $request): JsonResponse
    {
        try {
            $consultationId = $request->query('consultation_id');
            
            $physicalExamination = PhysicalExamination::where('patient_id', $patient->id)
                ->where('consultation_id', $consultationId)
                ->first();

            if (!$physicalExamination) {
                return response()->json([
                    'success' => true,
                    'data' => null,
                    'completion_percentage' => 0,
                    'completed_sections' => []
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $physicalExamination,
                'completion_percentage' => $physicalExamination->getCompletionPercentage(),
                'completed_sections' => $physicalExamination->getCompletedSections()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving physical examination data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get physical examination data by consultation ID
     */
    public function getByConsultation(Consultation $consultation): JsonResponse
    {
        try {
            $physicalExamination = $consultation->physicalExamination;

            return response()->json([
                'success' => true,
                'data' => $physicalExamination,
                'completion_percentage' => $physicalExamination ? $physicalExamination->getCompletionPercentage() : 0,
                'completed_sections' => $physicalExamination ? $physicalExamination->getCompletedSections() : []
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving physical examination data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process section data from request.
     */
    private function processSectionData(Request $request, string $section): array
    {
        $data = $request->all();
        $sectionData = [];

        // Remove patient_id, consultation_id and _token from the data
        unset($data['patient_id'], $data['consultation_id'], $data['_token']);

        // Get the section data from the request
        $sectionKey = str_replace('_', ' ', $section);
        $sectionKey = str_replace(' ', '_', $sectionKey);

        if (isset($data[$sectionKey])) {
            $sectionData = $data[$sectionKey];
        }

        return $sectionData;
    }

    /**
     * Store General Survey section.
     */
    public function storeGeneralSurvey(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'general_survey');
    }

    /**
     * Store Skin/Hair section.
     */
    public function storeSkinHair(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'skin_hair');
    }

    /**
     * Store Finger & Nails section.
     */
    public function storeFingerNails(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'finger_nails');
    }

    /**
     * Store Head section.
     */
    public function storeHead(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'head');
    }

    /**
     * Store Eyes section.
     */
    public function storeEyes(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'eyes');
    }

    /**
     * Store Ear section.
     */
    public function storeEar(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'ear');
    }

    /**
     * Store Neck section.
     */
    public function storeNeck(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'neck');
    }

    /**
     * Store Back & Posture section.
     */
    public function storeBackPosture(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'back_posture');
    }

    /**
     * Store Thorax & Lungs section.
     */
    public function storeThoraxLungs(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'thorax_lungs');
    }

    /**
     * Store Cardiac Exam section.
     */
    public function storeCardiacExam(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'cardiac_exam');
    }

    /**
     * Store Abdomen section.
     */
    public function storeAbdomen(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'abdomen');
    }

    /**
     * Store Breast & Axillae section.
     */
    public function storeBreastAxillae(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'breast_axillae');
    }

    /**
     * Store Male Genitalia section.
     */
    public function storeMaleGenitalia(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'male_genitalia');
    }

    /**
     * Store Female Genitalia section.
     */
    public function storeFemaleGenitalia(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'female_genitalia');
    }

    /**
     * Store Extremities section.
     */
    public function storeExtremities(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'extremities');
    }

    /**
     * Store Nervous System section.
     */
    public function storeNervousSystem(Request $request, Patient $patient): JsonResponse
    {
        return $this->storeSection($request, $patient, 'nervous_system');
    }

    /**
     * Save all physical examination sections at once.
     */
    public function saveAll(Request $request, Patient $patient): JsonResponse
    {
        try {
            $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'consultation_id' => 'nullable|exists:consultations,id',
            ]);

            $consultationId = $request->consultation_id;

            // Get or create the physical examination record for this consultation
            $physicalExamination = PhysicalExamination::firstOrCreate(
                [
                    'patient_id' => $patient->id,
                    'consultation_id' => $consultationId
                ],
                [
                    'patient_id' => $patient->id,
                    'consultation_id' => $consultationId
                ]
            );

            // List of all sections
            $sections = [
                'general_survey',
                'skin_hair',
                'finger_nails',
                'head',
                'eyes',
                'ear',
                'neck',
                'back_posture',
                'thorax_lungs',
                'cardiac_exam',
                'abdomen',
                'breast_axillae',
                'male_genitalia',
                'female_genitalia',
                'extremities',
                'nervous_system',
            ];

            $data = $request->all();
            unset($data['patient_id'], $data['consultation_id'], $data['_token']);

            $updateData = [];
            foreach ($sections as $section) {
                if (isset($data[$section])) {
                    $updateData[$section] = $data[$section];
                }
            }

            if (!empty($updateData)) {
                $physicalExamination->update($updateData);
            }

            return response()->json([
                'success' => true,
                'message' => 'All physical examination sections saved successfully!',
                'data' => $updateData,
                'consultation_id' => $consultationId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving physical examination: ' . $e->getMessage()
            ], 500);
        }
    }
} 