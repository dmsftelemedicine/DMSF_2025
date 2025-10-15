<!-- Display errors if there are any -->
<div id="error-messages" class="text-red-500 mb-4 hidden"></div>

<div id="inclusion-criteria-form-wrapper">
    <form id="inclusion-criteria-form" method="POST">
        @csrf
        <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">

        <p class="mb-4 text-gray-700">This form certifies that the resident:</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <!-- 1. Read and write ability -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">1. Can read, write, and give consent</label>
                    <select name="read_and_write_consent" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- 2. Consent to provide information -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">2. Agrees to provide personal and health information</label>
                    <select name="consent_for_info" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- 3. Consent for teleconsultation -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">3. Agrees to teleconsultation for lifestyle care</label>
                    <select name="consent_for_teleconsultation" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- 4. Laboratory finding -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">4. Meets clinical criteria (FBS ≥ 126 or RBS ≥200 mg/dL with symptoms)</label>
                    <select name="laboratory_finding" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <!-- FBS Result -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2 flex items-center justify-between">
                        <span>FBS Result (mg/dL):</span>
                        <span class="relative">
                            <!-- Question circle icon from Bootstrap Icons -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill text-black cursor-help fbs-tooltip-trigger" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247m2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                            </svg>
                            <div class="fbs-tooltip hidden absolute right-0 top-6 z-50 w-64 p-2 bg-gray-800 text-white text-xs rounded shadow-lg">
                                Normal: Below 100 mg/dL<br>
                                Prediabetes: 100-126 mg/dL<br>
                                Diabetes: 127 mg/dL or higher
                            </div>
                        </span>
                    </label>
                    <input type="number" name="fbs_result" placeholder="Enter FBS Result here" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]" step="0.1" min="0">
                </div>

                <!-- RBS Result -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2 flex items-center justify-between">
                        <span>RBS Result (mg/dL):</span>
                        <span class="relative">
                            <!-- Question circle icon from Bootstrap Icons -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill text-black cursor-help rbs-tooltip-trigger" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247m2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                            </svg>
                            <div class="rbs-tooltip hidden absolute right-0 top-6 z-50 w-64 p-2 bg-gray-800 text-white text-xs rounded shadow-lg">
                                Normal: Below 140 mg/dL<br>
                                Prediabetes: 140-199 mg/dL<br>
                                Diabetes: 200 mg/dL or higher
                            </div>
                        </span>
                    </label>
                    <input type="number" name="rbs_result" placeholder="Enter RBS Result here" class="w-full px-4 py-2 rounded-lg bg-[#F7F7F7] border border-[#BFBFBF]" step="0.1" min="0">
                </div>

                <!-- Symptoms -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">Hyperglycemia Symptoms (check all that apply):</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="hidden" name="polyuria" value="0">
                            <input type="checkbox" name="polyuria" value="1" class="w-4 h-4 mr-2 rounded border-[#BFBFBF]">
                            <span class="text-gray-700">Polyuria (frequent urination)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="hidden" name="polydipsia" value="0">
                            <input type="checkbox" name="polydipsia" value="1" class="w-4 h-4 mr-2 rounded border-[#BFBFBF]">
                            <span class="text-gray-700">Polydipsia (excessive thirst)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="hidden" name="polyphagia" value="0">
                            <input type="checkbox" name="polyphagia" value="1" class="w-4 h-4 mr-2 rounded border-[#BFBFBF]">
                            <span class="text-gray-700">Polyphagia (excessive hunger)</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 p-3 bg-[#FCFFC7] font-semibold italic flex items-center gap-3" style="border: 1px solid #B79E1D; border-radius: 8px;">
            <!-- exclamation triangle icon from bootstrap -->
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#B79E1D" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
            </svg>
            <span class="text-[#383838]">If any of the above is answered NO, the subject is not eligible for the research and must not be INCLUDED in the study.</span>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-2 md:mt-4 lg:mt-6">
            <button type="submit" class="bg-[#7CAD3E] hover:bg-[#5a8c2e] text-white border-none px-6 py-2 rounded-full text-base font-medium cursor-pointer transition-colors duration-300 flex items-center gap-2">
                <span>Save & Continue</span>
                <!-- arrow right circle icon from bootstrap -->
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                </svg>
            </button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    let patientId = $('#patient_id').val();

    // Tooltip functionality
    $('.fbs-tooltip-trigger').hover(
        function() {
            $('.fbs-tooltip').removeClass('hidden');
        },
        function() {
            $('.fbs-tooltip').addClass('hidden');
        }
    );

    $('.rbs-tooltip-trigger').hover(
        function() {
            $('.rbs-tooltip').removeClass('hidden');
        },
        function() {
            $('.rbs-tooltip').addClass('hidden');
        }
    );

    // First, check if the form has already been submitted when the page loads
    $.get(`/research-eligibility/check/${patientId}`, function(response) {
        if (response.form_exists) {
            // Disable all form fields and hide the save button
            $('#inclusion-criteria-form input, #inclusion-criteria-form select, #inclusion-criteria-form textarea, #inclusion-criteria-form button[type="submit"]').prop('disabled', true);
            $('#inclusion-criteria-form button[type="submit"]').closest('div').hide();
            displayAnswers(response.data);
        }
    });

    // Handle form submission
    $('#inclusion-criteria-form').submit(function(e) {
        e.preventDefault();

        // Clear any previous error messages
        $('#error-messages').addClass('hidden').html('');

        $.ajax({
            url: "{{ route('research_eligibility.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                // Check if response indicates success
                if (response && (response.success !== false)) {
                    // Disable all form fields and hide submit button
                    $('#inclusion-criteria-form input, #inclusion-criteria-form select, #inclusion-criteria-form textarea, #inclusion-criteria-form button[type="submit"]').prop('disabled', true);
                    $('#inclusion-criteria-form button[type="submit"]').closest('div').hide();
                    
                    // Display the submitted answers
                    displayAnswers(response.data);
                    
                    // Mark step 2 as completed and trigger check with auto-advance
                    setTimeout(function() {
                        // Trigger a custom event to notify parent that form is submitted
                        const event = new CustomEvent('inclusionCriteriaCompleted', { detail: { autoAdvance: true } });
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
                    $('#error-messages').html(errorList).removeClass('hidden');
                } else {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message 
                        ? xhr.responseJSON.message 
                        : 'There was an issue with the form submission.';
                    showTemporaryNotification('Error: ' + errorMessage, 'error');
                }
            }
        });
    });

    function displayAnswers(data) {
        // Populate form fields with saved data
        $('input[name="read_and_write_consent"][value="' + data.read_and_write_consent + '"]').prop('checked', true);
        $('input[name="consent_for_info"][value="' + data.consent_for_info + '"]').prop('checked', true);
        $('input[name="consent_for_teleconsultation"][value="' + data.consent_for_teleconsultation + '"]').prop('checked', true);
        $('select[name="laboratory_finding"]').val(data.laboratory_finding);
        
        // Handle FBS result - show "Nothing given" if null
        if (data.fbs_result !== null && data.fbs_result !== '') {
            $('input[name="fbs_result"]').val(data.fbs_result);
        } else {
            $('input[name="fbs_result"]').val('').attr('placeholder', 'Nothing given');
        }
        
        // Handle RBS result - show "Nothing given" if null
        if (data.rbs_result !== null && data.rbs_result !== '') {
            $('input[name="rbs_result"]').val(data.rbs_result);
        } else {
            $('input[name="rbs_result"]').val('').attr('placeholder', 'Nothing given');
        }
        
        // Populate checkboxes for symptoms
        if (data.polyuria == 1) $('input[name="polyuria"]').prop('checked', true);
        if (data.polydipsia == 1) $('input[name="polydipsia"]').prop('checked', true);
        if (data.polyphagia == 1) $('input[name="polyphagia"]').prop('checked', true);
    }

// Function to determine HbA1c result condition
function getfbsCondition(fbs) {
    if (fbs < 100) {
        return 'Normal';
    } else if (fbs >= 100 && fbs < 126) {
        return 'Prediabetes';
    } else {
        return 'Diabetes';
    }
}

// Function to determine RBS result condition
function getRbsCondition(rbs) {
    if (rbs < 140) {
        return 'Normal';
    } else if (rbs >= 140 && rbs < 200) {
        return 'Prediabetes';
    } else {
        return 'Diabetes';
    }
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

});
</script>
