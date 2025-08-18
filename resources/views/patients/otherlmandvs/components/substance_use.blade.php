<div class="container-fluid">
    <!-- Main Substance Use Container -->
    @php
        $hist = isset($patient) ? $patient->comprehensiveHistory : null;
        $inlineIsSmoker = $hist && $hist->current_smoker ? 1 : 0;
        $inlineIsDrinker = $hist && $hist->current_drinker ? 1 : 0;
        $inlineIsDrugUser = $hist && $hist->current_drug_user ? 1 : 0;
        $sd = $hist ? (float) ($hist->alcohol_sd ?? 0) : 0;
        $freq = $hist ? ($hist->alcohol_frequency ?? 'per_day') : 'per_day';
        $stdPerDay = $sd;
        if ($freq === 'per_week') {
            $stdPerDay = $sd / 7.0;
        }
        $userSex = isset($patient->gender) ? (strtolower($patient->gender) === 'female' ? 'Female' : 'Male') : 'Male';
    @endphp
    <div id="substance-use-container" 
         data-is-current-smoker="{{ $inlineIsSmoker }}"
         data-is-current-drinker="{{ $inlineIsDrinker }}"
         data-is-current-drug-user="{{ $inlineIsDrugUser }}"
         data-standard-drinks-per-day="{{ $stdPerDay }}"
         data-user-sex="{{ $userSex }}">
        <!-- Initial Substance Use Assessment Section -->
        <div id="substance-initial-assessment">
            @include('patients.otherlmandvs.substanceuseforms.initial_assessment', ['patient' => $patient])
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
// Navigation between substance use assessments
function showFND6() {
    $('#substance-initial-assessment').hide();
    $('#fnd6-assessment').show();
    $('#cage4-assessment').hide();
    $('#assist8-assessment').hide();

    if (typeof loadFND6Data === 'function') {
        loadFND6Data();
    }
}

function showCAGE4() {
    $('#substance-initial-assessment').hide();
    $('#fnd6-assessment').hide();
    $('#cage4-assessment').show();
    $('#assist8-assessment').hide();

    if (typeof loadCAGE4Data === 'function') {
        loadCAGE4Data();
    }
}

function showASSIST8() {
    $('#substance-initial-assessment').hide();
    $('#fnd6-assessment').hide();
    $('#cage4-assessment').hide();
    $('#assist8-assessment').show();

    if (typeof loadASSIST8Data === 'function') {
        loadASSIST8Data();
    }
}

function backToSubstanceInitial() {
    $('#substance-initial-assessment').show();
    $('#fnd6-assessment').hide();
    $('#cage4-assessment').hide();
    $('#assist8-assessment').hide();
}

// Initialize
$(document).ready(function() {
    $('#substance-initial-assessment').show();
    if (typeof loadSubstanceData === 'function') { loadSubstanceData(); }
});
</script>


