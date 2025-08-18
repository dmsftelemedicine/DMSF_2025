<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0"><i class="fas fa-prescription-bottle me-2"></i>Substance Use - Initial Assessment</h4>
        </div>
        <div class="card-body">
            <!-- Summary from Personal-Social History (read-only) -->
            <div class="mb-3">
                <h6 class="mb-2">Current Status (from Personal-Social History)</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Current Smoker</label>
                        <input type="text" class="form-control" id="su_summary_smoker" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Current Drug User</label>
                        <input type="text" class="form-control" id="su_summary_drug" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Current Alcohol Drinker</label>
                        <input type="text" class="form-control" id="su_summary_drinker" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sex / Gender</label>
                        <input type="text" class="form-control" id="su_summary_gender" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Standard Drinks</label>
                        <input type="text" class="form-control" id="su_summary_sd" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Frequency</label>
                        <input type="text" class="form-control" id="su_summary_freq" readonly>
                    </div>
                </div>
            </div>
            <!-- Recommendation Area populated from existing history data -->
            <div id="substance_recommendation_area" class="mb-3"></div>

            <!-- Recommended Screener Buttons (hidden until rules trigger) -->
            <div id="substance_screener_buttons" class="mt-3" style="display: none;">
                <h6 class="mb-3">Recommended Screeners:</h6>
                <div class="row">
                    <div class="col-md-4 mb-2 d-none" id="wrap-btn-fnd6">
                        <button id="btn_fnd6" type="button" class="btn btn-secondary w-100" onclick="showFND6()">
                            <i class="fas fa-smoking me-2"></i>Start FND-6 Screener
                        </button>
                    </div>
                    <div class="col-md-4 mb-2 d-none" id="wrap-btn-cage4">
                        <button id="btn_cage4" type="button" class="btn btn-primary w-100" onclick="showCAGE4()">
                            <i class="fas fa-wine-bottle me-2"></i>Start CAGE-4 Screener
                        </button>
                    </div>
                    <div class="col-md-4 mb-2 d-none" id="wrap-btn-assist8">
                        <button id="btn_assist8" type="button" class="btn btn-info w-100" onclick="showASSIST8()">
                            <i class="fas fa-syringe me-2"></i>Start ASSIST-8 Screener
                        </button>
                    </div>
                </div>
            </div>

            <!-- Note: Inputs are not collected here; data is sourced from history/personal social history -->
            <div class="alert alert-light border mt-3">
                <i class="fas fa-info-circle me-2"></i>
                This section uses existing history data (e.g., smoking, alcohol, drug use, and daily standard drinks) to recommend appropriate screeners. No input is required here.
            </div>

            
        </div>
    </div>
</div>

<script>
// Load recommendations from backend using current patient data
window.loadSubstanceData = function() {
    const container = $('#substance-use-container');
    const inline = container.data() || {};
    const bladeDefaultSex = '{{ isset($patient->gender) ? (strtolower($patient->gender) === 'female' ? 'Female' : 'Male') : 'Male' }}';
    $.ajax({
        url: '{{ route("substance.recommendations") }}',
        method: 'POST',
        data: {
            patient_id: {{ $patient->id }},
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp){
            if (resp && resp.success) {
                const base = {
                    is_current_smoker: Boolean(resp.data.is_current_smoker),
                    is_current_drinker: Boolean(resp.data.is_current_drinker),
                    is_current_drug_user: Boolean(resp.data.is_current_drug_user),
                    standard_drinks: Number(resp.data.standard_drinks_per_day || 0),
                    standard_drinks_per_day: Number(resp.data.standard_drinks_per_day || 0),
                    alcohol_sd_raw: Number(resp.data.alcohol_sd || 0),
                    alcohol_frequency: resp.data.alcohol_frequency || 'per_day',
                    user_sex: resp.data.user_sex === 'Female' ? 'Female' : 'Male'
                };
                window.__substanceHistory = base;
                updateSubstanceSummary();
                refreshSubstanceRecommendations();
                return;
            }
            // Fallback to inline if backend returns no usable data
            fallbackInlineRecommendations(inline);
        },
        error: function(){ fallbackInlineRecommendations(inline); }
    });
}

function fallbackInlineRecommendations(inline){
    const inlineFreq = String(inline.alcoholFrequency || 'per_day');
    let inlineRaw = Number(inline.standardDrinks ?? inline.standardDrinksPerDay ?? 0);
    let inlineDaily = inlineRaw;
    if (inlineFreq === 'per_week') { inlineDaily = inlineDaily / 7.0; }
    window.__substanceHistory = {
        is_current_smoker: Boolean(inline.isCurrentSmoker ?? false),
        is_current_drinker: Boolean(inline.isCurrentDrinker ?? false),
        is_current_drug_user: Boolean(inline.isCurrentDrugUser ?? false),
        standard_drinks: inlineDaily,
        standard_drinks_per_day: inlineDaily,
        alcohol_sd_raw: inlineRaw,
        alcohol_frequency: inlineFreq,
        user_sex: (inline.userSex === 'Female' ? 'Female' : (inline.userSex === 'Male' ? 'Male' : bladeDefaultSex))
    };
    // Compute recommendations from inline data immediately
    updateSubstanceSummary();
    refreshSubstanceRecommendations();
}

function refreshSubstanceRecommendations() {
    const recArea = $('#substance_recommendation_area');
    const btns = $('#substance_screener_buttons');
    recArea.empty();
    // Reset button wrappers each refresh to avoid stale visibility
    $('#wrap-btn-fnd6, #wrap-btn-cage4, #wrap-btn-assist8').addClass('d-none');

    const h = window.__substanceHistory || {
        is_current_smoker: false,
        is_current_drinker: false,
        is_current_drug_user: false,
        standard_drinks: 0,
        standard_drinks_per_day: 0,
        alcohol_frequency: 'per_day',
        user_sex: 'Male'
    };

    const recommendations = [];

    // Fagerstrom Test Logic
    if (h.is_current_smoker) {
        recommendations.push({
            type: 'info',
            message: 'Suggest to assess Nicotine Dependence with Fagerstrom Test (FND-6).',
            action: 'showFND6()'
        });
    }

    // CAGE Questionnaire Logic
    let needsCAGE = false;
    // Normalize daily drinks for decision logic
    const drinks = Number(h.standard_drinks_per_day ?? h.standard_drinks ?? 0);
    const freq = String(h.alcohol_frequency || 'per_day');
    const rawSd = Number(h.alcohol_sd_raw ?? h.standard_drinks ?? 0);
    if ((freq === 'per_day' && drinks > 4) || (freq === 'per_session' && rawSd > 4)) {
        needsCAGE = 'binge';
    } else if (freq === 'per_day' && h.user_sex === 'Male' && drinks > 2) {
        needsCAGE = 'daily';
    } else if (freq === 'per_day' && h.user_sex === 'Female' && drinks > 1) {
        needsCAGE = 'daily';
    }
    if (needsCAGE) {
        const message = needsCAGE === 'binge'
            ? 'Patient is a binge-drinker. Suggest to screen for Alcohol Dependence with CAGE questionnaire (CAGE-4).'
            : 'Suggest to screen for Alcohol Dependence with CAGE questionnaire (CAGE-4).';
        recommendations.push({
            type: 'warning',
            message: message,
            action: 'showCAGE4()'
        });
    }

    // ASSIST Test Logic
    let needsASSIST = false;
    if (h.is_current_drug_user) {
        needsASSIST = true;
    } else if (h.is_current_smoker && h.is_current_drinker) {
        needsASSIST = true;
    }
    if (needsASSIST) {
        recommendations.push({
            type: 'info',
            message: 'Suggest to use Alcohol, Smoking, Substance Involvement Screening Test (ASSIST-8).',
            action: 'showASSIST8()'
        });
    }

    if (recommendations.length === 0) {
        recArea.append('<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>No substance use screeners are recommended based on current data.</div>');
        btns.hide();
        return;
    }
    
    // Render messages
    recommendations.forEach(function(rec){
        const alertClass = rec.type === 'warning' ? 'alert-warning' : (rec.type === 'info' ? 'alert-info' : 'alert-secondary');
        const icon = rec.type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle';
        recArea.append(`<div class="alert ${alertClass}"><i class="fas ${icon} me-2"></i>${rec.message}</div>`);
        if (rec.action === 'showFND6()') $('#wrap-btn-fnd6').removeClass('d-none');
        if (rec.action === 'showCAGE4()') $('#wrap-btn-cage4').removeClass('d-none');
        if (rec.action === 'showASSIST8()') $('#wrap-btn-assist8').removeClass('d-none');
    });
    btns.show();
}

function renderRecommendations(recs){
    const recArea = $('#substance_recommendation_area');
    const btns = $('#substance_screener_buttons');
    recArea.empty();
    // Reset button wrappers before rendering
    $('#wrap-btn-fnd6, #wrap-btn-cage4, #wrap-btn-assist8').addClass('d-none');
    if (!recs || recs.length === 0) {
        recArea.append('<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>No substance use screeners are recommended based on current data.</div>');
        btns.hide();
        return;
    }
    // Backward compatibility: treat non-empty as generic recommendation set
    recs.forEach(function(rec){
        const alertClass = rec.type === 'warning' ? 'alert-warning' : (rec.type === 'info' ? 'alert-info' : 'alert-secondary');
        const icon = rec.type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle';
        if (rec.message) recArea.append(`<div class="alert ${alertClass}"><i class="fas ${icon} me-2"></i>${rec.message}</div>`);
        if (rec.action === 'showFND6()' || rec.key === 'fnd6') $('#wrap-btn-fnd6').removeClass('d-none');
        if (rec.action === 'showCAGE4()' || rec.key === 'cage4') $('#wrap-btn-cage4').removeClass('d-none');
        if (rec.action === 'showASSIST8()' || rec.key === 'assist8') $('#wrap-btn-assist8').removeClass('d-none');
    });
    btns.show();
}

// Bind live inputs from Personal-Social History to keep recommendations in sync
function bindLiveInputs() {
    try {
        const $currentSmoker = $('#current_smoker');
        const $currentDrinker = $('#current_drinker');
        const $currentDrugUser = $('#current_drug_user');
        const $alcoholSd = $('[name="alcohol_sd"]');
        const $alcoholFreq = $('[name="alcohol_frequency"]');
        const $gender = $('[name="gender"], #gender');

        const updateFromInputs = function() {
            window.__substanceHistory = Object.assign({
                is_current_smoker: false,
                is_current_drinker: false,
                is_current_drug_user: false,
                standard_drinks: 0,
                standard_drinks_per_day: 0,
                alcohol_frequency: 'per_day',
                user_sex: 'Male'
            }, window.__substanceHistory || {});

            if ($currentSmoker.length) window.__substanceHistory.is_current_smoker = $currentSmoker.is(':checked');
            if ($currentDrinker.length) window.__substanceHistory.is_current_drinker = $currentDrinker.is(':checked');
            if ($currentDrugUser.length) window.__substanceHistory.is_current_drug_user = $currentDrugUser.is(':checked');
            if ($alcoholFreq.length && $alcoholFreq.val() !== '') window.__substanceHistory.alcohol_frequency = String($alcoholFreq.val());
            // Normalize sd to per-day using selected frequency
            if ($alcoholSd.length && $alcoholSd.val() !== '') {
                const raw = Number($alcoholSd.val());
                const f = String(window.__substanceHistory.alcohol_frequency || 'per_day');
                let daily = raw;
                if (f === 'per_week') { daily = raw / 7.0; }
                window.__substanceHistory.standard_drinks = daily;
                window.__substanceHistory.standard_drinks_per_day = daily;
            }
            if ($gender.length && $gender.val() !== '') window.__substanceHistory.user_sex = (String($gender.val()).toLowerCase() === 'female') ? 'Female' : 'Male';
            updateSubstanceSummary();
            refreshSubstanceRecommendations();
        };

        // Debounced input handler for numeric field
        let debounceTimer = null;
        const debounced = function(handler){
            return function(){
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(handler, 200);
            };
        };

        if ($currentSmoker.length) $currentSmoker.on('change', function(){ $(this).data('touched', true); updateFromInputs(); });
        if ($currentDrinker.length) $currentDrinker.on('change', function(){ $(this).data('touched', true); updateFromInputs(); });
        if ($currentDrugUser.length) $currentDrugUser.on('change', function(){ $(this).data('touched', true); updateFromInputs(); });
        if ($alcoholSd.length) $alcoholSd.on('input', debounced(updateFromInputs));
        if ($alcoholFreq.length) $alcoholFreq.on('change', updateFromInputs);
        if ($gender.length) $gender.on('change', function(){ $(this).data('touched', true); updateFromInputs(); });
    } catch (e) {
        // ignore
    }
}

function friendlyFrequency(code) {
    if (!code) return '';
    if (code === 'per_day') return 'per day';
    if (code === 'per_week') return 'per week';
    if (code === 'per_session') return 'per session';
    return String(code);
}

function updateSubstanceSummary() {
    const h = window.__substanceHistory || {};
    const yesNo = function(v){ return v ? 'Yes' : 'No'; };
    $('#su_summary_smoker').val(yesNo(Boolean(h.is_current_smoker)));
    $('#su_summary_drug').val(yesNo(Boolean(h.is_current_drug_user)));
    $('#su_summary_drinker').val(yesNo(Boolean(h.is_current_drinker)));
    $('#su_summary_gender').val(h.user_sex === 'Female' ? 'Female' : 'Male');
    const sd = (h.alcohol_sd_raw !== undefined && h.alcohol_sd_raw !== null) ? Number(h.alcohol_sd_raw) : Number(h.standard_drinks || 0);
    $('#su_summary_sd').val(Number.isFinite(sd) ? sd : '');
    $('#su_summary_freq').val(friendlyFrequency(h.alcohol_frequency));
}
</script>


