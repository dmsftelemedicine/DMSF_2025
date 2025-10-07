<style type="text/css">
    
    img.img-fluid {
        max-width: 100px;
        height: auto;
    }
    /* Ensure the modal image is responsive and centered */
    #imageModal .modal-body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #modalImage {
        max-width: 300%; /* Limit the image size to 90% of the modal width */
        max-height: 70vh; /* Limit the height to 70% of the viewport height */
        object-fit: contain; /* Maintain aspect ratio while filling the space */
    }
</style>

<div class="row justify-content-md-center">
	<div class="col-10">
		<div class="card shadow-lg p-4 border-0">
			<!-- Flex container for heading and button -->
            <div class="d-flex justify-content-between align-items-center">
                <h5>Prescription Lists</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddPrescriptionModal">
                    Create Prescription
                </button>
            </div>
            <br/>
            <div class="table-responsive">
                <table class="table table-striped" id="prescriptions-table">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="70%">Created At</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="prescriptions-table-tbody">
                        
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>

<div class="modal fade" id="AddPrescriptionModal" tabindex="-1" aria-labelledby="PrescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PrescriptionModalLabel">Create Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="PrescriptionFrom" method="POST">
			        @csrf
                    <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
			        <div class="table-responsive">
			            <table class="table table-bordered" id="medicine-table">
			                <thead>
			                    <tr>
			                        <th width="30%">Medicine Name</th>
                                    <th width="50%">Rx English Instructions</th>
			                        <th width="20%">Action</th>
			                    </tr>
			                </thead>
			               <tbody>
			                    <tr>
			                        <td>
			                            <!-- Change input to textarea -->
			                            <textarea class="form-control medicine-name" name="medicine_name[]" id="medicine_name_1" autocomplete="off" required></textarea>
			                            <input type="hidden" name="medicine_id[]" id="medicine_id_1">
			                        </td>
                                    <td>
                                        <textarea class="form-control english-instructions"  id="english_instruction_1" autocomplete="off"></textarea>
                                    </td>
			                        <td>
			                            <button type="button" class="btn btn-primary add-row"><i class="fa-solid fa-plus"></i></button>
			                            <button type="button" class="btn btn-danger remove-row"><i class="fa-solid fa-trash"></i></button>
			                        </td>
			                    </tr>
			                </tbody>
			            </table>
			        </div>
			        <button type="submit" class="btn btn-success">Submit Prescription</button>
			    </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for displaying medicines -->
<div class="modal fade" id="medicineModal" tabindex="-1" aria-labelledby="medicineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicineModalLabel">Prescription Medicines</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Medicines table will be dynamically populated here -->

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal to display the image -->
<div class="modal" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Medicine Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Image will be injected here -->
        <img id="modalImage" src="" alt="Medicine Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>


<!-- Edit Prescription Modal -->
<div class="modal fade" id="EditmedicineModal" tabindex="-1" aria-labelledby="EditmedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditmedicineModalLabel">Edit Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Medicines Table will be populated dynamically -->
            </div>
        </div>
    </div>
</div>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    $(document).ready(function() {
        fetchPrescriptions();
        // Autocomplete functionality for all medicine name fields
        $(document).on('input', 'textarea.medicine-name', function() {
                var medicineInput = $(this);
                var query = medicineInput.val();
                var currentRow = medicineInput.closest('tr');
                var medicineIdField = currentRow.find('input[type="hidden"]');

                if (query.length >= 2) {
                    $.ajax({
                        url: '{{ route('medicines.search') }}',
                        method: 'GET',
                        data: { query: query },
                        success: function(data) {
                            var suggestions = data.map(function(medicine, index) {
                                return `
                                    <div class="suggestion"
                                        data-id="${medicine.id}"
                                        data-name="${medicine.name}"
                                        data-instructions="${medicine.rx_english_instructions || ''}">
                                        <strong>${medicine.name}</strong><br>
                                        <small>${medicine.rx_english_instructions || 'No instructions'}</small>
                                    </div>
                                    <hr class="suggestion-divider">`;
                            }).join('');


                            medicineInput.siblings('.autocomplete-suggestions').remove();
                            medicineInput.after('<div class="autocomplete-suggestions">' + suggestions + '</div>');
                        }
                    });
                } else {
                    medicineInput.siblings('.autocomplete-suggestions').remove();
                }
            });

        // When a suggestion is clicked
        $(document).on('click', '.suggestion', function() {
            var suggestion = $(this);
            var medicineName = suggestion.data('name');
            var medicineId = suggestion.data('id');
            var instructions = suggestion.data('instructions');

            var currentRow = suggestion.closest('tr');
            var inputField = currentRow.find('textarea.medicine-name');
            var hiddenField = currentRow.find('input[type="hidden"]');
            var instructionsField = currentRow.find('textarea.english-instructions');

            inputField.val(medicineName);
            hiddenField.val(medicineId);
            instructionsField.val(instructions);

            suggestion.closest('.autocomplete-suggestions').remove();
        });

        // Add Row functionality
        $(document).on('click', '.add-row', function() {
            var newRow = $('#medicine-table tbody tr:first').clone();
            var rowCount = $('#medicine-table tbody tr').length + 1;
            newRow.find('textarea.medicine-name').attr('id', 'medicine_name_' + rowCount).val('');
            newRow.find('input[type="hidden"]').attr('id', 'medicine_id_' + rowCount).val('');
            newRow.find('input[type="number"]').val('');
            newRow.find('textarea.english-instructions').attr('id', 'english_instruction_' + rowCount).val('');
            $('#medicine-table tbody').append(newRow);
        });

        // Remove Row functionality
        $(document).on('click', '.remove-row', function() {
            if ($('#medicine-table tbody tr').length > 1) {
                $(this).closest('tr').remove();
            }
        });

        $('#PrescriptionFrom').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serializeArray();
            // Append prescription_id manually if not in the form
            formData.push({ name: 'prescription_id', value: 1 }); // Replace 1 with dynamic value as needed
            $.ajax({
                url: "{{ route('prescription.store') }}",
                method: "POST",
                data: formData,
                success: function (response) {
                    // Close the modal on successful submission
                    $('#AddPrescriptionModal').modal('hide');

                    // Reset the form
                    form.trigger('reset');

                    // Clear the medicine table
                    $('#medicine-table tbody').html('');

                    // Repopulate the prescriptions table
                    fetchPrescriptions();
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Error occurred while submitting.');
                }
            });
        });

        $(document).on('click', '.view-btn', function() {
            const medicines = JSON.parse($(this).attr('data-medicines'));
            let tableRows = '';

            medicines.forEach((medicine, index) => {
                let medicineName = medicine.medicine_name;
                let englishInstructions = medicine.rx_english_instructions || '—';
                let imagePath = medicine.image_url ? `/storage/${medicine.image_url}` : '/images/sample1.jpeg';

                tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${medicineName}</td>
                        <td>${englishInstructions}</td>
                        <td>
                            <button type="button" class="btn btn-primary view-image-btn" data-image="${imagePath}">
                                <i class="fa-solid fa-eye"></i> View
                            </button>
                        </td>
                    </tr>
                `;
            });

            $('#medicineModal .modal-body').html(`
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width='10%'>#</th>
                            <th width="20%">Medicine Name</th>
                            <th width="50%">English Instructions</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
            `);

            $('#medicineModal').modal('show');
        });

        // Event listener for the eye button to show the image in the modal
        $(document).on('click', '.view-image-btn', function() {
            const imageUrl = $(this).attr('data-image'); // Get the image URL from the button data attribute
            $('#modalImage').attr('src', imageUrl); // Set the modal image to the clicked medicine's image
            $('#imageModal').modal('show'); // Show the image modal
        });

// Event listener for the eye button to show the image in the modal
$(document).on('click', '.view-image-btn', function() {
    const imageUrl = $(this).attr('data-image'); // Get the image URL from the button data attribute
    $('#modalImage').attr('src', imageUrl); // Set the modal image to the clicked medicine's image
    $('#imageModal').modal('show'); // Show the image modal
});


        $(document).on('click', '.edit-btn', function() {
            const prescriptionId = $(this).attr('data-id');
            const medicines = JSON.parse($(this).attr('data-medicines'));
            
            // Store the original medicines data to compare with the updated data later
            originalMedicines = medicines;  // Store this data globally or pass it in a closure

            // Populate the modal with the current medicines
            let tableRows = '';
            medicines.forEach((medicine) => {
                let medicineName = medicine.medicine_name; // Get medicine name
                const uniqueInputId = `edit_medicine_${medicine.medicine_id}`; // Unique id based on medicine id
                const uniquehiddenId = `edit_medicine_id_${medicine.medicine_id}_${medicine.medicine_details_id}`; // Unique id based on medicine id and details id
                
                tableRows += `
                    <tr>
                        <td>${medicine.medicine_id}</td>
                        <td>
                            <textarea class="form-control" data-details="${medicine.medicine_details_id}" id="${uniqueInputId}" data-id="${medicine.medicine_id}">${medicineName}</textarea>
                            <input type='hidden' id="${uniquehiddenId}" value="${medicine.medicine_id}">
                            <div class="autocomplete-suggestions" id="autocomplete-suggestions-${medicine.medicine_id}"></div> <!-- Autocomplete dropdown -->
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-medicine-btn" data-id="${medicine.medicine_id}" data-medicine='${JSON.stringify(medicine).replace(/'/g, "&apos;")}'>Edit</button>
                        </td>
                    </tr>
                `;
            });

            // Insert the table rows dynamically into the modal
            $('#EditmedicineModal .modal-body').html(`
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Medicine Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
                <button id="save-medicines" class="btn btn-primary">Save Changes</button>
            `);

            // Show the modal
            $('#EditmedicineModal').modal('show');
            
            // Store prescription ID to be used later in the save request
            $('#EditmedicineModal').data('prescription-id', prescriptionId);

            // Autocomplete logic for each medicine textarea
            $(document).on('input', 'textarea[id^="edit_medicine_"]', function() {
                var medicineInput = $(this);
                var query = medicineInput.val();
                const medicineId = medicineInput.data('id'); // Get the unique id of the medicine

                if (query.length >= 2) { // Start searching after 2 characters
                    $.ajax({
                        url: '{{ route('medicines.search') }}',
                        method: 'GET',
                        data: { query: query },
                        success: function(data) {
                            // Create a dropdown for autocomplete suggestions
                            var suggestions = data.map(function(medicine) {
                                return '<div class="suggestion" textarea-id="' + medicineId + '" data-id="'+medicine.id+'" data-name="' + medicine.name + '">' + medicine.name + '</div>';
                            }).join('');
                            
                            // Remove any existing suggestions and display the new ones
                            $('#autocomplete-suggestions-' + medicineId).remove(); // Remove old suggestions
                            medicineInput.after('<div class="autocomplete-suggestions" medicine-textarea-id='+medicineId+' id="autocomplete-suggestions-' + medicineId + '">' + suggestions + '</div>');
                        }
                    });
                } else {
                    $('#autocomplete-suggestions-' + medicineId).remove(); // Remove suggestions if query is too short
                }
            });

            // Select a suggestion when clicked
            $(document).on('click', '.autocomplete-suggestions .suggestion', function() {
                var suggestion = $(this);
                const medicineId = $(this).attr("textarea-id"); // Get the medicine ID
                const newmedicineId = $(this).attr("data-id");
                var medicineInput = $('#edit_medicine_' + medicineId); // Get the specific textarea based on the medicine ID
                var medicineDetailsid = $('#edit_medicine_' + medicineId).attr("data-details");
                var medicineHidden = $('#edit_medicine_id_' + medicineId+"_"+medicineDetailsid);
                var medicineName = suggestion.data('name');
                
                // Update the textarea with the selected medicine name
                medicineInput.val(medicineName);
                medicineHidden.val(newmedicineId);
                
                // Remove the suggestions after selection
                $('#autocomplete-suggestions-' + medicineId).remove(); // Remove the suggestion list
            });

            // Save the updated medicines data
            $(document).on('click', '#save-medicines', function() {
                // Prepare the data to send
                var updatedMedicines = [];
                
                // Iterate through each textarea and collect the updated data
                $('textarea[id^="edit_medicine_"]').each(function() {
                    var medicineInput = $(this);
                    var medicineId = medicineInput.data('id');
                    var medicineName = medicineInput.val();
                    var medicineDetailsId = medicineInput.data('details');
                    var hiddenInput = $('#edit_medicine_id_' + medicineId + "_" + medicineDetailsId);
                    var updatedMedicineId = hiddenInput.val(); // Get the updated medicine ID if it was changed
                    
                    updatedMedicines.push({
                        medicine_id: updatedMedicineId,
                        medicine_name: medicineName,
                        medicine_details_id: medicineDetailsId
                    });
                });

                // Send the updated medicines data to the server using AJAX
                $.ajax({
                    url: `/prescriptions/${prescriptionId}/update`,
                    method: 'PUT',
                    data: {
                        medicines: updatedMedicines,  // The updated medicines data
                        _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Prescription updated successfully');
                            $('#EditmedicineModal').modal('hide');
                            fetchPrescriptions();  // Refresh the prescriptions list
                        } else {
                            alert('Failed to update prescription');
                        }
                    },
                    error: function() {
                        alert("Error updating prescription.");
                    }
                });
            });
        });

        function fetchPrescriptions() {
            const patientId = $('#patient_id').val();  // Ensure you're getting the patient_id correctly

            $.ajax({
                url: `/patients/${patientId}/prescriptions`,
                method: 'GET',
                success: function (data) {
                let tbody = $('#prescriptions-table tbody');
                tbody.empty();

                if (data.prescriptions.length === 0) {
                    tbody.append('<tr><td colspan="3" class="text-center">No prescriptions found.</td></tr>');
                    return;
                }

                data.prescriptions.forEach(function (prescription) {
                    const medicinesJson = JSON.stringify(prescription.medicines);
                    
                    tbody.append(`
                        <tr>
                            <td>${prescription.id}</td>
                            <td>${prescription.created_at}</td>
                            <td>
                                <button class="btn btn-info btn-sm view-btn"
                                        data-id="${prescription.id}"
                                        data-medicines='${medicinesJson.replace(/'/g, "&apos;")}'>
                                    View
                                </button>
                                <button class="btn btn-warning btn-sm edit-btn"
                                        data-id="${prescription.id}"
                                        data-medicines='${medicinesJson.replace(/'/g, "&apos;")}'>
                                    Edit
                                </button>
                                <a href="/prescription/${prescription.id}/print" class="btn btn-secondary btn-sm" target="_blank">Print</a>
                            </td>
                        </tr>
                    `);
                });
            },
                error: function () {
                    alert("Failed to load prescriptions.");
                }
            });
        }


    });
</script> 