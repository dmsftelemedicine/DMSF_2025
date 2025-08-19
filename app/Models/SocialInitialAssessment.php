<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialInitialAssessment extends Model
{
    use HasFactory;

    protected $table = 'social_initial_assessments';

    protected $fillable = [
        'patient_id',
        'family_rating',
        'friends_rating',
        'colleagues_rating',
    ];

    protected $casts = [
        'family_rating' => 'integer',
        'friends_rating' => 'integer',
        'colleagues_rating' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


