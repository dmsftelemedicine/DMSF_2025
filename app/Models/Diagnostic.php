<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'created_by',
        'diagnostic_date',
        'requesting_physician',
        'control_number',
        'hematology',
        'clinical_microscopy',
        'blood_chemistry',
        'microbiology',
        'immunology_serology',
        'stool_tests',
        'blood_typing_bsmp',
        'others',
    ];

    protected $casts = [
        'hematology' => 'array',
        'clinical_microscopy' => 'array',
        'blood_chemistry' => 'array',
        'microbiology' => 'array',
        'immunology_serology' => 'array',
        'stool_tests' => 'array',
        'blood_typing_bsmp' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
