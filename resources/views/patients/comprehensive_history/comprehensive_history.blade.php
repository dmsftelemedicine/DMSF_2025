<style>
        /* Custom Accordion Styling */
        .accordion-header {
            cursor: pointer;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
            margin-bottom: 2px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            user-select: none;
            transition: all 0.3s ease;
            position: relative;
            border-radius: 6px;
        }
        
        .accordion-header::after {
            content: '+';
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
            font-weight: bold;
            transition: transform 0.3s ease;
        }
        
        .accordion-header.active::after {
            content: '−';
            transform: translateY(-50%) rotate(180deg);
        }
        
        .accordion-header:hover {
            background-color: #e9ecef;
        }
        
        .accordion-header.active {
            background-color: #7CAD3E;
            color: white;
            box-shadow: 0 2px 4px rgba(124, 173, 62, 0.2);
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            margin-bottom: 0;
        }
        
        .accordion-content {
            padding: 1.5rem;
            border: 1px solid #dee2e6;
            border-top: none;
            background: #fafafa;
            overflow: hidden;
            transition: all 0.3s ease;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
        }
        
        /* Main container styling */
        .comprehensive-history-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: auto;
        }
        
        /* Card styling */
        .card {
            border: none;
            border-radius: 8px;
            margin: 0;
            width: 100%;
            max-width: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background: white;
            overflow: hidden;
        }
        
        .card-header {
            border-bottom: 1px solid #e9ecef;
        }
        
        .card-body {
            background: #f8f9fa;
        }
        
        /* Sticky navigation styles */
        .sticky-nav {
            position: sticky;
            top: 20px;
            z-index: 1000;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-height: calc(100vh - 40px);
            overflow-y: auto;
            width: 100%;
            border: 1px solid #e9ecef;
        }
        
        .sticky-nav h6 {
            color: #495057;
            font-weight: 600;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        /* Content area adjustments */
        .form-content-area {
            padding-left: 15px;
        }
        
        /* Row adjustments */
        .comprehensive-history-row {
            margin: 0;
            width: 100%;
        }
        
        /* Navigation column */
        .nav-column {
            padding-right: 15px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sticky-nav {
                position: relative;
                max-height: none;
                margin-bottom: 1rem;
            }
            
            .comprehensive-history-container {
                padding: 10px;
                width: 100%;
                max-width: 100%;
            }
            
            .card {
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                width: 100%;
            }
            
            .nav-column {
                padding-right: 15px;
                margin-bottom: 20px;
            }
            
            .form-content-area {
                padding-left: 15px;
            }
            
            .comprehensive-history-row {
                width: 100%;
                margin: 0;
            }
        }
        
        .form-content-area {
            position: relative;
            z-index: 1;
            background: white;
        }
        
        .nav-link {
            color: #666;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: #7CAD3E;
            color: white;
            text-decoration: none;
        }
        
        .nav-link.completed {
            background-color: #28a745;
            color: white;
        }
        
        .progress-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .progress-indicator.completed {
            background-color: #28a745;
            color: white;
        }
        
        .progress-indicator.active {
            background-color: #7CAD3E;
            color: white;
        }
        
        /* Form styling within accordion */
        .accordion-content .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .accordion-content .form-control:focus {
            border-color: #7CAD3E;
            box-shadow: 0 0 0 0.2rem rgba(124, 173, 62, 0.25);
        }
        
        .accordion-content .form-group {
            margin-bottom: 1.5rem;
        }
        
        .accordion-content label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        /* Force full width for comprehensive history */
        #comprehensive-history-tab-pane {
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Ensure row takes full width */
        .comprehensive-history-row {
            width: 100% !important;
            max-width: 100% !important;
        }
    </style>
    
<div class="comprehensive-history-container">
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: #7CAD3E;">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-white">Comprehensive History</h6>
                <small id="autoSaveStatus" class="text-black-50 ms-3" style="display: none;">
                    <i class="fa fa-circle-notch fa-spin me-1"></i><span id="autoSaveText"></span>
                </small>
            </div>
            <button class="btn btn-secondary btn-sm" type="button" id="saveComprehensiveHistoryBtn" disabled>
                <i class="fa fa-circle-notch fa-spin me-1"></i> Loading...
            </button>
        </div>
        <div class="card-body p-0">
            <div class="row comprehensive-history-row g-0">
                <!-- Sticky Navigation -->
                <div class="col-md-3 nav-column">
                    <nav class="sticky-nav p-3">
                        <h6 class="mb-3 text-muted">Sections</h6>
                        <div class="nav flex-column">
                            <a href="#section-informant" class="nav-link" data-section="informant">
                                <span class="progress-indicator" id="indicator-informant">1</span>
                                Informant
                            </a>
                            <a href="#section-chief-concern" class="nav-link" data-section="chief-concern">
                                <span class="progress-indicator" id="indicator-chief-concern">2</span>
                                Chief Concern
                            </a>
                            <a href="#section-past-medical" class="nav-link" data-section="past-medical">
                                <span class="progress-indicator" id="indicator-past-medical">3</span>
                                Past Medical History
                            </a>
                            <a href="#section-family-history" class="nav-link" data-section="family-history">
                                <span class="progress-indicator" id="indicator-family-history">4</span>
                                Family History
                            </a>
                            <a href="#section-allergies" class="nav-link" data-section="allergies">
                                <span class="progress-indicator" id="indicator-allergies">5</span>
                                Allergies
                            </a>
                            <a href="#section-medications" class="nav-link" data-section="medications">
                                <span class="progress-indicator" id="indicator-medications">6</span>
                                Medications
                            </a>
                            <a href="#section-hospitalization" class="nav-link" data-section="hospitalization">
                                <span class="progress-indicator" id="indicator-hospitalization">7</span>
                                Hospitalization
                            </a>
                            <a href="#section-surgical" class="nav-link" data-section="surgical">
                                <span class="progress-indicator" id="indicator-surgical">8</span>
                                Surgical History
                            </a>
                            <a href="#section-health-maintenance" class="nav-link" data-section="health-maintenance">
                                <span class="progress-indicator" id="indicator-health-maintenance">9</span>
                                Health Maintenance
                            </a>
                            @if(strtolower($patient->gender) !== 'male')
                                <a href="#section-obgyn" class="nav-link" data-section="obgyn">
                                    <span class="progress-indicator" id="indicator-obgyn">10</span>
                                    OBGYN History
                                </a>
                            @endif
                            <a href="#section-psychiatric" class="nav-link" data-section="psychiatric">
                                <span class="progress-indicator" id="indicator-psychiatric">11</span>
                                Psychiatric Illness
                            </a>
                            <a href="#section-personal-social" class="nav-link" data-section="personal-social">
                                <span class="progress-indicator" id="indicator-personal-social">12</span>
                                Personal-Social History
                            </a>
                            <a href="#section-alternative" class="nav-link" data-section="alternative">
                                <span class="progress-indicator" id="indicator-alternative">13</span>
                                Alternative Therapies
                            </a>
                            <a href="#section-other-social" class="nav-link" data-section="other-social">
                                <span class="progress-indicator" id="indicator-other-social">14</span>
                                Other Social History
                            </a>
                        </div>
                    </nav>
                </div>
                
                <!-- Form Content -->
                <div class="col-md-9 form-content-area">
                    <div class="p-3">
                        <form id="comprehensiveHistoryForm">
                            @csrf
                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                        <!-- Custom Accordion -->
                        <div id="comprehensiveHistoryAccordion">
                            
                            <!-- Informant Section -->
                            <div class="card mb-2" id="section-informant">
                                <div class="accordion-header" data-section="informant">
                                    <span class="progress-indicator me-2" id="header-indicator-informant">1</span>
                                    Informant
                                </div>
                                <div id="content-informant" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.informant_section')
                                </div>
                            </div>

                            <!-- Chief Concern Section -->
                            <div class="card mb-2" id="section-chief-concern">
                                <div class="accordion-header" data-section="chief-concern">
                                    <span class="progress-indicator me-2" id="header-indicator-chief-concern">2</span>
                                    Chief Concern
                                </div>
                                <div id="content-chief-concern" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.chief_concern_section')
                                </div>
                            </div>

                            <!-- Past Medical History Section -->
                            <div class="card mb-2" id="section-past-medical">
                                <div class="accordion-header" data-section="past-medical">
                                    <span class="progress-indicator me-2" id="header-indicator-past-medical">3</span>
                                    Past Medical History
                                </div>
                                <div id="content-past-medical" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.past_medical_history_section')
                                </div>
                            </div>

                            <!-- Family History Section -->
                            <div class="card mb-2" id="section-family-history">
                                <div class="accordion-header" data-section="family-history">
                                    <span class="progress-indicator me-2" id="header-indicator-family-history">4</span>
                                    Family History
                                </div>
                                <div id="content-family-history" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.family_history_section')
                                </div>
                            </div>

                            <!-- Allergies Section -->
                            <div class="card mb-2" id="section-allergies">
                                <div class="accordion-header" data-section="allergies">
                                    <span class="progress-indicator me-2" id="header-indicator-allergies">5</span>
                                    Allergies
                                </div>
                                <div id="content-allergies" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.allergies_section')
                                </div>
                            </div>

                            <!-- Medications Section -->
                            <div class="card mb-2" id="section-medications">
                                <div class="accordion-header" data-section="medications">
                                    <span class="progress-indicator me-2" id="header-indicator-medications">6</span>
                                    Previous and Current Medications
                                </div>
                                <div id="content-medications" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.medications_section')
                                </div>
                            </div>

                            <!-- Hospitalization Section -->
                            <div class="card mb-2" id="section-hospitalization">
                                <div class="accordion-header" data-section="hospitalization">
                                    <span class="progress-indicator me-2" id="header-indicator-hospitalization">7</span>
                                    Previous Hospitalization
                                </div>
                                <div id="content-hospitalization" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.hospitalization_section')
                                </div>
                            </div>

                            <!-- Surgical History Section -->
                            <div class="card mb-2" id="section-surgical">
                                <div class="accordion-header" data-section="surgical">
                                    <span class="progress-indicator me-2" id="header-indicator-surgical">8</span>
                                    Surgical History
                                </div>
                                <div id="content-surgical" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.surgical_history_section')
                                </div>
                            </div>

                            <!-- Health Maintenance Section -->
                            <div class="card mb-2" id="section-health-maintenance">
                                <div class="accordion-header" data-section="health-maintenance">
                                    <span class="progress-indicator me-2" id="header-indicator-health-maintenance">9</span>
                                    Health Maintenance
                                </div>
                                <div id="content-health-maintenance" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.health_maintenance_section')
                                </div>
                            </div>

                            <!-- OBGYN History Section -->
                            @if(strtolower($patient->gender) !== 'male')
                                <div class="card mb-2" id="section-obgyn">
                                    <div class="accordion-header" data-section="obgyn">
                                        <span class="progress-indicator me-2" id="header-indicator-obgyn">10</span>
                                        OBGYN History
                                    </div>
                                    <div id="content-obgyn" class="accordion-content" style="display: none;">
                                        @include('patients.comprehensive_history.components.obgyn_history_section')
                                    </div>
                                </div>
                            @endif

                            <!-- Psychiatric Illness Section -->
                            <div class="card mb-2" id="section-psychiatric">
                                <div class="accordion-header" data-section="psychiatric">
                                    <span class="progress-indicator me-2" id="header-indicator-psychiatric">11</span>
                                    Psychiatric Illness
                                </div>
                                <div id="content-psychiatric" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.psychiatric_illness_section')
                                </div>
                            </div>

                            <!-- Personal-Social History Section -->
                            <div class="card mb-2" id="section-personal-social">
                                <div class="accordion-header" data-section="personal-social">
                                    <span class="progress-indicator me-2" id="header-indicator-personal-social">12</span>
                                    Personal-Social History
                                </div>
                                <div id="content-personal-social" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.personal_social_history_section')
                                </div>
                            </div>

                            <!-- Alternative Therapies Section -->
                            <div class="card mb-2" id="section-alternative">
                                <div class="accordion-header" data-section="alternative">
                                    <span class="progress-indicator me-2" id="header-indicator-alternative">13</span>
                                    Alternative Therapies
                                </div>
                                <div id="content-alternative" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.alternative_therapies_section')
                                </div>
                            </div>

                            <!-- Other Social History Section -->
                            <div class="card mb-2" id="section-other-social">
                                <div class="accordion-header" data-section="other-social">
                                    <span class="progress-indicator me-2" id="header-indicator-other-social">14</span>
                                    Other Social History
                                </div>
                                <div id="content-other-social" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.other_social_history_section')
                                </div>
                            </div>

                            </div> <!-- End Accordion -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Custom accordion implementation with slideUp/slideDown
    $('.accordion-header').on('click', function() {
        const $header = $(this);
        const section = $header.data('section');
        const $content = $header.next('.accordion-content');
        const isCurrentlyActive = $header.hasClass('active');
        
        // Close all other sections first
        $('.accordion-header').removeClass('active');
        $('.accordion-content').slideUp(300);
        
        if (!isCurrentlyActive) {
            // Open this section
            $header.addClass('active');
            $content.slideDown(300);
            
            // Update navigation
            $('.nav-link').removeClass('active');
            $(`.nav-link[data-section="${section}"]`).addClass('active');
            updateProgressIndicator(section, 'active');
            
        } else {
            // If it was active, just close it (already done above)
            
            // Update progress indicator for closed section
            if (isSectionCompleted(section)) {
                updateProgressIndicator(section, 'completed');
            } else {
                updateProgressIndicator(section, 'default');
            }
        }
    });
    
    // Navigation click handler
    $('.nav-link[data-section]').on('click', function(e) {
        e.preventDefault();
        const section = $(this).data('section');
        const $targetHeader = $(`.accordion-header[data-section="${section}"]`);
        
        if ($targetHeader.length) {
            $targetHeader.click(); // Trigger custom accordion
        }
    });
    
    // Load comprehensive history data when the tab is clicked
    $('#comprehensive-history-tab').on('click', function() {
        loadComprehensiveHistoryData();
    });

    // Also load data if the comprehensive history tab is already active on page load
    if ($('#comprehensive-history-tab').hasClass('active') || $('#comprehensive-history-tab-pane').hasClass('active')) {
        loadComprehensiveHistoryData();
    }
    
    // Check if a section has any filled content
    function isSectionCompleted(sectionId) {
        const section = $(`#section-${sectionId}`);
        let hasContent = false;
        
        section.find('input, select, textarea').each(function() {
            const $el = $(this);
            if ($el.attr('type') === 'checkbox' || $el.attr('type') === 'radio') {
                if ($el.is(':checked')) {
                    hasContent = true;
                    return false;
                }
            } else if ($el.val() && $el.val().trim() !== '') {
                hasContent = true;
                return false;
            }
        });
        
        return hasContent;
    }
    
    // Update progress indicator
    function updateProgressIndicator(sectionId, status) {
        const indicator = $(`#indicator-${sectionId}`);
        const btnIndicator = $(`#btn-indicator-${sectionId}`);
        const headerIndicator = $(`#header-indicator-${sectionId}`);
        const navLink = $(`.nav-link[data-section="${sectionId}"]`);
        
        // Update all indicators (navigation, button, and header)
        [indicator, btnIndicator, headerIndicator].forEach($ind => {
            if ($ind.length) {
                $ind.removeClass('completed active');
            }
        });
        navLink.removeClass('completed');
        
        if (status === 'completed') {
            [indicator, btnIndicator, headerIndicator].forEach($ind => {
                if ($ind.length) {
                    $ind.addClass('completed').html('✓');
                }
            });
            navLink.addClass('completed');
        } else if (status === 'active') {
            [indicator, btnIndicator, headerIndicator].forEach($ind => {
                if ($ind.length) {
                    $ind.addClass('active');
                }
            });
        } else {
            // Reset to number
            const number = navLink.index() + 1;
            [indicator, btnIndicator, headerIndicator].forEach($ind => {
                if ($ind.length) {
                    $ind.html(number);
                }
            });
        }
    }

    // Function to load comprehensive history data
    function loadComprehensiveHistoryData() {
        var patientId = $('input[name="patient_id"]').val();
        
        // Show loading state
        updateButtonState('loading', '<i class="fa fa-circle-notch fa-spin me-1"></i> Loading...');
        $('#autoSaveStatus').show();
        $('#autoSaveText').text('Loading data from database...');
        $('#autoSaveStatus i').removeClass('fa-check fa-exclamation-triangle').addClass('fa-circle-notch fa-spin');
        
        $.ajax({
            url: '/patients/' + patientId + '/comprehensive-history/data',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Hide loading indicator
                $('#autoSaveStatus').fadeOut(300);
                
                if (response) {
                    populateFormWithData(response);
                    // Update progress indicators after loading data
                    updateAllProgressIndicators();
                    
                    // Set button to default state after successful load
                    updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
                } else {
                    // No data found, set to default state
                    updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
                }
            },
            error: function(xhr) {
                // Hide loading indicator and show error
                $('#autoSaveStatus').fadeOut(300);
                
                console.error('Failed to load comprehensive history data:', xhr.responseJSON?.message || 'Unknown error');
                
                // Show error state briefly, then revert to default
                updateButtonState('error', '<i class="fa fa-exclamation-triangle me-1"></i> Load Failed');
                
                setTimeout(function() {
                    updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
                }, 3000);
            }
        });
    }
    
    // Update all progress indicators based on current form state
    function updateAllProgressIndicators() {
        $('.nav-link[data-section]').each(function() {
            const sectionId = $(this).data('section');
            if (isSectionCompleted(sectionId)) {
                updateProgressIndicator(sectionId, 'completed');
            }
        });
    }

    // Function to populate form with loaded data
    function populateFormWithData(data) {
        // Handle arrays
        if (data.informant) {
            data.informant.forEach(function(value) {
                $(`input[name="informant[]"][value="${value}"]`).prop('checked', true);
            });
        }

        if (data.childhood_illness) {
            Object.keys(data.childhood_illness).forEach(function(illness) {
                $(`#${illness}`).prop('checked', true);
                $(`#${illness}-details`).show();
                if (data.childhood_illness[illness].year) {
                    $(`select[name="${illness}_year"]`).val(data.childhood_illness[illness].year);
                }
                if (data.childhood_illness[illness].complications) {
                    $(`input[name="${illness}_complications"]`).val(data.childhood_illness[illness].complications);
                }
            });
        }

        if (data.adult_illness) {
            data.adult_illness.forEach(function(illness) {
                $(`#${illness}`).prop('checked', true);
                $(`#${illness}-details`).show();
            });
        }

        if (data.family_illness) {
            data.family_illness.forEach(function(illness) {
                $(`#family_${illness}`).prop('checked', true);
                $(`#family_${illness}-details`).show();
            });
        }

        if (data.other_conditions) {
            data.other_conditions.forEach(function(condition) {
                $(`input[name="other_conditions[]"][value="${condition}"]`).prop('checked', true);
            });
        }

        if (data.family_other_conditions) {
            data.family_other_conditions.forEach(function(condition) {
                $(`input[name="family_other_conditions[]"][value="${condition}"]`).prop('checked', true);
            });
        }

        if (data.menstrual_symptoms) {
            data.menstrual_symptoms.forEach(function(symptom) {
                $(`input[name="menstrual_symptoms[]"][value="${symptom}"]`).prop('checked', true);
            });
        }

        if (data.contraceptive_methods) {
            data.contraceptive_methods.forEach(function(method) {
                $(`input[name="contraceptive_methods[]"][value="${method}"]`).prop('checked', true);
            });
        }

        // Load contraceptive detail fields - ensure they're loaded
        if (data.contraceptive_pills_details) {
            $('#contraceptive_pills_details').val(data.contraceptive_pills_details);
            // Ensure the container is visible if there's data
            if (data.contraceptive_pills_details.trim() !== '') {
                $('#pills_details').show();
            }
        }
        if (data.contraceptive_depo_details) {
            $('#contraceptive_depo_details').val(data.contraceptive_depo_details);
            // Ensure the container is visible if there's data
            if (data.contraceptive_depo_details.trim() !== '') {
                $('#depo_details').show();
            }
        }
        if (data.contraceptive_implant_details) {
            $('#contraceptive_implant_details').val(data.contraceptive_implant_details);
            // Ensure the container is visible if there's data
            if (data.contraceptive_implant_details.trim() !== '') {
                $('#implant_details').show();
            }
        }

        // Initialize contraceptive method toggles after both checkboxes and values are set
        if (typeof window.initializeContraceptiveToggles === 'function') {
            setTimeout(function() {
                window.initializeContraceptiveToggles();
            }, 50); // Small delay to ensure DOM is updated
        }

        if (data.psychiatric_illness) {
            data.psychiatric_illness.forEach(function(illness) {
                $(`input[name="psychiatric_illness[]"][value="${illness}"]`).prop('checked', true);
            });
        }

        if (data.alternative_therapies) {
            data.alternative_therapies.forEach(function(therapy) {
                $(`input[name="alternative_therapies[]"][value="${therapy}"]`).prop('checked', true);
            });
        }

        // Handle boolean fields and show/hide details
        if (data.cigarette_user) {
            $('#cigarette_user').prop('checked', true);
            $('#cigarette-details').show();
        }
        if (data.alcohol_drinker) {
            $('#alcohol_drinker').prop('checked', true);
            $('#alcohol-details').show();
        }
        if (data.drug_user) {
            $('#drug_user').prop('checked', true);
            $('#drug-details').show();
        }
        if (data.coffee_user) {
            $('#coffee_user').prop('checked', true);
            $('#coffee-details').show();
        }

        // Handle hospitalization data
        if (data.hospitalization && data.hospitalization.length > 0) {
            $('#hospitalizationTable tbody').empty(); // Clear existing rows
            data.hospitalization.forEach(function(hospital) {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="hospitalization_year[]" value="${hospital.year || ''}"></td>
                        <td><input type="text" class="form-control" name="hospitalization_diagnosis[]" value="${hospital.diagnosis || ''}"></td>
                        <td><input type="text" class="form-control" name="hospitalization_notes[]" value="${hospital.notes || ''}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#hospitalizationTable tbody').append(newRow);
            });
        }

        // Handle surgical history data
        if (data.surgical_history && data.surgical_history.length > 0) {
            $('#surgicalTable tbody').empty(); // Clear existing rows
            data.surgical_history.forEach(function(surgery) {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="surgical_year[]" value="${surgery.year || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_diagnosis[]" value="${surgery.diagnosis || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_procedure[]" value="${surgery.procedure || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_biopsy[]" value="${surgery.biopsy || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_notes[]" value="${surgery.notes || ''}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#surgicalTable tbody').append(newRow);
            });
        }

        // Handle covid vaccination data
        if (data.covid_vaccination) {
            $('input[name="covid_year"]').val(data.covid_vaccination.year || '');
            $('input[name="covid_brand"]').val(data.covid_vaccination.brand || '');
            $('input[name="covid_boosters"]').val(data.covid_vaccination.boosters || '');
        }

        // Handle Other vaccinations data
        if (data.other_vaccinations) {
            $('input[name="pcv_vaccine"]').val(data.other_vaccinations.pcv || '');
            $('input[name="flu_vaccine"]').val(data.other_vaccinations.flu || '');
            $('input[name="hepb_vaccine"]').val(data.other_vaccinations.hepb || '');
            $('input[name="hpv_vaccine"]').val(data.other_vaccinations.hpv || '');
            $('input[name="other_vaccines"]').val(data.other_vaccinations.others || '');
        }

        // Handle past pregnancy data (matches JSON column `past_pregnancies`)
        if (data.past_pregnancies && data.past_pregnancies.length > 0) {
            $('#pastPregnancyTable tbody').empty(); // Clear existing rows

            data.past_pregnancies.forEach(function (pregnancy) {
                const sex = pregnancy.sex || ''; 
                const mod = pregnancy.manner_of_delivery || ''; 
                const comp = pregnancy.disposition_complications || '';

                let newRow = `
                    <tr>
                        <td>
                            <input type="text" class="form-control"
                                name="past_pregnancy_number[]"
                                value="${pregnancy.number ?? ''}">
                        </td>

                        <td>
                            <select class="form-control" name="past_pregnancy_sex[]">
                                <option value="">Select</option>
                                <option value="Male" ${sex === 'Male' ? 'selected' : ''}>Male</option>
                                <option value="Female" ${sex === 'Female' ? 'selected' : ''}>Female</option>
                                <option value="Unknown" ${sex === 'Unknown' ? 'selected' : ''}>Unknown</option>
                            </select>
                        </td>

                        <td>
                            <select class="form-control" name="past_pregnancy_manner_of_delivery[]">
                                <option value="">Select</option>
                                <option value="Normal Spontaneous Delivery" ${mod === 'Normal Spontaneous Delivery' ? 'selected' : ''}>Normal Spontaneous Delivery</option>
                                <option value="Cesarean Section" ${mod === 'Cesarean Section' ? 'selected' : ''}>Cesarean Section</option>
                                <option value="Vacuum Extraction" ${mod === 'Vacuum Extraction' ? 'selected' : ''}>Vacuum Extraction</option>
                                <option value="Forceps Delivery" ${mod === 'Forceps Delivery' ? 'selected' : ''}>Forceps Delivery</option>
                                <option value="Breech Delivery" ${mod === 'Breech Delivery' ? 'selected' : ''}>Breech Delivery</option>
                                <option value="Other" ${mod === 'Other' ? 'selected' : ''}>Other</option>
                            </select>
                        </td>

                        <td>
                            <input type="text" class="form-control"
                                name="past_pregnancy_disposition_complications[]"
                                value="${comp}">
                        </td>

                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#pastPregnancyTable tbody').append(newRow);
            });
        } else {
            // show one empty row if there’s no data yet
            const emptyRow = `
                <tr>
                    <td><input type="text" class="form-control" name="past_pregnancy_number[]" value=""></td>
                    <td>
                        <select class="form-control" name="past_pregnancy_sex[]">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="past_pregnancy_manner_of_delivery[]">
                            <option value="">Select</option>
                            <option value="Normal Spontaneous Delivery">Normal Spontaneous Delivery</option>
                            <option value="Cesarean Section">Cesarean Section</option>
                            <option value="Vacuum Extraction">Vacuum Extraction</option>
                            <option value="Forceps Delivery">Forceps Delivery</option>
                            <option value="Breech Delivery">Breech Delivery</option>
                            <option value="Other">Other</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="past_pregnancy_disposition_complications[]" value=""></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('#pastPregnancyTable tbody').html(emptyRow);
        }

        // (Removed event handler binding for .remove-row from here)
        // Handle simple text fields
        Object.keys(data).forEach(function(key) {
            if (!['informant', 'childhood_illness', 'adult_illness', 'family_illness', 'other_conditions',
                  'family_other_conditions', 'menstrual_symptoms', 'contraceptive_methods',
                  'contraceptive_pills_details', 'contraceptive_depo_details', 'contraceptive_implant_details',
                  'psychiatric_illness', 'alternative_therapies', 'cigarette_user', 'alcohol_drinker',
                  'drug_user', 'coffee_user', 'hospitalization', 'surgical_history', 'past_pregnancy',
                  'id', 'patient_id', 'created_at', 'updated_at'].includes(key)) {

                var element = $(`[name="${key}"]`);
                if (element.length > 0) {
                    if (element.is(':checkbox')) {
                        element.prop('checked', Boolean(data[key]));
                    } else {
                        element.val(data[key]);
                    }
                }
            }
        });

        // Ensure dependent UI reacts to current smoker/drinker/drug-user values after population
        if (Object.prototype.hasOwnProperty.call(data, 'current_smoker')) {
            const $cs = $('#current_smoker');
            if ($cs.length) { $cs.prop('checked', Boolean(data.current_smoker)).trigger('change'); }
        }
        if (Object.prototype.hasOwnProperty.call(data, 'current_drinker')) {
            const $cd = $('#current_drinker');
            if ($cd.length) { $cd.prop('checked', Boolean(data.current_drinker)).trigger('change'); }
        }
        if (Object.prototype.hasOwnProperty.call(data, 'current_drug_user')) {
            const $cdu = $('#current_drug_user');
            if ($cdu.length) { $cdu.prop('checked', Boolean(data.current_drug_user)).trigger('change'); }
        }

        // Handle complex nested data for adult illnesses
        ['hypertension', 'diabetes', 'bronchial_asthma'].forEach(function(illness) {
            Object.keys(data).forEach(function(key) {
                if (key.startsWith(illness + '_') && key !== illness + '_user') {
                    $(`[name="${key}"]`).val(data[key]);
                }
            });
        });

        // Handle family illness nested data
        ['hypertension', 'diabetes', 'asthma', 'cancer'].forEach(function(illness) {
            Object.keys(data).forEach(function(key) {
                if (key.includes('_family_') || key.includes('_relation') || key.includes('_side')) {
                    $(`[name="${key}"]`).val(data[key]);
                }
            });
        });
    }

    // Initially hide all illness details
    $('.illness-details').hide();
    $('.family-illness-details').hide();
    $('#cigarette-details').hide();
    $('#alcohol-details').hide();
    $('#drug-details').hide();
    $('#coffee-details').hide();

    // Show/hide illness details when checkboxes are clicked
    $('.childhood-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    $('.adult-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    $('.family-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    // Show/hide habits details with auto-save
    $('#cigarette_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#cigarette-details').show();
        } else {
            $('#cigarette-details').hide();
            // Clear the form fields when unchecked
            $('#cigarette-details input, #cigarette-details select').val('');
            $('#current_smoker').prop('checked', false);
        }
        autoSaveForm(); // Trigger auto-save
    });

    $('#alcohol_drinker').on('change', function() {
        if($(this).is(':checked')) {
            $('#alcohol-details').show();
        } else {
            $('#alcohol-details').hide();
            // Clear the form fields when unchecked
            $('#alcohol-details input, #alcohol-details select').val('');
            $('#current_drinker').prop('checked', false);
        }
        autoSaveForm(); // Trigger auto-save
    });

    $('#drug_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#drug-details').show();
        } else {
            $('#drug-details').hide();
            // Clear the form fields when unchecked
            $('#drug-details input, #drug-details select').val('');
            $('#current_drug_user').prop('checked', false);
        }
        autoSaveForm(); // Trigger auto-save
    });

    $('#coffee_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#coffee-details').show();
        } else {
            $('#coffee-details').hide();
            // Clear the form fields when unchecked
            $('#coffee-details input, #coffee-details select').val('');
        }
        autoSaveForm(); // Trigger auto-save
    });

    // Calculate smoking pack years with auto-save
    $('#sticks_per_day, #cigarette_year_started, #cigarette_year_discontinued, #current_smoker').on('change', function() {
        calculatePackYears();
        autoSaveForm(); // Trigger auto-save after calculation
    });

    function calculatePackYears() {
        let sticksPerDay = parseFloat($('#sticks_per_day').val()) || 0;
        let yearStarted = parseInt($('input[name="cigarette_year_started"]').val());
        let yearDiscontinued = parseInt($('input[name="cigarette_year_discontinued"]').val());
        let currentSmoker = $('#current_smoker').is(':checked');

        if (yearStarted) {
            let yearsSmoking;
            if (currentSmoker) {
                yearsSmoking = new Date().getFullYear() - yearStarted;
            } else if (yearDiscontinued) {
                yearsSmoking = yearDiscontinued - yearStarted;
            } else {
                yearsSmoking = 0;
            }

            if (yearsSmoking > 0) {
                $('#years_smoking').val(yearsSmoking);

                // Calculate pack years: (sticks per day / 20) * years smoking
                let packYears = (sticksPerDay / 20) * yearsSmoking;
                $('#pack_years').val(packYears.toFixed(2));
            }
        }
    }

    // Add row to hospitalization table
    $('#addHospitalizationRow').on('click', function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="hospitalization_year[]"></td>
                <td><input type="text" class="form-control" name="hospitalization_diagnosis[]"></td>
                <td><input type="text" class="form-control" name="hospitalization_notes[]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#hospitalizationTable tbody').append(newRow);
    });

    // Add row to surgical table
    $('#addSurgicalRow').on('click', function() {
            let newRow = `
                <tr>
                    <td><input type="text" class="form-control" name="surgical_year[]"></td>
                    <td><input type="text" class="form-control" name="surgical_diagnosis[]"></td>
                    <td><input type="text" class="form-control" name="surgical_procedure[]"></td>
                    <td><input type="text" class="form-control" name="surgical_biopsy[]"></td>
                    <td><input type="text" class="form-control" name="surgical_notes[]"></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('#surgicalTable tbody').append(newRow);
        });
        $(document).off('click.addPP').on('click.addPP', '#addPregnancyRow', function (e) {
    e.preventDefault();
    const row = `
        <tr>
        <td><input type="text" class="form-control" name="past_pregnancy_number[]"></td>
        <td>
            <select class="form-control" name="past_pregnancy_sex[]">
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Unknown">Unknown</option>
            </select>
        </td>
        <td>
            <select class="form-control" name="past_pregnancy_manner_of_delivery[]">
            <option value="">Select</option>
            <option value="Normal Spontaneous Delivery">Normal Spontaneous Delivery</option>
            <option value="Cesarean Section">Cesarean Section</option>
            <option value="Vacuum Extraction">Vacuum Extraction</option>
            <option value="Forceps Delivery">Forceps Delivery</option>
            <option value="Breech Delivery">Breech Delivery</option>
            <option value="Other">Other</option>
            </select>
        </td>
        <td><input type="text" class="form-control" name="past_pregnancy_disposition_complications[]"></td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm remove-row">
            <i class="fa-solid fa-trash"></i>
            </button>
        </td>
        </tr>`;
    $('#pastPregnancyTable tbody').append(row);
    });

    // delegated remove (single binding)
    $(document).off('click.removePP').on('click.removePP', '#pastPregnancyTable .remove-row', function (e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    });

    // Auto-save functionality with improved timing
    let autoSaveTimeout;
    let throttleTimeout;
    let isThrottling = false;
    let lastSaveTime = 0;
    let pendingSave = false;
    
    const DEBOUNCE_DELAY = 1500; // 1.5 seconds after user stops typing
    const THROTTLE_DELAY = 4000; // 4 seconds during continuous typing
    const MIN_SAVE_INTERVAL = 2000; // Minimum 2 seconds between saves
    
    function autoSaveForm(forceImmediate = false) {
        const now = Date.now();
        
        // Clear existing timeouts
        clearTimeout(autoSaveTimeout);
        clearTimeout(throttleTimeout);
        
        // If forcing immediate save or enough time has passed since last save
        if (forceImmediate || (now - lastSaveTime >= MIN_SAVE_INTERVAL)) {
            performSave();
            return;
        }
        
        // Mark that we have a pending save
        pendingSave = true;
        
        // Show saving indicator
        $('#autoSaveStatus').show();
        $('#autoSaveText').text('Saving...');
        $('#autoSaveStatus i').removeClass('fa-check').addClass('fa-circle-notch fa-spin');
        
        // Set up debounced save (after user stops typing)
        autoSaveTimeout = setTimeout(function() {
            if (pendingSave) {
                performSave();
            }
        }, DEBOUNCE_DELAY);
        
        // Set up throttled save (during continuous typing)
        if (!isThrottling) {
            isThrottling = true;
            throttleTimeout = setTimeout(function() {
                if (pendingSave) {
                    performSave();
                }
                isThrottling = false;
            }, THROTTLE_DELAY);
        }
    }
    
    function performSave() {
        // Reset flags
        pendingSave = false;
        lastSaveTime = Date.now();
        
        // Clear timeouts
        clearTimeout(autoSaveTimeout);
        clearTimeout(throttleTimeout);
        isThrottling = false;
        
        // Show saving indicator
        $('#autoSaveStatus').show();
        $('#autoSaveText').text('Saving...');
        $('#autoSaveStatus i').removeClass('fa-check').addClass('fa-circle-notch fa-spin');
        
        let formData = $('#comprehensiveHistoryForm').serialize();
        
        $.ajax({
            url: '/patients/' + $('input[name="patient_id"]').val() + '/comprehensive-history',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Show success indicator briefly
                    $('#autoSaveText').text('Saved');
                    $('#autoSaveStatus i').removeClass('fa-circle-notch fa-spin').addClass('fa-check');
                    
                    // Hide saving indicator after a brief moment
                    setTimeout(function() {
                        $('#autoSaveStatus').fadeOut(300);
                    }, 1000);
                    
                    // Visual feedback for auto-save using unified styling
                    updateButtonState('success', '<i class="fa fa-check me-1"></i> Auto-saved');
                    
                    // Reset to default state after delay
                    setTimeout(function() {
                        if (!hasUnsavedChanges) {
                            updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
                        }
                    }, 2000);
                    
                    // Update all progress indicators after saving
                    updateAllProgressIndicators();
                    
                    // Mark form as saved
                    markFormAsSaved();
                }
            },
            error: function(xhr) {
                // Show error indicator
                $('#autoSaveText').text('Save failed - retrying...');
                $('#autoSaveStatus i').removeClass('fa-circle-notch fa-spin fa-check').addClass('fa-exclamation-triangle');
                
                setTimeout(function() {
                    $('#autoSaveStatus').fadeOut(300);
                }, 3000);
                
                console.error('Auto-save failed:', xhr.responseJSON?.message || 'Unknown error');
                
                // Show error feedback using unified styling
                updateButtonState('error', '<i class="fa fa-exclamation-triangle me-1"></i> Save Failed');
                
                // Reset to appropriate state after delay
                setTimeout(function() {
                    if (hasUnsavedChanges) {
                        updateButtonState('changed', '<i class="fa fa-save me-1"></i> Save Changes');
                    } else {
                        updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
                    }
                }, 3000);
                
                // Retry after a delay if there's still pending changes
                setTimeout(function() {
                    // Only retry if we still have unsaved changes
                    const formData = $('#comprehensiveHistoryForm').serialize();
                    if (formData && formData.length > 0) {
                        pendingSave = true;
                        autoSaveForm(true);
                    }
                }, 5000);
            }
        });
    }
    
    // Track form changes
    let hasUnsavedChanges = false;
    
    // Unified button state management
    function updateButtonState(state, text) {
        const $btn = $('#saveComprehensiveHistoryBtn');
        
        // Remove all possible classes
        $btn.removeClass('btn-light btn-outline-warning btn-success btn-danger btn-primary btn-info btn-secondary');
        
        // Apply appropriate class and text based on state
        switch(state) {
            case 'default':
                $btn.addClass('btn-secondary').html(text).prop('disabled', true);
                break;
            case 'changed':
                $btn.addClass('btn-outline-warning').html(text).prop('disabled', false);
                break;
            case 'saving':
                $btn.addClass('btn-primary').html(text).prop('disabled', true);
                break;
            case 'success':
                $btn.addClass('btn-success').html(text).prop('disabled', false);
                break;
            case 'error':
                $btn.addClass('btn-danger').html(text).prop('disabled', false);
                break;
            case 'auto-saving':
                $btn.addClass('btn-info').html(text).prop('disabled', false);
                break;
            case 'loading':
                $btn.addClass('btn-secondary').html(text).prop('disabled', true);
                break;
        }
    }
    
    function markFormAsChanged() {
        if (!hasUnsavedChanges) {
            hasUnsavedChanges = true;
            // Visual indicator that form has unsaved changes using unified styling
            updateButtonState('changed', '<i class="fa fa-save me-1"></i> Save Changes');
        }
    }
    
    function markFormAsSaved() {
        hasUnsavedChanges = false;
        // Remove change indicator using unified styling
        setTimeout(function() {
            if (!hasUnsavedChanges) {
                updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
            }
        }, 2000);
    }
    
    // Bind auto-save to form inputs with different strategies
    $('#comprehensiveHistoryForm').on('input', 'input[type="text"], input[type="number"], input[type="email"], input[type="password"], textarea', function() {
        markFormAsChanged();
        autoSaveForm(); // Use debounce + throttle for text inputs
    });
    
    $('#comprehensiveHistoryForm').on('change', 'select, input[type="checkbox"], input[type="radio"]', function() {
        markFormAsChanged();
        autoSaveForm(true); // Immediate save for discrete changes
    });
    
    // Prevent accidental navigation when there are unsaved changes
    window.addEventListener('beforeunload', function(e) {
        if (hasUnsavedChanges) {
            e.preventDefault();
            e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
            return e.returnValue;
        }
    });
    
    // Failsafe: Reset button state if it gets stuck
    setInterval(function() {
        const $btn = $('#saveComprehensiveHistoryBtn');
        
        // If button is disabled but not in default, saving, or loading state, check if it should be enabled
        if ($btn.prop('disabled') && !$btn.hasClass('btn-primary') && !$btn.hasClass('btn-secondary')) {
            // If button is disabled but not in saving, default, or loading state, re-enable it
            $btn.prop('disabled', false);
        }
        
        // If button shows saving state but no actual save is in progress
        if ($btn.hasClass('btn-primary') && !pendingSave && (Date.now() - lastSaveTime > 10000)) {
            if (hasUnsavedChanges) {
                updateButtonState('changed', '<i class="fa fa-save me-1"></i> Save Changes');
            } else {
                updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
            }
        }
        
        // If button shows loading state for too long (more than 30 seconds), reset it
        if ($btn.html().includes('Loading...') && (Date.now() - lastSaveTime > 30000)) {
            updateButtonState('default', '<i class="fa fa-save me-1"></i> Save');
            $('#autoSaveStatus').fadeOut(300);
        }
    }, 5000); // Check every 5 seconds

    // Form submission - force immediate save
    $('#saveComprehensiveHistoryBtn').on('click', function() {
        // Clear any pending auto-saves and force immediate save
        clearTimeout(autoSaveTimeout);
        clearTimeout(throttleTimeout);
        pendingSave = true;
        
        // Show manual save in progress using unified styling
        updateButtonState('saving', '<i class="fa fa-circle-notch fa-spin me-1"></i> Saving...');
        
        let formData = $('#comprehensiveHistoryForm').serialize();

        $.ajax({
            url: '/patients/' + $('input[name="patient_id"]').val() + '/comprehensive-history',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Show success state using unified styling
                    updateButtonState('success', '<i class="fa fa-check me-1"></i> Saved Successfully!');
                    
                    // Update all progress indicators after saving
                    updateAllProgressIndicators();
                    
                    // Mark form as saved
                    markFormAsSaved();
                    
                    // Update last save time
                    lastSaveTime = Date.now();
                    pendingSave = false;
                    
                } else {
                    // Show error state using unified styling
                    updateButtonState('error', '<i class="fa fa-exclamation-triangle me-1"></i> Save Failed');
                    
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                // Show error state using unified styling
                updateButtonState('error', '<i class="fa fa-exclamation-triangle me-1"></i> Save Failed');
                
                alert('Error saving comprehensive history: ' + (xhr.responseJSON?.message || 'Unknown error'));
            }
        });
    });
});
</script>

{{-- Include File Upload and Viewer Modals --}}
@include('patients.comprehensive_history.components.file_modals')
