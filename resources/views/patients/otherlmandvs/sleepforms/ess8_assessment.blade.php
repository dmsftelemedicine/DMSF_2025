<div class="card mb-4">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-tired me-2"></i>Epworth Sleepiness Scale (ESS-8)</h4>
        <button type="button" class="btn btn-light btn-sm" onclick="backToSleepInitial()">
            <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
        </button>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Instructions:</strong> How likely are you to doze off or fall asleep in the following situations? 
            Use the following scale to choose the most appropriate number for each situation:
        </div>

        <div class="alert alert-secondary">
            <strong>Scale:</strong><br>
            0 = Would never doze<br>
            1 = Slight chance of dozing<br>
            2 = Moderate chance of dozing<br>
            3 = High chance of dozing
        </div>

        <form id="ess8-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="assessment_type" value="ess8">

            <!-- ESS-8 Questions -->
            <div class="row">
                <div class="col-12">
                    <h5 class="text-warning mb-3">Assessment Questions</h5>
                </div>
            </div>

            <!-- Question 1 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">1. Sitting and reading</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q1" value="0" id="ess_q1_0" required>
                                <label class="form-check-label" for="ess_q1_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q1" value="1" id="ess_q1_1" required>
                                <label class="form-check-label" for="ess_q1_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q1" value="2" id="ess_q1_2" required>
                                <label class="form-check-label" for="ess_q1_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q1" value="3" id="ess_q1_3" required>
                                <label class="form-check-label" for="ess_q1_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">2. Watching TV</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q2" value="0" id="ess_q2_0" required>
                                <label class="form-check-label" for="ess_q2_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q2" value="1" id="ess_q2_1" required>
                                <label class="form-check-label" for="ess_q2_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q2" value="2" id="ess_q2_2" required>
                                <label class="form-check-label" for="ess_q2_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q2" value="3" id="ess_q2_3" required>
                                <label class="form-check-label" for="ess_q2_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">3. Sitting inactive in a public place (e.g., a theater or a meeting)</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q3" value="0" id="ess_q3_0" required>
                                <label class="form-check-label" for="ess_q3_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q3" value="1" id="ess_q3_1" required>
                                <label class="form-check-label" for="ess_q3_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q3" value="2" id="ess_q3_2" required>
                                <label class="form-check-label" for="ess_q3_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q3" value="3" id="ess_q3_3" required>
                                <label class="form-check-label" for="ess_q3_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">4. As a passenger in a car for an hour without a break</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q4" value="0" id="ess_q4_0" required>
                                <label class="form-check-label" for="ess_q4_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q4" value="1" id="ess_q4_1" required>
                                <label class="form-check-label" for="ess_q4_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q4" value="2" id="ess_q4_2" required>
                                <label class="form-check-label" for="ess_q4_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q4" value="3" id="ess_q4_3" required>
                                <label class="form-check-label" for="ess_q4_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">5. Lying down to rest in the afternoon when circumstances permit</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q5" value="0" id="ess_q5_0" required>
                                <label class="form-check-label" for="ess_q5_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q5" value="1" id="ess_q5_1" required>
                                <label class="form-check-label" for="ess_q5_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q5" value="2" id="ess_q5_2" required>
                                <label class="form-check-label" for="ess_q5_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q5" value="3" id="ess_q5_3" required>
                                <label class="form-check-label" for="ess_q5_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">6. Sitting and talking to someone</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q6" value="0" id="ess_q6_0" required>
                                <label class="form-check-label" for="ess_q6_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q6" value="1" id="ess_q6_1" required>
                                <label class="form-check-label" for="ess_q6_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q6" value="2" id="ess_q6_2" required>
                                <label class="form-check-label" for="ess_q6_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q6" value="3" id="ess_q6_3" required>
                                <label class="form-check-label" for="ess_q6_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">7. Sitting quietly after a lunch without alcohol</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q7" value="0" id="ess_q7_0" required>
                                <label class="form-check-label" for="ess_q7_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q7" value="1" id="ess_q7_1" required>
                                <label class="form-check-label" for="ess_q7_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q7" value="2" id="ess_q7_2" required>
                                <label class="form-check-label" for="ess_q7_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q7" value="3" id="ess_q7_3" required>
                                <label class="form-check-label" for="ess_q7_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 8 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">8. In a car, while stopped for a few minutes in traffic</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q8" value="0" id="ess_q8_0" required>
                                <label class="form-check-label" for="ess_q8_0">0 - Would never doze</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q8" value="1" id="ess_q8_1" required>
                                <label class="form-check-label" for="ess_q8_1">1 - Slight chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q8" value="2" id="ess_q8_2" required>
                                <label class="form-check-label" for="ess_q8_2">2 - Moderate chance</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ess_q8" value="3" id="ess_q8_3" required>
                                <label class="form-check-label" for="ess_q8_3">3 - High chance</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score Display -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <strong>Total Score: <span id="ess8-total-score">0</span></strong>
                        <br>
                        <span id="ess8-interpretation">Please complete all questions to see your score.</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-warning me-2" id="calculate-ess8-btn">
                        <i class="fas fa-calculator me-1"></i>Calculate Score
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

        <!-- Results Area -->
        <div id="ess8-results" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>ESS-8 Assessment Results</h5>
                </div>
                <div class="card-body">
                    <div id="ess8-results-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Calculate score when any radio button changes
    $('input[type="radio"]').on('change', function() {
        calculateESS8Score();
    });

    // Calculate button
    $('#calculate-ess8-btn').on('click', function() {
        calculateESS8Score();
        displayESS8Results();
    });

    // Form submission
    $('#ess8-form').on('submit', function(e) {
        e.preventDefault();
        submitESS8Assessment();
    });

    function calculateESS8Score() {
        let totalScore = 0;
        let questionsAnswered = 0;

        // Calculate total score
        for (let i = 1; i <= 8; i++) {
            const selectedValue = $(`input[name="ess_q${i}"]:checked`).val();
            if (selectedValue !== undefined) {
                totalScore += parseInt(selectedValue);
                questionsAnswered++;
            }
        }

        // Update score display
        $('#ess8-total-score').text(totalScore);

        // Update interpretation
        if (questionsAnswered === 8) {
            let interpretation = '';
            let severity = '';
            let color = '';

            if (totalScore >= 0 && totalScore <= 5) {
                interpretation = 'Lower normal daytime sleepiness';
                severity = 'Normal';
                color = 'success';
            } else if (totalScore >= 6 && totalScore <= 10) {
                interpretation = 'Higher normal daytime sleepiness';
                severity = 'Mild';
                color = 'warning';
            } else if (totalScore >= 11 && totalScore <= 15) {
                interpretation = 'Mild excessive daytime sleepiness';
                severity = 'Moderate';
                color = 'danger';
            } else if (totalScore >= 16 && totalScore <= 24) {
                interpretation = 'Moderate to severe excessive daytime sleepiness';
                severity = 'Severe';
                color = 'danger';
            }

            $('#ess8-interpretation').html(`
                <strong>Severity: ${severity}</strong><br>
                ${interpretation}
            `).removeClass().addClass(`text-${color}`);
        } else {
            $('#ess8-interpretation').text('Please complete all questions to see your score.').removeClass();
        }

        return { totalScore, questionsAnswered };
    }

    function displayESS8Results() {
        const { totalScore, questionsAnswered } = calculateESS8Score();
        
        if (questionsAnswered === 8) {
            let severity = '';
            let recommendations = '';

            if (totalScore >= 0 && totalScore <= 5) {
                severity = 'Normal';
                recommendations = 'Your daytime sleepiness is within normal limits. Continue maintaining good sleep habits and regular sleep schedule.';
            } else if (totalScore >= 6 && totalScore <= 10) {
                severity = 'Mild';
                recommendations = 'You may have slightly elevated daytime sleepiness. Consider improving sleep hygiene and ensuring adequate sleep duration.';
            } else if (totalScore >= 11 && totalScore <= 15) {
                severity = 'Moderate';
                recommendations = 'You have mild excessive daytime sleepiness. Consider consulting with a healthcare provider. This may indicate underlying sleep disorders or insufficient sleep.';
            } else if (totalScore >= 16 && totalScore <= 24) {
                severity = 'Severe';
                recommendations = 'You have moderate to severe excessive daytime sleepiness. Strongly recommend consulting with a healthcare provider or sleep specialist. This may indicate sleep disorders such as sleep apnea, narcolepsy, or other conditions.';
            }

            $('#ess8-results-content').html(`
                <div class="row">
                    <div class="col-md-6">
                        <h6>Assessment Summary</h6>
                        <ul class="list-unstyled">
                            <li><strong>Total Score:</strong> ${totalScore}/24</li>
                            <li><strong>Daytime Sleepiness:</strong> ${severity}</li>
                            <li><strong>Assessment Date:</strong> ${new Date().toLocaleDateString()}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Recommendations</h6>
                        <p>${recommendations}</p>
                    </div>
                </div>
            `);

            $('#ess8-results').show();
        }
    }

    function submitESS8Assessment() {
        const { totalScore, questionsAnswered } = calculateESS8Score();
        
        if (questionsAnswered < 8) {
            alert('Please complete all questions before saving.');
            return;
        }

        const formData = new FormData($('#ess8-form')[0]);
        formData.append('total_score', totalScore);

        $.ajax({
            url: '{{ route("ess8-assessments.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('ESS-8 assessment saved successfully!');
                }
            },
            error: function(xhr) {
                alert('Error saving assessment. Please try again.');
            }
        });
    }

    window.loadESS8Data = function() {
        $.ajax({
            url: '{{ route("ess8-assessments.show", $patient->id) }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.data) {
                    const data = response.data;
                    
                    // Fill form fields with existing data
                    for (let i = 1; i <= 8; i++) {
                        if (data[`ess_q${i}`] !== null) {
                            $(`input[name="ess_q${i}"][value="${data[`ess_q${i}`]}"]`).prop('checked', true);
                        }
                    }
                    
                    // Recalculate and display score
                    calculateESS8Score();
                    displayESS8Results();
                }
            },
            error: function(xhr) {
                // No existing data found, which is fine
            }
        });
    }
});
</script> 