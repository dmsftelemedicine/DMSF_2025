<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CAGE4Assessment extends Model
{
    use HasFactory;

    protected $table = 'cage4_assessments';

    protected $fillable = [
        'patient_id',
        'q1','q2','q3','q4',
        'total_score',
        'interpretation',
    ];

    protected $casts = [
        'q1' => 'integer',
        'q2' => 'integer',
        'q3' => 'integer',
        'q4' => 'integer',
        'total_score' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


