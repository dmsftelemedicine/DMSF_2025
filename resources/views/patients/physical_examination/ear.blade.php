@php
    $earCategories = [
        [
            'category' => 'EAR',
            'normal' => 'Symmetrical, no lesions, no discharge',
            'abnormal' => ['Asymmetry', 'Eczema', 'Other lesions', 'Discharge', 'Other'],
        ],
        [
            'category' => 'Auricle, Tragus, Mastoid Process',
            'normal' => 'Nontender auricle, tragus, and mastoid process',
            'abnormal' => ['Tender auricle', 'Tender tragus', 'Tender mastoid process', 'Other'],
        ],
        [
            'category' => 'Otoscopy - Ear Canal',
            'normal' => 'Clear and patent ear canal',
            'abnormal' => ['Impacted cerumen', 'Foreign body', 'Discharge', 'Other'],
        ],
        [
            'category' => 'Otoscopy - Tympanic Membrane',
            'normal' => 'Pearly gray, translucent, intact, neutral',
            'abnormal' => ['Erythematous', 'Yellowish or amber fluid-filled', 'Retracted', 'Bulging', 'Perforated', 'Other'],
        ],
        [
            'category' => 'Otoscopy - Cone of Light & Malleus',
            'normal' => 'Visible cone of light and malleus',
            'abnormal' => ['Not visualized', 'Other'],
        ],
        [
            'category' => 'Hearing',
            'normal' => 'Hears conversation well',
            'abnormal' => ['Reports difficulty hearing', 'Other'],
        ],
        [
            'category' => 'Whisper Test',
            'normal' => 'Correctly repeats the number-letter sequence',
            'abnormal' => ['Can only repeat the sequence with at a louder volume', 'Cannot repeat the sequence', 'Other'],
        ],
        [
            'category' => 'Tuning Fork Tests',
            'normal' => 'Air > Bone conduction & sound heard equally',
            'abnormal' => ['Air = Bone conduction', 'Air < Bone conduction', 'Lateralization', 'Other'],
        ],
    ];
    $existingEar = $existingEar ?? $earData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">EAR Examination</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalEar">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalEar">
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
                                @foreach($earCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-ear-checkbox" type="checkbox" name="ear[{{ $i }}][normal]" id="normal_ear_{{ $i }}" value="1" {{ (isset($existingEar[$i]['normal']) && $existingEar[$i]['normal'] == '1') ? 'checked' : (empty($existingEar) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_ear_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-ear-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-ear-checkbox" type="checkbox" name="ear[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_ear_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingEar[$i]['abnormal'][$abnormal]) && $existingEar[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_ear_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-ear-other-input" name="ear[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingEar[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-ear-detail-input" name="ear[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingEar[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-ear-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-ear-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-ear-checkbox').each(function() {
            var input = $(this).closest('.abnormal-ear-checkbox-group').find('.abnormal-ear-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Ear
    $('.abnormal-ear-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-ear-checkbox-group').find('.abnormal-ear-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-ear-other-input').show();

    // Check All Normal functionality for Ear (now a button)
    $('#checkAllNormalEar').on('click', function() {
        $('.normal-ear-checkbox').prop('checked', true);
        // Trigger autosave
        $('.normal-ear-checkbox').first().trigger('change');
    });

    // Uncheck All Normal functionality for Ear
    $('#uncheckAllNormalEar').on('click', function() {
        $('.normal-ear-checkbox').prop('checked', false);
        // Trigger autosave
        $('.normal-ear-checkbox').first().trigger('change');
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



