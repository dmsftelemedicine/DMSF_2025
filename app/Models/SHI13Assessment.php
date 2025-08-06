<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SHI13Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'shi_q1',
        'shi_q2',
        'shi_q3',
        'shi_q4',
        'shi_q5',
        'shi_q6',
        'shi_q7',
        'shi_q8',
        'shi_q9',
        'shi_q10',
        'shi_q11',
        'shi_q12',
        'shi_q13',
        'total_score',
        'severity',
        'interpretation',
        'recommendations',
    ];

    protected $casts = [
        'shi_q1' => 'integer',
        'shi_q2' => 'integer',
        'shi_q3' => 'integer',
        'shi_q4' => 'integer',
        'shi_q5' => 'integer',
        'shi_q6' => 'integer',
        'shi_q7' => 'integer',
        'shi_q8' => 'integer',
        'shi_q9' => 'integer',
        'shi_q10' => 'integer',
        'shi_q11' => 'integer',
        'shi_q12' => 'integer',
        'shi_q13' => 'integer',
        'total_score' => 'integer',
    ];

    /**
     * Get the patient that owns the SHI-13 assessment.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
