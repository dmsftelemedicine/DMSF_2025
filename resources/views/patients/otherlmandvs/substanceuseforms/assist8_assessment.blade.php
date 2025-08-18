<div class="card mb-4">
	<div class="card-header bg-warning">
		<h4 class="mb-0">Alcohol, Smoking and Substance Involvement Screening Test (ASSIST-8)</h4>
	</div>
	<div class="card-body">
		<form id="assist8-form">
			<!-- Q1: Lifetime Use -->
			<div class="mb-3">
				<label class="form-label">In your life which of the following substances have you ever used?</label>
				<div class="row">
					<div class="col-md-6">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Tobacco" id="sub-tobacco" name="subs[]">
							<label class="form-check-label" for="sub-tobacco">Tobacco</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Alcohol" id="sub-alcohol" name="subs[]">
							<label class="form-check-label" for="sub-alcohol">Alcohol</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Cannabis" id="sub-cannabis" name="subs[]">
							<label class="form-check-label" for="sub-cannabis">Cannabis</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Cocaine" id="sub-cocaine" name="subs[]">
							<label class="form-check-label" for="sub-cocaine">Cocaine</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Amphetamines" id="sub-amps" name="subs[]">
							<label class="form-check-label" for="sub-amps">Amphetamines</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Inhalants" id="sub-inhalants" name="subs[]">
							<label class="form-check-label" for="sub-inhalants">Inhalants</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Sedatives" id="sub-sedatives" name="subs[]">
							<label class="form-check-label" for="sub-sedatives">Sedatives</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="Hallucinogens" id="sub-hallu" name="subs[]">
							<label class="form-check-label" for="sub-hallu">Hallucinogens</label>
						</div>
					</div>
				</div>
			</div>

			<!-- Q2-7: For checked substances (rendered dynamically) -->
			<div id="assist8-dynamic"></div>

			<!-- Q8: Injection Use -->
			<div class="mb-3">
				<label class="form-label">Have you ever used any drug by injection (non-medical use)?</label>
				<select class="form-select" name="q8_injection">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</div>
		</form>

		<div class="d-flex gap-2">
			<button type="button" class="btn btn-secondary" onclick="backToSubstanceInitial()">Back</button>
			<button type="button" class="btn btn-warning" id="calc-assist8">Calculate ASSIST-8 Scores</button>
		</div>

		<div id="assist8-results" class="mt-3"></div>
	</div>
</div>

<script>
const ASSIST_SUBS = [
	'Tobacco','Alcohol','Cannabis','Cocaine','Amphetamines','Inhalants','Sedatives','Hallucinogens'
];

function buildAssistQuestionsFor(substance) {
	return `
		<div class="border rounded p-3 mb-3">
			<h6 class="mb-3">${substance}</h6>
			<div class="row g-2">
				<div class="col-md-6">
					<label class="form-label">Q2: Past 3 months use frequency</label>
					<select class="form-select" name="${substance}_q2">
						<option value="0">Never (0)</option>
						<option value="2">Once or twice (2)</option>
						<option value="3">Monthly (3)</option>
						<option value="4">Weekly (4)</option>
						<option value="6">Daily or almost daily (6)</option>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">Q3: Strong desire or urge</label>
					<select class="form-select" name="${substance}_q3">
						<option value="0">Never (0)</option>
						<option value="3">Once or twice (3)</option>
						<option value="4">Monthly (4)</option>
						<option value="5">Weekly (5)</option>
						<option value="6">Daily or almost daily (6)</option>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">Q4: Health, social, legal or financial problems</label>
					<select class="form-select" name="${substance}_q4">
						<option value="0">No, never (0)</option>
						<option value="4">Yes, in the past 3 months (4)</option>
						<option value="6">Yes, but not in the past 3 months (6)</option>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">Q5: Failed to do what was normally expected</label>
					<select class="form-select" name="${substance}_q5">
						<option value="0">No, never (0)</option>
						<option value="5">Yes, in the past 3 months (5)</option>
						<option value="6">Yes, but not in the past 3 months (6)</option>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">Q6: Friend/relative/others expressed concern</label>
					<select class="form-select" name="${substance}_q6">
						<option value="0">No, never (0)</option>
						<option value="3">Yes, in the past 3 months (3)</option>
						<option value="6">Yes, but not in the past 3 months (6)</option>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">Q7: Tried and failed to control, cut down or stop</label>
					<select class="form-select" name="${substance}_q7">
						<option value="0">No, never (0)</option>
						<option value="3">Yes, in the past 3 months (3)</option>
						<option value="6">Yes, but not in the past 3 months (6)</option>
					</select>
				</div>
			</div>
		</div>
	`;
}

function parseAssistScores(formData) {
	const selected = formData.getAll('subs[]');
	const results = [];
	for (const sub of selected) {
		let total = 0;
		for (let i=2;i<=7;i++) {
			const key = `${sub}_q${i}`;
			const val = Number(formData.get(key) ?? 0);
			if (sub === 'Tobacco' && i === 5) continue; // Skip Q5 for tobacco
			total += val;
		}
		// Interpret
		let level = 'Low';
		let remarks = 'Brief advice and monitoring.';
		if (sub === 'Alcohol') {
			if (total >= 11 && total <= 26) { level = 'Moderate'; remarks = 'Brief counseling and monitoring recommended.'; }
			else if (total >= 27) { level = 'High'; remarks = 'Further assessment and referral may be required.'; }
		} else {
			if (total >= 4 && total <= 26) { level = 'Moderate'; remarks = 'Brief counseling and monitoring recommended.'; }
			else if (total >= 27) { level = 'High'; remarks = 'Further assessment and referral may be required.'; }
		}
		results.push({ sub, total, level, remarks });
	}
	return results;
}

$(document).ready(function() {
	// Build dynamic Q2-7 for each checked substance
	$('#assist8-form input[type="checkbox"]').on('change', function() {
		const checked = ASSIST_SUBS.filter(s => $(`#assist8-form input[value='${s}']`).is(':checked'));
		const $dyn = $('#assist8-dynamic');
		$dyn.empty();
		checked.forEach(s => $dyn.append(buildAssistQuestionsFor(s)));
	});

	$('#calc-assist8').on('click', function() {
		const form = document.getElementById('assist8-form');
		const fd = new FormData(form);
		const results = parseAssistScores(fd);
		let html = '';
		results.forEach(r => {
			html += `
				<div class="alert alert-warning">
					<strong>${r.sub}</strong>: Total ${r.total} — <em>${r.level}</em><br/>
					Recommended Action: ${r.remarks}
				</div>
			`;
		});
		if ((fd.get('q8_injection') ?? '0') === '1') {
			html += `<div class="alert alert-danger">Provide information about the risks of injecting.</div>`;
		}
		$('#assist8-results').html(html || '<div class="alert alert-info">No substances selected.</div>');
	});
});
</script>


