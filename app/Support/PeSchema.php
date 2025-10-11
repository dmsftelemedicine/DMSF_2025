<?php

namespace App\Support;

final class PeSchema
{
    /**
     * Section keys must be snake_case. Row and option keys should be snake_case too.
     */
    public static function generalSurvey(): array
    {
        return [
            'key' => 'general_survey',
            'title' => 'General Survey',
            'rows' => [
                [
                    'key' => 'demeanor_body_habitus',
                    'title' => 'Demeanor and Body Habitus',
                    'normal_label' => 'Calm with well developed and well-nourished built',
                    'options' => [
                        ['key'=>'restless_agitated','label'=>'Restless / Agitated','help'=>'Anxiety, pain, delirium, stimulant intoxication','needs_detail'=>true],
                        ['key'=>'physical_maturity_problems','label'=>'Physical maturity problems','help'=>'Endocrine disorders (e.g., hypopituitarism, precocious puberty), genetic syndromes','needs_detail'=>true],
                        ['key'=>'ill_looking','label'=>'Ill-looking','help'=>'Infection, anemia, malignancy, cachexia, systemic illness','needs_detail'=>true],
                        ['key'=>'cachectic','label'=>'Cachectic','help'=>'Infection, anemia, malignancy, cachexia, systemic illness','needs_detail'=>true],
                        ['key'=>'obese','label'=>'Obese','help'=>'Excessive body fat that may impair health','needs_detail'=>true],
                        ['key'=>'poor_hygiene_grooming','label'=>'Poor hygiene and grooming','help'=>'Depression, schizophrenia, dementia, cognitive decline, neglect','needs_detail'=>true],
                        ['key'=>'unusual_odor','label'=>'Unusual body or breath odor','help'=>'Uremia (urine odor), diabetic ketoacidosis (fruity/sweet), hepatic failure (musty), poor hygiene','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'breathing',
                    'title' => 'Breathing',
                    'normal_label' => 'Breathing regularly',
                    'options' => [
                        ['key'=>'dyspneic','label'=>'Dyspneic','help'=>'Heart failure, asthma, COPD, pneumonia, pulmonary embolism','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'level_of_alertness',
                    'title' => 'Level of Alertness',
                    'normal_label' => 'Alert and oriented to person, place, time, and situation',
                    'options' => [
                        ['key'=>'drowsy','label'=>'Drowsy','needs_detail'=>true],
                        ['key'=>'disoriented','label'=>'Disoriented','needs_detail'=>true],
                        ['key'=>'confused','label'=>'Confused','needs_detail'=>true],
                        ['key'=>'unresponsive','label'=>'Unresponsive','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'posture',
                    'title' => 'Posture',
                    'normal_label' => 'Erect, ambulating with ease',
                    'options' => [
                        ['key'=>'hunched','label'=>'Hunched','help'=>'Kyphosis, osteoporosis, Parkinson\'s disease, depressive disorders','needs_detail'=>true],
                        ['key'=>'tripod_positioning','label'=>'Tripod positioning','help'=>'Severe respiratory distress, COPD exacerbation, asthma attack','needs_detail'=>true],
                        ['key'=>'involuntary_movements','label'=>'Involuntary movements','help'=>'Parkinson\'s disease, chorea (Huntington\'s), dystonia, medication side effects (e.g., tardive dyskinesia)','needs_detail'=>true],
                        ['key'=>'tremors','label'=>'Tremors','help'=>'Essential tremor, Parkinson\'s disease, hyperthyroidism, drug withdrawal','needs_detail'=>true],
                        ['key'=>'limping','label'=>'Limping','help'=>'Musculoskeletal injury, arthritis, leg length discrepancy, neurological disorder','needs_detail'=>true],
                        ['key'=>'unsteady','label'=>'Unsteadiness or movement difficulties','help'=>'Stroke, Parkinson\'s, neuropathy, musculoskeletal disorders; Vertigo','needs_detail'=>true],
                        ['key'=>'assistive_devices','label'=>'With assistive devices (cane, walker, crutches)','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function skinHair(): array
    {
        return [
            'key' => 'skin_hair',
            'title' => 'Skin & Hair Examination',
            'rows' => [
                [
                    'key' => 'skin_color',
                    'title' => 'Skin Color',
                    'normal_label' => 'Even tone, appropriate for ethnicity',
                    'options' => [
                        ['key'=>'pallor','label'=>'Pallor','help'=>'Pale skin, may indicate anemia','needs_detail'=>true],
                        ['key'=>'cyanosis','label'=>'Cyanosis','help'=>'Bluish discoloration, poor oxygenation','needs_detail'=>true],
                        ['key'=>'jaundice','label'=>'Jaundice','help'=>'Yellowish skin, liver issues','needs_detail'=>true],
                        ['key'=>'erythema','label'=>'Erythema','help'=>'Redness, inflammation','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'skin_texture',
                    'title' => 'Skin Texture & Moisture',
                    'normal_label' => 'Smooth, warm, and appropriately moist',
                    'options' => [
                        ['key'=>'dry','label'=>'Dry','needs_detail'=>true],
                        ['key'=>'oily','label'=>'Oily','needs_detail'=>true],
                        ['key'=>'rough','label'=>'Rough','needs_detail'=>true],
                        ['key'=>'cool','label'=>'Cool to touch','needs_detail'=>true],
                        ['key'=>'clammy','label'=>'Clammy','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'skin_lesions',
                    'title' => 'Skin Lesions',
                    'normal_label' => 'No lesions, rashes, or abnormal markings',
                    'options' => [
                        ['key'=>'rash','label'=>'Rash','needs_detail'=>true],
                        ['key'=>'macules','label'=>'Macules','needs_detail'=>true],
                        ['key'=>'papules','label'=>'Papules','needs_detail'=>true],
                        ['key'=>'vesicles','label'=>'Vesicles','needs_detail'=>true],
                        ['key'=>'pustules','label'=>'Pustules','needs_detail'=>true],
                        ['key'=>'ulcers','label'=>'Ulcers','needs_detail'=>true],
                        ['key'=>'bruising','label'=>'Bruising/Ecchymosis','needs_detail'=>true],
                        ['key'=>'petechiae','label'=>'Petechiae','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'hair_distribution',
                    'title' => 'Hair Distribution',
                    'normal_label' => 'Even distribution, appropriate for age and sex',
                    'options' => [
                        ['key'=>'alopecia','label'=>'Alopecia (hair loss)','needs_detail'=>true],
                        ['key'=>'hirsutism','label'=>'Hirsutism (excessive hair)','needs_detail'=>true],
                        ['key'=>'patchy','label'=>'Patchy distribution','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'hair_texture',
                    'title' => 'Hair Texture',
                    'normal_label' => 'Healthy, appropriate texture and sheen',
                    'options' => [
                        ['key'=>'brittle','label'=>'Brittle','needs_detail'=>true],
                        ['key'=>'dry','label'=>'Dry','needs_detail'=>true],
                        ['key'=>'oily','label'=>'Oily','needs_detail'=>true],
                        ['key'=>'dull','label'=>'Dull','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function fingerNails(): array
    {
        return [
            'key' => 'finger_nails',
            'title' => 'Finger & Nails Examination',
            'rows' => [
                [
                    'key' => 'appearance',
                    'title' => 'Appearance',
                    'normal_label' => 'Pink & smooth',
                    'options' => [
                        ['key'=>'pale','label'=>'Pale','needs_detail'=>true],
                        ['key'=>'cyanotic','label'=>'Cyanotic','needs_detail'=>true],
                        ['key'=>'clubbing','label'=>'Clubbing','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'capillary_refill',
                    'title' => 'Capillary Refill',
                    'normal_label' => 'Capillary refill time of <2 seconds',
                    'options' => [
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    // Add more sections as needed...
}
