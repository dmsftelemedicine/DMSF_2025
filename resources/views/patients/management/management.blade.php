<style>
    .clearfix:after {
        clear: both;
        content: "";
        display: block;
        height: 0;
    }

    .progress-tabs {
        padding: 20px 5%;
        position: relative;
        font-family: 'Lato', sans-serif;
    }

    .progress-bar-container {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        position: relative;
        margin: 1.5rem 0;
        max-width: 100%;
        overflow: hidden;
    }

    .progress-tabs .list-group {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        position: relative;
        margin: 0;
        max-width: 100%;
        flex-wrap: nowrap;
    }

    .arrow-steps {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        width: 100%;
        gap: 0;
        margin: 0;
    }

    .arrow-steps .list-group-item {
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        color: #666;
        cursor: pointer;
        margin: 0;
        margin-right: -25px;
        padding: 12px 35px 12px 35px;
        min-width: 160px;
        flex: 1;
        position: relative;
        background-color: #FFFFFF;
        border: 1px solid #BFBFBF;
        color: #666;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; 
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        text-decoration: none;
        max-width: 200px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 2;
    }

    /* Modern clip-path approach for clean arrow shapes */
    .arrow-steps .list-group-item {
        clip-path: polygon(0 0, calc(100% - 25px) 0, 100% 50%, calc(100% - 25px) 100%, 0 100%, 25px 50%);
    }

    .arrow-steps .list-group-item:first-child {
        clip-path: polygon(0 0, calc(100% - 25px) 0, 100% 50%, calc(100% - 25px) 100%, 0 100%, 0 50%);
    }

    .arrow-steps .list-group-item:last-child {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%, 25px 50%);
    }

    .arrow-steps .list-group-item span {
        display: block;
    }

    .arrow-steps .list-group-item .step-title {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 2px;
    }

    .arrow-steps .list-group-item .step-subtitle {
        font-size: 10px;
        opacity: 0.8;
        font-weight: 400;
    }

    .arrow-steps .list-group-item.active {
        color: #fff;
        background-color: #236477;
        border: 1px solid #173042;
    }

    .arrow-steps .list-group-item.completed {
        color: #7CAD3E;
        background-color: #EBFCD6;
        border: 1px solid #7CAD3E;
    }

    /* Active state takes priority over completed state */
    .arrow-steps .list-group-item.active.completed {
        color: #fff;
        background-color: #236477;
        border: 1px solid #173042;
    }

    .management-content {
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
            <div class="progress-bar-container">
                <div class="list-group arrow-steps clearfix" id="management-list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-drug-prescription-list" data-bs-toggle="list" href="#list-drug-prescription" role="tab" aria-controls="list-drug-prescription">
                    <span>
                        <div class="step-title">Drug Prescription</div>
                        <div class="step-subtitle">Medication orders</div>
                    </span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-diagnostic-request-list" data-bs-toggle="list" href="#list-diagnostic-request" role="tab" aria-controls="list-diagnostic-request">
                    <span>
                        <div class="step-title">Diagnostic Request</div>
                        <div class="step-subtitle">Lab & imaging</div>
                    </span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-lifestyle-prescription-list" data-bs-toggle="list" href="#list-lifestyle-prescription" role="tab" aria-controls="list-lifestyle-prescription">
                    <span>
                        <div class="step-title">Lifestyle Prescription</div>
                        <div class="step-subtitle">Health recommendations</div>
                    </span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-medical-certificate-list" data-bs-toggle="list" href="#list-medical-certificate" role="tab" aria-controls="list-medical-certificate">
                    <span>
                        <div class="step-title">Medical Certificate</div>
                        <div class="step-subtitle">Official documentation</div>
                    </span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-referral-form-list" data-bs-toggle="list" href="#list-referral-form" role="tab" aria-controls="list-referral-form">
                    <span>
                        <div class="step-title">Referral Form</div>
                        <div class="step-subtitle">Specialist referral</div>
                    </span>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="management-content">
            <div class="tab-content" id="management-nav-tabContent">
                <div class="tab-pane fade show active" id="list-drug-prescription" role="tabpanel" aria-labelledby="list-drug-prescription-list">
                    @include('patients.management.components.drug_prescription.drug_prescription', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-diagnostic-request" role="tabpanel" aria-labelledby="list-diagnostic-request-list">
                    @include('patients.management.components.diagnostic_request.diagnostic_request', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-lifestyle-prescription" role="tabpanel" aria-labelledby="list-lifestyle-prescription-list">
                    @include('patients.management.components.lifestyle_prescription', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-medical-certificate" role="tabpanel" aria-labelledby="list-medical-certificate-list">
                    @include('patients.management.components.medical_certificate', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-referral-form" role="tabpanel" aria-labelledby="list-referral-form-list">
                    @include('patients.management.components.referral_form', ['patient' => $patient])
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Arrow progress bar navigation functionality for Management tab
$(document).ready(function() {
    // Handle tab click events for arrow progress bar
    $('#management-list-tab .list-group-item').on('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all items
        $('#management-list-tab .list-group-item').removeClass('active');
        
        // Add active class to clicked item
        $(this).addClass('active');
        
        // Get target tab
        const targetTab = $(this).attr('href');
        
        // Hide all tab panes
        $('#management-nav-tabContent .tab-pane').removeClass('show active');
        
        // Show target tab pane
        $(targetTab).addClass('show active');
        
        // Update progress bar visual state
        updateManagementProgressBarState($(this));
    });

    // Function to update progress bar visual state
    function updateManagementProgressBarState(activeItem) {
        const allItems = $('#management-list-tab .list-group-item');
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
    const firstManagementItem = $('#management-list-tab .list-group-item:first');
    updateManagementProgressBarState(firstManagementItem);

    // Handle Bootstrap tab events to sync with progress bar
    $('#management-list-tab a[data-bs-toggle="list"]').on('shown.bs.tab', function (e) {
        const targetItem = $(e.target);
        updateManagementProgressBarState(targetItem);
    });
});
</script> 