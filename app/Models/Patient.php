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
        'first_name',
        'last_name',
        'middle_name',
        'birth_date',
        'gender',
        'marital_status',
        'email',
        'diagnosis',
        'house_no',
        'street',
        'barangay',
        'city_municipality',
        'province',
        'zip_code',
        'country',
        'blood_type',
        'height',
        'occupation',
        'weight_kg',
        'status',  // Add this line
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


    // Function to calculate BMI
    public function calculateBMI()
    {
        if ($this->weight_kg && $this->height) {
            $heightInMeters = $this->getHeightInCm() / 100; // Convert cm to meters
            return round($this->weight_kg / ($heightInMeters * $heightInMeters), 2);
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
        $height = $this->getHeightInCm(); // Assuming it's stored in centimeters
        $age = $this->age;

        if (strtolower($this->gender) === 'male') {
            return (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } elseif (strtolower($this->gender) === 'female') {
            return (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        return "N/A";
    }

    public function getHeightInCm()
    {
        return $this->height ? $this->height * 100 : null;
    }


}
