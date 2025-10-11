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
                    'normal_label' => 'Even tone',
                    'options' => [
                        ['key' => 'hyperpigmentation', 'label' => 'Hyperpigmentation', 'help' => 'Increased pigmentation, may indicate inflammation or other conditions', 'needs_detail' => true],
                        ['key' => 'hypopigmentation', 'label' => 'Hypopigmentation', 'help' => 'Decreased pigmentation, may indicate vitiligo or other conditions', 'needs_detail' => true],
                        ['key'=>'pallor','label'=>'Pallor','help'=>'Pale skin, may indicate anemia','needs_detail'=>true],
                        ['key'=>'jaundice','label'=>'Jaundice','help'=>'Yellowish skin, liver issues','needs_detail'=>true],
                        ['key' => 'cyanosis', 'label' => 'Cyanosis', 'help' => 'Bluish discoloration, poor oxygenation', 'needs_detail' => true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'clear_skin',
                    'title' => 'Clear Skin',
                    'normal_label' => 'Generally clear skin',
                    'options' => [
                        ['key' => 'erythema', 'label' => 'Erythema', 'help' => 'Redness, inflammation', 'needs_detail' => true],
                        ['key' => 'rash', 'label' => 'Rash', 'needs_detail' => true],
                        ['key' => 'other_lesions', 'label' => 'Other lesions', 'help' => 'Bluish discoloration, poor oxygenation', 'needs_detail' => true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'skin_texture',
                    'title' => 'Skin Texture & Moisture',
                    'normal_label' => 'Warm to touch, moisturized',
                    'options' => [
                        ['key'=> 'hot', 'label' => 'Hot', 'needs_detail' => true],
                        ['key'=> 'asymmetrical_temperature','label'=>'Asymmetrical temperature','needs_detail'=>true],
                        ['key'=> 'diaphoresis', 'label' => 'Diaphoresis', 'needs_detail' => true],
                        ['key'=> 'sweaty_clammy', 'label' => 'Sweaty/Clammy', 'needs_detail' => true],
                        ['key'=> 'dry', 'label' => 'Dry', 'needs_detail' => true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'hair_distribution',
                    'title' => 'Hair Distribution',
                    'normal_label' => 'Normal hair distribution & texture',
                    'options' => [
                        ['key'=>'alopecia','label'=>'Alopecia (hair loss)','needs_detail'=>true],
                        ['key'=>'hirsutism','label'=>'Hirsutism (excessive hair)','needs_detail'=>true],
                        ['key'=>'dandruff','label'=>'Dandruff','needs_detail'=>true],
                        ['key'=>'infestations','label'=>'Infestations','needs_detail'=>true],
                        ['key'=> 'brittle', 'label' => 'Brittle', 'help' => 'Thyroid Problem', 'needs_detail' => true],
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
                        ['key'=>'clubbing','label'=>'Clubbing','help' => 'Bronchiectasis, congenital heart disease, pulmonary fibrosis, cystic fibrosis, lung abscess, and malignancy', 'needs_detail'=>true],
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

    public static function cardiacExam(): array
    {
        return [
            'key' => 'cardiac_exam',
            'title' => 'Cardiac Examination',
            'rows' => [
                [
                    'key' => 'inspection',
                    'title' => 'Inspection',
                    'normal_label' => 'JVP <3cm above sternal angle; adynamic precordium',
                    'options' => [
                        ['key'=>'visible_heaves','label'=>'Visible heaves','needs_detail'=>true],
                        ['key'=>'precordial_bulge','label'=>'Precordial bulge','needs_detail'=>true],
                        ['key'=>'increased_jvp','label'=>'Increased JVP','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'palpation',
                    'title' => 'Palpation',
                    'normal_label' => 'Nontender, PMI is at the 5th ICS MCL nondisplaced nonsustained with light tapping sensation <2.5cm; no heaves nor thrills',
                    'options' => [
                        ['key'=>'heaves','label'=>'Heaves','needs_detail'=>true],
                        ['key'=>'thrills','label'=>'Thrills','needs_detail'=>true],
                        ['key'=>'pmi_displaced','label'=>'PMI displaced laterally','needs_detail'=>true],
                        ['key'=>'sustained_forceful_pmi','label'=>'Sustained or forceful PMI','needs_detail'=>true],
                        ['key'=>'undetected_apical','label'=>'Undetected apical impulse','needs_detail'=>true],
                        ['key'=>'diffuse_pmi','label'=>'Diffuse PMI (>3cm)','needs_detail'=>true],
                        ['key'=>'sustained_parasternal','label'=>'Sustained left parasternal movement beginning at S1','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'auscultation',
                    'title' => 'Auscultation',
                    'normal_label' => 'Clear and distinct S1 and S2 with physiologic splitting of S2 at right 2nd ICS parasternal area; regular rate and rhythm',
                    'options' => [
                        ['key'=>'murmurs','label'=>'Murmurs (systolic/diastolic, location, grade, pitch, quality)','needs_detail'=>true],
                        ['key'=>'pericardial_rub','label'=>'Pericardial rub','needs_detail'=>true],
                        ['key'=>'irregular_rhythm','label'=>'Irregular rhythm','needs_detail'=>true],
                        ['key'=>'presence_s3','label'=>'Presence of S3','needs_detail'=>true],
                        ['key'=>'presence_s4','label'=>'Presence of S4','needs_detail'=>true],
                        ['key'=>'diminished_s1','label'=>'Diminished S1 sounds','needs_detail'=>true],
                        ['key'=>'diminished_s2','label'=>'Diminished S2 sounds','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function abdomen(): array
    {
        return [
            'key' => 'abdomen',
            'title' => 'Abdomen Examination',
            'rows' => [
                [
                    'key' => 'general',
                    'title' => 'ABDOMEN',
                    'normal_label' => 'Relaxed, non-distended, symmetrical contour',
                    'options' => [
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'inspection',
                    'title' => 'Inspection',
                    'normal_label' => 'Flat/slightly flabby, symmetric, even skin tone, no visible peristalsis with midline nonherniated umbilicus',
                    'options' => [
                        ['key'=>'distended','label'=>'Distended/rounded/protuberant','needs_detail'=>true],
                        ['key'=>'scaphoid','label'=>'Scaphoid abdomen','needs_detail'=>true],
                        ['key'=>'asymmetry','label'=>'Asymmetry','needs_detail'=>true],
                        ['key'=>'visible_peristalsis','label'=>'Visible peristalsis','needs_detail'=>true],
                        ['key'=>'lesions','label'=>'Lesions (scars, striae, dilated veins, ecchymosis)','needs_detail'=>true],
                        ['key'=>'hernia','label'=>'Hernia/ed umbilicus','needs_detail'=>true],
                        ['key'=>'bulging_flanks','label'=>'Bulging flanks','needs_detail'=>true],
                        ['key'=>'suprapubic_bulge','label'=>'Suprapubic bulge','needs_detail'=>true],
                        ['key'=>'local_bulge','label'=>'Local bulge','needs_detail'=>true],
                        ['key'=>'pulsations','label'=>'Pulsations','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'auscultation',
                    'title' => 'Auscultation',
                    'normal_label' => '5-34 bowel sounds per minute and no bruits',
                    'options' => [
                        ['key'=>'hyperactive','label'=>'Hyperactive sounds','needs_detail'=>true],
                        ['key'=>'hypoactive_absent','label'=>'Hypoactive/Absent sounds','needs_detail'=>true],
                        ['key'=>'bruits','label'=>'Bruits (location)','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'percussion',
                    'title' => 'Percussion',
                    'normal_label' => 'Alternating tympany and dullness',
                    'options' => [
                        ['key'=>'diffuse_tympany','label'=>'Diffuse Tympany','needs_detail'=>true],
                        ['key'=>'large_dull_areas','label'=>'Large dull areas','needs_detail'=>true],
                        ['key'=>'costovertebral_tenderness','label'=>'Costovertebral tenderness with fist percussion (Kidney punch sign)','needs_detail'=>true],
                        ['key'=>'shifting_dullness','label'=>'Shifting dullness','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'palpation',
                    'title' => 'Palpation',
                    'normal_label' => 'Nontender, no to minimal pulsations, negative abdominal maneuvers, intact reflexes',
                    'options' => [
                        ['key'=>'guarding','label'=>'Guarding','needs_detail'=>true],
                        ['key'=>'mass','label'=>'Mass','needs_detail'=>true],
                        ['key'=>'tender','label'=>'Tender','needs_detail'=>true],
                        ['key'=>'pulsations','label'=>'Pulsations','needs_detail'=>true],
                        ['key'=>'rigidity','label'=>'Rigidity','needs_detail'=>true],
                        ['key'=>'rlq_direct','label'=>'RLQ Direct tenderness/Mcburney point tenderness','needs_detail'=>true],
                        ['key'=>'rebound_tenderness','label'=>'Rebound tenderness','needs_detail'=>true],
                        ['key'=>'indirect_rovsing','label'=>'Indirect tenderness (Rovsing sign)','needs_detail'=>true],
                        ['key'=>'psoas_sign','label'=>'(+) psoas sign','needs_detail'=>true],
                        ['key'=>'obturator_sign','label'=>'(+) obturator sign','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'organs',
                    'title' => '',
                    'normal_label' => 'Normal liver and spleen size',
                    'options' => [
                        ['key'=>'liver_enlargement','label'=>'Liver enlargement (below the ribs)','needs_detail'=>true],
                        ['key'=>'spleen_enlargement','label'=>'Spleen enlargement (percussion dullness on deep inspiration)','needs_detail'=>true],
                        ['key'=>'bladder_distention','label'=>'Urinary bladder distention / tenderness','needs_detail'=>true],
                        ['key'=>'murphy_sign','label'=>'(+) murphy sign','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function breastAxillae(): array
    {
        return [
            'key' => 'breast_axillae',
            'title' => 'Breast & Axillae Examination',
            'rows' => [
                [
                    'key' => 'inspection',
                    'title' => 'Inspection',
                    'normal_label' => 'Symmetrical size and shape, smooth contour, even skin color, everted nipples with evenly pigmented areolae',
                    'options' => [
                        ['key'=>'distinct_asymmetry','label'=>'Distinct asymmetry','needs_detail'=>true],
                        ['key'=>'dimpling','label'=>'Dimpling','needs_detail'=>true],
                        ['key'=>'retraction','label'=>'Retraction','needs_detail'=>true],
                        ['key'=>'spontaneous_discharge','label'=>'Spontaneous discharge','needs_detail'=>true],
                        ['key'=>'peau_dorange','label'=>'Peau d\'orange','needs_detail'=>true],
                        ['key'=>'gynecomastia','label'=>'Pseudogynecomastia/gynecomastia','needs_detail'=>true],
                        ['key'=>'inverted_nipples','label'=>'Inverted nipples','needs_detail'=>true],
                        ['key'=>'scaly_nipples','label'=>'Scaly nipples','needs_detail'=>true],
                        ['key'=>'flattening','label'=>'Flattening','needs_detail'=>true],
                        ['key'=>'erythema','label'=>'Erythema','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'palpation',
                    'title' => 'Palpation',
                    'normal_label' => 'Firm and uniform consistency, and no palpable lumps or masses; thin elastic nipple',
                    'options' => [
                        ['key'=>'mass','label'=>'Mass','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'thickened_nipple','label'=>'Thickened nonelastic nipple','needs_detail'=>true],
                        ['key'=>'nipple_discharge','label'=>'Nipple discharge upon compression','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'inspection_skin',
                    'title' => 'Inspection (Skin)',
                    'normal_label' => 'Smooth even skin color with no swelling, lumps or rashes',
                    'options' => [
                        ['key'=>'unusual_pigmentation','label'=>'Unusual pigmentation','needs_detail'=>true],
                        ['key'=>'lesions','label'=>'Lesions','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function maleGenitalia(): array
    {
        return [
            'key' => 'male_genitalia',
            'title' => 'Male Genitalia Examination',
            'rows' => [
                [
                    'key' => 'penis',
                    'title' => 'Penis',
                    'normal_label' => 'Circumcised/uncircumcised with no lesions/discharge, urethral meatus patent',
                    'options' => [
                        ['key'=>'balanitis','label'=>'Balanitis','needs_detail'=>true],
                        ['key'=>'phimosis','label'=>'Phimosis','needs_detail'=>true],
                        ['key'=>'paraphimosis','label'=>'Paraphimosis','needs_detail'=>true],
                        ['key'=>'penile_discharge','label'=>'Penile discharge','needs_detail'=>true],
                        ['key'=>'lesions','label'=>'Lesions','needs_detail'=>true],
                        ['key'=>'hypospadias','label'=>'Hypospadias','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'scrotum',
                    'title' => 'Scrotum',
                    'normal_label' => 'No swelling and lesions',
                    'options' => [
                        ['key'=>'swelling','label'=>'Swelling','needs_detail'=>true],
                        ['key'=>'lesions','label'=>'Lesions','needs_detail'=>true],
                        ['key'=>'asymmetry','label'=>'Asymmetry','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'testicles',
                    'title' => 'Testicles',
                    'normal_label' => 'Palpable, no masses, nontender',
                    'options' => [
                        ['key'=>'absent_undescended','label'=>'Absent/undescended','needs_detail'=>true],
                        ['key'=>'masses_nodules','label'=>'Masses/nodules','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'swelling','label'=>'Swelling','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'epididymis',
                    'title' => 'Epididymis',
                    'normal_label' => 'No swelling, nontender',
                    'options' => [
                        ['key'=>'swelling','label'=>'Swelling','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'induration','label'=>'Induration','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'spermatic_cord',
                    'title' => 'Spermatic Cord',
                    'normal_label' => 'No swelling, nontender',
                    'options' => [
                        ['key'=>'swelling','label'=>'Swelling','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'masses','label'=>'Masses','needs_detail'=>true],
                        ['key'=>'varicocele','label'=>'Varicocele','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'hernia_exam',
                    'title' => 'Hernia Examination',
                    'normal_label' => 'No bulges with Valsalva or cough',
                    'options' => [
                        ['key'=>'inguinal_hernia','label'=>'Inguinal hernia','needs_detail'=>true],
                        ['key'=>'femoral_hernia','label'=>'Femoral hernia','needs_detail'=>true],
                        ['key'=>'incisional_hernia','label'=>'Incisional hernia','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'rectal_exam',
                    'title' => 'Rectal Exam',
                    'normal_label' => 'Good sphincter tone, smooth rectal walls, no masses',
                    'options' => [
                        ['key'=>'poor_tone','label'=>'Poor tone','needs_detail'=>true],
                        ['key'=>'masses','label'=>'Masses','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'blood','label'=>'Blood','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'prostate',
                    'title' => 'Prostate (if applicable)',
                    'normal_label' => 'Smooth, non-tender, normal size',
                    'options' => [
                        ['key'=>'enlarged','label'=>'Enlarged','needs_detail'=>true],
                        ['key'=>'nodular','label'=>'Nodular','needs_detail'=>true],
                        ['key'=>'tender','label'=>'Tender','needs_detail'=>true],
                        ['key'=>'firm_hard','label'=>'Firm/hard','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

    public static function femaleGenitalia(): array
    {
        return [
            'key' => 'female_genitalia',
            'title' => 'Female Genitalia Examination',
            'rows' => [
                [
                    'key' => 'external_inspection',
                    'title' => 'External Inspection',
                    'normal_label' => 'Smooth and intact mons pubis, labia and perineum with no lesions, and sexual maturity appropriate to age',
                    'options' => [
                        ['key'=>'vulvar_ulcers','label'=>'Vulvar ulcers','needs_detail'=>true],
                        ['key'=>'warts','label'=>'Warts','needs_detail'=>true],
                        ['key'=>'unusual_discharge','label'=>'Unusual discharge','needs_detail'=>true],
                        ['key'=>'erythema','label'=>'Erythema','needs_detail'=>true],
                        ['key'=>'other_lesions_maturity','label'=>'Other lesions or maturity problems','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'speculum_exam',
                    'title' => 'Speculum Exam',
                    'normal_label' => 'Cervix pink, smooth, no discharge; intact vaginal mucosa',
                    'options' => [
                        ['key'=>'cervical_motion_tenderness','label'=>'Cervical motion tenderness','needs_detail'=>true],
                        ['key'=>'erythema','label'=>'Erythema','needs_detail'=>true],
                        ['key'=>'purulent_discharge','label'=>'Purulent discharge','needs_detail'=>true],
                        ['key'=>'visible_lesions','label'=>'Visible lesions','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'bimanual_exam',
                    'title' => 'Bimanual Exam',
                    'normal_label' => 'Uterus midline, mobile, non-tender; no adnexal masses',
                    'options' => [
                        ['key'=>'uterine_enlargement','label'=>'Uterine enlargement','needs_detail'=>true],
                        ['key'=>'fixed_uterus','label'=>'Fixed uterus','needs_detail'=>true],
                        ['key'=>'adnexal_tenderness','label'=>'Adnexal tenderness','needs_detail'=>true],
                        ['key'=>'adnexal_mass','label'=>'Adnexal mass','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
                [
                    'key' => 'rectovaginal_exam',
                    'title' => 'Rectovaginal Exam',
                    'normal_label' => 'Septum smooth and intact; no masses',
                    'options' => [
                        ['key'=>'nodularity','label'=>'Nodularity','needs_detail'=>true],
                        ['key'=>'tenderness','label'=>'Tenderness','needs_detail'=>true],
                        ['key'=>'rectal_wall_irregularities','label'=>'Rectal wall irregularities','needs_detail'=>true],
                        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                    ],
                ],
            ],
        ];
    }

}
