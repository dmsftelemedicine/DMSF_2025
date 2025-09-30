<style>
.progress-nav {
    margin: 1rem 2rem;
    padding: 0 1rem;
    max-width: 1200px;
}

.progress-bar-container {
    display: flex;
    justify-content: space-between;
    position: relative;
    margin: 2rem 0;
    max-width: 100%;
	margin-top: 0;
}

.progress-bar-container::before {
    content: "";
    background-color: #e0e0e0;
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    height: 4px;
    width: 100%;
    z-index: 1;
}

.progress-step {
    background-color: #ffffff;
    border: 3px solid #e0e0e0;
    border-radius: 50%;
    height: 2.5rem;
    width: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.progress-step.active {
    background-color: #4CAF50;
    border-color: #4CAF50;
    color: white;
}

.progress-step.completed {
    background-color: #4CAF50;
    border-color: #4CAF50;
    color: white;
}

.progress-step-label {
    position: absolute;
    top: 3rem;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    font-size: 0.9rem;
    font-weight: 500;
    color: #666;
}

.progress-step.active .progress-step-label {
    color: #4CAF50;
    font-weight: 600;
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
            <div class="progress-step active" data-step="1">
                <span>1</span>
                <div class="progress-step-label">Inform Consent</div>
            </div>
            @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3')
            <div class="progress-step" data-step="2">
                <span>2</span>
                <div class="progress-step-label">Inclusion Criteria</div>
            </div>
            <div class="progress-step" data-step="3">
                <span>3</span>
                <div class="progress-step-label">Exclusion Criteria</div>
            </div>
            @endif
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

	<script>
	    $(document).ready(function() {
            // Progress bar navigation
            $('.progress-step').click(function() {
                const step = $(this).data('step');
                
                // Update progress steps
                $('.progress-step').removeClass('active');
                $(this).addClass('active');
                $('.progress-step').each(function() {
                    if (parseInt($(this).data('step')) < step) {
                        $(this).addClass('completed');
                    } else {
                        $(this).removeClass('completed');
                    }
                });
                
                // Show corresponding content
                $('.progress-section').removeClass('active');
                $(`#step-${step}`).addClass('active');
                
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

