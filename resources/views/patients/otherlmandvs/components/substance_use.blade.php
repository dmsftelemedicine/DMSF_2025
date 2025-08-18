<div class="container-fluid">
	<!-- Main Substance Use Container -->
	<div id="substance-use-container">
		<!-- Initial Recommendation Section (auto from history) -->
		<div id="substance-initial-recommendations">
			@include('patients.otherlmandvs.substanceuseforms.initial_recommendations', ['patient' => $patient])
		</div>

		<!-- FND-6 Assessment Section -->
		<div id="fnd6-assessment" style="display: none;">
			@include('patients.otherlmandvs.substanceuseforms.fnd6_assessment', ['patient' => $patient])
		</div>

		<!-- CAGE-4 Assessment Section -->
		<div id="cage4-assessment" style="display: none;">
			@include('patients.otherlmandvs.substanceuseforms.cage4_assessment', ['patient' => $patient])
		</div>

		<!-- ASSIST-8 Assessment Section -->
		<div id="assist8-assessment" style="display: none;">
			@include('patients.otherlmandvs.substanceuseforms.assist8_assessment', ['patient' => $patient])
		</div>
	</div>
</div>

<script>
// Navigation functions
function showFND6() {
	$('#substance-initial-recommendations').hide();
	$('#fnd6-assessment').show();
	$('#cage4-assessment').hide();
	$('#assist8-assessment').hide();
	if (typeof loadFND6Data === 'function') { loadFND6Data(); }
}

function showCAGE4() {
	$('#substance-initial-recommendations').hide();
	$('#fnd6-assessment').hide();
	$('#cage4-assessment').show();
	$('#assist8-assessment').hide();
	if (typeof loadCAGE4Data === 'function') { loadCAGE4Data(); }
}

function showASSIST8() {
	$('#substance-initial-recommendations').hide();
	$('#fnd6-assessment').hide();
	$('#cage4-assessment').hide();
	$('#assist8-assessment').show();
	if (typeof loadASSIST8Data === 'function') { loadASSIST8Data(); }
}

function backToSubstanceInitial() {
	$('#substance-initial-recommendations').show();
	$('#fnd6-assessment').hide();
	$('#cage4-assessment').hide();
	$('#assist8-assessment').hide();
}

// Initialize
$(document).ready(function() {
	$('#substance-initial-recommendations').show();
	if (typeof loadSubstanceHistoryAndRecommend === 'function') {
		loadSubstanceHistoryAndRecommend();
	}
});
</script>


