@php
    // Use the passed consultation ID from the parent view
    $consultationId = $selectedConsultationId ?? null;
    $selectedConsultation = null;
    
    // Get the selected consultation details if ID is provided
    if ($consultationId) {
        $selectedConsultation = \App\Models\Consultation::find($consultationId);
    }

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
@endphp

<!-- ROS Form Panel -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h6 class="mb-0">Review of Systems</h6>
                <div class="d-flex align-items-center">
                    @if($selectedConsultation)
                        <div class="alert alert-success py-1 px-3 mb-0 ms-3 d-flex align-items-center" style="font-size: 1rem;">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Active:</strong> 
                            <span>{{ $selectedConsultation->consultation_number }}{{ $selectedConsultation->consultation_number == 1 ? 'st' : ($selectedConsultation->consultation_number == 2 ? 'nd' : 'rd') }} Consultation</span>
                        </div>
                    @endif
                    <div id="ros-saving-status-badge" class="alert alert-info py-1 px-3 mb-0 d-inline-flex align-items-center ms-4" style="display:none; font-size: 1rem; min-width: 140px;">
                        <i class="fas fa-save me-2"></i>
                        <span id="ros-saving-status-text">Saved</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <button type="button" id="clearAllSymptoms" class="btn btn-outline-danger fw-bold">
                                Clear All Symptoms
                            </button>
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
<div id="ros-form-container">
    <form id="reviewOfSystemsForm">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        <input type="hidden" name="consultation_id" value="{{ $consultationId }}">
        <input type="hidden" name="consultation_type" id="selected_consultation_type" value="@if($selectedConsultation)ROS_{{ $selectedConsultation->consultation_number == 1 ? '1st' : ($selectedConsultation->consultation_number == 2 ? '2nd' : '3rd') }}@endif">

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
    @if($consultationId && $selectedConsultation)
        let rosActiveConsultationId = {{ $consultationId }};
        let rosActiveConsultationType = 'ROS_{{ $selectedConsultation->consultation_number == 1 ? '1st' : ($selectedConsultation->consultation_number == 2 ? '2nd' : '3rd') }}';
    @else
        let rosActiveConsultationId = null;
        let rosActiveConsultationType = null;
    @endif
    let rosConsultationsData = {};
    let rosSaveTimeout = null;
    let rosIsSaving = false;

    // Auto-initialize with the passed consultation if available
    @if($consultationId && $selectedConsultation)
        // Show saving badge since we have a consultation
        $('#ros-saving-status-badge').show();
        // Load the ROS data for this consultation
        rosLoadConsultationRosData(rosActiveConsultationType);
    @endif





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
    $('#clearAllSymptoms').on('click', function() {
        // Uncheck all symptom checkboxes
        $('.ros-symptom-checkbox').prop('checked', false);

        // Trigger save immediately after clearing
        if (rosSaveTimeout) clearTimeout(rosSaveTimeout);
        saveRosForm();
    });

    // Save ROS form handler (automatic)
    $(document).on('change', '.ros-symptom-checkbox', function() {
        if (!rosActiveConsultationId || !rosActiveConsultationType) {
            return;
        }
        if (rosSaveTimeout) clearTimeout(rosSaveTimeout);
        rosSaveTimeout = setTimeout(function() {
            saveRosForm();
        }, 5000);
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
                // Successfully saved - no additional actions needed
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
});
</script> 