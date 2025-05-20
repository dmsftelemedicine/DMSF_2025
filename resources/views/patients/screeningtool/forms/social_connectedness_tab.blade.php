<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Social Connectedness Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SocialConnectednessModal">
            Add Social Connectedness
        </button>
    </div>
    <br/>
    <div id="patientData">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Family</th>
                    <th>Friends</th>
                    <th>Classmates</th>
                </tr>
            </thead>
            <tbody>
                <tr id="socialConnectednessRow">
                    <td id="family"></td>
                    <td id="friends"></td>
                    <td id="classmates"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="SocialConnectednessModal" tabindex="-1" aria-labelledby="SocialConnectednessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SocialConnectednessModalLabel">Add Social Connectedness</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form or content goes here -->
                <form id="AddSocialConnectednessForm">
                	@csrf
                	<input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
                     <!-- Relationship Ratings -->
                     <div class="mb-3">
					    <label for="familyRelationship" class="form-label">How is your relationship with your immediate family?</label>
					    <select class="form-select" name="family" id="family">
					    	<option value="0">- - choose - -</option>
					        <option value="1">1 - Worst</option>
					        <option value="2">2</option>
					        <option value="3">3</option>
					        <option value="4">4</option>
					        <option value="5">5</option>
					        <option value="6">6</option>
					        <option value="7">7</option>
					        <option value="8">8</option>
					        <option value="9">9</option>
					        <option value="10">10 - Excellent</option>
					    </select>
					</div>
                    
                     <div class="mb-3">
					    <label for="friendsRelationship" class="form-label">How is your relationship with your friends?</label>
					    <select class="form-select" name="friends" id="friends">
					    	<option value="0">- - choose - -</option>
					        <option value="1">1 - Worst</option>
					        <option value="2">2</option>
					        <option value="3">3</option>
					        <option value="4">4</option>
					        <option value="5">5</option>
					        <option value="6">6</option>
					        <option value="7">7</option>
					        <option value="8">8</option>
					        <option value="9">9</option>
					        <option value="10">10 - Excellent</option>
					    </select>
					</div>

					<div class="mb-3">
					    <label for="classmateRelationship" class="form-label">How is your relationship with your classmates/workmates?</label>
					    <select class="form-select" name="classmate" id="classmate">
					    	<option value="0">- - choose - -</option>
					        <option value="1">1 - Worst</option>
					        <option value="2">2</option>
					        <option value="3">3</option>
					        <option value="4">4</option>
					        <option value="5">5</option>
					        <option value="6">6</option>
					        <option value="7">7</option>
					        <option value="8">8</option>
					        <option value="9">9</option>
					        <option value="10">10 - Excellent</option>
					    </select>
					</div>
                    
                    <!-- SCS-8 Questions -->
                    <div class="mb-3" id="scs8Questions" style="display: none;">
                        <label class="form-label">Social Connectedness Scale</label>
                        <div class="table-responsive">
						    <table class="table table-bordered">
						        <tbody>
						            <tr>
						                <th>Question</th>
						                <th>Strongly Agree (1)</th>
						                <th>2</th>
						                <th>3</th>
						                <th>4</th>
						                <th>5</th>
						                <th>Strongly Disagree (6)</th>
						            </tr>
						            <tr>
						                <td>I feel disconnected from the world around me.</td>
						                <td><input type="radio" name="scs_8_Q1" value="1"></td>
						                <td><input type="radio" name="scs_8_Q1" value="2"></td>
						                <td><input type="radio" name="scs_8_Q1" value="3"></td>
						                <td><input type="radio" name="scs_8_Q1" value="4"></td>
						                <td><input type="radio" name="scs_8_Q1" value="5"></td>
						                <td><input type="radio" name="scs_8_Q1" value="6"></td>
						            </tr>
						            <tr>
						                <td>Even around people I know, I don’t feel that I really belong.</td>
						                <td><input type="radio" name="scs_8_Q2" value="1"></td>
						                <td><input type="radio" name="scs_8_Q2" value="2"></td>
						                <td><input type="radio" name="scs_8_Q2" value="3"></td>
						                <td><input type="radio" name="scs_8_Q2" value="4"></td>
						                <td><input type="radio" name="scs_8_Q2" value="5"></td>
						                <td><input type="radio" name="scs_8_Q2" value="6"></td>
						            </tr>
						            <tr>
						                <td>I feel so distant from people.</td>
						                <td><input type="radio" name="scs_8_Q3" value="1"></td>
						                <td><input type="radio" name="scs_8_Q3" value="2"></td>
						                <td><input type="radio" name="scs_8_Q3" value="3"></td>
						                <td><input type="radio" name="scs_8_Q3" value="4"></td>
						                <td><input type="radio" name="scs_8_Q3" value="5"></td>
						                <td><input type="radio" name="scs_8_Q3" value="6"></td>
						            </tr>
						            <tr>
						                <td>I have no sense of togetherness with my peers.</td>
						                <td><input type="radio" name="scs_8_Q4" value="1"></td>
						                <td><input type="radio" name="scs_8_Q4" value="2"></td>
						                <td><input type="radio" name="scs_8_Q4" value="3"></td>
						                <td><input type="radio" name="scs_8_Q4" value="4"></td>
						                <td><input type="radio" name="scs_8_Q4" value="5"></td>
						                <td><input type="radio" name="scs_8_Q4" value="6"></td>
						            </tr>
						            <tr>
						                <td>I don’t feel related to anyone.</td>
						                <td><input type="radio" name="scs_8_Q5" value="1"></td>
						                <td><input type="radio" name="scs_8_Q5" value="2"></td>
						                <td><input type="radio" name="scs_8_Q5" value="3"></td>
						                <td><input type="radio" name="scs_8_Q5" value="4"></td>
						                <td><input type="radio" name="scs_8_Q5" value="5"></td>
						                <td><input type="radio" name="scs_8_Q5" value="6"></td>
						            </tr>
						            <tr>
						                <td>I catch myself losing all sense of connectedness with society.</td>
						                <td><input type="radio" name="scs_8_Q6" value="1"></td>
						                <td><input type="radio" name="scs_8_Q6" value="2"></td>
						                <td><input type="radio" name="scs_8_Q6" value="3"></td>
						                <td><input type="radio" name="scs_8_Q6" value="4"></td>
						                <td><input type="radio" name="scs_8_Q6" value="5"></td>
						                <td><input type="radio" name="scs_8_Q6" value="6"></td>
						            </tr>
						            <tr>
						                <td>Even among my friends, there is no sense of brother/sisterhood.</td>
						                <td><input type="radio" name="scs_8_Q7" value="1"></td>
						                <td><input type="radio" name="scs_8_Q7" value="2"></td>
						                <td><input type="radio" name="scs_8_Q7" value="3"></td>
						                <td><input type="radio" name="scs_8_Q7" value="4"></td>
						                <td><input type="radio" name="scs_8_Q7" value="5"></td>
						                <td><input type="radio" name="scs_8_Q7" value="6"></td>
						            </tr>
						            <tr>
						                <td>I don’t feel that I participate with anyone or any group.</td>
						                <td><input type="radio" name="scs_8_Q8" value="1"></td>
						                <td><input type="radio" name="scs_8_Q8" value="2"></td>
						                <td><input type="radio" name="scs_8_Q8" value="3"></td>
						                <td><input type="radio" name="scs_8_Q8" value="4"></td>
						                <td><input type="radio" name="scs_8_Q8" value="5"></td>
						                <td><input type="radio" name="scs_8_Q8" value="6"></td>
						            </tr>
						        </tbody>
						    </table>
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="AddSocialConnectednessFormSubmitBtn">Save</button>
            </div>
        </div>
    </div>
</div>
