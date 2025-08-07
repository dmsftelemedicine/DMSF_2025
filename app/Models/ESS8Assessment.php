<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ESS8Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'ess_q1',
        'ess_q2',
        'ess_q3',
        'ess_q4',
        'ess_q5',
        'ess_q6',
        'ess_q7',
        'ess_q8',
        'total_score',
        'severity',
        'interpretation',
        'recommendations',
    ];

    protected $casts = [
        'ess_q1' => 'integer',
        'ess_q2' => 'integer',
        'ess_q3' => 'integer',
        'ess_q4' => 'integer',
        'ess_q5' => 'integer',
        'ess_q6' => 'integer',
        'ess_q7' => 'integer',
        'ess_q8' => 'integer',
        'total_score' => 'integer',
    ];

    /**
     * Get the patient that owns the ESS-8 assessment.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
