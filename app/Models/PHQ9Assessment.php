<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PHQ9Assessment extends Model
{
    use HasFactory;

    protected $table = 'phq9_assessments';

    protected $fillable = [
        'patient_id',
        'phq9_q1','phq9_q2','phq9_q3','phq9_q4','phq9_q5','phq9_q6','phq9_q7','phq9_q8','phq9_q9',
        'total_score',
        'severity',
        'suicide_risk',
        'remarks',
    ];

    protected $casts = [
        'phq9_q1' => 'integer',
        'phq9_q2' => 'integer',
        'phq9_q3' => 'integer',
        'phq9_q4' => 'integer',
        'phq9_q5' => 'integer',
        'phq9_q6' => 'integer',
        'phq9_q7' => 'integer',
        'phq9_q8' => 'integer',
        'phq9_q9' => 'integer',
        'total_score' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


