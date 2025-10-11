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

    public static function head(): array
    {
        return [
            'key' => 'head',
            'title' => 'Head Examination',
            'rows' => [
                [
                    'key' => 'skull',
                    'title' => 'Head/Skull',
                    'normal_label' => 'Normal skull shape & contour',
                    'options' => [
                        ['key'=>'macrocephaly','label'=>'Macrocephaly','help'=>'Abnormally large head','needs_detail'=>true],
                        ['key'=>'microcephaly','label'=>'Microcephaly','help'=>'Abnormally small head','needs_detail'=>true],
                        ['key'=>'plagiocephaly','label'=>'Flattening (plagiocephaly), bulges, or depression','needs_detail'=>true],
                        ['key'=>'frontal_bossing','label'=>'Frontal Bossing','needs_detail'=>true],
                        ['key'=>'fontanelle','label'=>'Sunken or Bulging Fontanelle (infants)','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'scalp',
                    'title' => 'Scalp',
                    'normal_label' => 'No visible masses, swelling, lesions, scaliness/flakiness or pulsations; nontender',
                    'options' => [
                        ['key'=>'lumps','label'=>'Lumps or Swellings','needs_detail'=>true],
                        ['key'=>'lesions','label'=>'Lesions or ulcers','needs_detail'=>true],
                        ['key'=>'scaling','label'=>'Scalp Scaling or Flaking','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'pulsations','label'=>'Visible Pulsations','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'scalp_hair',
                    'title' => 'Hair',
                    'normal_label' => 'Even distribution across the scalp, appropriate color for the individual\'s ethnicity, no infestations, and a smooth, healthy texture',
                    'options' => [
                        ['key'=>'patchy_loss','label'=>'Patchy hair loss','needs_detail'=>true],
                        ['key'=>'diffuse_loss','label'=>'Diffuse hair loss','needs_detail'=>true],
                        ['key'=>'lice','label'=>'Lice or nits','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function neck(): array
    {
        return [
            'key' => 'neck',
            'title' => 'Neck Examination',
            'rows' => [
                [
                    'key' => 'neck_general',
                    'title' => 'NECK',
                    'normal_label' => 'No visible pulsations and masses',
                    'options' => [
                        ['key'=>'pulsations','label'=>'Visible pulsations','needs_detail'=>true],
                        ['key'=>'mass','label'=>'Mass','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'cervical_lymph',
                    'title' => 'Cervical lymph nodes',
                    'normal_label' => 'Non-palpable, nontender',
                    'options' => [
                        ['key'=>'enlarged','label'=>'Enlarged','needs_detail'=>true],
                        ['key'=>'tender','label'=>'Tender','needs_detail'=>true],
                        ['key'=>'round','label'=>'Round','needs_detail'=>true],
                        ['key'=>'irregular','label'=>'Irregular','needs_detail'=>true],
                        ['key'=>'fixed','label'=>'Fixed','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'trachea',
                    'title' => 'Trachea',
                    'normal_label' => 'Midline, with loud, high-pitched tubular tracheal sounds',
                    'options' => [
                        ['key'=>'deviated','label'=>'Deviated','needs_detail'=>true],
                        ['key'=>'stridor','label'=>'Stridor','needs_detail'=>true],
                        ['key'=>'wheezing','label'=>'Wheezing','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'thyroid',
                    'title' => 'Thyroid Gland',
                    'normal_label' => 'Soft, smooth, symmetrical, nontender, and moves slightly upward with swallowing',
                    'options' => [
                        ['key'=>'nodular_mass','label'=>'Visible nodular mass(es)','needs_detail'=>true],
                        ['key'=>'nodules_palpation','label'=>'Nodules upon palpation','needs_detail'=>true],
                        ['key'=>'thrills','label'=>'Thrills','needs_detail'=>true],
                        ['key'=>'bruit','label'=>'Bruit','needs_detail'=>true],
                        ['key'=>'tender','label'=>'Tender','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'breathing_effort',
                    'title' => 'Breathing effort',
                    'normal_label' => 'Effortless breathing',
                    'options' => [
                        ['key'=>'accessory_inspiration','label'=>'Use of accessory muscles during inspiration (SCM, scalene, supraclavicular retraction)','needs_detail'=>true],
                        ['key'=>'accessory_expiration','label'=>'Use of neck accessory muscles during expiration (intercostal or abdominal oblique muscles)','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function ear(): array
    {
        return [
            'key' => 'ear',
            'title' => 'Ear Examination',
            'rows' => [
                [
                    'key' => 'ear_external',
                    'title' => 'EAR',
                    'normal_label' => 'Symmetrical, no lesions, no discharge',
                    'options' => [
                        ['key'=>'asymmetry','label'=>'Asymmetry','needs_detail'=>true],
                        ['key'=>'eczema','label'=>'Eczema','needs_detail'=>true],
                        ['key'=>'lesions','label'=>'Other lesions','needs_detail'=>true],
                        ['key'=>'discharge','label'=>'Discharge','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'auricle_tragus',
                    'title' => 'Auricle, Tragus, Mastoid Process',
                    'normal_label' => 'Nontender auricle, tragus, and mastoid process',
                    'options' => [
                        ['key'=>'tender_auricle','label'=>'Tender auricle','needs_detail'=>true],
                        ['key'=>'tender_tragus','label'=>'Tender tragus','needs_detail'=>true],
                        ['key'=>'tender_mastoid','label'=>'Tender mastoid process','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'otoscopy_canal',
                    'title' => 'Otoscopy - Ear Canal',
                    'normal_label' => 'Clear and patent ear canal',
                    'options' => [
                        ['key'=>'cerumen','label'=>'Impacted cerumen','needs_detail'=>true],
                        ['key'=>'foreign_body','label'=>'Foreign body','needs_detail'=>true],
                        ['key'=>'discharge','label'=>'Discharge','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'otoscopy_membrane',
                    'title' => 'Otoscopy - Tympanic Membrane',
                    'normal_label' => 'Pearly gray, translucent, intact, neutral',
                    'options' => [
                        ['key'=>'erythematous','label'=>'Erythematous','needs_detail'=>true],
                        ['key'=>'fluid','label'=>'Yellowish or amber fluid-filled','needs_detail'=>true],
                        ['key'=>'retracted','label'=>'Retracted','needs_detail'=>true],
                        ['key'=>'bulging','label'=>'Bulging','needs_detail'=>true],
                        ['key'=>'perforated','label'=>'Perforated','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'cone_malleus',
                    'title' => 'Otoscopy - Cone of Light & Malleus',
                    'normal_label' => 'Visible cone of light and malleus',
                    'options' => [
                        ['key'=>'not_visualized','label'=>'Not visualized','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'hearing_general',
                    'title' => 'Hearing',
                    'normal_label' => 'Hears conversation well',
                    'options' => [
                        ['key'=>'difficulty','label'=>'Reports difficulty hearing','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'whisper_test',
                    'title' => 'Whisper Test',
                    'normal_label' => 'Correctly repeats the number-letter sequence',
                    'options' => [
                        ['key'=>'louder','label'=>'Can only repeat the sequence with at a louder volume','needs_detail'=>true],
                        ['key'=>'cannot','label'=>'Cannot repeat the sequence','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'tuning_fork',
                    'title' => 'Tuning Fork Tests',
                    'normal_label' => 'Air > Bone conduction & sound heard equally',
                    'options' => [
                        ['key'=>'air_equal_bone','label'=>'Air = Bone conduction','needs_detail'=>true],
                        ['key'=>'air_less_bone','label'=>'Air < Bone conduction','needs_detail'=>true],
                        ['key'=>'lateralization','label'=>'Lateralization','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function backPosture(): array
    {
        return [
            'key' => 'back_posture',
            'title' => 'Back & Posture Examination',
            'rows' => [
                [
                    'key' => 'spinal_alignment',
                    'title' => 'Spinal Alignment',
                    'normal_label' => 'Midline and nontender',
                    'options' => [
                        ['key'=>'lateral_deviation','label'=>'Lateral deviation','help'=>'Scoliosis','needs_detail'=>true],
                        ['key'=>'excessive_curvature','label'=>'Excessive curvature','help'=>'Kyphosis, lordosis','needs_detail'=>true],
                        ['key'=>'straightening','label'=>'Straightening','help'=>'Loss of normal curvature','needs_detail'=>true],
                        ['key'=>'tender','label'=>'Tender','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'skin_muscles',
                    'title' => 'Skin & Paraspinal muscles',
                    'normal_label' => 'Intact skin with symmetrical tone of muscles',
                    'options' => [
                        ['key'=>'scars','label'=>'Scars','needs_detail'=>true],
                        ['key'=>'asymmetrical','label'=>'Asymmetrical shoulders','needs_detail'=>true],
                        ['key'=>'lesions','label'=>'Lesions','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function thoraxLungs(): array
    {
        return [
            'key' => 'thorax_lungs',
            'title' => 'Posterior Thorax & Lungs Examination',
            'rows' => [
                [
                    'key' => 'breathing_pattern',
                    'title' => 'POSTERIOR THORAX & LUNGS',
                    'normal_label' => 'Quiet, unlabored and regular breathing',
                    'options' => [
                        ['key'=>'labored_breathing','label'=>'Labored breathing','needs_detail'=>true],
                        ['key'=>'delayed_expiration','label'=>'Delayed expiration','needs_detail'=>true],
                        ['key'=>'irregular_rhythm','label'=>'Irregular rhythm','needs_detail'=>true],
                        ['key'=>'intercostal_retraction','label'=>'Intercostal retraction (lower intercostal spaces)','needs_detail'=>true],
                        ['key'=>'accessory_muscles','label'=>'Use of accessory muscles during expiration (intercostal or abdominal oblique muscles)','needs_detail'=>true],
                        ['key'=>'unilateral_lag','label'=>'Unilateral lag or delay','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'inspection',
                    'title' => 'Inspection',
                    'normal_label' => 'Anteroposterior diameter < transverse diameter with normal contour',
                    'options' => [
                        ['key'=>'barrel_chest','label'=>'Barrel chest','needs_detail'=>true],
                        ['key'=>'pectus_excavatum','label'=>'Pectus excavatum','needs_detail'=>true],
                        ['key'=>'pectus_carinatum','label'=>'Pectus carinatum','needs_detail'=>true],
                        ['key'=>'sinus_tracts','label'=>'Sinus tracts','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'palpation_expansion',
                    'title' => 'Palpation',
                    'normal_label' => 'Nontender, Equal and adequate chest expansion (2-5 inches)',
                    'options' => [
                        ['key'=>'unilateral_decrease','label'=>'Unilateral decrease/delay in chest expansion','needs_detail'=>true],
                        ['key'=>'shallow_breathing','label'=>'Shallow breathing','needs_detail'=>true],
                        ['key'=>'tender','label'=>'Tender','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'palpation_fremitus',
                    'title' => '',
                    'normal_label' => 'Equal tactile fremitus',
                    'options' => [
                        ['key'=>'asymmetric_increased','label'=>'Asymmetric increased tactile fremitus','needs_detail'=>true],
                        ['key'=>'asymmetric_decreased','label'=>'Asymmetric decreased tactile fremitus','needs_detail'=>true],
                        ['key'=>'absent','label'=>'Absent tactile fremitus','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'palpation_tenderness',
                    'title' => '',
                    'normal_label' => 'Nontender',
                    'options' => [
                        ['key'=>'intercostal_tenderness','label'=>'Intercostal tenderness','needs_detail'=>true],
                        ['key'=>'crepitus','label'=>'Crepitus','needs_detail'=>true],
                        ['key'=>'bony_step_offs','label'=>'Bony step-offs','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'percussion',
                    'title' => 'Percussion',
                    'normal_label' => 'Resonant',
                    'options' => [
                        ['key'=>'dull','label'=>'Dull','needs_detail'=>true],
                        ['key'=>'hyperresonant','label'=>'Hyperresonant','needs_detail'=>true],
                        ['key'=>'tympanitic','label'=>'Tympanitic','needs_detail'=>true],
                        ['key'=>'flat','label'=>'Flat','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'auscultation',
                    'title' => 'Auscultation',
                    'normal_label' => 'Vesicular',
                    'options' => [
                        ['key'=>'bronchial_periphery','label'=>'Bronchial sounds heard in the periphery','needs_detail'=>true],
                        ['key'=>'decreased','label'=>'Decreased','needs_detail'=>true],
                        ['key'=>'absent','label'=>'Absent','needs_detail'=>true],
                        ['key'=>'crackles','label'=>'Crackles (fine/coarse)','needs_detail'=>true],
                        ['key'=>'wheeze','label'=>'Wheeze (inspiratory/expiratory)','needs_detail'=>true],
                        ['key'=>'ronchi','label'=>'Ronchi','needs_detail'=>true],
                        ['key'=>'pleural_friction_rub','label'=>'Pleural friction rub','needs_detail'=>true],
                        ['key'=>'stridor','label'=>'Stridor','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'voice_sounds',
                    'title' => 'Transmitted voice sounds',
                    'normal_label' => 'Absent',
                    'options' => [
                        ['key'=>'bronchophony','label'=>'Bronchophony (louder)','needs_detail'=>true],
                        ['key'=>'egophony','label'=>'Egophony (ee to A)','needs_detail'=>true],
                        ['key'=>'whispered_pectoriloquy','label'=>'Whispered pectoriloquy (louder)','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }


    // Add more sections as needed...
}
