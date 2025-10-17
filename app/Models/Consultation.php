<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'consultation_date',
        'consultation_number',
    ];

    protected $casts = [
        'consultation_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // ROS relationship (existing)
    public function reviewOfSystems()
    {
        return $this->hasMany(ReviewOfSystem::class);
    }

    // Screening tool relationships
    public function nutritions()
    {
        return $this->hasMany(Nutrition::class);
    }

    /**
     * Get the nutrition assessment for this consultation (one per consultation)
     */
    public function nutrition()
    {
        return $this->hasOne(Nutrition::class);
    }

    public function qualityOfLifeRecords()
    {
        return $this->hasMany(QualityOfLife::class);
    }

    public function telemedicinePerceptions()
    {
        return $this->hasMany(TelemedicinePerception::class);
    }

    public function physicalActivities()
    {
        return $this->hasMany(PhysicalActivity::class);
    }

    // Patient measurements relationship
    public function patientMeasurements()
    {
        return $this->hasMany(PatientMeasurement::class);
    }

    /**
     * Get the patient measurement for this consultation
     */
    public function patientMeasurement()
    {
        return $this->hasOne(PatientMeasurement::class);
    }

    // Physical examination relationship
    public function physicalExaminations()
    {
        return $this->hasMany(PhysicalExamination::class);
    }

    /**
     * Get the physical examination for this consultation
     */
    public function physicalExamination()
    {
        return $this->hasOne(PhysicalExamination::class);
    }

    /**
     * Get the consultation type based on consultation number
     */
    public function getConsultationTypeAttribute()
    {
        if (!$this->consultation_number) {
            return 'CONSULTATION_other';
        }

        switch ($this->consultation_number) {
            case 1:
                return 'CONSULTATION_1st';
            case 2:
                return 'CONSULTATION_2nd';
            case 3:
                return 'CONSULTATION_3rd';
            default:
                return 'CONSULTATION_other';
        }
    }

    /**
     * Get the ROS consultation type (backward compatibility)
     */
    public function getRosConsultationTypeAttribute()
    {
        $type = $this->consultation_type;
        return str_replace('CONSULTATION_', 'ROS_', $type);
    }

    /**
     * Create or get the three required consultations for a patient
     */
    public static function ensureThreeConsultations($patientId)
    {
        $patient = Patient::find($patientId);
        if (!$patient) {
            return null;
        }

        $consultations = $patient->consultations()->orderBy('consultation_number')->get();
        
        if ($consultations->count() == 0) {
            // Create all three consultations with initial dates that can be manually updated
            $baseDate = now();
            
            $consultation1st = self::create([
                'patient_id' => $patientId,
                'consultation_date' => $baseDate,
                'consultation_number' => 1,
            ]);
            
            $consultation2nd = self::create([
                'patient_id' => $patientId,
                'consultation_date' => $baseDate->copy()->addWeek(),
                'consultation_number' => 2,
            ]);
            
            $consultation3rd = self::create([
                'patient_id' => $patientId,
                'consultation_date' => $baseDate->copy()->addMonth(),
                'consultation_number' => 3,
            ]);
            
            return [
                $consultation1st,
                $consultation2nd,
                $consultation3rd,
            ];
        }
        
        // Ensure we have all three consultations, create missing ones
        $existingNumbers = $consultations->pluck('consultation_number')->toArray();
        $allConsultations = $consultations->keyBy('consultation_number');
        
        for ($i = 1; $i <= 3; $i++) {
            if (!in_array($i, $existingNumbers)) {
                // Create missing consultation with a default date
                $defaultDate = now()->addDays(($i - 1) * 7); // Default spacing of 1 week
                $newConsultation = self::create([
                    'patient_id' => $patientId,
                    'consultation_date' => $defaultDate,
                    'consultation_number' => $i,
                ]);
                $allConsultations[$i] = $newConsultation;
            }
        }
        
        // Return consultations in order
        return [
            $allConsultations[1] ?? null,
            $allConsultations[2] ?? null,
            $allConsultations[3] ?? null,
        ];
    }

    /**
     * Check if this consultation has any screening tool data
     */
    public function hasScreeningToolData()
    {
        return $this->nutrition()->exists() ||
               $this->qualityOfLifeRecords()->exists() ||
               $this->telemedicinePerceptions()->exists() ||
               $this->physicalActivities()->exists();
    }

    /**
     * Check if this consultation has nutrition data
     */
    public function hasNutritionData()
    {
        return $this->nutrition()->exists();
    }

    /**
     * Check if this consultation has measurement data
     */
    public function hasMeasurementData()
    {
        return $this->patientMeasurements()->exists();
    }

    /**
     * Check if this consultation has any ROS data
     */
    public function hasRosData()
    {
        return $this->reviewOfSystems()->exists();
    }

    /**
     * Check if this consultation has physical examination data
     */
    public function hasPhysicalExaminationData()
    {
        return $this->physicalExaminations()->exists();
    }

    /**
     * Check if this consultation has any data at all
     */
    public function hasAnyData()
    {
        return $this->hasScreeningToolData() || $this->hasMeasurementData() || $this->hasRosData() || $this->hasPhysicalExaminationData();
    }

    /**
     * Get consultation display number (1, 2, 3, etc.)
     */
    public function getConsultationNumberAttribute($value)
    {
        return $value;
    }
} 