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
                            <th>ID</th>
                            <th>Created At</th>
                            <th>Action</th>
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
    <div class="modal-dialog modal-lg">
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
			                        <th width="60%">Medicine Name</th>
			                        <th width="20%">Quantity</th>
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
			                        <td><input type="number" class="form-control" name="quantity[]" required></td>
			                        <td>
			                            <button type="button" class="btn btn-primary add-row">Add Row</button>
			                            <button type="button" class="btn btn-danger remove-row">Remove</button>
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



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    $(document).ready(function() {
        fetchPrescriptions();
        // Autocomplete functionality for all medicine name fields
        $(document).on('input', 'textarea.medicine-name', function() {
            var medicineInput = $(this);
            var query = medicineInput.val();
            var medicineIdField = medicineInput.closest('tr').find('input[type="hidden"]');

            if (query.length >= 2) { // Start searching after 2 characters
                $.ajax({
                    url: '{{ route('medicines.search') }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        // Create a dropdown for autocomplete
                        var suggestions = data.map(function(medicine) {
                            return '<div class="suggestion" data-id="' + medicine.id + '" data-name="' + medicine.name + '">' + medicine.name + '</div>';
                        }).join('');
                        
                        medicineInput.siblings('.autocomplete-suggestions').remove();
                        medicineInput.after('<div class="autocomplete-suggestions">' + suggestions + '</div>');
                    }
                });
            } else {
                medicineInput.siblings('.autocomplete-suggestions').remove();
            }
        });

        // Select the medicine from autocomplete
        $(document).on('click', '.suggestion', function() {
            var suggestion = $(this);
            var medicineName = suggestion.data('name');
            var medicineId = suggestion.data('id');
            var inputField = suggestion.closest('tr').find('textarea.medicine-name');
            var hiddenField = suggestion.closest('tr').find('input[type="hidden"]');

            inputField.val(medicineName);
            hiddenField.val(medicineId);
            suggestion.closest('.autocomplete-suggestions').remove();
        });

        // Add Row functionality
        $(document).on('click', '.add-row', function() {
            var newRow = $('#medicine-table tbody tr:first').clone();
            var rowCount = $('#medicine-table tbody tr').length + 1;
            newRow.find('textarea.medicine-name').attr('id', 'medicine_name_' + rowCount).val('');
            newRow.find('input[type="hidden"]').attr('id', 'medicine_id_' + rowCount).val('');
            newRow.find('input[type="number"]').val('');
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
                    alert(response.message);
                    form.trigger('reset');
                    $('#medicine-table tbody').html('');
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
                tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${medicine.medicine_name}</td>
                    </tr>
                `;
            });

            $('#medicineModal .modal-body').html(`
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Medicine Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
            `);

            $('#medicineModal').modal('show');
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
                                <a href="/prescriptions/${prescription.id}/print" class="btn btn-secondary btn-sm" target="_blank">Print</a>
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

