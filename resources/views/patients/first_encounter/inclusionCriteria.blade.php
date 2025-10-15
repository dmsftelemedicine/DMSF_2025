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
                            <svg class="w-4 h-4 text-gray-400 cursor-help fbs-tooltip-trigger" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
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
                            <svg class="w-4 h-4 text-gray-400 cursor-help rbs-tooltip-trigger" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
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

        <div class="mt-6 p-3 bg-[#FCFFC7] font-semibold italic flex items-start gap-3" style="border: 1px solid #B79E1D; border-radius: 8px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 20H22L12 2Z" stroke="#B79E1D" stroke-width="2" fill="none"/>
                <path d="M12 8V13" stroke="#B79E1D" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="16" r="1" fill="#B79E1D"/>
            </svg>
            <span class="text-[#383838]">If any of the above is answered NO, the subject is not eligible for the research and must not be INCLUDED in the study.</span>
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
        $('input[name="laboratory_finding"][value="' + data.laboratory_finding + '"]').prop('checked', true);
        
        // Handle FBS result - show "Nothing given" if null
        if (data.fbs_result !== null && data.fbs_result !== '') {
            $('#fbs_result').val(data.fbs_result);
        } else {
            $('#fbs_result').val('').attr('placeholder', 'Nothing given');
        }
        
        // Handle RBS result - show "Nothing given" if null
        if (data.rbs_result !== null && data.rbs_result !== '') {
            $('#rbs_result').val(data.rbs_result);
        } else {
            $('#rbs_result').val('').attr('placeholder', 'Nothing given');
        }
        
        // Populate checkboxes for symptoms
        if (data.polyuria == 1) $('#polyuria').prop('checked', true);
        if (data.polydipsia == 1) $('#polydipsia').prop('checked', true);
        if (data.polyphagia == 1) $('#polyphagia').prop('checked', true);
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
