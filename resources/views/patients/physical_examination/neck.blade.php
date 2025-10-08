@php
    $neckCategories = [
        [
            'category' => 'NECK',
            'normal' => 'No visible pulsations and masses',
            'abnormal' => ['Visible pulsations', 'Mass', 'Other'],
        ],
        [
            'category' => 'Cervical lymph nodes',
            'normal' => 'Non-palpable, nontender',
            'abnormal' => ['Enlarged', 'Tender', 'Round', 'Irregular', 'Fixed', 'Other'],
        ],
        [
            'category' => 'Trachea',
            'normal' => 'Midline, with loud, high-pitched tubular tracheal sounds',
            'abnormal' => ['Deviated', 'Stridor', 'Wheezing', 'Other'],
        ],
        [
            'category' => 'Thyroid Gland',
            'normal' => 'Soft, smooth, symmetrical, nontender, and moves slightly upward with swallowing',
            'abnormal' => ['Visible nodular mass(es)', 'Nodules upon palpation', 'Thrills', 'Bruit', 'Tender', 'Other'],
        ],
        [
            'category' => 'Breathing effort',
            'normal' => 'Effortless breathing',
            'abnormal' => [
                'Use of accessory muscles during inspiration (SCM, scalene, supraclavicular retraction)',
                'Use of neck accessory muscles during expiration (intercostal or abdominal oblique muscles)',
                'Other'
            ],
        ],
    ];
    $existingNeck = $existingNeck ?? $neckData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">NECK Examination</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalNeck">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalNeck">
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
                                @foreach($neckCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-neck-checkbox" type="checkbox" name="neck[{{ $i }}][normal]" id="normal_neck_{{ $i }}" value="1" {{ (isset($existingNeck[$i]['normal']) && $existingNeck[$i]['normal'] == '1') ? 'checked' : (empty($existingNeck) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_neck_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-neck-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-neck-checkbox" type="checkbox" name="neck[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_neck_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingNeck[$i]['abnormal'][$abnormal]) && $existingNeck[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_neck_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-neck-other-input" name="neck[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingNeck[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-neck-detail-input" name="neck[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingNeck[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-neck-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-neck-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-neck-checkbox').each(function() {
            var input = $(this).closest('.abnormal-neck-checkbox-group').find('.abnormal-neck-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Neck
    $('.abnormal-neck-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-neck-checkbox-group').find('.abnormal-neck-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-neck-other-input').show();

    // Check All Normal functionality for Neck (now a button)
    $('#checkAllNormalNeck').on('click', function() {
        $('.normal-neck-checkbox').prop('checked', true);
        // Trigger autosave
        $('.normal-neck-checkbox').first().trigger('change');
    });

    // Uncheck All Normal functionality for Neck
    $('#uncheckAllNormalNeck').on('click', function() {
        $('.normal-neck-checkbox').prop('checked', false);
        // Trigger autosave
        $('.normal-neck-checkbox').first().trigger('change');
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



