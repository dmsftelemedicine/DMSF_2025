<div class="row">
    <div class="col-4">
        <div class="list-group" id="management-list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-drug-prescription-list" data-bs-toggle="list" href="#list-drug-prescription" role="tab" aria-controls="list-drug-prescription">Drug Prescription</a>
            <a class="list-group-item list-group-item-action" id="list-diagnostic-request-list" data-bs-toggle="list" href="#list-diagnostic-request" role="tab" aria-controls="list-diagnostic-request">Diagnostic Request</a>
            <a class="list-group-item list-group-item-action" id="list-lifestyle-prescription-list" data-bs-toggle="list" href="#list-lifestyle-prescription" role="tab" aria-controls="list-lifestyle-prescription">Lifestyle Prescription</a>
            <a class="list-group-item list-group-item-action" id="list-medical-certificate-list" data-bs-toggle="list" href="#list-medical-certificate" role="tab" aria-controls="list-medical-certificate">Medical Certificate</a>
            <a class="list-group-item list-group-item-action" id="list-referral-form-list" data-bs-toggle="list" href="#list-referral-form" role="tab" aria-controls="list-referral-form">Referral Form</a>
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="management-nav-tabContent">
            <div class="tab-pane fade show active" id="list-drug-prescription" role="tabpanel" aria-labelledby="list-drug-prescription-list">
                @include('patients.management.components.drug_prescription', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="list-diagnostic-request" role="tabpanel" aria-labelledby="list-diagnostic-request-list">
                @include('patients.management.components.diagnostic_request', ['patient' => $patient])
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