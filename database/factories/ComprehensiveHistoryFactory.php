<?php

namespace Database\Factories;

use App\Models\ComprehensiveHistory;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComprehensiveHistory>
 */
class ComprehensiveHistoryFactory extends Factory
{
    protected $model = ComprehensiveHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'chief_complaint' => $this->faker->sentence(),
            'history_of_present_illness' => $this->faker->paragraph(3),
            'past_medical_history' => $this->faker->paragraph(2),
            'family_history' => $this->faker->paragraph(2),
            'social_history' => $this->faker->paragraph(2),
            'allergies' => $this->faker->optional()->sentence(),
            'medications' => $this->faker->optional()->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create comprehensive history for specific patient
     */
    public function forPatient($patientId)
    {
        return $this->state(function (array $attributes) use ($patientId) {
            return [
                'patient_id' => $patientId,
            ];
        });
    }

    /**
     * Create draft comprehensive history
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'chief_complaint' => $this->faker->sentence(),
                'history_of_present_illness' => $this->faker->paragraph(1), // Shorter for draft
                'past_medical_history' => null,
                'family_history' => null,
                'social_history' => null,
                'status' => 'draft',
            ];
        });
    }

    /**
     * Create complete comprehensive history
     */
    public function complete()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'complete',
            ];
        });
    }
}