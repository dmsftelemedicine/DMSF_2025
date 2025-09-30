<div class="mt-6 p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-bold">Add Informed Consent Form</h2>

    <div id="consent-message" class="mb-4 p-2 bg-green-100 text-green-700 rounded hidden">
        ✅ Consent form already submitted.
    </div>

    <!-- Display submitted form data -->
    <div id="submitted-data" class="mb-4 p-4 bg-gray-50 rounded-lg hidden">
        <h3 class="text-lg font-semibold mb-3">Submitted Consent Form Details</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="font-medium">Date:</p>
                <p id="submitted-date" class="text-gray-600"></p>
            </div>
            <div>
                <p class="font-medium">Session:</p>
                <p id="submitted-session" class="text-gray-600"></p>
            </div>
            <div>
                <p class="font-medium">Participant Signed:</p>
                <p id="submitted-participant-signed" class="text-gray-600"></p>
            </div>
            <div>
                <p class="font-medium">Witness Signed:</p>
                <p id="submitted-witness-signed" class="text-gray-600"></p>
            </div>
            <div>
                <p class="font-medium">Witness Name:</p>
                <p id="submitted-witness-name" class="text-gray-600"></p>
            </div>
            <div>
                <p class="font-medium">Copy Given to Participant:</p>
                <p id="submitted-copy-given" class="text-gray-600"></p>
            </div>
            <div id="submitted-reason-container" class="hidden">
                <p class="font-medium">Reason for No Copy:</p>
                <p id="submitted-copy-reason" class="text-gray-600"></p>
            </div>
        </div>
    </div>

    <!-- Display errors if there are any -->
    <div id="error-messages" class="text-red-500 mb-4 hidden"></div>
    <div id="consent-form-wrapper">
        <form id="consent-form" method="POST">
            @csrf
            <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Date</label>
                <input 
                    type="date" 
                    name="date" 
                    class="w-full px-4 py-2 border rounded-lg"
                    value="{{ old('date', now()->format('Y-m-d')) }}"
                >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Session</label>
                <select name="session" class="w-full px-4 py-2 border rounded-lg">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Participant Signed</label>
                <input type="hidden" name="participant_signed" value="0">
                <input type="checkbox" name="participant_signed" value="1" class="mr-2"> Yes
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Witness Signed</label>
                <input type="hidden" name="witness_signed" value="0">
                <input type="checkbox" name="witness_signed" value="1" class="mr-2"> Yes
            </div>


            <div class="mb-4">
                <label class="block font-medium text-gray-700">Name of ICF Witness</label>
                <input type="text" name="witness_name" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Copy Given to Participant?</label>
                <div>
                    <input type="radio" name="copy_given" value="1" class="mr-2"> Yes
                    <input type="radio" name="copy_given" value="0" class="ml-4 mr-2"> No
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">If No, Reason</label>
                <input type="text" name="copy_reason" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="flex justify-center mt-2 md:mt-4 lg:mt-6">
            <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">
                Submit Consent Form
            </button>
            </div>
        </form>
    </div>
</div>


<script>
$(document).ready(function() {
    // Check if the form already exists (optional, for modal use)
    let patientId = $('#patient_id').val();

    function populateSubmittedData(data) {
        console.log('populateSubmittedData called with:', data);
        
        // Handle date
        $('#submitted-date').text(data.date || 'N/A');
        
        // Handle session
        $('#submitted-session').text(data.session || 'N/A');
        
        // Handle participant_signed (can be boolean, string, or number)
        let participantSigned = 'No';
        if (data.participant_signed === true || data.participant_signed === 1 || data.participant_signed === '1') {
            participantSigned = 'Yes';
        }
        $('#submitted-participant-signed').text(participantSigned);
        
        // Handle witness_signed (can be boolean, string, or number)
        let witnessSigned = 'No';
        if (data.witness_signed === true || data.witness_signed === 1 || data.witness_signed === '1') {
            witnessSigned = 'Yes';
        }
        $('#submitted-witness-signed').text(witnessSigned);
        
        // Handle witness name
        $('#submitted-witness-name').text(data.witness_name || 'N/A');
        
        // Handle copy_given (can be boolean, string, or number)
        let copyGiven = 'No';
        if (data.copy_given === true || data.copy_given === 1 || data.copy_given === '1') {
            copyGiven = 'Yes';
        }
        $('#submitted-copy-given').text(copyGiven);

        // Handle copy reason
        if ((data.copy_given === false || data.copy_given === 0 || data.copy_given === '0') && data.copy_reason) {
            $('#submitted-reason-container').removeClass('hidden');
            $('#submitted-copy-reason').text(data.copy_reason);
        } else {
            $('#submitted-reason-container').addClass('hidden');
        }
        
        console.log('Data populated successfully');
    }

    function showTemporaryNotification(message, type) {
        // Create notification element
        let notificationClass = type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
        let notification = $(`
            <div class="fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${notificationClass} max-w-sm">
                <div class="flex items-center">
                    <span class="mr-2">${type === 'success' ? '✅' : '❌'}</span>
                    <span>${message}</span>
                </div>
            </div>
        `);
        
        // Add to body
        $('body').append(notification);
        
        // Remove after 5 seconds
        setTimeout(function() {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 5000);
    }

    // Check if consent form already exists
    $.get(`/informed-consent/check/${patientId}`, function(response) {
        if (response.form_exists) {
            $('#consent-message').removeClass('hidden');
            $('#consent-form-wrapper').addClass('hidden');
            $('#submitted-data').removeClass('hidden');

            // Populate the submitted data using the helper function
            populateSubmittedData(response.data);
        }
    });

    // Handle form submission WITHOUT page reload
    $('#consent-form').submit(function(e) {
        e.preventDefault(); // 🔥 stops page reload

        // Clear any previous error messages
        $('#error-messages').addClass('hidden').html('');

        $.ajax({
            url: "{{ route('informed_consent.store') }}",
            type: "POST",
            data: $(this).serialize(), // gathers all form data including CSRF token
            success: function(response) {
                // Add debugging to see what we're getting
                console.log('Response received:', response);
                console.log('Response data:', response.data);
                
                // Check if response indicates success
                if (response && (response.success !== false)) {
                    // Hide the form and show the submission message
                    $('#consent-form-wrapper').addClass('hidden');
                    $('#consent-message').removeClass('hidden');
                    $('#submitted-data').removeClass('hidden');
                    
                    // Populate the submitted data
                    if (response.data) {
                        console.log('Calling populateSubmittedData with:', response.data);
                        populateSubmittedData(response.data);
                    } else if (response.informed_consent) {
                        // Fallback in case the data is nested differently
                        console.log('Using fallback data structure:', response.informed_consent);
                        populateSubmittedData(response.informed_consent);
                    } else {
                        console.log('No response.data found, trying to extract from form');
                        // Last resort: extract data from the form that was just submitted
                        let formData = $('#consent-form').serializeArray();
                        let extractedData = {};
                        formData.forEach(function(field) {
                            extractedData[field.name] = field.value;
                        });
                        console.log('Extracted form data:', extractedData);
                        populateSubmittedData(extractedData);
                    }
                    
                    // Optional: Show a temporary success notification without alert
                    if (response.message) {
                        showTemporaryNotification('Success! ' + response.message, 'success');
                    }
                } else {
                    // Handle case where response indicates failure
                    console.log('Response indicates failure:', response);
                    showTemporaryNotification('Error: ' + (response.message || 'Form submission failed'), 'error');
                }
            },
            error: function(xhr) {
                if (xhr.status === 409) {
                    showTemporaryNotification('Error: ' + xhr.responseJSON.message, 'error');
                } else if (xhr.status === 422) {
                    // Laravel validation errors
                    let errors = xhr.responseJSON.errors;
                    let errorList = '<ul>';
                    $.each(errors, function(key, value) {
                        errorList += '<li>' + value[0] + '</li>';
                    });
                    errorList += '</ul>';
                    $('#error-messages').html(errorList).removeClass('hidden');
                } else {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message 
                        ? xhr.responseJSON.message 
                        : 'An unexpected error occurred.';
                    showTemporaryNotification('Error: ' + errorMessage, 'error');
                }
            }
        });
    });
});
</script>


