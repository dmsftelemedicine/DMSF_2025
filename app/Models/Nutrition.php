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
        'consultation_id',
        'fruit', 'fruit_juice', 'vegetables', 'green_vegetables', 'starchy_vegetables',
        'grains', 'grains_frequency', 'whole_grains', 'whole_grains_frequency', 'milk',
        'milk_frequency', 'low_fat_milk', 'low_fat_milk_frequency', 'beans', 'nuts_seeds',
        'seafood', 'seafood_frequency', 'ssb', 'ssb_frequency', 'added_sugars',
        'saturated_fat', 'water', 'dq_score', 'icd_diagnosis'
    ];

    protected $table = 'nutritions';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function foodRecalls()
    {
        return $this->hasMany(FoodRecall::class);
    }
}
