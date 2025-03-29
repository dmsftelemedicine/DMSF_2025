<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Nutrition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'question_1', 'question_2', 'question_3', 'question_4', 'question_5',
        'question_6', 'question_7', 'question_8', 'question_9', 'question_10',
        'question_11', 'question_12', 'question_13', 'question_14', 'question_15',
        'question_16', 'question_17', 'question_18', 'question_19', 'question_20',
        'question_21', 'question_22'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
