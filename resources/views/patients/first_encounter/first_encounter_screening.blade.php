@php
    $firstEncounterSteps = [
        ['title' => 'Informed Consent', 'subtitle' => 'Review and sign']
    ];
    
    if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3') {
        $firstEncounterSteps[] = ['title' => 'Inclusion Criteria', 'subtitle' => 'Check eligibility'];
        $firstEncounterSteps[] = ['title' => 'Exclusion Criteria', 'subtitle' => 'Verify disqualifying conditions'];
        $firstEncounterSteps[] = ['title' => 'Eligibility Summary', 'subtitle' => 'Review eligibility status'];
    }
@endphp

<div class="container">
    <x-progress-bar 
        :steps="$firstEncounterSteps"
        :active-step="1"
        :completed-steps="[]"
        id="first-encounter-progress"
        type="arrow"
        :enable-click="true"
        container-class="mt-0">
        
        <div class="progress-section active" id="step-1">
            @include('patients.first_encounter.InformedConsent')
        </div>

        @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3')
        <div class="progress-section" id="step-2">
            @include('patients.first_encounter.inclusionCriteria')
        </div>
        <div class="progress-section" id="step-3">
            @include('patients.first_encounter.exclusionCriteria')
        </div>
        <div class="progress-section" id="step-4">
            @include('patients.first_encounter.eligibilitySummary')
        </div>
        @endif
    </x-progress-bar>
</div>
<!-- Blood Sugar Modal -->
    <div class="modal fade" id="bloodSugarModal" tabindex="-1" aria-labelledby="bloodSugarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloodSugarModalLabel">Add Blood Sugar Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('blood-sugar.store', $patient->id) }}" method="POST">
                        @csrf
                        <!-- Blood Sugar Result (mg/dL) -->
                        <div class="mb-3">
                            <label for="blood_sugar_mgdl" class="form-label">Blood Sugar (mg/dL)</label>
                            <input type="number" class="form-control @error('blood_sugar_mgdl') is-invalid @enderror"
                                   name="blood_sugar_mgdl" id="blood_sugar_mgdl" value="{{ old('blood_sugar_mgdl') }}"
                                   step="0.1" required>
                            @error('blood_sugar_mgdl')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blood Sugar Result (mmol/L) -->
                        <div class="mb-3">
                            <label for="blood_sugar_mmol" class="form-label">Blood Sugar (mmol/L)</label>
                            <input type="number" class="form-control @error('blood_sugar_mmol') is-invalid @enderror"
                                   name="blood_sugar_mmol" id="blood_sugar_mmol" value="{{ old('blood_sugar_mmol') }}"
                                   step="0.01" required>
                            @error('blood_sugar_mmol')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Test Date -->
                        <div class="mb-3">
                            <label for="test_date" class="form-label">Test Date</label>
                            <input type="date" class="form-control @error('test_date') is-invalid @enderror"
                                   name="test_date" id="test_date" value="{{ old('test_date') }}" required>
                            @error('test_date')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Save Test Result</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Bootstrap JavaScript (Required for Modal) -->

<!-- HbA1c Result Modal -->
	<div class="modal fade" id="addHbA1cModal" tabindex="-1" aria-labelledby="addHbA1cModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Add HbA1c Result</h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
	            </div>
	            <div class="modal-body">
	                <form id="hba1cForm">
	                    @csrf
	                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">

	                    <div class="mb-3">
	                        <label class="form-label">Test Date</label>
	                        <input type="date" name="date" id="date" class="form-control" required>
	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label">HbA1c Level (%)</label>
	                        <input type="number" step="0.1" name="result" id="result" class="form-control" required>
	                    </div>

	                    <input type="hidden" name="test_type" value="HbA1c">

	                    <div class="modal-footer">
	                        <button type="submit" class="btn btn-primary">Save Result</button>
	                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="uploadLabModal" tabindex="-1" aria-labelledby="uploadLabLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="uploadLabLabel">Upload Laboratory Result</h5>
	                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
	            </div>
	            <div class="modal-body">
	                <form id="labUploadForm" enctype="multipart/form-data">
	                    @csrf
	                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">

	                    <label class="block text-gray-700">Lab Test Type:</label>
	                    <input type="text" name="lab_type" id="lab_type" required class="mt-2 p-2 border rounded w-full" placeholder="e.g., CBC, HbA1c">
	                    <!-- Date of Procedure -->
			            <label class="block mt-3 mb-2 text-sm font-semibold">Date of Procedure:</label>
			            <input type="date" name="date_of_procedure" class="w-full border px-3 py-2 rounded focus:outline-blue-500" required>

	                    <label class="block text-gray-700 mt-3">Upload Image:</label>
	                    <input type="file" name="lab_image" id="lab_image" accept="image/*" required class="mt-2 p-2 border rounded w-full">
	                    
	                    <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded w-full">
	                        Upload
	                    </button>
	                </form>
	            </div>
	        </div>
	    </div>
</div>


	<!-- jQuery for AJAX -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
	    $(document).ready(function() {
            let isInitialLoad = true; // Track if this is the first load
            
            // Function to check and mark completed steps
            function checkCompletedSteps() {
                // Check Informed Consent step
                checkStepCompletion(1, 'informed-consent');
                
                // Check Inclusion Criteria step
                checkStepCompletion(2, 'inclusion-criteria');
                
                // Check Exclusion Criteria step
                checkStepCompletion(3, 'exclusion-criteria');
                
                // Check Eligibility Summary step (step 4)
                checkStepCompletion(4, 'eligibility-summary');
                
                // Set default tab only on initial load
                if (isInitialLoad) {
                    setDefaultTab();
                    isInitialLoad = false;
                }
            }
            
            function setDefaultTab() {
                // Get all completed steps
                const completedSteps = ProgressBar.getCompletedSteps('first-encounter-progress') || [];
                const maxSteps = {{ count($firstEncounterSteps) }};
                
                // Find the first incomplete step (step after the last completed one)
                let defaultStep = 1; // Start with step 1 by default
                
                if (completedSteps.length > 0) {
                    // Sort completed steps to find the highest completed step
                    const sortedCompleted = completedSteps.sort((a, b) => a - b);
                    const lastCompleted = sortedCompleted[sortedCompleted.length - 1];
                    
                    // Check if all steps are completed
                    if (completedSteps.length === maxSteps) {
                        // All steps complete - show the last step (eligibility summary)
                        defaultStep = maxSteps;
                    } else {
                        // Find first incomplete step after last completed
                        for (let step = 1; step <= maxSteps; step++) {
                            if (!completedSteps.includes(step)) {
                                defaultStep = step;
                                break;
                            }
                        }
                    }
                }
                
                ProgressBar.setActiveStep('first-encounter-progress', defaultStep);
            }

            function checkStepCompletion(stepNumber, stepType) {
                let hasData = false;
                
                // Check for existing data based on step type
                if (stepType === 'informed-consent') {
                    // Check if informed consent form is submitted/signed
                    // Look for consent confirmation, signatures, or submitted data
                    hasData = checkInformedConsentData();
                    
                } else if (stepType === 'inclusion-criteria') {
                    // Check if inclusion criteria form has been submitted
                    hasData = checkInclusionCriteriaData();
                    
                } else if (stepType === 'exclusion-criteria') {
                    // Check if exclusion criteria form has been submitted
                    hasData = checkExclusionCriteriaData();
                    
                } else if (stepType === 'eligibility-summary') {
                    // Check if eligibility summary should be complete (both inclusion and exclusion done)
                    hasData = checkEligibilitySummaryData();
                }
                
                // Update completed steps using the new progress bar API
                const currentCompleted = ProgressBar.getCompletedSteps('first-encounter-progress') || [];
                const activeStep = ProgressBar.getActiveStep('first-encounter-progress');
                
                if (hasData) {
                    // Mark step as completed if it has data, regardless of whether it's active
                    if (!currentCompleted.includes(stepNumber)) {
                        currentCompleted.push(stepNumber);
                        ProgressBar.markCompleted('first-encounter-progress', currentCompleted);
                    }
                } else if (!hasData) {
                    const filteredCompleted = currentCompleted.filter(step => step !== stepNumber);
                    ProgressBar.markCompleted('first-encounter-progress', filteredCompleted);
                }
            }

            function checkInformedConsentData() {
                // Check if informed consent form is submitted
                let hasConsent = false;
                
                // Check if the success message is visible (doesn't have 'hidden' class)
                if ($('#consent-message').length && !$('#consent-message').hasClass('hidden')) {
                    hasConsent = true;
                }
                
                // Also check if the form wrapper is hidden (form already submitted)
                if ($('#consent-form-wrapper').length && $('#consent-form-wrapper').hasClass('hidden')) {
                    hasConsent = true;
                }
                
                // Also check if submitted data section is visible
                if ($('#submitted-data').length && !$('#submitted-data').hasClass('hidden')) {
                    hasConsent = true;
                }
                
                return hasConsent;
            }

            function checkInclusionCriteriaData() {
                // Check if inclusion criteria form fields are disabled (form already submitted)
                let hasData = false;
                
                // Check if form inputs are disabled
                if ($('#inclusion-criteria-form input').length && $('#inclusion-criteria-form input').first().prop('disabled')) {
                    hasData = true;
                }
                
                return hasData;
            }

            function checkExclusionCriteriaData() {
                // Check if exclusion criteria form fields are disabled (form already submitted)
                let hasData = false;
                
                // Check if form inputs are disabled
                if ($('#exclusion-criteria-form select').length && $('#exclusion-criteria-form select').first().prop('disabled')) {
                    hasData = true;
                }
                
                return hasData;
            }

            function checkEligibilitySummaryData() {
                // Eligibility summary is complete when BOTH inclusion and exclusion are complete
                const inclusionComplete = checkInclusionCriteriaData();
                const exclusionComplete = checkExclusionCriteriaData();
                
                return inclusionComplete && exclusionComplete;
            }

            // Check completed steps on page load
            setTimeout(checkCompletedSteps, 1000);
            
            // Also check after a longer delay to catch any async-loaded success messages
            setTimeout(checkCompletedSteps, 2500);
            
            // Add additional checks for informed consent specifically
            setTimeout(checkCompletedSteps, 3500);
            setTimeout(checkCompletedSteps, 5000);
            
            // Listen for form completion events (no auto-advance)
            document.addEventListener('informedConsentCompleted', function(e) {
                setTimeout(function() {
                    checkCompletedSteps();
                }, 200);
            });
            
            document.addEventListener('inclusionCriteriaCompleted', function(e) {
                setTimeout(function() {
                    checkCompletedSteps();
                }, 200);
            });
            
            document.addEventListener('exclusionCriteriaCompleted', function(e) {
                setTimeout(function() {
                    checkCompletedSteps();
                }, 200);
            });
            
            // Monitor for changes in success message visibility
            function observeSuccessMessages() {
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            const target = mutation.target;
                            if (target.id === 'consent-message' || 
                                target.id === 'inclusion-criteria-message' || 
                                target.id === 'exclusion-criteria-message') {
                                setTimeout(() => {
                                    checkCompletedSteps();
                                }, 100);
                            }
                        }
                    });
                });
                
                // Observe all success message elements AND form wrappers
                ['#consent-message', '#consent-form-wrapper', '#submitted-data', '#inclusion-criteria-message', '#exclusion-criteria-message'].forEach(function(selector) {
                    const element = document.querySelector(selector);
                    if (element) {
                        observer.observe(element, { attributes: true, attributeFilter: ['class'] });
                    }
                });
                
                // Also observe for form field changes (disabled state)
                const formsObserver = new MutationObserver(function(mutations) {
                    setTimeout(() => {
                        checkCompletedSteps();
                    }, 100);
                });
                
                // Observe inclusion and exclusion forms for disabled state changes
                const inclusionForm = document.getElementById('inclusion-criteria-form');
                const exclusionForm = document.getElementById('exclusion-criteria-form');
                
                if (inclusionForm) {
                    formsObserver.observe(inclusionForm, { 
                        attributes: true, 
                        subtree: true, 
                        attributeFilter: ['disabled'] 
                    });
                }
                
                if (exclusionForm) {
                    formsObserver.observe(exclusionForm, { 
                        attributes: true, 
                        subtree: true, 
                        attributeFilter: ['disabled'] 
                    });
                }
            }
            
            // Start observing after DOM is ready
            setTimeout(observeSuccessMessages, 500);

            // Update completion status when forms change
            $(document).on('change input', '#step-1 input, #step-1 textarea, #step-1 select', function() {
                setTimeout(checkCompletedSteps, 100);
            });

            $(document).on('change input', '#step-2 input, #step-2 textarea, #step-2 select', function() {
                setTimeout(checkCompletedSteps, 100);
            });

            $(document).on('change input', '#step-3 input, #step-3 textarea, #step-3 select', function() {
                setTimeout(checkCompletedSteps, 100);
            });

		    $('#hba1cForm').submit(function(event) {
		        event.preventDefault(); // Prevent page reload

		        let patientId = "{{ $patient->id }}"; // Get patient ID dynamically

		        $.ajax({
		            url: `/patients/${patientId}/laboratory`, // Dynamic route
		            method: "POST",
		            data: $(this).serialize(),
		            success: function(response) {
		                if (response.success) {
		                    // Append new result row dynamically
		                    let newRow = `
		                        <tr>
		                            <td class="border border-gray-300 px-4 py-2">${response.date}</td>
		                            <td class="border border-gray-300 px-4 py-2">${response.result}%</td>
		                            <td class="border border-gray-300 px-4 py-2">${response.blood_sugar} mg/dL</td>
		                            <td class="border border-gray-300 px-4 py-2">${response.remarks}</td>
		                        </tr>
		                    `;
		                    $('#hba1cTable tbody').prepend(newRow);

		                    // Close modal and reset form
		                    $('#addHbA1cModal').modal('hide');
		                    $('#hba1cForm')[0].reset();
		                }
		            },
		            error: function(xhr) {
		                alert("Error: " + xhr.responseJSON.message);
		            }
		        });
		    });

		     $('#labUploadForm').submit(function (event) {
		        event.preventDefault(); // Prevent reload

		        let formData = new FormData(this);
		        let patientId = "{{ $patient->id }}"; 

		        $.ajax({
		            url: `/patients/${patientId}/laboratory/upload`,
		            method: "POST",
		            data: formData,
		            processData: false,
		            contentType: false,
		            success: function (response) {
		                if (response.success) {
		                    let newRow = `
		                        <tr>
		                            <td class="border px-4 py-2">${response.test_type}</td>
		                    		<td class="border px-4 py-2">${response.date}</td>
		                            <td class="border px-4 py-2">
		                                <img src="${response.image_url}" class="w-32 h-32 rounded shadow">
		                            </td>
		                        </tr>`;
		                    $('#uploadedResults').prepend(newRow);

		                    $('#uploadLabModal').modal('hide');
		                    $('#labUploadForm')[0].reset();
		                }
		            },
		            error: function (xhr) {
		                alert("Error: " + xhr.responseJSON.message);
		            }
		        });
		    });
		});
	</script>

