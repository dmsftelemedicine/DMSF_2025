<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyAPGARAssessment extends Model
{
    use HasFactory;

    protected $table = 'family_apgar_assessments';

    protected $fillable = [
        'patient_id',
        'apgar_q1','apgar_q2','apgar_q3','apgar_q4','apgar_q5',
        'total_score',
        'family_functioning',
        'functioning_category',
        'remarks',
    ];

    protected $casts = [
        'apgar_q1' => 'integer',
        'apgar_q2' => 'integer',
        'apgar_q3' => 'integer',
        'apgar_q4' => 'integer',
        'apgar_q5' => 'integer',
        'total_score' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


