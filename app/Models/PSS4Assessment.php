<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PSS4Assessment extends Model
{
    use HasFactory;

    protected $table = 'pss4_assessments';

    protected $fillable = [
        'patient_id',
        'pss4_q1','pss4_q2','pss4_q3','pss4_q4',
        'total_score',
        'stress_level',
        'stress_category',
        'interpretation',
    ];

    protected $casts = [
        'pss4_q1' => 'integer',
        'pss4_q2' => 'integer',
        'pss4_q3' => 'integer',
        'pss4_q4' => 'integer',
        'total_score' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


