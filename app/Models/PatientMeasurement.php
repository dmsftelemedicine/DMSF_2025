<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'measurement_date',
        'tab_number',
        'height',
        'weight_kg',
        'waist_circumference',
        'hip_circumference',
        'neck_circumference',
        'temperature',
        'heart_rate',
        'o2_saturation',
        'respiratory_rate',
        'blood_pressure',
    ];

    protected $casts = [
        'measurement_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Helper method to calculate BMI for this measurement
    public function calculateBMI()
    {
        if ($this->weight_kg && $this->height) {
            return round($this->weight_kg / ($this->height * $this->height), 2);
        }
        return 'N/A';
    }

    // Helper method to get height in meters
    public function getHeightInMeters()
    {
        return $this->height ? $this->height : null;
    }
}
