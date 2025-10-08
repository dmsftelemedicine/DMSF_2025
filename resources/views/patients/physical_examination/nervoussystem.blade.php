@php
    $nervousSystemCategories = [
        [
            'category' => 'Level of Alertness',
            'normal' => '(See General Survey)',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'Language - Fluency',
            'normal' => 'Speaks fluently with appropriate rate and articulation',
            'abnormal' => ['Hesitant', 'Slurred', 'Effortful', 'Nonfluent speech', 'Other'],
        ],
        [
            'category' => 'Language - Comprehension',
            'normal' => 'Understands simple and complex instructions',
            'abnormal' => ['Difficulty following verbal commands', 'Difficulty following written commands', 'Other'],
        ],
        [
            'category' => 'Language - Repetition',
            'normal' => 'Repeats simple phrases correctly',
            'abnormal' => ['Unable to repeat short sentences or phrases', 'Other'],
        ],
        [
            'category' => 'Language - Naming',
            'normal' => 'Can name familiar objects easily',
            'abnormal' => ['Difficulty naming objects (anomia)', 'Other'],
        ],
        [
            'category' => 'Memory - Short-term',
            'normal' => 'Remembers 3 objects after 5 minutes',
            'abnormal' => ['Forgets objects after delay or asks for prompts', 'Other'],
        ],
        [
            'category' => 'Memory - Long-term',
            'normal' => 'Recalls personal and historical facts accurately',
            'abnormal' => ['Forgetful of significant personal or historical events', 'Other'],
        ],
        [
            'category' => 'Calculation',
            'normal' => 'Performs simple math (e.g., 100–7 or 20+5) correctly',
            'abnormal' => ['Makes frequent or major errors with basic arithmetic', 'Other'],
        ],
        [
            'category' => 'Visuospatial Processing',
            'normal' => 'Accurately copies shapes or draws clock with proper spacing and time',
            'abnormal' => ['Misplaces numbers', "Can't draw shapes symmetrically", 'Other'],
        ],
        [
            'category' => 'Abstract Reasoning',
            'normal' => 'Interprets proverbs or identifies similarities logically',
            'abnormal' => ['Gives literal or unrelated answers', 'Unable to identify similarities', 'Other'],
        ],
        [
            'category' => 'CN I',
            'normal' => '(See Nose section)',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'CN II, III, IV, VI',
            'normal' => '(See Eyes section)',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'CN V',
            'normal' => 'Strong and symmetrical temporal and masseter muscle contraction; Intact sensation in all facial regions',
            'abnormal' => ['Weak contraction on one side', 'Weak contraction on both sides', 'Asymmetrical muscle contraction', 'Loss or reduction of sensation', 'Paresthesia or altered sensation', 'Other'],
        ],
        [
            'category' => 'CN VII',
            'normal' => 'Symmetrical facial features, no abnormal movements',
            'abnormal' => ['Facial droop or asymmetry', 'Involuntary movements or tics', 'Incomplete closure or drooping of mouth', 'Other'],
        ],
        [
            'category' => 'CN VIII',
            'normal' => '(See Ear section)',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'CN IX, X',
            'normal' => '(See Throat Section)',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'CN V, VII, IX, X, XI, XII',
            'normal' => '(See Throat Section)',
            'abnormal' => ['Other'],
        ],
        [
            'category' => 'CN XI',
            'normal' => 'Symmetrical neck muscles strength against resistance',
            'abnormal' => ['Weakness or asymmetry in muscle strength', 'Inability to shrug or turn head properly', 'Other'],
        ],
    ];
    $existingNervousSystem = $existingNervousSystem ?? $nervousSystemData ?? [];
@endphp

<div class="card h-100">
    <div class="card-header bg-light py-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">NERVOUS SYSTEM</h6>
            <div>
                <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalNervousSystem">
                    <i class="fas fa-check-double me-1"></i>Check All Normal
                </button>
                <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalNervousSystem">
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
                    @foreach($nervousSystemCategories as $i => $item)
                        <tr>
                            <td><strong>{{ $item['category'] }}</strong></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input normal-nervoussystem-checkbox" type="checkbox" name="nervous_system[{{ $i }}][normal]" id="normal_nervoussystem_{{ $i }}" value="1" {{ (isset($existingNervousSystem[$i]['normal']) && $existingNervousSystem[$i]['normal'] == '1') ? 'checked' : (empty($existingNervousSystem) ? 'checked' : '') }}>
                                    <label class="form-check-label" for="normal_nervoussystem_{{ $i }}">
                                        {{ $item['normal'] }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                    <div class="row">
                                        @foreach($item['abnormal'] as $j => $abnormal)
                                            <div class="col-12 mb-1 abnormal-nervoussystem-checkbox-group">
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input abnormal-nervoussystem-checkbox" type="checkbox" name="nervous_system[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_nervoussystem_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingNervousSystem[$i]['abnormal'][$abnormal]) && $existingNervousSystem[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2" for="abnormal_nervoussystem_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                </div>
                                                @if($abnormal === 'Other')
                                                    <input type="text" class="form-control mt-1 abnormal-nervoussystem-other-input" name="nervous_system[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingNervousSystem[$i]['abnormal_other'] ?? '' }}">
                                                @else
                                                    <input type="text" class="form-control mt-1 abnormal-nervoussystem-detail-input" name="nervous_system[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingNervousSystem[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-nervoussystem-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-nervoussystem-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-nervoussystem-checkbox').each(function() {
            var input = $(this).closest('.abnormal-nervoussystem-checkbox-group').find('.abnormal-nervoussystem-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Nervous System
    $('.abnormal-nervoussystem-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-nervoussystem-checkbox-group').find('.abnormal-nervoussystem-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-nervoussystem-other-input').show();

    // Check All Normal functionality for Nervous System
    $('#checkAllNormalNervousSystem').on('click', function() {
        $('.normal-nervoussystem-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Nervous System
    $('#uncheckAllNormalNervousSystem').on('click', function() {
        $('.normal-nervoussystem-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>
