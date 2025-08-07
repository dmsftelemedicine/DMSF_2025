@php
    $generalSurveyCategories = [
        [
            'category' => 'Demeanor and Body Habitus',
            'normal' => 'Calm with well developed and well-nourished built',
            'abnormal' => [
                'Restless / Agitated',
                'Physical maturity problems',
                'Ill-looking',
                'Cachectic',
                'Obese',
                'Poor hygiene and grooming',
                'Unusual body or breath odor',
                'Other',
            ],
        ],
        [
            'category' => 'Breathing',
            'normal' => 'Breathing regularly',
            'abnormal' => [
                'Dyspneic',
                'Other',
            ],
        ],
        [
            'category' => 'Level of Alertness',
            'normal' => 'Alert and oriented to person, place, time, and situation',
            'abnormal' => [
                'Drowsy',
                'Disoriented',
                'Confused',
                'Unresponsive',
                'Other',
            ],
        ],
        [
            'category' => 'Posture',
            'normal' => 'Erect, ambulating with ease',
            'abnormal' => [
                'Hunched',
                'Tripod positioning',
                'Involuntary movements',
                'Tremors',
                'Limping',
                'Unsteadiness or movement difficulties',
                'With assistive devices (cane, walker, crutches)',
                'Other',
            ],
        ],
    ];
    $existingGeneralSurvey = $existingGeneralSurvey ?? $generalSurveyData ?? [];
@endphp

<div class="card h-100">
    <div class="card-header bg-light py-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <i class="fa-solid fa-person me-2"></i>General Survey
            </h6>
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
                                <input class="form-check-input" type="checkbox" id="checkAllNormal">
                                <label class="form-check-label small" for="checkAllNormal">Check All</label>
                            </div>
                        </th>
                        <th style="width: 35%">Abnormal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($generalSurveyCategories as $i => $item)
                        <tr>
                            <td><strong>{{ $item['category'] }}</strong></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input normal-general-checkbox" type="checkbox" name="general_survey[{{ $i }}][normal]" id="normal_{{ $i }}" value="1" {{ (isset($existingGeneralSurvey[$i]['normal']) && $existingGeneralSurvey[$i]['normal']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="normal_{{ $i }}">
                                        {{ $item['normal'] }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                @if(isset($item['abnormal']) && is_array($item['abnormal']))
                                    <div class="row">
                                        @foreach($item['abnormal'] as $j => $abnormal)
                                            <div class="col-12 mb-1 abnormal-checkbox-group">
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input abnormal-checkbox" type="checkbox" name="general_survey[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingGeneralSurvey[$i]['abnormal'][$abnormal]) && $existingGeneralSurvey[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2" for="abnormal_{{ $i }}_{{ $j }}">
                                                        {{ $abnormal }}
                                                        @if($abnormal === 'Restless / Agitated')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Anxiety, pain, delirium, stimulant intoxication" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Physical maturity problems')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Endocrine disorders (e.g., hypopituitarism, precocious puberty), genetic syndromes" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Ill-looking')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Infection, anemia, malignancy, cachexia, systemic illness" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Cachectic')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Infection, anemia, malignancy, cachexia, systemic illness" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Obese')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Excessive body fat that may impair health" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Poor hygiene and grooming')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Depression, schizophrenia, dementia, cognitive decline, neglect" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Unusual body or breath odor')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Uremia (urine odor), diabetic ketoacidosis (fruity/sweet), hepatic failure (musty), poor hygiene" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Dyspneic')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Heart failure, asthma, COPD, pneumonia, pulmonary embolism" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Hunched')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Kyphosis, osteoporosis, Parkinson's disease, depressive disorders" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Tripod positioning')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Severe respiratory distress, COPD exacerbation, asthma attack" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Involuntary movements')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Parkinson's disease, chorea (Huntington's), dystonia, medication side effects (e.g., tardive dyskinesia)" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Tremors')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Essential tremor, Parkinson's disease, hyperthyroidism, drug withdrawal" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Limping')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Musculoskeletal injury, arthritis, leg length discrepancy, neurological disorder" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @elseif($abnormal === 'Unsteadiness or movement difficulties')
                                                            <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Stroke, Parkinson's, neuropathy, musculoskeletal disorders; Vertigo" style="cursor:pointer;">
                                                                <i class="fas fa-info-circle text-info ms-1"></i>
                                                            </span>
                                                        @endif
                                                    </label>
                                                </div>
                                                @if($abnormal === 'Other')
                                                    <input type="text" class="form-control mt-1 abnormal-other-input" name="general_survey[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingGeneralSurvey[$i]['abnormal_other'] ?? '' }}">
                                                @else
                                                    <input type="text" class="form-control mt-1 abnormal-detail-input" name="general_survey[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingGeneralSurvey[$i]['abnormal_detail'][$abnormal] ?? '' }}">
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="general_survey[{{ $i }}][abnormal]" id="abnormal_{{ $i }}" value="1">
                                        <label class="form-check-label" for="abnormal_{{ $i }}">
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
.abnormal-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-checkbox').each(function() {
            var input = $(this).closest('.abnormal-checkbox-group').find('.abnormal-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Demeanor and Body Habitus
    $('.abnormal-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-checkbox-group').find('.abnormal-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-other-input').show();

    // Check All Normal functionality
    $('#checkAllNormal').on('change', function() {
        var checked = $(this).is(':checked');
        $('.normal-general-checkbox').prop('checked', checked);
    });

    // Enable Bootstrap tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>
