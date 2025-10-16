@php
    // Use the passed consultation ID from the parent view
    $consultationId = $selectedConsultationId ?? null;
    $selectedConsultation = null;
    $physicalExamData = [];
    
    // Get the selected consultation details if ID is provided
    if ($consultationId) {
        $selectedConsultation = \App\Models\Consultation::find($consultationId);
        
        // Load existing physical examination data for this consultation
        $physicalExam = \App\Models\PhysicalExamination::where('patient_id', $patient->id)
            ->where('consultation_id', $consultationId)
            ->first();
        
        if ($physicalExam) {
            $physicalExamData = [
                'general_survey' => $physicalExam->general_survey ?? [],
                'skin_hair' => $physicalExam->skin_hair ?? [],
                'finger_nails' => $physicalExam->finger_nails ?? [],
                'head' => $physicalExam->head ?? [],
                'eyes' => $physicalExam->eyes ?? [],
                'ear' => $physicalExam->ear ?? [],
                'neck' => $physicalExam->neck ?? [],
                'back_posture' => $physicalExam->back_posture ?? [],
                'thorax_lungs' => $physicalExam->thorax_lungs ?? [],
                'cardiac_exam' => $physicalExam->cardiac_exam ?? [],
                'abdomen' => $physicalExam->abdomen ?? [],
                'breast_axillae' => $physicalExam->breast_axillae ?? [],
                'male_genitalia' => $physicalExam->male_genitalia ?? [],
                'female_genitalia' => $physicalExam->female_genitalia ?? [],
                'extremities' => $physicalExam->extremities ?? [],
                'nervous_system' => $physicalExam->nervous_system ?? [],
            ];
        }
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
                    <div id="pe-saving-status-badge" class="alert alert-success py-1 px-3 mb-0 d-inline-flex align-items-center ms-3" style="display:none; font-size: 1rem;">
                        <i class="fas fa-check me-2"></i>
                        <span id="pe-saving-status-text">No Changes</span>
                    </div>
                    <button type="button" id="pe-manual-save-btn" class="btn btn-success py-1 px-3 ms-2" style="display:none;" disabled>
                        <i class="fas fa-save me-2"></i>Save
                    </button>
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

<!-- Loading Overlay -->
<div id="pe-loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:white; padding:30px; border-radius:10px; text-align:center;">
        <div class="spinner-border text-primary mb-3" role="status" style="width:3rem; height:3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h5>Loading Physical Examination Data...</h5>
        <p class="text-muted mb-0">Please wait</p>
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
                <!-- Tabs will be lazy-loaded when clicked -->
                <div class="tab-pane fade show active" id="list-general-survey" role="tabpanel" aria-labelledby="list-general-survey-list">
                    @include('patients.physical_examination.generalSurvey', ['patient' => $patient, 'physicalExamData' => $physicalExamData])
                </div>
                <div class="tab-pane fade" id="list-skin-hair" role="tabpanel" aria-labelledby="list-skin-hair-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-finger-nails" role="tabpanel" aria-labelledby="list-finger-nails-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-head" role="tabpanel" aria-labelledby="list-head-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-eyes" role="tabpanel" aria-labelledby="list-eyes-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-ear" role="tabpanel" aria-labelledby="list-ear-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-neck" role="tabpanel" aria-labelledby="list-neck-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-back-posture" role="tabpanel" aria-labelledby="list-back-posture-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-thorax-lungs" role="tabpanel" aria-labelledby="list-thorax-lungs-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-cardiac-exam" role="tabpanel" aria-labelledby="list-cardiac-exam-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-abdomen" role="tabpanel" aria-labelledby="list-abdomen-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-breast-axillae" role="tabpanel" aria-labelledby="list-breast-axillae-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-male-genitalia" role="tabpanel" aria-labelledby="list-male-genitalia-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-female-genitalia" role="tabpanel" aria-labelledby="list-female-genitalia-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-extremities" role="tabpanel" aria-labelledby="list-extremities-list">
                    <!-- Content will be loaded when tab is clicked -->
                </div>
                <div class="tab-pane fade" id="list-nervous-system" role="tabpanel" aria-labelledby="list-nervous-system-list">
                    <!-- Content will be loaded when tab is clicked -->
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
    let peHasUnsavedChanges = false;
    let peIsLoading = false; // Flag to prevent auto-save during initial load
    let peLoadedTabs = ['general_survey']; // Track which tabs have been loaded (first one is pre-loaded)

    // Tab to view file mapping
    const peTabMapping = {
        'skin-hair': { view: 'skinHair', section: 'skin_hair' },
        'finger-nails': { view: 'fingerNails', section: 'finger_nails' },
        'head': { view: 'head', section: 'head' },
        'eyes': { view: 'eyes', section: 'eyes' },
        'ear': { view: 'ear', section: 'ear' },
        'neck': { view: 'neck', section: 'neck' },
        'back-posture': { view: 'backandposture', section: 'back_posture' },
        'thorax-lungs': { view: 'thoraxandlungs', section: 'thorax_lungs' },
        'cardiac-exam': { view: 'cardiacexam', section: 'cardiac_exam' },
        'abdomen': { view: 'abdomen', section: 'abdomen' },
        'breast-axillae': { view: 'breastandaxillae', section: 'breast_axillae' },
        'male-genitalia': { view: 'malegenitalie', section: 'male_genitalia' },
        'female-genitalia': { view: 'femalegenitalia', section: 'female_genitalia' },
        'extremities': { view: 'extremities', section: 'extremities' },
        'nervous-system': { view: 'nervoussystem', section: 'nervous_system' }
    };

    // Lazy load tab content when clicked
    $('#physical-exam-tablist a[data-bs-toggle="list"]').on('shown.bs.tab', function(e) {
        const targetId = $(e.target).attr('href').replace('#list-', '');
        const tabInfo = peTabMapping[targetId];
        
        if (tabInfo && !peLoadedTabs.includes(tabInfo.section)) {
            // Load this tab's content via AJAX
            const $tabPane = $('#list-' + targetId);
            $tabPane.html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading section...</p></div>');
            
            $.ajax({
                url: '/patients/{{ $patient->id }}/physical-examination/load-section/' + tabInfo.view,
                method: 'GET',
                data: {
                    consultation_id: peActiveConsultationId
                },
                success: function(html) {
                    $tabPane.html(html);
                    peLoadedTabs.push(tabInfo.section);
                    
                    // Populate data if available
                    if (peCurrentPhysicalExamData[tabInfo.section]) {
                        populateSectionData(tabInfo.section, peCurrentPhysicalExamData[tabInfo.section]);
                    }
                },
                error: function(xhr) {
                    console.error('Error loading section:', xhr.responseText);
                    $tabPane.html('<div class="alert alert-danger">Error loading section. Please refresh the page.</div>');
                }
            });
        }
    });

    // Auto-initialize with the passed consultation if available
    @if($consultationId)
        // Show loading overlay
        $('#pe-loading-overlay').css('display', 'flex');
        
        // Show saving badge since we have a consultation
        $('#pe-saving-status-badge').show();
        $('#pe-manual-save-btn').show();
        
        // Set loading flag to prevent auto-save during data population
        peIsLoading = true;
        
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
            },
            complete: function() {
                // Hide loading overlay after data is loaded and populated
                setTimeout(function() {
                    $('#pe-loading-overlay').fadeOut(300);
                    // Reset loading flag after data is fully populated
                    peIsLoading = false;
                    peHasUnsavedChanges = false;
                }, 500);
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
        console.log('Populating section:', section, 'with data:', sectionData);

        $.each(sectionData, function(rowKey, rowData) {
            if (typeof rowData === 'object' && rowData !== null) {
                // Handle Normal checkbox (with 'pe' prefix)
                if (rowData.normal !== undefined) {
                    var normalField = 'pe[' + section + '][' + rowKey + '][normal]';
                    var $normalCheckbox = $('input[name="' + normalField + '"]');
                    if ($normalCheckbox.length) {
                        $normalCheckbox.prop('checked', rowData.normal == '1');
                    }
                }
                
                // Handle Abnormal checkboxes (array of values) - with 'pe' prefix
                if (Array.isArray(rowData.abnormal)) {
                    rowData.abnormal.forEach(function(abnormalValue) {
                        // Find checkbox with this value (note the 'pe' prefix)
                        var abnormalSelector = 'input[name="pe[' + section + '][' + rowKey + '][abnormal][]"][value="' + abnormalValue + '"]';
                        var $abnormalCheckbox = $(abnormalSelector);
                        if ($abnormalCheckbox.length) {
                            $abnormalCheckbox.prop('checked', true);
                            // Trigger change WITHOUT triggering auto-save (for showing detail inputs)
                            // We manually trigger the vanilla JS event without jQuery's change event
                            var event = new Event('change', { bubbles: true });
                            $abnormalCheckbox[0].dispatchEvent(event);
                        }
                    });
                }
                
                // Handle detail text inputs (with 'pe' prefix)
                if (rowData.detail && typeof rowData.detail === 'object') {
                    $.each(rowData.detail, function(detailKey, detailValue) {
                        var detailField = 'pe[' + section + '][' + rowKey + '][detail][' + detailKey + ']';
                        var $detailInput = $('input[name="' + detailField + '"]');
                        if ($detailInput.length) {
                            $detailInput.val(detailValue);
                        }
                    });
                }
                
                // Handle other_text (with 'pe' prefix)
                if (rowData.other_text !== undefined) {
                    var otherField = 'pe[' + section + '][' + rowKey + '][other_text]';
                    var $otherInput = $('input[name="' + otherField + '"]');
                    if ($otherInput.length) {
                        $otherInput.val(rowData.other_text);
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

    // Global Check All Normal functionality (triggers section-level buttons)
    $('#checkAllNormalGlobal').on('click', function() {
        // Trigger all section-level "Check All Normal" buttons (only in loaded tabs)
        $('[data-pe-action="check-all-normal"]').each(function() {
            $(this).click();
        });
    });

    // Global Uncheck All Normal functionality (triggers section-level buttons)
    $('#uncheckAllNormalGlobal').on('click', function() {
        // Trigger all section-level "Uncheck All" buttons (only in loaded tabs)
        $('[data-pe-action="uncheck-all-normal"]').each(function() {
            $(this).click();
        });
    });

    // Manual Save Button
    $('#pe-manual-save-btn').on('click', function() {
        if (peHasUnsavedChanges) {
            peSavePhysicalExamForm();
        }
    });

    // Auto-save on any checkbox change (debounced)
    $(document).on('change', '#masterPhysicalExamForm input[type="checkbox"]', function() {
        if (!peActiveConsultationId || peIsLoading) return;
        peHasUnsavedChanges = true;
        updateSaveButton();
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSaveTimeout = setTimeout(function() {
            peSavePhysicalExamForm();
        }, 5000);
    });

    // Auto-save on text input changes (debounced)
    $(document).on('input keyup', '#masterPhysicalExamForm input[type="text"], #masterPhysicalExamForm textarea', function() {
        if (!peActiveConsultationId || peIsLoading) return;
        peHasUnsavedChanges = true;
        updateSaveButton();
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSaveTimeout = setTimeout(function() {
            peSavePhysicalExamForm();
        }, 3000); // Shorter delay for text inputs
    });

    // Auto-save on select change
    $(document).on('change', '#masterPhysicalExamForm select', function() {
        if (!peActiveConsultationId || peIsLoading) return;
        peHasUnsavedChanges = true;
        updateSaveButton();
        if (peSaveTimeout) clearTimeout(peSaveTimeout);
        peSaveTimeout = setTimeout(function() {
            peSavePhysicalExamForm();
        }, 2000);
    });

    // Function to update save button state
    function updateSaveButton() {
        if (peHasUnsavedChanges) {
            // Has unsaved changes
            $('#pe-saving-status-badge').removeClass('alert-success').addClass('alert-warning');
            $('#pe-saving-status-badge i').removeClass().addClass('fas fa-exclamation-triangle me-2');
            $('#pe-saving-status-text').text('Unsaved Changes');
            $('#pe-manual-save-btn').prop('disabled', false);
        } else {
            // No changes / saved
            $('#pe-saving-status-badge').removeClass('alert-warning alert-info').addClass('alert-success');
            $('#pe-saving-status-badge i').removeClass().addClass('fas fa-check me-2');
            $('#pe-saving-status-text').text('No Changes');
            $('#pe-manual-save-btn').prop('disabled', true);
        }
    }



    // Save Physical Exam form logic
    function peSavePhysicalExamForm() {
        if (!peActiveConsultationId) {
            console.error('Cannot save: No active consultation ID');
            showAlert('error', 'No consultation selected for saving physical examination data.');
            return;
        }
        if (peIsSaving) return;
        peIsSaving = true;
        // Show saving state in badge
        $('#pe-saving-status-badge').show();
        $('#pe-saving-status-badge').removeClass('alert-success alert-warning').addClass('alert-info');
        $('#pe-saving-status-badge i').removeClass().addClass('fas fa-spinner fa-spin me-2');
        $('#pe-saving-status-text').text('Saving...');
        $('#pe-manual-save-btn').prop('disabled', true);
        // Collect form data
        var formData = $('#masterPhysicalExamForm').serialize();
        $.ajax({
            url: '/patients/{{ $patient->id ?? 0 }}/physical-examination/save-all',
            method: 'POST',
            data: formData,
            success: function(response) {
                showAlert('success', 'Physical examination saved successfully.');
                peHasUnsavedChanges = false;
                updateSaveButton();
            },
            error: function(xhr) {
                console.error('Save error:', xhr.responseText);
                showAlert('error', 'Error saving physical examination: ' + xhr.responseText);
            },
            complete: function() {
                // Show saved state in badge
                $('#pe-saving-status-badge').removeClass('alert-warning alert-info').addClass('alert-success');
                $('#pe-saving-status-badge i').removeClass().addClass('fas fa-check me-2');
                $('#pe-saving-status-text').text('Saved');
                $('#pe-manual-save-btn').prop('disabled', true);
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
