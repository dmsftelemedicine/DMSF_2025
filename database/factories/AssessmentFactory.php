<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    protected $model = Assessment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'consultation_id' => Consultation::factory(),
            'chief_complaint' => $this->faker->sentence(),
            'history_of_present_illness' => $this->faker->paragraph(),
            'assessment' => $this->faker->paragraph(),
            'plan' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create assessment for specific patient
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
     * Create assessment with specific consultation
     */
    public function forConsultation($consultationId)
    {
        return $this->state(function (array $attributes) use ($consultationId) {
            return [
                'consultation_id' => $consultationId,
            ];
        });
    }
}