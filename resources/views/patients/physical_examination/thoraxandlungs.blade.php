@php
    $thoraxLungsCategories = [
        [
            'category' => 'POSTERIOR THORAX & LUNGS',
            'normal' => 'Quiet, unlabored and regular breathing',
            'abnormal' => [
                'Labored breathing', 'Delayed expiration', 'Irregular rhythm', 'Intercostal retraction (lower intercostal spaces)', 'Use of accessory muscles during expiration (intercostal or abdominal oblique muscles)', 'Unilateral lag or delay', 'Other'
            ],
        ],
        [
            'category' => 'Inspection',
            'normal' => 'Anteroposterior diameter < transverse diameter with normal contour',
            'abnormal' => ['Barrel chest', 'Pectus excavatum', 'Pectus carinatum', 'Sinus tracts', 'Other'],
        ],
        [
            'category' => 'Palpation',
            'normal' => 'Nontender, Equal and adequate chest expansion (2-5 inches)',
            'abnormal' => ['Unilateral decrease/delay in chest expansion', 'Shallow breathing', 'Tender', 'Other'],
        ],
        [
            'category' => '',
            'normal' => 'Equal tactile fremitus',
            'abnormal' => ['Asymmetric increased tactile fremitus', 'Asymmetric decreased tactile fremitus', 'Absent tactile fremitus', 'Other'],
        ],
        [
            'category' => '',
            'normal' => 'Nontender',
            'abnormal' => ['Intercostal tenderness', 'Crepitus', 'Bony step-offs', 'Other'],
        ],
        [
            'category' => 'Percussion',
            'normal' => 'Resonant',
            'abnormal' => ['Dull', 'Hyperresonant', 'Tympanitic', 'Flat', 'Other'],
        ],
        [
            'category' => 'Auscultation',
            'normal' => 'Vesicular',
            'abnormal' => ['Bronchial sounds heard in the periphery', 'Decreased', 'Absent','Crackles (fine/coarse)', 'Wheeze (inspiratory/expiratory)', 'Ronchi', 'Pleural friction rub', 'Stridor', 'Other'],
        ],
        [
            'category' => 'Transmitted voice sounds',
            'normal' => 'Absent',
            'abnormal' => ['Bronchophony (louder)', 'Egophony (ee to A)', 'Whispered pectoriloquy (louder)', 'Other'],
        ],
    ];
    $existingThoraxLungs = $existingThoraxLungs ?? $thoraxLungsData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fa-solid fa-lungs me-2"></i>POSTERIOR THORAX & LUNGS Examination
                        </h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalThoraxLungs">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalThoraxLungs">
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
                                @foreach($thoraxLungsCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-thoraxlungs-checkbox" type="checkbox" name="thorax_lungs[{{ $i }}][normal]" id="normal_thoraxlungs_{{ $i }}" value="1" {{ (isset($existingThoraxLungs[$i]['normal']) && $existingThoraxLungs[$i]['normal'] == '1') ? 'checked' : (empty($existingThoraxLungs) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_thoraxlungs_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-thoraxlungs-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-thoraxlungs-checkbox" type="checkbox" name="thorax_lungs[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_thoraxlungs_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingThoraxLungs[$i]['abnormal'][$abnormal]) && $existingThoraxLungs[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_thoraxlungs_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-thoraxlungs-other-input" name="thorax_lungs[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingThoraxLungs[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-thoraxlungs-detail-input" name="thorax_lungs[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingThoraxLungs[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-thoraxlungs-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-thoraxlungs-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-thoraxlungs-checkbox').each(function() {
            var input = $(this).closest('.abnormal-thoraxlungs-checkbox-group').find('.abnormal-thoraxlungs-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Thorax & Lungs
    $('.abnormal-thoraxlungs-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-thoraxlungs-checkbox-group').find('.abnormal-thoraxlungs-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-thoraxlungs-other-input').show();

    // Check All Normal functionality for Thorax & Lungs (now a button)
    $('#checkAllNormalThoraxLungs').on('click', function() {
        $('.normal-thoraxlungs-checkbox').prop('checked', true);
        // Trigger autosave
        $('.normal-thoraxlungs-checkbox').first().trigger('change');
    });

    // Uncheck All Normal functionality for Thorax & Lungs
    $('#uncheckAllNormalThoraxLungs').on('click', function() {
        $('.normal-thoraxlungs-checkbox').prop('checked', false);
        // Trigger autosave
        $('.normal-thoraxlungs-checkbox').first().trigger('change');
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



