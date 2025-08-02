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
