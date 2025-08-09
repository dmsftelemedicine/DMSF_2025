<?php

namespace Database\Factories;

use App\Models\Nutrition;
use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nutrition>
 */
class NutritionFactory extends Factory
{
    protected $model = Nutrition::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'consultation_id' => null, // Will be set if consultation is needed
            'fruit' => $this->faker->numberBetween(0, 5),
            'fruit_juice' => $this->faker->numberBetween(0, 3),
            'vegetables' => $this->faker->numberBetween(0, 5),
            'green_vegetables' => $this->faker->numberBetween(0, 3),
            'starchy_vegetables' => $this->faker->numberBetween(0, 3),
            'grains' => $this->faker->numberBetween(0, 8),
            'grains_frequency' => $this->faker->randomElement(['daily', 'weekly', 'rarely']),
            'whole_grains' => $this->faker->numberBetween(0, 3),
            'whole_grains_frequency' => $this->faker->randomElement(['daily', 'weekly', 'rarely']),
            'milk' => $this->faker->numberBetween(0, 3),
            'milk_frequency' => $this->faker->randomElement(['daily', 'weekly', 'rarely']),
            'low_fat_milk' => $this->faker->numberBetween(0, 3),
            'low_fat_milk_frequency' => $this->faker->randomElement(['daily', 'weekly', 'rarely']),
            'beans' => $this->faker->numberBetween(0, 3),
            'nuts_seeds' => $this->faker->numberBetween(0, 3),
            'seafood' => $this->faker->numberBetween(0, 4),
            'seafood_frequency' => $this->faker->randomElement(['daily', 'weekly', 'rarely']),
            'ssb' => $this->faker->numberBetween(0, 5),
            'ssb_frequency' => $this->faker->randomElement(['daily', 'weekly', 'rarely']),
            'added_sugars' => $this->faker->numberBetween(0, 5),
            'saturated_fat' => $this->faker->numberBetween(0, 5),
            'water' => $this->faker->numberBetween(6, 12),
            'dq_score' => $this->faker->optional()->numberBetween(0, 100),
            'icd_diagnosis' => $this->faker->optional()->text(50),
        ];
    }

    /**
     * Create nutrition assessment with consultation
     */
    public function withConsultation()
    {
        return $this->state(function (array $attributes) {
            return [
                'consultation_id' => Consultation::factory(),
            ];
        });
    }

    /**
     * Create nutrition assessment with poor diet quality
     */
    public function poorDiet()
    {
        return $this->state(function (array $attributes) {
            return [
                'fruit' => $this->faker->numberBetween(0, 1),
                'vegetables' => $this->faker->numberBetween(0, 1),
                'whole_grains' => $this->faker->numberBetween(0, 1),
                'ssb' => $this->faker->numberBetween(3, 5),
                'added_sugars' => $this->faker->numberBetween(3, 5),
                'dq_score' => $this->faker->numberBetween(0, 40),
            ];
        });
    }

    /**
     * Create nutrition assessment with good diet quality
     */
    public function goodDiet()
    {
        return $this->state(function (array $attributes) {
            return [
                'fruit' => $this->faker->numberBetween(3, 5),
                'vegetables' => $this->faker->numberBetween(3, 5),
                'whole_grains' => $this->faker->numberBetween(2, 3),
                'ssb' => $this->faker->numberBetween(0, 1),
                'added_sugars' => $this->faker->numberBetween(0, 1),
                'water' => $this->faker->numberBetween(8, 12),
                'dq_score' => $this->faker->numberBetween(70, 100),
            ];
        });
    }
}