<div class="container-fluid">
    <!-- PHQ-9 Assessment -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-heart me-2"></i>Patient Health Questionnaire (PHQ-9)</h4>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">Over the last 2 weeks, how often have you been bothered by any of the following problems?</p>
            
            <form id="phq9-form">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="assessment_type" value="phq9">
                
                <!-- PHQ-9 Questions -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50%;">Question</th>
                                        <th class="text-center">Not at all<br>(0)</th>
                                        <th class="text-center">Several days<br>(1)</th>
                                        <th class="text-center">More than half<br>the days (2)</th>
                                        <th class="text-center">Nearly every<br>day (3)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1. Little interest or pleasure in doing things</td>
                                        <td class="text-center"><input type="radio" name="phq9_q1" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q1" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q1" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q1" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>2. Feeling down, depressed, or hopeless</td>
                                        <td class="text-center"><input type="radio" name="phq9_q2" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q2" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q2" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q2" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>3. Trouble falling or staying asleep, or sleeping too much</td>
                                        <td class="text-center"><input type="radio" name="phq9_q3" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q3" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q3" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q3" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>4. Feeling tired or having little energy</td>
                                        <td class="text-center"><input type="radio" name="phq9_q4" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q4" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q4" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q4" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>5. Poor appetite or overeating</td>
                                        <td class="text-center"><input type="radio" name="phq9_q5" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q5" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q5" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q5" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>6. Feeling bad about yourself - or that you are a failure or have let yourself or your family down</td>
                                        <td class="text-center"><input type="radio" name="phq9_q6" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q6" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q6" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q6" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>7. Trouble concentrating on things, such as reading the newspaper or watching television</td>
                                        <td class="text-center"><input type="radio" name="phq9_q7" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q7" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q7" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q7" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>8. Moving or speaking so slowly that other people could have noticed. Or the opposite - being so fidgety or restless that you have been moving around a lot more than usual</td>
                                        <td class="text-center"><input type="radio" name="phq9_q8" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q8" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q8" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q8" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>9. Thoughts that you would be better off dead, or of hurting yourself</td>
                                        <td class="text-center"><input type="radio" name="phq9_q9" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q9" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q9" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="phq9_q9" value="3" class="form-check-input"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4">
                    <button type="button" class="btn btn-success me-2" onclick="calculatePHQ9Score()">
                        <i class="fas fa-calculator me-1"></i>Calculate PHQ-9 Score
                    </button>
                    <button type="button" class="btn btn-primary me-2" onclick="savePHQ9Assessment()">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="backToInitial()">
                        <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PHQ-9 Results Section -->
    <div id="phq9-results" class="card mb-4" style="display: none;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>PHQ-9 Results</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 id="phq9_total_score">0</h3>
                        <p class="text-muted">Total Score</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h4 id="depression_severity" class="text-primary">Minimal Depression</h4>
                        <p class="text-muted">Severity Level</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span id="suicide_risk" class="badge bg-info fs-6">Low Risk</span>
                        <p class="text-muted mt-2">Suicide Risk</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6>Remarks:</h6>
                <p id="phq9_remarks" class="text-muted">Assessment remarks will appear here.</p>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Additional Information</h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="phq9InfoAccordion">
                <!-- About PHQ-9 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="aboutPHQ9">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAboutPHQ9">
                            About the PHQ-9
                        </button>
                    </h2>
                    <div id="collapseAboutPHQ9" class="accordion-collapse collapse show" data-bs-parent="#phq9InfoAccordion">
                        <div class="accordion-body">
                            <p>The Patient Health Questionnaire-9 (PHQ-9) is a self-reported questionnaire for screening and measuring the severity of depression. It consists of 9 items, each scored from 0 to 3, providing a total score ranging from 0 to 27.</p>
                            <p><strong>Scoring:</strong></p>
                            <ul>
                                <li>0-4: Minimal depression</li>
                                <li>5-9: Mild depression</li>
                                <li>10-14: Moderate depression</li>
                                <li>15-19: Moderately severe depression</li>
                                <li>20-27: Severe depression</li>
                            </ul>
                            <p><strong>Suicide Risk Assessment:</strong></p>
                            <ul>
                                <li>Question 9 score = 0: Low risk</li>
                                <li>Question 9 score = 1-2: Moderate risk</li>
                                <li>Question 9 score = 3: High risk (immediate evaluation needed)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ICD-10 Diagnoses -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="phq9ICD10">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePHQ9ICD10">
                            Possible ICD-10 Diagnoses
                        </button>
                    </h2>
                    <div id="collapsePHQ9ICD10" class="accordion-collapse collapse" data-bs-parent="#phq9InfoAccordion">
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
                                            <td>F32.0</td>
                                            <td>Mild Depressive Episode</td>
                                            <td>PHQ-9 score 5-9 with 2+ core symptoms</td>
                                        </tr>
                                        <tr>
                                            <td>F32.1</td>
                                            <td>Moderate Depressive Episode</td>
                                            <td>PHQ-9 score 10-14 with 2+ core symptoms</td>
                                        </tr>
                                        <tr>
                                            <td>F32.2</td>
                                            <td>Severe Depressive Episode</td>
                                            <td>PHQ-9 score 15+ with 3+ core symptoms</td>
                                        </tr>
                                        <tr>
                                            <td>F33.0</td>
                                            <td>Recurrent Depressive Disorder</td>
                                            <td>Multiple episodes of depression</td>
                                        </tr>
                                        <tr>
                                            <td>F41.2</td>
                                            <td>Mixed Anxiety and Depressive Disorder</td>
                                            <td>Both anxiety and depression symptoms</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="phq9Resources">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePHQ9Resources">
                            Resources & Links
                        </button>
                    </h2>
                    <div id="collapsePHQ9Resources" class="accordion-collapse collapse" data-bs-parent="#phq9InfoAccordion">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li><a href="https://www.phqscreeners.com/select-screener" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>PHQ Screeners Official Site
                                </a></li>
                                <li><a href="https://www.psychiatry.org/File%20Library/Psychiatrists/Practice/DSM/APA_DSM-5-Depression.pdf" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>DSM-5 Depression Criteria
                                </a></li>
                                <li><a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-pdf me-2"></i>Cebuano PHQ-9 PDF (Available upon request)
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
function calculatePHQ9Score() {
    let total = 0;
    let answeredQuestions = 0;
    
    // Calculate total score
    for (let i = 1; i <= 9; i++) {
        const value = $('input[name="phq9_q' + i + '"]:checked').val();
        if (value !== undefined) {
            total += parseInt(value);
            answeredQuestions++;
        }
    }
    
    if (answeredQuestions < 9) {
        alert('Please answer all 9 PHQ-9 questions before calculating your score.');
        return;
    }
    
    // Determine severity
    let severity = '';
    let remarks = '';
    let suicideRisk = '';
    
    if (total >= 0 && total <= 4) {
        severity = 'Minimal Depression';
        remarks = 'No significant depressive symptoms. Continue monitoring if risk factors are present.';
        suicideRisk = 'Low Risk';
    } else if (total >= 5 && total <= 9) {
        severity = 'Mild Depression';
        remarks = 'May reflect normal mood variation or early signs of depression. Consider psychoeducation and self-care strategies. Monitor for symptom progression.';
        suicideRisk = 'Low Risk';
    } else if (total >= 10 && total <= 14) {
        severity = 'Moderate Depression';
        remarks = 'Likely to impact daily functioning. Consider brief counseling, referral for psychological evaluation, or antidepressant medication if clinically indicated.';
        suicideRisk = 'Moderate Risk';
    } else if (total >= 15 && total <= 19) {
        severity = 'Moderately Severe Depression';
        remarks = 'Significant functional impairment likely. Prompt referral for mental health services recommended. May require both medication and psychotherapy.';
        suicideRisk = 'Moderate Risk';
    } else if (total >= 20 && total <= 27) {
        severity = 'Severe Depression';
        remarks = 'Severe functional impairment. Urgent referral for mental health services essential. May require hospitalization if safety concerns exist.';
        suicideRisk = 'High Risk';
    }
    
    // Check suicide risk based on question 9
    const question9Score = parseInt($('input[name="phq9_q9"]:checked').val()) || 0;
    if (question9Score >= 1) {
        suicideRisk = question9Score === 3 ? 'HIGH RISK - Immediate evaluation needed' : 'Moderate Risk - Monitor closely';
        remarks += ' **SUICIDE RISK ASSESSMENT REQUIRED**';
    }
    
    // Display results
    $('#phq9_total_score').text(total);
    $('#depression_severity').text(severity);
    $('#suicide_risk').text(suicideRisk);
    $('#phq9_remarks').text(remarks);
    
    // Update badge color based on suicide risk
    const riskBadge = $('#suicide_risk');
    riskBadge.removeClass('bg-info bg-warning bg-danger');
    if (suicideRisk.includes('HIGH RISK')) {
        riskBadge.addClass('bg-danger');
    } else if (suicideRisk.includes('Moderate')) {
        riskBadge.addClass('bg-warning');
    } else {
        riskBadge.addClass('bg-info');
    }
    
    $('#phq9-results').show();
    
    // Scroll to results
    $('#phq9-results')[0].scrollIntoView({ behavior: 'smooth' });
}

function savePHQ9Assessment() {
    // Ensure all answers are provided and compute total
    let total = 0;
    let answered = 0;
    for (let i = 1; i <= 9; i++) {
        const val = $(`input[name="phq9_q${i}"]:checked`).val();
        if (val !== undefined) {
            total += parseInt(val);
            answered++;
        }
    }
    if (answered < 9) {
        alert('Please answer all 9 PHQ-9 questions before saving.');
        return;
    }

    const formData = new FormData($('#phq9-form')[0]);
    formData.append('total_score', total);
    
    $.ajax({
        url: '{{ route("phq9-assessments.store") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('PHQ-9 assessment saved');
            alert('PHQ-9 assessment saved successfully!');
        },
        error: function(xhr) {
            console.error('Error saving PHQ-9 assessment:', xhr.responseText);
            alert('Error saving assessment. Please try again.');
        }
    });
}

// Navigation function handled by parent stress_management.blade.php

// Load existing PHQ-9 data
window.loadPHQ9Data = function() {
    $.ajax({
        url: '{{ route("phq9-assessments.show", $patient->id) }}',
        method: 'GET',
        success: function(resp) {
            if (resp && resp.success && resp.data) {
                const data = resp.data;
                for (let i = 1; i <= 9; i++) {
                    if (data[`phq9_q${i}`] !== null && data[`phq9_q${i}`] !== undefined) {
                        $(`input[name="phq9_q${i}"][value="${data[`phq9_q${i}`]}"]`).prop('checked', true);
                    }
                }
                if (data.total_score !== undefined) $('#phq9_total_score').text(data.total_score);
                if (data.severity) $('#depression_severity').text(data.severity);
                if (data.suicide_risk) $('#suicide_risk').text(data.suicide_risk);
                if (data.remarks) $('#phq9_remarks').text(data.remarks);
            }
        },
        error: function(xhr) {
            console.log('No existing PHQ-9 data found');
        }
    });
}
</script> 