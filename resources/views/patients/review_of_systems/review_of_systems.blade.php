@php
    // Get or create consultations for this patient
    $consultations = \App\Models\Consultation::ensureThreeConsultations($patient->id ?? 0);

    $sections = [
        'GENERAL' => [
            'icon' => 'general.png', // Add your icon filename here
            'weight loss', 'weight gain', 'insomnia', 'fatigue', 'anorexia', 'fever', 'night sweats'
        ],
        'SKIN' => [
            'icon' => 'skin.png', // Add your icon filename here
            'pruritus', 'vasomotor changes'
        ],
        'HEAD' => [
            'icon' => 'head.png', // Add your icon filename here
            'headache', 'dizziness', 'lightheadedness', 'pruritus'
        ],
        'EYES' => [
            'icon' => 'eye.png', // Add your icon filename here
            'blurring of vision', 'double vision', 'flashing lights', 'photosensitivity', 'spots/specks', 'pain', 'itching'
        ],
        'EARS' => [
            'icon' => 'ear.png', // Add your icon filename here
            'vertigo', 'tinnitus', 'hearing loss', 'Pain', 'pruritus'
        ],
        'NOSE' => [
            'icon' => 'nose.png', // Add your icon filename here
            'pruritus', 'nasal congestion', 'sinus pain', 'anosmia', 'obstruction'
        ],
        'MOUTH & THROAT' => [
            'icon' => 'mouth.png', // Add your icon filename here
            'changes in taste', 'ageusia', 'pain', 'dry mouth', 'loose teeth', 'Sores', 'difficulty swallowing', 'odynophagia'
        ],
        'BREAST' => [
            'icon' => 'breasts.png', // Add your icon filename here
            'engorgement', 'pain', 'nipple discharge'
        ],
        'RESPIRATORY' => [
            'icon' => 'lungs.png', // Add your icon filename here
            'dyspnea', 'wheezing', 'cough', 'sputum production', 'hemoptysis', 'pleuritic pain', 'back pain'
        ],
        'CARDIOVASCULAR' => [
            'icon' => 'cardio.png', // Add your icon filename here
            'shortness of breath', 'exertional dyspnea', 'paroxysmal nocturnal dyspnea', 'palpitations', 'syncope', 'orthopnea', 'nocturnal dyspnea', 'nape pain', 'chest pain or discomfort'
        ],
        'GASTROINTESTINAL' => [
            'icon' => 'gastrointes.png', // Add your icon filename here
            'nausea', 'vomiting', 'dysphagia', 'retching', 'hiccups', 'excessive burping', 'hematemesis', 'regurgitation', 'heartburn', 'distention', 'diarrhea', 'constipation', 'excessive flatulence', 'tenesmus', 'dyschezia', 'melena', 'hematochezia', 'abdominal pain (specify)'
        ],
        'PERIPHERAL-VASCULAR' => [
            'icon' => 'peripheral-vas.png', // Add your icon filename here
            'pain', 'cramps', 'swelling', 'claudication'
        ],
        'GENITO-URINARY' => [
            'icon' => 'gastro-uri.png', // Add your icon filename here
            'decreased urine flow', 'urinary urgency', 'urinary frequency', 'incontinence', 'dysuria', 'hematuria', 'nocturia', 'decreased libido', 'hypogastric pain', 'flank pain', 'pelvic pain', 'Inguinal pain', 'scrotal pain', 'dysmenorrhea', 'dyspareunia', 'pruritus'
        ],
        'MUSCULO-SKELETAL' => [
            'icon' => 'musco-skel.png', // Add your icon filename here
            'neck pain', 'back pain', 'muscle pain', 'joint pain', 'stiffness', 'trauma'
        ],
        'NEUROLOGIC' => [
            'icon' => 'neuro.png', // Add your icon filename here
            'paresthesia', 'sensory perversions', 'seizures', 'head trauma'
        ],
        'HEMATOLOGIC' => [
            'icon' => 'eye.png', // Add your icon filename here
            'pica', 'abnormal bleeding', 'easy bruising'
        ],
        'ENDOCRINE' => [
            'icon' => 'endocrine.png', // Add your icon filename here
            'voice changes', 'heat intolerance', 'cold intolerance', 'polydipsia', 'polyphagia', 'polyuria'
        ]
    ];
@endphp

<!-- Consultation Selection Panel -->
<div class="row mb-3">
   
</div>
