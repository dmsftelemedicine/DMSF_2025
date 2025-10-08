@php
    // Use the passed consultation ID from the parent view
    $consultationId = $selectedConsultationId ?? null;
    $selectedConsultation = null;
    
    // Get the selected consultation details if ID is provided
    if ($consultationId) {
        $selectedConsultation = \App\Models\Consultation::find($consultationId);
    }
@endphp

<!-- Global Control Panel -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h6 class="mb-0">Physical Examination</h6>
                <div class="d-flex align-items-center">
                    @if($selectedConsultation)
                        <div class="alert alert-success py-1 px-3 mb-0 ms-3 d-flex align-items-center" style="font-size: 1rem;">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Active:</strong> 
                            <span>{{ $selectedConsultation->consultation_number }}{{ $selectedConsultation->consultation_number == 1 ? 'st' : ($selectedConsultation->consultation_number == 2 ? 'nd' : 'rd') }} Consultation</span>
                        </div>
                    @endif
                    <div id="pe-saving-status-badge" class="alert alert-info py-1 px-3 mb-0 d-inline-flex align-items-center ms-4" style="display:none; font-size: 1rem; min-width: 140px;">
                        <i class="fas fa-save me-2"></i>
                        <span id="pe-saving-status-text">Saved</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-success me-2 mb-2" id="checkAllNormalGlobal">
                            <i class="fas fa-check-double me-2"></i>Check All Normal
                        </button>
                        <button type="button" class="btn btn-warning me-2 mb-2" id="uncheckAllNormalGlobal">
                            <i class="fas fa-times-circle me-2"></i>Uncheck All Normal
                        </button>
                        <small class="text-muted d-block">These buttons will check/uncheck all "Normal" checkboxes across all examination sections</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Master Form Wrapper -->
<form id="masterPhysicalExamForm">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $patient->id ?? '' }}">
    <input type="hidden" name="consultation_id" id="selected_consultation_id" value="{{ $consultationId }}">

    <div class="row">
        <div class="col-4">
            <div class="list-group" id="physical-exam-tablist" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-general-survey-list" data-bs-toggle="list" href="#list-general-survey" role="tab" aria-controls="list-general-survey">
                    <i class="fa-solid fa-person me-2"></i>General Survey
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-skin-hair-list" data-bs-toggle="list" href="#list-skin-hair" role="tab" aria-controls="list-skin-hair">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-skin"></use>
                        </svg>
                    </i>Skin/Hair
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-finger-nails-list" data-bs-toggle="list" href="#list-finger-nails" role="tab" aria-controls="list-finger-nails">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-nails"></use>
                        </svg>
                    </i> Finger & Nails
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-head-list" data-bs-toggle="list" href="#list-head" role="tab" aria-controls="list-head">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-neck"></use>
                        </svg>
                    </i> Head
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-eyes-list" data-bs-toggle="list" href="#list-eyes" role="tab" aria-controls="list-eyes">
                    <i class="fa-solid fa-eye me-2"></i>Eyes
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-ear-list" data-bs-toggle="list" href="#list-ear" role="tab" aria-controls="list-ear">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-ear"></use>
                        </svg>
                    </i> Ear
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-neck-list" data-bs-toggle="list" href="#list-neck" role="tab" aria-controls="list-neck">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-neck"></use>
                        </svg>
                    </i> Neck
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-back-posture-list" data-bs-toggle="list" href="#list-back-posture" role="tab" aria-controls="list-back-posture">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-back"></use>
                        </svg>
                    </i> Back & Posture
                </a>
                <a class="list-group-item list-group-item-action" id="list-thorax-lungs-list" data-bs-toggle="list" href="#list-thorax-lungs" role="tab" aria-controls="list-thorax-lungs">
                    <i class="fa-solid fa-lungs me-2"></i>
                    Posterior Thorax & Lungs
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-cardiac-exam-list" data-bs-toggle="list" href="#list-cardiac-exam" role="tab" aria-controls="list-cardiac-exam">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-heart"></use>
                        </svg>
                    </i>Cardiac Exam
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-abdomen-list" data-bs-toggle="list" href="#list-abdomen" role="tab" aria-controls="list-abdomen">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-abdomen"></use>
                        </svg>
                    </i> Abdomen
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-breast-axillae-list" data-bs-toggle="list" href="#list-breast-axillae" role="tab" aria-controls="list-breast-axillae">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-breast"></use>
                        </svg>
                    </i> Breast & Axillae
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-male-genitalia-list" data-bs-toggle="list" href="#list-male-genitalia" role="tab" aria-controls="list-male-genitalia">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-male"></use>
                        </svg>
                    </i> Male Genitalia
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-female-genitalia-list" data-bs-toggle="list" href="#list-female-genitalia" role="tab" aria-controls="list-female-genitalia">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-female"></use>
                        </svg>
                    </i> Female Genitalia
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-extremities-list" data-bs-toggle="list" href="#list-extremities" role="tab" aria-controls="list-extremities">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-extremities"></use>
                        </svg>
                    </i> Extremities
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" id="list-nervous-system-list" data-bs-toggle="list" href="#list-nervous-system" role="tab" aria-controls="list-nervous-system">
                    <i>
                        <svg class="icon mr-2" width="20" height="20">
                            <use xlink:href="#icon-nervous"></use>
                        </svg>
                    </i> Nervous System
                </a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="physical-exam-tabContent">
                <div class="tab-pane fade show active" id="list-general-survey" role="tabpanel" aria-labelledby="list-general-survey-list">
                    @include('patients.physical_examination.generalSurvey', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-skin-hair" role="tabpanel" aria-labelledby="list-skin-hair-list">
                    @include('patients.physical_examination.skinHair', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-finger-nails" role="tabpanel" aria-labelledby="list-finger-nails-list">
                    @include('patients.physical_examination.fingerNails', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-head" role="tabpanel" aria-labelledby="list-head-list">
                    @include('patients.physical_examination.head', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-eyes" role="tabpanel" aria-labelledby="list-eyes-list">
                    @include('patients.physical_examination.eyes', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-ear" role="tabpanel" aria-labelledby="list-ear-list">
                    @include('patients.physical_examination.ear', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-neck" role="tabpanel" aria-labelledby="list-neck-list">
                    @include('patients.physical_examination.neck', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-back-posture" role="tabpanel" aria-labelledby="list-back-posture-list">
                    @include('patients.physical_examination.backandposture', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-thorax-lungs" role="tabpanel" aria-labelledby="list-thorax-lungs-list">
                    @include('patients.physical_examination.thoraxandlungs', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-cardiac-exam" role="tabpanel" aria-labelledby="list-cardiac-exam-list">
                    @include('patients.physical_examination.cardiacexam', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-abdomen" role="tabpanel" aria-labelledby="list-abdomen-list">
                    @include('patients.physical_examination.abdomen', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-breast-axillae" role="tabpanel" aria-labelledby="list-breast-axillae-list">
                    @include('patients.physical_examination.breastandaxillae', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-male-genitalia" role="tabpanel" aria-labelledby="list-male-genitalia-list">
                    @include('patients.physical_examination.malegenitalie', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-female-genitalia" role="tabpanel" aria-labelledby="list-female-genitalia-list">
                    @include('patients.physical_examination.femalegenitalia', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-extremities" role="tabpanel" aria-labelledby="list-extremities-list">
                    @include('patients.physical_examination.extremities', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-nervous-system" role="tabpanel" aria-labelledby="list-nervous-system-list">
                    @include('patients.physical_examination.nervoussystem', ['patient' => $patient])
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.card:hover {
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}
.tab-pane:not(.active) {
    display: none !important;
}


</style>

<script>
$(document).ready(function() {
    @if($consultationId)
        let peActiveConsultationId = {{ $consultationId }};
    @else
        let peActiveConsultationId = null;
    @endif
    let peCurrentPhysicalExamData = {};
    let peSaveTimeout = null;
    let peIsSaving = false;

    // Auto-initialize with the passed consultation if available
    @if($consultationId)
        // Show saving badge since we have a consultation
        $('#pe-saving-status-badge').show();
        // Load the physical exam data for this consultation
        peLoadConsultationPhysicalExamData(peActiveConsultationId);
    @endif



    // Function to load consultation-specific physical examination data
    function peLoadConsultationPhysicalExamData(consultationId) {
        $.ajax({
            url: '/consultations/' + consultationId + '/physical-examination',
            method: 'GET',
            success: function(response) {
                if (response.success && response.data) {
                    peCurrentPhysicalExamData = response.data;
                    populatePhysicalExamForms(response.data);
                } else {
                    // Clear forms if no data
                    clearAllPhysicalExamForms();
                }
            },
            error: function(xhr) {
                console.error('Error loading physical examination data:', xhr.responseText);
                clearAllPhysicalExamForms();
            }
        });
    }

    // Function to populate physical examination forms with data
    function populatePhysicalExamForms(data) {
        // Clear all forms first
        clearAllPhysicalExamForms();

        // Populate each section if it has data
        const sections = [
            'general_survey', 'skin_hair', 'finger_nails', 'head', 'eyes', 'ear',
            'neck', 'back_posture', 'thorax_lungs', 'cardiac_exam', 'abdomen',
            'breast_axillae', 'male_genitalia', 'female_genitalia', 'extremities', 'nervous_system'
        ];

        sections.forEach(function(section) {
            if (data[section]) {
                populateSectionData(section, data[section]);
            }
        });
    }

    // Function to populate a specific section with data
    function populateSectionData(section, sectionData) {
        // This function would populate checkboxes and inputs based on the section data
        // Implementation depends on the specific structure of each section
        console.log('Populating section:', section, 'with data:', sectionData);

        // Example for populating checkboxes and text inputs
        $.each(sectionData, function(key, value) {
            if (typeof value === 'object') {
                // Handle nested objects (like abnormal findings)
                $.each(value, function(subKey, subValue) {
                    var fieldName = section + '[' + key + '][' + subKey + ']';
                    var $field = $('[name="' + fieldName + '"]');

                    if ($field.length) {
                        if ($field.is(':checkbox') || $field.is(':radio')) {
                            $field.prop('checked', subValue == 1);
                        } else {
                            $field.val(subValue);
                        }
                    }
                });
            } else {
                // Handle simple values
                var fieldName = section + '[' + key + ']';
                var $field = $('[name="' + fieldName + '"]');

                if ($field.length) {
                    if ($field.is(':checkbox') || $field.is(':radio')) {
                        $field.prop('checked', value == 1);
                    } else {
                        $field.val(value);
                    }
                }
            }
        });
    }

    // Function to clear all physical examination forms
    function clearAllPhysicalExamForms() {
        $('#masterPhysicalExamForm input[type="checkbox"]').prop('checked', false);
        $('#masterPhysicalExamForm input[type="text"]').val('');
        $('#masterPhysicalExamForm input[type="number"]').val('');
        $('#masterPhysicalExamForm select').prop('selectedIndex', 0);
        $('#masterPhysicalExamForm textarea').val('');
    }

    // Global Check All Normal functionality (now a button)
    $('#checkAllNormalGlobal').on('click', function() {
        // Check all normal checkboxes across all sections
        $('input[type=checkbox][id^=normal_]').prop('checked', true);
        $('.normal-general-checkbox, .normal-skin-checkbox, .normal-finger-checkbox, .normal-head-checkbox, .normal-eyes-checkbox, .normal-ear-checkbox, .normal-neck-checkbox, .normal-backposture-checkbox, .normal-thoraxlungs-checkbox, .normal-cardiacexam-checkbox, .normal-abdomen-checkbox, .normal-breastaxillae-checkbox, .normal-malegenitalia-checkbox, .normal-femalegenitalia-checkbox, .normal-extremities-checkbox, .normal-nervoussystem-checkbox').prop('checked', true);
        
        // Trigger autosave
        if (peActiveConsultationId) {
            if (peSaveTimeout) clearTimeout(peSaveTimeout);
            peSavePhysicalExamForm();
        }
    });

    // Global Uncheck All Normal functionality
    $('#uncheckAllNormalGlobal').on('click', function() {
        // Uncheck all normal checkboxes across all sections
        $('input[type=checkbox][id^=normal_]').prop('checked', false);
        $('.normal-general-checkbox, .normal-skin-checkbox, .normal-finger-checkbox, .normal-head-checkbox, .normal-eyes-checkbox, .normal-ear-checkbox, .normal-neck-checkbox, .normal-backposture-checkbox, .normal-thoraxlungs-checkbox, .normal-cardiacexam-checkbox, .normal-abdomen-checkbox, .normal-breastaxillae-checkbox, .normal-malegenitalia-checkbox, .normal-femalegenitalia-checkbox, .normal-extremities-checkbox, .normal-nervoussystem-checkbox').prop('checked', false);
        
        // Trigger autosave
        if (peActiveConsultationId) {
            if (peSaveTimeout) clearTimeout(peSaveTimeout);
            peSavePhysicalExamForm();
        }
    });

    // Auto-save on any checkbox change (debounced)
    $(document).on('change', '#masterPhysicalExamForm input[type="checkbox"]', function() {
        if (!peActiveConsultationId) return;
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSaveTimeout = setTimeout(function() {
            peSavePhysicalExamForm();
        }, 5000);
    });

    // Auto-save on text input changes (debounced)
    $(document).on('input keyup', '#masterPhysicalExamForm input[type="text"], #masterPhysicalExamForm textarea', function() {
        if (!peActiveConsultationId) return;
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSaveTimeout = setTimeout(function() {
            peSavePhysicalExamForm();
        }, 3000); // Shorter delay for text inputs
    });

    // Auto-save on select change
    $(document).on('change', '#masterPhysicalExamForm select', function() {
        if (!peActiveConsultationId) return;
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSaveTimeout = setTimeout(function() {
            peSavePhysicalExamForm();
        }, 2000);
    });



    // Save Physical Exam form logic
    function peSavePhysicalExamForm() {
        if (!peActiveConsultationId) {
            console.error('Cannot save: No active consultation ID');
            showAlert('error', 'No consultation selected for saving physical examination data.');
            return;
        }
        if (peIsSaving) return;
        peIsSaving = true;
        // Show loading state in badge
        $('#pe-saving-status-badge').show();
        $('#pe-saving-status-badge').removeClass('alert-success alert-info').addClass('alert-warning');
        $('#pe-saving-status-badge i').removeClass().addClass('fas fa-spinner fa-spin me-2');
        $('#pe-saving-status-text').text('Auto-saving...');
        // Collect form data
        var formData = $('#masterPhysicalExamForm').serialize();
        $.ajax({
            url: '/patients/{{ $patient->id ?? 0 }}/physical-examination/save-all',
            method: 'POST',
            data: formData,
            success: function(response) {
                // Successfully saved - no additional actions needed
            },
            error: function(xhr) {
                showAlert('error', 'Error saving physical examination: ' + xhr.responseText);
            },
            complete: function() {
                // Show saved state in badge
                $('#pe-saving-status-badge').removeClass('alert-warning alert-info').addClass('alert-success');
                $('#pe-saving-status-badge i').removeClass().addClass('fas fa-check me-2');
                $('#pe-saving-status-text').text('Saved');
                peIsSaving = false;
            }
        });
    }

    // Modal alert function (copied and adapted from review_of_systems.blade.php)
    function showAlert(type, message) {
        const isSuccess = type === 'success';
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
