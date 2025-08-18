<div class="container-fluid">
    <!-- SCS-8 Assessment -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-network-wired me-2"></i>Social Connectedness Scale (SCS-8)</h4>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">Circle the answer that shows how much you agree or disagree with each of the following statements.</p>
            
            <form id="scs8-form">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="assessment_type" value="scs8">
                
                <!-- SCS-8 Questions -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50%;">Question</th>
                                        <th class="text-center">Strongly<br>Agree (1)</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">Strongly<br>Disagree (6)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1. I feel disconnected from the world around me.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q1" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q1" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q1" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q1" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q1" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q1" value="6" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>2. Even around people I know, I don't feel that I really belong.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q2" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q2" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q2" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q2" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q2" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q2" value="6" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>3. I feel so distant from people.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q3" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q3" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q3" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q3" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q3" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q3" value="6" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>4. I have no sense of togetherness with my peers.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q4" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q4" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q4" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q4" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q4" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q4" value="6" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>5. I don't feel related to anyone.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q5" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q5" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q5" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q5" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q5" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q5" value="6" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>6. I catch myself losing all sense of connectedness with society.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q6" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q6" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q6" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q6" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q6" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q6" value="6" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>7. Even among my friends, there is no sense of brother/sisterhood.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q7" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q7" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q7" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q7" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q7" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q7" value="6" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>8. I don't feel that I participate with anyone or any group.</td>
                                        <td class="text-center"><input type="radio" name="scs8_q8" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q8" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q8" value="3" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q8" value="4" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q8" value="5" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="scs8_q8" value="6" class="form-check-input"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4">
                    <button type="button" class="btn btn-success me-2" onclick="calculateSCS8Score()">
                        <i class="fas fa-calculator me-1"></i>Calculate SCS-8 Score
                    </button>
                    <button type="button" class="btn btn-primary me-2" onclick="saveSCS8Assessment()">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="backToSocialInitial()">
                        <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCS-8 Results Section -->
    <div id="scs8-results" class="card mb-4" style="display: none;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>SCS-8 Results</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 id="scs8_total_score">0</h3>
                        <p class="text-muted">Total Score</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h4 id="connectedness_level" class="text-primary">Low Connectedness</h4>
                        <p class="text-muted">Connectedness Level</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span id="connectedness_category" class="badge bg-info fs-6">Low</span>
                        <p class="text-muted mt-2">Category</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6>Remarks:</h6>
                <p id="scs8_remarks" class="text-muted">Assessment remarks will appear here.</p>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Additional Information</h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="scs8InfoAccordion">
                <!-- About SCS-8 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="aboutSCS8">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAboutSCS8">
                            About the SCS-8
                        </button>
                    </h2>
                    <div id="collapseAboutSCS8" class="accordion-collapse collapse show" data-bs-parent="#scs8InfoAccordion">
                        <div class="accordion-body">
                            <p>The Social Connectedness Scale (SCS-8) is a self-reported questionnaire designed to measure an individual's sense of connectedness with the social world. It consists of 8 items, each scored from 1 to 6, providing a total score ranging from 8 to 48.</p>
                            <p><strong>Scoring:</strong></p>
                            <ul>
                                <li>8-23: Low connectedness</li>
                                <li>24-35: Moderate connectedness</li>
                                <li>36-48: High connectedness</li>
                            </ul>
                            <p><strong>Note:</strong> All items are negatively worded. A lower score indicates lower social connectedness, while a higher score indicates higher social connectedness.</p>
                        </div>
                    </div>
                </div>

                <!-- ICD-10 Diagnoses -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="scs8ICD10">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSCS8ICD10">
                            Possible ICD-10 Diagnoses
                        </button>
                    </h2>
                    <div id="collapseSCS8ICD10" class="accordion-collapse collapse" data-bs-parent="#scs8InfoAccordion">
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
                                            <td>F60.6</td>
                                            <td>Anxious (Avoidant) Personality Disorder</td>
                                            <td>Low SCS-8 score with social avoidance</td>
                                        </tr>
                                        <tr>
                                            <td>F60.3</td>
                                            <td>Emotionally Unstable Personality Disorder</td>
                                            <td>Low connectedness with emotional instability</td>
                                        </tr>
                                        <tr>
                                            <td>F41.1</td>
                                            <td>Generalized Anxiety Disorder</td>
                                            <td>Low connectedness with anxiety symptoms</td>
                                        </tr>
                                        <tr>
                                            <td>F32.1</td>
                                            <td>Moderate Depressive Episode</td>
                                            <td>Low connectedness with depression</td>
                                        </tr>
                                        <tr>
                                            <td>Z60.0</td>
                                            <td>Problems of Adjustment to Life-cycle Transitions</td>
                                            <td>Recent life changes affecting social connectedness</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="scs8Resources">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSCS8Resources">
                            Resources & Links
                        </button>
                    </h2>
                    <div id="collapseSCS8Resources" class="accordion-collapse collapse" data-bs-parent="#scs8InfoAccordion">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li><a href="https://www.researchgate.net/publication/232443089_The_Social_Connectedness_Scale_Revised" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>SCS-8 Research Paper
                                </a></li>
                                <li><a href="https://www.psychologytoday.com/us/blog/tech-happy-life/201712/social-connectedness" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>Social Connectedness Information
                                </a></li>
                                <li><a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-pdf me-2"></i>Cebuano SCS-8 PDF (Available upon request)
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
function calculateSCS8Score() {
    let total = 0;
    let answeredQuestions = 0;
    
    // Calculate total score
    for (let i = 1; i <= 8; i++) {
        const value = $('input[name="scs8_q' + i + '"]:checked').val();
        if (value !== undefined) {
            total += parseInt(value);
            answeredQuestions++;
        }
    }
    
    if (answeredQuestions < 8) {
        alert('Please answer all 8 SCS-8 questions before calculating your score.');
        return;
    }
    
    // Determine connectedness level
    let connectednessLevel = '';
    let category = '';
    let remarks = '';
    let badgeClass = '';
    
    if (total >= 8 && total <= 23) {
        connectednessLevel = 'Low Connectedness';
        category = 'Low';
        remarks = 'You may be experiencing feelings of social isolation or disconnection. Consider reaching out to friends, family, or mental health professionals for support. Social activities and community involvement may help improve your sense of connectedness.';
        badgeClass = 'bg-danger';
    } else if (total >= 24 && total <= 35) {
        connectednessLevel = 'Moderate Connectedness';
        category = 'Moderate';
        remarks = 'Your social connectedness is within a moderate range. You may benefit from strengthening existing relationships or developing new social connections. Consider joining social groups or activities that interest you.';
        badgeClass = 'bg-warning';
    } else if (total >= 36 && total <= 48) {
        connectednessLevel = 'High Connectedness';
        category = 'High';
        remarks = 'You appear to have a strong sense of social connectedness. Continue nurturing your relationships and social networks. Your positive social connections likely contribute to your overall well-being.';
        badgeClass = 'bg-success';
    }
    
    // Display results
    $('#scs8_total_score').text(total);
    $('#connectedness_level').text(connectednessLevel);
    $('#connectedness_category').text(category);
    $('#scs8_remarks').text(remarks);
    
    // Update badge color
    const categoryBadge = $('#connectedness_category');
    categoryBadge.removeClass('bg-danger bg-warning bg-success');
    categoryBadge.addClass(badgeClass);
    
    $('#scs8-results').show();
    
    // Scroll to results
    $('#scs8-results')[0].scrollIntoView({ behavior: 'smooth' });
}

function saveSCS8Assessment() {
    // compute total and ensure all answered
    let total = 0; let answered = 0;
    for (let i = 1; i <= 8; i++) {
        const v = $(`input[name="scs8_q${i}"]:checked`).val();
        if (v !== undefined) { total += parseInt(v); answered++; }
    }
    if (answered < 8) { alert('Please answer all 8 SCS-8 questions before saving.'); return; }
    const formData = new FormData($('#scs8-form')[0]);
    formData.append('total_score', total);
    
    $.ajax({
        url: '{{ route("scs8-assessments.store") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('SCS-8 assessment saved');
            alert('SCS-8 assessment saved successfully!');
        },
        error: function(xhr) {
            console.error('Error saving SCS-8 assessment:', xhr.responseText);
            alert('Error saving assessment. Please try again.');
        }
    });
}

// Load existing SCS-8 data
window.loadSCS8Data = function() {
    $.ajax({
        url: '{{ route("scs8-assessments.show", $patient->id) }}',
        method: 'GET',
        success: function(resp) {
            if (resp && resp.success && resp.data) {
                const data = resp.data;
                for (let i = 1; i <= 8; i++) {
                    if (data[`scs8_q${i}`] !== null && data[`scs8_q${i}`] !== undefined) {
                        $(`input[name="scs8_q${i}"][value="${data[`scs8_q${i}`]}"]`).prop('checked', true);
                    }
                }
                if (data.total_score !== undefined) $('#scs8_total_score').text(data.total_score);
                if (data.connectedness_level) $('#connectedness_level').text(data.connectedness_level);
                if (data.connectedness_category) $('#connectedness_category').text(data.connectedness_category);
                if (data.remarks) $('#scs8_remarks').text(data.remarks);
            }
        },
        error: function(xhr) {
            console.log('No existing SCS-8 data found');
        }
    });
}
</script> 