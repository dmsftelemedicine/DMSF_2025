<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Quality of Life Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#QualityOfLifeModal">
            Add Quality of Life
        </button>
    </div>
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