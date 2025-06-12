<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Patient extends Model
{
    use HasFactory;
    protected $appends = ['age'];
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
        'diagnosis',
        'waist_circumference',
        'hip_circumference',
        'neck_circumference',
        'height',
        'weight_kg',
        'temperature',
        'heart_rate',
        'o2_saturation',
        'respiratory_rate',
        'blood_pressure',
        'reference_number',
    ];


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

    public function tdee() {
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

    // Function to calculate BMI
    public function calculateBMI()
    {
        if ($this->weight_kg && $this->height) {
            return round($this->weight_kg / ($this->height * $this->height), 2);
        }
        return 'N/A';
    }


    public function calculateBMR()
    {
        // Ensure weight, height, and age are available
        if (!$this->weight_kg || !$this->height || !$this->age || !$this->gender) {
            return "N/A";
        }

        $weight = $this->weight_kg;
        $height = $this->getHeightInMeters();
        $age = $this->age;

        if (strtolower($this->gender) === 'male') {
            return (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } elseif (strtolower($this->gender) === 'female') {
            return (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        return "N/A";
    }

    public function getHeightInMeters()
    {
        return $this->height ? $this->height : null;
    }

    public function comprehensiveHistory()
    {
        return $this->hasOne(ComprehensiveHistory::class);
    }

    public function patientMeasurements()
    {
        return $this->hasMany(PatientMeasurement::class);
    }

    // Helper method to get measurements for a specific tab and date
    public function getMeasurementForTab($tabNumber, $date = null)
    {
        $date = $date ?: now()->toDateString();
        return $this->patientMeasurements()
            ->where('tab_number', $tabNumber)
            ->where('measurement_date', $date)
            ->first();
    }

}
