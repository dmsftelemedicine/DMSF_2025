@props(['patient', 'consultationId' => null])

<style>
    .active-row {
        background-color: #e3f2fd !important;
        font-weight: bold;
    }
    
    .consultation-date-input.is-loading {
        background-color: #f8f9fa;
        opacity: 0.7;
        cursor: wait;
    }
    
    .consultation-date-input.is-valid {
        border-color: #28a745;
        background-color: #d4edda;
    }
    
    .consultation-date-input.is-invalid {
        border-color: #dc3545;
        background-color: #f8d7da;
    }
</style>

<!-- Screening Tool Form Section Start -->
<div id="screeningtool-form-section">
    <input type="hidden" id="consultation_id" name="consultation_id" value="{{ $consultationId }}">
    <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient->id }}">
    <div class="row">
        <div class="col-12">
            <x-progress-bar 
                :steps="[
                    [
                        'title' => 'Nutrition', 
                        'subtitle' => 'Dietary assessment'
                    ],
                    [
                        'title' => 'Physical Activity', 
                        'subtitle' => 'Exercise evaluation'
                    ],
                    [
                        'title' => 'Quality of Life', 
                        'subtitle' => 'Wellness screening'
                    ],
                    [
                        'title' => 'Telemedicine Perception', 
                        'subtitle' => 'Technology assessment'
                    ]
                ]"
                :active-step="1"
                :completed-steps="[]"
                id="ld-screening-progress"
                type="arrow"
                :enable-click="true"
                container-class="progress-tabs">
                
                <div class="progress-section active" id="step-1">
                    @include('patients.screeningtool.forms.nutrition_tab')
                </div>
                
                <div class="progress-section" id="step-2">
                    @include('patients.screeningtool.forms.physical_activity_form')
                </div>
                
                <div class="progress-section" id="step-3">
                    @include('patients.screeningtool.forms.quality_life_tab')
                </div>
                
                <div class="progress-section" id="step-4">
                    @include('patients.screeningtool.forms.telemedicine_perception_result')
                </div>
            </x-progress-bar>
        </div>
    </div>
</div>
<!-- Screening Tool Form Section End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize consultation mode
        window.consultationMode = true;
        
        // Set consultation and patient IDs
        var consultationId = {{ $consultationId ?? 'null' }};
        var patientId = {{ $patient->id }};
        
        // Set hidden fields in all screening tool forms
        $('#consultation_id').val(consultationId);
        $('#patient_id').val(patientId);
        $('#nutrition_consultation_id').val(consultationId);
        $('#qol_consultation_id').val(consultationId);
        $('#tp_consultation_id').val(consultationId);
        $('#pa_consultation_id').val(consultationId);
        
        // Load existing data for this consultation if consultationId is provided
        if (consultationId) {
            loadConsultationData(consultationId);
        }

        // Function to check and mark completed steps
        function checkCompletedSteps() {
            // Map step types to step numbers (updated for new structure)
            const stepMapping = {
                'nutrition': 1,
                'physical-activity': 2,
                'quality-of-life': 3,
                'telemedicine-perception': 4
            };
            
            const completedSteps = [];
            
            // Check each step for saved data
            Object.keys(stepMapping).forEach(stepType => {
                if (checkStepCompletion(stepType)) {
                    completedSteps.push(stepMapping[stepType]);
                }
            });
            
            // Update the progress bar with completed steps
            ProgressBar.markCompleted('ld-screening-progress', completedSteps);
        }

        // Make checkCompletedSteps available globally for debugging
        window.checkCompletedSteps = checkCompletedSteps;

        function checkStepCompletion(stepType) {
            let hasData = false;
            
            // Check specifically for saved data in each section
            if (stepType === 'nutrition') {
                // Check if nutrition results table has data rows (excluding "No data" messages)
                const nutritionRows = $('#nutrition-results-tbody tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    // Has data if it's not a "no data" message and has multiple columns
                    return !text.includes('no nutrition data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = nutritionRows.length > 0;
                
            } else if (stepType === 'physical-activity') {
                // Check if physical activity results table has data
                const paRows = $('#physical-activity-results-tbody tr, #PhysicalActivityTable tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    return !text.includes('no physical activity data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = paRows.length > 0;
                
            } else if (stepType === 'quality-of-life') {
                // Check if quality of life results table has data
                const qolRows = $('#qualityOfLifeTableBody tr, #qol-results-tbody tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    return !text.includes('no quality of life data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = qolRows.length > 0;
                
            } else if (stepType === 'telemedicine-perception') {
                // Check if telemedicine perception results table has data
                const tpRows = $('#telemedicine-perception-results-tbody tr, #telemedicine-results-table tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    return !text.includes('no telemedicine perception data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = tpRows.length > 0;
            }
            
            return hasData;
        }

        // Check completed steps on page load (multiple times to ensure all data is loaded)
        setTimeout(checkCompletedSteps, 1000);
        setTimeout(checkCompletedSteps, 2000);
        setTimeout(checkCompletedSteps, 3000);

        // Listen for progress step changes from the new component
        document.addEventListener('progressStepChanged', function(event) {
            if (event.detail.progressId === 'ld-screening-progress') {
                // Check completed steps after switching
                setTimeout(checkCompletedSteps, 200);
            }
        });
        

        // Initialize progress tracking
        $('.list-group-item').on('shown.bs.tab', function (e) {
            let currentStep = parseInt($(this).find('.step-number').text());
            
            // Mark all previous steps as completed
            $('.list-group-item').each(function() {
                let stepNum = parseInt($(this).find('.step-number').text());
                if (stepNum < currentStep) {
                    $(this).addClass('completed');
                } else if (stepNum > currentStep) {
                    $(this).removeClass('completed');
                }
            });
        });
    });
</script>