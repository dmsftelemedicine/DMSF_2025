<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'ICD_10',
        'medical_diagnosis',
        'lifestyle_diagnosis',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
