<div class="mt-6 p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-bold">Exclusion Criteria Form</h2>

    <!-- Success message -->
    <div id="exclusion-criteria-message" class="mb-4 p-2 bg-green-100 text-green-700 rounded hidden">
        ❌ Exclusion criteria form already submitted.
    </div>

    <!-- Display errors if there are any -->
    <div id="exclusion-error-messages" class="text-red-500 mb-4 hidden"></div>

    <!-- Display form answers if already submitted -->
    <div id="exclusion-criteria-answers" class="hidden">
        <h3 class="font-semibold">Submitted Answers:</h3>
        <div id="exclusion-answers-content"></div>
    </div>

    <div id="exclusion-criteria-form-wrapper">
        <form id="exclusion-criteria-form" method="POST">
            @csrf
            <input type="hidden" name="patient_id" id="exclusion_patient_id" value="{{ $patient->id }}">

            <!-- 1. Emergency or unstable cases -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">1. Resident with emergency or unstable cases needing urgent hospital care.</label>
                <select name="emergency_unstable_case" class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 2. Psychiatric or neurologic conditions -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">2. Resident with psychiatric or neurologic conditions that impede his/her ability to give reliable information</label>
                <select name="psychiatric_neuro_condition" class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 3. Unable to give complete data -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">3. Resident unable to give complete data during the project duration</label>
                <select name="unable_complete_data" class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 4. Confined to residence or unable to do moderate physical activity -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">4. Resident who is confined to their residence or unable to do moderate physical activity</label>
                <select name="confined_or_no_activity" class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 5. Unable to feed/cook/decide food intake -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">5. Resident unable to feed him/herself, cook, or decide on his/her food intake</label>
                <select name="unable_feed_cook_decide" class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 6. Pregnant woman -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">6. Pregnant woman</label>
                <select name="pregnant_woman" class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <div class="mt-6 p-2 bg-yellow-100 text-yellow-800 rounded font-semibold italic">
                If any of the above is answered YES, the subject is not eligible for the research and must be EXCLUDED from the study
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-2 md:mt-4 lg:mt-6">
            <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">
                Submit Exclusion Criteria Form
            </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    let patientId = $('#exclusion_patient_id').val();

    // Check if the form has already been submitted when the page loads
    $.get(`/research-exclusion/check/${patientId}`, function(response) {
        if (response.form_exists) {
            // Hide the form and show the submission message with the answers
            $('#exclusion-criteria-form-wrapper').addClass('hidden');
            $('#exclusion-criteria-message').removeClass('hidden');
            displayExclusionAnswers(response.data);
        } else {
            // The form hasn't been submitted yet, so show the form (default behavior)
            $('#exclusion-criteria-form-wrapper').removeClass('hidden');
            $('#exclusion-criteria-message').addClass('hidden');
        }
    });

    // Handle form submission
    $('#exclusion-criteria-form').submit(function(e) {
        e.preventDefault();

        // Clear any previous error messages
        $('#exclusion-error-messages').addClass('hidden').html('');

        $.ajax({
            url: "{{ route('research_exclusion.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                // Check if response indicates success
                if (response && (response.success !== false)) {
                    // Hide the form and show the submission message
                    $('#exclusion-criteria-form-wrapper').addClass('hidden');
                    $('#exclusion-criteria-message').removeClass('hidden');
                    
                    // Display the submitted answers
                    displayExclusionAnswers(response.data);
                    
                    // Optional: Show a temporary success notification without alert
                    if (response.message) {
                        showTemporaryNotification('Success! ' + response.message, 'success');
                    }
                } else {
                    // Handle case where response indicates failure
                    showTemporaryNotification('Error: ' + (response.message || 'Form submission failed'), 'error');
                }
            },
            error: function(xhr) {
                // Handle validation errors or server errors
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let errorList = '<ul>';
                    $.each(errors, function(key, value) {
                        errorList += '<li>' + value[0] + '</li>';
                    });
                    errorList += '</ul>';
                    $('#exclusion-error-messages').html(errorList).removeClass('hidden');
                } else {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message 
                        ? xhr.responseJSON.message 
                        : 'There was an issue with the form submission.';
                    showTemporaryNotification('Error: ' + errorMessage, 'error');
                }
            }
        });
    });

    function displayExclusionAnswers(data) {
        let answersHtml = `
            <p><strong>Emergency/Unstable Case:</strong> ${capitalize(data.emergency_unstable_case)}</p>
            <p><strong>Psychiatric/Neurologic Condition:</strong> ${capitalize(data.psychiatric_neuro_condition)}</p>
            <p><strong>Unable to Give Complete Data:</strong> ${capitalize(data.unable_complete_data)}</p>
            <p><strong>Confined/No Physical Activity:</strong> ${capitalize(data.confined_or_no_activity)}</p>
            <p><strong>Unable to Feed/Cook/Decide Food Intake:</strong> ${capitalize(data.unable_feed_cook_decide)}</p>
            <p><strong>Pregnant Woman:</strong> ${capitalize(data.pregnant_woman)}</p>
        `;
        $('#exclusion-answers-content').html(answersHtml);
        $('#exclusion-criteria-answers').removeClass('hidden');
    }

    function capitalize(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
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
        }, 10000);
    }
});
</script>
