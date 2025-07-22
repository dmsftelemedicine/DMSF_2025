<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'type',
        'diagnosis_text',
        'other_info',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
