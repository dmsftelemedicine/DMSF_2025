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
            <h6 class="m-0 font-weight-bold text-white">Comprehensive History</h6>
            <button class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300" type="button" id="saveComprehensiveHistoryBtn">Save</button>
        </div>
        <div class="card card-body">
            <form id="comprehensiveHistoryForm">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                <!-- Informant Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Informant</h5>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="informant_patient" name="informant[]" value="patient">
                                <label class="form-check-label" for="informant_patient">Patient himself</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="informant_family" name="informant[]" value="family">
                                <label class="form-check-label" for="informant_family">Family/Relative/Guardian</label>
                            </div>
                        </div>
                        <div class="col-md-1.5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="informant_acquaintance" name="informant[]" value="acquaintance">
                                <label class="form-check-label" for="informant_acquaintance">Acquaintance</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="informant_other_checkbox" name="informant[]" value="other">
                                <label class="form-check-label" for="informant_other_checkbox">Other</label>
                            </div>
                            <input type="text" class="form-control mt-2" id="informant_other" name="informant_other" placeholder="Specify other">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="percent_reliability" class="form-label">Percent Reliability</label>
                            <input type="number" class="form-control" id="percent_reliability" name="percent_reliability" min="0" max="100">
                        </div>
                    </div>
                </div>

                <!-- Chief Concern and History of Present Illness -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Chief Concern & History</h5>
                    <div class="mb-3">
                        <label for="chief_concern" class="form-label">Chief Concern</label>
                        <input type="text" class="form-control" id="chief_concern" name="chief_concern">
                    </div>
                    <div class="mb-3">
                        <label for="history_present_illness" class="form-label">History of Present Illness</label>
                        <textarea class="form-control" id="history_present_illness" name="history_present_illness" rows="4"></textarea>
                    </div>
                </div>

                <!-- Past Medical History Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Past Medical History</h5>

                    <!-- Childhood Illness -->
                    <h6 class="mb-3">Childhood Illness</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input childhood-illness" type="checkbox" id="measles" name="childhood_illness[]" value="measles">
                                <label class="form-check-label" for="measles">Measles</label>
                            </div>
                            <div class="illness-details" id="measles-details">
                                <div class="mb-2">
                                    <label class="form-label">Year</label>
                                    <input type="text" class="form-control" name="measles_year">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="measles_other_information">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input childhood-illness" type="checkbox" id="mumps" name="childhood_illness[]" value="mumps">
                                <label class="form-check-label" for="mumps">Mumps</label>
                            </div>
                            <div class="illness-details" id="mumps-details">
                                <div class="mb-2">
                                    <label class="form-label">Year</label>
                                    <input type="text" class="form-control" name="mumps_year">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="mumps_complications">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input childhood-illness" type="checkbox" id="chicken_pox" name="childhood_illness[]" value="chicken_pox">
                                <label class="form-check-label" for="chicken_pox">Chicken Pox</label>
                            </div>
                            <div class="illness-details" id="chicken_pox-details">
                                <div class="mb-2">
                                    <label class="form-label">Year</label>
                                    <input type="text" class="form-control" name="chicken_pox_year">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="chicken_pox_complications">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input childhood-illness" type="checkbox" id="polio" name="childhood_illness[]" value="polio">
                                <label class="form-check-label" for="polio">Polio</label>
                            </div>
                            <div class="illness-details" id="polio-details">
                                <div class="mb-2">
                                    <label class="form-label">Year</label>
                                    <input type="text" class="form-control" name="polio_year">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="polio_complications">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input childhood-illness" type="checkbox" id="tuberculosis" name="childhood_illness[]" value="tuberculosis">
                                <label class="form-check-label" for="tuberculosis">Tuberculosis</label>
                            </div>
                            <div class="illness-details" id="tuberculosis-details">
                                <div class="mb-2">
                                    <label class="form-label">Year</label>
                                    <input type="text" class="form-control" name="tuberculosis_year">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="tuberculosis_complications">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input childhood-illness" type="checkbox" id="childhood_asthma" name="childhood_illness[]" value="childhood_asthma">
                                <label class="form-check-label" for="childhood_asthma">Asthma</label>
                            </div>
                            <div class="illness-details" id="childhood_asthma-details">
                                <div class="mb-2">
                                    <label class="form-label">Year</label>
                                    <input type="text" class="form-control" name="childhood_asthma_year">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="childhood_asthma_complications">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input childhood-illness" type="checkbox" id="childhood_others" name="childhood_illness[]" value="childhood_others">
                                <label class="form-check-label" for="childhood_others">Others</label>
                            </div>
                            <div class="illness-details" id="childhood_others-details">
                                <div class="mb-2">
                                    <label class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="childhood_others_details">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="completed_vaccinations" name="completed_vaccinations" value="1">
                                <label class="form-check-label" for="completed_vaccinations">Completed childhood vaccinations</label>
                            </div>
                        </div>
                    </div>

                    <!-- Adult Illnesses -->
                    <h6 class="mb-3 mt-4">Adult Illnesses</h6>

                    <!-- Hypertension -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input adult-illness" type="checkbox" id="hypertension" name="adult_illness[]" value="hypertension">
                                <label class="form-check-label" for="hypertension">Hypertension</label>
                            </div>
                        </div>
                        <div class="card-body illness-details" id="hypertension-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="hypertension_type">
                                        <option value="">Select</option>
                                        <option value="primary">Primary</option>
                                        <option value="secondary">Secondary</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Stage</label>
                                    <select class="form-select" name="hypertension_stage">
                                        <option value="">Select</option>
                                        <option value="stage1">Stage I</option>
                                        <option value="stage2">Stage II</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Control Status</label>
                                    <select class="form-select" name="hypertension_control">
                                        <option value="">Select</option>
                                        <option value="controlled">Controlled</option>
                                        <option value="uncontrolled">Uncontrolled</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Diagnosed</label>
                                    <input type="text" class="form-control" name="hypertension_year">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Medication Status</label>
                                    <select class="form-select" name="hypertension_med_status">
                                        <option value="">Select</option>
                                        <option value="self-medicated">Self-medicated</option>
                                        <option value="prescribed">Prescribed</option>
                                        <option value="no-meds">No medications</option>
                                    </select>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Medications and other information</label>
                                    <input type="text" class="form-control" name="hypertension_medications">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Compliance</label>
                                    <select class="form-select" name="hypertension_compliance">
                                        <option value="">Select</option>
                                        <option value="compliant">Compliant</option>
                                        <option value="partially-compliant">Partially compliant</option>
                                        <option value="poorly-compliant">Poorly compliant</option>
                                        <option value="noncompliant">Noncompliant</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Diabetes -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input adult-illness" type="checkbox" id="diabetes" name="adult_illness[]" value="diabetes">
                                <label class="form-check-label" for="diabetes">Diabetes</label>
                            </div>
                        </div>
                        <div class="card-body illness-details" id="diabetes-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Insulin Requirement</label>
                                    <select class="form-select" name="diabetes_insulin">
                                        <option value="">Select</option>
                                        <option value="non-insulin">Non Insulin-requiring</option>
                                        <option value="insulin">Insulin-requiring</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="diabetes_type">
                                        <option value="">Select</option>
                                        <option value="type1">Type 1</option>
                                        <option value="type2">Type 2</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Control Status</label>
                                    <select class="form-select" name="diabetes_control">
                                        <option value="">Select</option>
                                        <option value="controlled">Controlled</option>
                                        <option value="uncontrolled">Uncontrolled</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Diagnosed</label>
                                    <input type="text" class="form-control" name="diabetes_year">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Medication Status</label>
                                    <select class="form-select" name="diabetes_med_status">
                                        <option value="">Select</option>
                                        <option value="self-medicated">Self-medicated</option>
                                        <option value="prescribed">Prescribed</option>
                                        <option value="no-meds">No medications</option>
                                    </select>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Medications and other information</label>
                                    <input type="text" class="form-control" name="diabetes_medications">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Compliance</label>
                                    <select class="form-select" name="diabetes_compliance">
                                        <option value="">Select</option>
                                        <option value="compliant">Compliant</option>
                                        <option value="partially-compliant">Partially compliant</option>
                                        <option value="poorly-compliant">Poorly compliant</option>
                                        <option value="noncompliant">Noncompliant</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bronchial Asthma -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input adult-illness" type="checkbox" id="bronchial_asthma" name="adult_illness[]" value="bronchial_asthma">
                                <label class="form-check-label" for="bronchial_asthma">Bronchial Asthma</label>
                            </div>
                        </div>
                        <div class="card-body illness-details" id="bronchial_asthma-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Control Status</label>
                                    <select class="form-select" name="asthma_control">
                                        <option value="">Select</option>
                                        <option value="controlled">Controlled</option>
                                        <option value="uncontrolled">Uncontrolled</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Diagnosed</label>
                                    <input type="text" class="form-control" name="asthma_year">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Medication Status</label>
                                    <select class="form-select" name="asthma_med_status">
                                        <option value="">Select</option>
                                        <option value="self-medicated">Self-medicated</option>
                                        <option value="prescribed">Prescribed</option>
                                        <option value="no-meds">No medications</option>
                                    </select>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Medications and other information</label>
                                    <input type="text" class="form-control" name="asthma_medications">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Compliance</label>
                                    <select class="form-select" name="asthma_compliance">
                                        <option value="">Select</option>
                                        <option value="compliant">Compliant</option>
                                        <option value="partially-compliant">Partially compliant</option>
                                        <option value="poorly-compliant">Poorly compliant</option>
                                        <option value="noncompliant">Noncompliant</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Other Adult Conditions -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Other Conditions</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cancer" name="other_conditions[]" value="cancer">
                                        <label class="form-check-label" for="cancer">Cancer</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="cancer_details" placeholder="Details">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dyslipidemia" name="other_conditions[]" value="dyslipidemia">
                                        <label class="form-check-label" for="dyslipidemia">Dyslipidemia</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="dyslipidemia_details" placeholder="Details">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="neurologic" name="other_conditions[]" value="neurologic">
                                        <label class="form-check-label" for="neurologic">Neurologic problems</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="neurologic_details" placeholder="Details">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="liver" name="other_conditions[]" value="liver">
                                        <label class="form-check-label" for="liver">Liver problems</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="liver_details" placeholder="Details">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kidney" name="other_conditions[]" value="kidney">
                                        <label class="form-check-label" for="kidney">Kidney problems</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="kidney_details" placeholder="Details">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="other_condition" name="other_conditions[]" value="other">
                                        <label class="form-check-label" for="other_condition">Others</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="other_condition_details" placeholder="Details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family History Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Family History</h5>

                    <!-- Hypertension -->
                    <div class="card mb-3">
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
                                    <input type="text" class="form-control" name="hypertension_family_year">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Medications and other information</label>
                                    <input type="text" class="form-control" name="hypertension_family_medications">
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
                    <div class="card mb-3">
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
                                    <input type="text" class="form-control" name="diabetes_family_year">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Medications</label>
                                    <input type="text" class="form-control" name="diabetes_family_medications">
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
                    <div class="card mb-3">
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
                                    <input type="text" class="form-control" name="asthma_family_year">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cancer -->
                    <div class="card mb-3">
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
                                    <input type="text" class="form-control" name="cancer_family_year">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Medications and other information</label>
                                    <input type="text" class="form-control" name="cancer_family_medications">
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
                    <div class="card mb-3">
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
                </div>

                <!-- Allergies Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Allergies</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="food_allergies" class="form-label">Food Allergies</label>
                            <input type="text" class="form-control" id="food_allergies" name="food_allergies">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="drug_allergies" class="form-label">Drug Allergies</label>
                            <input type="text" class="form-control" id="drug_allergies" name="drug_allergies">
                        </div>
                    </div>
                </div>

                <!-- Previous and Current Medications Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Previous and Current Medications</h5>
                    <div class="mb-3">
                        <label for="medications" class="form-label">List All Medications</label>
                        <textarea class="form-control" id="medications" name="medications" rows="4"></textarea>
                    </div>
                </div>

                <!-- Previous Hospitalization Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Previous Hospitalization</h5>
                    <div class="mb-3">
                        <table class="table table-bordered" id="hospitalizationTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Year</th>
                                    <th>Diagnosis</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="hospitalization_year[]"></td>
                                    <td><input type="text" class="form-control" name="hospitalization_diagnosis[]"></td>
                                    <td><input type="text" class="form-control" name="hospitalization_notes[]"></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm" id="addHospitalizationRow">
                            <i class="fa-solid fa-plus"></i> Add Row
                        </button>
                    </div>
                </div>

                <!-- Surgical History Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Surgical History</h5>
                    <div class="mb-3">
                        <table class="table table-bordered" id="surgicalTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Year</th>
                                    <th>Diagnosis</th>
                                    <th>Procedure</th>
                                    <th>Biopsy Result</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="surgical_year[]"></td>
                                    <td><input type="text" class="form-control" name="surgical_diagnosis[]"></td>
                                    <td><input type="text" class="form-control" name="surgical_procedure[]"></td>
                                    <td><input type="text" class="form-control" name="surgical_biopsy[]"></td>
                                    <td><input type="text" class="form-control" name="surgical_notes[]"></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm" id="addSurgicalRow">
                            <i class="fa-solid fa-plus"></i> Add Row
                        </button>
                    </div>
                </div>

                <!-- Health Maintenance Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Health Maintenance</h5>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">COVID-19 Vaccination</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="covid_year" class="form-label">Year</label>
                                    <input type="date" class="form-control" id="covid_year" name="covid_year">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="covid_brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control" id="covid_brand" name="covid_brand">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="covid_boosters" class="form-label">Boosters</label>
                                    <input type="text" class="form-control" id="covid_boosters" name="covid_boosters">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Other Vaccinations</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="pcv_vaccine" class="form-label">PCV</label>
                                    <input type="text" class="form-control" id="pcv_vaccine" name="pcv_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="flu_vaccine" class="form-label">Flu</label>
                                    <input type="text" class="form-control" id="flu_vaccine" name="flu_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="hepb_vaccine" class="form-label">HepB</label>
                                    <input type="text" class="form-control" id="hepb_vaccine" name="hepb_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="hpv_vaccine" class="form-label">HPV</label>
                                    <input type="text" class="form-control" id="hpv_vaccine" name="hpv_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="other_vaccines" class="form-label">Others</label>
                                    <input type="text" class="form-control" id="other_vaccines" name="other_vaccines">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- OBGYN History Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">OBGYN History</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="lmp" class="form-label">Last Menstrual Period (LMP)</label>
                            <input type="date" class="form-control" id="lmp" name="lmp">
                        </div>
                        <div class="col-md-6">
                            <label for="pmp" class="form-label">Previous Menstrual Period (PMP)</label>
                            <input type="date" class="form-control" id="pmp" name="pmp">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6 class="mb-2">OB Score</h6>
                        </div>
                        <div class="col-md-2">
                            <label for="ob_g" class="form-label">G</label>
                            <input type="text" class="form-control" id="ob_g" name="ob_g">
                        </div>
                        <div class="col-md-2">
                            <label for="ob_p" class="form-label">P</label>
                            <input type="text" class="form-control" id="ob_p" name="ob_p">
                        </div>
                        <div class="col-md-2">
                            <label for="ob_t" class="form-label">T</label>
                            <input type="text" class="form-control" id="ob_t" name="ob_t">
                        </div>
                        <div class="col-md-2">
                            <label for="ob_p2" class="form-label">P</label>
                            <input type="text" class="form-control" id="ob_p2" name="ob_p2">
                        </div>
                        <div class="col-md-2">
                            <label for="ob_a" class="form-label">A</label>
                            <input type="text" class="form-control" id="ob_a" name="ob_a">
                        </div>
                        <div class="col-md-2">
                            <label for="ob_l" class="form-label">L</label>
                            <input type="text" class="form-control" id="ob_l" name="ob_l">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="menarche" class="form-label">Menarche</label>
                            <input type="text" class="form-control" id="menarche" name="menarche">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6 class="mb-2">Menstrual Details</h6>
                        </div>
                        <div class="col-md-4">
                            <label for="menstrual_interval" class="form-label">Interval</label>
                            <input type="text" class="form-control" id="menstrual_interval" name="menstrual_interval">
                        </div>
                        <div class="col-md-4">
                            <label for="menstrual_duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="menstrual_duration" name="menstrual_duration">
                        </div>
                        <div class="col-md-4">
                            <label for="menstrual_pads" class="form-label">Pads Per Day</label>
                            <input type="number" class="form-control" id="menstrual_pads" name="menstrual_pads">
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="radio" name="menstrual_amount" id="amount_minimal" value="minimally">
                                <label class="form-check-label" for="amount_minimal">Minimally</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="menstrual_amount" id="amount_moderate" value="moderately">
                                <label class="form-check-label" for="amount_moderate">Moderately</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="menstrual_amount" id="amount_soaked" value="soaked">
                                <label class="form-check-label" for="amount_soaked">Soaked</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6 class="mb-2">Symptoms</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="symptom_dysmenorrhea" name="menstrual_symptoms[]" value="dysmenorrhea">
                                <label class="form-check-label" for="symptom_dysmenorrhea">Dysmenorrhea</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="symptom_headache" name="menstrual_symptoms[]" value="headache">
                                <label class="form-check-label" for="symptom_headache">Headache</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="symptom_vomiting" name="menstrual_symptoms[]" value="vomiting">
                                <label class="form-check-label" for="symptom_vomiting">Vomiting</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="symptom_dyschezia" name="menstrual_symptoms[]" value="dyschezia">
                                <label class="form-check-label" for="symptom_dyschezia">Dyschezia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="symptom_other" name="menstrual_symptoms[]" value="other">
                                <label class="form-check-label" for="symptom_other">Others</label>
                            </div>
                            <div class="mt-2">
                                <input type="text" class="form-control" id="symptom_other_details" name="symptom_other_details" placeholder="Other symptoms">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="coitarche" class="form-label">Coitarche</label>
                            <input type="text" class="form-control" id="coitarche" name="coitarche">
                        </div>
                        <div class="col-md-4">
                            <label for="pap_smear" class="form-label">Pap Smear</label>
                            <input type="text" class="form-control" id="pap_smear" name="pap_smear">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6 class="mb-2">Contraceptive Method</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_calendar" name="contraceptive_methods[]" value="calendar">
                                <label class="form-check-label" for="contraceptive_calendar">Calendar method</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_withdrawal" name="contraceptive_methods[]" value="withdrawal">
                                <label class="form-check-label" for="contraceptive_withdrawal">Withdrawal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_pills" name="contraceptive_methods[]" value="pills">
                                <label class="form-check-label" for="contraceptive_pills">Hormonal pills</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_depo" name="contraceptive_methods[]" value="depo">
                                <label class="form-check-label" for="contraceptive_depo">Depo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_implant" name="contraceptive_methods[]" value="implant">
                                <label class="form-check-label" for="contraceptive_implant">Implant</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_other_checkbox" name="contraceptive_methods[]" value="other">
                                <label class="form-check-label" for="contraceptive_other_checkbox">Others</label>
                            </div>
                            <div class="mt-2">
                                <input type="text" class="form-control" id="contraceptive_other" name="contraceptive_other" placeholder="Other contraceptive methods">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Psychiatric Illness Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Psychiatric Illness</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_anxiety" name="psychiatric_illness[]" value="anxiety">
                                <label class="form-check-label" for="psychiatric_anxiety">Anxiety</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_depression" name="psychiatric_illness[]" value="depression">
                                <label class="form-check-label" for="psychiatric_depression">Depression</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_mood" name="psychiatric_illness[]" value="mood_disorders">
                                <label class="form-check-label" for="psychiatric_mood">Mood Disorders</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_hallucinations" name="psychiatric_illness[]" value="hallucinations">
                                <label class="form-check-label" for="psychiatric_hallucinations">Hallucinations</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_delusions" name="psychiatric_illness[]" value="delusions">
                                <label class="form-check-label" for="psychiatric_delusions">Delusions</label>
                            </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="psychiatric_others" name="psychiatric_illness[]" value="others">
                            <label class="form-check-label" for="psychiatric_others">Others</label>
                        </div>
                        <div class="mt-2">
                            <input type="text" class="form-control" id="psychiatric_others_details" name="psychiatric_others_details" placeholder="Other psychiatric conditions">
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Personal-Social History Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Personal-Social History</h5>

                    <!-- Cigarette User -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cigarette_user" name="cigarette_user" value="1">
                                <label class="form-check-label" for="cigarette_user">Cigarette User</label>
                            </div>
                        </div>
                        <div class="card-body" id="cigarette-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Started</label>
                                    <input type="text" class="form-control" name="cigarette_year_started">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Discontinued</label>
                                    <input type="text" class="form-control" name="cigarette_year_discontinued">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="current_smoker" name="current_smoker" value="1">
                                        <label class="form-check-label" for="current_smoker">Current Smoker</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Sticks Per Day</label>
                                    <input type="number" class="form-control" id="sticks_per_day" name="sticks_per_day">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Years Smoking</label>
                                    <input type="text" class="form-control" id="years_smoking" name="years_smoking" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Pack Years</label>
                                    <input type="text" class="form-control" id="pack_years" name="pack_years" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alcohol Beverage Drinker -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="alcohol_drinker" name="alcohol_drinker" value="1">
                                <label class="form-check-label" for="alcohol_drinker">Alcohol Beverage Drinker</label>
                            </div>
                        </div>
                        <div class="card-body" id="alcohol-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Started</label>
                                    <input type="text" class="form-control" name="alcohol_year_started">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Discontinued</label>
                                    <input type="text" class="form-control" name="alcohol_year_discontinued">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="current_drinker" name="current_drinker" value="1">
                                        <label class="form-check-label" for="current_drinker">Current Drinker</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="alcohol_type">
                                        <option value="">Select</option>
                                        <option value="tuba">Tuba</option>
                                        <option value="beer">Beer</option>
                                        <option value="wine">Wine</option>
                                        <option value="shots">Shots</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Standard Drinks</label>
                                    <input type="number" class="form-control" name="alcohol_sd" placeholder="Amount">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Frequency</label>
                                    <select class="form-select" name="alcohol_frequency">
                                        <option value="">Select</option>
                                        <option value="per_day">Per Day</option>
                                        <option value="per_week">Per Week</option>
                                        <option value="per_session">Per Session</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Illicit Drug User -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="drug_user" name="drug_user" value="1">
                                <label class="form-check-label" for="drug_user">Illicit Drug User</label>
                            </div>
                        </div>
                        <div class="card-body" id="drug-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <input type="text" class="form-control" name="drug_type">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Started</label>
                                    <input type="text" class="form-control" name="drug_year_started">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Discontinued</label>
                                    <input type="text" class="form-control" name="drug_year_discontinued">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="current_drug_user" name="current_drug_user" value="1">
                                        <label class="form-check-label" for="current_drug_user">Current Drug User</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coffee User -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="coffee_user" name="coffee_user" value="1">
                                <label class="form-check-label" for="coffee_user">Coffee User</label>
                            </div>
                        </div>
                        <div class="card-body" id="coffee-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="coffee_type">
                                        <option value="">Select</option>
                                        <option value="instant">Instant</option>
                                        <option value="brewed">Brewed</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Amount</label>
                                    <select class="form-select" name="coffee_amount">
                                        <option value="">Select</option>
                                        <option value="240ml">240ml</option>
                                        <option value="360ml">360ml</option>
                                        <option value="500ml">500ml</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Cups Per Day</label>
                                    <select class="form-select" name="coffee_cups">
                                        <option value="">Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5+">5+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alternative Therapies -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Alternative Therapies</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_hilot" name="alternative_therapies[]" value="hilot">
                                        <label class="form-check-label" for="therapy_hilot">Hilot</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_quack" name="alternative_therapies[]" value="quack_doctor">
                                        <label class="form-check-label" for="therapy_quack">Quack Doctor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_chiro" name="alternative_therapies[]" value="chiropractor">
                                        <label class="form-check-label" for="therapy_chiro">Chiropractor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_acupuncture" name="alternative_therapies[]" value="acupuncture">
                                        <label class="form-check-label" for="therapy_acupuncture">Acupuncture</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_other_checkbox" name="alternative_therapies[]" value="other">
                                        <label class="form-check-label" for="therapy_other_checkbox">Others</label>
                                    </div>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" id="therapy_other" name="therapy_other" placeholder="Other alternative therapies">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Other Social History -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Other Social History</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="schooling" class="form-label">Schooling</label>
                                    <textarea class="form-control" id="schooling" name="schooling" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="job_history" class="form-label">Job History</label>
                                    <textarea class="form-control" id="job_history" name="job_history" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="financial_situation" class="form-label">Financial Situation</label>
                                    <textarea class="form-control" id="financial_situation" name="financial_situation" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="marriage_children" class="form-label">Marriage/Children</label>
                                    <textarea class="form-control" id="marriage_children" name="marriage_children" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="home_situation" class="form-label">Home Situation</label>
                                    <textarea class="form-control" id="home_situation" name="home_situation" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="daily_activities" class="form-label">Daily Activities</label>
                                    <textarea class="form-control" id="daily_activities" name="daily_activities" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="environment" class="form-label">Environment</label>
                                    <textarea class="form-control" id="environment" name="environment" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initially hide all illness details
    $('.illness-details').hide();
    $('.family-illness-details').hide();
    $('#cigarette-details').hide();
    $('#alcohol-details').hide();
    $('#drug-details').hide();
    $('#coffee-details').hide();

    // Show/hide illness details when checkboxes are clicked
    $('.childhood-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    $('.adult-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    $('.family-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    // Show/hide habits details
    $('#cigarette_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#cigarette-details').show();
        } else {
            $('#cigarette-details').hide();
        }
    });

    $('#alcohol_drinker').on('change', function() {
        if($(this).is(':checked')) {
            $('#alcohol-details').show();
        } else {
            $('#alcohol-details').hide();
        }
    });

    $('#drug_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#drug-details').show();
        } else {
            $('#drug-details').hide();
        }
    });

    $('#coffee_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#coffee-details').show();
        } else {
            $('#coffee-details').hide();
        }
    });

    // Calculate smoking pack years
    $('#sticks_per_day, #cigarette_year_started, #cigarette_year_discontinued, #current_smoker').on('change', function() {
        calculatePackYears();
    });

    function calculatePackYears() {
        let sticksPerDay = parseFloat($('#sticks_per_day').val()) || 0;
        let yearStarted = parseInt($('input[name="cigarette_year_started"]').val());
        let yearDiscontinued = parseInt($('input[name="cigarette_year_discontinued"]').val());
        let currentSmoker = $('#current_smoker').is(':checked');

        if (yearStarted) {
            let yearsSmoking;
            if (currentSmoker) {
                yearsSmoking = new Date().getFullYear() - yearStarted;
            } else if (yearDiscontinued) {
                yearsSmoking = yearDiscontinued - yearStarted;
            } else {
                yearsSmoking = 0;
            }

            if (yearsSmoking > 0) {
                $('#years_smoking').val(yearsSmoking);

                // Calculate pack years: (sticks per day / 20) * years smoking
                let packYears = (sticksPerDay / 20) * yearsSmoking;
                $('#pack_years').val(packYears.toFixed(2));
            }
        }
    }

    // Add row to hospitalization table
    $('#addHospitalizationRow').on('click', function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="hospitalization_year[]"></td>
                <td><input type="text" class="form-control" name="hospitalization_diagnosis[]"></td>
                <td><input type="text" class="form-control" name="hospitalization_notes[]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#hospitalizationTable tbody').append(newRow);
    });

    // Add row to surgical table
    $('#addSurgicalRow').on('click', function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="surgical_year[]"></td>
                <td><input type="text" class="form-control" name="surgical_diagnosis[]"></td>
                <td><input type="text" class="form-control" name="surgical_procedure[]"></td>
                <td><input type="text" class="form-control" name="surgical_biopsy[]"></td>
                <td><input type="text" class="form-control" name="surgical_notes[]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#surgicalTable tbody').append(newRow);
    });

    // Remove row from tables
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });

    // Form submission
    $('#saveComprehensiveHistoryBtn').on('click', function() {
        let formData = $('#comprehensiveHistoryForm').serialize();

        $.ajax({
            url: '/patients/' + $('input[name="patient_id"]').val() + '/comprehensive-history',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('Comprehensive history saved successfully!');
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('Error saving comprehensive history: ' + (xhr.responseJSON?.message || 'Unknown error'));
            }
        });
    });

    // Load existing data if available
    @if(isset($comprehensiveHistory) && $comprehensiveHistory)
        console.log('Loading existing comprehensive history data...');
        var existingData = @json($comprehensiveHistory);

        // Handle arrays
        if (existingData.informant) {
            existingData.informant.forEach(function(value) {
                $(`input[name="informant[]"][value="${value}"]`).prop('checked', true);
            });
        }

        if (existingData.childhood_illness) {
            Object.keys(existingData.childhood_illness).forEach(function(illness) {
                $(`#${illness}`).prop('checked', true);
                $(`#${illness}-details`).show();
                if (existingData.childhood_illness[illness].year) {
                    $(`input[name="${illness}_year"]`).val(existingData.childhood_illness[illness].year);
                }
                if (existingData.childhood_illness[illness].complications) {
                    $(`input[name="${illness}_complications"]`).val(existingData.childhood_illness[illness].complications);
                }
            });
        }

        if (existingData.adult_illness) {
            existingData.adult_illness.forEach(function(illness) {
                $(`#${illness}`).prop('checked', true);
                $(`#${illness}-details`).show();
            });
        }

        if (existingData.family_illness) {
            existingData.family_illness.forEach(function(illness) {
                $(`#family_${illness}`).prop('checked', true);
                $(`#family_${illness}-details`).show();
            });
        }

        if (existingData.other_conditions) {
            existingData.other_conditions.forEach(function(condition) {
                $(`input[name="other_conditions[]"][value="${condition}"]`).prop('checked', true);
            });
        }

        if (existingData.family_other_conditions) {
            existingData.family_other_conditions.forEach(function(condition) {
                $(`input[name="family_other_conditions[]"][value="${condition}"]`).prop('checked', true);
            });
        }

        if (existingData.menstrual_symptoms) {
            existingData.menstrual_symptoms.forEach(function(symptom) {
                $(`input[name="menstrual_symptoms[]"][value="${symptom}"]`).prop('checked', true);
            });
        }

        if (existingData.contraceptive_methods) {
            existingData.contraceptive_methods.forEach(function(method) {
                $(`input[name="contraceptive_methods[]"][value="${method}"]`).prop('checked', true);
            });
        }

        if (existingData.psychiatric_illness) {
            existingData.psychiatric_illness.forEach(function(illness) {
                $(`input[name="psychiatric_illness[]"][value="${illness}"]`).prop('checked', true);
            });
        }

        if (existingData.alternative_therapies) {
            existingData.alternative_therapies.forEach(function(therapy) {
                $(`input[name="alternative_therapies[]"][value="${therapy}"]`).prop('checked', true);
            });
        }

        // Handle boolean fields and show/hide details
        if (existingData.cigarette_user) {
            $('#cigarette_user').prop('checked', true);
            $('#cigarette-details').show();
        }
        if (existingData.alcohol_drinker) {
            $('#alcohol_drinker').prop('checked', true);
            $('#alcohol-details').show();
        }
        if (existingData.drug_user) {
            $('#drug_user').prop('checked', true);
            $('#drug-details').show();
        }
        if (existingData.coffee_user) {
            $('#coffee_user').prop('checked', true);
            $('#coffee-details').show();
        }

        // Handle hospitalization data
        if (existingData.hospitalization && existingData.hospitalization.length > 0) {
            $('#hospitalizationTable tbody').empty(); // Clear existing rows
            existingData.hospitalization.forEach(function(hospital) {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="hospitalization_year[]" value="${hospital.year || ''}"></td>
                        <td><input type="text" class="form-control" name="hospitalization_diagnosis[]" value="${hospital.diagnosis || ''}"></td>
                        <td><input type="text" class="form-control" name="hospitalization_notes[]" value="${hospital.notes || ''}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#hospitalizationTable tbody').append(newRow);
            });
        }

        // Handle surgical history data
        if (existingData.surgical_history && existingData.surgical_history.length > 0) {
            $('#surgicalTable tbody').empty(); // Clear existing rows
            existingData.surgical_history.forEach(function(surgery) {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="surgical_year[]" value="${surgery.year || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_diagnosis[]" value="${surgery.diagnosis || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_procedure[]" value="${surgery.procedure || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_biopsy[]" value="${surgery.biopsy || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_notes[]" value="${surgery.notes || ''}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#surgicalTable tbody').append(newRow);
            });
        }

        // Handle simple text fields
        Object.keys(existingData).forEach(function(key) {
            if (!['informant', 'childhood_illness', 'adult_illness', 'family_illness', 'other_conditions',
                  'family_other_conditions', 'menstrual_symptoms', 'contraceptive_methods',
                  'psychiatric_illness', 'alternative_therapies', 'cigarette_user', 'alcohol_drinker',
                  'drug_user', 'coffee_user', 'hospitalization', 'surgical_history',
                  'id', 'patient_id', 'created_at', 'updated_at'].includes(key)) {

                var element = $(`[name="${key}"]`);
                if (element.length > 0) {
                    if (element.is(':checkbox')) {
                        element.prop('checked', existingData[key]);
                    } else {
                        element.val(existingData[key]);
                    }
                }
            }
        });

        // Handle complex nested data for adult illnesses
        ['hypertension', 'diabetes', 'bronchial_asthma'].forEach(function(illness) {
            Object.keys(existingData).forEach(function(key) {
                if (key.startsWith(illness + '_') && key !== illness + '_user') {
                    $(`[name="${key}"]`).val(existingData[key]);
                }
            });
        });

        // Handle family illness nested data
        ['hypertension', 'diabetes', 'asthma', 'cancer'].forEach(function(illness) {
            Object.keys(existingData).forEach(function(key) {
                if (key.includes('_family_') || key.includes('_relation') || key.includes('_side')) {
                    $(`[name="${key}"]`).val(existingData[key]);
                }
            });
                 });
     @else
         console.log('No existing comprehensive history data found.');
     @endif
});
</script>
