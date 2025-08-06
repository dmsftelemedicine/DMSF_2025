<div class="container-fluid">
    <!-- PSS-4 Assessment -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="fas fa-chart-line me-2"></i>Perceived Stress Scale (PSS-4)</h4>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">The questions in this scale ask you about your feelings and thoughts during <strong>THE LAST MONTH</strong>.</p>
            
            <form id="pss4-form">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="assessment_type" value="pss4">
                
                <!-- PSS-4 Questions -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 60%;">Question</th>
                                        <th class="text-center">Never<br>(0)</th>
                                        <th class="text-center">Almost Never<br>(1)</th>
                                        <th class="text-center">Sometimes<br>(2)</th>
                                        <th class="text-center">Fairly Often<br>(3)</th>
                                        <th class="text-center">Very Often<br>(4)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1. In the last month, how often have you felt that you were unable to control the important things in your life?</td>
                                        <td class="text-center"><input type="radio" name="pss4_q1" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q1" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q1" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q1" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q1" value="4" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>2. In the last month, how often have you felt confident about your ability to handle your personal problems?</td>
                                        <td class="text-center"><input type="radio" name="pss4_q2" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q2" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q2" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q2" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q2" value="4" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>3. In the last month, how often have you felt that things were going your way?</td>
                                        <td class="text-center"><input type="radio" name="pss4_q3" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q3" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q3" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q3" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q3" value="4" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>4. In the last month, how often have you felt difficulties were piling up so high that you could not overcome them?</td>
                                        <td class="text-center"><input type="radio" name="pss4_q4" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q4" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q4" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q4" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="pss4_q4" value="4" class="form-check-input"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Important Note about Reverse Scoring -->
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> Questions 2 and 3 are reverse-scored. This means "Never" gets 4 points and "Very Often" gets 0 points for these questions.
                </div>

                <!-- Action Buttons -->
                <div class="mt-4">
                    <button type="button" class="btn btn-success me-2" onclick="calculatePSS4Score()">
                        <i class="fas fa-calculator me-1"></i>Calculate PSS-4 Score
                    </button>
                    <button type="button" class="btn btn-primary me-2" onclick="savePSS4Assessment()">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="backToInitial()">
                        <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PSS-4 Results Section -->
    <div id="pss4-results" class="card mb-4" style="display: none;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>PSS-4 Results</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 id="pss4_total_score">0</h3>
                        <p class="text-muted">Total Score</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h4 id="stress_level" class="text-primary">Low Stress</h4>
                        <p class="text-muted">Stress Level</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span id="stress_category" class="badge bg-info fs-6">Low</span>
                        <p class="text-muted mt-2">Category</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6>Interpretation:</h6>
                <p id="pss4_interpretation" class="text-muted">Assessment interpretation will appear here.</p>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Additional Information</h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="pss4InfoAccordion">
                <!-- About PSS-4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="aboutPSS4">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAboutPSS4">
                            About the PSS-4
                        </button>
                    </h2>
                    <div id="collapseAboutPSS4" class="accordion-collapse collapse show" data-bs-parent="#pss4InfoAccordion">
                        <div class="accordion-body">
                            <p>The Perceived Stress Scale-4 (PSS-4) is a short version of the original 14-item PSS. It measures the degree to which situations in one's life are appraised as stressful.</p>
                            <p><strong>Scoring:</strong></p>
                            <ul>
                                <li>0-4: Low stress</li>
                                <li>5-8: Mild to moderate stress</li>
                                <li>9-12: Moderate to high stress</li>
                                <li>13-16: High stress</li>
                            </ul>
                            <p><strong>Reverse Scoring:</strong></p>
                            <ul>
                                <li>Questions 2 and 3 are reverse-scored</li>
                                <li>Never (0) becomes 4 points</li>
                                <li>Almost Never (1) becomes 3 points</li>
                                <li>Sometimes (2) becomes 2 points</li>
                                <li>Fairly Often (3) becomes 1 point</li>
                                <li>Very Often (4) becomes 0 points</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Clinical Significance -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="pss4Clinical">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePSS4Clinical">
                            Clinical Significance
                        </button>
                    </h2>
                    <div id="collapsePSS4Clinical" class="accordion-collapse collapse" data-bs-parent="#pss4InfoAccordion">
                        <div class="accordion-body">
                            <p><strong>Low Stress (0-4):</strong> Generally indicates good stress management and coping abilities.</p>
                            <p><strong>Mild to Moderate Stress (5-8):</strong> Normal stress levels that may benefit from stress management techniques.</p>
                            <p><strong>Moderate to High Stress (9-12):</strong> Elevated stress levels that may impact health and functioning. Consider stress management interventions.</p>
                            <p><strong>High Stress (13-16):</strong> High stress levels that may require professional intervention and stress management strategies.</p>
                        </div>
                    </div>
                </div>

                <!-- ICD-10 Diagnoses -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="pss4ICD10">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePSS4ICD10">
                            Possible ICD-10 Diagnoses
                        </button>
                    </h2>
                    <div id="collapsePSS4ICD10" class="accordion-collapse collapse" data-bs-parent="#pss4InfoAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>ICD-10 Code</th>
                                            <th>Diagnosis</th>
                                            <th>When to Use</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>F43.0</td>
                                            <td>Acute Stress Reaction</td>
                                            <td>High PSS-4 score with recent stressor</td>
                                        </tr>
                                        <tr>
                                            <td>F43.1</td>
                                            <td>Post-traumatic Stress Disorder</td>
                                            <td>High stress following trauma</td>
                                        </tr>
                                        <tr>
                                            <td>F43.2</td>
                                            <td>Adjustment Disorder</td>
                                            <td>Stress response to life changes</td>
                                        </tr>
                                        <tr>
                                            <td>F43.8</td>
                                            <td>Other Reactions to Severe Stress</td>
                                            <td>Other stress-related conditions</td>
                                        </tr>
                                        <tr>
                                            <td>F43.9</td>
                                            <td>Reaction to Severe Stress, Unspecified</td>
                                            <td>Stress symptoms not meeting specific criteria</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="pss4Resources">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePSS4Resources">
                            Resources & Links
                        </button>
                    </h2>
                    <div id="collapsePSS4Resources" class="accordion-collapse collapse" data-bs-parent="#pss4InfoAccordion">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li><a href="https://www.mindgarden.com/137-perceived-stress-scale" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>PSS Official Site
                                </a></li>
                                <li><a href="https://www.apa.org/helpcenter/stress-management" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>APA Stress Management Resources
                                </a></li>
                                <li><a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-pdf me-2"></i>Cebuano PSS-4 PDF (Available upon request)
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculatePSS4Score() {
    let total = 0;
    let answeredQuestions = 0;
    
    // Calculate total score with reverse scoring for questions 2 and 3
    for (let i = 1; i <= 4; i++) {
        const value = $('input[name="pss4_q' + i + '"]:checked').val();
        if (value !== undefined) {
            let score = parseInt(value);
            
            // Reverse scoring for questions 2 and 3
            if (i === 2 || i === 3) {
                score = 4 - score; // Reverse the score
            }
            
            total += score;
            answeredQuestions++;
        }
    }
    
    if (answeredQuestions < 4) {
        alert('Please answer all 4 PSS-4 questions before calculating your score.');
        return;
    }
    
    // Determine stress level
    let stressLevel = '';
    let interpretation = '';
    let category = '';
    let badgeClass = '';
    
    if (total >= 0 && total <= 4) {
        stressLevel = 'Low Stress';
        interpretation = 'You are experiencing low levels of perceived stress. This indicates good stress management and coping abilities. Continue with your current stress management strategies.';
        category = 'Low';
        badgeClass = 'bg-success';
    } else if (total >= 5 && total <= 8) {
        stressLevel = 'Mild to Moderate Stress';
        interpretation = 'You are experiencing mild to moderate levels of perceived stress. This is within normal range but may benefit from stress management techniques such as relaxation exercises, time management, or lifestyle modifications.';
        category = 'Mild-Moderate';
        badgeClass = 'bg-info';
    } else if (total >= 9 && total <= 12) {
        stressLevel = 'Moderate to High Stress';
        interpretation = 'You are experiencing elevated levels of perceived stress that may impact your health and daily functioning. Consider implementing stress management strategies and possibly seeking professional guidance for stress management techniques.';
        category = 'Moderate-High';
        badgeClass = 'bg-warning';
    } else if (total >= 13 && total <= 16) {
        stressLevel = 'High Stress';
        interpretation = 'You are experiencing high levels of perceived stress that may significantly impact your health and well-being. Professional intervention and comprehensive stress management strategies are recommended. Consider consulting with a mental health professional.';
        category = 'High';
        badgeClass = 'bg-danger';
    }
    
    // Display results
    $('#pss4_total_score').text(total);
    $('#stress_level').text(stressLevel);
    $('#stress_category').text(category);
    $('#pss4_interpretation').text(interpretation);
    
    // Update badge color
    const categoryBadge = $('#stress_category');
    categoryBadge.removeClass('bg-success bg-info bg-warning bg-danger');
    categoryBadge.addClass(badgeClass);
    
    $('#pss4-results').show();
    
    // Scroll to results
    $('#pss4-results')[0].scrollIntoView({ behavior: 'smooth' });
}

function savePSS4Assessment() {
    const formData = new FormData($('#pss4-form')[0]);
    
    $.ajax({
        url: '{{ route("submit.stressManagement") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('PSS-4 assessment saved');
            alert('PSS-4 assessment saved successfully!');
        },
        error: function(xhr) {
            console.error('Error saving PSS-4 assessment:', xhr.responseText);
            alert('Error saving assessment. Please try again.');
        }
    });
}

// Navigation function handled by parent stress_management.blade.php

// Load existing PSS-4 data
function loadPSS4Data() {
    $.ajax({
        url: '{{ route("stressManagement.getDataByPatient", $patient->id) }}',
        method: 'GET',
        success: function(data) {
            if (data && data.pss4_data) {
                // Populate PSS-4 form fields
                for (let i = 1; i <= 4; i++) {
                    if (data.pss4_data[`pss4_q${i}`]) {
                        $(`input[name="pss4_q${i}"][value="${data.pss4_data[`pss4_q${i}`]}"]`).prop('checked', true);
                    }
                }
            }
        },
        error: function(xhr) {
            console.log('No existing PSS-4 data found');
        }
    });
}
</script> 