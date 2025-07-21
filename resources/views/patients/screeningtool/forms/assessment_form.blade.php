<div class="container-fluid">
    <style>
        .card-body {
            height: auto !important;
            min-height: fit-content;
            overflow: visible;
        }
    </style>
    <div>
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Assessment</h6>
        </div>
        <div class="card card-body">
            <form id="assessmentForm">
                @csrf
                <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient->id }}">
                <div class="mb-3">
                    <label for="ICD_10" class="form-label">ICD-10</label>
                    <input type="text" class="form-control" id="ICD_10" name="ICD_10" required>
                </div>
                <div class="mb-3">
                    <label for="medical_diagnosis" class="form-label">Medical Diagnosis</label>
                    <textarea class="form-control" id="medical_diagnosis" name="medical_diagnosis" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="lifestyle_diagnosis" class="form-label">Lifestyle Diagnosis</label>
                    <textarea class="form-control" id="lifestyle_diagnosis" name="lifestyle_diagnosis" required></textarea>
                </div>
                <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-1 mb-3 cursor-pointer transition-colors duration-300">Save Assessment</button>
            </form>
            <br/>
            <h3 class="m-0 font-weight-bold text-primary">Assessment Lists</h3>
            <table class="table table-bordered" id="assessmentTable">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>ICD-10</th>
                        <th>Medical Diagnosis</th>
                        <th>Lifestyle Diagnosis</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const patientId = $("#patient_id").val(); // Make sure $patient is passed from controller

        $.ajax({
            url: `/assessments/patient/${patientId}`,
            type: 'GET',
            success: function(data) {
                let tbody = $('#assessmentTable tbody');
                tbody.empty();

                if (data.length === 0) {
                    tbody.append('<tr><td colspan="5" class="text-center">No assessments found.</td></tr>');
                    return;
                }

                data.forEach(function(a) {
                    tbody.append(`
                        <tr>
                            <td>${a.patient.first_name}, ${a.patient.last_name}</td>
                            <td>${a.ICD_10}</td>
                            <td>${a.medical_diagnosis}</td>
                            <td>${a.lifestyle_diagnosis}</td>
                            <td>${new Date(a.created_at).toLocaleString()}</td>
                        </tr>
                    `);
                });
            },
            error: function() {
                alert('Unable to load assessments.');
            }
        });
    });
    $('#assessmentForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("assessments.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#assessmentForm')[0].reset();
                let row = `<tr>
                    <td>${data.patient.first_name}, ${data.patient.last_name}</td>
                    <td>${data.ICD_10}</td>
                    <td>${data.medical_diagnosis}</td>
                    <td>${data.lifestyle_diagnosis}</td>
                    <td>${new Date(data.created_at).toLocaleString()}</td>
                </tr>`;
                $('#assessmentTable tbody').prepend(row);
            },
            error: function(xhr) {
                alert('Something went wrong. Please check your input.');
            }
        });
    });

</script>
