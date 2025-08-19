<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FND6Assessment extends Model
{
    use HasFactory;

    protected $table = 'fnd6_assessments';

    protected $fillable = [
        'patient_id',
        'q1','q2','q3','q4','q5','q6',
        'total_score',
        'dependence_level',
    ];

    protected $casts = [
        'q1' => 'integer',
        'q2' => 'integer',
        'q3' => 'integer',
        'q4' => 'integer',
        'q5' => 'integer',
        'q6' => 'integer',
        'total_score' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


