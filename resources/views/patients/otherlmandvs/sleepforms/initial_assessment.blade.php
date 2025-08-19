<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-bed me-2"></i>Sleep Assessment - Initial Evaluation</h4>
    </div>
    <div class="card-body">
        <form id="sleep-initial-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            
            <!-- Basic Sleep Metrics -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3"><i class="fas fa-clock me-2"></i>Your Sleep Habits</h5>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sleep Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" name="sleep_time" id="sleep_time" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Wake Up Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" name="wake_up_time" id="wake_up_time" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Usual Sleep Duration (hours) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="usual_sleep_duration" id="usual_sleep_duration" 
                           min="0" max="24" step="0.5" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sleep Quality Rating <span class="text-danger">*</span></label>
                    <select class="form-control" name="sleep_quality_rating" id="sleep_quality_rating" required>
                        <option value="">Select quality...</option>
                        <option value="1">1 - Worst</option>
                        <option value="2">2 - Very Poor</option>
                        <option value="3">3 - Poor</option>
                        <option value="4">4 - Below Average</option>
                        <option value="5">5 - Average</option>
                        <option value="6">6 - Above Average</option>
                        <option value="7">7 - Good</option>
                        <option value="8">8 - Very Good</option>
                        <option value="9">9 - Excellent</option>
                        <option value="10">10 - Outstanding</option>
                    </select>
                </div>
            </div>

            <!-- Sleep Hygiene Checklist -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3"><i class="fas fa-list-check me-2"></i>Sleep Hygiene Activities</h5>
                    <p class="text-muted">Do you do any of the following less than 2 hours before sleeping?</p>
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="alcohol" id="hygiene_alcohol">
                        <label class="form-check-label" for="hygiene_alcohol">Drinking alcoholic beverages</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="large_meal" id="hygiene_meal">
                        <label class="form-check-label" for="hygiene_meal">Eating a large meal</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="coffee" id="hygiene_coffee">
                        <label class="form-check-label" for="hygiene_coffee">Drinking coffee</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="gadgets" id="hygiene_gadgets">
                        <label class="form-check-label" for="hygiene_gadgets">Using gadgets/screen time</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="intense_exercise" id="hygiene_exercise">
                        <label class="form-check-label" for="hygiene_exercise">Intense exercise</label>
                    </div>
                </div>
            </div>

            <!-- Daytime Sleepiness -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3"><i class="fas fa-tired me-2"></i>Daytime Sleepiness</h5>
                    <div class="mb-3">
                        <label class="form-label">Do you feel unusually sleepy during the daytime? <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="daytime_sleepiness" id="daytime_sleepiness_yes" value="yes" required>
                            <label class="form-check-label" for="daytime_sleepiness_yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="daytime_sleepiness" id="daytime_sleepiness_no" value="no" required>
                            <label class="form-check-label" for="daytime_sleepiness_no">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Objective Features for STOP-BANG -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3"><i class="fas fa-ruler me-2"></i>Physical Measurements for Assessment</h5>
                    <p class="text-muted">These measurements help assess risk for sleep apnea and other sleep disorders.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Blood Pressure</label>
                    <input type="text" class="form-control" name="blood_pressure" id="blood_pressure" 
                           value="{{ $patient->blood_pressure ?? '' }}" placeholder="e.g., 130/90">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">BMI (kg/m²)</label>
                    <input type="number" class="form-control" name="bmi" id="bmi" 
                           value="{{ $patient->calculateBMI() != 'N/A' ? $patient->calculateBMI() : '' }}" 
                           step="0.1" min="0" max="100">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" class="form-control" name="age" id="age" 
                           value="{{ $patient->age ?? '' }}" min="0" max="150">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Neck Circumference (cm)</label>
                    <input type="number" class="form-control" name="neck_circumference" id="neck_circumference" 
                           value="{{ $patient->neck_circumference ?? '' }}" step="0.1" min="0" max="100">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="">Select gender...</option>
                        <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-primary me-2" id="evaluate-sleep-btn">
                        <i class="fas fa-chart-line me-1"></i>Evaluate & Get Recommendations
                    </button>
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo me-1"></i>Reset Form
                    </button>
                </div>
            </div>
        </form>

        <!-- Recommendation Area -->
        <div id="sleep-recommendation-area" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Recommended Assessments</h5>
                </div>
                <div class="card-body">
                    <div id="sleep-recommendations-list"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
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
        const formData = new FormData($('#sleep-initial-form')[0]);
        
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
                }
            },
            error: function(xhr) {
                alert('Error saving assessment. Please try again.');
            }
        });
    }

    window.loadSleepData = function() {
        $.ajax({
            url: '{{ route("sleep-initial-assessments.show", $patient->id) }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.data) {
                    const data = response.data;
                    
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
                    if (data.blood_pressure) {
                        $('#blood_pressure').val(data.blood_pressure);
                    }
                    if (data.bmi) {
                        $('#bmi').val(data.bmi);
                    }
                    if (data.age) {
                        $('#age').val(data.age);
                    }
                    if (data.neck_circumference) {
                        $('#neck_circumference').val(data.neck_circumference);
                    }
                    if (data.gender) {
                        $('#gender').val(data.gender);
                    }
                    
                    // Handle hygiene activities (array)
                    if (data.hygiene_activities && Array.isArray(data.hygiene_activities)) {
                        data.hygiene_activities.forEach(activity => {
                            $(`input[name="hygiene_activities[]"][value="${activity}"]`).prop('checked', true);
                        });
                    }
                }
            },
            error: function(xhr) {
                // No existing data found, which is fine
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

        // Get objective features
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

        // STOP-BANG Logic
        let hasPBangFeatures = false;
        if (bloodPressure && bloodPressure.includes('/')) {
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
});
</script> 