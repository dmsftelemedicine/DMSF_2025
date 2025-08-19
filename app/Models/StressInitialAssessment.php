<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StressInitialAssessment extends Model
{
    use HasFactory;

    protected $table = 'stress_initial_assessments';

    protected $fillable = [
        'patient_id',
        'stress_rating',
    ];

    protected $casts = [
        'stress_rating' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


