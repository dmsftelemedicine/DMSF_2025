<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewOfSystem extends Model
{
    protected $fillable = [
        'patient_id',
        'symptoms'
    ];

    protected $casts = [
        'symptoms' => 'array'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
} 