@php
    $headCategories = [
        [
            'category' => 'Head',
            'normal' => 'Normal skull shape & contour',
            'abnormal' => [
                'Macrocephaly',
                'Microcephaly',
                'Flattening (plagiocephaly), bulges, or depression',
                'Frontal Bossing',
                'Sunken or Bulging Fontanelle (infants)',
                'Other',
            ],
        ],
        [
            'category' => 'Scalp',
            'normal' => 'No visible masses, swelling, lesions, scaliness/flakiness or pulsations; nontender',
            'abnormal' => [
                'Lumps or Swellings',
                'Lesions or ulcers',
                'Scalp Scaling or Flaking',
                'Tenderness',
                'Visible Pulsations',
                'Other',
            ],
        ],
        [
            'category' => 'Hair',
            'normal' => 'Even distribution across the scalp, appropriate color for the individual\'s ethnicity, no infestations, and a smooth, healthy texture',
            'abnormal' => [
                'Patchy hair loss',
                'Diffuse hair loss',
                'Lice or nits',
                'Other',
            ],
        ],
    ];
    $existingHead = $existingHead ?? $headData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Head Examination</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalHead">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalHead">
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
                                @foreach($headCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-head-checkbox" type="checkbox" name="head[{{ $i }}][normal]" id="normal_head_{{ $i }}" value="1" {{ (isset($existingHead[$i]['normal']) && $existingHead[$i]['normal'] == '1') ? 'checked' : (empty($existingHead) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_head_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-head-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-head-checkbox" type="checkbox" name="head[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_head_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingHead[$i]['abnormal'][$abnormal]) && $existingHead[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_head_{{ $i }}_{{ $j }}">
                                                                    {{ $abnormal }}
                                                                    @if($abnormal === 'Flattening (plagiocephaly), bulges, or depression')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="trauma, craniosynostosis, or postural effects in infants" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Frontal Bossing')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="rickets, thalassemia, or congenital conditions" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Sunken or Bulging Fontanelle (infants)')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Sunken: dehydration; Bulging: increased intracranial pressure (e.g., meningitis)" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Lumps or Swellings')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Lipoma, sebaceous cyst, hematoma (e.g., cephalohematoma in newborns)" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Lesions or ulcers')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="skin infections, malignancy, or autoimmune disease" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Scalp Scaling or Flaking')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dandruff, seborrheic dermatitis, psoriasis, tinea capitis" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Tenderness')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="trauma, scalp infections, temporal arteritis" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Visible Pulsations')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="intracranial pressure (ICP) or vascular abnormality" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Patchy hair loss')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="alopecia areata, tinea capitis" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @elseif($abnormal === 'Diffuse hair loss')
                                                                        <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="telogen effluvium, androgenic alopecia" style="cursor:pointer;">
                                                                            <i class="fas fa-info-circle text-info ms-1"></i>
                                                                        </span>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-head-other-input" name="head[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingHead[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-head-detail-input" name="head[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingHead[$i]['abnormal_detail'][$abnormal] ?? '' }}">
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="head[{{ $i }}][abnormal]" id="abnormal_head_{{ $i }}" value="1">
                                                    <label class="form-check-label" for="abnormal_head_{{ $i }}">
                                                        <span class="text-muted">(Describe abnormal findings)</span>
                                                    </label>
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
.abnormal-head-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-head-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-head-checkbox').each(function() {
            var input = $(this).closest('.abnormal-head-checkbox-group').find('.abnormal-head-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Head
    $('.abnormal-head-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-head-checkbox-group').find('.abnormal-head-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-head-other-input').show();

    // Check All Normal functionality for Head (now a button)
    $('#checkAllNormalHead').on('click', function() {
        $('.normal-head-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Head
    $('#uncheckAllNormalHead').on('click', function() {
        $('.normal-head-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();

    // Enable Bootstrap tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>

