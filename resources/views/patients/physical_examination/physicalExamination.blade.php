<!-- Global Control Panel -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0">Physical Examination</h6>
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
                    <div class="col-md-6 text-end">
                        <button type="button" id="saveAllBtn" class="btn btn-success btn-lg">
                            <i class="fas fa-save me-2"></i>Save All Physical Examination
                        </button>
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
    
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="physical-exam-tablist" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-general-survey-list" data-bs-toggle="list" href="#list-general-survey" role="tab" aria-controls="list-general-survey">General Survey</a>
                <a class="list-group-item list-group-item-action" id="list-skin-hair-list" data-bs-toggle="list" href="#list-skin-hair" role="tab" aria-controls="list-skin-hair">Skin/Hair</a>
                <a class="list-group-item list-group-item-action" id="list-finger-nails-list" data-bs-toggle="list" href="#list-finger-nails" role="tab" aria-controls="list-finger-nails">Finger & Nails</a>
                <a class="list-group-item list-group-item-action" id="list-head-list" data-bs-toggle="list" href="#list-head" role="tab" aria-controls="list-head">Head</a>
                <a class="list-group-item list-group-item-action" id="list-eyes-list" data-bs-toggle="list" href="#list-eyes" role="tab" aria-controls="list-eyes">EYES</a>
                <a class="list-group-item list-group-item-action" id="list-ear-list" data-bs-toggle="list" href="#list-ear" role="tab" aria-controls="list-ear">EAR</a>
                <a class="list-group-item list-group-item-action" id="list-neck-list" data-bs-toggle="list" href="#list-neck" role="tab" aria-controls="list-neck">NECK</a>
                <a class="list-group-item list-group-item-action" id="list-back-posture-list" data-bs-toggle="list" href="#list-back-posture" role="tab" aria-controls="list-back-posture">BACK & POSTURE</a>
                <a class="list-group-item list-group-item-action" id="list-thorax-lungs-list" data-bs-toggle="list" href="#list-thorax-lungs" role="tab" aria-controls="list-thorax-lungs">POSTERIOR THORAX & LUNGS</a>
                <a class="list-group-item list-group-item-action" id="list-cardiac-exam-list" data-bs-toggle="list" href="#list-cardiac-exam" role="tab" aria-controls="list-cardiac-exam">CARDIAC EXAM</a>
                <a class="list-group-item list-group-item-action" id="list-abdomen-list" data-bs-toggle="list" href="#list-abdomen" role="tab" aria-controls="list-abdomen">ABDOMEN</a>
                <a class="list-group-item list-group-item-action" id="list-breast-axillae-list" data-bs-toggle="list" href="#list-breast-axillae" role="tab" aria-controls="list-breast-axillae">BREAST & AXILLAE</a>
                <a class="list-group-item list-group-item-action" id="list-male-genitalia-list" data-bs-toggle="list" href="#list-male-genitalia" role="tab" aria-controls="list-male-genitalia">MALE GENITALIA</a>
                <a class="list-group-item list-group-item-action" id="list-female-genitalia-list" data-bs-toggle="list" href="#list-female-genitalia" role="tab" aria-controls="list-female-genitalia">FEMALE GENITALIA</a>
                <a class="list-group-item list-group-item-action" id="list-extremities-list" data-bs-toggle="list" href="#list-extremities" role="tab" aria-controls="list-extremities">EXTREMITIES</a>
                <a class="list-group-item list-group-item-action" id="list-nervous-system-list" data-bs-toggle="list" href="#list-nervous-system" role="tab" aria-controls="list-nervous-system">NERVOUS SYSTEM</a>
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
                // 'Well-groomed/dressed and no significant body odor' // Not present in code
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
                // 'Quiet, unlabored and regular breathing',
                // 'Anteroposterior diameter < transverse diameter with normal contour' // Not present in code
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

    // Save All functionality
    $('#saveAllBtn').on('click', function() {
        var $btn = $(this);
        var originalText = $btn.html();
        
        // Show loading state
        $btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');
        $btn.prop('disabled', true);
        
        // Collect all form data
        var formData = $('#masterPhysicalExamForm').serialize();
        
        $.ajax({
            url: '/patients/{{ $patient->id ?? 0 }}/physical-examination/save-all',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('All physical examination sections saved successfully!');
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('Error saving physical examination: ' + xhr.responseText);
            },
            complete: function() {
                // Restore button state
                $btn.html(originalText);
                $btn.prop('disabled', false);
            }
        });
    });
});
</script>
