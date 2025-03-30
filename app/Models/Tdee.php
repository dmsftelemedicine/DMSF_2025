<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tdee extends Model {
    use HasFactory;

    protected $fillable = ['patient_id', 'bmr', 'tdee', 'activity_level'];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function calculateTDEE($activityLevel) {
        if (!$this->weight_kg || !$this->height || !$this->age || !$this->gender) {
            return 'N/A';
        }

        $heightInCm = $this->height * 100; // Convert meters to cm

        $bmr = strtolower($this->gender) === 'male'
            ? (10 * $this->weight_kg) + (6.25 * $heightInCm) - (5 * $this->age) + 5
            : (10 * $this->weight_kg) + (6.25 * $heightInCm) - (5 * $this->age) - 161;

        // Activity level multipliers
        $multipliers = [
            'sedentary' => 1.2,
            'lightly active' => 1.375,
            'moderately active' => 1.55,
            'very active' => 1.725,
            'super active' => 1.9,
        ];

        // Get TDEE based on activity level
        $tdee = isset($multipliers[strtolower($activityLevel)]) ? $bmr * $multipliers[strtolower($activityLevel)] : $bmr;

        // Store in the TDEE table
        return Tdee::updateOrCreate(
            ['patient_id' => $this->id],
            ['bmr' => round($bmr, 2), 'tdee' => round($tdee, 2), 'activity_level' => $activityLevel]
        );
    }

}
