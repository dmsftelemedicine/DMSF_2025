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

<style>
    .clearfix:after {
        clear: both;
        content: "";
        display: block;
        height: 0;
    }

    .progress-tabs {
        padding: 20px 10%;
        position: relative;
        font-family: 'Lato', sans-serif;
    }

    .progress-tabs .list-group {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        position: relative;
        margin: 2rem 0;
        max-width: 100%;
        margin-top: 0;
        flex-wrap: nowrap;
    }

    .arrow-steps {
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 100%;
        gap: 10px;
    }

    .arrow-steps .list-group-item {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        color: #666;
        cursor: pointer;
        margin: 0;
        padding: 15px 15px 15px 30px;
        min-width: 180px;
        flex: 1;
        position: relative;
        background-color: #e5e7eb;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; 
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        text-decoration: none;
        max-width: 250px;
    }

    .arrow-steps .list-group-item:after,
    .arrow-steps .list-group-item:before {
        content: " ";
        position: absolute;
        top: 0;
        right: -15px;
        width: 0;
        height: 0;
        border-top: 25px solid transparent;
        border-bottom: 25px solid transparent;
        border-left: 15px solid #e5e7eb;	
        z-index: 2;
        transition: all 0.3s ease;
    }

    .arrow-steps .list-group-item:before {
        right: auto;
        left: 0;
        border-left: 15px solid #fff;	
        z-index: 0;
    }

    .arrow-steps .list-group-item:first-child:before {
        border: none;
    }

    .arrow-steps .list-group-item:first-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .arrow-steps .list-group-item span {
        display: block;
    }

    .arrow-steps .list-group-item .step-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .arrow-steps .list-group-item .step-subtitle {
        font-size: 11px;
        opacity: 0.8;
        font-weight: 400;
    }

    .arrow-steps .list-group-item.active {
        color: #fff;
        background-color: #0891b2;
    }

    .arrow-steps .list-group-item.active:after {
        border-left: 15px solid #0891b2;	
    }

    .arrow-steps .list-group-item.completed {
        color: #ffffff;
        background-color: #10b981;
    }

    .arrow-steps .list-group-item.completed:after {
        border-left: 15px solid #10b981;	
    }

    .arrow-steps .list-group-item:last-child:after {
        display: none;
    }

    .arrow-steps .list-group-item:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .lifestyle-content {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-top: 2rem;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="progress-tabs">
            <div class="list-group arrow-steps clearfix" id="lifestyle-measures-list" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-sleep-list" data-bs-toggle="list" href="#list-sleep" role="tab" aria-controls="list-sleep">
                    <span>
                        <div class="step-title">Sleep Assessment</div>
                        <div class="step-subtitle">Rest evaluation</div>
                    </span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-stress-management-list" data-bs-toggle="list" href="#list-stress-management" role="tab" aria-controls="list-stress-management">
                    <span>
                        <div class="step-title">Stress Management</div>
                        <div class="step-subtitle">Mental health</div>
                    </span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-social-connectedness-list" data-bs-toggle="list" href="#list-social-connectedness" role="tab" aria-controls="list-social-connectedness">
                    <span>
                        <div class="step-title">Social Connectedness</div>
                        <div class="step-subtitle">Community support</div>
                    </span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-substance-use-list" data-bs-toggle="list" href="#list-substance-use" role="tab" aria-controls="list-substance-use">
                    <span>
                        <div class="step-title">Substance Use</div>
                        <div class="step-subtitle">Usage screening</div>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="lifestyle-content">
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

// Arrow progress bar navigation functionality
$(document).ready(function() {
    // Initialize with current consultation data
    window.lifestyleMeasuresConsultation = {
        id: window.currentConsultationId,
        number: window.currentConsultationNumber
    };

    // Handle tab click events for arrow progress bar
    $('#lifestyle-measures-list .list-group-item').on('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all items
        $('#lifestyle-measures-list .list-group-item').removeClass('active');
        
        // Add active class to clicked item
        $(this).addClass('active');
        
        // Get target tab
        const targetTab = $(this).attr('href');
        
        // Hide all tab panes
        $('#lifestyle-measures-tabContent .tab-pane').removeClass('show active');
        
        // Show target tab pane
        $(targetTab).addClass('show active');
        
        // Update progress bar visual state
        updateProgressBarState($(this));
    });

    // Function to update progress bar visual state
    function updateProgressBarState(activeItem) {
        const allItems = $('#lifestyle-measures-list .list-group-item');
        const activeIndex = allItems.index(activeItem);
        
        // Mark all previous items as completed
        allItems.each(function(index) {
            $(this).removeClass('active completed');
            
            if (index < activeIndex) {
                $(this).addClass('completed');
            } else if (index === activeIndex) {
                $(this).addClass('active');
            }
        });
    }

    // Initialize first item as active
    const firstItem = $('#lifestyle-measures-list .list-group-item:first');
    updateProgressBarState(firstItem);

    // Handle Bootstrap tab events to sync with progress bar
    $('a[data-bs-toggle="list"]').on('shown.bs.tab', function (e) {
        const targetItem = $(e.target);
        updateProgressBarState(targetItem);
    });
});
</script> 