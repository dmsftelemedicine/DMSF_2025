<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifestylePrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'diet_type',
        'diet_notes',
        'exercise_type',
        'exercise_notes',
        'blood_sugar_monitoring',
        'weight_management',
        'follow_up_schedule',
    ];

    public function patient()
    {
        return $this->belongsTo(\App\Models\Patient::class);
    }
}
