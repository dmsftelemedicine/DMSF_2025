<div class="card mb-4">
    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-lungs me-2"></i>STOP-BANG Score for Obstructive Sleep Apnea</h4>
        <button type="button" class="btn btn-light btn-sm" onclick="backToSleepInitial()">
            <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
        </button>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Instructions:</strong> Please answer the following questions to assess your risk for obstructive sleep apnea. 
            Answer "Yes" or "No" to each question.
        </div>

        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Note:</strong> This assessment helps identify risk factors for obstructive sleep apnea. 
            A high score may indicate the need for further evaluation by a healthcare provider.
        </div>

        <form id="stopbang-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="assessment_type" value="stopbang">

            <!-- STOP-BANG Questions -->
            <div class="row">
                <div class="col-12">
                    <h5 class="text-danger mb-3">Assessment Questions</h5>
                </div>
            </div>

            <!-- Question 1: Snore -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">1. Do you SNORE loudly (loud enough to be heard through closed doors)?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q1" value="1" id="stopbang_q1_yes" required>
                        <label class="form-check-label" for="stopbang_q1_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q1" value="0" id="stopbang_q1_no" required>
                        <label class="form-check-label" for="stopbang_q1_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Question 2: Tired -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">2. Do you often feel TIRED, fatigued, or sleepy during daytime?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q2" value="1" id="stopbang_q2_yes" required>
                        <label class="form-check-label" for="stopbang_q2_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q2" value="0" id="stopbang_q2_no" required>
                        <label class="form-check-label" for="stopbang_q2_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Question 3: Observed -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">3. Has anyone OBSERVED you stop breathing or choking/gasping during your sleep?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q3" value="1" id="stopbang_q3_yes" required>
                        <label class="form-check-label" for="stopbang_q3_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q3" value="0" id="stopbang_q3_no" required>
                        <label class="form-check-label" for="stopbang_q3_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Question 4: Pressure -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">4. Do you have or are you being treated for high blood PRESSURE?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q4" value="1" id="stopbang_q4_yes" required>
                        <label class="form-check-label" for="stopbang_q4_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q4" value="0" id="stopbang_q4_no" required>
                        <label class="form-check-label" for="stopbang_q4_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Question 5: BMI -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">5. Is your BMI more than 35 kg/m²?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q5" value="1" id="stopbang_q5_yes" required>
                        <label class="form-check-label" for="stopbang_q5_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q5" value="0" id="stopbang_q5_no" required>
                        <label class="form-check-label" for="stopbang_q5_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Question 6: Age -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">6. Are you over 50 years old?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q6" value="1" id="stopbang_q6_yes" required>
                        <label class="form-check-label" for="stopbang_q6_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q6" value="0" id="stopbang_q6_no" required>
                        <label class="form-check-label" for="stopbang_q6_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Question 7: Neck -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">7. Is your neck circumference greater than 40 cm (16 inches)?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q7" value="1" id="stopbang_q7_yes" required>
                        <label class="form-check-label" for="stopbang_q7_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q7" value="0" id="stopbang_q7_no" required>
                        <label class="form-check-label" for="stopbang_q7_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Question 8: Gender -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">8. Are you male?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q8" value="1" id="stopbang_q8_yes" required>
                        <label class="form-check-label" for="stopbang_q8_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stopbang_q8" value="0" id="stopbang_q8_no" required>
                        <label class="form-check-label" for="stopbang_q8_no">No</label>
                    </div>
                </div>
            </div>

            <!-- Score Display -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <strong>Total Score: <span id="stopbang-total-score">0</span></strong>
                        <br>
                        <span id="stopbang-interpretation">Please complete all questions to see your score.</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-danger me-2" id="calculate-stopbang-btn">
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
        <div id="stopbang-results" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>STOP-BANG Assessment Results</h5>
                </div>
                <div class="card-body">
                    <div id="stopbang-results-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Calculate score when any radio button changes
    $('input[type="radio"]').on('change', function() {
        calculateSTOPBANGScore();
    });

    // Calculate button
    $('#calculate-stopbang-btn').on('click', function() {
        calculateSTOPBANGScore();
        displaySTOPBANGResults();
    });

    // Form submission
    $('#stopbang-form').on('submit', function(e) {
        e.preventDefault();
        submitSTOPBANGAssessment();
    });

    function calculateSTOPBANGScore() {
        let totalScore = 0;
        let questionsAnswered = 0;

        // Calculate total score
        for (let i = 1; i <= 8; i++) {
            const selectedValue = $(`input[name="stopbang_q${i}"]:checked`).val();
            if (selectedValue !== undefined) {
                totalScore += parseInt(selectedValue);
                questionsAnswered++;
            }
        }

        // Update score display
        $('#stopbang-total-score').text(totalScore);

        // Update interpretation
        if (questionsAnswered === 8) {
            let interpretation = '';
            let risk = '';
            let color = '';

            if (totalScore >= 0 && totalScore <= 2) {
                interpretation = 'Low risk of obstructive sleep apnea';
                risk = 'Low Risk';
                color = 'success';
            } else if (totalScore >= 3 && totalScore <= 4) {
                interpretation = 'Intermediate risk of obstructive sleep apnea';
                risk = 'Intermediate Risk';
                color = 'warning';
            } else if (totalScore >= 5 && totalScore <= 8) {
                interpretation = 'High risk of obstructive sleep apnea';
                risk = 'High Risk';
                color = 'danger';
            }

            $('#stopbang-interpretation').html(`
                <strong>Risk Level: ${risk}</strong><br>
                ${interpretation}
            `).removeClass().addClass(`text-${color}`);
        } else {
            $('#stopbang-interpretation').text('Please complete all questions to see your score.').removeClass();
        }

        return { totalScore, questionsAnswered };
    }

    function displaySTOPBANGResults() {
        const { totalScore, questionsAnswered } = calculateSTOPBANGScore();
        
        if (questionsAnswered === 8) {
            let risk = '';
            let recommendations = '';

            if (totalScore >= 0 && totalScore <= 2) {
                risk = 'Low Risk';
                recommendations = 'Your risk of obstructive sleep apnea appears to be low. Continue maintaining good sleep habits and regular health check-ups.';
            } else if (totalScore >= 3 && totalScore <= 4) {
                risk = 'Intermediate Risk';
                recommendations = 'You have an intermediate risk of obstructive sleep apnea. Consider discussing your sleep patterns with a healthcare provider. A sleep study may be recommended if you have symptoms.';
            } else if (totalScore >= 5 && totalScore <= 8) {
                risk = 'High Risk';
                recommendations = 'You have a high risk of obstructive sleep apnea. Strongly recommend consulting with a healthcare provider or sleep specialist. A sleep study (polysomnography) is typically recommended for diagnosis and treatment planning.';
            }

            $('#stopbang-results-content').html(`
                <div class="row">
                    <div class="col-md-6">
                        <h6>Assessment Summary</h6>
                        <ul class="list-unstyled">
                            <li><strong>Total Score:</strong> ${totalScore}/8</li>
                            <li><strong>Risk of OSA:</strong> ${risk}</li>
                            <li><strong>Assessment Date:</strong> ${new Date().toLocaleDateString()}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Recommendations</h6>
                        <p>${recommendations}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <strong>STOP-BANG Score Breakdown:</strong><br>
                            <strong>S</strong>nore, <strong>T</strong>ired, <strong>O</strong>bserved, <strong>P</strong>ressure, 
                            <strong>B</strong>MI, <strong>A</strong>ge, <strong>N</strong>eck, <strong>G</strong>ender
                        </div>
                    </div>
                </div>
            `);

            $('#stopbang-results').show();
        }
    }

    function submitSTOPBANGAssessment() {
        const { totalScore, questionsAnswered } = calculateSTOPBANGScore();
        
        if (questionsAnswered < 8) {
            alert('Please complete all questions before saving.');
            return;
        }

        const formData = new FormData($('#stopbang-form')[0]);
        formData.append('total_score', totalScore);

        $.ajax({
            url: '{{ route("stopbang-assessments.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('STOP-BANG assessment saved successfully!');
                }
            },
            error: function(xhr) {
                alert('Error saving assessment. Please try again.');
            }
        });
    }

    window.loadSTOPBANGData = function() {
        $.ajax({
            url: '{{ route("stopbang-assessments.show", $patient->id) }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.data) {
                    const data = response.data;
                    
                    // Fill form fields with existing data
                    for (let i = 1; i <= 8; i++) {
                        if (data[`stopbang_q${i}`] !== null) {
                            $(`input[name="stopbang_q${i}"][value="${data[`stopbang_q${i}`]}"]`).prop('checked', true);
                        }
                    }
                    
                    // Recalculate and display score
                    calculateSTOPBANGScore();
                    displaySTOPBANGResults();
                }
            },
            error: function(xhr) {
                // No existing data found, which is fine
            }
        });
    }
});
</script> 