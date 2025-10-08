@php
    $fingerNailsNormalValues = [
        [
            'normal' => 'Pink & smooth',
            'abnormal' => [
                'Pale',
                'Cyanotic',
                'Clubbing',
                'Other',
            ],
        ],
        [
            'normal' => 'Capillary refill time of <2 seconds',
            'abnormal' => [
                'Other',
            ],
        ],
    ];
    $existingFingerNails = $existingFingerNails ?? $fingerNailsData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Finger & Nails Examination</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalFinger">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalFinger">
                                <i class="fas fa-times-circle me-1"></i>Uncheck All
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-2">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50%">Normal</th>
                                    <th style="width: 50%">Abnormal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fingerNailsNormalValues as $i => $item)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-finger-checkbox" type="checkbox" name="finger_nails[{{ $i }}][normal]" id="normal_finger_{{ $i }}" value="1" {{ (isset($existingFingerNails[$i]['normal']) && $existingFingerNails[$i]['normal'] == '1') ? 'checked' : (empty($existingFingerNails) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_finger_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                @foreach($item['abnormal'] as $j => $abnormal)
                                                    <div class="col-12 mb-1 abnormal-finger-checkbox-group">
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input abnormal-finger-checkbox" type="checkbox" name="finger_nails[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_finger_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingFingerNails[$i]['abnormal'][$abnormal]) && $existingFingerNails[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                            <label class="form-check-label ms-2" for="abnormal_finger_{{ $i }}_{{ $j }}">
                                                                {{ $abnormal }}
                                                                @if($abnormal === 'Clubbing')
                                                                    <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Bronchiectasis, congenital heart disease, pulmonary fibrosis, cystic fibrosis, lung abscess, and malignancy" style="cursor:pointer;">
                                                                        <i class="fas fa-info-circle text-info ms-1"></i>
                                                                    </span>
                                                                @endif
                                                            </label>
                                                        </div>
                                                        @if($abnormal === 'Other')
                                                            <input type="text" class="form-control mt-1 abnormal-finger-other-input" name="finger_nails[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingFingerNails[$i]['abnormal_other'] ?? '' }}">
                                                        @else
                                                            <input type="text" class="form-control mt-1 abnormal-finger-detail-input" name="finger_nails[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingFingerNails[$i]['abnormal_detail'][$abnormal] ?? '' }}">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
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
</div>

<style>
.card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.card:hover {
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}
.form-check-label {
    font-size: 0.95rem;
    line-height: 1.2;
}
.card-body {
    max-height: 350px;
    overflow-y: auto;
}
.abnormal-finger-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-finger-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-finger-checkbox').each(function() {
            var input = $(this).closest('.abnormal-finger-checkbox-group').find('.abnormal-finger-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Finger & Nails
    $('.abnormal-finger-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-finger-checkbox-group').find('.abnormal-finger-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-finger-other-input').show();

    // Check All Normal functionality for Finger & Nails (now a button)
    $('#checkAllNormalFinger').on('click', function() {
        $('.normal-finger-checkbox').prop('checked', true);
        // Trigger autosave
        $('.normal-finger-checkbox').first().trigger('change');
    });

    // Uncheck All Normal functionality for Finger & Nails
    $('#uncheckAllNormalFinger').on('click', function() {
        $('.normal-finger-checkbox').prop('checked', false);
        // Trigger autosave
        $('.normal-finger-checkbox').first().trigger('change');
    });

    // Initialize on page load
    initializeAbnormalInputs();

    // Enable Bootstrap tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>

