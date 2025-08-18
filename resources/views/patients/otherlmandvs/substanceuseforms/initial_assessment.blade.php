<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0"><i class="fas fa-prescription-bottle me-2"></i>Substance Use - Initial Assessment</h4>
        </div>
        <div class="card-body">
            <!-- Recommendation Area populated from existing history data -->
            <div id="substance_recommendation_area" class="mb-3"></div>

            <!-- Recommended Screener Buttons (hidden until rules trigger) -->
            <div id="substance_screener_buttons" class="mt-3" style="display: none;">
                <h6 class="mb-3">Recommended Screeners:</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <button type="button" class="btn btn-secondary w-100" onclick="showFND6()">
                            <i class="fas fa-smoking me-2"></i>Start FND-6 Screener
                        </button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="button" class="btn btn-primary w-100" onclick="showCAGE4()">
                            <i class="fas fa-wine-bottle me-2"></i>Start CAGE-4 Screener
                        </button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="button" class="btn btn-info w-100" onclick="showASSIST8()">
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

            <div class="mt-3">
                <button type="button" class="btn btn-outline-secondary" onclick="refreshSubstanceRecommendations()">
                    <i class="fas fa-sync me-1"></i>Refresh Recommendations
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Load recommendations from backend using current patient data
window.loadSubstanceData = function() {
    const container = $('#substance-use-container');
    const inline = container.data() || {};
    // Try to collect live overrides from Personal-Social History section if it's on the page
    const overrides = {};
    try {
        const $currentSmoker = $('#current_smoker');
        const $currentDrinker = $('#current_drinker');
        const $currentDrugUser = $('#current_drug_user');
        const $alcoholSd = $('[name="alcohol_sd"]');
        const $alcoholFreq = $('[name="alcohol_frequency"]');
        const $gender = $('[name="gender"], #gender');

        if ($currentSmoker.length) overrides.current_smoker = $currentSmoker.is(':checked') ? 1 : 0;
        if ($currentDrinker.length) overrides.current_drinker = $currentDrinker.is(':checked') ? 1 : 0;
        if ($currentDrugUser.length) overrides.current_drug_user = $currentDrugUser.is(':checked') ? 1 : 0;
        if ($alcoholSd.length && $alcoholSd.val() !== '') overrides.alcohol_sd = Number($alcoholSd.val());
        if ($alcoholFreq.length && $alcoholFreq.val() !== '') overrides.alcohol_frequency = String($alcoholFreq.val());
        if ($gender.length && $gender.val() !== '') overrides.gender = (String($gender.val()).toLowerCase() === 'female') ? 'Female' : 'Male';
    } catch (e) {
        // ignore
    }
    $.ajax({
        url: '{{ route("substance.recommendations") }}',
        method: 'POST',
        data: Object.assign({
            patient_id: {{ $patient->id }},
            _token: $('meta[name="csrf-token"]').attr('content')
        }, overrides),
        success: function(resp){
            if (resp && resp.success) {
                const base = {
                    is_current_smoker: Boolean(resp.data.is_current_smoker),
                    is_current_drinker: Boolean(resp.data.is_current_drinker),
                    is_current_drug_user: Boolean(resp.data.is_current_drug_user),
                    // Default to per-day number from backend; can be overridden by live inputs
                    standard_drinks: Number(resp.data.standard_drinks_per_day || 0),
                    // Prefer live frequency if available; default to per_day otherwise
                    alcohol_frequency: overrides.alcohol_frequency || 'per_day',
                    user_sex: resp.data.user_sex === 'Female' ? 'Female' : 'Male'
                };
                if (Object.prototype.hasOwnProperty.call(overrides, 'current_smoker')) {
                    base.is_current_smoker = Boolean(overrides.current_smoker);
                }
                if (Object.prototype.hasOwnProperty.call(overrides, 'current_drinker')) {
                    base.is_current_drinker = Boolean(overrides.current_drinker);
                }
                if (Object.prototype.hasOwnProperty.call(overrides, 'current_drug_user')) {
                    base.is_current_drug_user = Boolean(overrides.current_drug_user);
                }
                if (Object.prototype.hasOwnProperty.call(overrides, 'alcohol_sd')) {
                    base.standard_drinks = Number(overrides.alcohol_sd);
                }
                if (Object.prototype.hasOwnProperty.call(overrides, 'gender')) {
                    base.user_sex = overrides.gender === 'Female' ? 'Female' : 'Male';
                }
                window.__substanceHistory = base;
                if (resp.recommendations && resp.recommendations.length > 0) {
                    renderRecommendations(resp.recommendations);
                } else {
                    refreshSubstanceRecommendations();
                }
                bindLiveInputs();
                return;
            }
            // Fallback to inline if backend returns no usable data
            fallbackInlineRecommendations(inline);
        },
        error: function(){ fallbackInlineRecommendations(inline); }
    });
}

function fallbackInlineRecommendations(inline){
    window.__substanceHistory = {
        is_current_smoker: Boolean(inline.isCurrentSmoker ?? false),
        is_current_drinker: Boolean(inline.isCurrentDrinker ?? false),
        is_current_drug_user: Boolean(inline.isCurrentDrugUser ?? false),
        standard_drinks: Number(inline.standardDrinksPerDay ?? 0),
        alcohol_frequency: 'per_day',
        user_sex: (inline.userSex === 'Female' ? 'Female' : 'Male')
    };
    bindLiveInputs();
    refreshSubstanceRecommendations();
}

function refreshSubstanceRecommendations() {
    const recArea = $('#substance_recommendation_area');
    const btns = $('#substance_screener_buttons');
    recArea.empty();

    const h = window.__substanceHistory || {
        is_current_smoker: false,
        is_current_drinker: false,
        is_current_drug_user: false,
        standard_drinks: 0,
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
    const drinks = Number(h.standard_drinks ?? h.standard_drinks_per_day ?? 0);
    const freq = String(h.alcohol_frequency || 'per_day');
    if ((freq === 'per_day' && drinks > 4) || (freq === 'per_session' && drinks > 4)) {
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

    btns.show();
}

function renderRecommendations(recs){
    const recArea = $('#substance_recommendation_area');
    const btns = $('#substance_screener_buttons');
    recArea.empty();
    if (!recs || recs.length === 0) {
        recArea.append('<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>No substance use screeners are recommended based on current data.</div>');
        btns.hide();
        return;
    }
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
                alcohol_frequency: 'per_day',
                user_sex: 'Male'
            }, window.__substanceHistory || {});

            if ($currentSmoker.length) window.__substanceHistory.is_current_smoker = $currentSmoker.is(':checked');
            if ($currentDrinker.length) window.__substanceHistory.is_current_drinker = $currentDrinker.is(':checked');
            if ($currentDrugUser.length) window.__substanceHistory.is_current_drug_user = $currentDrugUser.is(':checked');
            if ($alcoholSd.length && $alcoholSd.val() !== '') window.__substanceHistory.standard_drinks = Number($alcoholSd.val());
            if ($alcoholFreq.length && $alcoholFreq.val() !== '') window.__substanceHistory.alcohol_frequency = String($alcoholFreq.val());
            if ($gender.length && $gender.val() !== '') window.__substanceHistory.user_sex = (String($gender.val()).toLowerCase() === 'female') ? 'Female' : 'Male';
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

        if ($currentSmoker.length) $currentSmoker.on('change', updateFromInputs);
        if ($currentDrinker.length) $currentDrinker.on('change', updateFromInputs);
        if ($currentDrugUser.length) $currentDrugUser.on('change', updateFromInputs);
        if ($alcoholSd.length) $alcoholSd.on('input', debounced(updateFromInputs));
        if ($alcoholFreq.length) $alcoholFreq.on('change', updateFromInputs);
        if ($gender.length) $gender.on('change', updateFromInputs);
    } catch (e) {
        // ignore
    }
}
</script>


