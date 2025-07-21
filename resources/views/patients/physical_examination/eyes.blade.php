@php
    $eyesCategories = [
        [
            'category' => 'External Eye Exam',
            'normal' => 'Symmetrical eye position and alignment',
            'abnormal' => ['Sundown eyes', 'Strabismus', 'Other'],
        ],
        [
            'category' => 'Eyelids',
            'normal' => 'No inflammation, injury, or crusting',
            'abnormal' => ['Ptosis', 'Swelling', 'Discharge', 'Other'],
        ],
        [
            'category' => 'Palpebral Conjunctiva',
            'normal' => 'Pink',
            'abnormal' => ['Red', 'Discharge', 'Other'],
        ],
        [
            'category' => 'Bulbar Conjunctiva',
            'normal' => 'Clear',
            'abnormal' => ['Injected', 'Other'],
        ],
        [
            'category' => 'Sclera',
            'normal' => 'White',
            'abnormal' => ['Icteric', 'Red', 'Other'],
        ],
        [
            'category' => 'Cornea',
            'normal' => 'Clear & no crescentic shadow',
            'abnormal' => ['Opaque', 'Crescentic shadow', 'Other'],
        ],
        [
            'category' => 'Iris',
            'normal' => 'Intact, symmetrical color, and center',
            'abnormal' => ['Aniridia', 'Notched', 'Heterochromia', 'Corectopia', 'Other'],
        ],
        [
            'category' => 'Pupil Assessment',
            'normal' => 'Pupils equal, round, and reactive to light and accommodation (PERRLA)',
            'abnormal' => ['Anisocoria', 'Mydriasis', 'Miosis', 'Irregular', 'Other'],
        ],
        [
            'category' => 'Visual Screening',
            'normal' => '20/20 visual acuity & grossly intact visual fields',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'Eye Movements',
            'normal' => 'Full range of extraocular movements',
            'abnormal' => ['Nystagmus', 'Lid lag', 'Other'],
        ],
        [
            'category' => 'Ophthalmoscopy - Fundus',
            'normal' => 'Present red reflex',
            'abnormal' => ['Leukocoria', 'Dim reflex', 'Other'],
        ],
        [
            'category' => 'Ophthalmoscopy - Optic Disc',
            'normal' => 'Clear disc margins',
            'abnormal' => ['Blurred disc margins', 'Large cup-to-disc ratio (>0.6)', 'Pale disc', 'Other'],
        ],
        [
            'category' => 'Ophthalmoscopy - Retinal Vessels',
            'normal' => 'Vessels visible with normal arteriovenous (AV) ratio',
            'abnormal' => ['AV silver wiring', 'Retinal exudates', 'Retinal hemorrhages', 'Neovascularization', 'Microaneurysms', 'Other'],
        ],
        [
            'category' => 'Ophthalmoscopy - Macula',
            'normal' => 'Flat round yellow-orange with no vessels around',
            'abnormal' => ['Mottling or drusen', 'Cherry-red spot', 'Edema', 'Distortion', 'Exudates', 'Other'],
        ],
    ];
    $existingEyes = $existingEyes ?? $eyesData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">EYES Examination</h6>
                    </div>
                </div>
                <div class="card-body py-2">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 30%">Category</th>
                                    <th style="width: 35%">
                                        Normal
                                        <div class="form-check d-inline-block ms-2">
                                            <input class="form-check-input" type="checkbox" id="checkAllNormalEyes">
                                            <label class="form-check-label small" for="checkAllNormalEyes">Check All</label>
                                        </div>
                                    </th>
                                    <th style="width: 35%">Abnormal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eyesCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-eyes-checkbox" type="checkbox" name="eyes[{{ $i }}][normal]" id="normal_eyes_{{ $i }}" value="1" {{ (isset($existingEyes[$i]['normal']) && $existingEyes[$i]['normal']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="normal_eyes_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-eyes-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-eyes-checkbox" type="checkbox" name="eyes[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_eyes_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingEyes[$i]['abnormal'][$abnormal]) && $existingEyes[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_eyes_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-eyes-other-input" name="eyes[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingEyes[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-eyes-detail-input" name="eyes[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingEyes[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-eyes-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-eyes-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-eyes-checkbox').each(function() {
            var input = $(this).closest('.abnormal-eyes-checkbox-group').find('.abnormal-eyes-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Eyes
    $('.abnormal-eyes-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-eyes-checkbox-group').find('.abnormal-eyes-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-eyes-other-input').show();

    // Check All Normal functionality for Eyes
    $('#checkAllNormalEyes').on('change', function() {
        var checked = $(this).is(':checked');
        $('.normal-eyes-checkbox').prop('checked', checked);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>
