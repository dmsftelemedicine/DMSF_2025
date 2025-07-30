<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'consultation_id',
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

    protected $casts = [
        'general_survey' => 'array',
        'skin_hair' => 'array',
        'finger_nails' => 'array',
        'head' => 'array',
        'eyes' => 'array',
        'ear' => 'array',
        'neck' => 'array',
        'back_posture' => 'array',
        'thorax_lungs' => 'array',
        'cardiac_exam' => 'array',
        'abdomen' => 'array',
        'breast_axillae' => 'array',
        'male_genitalia' => 'array',
        'female_genitalia' => 'array',
        'extremities' => 'array',
        'nervous_system' => 'array',
    ];

    /**
     * Get the patient that owns the physical examination.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the consultation that owns the physical examination.
     */
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    /**
     * Get a specific section of the physical examination.
     */
    public function getSection($section)
    {
        return $this->$section ?? [];
    }

    /**
     * Update a specific section of the physical examination.
     */
    public function updateSection($section, $data)
    {
        $this->update([$section => $data]);
        return $this;
    }

    /**
     * Check if a specific section has data.
     */
    public function hasSection($section)
    {
        return !empty($this->$section);
    }

    /**
     * Get all sections that have data.
     */
    public function getCompletedSections()
    {
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

        $completed = [];
        foreach ($sections as $section) {
            if ($this->hasSection($section)) {
                $completed[] = $section;
            }
        }

        return $completed;
    }

    /**
     * Get the completion percentage of the physical examination.
     */
    public function getCompletionPercentage()
    {
        $totalSections = 16;
        $completedSections = count($this->getCompletedSections());
        
        return round(($completedSections / $totalSections) * 100, 2);
    }
}
