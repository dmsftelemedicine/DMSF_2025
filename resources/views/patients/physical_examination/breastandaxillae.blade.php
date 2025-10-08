@php
    $breastAxillaeCategories = [
        [
            'category' => 'Inspection',
            'normal' => 'Symmetrical size and shape, smooth contour, even skin color, everted nipples with evenly pigmented areolae',
            'abnormal' => [
                'Distinct asymmetry', 'Dimpling', 'Retraction', 'Spontaneous discharge', 'Peau d’orange', 'Pseudogynecomastia/gynecomastia', 'Inverted nipples', 'Scaly nipples', 'Flattening', 'Erythema', 'Other'
            ],
        ],
        [
            'category' => 'Palpation',
            'normal' => 'Firm and uniform consistency, and no palpable lumps or masses; thin elastic nipple',
            'abnormal' => [
                'Mass', 'Tenderness', 'Thickened nonelastic nipple', 'Nipple discharge upon compression', 'Other'
            ],
        ],
        [
            'category' => 'Inspection (Skin)',
            'normal' => 'Smooth even skin color with no swelling, lumps or rashes',
            'abnormal' => [
                'Unusual pigmentation', 'Lesions', 'Other'
            ],
        ],
    ];
    $existingBreastAxillae = $existingBreastAxillae ?? $breastAxillaeData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">BREAST & AXILLAE</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalBreastAxillae">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalBreastAxillae">
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
                                @foreach($breastAxillaeCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-breastaxillae-checkbox" type="checkbox" name="breast_axillae[{{ $i }}][normal]" id="normal_breastaxillae_{{ $i }}" value="1" {{ (isset($existingBreastAxillae[$i]['normal']) && $existingBreastAxillae[$i]['normal'] == '1') ? 'checked' : (empty($existingBreastAxillae) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_breastaxillae_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-breastaxillae-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-breastaxillae-checkbox" type="checkbox" name="breast_axillae[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_breastaxillae_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingBreastAxillae[$i]['abnormal'][$abnormal]) && $existingBreastAxillae[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_breastaxillae_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-breastaxillae-other-input" name="breast_axillae[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingBreastAxillae[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-breastaxillae-detail-input" name="breast_axillae[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingBreastAxillae[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-breastaxillae-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-breastaxillae-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-breastaxillae-checkbox').each(function() {
            var input = $(this).closest('.abnormal-breastaxillae-checkbox-group').find('.abnormal-breastaxillae-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Breast & Axillae
    $('.abnormal-breastaxillae-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-breastaxillae-checkbox-group').find('.abnormal-breastaxillae-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-breastaxillae-other-input').show();

    // Check All Normal functionality for Breast & Axillae (now a button)
    $('#checkAllNormalBreastAxillae').on('click', function() {
        $('.normal-breastaxillae-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Breast & Axillae
    $('#uncheckAllNormalBreastAxillae').on('click', function() {
        $('.normal-breastaxillae-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



