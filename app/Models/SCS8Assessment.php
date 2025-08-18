<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SCS8Assessment extends Model
{
    use HasFactory;

    protected $table = 'scs8_assessments';

    protected $fillable = [
        'patient_id',
        'scs8_q1','scs8_q2','scs8_q3','scs8_q4','scs8_q5','scs8_q6','scs8_q7','scs8_q8',
        'total_score',
        'connectedness_level',
        'connectedness_category',
        'remarks',
    ];

    protected $casts = [
        'scs8_q1' => 'integer',
        'scs8_q2' => 'integer',
        'scs8_q3' => 'integer',
        'scs8_q4' => 'integer',
        'scs8_q5' => 'integer',
        'scs8_q6' => 'integer',
        'scs8_q7' => 'integer',
        'scs8_q8' => 'integer',
        'total_score' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


