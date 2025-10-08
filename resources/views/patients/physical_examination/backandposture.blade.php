@php
    $backPostureCategories = [
        [
            'category' => 'Spinal Alignment',
            'normal' => 'Midline and nontender',
            'abnormal' => ['Lateral deviation', 'Excessive curvature', 'Straightening', 'Tender', 'Other'],
        ],
        [
            'category' => 'Skin & Paraspinal muscles',
            'normal' => 'Intact skin with symmetrical tone of muscles',
            'abnormal' => ['Scars', 'Asymmetrical shoulders', 'Lesions', 'Other'],
        ],
    ];
    $existingBackPosture = $existingBackPosture ?? $backPostureData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">BACK & POSTURE Examination</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalBackPosture">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalBackPosture">
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
                                @foreach($backPostureCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-backposture-checkbox" type="checkbox" name="back_posture[{{ $i }}][normal]" id="normal_backposture_{{ $i }}" value="1" {{ (isset($existingBackPosture[$i]['normal']) && $existingBackPosture[$i]['normal'] == '1') ? 'checked' : (empty($existingBackPosture) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_backposture_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-backposture-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-backposture-checkbox" type="checkbox" name="back_posture[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_backposture_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingBackPosture[$i]['abnormal'][$abnormal]) && $existingBackPosture[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_backposture_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-backposture-other-input" name="back_posture[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingBackPosture[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-backposture-detail-input" name="back_posture[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingBackPosture[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-backposture-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-backposture-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-backposture-checkbox').each(function() {
            var input = $(this).closest('.abnormal-backposture-checkbox-group').find('.abnormal-backposture-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Back & Posture
    $('.abnormal-backposture-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-backposture-checkbox-group').find('.abnormal-backposture-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-backposture-other-input').show();

    // Check All Normal functionality for Back & Posture (now a button)
    $('#checkAllNormalBackPosture').on('click', function() {
        $('.normal-backposture-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Back & Posture
    $('#uncheckAllNormalBackPosture').on('click', function() {
        $('.normal-backposture-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



