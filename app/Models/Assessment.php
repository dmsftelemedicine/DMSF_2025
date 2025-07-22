<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }

    public function medicalDiagnoses()
    {
        return $this->hasMany(Diagnosis::class)->where('type', 'medical');
    }

    public function lifestyleDiagnoses()
    {
        return $this->hasMany(Diagnosis::class)->where('type', 'lifestyle');
    }
}
