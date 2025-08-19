<div class="container-fluid">
    <!-- Family APGAR Assessment -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-home me-2"></i>Family APGAR-5</h4>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">Please rate how satisfied you are with each of the following aspects of your family relationships.</p>
            
            <form id="family-apgar-form">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="assessment_type" value="family_apgar">
                
                <!-- Family APGAR Questions -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 60%;">Question</th>
                                        <th class="text-center">Almost Always<br>(2)</th>
                                        <th class="text-center">Some of the Time<br>(1)</th>
                                        <th class="text-center">Hardly Ever<br>(0)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1. I am satisfied I can turn to my family for help when something is troubling me.</td>
                                        <td class="text-center"><input type="radio" name="apgar_q1" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q1" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q1" value="0" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>2. I am satisfied with the way my family talks over things with me and shares problems with me.</td>
                                        <td class="text-center"><input type="radio" name="apgar_q2" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q2" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q2" value="0" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>3. I am satisfied that my family accepts and supports my decision to take on new activities.</td>
                                        <td class="text-center"><input type="radio" name="apgar_q3" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q3" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q3" value="0" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>4. I am satisfied with the way my family expresses their affection to me and responds to my emotions.</td>
                                        <td class="text-center"><input type="radio" name="apgar_q4" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q4" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q4" value="0" class="form-check-input"></td>
                                    </tr>
                                    <tr>
                                        <td>5. I am satisfied with the way my family and I share time together.</td>
                                        <td class="text-center"><input type="radio" name="apgar_q5" value="2" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q5" value="1" class="form-check-input"></td>
                                        <td class="text-center"><input type="radio" name="apgar_q5" value="0" class="form-check-input"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4">
                    <button type="button" class="btn btn-success me-2" onclick="calculateFamilyAPGARScore()">
                        <i class="fas fa-calculator me-1"></i>Calculate Family APGAR Score
                    </button>
                    <button type="button" class="btn btn-primary me-2" onclick="saveFamilyAPGARAssessment()">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="backToSocialInitial()">
                        <i class="fas fa-arrow-left me-1"></i>Back to Initial Assessment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Family APGAR Results Section -->
    <div id="family-apgar-results" class="card mb-4" style="display: none;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Family APGAR Results</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 id="apgar_total_score">0</h3>
                        <p class="text-muted">Total Score</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h4 id="family_functioning" class="text-primary">Highly Functional</h4>
                        <p class="text-muted">Family Functioning</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span id="functioning_category" class="badge bg-info fs-6">Highly Functional</span>
                        <p class="text-muted mt-2">Category</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6>Remarks:</h6>
                <p id="apgar_remarks" class="text-muted">Assessment remarks will appear here.</p>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Additional Information</h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="apgarInfoAccordion">
                <!-- About Family APGAR -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="aboutAPGAR">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAboutAPGAR">
                            About the Family APGAR
                        </button>
                    </h2>
                    <div id="collapseAboutAPGAR" class="accordion-collapse collapse show" data-bs-parent="#apgarInfoAccordion">
                        <div class="accordion-body">
                            <p>The Family APGAR (Adaptation, Partnership, Growth, Affection, and Resolve) is a self-reported questionnaire designed to assess family functioning. It consists of 5 items, each scored from 0 to 2, providing a total score ranging from 0 to 10.</p>
                            <p><strong>Scoring:</strong></p>
                            <ul>
                                <li>7-10: Highly functional family</li>
                                <li>4-6: Moderately functional family</li>
                                <li>0-3: Severely dysfunctional family</li>
                            </ul>
                            <p><strong>APGAR Components:</strong></p>
                            <ul>
                                <li><strong>A</strong>daptation: Family's ability to use and share resources</li>
                                <li><strong>P</strong>artnership: How family members share decision making</li>
                                <li><strong>G</strong>rowth: How family members support each other's growth</li>
                                <li><strong>A</strong>ffection: How family members express emotions</li>
                                <li><strong>R</strong>esolve: How family members share time together</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ICD-10 Diagnoses -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="apgarICD10">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAPGARICD10">
                            Possible ICD-10 Diagnoses
                        </button>
                    </h2>
                    <div id="collapseAPGARICD10" class="accordion-collapse collapse" data-bs-parent="#apgarInfoAccordion">
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
                                            <td>Z63.0</td>
                                            <td>Problems in Relationship with Spouse or Partner</td>
                                            <td>Low APGAR score with marital issues</td>
                                        </tr>
                                        <tr>
                                            <td>Z63.1</td>
                                            <td>Problems in Relationship with In-laws</td>
                                            <td>Family conflicts with extended family</td>
                                        </tr>
                                        <tr>
                                            <td>Z63.8</td>
                                            <td>Other Specified Problems Related to Primary Support Group</td>
                                            <td>General family dysfunction</td>
                                        </tr>
                                        <tr>
                                            <td>F43.2</td>
                                            <td>Adjustment Disorders</td>
                                            <td>Family stress affecting individual</td>
                                        </tr>
                                        <tr>
                                            <td>F60.3</td>
                                            <td>Emotionally Unstable Personality Disorder</td>
                                            <td>Family dysfunction with personality issues</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="apgarResources">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAPGARResources">
                            Resources & Links
                        </button>
                    </h2>
                    <div id="collapseAPGARResources" class="accordion-collapse collapse" data-bs-parent="#apgarInfoAccordion">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li><a href="https://www.ncbi.nlm.nih.gov/pmc/articles/PMC1804303/" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>Family APGAR Research Paper
                                </a></li>
                                <li><a href="https://www.aafp.org/afp/2001/0815/p595.html" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>Family Assessment Guidelines
                                </a></li>
                                <li><a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-pdf me-2"></i>Cebuano Family APGAR PDF (Available upon request)
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
function calculateFamilyAPGARScore() {
    let total = 0;
    let answeredQuestions = 0;
    
    // Calculate total score
    for (let i = 1; i <= 5; i++) {
        const value = $('input[name="apgar_q' + i + '"]:checked').val();
        if (value !== undefined) {
            total += parseInt(value);
            answeredQuestions++;
        }
    }
    
    if (answeredQuestions < 5) {
        alert('Please answer all 5 Family APGAR questions before calculating your score.');
        return;
    }
    
    // Determine family functioning level
    let familyFunctioning = '';
    let category = '';
    let remarks = '';
    let badgeClass = '';
    
    if (total >= 7 && total <= 10) {
        familyFunctioning = 'Highly Functional Family';
        category = 'Highly Functional';
        remarks = 'Your family appears to be functioning well with good communication, support, and emotional connection. Continue nurturing these positive family dynamics and relationships.';
        badgeClass = 'bg-success';
    } else if (total >= 4 && total <= 6) {
        familyFunctioning = 'Moderately Functional Family';
        category = 'Moderately Functional';
        remarks = 'Your family is functioning at a moderate level. There may be areas for improvement in communication, support, or emotional expression. Consider family counseling or open discussions to strengthen family bonds.';
        badgeClass = 'bg-warning';
    } else if (total >= 0 && total <= 3) {
        familyFunctioning = 'Severely Dysfunctional Family';
        category = 'Severely Dysfunctional';
        remarks = 'Your family may be experiencing significant dysfunction. Professional family therapy is strongly recommended to address communication issues, improve support systems, and strengthen family relationships.';
        badgeClass = 'bg-danger';
    }
    
    // Display results
    $('#apgar_total_score').text(total);
    $('#family_functioning').text(familyFunctioning);
    $('#functioning_category').text(category);
    $('#apgar_remarks').text(remarks);
    
    // Update badge color
    const categoryBadge = $('#functioning_category');
    categoryBadge.removeClass('bg-success bg-warning bg-danger');
    categoryBadge.addClass(badgeClass);
    
    $('#family-apgar-results').show();
    
    // Scroll to results
    $('#family-apgar-results')[0].scrollIntoView({ behavior: 'smooth' });
}

function saveFamilyAPGARAssessment() {
    // compute total and ensure all answered
    let total = 0; let answered = 0;
    for (let i = 1; i <= 5; i++) {
        const v = $(`input[name="apgar_q${i}"]:checked`).val();
        if (v !== undefined) { total += parseInt(v); answered++; }
    }
    if (answered < 5) { alert('Please answer all 5 Family APGAR questions before saving.'); return; }
    const formData = new FormData($('#family-apgar-form')[0]);
    formData.append('total_score', total);
    
    $.ajax({
        url: '{{ route("family-apgar-assessments.store") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Family APGAR assessment saved');
            alert('Family APGAR assessment saved successfully!');
        },
        error: function(xhr) {
            console.error('Error saving Family APGAR assessment:', xhr.responseText);
            alert('Error saving assessment. Please try again.');
        }
    });
}

// Load existing Family APGAR data
window.loadFamilyAPGARData = function() {
    $.ajax({
        url: '{{ route("family-apgar-assessments.show", $patient->id) }}',
        method: 'GET',
        success: function(resp) {
            if (resp && resp.success && resp.data) {
                const data = resp.data;
                for (let i = 1; i <= 5; i++) {
                    if (data[`apgar_q${i}`] !== null && data[`apgar_q${i}`] !== undefined) {
                        $(`input[name="apgar_q${i}"][value="${data[`apgar_q${i}`]}"]`).prop('checked', true);
                    }
                }
                if (data.total_score !== undefined) $('#apgar_total_score').text(data.total_score);
                if (data.family_functioning) $('#family_functioning').text(data.family_functioning);
                if (data.functioning_category) $('#functioning_category').text(data.functioning_category);
                if (data.remarks) $('#apgar_remarks').text(data.remarks);
            }
        },
        error: function(xhr) {
            console.log('No existing Family APGAR data found');
        }
    });
}
</script> 