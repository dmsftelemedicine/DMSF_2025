<div class="row">
  	<div class="col-4">
    	<div class="list-group" id="list-tab" role="tablist">
	      	<a class="list-group-item list-group-item-action active" id="list-TP-list" data-bs-toggle="list" href="#list-TP" role="tab" aria-controls="list-TP">Telemedicine Perception Results</a>
	      	<a class="list-group-item list-group-item-action" id="list-nutrition-list" data-bs-toggle="list" href="#list-nutrition" role="tab" aria-controls="list-nutrition">Nutrition Results</a>
	      	<a class="list-group-item list-group-item-action" id="list-QOL-list" data-bs-toggle="list" href="#list-QOL" role="tab" aria-controls="list-QOL">Quality of Life</a>
    	</div>
  	</div>
  	<div class="col-8">
    	<div class="tab-content" id="nav-tabContent">
      		<div class="tab-pane fade show active" id="list-TP" role="tabpanel" aria-labelledby="list-TP-list">
      			<div class="card shadow-lg p-4 border-0">
	              	<!-- Flex container for heading and button -->
	                <div class="d-flex justify-content-between align-items-center">
	                    <h5>Telemedicine Perception Results</h5>
	                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TelemedicinePerceptionModal">
	                        Add Telemedicine Perception
	                    </button>
	                </div>
	                @if($patient->telemedicinePerceptionTests()->exists())
	                <table class="table table-striped mt-3">
	                    <thead>
	                        <tr>
	                            <th>Date</th>
	                            <th>Satisfaction</th>
	                            <th>First Time</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($patient->telemedicinePerceptionTests as $test)
	                        <tr>
	                            <td>{{ \Carbon\Carbon::parse($test->created_at)->format('M d, Y') }}</td>
	                            <td>{{ $test->satisfaction }}</td>
	                            <td>{{ $test->first_time}}</td>
	                            <td>
					                <button class="btn btn-info btn-sm view-details" 
					                        data-date="{{ \Carbon\Carbon::parse($test->created_at)->format('M d, Y') }}"
					                        data-first="{{ $test->first_time }}"
					                        data-q1="{{ $test->question_1 }}"
					                        data-q2="{{ $test->question_2 }}"
					                        data-q3="{{ $test->question_3 }}"
					                        data-q4="{{ $test->question_4 }}"
					                        data-q5="{{ $test->question_5 }}"
					                        data-satisfaction="{{ $test->satisfaction }}"
					                        data-bs-toggle="modal" 
					                        data-bs-target="#viewTestModal">
					                    View Details
					                </button>
					            </td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
		            @else
		                <p class="text-muted text-center mt-3">No test results available.</p>
		            @endif
	                
      			</div>
    		</div>
    		<div class="tab-pane fade" id="list-nutrition" role="tabpanel" aria-labelledby="list-nutrition-list">
    			<div class="card shadow-lg p-4 border-0">
    				<div class="d-flex justify-content-between align-items-center">
	                    <h5>Nutrition Results</h5>
	                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NutritionModal">
	                        Add Nutrition
	                    </button>
	                </div>
	                @if($patient->nutritions()->exists())
						    <table class="table table-striped mt-3">
						        <thead>
						            <tr>
						                <th>Date</th>
						                <th>Score</th>
						                <th>ICD 10</th>
						                <th>Details</th>
						                <th style="text-align: center;">24hrs food Recall</th>
						            </tr>
						        </thead>
						        <tbody>
						            @foreach($patient->nutritions as $nutrition)
						            <tr>
						                <td>{{ \Carbon\Carbon::parse($nutrition->created_at)->format('M d, Y') }}</td>
						                <td>{{ $nutrition->dq_score }}</td>
						                <td>{{ $nutrition->icd_diagnosis }}</td>
						                <td>
						                    <button class="btn btn-info btn-sm view-nutrition-details" 
						                        	data-date="{{ \Carbon\Carbon::parse($nutrition->created_at)->format('M d, Y') }}"
						                            data-fruit="{{ $nutrition->fruit }}"
						                            data-fruit_juice="{{ $nutrition->fruit_juice }}"
						                            data-vegetables="{{ $nutrition->vegetables }}"
						                            data-green_vegetables="{{ $nutrition->green_vegetables }}"
						                            data-starchy_vegetables="{{ $nutrition->starchy_vegetables }}"
						                            data-grains="{{ $nutrition->grains }}"
						                            data-grains_frequency="{{ $nutrition->grains_frequency }}"
						                            data-whole_grains="{{ $nutrition->whole_grains }}"
						                            data-whole_grains_frequency="{{ $nutrition->whole_grains_frequency }}"
						                            data-milk="{{ $nutrition->milk }}"
						                            data-milk_frequency="{{ $nutrition->milk_frequency }}"
						                            data-low_fat_milk="{{ $nutrition->low_fat_milk }}"
						                            data-low_fat_milk_frequency="{{ $nutrition->low_fat_milk_frequency }}"
						                            data-beans="{{ $nutrition->beans }}"
						                            data-nuts_seeds="{{ $nutrition->nuts_seeds }}"
						                            data-seafood="{{ $nutrition->seafood }}"
						                            data-seafood_frequency="{{ $nutrition->seafood_frequency }}"
						                            data-ssb="{{ $nutrition->ssb }}"
						                            data-ssb_frequency="{{ $nutrition->ssb_frequency }}"
						                            data-added_sugars="{{ $nutrition->added_sugars }}"
						                            data-saturated_fat="{{ $nutrition->saturated_fat }}"
						                            data-water="{{ $nutrition->water }}"
						                            data-bs-toggle="modal" 
						                            data-bs-target="#viewNutritionModal">
						                        View Details
						                    </button>
						                </td>
						                <td style="text-align: center;">
						                	 <button class="btn btn-warning btn-sm open-foodrecall-modal" 
										        data-nutrition-id="{{ $nutrition->id }}" 
										        data-bs-toggle="modal" 
										        data-bs-target="#foodRecallModal">
										        <i class="fa-solid fa-plus"></i>
										    </button>
										    <button class="btn btn-light btn-sm open-viewfoodrecall-modal"
										        data-bs-toggle="modal" 
										        data-bs-target="#ViewfoodRecallModal" 
										        data-nutrition-id="{{ $nutrition->id }}">
										    <i class="fa-solid fa-eye"></i>
										</button>

						                </td>
						            </tr>
						            @endforeach
						        </tbody>
						    </table>
						@else
						    <p class="text-muted text-center mt-3">No nutrition records available.</p>
						@endif
    			</div>
    		</div>
    		<div class="tab-pane fade" id="list-QOL" role="tabpanel" aria-labelledby="list-QOL-list">
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
    		</div>
 		</div>
	</div>
</div>


<!-- Telemedicine Perception Modal -->
<div class="modal fade" id="NutritionModal" tabindex="-1" aria-labelledby="NutritionModalabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NutritionModalLabel">Nutrition Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<!-- Telemedicine Form -->
			    @include('patients.screeningtool.forms.nutrition_form')
            </div>
        </div>
    </div>
</div>


<!-- Telemedicine Perception Modal -->
<div class="modal fade" id="TelemedicinePerceptionModal" tabindex="-1" aria-labelledby="TelemedicinePerceptionModalabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TelemedicinePerceptionModalLabel">Telemedicine Perception Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<!-- Telemedicine Form -->
			    <form id="telemedicine-perception-form">
			        @csrf
			        <div class="mb-3">
			            <label class="form-label">Is this the first time you are using a telemedicine app?</label>
			            <div>
			                <input type="radio" name="first_time" value="yes" required> Yes
			                <input type="radio" name="first_time" value="no"> No
			            </div>
			        </div>
			        @php
			            $questions = [
			                "This method (telemedicine) gives the physician a good understanding of the patient’s health status.",
			                "This method (telemedicine) does not violate the privacy of the patient’s medical information.",
			                "This method (telemedicine) is a good addition to regular care.",
			                "This method (telemedicine) saves time.",
			                "I would use this method (telemedicine) in the future."
			            ];
			        @endphp

			        @foreach ($questions as $index => $question)
			            <div class="mb-3">
			                <label class="form-label">{{ $index + 1 }}. {{ $question }}</label>
			                <div>
			                    @for ($i = 1; $i <= 5; $i++)
			                        <input style="margin-left: 0.5rem;" type="radio" name="question_{{ $index + 1 }}" value="{{ $i }}" required> {{ $i }}
			                        <br/>
			                    @endfor
			                </div>
			            </div>
			        @endforeach
			        <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
			        <!-- Submit Button -->
			        <button type="submit" class="btn btn-primary">Submit</button>
			    </form>
            </div>
        </div>
    </div>
</div>

<!--Telemedicine Perception View Modal -->
<div class="modal fade" id="viewTestModal" tabindex="-1" aria-labelledby="viewTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTestModalLabel">Telemedicine Perception Details (<strong><span id="test-date"></span></strong>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Is this the first time you are using a telemedicine app?: <strong><span id="test-first"></span></strong>  </p>
                <hr>
                <p>This method (telemedicine) gives the physician a good understanding of the patient’s health status.:  <strong><span id="test-q1"></span></strong></p>
                <hr>
                <p>This method (telemedicine) does not violate the privacy of the patient’s medical information.:  <strong><span id="test-q2"></span></strong></p>
                <hr>
                <p>This method (telemedicine) is a good addition to regular care.: <strong><span id="test-q3"></span></strong></p>
                <hr>
                <p>This method (telemedicine) saves time.: <strong><span id="test-q4"></span></strong></p>
                <hr>
                <p>I would use this method (telemedicine) in the future.: <strong><span id="test-q5"></span></strong></p>
                <hr>
                <p>Satisfaction Level: <strong><span id="test-satisfaction"></span></strong></p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewNutritionModal" tabindex="-1" aria-labelledby="viewNutritionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewNutritionLabel">Nutrition Details (<strong><span id="nutrition-date"></span></strong>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Fruit Consumption: <strong><span id="nutrition-fruit"></span></strong></p>
                <hr>
                <p>Fruit Juice Consumption: <strong><span id="nutrition-fruit-juice"></span></strong></p>
                <hr>
                <p>Vegetable Consumption: <strong><span id="nutrition-vegetables"></span></strong></p>
                <hr>
                <p>Green Vegetables: <strong><span id="nutrition-green-vegetables"></span></strong></p>
                <hr>
                <p>Starchy Vegetables: <strong><span id="nutrition-starchy-vegetables"></span></strong></p>
                <hr>
                <p>Grain Consumption: <strong><span id="nutrition-grains"></span></strong></p>
                <hr>
                <p>Grain Frequency: <strong><span id="nutrition-grains-frequency"></span></strong></p>
                <hr>
                <p>Whole Grain Consumption: <strong><span id="nutrition-whole-grains"></span></strong></p>
                <hr>
                <p>Whole Grain Frequency: <strong><span id="nutrition-whole-grains-frequency"></span></strong></p>
                <hr>
                <p>Milk Consumption: <strong><span id="nutrition-milk"></span></strong></p>
                <hr>
                <p>Milk Frequency: <strong><span id="nutrition-milk-frequency"></span></strong></p>
                <hr>
                <p>Low-Fat Milk Consumption: <strong><span id="nutrition-low-fat-milk"></span></strong></p>
                <hr>
                <p>Low-Fat Milk Frequency: <strong><span id="nutrition-low-fat-milk-frequency"></span></strong></p>
                <hr>
                <p>Beans Consumption: <strong><span id="nutrition-beans"></span></strong></p>
                <hr>
                <p>Nuts & Seeds Consumption: <strong><span id="nutrition-nuts-seeds"></span></strong></p>
                <hr>
                <p>Seafood Consumption: <strong><span id="nutrition-seafood"></span></strong></p>
                <hr>
                <p>Seafood Frequency: <strong><span id="nutrition-seafood-frequency"></span></strong></p>
                <hr>
                <p>Sugar-Sweetened Beverages: <strong><span id="nutrition-ssb"></span></strong></p>
                <hr>
                <p>SSB Frequency: <strong><span id="nutrition-ssb-frequency"></span></strong></p>
                <hr>
                <p>Added Sugars: <strong><span id="nutrition-added-sugars"></span></strong></p>
                <hr>
                <p>Saturated Fat: <strong><span id="nutrition-saturated-fat"></span></strong></p>
                <hr>
                <p>Water Consumption: <strong><span id="nutrition-water"></span></strong></p>
            </div>
        </div>
    </div>
</div>


<!-- Food Recall Modal -->
<div class="modal fade" id="foodRecallModal" tabindex="-1" aria-labelledby="foodRecallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="foodRecallModalLabel">Create Food Recall Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="foodRecallForm">
                    @csrf
                    <input type="hidden" id="nutrition_id" name="nutrition_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Breakfast</label>
                        <textarea class="form-control" name="breakfast"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">AM Snack</label>
                        <textarea class="form-control" name="am_snack"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lunch</label>
                        <textarea class="form-control" name="lunch"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PM Snack</label>
                        <textarea class="form-control" name="pm_snack"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dinner</label>
                        <textarea class="form-control" name="dinner"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Midnight Snack</label>
                        <textarea class="form-control" name="midnight_snack"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Food view Recall Modal -->
<div class="modal fade" id="ViewfoodRecallModal" tabindex="-1" aria-labelledby="ViewfoodRecallLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewfoodRecallLabel">Food Recall Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Breakfast</th>
                            <th>AM Snack</th>
                            <th>Lunch</th>
                            <th>PM Snack</th>
                            <th>Dinner</th>
                            <th>Midnight Snack</th>
                        </tr>
                    </thead>
                    <tbody id="foodRecallTableBody">
                        <tr>
                            <td colspan="7" class="text-center">No records available.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {

        $('#telemedicine-perception-form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('telemedicine_perception.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert("Survey submitted successfully!");
                    $('#telemedicine-form')[0].reset();
                },
                error: function(xhr) {
                    alert("An error occurred. Please try again.");
                }
            });
        });

        $('.view-details').click(function () {
            $('#test-date').text($(this).data('date'));
            $('#test-first').text($(this).data('first'));
            $('#test-q1').text($(this).data('q1'));
            $('#test-q2').text($(this).data('q2'));
            $('#test-q3').text($(this).data('q3'));
            $('#test-q4').text($(this).data('q4'));
            $('#test-q5').text($(this).data('q5'));
            $('#test-satisfaction').text($(this).data('satisfaction'));
        });

        $('#nutrition-form').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('nutrition.store') }}", // Define route in web.php
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    alert('Form submitted successfully!');
                    $('#nutrition-form')[0].reset();
                },
                error: function (xhr) {
                    alert('Error submitting form!');
                }
            });
        });

        $(".view-nutrition-details").click(function () {
            // Get data attributes from the clicked button
            let date = $(this).data("date");
            let fruit = $(this).data("fruit");
            let fruitJuice = $(this).data("fruit_juice");
            let vegetables = $(this).data("vegetables");
            let greenVegetables = $(this).data("green_vegetables");
            let starchyVegetables = $(this).data("starchy_vegetables");
            let grains = $(this).data("grains");
            let grainsFrequency = $(this).data("grains_frequency");
            let wholeGrains = $(this).data("whole_grains");
            let wholeGrainsFrequency = $(this).data("whole_grains_frequency");
            let milk = $(this).data("milk");
            let milkFrequency = $(this).data("milk_frequency");
            let lowFatMilk = $(this).data("low_fat_milk");
            let lowFatMilkFrequency = $(this).data("low_fat_milk_frequency");
            let beans = $(this).data("beans");
            let nutsSeeds = $(this).data("nuts_seeds");
            let seafood = $(this).data("seafood");
            let seafoodFrequency = $(this).data("seafood_frequency");
            let ssb = $(this).data("ssb");
            let ssbFrequency = $(this).data("ssb_frequency");
            let addedSugars = $(this).data("added_sugars");
            let saturatedFat = $(this).data("saturated_fat");
            let water = $(this).data("water");

            // Populate modal fields
            $("#nutrition-date").text(date);
            $("#nutrition-fruit").text(fruit);
            $("#nutrition-fruit-juice").text(fruitJuice);
            $("#nutrition-vegetables").text(vegetables);
            $("#nutrition-green-vegetables").text(greenVegetables);
            $("#nutrition-starchy-vegetables").text(starchyVegetables);
            $("#nutrition-grains").text(grains);
            $("#nutrition-grains-frequency").text(grainsFrequency);
            $("#nutrition-whole-grains").text(wholeGrains);
            $("#nutrition-whole-grains-frequency").text(wholeGrainsFrequency);
            $("#nutrition-milk").text(milk);
            $("#nutrition-milk-frequency").text(milkFrequency);
            $("#nutrition-low-fat-milk").text(lowFatMilk);
            $("#nutrition-low-fat-milk-frequency").text(lowFatMilkFrequency);
            $("#nutrition-beans").text(beans);
            $("#nutrition-nuts-seeds").text(nutsSeeds);
            $("#nutrition-seafood").text(seafood);
            $("#nutrition-seafood-frequency").text(seafoodFrequency);
            $("#nutrition-ssb").text(ssb);
            $("#nutrition-ssb-frequency").text(ssbFrequency);
            $("#nutrition-added-sugars").text(addedSugars);
            $("#nutrition-saturated-fat").text(saturatedFat);
            $("#nutrition-water").text(water);

            // Show the modal
            $("#viewNutritionModal").modal("show");
        });

        // Open modal and set nutrition ID
	    $('.open-foodrecall-modal').on('click', function() {
	        let nutritionId = $(this).data('nutrition-id');
	        $('#nutrition_id').val(nutritionId);
	    });

	    // Handle form submission via AJAX
	    $('#foodRecallForm').on('submit', function(e) {
	        e.preventDefault();

	        $.ajax({
	            url: "{{ route('food-recall.store') }}",
	            type: "POST",
	            data: $(this).serialize(),
	            success: function(response) {
	                alert("Food Recall entry added successfully!");
	                $('#foodRecallModal').modal('hide');
	                location.reload(); // Refresh the page
	            },
	            error: function(xhr) {
	                alert("An error occurred. Please try again.");
	                console.error(xhr.responseText);
	            }
	        });
	    });

	    $(".open-viewfoodrecall-modal").click(function () {
	        let nutritionId = $(this).data("nutrition-id");

	        // Clear the table while loading
	        $("#foodRecallTableBody").html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');

	        $.ajax({
	            url: "/food-recall/" + nutritionId,
	            type: "GET",
	            success: function (response) {
	                let rows = "";

	                if (response.foodRecalls.length > 0) {
	                    response.foodRecalls.forEach(function (recall) {
	                    	let formattedDate = new Date(recall.created_at).toLocaleDateString("en-US", {
	                            month: "long", // Full month name (e.g., "March")
	                            day: "2-digit", // Two-digit day (e.g., "29")
	                            year: "numeric" // Full year (e.g., "2025")
	                        });
	                        rows += `
	                            <tr>
	                                <td>${formattedDate}</td>
	                                <td>${recall.breakfast}</td>
	                                <td>${recall.am_snack}</td>
	                                <td>${recall.lunch}</td>
	                                <td>${recall.pm_snack}</td>
	                                <td>${recall.dinner}</td>
	                                <td>${recall.midnight_snack}</td>
	                            </tr>`;
	                    });
	                } else {
	                    rows = '<tr><td colspan="7" class="text-center">No records available.</td></tr>';
	                }

	                $("#foodRecallTableBody").html(rows);
	            },
	            error: function () {
	                $("#foodRecallTableBody").html('<tr><td colspan="7" class="text-center text-danger">Error fetching data.</td></tr>');
	            }
	        });
	    });

	    // Handle form submission via AJAX
	    $('#qualityOfLifeForm').on('submit', function(e) {
	        e.preventDefault(); // Prevent default form submission

	        $.ajax({
	            url: "{{ route('qualityoflife.store') }}", // Update with your actual route
	            type: "POST",
	            data: $(this).serialize(),
	            success: function(response) {
	                alert("Quality of Life entry added successfully!");
	                $('#TelemedicinePerceptionModal').modal('hide'); // Hide modal
	                location.reload(); // Refresh the page
	            },
	            error: function(xhr) {
	                alert("An error occurred. Please try again.");
	                console.error(xhr.responseText); // Log error for debugging
	            }
	        });
	    });

	    let patientId = "{{ $patient->id }}"; // Get patient ID from Blade
    	let isQOLLoaded = false; // Prevent multiple AJAX calls

	    function loadQualityOfLifeRecords() {
	        $.ajax({
	            url: "/qualityoflife/" + patientId, // Laravel route to fetch records
	            type: "GET",
	            dataType: "json",
	            success: function (response) {
	                let tableBody = $("#qualityOfLifeTableBody");
	                tableBody.empty(); // Clear previous data

	                if (response.length === 0) {
	                    tableBody.append('<tr><td colspan="3" class="text-center">No records found</td></tr>');
	                } else {
	                    response.forEach(function (record) {
	                        let score = `${record.mobility}${record.self_care}${record.usual_activities}${record.pain}${record.anxiety}`;
	                        
	                        let row = `
	                            <tr>
	                                <td>${score}</td>
	                                <td>${record.health_today}</td>
	                                <td>${record.icd_10 ? record.icd_10 : "N/A"}</td>
	                            </tr>
	                        `;
	                        tableBody.append(row);
	                    });
	                }
	            },
	            error: function (xhr) {
	                console.error("Error fetching data:", xhr.responseText);
	            },
	        });
	    }

	    // Load data when the "Quality of Life" tab is clicked
	    $("#list-QOL-list").on("click", function () {
	        if (!isQOLLoaded) {
	            loadQualityOfLifeRecords();
	            isQOLLoaded = true; // Ensure it loads only once per visit
	        }
	    });

    });
</script>

