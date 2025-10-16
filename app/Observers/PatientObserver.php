<?php

namespace App\Observers;

use App\Models\Patient;
use App\Models\PhysicalExamination;
use App\Models\Consultation;
use App\Support\PeSchema;

class PatientObserver
{
    /**
     * Handle the Patient "created" event.
     * 
     * Creates physical examinations with all normal values for the 3 consultations.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function created(Patient $patient)
    {
        // Ensure 3 consultations exist for this patient
        $consultations = Consultation::ensureThreeConsultations($patient->id);
        
        // Convert to collection if array is returned
        if (is_array($consultations)) {
            $consultations = collect($consultations);
        } else {
            // Fallback to getting consultations from database
            $consultations = $patient->consultations()
                ->orderBy('consultation_number')
                ->take(3)
                ->get();
        }

        // Create physical examination data with all normal values
        $normalData = $this->generateNormalPhysicalExaminationData();

        // Create physical examination for each consultation if it doesn't exist
        foreach ($consultations as $consultation) {
            if (!$consultation) {
                continue;
            }
            
            // Check if physical examination already exists for this consultation
            $existingPe = PhysicalExamination::where('patient_id', $patient->id)
                ->where('consultation_id', $consultation->id)
                ->first();
            
            if (!$existingPe) {
                PhysicalExamination::create(array_merge($normalData, [
                    'patient_id' => $patient->id,
                    'consultation_id' => $consultation->id,
                ]));
            }
        }
    }

    /**
     * Generate physical examination data with all normal values selected.
     * 
     * @return array
     */
    private function generateNormalPhysicalExaminationData(): array
    {
        return [
            'general_survey' => $this->generateNormalSectionData(PeSchema::generalSurvey()),
            'skin_hair' => $this->generateNormalSectionData(PeSchema::skinHair()),
            'finger_nails' => $this->generateNormalSectionData(PeSchema::fingerNails()),
            'head' => $this->generateNormalSectionData(PeSchema::head()),
            'eyes' => $this->generateNormalSectionData(PeSchema::eyes()),
            'ear' => $this->generateNormalSectionData(PeSchema::ear()),
            'neck' => $this->generateNormalSectionData(PeSchema::neck()),
            'back_posture' => $this->generateNormalSectionData(PeSchema::backPosture()),
            'thorax_lungs' => $this->generateNormalSectionData(PeSchema::thoraxLungs()),
            'cardiac_exam' => $this->generateNormalSectionData(PeSchema::cardiacExam()),
            'abdomen' => $this->generateNormalSectionData(PeSchema::abdomen()),
            'breast_axillae' => $this->generateNormalSectionData(PeSchema::breastAxillae()),
            'male_genitalia' => $this->generateNormalSectionData(PeSchema::maleGenitalia()),
            'female_genitalia' => $this->generateNormalSectionData(PeSchema::femaleGenitalia()),
            'extremities' => $this->generateNormalSectionData(PeSchema::extremities()),
            'nervous_system' => $this->generateNormalSectionData(PeSchema::nervousSystem()),
        ];
    }

    /**
     * Generate normal data for a specific section.
     * 
     * For each row in the section, set 'is_normal' to true and 'selected_options' to empty array.
     * 
     * @param array $sectionSchema
     * @return array
     */
    private function generateNormalSectionData(array $sectionSchema): array
    {
        $sectionData = [];
        
        foreach ($sectionSchema['rows'] as $row) {
            $rowKey = $row['key'];
            $sectionData[$rowKey] = [
                'normal' => "1"
            ];
        }
        
        return $sectionData;
    }
}
