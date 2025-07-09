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
                    @csrf
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

<script>
var patientId = "{{ $patient->id }}";
$(document).ready(function() {
    function loadStressManagementTable() {
        $.ajax({
            url: '/stress-management/' + patientId, // Dynamically add patient ID to the URL
            type: 'GET',
            success: function(response) {
                // Empty the table body before inserting new rows
                $('#stressManagementTable tbody').empty();

                // Iterate through the response data and populate the table
                $.each(response, function(index, data) {
                    var formattedDate = new Date(data.created_at).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    // Create a new row for each submission
                    var row = '<tr>';
                    row += '<td>' + data.id + '</td>';
                    row += '<td>' + formattedDate + '</td>';
                    row += '<td><button class="btn btn-info view-details" data-id="' + data.id + '" data-toggle="modal" data-target="#viewStressManagementModal">View All</button></td>';
                    row += '</tr>';

                    // Append the row to the table body
                    $('#stressManagementTable tbody').append(row);
                });
                // Handle "View All" button click to show the modal with data
                $('.view-details').click(function() {
                    var id = $(this).data('id');  // Get the id of the selected submission

                    // Make an AJAX request to fetch detailed data for the selected submission
                    $.ajax({
                        url: '/stress-management/' + id,  // Use the ID to fetch the specific submission
                        type: 'GET',
                        success: function(response) {
                            var data = response[0];  // Access the first item in the array
                            // Populate the modal with the data
                            $('#StressLevelView').text(data.stress_level);
                            $('#modalGAD_7_Q1').text(data.GAD_7_Q1);
                            $('#modalGAD_7_Q2').text(data.GAD_7_Q2);
                            $('#modalGAD_7_Q3').text(data.GAD_7_Q3);
                            $('#modalGAD_7_Q4').text(data.GAD_7_Q4);
                            $('#modalGAD_7_Q5').text(data.GAD_7_Q5);
                            $('#modalGAD_7_Q6').text(data.GAD_7_Q6);
                            $('#modalGAD_7_Q7').text(data.GAD_7_Q7);

                            $('#modalPHQ_9_Q1').text(data.PHQ_9_Q1);
                            $('#modalPHQ_9_Q2').text(data.PHQ_9_Q2);
                            $('#modalPHQ_9_Q3').text(data.PHQ_9_Q3);
                            $('#modalPHQ_9_Q4').text(data.PHQ_9_Q4);
                            $('#modalPHQ_9_Q5').text(data.PHQ_9_Q5);
                            $('#modalPHQ_9_Q6').text(data.PHQ_9_Q6);
                            $('#modalPHQ_9_Q7').text(data.PHQ_9_Q7);
                            $('#modalPHQ_9_Q8').text(data.PHQ_9_Q8);
                            $('#modalPHQ_9_Q9').text(data.PHQ_9_Q9);
                            $('#modalPSS_4_Q1').text(data.PSS_4_Q1);
                            $('#modalPSS_4_Q2').text(data.PSS_4_Q2);
                            $('#modalPSS_4_Q3').text(data.PSS_4_Q3);
                            $('#modalPSS_4_Q4').text(data.PSS_4_Q4);
                            // Show the modal
                            $('#viewStressManagementModal').modal('show');
                        },
                        error: function(xhr, status, error) {
                            alert('There was an error fetching the data for this submission.');
                            console.log(error);
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                alert('There was an error fetching the data.');
                console.log(error);
            }
        });
    }

    // Initial table load
    loadStressManagementTable();

    $('#submitStressManagementForm').click(function(event) {
        event.preventDefault(); // Prevent default form submission
        // Get the selected values for all GAD-7 questions
        var gad7Q1 = parseInt($('#GAD_7_Q1').val());
        var gad7Q2 = parseInt($('#GAD_7_Q2').val());
        var gad7Q3 = parseInt($('#GAD_7_Q3').val());
        var gad7Q4 = parseInt($('#GAD_7_Q4').val());
        var gad7Q5 = parseInt($('#GAD_7_Q5').val());
        var gad7Q6 = parseInt($('#GAD_7_Q6').val());
        var gad7Q7 = parseInt($('#GAD_7_Q7').val());

        // Calculate the total score
        var totalScore = gad7Q1 + gad7Q2 + gad7Q3 + gad7Q4 + gad7Q5 + gad7Q6 + gad7Q7;
        $('#GAD_7_total').val(totalScore);

        // Get the selected values for all PHQ-9 questions
        var phq9Q1 = parseInt($('#PHQ_9_Q1').val());
        var phq9Q2 = parseInt($('#PHQ_9_Q2').val());
        var phq9Q3 = parseInt($('#PHQ_9_Q3').val());
        var phq9Q4 = parseInt($('#PHQ_9_Q4').val());
        var phq9Q5 = parseInt($('#PHQ_9_Q5').val());
        var phq9Q6 = parseInt($('#PHQ_9_Q6').val());
        var phq9Q7 = parseInt($('#PHQ_9_Q7').val());
        var phq9Q8 = parseInt($('#PHQ_9_Q8').val());
        var phq9Q9 = parseInt($('#PHQ_9_Q9').val());
        var totalScorePHQ9 = phq9Q1 + phq9Q2 + phq9Q3 + phq9Q4 + phq9Q5 + phq9Q6 + phq9Q7 + phq9Q8 + phq9Q9;
        $('#PHQ_9_total').val(totalScorePHQ9);

        var formData = $('#stressManagementForm').serialize();
        $.ajax({
            url: '{{ route("submit.stressManagement") }}',
            type: 'POST',
            data: formData + '&_token={{ csrf_token() }}',
            success: function(response) {
                alert('Stress Level submitted successfully!');
                console.log(response);
                // Reload the table after successful save
                loadStressManagementTable();
            },
            error: function(xhr, status, error) {
                alert('There was an error submitting the form.');
                console.log(error);
            }
        });
    });
});
</script>