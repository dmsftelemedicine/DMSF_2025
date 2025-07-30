<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelemedicinePerception extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['first_time', 'patient_id', 'consultation_id', 'question_1', 'question_2', 'question_3', 'question_4', 'question_5', 'satisfaction',];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
