<div class="card mb-4">
	<div class="card-header bg-dark text-white">
		<h4 class="mb-0">Fagerstrom Test for Nicotine Dependence (FND-6)</h4>
	</div>
	<div class="card-body">
		<form id="fnd6-form">
			<!-- Minimal scaffold; fill with full Q1-6 as needed -->
			<div class="mb-3">
				<label class="form-label">1. How soon after you wake up do you smoke your first cigarette?</label>
				<select class="form-select" name="q1">
					<option value="0">After 60 minutes (0)</option>
					<option value="1">31–60 minutes (1)</option>
					<option value="2">6–30 minutes (2)</option>
					<option value="3">Within 5 minutes (3)</option>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">2. Do you find it difficult to refrain from smoking in places where it is forbidden?</label>
				<select class="form-select" name="q2">
					<option value="0">No (0)</option>
					<option value="1">Yes (1)</option>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">3. Which cigarette would you hate most to give up?</label>
				<select class="form-select" name="q3">
					<option value="0">Any other (0)</option>
					<option value="1">The first one in the morning (1)</option>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">4. How many cigarettes per day do you smoke?</label>
				<select class="form-select" name="q4">
					<option value="0">10 or less (0)</option>
					<option value="1">11–20 (1)</option>
					<option value="2">21–30 (2)</option>
					<option value="3">31 or more (3)</option>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">5. Do you smoke more frequently during the first hours after waking than during the rest of the day?</label>
				<select class="form-select" name="q5">
					<option value="0">No (0)</option>
					<option value="1">Yes (1)</option>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">6. Do you smoke if you are so ill that you are in bed most of the day?</label>
				<select class="form-select" name="q6">
					<option value="0">No (0)</option>
					<option value="1">Yes (1)</option>
				</select>
			</div>
		</form>

		<div class="d-flex gap-2">
			<button type="button" class="btn btn-secondary" onclick="backToSubstanceInitial()">Back</button>
			<button type="button" class="btn btn-dark" id="calc-fnd6">Calculate FND-6 Score</button>
		</div>

		<div id="fnd6-results" class="mt-3"></div>
	</div>
</div>

<script>
function interpretFND6(score) {
	if (score <= 2) return { level: 'Low', remarks: 'Minimal nicotine dependence.' };
	if (score <= 4) return { level: 'Low-Moderate', remarks: 'Consider brief advice and monitoring.' };
	if (score <= 7) return { level: 'Moderate', remarks: 'Consider pharmacotherapy and counseling.' };
	return { level: 'High', remarks: 'Strongly consider intensive cessation support.' };
}

$(document).ready(function() {
	$('#calc-fnd6').on('click', function() {
		const data = Object.fromEntries(new FormData(document.getElementById('fnd6-form')).entries());
		let total = 0;
		['q1','q2','q3','q4','q5','q6'].forEach(k => total += Number(data[k] ?? 0));
		const interp = interpretFND6(total);
		$('#fnd6-results').html(`
			<div class="alert alert-dark">
				<strong>Total Score:</strong> ${total}<br/>
				<strong>Level:</strong> ${interp.level}<br/>
				<strong>Remarks:</strong> ${interp.remarks}
			</div>
		`);
	});
});
</script>


