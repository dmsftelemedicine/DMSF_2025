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
        // Extract data from new format: pe[section_key][row_key][field]
        $peData = $request->input('pe', []);
        
        // Return the section data if it exists
        if (isset($peData[$section])) {
            return $peData[$section];
        }

        return [];
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
            // Validate basic request structure and new data format
            $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'consultation_id' => 'nullable|exists:consultations,id',
                
                // New format validation: pe[section_key][row_key][field]
                'pe.general_survey.*.normal' => 'nullable|in:0,1',
                'pe.general_survey.*.abnormal' => 'nullable|array',
                'pe.general_survey.*.abnormal.*' => 'nullable|string',
                'pe.general_survey.*.detail' => 'nullable|array',
                'pe.general_survey.*.detail.*' => 'nullable|string|max:500',
                'pe.general_survey.*.other_text' => 'nullable|string|max:500',
                
                'pe.skin_hair.*.normal' => 'nullable|in:0,1',
                'pe.skin_hair.*.abnormal' => 'nullable|array',
                'pe.skin_hair.*.abnormal.*' => 'nullable|string',
                'pe.skin_hair.*.detail' => 'nullable|array',
                'pe.skin_hair.*.detail.*' => 'nullable|string|max:500',
                'pe.skin_hair.*.other_text' => 'nullable|string|max:500',
                
                'pe.finger_nails.*.normal' => 'nullable|in:0,1',
                'pe.finger_nails.*.abnormal' => 'nullable|array',
                'pe.finger_nails.*.abnormal.*' => 'nullable|string',
                'pe.finger_nails.*.detail' => 'nullable|array',
                'pe.finger_nails.*.detail.*' => 'nullable|string|max:500',
                'pe.finger_nails.*.other_text' => 'nullable|string|max:500',
                
                'pe.head.*.normal' => 'nullable|in:0,1',
                'pe.head.*.abnormal' => 'nullable|array',
                'pe.head.*.abnormal.*' => 'nullable|string',
                'pe.head.*.detail' => 'nullable|array',
                'pe.head.*.detail.*' => 'nullable|string|max:500',
                'pe.head.*.other_text' => 'nullable|string|max:500',
                
                'pe.eyes.*.normal' => 'nullable|in:0,1',
                'pe.eyes.*.abnormal' => 'nullable|array',
                'pe.eyes.*.abnormal.*' => 'nullable|string',
                'pe.eyes.*.detail' => 'nullable|array',
                'pe.eyes.*.detail.*' => 'nullable|string|max:500',
                'pe.eyes.*.other_text' => 'nullable|string|max:500',
                
                'pe.ear.*.normal' => 'nullable|in:0,1',
                'pe.eyes.*.abnormal' => 'nullable|array',
                'pe.eyes.*.abnormal.*' => 'nullable|string',
                'pe.eyes.*.detail' => 'nullable|array',
                'pe.eyes.*.detail.*' => 'nullable|string|max:500',
                'pe.eyes.*.other_text' => 'nullable|string|max:500',
                
                'pe.ear.*.normal' => 'nullable|in:0,1',
                'pe.ear.*.abnormal' => 'nullable|array',
                'pe.ear.*.abnormal.*' => 'nullable|string',
                'pe.ear.*.detail' => 'nullable|array',
                'pe.ear.*.detail.*' => 'nullable|string|max:500',
                'pe.ear.*.other_text' => 'nullable|string|max:500',
                
                'pe.neck.*.normal' => 'nullable|in:0,1',
                'pe.neck.*.abnormal' => 'nullable|array',
                'pe.neck.*.abnormal.*' => 'nullable|string',
                'pe.neck.*.detail' => 'nullable|array',
                'pe.neck.*.detail.*' => 'nullable|string|max:500',
                'pe.neck.*.other_text' => 'nullable|string|max:500',
                
                'pe.back_posture.*.normal' => 'nullable|in:0,1',
                'pe.back_posture.*.abnormal' => 'nullable|array',
                'pe.back_posture.*.abnormal.*' => 'nullable|string',
                'pe.back_posture.*.detail' => 'nullable|array',
                'pe.back_posture.*.detail.*' => 'nullable|string|max:500',
                'pe.back_posture.*.other_text' => 'nullable|string|max:500',
                
                'pe.thorax_lungs.*.normal' => 'nullable|in:0,1',
                'pe.thorax_lungs.*.abnormal' => 'nullable|array',
                'pe.thorax_lungs.*.abnormal.*' => 'nullable|string',
                'pe.thorax_lungs.*.detail' => 'nullable|array',
                'pe.thorax_lungs.*.detail.*' => 'nullable|string|max:500',
                'pe.thorax_lungs.*.other_text' => 'nullable|string|max:500',
                
                'pe.cardiac_exam.*.normal' => 'nullable|in:0,1',
                'pe.cardiac_exam.*.abnormal' => 'nullable|array',
                'pe.cardiac_exam.*.abnormal.*' => 'nullable|string',
                'pe.cardiac_exam.*.detail' => 'nullable|array',
                'pe.cardiac_exam.*.detail.*' => 'nullable|string|max:500',
                'pe.cardiac_exam.*.other_text' => 'nullable|string|max:500',
                
                'pe.abdomen.*.normal' => 'nullable|in:0,1',
                'pe.abdomen.*.abnormal' => 'nullable|array',
                'pe.abdomen.*.abnormal.*' => 'nullable|string',
                'pe.abdomen.*.detail' => 'nullable|array',
                'pe.abdomen.*.detail.*' => 'nullable|string|max:500',
                'pe.abdomen.*.other_text' => 'nullable|string|max:500',
                
                'pe.breast_axillae.*.normal' => 'nullable|in:0,1',
                'pe.breast_axillae.*.abnormal' => 'nullable|array',
                'pe.breast_axillae.*.abnormal.*' => 'nullable|string',
                'pe.breast_axillae.*.detail' => 'nullable|array',
                'pe.breast_axillae.*.detail.*' => 'nullable|string|max:500',
                'pe.breast_axillae.*.other_text' => 'nullable|string|max:500',
                
                'pe.male_genitalia.*.normal' => 'nullable|in:0,1',
                'pe.male_genitalia.*.abnormal' => 'nullable|array',
                'pe.male_genitalia.*.abnormal.*' => 'nullable|string',
                'pe.male_genitalia.*.detail' => 'nullable|array',
                'pe.male_genitalia.*.detail.*' => 'nullable|string|max:500',
                'pe.male_genitalia.*.other_text' => 'nullable|string|max:500',
                
                'pe.female_genitalia.*.normal' => 'nullable|in:0,1',
                'pe.female_genitalia.*.abnormal' => 'nullable|array',
                'pe.female_genitalia.*.abnormal.*' => 'nullable|string',
                'pe.female_genitalia.*.detail' => 'nullable|array',
                'pe.female_genitalia.*.detail.*' => 'nullable|string|max:500',
                'pe.female_genitalia.*.other_text' => 'nullable|string|max:500',
                
                'pe.extremities.*.normal' => 'nullable|in:0,1',
                'pe.extremities.*.abnormal' => 'nullable|array',
                'pe.extremities.*.abnormal.*' => 'nullable|string',
                'pe.extremities.*.detail' => 'nullable|array',
                'pe.extremities.*.detail.*' => 'nullable|string|max:500',
                'pe.extremities.*.other_text' => 'nullable|string|max:500',
                
                'pe.nervous_system.*.normal' => 'nullable|in:0,1',
                'pe.nervous_system.*.abnormal' => 'nullable|array',
                'pe.nervous_system.*.abnormal.*' => 'nullable|string',
                'pe.nervous_system.*.detail' => 'nullable|array',
                'pe.nervous_system.*.detail.*' => 'nullable|string|max:500',
                'pe.nervous_system.*.other_text' => 'nullable|string|max:500',
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

            // Extract PE data from the new format (pe[section][row][field])
            $peData = $request->input('pe', []);
            
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

            $updateData = [];
            foreach ($sections as $section) {
                if (isset($peData[$section]) && !empty($peData[$section])) {
                    $updateData[$section] = $peData[$section];
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