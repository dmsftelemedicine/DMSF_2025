<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Patient extends Model
{
    use HasFactory;
    protected $appends = ['age'];

    // Cache frequently accessed relationships
    protected $with = [];

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'birth_date',
        'gender',
        'street',
        'brgy_address',
        'address_landmark',
        'occupation',
        'highest_educational_attainment',
        'marital_status',
        'status',
        'monthly_household_income',
        'religion',
        'image_path',
        'diabetes_status',
        'height', // Keep height in patients table for basic data
        'reference_number',
        'physician_notes',
        'allied_health_notes',
        'admin_notes',
    ];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically create a comprehensive history when a patient is created
        static::created(function ($patient) {
            $patient->comprehensiveHistory()->create([
                'patient_id' => $patient->id
            ]);
        });
    }


    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function bloodSugarTests()
    {
        return $this->hasMany(BloodSugarTest::class, 'patient_id');
    }

    public function laboratoryResults()
    {
        return $this->hasMany(LaboratoryResult::class);
    }

    public function telemedicinePerceptionTests()
    {
        return $this->hasMany(TelemedicinePerception::class, 'patient_id');
    }

    public function nutritions()
    {
        return $this->hasMany(Nutrition::class, 'patient_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class);
    }

    public function tdee()
    {
        return $this->hasOne(Tdee::class);
    }

    public function informedConsent()
    {
        return $this->hasMany(InformedConsent::class);
    }

    public function reviewOfSystems()
    {
        return $this->hasMany(ReviewOfSystem::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    // Function to calculate BMI using latest measurements
    public function calculateBMI()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        if ($latestMeasurement && $latestMeasurement->weight_kg && $latestMeasurement->height) {
            return round($latestMeasurement->weight_kg / ($latestMeasurement->height * $latestMeasurement->height), 2);
        }
        return 'N/A';
    }

    /**
     * Returns numeric WHR (rounded) or 'N/A'
     *
     * @param int|null $tabNumber  Optional tab number to get measurements for a specific tab/consultation.
     * @return float|string
     */
    public function calculateWHR($tabNumber = null)
    {
        $measurement = null;
        
        // If a tab number is provided, try to get the measurement for that specific tab first
        if ($tabNumber !== null) {
            $measurement = $this->getMeasurementForTab(intval($tabNumber));
        }
        
        // If no tab-specific measurement found, fall back to the latest measurement
        if (!$measurement) {
            $measurement = $this->getLatestMeasurement();
        }
        
        // Get waist and hip values from measurement or patient attributes
        $waist = $measurement->waist_circumference ?? $this->waist_circumference ?? null;
        $hip   = $measurement->hip_circumference   ?? $this->hip_circumference   ?? null;
        
        // Calculate WHR if both measurements exist and hip is not zero
        if ($waist && $hip && $hip > 0) {
            return round($waist / $hip, 2);
        }
        
        return 'N/A';
    }

    /**
     * Returns structured WHR data: value, category label, and CSS class.
     * Accepts optional $tabNumber so UI can get WHR based on a specific tab's measurements.
     *
     * @param int|null $tabNumber Optional tab number for tab-specific measurements
     * @return array
     */
    public function getWHRData($tabNumber = null)
    {
        $whr = $this->calculateWHR($tabNumber);
        
        // Handle case where no measurements are available
        if ($whr === 'N/A') {
            return [
                'value'     => '0',
                'display'   => 'No Entry',
                'category'  => 'no-entry',
                'css_class' => 'whr-0'
            ];
        }
        
        // Get and normalize sex/gender
        $sex = strtolower(trim($this->sex ?? $this->gender ?? ''));
        
        // Determine category and styling based on sex-specific thresholds
        if (in_array($sex, ['female', 'f'])) {
            // Female thresholds
            if ($whr <= 0.80) {
                $label = 'Within optimal range';
                $cls = 'whr-green';
            } elseif ($whr >= 0.86) {
                $label = 'Increased health risk (central obesity)';
                $cls = 'whr-red';
            } else { // 0.81 - 0.85
                $label = 'Borderline / indicative of central obesity';
                $cls = 'whr-yellow';
            }
        } elseif (in_array($sex, ['male', 'm'])) {
            // Male thresholds
            if ($whr <= 0.90) {
                $label = 'Within optimal range';
                $cls = 'whr-green';
            } elseif ($whr >= 0.95) {
                $label = 'Increased health risk (central obesity)';
                $cls = 'whr-red';
            } else { // 0.91 - 0.94
                $label = 'Within borderline range';
                $cls = 'whr-yellow';
            }
        } else {
            // Sex not specified or recognized
            $label = 'Sex not specified — select sex to interpret WHR';
            $cls = 'whr-unknown';
        }
        
        return [
            'value'     => number_format($whr, 2, '.', ''),
            'display'   => $label,
            'category'  => $label,
            'css_class' => $cls
        ];
    }

    public function calculateBMR()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        
        // Ensure weight, height, and age are available
        if (!$latestMeasurement || !$latestMeasurement->weight_kg || !$latestMeasurement->height || !$this->age || !$this->gender) {
            return "N/A";
        }

        $weight = $latestMeasurement->weight_kg;
        $height = $latestMeasurement->height * 100; // Convert to cm for BMR formula
        $age = $this->age;

        if (strtolower($this->gender) === 'male') {
            return (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } elseif (strtolower($this->gender) === 'female') {
            return (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        return "N/A";
    }

    // Accessor methods for measurement fields (for backward compatibility)
    public function getHeightAttribute($value)
    {
        // If there's a value in the patients table, use it, otherwise get from measurements
        if ($value) {
            return $value;
        }
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->height : null;
    }

    public function getWeightKgAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->weight_kg : null;
    }

    public function getWaistCircumferenceAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->waist_circumference : null;
    }

    public function getHipCircumferenceAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->hip_circumference : null;
    }

    public function getNeckCircumferenceAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->neck_circumference : null;
    }

    public function getTemperatureAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->temperature : null;
    }

    public function getHeartRateAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->heart_rate : null;
    }

    public function getO2SaturationAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->o2_saturation : null;
    }

    public function getRespiratoryRateAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->respiratory_rate : null;
    }

    public function getBloodPressureAttribute()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->blood_pressure : null;
    }

    // Helper method to get the latest measurement
    public function getLatestMeasurement()
    {
        return $this->patientMeasurements()
            ->with('consultation')
            ->orderBy('measurement_date', 'desc')
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    public function getHeightInMeters()
    {
        $latestMeasurement = $this->getLatestMeasurement();
        return $latestMeasurement ? $latestMeasurement->height : $this->height; // Fallback to patient table height
    }

    public function comprehensiveHistory()
    {
        return $this->hasOne(ComprehensiveHistory::class);
    }

    public function patientMeasurements()
    {
        return $this->hasMany(PatientMeasurement::class);
    }

    public function physicalExamination()
    {
        return $this->hasOne(PhysicalExamination::class);
    }

    public function sleepScreenings()
    {
        return $this->hasMany(SleepScreening::class);
    }

    public function sleepInitialAssessments()
    {
        return $this->hasMany(SleepInitialAssessment::class);
    }

    public function isi7Assessments()
    {
        return $this->hasMany(ISI7Assessment::class);
    }

    public function ess8Assessments()
    {
        return $this->hasMany(ESS8Assessment::class);
    }

    public function shi13Assessments()
    {
        return $this->hasMany(SHI13Assessment::class);
    }

    public function stopbangAssessments()
    {
        return $this->hasMany(STOPBANGAssessment::class);
    }

    // Helper method to get measurements for a specific consultation
    public function getMeasurementForConsultation($consultationId)
    {
        return $this->patientMeasurements()
            ->where('consultation_id', $consultationId)
            ->first();
    }

    // Backward compatibility method - maps tab number to consultation
    public function getMeasurementForTab($tabNumber, $date = null)
    {
        // For backward compatibility, try to find by consultation number
        $consultation = $this->consultations()
            ->where('consultation_number', $tabNumber)
            ->first();
            
        if ($consultation) {
            return $consultation->patientMeasurement;
        }
        
        // Fallback to old method if needed
        return $this->patientMeasurements()
            ->where('tab_number', $tabNumber)
            ->when($date, function ($query, $date) {
                return $query->where('measurement_date', $date);
            })
            ->first();
    }
}
