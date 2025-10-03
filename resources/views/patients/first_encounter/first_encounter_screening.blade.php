<style>
.clearfix:after {
    clear: both;
    content: "";
    display: block;
    height: 0;
}

.progress-nav {
    margin: 1rem 2rem;
    padding: 0 1rem;
    max-width: 1200px;
    font-family: 'Lato', sans-serif;
}

.progress-bar-container {
    display: flex;
    justify-content: left;
    align-items: center;
    position: relative;
    margin: 2rem 0;
    max-width: 100%;
    margin-top: 0;
}

.arrow-steps {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.arrow-steps .progress-step {
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    color: #666;
    cursor: pointer;
    margin: 0;
    padding: 15px 20px 15px 35px;
    min-width: 200px;
    float: left;
    position: relative;
    background-color: #e5e7eb;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none; 
    transition: all 0.3s ease;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 50px;
}

.arrow-steps .progress-step:after,
.arrow-steps .progress-step:before {
    content: " ";
    position: absolute;
    top: 0;
    right: -15px;
    width: 0;
    height: 0;
    border-top: 25px solid transparent;
    border-bottom: 25px solid transparent;
    border-left: 15px solid #e5e7eb;	
    z-index: 2;
    transition: all 0.3s ease;
}

.arrow-steps .progress-step:before {
    right: auto;
    left: 0;
    border-left: 15px solid #fff;	
    z-index: 0;
}

.arrow-steps .progress-step:first-child:before {
    border: none;
}

.arrow-steps .progress-step:first-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.arrow-steps .progress-step span {
    position: relative;
}

.arrow-steps .progress-step span {
    display: block;
}

.arrow-steps .progress-step .step-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 2px;
}

.arrow-steps .progress-step .step-subtitle {
    font-size: 11px;
    opacity: 0.8;
    font-weight: 400;
}

.arrow-steps .progress-step.active {
    color: #fff;
    background-color: #0891b2;
}

.arrow-steps .progress-step.active:after {
    border-left: 15px solid #0891b2;	
}

.arrow-steps .progress-step.completed {
    color: #fff;
    background-color: #10b981;
}

.arrow-steps .progress-step.completed:after {
    border-left: 15px solid #10b981;	
}

/* Active state takes priority over completed state */
.arrow-steps .progress-step.completed.active {
    color: #fff;
    background-color: #0891b2;
}

.arrow-steps .progress-step.completed.active:after {
    border-left: 15px solid #0891b2;	
}

.arrow-steps .progress-step:last-child:after {
    display: none;
}

.arrow-steps .progress-step:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

/* Handle single step case */
.arrow-steps .progress-step:only-child {
    min-width: 300px;
}

/* Handle two steps case */
.arrow-steps:has(.progress-step:nth-child(2):last-child) .progress-step {
    min-width: 250px;
}

.progress-content {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 2rem;
    margin-top: 4rem;
}

.progress-section {
    display: none;
}

.progress-section.active {
    display: block;
    animation: fadeIn 0.5s ease;
	margin-top: -2rem;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="container">
    <div class="progress-nav">
        <div class="progress-bar-container">
            <div class="arrow-steps clearfix">
                <div class="progress-step active" data-step="1">
                    <span>
                        <div class="step-title">Informed Consent</div>
                        <div class="step-subtitle">Review and sign</div>
                    </span>
                </div>
                @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3')
                <div class="progress-step" data-step="2">
                    <span>
                        <div class="step-title">Inclusion Criteria</div>
                        <div class="step-subtitle">Check eligibility</div>
                    </span>
                </div>
                <div class="progress-step" data-step="3">
                    <span>
                        <div class="step-title">Exclusion Criteria</div>
                        <div class="step-subtitle">Verify disqualifying conditions</div>
                    </span>
                </div>
                @endif
            </div>
        </div>

        <div class="progress-content">
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
            @endif
        </div>
    </div>
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
            // Function to check and mark completed steps
            function checkCompletedSteps() {
                // Check Informed Consent step
                checkStepCompletion(1, 'informed-consent');
                
                // Check Inclusion Criteria step
                checkStepCompletion(2, 'inclusion-criteria');
                
                // Check Exclusion Criteria step
                checkStepCompletion(3, 'exclusion-criteria');
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
                }
                
                // Mark step as completed if it has data and is not currently active
                const stepElement = $(`.progress-step[data-step="${stepNumber}"]`);
                if (hasData && !stepElement.hasClass('active')) {
                    stepElement.addClass('completed');
                } else if (!hasData) {
                    stepElement.removeClass('completed');
                }
            }

            function checkInformedConsentData() {
                // Check if informed consent success message is visible (form already submitted)
                let hasConsent = false;
                
                // Check if the success message is visible (doesn't have 'hidden' class)
                if ($('#consent-message').length && !$('#consent-message').hasClass('hidden')) {
                    hasConsent = true;
                }
                
                return hasConsent;
            }

            function checkInclusionCriteriaData() {
                // Check if inclusion criteria success message is visible (form already submitted)
                let hasData = false;
                
                // Check if the success message is visible (doesn't have 'hidden' class)
                if ($('#inclusion-criteria-message').length && !$('#inclusion-criteria-message').hasClass('hidden')) {
                    hasData = true;
                }
                
                return hasData;
            }

            function checkExclusionCriteriaData() {
                // Check if exclusion criteria success message is visible (form already submitted)
                let hasData = false;
                
                // Check if the success message is visible (doesn't have 'hidden' class)
                if ($('#exclusion-criteria-message').length && !$('#exclusion-criteria-message').hasClass('hidden')) {
                    hasData = true;
                }
                
                return hasData;
            }

            // Check completed steps on page load
            setTimeout(checkCompletedSteps, 1000);
            
            // Also check after a longer delay to catch any async-loaded success messages
            setTimeout(checkCompletedSteps, 2500);
            
            // Monitor for changes in success message visibility
            function observeSuccessMessages() {
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            const target = mutation.target;
                            if (target.id === 'consent-message' || 
                                target.id === 'inclusion-criteria-message' || 
                                target.id === 'exclusion-criteria-message') {
                                setTimeout(checkCompletedSteps, 100);
                            }
                        }
                    });
                });
                
                // Observe all success message elements
                ['#consent-message', '#inclusion-criteria-message', '#exclusion-criteria-message'].forEach(function(selector) {
                    const element = document.querySelector(selector);
                    if (element) {
                        observer.observe(element, { attributes: true, attributeFilter: ['class'] });
                    }
                });
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

            // Progress bar navigation
            $('.progress-step').click(function() {
                const step = $(this).data('step');
                
                // Update progress steps
                $('.progress-step').removeClass('active');
                $(this).addClass('active');
                
                // Show corresponding content
                $('.progress-section').removeClass('active');
                $(`#step-${step}`).addClass('active');
                
                // Check completion status after switching
                setTimeout(checkCompletedSteps, 100);
                
                // Smooth scroll to content
                $('html, body').animate({
                    scrollTop: $('.progress-content').offset().top - 100
                }, 500);
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

