<?php

namespace Database\Factories;

use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    protected $model = Consultation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'consultation_number' => $this->faker->numberBetween(1, 5),
            'consultation_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a first consultation
     */
    public function first()
    {
        return $this->state(function (array $attributes) {
            return [
                'consultation_number' => 1,
            ];
        });
    }

    /**
     * Create a follow-up consultation
     */
    public function followUp($number = 2)
    {
        return $this->state(function (array $attributes) use ($number) {
            return [
                'consultation_number' => $number,
            ];
        });
    }

    /**
     * Create consultation for today
     */
    public function today()
    {
        return $this->state(function (array $attributes) {
            return [
                'consultation_date' => now(),
            ];
        });
    }

    /**
     * Create consultation for specific patient
     */
    public function forPatient($patientId)
    {
        return $this->state(function (array $attributes) use ($patientId) {
            return [
                'patient_id' => $patientId,
            ];
        });
    }
}