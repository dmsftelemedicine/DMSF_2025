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
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Consultation Management - Review of Systems
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                            <strong>Consultation-Based Review of Systems:</strong> Each consultation maintains its own independent symptom records.
                            <br><small class="text-muted">Select a consultation to view and edit its ROS data. Dates can be manually updated.</small>
                            <div class="container-fluid">
                                <!-- Consultation Tabs -->
                                <ul class="nav nav-tabs" id="rosConsultationTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="ros-1st-tab" data-bs-toggle="tab" data-bs-target="#ros-1st" type="button" role="tab" aria-controls="ros-1st" aria-selected="true">
                                            <i class="fas fa-calendar-day"></i> 1st Consultation
                                            <span class="badge bg-secondary ms-1" id="ros-1st-date">Loading...</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ros-2nd-tab" data-bs-toggle="tab" data-bs-target="#ros-2nd" type="button" role="tab" aria-controls="ros-2nd" aria-selected="false">
                                            <i class="fas fa-calendar-week"></i> 2nd Consultation
                                            <span class="badge bg-secondary ms-1" id="ros-2nd-date">Loading...</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ros-3rd-tab" data-bs-toggle="tab" data-bs-target="#ros-3rd" type="button" role="tab" aria-controls="ros-3rd" aria-selected="false">
                                            <i class="fas fa-calendar-days"></i> 3rd Consultation
                                            <span class="badge bg-secondary ms-1" id="ros-3rd-date">Loading...</span>
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="rosConsultationTabsContent">
                                    @foreach(['ROS_1st', 'ROS_2nd', 'ROS_3rd'] as $index => $consultationType)
                                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="{{ strtolower(str_replace('_', '-', $consultationType)) }}" role="tabpanel" aria-labelledby="{{ strtolower(str_replace('_', '-', $consultationType)) }}-tab">
                                        <div class="mt-3">
                                            <form class="reviewOfSystemsForm" data-consultation-type="{{ $consultationType }}">
                                                @csrf
                                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                <input type="hidden" name="consultation_type" value="{{ $consultationType }}">
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <div class="alert alert-info mb-3">
                                                        <i class="fas fa-info-circle"></i>
                                                            <strong>Review of Systems (ROS) Consultations:</strong> This form tracks symptoms across three consultations:
                                                            Initial, One Week Follow-up , and One Month Follow-up.
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Consultation</th>
                                                                <th>Date</th>
                                                                <th>ROS Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($consultations as $index => $consultation)
                                                                @if($consultation)
                                                                    <tr class="ros-consultation-row" data-ros-consultation-id="{{ $consultation->id }}">
                                                                        <td>
                                                                            <strong>{{ $consultation->consultation_number }}{{ $consultation->consultation_number == 1 ? 'st' : ($consultation->consultation_number == 2 ? 'nd' : 'rd') }} Consultation</strong>
                                                                        </td>
                                                                        <td>
                                                                            <input type="date" 
                                                                                   class="form-control form-control-sm ros-consultation-date-input" 
                                                                                   value="{{ $consultation->consultation_date->format('Y-m-d') }}" 
                                                                                   data-ros-consultation-id="{{ $consultation->id }}"
                                                                                   style="width: 160px;">
                                                                        </td>
                                                                        <td>
                                                                            <span class="ros-status-badge badge bg-secondary" id="ros-status-{{ $consultation->id }}">
                                                                                <i class="fas fa-spinner fa-spin"></i> Checking...
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" 
                                                                                    class="btn btn-sm btn-primary ros-select-consultation-btn" 
                                                                                    data-ros-consultation-id="{{ $consultation->id }}"
                                                                                    data-ros-consultation-number="{{ $consultation->consultation_number }}">
                                                                                <i class="fas fa-edit me-1"></i>Select & Edit
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            
                                                <div class="row">
                                                    @foreach($sections as $section => $data)
                                                        @php
                                                            $icon = $data['icon'];
                                                            $symptoms = array_slice($data, 1);
                                                        @endphp
                                                        <div class="col-md-4 mb-3">
                                                            <div class="card h-100">
                                                                <div class="card-header bg-light py-2">
                                                                    <h6 class="mb-0">{{ $section }}</h6>
                                                                </div>
                                                                <!-- <div class="card-body py-2">
                                                                    @foreach($symptoms as $symptom)
                                                                        @php
                                                                            $sectionKey = strtolower(str_replace(' ', '_', $section));
                                                                            $inputId = $consultationType . '_' . strtolower(str_replace([' ', '&', '(', ')', '-'], '_', $symptom));
                                                                        @endphp
                                                                        <div class="form-check mb-1">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                   name="symptoms[{{ $sectionKey }}][]"
                                                                                   value="{{ $symptom }}"
                                                                                   id="{{ $inputId }}">
                                                                            <label class="form-check-label small" for="{{ $inputId }}">
                                                                                {{ ucfirst($symptom) }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div> -->
                                                                <div class="card-body py-2 position-relative" style="z-index: 1;">
                                                                    <!-- Icon in the bottom right corner -->
                                                                    <img src="{{ asset('assets/icons/' . $icon) }}" alt="{{ $section }} icon"
                                                                        class="position-absolute end-0 bottom-0 me-2 mb-2"
                                                                        style="width: 100px; opacity: 0.2; pointer-events: none; z-index: 0;">

                                                                    <div style="position: relative; z-index: 1;">
                                                                        @foreach($symptoms as $symptom)
                                                                            @php
                                                                                $sectionKey = strtolower(str_replace(' ', '_', $section));
                                                                                $inputId = $consultationType . '_' . strtolower(str_replace([' ', '&', '(', ')', '-'], '_', $symptom));
                                                                            @endphp
                                                                            <div class="form-check mb-1">
                                                                                <input class="form-check-input" type="checkbox"
                                                                                    name="symptoms[{{ $sectionKey }}][]"
                                                                                    value="{{ $symptom }}"
                                                                                    id="{{ $inputId }}">
                                                                                <label class="form-check-label small" for="{{ $inputId }}">
                                                                                    {{ ucfirst($symptom) }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ROS Form Panel -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">Review of Systems</h6>
                                            <div class="d-flex align-items-center">
                                                <div id="ros-active-consultation-info" class="alert alert-success py-1 px-3 mb-0 ms-3 d-flex align-items-center" style="display: none; font-size: 1rem;">
                                                    <i class="fas fa-check-circle me-2"></i>
                                                    <strong>Active:</strong> <span id="ros-active-consultation-text">No consultation selected</span>
                                                </div>
                                                <div id="ros-saving-status-badge" class="alert alert-info py-1 px-3 mb-0 d-inline-flex align-items-center ms-4" style="display:none; font-size: 1rem; min-width: 140px;">
                                                    <i class="fas fa-save me-2"></i>
                                                    <span id="ros-saving-status-text">Saved</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" id="clearAllSymptoms">
                                                        <label class="form-check-label fw-bold" for="clearAllSymptoms">
                                                            Clear All Symptoms
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">This will uncheck all symptom checkboxes</small>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <!-- Save button and info removed: saving is now automatic -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ROS Form Content -->
                            <div id="ros-form-container" style="display: none;">
                                <form id="reviewOfSystemsForm">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                    <input type="hidden" name="consultation_type" id="selected_consultation_type" value="">

                                    <div class="row">
                                        @foreach($sections as $section => $symptoms)
                                            <div class="col-md-4 mb-3">
                                                <div class="card h-100">
                                                    <div class="card-header bg-light py-2">
                                                        <h6 class="mb-0">{{ $section }}</h6>
                                                    </div>
                                                    <div class="card-body py-2">
                                                        @foreach($symptoms as $symptom)
                                                            @php
                                                                $sectionKey = strtolower(str_replace(' ', '_', $section));
                                                                $inputId = 'ros_' . strtolower(str_replace([' ', '&', '(', ')', '-'], '_', $symptom));
                                                            @endphp
                                                            <div class="form-check mb-1">
                                                                <input class="form-check-input ros-symptom-checkbox" type="checkbox" 
                                                                       name="symptoms[{{ $sectionKey }}][]" 
                                                                       value="{{ $symptom }}" 
                                                                       id="{{ $inputId }}">
                                                                <label class="form-check-label small" for="{{ $inputId }}">
                                                                    {{ ucfirst($symptom) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

.ros-consultation-row:hover {
    background-color: #f8f9fa;
}

.ros-consultation-row.selected {
    background-color: #e3f2fd !important;
}

.ros-consultation-date-input {
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.ros-consultation-date-input.loading {
    border-color: #007bff;
    background-color: #f0f8ff;
}

.ros-consultation-date-input.valid {
    border-color: #28a745;
    background-color: #f0fff0;
}

.ros-consultation-date-input.invalid {
    border-color: #dc3545;
    background-color: #fff0f0;
}

.ros-status-badge {
    font-size: 0.8em;
    padding: 4px 8px;
}

/* Alert Modal Styles */
#alertModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
}

#alertModal .modal-header {
    border-radius: 15px 15px 0 0;
}

#alertModal .modal-body {
    font-size: 1.1rem;
}

#alertModal .btn {
    border-radius: 25px;
    padding: 8px 20px;
    font-weight: 500;
}

/* Pulse animation for success */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

#alertModal.success .modal-content {
    animation: pulse 0.6s ease-in-out;
}

/* Loading button styles */
.btn:disabled {
    opacity: 0.7;
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Consultation info styling */
.consultation-info h5 {
    color: #495057;
}

#current-consultation-date {
    font-weight: 500;
}
</style>

<script>
$(document).ready(function() {
    let rosActiveConsultationId = null;
    let rosActiveConsultationType = null;
    let rosConsultationsData = {};
    let rosSaveTimeout = null;
    let rosIsSaving = false;

    // Initialize consultation status checking
    rosCheckAllConsultationStatuses();

<<<<<<< HEAD
    // Consultation date update handler
    $('.ros-consultation-date-input').on('change', function() {
        var $input = $(this);
        var consultationId = $input.data('ros-consultation-id');
        var newDate = $input.val();
        if (!newDate) return;
        $input.addClass('loading');
=======
    // Handle form submissions
    $('.reviewOfSystemsForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const consultationType = form.data('consultation-type');
        const submitBtn = form.find('button[type="submit"]');
        let formData = form.serialize();

        // If no checkboxes are checked, send empty symptoms array
        if (!formData.includes('symptoms')) {
            formData += '&symptoms[]=';
        }

        // Show loading state
        const originalBtnText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Saving...');

>>>>>>> origin/live_bridge_dev
        $.ajax({
            url: '/consultations/' + consultationId + '/update-date',
            method: 'POST',
            data: {
                consultation_date: newDate,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
<<<<<<< HEAD
                $input.removeClass('loading').addClass('valid');
                setTimeout(() => $input.removeClass('valid'), 2000);
                console.log('Date updated successfully');
                if (consultationId == rosActiveConsultationId) {
                    rosUpdateConsultationDateDisplay(newDate);
                }
=======
                // Show success message
                showAlert('success', response.message);

                // Update the consultation date display
                form.find('.consultation-date-display').text(response.consultation_date);
>>>>>>> origin/live_bridge_dev
            },
            error: function(xhr) {
                $input.removeClass('loading').addClass('invalid');
                setTimeout(() => $input.removeClass('invalid'), 3000);
                rosShowAlert('error', 'Error updating consultation date: ' + xhr.responseText);
            }
        });
    });

    // Consultation selection handler
    $('.ros-select-consultation-btn').on('click', function() {
        var consultationId = $(this).data('ros-consultation-id');
        var consultationNumber = $(this).data('ros-consultation-number');
        rosSelectConsultation(consultationId, consultationNumber);
    });

    // Function to select a consultation
    function rosSelectConsultation(consultationId, consultationNumber) {
        rosActiveConsultationId = consultationId;
        rosActiveConsultationType = 'ROS_' + rosGetConsultationSuffix(consultationNumber);
        // Update UI
        $('.ros-consultation-row').removeClass('selected');
        $('[data-ros-consultation-id="' + consultationId + '"]').closest('tr').addClass('selected');
        $('#selected_consultation_type').val(rosActiveConsultationType);
        $('#ros-active-consultation-text').text('Consultation ' + consultationNumber);
        $('#ros-active-consultation-info').show();
        // Show and reset saving badge
        $('#ros-saving-status-badge').show();
        $('#ros-saving-status-badge').removeClass('alert-warning alert-success alert-info').addClass('alert-info');
        $('#ros-saving-status-badge i').removeClass().addClass('fas fa-save me-2');
        $('#ros-saving-status-text').text('Saved');
        $('#ros-form-container').show();
        rosLoadConsultationRosData(rosActiveConsultationType);
    }

    // Function to get consultation suffix
    function rosGetConsultationSuffix(number) {
        if (number === 1) return '1st';
        if (number === 2) return '2nd';
        if (number === 3) return '3rd';
        return number + 'th';
    }

    // Function to get ordinal suffix
    function rosGetOrdinalSuffix(number) {
        if (number === 1) return 'st';
        if (number === 2) return 'nd';
        if (number === 3) return 'rd';
        return 'th';
    }

    // Function to check all consultation statuses
    function rosCheckAllConsultationStatuses() {
        $('.ros-consultation-row').each(function() {
            var consultationId = $(this).data('ros-consultation-id');
            rosCheckConsultationRosStatus(consultationId);
        });
    }

    // Function to check if consultation has ROS data
    function rosCheckConsultationRosStatus(consultationId) {
        $.ajax({
            url: `/patients/{{ $patient->id }}/consultations`,
            method: 'GET',
            success: function(response) {
                rosConsultationsData = response;
                let consultationType = null;
                let hasSymptoms = false;
                Object.keys(response).forEach(function(type) {
                    if (response[type] && response[type].consultation_id == consultationId) {
                        consultationType = type;
                        // Check for at least one non-empty array in symptoms
                        const symptoms = response[type].symptoms;
                        if (symptoms && typeof symptoms === 'object') {
                            hasSymptoms = Object.values(symptoms).some(arr => Array.isArray(arr) && arr.length > 0);
                        } else {
                            hasSymptoms = false;
                        }
                    }
                });
                var statusBadge = $('#ros-status-' + consultationId);
                if (hasSymptoms) {
                    statusBadge.removeClass('bg-secondary').addClass('bg-success')
                        .html('<i class="fas fa-check"></i> Has Data');
                } else {
                    statusBadge.removeClass('bg-secondary').addClass('bg-warning')
                        .html('<i class="fas fa-clock"></i> No Data');
                }
            },
            error: function() {
                $('#ros-status-' + consultationId).removeClass('bg-secondary').addClass('bg-danger')
                    .html('<i class="fas fa-times"></i> Error');
            }
        });
    }

    // Function to load consultation-specific ROS data
    function rosLoadConsultationRosData(consultationType) {
        $.ajax({
            url: `/patients/{{ $patient->id }}/review-of-systems/${consultationType}`,
            method: 'GET',
            success: function(response) {
                if (response.symptoms) {
                    populateRosForm(response.symptoms);
                } else {
                    clearRosForm();
                }
                
                // Update consultation date display
                if (response.consultation_date) {
                    rosUpdateConsultationDateDisplay(response.consultation_date);
                }
            },
            error: function(xhr) {
                console.error('Error loading ROS data:', xhr.responseText);
                clearRosForm();
            }
        });
    }

<<<<<<< HEAD
    // Function to populate ROS form with symptoms
    function populateRosForm(symptoms) {
        // Clear all checkboxes first
        $('.ros-symptom-checkbox').prop('checked', false);
        
        // Populate symptoms
        Object.keys(symptoms).forEach(function(section) {
            const sectionSymptoms = symptoms[section];
            if (Array.isArray(sectionSymptoms)) {
                sectionSymptoms.forEach(function(symptom) {
                    const checkbox = $(`input[name="symptoms[${section}][]"][value="${symptom}"]`);
                    checkbox.prop('checked', true);
=======
    // Populate consultation tab dates
    function populateConsultationTabs() {
        ['ROS_1st', 'ROS_2nd', 'ROS_3rd'].forEach(function(type) {
            const consultation = consultationsData[type];
            if (consultation && consultation.consultation_date) {
                const date = new Date(consultation.consultation_date);
                const formattedDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                $(`#${type.toLowerCase().replace('_', '-')}-date`).text(formattedDate);
            }
        });
    }

    // Populate forms with existing symptoms
    function populateForms() {
        ['ROS_1st', 'ROS_2nd', 'ROS_3rd'].forEach(function(consultationType) {
            const consultation = consultationsData[consultationType];
            const form = $(`.reviewOfSystemsForm[data-consultation-type="${consultationType}"]`);

            if (consultation) {
                // Update consultation date display
                if (consultation.consultation_date) {
                    const date = new Date(consultation.consultation_date);
                    const formattedDate = date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    form.find('.consultation-date-display').text(formattedDate);
                }

                // Populate symptoms
                const symptoms = consultation.symptoms || {};
                form.find('input[type="checkbox"]').prop('checked', false); // Clear all first

                Object.keys(symptoms).forEach(function(section) {
                    const sectionSymptoms = symptoms[section];
                    if (Array.isArray(sectionSymptoms)) {
                        sectionSymptoms.forEach(function(symptom) {
                            const checkbox = form.find(`input[name="symptoms[${section}][]"][value="${symptom}"]`);
                            checkbox.prop('checked', true);
                        });
                    }
>>>>>>> origin/live_bridge_dev
                });
            }
        });
    }

    // Function to clear ROS form
    function clearRosForm() {
        $('.ros-symptom-checkbox').prop('checked', false);
    }

    // Function to update consultation date display
    function rosUpdateConsultationDateDisplay(dateString) {
        const date = new Date(dateString);
        const formattedDate = date.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
        $('#current-consultation-date').text(formattedDate);
    }

    // Clear all symptoms handler
    $('#clearAllSymptoms').on('change', function() {
        var checked = $(this).is(':checked');
        if (checked) {
            $('.ros-symptom-checkbox').prop('checked', false);
            $(this).prop('checked', false); // Uncheck the clear button itself
            // Trigger save immediately after clearing
            if (rosSaveTimeout) clearTimeout(rosSaveTimeout);
            saveRosForm();
        }
    });

    // Save ROS form handler (automatic)
    $(document).on('change', '.ros-symptom-checkbox', function() {
        if (!rosActiveConsultationId || !rosActiveConsultationType) {
            return;
        }
        if (rosSaveTimeout) clearTimeout(rosSaveTimeout);
        rosSaveTimeout = setTimeout(function() {
            saveRosForm();
        }, 400);
    });

    // Save ROS form logic (used by both auto and manual save)
    function saveRosForm() {
        if (!rosActiveConsultationId || !rosActiveConsultationType) {
            rosShowAlert('error', 'Please select a consultation first.');
            return;
        }
        if (rosIsSaving) return; // Prevent concurrent saves
        rosIsSaving = true;
        // Show loading state in badge
        $('#ros-saving-status-badge').show();
        $('#ros-saving-status-badge').removeClass('alert-success alert-info').addClass('alert-warning');
        $('#ros-saving-status-badge i').removeClass().addClass('fas fa-spinner fa-spin me-2');
        $('#ros-saving-status-text').text('Auto-saving...');
        // Collect form data
        var formData = $('#reviewOfSystemsForm').serialize();
        // If no checkboxes are checked, send empty symptoms array
        if (!formData.includes('symptoms')) {
            formData += '&symptoms[]=';
        }
        $.ajax({
            url: `/patients/{{ $patient->id }}/review-of-systems`,
            method: 'POST',
            data: formData,
            success: function(response) {
                rosCheckConsultationRosStatus(rosActiveConsultationId);
                if (response.consultation_date) {
                    rosUpdateConsultationDateDisplay(response.consultation_date);
                }
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Error saving Review of Systems';
                rosShowAlert('error', errorMsg);
            },
            complete: function() {
                // Show saved state in badge
                $('#ros-saving-status-badge').removeClass('alert-warning alert-info').addClass('alert-success');
                $('#ros-saving-status-badge i').removeClass().addClass('fas fa-check me-2');
                $('#ros-saving-status-text').text('Saved');
                rosIsSaving = false;
            }
        });
    }

    // Show alert messages as a modal popup
    function rosShowAlert(type, message) {
        const isSuccess = type === 'success';
        const modalClass = isSuccess ? 'modal-success' : 'modal-error';
        const iconClass = isSuccess ? 'fa-check-circle' : 'fa-exclamation-circle';
        const bgColor = isSuccess ? 'bg-success' : 'bg-danger';
        const title = isSuccess ? 'Success!' : 'Error!';

        // Remove any existing alert modal
        $('#alertModal').remove();

        const alertModal = $(`
            <div class="modal fade ${isSuccess ? 'success' : ''}" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header ${bgColor} text-white border-0">
                            <h5 class="modal-title" id="alertModalLabel">
                                <i class="fas ${iconClass} me-2"></i>${title}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center py-4">
                            <p class="mb-0 fs-6">${message}</p>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn ${isSuccess ? 'btn-success' : 'btn-danger'}" data-bs-dismiss="modal">
                                <i class="fas fa-check me-1"></i>OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `);

        $('body').append(alertModal);

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('alertModal'));
        modal.show();

        // Auto dismiss after 4 seconds for success messages
        if (isSuccess) {
            setTimeout(function() {
                modal.hide();
            }, 4000);
        }

        // Remove modal from DOM when hidden
        $('#alertModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });
    }
<<<<<<< HEAD
=======

    // Handle tab switches to reload data if needed
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        const targetTab = $(e.target).attr('data-bs-target');
        const consultationType = targetTab.replace('#', '').replace('-', '_').toUpperCase();

        // Refresh data for the active tab if needed
        if (!consultationsData[consultationType]) {
            loadConsultations();
        }
    });
>>>>>>> origin/live_bridge_dev
});
</script>
