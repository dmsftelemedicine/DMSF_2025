<?php

namespace Database\Factories;

use App\Models\Icd10;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Icd10>
 */
class Icd10Factory extends Factory
{
    protected $model = Icd10::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = [
            'Endocrine' => [
                ['E11.9', 'Type 2 diabetes mellitus without complications'],
                ['E11.0', 'Type 2 diabetes mellitus with hyperosmolarity'],
                ['E10.9', 'Type 1 diabetes mellitus without complications'],
                ['E78.0', 'Pure hypercholesterolemia'],
            ],
            'Circulatory' => [
                ['I10', 'Essential hypertension'],
                ['I25.9', 'Chronic ischemic heart disease, unspecified'],
                ['I50.9', 'Heart failure, unspecified'],
            ],
            'Respiratory' => [
                ['J44.1', 'Chronic obstructive pulmonary disease with acute exacerbation'],
                ['J45.9', 'Asthma, unspecified'],
            ],
            'Digestive' => [
                ['K21.9', 'Gastro-esophageal reflux disease without esophagitis'],
                ['K59.00', 'Constipation, unspecified'],
            ],
        ];

        $category = $this->faker->randomElement(array_keys($categories));
        $diagnosis = $this->faker->randomElement($categories[$category]);

        return [
            'code' => $diagnosis[0],
            'description' => $diagnosis[1],
            'category' => $category,
        ];
    }

    /**
     * Create diabetes-related ICD-10 codes
     */
    public function diabetes()
    {
        return $this->state(function (array $attributes) {
            $diabetesCodes = [
                ['E11.9', 'Type 2 diabetes mellitus without complications'],
                ['E11.0', 'Type 2 diabetes mellitus with hyperosmolarity'],
                ['E11.21', 'Type 2 diabetes mellitus with diabetic nephropathy'],
                ['E11.22', 'Type 2 diabetes mellitus with diabetic chronic kidney disease'],
            ];

            $code = $this->faker->randomElement($diabetesCodes);

            return [
                'code' => $code[0],
                'description' => $code[1],
                'category' => 'Endocrine',
            ];
        });
    }

    /**
     * Create cardiovascular-related ICD-10 codes
     */
    public function cardiovascular()
    {
        return $this->state(function (array $attributes) {
            $cvCodes = [
                ['I10', 'Essential hypertension'],
                ['I25.9', 'Chronic ischemic heart disease, unspecified'],
                ['I50.9', 'Heart failure, unspecified'],
                ['I48.91', 'Unspecified atrial fibrillation'],
            ];

            $code = $this->faker->randomElement($cvCodes);

            return [
                'code' => $code[0],
                'description' => $code[1],
                'category' => 'Circulatory',
            ];
        });
    }
}