@php
    // Get consultations passed from parent
    $consultations = [
        1 => $consultation1 ?? null,
        2 => $consultation2 ?? null,
        3 => $consultation3 ?? null
    ];
    
    // Default to first consultation if available
    $activeConsultation = $consultation1 ?? $consultation2 ?? $consultation3 ?? null;
@endphp

<div class="row">
    <div class="col-4">
        <div class="list-group" id="lifestyle-measures-list" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-sleep-list" data-bs-toggle="list" href="#list-sleep" role="tab" aria-controls="list-sleep">Sleep Assessment</a>
            <a class="list-group-item list-group-item-action" id="list-stress-management-list" data-bs-toggle="list" href="#list-stress-management" role="tab" aria-controls="list-stress-management">Stress Management</a>
            <a class="list-group-item list-group-item-action" id="list-social-connectedness-list" data-bs-toggle="list" href="#list-social-connectedness" role="tab" aria-controls="list-social-connectedness">Social Connectedness</a>
            <a class="list-group-item list-group-item-action" id="list-substance-use-list" data-bs-toggle="list" href="#list-substance-use" role="tab" aria-controls="list-substance-use">Substance Use</a>
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="lifestyle-measures-tabContent">
            <div class="tab-pane fade show active" id="list-sleep" role="tabpanel" aria-labelledby="list-sleep-list">
                @include('patients.otherlmandvs.components.sleep_assessment', [
                    'patient' => $patient,
                    'consultation' => $activeConsultation,
                    'consultations' => $consultations
                ])
            </div>
            <div class="tab-pane fade" id="list-stress-management" role="tabpanel" aria-labelledby="list-stress-management-list">
                @include('patients.otherlmandvs.components.stress_management', [
                    'patient' => $patient,
                    'consultation' => $activeConsultation,
                    'consultations' => $consultations
                ])
            </div>
            <div class="tab-pane fade" id="list-social-connectedness" role="tabpanel" aria-labelledby="list-social-connectedness-list">
                @include('patients.otherlmandvs.components.social_connectedness', [
                    'patient' => $patient,
                    'consultation' => $activeConsultation,
                    'consultations' => $consultations
                ])
            </div>
            <div class="tab-pane fade" id="list-substance-use" role="tabpanel" aria-labelledby="list-substance-use-list">
                @include('patients.otherlmandvs.components.substance_use', [
                    'patient' => $patient,
                    'consultation' => $activeConsultation,
                    'consultations' => $consultations
                ])
            </div>
        </div>
    </div>
</div>

<script>
// Listen for consultation changes from parent
document.addEventListener('consultationChanged', function(event) {
    const { consultationId, consultationNumber } = event.detail;
    
    // Store active consultation data for lifestyle measures components
    window.lifestyleMeasuresConsultation = {
        id: consultationId,
        number: consultationNumber
    };
    
    // Notify all lifestyle measures components about the consultation change
    const lifestyleChangeEvent = new CustomEvent('lifestyleMeasuresConsultationChanged', {
        detail: {
            consultationId: consultationId,
            consultationNumber: consultationNumber
        }
    });
    document.dispatchEvent(lifestyleChangeEvent);
});

// Initialize with current consultation data
$(document).ready(function() {
    window.lifestyleMeasuresConsultation = {
        id: window.currentConsultationId,
        number: window.currentConsultationNumber
    };
});
</script> 