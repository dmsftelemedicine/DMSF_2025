<div class="card mb-4">
	<div class="card-header bg-primary text-white">
		<h4 class="mb-0">CAGE Questionnaire (CAGE-4)</h4>
	</div>
	<div class="card-body">
		<form id="cage4-form">
			<div class="mb-3">
				<label class="form-label">1. Have you ever felt you should Cut down on your drinking?</label>
				<select class="form-select" name="q1"><option value="0">No (0)</option><option value="1">Yes (1)</option></select>
			</div>
			<div class="mb-3">
				<label class="form-label">2. Have people Annoyed you by criticizing your drinking?</label>
				<select class="form-select" name="q2"><option value="0">No (0)</option><option value="1">Yes (1)</option></select>
			</div>
			<div class="mb-3">
				<label class="form-label">3. Have you ever felt bad or Guilty about your drinking?</label>
				<select class="form-select" name="q3"><option value="0">No (0)</option><option value="1">Yes (1)</option></select>
			</div>
			<div class="mb-3">
				<label class="form-label">4. Have you ever had a drink first thing in the morning (Eye-opener) to steady your nerves or get rid of a hangover?</label>
				<select class="form-select" name="q4"><option value="0">No (0)</option><option value="1">Yes (1)</option></select>
			</div>
		</form>

		<div class="d-flex gap-2">
			<button type="button" class="btn btn-secondary" onclick="backToSubstanceInitial()">Back</button>
			<button type="button" class="btn btn-primary" id="calc-cage4">Calculate CAGE-4 Score</button>
		</div>

		<div id="cage4-results" class="mt-3"></div>
	</div>
</div>

<script>
function interpretCAGE4(score) {
	if (score <= 1) return { level: 'Low likelihood', remarks: 'Continue monitoring and brief advice if needed.' };
	return { level: 'High likelihood', remarks: 'Further evaluation for alcohol use disorder is indicated.' };
}

$(document).ready(function() {
	$('#calc-cage4').on('click', function() {
		const data = Object.fromEntries(new FormData(document.getElementById('cage4-form')).entries());
		let total = 0;
		['q1','q2','q3','q4'].forEach(k => total += Number(data[k] ?? 0));
		const interp = interpretCAGE4(total);
		$('#cage4-results').html(`
			<div class="alert alert-primary">
				<strong>Total Score:</strong> ${total}<br/>
				<strong>Interpretation:</strong> ${interp.level}<br/>
				<strong>Remarks:</strong> ${interp.remarks}
			</div>
		`);
	});
});
</script>


