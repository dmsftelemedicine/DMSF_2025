<div class="container-fluid">
    <!-- Main Social Connectedness Container -->
    <div id="social-connectedness-container">
        <!-- Initial Assessment Section -->
        <div id="social-initial-assessment">
            @include('patients.otherlmandvs.socialconnectednessforms.initial_assessment', ['patient' => $patient])
        </div>

        <!-- SCS-8 Assessment Section -->
        <div id="scs8-assessment" style="display: none;">
            @include('patients.otherlmandvs.socialconnectednessforms.scs8_assessment', ['patient' => $patient])
        </div>

        <!-- Family APGAR Assessment Section -->
        <div id="family-apgar-assessment" style="display: none;">
            @include('patients.otherlmandvs.socialconnectednessforms.family_apgar_assessment', ['patient' => $patient])
        </div>
    </div>
</div>

<script>
// Global functions for navigation between assessments
function showSCS8() {
    $('#social-initial-assessment').hide();
    $('#scs8-assessment').show();
    $('#family-apgar-assessment').hide();
    
    // Load SCS-8 data if available
    if (typeof loadSCS8Data === 'function') {
        loadSCS8Data();
    }
}

function showFamilyAPGAR() {
    $('#social-initial-assessment').hide();
    $('#scs8-assessment').hide();
    $('#family-apgar-assessment').show();
    
    // Load Family APGAR data if available
    if (typeof loadFamilyAPGARData === 'function') {
        loadFamilyAPGARData();
    }
}

function backToSocialInitial() {
    $('#social-initial-assessment').show();
    $('#scs8-assessment').hide();
    $('#family-apgar-assessment').hide();
}

// Initialize the social connectedness system
$(document).ready(function() {
    // Show initial assessment by default
    $('#social-initial-assessment').show();
    
    // Load any existing data
    if (typeof loadSocialData === 'function') {
        loadSocialData();
    }
});
</script> 