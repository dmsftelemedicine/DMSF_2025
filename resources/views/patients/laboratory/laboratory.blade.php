<div class="row">
  	<div class="col-4">
    	<div class="list-group" id="list-tab" role="tablist">
	      	<a class="list-group-item list-group-item-action active" id="list-HbA1C-list" data-bs-toggle="list" href="#list-HbA1C" role="tab" aria-controls="list-HbA1C">HbA1C Results</a>
	      	<a class="list-group-item list-group-item-action" id="list-FBS-list" data-bs-toggle="list" href="#list-FBS" role="tab" aria-controls="list-FBS">FBS Results</a>
	      	<a class="list-group-item list-group-item-action" id="list-otherlabs-list" data-bs-toggle="list" href="#list-otherlabs" role="tab" aria-controls="list-otherlabs">Other Labs</a>
    	</div>
  	</div>
  	<div class="col-8">
    	<div class="tab-content" id="nav-tabContent">
      		<div class="tab-pane fade show active" id="list-HbA1C" role="tabpanel" aria-labelledby="list-HbA1C-list">
      			<div class="card shadow-lg p-4 border-0">
	                <!-- Flex container for heading and button -->
	                <div class="d-flex justify-content-between align-items-center">
	                    <h5>Diabetics Results</h5>
	                    <button type="button" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300" data-bs-toggle="modal" data-bs-target="#bloodSugarModal">
	                        Add Blood Sugar Test
	                    </button>
	                </div>
	                @if($patient->bloodSugarTests()->exists())
	                <table class="table table-striped mt-3">
	                    <thead>
	                        <tr>
	                            <th>Date</th>
	                            <th>mg/dL</th>
	                            <th>mmol/L</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($patient->bloodSugarTests as $test)
	                        <tr>
	                            <td>{{ \Carbon\Carbon::parse($test->test_date)->format('M d, Y') }}</td>
	                            <td>{{ $test->blood_sugar_mgdl }}</td>
	                            <td>{{ $test->blood_sugar_mmol }}</td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	            @else
	                <p class="text-muted text-center mt-3">No test results available.</p>
	            @endif
	            </div>
      		</div>
      		<div class="tab-pane fade" id="list-FBS" role="tabpanel" aria-labelledby="list-FBS-list">
      			<div class="mt-6 p-4 bg-white shadow-md rounded-lg">
				    <div class="flex justify-between items-center mb-4">
				        <h2 class="text-xl font-bold">HbA1c Results</h2>
				        <button class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300" data-bs-toggle="modal" data-bs-target="#addHbA1cModal">
				            + Add HbA1c Result
				        </button>
				    </div>

				    <table id="hba1cTable" class="w-full border-collapse border border-gray-300">
				        <thead>
				            <tr class="bg-gray-100">
				                <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
				                <th class="border border-gray-300 px-4 py-2 text-left">HbA1c Level (%)</th>
				                <th class="border border-gray-300 px-4 py-2 text-left">Avg Blood Sugar (mg/dL)</th>
				                <th class="border border-gray-300 px-4 py-2 text-left">Remarks</th>
				            </tr>
				        </thead>
				        <tbody>
				            @foreach($patient->laboratoryResults->where('test_type', 'HbA1c')->sortByDesc('date') as $result)
				                <tr>
				                    <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($result->date)->format('M d, Y') }}</td>
				                    <td class="border border-gray-300 px-4 py-2">{{ $result->result }}%</td>
				                    <td class="border border-gray-300 px-4 py-2">{{ round((28.7 * $result->result) - 46.7, 0) }} mg/dL</td>
				                    <td class="border border-gray-300 px-4 py-2">
				                        @if($result->result < 5.7)
				                            <span class="text-green-600 font-bold">Normal</span>
				                        @elseif($result->result < 6.5)
				                            <span class="text-yellow-600 font-bold">Prediabetes</span>
				                        @else
				                            <span class="text-red-600 font-bold">High</span>
				                        @endif
				                    </td>
				                </tr>
				            @endforeach
				        </tbody>
				    </table>
				</div>
      		</div>
      		<div class="tab-pane fade" id="list-otherlabs" role="tabpanel" aria-labelledby="list-otherlabs-list">
      			<button class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300" data-bs-toggle="modal" data-bs-target="#uploadLabModal">
    				Upload Lab Result
				</button>
				<div class="mt-6">
				    <h3 class="text-lg font-bold text-white">Uploaded Laboratory Results</h3>
				    <table class="table-auto w-full border mt-2">
				        <thead>
				            <tr class="bg-gray-200">
				                <th class="border px-4 py-2">Test Type</th>
				                <th class="border px-4 py-2">Test Date</th>
				                <th class="border px-4 py-2">Image</th>
				            </tr>
				        </thead>
				        <tbody id="uploadedResults">
				            @foreach ($patient->laboratoryResults->whereNotNull('image_path') as $result)

				                <tr>
				                    <td class="border px-4 py-2">{{ $result->test_type }}</td>
				                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($result->date)->format('M d, Y') }}</td>
				                    <td class="border px-4 py-2">
				                        <img src="{{ asset('storage/' . $result->image_path) }}" class="w-32 h-32 rounded shadow">
				                        <a href="{{ asset('storage/' . $result->image_path) }}" download class="block mt-2 text-blue-500 underline">Download</a>
				                    </td>
				                </tr>
				            @endforeach
				        </tbody>
				    </table>
				</div>

      		</div>
    	</div>
 	</div>
</div>
<!-- Blood Sugar Modal -->
    <div class="modal fade" id="bloodSugarModalLB" tabindex="-1" aria-labelledby="bloodSugarModalLBLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloodSugarModalLBLabel">Add Blood Sugar Test</h5>
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
	<div class="modal fade" id="addHbA1cModalLB" tabindex="-1" aria-labelledby="addHbA1cModalLBLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Add HbA1c Result</h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
	            </div>
	            <div class="modal-body">
	                <form id="hba1cFormLB">
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
		    $('#hba1cFormLB').submit(function(event) {
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
		                    $('#hba1cFormLB')[0].reset();
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

