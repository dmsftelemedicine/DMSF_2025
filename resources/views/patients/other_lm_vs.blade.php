<div class="row">
    <div class="col-4">
        <div class="list-group" id="other-lm-vs-list" role="tablist">
            <a class="list-group-item list-group-item-action" id="sleep-list" data-bs-toggle="list" href="#sleep" role="tab" aria-controls="sleep">Sleep</a>
            <a class="list-group-item list-group-item-action active" id="social-connectedness-list" data-bs-toggle="list" href="#social-connectedness" role="tab" aria-controls="social-connectedness">Social Connectedness</a>
            <a class="list-group-item list-group-item-action" id="stress-management-list" data-bs-toggle="list" href="#stress-management" role="tab" aria-controls="stress-management">Stress Management</a>
            <a class="list-group-item list-group-item-action" id="substance-use-list" data-bs-toggle="list" href="#substance-use" role="tab" aria-controls="substance-use">Substance Use</a>
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="other-lm-vs-tabContent">
            <div class="tab-pane fade show active" id="social-connectedness" role="tabpanel" aria-labelledby="social-connectedness-list">
                @include('patients.screeningtool.forms.social_connectedness_tab')
            </div>
            <div class="tab-pane fade" id="stress-management" role="tabpanel" aria-labelledby="stress-management-list">
                @include('patients.screeningtool.forms.stress_management_tab')
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
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