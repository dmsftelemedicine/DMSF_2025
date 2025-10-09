<?php

namespace App\Http\Controllers;

use App\Models\ComprehensiveHistory;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComprehensiveHistoryController extends Controller
{
    public function show(Patient $patient)
    {
        $comprehensiveHistory = $patient->comprehensiveHistory()->first();
        return view('patients.comprehensive_history.comprehensive_history', compact('patient', 'comprehensiveHistory'));
    }

    public function get(Patient $patient)
    {
        $comprehensiveHistory = $patient->comprehensiveHistory;
        return response()->json($comprehensiveHistory);
    }

    public function store(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'informant' => 'nullable|array',
            'informant_other' => 'nullable|string',
            'percent_reliability' => 'nullable|integer|min:0|max:100',
            'chief_concern' => 'nullable|string',
            'history_present_illness' => 'nullable|string',
            'childhood_illness' => 'nullable|array',
            'completed_vaccinations' => 'nullable|boolean',
            'adult_illness' => 'nullable|array',
            'other_conditions' => 'nullable|array',
            'family_illness' => 'nullable|array',
            'family_other_conditions' => 'nullable|array',
            'food_allergies' => 'nullable|string',
            'drug_allergies' => 'nullable|string',
            'animal_allergies' => 'nullable|string',
            'plant_allergies' => 'nullable|string',
            'substance_allergies' => 'nullable|string',
            'other_allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'hospitalization' => 'nullable|array',
            'surgical_history' => 'nullable|array',
            'covid_vaccination' => 'nullable|array',
            'other_vaccinations' => 'nullable|array',
            'lmp' => 'nullable|date_format:Y-m-d',
            'pmp' => 'nullable|date_format:Y-m-d',
            'ob_g' => 'nullable|string',
            'ob_p' => 'nullable|string',
            'ob_t' => 'nullable|string',
            'ob_p2' => 'nullable|string',
            'ob_a' => 'nullable|string',
            'ob_l' => 'nullable|string',
            'past_pregnancy_number.*' => ['nullable','string'],
            'past_pregnancy_sex.*' => ['nullable','in:Male,Female,Unknown'],
            'past_pregnancy_manner_of_delivery.*' => ['nullable','string','max:255'],
            'past_pregnancy_disposition_complications.*' => ['nullable','string','max:255'],
            'current_partner' => ['nullable','string','in:None,Male,Female,Both males and females'],
            'total_number_of_partners' => ['nullable','integer','min:0','max:65535'],
            'menarche' => 'nullable|string',
            'menstrual_interval' => 'nullable|string',
            'menstrual_duration' => 'nullable|string',
            'menstrual_pads' => 'nullable|integer|min:0',
            'menstrual_amount' => 'nullable|string',
            'menstrual_symptoms' => 'nullable|array',
            'symptom_other_details' => 'nullable|string|max:255',
            'coitarche' => 'nullable|string',
            'pap_smear' => 'nullable|string',
            'contraceptive_methods' => 'nullable|array',
            'contraceptive_other' => 'nullable|string',
            'contraceptive_pills_details' => 'nullable|string',
            'contraceptive_depo_details' => 'nullable|string',
            'contraceptive_implant_details' => 'nullable|string',
            'psychiatric_illness' => 'nullable|array',
            'psychiatric_others_details' => 'nullable|string',
            'cigarette_user' => 'nullable|boolean',
            'cigarette_year_started' => 'nullable|string',
            'cigarette_year_discontinued' => 'nullable|string',
            'current_smoker' => 'nullable|boolean',
            'sticks_per_day' => 'nullable|integer|min:0',
            'years_smoking' => 'nullable|integer|min:0',
            'pack_years' => 'nullable|numeric|min:0',
            'alcohol_drinker' => 'nullable|boolean',
            'alcohol_year_started' => 'nullable|string',
            'alcohol_year_discontinued' => 'nullable|string',
            'current_drinker' => 'nullable|boolean',
            'alcohol_type' => 'nullable|string',
            'alcohol_sd' => 'nullable|integer|min:0',
            'alcohol_frequency' => 'nullable|string',
            'drug_user' => 'nullable|boolean',
            'drug_type' => 'nullable|string',
            'drug_year_started' => 'nullable|string',
            'drug_year_discontinued' => 'nullable|string',
            'current_drug_user' => 'nullable|boolean',
            'coffee_user' => 'nullable|boolean',
            'coffee_type' => 'nullable|string',
            'coffee_amount' => 'nullable|string',
            'coffee_cups' => 'nullable|string',
            'alternative_therapies' => 'nullable|array',
            'therapy_other' => 'nullable|string',
            'schooling' => 'nullable|string',
            'job_history' => 'nullable|string',
            'financial_situation' => 'nullable|string',
            'marriage_children' => 'nullable|string',
            'home_situation' => 'nullable|string',
            'daily_activities' => 'nullable|string',
            'environment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Process hospitalization data
            $hospitalizationData = [];
            if ($request->has('hospitalization_year')) {
                foreach ($request->hospitalization_year as $key => $year) {
                    if (!empty($year)) {
                        $hospitalizationData[] = [
                            'year' => $year,
                            'diagnosis' => $request->hospitalization_diagnosis[$key] ?? null,
                            'notes' => $request->hospitalization_notes[$key] ?? null,
                        ];
                    }
                }
            }

            // Process surgical history data
            $surgicalHistoryData = [];
            if ($request->has('surgical_year')) {
                foreach ($request->surgical_year as $key => $year) {
                    if (!empty($year)) {
                        $surgicalHistoryData[] = [
                            'year' => $year,
                            'diagnosis' => $request->surgical_diagnosis[$key] ?? null,
                            'procedure' => $request->surgical_procedure[$key] ?? null,
                            'biopsy' => $request->surgical_biopsy[$key] ?? null,
                            'notes' => $request->surgical_notes[$key] ?? null,
                        ];
                    }
                }
            }

            // Process childhood illness data
            $childhoodIllnessData = [];
            if ($request->has('childhood_illness')) {
                foreach ($request->childhood_illness as $illness) {
                    $childhoodIllnessData[$illness] = [
                        'year' => $request->input("{$illness}_year"),
                        'complications' => $request->input("{$illness}_complications") ?? $request->input("{$illness}_other_information"),
                    ];
                }
            }

            // Process adult illness details
            $adultIllnessDetails = [];
            foreach (['hypertension', 'diabetes', 'bronchial_asthma', 'dyslipidemia'] as $illness) {
                if ($request->has('adult_illness') && in_array($illness, $request->adult_illness)) {
                    $prefix = ($illness === 'bronchial_asthma') ? 'asthma' : $illness;
                    $adultIllnessDetails["{$prefix}_type"] = $request->input("{$prefix}_type");
                    $adultIllnessDetails["{$prefix}_stage"] = $request->input("{$prefix}_stage");
                    $adultIllnessDetails["{$prefix}_control"] = $request->input("{$prefix}_control");
                    $adultIllnessDetails["{$prefix}_year"] = $request->input("{$prefix}_year");
                    $adultIllnessDetails["{$prefix}_med_status"] = $request->input("{$prefix}_med_status");
                    $adultIllnessDetails["{$prefix}_medications"] = $request->input("{$prefix}_medications");
                    $adultIllnessDetails["{$prefix}_compliance"] = $request->input("{$prefix}_compliance");
                    $adultIllnessDetails["{$prefix}_insulin"] = $request->input("{$prefix}_insulin");
                }
            }

            // Process family illness details
            $familyIllnessDetails = [];
            foreach (['hypertension', 'diabetes', 'asthma', 'cancer'] as $illness) {
                if ($request->has('family_illness') && in_array($illness, $request->family_illness)) {
                    $familyIllnessDetails["{$illness}_relation"] = $request->input("{$illness}_relation");
                    $familyIllnessDetails["{$illness}_side"] = $request->input("{$illness}_side");
                    $familyIllnessDetails["{$illness}_family_year"] = $request->input("{$illness}_family_year");
                    $familyIllnessDetails["{$illness}_family_medications"] = $request->input("{$illness}_family_medications");
                    $familyIllnessDetails["{$illness}_family_status"] = $request->input("{$illness}_family_status");
                }
            }

            // Process other condition details
            $otherConditionDetails = [];
            foreach (['cancer', 'dyslipidemia', 'neurologic', 'liver', 'kidney', 'other_condition'] as $condition) {
                $otherConditionDetails["{$condition}_details"] = $request->input("{$condition}_details");
            }

            // Process family other condition details
            $familyOtherConditionDetails = [];
            foreach (['dyslipidemia', 'neurologic', 'liver', 'kidney', 'other'] as $condition) {
                $familyOtherConditionDetails["family_{$condition}_details"] = $request->input("family_{$condition}_details");
            }

            // Process vaccination data
            $covidVaccination = [
                'year' => $request->covid_year,
                'brand' => $request->covid_brand,
                'boosters' => $request->covid_boosters,
            ];

            $otherVaccinations = [
                'pcv' => $request->pcv_vaccine,
                'flu' => $request->flu_vaccine,
                'hepb' => $request->hepb_vaccine,
                'hpv' => $request->hpv_vaccine,
                'others' => $request->other_vaccines,
            ];

            // Process past pregnancy data (array of rows) — robust against gaps/missing keys
            $pastPregnancies = [];

            $numbers    = array_values((array) $request->input('past_pregnancy_number', []));
            $sexes      = array_values((array) $request->input('past_pregnancy_sex', []));
            $deliveries = array_values((array) $request->input('past_pregnancy_manner_of_delivery', []));
            $dispos     = array_values((array) $request->input('past_pregnancy_disposition_complications', []));

            $max = max(count($numbers), count($sexes), count($deliveries), count($dispos));

            for ($i = 0; $i < $max; $i++) {
                $num         = $numbers[$i]    ?? null;
                $sex         = $sexes[$i]      ?? null; // 'Male' | 'Female' | 'Unknown'
                $delivery    = $deliveries[$i] ?? null;
                $disposition = $dispos[$i]     ?? null;

                // Skip only if the entire row is empty
                if (
                    ($num === null || $num === '') &&
                    ($sex === null || $sex === '') &&
                    ($delivery === null || $delivery === '') &&
                    ($disposition === null || $disposition === '')
                ) {
                    continue;
                }

                $pastPregnancies[] = [
                    'number'                   => $num,
                    'sex'                      => $sex,
                    'manner_of_delivery'       => $delivery,
                    'disposition_complications'=> $disposition,
                ];
            }

            $totalPartners  = $request->input('total_number_of_partners'); 
            $currentPartner = $request->input('current_partner');          
            
            $comprehensiveHistory = $patient->comprehensiveHistory()->updateOrCreate(
                ['patient_id' => $patient->id],
                array_merge(
                    $request->except([
                        'hospitalization_year','hospitalization_diagnosis','hospitalization_notes',
                        'surgical_year','surgical_diagnosis','surgical_procedure','surgical_biopsy','surgical_notes',
                        'covid_year','covid_brand','covid_boosters','pcv_vaccine','flu_vaccine','hepb_vaccine','hpv_vaccine','other_vaccines',
                        'hypertension_type','hypertension_stage','hypertension_control','hypertension_year',
                        'hypertension_med_status','hypertension_medications','hypertension_compliance',
                        'diabetes_type','diabetes_insulin','diabetes_control','diabetes_year',
                        'diabetes_med_status','diabetes_medications','diabetes_compliance',
                        'asthma_control','asthma_year','asthma_med_status','asthma_medications','asthma_compliance',
                        'hypertension_relation','hypertension_side','hypertension_family_year','hypertension_family_medications','hypertension_family_status',
                        'diabetes_relation','diabetes_side','diabetes_family_year','diabetes_family_medications','diabetes_family_status',
                        'asthma_relation','asthma_side','asthma_family_year',
                        'cancer_relation','cancer_side','cancer_family_year','cancer_family_medications','cancer_family_status',
                        'dyslipidemia_year','dyslipidemia_med_status','dyslipidemia_compliance','dyslipidemia_medications','dyslipidemia_med_status',
                        'cancer_details','dyslipidemia_details','neurologic_details','liver_details','kidney_details','other_condition_details',
                        'family_dyslipidemia_details','family_neurologic_details','family_liver_details','family_kidney_details','family_other_details',
                        'past_pregnancy_number',
                        'past_pregnancy_sex',
                        'past_pregnancy_manner_of_delivery',
                        'past_pregnancy_disposition_complications',
                    ]),
                    [
                        'hospitalization'     => $hospitalizationData,
                        'surgical_history'    => $surgicalHistoryData,
                        'childhood_illness'   => $childhoodIllnessData,
                        'covid_vaccination'   => $covidVaccination,
                        'other_vaccinations'  => $otherVaccinations,
                        'past_pregnancies'    => empty($pastPregnancies) ? null : $pastPregnancies,
            
                        'total_number_of_partners' => $totalPartners,
                        'current_partner'          => $currentPartner,
                    ],
                    $adultIllnessDetails,
                    $familyIllnessDetails,
                    $otherConditionDetails,
                    $familyOtherConditionDetails
                )
            );                    

            return response()->json([
                'success' => true,
                'message' => 'Comprehensive history saved successfully',
                'data' => $comprehensiveHistory
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving comprehensive history: ' . $e->getMessage()
            ], 500);
        }
    }
}
