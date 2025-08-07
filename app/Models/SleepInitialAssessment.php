<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepInitialAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'sleep_time',
        'wake_up_time',
        'usual_sleep_duration',
        'sleep_quality_rating',
        'hygiene_activities',
        'daytime_sleepiness',
        'blood_pressure',
        'bmi',
        'age',
        'neck_circumference',
        'gender',
    ];

    protected $casts = [
        'sleep_time' => 'datetime:H:i',
        'wake_up_time' => 'datetime:H:i',
        'usual_sleep_duration' => 'decimal:1',
        'sleep_quality_rating' => 'integer',
        'hygiene_activities' => 'array',
        'bmi' => 'decimal:2',
        'age' => 'integer',
        'neck_circumference' => 'decimal:1',
    ];

    /**
     * Get the patient that owns the sleep initial assessment.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
