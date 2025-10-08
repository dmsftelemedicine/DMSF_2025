@php
    $extremitiesCategories = [
        [
            'category' => 'Inspection & Palpation',
            'normal' => 'Even skin, no subcutaneous nodules, muscle atrophy, crepitus, bogginess or tenderness',
            'abnormal' => ['Skin changes', 'Subcutaneous nodules', 'Muscle atrophy', 'Crepitus', 'Tenderness', 'Bogginess of joints', 'Erythema and tenderness of joint', 'Other'],
        ],
        [
            'category' => 'Bone and Joint Assessment',
            'normal' => 'Full smooth range of motion, no swelling, symmetrical and aligned',
            'abnormal' => ['Decreased or difficulty in ROM', 'Swelling/erythema', 'Joint asymmetry', 'Malalignment', 'Other'],
        ],
        [
            'category' => 'Peripheral Vascular',
            'normal' => 'Pulses full and equal, no edema, symmetrical valves, not visible to flat nonprominent veins, symmetrical warmth, with hair growth appropriate to age and sex',
            'abnormal' => ['Diminished pulses', 'Bounding pulses', 'Pitting (+1 to +4) edema', 'Nonpitting edema (unilateral, bilateral)', 'Varicosities/ visible venous collaterals', 'Significant extremity hair loss or pallor', 'Sharply demarcated pallor of fingers', 'Calf asymmetry (>3cm)', 'Lesions (pigmentation, rashes, scars, ulcers, thickened brawny skin)', 'Local swelling, redness, and warmth', '(+) Allen test', 'Other'],
        ],
        [
            'category' => 'Inguinal Nodes',
            'normal' => 'Not palpable',
            'abnormal' => ['Enlarged', 'Tender', 'Other'],
        ],
        [
            'category' => 'Muscle & Motor',
            'normal' => 'Normal tone & strength',
            'abnormal' => ['Weakness', 'Abnormal reflexes', '(+) Brudzinski sign', '(+) Babinski sign', 'Other'],
        ],
        [
            'category' => 'Gait',
            'normal' => 'Steady, balanced',
            'abnormal' => ['Unsteady gait', 'Ataxic gait', '(+) Romberg test', 'Other'],
        ],
    ];
    $existingExtremities = $existingExtremities ?? $extremitiesData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">EXTREMITIES</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalExtremities">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalExtremities">
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
                                    <th style="width: 30%">Category</th>
                                    <th style="width: 35%">Normal</th>
                                    <th style="width: 35%">Abnormal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($extremitiesCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-extremities-checkbox" type="checkbox" name="extremities[{{ $i }}][normal]" id="normal_extremities_{{ $i }}" value="1" {{ (isset($existingExtremities[$i]['normal']) && $existingExtremities[$i]['normal'] == '1') ? 'checked' : (empty($existingExtremities) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_extremities_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-extremities-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-extremities-checkbox" type="checkbox" name="extremities[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_extremities_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingExtremities[$i]['abnormal'][$abnormal]) && $existingExtremities[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_extremities_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-extremities-other-input" name="extremities[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingExtremities[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-extremities-detail-input" name="extremities[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingExtremities[$i]['abnormal_detail'][$abnormal] ?? '' }}">
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
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
.abnormal-extremities-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-extremities-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-extremities-checkbox').each(function() {
            var input = $(this).closest('.abnormal-extremities-checkbox-group').find('.abnormal-extremities-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Extremities
    $('.abnormal-extremities-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-extremities-checkbox-group').find('.abnormal-extremities-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-extremities-other-input').show();

    // Check All Normal functionality for Extremities (now a button)
    $('#checkAllNormalExtremities').on('click', function() {
        $('.normal-extremities-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Extremities
    $('#uncheckAllNormalExtremities').on('click', function() {
        $('.normal-extremities-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



