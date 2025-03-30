<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'meal_type',
        'protein',
        'fat',
        'carbohydrates',
    ];

    // Relationship with Patient Model
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
