<div class="container-fluid">
    <!-- Main Sleep Assessment Container -->
    <div id="sleep-assessment-container">
        <!-- Initial Sleep Assessment Section -->
        <div id="sleep-initial-assessment">
            @include('patients.otherlmandvs.sleepforms.initial_assessment', ['patient' => $patient])
        </div>

        <!-- ISI-7 Assessment Section -->
        <div id="isi7-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.isi7_assessment', ['patient' => $patient])
        </div>

        <!-- ESS-8 Assessment Section -->
        <div id="ess8-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.ess8_assessment', ['patient' => $patient])
        </div>

        <!-- SHI-13 Assessment Section -->
        <div id="shi13-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.shi13_assessment', ['patient' => $patient])
        </div>

        <!-- STOP-BANG Assessment Section -->
        <div id="stopbang-assessment" style="display: none;">
            @include('patients.otherlmandvs.sleepforms.stopbang_assessment', ['patient' => $patient])
        </div>
    </div>
</div>

<script>
// Global functions for navigation between sleep assessments
function showISI7() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').show();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').hide();
    
    // Load ISI-7 data if available
    if (typeof loadISI7Data === 'function') {
        loadISI7Data();
    }
}

function showESS8() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').show();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').hide();
    
    // Load ESS-8 data if available
    if (typeof loadESS8Data === 'function') {
        loadESS8Data();
    }
}

function showSHI13() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').show();
    $('#stopbang-assessment').hide();
    
    // Load SHI-13 data if available
    if (typeof loadSHI13Data === 'function') {
        loadSHI13Data();
    }
}

function showSTOPBANG() {
    $('#sleep-initial-assessment').hide();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').show();
    
    // Load STOP-BANG data if available
    if (typeof loadSTOPBANGData === 'function') {
        loadSTOPBANGData();
    }
}

function backToSleepInitial() {
    $('#sleep-initial-assessment').show();
    $('#isi7-assessment').hide();
    $('#ess8-assessment').hide();
    $('#shi13-assessment').hide();
    $('#stopbang-assessment').hide();
}

// Initialize the sleep assessment system
$(document).ready(function() {
    // Show initial assessment by default
    $('#sleep-initial-assessment').show();
    
    // Load any existing data
    if (typeof loadSleepData === 'function') {
        loadSleepData();
    }
});
</script> 