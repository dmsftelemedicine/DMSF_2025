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
                <input type="date" name="date" class="w-full px-4 py-2 border rounded-lg">
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

            <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-bold rounded-lg shadow-md hover:bg-blue-600">
                Submit Consent Form
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Check if the form already exists (optional, for modal use)
    let patientId = $('#patient_id').val();
    // Check if consent form already exists
    $.get(`/informed-consent/check/${patientId}`, function(response) {
        if (response.form_exists) {
            $('#consent-message').removeClass('hidden');
            $('#consent-form-wrapper').addClass('hidden');
            $('#submitted-data').removeClass('hidden');
            
            // Populate the submitted data
            $('#submitted-date').text(response.data.date);
            $('#submitted-session').text(response.data.session);
            $('#submitted-participant-signed').text(response.data.participant_signed ? 'Yes' : 'No');
            $('#submitted-witness-signed').text(response.data.witness_signed ? 'Yes' : 'No');
            $('#submitted-witness-name').text(response.data.witness_name || 'N/A');
            $('#submitted-copy-given').text(response.data.copy_given ? 'Yes' : 'No');
            
            if (!response.data.copy_given && response.data.copy_reason) {
                $('#submitted-reason-container').removeClass('hidden');
                $('#submitted-copy-reason').text(response.data.copy_reason);
            }
        }
    });

    // Handle form submission WITHOUT page reload
    $('#consent-form').submit(function(e) {
        e.preventDefault(); // 🔥 stops page reload

        $.ajax({
            url: "{{ route('informed_consent.store') }}",
            type: "POST",
            data: $(this).serialize(), // gathers all form data including CSRF token
            success: function(response) {
                alert(response.message); // ✅ replace with SweetAlert or toast if desired
                $('#consent-form').addClass('hidden'); // hides form on success
            },
            error: function(xhr) {
                if (xhr.status === 409) {
                    alert(xhr.responseJSON.message);
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
                    alert('An unexpected error occurred.');
                }
            }
        });
    });
});
</script>


