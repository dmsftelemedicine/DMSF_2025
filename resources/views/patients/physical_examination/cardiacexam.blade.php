@php
    $cardiacExamCategories = [
        [
            'category' => 'Inspection',
            'normal' => 'JVP <3cm above sternal angle; adynamic precordium',
            'abnormal' => ['Visible heaves', 'Precordial bulge', 'Increased JVP', 'Other'],
        ],
        [
            'category' => 'Palpation',
            'normal' => 'Nontender, PMI is at the 5th ICS MCL nondisplaced nonsustained with light tapping sensation <2.5cm; no heaves nor thrills',
            'abnormal' => ['Heaves', 'Thrills', 'PMI displaced laterally', 'Sustained or forceful PMI', 'Undetected apical impulse','Diffuse PMI (>3cm)','Sustained left parasternal movement beginning at S1', 'Other'],
        ],
        [
            'category' => 'Auscultation',
            'normal' => 'Clear and distinct S1 and S2 with physiologic splitting of S2 at right 2nd ICS parasternal area; regular rate and rhythm',
            'abnormal' => ['Murmurs (systolic/diastolic, location, grade, pitch, quality)', 'Pericardial rub', 'Irregular rhythm', 'Presence of S3', 'Presence of S4','Diminished S1 sounds','Diminished S2 sounds', 'Other'],
        ],
    ];
    $existingCardiacExam = $existingCardiacExam ?? $cardiacExamData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">CARDIAC EXAM</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalCardiacExam">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalCardiacExam">
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
                                @foreach($cardiacExamCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-cardiacexam-checkbox" type="checkbox" name="cardiac_exam[{{ $i }}][normal]" id="normal_cardiacexam_{{ $i }}" value="1" {{ (isset($existingCardiacExam[$i]['normal']) && $existingCardiacExam[$i]['normal'] == '1') ? 'checked' : (empty($existingCardiacExam) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_cardiacexam_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-cardiacexam-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-cardiacexam-checkbox" type="checkbox" name="cardiac_exam[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_cardiacexam_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingCardiacExam[$i]['abnormal'][$abnormal]) && $existingCardiacExam[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_cardiacexam_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-cardiacexam-other-input" name="cardiac_exam[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingCardiacExam[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-cardiacexam-detail-input" name="cardiac_exam[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingCardiacExam[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-cardiacexam-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-cardiacexam-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-cardiacexam-checkbox').each(function() {
            var input = $(this).closest('.abnormal-cardiacexam-checkbox-group').find('.abnormal-cardiacexam-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Cardiac Exam
    $('.abnormal-cardiacexam-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-cardiacexam-checkbox-group').find('.abnormal-cardiacexam-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-cardiacexam-other-input').show();

    // Check All Normal functionality for Cardiac Exam (now a button)
    $('#checkAllNormalCardiacExam').on('click', function() {
        $('.normal-cardiacexam-checkbox').prop('checked', true);
        // Trigger autosave
        $('.normal-cardiacexam-checkbox').first().trigger('change');
    });

    // Uncheck All Normal functionality for Cardiac Exam
    $('#uncheckAllNormalCardiacExam').on('click', function() {
        $('.normal-cardiacexam-checkbox').prop('checked', false);
        // Trigger autosave
        $('.normal-cardiacexam-checkbox').first().trigger('change');
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



