<!-- Informant Section Component -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Informant</h5>
    <div class="row mb-3">
        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="informant_patient" name="informant[]" value="patient">
                <label class="form-check-label" for="informant_patient">Patient himself</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="informant_family" name="informant[]" value="family">
                <label class="form-check-label" for="informant_family">Family/Relative/Guardian</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="informant_acquaintance" name="informant[]" value="acquaintance">
                <label class="form-check-label" for="informant_acquaintance">Acquaintance</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="informant_other_checkbox" name="informant[]" value="other">
                <label class="form-check-label" for="informant_other_checkbox">Other</label>
            </div>
            <input type="text" class="form-control mt-2" id="informant_other" name="informant_other" placeholder="Specify other" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="percent_reliability" class="form-label">Percent Reliability (%)</label>
            <input type="number" class="form-control" id="percent_reliability" name="percent_reliability" min="0" max="100" placeholder="0-100">
            <small class="form-text text-muted">Enter a value between 0 and 100</small>
        </div>
    </div>
</div>

<style>
.form-check-label {
    font-size: 0.95rem;
    color: #495057;
}

.form-control.is-valid {
    border-color: #28a745;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

#informant_other:disabled {
    background-color: #f8f9fa;
    opacity: 0.6;
}
</style>

<!-- JavaScript for Informant Section -->
<script>
$(document).ready(function() {
    // Handle "Other" checkbox functionality
    $('#informant_other_checkbox').on('change', function() {
        if ($(this).is(':checked')) {
            $('#informant_other').prop('disabled', false).focus();
        } else {
            $('#informant_other').prop('disabled', true).val('');
        }
    });

    // Validate percent reliability input
    $('#percent_reliability').on('input', function() {
        let value = parseInt($(this).val());
        if (value < 0) $(this).val(0);
        if (value > 100) $(this).val(100);
        
        // Update validation styling real-time
        if ($(this).val() !== '' && (value < 0 || value > 100 || isNaN(value))) {
            $(this).removeClass('is-valid').addClass('is-invalid');
        } else if ($(this).val() !== '') {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-valid is-invalid');
        }
    });

    // Clear validation styling when field is empty
    $('#percent_reliability').on('blur', function() {
        if ($(this).val() === '') {
            $(this).removeClass('is-valid is-invalid');
        }
    });
});
</script>
