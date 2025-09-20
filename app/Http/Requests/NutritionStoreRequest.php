<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutritionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'consultation_id' => 'nullable|exists:consultations,id',
            'patient_id' => 'required|exists:patients,id',
            'fruit' => 'required|in:1,2,3,4,5,6,7',
            'fruit_juice' => 'required|in:1,2,3,4,5,6,7',
            'vegetables' => 'required|in:1,2,3,4,5,6,7',
            'green_vegetables' => 'required|in:1,2,3,4,5,6,7',
            'starchy_vegetables' => 'required|in:1,2,3,4,5,6,7',
            'grains' => 'required|in:1,2,3,4,5,6,7',
            'grains_frequency' => 'nullable|in:rarely,sometimes,often,daily',
            'whole_grains' => 'required|in:1,2,3,4,5,6,7',
            'whole_grains_frequency' => 'nullable|in:rarely,sometimes,often,daily',
            'milk' => 'required|in:1,2,3,4,5,6,7',
            'milk_frequency' => 'nullable|in:rarely,sometimes,often,daily',
            'low_fat_milk' => 'required|in:1,2,3,4,5,6,7',
            'low_fat_milk_frequency' => 'nullable|in:rarely,sometimes,often,daily',
            'beans' => 'required|in:1,2,3,4,5,6,7',
            'nuts_seeds' => 'required|in:1,2,3,4,5,6,7',
            'seafood' => 'required|in:1,2,3,4,5,6,7',
            'seafood_frequency' => 'nullable|in:rarely,sometimes,often,daily',
            'ssb' => 'required|in:1,2,3,4,5,6,7',
            'ssb_frequency' => 'nullable|in:rarely,sometimes,often,daily',
            'added_sugars' => 'required|in:none,some,a_lot',
            'saturated_fat' => 'required|in:none,some,a_lot',
            'water' => 'required|in:none,some,a_lot',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'patient_id.required' => 'Patient ID is required.',
            'patient_id.exists' => 'Selected patient does not exist.',
            'consultation_id.exists' => 'Selected consultation does not exist.',
            '*.required' => 'This field is required.',
            '*.in' => 'Please select a valid option.',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'fruit' => 'fruit servings',
            'fruit_juice' => 'fruit juice servings',
            'vegetables' => 'vegetable servings',
            'green_vegetables' => 'green vegetable servings',
            'starchy_vegetables' => 'starchy vegetable servings',
            'grains' => 'grain servings',
            'whole_grains' => 'whole grain servings',
            'milk' => 'milk servings',
            'low_fat_milk' => 'low-fat milk servings',
            'beans' => 'bean servings',
            'nuts_seeds' => 'nuts/seeds servings',
            'seafood' => 'seafood servings',
            'ssb' => 'sugar-sweetened beverage servings',
            'added_sugars' => 'added sugars consumption',
            'saturated_fat' => 'saturated fat consumption',
            'water' => 'water consumption',
        ];
    }
}
