<h2 class="text-xl font-bold mb-4">Eligibility Summary</h2>

<div id="eligibility-summary-content">
    <p class="text-gray-600 mb-4">Loading eligibility information...</p>
</div>

<script>
$(document).ready(function() {
    let patientId = '{{ $patient->id }}';
    
    // Function to fetch and display eligibility data
    function loadEligibilitySummary() {
        // Show loading state while fetching data (spinner icon from bootstrap)
        $('#eligibility-summary-content').html('<p class="text-gray-600 mb-4"><i class="fas fa-spinner fa-spin mr-2"></i>Loading eligibility information...</p>');
        
        // Fetch both inclusion and exclusion criteria data
        Promise.all([
            $.get(`/research-eligibility/check/${patientId}`),
            $.get(`/research-exclusion/check/${patientId}`)
        ]).then(function([inclusionResponse, exclusionResponse]) {
            if (!inclusionResponse || !exclusionResponse) {
                throw new Error('Invalid response received');
            }
            displayEligibilitySummary(inclusionResponse, exclusionResponse);
        }).catch(function(error) {
            const errorMessage = error.responseJSON?.message || error.statusText || error.message || 'Unknown error';
            const errorHtml = `
                <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-red-800 font-medium mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Error loading eligibility data
                    </p>
                    <p class="text-red-600 text-sm bg-white p-2 rounded border border-red-100">
                        ${errorMessage}
                    </p>
                </div>
            `;
            $('#eligibility-summary-content').html(errorHtml);
            console.error('Eligibility Summary Error:', error);
        });
    }
    
    // Load on initial page load
    loadEligibilitySummary();
    
    // Listen for completion events to refresh the summary
    document.addEventListener('inclusionCriteriaCompleted', function() {
        loadEligibilitySummary();
    });
    
    document.addEventListener('exclusionCriteriaCompleted', function() {
        loadEligibilitySummary();
    });
    
    function displayEligibilitySummary(inclusionResponse, exclusionResponse) {
        let html = '';
        
        // Check if both forms exist
        let inclusionComplete = inclusionResponse.form_exists;
        let exclusionComplete = exclusionResponse.form_exists;
        
        if (!inclusionComplete || !exclusionComplete) {
            html = `
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-yellow-800 font-medium flex items-center">
                        <!-- exclamation circle icon from FontAwesome -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-circle-fill inline-block mr-2" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                        </svg>
                        Please complete both Inclusion and Exclusion Criteria forms to view the eligibility summary.
                    </p>
                </div>
            `;
            $('#eligibility-summary-content').html(html);
            return;
        }
        
        let inclusionData = inclusionResponse.data;
        let exclusionData = exclusionResponse.data;
        
        // Determine eligibility status
        let isEligible = checkEligibility(inclusionData, exclusionData);
        
        html = `
            <div class="mb-6 p-4 rounded-lg ${isEligible ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'}">
                <h3 class="text-lg font-bold ${isEligible ? 'text-green-800' : 'text-red-800'} mb-2">
                    <i class="fas ${isEligible ? 'fa-check-circle' : 'fa-times-circle'} mr-2"></i>
                    ${isEligible ? 'Patient is ELIGIBLE' : 'Patient is NOT ELIGIBLE'}
                </h3>
                <p class="${isEligible ? 'text-green-700' : 'text-red-700'}">
                    ${isEligible ? 'The patient meets all inclusion criteria and has no exclusion criteria.' : 'The patient does not meet the eligibility requirements.'}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Inclusion Criteria Summary -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-check-square text-green-600 mr-2"></i>
                        Inclusion Criteria
                    </h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-700">Can read, write, and give consent:</span>
                            <span class="font-medium ${inclusionData.read_and_write_consent == 1 ? 'text-green-600' : 'text-red-600'}">
                                ${inclusionData.read_and_write_consent == 1 ? 'Yes' : 'No'}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Agrees to provide information:</span>
                            <span class="font-medium ${inclusionData.consent_for_info == 1 ? 'text-green-600' : 'text-red-600'}">
                                ${inclusionData.consent_for_info == 1 ? 'Yes' : 'No'}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Agrees to teleconsultation:</span>
                            <span class="font-medium ${inclusionData.consent_for_teleconsultation == 1 ? 'text-green-600' : 'text-red-600'}">
                                ${inclusionData.consent_for_teleconsultation == 1 ? 'Yes' : 'No'}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Meets clinical criteria:</span>
                            <span class="font-medium ${inclusionData.laboratory_finding == 1 ? 'text-green-600' : 'text-red-600'}">
                                ${inclusionData.laboratory_finding == 1 ? 'Yes' : 'No'}
                            </span>
                        </div>
                        <div class="pt-2 border-t border-gray-200">
                            <div class="flex justify-between">
                                <span class="text-gray-700">FBS Result:</span>
                                <span class="font-medium">${inclusionData.fbs_result !== null && inclusionData.fbs_result !== '' ? inclusionData.fbs_result + ' mg/dL (' + getfbsCondition(inclusionData.fbs_result) + ')' : 'Not given'}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-700">RBS Result:</span>
                                <span class="font-medium">${inclusionData.rbs_result !== null && inclusionData.rbs_result !== '' ? inclusionData.rbs_result + ' mg/dL (' + getRbsCondition(inclusionData.rbs_result) + ')' : 'Not given'}</span>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-gray-200">
                            <span class="text-gray-700 font-medium">Symptoms:</span>
                            <div class="ml-4 mt-1">
                                <div class="flex items-center">
                                    <i class="fas fa-${inclusionData.polyuria == 1 ? 'check text-green-600' : 'times text-gray-400'} mr-2"></i>
                                    <span class="${inclusionData.polyuria == 1 ? 'text-green-600' : 'text-gray-500'}">Polyuria</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-${inclusionData.polydipsia == 1 ? 'check text-green-600' : 'times text-gray-400'} mr-2"></i>
                                    <span class="${inclusionData.polydipsia == 1 ? 'text-green-600' : 'text-gray-500'}">Polydipsia</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-${inclusionData.polyphagia == 1 ? 'check text-green-600' : 'times text-gray-400'} mr-2"></i>
                                    <span class="${inclusionData.polyphagia == 1 ? 'text-green-600' : 'text-gray-500'}">Polyphagia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Exclusion Criteria Summary -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-times-circle text-red-600 mr-2"></i>
                        Exclusion Criteria
                    </h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-700">Emergency/Unstable Case:</span>
                            <span class="font-medium ${exclusionData.emergency_unstable_case === 'yes' ? 'text-red-600' : 'text-green-600'}">
                                ${capitalize(exclusionData.emergency_unstable_case)}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Psychiatric/Neurologic Condition:</span>
                            <span class="font-medium ${exclusionData.psychiatric_neuro_condition === 'yes' ? 'text-red-600' : 'text-green-600'}">
                                ${capitalize(exclusionData.psychiatric_neuro_condition)}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Unable to Give Complete Data:</span>
                            <span class="font-medium ${exclusionData.unable_complete_data === 'yes' ? 'text-red-600' : 'text-green-600'}">
                                ${capitalize(exclusionData.unable_complete_data)}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Confined/No Physical Activity:</span>
                            <span class="font-medium ${exclusionData.confined_or_no_activity === 'yes' ? 'text-red-600' : 'text-green-600'}">
                                ${capitalize(exclusionData.confined_or_no_activity)}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Unable to Feed/Cook/Decide:</span>
                            <span class="font-medium ${exclusionData.unable_feed_cook_decide === 'yes' ? 'text-red-600' : 'text-green-600'}">
                                ${capitalize(exclusionData.unable_feed_cook_decide)}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Pregnant Woman:</span>
                            <span class="font-medium ${exclusionData.pregnant_woman === 'yes' ? 'text-red-600' : 'text-green-600'}">
                                ${capitalize(exclusionData.pregnant_woman)}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#eligibility-summary-content').html(html);
    }
    
    function checkEligibility(inclusionData, exclusionData) {
        // Check if all inclusion criteria are met (all should be 1/Yes)
        let inclusionMet = inclusionData.read_and_write_consent == 1 &&
                          inclusionData.consent_for_info == 1 &&
                          inclusionData.consent_for_teleconsultation == 1 &&
                          inclusionData.laboratory_finding == 1;
        
        // Check if any exclusion criteria are met (all should be 'no' or 'na')
        let exclusionMet = exclusionData.emergency_unstable_case !== 'yes' &&
                          exclusionData.psychiatric_neuro_condition !== 'yes' &&
                          exclusionData.unable_complete_data !== 'yes' &&
                          exclusionData.confined_or_no_activity !== 'yes' &&
                          exclusionData.unable_feed_cook_decide !== 'yes' &&
                          exclusionData.pregnant_woman !== 'yes';
        
        return inclusionMet && exclusionMet;
    }
    
    function getfbsCondition(fbs) {
        if (fbs < 100) {
            return 'Normal';
        } else if (fbs >= 100 && fbs < 126) {
            return 'Prediabetes';
        } else {
            return 'Diabetes';
        }
    }
    
    function getRbsCondition(rbs) {
        if (rbs < 140) {
            return 'Normal';
        } else if (rbs >= 140 && rbs < 200) {
            return 'Prediabetes';
        } else {
            return 'Diabetes';
        }
    }
    
    function capitalize(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
});
</script>
