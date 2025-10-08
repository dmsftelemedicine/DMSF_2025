@php
    $femaleGenitaliaCategories = [
        [
            'category' => 'External Inspection',
            'normal' => 'Smooth and intact mons pubis, labia and perineum with no lesions, and sexual maturity appropriate to age',
            'abnormal' => ['Vulvar ulcers', 'Warts', 'Unusual discharge', 'Erythema', 'Other lesions or maturity problems', 'Other'],
        ],
        [
            'category' => 'Speculum Exam',
            'normal' => 'Cervix pink, smooth, no discharge; intact vaginal mucosa',
            'abnormal' => ['Cervical motion tenderness', 'Erythema', 'Purulent discharge', 'Visible lesions', 'Other'],
        ],
        [
            'category' => 'Bimanual Exam',
            'normal' => 'Uterus midline, mobile, non-tender; no adnexal masses',
            'abnormal' => ['Uterine enlargement', 'Fixed uterus', 'Adnexal tenderness', 'Adnexal mass', 'Other'],
        ],
        [
            'category' => 'Rectovaginal Exam',
            'normal' => 'Septum smooth and intact; no masses',
            'abnormal' => ['Nodularity', 'Tenderness', 'Rectal wall irregularities', 'Other'],
        ],
    ];
    $existingFemaleGenitalia = $existingFemaleGenitalia ?? $femaleGenitaliaData ?? [];
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">FEMALE GENITALIA</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success me-1" id="checkAllNormalFemaleGenitalia">
                                <i class="fas fa-check-double me-1"></i>Check All Normal
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheckAllNormalFemaleGenitalia">
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
                                @foreach($femaleGenitaliaCategories as $i => $item)
                                    <tr>
                                        <td><strong>{{ $item['category'] }}</strong></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input normal-femalegenitalia-checkbox" type="checkbox" name="female_genitalia[{{ $i }}][normal]" id="normal_femalegenitalia_{{ $i }}" value="1" {{ (isset($existingFemaleGenitalia[$i]['normal']) && $existingFemaleGenitalia[$i]['normal'] == '1') ? 'checked' : (empty($existingFemaleGenitalia) ? 'checked' : '') }}>
                                                <label class="form-check-label" for="normal_femalegenitalia_{{ $i }}">
                                                    {{ $item['normal'] }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                                <div class="row">
                                                    @foreach($item['abnormal'] as $j => $abnormal)
                                                        <div class="col-12 mb-1 abnormal-femalegenitalia-checkbox-group">
                                                            <div class="form-check d-flex align-items-center">
                                                                <input class="form-check-input abnormal-femalegenitalia-checkbox" type="checkbox" name="female_genitalia[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_femalegenitalia_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingFemaleGenitalia[$i]['abnormal'][$abnormal]) && $existingFemaleGenitalia[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="abnormal_femalegenitalia_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                            </div>
                                                            @if($abnormal === 'Other')
                                                                <input type="text" class="form-control mt-1 abnormal-femalegenitalia-other-input" name="female_genitalia[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingFemaleGenitalia[$i]['abnormal_other'] ?? '' }}">
                                                            @else
                                                                <input type="text" class="form-control mt-1 abnormal-femalegenitalia-detail-input" name="female_genitalia[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingFemaleGenitalia[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-femalegenitalia-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-femalegenitalia-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-femalegenitalia-checkbox').each(function() {
            var input = $(this).closest('.abnormal-femalegenitalia-checkbox-group').find('.abnormal-femalegenitalia-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Female Genitalia
    $('.abnormal-femalegenitalia-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-femalegenitalia-checkbox-group').find('.abnormal-femalegenitalia-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-femalegenitalia-other-input').show();

    // Check All Normal functionality for Female Genitalia (now a button)
    $('#checkAllNormalFemaleGenitalia').on('click', function() {
        $('.normal-femalegenitalia-checkbox').prop('checked', true);
    });

    // Uncheck All Normal functionality for Female Genitalia
    $('#uncheckAllNormalFemaleGenitalia').on('click', function() {
        $('.normal-femalegenitalia-checkbox').prop('checked', false);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



