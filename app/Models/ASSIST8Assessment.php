<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ASSIST8Assessment extends Model
{
    use HasFactory;

    protected $table = 'assist8_assessments';

    protected $fillable = [
        'patient_id',
        'data_json', // store per-substance answers and scores as JSON
        'injection_use',
    ];

    protected $casts = [
        'data_json' => 'array',
        'injection_use' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


