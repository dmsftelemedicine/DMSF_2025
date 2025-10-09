<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComprehensiveHistory extends Model
{
    protected $fillable = [
        'patient_id',
        'informant',
        'informant_other',
        'percent_reliability',
        'chief_concern',
        'history_present_illness',
        'childhood_illness',
        'completed_vaccinations',
        'adult_illness',
        'other_conditions',
        'family_illness',
        'family_other_conditions',
        'food_allergies',
        'drug_allergies',
        'animal_allergies',
        'plant_allergies',
        'substance_allergies',
        'other_allergies',
        'medications',
        'hospitalization',
        'surgical_history',
        'covid_vaccination',
        'other_vaccinations',
        'lmp',
        'pmp',
        'ob_g',
        'ob_p',
        'ob_t',
        'ob_p2',
        'ob_a',
        'ob_l',

        // NEW
        'past_pregnancies',
        'total_number_of_partners',
        'current_partner',

        'menarche',
        'menstrual_interval',
        'menstrual_duration',
        'menstrual_pads',
        'menstrual_amount',
        'menstrual_symptoms',
        'symptom_other_details',
        'coitarche',
        'pap_smear',
        'contraceptive_methods',
        'contraceptive_other',
        'contraceptive_pills_details',
        'contraceptive_depo_details',
        'contraceptive_implant_details',
        'psychiatric_illness',
        'psychiatric_others_details',
        'cigarette_user',
        'cigarette_year_started',
        'cigarette_year_discontinued',
        'current_smoker',
        'sticks_per_day',
        'years_smoking',
        'pack_years',
        'alcohol_drinker',
        'alcohol_year_started',
        'alcohol_year_discontinued',
        'current_drinker',
        'alcohol_type',
        'alcohol_sd',
        'alcohol_frequency',
        'drug_user',
        'drug_type',
        'drug_year_started',
        'drug_year_discontinued',
        'current_drug_user',
        'coffee_user',
        'coffee_type',
        'coffee_amount',
        'coffee_cups',
        'alternative_therapies',
        'therapy_other',
        'schooling',
        'job_history',
        'financial_situation',
        'marriage_children',
        'home_situation',
        'daily_activities',
        'environment',

        // Adult illness details
        'hypertension_type',
        'hypertension_stage',
        'hypertension_control',
        'hypertension_year',
        'hypertension_med_status',
        'hypertension_medications',
        'hypertension_compliance',
        'diabetes_type',
        'diabetes_insulin',
        'diabetes_control',
        'diabetes_year',
        'diabetes_med_status',
        'diabetes_medications',
        'diabetes_compliance',
        'asthma_control',
        'asthma_year',
        'asthma_med_status',
        'asthma_medications',
        'asthma_compliance',

        // Family illness details
        'hypertension_relation',
        'hypertension_side',
        'hypertension_family_year',
        'hypertension_family_medications',
        'hypertension_family_status',
        'diabetes_relation',
        'diabetes_side',
        'diabetes_family_year',
        'diabetes_family_medications',
        'diabetes_family_status',
        'asthma_relation',
        'asthma_side',
        'asthma_family_year',
        'cancer_relation',
        'cancer_side',
        'cancer_family_year',
        'cancer_family_medications',
        'cancer_family_status',

        // Dyslipidemia (keep the one you actually use in controllers/migrations)
        'dyslipidemia_year',
        'dyslipidemia_status',     // <- remove if you don't have this column
        'dyslipidemia_compliance',
        'dyslipidemia_medications',
        'dyslipidemia_med_status',

        // Condition details
        'cancer_details',
        'cancer_status',
        'dyslipidemia_details',
        'neurologic_details',
        'liver_details',
        'kidney_details',
        'other_condition_details',
        'family_dyslipidemia_details',
        'family_neurologic_details',
        'family_liver_details',
        'family_kidney_details',
        'family_other_details',
        'diagnostic_test_results',
    ];

    protected $casts = [
        'informant' => 'array',
        'childhood_illness' => 'array',
        'adult_illness' => 'array',
        'other_conditions' => 'array',
        'family_illness' => 'array',
        'family_other_conditions' => 'array',
        'hospitalization' => 'array',
        'surgical_history' => 'array',
        'covid_vaccination' => 'array',
        'other_vaccinations' => 'array',
        'menstrual_symptoms' => 'array',
        'contraceptive_methods' => 'array',
        'psychiatric_illness' => 'array',
        'alternative_therapies' => 'array',

        // booleans
        'completed_vaccinations' => 'boolean',
        'cigarette_user' => 'boolean',
        'current_smoker' => 'boolean',
        'alcohol_drinker' => 'boolean',
        'current_drinker' => 'boolean',
        'drug_user' => 'boolean',
        'current_drug_user' => 'boolean',
        'coffee_user' => 'boolean',

        // dates
        'lmp' => 'datetime:Y-m-d',
        'pmp' => 'datetime:Y-m-d',

        // JSON arrays
        'past_pregnancies' => 'array',

        // NEW helpful casts
        'total_number_of_partners' => 'integer',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
