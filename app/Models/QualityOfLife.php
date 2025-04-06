<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityOfLife extends Model
{
    use HasFactory;

    protected $table = 'qualityoflife';
    protected $fillable = [
        'patient_id', 'mobility', 'self_care', 'usual_activities', 'pain', 'anxiety', 'health_today', 'icd_10'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
