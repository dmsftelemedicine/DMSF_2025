<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $medicines = [
            ['Metformin', 'Glucophage', '500mg', 'Tablet', 'Antidiabetic', 'Type 2 Diabetes'],
            ['Lisinopril', 'Prinivil', '10mg', 'Tablet', 'ACE Inhibitor', 'Hypertension'],
            ['Atorvastatin', 'Lipitor', '20mg', 'Tablet', 'Statin', 'High Cholesterol'],
            ['Omeprazole', 'Prilosec', '20mg', 'Capsule', 'PPI', 'GERD'],
            ['Amlodipine', 'Norvasc', '5mg', 'Tablet', 'Calcium Channel Blocker', 'Hypertension'],
            ['Losartan', 'Cozaar', '50mg', 'Tablet', 'ARB', 'Hypertension'],
            ['Simvastatin', 'Zocor', '20mg', 'Tablet', 'Statin', 'High Cholesterol'],
            ['Hydrochlorothiazide', 'Microzide', '25mg', 'Tablet', 'Diuretic', 'Hypertension'],
        ];

        $medicine = $this->faker->randomElement($medicines);

        return [
            'generic_name' => $medicine[0],
            'brand_name' => $medicine[1],
            'strength' => $medicine[2],
            'dosage_form' => $medicine[3],
            'therapeutic_class' => $medicine[4],
            'indication' => $medicine[5],
            'description' => $this->faker->optional()->paragraph(),
            'manufacturer' => $this->faker->optional()->company(),
            'storage_requirements' => $this->faker->optional()->sentence(),
            'side_effects' => $this->faker->optional()->paragraph(),
        ];
    }

    /**
     * Create diabetes medications
     */
    public function diabetes()
    {
        return $this->state(function (array $attributes) {
            $diabetesMeds = [
                ['Metformin', 'Glucophage', '500mg', 'Tablet'],
                ['Insulin Glargine', 'Lantus', '100 units/mL', 'Injection'],
                ['Glipizide', 'Glucotrol', '5mg', 'Tablet'],
                ['Sitagliptin', 'Januvia', '100mg', 'Tablet'],
            ];

            $med = $this->faker->randomElement($diabetesMeds);

            return [
                'generic_name' => $med[0],
                'brand_name' => $med[1],
                'strength' => $med[2],
                'dosage_form' => $med[3],
                'therapeutic_class' => 'Antidiabetic',
                'indication' => 'Type 2 Diabetes Mellitus',
            ];
        });
    }

    /**
     * Create hypertension medications
     */
    public function hypertension()
    {
        return $this->state(function (array $attributes) {
            $hypertensionMeds = [
                ['Lisinopril', 'Prinivil', '10mg', 'Tablet'],
                ['Amlodipine', 'Norvasc', '5mg', 'Tablet'],
                ['Losartan', 'Cozaar', '50mg', 'Tablet'],
                ['Hydrochlorothiazide', 'Microzide', '25mg', 'Tablet'],
            ];

            $med = $this->faker->randomElement($hypertensionMeds);

            return [
                'generic_name' => $med[0],
                'brand_name' => $med[1],
                'strength' => $med[2],
                'dosage_form' => $med[3],
                'therapeutic_class' => 'Antihypertensive',
                'indication' => 'Hypertension',
            ];
        });
    }
}