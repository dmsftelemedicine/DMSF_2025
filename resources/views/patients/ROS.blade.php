@php
    $sections = [
        'GENERAL' => [
            'weight loss', 'weight gain', 'insomnia', 'fatigue', 'anorexia', 'fever', 'night sweats'
        ],
        'SKIN' => [
            'pruritus', 'vasomotor changes'
        ],
        'HEAD' => [
            'headache', 'dizziness', 'lightheadedness', 'pruritus'
        ],
        'EYES' => [
            'blurring of vision', 'double vision', 'flashing lights', 'photosensitivity', 'spots/specks', 'pain', 'itching'
        ],
        'EARS' => [
            'vertigo', 'tinnitus', 'hearing loss', 'Pain', 'pruritus'
        ],
        'NOSE' => [
            'pruritus', 'nasal congestion', 'sinus pain', 'anosmia', 'obstruction'
        ],
        'MOUTH & THROAT' => [
            'changes in taste', 'ageusia', 'pain', 'dry mouth', 'loose teeth', 'Sores', 'difficulty swallowing', 'odynophagia'
        ],
        'BREAST' => [
            'engorgement', 'pain', 'nipple discharge'
        ],
        'RESPIRATORY' => [
            'dyspnea', 'wheezing', 'cough', 'sputum production', 'hemoptysis', 'pleuritic pain', 'back pain'
        ],
        'CARDIOVASCULAR' => [
            'shortness of breath', 'exertional dyspnea', 'paroxysmal nocturnal dyspnea', 'palpitations', 'syncope', 'orthopnea', 'nocturnal dyspnea', 'nape pain', 'chest pain or discomfort'
        ],
        'GASTROINTESTINAL' => [
            'nausea', 'vomiting', 'dysphagia', 'retching', 'hiccups', 'excessive burping', 'hematemesis', 'regurgitation', 'heartburn', 'distention', 'diarrhea', 'constipation', 'excessive flatulence', 'tenesmus', 'dyschezia', 'melena', 'hematochezia', 'abdominal pain (specify)'
        ],
        'PERIPHERAL-VASCULAR' => [
            'pain', 'cramps', 'swelling', 'claudication'
        ],
        'GENITO-URINARY' => [
            'decreased urine flow', 'urinary urgency', 'urinary frequency', 'incontinence', 'dysuria', 'hematuria', 'nocturia', 'decreased libido', 'hypogastric pain', 'flank pain', 'pelvic pain', 'Inguinal pain', 'scrotal pain', 'dysmenorrhea', 'dyspareunia', 'pruritus'
        ],
        'MUSCULO-SKELETAL' => [
            'neck pain', 'back pain', 'muscle pain', 'joint pain', 'stiffness', 'trauma'
        ],
        'NEUROLOGIC' => [
            'paresthesia', 'sensory perversions', 'seizures', 'head trauma'
        ],
        'HEMATOLOGIC' => [
            'pica', 'abnormal bleeding', 'easy bruising'
        ],
        'ENDOCRINE' => [
            'voice changes', 'heat intolerance', 'cold intolerance', 'polydipsia', 'polyphagia', 'polyuria'
        ]
    ];

    // Get existing symptoms from the database
    $existingSymptoms = $reviewOfSystems ? $reviewOfSystems->symptoms : [];
@endphp

<div class="container-fluid">
    <form id="reviewOfSystemsForm">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        <div class="row">
            @foreach($sections as $section => $symptoms)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-light py-2">
                            <h6 class="mb-0">{{ $section }}</h6>
                        </div>
                        <div class="card-body py-2 d-flex align-items-start">
                            <div class="flex-grow-1 pe-2 overflow-auto card-content" style="max-height: 300px;">
                                @foreach($symptoms as $symptom)
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
                            @if(isset($sectionImages[$section]))
                                <div class="flex-shrink-0 ms-2">
                                    <img src="{{ asset($sectionImages[$section]) }}" alt="{{ $section }}" class="img-fluid rounded shadow-sm" style="max-width: 80px;">
                                </div>
                            @endif
                        </div>
                        <div class="card-body py-2">
                            @foreach($symptoms as $symptom)
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
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">Save Review of Systems</button>
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
