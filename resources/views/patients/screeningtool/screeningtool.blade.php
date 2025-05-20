<div class="card shadow-lg p-4 border-0 mx-auto mb-4" style="width: 90%; border-radius: 2rem;">

	<h5 class="border-bottom pb-2 mb-3">Nutrition Summary</h5>
	<div class="row">
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">BMR (kcal/day)</p>
			<p class="fw-bold">{{ $patient->calculateBMR() }}</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">
				TDEE
				<button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#tdeeModal">
					<i class="fa-solid fa-plus"></i>
				</button>
			</p>
			<p class="fw-bold" id="tdeeValue">
				{{ $patient->tdee ? $patient->tdee->tdee . ' kcal/day' : 'Not calculated yet' }}
			</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">Weight Loss / Gain</p>
			<p class="fw-bold">
				{{ $patient->tdee ? ($patient->tdee->tdee - 500) . " kcal / " . ($patient->tdee->tdee + 200) . " kcal" : 'Need TDEE data' }}
			</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">
				Meal Plan
				<button class="btn btn-light btn-sm open-meal-plan-modal" data-patient-id="{{ $patient->id }}">
					<i class="fa-solid fa-eye"></i>
				</button>
			</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">
				Macronutrient Split 
				<button class="btn btn-light btn-sm open-macro-modal" data-patient-id="{{ $patient->id }}">
					<i class="fa-solid fa-eye"></i>
				</button>
			</p>
		</div>
	</div>
</div>


<div class="row">
  	<div class="col-4">
    	<div class="list-group" id="list-tab" role="tablist">
	      	<a class="list-group-item list-group-item-action active" id="list-TP-list" data-bs-toggle="list" href="#list-TP" role="tab" aria-controls="list-TP">Telemedicine Perception Results</a>
	      	<a class="list-group-item list-group-item-action" id="list-nutrition-list" data-bs-toggle="list" href="#list-nutrition" role="tab" aria-controls="list-nutrition">Nutrition Results</a>
	      	<a class="list-group-item list-group-item-action" id="list-QOL-list" data-bs-toggle="list" href="#list-QOL" role="tab" aria-controls="list-QOL">Quality of Life</a>
	      	<a class="list-group-item list-group-item-action" id="list-SM-list" data-bs-toggle="list" href="#list-SM" role="tab" aria-controls="list-SM">Stress Management</a>
	      	<a class="list-group-item list-group-item-action" id="list-SC-list" data-bs-toggle="list" href="#list-SC" role="tab" aria-controls="list-SC">Social Connectedness</a>
	      	<a class="list-group-item list-group-item-action" id="list-PA-list" data-bs-toggle="list" href="#list-PA" role="tab" aria-controls="list-PA">Physical Activity</a>
    	</div>
  	</div>
  	<div class="col-8">
    	<div class="tab-content" id="nav-tabContent">
      		<div class="tab-pane fade show active" id="list-TP" role="tabpanel" aria-labelledby="list-TP-list">
      			@include('patients.screeningtool.forms.telemedicine_perception_result')
    		</div>
    		<div class="tab-pane fade" id="list-nutrition" role="tabpanel" aria-labelledby="list-nutrition-list">
    			@include('patients.screeningtool.forms.nutrition_tab')
    		</div>
    		<div class="tab-pane fade" id="list-QOL" role="tabpanel" aria-labelledby="list-QOL-list">
    			@include('patients.screeningtool.forms.quality_life_tab')
    		</div>    		
    		<div class="tab-pane fade" id="list-SM" role="tabpanel" aria-labelledby="list-SM-list">
    			@include('patients.screeningtool.forms.stress_management_tab')
    		</div>
			<div class="tab-pane fade" id="list-SC" role="tabpanel" aria-labelledby="list-SC-list">
    			@include('patients.screeningtool.forms.social_connectedness_tab')
    		</div>
    		<div class="tab-pane fade" id="list-PA" role="tabpanel" aria-labelledby="list-PA-list">
    			@include('patients.screeningtool.forms.physical_activity_form')
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

	    // Event listeners to check if the relationship values change
	    $('#friends, #classmate').change(function() {
	        checkSCS8QuestionsVisibility();
	    });

	    function checkSCS8QuestionsVisibility() {
		    var friendsValue = $('#friends').val();
		    var classmateValue = $('#classmate').val();

		    // Show SCS-8 questions if either friends or classmate relationship is less than 6 and not equal to 0
		    if ((parseInt(friendsValue) < 6 && parseInt(friendsValue) !== 0) || 
		        (parseInt(classmateValue) < 6 && parseInt(classmateValue) !== 0)) {
		        $('#scs8Questions').show();
		    } else {
		        $('#scs8Questions').hide();
		    }
		}

	    // Form submission via modal Save button
	    $('#AddSocialConnectednessFormSubmitBtn').click(function(event){
	        // event.preventDefault(); // Prevent the default form submission
	        // alert("here!")
	        // Serialize the form data
	        var formData = $("#AddSocialConnectednessForm").serialize();

	        // Send the data to the server using AJAX
	        $.ajax({
	            url: "{{ route('submit.socialConnectedness') }}", // Route to the controller
	            type: "POST",
	            data: formData,
	            success: function(response) {
	                alert('Form submitted successfully!');
	                console.log(response);
	                $('#exampleModal').modal('hide');  // Close the modal after submission
	            },
	            error: function(xhr, status, error) {
	                alert('There was an error submitting the form!');
	            }
	        });
	    });

	    // Function to fetch the social connectedness data
	    function fetchSocialConnectedness(patientId) {
	        $.ajax({
	            url: "/social-connectedness/" + patientId, // Call to the route
	            type: "GET",
	            success: function(response) {
	                if (response) {
	                    // Populate the data into the table
	                    $('#family').text(response.family);
	                    $('#friends').text(response.friends);
	                    $('#classmates').text(response.classmate);
	                } else {
	                    alert('Data not found');
	                }
	            },
	            error: function(xhr, status, error) {
	                alert('There was an error fetching the data!');
	            }
	        });
	    }
	    // Call the function when the page loads or when a specific event occurs
    	fetchSocialConnectedness(patientId);

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

	        // Display the total score in the Total GAD-7 Score field
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

	        // Calculate the total score
	        var totalScore = phq9Q1 + phq9Q2 + phq9Q3 + phq9Q4 + phq9Q5 + phq9Q6 + phq9Q7 + phq9Q8 + phq9Q9;

	        // Display the total score in the Total PHQ-9 Score field
	        $('#PHQ_9_total').val(totalScore);
	        // Serialize the form data
	        var formData = $('#stressManagementForm').serialize();

	        // Send the data to the server using AJAX
	        $.ajax({
	            url: '{{ route("submit.stressManagement") }}', // Define the route for submission
	            type: 'POST',
	            data: formData + '&_token={{ csrf_token() }}', // Add CSRF token for security
	            success: function(response) {
	                // Handle success response
	                alert('Stress Level submitted successfully!');
	                console.log(response);
	            },
	            error: function(xhr, status, error) {
	                // Handle error response
	                alert('There was an error submitting the form.');
	                console.log(error);
	            }
	        });
	    });

	    // Fetch Stress Management data for a specific patient using AJAX
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
	                        $('#viewAllModal').modal('show');
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
    });
</script>

