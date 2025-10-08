@php
    $skinHairNormalValues = [
        [
            'normal' => 'Even skin tone',
            'abnormal' => [
                'Hyperpigmentation',
                'Hypopigmentation',
                'Pallor',
                'Jaundice',
                'Cyanosis',
                'Other',
            ],
        ],
        [
            'normal' => 'Generally clear skin',
            'abnormal' => [
                'Rashes',
                'Erythema',
                'Other lesions',
                'Other',
            ],
        ],
        [
            'normal' => 'Normal skin turgor & elasticity',
            'abnormal' => [
                'Poor skin turgor/ Delayed recoil',
                'Very Loose or Doughy Skin',
                'Decreased skin mobility',
                'Other',
            ],
        ],
        [
            'normal' => 'Warm to touch, moisturized',
            'abnormal' => [
                'Hot',
                'Asymmetrical temperature',
                'Diaphoresis',
                'Sweaty/clammy',
                'Dry',
                'Other',
            ],
        ],
        [
            'normal' => 'Normal hair distribution & texture',
            'abnormal' => [
                'Alopecia',
                'Hirsutism',
                'Dandruff',
                'Infestations',
                'Brittle',
                'Other',
            ],
        ],
    ];
    $existingSkinHair = $existingSkinHair ?? $skinHairData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
            <div class="col-md-12 mb-3">
                <div class="card h-100">
                    <div class="card-header bg-light py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Skin/Hair Examination</h6>
                            <div>
                                <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalSkin">
                                    <i class="fas fa-check-double me-1"></i>Check All Normal
                                </button>
                                <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalSkin">
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
                                    @foreach($skinHairNormalValues as $i => $item)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input normal-skin-checkbox" type="checkbox" name="skin_hair[{{ $i }}][normal]" id="normal_skin_{{ $i }}" value="1" {{ (isset($existingSkinHair[$i]['normal']) && $existingSkinHair[$i]['normal'] == '1') ? 'checked' : (empty($existingSkinHair) ? 'checked' : '') }}>
                                                    <label class="form-check-label" for="normal_skin_{{ $i }}">
                                                        {{ $item['normal'] }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-skin-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-skin-checkbox" type="checkbox" name="skin_hair[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_skin_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingSkinHair[$i]['abnormal'][$abnormal]) && $existingSkinHair[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_skin_{{ $i }}_{{ $j }}">
                                                                    {{ $abnormal }}
                                                                    @if($abnormal === 'Poor skin turgor/ Delayed recoil')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dehydration, volume depletion, severe malnutrition" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Very Loose or Doughy Skin')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Aging, Ehlers-Danlos syndrome, Cutix Laxa" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Decreased skin mobility')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Scleroderma, Edema, Burns or scarring" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Brittle')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Thyroid Problem" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-skin-other-input" name="skin_hair[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingSkinHair[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-skin-detail-input" name="skin_hair[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingSkinHair[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-skin-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-skin-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-skin-checkbox').each(function() {
            var input = $(this).closest('.abnormal-skin-checkbox-group').find('.abnormal-skin-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Skin/Hair
    $('.abnormal-skin-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-skin-checkbox-group').find('.abnormal-skin-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-skin-other-input').show();

    // Check All Normal functionality for Skin/Hair (now a button)
    $('#checkAllNormalSkin').on('click', function() {
        $('.normal-skin-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Skin/Hair
    $('#uncheckAllNormalSkin').on('click', function() {
        $('.normal-skin-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();

    // Enable Bootstrap tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
