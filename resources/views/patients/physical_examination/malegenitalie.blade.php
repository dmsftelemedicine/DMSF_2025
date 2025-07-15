@php
    $maleGenitaliaCategories = [
        [
            'category' => 'Penis',
            'normal' => 'Circumcised/uncircumcised with no lesions/discharge, urethral meatus patent',
            'abnormal' => ['Balanitis', 'Phimosis', 'Paraphimosis', 'Penile discharge', 'Lesions', 'Hypospadias', 'Other'],
        ],
        [
            'category' => 'Scrotum',
            'normal' => 'No swelling and lesions',
            'abnormal' => ['Swelling', 'Lesions', 'Asymmetry', 'Tenderness', 'Other'],
        ],
        [
            'category' => 'Testicles',
            'normal' => 'Palpable, no masses, nontender',
            'abnormal' => ['Absent/undescended', 'Masses/nodules', 'Tenderness', 'Swelling', 'Other'],
        ],
        [
            'category' => 'Epididymis',
            'normal' => 'No swelling, nontender',
            'abnormal' => ['Swelling', 'Tenderness', 'Induration', 'Other'],
        ],
        [
            'category' => 'Spermatic Cord',
            'normal' => 'No swelling, nontender',
            'abnormal' => ['Swelling', 'Tenderness', 'Masses', 'Varicocele', 'Other'],
        ],
        [
            'category' => 'Hernia Examination',
            'normal' => 'No bulges with Valsalva or cough',
            'abnormal' => ['Inguinal hernia', 'Femoral hernia', 'Incisional hernia', 'Other'],
        ],
        [
            'category' => 'Rectal Exam',
            'normal' => 'Good sphincter tone, smooth rectal walls, no masses',
            'abnormal' => ['Poor tone', 'Masses', 'Tenderness', 'Blood', 'Other'],
        ],
        [
            'category' => 'Prostate (if applicable)',
            'normal' => 'Smooth, non-tender, normal size',
            'abnormal' => ['Enlarged', 'Nodular', 'Tender', 'Firm/hard', 'Other'],
        ],
    ];
    $existingMaleGenitalia = $existingMaleGenitalia ?? $maleGenitaliaData ?? [];
@endphp

<div class="card h-100">
    <div class="card-header bg-light py-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">MALE GENITALIA</h6>
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
                                <input class="form-check-input" type="checkbox" id="checkAllNormalMaleGenitalia">
                                <label class="form-check-label small" for="checkAllNormalMaleGenitalia">Check All</label>
                            </div>
                        </th>
                        <th style="width: 35%">Abnormal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maleGenitaliaCategories as $i => $item)
                        <tr>
                            <td><strong>{{ $item['category'] }}</strong></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input normal-malegenitalia-checkbox" type="checkbox" name="male_genitalia[{{ $i }}][normal]" id="normal_malegenitalia_{{ $i }}" value="1" {{ (isset($existingMaleGenitalia[$i]['normal']) && $existingMaleGenitalia[$i]['normal']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="normal_malegenitalia_{{ $i }}">
                                        {{ $item['normal'] }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                @if(isset($item['abnormal']) && is_array($item['abnormal']) && count($item['abnormal']))
                                    <div class="row">
                                        @foreach($item['abnormal'] as $j => $abnormal)
                                            <div class="col-12 mb-1 abnormal-malegenitalia-checkbox-group">
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input abnormal-malegenitalia-checkbox" type="checkbox" name="male_genitalia[{{ $i }}][abnormal][{{ $abnormal }}]" id="abnormal_malegenitalia_{{ $i }}_{{ $j }}" value="1" {{ (isset($existingMaleGenitalia[$i]['abnormal'][$abnormal]) && $existingMaleGenitalia[$i]['abnormal'][$abnormal]) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2" for="abnormal_malegenitalia_{{ $i }}_{{ $j }}">{{ $abnormal }}</label>
                                                </div>
                                                @if($abnormal === 'Other')
                                                    <input type="text" class="form-control mt-1 abnormal-malegenitalia-other-input" name="male_genitalia[{{ $i }}][abnormal_other]" placeholder="Please specify..." value="{{ $existingMaleGenitalia[$i]['abnormal_other'] ?? '' }}">
                                                @else
                                                    <input type="text" class="form-control mt-1 abnormal-malegenitalia-detail-input" name="male_genitalia[{{ $i }}][abnormal_detail][{{ $abnormal }}]" placeholder="Additional info for '{{ $abnormal }}'" style="display:none;" value="{{ $existingMaleGenitalia[$i]['abnormal_detail'][$abnormal] ?? '' }}">
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
.abnormal-malegenitalia-detail-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
.abnormal-malegenitalia-other-input {
    font-size: 0.9rem;
    padding: 2px 8px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize abnormal detail input fields based on existing checkbox states
    function initializeAbnormalInputs() {
        $('.abnormal-malegenitalia-checkbox').each(function() {
            var input = $(this).closest('.abnormal-malegenitalia-checkbox-group').find('.abnormal-malegenitalia-detail-input');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide();
            }
        });
    }

    // Show/hide abnormal detail input fields for Male Genitalia
    $('.abnormal-malegenitalia-checkbox').on('change', function() {
        var input = $(this).closest('.abnormal-malegenitalia-checkbox-group').find('.abnormal-malegenitalia-detail-input');
        if ($(this).is(':checked')) {
            input.show();
        } else {
            input.hide();
            input.val('');
        }
    });

    // Always show the input for 'Other'
    $('.abnormal-malegenitalia-other-input').show();

    // Check All Normal functionality for Male Genitalia
    $('#checkAllNormalMaleGenitalia').on('change', function() {
        var checked = $(this).is(':checked');
        $('.normal-malegenitalia-checkbox').prop('checked', checked);
    });

    // Initialize on page load
    initializeAbnormalInputs();
});
</script>



