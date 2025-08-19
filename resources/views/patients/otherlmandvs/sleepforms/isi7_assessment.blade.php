<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-moon me-2"></i>Insomnia Severity Index (ISI-7)</h4>
        <button type="button" class="btn btn-light btn-sm" onclick="backToSleepInitial()">
            <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
        </button>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Instructions:</strong> Please rate the severity of your insomnia problems during the past month.
        </div>

        <form id="isi7-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="assessment_type" value="isi7">

            <!-- ISI-7 Questions -->
            <div class="row">
                <div class="col-12">
                    <h5 class="text-primary mb-3">Assessment Questions</h5>
                </div>
            </div>

            <!-- Question 1 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">1. Difficulty falling asleep</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q1" value="0" id="isi_q1_0" required>
                        <label class="form-check-label" for="isi_q1_0">None</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q1" value="1" id="isi_q1_1" required>
                        <label class="form-check-label" for="isi_q1_1">Mild</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q1" value="2" id="isi_q1_2" required>
                        <label class="form-check-label" for="isi_q1_2">Moderate</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q1" value="3" id="isi_q1_3" required>
                        <label class="form-check-label" for="isi_q1_3">Severe</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q1" value="4" id="isi_q1_4" required>
                        <label class="form-check-label" for="isi_q1_4">Very severe</label>
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">2. Difficulty staying asleep</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q2" value="0" id="isi_q2_0" required>
                        <label class="form-check-label" for="isi_q2_0">None</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q2" value="1" id="isi_q2_1" required>
                        <label class="form-check-label" for="isi_q2_1">Mild</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q2" value="2" id="isi_q2_2" required>
                        <label class="form-check-label" for="isi_q2_2">Moderate</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q2" value="3" id="isi_q2_3" required>
                        <label class="form-check-label" for="isi_q2_3">Severe</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q2" value="4" id="isi_q2_4" required>
                        <label class="form-check-label" for="isi_q2_4">Very severe</label>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">3. Problems waking up too early</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q3" value="0" id="isi_q3_0" required>
                        <label class="form-check-label" for="isi_q3_0">None</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q3" value="1" id="isi_q3_1" required>
                        <label class="form-check-label" for="isi_q3_1">Mild</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q3" value="2" id="isi_q3_2" required>
                        <label class="form-check-label" for="isi_q3_2">Moderate</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q3" value="3" id="isi_q3_3" required>
                        <label class="form-check-label" for="isi_q3_3">Severe</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q3" value="4" id="isi_q3_4" required>
                        <label class="form-check-label" for="isi_q3_4">Very severe</label>
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">4. How satisfied/dissatisfied are you with your current sleep pattern?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q4" value="0" id="isi_q4_0" required>
                        <label class="form-check-label" for="isi_q4_0">Very satisfied</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q4" value="1" id="isi_q4_1" required>
                        <label class="form-check-label" for="isi_q4_1">Satisfied</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q4" value="2" id="isi_q4_2" required>
                        <label class="form-check-label" for="isi_q4_2">Dissatisfied</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q4" value="3" id="isi_q4_3" required>
                        <label class="form-check-label" for="isi_q4_3">Very dissatisfied</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q4" value="4" id="isi_q4_4" required>
                        <label class="form-check-label" for="isi_q4_4">Extremely dissatisfied</label>
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">5. How noticeable to others do you think your sleep problem is in terms of impairing the quality of your life?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q5" value="0" id="isi_q5_0" required>
                        <label class="form-check-label" for="isi_q5_0">Not at all noticeable</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q5" value="1" id="isi_q5_1" required>
                        <label class="form-check-label" for="isi_q5_1">A little</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q5" value="2" id="isi_q5_2" required>
                        <label class="form-check-label" for="isi_q5_2">Somewhat</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q5" value="3" id="isi_q5_3" required>
                        <label class="form-check-label" for="isi_q5_3">Much</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q5" value="4" id="isi_q5_4" required>
                        <label class="form-check-label" for="isi_q5_4">Very much noticeable</label>
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">6. How worried/distressed are you about your current sleep problem?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q6" value="0" id="isi_q6_0" required>
                        <label class="form-check-label" for="isi_q6_0">Not at all worried</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q6" value="1" id="isi_q6_1" required>
                        <label class="form-check-label" for="isi_q6_1">A little</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q6" value="2" id="isi_q6_2" required>
                        <label class="form-check-label" for="isi_q6_2">Somewhat</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q6" value="3" id="isi_q6_3" required>
                        <label class="form-check-label" for="isi_q6_3">Much</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q6" value="4" id="isi_q6_4" required>
                        <label class="form-check-label" for="isi_q6_4">Very much worried</label>
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">7. To what extent do you consider your sleep problem to interfere with your daily functioning (e.g., daytime fatigue, ability to function at work/daily chores, concentration, memory, mood, etc.) currently?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q7" value="0" id="isi_q7_0" required>
                        <label class="form-check-label" for="isi_q7_0">Not at all interfering</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q7" value="1" id="isi_q7_1" required>
                        <label class="form-check-label" for="isi_q7_1">A little</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q7" value="2" id="isi_q7_2" required>
                        <label class="form-check-label" for="isi_q7_2">Somewhat</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q7" value="3" id="isi_q7_3" required>
                        <label class="form-check-label" for="isi_q7_3">Much</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isi_q7" value="4" id="isi_q7_4" required>
                        <label class="form-check-label" for="isi_q7_4">Very much interfering</label>
                    </div>
                </div>
            </div>

            <!-- Score Display -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <strong>Total Score: <span id="isi7-total-score">0</span></strong>
                        <br>
                        <span id="isi7-interpretation">Please complete all questions to see your score.</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-primary me-2" id="calculate-isi7-btn">
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
        <div id="isi7-results" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>ISI-7 Assessment Results</h5>
                </div>
                <div class="card-body">
                    <div id="isi7-results-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Calculate score when any radio button changes
    $('input[type="radio"]').on('change', function() {
        calculateISI7Score();
    });

    // Calculate button
    $('#calculate-isi7-btn').on('click', function() {
        calculateISI7Score();
        displayISI7Results();
    });

    // Form submission
    $('#isi7-form').on('submit', function(e) {
        e.preventDefault();
        submitISI7Assessment();
    });

    function calculateISI7Score() {
        let totalScore = 0;
        let questionsAnswered = 0;

        // Calculate total score
        for (let i = 1; i <= 7; i++) {
            const selectedValue = $(`input[name="isi_q${i}"]:checked`).val();
            if (selectedValue !== undefined) {
                totalScore += parseInt(selectedValue);
                questionsAnswered++;
            }
        }

        // Update score display
        $('#isi7-total-score').text(totalScore);

        // Update interpretation
        if (questionsAnswered === 7) {
            let interpretation = '';
            let severity = '';
            let color = '';

            if (totalScore >= 0 && totalScore <= 7) {
                interpretation = 'No clinically significant insomnia';
                severity = 'None';
                color = 'success';
            } else if (totalScore >= 8 && totalScore <= 14) {
                interpretation = 'Subthreshold insomnia';
                severity = 'Mild';
                color = 'warning';
            } else if (totalScore >= 15 && totalScore <= 21) {
                interpretation = 'Clinical insomnia (moderate severity)';
                severity = 'Moderate';
                color = 'danger';
            } else if (totalScore >= 22 && totalScore <= 28) {
                interpretation = 'Clinical insomnia (severe)';
                severity = 'Severe';
                color = 'danger';
            }

            $('#isi7-interpretation').html(`
                <strong>Severity: ${severity}</strong><br>
                ${interpretation}
            `).removeClass().addClass(`text-${color}`);
        } else {
            $('#isi7-interpretation').text('Please complete all questions to see your score.').removeClass();
        }

        return { totalScore, questionsAnswered };
    }

    function displayISI7Results() {
        const { totalScore, questionsAnswered } = calculateISI7Score();
        
        if (questionsAnswered === 7) {
            let severity = '';
            let recommendations = '';

            if (totalScore >= 0 && totalScore <= 7) {
                severity = 'None';
                recommendations = 'Your sleep appears to be within normal limits. Continue maintaining good sleep hygiene practices.';
            } else if (totalScore >= 8 && totalScore <= 14) {
                severity = 'Mild';
                recommendations = 'Consider implementing sleep hygiene improvements and stress management techniques. Monitor your sleep patterns.';
            } else if (totalScore >= 15 && totalScore <= 21) {
                severity = 'Moderate';
                recommendations = 'Consider consulting with a healthcare provider about your sleep difficulties. Cognitive behavioral therapy for insomnia (CBT-I) may be beneficial.';
            } else if (totalScore >= 22 && totalScore <= 28) {
                severity = 'Severe';
                recommendations = 'Strongly recommend consulting with a healthcare provider or sleep specialist. Treatment options may include CBT-I, medication, or other interventions.';
            }

            $('#isi7-results-content').html(`
                <div class="row">
                    <div class="col-md-6">
                        <h6>Assessment Summary</h6>
                        <ul class="list-unstyled">
                            <li><strong>Total Score:</strong> ${totalScore}/28</li>
                            <li><strong>Insomnia Severity:</strong> ${severity}</li>
                            <li><strong>Assessment Date:</strong> ${new Date().toLocaleDateString()}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Recommendations</h6>
                        <p>${recommendations}</p>
                    </div>
                </div>
            `);

            $('#isi7-results').show();
        }
    }

    function submitISI7Assessment() {
        const { totalScore, questionsAnswered } = calculateISI7Score();
        
        if (questionsAnswered < 7) {
            alert('Please complete all questions before saving.');
            return;
        }

        const formData = new FormData($('#isi7-form')[0]);
        formData.append('total_score', totalScore);

        $.ajax({
            url: '{{ route("isi7-assessments.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('ISI-7 assessment saved successfully!');
                }
            },
            error: function(xhr) {
                alert('Error saving assessment. Please try again.');
            }
        });
    }

    window.loadISI7Data = function() {
        $.ajax({
            url: '{{ route("isi7-assessments.show", $patient->id) }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.data) {
                    const data = response.data;
                    
                    // Fill form fields with existing data
                    for (let i = 1; i <= 7; i++) {
                        if (data[`isi_q${i}`] !== null) {
                            $(`input[name="isi_q${i}"][value="${data[`isi_q${i}`]}"]`).prop('checked', true);
                        }
                    }
                    
                    // Recalculate and display score
                    calculateISI7Score();
                    displayISI7Results();
                }
            },
            error: function(xhr) {
                // No existing data found, which is fine
            }
        });
    }
});
</script> 