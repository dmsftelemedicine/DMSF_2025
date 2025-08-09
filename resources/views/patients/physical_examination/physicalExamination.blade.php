@php
    // Get or create consultations for this patient
    $consultations = \App\Models\Consultation::ensureThreeConsultations($patient->id ?? 0);
@endphp

<!-- Consultation Selection Panel -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Consultation Management - Physical Examination
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                            <strong>Consultation-Based Physical Examination:</strong> Each consultation has its own independent physical examination record.
                            <br><small class="text-muted">Select a consultation to view and edit its physical examination data. Dates can be manually updated.</small>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Consultation</th>
                                <th>Date</th>
                                <th>Physical Exam Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consultations as $index => $consultation)
                                @if($consultation)
                                    <tr class="pe-consultation-row" data-pe-consultation-id="{{ $consultation->id }}">
                                        <td>
                                            <strong>{{ $consultation->consultation_number }}{{ $consultation->consultation_number == 1 ? 'st' : ($consultation->consultation_number == 2 ? 'nd' : 'rd') }} Consultation</strong>
                                        </td>
                                        <td>
                                            <input type="date"
                                                   class="form-control form-control-sm pe-consultation-date-input"
                                                   value="{{ $consultation->consultation_date->format('Y-m-d') }}"
                                                   data-pe-consultation-id="{{ $consultation->id }}"
                                                   style="width: 160px;">
                                        </td>
                                        <td>
                                            <span class="pe-status-badge badge bg-secondary" id="pe-status-{{ $consultation->id }}">
                                                <i class="fas fa-spinner fa-spin"></i> Checking...
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-sm btn-primary pe-select-consultation-btn"
                                                    data-pe-consultation-id="{{ $consultation->id }}"
                                                    data-pe-consultation-number="{{ $consultation->consultation_number }}">
                                                <i class="fas fa-edit me-1"></i>Select & Edit
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Global Control Panel -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h6 class="mb-0">Physical Examination</h6>
                <div class="d-flex align-items-center">
                    <div id="pe-active-consultation-info" class="alert alert-success py-1 px-3 mb-0 ms-3 d-flex align-items-center" style="display: none; font-size: 1rem;">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Active:</strong> <span id="pe-active-consultation-text">No consultation selected</span>
                    </div>
                    <div id="pe-saving-status-badge" class="alert alert-info py-1 px-3 mb-0 d-inline-flex align-items-center ms-4" style="display:none; font-size: 1rem; min-width: 140px;">
                        <i class="fas fa-save me-2"></i>
                        <span id="pe-saving-status-text">Saved</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="checkAllNormalGlobal">
                            <label class="form-check-label fw-bold" for="checkAllNormalGlobal">
                                Check All Normal Parameters
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAllNormalConsultation">
                            <label class="form-check-label fw-bold" for="checkAllNormalConsultation">
                                Check All Normal via Consultation
                            </label>
                        </div>
                        <small class="text-muted">This will check all "Normal" checkboxes across all examination sections</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Master Form Wrapper -->
<form id="masterPhysicalExamForm" style="display: none;">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $patient->id ?? '' }}">
    <input type="hidden" name="consultation_id" id="selected_consultation_id" value="">

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
                            <use xlink:href="#icon-head"></use>
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

.pe-consultation-row:hover {
    background-color: #f8f9fa;
}

.pe-consultation-row.selected {
    background-color: #e3f2fd !important;
}

.pe-consultation-date-input {
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.pe-consultation-date-input.loading {
    border-color: #007bff;
    background-color: #f0f8ff;
}

.pe-consultation-date-input.valid {
    border-color: #28a745;
    background-color: #f0fff0;
}

.pe-consultation-date-input.invalid {
    border-color: #dc3545;
    background-color: #fff0f0;
}

.pe-status-badge {
    font-size: 0.8em;
    padding: 4px 8px;
}
</style>

<script>
$(document).ready(function() {
    let peActiveConsultationId = null;
    let peCurrentPhysicalExamData = {};
    let peSaveTimeout = null;
    let peIsSaving = false;

    // Initialize consultation status checking
    peCheckAllConsultationStatuses();

    // Consultation date update handler
    $('.pe-consultation-date-input').on('change', function() {
        var $input = $(this);
        var consultationId = $input.data('pe-consultation-id');
        var newDate = $input.val();
        if (!newDate) return;
        $input.addClass('loading');
        $.ajax({
            url: '/consultations/' + consultationId + '/update-date',
            method: 'POST',
            data: {
                consultation_date: newDate,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $input.removeClass('loading').addClass('valid');
                setTimeout(() => $input.removeClass('valid'), 2000);
                if (consultationId == peActiveConsultationId) {
                    // Optionally update date display
                }
            },
            error: function(xhr) {
                $input.removeClass('loading').addClass('invalid');
                setTimeout(() => $input.removeClass('invalid'), 3000);
                showAlert('error', 'Error updating consultation date: ' + xhr.responseText);
            }
        });
    });

    // Consultation selection handler
    $('.pe-select-consultation-btn').on('click', function() {
        var consultationId = $(this).data('pe-consultation-id');
        var consultationNumber = $(this).data('pe-consultation-number');
        peSelectConsultation(consultationId, consultationNumber);
    });

    // Function to select a consultation
    function peSelectConsultation(consultationId, consultationNumber) {
        peActiveConsultationId = consultationId;
        // Update UI
        $('.pe-consultation-row').removeClass('selected');
        $('[data-pe-consultation-id="' + consultationId + '"]').closest('tr').addClass('selected');
        $('#selected_consultation_id').val(consultationId);
        $('#pe-active-consultation-text').text('Consultation ' + consultationNumber);
        $('#pe-active-consultation-info').show();
        // Show and reset saving badge
        $('#pe-saving-status-badge').show();
        $('#pe-saving-status-badge').removeClass('alert-warning alert-success alert-info').addClass('alert-info');
        $('#pe-saving-status-badge i').removeClass().addClass('fas fa-save me-2');
        $('#pe-saving-status-text').text('Saved');
        $('#masterPhysicalExamForm').show();
        peLoadConsultationPhysicalExamData(consultationId);
    }

    // Function to get ordinal suffix
    function getOrdinalSuffix(number) {
        if (number === 1) return 'st';
        if (number === 2) return 'nd';
        if (number === 3) return 'rd';
        return 'th';
    }

    // Function to check all consultation statuses
    function peCheckAllConsultationStatuses() {
        $('.pe-consultation-row').each(function() {
            var consultationId = $(this).data('pe-consultation-id');
            peCheckConsultationPhysicalExamStatus(consultationId);
        });
    }

    // Function to check if consultation has physical examination data
    function peCheckConsultationPhysicalExamStatus(consultationId) {
        $.ajax({
            url: '/consultations/' + consultationId + '/physical-examination',
            method: 'GET',
            success: function(response) {
                var statusBadge = $('#pe-status-' + consultationId);
                // Only show 'Has Data' if at least one checked checkbox (value === 1 or true) in the data object
                function hasActiveValue(obj) {
                    if (Array.isArray(obj)) {
                        return obj.some(hasActiveValue);
                    } else if (typeof obj === 'object' && obj !== null) {
                        return Object.values(obj).some(hasActiveValue);
                    } else {
                        // Consider 1, true, '1', or 'true' as active (checked checkbox)
                        return obj === 1 || obj === true || obj === '1' || obj === 'true';
                    }
                }
                let hasData = false;
                if (response.success && response.data && typeof response.data === 'object') {
                    hasData = hasActiveValue(response.data);
                }
                if (hasData) {
                    statusBadge.removeClass('bg-secondary bg-warning bg-danger').addClass('bg-success')
                        .html('<i class="fas fa-check"></i> Has Data');
                } else {
                    statusBadge.removeClass('bg-secondary bg-success bg-danger').addClass('bg-warning')
                        .html('<i class="fas fa-clock"></i> No Data');
                }
            },
            error: function() {
                $('#pe-status-' + consultationId).removeClass('bg-secondary bg-success bg-warning').addClass('bg-danger')
                    .html('<i class="fas fa-times"></i> Error');
            }
        });
    }

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

    // Global Check All Normal functionality
    $('#checkAllNormalGlobal').on('change', function() {
        var checked = $(this).is(':checked');

        // Check all normal checkboxes across all sections
        $('input[type=checkbox][id^=normal_]').prop('checked', checked);
        $('.normal-general-checkbox, .normal-skin-checkbox, .normal-finger-checkbox, .normal-head-checkbox, .normal-eyes-checkbox, .normal-ear-checkbox, .normal-neck-checkbox, .normal-backposture-checkbox, .normal-thoraxlungs-checkbox, .normal-cardiacexam-checkbox, .normal-abdomen-checkbox, .normal-breastaxillae-checkbox, .normal-malegenitalia-checkbox, .normal-femalegenitalia-checkbox, .normal-extremities-checkbox, .normal-nervoussystem-checkbox').prop('checked', checked);
    });

    // Check All Normal via Consultation functionality
    $('#checkAllNormalConsultation').on('change', function() {
        var checked = $(this).is(':checked');
        // List of normal values to check by label text, grouped by section class
        var normalMap = [
            // General Survey
            {cls: '.normal-general-checkbox', labels: [
                'Calm with well developed and well-nourished built',
                'Breathing regularly',
                'Alert and oriented to person, place, time, and situation',
                'Erect, ambulating with ease',
            ]},
            // Skin/Hair
            {cls: '.normal-skin-checkbox', labels: [
                'Even skin tone',
                'Generally clear skin',
                'Normal hair distribution & texture'
            ]},
            // Finger & Nails
            {cls: '.normal-finger-checkbox', labels: [
                'Pink & smooth',
                'Capillary refill time of <2 seconds'
            ]},
            // Head
            {cls: '.normal-head-checkbox', labels: [
                'Normal skull shape & contour',
                'No visible masses, swelling, lesions, scaliness/flakiness or pulsations; nontender',
                "Even distribution across the scalp, appropriate color for the individual's ethnicity, no infestations, and a smooth, healthy texture"
            ]},
            // Eyes
            {cls: '.normal-eyes-checkbox', labels: [
                'Symmetrical eye position and alignment',
                'No inflammation, injury, or crusting',
                'Pink',
                'Clear',
                'White',
                'Intact, symmetrical color, and center',
                'Full range of extraocular movements'
            ]},
            // Ear
            {cls: '.normal-ear-checkbox', labels: [
                'Symmetrical, no lesions, no discharge',
                'Nontender auricle, tragus, and mastoid process',
                'Hears conversation well'
            ]},
            // Neck
            {cls: '.normal-neck-checkbox', labels: [
                'No visible pulsations and masses',
                'Effortless breathing'
            ]},
            // Back and Posture
            {cls: '.normal-backposture-checkbox', labels: [
                'Midline and nontender',
                'Intact skin with symmetrical tone of muscles'
            ]},
            // Abdomen
            {cls: '.normal-abdomen-checkbox', labels: [
                'Relaxed, non-distended, symmetrical contour'
            ]},
            // Extremities
            {cls: '.normal-extremities-checkbox', labels: [
                'Even skin, no subcutaneous nodules, muscle atrophy, crepitus, bogginess or tenderness',
                'Full smooth range of motion, no swelling, symmetrical and aligned',
                'Pulses full and equal, no edema, symmetrical valves, not visible to flat nonprominent veins, symmetrical warmth, with hair growth appropriate to age and sex',
                'Steady, balanced'
            ]},
            // Nervous System
            {cls: '.normal-nervoussystem-checkbox', labels: [
                'Speaks fluently with appropriate rate and articulation',
                'Understands simple and complex instructions',
                'Symmetrical facial features, no abnormal movements'
            ]}
        ];

        // Uncheck all normal checkboxes first
        if (checked) {
            // Uncheck all normal checkboxes first
            $('.normal-general-checkbox, .normal-skin-checkbox, .normal-finger-checkbox, .normal-head-checkbox, .normal-eyes-checkbox, .normal-ear-checkbox, .normal-neck-checkbox, .normal-backposture-checkbox, .normal-abdomen-checkbox, .normal-extremities-checkbox, .normal-nervoussystem-checkbox').prop('checked', false);
            // For each section, check only those with matching label
            normalMap.forEach(function(section) {
                section.labels.forEach(function(labelText) {
                    $(section.cls).each(function() {
                        var label = $(this).closest('.form-check').find('label').text().trim();
                        if (label === labelText) {
                            $(this).prop('checked', true);
                        }
                    });
                });
            });
        } else {
            // Uncheck only those checkboxes
            normalMap.forEach(function(section) {
                section.labels.forEach(function(labelText) {
                    $(section.cls).each(function() {
                        var label = $(this).closest('.form-check').find('label').text().trim();
                        if (label === labelText) {
                            $(this).prop('checked', false);
                        }
                    });
                });
            });
        }
    });

    // Auto-save on any checkbox change (debounced)
    $(document).on('change', '#masterPhysicalExamForm input[type="checkbox"]', function() {
        if (!peActiveConsultationId) return;
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSaveTimeout = setTimeout(function() {
            peSavePhysicalExamForm();
        }, 400);
    });

    // Auto-save when 'Check All Normal' is used
    $('#checkAllNormalGlobal, #checkAllNormalConsultation').on('change', function() {
        if (!peActiveConsultationId) return;
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSavePhysicalExamForm();
    });

    // Save Physical Exam form logic
    function peSavePhysicalExamForm() {
        if (!peActiveConsultationId) return;
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
                peCheckConsultationPhysicalExamStatus(peActiveConsultationId);
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
