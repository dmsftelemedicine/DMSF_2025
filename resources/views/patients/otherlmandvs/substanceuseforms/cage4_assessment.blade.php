<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-wine-bottle me-2"></i>CAGE Questionnaire (CAGE-4)</h4>
    </div>
    <div class="card-body">
        <form id="cage4-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <div class="mb-3">
                <label class="form-label">1. Have you ever felt you should Cut down on your drinking?</label>
                <select class="form-control" name="q1" required>
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">2. Have people Annoyed you by criticizing your drinking?</label>
                <select class="form-control" name="q2" required>
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">3. Have you ever felt bad or Guilty about your drinking?</label>
                <select class="form-control" name="q3" required>
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">4. Have you ever had a drink first thing in the morning (Eye-opener) to steady your nerves or get rid of a hangover?</label>
                <select class="form-control" name="q4" required>
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" id="cage4-calc-btn"><i class="fas fa-calculator me-1"></i>Calculate CAGE-4 Score</button>
                <button type="button" class="btn btn-success" onclick="saveCAGE4Assessment()"><i class="fas fa-save me-1"></i>Save</button>
                <button type="button" class="btn btn-outline-secondary" onclick="backToSubstanceInitial()"><i class="fas fa-arrow-left me-1"></i>Back</button>
            </div>
        </form>

        <div id="cage4-result" class="mt-3" style="display: none;"></div>
    </div>
</div>

<script>
$('#cage4-calc-btn').on('click', function() {
    const q1 = Number($('select[name="q1"]').val() || 0);
    const q2 = Number($('select[name="q2"]').val() || 0);
    const q3 = Number($('select[name="q3"]').val() || 0);
    const q4 = Number($('select[name="q4"]').val() || 0);
    const total = q1 + q2 + q3 + q4;
    const interpretation = total >= 2 ? 'High likelihood of alcohol dependence' : 'Low likelihood of alcohol dependence';
    const html = `
        <div class="alert alert-primary">
            <strong>Total Score:</strong> ${total}<br/>
            <strong>Interpretation:</strong> ${interpretation}<br/>
            <em>Consider brief intervention or referral as indicated.</em>
        </div>
    `;
    $('#cage4-result').html(html).show();
});

window.loadCAGE4Data = function() {
    $.ajax({
        url: '{{ route("cage4-assessments.show", $patient->id) }}',
        method: 'GET',
        success: function(resp) {
            if (resp && resp.success && resp.data) {
                const d = resp.data;
                for (let i=1; i<=4; i++) {
                    if (d[`q${i}`] !== undefined && d[`q${i}`] !== null) {
                        $(`select[name="q${i}"]`).val(d[`q${i}`]);
                    }
                }
                if (d.total_score !== undefined) {
                    $('#cage4-result').html(`<div class="alert alert-primary"><strong>Total Score:</strong> ${d.total_score}<br/><strong>Interpretation:</strong> ${d.interpretation||''}</div>`).show();
                }
            }
        }
    });
};

function saveCAGE4Assessment() {
    for (let i=1; i<=4; i++) { if ($(`select[name="q${i}"]`).val() === '') { alert('Please complete all CAGE-4 items.'); return; } }
    const payload = {
        patient_id: {{ $patient->id }},
        q1: Number($('select[name="q1"]').val()),
        q2: Number($('select[name="q2"]').val()),
        q3: Number($('select[name="q3"]').val()),
        q4: Number($('select[name="q4"]').val()),
    };
    payload.total_score = payload.q1+payload.q2+payload.q3+payload.q4;
    $.ajax({
        url: '{{ route("cage4-assessments.store") }}',
        method: 'POST',
        data: Object.assign(payload, {_token: $('meta[name="csrf-token"]').attr('content')}),
        success: function(){ alert('CAGE-4 saved successfully!'); },
        error: function(xhr){ alert('Error saving CAGE-4.'); console.error(xhr.responseText); }
    });
}
</script>


