<div class="container-fluid">
    <!-- Main Sleep Assessment Container -->
    <div id="sleep-assessment-container">
        <!-- Initial Sleep Assessment Section -->
        <div id="sleep-initial-assessment">
            @include('patients.otherlmandvs.sleepforms.initial_assessment', ['patient' => $patient])
        </div>

        <!-- ISI-7 Assessment Section -->
        <div id="isi7-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.isi7_assessment', ['patient' => $patient])
        </div>

        <!-- ESS-8 Assessment Section -->
        <div id="ess8-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.ess8_assessment', ['patient' => $patient])
        </div>

        <!-- SHI-13 Assessment Section -->
        <div id="shi13-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.shi13_assessment', ['patient' => $patient])
        </div>

        <!-- STOP-BANG Assessment Section -->
        <div id="stopbang-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.stopbang_assessment', ['patient' => $patient])
        </div>
    </div>
</div>

<script>
// Global functions for navigation between sleep assessments
function showISI7() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').show();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').hide();
    
    // Load ISI-7 data if available
    if (typeof loadISI7Data === 'function') {
        loadISI7Data();
    }
}

function showESS8() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').show();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').hide();
    
    // Load ESS-8 data if available
    if (typeof loadESS8Data === 'function') {
        loadESS8Data();
    }
}

function showSHI13() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').show();
    $('#stopbang-assessment').hide();
    
    // Load SHI-13 data if available
    if (typeof loadSHI13Data === 'function') {
        loadSHI13Data();
    }
}

function showSTOPBANG() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').show();
    
    // Load STOP-BANG data if available
    if (typeof loadSTOPBANGData === 'function') {
        loadSTOPBANGData();
    }
}

function backToSleepInitial() {
    $('#sleep-initial-assessment').show();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').hide();
}

// Initialize the sleep assessment system
$(document).ready(function() {
    // Show initial assessment by default
    $('#sleep-initial-assessment').show();
    
    // Initialize the initial assessment form functionality
    initializeSleepInitialForm();
    
    // Listen for consultation changes
    document.addEventListener('lifestyleMeasuresConsultationChanged', function(event) {
        const { consultationId, consultationNumber } = event.detail;
        handleConsultationChange(consultationId, consultationNumber);
    });
});

// Initialize sleep initial form functionality
function initializeSleepInitialForm() {
    // Form submission
    $('#sleep-initial-form').on('submit', function(e) {
        e.preventDefault();
        submitSleepInitialAssessment();
    });

    // Evaluation button
    $('#evaluate-sleep-btn').on('click', function() {
        evaluateSleepAssessment();
    });

    // Auto-calculate sleep duration when times change
    $('#sleep_time, #wake_up_time').on('change', function() {
        calculateSleepDuration();
    });

    // Populate physical measurements on initialization
    populatePhysicalMeasurements();

    // Load existing sleep data if available
    loadExistingSleepData();
}

function loadExistingSleepData() {
    const consultationId = window.lifestyleMeasuresConsultation?.id || window.currentConsultationId;
    
    if (!consultationId) {
        console.log('No consultation ID available for loading sleep data');
        return;
    }
    
    $.ajax({
        url: '{{ route("sleep-initial-assessments.show", $patient->id) }}',
        type: 'GET',
        data: {
            consultation_id: consultationId
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(response) {
        if (response.success && response.data) {
            populateFormWithExistingData(response.data);
        }
    }).fail(function() {
        // No existing data found, which is fine
        console.log('No existing sleep data found for consultation', consultationId);
    });
}

function populateFormWithExistingData(data) {
    // Fill form fields with existing data
    if (data.sleep_time) {
        $('#sleep_time').val(data.sleep_time.substring(0, 5));
    }
    if (data.wake_up_time) {
        $('#wake_up_time').val(data.wake_up_time.substring(0, 5));
    }
    if (data.usual_sleep_duration) {
        $('#usual_sleep_duration').val(data.usual_sleep_duration);
    }
    if (data.sleep_quality_rating) {
        $('#sleep_quality_rating').val(data.sleep_quality_rating);
    }
    if (data.daytime_sleepiness) {
        $(`input[name="daytime_sleepiness"][value="${data.daytime_sleepiness}"]`).prop('checked', true);
    }
    
    // Handle hygiene activities (array)
    if (data.hygiene_activities && Array.isArray(data.hygiene_activities)) {
        data.hygiene_activities.forEach(activity => {
            $(`input[name="hygiene_activities[]"][value="${activity}"]`).prop('checked', true);
        });
    }
}

function calculateSleepDuration() {
    const sleepTime = $('#sleep_time').val();
    const wakeTime = $('#wake_up_time').val();
    
    if (sleepTime && wakeTime) {
        const sleep = new Date(`2000-01-01T${sleepTime}`);
        let wake = new Date(`2000-01-01T${wakeTime}`);
        
        // If wake time is before sleep time, it's the next day
        if (wake <= sleep) {
            wake.setDate(wake.getDate() + 1);
        }
        
        const duration = (wake - sleep) / (1000 * 60 * 60); // Convert to hours
        $('#usual_sleep_duration').val(duration.toFixed(1));
    }
}

function submitSleepInitialAssessment() {
    const consultationId = window.lifestyleMeasuresConsultation?.id || window.currentConsultationId;
    
    if (!consultationId) {
        alert('No active consultation selected. Please select a consultation first.');
        return;
    }
    
    const formData = new FormData($('#sleep-initial-form')[0]);
    formData.append('consultation_id', consultationId);
    
    $.ajax({
        url: '{{ route("sleep-initial-assessments.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                alert('Sleep assessment saved successfully!');
                // Optionally reload data
                loadExistingSleepData();
            }
        },
        error: function(xhr) {
            alert('Error saving assessment. Please try again.');
        }
    });
}

function evaluateSleepAssessment() {
    // Get form values
    const sleepDuration = parseFloat($('#usual_sleep_duration').val()) || 0;
    const sleepQuality = parseInt($('#sleep_quality_rating').val()) || 0;
    const daytimeSleepiness = $('input[name="daytime_sleepiness"]:checked').val();
    const hygieneActivities = $('input[name="hygiene_activities[]"]:checked').map(function() {
        return $(this).val();
    }).get();

    // Get objective features (from read-only fields)
    const bloodPressure = $('#blood_pressure').val();
    const bmi = parseFloat($('#bmi').val()) || 0;
    const age = parseInt($('#age').val()) || 0;
    const neckCircumference = parseFloat($('#neck_circumference').val()) || 0;
    const gender = $('#gender').val();

    let recommendations = [];

    // ISI-7 Logic
    if (sleepDuration < 7 || sleepQuality < 6) {
        recommendations.push({
            title: 'Insomnia Severity Index (ISI-7)',
            description: 'Recommended due to short sleep duration or poor sleep quality.',
            action: 'showISI7()',
            color: 'primary'
        });
    }

    // ESS-8 Logic
    if (daytimeSleepiness === 'yes') {
        recommendations.push({
            title: 'Epworth Sleepiness Scale (ESS-8)',
            description: 'Recommended due to reported daytime sleepiness.',
            action: 'showESS8()',
            color: 'warning'
        });
    }

    // SHI-13 Logic
    if (hygieneActivities.length > 0) {
        recommendations.push({
            title: 'Sleep Hygiene Index (SHI-13)',
            description: 'Recommended due to poor sleep hygiene practices.',
            action: 'showSHI13()',
            color: 'info'
        });
    }

    // STOP-BANG Logic (only if physical measurements are available)
    if (bloodPressure !== '—' || bmi > 0 || neckCircumference > 0) {
        let hasPBangFeatures = false;
        if (bloodPressure && bloodPressure !== '—' && bloodPressure.includes('/')) {
            const [systolic, diastolic] = bloodPressure.split('/').map(Number);
            if (systolic > 130 || diastolic > 90) hasPBangFeatures = true;
        }
        if (bmi > 35 || age > 50 || neckCircumference > 40 || gender === 'male') {
            hasPBangFeatures = true;
        }

        if (hasPBangFeatures) {
            recommendations.push({
                title: 'STOP-BANG Score for Obstructive Sleep Apnea',
                description: 'Recommended due to risk factors for sleep apnea.',
                action: 'showSTOPBANG()',
                color: 'danger'
            });
        }
    }

    // Display recommendations
    displaySleepRecommendations(recommendations);
}

function displaySleepRecommendations(recommendations) {
    const container = $('#sleep-recommendations-list');
    
    if (recommendations.length === 0) {
        container.html('<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>No specific sleep assessments are recommended based on your responses.</div>');
    } else {
        let html = '<div class="row">';
        recommendations.forEach(function(rec, index) {
            html += `
                <div class="col-md-6 mb-3">
                    <div class="card border-${rec.color}">
                        <div class="card-header bg-${rec.color} text-white">
                            <h6 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>${rec.title}</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">${rec.description}</p>
                            <button type="button" class="btn btn-${rec.color} btn-sm" onclick="${rec.action}">
                                <i class="fas fa-play me-1"></i>Start Assessment
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        container.html(html);
    }
    
    $('#sleep-recommendation-area').show();
}

// Handle consultation changes
function handleConsultationChange(consultationId, consultationNumber) {
    console.log('Sleep assessment: Consultation changed to', consultationId, consultationNumber);
    
    // Update hidden consultation_id field
    $('#sleep-consultation-id').val(consultationId || '');
    
    // Clear form
    $('#sleep-initial-form')[0].reset();
    $('#sleep-consultation-id').val(consultationId || ''); // Restore after reset
    $('#sleep-recommendation-area').hide();
    
    // Populate physical measurements for new consultation
    populatePhysicalMeasurements();
    
    // Load data for new consultation
    loadExistingSleepData();
}

function populatePhysicalMeasurements() {
    const consultationId = window.lifestyleMeasuresConsultation?.id || window.currentConsultationId;
    const consultationNumber = window.lifestyleMeasuresConsultation?.number || window.currentConsultationNumber || 1;
    
    // Get measurements for the current consultation tab
    $.ajax({
        url: `/patients/{{ $patient->id }}/measurements/${consultationNumber}`,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(response) {
        const measurement = response.measurement;
        
        // BMI - calculate from measurement data if available, otherwise use patient data
        let bmi = '—';
        if (measurement && measurement.height && measurement.weight_kg) {
            bmi = (measurement.weight_kg / (measurement.height * measurement.height)).toFixed(1);
        } else {
            // Fallback to patient calculation
            const patientBMI = '{{ $patient->calculateBMI() }}';
            bmi = patientBMI !== 'N/A' ? patientBMI : '—';
        }
        $('#bmi').val(bmi);
        
        // Blood pressure from measurement data
        const bloodPressure = measurement?.blood_pressure || '—';
        $('#blood_pressure').val(bloodPressure);
        
        // Neck circumference from measurement data
        const neckCircumference = measurement?.neck_circumference || '—';
        $('#neck_circumference').val(neckCircumference);
        
        // Age - calculated from patient data (always available)
        const patientAge = '{{ $patient->age ?? "" }}';
        $('#age').val(patientAge || '—');
        
        // Gender - from patient data (always available)
        const patientGender = '{{ $patient->gender ?? "" }}';
        $('#gender').val(patientGender || '—');
        
        // Update consultation indicator
        $('#consultation-indicator').text(`(Using Consultation ${consultationNumber} data)`);
        
        console.log('Physical measurements populated for consultation', consultationNumber);
        
    }).fail(function(xhr) {
        console.log('Failed to load measurements, using fallback data');
        
        // Fallback to patient data
        const patientBMI = '{{ $patient->calculateBMI() }}';
        $('#bmi').val(patientBMI !== 'N/A' ? patientBMI : '—');
        
        const patientAge = '{{ $patient->age ?? "" }}';
        $('#age').val(patientAge || '—');
        
        const patientGender = '{{ $patient->gender ?? "" }}';
        $('#gender').val(patientGender || '—');
        
        // Set unknown values for missing data
        $('#blood_pressure').val('—');
        $('#neck_circumference').val('—');
    });
}

// Expose loadSleepData for backward compatibility
window.loadSleepData = function() {
    loadExistingSleepData();
}
</script> 