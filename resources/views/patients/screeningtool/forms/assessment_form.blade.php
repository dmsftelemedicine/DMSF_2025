<div class="container-fluid">
    <style>
        .card-body {
            height: auto !important;
            min-height: fit-content;
            overflow: visible;
        }

        .autocomplete-suggestions {
            border: 1px solid #ccc;
            border-top: none;
            max-height: 200px;
            overflow-y: auto;
            background: white;
            position: absolute;
            z-index: 1000;
            width: 100%;
        }

        .autocomplete-suggestion {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            line-height: 1.4;
        }

        .autocomplete-suggestion:last-child {
            border-bottom: none;
        }

        .autocomplete-suggestion:hover {
            background-color: #f5f5f5;
        }

        .autocomplete-suggestion.selected {
            background-color: #007bff;
            color: white;
        }
        .autocomplete-suggestion strong {
            font-weight: 600;
        }

        .diagnosis-input-container {
            position: relative;
        }

        .equal-height-input {
            height: 45px;
            /* Standard input height to match */
        }
        mark {
            background-color: #fff3cd;
            color: #856404;
            padding: 0;
        }

        .autocomplete-suggestion.selected mark {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .loading-indicator {
            padding: 10px;
            text-align: center;
            color: #6c757d;
            font-style: italic;
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

                <div class="row">
                    <!-- Medical Diagnosis Column -->
                    <div class="col-md-6">
                        <div class="mb-4" id="medicalSection">
                            <h5 class="text-primary mb-3">MEDICAL DIAGNOSIS</h5>
                            <div class="mb-3">
                                <label for="medical_diagnosis" class="form-label">ICD-10 Diagnosis Code</label>
                                <div class="diagnosis-input-container">
                                    <input type="text" class="form-control icd10-search equal-height-input" id="medical_diagnosis" name="medical_diagnosis[]" required placeholder="Search ICD-10 codes...">
                                    <div class="autocomplete-suggestions" id="medical_suggestions_0" style="display: none;"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="medical_other_diagnosis_info" class="form-label">Other Diagnosis Info</label>
                                <textarea class="form-control" id="medical_other_diagnosis_info" name="medical_other_diagnosis_info[]" rows="3"></textarea>
                            </div>
                            <div id="additionalMedicalDiagnoses"></div>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="addMedicalDiagnosis">Add Diagnosis</button>
                        </div>
                    </div>

                    <!-- Lifestyle Diagnosis Column -->
                    <div class="col-md-6">
                        <div class="mb-4" id="lifestyleSection">
                            <h5 class="text-primary mb-3">LIFESTYLE DIAGNOSIS</h5>
                            <div class="mb-3">
                                <label for="lifestyle_diagnosis" class="form-label">Lifestyle Diagnosis</label>
                                <input type="text" class="form-control equal-height-input" id="lifestyle_diagnosis" name="lifestyle_diagnosis[]" required>
                            </div>
                            <div class="mb-3">
                                <label for="lifestyle_other_diagnosis_info" class="form-label">Other Diagnosis Info</label>
                                <textarea class="form-control" id="lifestyle_other_diagnosis_info" name="lifestyle_other_diagnosis_info[]" rows="3"></textarea>
                            </div>
                            <div id="additionalLifestyleDiagnoses"></div>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="addLifestyleDiagnosis">Add Diagnosis</button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-1 mb-3 cursor-pointer transition-colors duration-300">Save Assessment</button>
            </form>
            <br />
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
    $(document).ready(function() {
        const patientId = $("#patient_id").val(); // Make sure $patient is passed from controller
        let medicalDiagnosisCount = 1;
        let lifestyleDiagnosisCount = 1;

        // Add Medical Diagnosis functionality
        $('#addMedicalDiagnosis').on('click', function() {
            medicalDiagnosisCount++;
            const additionalFields = `
                <div class="diagnosis-group mb-3" data-type="medical" data-index="${medicalDiagnosisCount}">
                    <div class="mb-2">
                        <label class="form-label">ICD-10 Diagnosis Code ${medicalDiagnosisCount}</label>
                        <div class="diagnosis-input-container">
                            <input type="text" class="form-control icd10-search equal-height-input" name="medical_diagnosis[]" required placeholder="Search ICD-10 codes...">
                            <div class="autocomplete-suggestions" id="medical_suggestions_${medicalDiagnosisCount}" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Other Diagnosis Info</label>
                        <textarea class="form-control" name="medical_other_diagnosis_info[]" rows="3"></textarea>
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
                        <input type="text" class="form-control equal-height-input" name="lifestyle_diagnosis[]" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Other Diagnosis Info</label>
                        <textarea class="form-control" name="lifestyle_other_diagnosis_info[]" rows="3"></textarea>
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
                if (diagnosisType === 'Medical') {
                    $(this).find('label:first').text(`ICD-10 Diagnosis Code ${newNumber}`);
                } else {
                    $(this).find('label:first').text(`${diagnosisType} Diagnosis ${newNumber}`);
                }
            });

            // Update the counter
            if (diagnosisType === 'Medical') {
                medicalDiagnosisCount = diagnosisGroups.length + 1;
            } else {
                lifestyleDiagnosisCount = diagnosisGroups.length + 1;
            }
        }

        // ICD-10 autocomplete functionality
        let searchTimeout;
        let currentSelectedIndex = -1;
        let currentSuggestions = [];

        $(document).on('input', '.icd10-search', function() {
            const input = $(this);
            const query = input.val();
            const suggestionsContainer = input.siblings('.autocomplete-suggestions');

            // Store the active input
            activeInput = input;

            // Clear previous timeout
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            // Hide suggestions if query is too short
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }
            if (query.length < 2) {
                suggestionsContainer.hide();
                return;
            }
            
            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: '{{ route("assessments.icd10.search") }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        currentSuggestions = data;
                        currentSelectedIndex = -1;

                        if (data.length > 0) {
                            let suggestionsHtml = '';
                            data.forEach(function(item, index) {
                                suggestionsHtml += `<div class="autocomplete-suggestion" data-index="${index}" data-code="${item.code}" data-description="${item.description}">${item.code} - ${item.description}</div>`;
                            });
                            suggestionsContainer.html(suggestionsHtml).show();
                        } else {
                            suggestionsContainer.hide();
                        }
                    }
                });
            }, 300);
        });

        // Handle suggestion selection
        $(document).on('click', '.autocomplete-suggestion', function() {
            const suggestion = $(this);
            // Skip if this is a loading or error message
            if (suggestion.hasClass('loading-indicator') || suggestion.hasClass('text-danger') || suggestion.hasClass('text-muted')) {
                return;
            }

            const input = suggestion.closest('.diagnosis-input-container').find('.icd10-search');
            const code = suggestion.data('code');
            const description = suggestion.data('description');

            // Only select if it has valid data
            if (code && description) {
                input.val(code + ' - ' + description);
                input.trigger('change'); // Trigger change event for any listeners
            }
            suggestion.parent().hide();
        });

        // Handle keyboard navigation
        $(document).on('keydown', '.icd10-search', function(e) {
            const input = $(this);
            const suggestionsContainer = input.siblings('.autocomplete-suggestions');
            const suggestions = suggestionsContainer.find('.autocomplete-suggestion');

            if (suggestions.length === 0) return;

            if (e.keyCode === 40) { // Down arrow
                e.preventDefault();
                currentSelectedIndex = Math.min(currentSelectedIndex + 1, suggestions.length - 1);
                updateSelection(suggestions);
            } else if (e.keyCode === 38) { // Up arrow
                e.preventDefault();
                currentSelectedIndex = Math.max(currentSelectedIndex - 1, -1);
                updateSelection(suggestions);
            } else if (e.keyCode === 13) { // Enter
                e.preventDefault();
                if (currentSelectedIndex >= 0) {
                    const selectedSuggestion = suggestions.eq(currentSelectedIndex);
                    const code = selectedSuggestion.data('code');
                    const description = selectedSuggestion.data('description');
                    input.val(code + ' - ' + description);
                    suggestionsContainer.hide();
                }
            } else if (e.keyCode === 27) { // Escape
                suggestionsContainer.hide();
                currentSelectedIndex = -1;
            }
        });

        function updateSelection(suggestions) {
            suggestions.removeClass('selected');
            if (currentSelectedIndex >= 0) {
                suggestions.eq(currentSelectedIndex).addClass('selected');
            }
        }

        // Hide suggestions when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.diagnosis-input-container').length) {
                $('.autocomplete-suggestions').hide();
            }
        });

        
    $('#assessmentForm').on('submit', function(e) {
        e.preventDefault();

        // Collect all diagnosis data
        const formData = new FormData(this);

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
</script>