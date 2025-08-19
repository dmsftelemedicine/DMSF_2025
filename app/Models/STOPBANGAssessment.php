<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class STOPBANGAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'stopbang_q1',
        'stopbang_q2',
        'stopbang_q3',
        'stopbang_q4',
        'stopbang_q5',
        'stopbang_q6',
        'stopbang_q7',
        'stopbang_q8',
        'total_score',
        'risk_level',
        'interpretation',
        'recommendations',
    ];

    protected $casts = [
        'stopbang_q1' => 'integer',
        'stopbang_q2' => 'integer',
        'stopbang_q3' => 'integer',
        'stopbang_q4' => 'integer',
        'stopbang_q5' => 'integer',
        'stopbang_q6' => 'integer',
        'stopbang_q7' => 'integer',
        'stopbang_q8' => 'integer',
        'total_score' => 'integer',
    ];

    /**
     * Get the patient that owns the STOP-BANG assessment.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
