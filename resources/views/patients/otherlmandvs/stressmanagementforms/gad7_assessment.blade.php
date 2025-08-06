<div class="container-fluid">
    <!-- GAD-7 Assessment -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Generalized Anxiety Disorder Questionnaire (GAD-7)</h4>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">Over the last two weeks, how often have you been bothered by the following problems?</p>
            
            <form id="gad7-form">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="assessment_type" value="gad7">
                
                <!-- GAD-7 Questions -->
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
                                        <td>1. Feeling nervous, anxious, or on edge</td>
                                        <td class="text-center"><input type="radio" name="gad7_q1" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q1" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q1" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q1" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>2. Not being able to stop or control worrying</td>
                                        <td class="text-center"><input type="radio" name="gad7_q2" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q2" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q2" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q2" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>3. Worrying too much about different things</td>
                                        <td class="text-center"><input type="radio" name="gad7_q3" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q3" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q3" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q3" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>4. Trouble relaxing</td>
                                        <td class="text-center"><input type="radio" name="gad7_q4" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q4" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q4" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q4" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>5. Being so restless that it is hard to sit still</td>
                                        <td class="text-center"><input type="radio" name="gad7_q5" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q5" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q5" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q5" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>6. Becoming easily annoyed or irritable</td>
                                        <td class="text-center"><input type="radio" name="gad7_q6" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q6" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q6" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q6" value="3" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>7. Feeling afraid, as if something awful might happen</td>
                                        <td class="text-center"><input type="radio" name="gad7_q7" value="0" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q7" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q7" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="gad7_q7" value="3" class="form-check-input"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Difficulty Assessment -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h6>If you checked any problems, how difficult have they made it for you to do your work, take care of things at home, or get along with other people?</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gad7_difficulty" id="difficulty_none" value="not_difficult">
                            <label class="form-check-label" for="difficulty_none">Not difficult at all</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gad7_difficulty" id="difficulty_somewhat" value="somewhat_difficult">
                            <label class="form-check-label" for="difficulty_somewhat">Somewhat difficult</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gad7_difficulty" id="difficulty_very" value="very_difficult">
                            <label class="form-check-label" for="difficulty_very">Very difficult</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gad7_difficulty" id="difficulty_extremely" value="extremely_difficult">
                            <label class="form-check-label" for="difficulty_extremely">Extremely difficult</label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4">
                    <button type="button" class="btn btn-success me-2" onclick="calculateGAD7Score()">
                        <i class="fas fa-calculator me-1"></i>Calculate GAD-7 Score
                    </button>
                    <button type="button" class="btn btn-primary me-2" onclick="saveGAD7Assessment()">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="backToInitial()">
                        <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- GAD-7 Results Section -->
    <div id="gad7-results" class="card mb-4" style="display: none;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>GAD-7 Results</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 id="gad7_total_score">0</h3>
                        <p class="text-muted">Total Score</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h4 id="anxiety_severity" class="text-primary">Mild Anxiety</h4>
                        <p class="text-muted">Severity Level</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span id="difficulty_level" class="badge bg-info fs-6">Not difficult</span>
                        <p class="text-muted mt-2">Functional Impact</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6>Remarks:</h6>
                <p id="gad7_remarks" class="text-muted">Assessment remarks will appear here.</p>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Additional Information</h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="gad7InfoAccordion">
                <!-- About GAD-7 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="aboutGAD7">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAboutGAD7">
                            About the GAD-7
                        </button>
                    </h2>
                    <div id="collapseAboutGAD7" class="accordion-collapse collapse show" data-bs-parent="#gad7InfoAccordion">
                        <div class="accordion-body">
                            <p>The Generalized Anxiety Disorder-7 (GAD-7) is a self-reported questionnaire for screening and measuring the severity of generalized anxiety disorder. It consists of 7 items, each scored from 0 to 3, providing a total score ranging from 0 to 21.</p>
                            <p><strong>Scoring:</strong></p>
                            <ul>
                                <li>0-5: Mild anxiety</li>
                                <li>6-10: Moderate anxiety</li>
                                <li>11-14: Moderately severe anxiety</li>
                                <li>15-21: Severe anxiety</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ICD-10 Diagnoses -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="gad7ICD10">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGAD7ICD10">
                            Possible ICD-10 Diagnoses
                        </button>
                    </h2>
                    <div id="collapseGAD7ICD10" class="accordion-collapse collapse" data-bs-parent="#gad7InfoAccordion">
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
                                            <td>F41.1</td>
                                            <td>Generalized Anxiety Disorder</td>
                                            <td>GAD-7 score ≥ 10 with persistent worry</td>
                                        </tr>
                                        <tr>
                                            <td>F41.0</td>
                                            <td>Panic Disorder</td>
                                            <td>Recurrent panic attacks</td>
                                        </tr>
                                        <tr>
                                            <td>F41.9</td>
                                            <td>Anxiety Disorder, Unspecified</td>
                                            <td>Anxiety symptoms not meeting specific criteria</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="gad7Resources">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGAD7Resources">
                            Resources & Links
                        </button>
                    </h2>
                    <div id="collapseGAD7Resources" class="accordion-collapse collapse" data-bs-parent="#gad7InfoAccordion">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li><a href="https://therapymeetsnumbers.com/made-to-measure-gad-7/" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>GAD-7 Assessment Guide
                                </a></li>
                                <li><a href="https://www.phqscreeners.com/select-screener" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>PHQ Screeners
                                </a></li>
                                <li><a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-pdf me-2"></i>Cebuano GAD-7 PDF (Available upon request)
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
function calculateGAD7Score() {
    let total = 0;
    let answeredQuestions = 0;
    
    // Calculate total score
    for (let i = 1; i <= 7; i++) {
        const value = $('input[name="gad7_q' + i + '"]:checked').val();
        if (value !== undefined) {
            total += parseInt(value);
            answeredQuestions++;
        }
    }
    
    if (answeredQuestions < 7) {
        alert('Please answer all 7 GAD-7 questions before calculating your score.');
        return;
    }
    
    // Determine severity
    let severity = '';
    let remarks = '';
    
    if (total >= 0 && total <= 5) {
        severity = 'Mild Anxiety';
        remarks = 'May reflect normal worry or early signs of anxiety. Typically requires no treatment, but education and self-care strategies (e.g., sleep hygiene, relaxation) are advised. Monitor symptoms if risk factors are present.';
    } else if (total >= 6 && total <= 10) {
        severity = 'Moderate Anxiety';
        remarks = 'May interfere with functioning. Consider psychoeducation, brief counseling, or referral for psychological evaluation depending on patient needs. Reassess after supportive interventions.';
    } else if (total >= 11 && total <= 14) {
        severity = 'Moderately Severe Anxiety';
        remarks = 'Likely to impact daily life. Further evaluation is recommended. May benefit from structured therapy (e.g., CBT) and/or pharmacological treatment if clinically indicated. Monitor symptom progression.';
    } else if (total >= 15 && total <= 21) {
        severity = 'Severe Anxiety';
        remarks = 'Strong indication of generalized anxiety disorder or related conditions. Prompt referral for mental health services is essential. May require both medication and psychotherapy. Urgent care may be needed if functional impairment is high.';
    }
    
    // Get difficulty level
    const difficulty = $('input[name="gad7_difficulty"]:checked').val();
    let difficultyText = 'Not assessed';
    
    if (difficulty === 'not_difficult') difficultyText = 'Not difficult at all';
    else if (difficulty === 'somewhat_difficult') difficultyText = 'Somewhat difficult';
    else if (difficulty === 'very_difficult') difficultyText = 'Very difficult';
    else if (difficulty === 'extremely_difficult') difficultyText = 'Extremely difficult';
    
    // Display results
    $('#gad7_total_score').text(total);
    $('#anxiety_severity').text(severity);
    $('#difficulty_level').text(difficultyText);
    $('#gad7_remarks').text(remarks);
    $('#gad7-results').show();
    
    // Scroll to results
    $('#gad7-results')[0].scrollIntoView({ behavior: 'smooth' });
}

function saveGAD7Assessment() {
    const formData = new FormData($('#gad7-form')[0]);
    
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
            console.log('GAD-7 assessment saved');
            alert('GAD-7 assessment saved successfully!');
        },
        error: function(xhr) {
            console.error('Error saving GAD-7 assessment:', xhr.responseText);
            alert('Error saving assessment. Please try again.');
        }
    });
}

// Navigation function handled by parent stress_management.blade.php

// Load existing GAD-7 data
function loadGAD7Data() {
    $.ajax({
        url: '{{ route("stressManagement.getDataByPatient", $patient->id) }}',
        method: 'GET',
        success: function(data) {
            if (data && data.gad7_data) {
                // Populate GAD-7 form fields
                for (let i = 1; i <= 7; i++) {
                    if (data.gad7_data[`gad7_q${i}`]) {
                        $(`input[name="gad7_q${i}"][value="${data.gad7_data[`gad7_q${i}`]}"]`).prop('checked', true);
                    }
                }
                
                if (data.gad7_data.gad7_difficulty) {
                    $(`input[name="gad7_difficulty"][value="${data.gad7_data.gad7_difficulty}"]`).prop('checked', true);
                }
            }
        },
        error: function(xhr) {
            console.log('No existing GAD-7 data found');
        }
    });
}
</script> 