<div class="card mb-4">
    <div class="card-header bg-secondary text-white">
        <h4 class="mb-0"><i class="fas fa-smoking me-2"></i>Fagerstrom Test for Nicotine Dependence (FND-6)</h4>
    </div>
    <div class="card-body">
        <form id="fnd6-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <!-- Questions 1-6 -->
            <div class="mb-3">
                <label class="form-label">1. How soon after you wake up do you smoke your first cigarette?</label>
                <select class="form-control" name="q1" required>
                    <option value="">Select...</option>
                    <option value="3">Within 5 minutes</option>
                    <option value="2">6–30 minutes</option>
                    <option value="1">31–60 minutes</option>
                    <option value="0">After 60 minutes</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">2. Do you find it difficult to refrain from smoking in places where it is forbidden?</label>
                <select class="form-control" name="q2" required>
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">3. Which cigarette would you hate most to give up?</label>
                <select class="form-control" name="q3" required>
                    <option value="">Select...</option>
                    <option value="1">The first one in the morning</option>
                    <option value="0">Any other</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">4. How many cigarettes per day do you smoke?</label>
                <select class="form-control" name="q4" required>
                    <option value="">Select...</option>
                    <option value="0">10 or less</option>
                    <option value="1">11–20</option>
                    <option value="2">21–30</option>
                    <option value="3">31 or more</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">5. Do you smoke more frequently during the first hours after waking than during the rest of the day?</label>
                <select class="form-control" name="q5" required>
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">6. Do you smoke even when you are so ill that you are in bed most of the day?</label>
                <select class="form-control" name="q6" required>
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-secondary" id="fnd6-calc-btn"><i class="fas fa-calculator me-1"></i>Calculate FND-6 Score</button>
                <button type="button" class="btn btn-success" onclick="saveFND6Assessment()"><i class="fas fa-save me-1"></i>Save</button>
                <button type="button" class="btn btn-outline-secondary" onclick="backToSubstanceInitial()"><i class="fas fa-arrow-left me-1"></i>Back</button>
            </div>
        </form>

        <div id="fnd6-result" class="mt-3" style="display: none;"></div>
    </div>
</div>

<script>
$('#fnd6-calc-btn').on('click', function() {
    const q1 = Number($('select[name="q1"]').val() || 0);
    const q2 = Number($('select[name="q2"]').val() || 0);
    const q3 = Number($('select[name="q3"]').val() || 0);
    const q4 = Number($('select[name="q4"]').val() || 0);
    const q5 = Number($('select[name="q5"]').val() || 0);
    const q6 = Number($('select[name="q6"]').val() || 0);

    const total = q1 + q2 + q3 + q4 + q5 + q6;
    let level = 'Low';
    if (total >= 8) level = 'High';
    else if (total >= 5) level = 'Moderate';
    else if (total >= 3) level = 'Low-Moderate';

    const html = `
        <div class="alert alert-secondary">
            <strong>Total Score:</strong> ${total}<br/>
            <strong>Level of Nicotine Dependence:</strong> ${level}<br/>
            <em>Consider counseling and smoking cessation support as indicated.</em>
        </div>
    `;
    $('#fnd6-result').html(html).show();
});

// Optional: loadFND6Data() can fetch previous responses
window.loadFND6Data = function() {
    $.ajax({
        url: '{{ route("fnd6-assessments.show", $patient->id) }}',
        method: 'GET',
        success: function(resp) {
            if (resp && resp.success && resp.data) {
                const d = resp.data;
                for (let i=1; i<=6; i++) {
                    if (d[`q${i}`] !== null && d[`q${i}`] !== undefined) {
                        $(`select[name="q${i}"]`).val(d[`q${i}`]);
                    }
                }
                if (d.total_score !== undefined) {
                    $('#fnd6-result').html(`<div class="alert alert-secondary"><strong>Total Score:</strong> ${d.total_score}<br/><strong>Level:</strong> ${d.dependence_level||''}</div>`).show();
                }
            }
        }
    });
};

function saveFND6Assessment() {
    // ensure required selections
    for (let i=1; i<=6; i++) {
        if (!$(`select[name="q${i}"]`).val()) { alert('Please complete all FND-6 questions before saving.'); return; }
    }
    const payload = {
        patient_id: {{ $patient->id }},
        q1: Number($('select[name="q1"]').val()),
        q2: Number($('select[name="q2"]').val()),
        q3: Number($('select[name="q3"]').val()),
        q4: Number($('select[name="q4"]').val()),
        q5: Number($('select[name="q5"]').val()),
        q6: Number($('select[name="q6"]').val()),
    };
    payload.total_score = payload.q1+payload.q2+payload.q3+payload.q4+payload.q5+payload.q6;
    $.ajax({
        url: '{{ route("fnd6-assessments.store") }}',
        method: 'POST',
        data: Object.assign(payload, {_token: $('meta[name="csrf-token"]').attr('content')}),
        success: function(){ alert('FND-6 saved successfully!'); },
        error: function(xhr){ alert('Error saving FND-6.'); console.error(xhr.responseText); }
    });
}
</script>


