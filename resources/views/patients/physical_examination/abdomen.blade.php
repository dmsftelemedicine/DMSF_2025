@php
    $abdomenCategories = [
        [
            'category' => 'ABDOMEN',
            'normal' => 'Relaxed, non-distended, symmetrical contour',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'Inspection',
            'normal' => 'Flat/slightly flabby, symmetric, even skin tone, no visible peristalsis with midline nonherniated umbilicus',
            'abnormal' => ['Distended/rounded/protuberant', 'Scaphoid abdomen', 'Asymmetry', 'Visible peristalsis', 'Lesions (scars, striae, dilated veins, ecchymosis)','Hernia/ed umbilicus', 'Bulging flanks', 'Suprapubic bulge', 'Local bulge', 'Pulsations', 'Other'],
        ],
        [
            'category' => 'Auscultation',
            'normal' => '5-34 bowel sounds per minute and no bruits',
            'abnormal' => ['Hyperactive sounds', 'Hypoactive/Absent sounds', 'Bruits (location)', 'Other'],
        ],
        [
            'category' => 'Percussion',
            'normal' => 'Alternating tympany and dullness',
            'abnormal' => ['Diffuse Tympany', 'Large dull areas', 'Costovertebral tenderness with fist percussion (Kidney punch sign)', 'Shifting dullness', 'Other'],
        ],
        [
            'category' => 'Palpation',
            'normal' => 'Nontender, no to minimal pulsations, negative abdominal maneuvers, intact reflexes',
            'abnormal' => ['Guarding', 'Mass', 'Tender', 'Pulsations', 'Rigidity','RLQ Direct tenderness/Mcburney point tenderness','Rebound tenderness', 'Indirect tenderness (Rovsing sign)', '(+) psoas sign', '(+) obturator sign', 'Other'],
        ],
        [
            'category' => '',
            'normal' => 'Normal liver and spleen size',
            'abnormal' => ['Liver enlargement (below the ribs)', 'Spleen enlargement (percussion dullness on deep inspiration)', 'Urinary bladder distention / tenderness', '(+) murphy sign', 'Other'],
        ],
    ];
    $existingAbdomen = $existingAbdomen ?? $abdomenData ?? [];
@endphp

<div class="card h-100">
    <div class="card-header bg-light py-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">ABDOMEN</h6>
            <div>
                <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalAbdomen">
                    <i class="fas fa-check-double me-1"></i>Check All Normal
                </button>
                <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalAbdomen">
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
                    @foreach($abdomenCategories as $i => $item)
                        <tr>
                            <td><strong>{{ $item['category'] }}</strong></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input normal-abdomen-checkbox" type="checkbox" name="abdomen[{{ $i }}][normal]" id="normal_abdomen_{{ $i }}" value="1" {{ (isset($existingAbdomen[$i]['normal']) && $existingAbdomen[$i]['normal'] == '1') ? 'checked' : (empty($existingAbdomen) ? 'checked' : '') }}>
                                    <label class="form-check-label" for="normal_abdomen_{{ $i }}">
                                        {{ $item['normal'] }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                    <div class="row">
                                        @foreach($item['abnormal'] as $j => $abnormal)
                                            <div class="col-12 mb-1 abnormal-abdomen-checkbox-group">
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input abnormal-abdomen-checkbox" type="checkbox" name="abdomen[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_abdomen_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingAbdomen[$i]['abnormal'][$abnormal]) && $existingAbdomen[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2" for="abnormal_abdomen_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                </div>
                                                @if($abnormal === 'Other')
                                                    <input type="text" class="form-control mt-1 abnormal-abdomen-other-input" name="abdomen[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingAbdomen[$i]['abnormal_other'] ?? '' }}">
                                                @else
                                                    <input type="text" class="form-control mt-1 abnormal-abdomen-detail-input" name="abdomen[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingAbdomen[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-abdomen-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-abdomen-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-abdomen-checkbox').each(function() {
            var input = $(this).closest('.abnormal-abdomen-checkbox-group').find('.abnormal-abdomen-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Abdomen
    $('.abnormal-abdomen-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-abdomen-checkbox-group').find('.abnormal-abdomen-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-abdomen-other-input').show();

    // Check All Normal functionality for Abdomen (now a button)
    $('#checkAllNormalAbdomen').on('click', function() {
        $('.normal-abdomen-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Abdomen
    $('#uncheckAllNormalAbdomen').on('click', function() {
        $('.normal-abdomen-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



