<!-- Display errors if there are any -->
<div id="exclusion-error-messages" class="text-red-500 mb-4 hidden"></div>

<div id="exclusion-criteria-form-wrapper">
    <form id="exclusion-criteria-form" method="POST">
        @csrf
        <input type="hidden" name="patient_id" id="exclusion_patient_id" value="{{ $patient->id }}">

        <p class="mb-4 text-gray-700">This form certifies that the resident:</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- 1. Emergency or unstable cases -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">1. Resident with emergency or unstable cases needing urgent hospital care.</label>
                <select name="emergency_unstable_case" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 4. Confined to residence or unable to do moderate physical activity -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">4. Resident who is confined to their residence or unable to do moderate physical activity</label>
                <select name="confined_or_no_activity" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 2. Psychiatric or neurologic conditions -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">2. Resident with psychiatric or neurologic conditions that impede his/her ability to give reliable information</label>
                <select name="psychiatric_neuro_condition" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 5. Unable to feed/cook/decide food intake -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">5. Resident unable to feed him/herself, cook, or decide on his/her food intake</label>
                <select name="unable_feed_cook_decide" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 3. Unable to give complete data -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">3. Resident unable to give complete data during the project duration</label>
                <select name="unable_complete_data" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>

            <!-- 6. Pregnant woman -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">6. Pregnant woman</label>
                <select name="pregnant_woman" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                    <option value="na">N/A</option>
                </select>
            </div>
        </div>

        <div class="mt-6 p-3 bg-[#FCFFC7] font-semibold italic flex items-start gap-3" style="border: 1px solid #B79E1D; border-radius: 8px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 20H22L12 2Z" stroke="#B79E1D" stroke-width="2" fill="none"/>
                <path d="M12 8V13" stroke="#B79E1D" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="16" r="1" fill="#B79E1D"/>
            </svg>
            <span class="text-[#383838]">If any of the above is answered YES, the subject is not eligible for the research and must be EXCLUDED from the study</span>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-2 md:mt-4 lg:mt-6">
            <button type="submit" class="bg-[#7CAD3E] hover:bg-[#5a8c2e] text-white border-none px-6 py-2 rounded-full text-base font-medium cursor-pointer transition-colors duration-300 flex items-center gap-2">
                <span>Save & Continue</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 11H8V13H12V16L16 12L12 8V11Z" fill="white"/>
                </svg>
            </button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    let patientId = $('#exclusion_patient_id').val();

    // Check if the form has already been submitted when the page loads
    $.get(`/research-exclusion/check/${patientId}`, function(response) {
        if (response.form_exists) {
            // Disable all form fields and hide the save button
            $('#exclusion-criteria-form input, #exclusion-criteria-form select, #exclusion-criteria-form textarea, #exclusion-criteria-form button[type="submit"]').prop('disabled', true);
            $('#exclusion-criteria-form button[type="submit"]').closest('div').hide();
            displayExclusionAnswers(response.data);
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
                    // Disable all form fields and hide submit button
                    $('#exclusion-criteria-form input, #exclusion-criteria-form select, #exclusion-criteria-form textarea, #exclusion-criteria-form button[type="submit"]').prop('disabled', true);
                    $('#exclusion-criteria-form button[type="submit"]').closest('div').hide();
                    
                    // Display the submitted answers
                    displayExclusionAnswers(response.data);
                    
                    // Mark step 3 as completed and trigger check with auto-advance
                    setTimeout(function() {
                        // Trigger a custom event to notify parent that form is submitted
                        const event = new CustomEvent('exclusionCriteriaCompleted', { detail: { autoAdvance: true } });
                        document.dispatchEvent(event);
                    }, 100);
                    
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
        // Populate form fields with saved data
        $('select[name="emergency_unstable_case"]').val(data.emergency_unstable_case || '');
        $('select[name="psychiatric_neuro_condition"]').val(data.psychiatric_neuro_condition || '');
        $('select[name="unable_complete_data"]').val(data.unable_complete_data || '');
        $('select[name="confined_or_no_activity"]').val(data.confined_or_no_activity || '');
        $('select[name="unable_feed_cook_decide"]').val(data.unable_feed_cook_decide || '');
        $('select[name="pregnant_woman"]').val(data.pregnant_woman || '');
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
