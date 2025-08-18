<div class="card mb-4">
	<div class="card-header bg-secondary text-white">
		<h4 class="mb-0"><i class="fas fa-prescription-bottle-alt me-2"></i>Substance Use Assessment</h4>
	</div>
	<div class="card-body">
		<p class="text-muted">Recommendations below are auto-generated from history data.</p>

		<div id="recommendation_area"></div>

		<div id="substance_screener_buttons" class="mt-4" style="display: none;">
			<h6 class="mb-3">Recommended Screeners:</h6>
			<div class="row">
				<div class="col-md-4 mb-2">
					<button type="button" class="btn btn-outline-dark w-100" onclick="showFND6()">
						<i class="fas fa-smoking me-2"></i>Start FND-6 Screener
					</button>
				</div>
				<div class="col-md-4 mb-2">
					<button type="button" class="btn btn-outline-primary w-100" onclick="showCAGE4()">
						<i class="fas fa-wine-bottle me-2"></i>Start CAGE-4 Screener
					</button>
				</div>
				<div class="col-md-4 mb-2">
					<button type="button" class="btn btn-outline-warning w-100" onclick="showASSIST8()">
						<i class="fas fa-syringe me-2"></i>Start ASSIST-8 Screener
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
// SECTION 1 + 2: Ingest history and compute recommendations
function loadSubstanceHistoryAndRecommend() {
	// Placeholder: fetch these from your existing history source
	const is_current_smoker = window.patientHistory?.is_current_smoker ?? false;
	const is_current_drinker = window.patientHistory?.is_current_drinker ?? false;
	const is_current_drug_user = window.patientHistory?.is_current_drug_user ?? false;
	const standard_drinks_per_day = Number(window.patientHistory?.standard_drinks_per_day ?? 0);
	const user_sex = (window.patientHistory?.user_sex ?? 'Male');

	const $area = $('#recommendation_area');
	$area.empty();

	let suggested = false;

	// Fagerstrom
	if (is_current_smoker) {
		$area.append(`
			<div class="alert alert-dark" role="alert">
				<strong>Suggestion:</strong> Assess Nicotine Dependence with Fagerstrom Test (FND-6).
				<div class="mt-2"><button class="btn btn-sm btn-dark" onclick="showFND6()">Start FND-6 Screener</button></div>
			</div>
		`);
		suggested = true;
	}

	// CAGE logic
	let needs_cage_screener = false;
	if (standard_drinks_per_day > 4) {
		needs_cage_screener = true;
	} else if (user_sex === 'Male' && standard_drinks_per_day > 2) {
		needs_cage_screener = true;
	} else if (user_sex === 'Female' && standard_drinks_per_day > 1) {
		needs_cage_screener = true;
	}
	if (needs_cage_screener) {
		$area.append(`
			<div class="alert alert-primary" role="alert">
				<strong>Suggestion:</strong> Screen for Alcohol Dependence with CAGE questionnaire (CAGE-4).
				<div class="mt-2"><button class="btn btn-sm btn-primary" onclick="showCAGE4()">Start CAGE-4 Screener</button></div>
			</div>
		`);
		suggested = true;
	}

	// ASSIST logic
	let needs_assist_screener = false;
	if (is_current_drug_user) {
		needs_assist_screener = true;
	} else if (is_current_smoker && is_current_drinker) {
		needs_assist_screener = true;
	}
	if (needs_assist_screener) {
		$area.append(`
			<div class="alert alert-warning" role="alert">
				<strong>Suggestion:</strong> Use Alcohol, Smoking, Substance Involvement Screening Test (ASSIST-8).
				<div class="mt-2"><button class="btn btn-sm btn-warning" onclick="showASSIST8()">Start ASSIST-8 Screener</button></div>
			</div>
		`);
		suggested = true;
	}

	if (suggested) {
		$('#substance_screener_buttons').show();
	} else {
		$('#substance_screener_buttons').hide();
		$area.append('<div class="alert alert-success">No screeners recommended based on current history.</div>');
	}
}
</script>


