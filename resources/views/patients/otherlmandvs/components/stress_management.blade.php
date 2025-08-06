<div class="container-fluid">
    <!-- Main Stress Management Container -->
    <div id="stress-management-container">
        <!-- Initial Assessment Section -->
        <div id="initial-assessment">
            @include('patients.otherlmandvs.stressmanagementforms.initial_assessment', ['patient' => $patient])
        </div>

        <!-- GAD-7 Assessment Section -->
        <div id="gad7-assessment" style="display: none;">
            @include('patients.otherlmandvs.stressmanagementforms.gad7_assessment', ['patient' => $patient])
        </div>

        <!-- PHQ-9 Assessment Section -->
        <div id="phq9-assessment" style="display: none;">
            @include('patients.otherlmandvs.stressmanagementforms.phq9_assessment', ['patient' => $patient])
        </div>

        <!-- PSS-4 Assessment Section -->
        <div id="pss4-assessment" style="display: none;">
            @include('patients.otherlmandvs.stressmanagementforms.pss4_assessment', ['patient' => $patient])
        </div>
    </div>
</div>

<script>
// Global functions for navigation between assessments
function showGAD7() {
    $('#initial-assessment').hide();
    $('#gad7-assessment').show();
    $('#phq9-assessment').hide();
    $('#pss4-assessment').hide();
    
    // Load GAD-7 data if available
    if (typeof loadGAD7Data === 'function') {
        loadGAD7Data();
    }
}

function showPHQ9() {
    $('#initial-assessment').hide();
    $('#gad7-assessment').hide();
    $('#phq9-assessment').show();
    $('#pss4-assessment').hide();
    
    // Load PHQ-9 data if available
    if (typeof loadPHQ9Data === 'function') {
        loadPHQ9Data();
    }
}

function showPSS4() {
    $('#initial-assessment').hide();
    $('#gad7-assessment').hide();
    $('#phq9-assessment').hide();
    $('#pss4-assessment').show();
    
    // Load PSS-4 data if available
    if (typeof loadPSS4Data === 'function') {
        loadPSS4Data();
    }
}

function backToInitial() {
    $('#initial-assessment').show();
    $('#gad7-assessment').hide();
    $('#phq9-assessment').hide();
    $('#pss4-assessment').hide();
}

// Initialize the stress management system
$(document).ready(function() {
    // Show initial assessment by default
    $('#initial-assessment').show();
    
    // Load any existing data
    if (typeof loadStressData === 'function') {
        loadStressData();
    }
});
</script> 