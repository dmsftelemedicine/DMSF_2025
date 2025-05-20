<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Stress Management Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#StressManagementModal">
            Add Stress Management
        </button>
    </div>
    <br/>
    <!-- Stress Management Table -->
    <table class="table table-bordered" id="stressManagementTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date/Time Submitted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be dynamically inserted here -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="StressManagementModal" tabindex="-1" aria-labelledby="StressManagementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="StressManagementModalLabel">Add Stress Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Stress Management Form -->
                <form id="stressManagementForm">
                	<input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
                    <!-- Stress Level -->
                    <div class="mb-3">
					    <label for="stressLevel" class="form-label">Stress Level (0-10)</label>
					    <select class="form-select" id="stressLevel" name="stress_level" required>
					        <option value="0">0</option>
					        <option value="1">1</option>
					        <option value="2">2</option>
					        <option value="3">3</option>
					        <option value="4">4</option>
					        <option value="5">5</option>
					        <option value="6">6</option>
					        <option value="7">7</option>
					        <option value="8">8</option>
					        <option value="9">9</option>
					        <option value="10">10</option>
					    </select>
					</div>
                     <!-- GAD-7 Questions -->
                    <br/>
                    <hr>
                    <div class="GAD-7">
                    	<h5>Generalized Anxiety Disorder Questionnaire (GAD-7)</h5>
                    	<br/>
                    	<div class="mb-3">
					        <label for="GAD_7_Q1" class="form-label">1. Feeling nervous, anxious, or on edge</label><br/>
					        <select class="form-select" id="GAD_7_Q1" name="GAD_7_Q1">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="GAD_7_Q2" class="form-label">2. Not being able to stop or control worrying</label><br/>
					        <select class="form-select" id="GAD_7_Q2" name="GAD_7_Q2">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="GAD_7_Q3" class="form-label">3. Worrying too much about different things</label><br/>
					        <select class="form-select" id="GAD_7_Q3" name="GAD_7_Q3">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="GAD_7_Q4" class="form-label">4. Trouble relaxing</label><br/>
					        <select class="form-select" id="GAD_7_Q4" name="GAD_7_Q4">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="GAD_7_Q5" class="form-label">5. Being so restless that it is hard to sit still</label><br/>
					        <select class="form-select" id="GAD_7_Q5" name="GAD_7_Q5">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="GAD_7_Q6" class="form-label">6. Becoming easily annoyed or irritable</label><br/>
					        <select class="form-select" id="GAD_7_Q6" name="GAD_7_Q6">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="GAD_7_Q7" class="form-label">7. Feeling afraid, as if something awful might happen</label><br/>
					        <select class="form-select" id="GAD_7_Q7" name="GAD_7_Q7">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <!-- Total GAD-7 Score -->
					    <div class="mb-3">
					        <input type="hidden" class="form-control" id="GAD_7_total" name="GAD_7_total" readonly>
					    </div>
                    </div>
				    

                    <!-- PHQ-9 Questions -->
                    <br/>
                    <hr>
                    <div class="PHQ-9">
                    	<h5>Over the last two weeks, how often have you been bothered by any of the following problems?</h5>
                    	<br/>
					    <div class="mb-3">
					        <label for="PHQ_9_Q1" class="form-label">1. Little interest or pleasure in doing things</label><br/>
					        <select class="form-select" id="PHQ_9_Q1" name="PHQ_9_Q1">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q2" class="form-label">2. Feeling down, depressed, or hopeless</label><br/>
					        <select class="form-select" id="PHQ_9_Q2" name="PHQ_9_Q2">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q3" class="form-label">3. Trouble falling or staying asleep, or sleeping too much</label><br/>
					        <select class="form-select" id="PHQ_9_Q3" name="PHQ_9_Q3">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q4" class="form-label">4. Feeling tired or having little energy</label><br/>
					        <select class="form-select" id="PHQ_9_Q4" name="PHQ_9_Q4">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q5" class="form-label">5. Poor appetite or overeating</label><br/>
					        <select class="form-select" id="PHQ_9_Q5" name="PHQ_9_Q5">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q6" class="form-label">6. Feeling bad about yourself — or that you are a failure or have let yourself or your family down</label><br/>
					        <select class="form-select" id="PHQ_9_Q6" name="PHQ_9_Q6">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q7" class="form-label">7. Trouble concentrating on things, such as reading the newspaper or watching television</label><br/>
					        <select class="form-select" id="PHQ_9_Q7" name="PHQ_9_Q7">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q8" class="form-label">8. Moving or speaking so slowly that other people could have noticed. Or the opposite — being so fidgety or restless that you have been moving around a lot more than usual</label><br/>
					        <select class="form-select" id="PHQ_9_Q8" name="PHQ_9_Q8">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PHQ_9_Q9" class="form-label">9. Thoughts that you would be better off dead, or of hurting yourself</label><br/>
					        <select class="form-select" id="PHQ_9_Q9" name="PHQ_9_Q9">
					            <option value="0">Not at all</option>
					            <option value="1">Several days</option>
					            <option value="2">More than half the days</option>
					            <option value="3">Nearly every day</option>
					        </select>
					    </div>

					    <!-- Total PHQ-9 Score -->
					    <div class="mb-3">
					        <input type="hidden" class="form-control" id="PHQ_9_total" name="PHQ_9_total" readonly>
					    </div>
	                    <!-- Add other PHQ-9 Questions similarly (Q2 to Q9) -->
                    </div>

                    <!-- PSS-4 Questions -->
                    <br/>
                    <hr>
                   	<div class="PSS-4">
                   		<h5>Perceived Stress Scale (PSS-4)</h5>
                   		<br/>
					    <div class="mb-3">
					        <label for="PSS_4_Q1" class="form-label">1. In the last month, how often have you felt that you were unable to control the important things in your life?</label><br/>
					        <select class="form-select" id="PSS_4_Q1" name="PSS_4_Q1">
					            <option value="0">Never</option>
					            <option value="1">Almost Never</option>
					            <option value="2">Sometimes</option>
					            <option value="3">Fairly Often</option>
					            <option value="4">Very Often</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PSS_4_Q2" class="form-label">2. In the last month, how often have you felt confident about your ability to handle your personal problems?</label><br/>
					        <select class="form-select" id="PSS_4_Q2" name="PSS_4_Q2">
					            <option value="0">Never</option>
					            <option value="1">Almost Never</option>
					            <option value="2">Sometimes</option>
					            <option value="3">Fairly Often</option>
					            <option value="4">Very Often</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PSS_4_Q3" class="form-label">3. In the last month, how often have you felt that things were going your way?</label><br/>
					        <select class="form-select" id="PSS_4_Q3" name="PSS_4_Q3">
					            <option value="0">Never</option>
					            <option value="1">Almost Never</option>
					            <option value="2">Sometimes</option>
					            <option value="3">Fairly Often</option>
					            <option value="4">Very Often</option>
					        </select>
					    </div>

					    <div class="mb-3">
					        <label for="PSS_4_Q4" class="form-label">4. In the last month, how often have you felt difficulties were piling up so high that you could not overcome them?</label><br/>
					        <select class="form-select" id="PSS_4_Q4" name="PSS_4_Q4">
					            <option value="0">Never</option>
					            <option value="1">Almost Never</option>
					            <option value="2">Sometimes</option>
					            <option value="3">Fairly Often</option>
					            <option value="4">Very Often</option>
					        </select>
					    </div>
                   </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitStressManagementForm">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewStressManagementModal" tabindex="-1" aria-labelledby="viewStressManagementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewAllModalLabel">Stress Management Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Table to display the details of the selected stress management submission -->
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td><strong>Stress Level</strong></td>
              <td id="StressLevelView"></td>
            </tr>
            <tr>
            	<td colspan="2">Generalized Anxiety Disorder Questionnaire (GAD-7)</td>
            </tr>
            <tr>
              <td><strong>1. Feeling nervous, anxious, or on edge</strong></td>
              <td id="modalGAD_7_Q1"></td>
            </tr>
            <tr>
              <td><strong>2. Not being able to stop or control worrying</strong></td>
              <td id="modalGAD_7_Q2"></td>
            </tr>
            <tr>
              <td><strong>3. Worrying too much about different things</strong></td>
              <td id="modalGAD_7_Q3"></td>
            </tr>
            <tr>
              <td><strong>4. Trouble relaxing</strong></td>
              <td id="modalGAD_7_Q4"></td>
            </tr>
            <tr>
              <td><strong>5. Being so restless that it is hard to sit still</strong></td>
              <td id="modalGAD_7_Q5"></td>
            </tr>
            <tr>
              <td><strong>6. Becoming easily annoyed or irritable</strong></td>
              <td id="modalGAD_7_Q6"></td>
            </tr>
            <tr>
              <td><strong>7. Feeling afraid, as if something awful might happen</strong></td>
              <td id="modalGAD_7_Q7"></td>
            </tr>
            <tr>
            	<td colspan="2">
            		<h5>Over the last two weeks, how often have you been bothered by any of the following problems?</h5>
            	</td>
            </tr>
            
            <!-- Add rows for other GAD-7, PHQ-9, PSS-4 questions -->
            <tr>
              <td><strong>1. Little interest or pleasure in doing things</strong></td>
              <td id="modalPHQ_9_Q1"></td>
            </tr>
            <tr>
              <td><strong>2. Feeling down, depressed, or hopeless</strong></td>
              <td id="modalPHQ_9_Q2"></td>
            </tr>
            <tr>
              <td><strong>3. Trouble falling or staying asleep, or sleeping too much</strong></td>
              <td id="modalPHQ_9_Q3"></td>
            </tr>
            <tr>
              <td><strong>4. Feeling tired or having little energy</strong></td>
              <td id="modalPHQ_9_Q4"></td>
            </tr>
            <tr>
              <td><strong>5. Poor appetite or overeating</strong></td>
              <td id="modalPHQ_9_Q5"></td>
            </tr>
            <tr>
              <td><strong>6. Feeling bad about yourself — or that you are a failure or have let yourself or your family down</strong></td>
              <td id="modalPHQ_9_Q6"></td>
            </tr>
            <tr>
              <td><strong>7. Trouble concentrating on things, such as reading the newspaper or watching television</strong></td>
              <td id="modalPHQ_9_Q7"></td>
            </tr>
            <tr>
              <td><strong>8. Moving or speaking so slowly that other people could have noticed. Or the opposite — being so fidgety or restless that you have been moving around a lot more than usual</strong></td>
              <td id="modalPHQ_9_Q8"></td>
            </tr>
            <tr>
              <td><strong>9. Thoughts that you would be better off dead, or of hurting yourself</strong></td>
              <td id="modalPHQ_9_Q9"></td>
            </tr>
            <tr>
            	<td colspan="2">
            		Perceived Stress Scale (PSS-4)
            	</td>
            </tr>
            <tr>
              <td><strong>1. In the last month, how often have you felt that you were unable to control the important things in your life?</strong></td>
              <td id="modalPSS_4_Q1"></td>
            </tr>
            <tr>
              <td><strong>2. In the last month, how often have you felt confident about your ability to handle your personal problems?</strong></td>
              <td id="modalPSS_4_Q2"></td>
            </tr>
            <tr>
              <td><strong>3. In the last month, how often have you felt that things were going your way?</strong></td>
              <td id="modalPSS_4_Q3"></td>
            </tr>
            <tr>
              <td><strong>4. In the last month, how often have you felt difficulties were piling up so high that you could not overcome them?</strong></td>
              <td id="modalPSS_4_Q4"></td>
            </tr>
            <!-- Add additional fields as necessary -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>