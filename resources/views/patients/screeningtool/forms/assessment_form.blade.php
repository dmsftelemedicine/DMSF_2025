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
                <!-- Medical Diagnosis Section -->
                <div class="mb-4" id="medicalSection">
                    <div class="mb-3">
                        <label for="medical_diagnosis" class="form-label">MEDICAL DIAGNOSIS</label>
                        <textarea class="form-control" id="medical_diagnosis" name="medical_diagnosis[]" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="medical_other_diagnosis_info" class="form-label">Other Diagnosis Info</label>
                        <textarea class="form-control" id="medical_other_diagnosis_info" name="medical_other_diagnosis_info[]"></textarea>
                    </div>
                    <div id="additionalMedicalDiagnoses"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="addMedicalDiagnosis">Add Diagnosis</button>
                </div>

                <!-- Lifestyle Section -->
                <div class="mb-4" id="lifestyleSection">
                    <div class="mb-3">
                        <label for="lifestyle_diagnosis" class="form-label">LIFESTYLE DIAGNOSIS</label>
                        <textarea class="form-control" id="lifestyle_diagnosis" name="lifestyle_diagnosis[]" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lifestyle_other_diagnosis_info" class="form-label">Other Diagnosis Info</label>
                        <textarea class="form-control" id="lifestyle_other_diagnosis_info" name="lifestyle_other_diagnosis_info[]"></textarea>
                    </div>
                    <div id="additionalLifestyleDiagnoses"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="addLifestyleDiagnosis">Add Diagnosis</button>
                </div>

                <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-1 mb-3 cursor-pointer transition-colors duration-300">Save Assessment</button>
            </form>
            <br/>
            <h3 class="m-0 font-weight-bold text-primary">Assessment Lists</h3>
            <table class="table table-bordered" id="assessmentTable">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Medical Diagnosis</th>
                        <th>Medical Other Info</th>
                        <th>Lifestyle Diagnosis</th>
                        <th>Lifestyle Other Info</th>
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
        let medicalDiagnosisCount = 1;
        let lifestyleDiagnosisCount = 1;

        // Add Medical Diagnosis functionality
        $('#addMedicalDiagnosis').on('click', function() {
            medicalDiagnosisCount++;
            const additionalFields = `
                <div class="diagnosis-group mb-3" data-type="medical" data-index="${medicalDiagnosisCount}">
                    <div class="mb-2">
                        <label class="form-label">Medical Diagnosis ${medicalDiagnosisCount}</label>
                        <textarea class="form-control" name="medical_diagnosis[]" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Other Diagnosis Info</label>
                        <textarea class="form-control" name="medical_other_diagnosis_info[]"></textarea>
                    </div>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-diagnosis">Remove</button>
                    <hr>
                </div>
            `;
            $('#additionalMedicalDiagnoses').append(additionalFields);
        });

        // Add Lifestyle Diagnosis functionality
        $('#addLifestyleDiagnosis').on('click', function() {
            lifestyleDiagnosisCount++;
            const additionalFields = `
                <div class="diagnosis-group mb-3" data-type="lifestyle" data-index="${lifestyleDiagnosisCount}">
                    <div class="mb-2">
                        <label class="form-label">Lifestyle Diagnosis ${lifestyleDiagnosisCount}</label>
                        <textarea class="form-control" name="lifestyle_diagnosis[]" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Other Diagnosis Info</label>
                        <textarea class="form-control" name="lifestyle_other_diagnosis_info[]"></textarea>
                    </div>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-diagnosis">Remove</button>
                    <hr>
                </div>
            `;
            $('#additionalLifestyleDiagnoses').append(additionalFields);
        });

        // Remove diagnosis functionality
        $(document).on('click', '.remove-diagnosis', function() {
            const diagnosisGroup = $(this).closest('.diagnosis-group');
            const type = diagnosisGroup.data('type');
            diagnosisGroup.remove();
            
            // Renumber remaining diagnoses
            if (type === 'medical') {
                renumberDiagnoses('#additionalMedicalDiagnoses', 'Medical', medicalDiagnosisCount);
            } else if (type === 'lifestyle') {
                renumberDiagnoses('#additionalLifestyleDiagnoses', 'Lifestyle', lifestyleDiagnosisCount);
            }
        });

        // Function to renumber diagnoses after removal
        function renumberDiagnoses(containerSelector, diagnosisType, currentCount) {
            const container = $(containerSelector);
            const diagnosisGroups = container.find('.diagnosis-group');
            
            diagnosisGroups.each(function(index) {
                const newNumber = index + 2; // +2 because we start from 2 (first one is not in additional container)
                $(this).attr('data-index', newNumber);
                $(this).find('label:first').text(`${diagnosisType} Diagnosis ${newNumber}`);
            });
            
            // Update the counter
            if (diagnosisType === 'Medical') {
                medicalDiagnosisCount = diagnosisGroups.length + 1;
            } else {
                lifestyleDiagnosisCount = diagnosisGroups.length + 1;
            }
        }

        $.ajax({
            url: `/assessments/patient/${patientId}`,
            type: 'GET',
            success: function(data) {
                let tbody = $('#assessmentTable tbody');
                tbody.empty();

                if (data.length === 0) {
                    tbody.append('<tr><td colspan="6" class="text-center">No assessments found.</td></tr>');
                    return;
                }

                data.forEach(function(a) {
                    // Extract diagnoses
                    let medicalDiagnoses = [];
                    let medicalOtherInfos = [];
                    let lifestyleDiagnoses = [];
                    let lifestyleOtherInfos = [];
                    
                    if (a.diagnoses) {
                        a.diagnoses.forEach(function(d) {
                            if (d.type === 'medical') {
                                medicalDiagnoses.push(d.diagnosis_text);
                                medicalOtherInfos.push(d.other_info || '');
                            } else if (d.type === 'lifestyle') {
                                lifestyleDiagnoses.push(d.diagnosis_text);
                                lifestyleOtherInfos.push(d.other_info || '');
                            }
                        });
                    }
                    
                    // Format diagnoses elegantly
                    let formattedMedicalDiagnoses = medicalDiagnoses.map((diagnosis, index) => 
                        `Diagnosis ${index + 1}: <strong>${diagnosis}</strong>`
                    ).join('<br>');
                    
                    let formattedMedicalOtherInfos = medicalOtherInfos
                        .map((info, index) => info ? `Info ${index + 1}: <strong>${info}</strong>` : '')
                        .filter(info => info)
                        .join('<br>');
                    
                    let formattedLifestyleDiagnoses = lifestyleDiagnoses.map((diagnosis, index) => 
                        `Diagnosis ${index + 1}: <strong>${diagnosis}</strong>`
                    ).join('<br>');
                    
                    let formattedLifestyleOtherInfos = lifestyleOtherInfos
                        .map((info, index) => info ? `Info ${index + 1}: <strong>${info}</strong>` : '')
                        .filter(info => info)
                        .join('<br>');
                    
                    tbody.append(`
                        <tr>
                            <td>${a.patient.first_name}, ${a.patient.last_name}</td>
                            <td>${formattedMedicalDiagnoses}</td>
                            <td>${formattedMedicalOtherInfos}</td>
                            <td>${formattedLifestyleDiagnoses}</td>
                            <td>${formattedLifestyleOtherInfos}</td>
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

        // Collect all diagnosis data
        const formData = new FormData(this);
        
        $.ajax({
            url: '{{ route("assessments.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#assessmentForm')[0].reset();
                
                // Reset dynamic fields
                $('#additionalMedicalDiagnoses').empty();
                $('#additionalLifestyleDiagnoses').empty();
                medicalDiagnosisCount = 1;
                lifestyleDiagnosisCount = 1;
                
                // Extract all diagnoses for display
                let medicalDiagnoses = [];
                let medicalOtherInfos = [];
                let lifestyleDiagnoses = [];
                let lifestyleOtherInfos = [];
                
                if (data.diagnoses) {
                    data.diagnoses.forEach(function(d) {
                        if (d.type === 'medical') {
                            medicalDiagnoses.push(d.diagnosis_text);
                            medicalOtherInfos.push(d.other_info || '');
                        } else if (d.type === 'lifestyle') {
                            lifestyleDiagnoses.push(d.diagnosis_text);
                            lifestyleOtherInfos.push(d.other_info || '');
                        }
                    });
                }
                
                // Format diagnoses elegantly
                let formattedMedicalDiagnoses = medicalDiagnoses.map((diagnosis, index) => 
                    `Diagnosis ${index + 1}: <strong>${diagnosis}</strong>`
                ).join('<br>');
                
                let formattedMedicalOtherInfos = medicalOtherInfos
                    .map((info, index) => info ? `Info ${index + 1}: <strong>${info}</strong>` : '')
                    .filter(info => info)
                    .join('<br>');
                
                let formattedLifestyleDiagnoses = lifestyleDiagnoses.map((diagnosis, index) => 
                    `Diagnosis ${index + 1}: <strong>${diagnosis}</strong>`
                ).join('<br>');
                
                let formattedLifestyleOtherInfos = lifestyleOtherInfos
                    .map((info, index) => info ? `Info ${index + 1}: <strong>${info}</strong>` : '')
                    .filter(info => info)
                    .join('<br>');
                
                let row = `<tr>
                    <td>${data.patient.first_name}, ${data.patient.last_name}</td>
                    <td>${formattedMedicalDiagnoses}</td>
                    <td>${formattedMedicalOtherInfos}</td>
                    <td>${formattedLifestyleDiagnoses}</td>
                    <td>${formattedLifestyleOtherInfos}</td>
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
