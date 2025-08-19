<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GAD7Assessment extends Model
{
    use HasFactory;

    protected $table = 'gad7_assessments';

    protected $fillable = [
        'patient_id',
        'gad7_q1','gad7_q2','gad7_q3','gad7_q4','gad7_q5','gad7_q6','gad7_q7',
        'gad7_difficulty',
        'total_score',
        'severity',
        'remarks',
    ];

    protected $casts = [
        'gad7_q1' => 'integer',
        'gad7_q2' => 'integer',
        'gad7_q3' => 'integer',
        'gad7_q4' => 'integer',
        'gad7_q5' => 'integer',
        'gad7_q6' => 'integer',
        'gad7_q7' => 'integer',
        'total_score' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


