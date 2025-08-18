<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0"><i class="fas fa-syringe me-2"></i>Alcohol, Smoking and Substance Involvement Screening Test (ASSIST-8)</h4>
    </div>
    <div class="card-body">
        <form id="assist8-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <!-- Q1: Lifetime Use -->
            <div class="mb-3">
                <label class="form-label">In your life which of the following substances have you ever used?</label>
                <div class="row">
                    <?php $substances = ['Tobacco', 'Alcohol', 'Cannabis', 'Cocaine', 'Amphetamines', 'Inhalants', 'Sedatives', 'Hallucinogens', 'Opioids', 'Other']; ?>
                    @foreach ($substances as $sub)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input assist-q1" type="checkbox" value="{{ $sub }}" id="assist_q1_{{ \Illuminate\Support\Str::slug($sub) }}">
                                <label class="form-check-label" for="assist_q1_{{ \Illuminate\Support\Str::slug($sub) }}">{{ $sub }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Q2-Q7 per substance selected in Q1 -->
            <div id="assist-detail-questions"></div>

            <!-- Q8: Injection Use -->
            <div class="mb-3">
                <label class="form-label">Have you ever used any drug by injection (non-medical use)?</label>
                <select class="form-control" id="assist_q8">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-info" id="assist8-calc-btn"><i class="fas fa-calculator me-1"></i>Calculate ASSIST-8 Scores</button>
                <button type="button" class="btn btn-outline-secondary" onclick="backToSubstanceInitial()"><i class="fas fa-arrow-left me-1"></i>Back</button>
            </div>
        </form>

        <div id="assist8-results" class="mt-3" style="display: none;"></div>
    </div>
</div>

<script>
// Build detail questions when substances are checked
$(document).on('change', '.assist-q1', function() {
    renderAssistDetailQuestions();
});

function renderAssistDetailQuestions() {
    const checked = $('.assist-q1:checked').map(function(){ return $(this).val(); }).get();
    const container = $('#assist-detail-questions');
    container.empty();
    checked.forEach(function(sub){
        const key = sub;
        const isTobacco = sub === 'Tobacco';
        const q2to7 = `
            <div class="card mb-3">
                <div class="card-header">
                    <strong>${sub}</strong>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="form-label">2. In the past 3 months, how often have you used ${sub}?</label>
                        <select class="form-control assist" data-sub="${key}" data-q="2">
                            <option value="0">Never</option>
                            <option value="2">Once or twice</option>
                            <option value="3">Monthly</option>
                            <option value="4">Weekly</option>
                            <option value="6">Daily or almost daily</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">3. In the past 3 months, how often have you had a strong desire or urge to use ${sub}?</label>
                        <select class="form-control assist" data-sub="${key}" data-q="3">
                            <option value="0">Never</option>
                            <option value="3">Once or twice</option>
                            <option value="4">Monthly</option>
                            <option value="5">Weekly</option>
                            <option value="6">Daily or almost daily</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">4. In the past 3 months, how often has your use of ${sub} led to health, social, legal or financial problems?</label>
                        <select class="form-control assist" data-sub="${key}" data-q="4">
                            <option value="0">Never</option>
                            <option value="4">Once or twice</option>
                            <option value="5">Monthly</option>
                            <option value="6">Weekly</option>
                            <option value="7">Daily or almost daily</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">5. In the past 3 months, how often have you failed to do what was normally expected of you because of your use of ${sub}?</label>
                        <select class="form-control assist" data-sub="${key}" data-q="5">
                            <option value="0">Never</option>
                            <option value="4">Once or twice</option>
                            <option value="5">Monthly</option>
                            <option value="6">Weekly</option>
                            <option value="7">Daily or almost daily</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">6. Has a friend or relative or anyone else ever expressed concern about your use of ${sub}?</label>
                        <select class="form-control assist" data-sub="${key}" data-q="6">
                            <option value="0">No, never</option>
                            <option value="3">Yes, in the past 3 months</option>
                            <option value="6">Yes, but not in the past 3 months</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">7. Have you ever tried and failed to control, cut down or stop using ${sub}?</label>
                        <select class="form-control assist" data-sub="${key}" data-q="7">
                            <option value="0">No, never</option>
                            <option value="3">Yes, in the past 3 months</option>
                            <option value="6">Yes, but not in the past 3 months</option>
                        </select>
                    </div>
                </div>
            </div>`;
        container.append(q2to7);
    });
}

$('#assist8-calc-btn').on('click', function(){
    const checked = $('.assist-q1:checked').map(function(){ return $(this).val(); }).get();
    const results = [];
    checked.forEach(function(sub){
        let score = 0;
        for (let i=2; i<=7; i++) {
            const val = Number($(`.assist[data-sub="${sub}"][data-q="${i}"]`).val() || 0);
            // Skip Q5 for Tobacco
            if (sub === 'Tobacco' && i === 5) continue;
            score += val;
        }
        const risk = interpretAssistRisk(sub, score);
        results.push({ sub, score, risk });
    });

    const q8 = Number($('#assist_q8').val() || 0);
    let html = '';
    if (results.length === 0) {
        html += '<div class="alert alert-success">No substances selected in Q1.</div>';
    } else {
        html += '<div class="list-group">';
        results.forEach(function(r){
            html += `
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">${r.sub}</h6>
                        <small>Score: ${r.score}</small>
                    </div>
                    <p class="mb-1"><strong>Risk Level:</strong> ${r.risk.level}</p>
                    <small><em>${r.risk.action}</em></small>
                </div>
            `;
        });
        html += '</div>';
    }

    if (q8 === 1) {
        html += '<div class="alert alert-danger mt-3"><strong>Note:</strong> Provide information about the risks of injecting.</div>';
    }

    $('#assist8-results').html(html).show();
});

function interpretAssistRisk(substance, score) {
    // Simplified risk interpretation
    if (substance === 'Alcohol') {
        if (score <= 10) return { level: 'Low', action: 'Provide health information as needed.' };
        if (score <= 26) return { level: 'Moderate', action: 'Brief intervention and follow-up.' };
        return { level: 'High', action: 'Intensive treatment or referral.' };
    } else {
        if (score <= 3) return { level: 'Low', action: 'Provide health information as needed.' };
        if (score <= 26) return { level: 'Moderate', action: 'Brief intervention and counseling.' };
        return { level: 'High', action: 'Consider referral to specialist services.' };
    }
}

window.loadASSIST8Data = function() {};

function saveASSIST8Assessment() {
    // Collect selections into structured JSON
    const substances = $('.assist-q1:checked').map(function(){ return $(this).val(); }).get();
    const data = {};
    substances.forEach(function(sub){
        data[sub] = {};
        for (let i=2; i<=7; i++) {
            const v = Number($(`.assist[data-sub="${sub}"][data-q="${i}"]`).val() || 0);
            data[sub][`q${i}`] = v;
        }
    });
    const injection = Number($('#assist_q8').val() || 0);
    $.ajax({
        url: '{{ route("assist8-assessments.store") }}',
        method: 'POST',
        data: {
            patient_id: {{ $patient->id }},
            data_json: data,
            injection_use: injection,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){ alert('ASSIST-8 saved successfully!'); },
        error: function(xhr){ alert('Error saving ASSIST-8.'); console.error(xhr.responseText); }
    });
}
</script>


