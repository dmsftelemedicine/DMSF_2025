@php
    $sections = [
        'GENERAL' => [
            'icon' => 'general.png', // Add your icon filename here
            'symptoms' => ['weight loss', 'weight gain', 'insomnia', 'fatigue', 'anorexia', 'fever', 'night sweats']
        ],
        'SKIN' => [
            'icon' => 'skin.png', // Add your icon filename here
            'symptoms' => ['pruritus', 'vasomotor changes']
        ],
        'HEAD' => [
            'icon' => 'head.png', // Add your icon filename here
            'symptoms' => ['headache', 'dizziness', 'lightheadedness', 'pruritus']
        ],
        'EYES' => [
            'icon' => 'eye.png', // Add your icon filename here
            'symptoms' => ['blurring of vision', 'double vision', 'flashing lights', 'photosensitivity', 'spots/specks', 'pain', 'itching']
        ],
        'EARS' => [
            'icon' => 'ear.png', // Add your icon filename here
            'symptoms' => ['vertigo', 'tinnitus', 'hearing loss', 'Pain', 'pruritus']
        ],
        'NOSE' => [
            'icon' => 'nose.png', // Add your icon filename here
            'symptoms' => ['pruritus', 'nasal congestion', 'sinus pain', 'anosmia', 'obstruction']
        ],
        'MOUTH & THROAT' => [
            'icon' => 'mouth.png', // Add your icon filename here
            'symptoms' => ['changes in taste', 'ageusia', 'pain', 'dry mouth', 'loose teeth', 'Sores', 'difficulty swallowing', 'odynophagia']
        ],
        'BREAST' => [
            'icon' => 'breasts.png', // Add your icon filename here
            'symptoms' => ['engorgement', 'pain', 'nipple discharge']
        ],
        'RESPIRATORY' => [
            'icon' => 'lungs.png', // Add your icon filename here
            'symptoms' => ['dyspnea', 'wheezing', 'cough', 'sputum production', 'hemoptysis', 'pleuritic pain', 'back pain']
        ],
        'CARDIOVASCULAR' => [
            'icon' => 'cardio.png', // Add your icon filename here
            'symptoms' => ['shortness of breath', 'exertional dyspnea', 'paroxysmal nocturnal dyspnea', 'palpitations', 'syncope', 'orthopnea', 'nocturnal dyspnea', 'nape pain', 'chest pain or discomfort']
        ],
        'GASTROINTESTINAL' => [
            'icon' => 'gastrointestinal.png', // Add your icon filename here
            'symptoms' => ['nausea', 'vomiting', 'dysphagia', 'retching', 'hiccups', 'excessive burping', 'hematemesis', 'regurgitation', 'heartburn', 'distention', 'diarrhea', 'constipation', 'excessive flatulence', 'tenesmus', 'dyschezia', 'melena', 'hematochezia', 'abdominal pain (specify)']
        ],
        'PERIPHERAL-VASCULAR' => [
            'icon' => 'pain.png', // Add your icon filename here
            'symptoms' => ['pain', 'cramps', 'swelling', 'claudication']
        ],
        'GENITO-URINARY' => [
            'icon' => 'genito_urinary.png', // Add your icon filename here
            'symptoms' => ['decreased urine flow', 'urinary urgency', 'urinary frequency', 'incontinence', 'dysuria', 'hematuria', 'nocturia', 'decreased libido', 'hypogastric pain', 'flank pain', 'pelvic pain', 'Inguinal pain', 'scrotal pain', 'dysmenorrhea', 'dyspareunia', 'pruritus']
        ],
        'MUSCULO-SKELETAL' => [
            'icon' => 'skeleton.png', // Add your icon filename here
            'symptoms' => ['neck pain', 'back pain', 'muscle pain', 'joint pain', 'stiffness', 'trauma']
        ],
        'NEUROLOGIC' => [
            'icon' => 'neurology.png', // Add your icon filename here
            'symptoms' => ['paresthesia', 'sensory perversions', 'seizures', 'head trauma']
        ],
        'HEMATOLOGIC' => [
            'icon' => 'hematology.png', // Add your icon filename here
            'symptoms' => ['pica', 'abnormal bleeding', 'easy bruising']
        ],
        'ENDOCRINE' => [
            'icon' => 'endocrine.png', // Add your icon filename here
            'symptoms' => ['voice changes', 'heat intolerance', 'cold intolerance', 'polydipsia', 'polyphagia', 'polyuria']
        ]
    ];

    // Get existing symptoms from the database
    $existingSymptoms = $reviewOfSystems ? $reviewOfSystems->symptoms : [];
@endphp

<style>
    .container-fluid {
        background-color: rgb(26 93 119/40%);
        padding: 20px;
        border-radius: 10px;
    }
</style>

<div class="container-fluid">
    <form id="reviewOfSystemsForm">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

        <div class="row">
            @foreach($sections as $section => $data)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-light py-2">
                            <h6 class="mb-0">{{ $section }}</h6>
                        </div>
                        <div class="card-content d-flex">
                            <div class="card-body py-2 flex-grow-1">
                                @foreach($data['symptoms'] as $symptom)
                                    @php
                                        $sectionKey = strtolower(str_replace(' ', '_', $section));
                                        $isChecked = isset($existingSymptoms[$sectionKey]) && in_array($symptom, $existingSymptoms[$sectionKey]);
                                    @endphp
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox"
                                               name="symptoms[{{ $sectionKey }}][]"
                                               value="{{ $symptom }}"
                                               id="{{ strtolower(str_replace(' ', '_', $symptom)) }}"
                                               {{ $isChecked ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="{{ strtolower(str_replace(' ', '_', $symptom)) }}">
                                            {{ ucfirst($symptom) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Icon positioned on the right side of the card -->
                            <div class="d-flex align-items-center justify-content-end pe-2">
                                <img src="{{ asset('icons/' . $data['icon']) }}"
                                     alt="{{ $section }}"
                                     class="section-icon">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">Save Review of Systems</button>
        </div>
    </form>
</div>

<style>
.card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}

.card:hover {
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}

.form-check-label {
    font-size: 0.875rem;
    line-height: 1.2;
}

.card-body {
    max-height: 300px;
    overflow-y: auto;
}

/* Icon styles */
.section-icon {
    object-fit: none;
    opacity: 0.5;
}
.section-icon:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

</style>

<script>
$(document).ready(function() {
    // Handle form submission
    $('#reviewOfSystemsForm').on('submit', function(e) {
        e.preventDefault();

        // Get all form data
        let formData = $(this).serialize();

        // If no checkboxes are checked, send empty object
        if (!formData.includes('symptoms')) {
            formData = 'symptoms[]=';
        }

        $.ajax({
            url: `/patients/{{ $patient->id }}/review-of-systems`,
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Review of Systems saved successfully!');
            },
            error: function(xhr) {
                alert('Error saving Review of Systems: ' + xhr.responseText);
            }
        });
    });
});
</script>
