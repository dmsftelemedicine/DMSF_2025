<!-- Family History Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Family History</h5>

    <!-- Hypertension -->
    <div class="card mb-3 family-illness-card">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input family-illness" type="checkbox" id="family_hypertension" name="family_illness[]" value="hypertension">
                <label class="form-check-label" for="family_hypertension">Hypertension</label>
            </div>
        </div>
        <div class="card-body family-illness-details" id="family_hypertension-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Relation</label>
                    <select class="form-select" name="hypertension_relation">
                        <option value="">Select</option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                        <option value="sibling">Sibling</option>
                        <option value="aunt">Aunt</option>
                        <option value="uncle">Uncle</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Side</label>
                    <select class="form-select" name="hypertension_side">
                        <option value="">Select</option>
                        <option value="maternal">Maternal side</option>
                        <option value="paternal">Paternal side</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select year-select" name="hypertension_family_year">
                        <option value="">Select year</option>
                        @for ($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Medications and other information</label>
                    <input type="text" class="form-control" name="hypertension_family_medications" placeholder="Medications, treatment details, notes">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="hypertension_family_status">
                        <option value="">Select</option>
                        <option value="alive">Alive</option>
                        <option value="deceased">Deceased</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Diabetes -->
    <div class="card mb-3 family-illness-card">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input family-illness" type="checkbox" id="family_diabetes" name="family_illness[]" value="diabetes">
                <label class="form-check-label" for="family_diabetes">Diabetes</label>
            </div>
        </div>
        <div class="card-body family-illness-details" id="family_diabetes-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Relation</label>
                    <select class="form-select" name="diabetes_relation">
                        <option value="">Select</option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                        <option value="sibling">Sibling</option>
                        <option value="aunt">Aunt</option>
                        <option value="uncle">Uncle</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Side</label>
                    <select class="form-select" name="diabetes_side">
                        <option value="">Select</option>
                        <option value="maternal">Maternal side</option>
                        <option value="paternal">Paternal side</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select year-select" name="diabetes_family_year">
                        <option value="">Select year</option>
                        @for ($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Medications</label>
                    <input type="text" class="form-control" name="diabetes_family_medications" placeholder="Medications, treatment details">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="diabetes_family_status">
                        <option value="">Select</option>
                        <option value="alive">Alive</option>
                        <option value="deceased">Deceased</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Bronchial Asthma -->
    <div class="card mb-3 family-illness-card">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input family-illness" type="checkbox" id="family_asthma" name="family_illness[]" value="asthma">
                <label class="form-check-label" for="family_asthma">Bronchial Asthma</label>
            </div>
        </div>
        <div class="card-body family-illness-details" id="family_asthma-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Relation</label>
                    <select class="form-select" name="asthma_relation">
                        <option value="">Select</option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                        <option value="sibling">Sibling</option>
                        <option value="aunt">Aunt</option>
                        <option value="uncle">Uncle</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Side</label>
                    <select class="form-select" name="asthma_side">
                        <option value="">Select</option>
                        <option value="maternal">Maternal side</option>
                        <option value="paternal">Paternal side</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select year-select" name="asthma_family_year">
                        <option value="">Select year</option>
                        @for ($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancer -->
    <div class="card mb-3 family-illness-card">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input family-illness" type="checkbox" id="family_cancer" name="family_illness[]" value="cancer">
                <label class="form-check-label" for="family_cancer">Cancer</label>
            </div>
        </div>
        <div class="card-body family-illness-details" id="family_cancer-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Relation</label>
                    <select class="form-select" name="cancer_relation">
                        <option value="">Select</option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                        <option value="sibling">Sibling</option>
                        <option value="aunt">Aunt</option>
                        <option value="uncle">Uncle</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Side</label>
                    <select class="form-select" name="cancer_side">
                        <option value="">Select</option>
                        <option value="maternal">Maternal side</option>
                        <option value="paternal">Paternal side</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select year-select" name="cancer_family_year">
                        <option value="">Select year</option>
                        @for ($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Medications and other information</label>
                    <input type="text" class="form-control" name="cancer_family_medications" placeholder="Medications, treatment details, notes">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="cancer_family_status">
                        <option value="">Select</option>
                        <option value="alive">Alive</option>
                        <option value="deceased">Deceased</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Family Conditions -->
    <div class="card mb-3 family-illness-card">
        <div class="card-header">
            <h6 class="mb-0">Other Family Conditions</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="family_dyslipidemia" name="family_other_conditions[]" value="dyslipidemia">
                        <label class="form-check-label" for="family_dyslipidemia">Dyslipidemia</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="family_dyslipidemia_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="family_neurologic" name="family_other_conditions[]" value="neurologic">
                        <label class="form-check-label" for="family_neurologic">Neurologic problems</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="family_neurologic_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="family_liver" name="family_other_conditions[]" value="liver">
                        <label class="form-check-label" for="family_liver">Liver problems</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="family_liver_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="family_kidney" name="family_other_conditions[]" value="kidney">
                        <label class="form-check-label" for="family_kidney">Kidney problems</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="family_kidney_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="family_other" name="family_other_conditions[]" value="other">
                        <label class="form-check-label" for="family_other">Others</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="family_other_details" placeholder="Details">
                </div>
            </div>
        </div>
    </div>

    {{-- File Upload Section for Family History --}}
    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'family_history', 
        'title' => 'Family History Supporting Documents',
        'patient' => $patient ?? null
    ])
</div>

<style>
/* Family History Card Styles */
.family-illness-card {
    transition: box-shadow 0.3s ease, transform 0.2s ease;
}

.family-illness-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.family-illness-card .card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

.family-illness-card .form-check-input:checked ~ .form-check-label {
    color: #7CAD3E;
    font-weight: 500;
}

/* Family illness details styling */
.family-illness-details {
    display: none;
}

/* Year select styling for family history */
.family-illness-card .year-select:focus,
.family-illness-card .form-select:focus,
.family-illness-card .form-control:focus {
    border-color: #7CAD3E;
    box-shadow: 0 0 0 0.2rem rgba(124, 173, 62, 0.25);
}

.family-illness-card .year-select.border-success,
.family-illness-card .form-select.border-success,
.family-illness-card .form-control.border-success {
    border-color: #7CAD3E !important;
}

/* Family conditions checkbox styling */
.family-illness-card .form-check-input:checked {
    background-color: #7CAD3E;
    border-color: #7CAD3E;
}
</style>

<script>
$(document).ready(function() {
    // Family illness checkbox toggle
    $('.family-illness').change(function() {
        var targetId = $(this).attr('id') + '-details';
        var detailsDiv = $('#' + targetId);
        
        if ($(this).is(':checked')) {
            detailsDiv.slideDown(300);
            // Add visual feedback for successful selection
            $(this).closest('.card').addClass('border-success');
        } else {
            detailsDiv.slideUp(300);
            // Clear all form inputs in the details section
            detailsDiv.find('input, select').val('').removeClass('border-success');
            $(this).closest('.card').removeClass('border-success');
        }
    });

    // Visual feedback for year selections in family history
    $('.family-illness-card .year-select').change(function() {
        if ($(this).val()) {
            $(this).addClass('border-success');
        } else {
            $(this).removeClass('border-success');
        }
    });

    // Visual feedback for other form controls in family history
    $('.family-illness-card .form-select, .family-illness-card .form-control').change(function() {
        if ($(this).val()) {
            $(this).addClass('border-success');
        } else {
            $(this).removeClass('border-success');
        }
    });

    // Enhanced hover effects for family history cards
    $('.family-illness-card').hover(
        function() {
            $(this).css('background-color', '#fafbfc');
        },
        function() {
            $(this).css('background-color', '');
        }
    );
});
</script>
