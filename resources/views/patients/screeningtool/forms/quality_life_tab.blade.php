<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Quality of Life Results</h5>

        <button type="button" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 mb-3 cursor-pointer transition-colors duration-300" data-bs-toggle="modal" data-bs-target="#QualityOfLifeModal">
            Add Quality of Life
        </button>
    </div>
		<div class="alert alert-info">
            <h6 class="alert-heading mb-2">EQ-5D-5L Health Status Assessment</h6>
            <p class="mb-2">A standardized measure of health status with two components:</p>
            <ol class="mb-2">
                <li><strong>Descriptive System:</strong> Five dimensions (MOBILITY, SELF-CARE, USUAL ACTIVITIES, PAIN/DISCOMFORT, ANXIETY/DEPRESSION) with five severity levels each</li>
                <li><strong>Visual Analogue Scale (VAS):</strong> Patient rates perceived health from 0 (worst) to 100 (best)</li>
            </ol>

            <h6 class="alert-heading mb-2">Scoring System</h6>
            <p class="mb-2">Health states are represented by 5-digit codes (e.g., 12345) or index values based on population preferences. Total possible states: 3,125.</p>

            <h6 class="alert-heading mb-2">Reference Materials</h6>
            <ul class="mb-2">
                <li><a href="https://docs.google.com/spreadsheets/d/1r11CX2F7N8sA1sbG-_vMw_YiVNUzEZfU/edit?usp=sharing&ouid=107953619828181291909&rtpof=true&sd=true" target="_blank">Philippines Value Set Estimation</a></li>
                <li><a href="https://euroqol.org/wp-content/uploads/2023/11/EQ-5D-5LUserguide-23-07.pdf" target="_blank">EQ-5D-5L User Guide</a></li>
                <li><a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC9356948/#sec22" target="_blank">Research Article</a></li>
            </ul>

            <h6 class="alert-heading mb-2">Common ICD-10 Diagnoses</h6>
            <div class="row">
                <div class="col-md-6">
                    <ul class="mb-2">
                        <li>Z73.6 - Limitation of activities due to disability</li>
                        <li>Z73.2 - Lack of relaxation and leisure</li>
                        <li>M54.5 - Chronic low back pain</li>
                        <li>Z73.1 - Burn-out</li>
                        <li>Z56.6 - Other physical and mental strain related to work</li>
                        <li>R53.1 - Weakness and fatigue</li>
                        <li>M79.1 - Myalgia</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="mb-2">
                        <li>F41.9 - Anxiety disorder, unspecified</li>
                        <li>F32.0 - Mild depressive episode</li>
                        <li>F32.1 - Moderate depressive episode</li>
                        <li>F32.2 - Severe depressive episode without psychotic symptoms</li>
                        <li>F32.3 - Severe depressive episode with psychotic symptoms</li>
                        <li>F43.2 - Adjustment disorder with depressed mood</li>
                        <li>F43.21 - Adjustment disorder with mixed anxiety and depressed mood</li>
                        <li>F41.2 - Mixed anxiety and depressive disorder</li>
                        <li>R45.2 - Unhappiness</li>
                    </ul>
                </div>
            </div>
        =</div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Score</th>
                <th>Health Today</th>
                <th>ICD-10</th>
            </tr>
        </thead>
        <tbody id="qualityOfLifeTableBody">
            <!-- Data will be inserted here dynamically -->
            </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="QualityOfLifeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quality of Life Questionnaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="qualityOfLifeForm" method="POST">
                	@csrf
                	<input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
                    <div class="mb-3">
				        <p class="fw-bold">MOBILITY</p>
				        <label class="form-check"><input type="radio" name="mobility" value="1" required> No problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="2"> Slight problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="3"> Moderate problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="4"> Severe problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="5"> Unable to walk</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">SELF-CARE</p>
				        <label class="form-check"><input type="radio" name="self_care" value="1" required> No problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="2"> Slight problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="3"> Moderate problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="4"> Severe problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="5"> Unable to wash or dress myself</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">USUAL ACTIVITIES (e.g., work, study, household, family or leisure activities)</p>
				        <label class="form-check"><input type="radio" name="usual_activities" value="1" required> No problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="2"> Slight problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="3"> Moderate problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="4"> Severe problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="5"> Unable to do my usual activities</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">PAIN/DISCOMFORT</p>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="1" required> No pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="2"> Slight pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="3"> Moderate pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="4"> Severe pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="5"> Extreme pain or discomfort</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">ANXIETY/DEPRESSION</p>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="1" required> Not anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="2"> Slightly anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="3"> Moderately anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="4"> Very anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="5"> Extremely anxious or depressed</label>
				    </div>

				     <div class="mb-3">
                            <label class="fw-bold">Health Today (0-100)</label>
                            <input type="number" name="health_today" class="form-control" min="0" max="100" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">ICD-10 Code</label>
                            <input type="text" name="icd_10" class="form-control" value="">
                        </div>

                    <div class="mb-3">
				        <button type="submit" class="btn btn-primary">Submit</button>
				    </div>
                </form>
            </div>
        </div>
    </div>
</div>
