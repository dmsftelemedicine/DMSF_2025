<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExclusionCriteria extends Model
{
    use HasFactory;
    
    protected $table = 'exclusion_criteria';

    protected $fillable = [
        'patient_id',
        'emergency_unstable_case',
        'psychiatric_neuro_condition',
        'unable_complete_data',
        'confined_or_no_activity',
        'unable_feed_cook_decide',
        'pregnant_woman'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
