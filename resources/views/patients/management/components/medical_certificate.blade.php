<!-- Management View (Default) -->
<div id="management-view" class="container-fluid">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">
                <i class="fas fa-certificate me-2"></i>
                Medical Certificate Management
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCertificateModal">
                        <i class="fas fa-plus me-1"></i>
                        Issue Medical Certificate
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="medical-certificates-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Date Issued</th>
                            <th>Certificate Type</th>
                            <th>Purpose</th>
                            <th>Valid Until</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="certificates-tbody">
                        <!-- Dynamic content will be loaded here -->
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-1"></i> Certificate Templates Available:</h6>
                        <ul class="mb-0">
                            <li><strong>Fitness for Work:</strong> Standard medical clearance for employment</li>
                            <li><strong>Medical Leave:</strong> Certificate for sick leave or medical absence</li>
                            <li><strong>Travel Clearance:</strong> Medical fitness for travel</li>
                            <li><strong>School/Sports:</strong> Physical fitness for activities</li>
                            <li><strong>Custom Certificate:</strong> Tailored medical documentation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Certificate Print View (Hidden by default) -->
<div id="certificate-view" class="medical-certificate-container" style="display: none;">
    <div class="certificate-page">
        <!-- Header Section -->
        <div class="certificate-header">
            <div class="logo-section">
                <div class="medical-logo">
                    <img src="{{ asset('images/dmsf_logo_transparent.png') }}" alt="DMSF Logo">
                </div>
            </div>
            <div class="institution-info">
                <h2 class="institution-name">DAVAO MEDICAL SCHOOL FOUNDATION</h2>
                <h3 class="institution-location">DAVAO CITY</h3>
                <h1 class="certificate-title">MEDICAL CERTIFICATE</h1>
            </div>
            <div class="date-section">
                <div class="date-field">
                    <span class="date-value" id="cert-date">{{ date('F j, Y') }}</span>
                    <div class="underline"></div>
                    <span class="field-label">Date</span>
                </div>
            </div>
        </div>

        <!-- Certificate Body -->
        <div class="certificate-body">
            <div class="salutation">
                <strong>TO WHOM IT MAY CONCERN:</strong>
            </div>

            <div class="certification-text">
                <p style="margin-left: 90px">This is to certify that
                    <span class="field-value name-field" id="cert-patient-name">{{ $patient->first_name ?? '' }} {{ $patient->middle_name ?? '' }} {{ $patient->last_name ?? '' }}</span>,
                    <span class="field-value short" id="cert-patient-age">{{ $patient->age ?? '' }}</span> years old
                </p>
                <p>of
                    <span class="field-value long" id="cert-patient-address">{{ $patient->address ?? '' }}</span> has been treated/examined last
                    <span class="field-value medium" id="cert-exam-date"></span>
                </p>
            </div>

            <!-- Diagnosis Section -->
            <div class="section-block">
                <div class="section-header">
                    <strong>DIAGNOSIS:</strong>
                </div>
                <div class="section-content">
                    <div class="content-line">
                        <span class="field-value full-width" id="cert-diagnosis"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                </div>
            </div>

            <!-- Remarks Section -->
            <div class="section-block">
                <div class="section-header">
                    <strong>REMARKS:</strong>
                </div>
                <div class="section-content">
                    <div class="content-line">
                        <span class="field-value full-width" id="cert-remarks"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                </div>
            </div>

            <!-- Physician Signature Section -->
            <div class="signature-section">
                <div class="signature-block">
                    <div class="signature-line">
                        <span class="field-value signature-field" id="cert-physician"></span>
                    </div>
                    <div class="signature-label">Physician</div>
                </div>

                <div class="credentials-block">
                    <div class="credential-line">
                        <span class="credential-label">License No.</span>
                        <span class="field-value credential-field" id="cert-license"></span>
                    </div>
                    <div class="credential-line">
                        <span class="credential-label">PTR No.</span>
                        <span class="field-value credential-field" id="cert-ptr"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Controls -->
    <div class="print-controls d-print-none text-center">
        <button type="button" class="btn btn-secondary me-2" onclick="showManagementView()">
            <i class="fas fa-arrow-left me-1"></i>
            Back to Management
        </button>
        <button type="button" class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print me-1"></i>
            Print Certificate
        </button>
    </div>
</div>
<style>
    .medical-certificate-container {
        max-width: 8.5in;
        margin: 0 auto 3rem auto;
        background: white;
        font-family: 'Times New Roman', serif;
        color: #000;
        line-height: 1;
        padding-bottom: 2rem;
    }

    .certificate-page {
        padding: 25px 45px;
        width: 8.5in;
        height: 5.5in;
        background: white;
        page-break-inside: avoid;
        margin-bottom: 0;
        box-sizing: border-box;
    }

    /* Header Styles */
    .certificate-header {
        display: flex;
        align-items: flex-start;
        margin-bottom: 8px;
        position: relative;
    }

    .logo-section {
        width: 65px;
        height: 65px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .medical-logo {
        width: 100%;
        height: 100%;
    }

    .medical-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .institution-info {
        flex: 1;
        text-align: center;
    }

    .institution-name {
        font-size: 13pt;
        font-weight: bold;
        margin: 0;
        letter-spacing: 1px;
    }

    .institution-location {
        font-size: 11pt;
        font-weight: bold;
        margin: 5px 0;
        letter-spacing: 0.3px;
    }

    .certificate-title {
        font-size: 15pt;
        font-weight: bold;
        margin: 10px 0 0 0;
        letter-spacing: 2px;
    }

    .date-section {
        width: 120px;
        text-align: center;
        flex-shrink: 0;
    }

    .date-field {
        text-align: center;
    }

    .date-value {
        display: block;
        margin-bottom: 3px;
        font-size: 11pt;
        border-bottom: 1px solid #000;
        padding-bottom: 3px;
    }

    .underline {
        height: 1px;
        background: #000;
        margin: 2px 0;
    }

    .field-label {
        font-size: 10pt;
        margin-top: 3px;
        display: block;
    }

    /* Body Styles */
    .certificate-body {
        margin-top: 0;
    }

    .salutation {
        margin: 15px 0 10px 0;
        font-size: 11pt;
        font-weight: bold;
    }

    .certification-text p {
        margin: 8px 0;
        font-size: 11pt;
        line-height: 1.6;
    }

    .field-value {
        font-weight: bold;
        display: inline-block;
        min-width: 65px;
        border-bottom: 1px solid #000;
        padding: 0 10px 2px 10px;
        margin: 0 2px;
        text-align: center;
    }

    .field-value.short {
        min-width: 40px;
        width: 40px;
    }

    .field-value.medium {
        min-width: 120px;
        width: 120px;
    }

    .field-value.long {
        min-width: 350px;
        width: 350px;
    }

    .field-value.full-width {
        min-width: 100%;
        width: 100%;
        margin: 0;
    }

    .field-value.name-field {
        min-width: 300px;
    }

    .field-value.signature-field {
        min-width: 180px;
        width: 180px;
    }

    .field-value.credential-field {
        min-width: 100px;
        width: 100px;
    }

    .underline-field {
        display: inline-block;
        border-bottom: 1px solid #000;
        margin: 0 3px;
        min-height: 16px;
    }

    /* Section Styles */
    .section-block {
        margin-top: 15px;
    }

    .section-header {
        font-size: 11pt;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .content-line {
        margin: 6px 0;
        min-height: 18px;
        border-bottom: 1px solid #000;
        padding: 2px 0;
        font-size: 10pt;
    }

    /* Signature Section */
    .signature-section {
        margin-top: 30px;
        margin-bottom: 0;
        display: flex;
        justify-content: flex-end;
        align-items: flex-start;
        padding-right: 30px;
    }

    .signature-block {
        text-align: center;
        margin-right: 1.5rem;
    }

    .signature-line {
        margin-bottom: 3px;
        border-bottom: 1px solid #000;
        min-width: 180px;
        padding-bottom: 2px;
        font-size: 10pt;
    }

    .signature-underline {
        width: 150px;
        height: 1px;
        background: #000;
        margin: 3px auto;
    }

    .signature-label {
        font-size: 9pt;
        margin-top: 3px;
    }

    .credentials-block {
        text-align: left;
    }

    .credential-line {
        margin: 2px 0;
        display: flex;
        align-items: center;
    }

    .credential-label {
        font-size: 9pt;
        margin-right: 8px;
        min-width: 70px;
    }

    .credential-underline {
        flex: 1;
        height: 1px;
        background: #000;
        margin-left: 8px;
        max-width: 100px;
        border-bottom: 1px solid #000;
        display: inline-block;
        min-width: 100px;
    }

    /* Print controls positioning */
    .print-controls {
        margin-top: 1rem !important;
        padding: 3rem 0;
        border-top: 1px solid #dee2e6;
        clear: both;
    }

    /* Print Styles */
    @media print {

        /* Hide everything except the certificate */
        body * {
            visibility: hidden;
        }

        #certificate-view,
        #certificate-view * {
            visibility: visible;
        }

        #certificate-view {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }

        .medical-certificate-container {
            margin: 0;
            max-width: none;
            width: 100%;
            padding-bottom: 0;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }

        .certificate-page {
            padding: 25px 45px;
            margin: 0;
            box-shadow: none;
            height: auto;
            min-height: auto;
            max-height: none;
            width: 8.5in;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }

        .certificate-header {
            margin-bottom: 8px;
            page-break-after: avoid;
        }

        .certificate-body {
            margin-top: 0;
            page-break-inside: avoid;
        }

        .section-block {
            margin-top: 15px;
            page-break-inside: avoid;
        }

        .signature-section {
            margin-top: 30px;
            page-break-before: avoid;
        }

        body {
            background: white !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @page {
            size: 8.5in 5.5in landscape;
            margin: 0;
        }

        @page :first {
            margin: 0;
        }
    }

    /* Empty field styling for better visibility */
    .field-value:empty::after {
        content: "\00a0";
        text-decoration: underline;
        display: inline-block;
        width: 65px;
    }
</style>

<!-- Add Medical Certificate Modal -->
<div class="modal fade" id="addCertificateModal" tabindex="-1" aria-labelledby="addCertificateModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="addCertificateModalLabel">
                    <i class="fas fa-certificate me-2"></i>Issue Medical Certificate
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="medical-certificate-form">
                    @csrf
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    
                    <!-- Patient Information Section -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-user me-2"></i>Patient Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="patientAddress" class="form-label">Patient Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="patientAddress" name="patient_address" 
                                           value="{{ $patient->address ?? '' }}" placeholder="Complete patient address" required>
                                    <small class="form-text text-muted">This will appear on the certificate</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Certificate Details Section -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-file-medical me-2"></i>Certificate Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="certificateType" class="form-label">Certificate Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="certificateType" name="certificate_type" required>
                                        <option value="">Select certificate type</option>
                                        <option value="fitness_work">Fitness for Work</option>
                                        <option value="medical_leave">Medical Leave</option>
                                        <option value="travel_clearance">Travel Clearance</option>
                                        <option value="school_sports">School/Sports</option>
                                        <option value="custom">Custom Certificate</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="purpose" class="form-label">Purpose <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="purpose" name="purpose" 
                                           placeholder="e.g., Return to work after illness" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="issueDate" class="form-label">Issue Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="issueDate" name="date_issued" 
                                           value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validUntil" class="form-label">Valid Until</label>
                                    <input type="date" class="form-control" id="validUntil" name="valid_until">
                                    <small class="form-text text-muted">Leave blank for no expiry</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Information Section -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-stethoscope me-2"></i>Medical Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="medicalFindings" class="form-label">Medical Findings/Diagnosis</label>
                                <textarea class="form-control" id="medicalFindings" name="medical_findings" rows="3" 
                                          placeholder="Brief medical assessment and findings"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="recommendations" class="form-label">Recommendations/Remarks</label>
                                <textarea class="form-control" id="recommendations" name="recommendations" rows="3" 
                                          placeholder="Any work restrictions or recommendations"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Physician Information Section -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-user-md me-2"></i>Physician Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                     <label for="issuingDoctor" class="form-label">Issuing Doctor <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="issuingDoctor" name="issuing_doctor" 
                         placeholder="Dr. Juan Dela Cruz" value="{{ auth()->user()->display_name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="licenseNumber" class="form-label">License Number</label>
                     <input type="text" class="form-control" id="licenseNumber" name="license_number" 
                         placeholder="e.g., 0123456" value="{{ auth()->user()->license_number ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ptrNumber" class="form-label">PTR Number</label>
                     <input type="text" class="form-control" id="ptrNumber" name="ptr_number" 
                         placeholder="e.g., 1234567" value="{{ auth()->user()->ptr_number ?? '' }}">
                                    <small class="form-text text-muted">Professional Tax Receipt Number</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-outline-primary" id="preview-certificate-btn">
                    <i class="fas fa-eye me-1"></i>Preview
                </button>
                <button type="button" class="btn btn-primary" id="issue-certificate-btn">
                    <i class="fas fa-save me-1"></i>Issue Certificate
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Preview Certificate Modal -->
<div class="modal fade" id="previewCertificateModal" tabindex="-1" aria-labelledby="previewCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="previewCertificateModalLabel">
                    <i class="fas fa-eye me-2"></i>Certificate Preview
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="medical-certificate-preview">
                    <div class="certificate-page-preview">
                        <!-- Header Section -->
                        <div class="certificate-header">
                            <div class="logo-section">
                                <div class="medical-logo">
                                    <img src="{{ asset('images/dmsf_logo_transparent.png') }}" alt="DMSF Logo">
                                </div>
                            </div>
                            <div class="institution-info">
                                <h2 class="institution-name">DAVAO MEDICAL SCHOOL FOUNDATION</h2>
                                <h3 class="institution-location">DAVAO CITY</h3>
                                <h1 class="certificate-title">MEDICAL CERTIFICATE</h1>
                            </div>
                            <div class="date-section">
                                <div class="date-field">
                                    <span class="date-value" id="preview-cert-date">{{ date('F j, Y') }}</span>
                                    <div class="underline"></div>
                                    <span class="field-label">Date</span>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Body -->
                        <div class="certificate-body">
                            <div class="salutation">
                                <strong>TO WHOM IT MAY CONCERN:</strong>
                            </div>

                            <div class="certification-text">
                                <p style="margin-left: 90px">This is to certify that
                                    <span class="field-value name-field">{{ $patient->first_name ?? '' }} {{ $patient->middle_name ?? '' }} {{ $patient->last_name ?? '' }}</span>,
                                    <span class="field-value short">{{ $patient->age ?? '' }}</span> years old
                                </p>
                                <p>of
                                    <span class="field-value long" id="preview-cert-address">{{ $patient->address ?? '' }}</span> has been treated/examined last
                                    <span class="field-value medium" id="preview-cert-exam-date"></span>
                                </p>
                            </div>

                            <!-- Diagnosis Section -->
                            <div class="section-block">
                                <div class="section-header">
                                    <strong>DIAGNOSIS:</strong>
                                </div>
                                <div class="section-content">
                                    <div class="content-line">
                                        <span class="field-value full-width" id="preview-cert-diagnosis"></span>
                                    </div>
                                    <div class="content-line">
                                        <span class="field-value full-width"></span>
                                    </div>
                                    <div class="content-line">
                                        <span class="field-value full-width"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Remarks Section -->
                            <div class="section-block">
                                <div class="section-header">
                                    <strong>REMARKS:</strong>
                                </div>
                                <div class="section-content">
                                    <div class="content-line">
                                        <span class="field-value full-width" id="preview-cert-remarks"></span>
                                    </div>
                                    <div class="content-line">
                                        <span class="field-value full-width"></span>
                                    </div>
                                    <div class="content-line">
                                        <span class="field-value full-width"></span>
                                    </div>
                                    <div class="content-line">
                                        <span class="field-value full-width"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Physician Signature Section -->
                            <div class="signature-section">
                                <div class="signature-block">
                                    <div class="signature-line">
                                        <span class="field-value signature-field" id="preview-cert-physician"></span>
                                    </div>
                                    <div class="signature-label">Physician</div>
                                </div>

                                <div class="credentials-block">
                                    <div class="credential-line">
                                        <span class="credential-label">License No.</span>
                                        <span class="field-value credential-field" id="preview-cert-license"></span>
                                    </div>
                                    <div class="credential-line">
                                        <span class="credential-label">PTR No.</span>
                                        <span class="field-value credential-field" id="preview-cert-ptr"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <small class="text-muted me-auto">
                    <i class="fas fa-info-circle me-1"></i> This is a preview only. Submit the form to issue the certificate.
                </small>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close Preview
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .medical-certificate-preview {
        background: #f5f5f5;
        padding: 2rem;
        min-height: 500px;
    }

    .certificate-page-preview {
        background: white;
        padding: 25px 45px;
        width: 8.5in;
        height: 5.5in;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        box-sizing: border-box;
        font-family: 'Times New Roman', serif;
    }

    /* Reuse the same certificate styles for preview */
    #previewCertificateModal .certificate-header {
        display: flex;
        align-items: flex-start;
        margin-bottom: 8px;
        position: relative;
    }

    #previewCertificateModal .logo-section {
        width: 65px;
        height: 65px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    #previewCertificateModal .medical-logo {
        width: 100%;
        height: 100%;
    }

    #previewCertificateModal .medical-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    #previewCertificateModal .institution-info {
        flex: 1;
        text-align: center;
    }

    #previewCertificateModal .institution-name {
        font-size: 13pt;
        font-weight: bold;
        margin: 0;
        letter-spacing: 1px;
        font-family: 'Times New Roman', serif;
    }

    #previewCertificateModal .institution-location {
        font-size: 11pt;
        font-weight: bold;
        margin: 5px 0;
        letter-spacing: 0.3px;
        font-family: 'Times New Roman', serif;
    }

    #previewCertificateModal .certificate-title {
        font-size: 15pt;
        font-weight: bold;
        margin: 10px 0 0 0;
        letter-spacing: 2px;
        font-family: 'Times New Roman', serif;
    }

    #previewCertificateModal .date-section {
        width: 120px;
        text-align: center;
        flex-shrink: 0;
    }

    #previewCertificateModal .date-field {
        text-align: center;
    }

    #previewCertificateModal .date-value {
        display: block;
        margin-bottom: 3px;
        font-size: 11pt;
        font-family: 'Times New Roman', serif;
        border-bottom: 1px solid #000;
        padding-bottom: 3px;
    }

    #previewCertificateModal .underline {
        height: 1px;
        background: #000;
        margin: 2px 0;
    }

    #previewCertificateModal .field-label {
        font-size: 10pt;
        margin-top: 3px;
        display: block;
        font-family: 'Times New Roman', serif;
    }

    #previewCertificateModal .certificate-body {
        margin-top: 0;
        font-family: 'Times New Roman', serif;
    }

    #previewCertificateModal .salutation {
        margin: 15px 0 10px 0;
        font-size: 11pt;
        font-weight: bold;
    }

    #previewCertificateModal .certification-text p {
        margin: 8px 0;
        font-size: 11pt;
        line-height: 1.6;
    }

    #previewCertificateModal .field-value {
        font-weight: bold;
        display: inline-block;
        min-width: 65px;
        border-bottom: 1px solid #000;
        padding: 0 10px 2px 10px;
        margin: 0 2px;
        text-align: center;
    }

    #previewCertificateModal .field-value.short {
        min-width: 40px;
        width: 40px;
    }

    #previewCertificateModal .field-value.medium {
        min-width: 120px;
        width: 120px;
    }

    #previewCertificateModal .field-value.long {
        min-width: 350px;
        width: 350px;
    }

    #previewCertificateModal .field-value.full-width {
        min-width: 100%;
        width: 100%;
        margin: 0;
    }

    #previewCertificateModal .field-value.name-field {
        min-width: 300px;
    }

    #previewCertificateModal .field-value.signature-field {
        min-width: 180px;
        width: 180px;
    }

    #previewCertificateModal .field-value.credential-field {
        min-width: 100px;
        width: 100px;
    }

    #previewCertificateModal .section-block {
        margin-top: 15px;
    }

    #previewCertificateModal .section-header {
        font-size: 11pt;
        margin-bottom: 5px;
        font-weight: bold;
    }

    #previewCertificateModal .content-line {
        margin: 6px 0;
        min-height: 18px;
        border-bottom: 1px solid #000;
        padding: 2px 0;
        font-size: 10pt;
    }

    #previewCertificateModal .signature-section {
        margin-top: 30px;
        margin-bottom: 0;
        display: flex;
        justify-content: flex-end;
        align-items: flex-start;
        padding-right: 30px;
    }

    #previewCertificateModal .signature-block {
        text-align: center;
        margin-right: 1.5rem;
    }

    #previewCertificateModal .signature-line {
        margin-bottom: 3px;
        border-bottom: 1px solid #000;
        min-width: 180px;
        padding-bottom: 2px;
        font-size: 10pt;
    }

    #previewCertificateModal .signature-label {
        font-size: 9pt;
        margin-top: 3px;
    }

    #previewCertificateModal .credentials-block {
        text-align: left;
    }

    #previewCertificateModal .credential-line {
        margin: 2px 0;
        display: flex;
        align-items: center;
    }

    #previewCertificateModal .credential-label {
        font-size: 9pt;
        margin-right: 8px;
        min-width: 70px;
    }

    #previewCertificateModal .credential-underline {
        height: 1px;
        background: #000;
        border-bottom: 1px solid #000;
        display: inline-block;
        min-width: 100px;
    }
</style>

<!-- Revoke Certificate Modal -->
<div class="modal fade" id="revokeCertificateModal" tabindex="-1" aria-labelledby="revokeCertificateModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="revokeCertificateModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Revoke Medical Certificate
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="revoke-certificate-form">
                    @csrf
                    <input type="hidden" id="revoke-certificate-id" name="certificate_id">
                    
                    <div class="alert alert-warning mb-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. The certificate will be permanently marked as revoked.
                    </div>

                    <div class="mb-3">
                        <label for="revocationReason" class="form-label">Reason for Revocation <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="revocationReason" name="revocation_reason" rows="4" 
                                  placeholder="Please provide a detailed reason for revoking this certificate" required></textarea>
                        <small class="form-text text-muted">This reason will be permanently recorded and visible on the certificate.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirm-revoke-btn">
                    <i class="fas fa-ban me-1"></i>Revoke Certificate
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Load certificates on page load
        loadMedicalCertificates();

        // Reset form when modal is hidden
        $('#addCertificateModal').on('hidden.bs.modal', function () {
            $('#medical-certificate-form')[0].reset();
            // Reset to today's date
            $('#issueDate').val('{{ date('Y-m-d') }}');
            // Reset patient address
            $('#patientAddress').val('{{ $patient->address ?? '' }}');
        });

        // Reset revoke form when modal is hidden
        $('#revokeCertificateModal').on('hidden.bs.modal', function () {
            $('#revoke-certificate-form')[0].reset();
        });

        // Issue certificate form submission
        $('#issue-certificate-btn').click(function() {
            const form = $('#medical-certificate-form')[0];
            
            // Validate form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);
            
            // Disable button to prevent double submission
            $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Issuing...');

            $.ajax({
                url: "{{ route('medical-certificates.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        
                        // Close modal properly
                        const modalElement = document.getElementById('addCertificateModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();
                        
                        // Remove backdrop manually to ensure it's gone
                        setTimeout(function() {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '');
                        }, 100);
                        
                        // Reload certificates
                        loadMedicalCertificates();
                        
                        // Show success message after modal is closed
                        setTimeout(function() {
                            alert('Medical certificate issued successfully!');
                        }, 300);
                        
                    } else {
                        console.warn('Response received but success is false:', response);
                        alert('Error: Unable to issue certificate');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error!');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                    console.error('Status Code:', xhr.status);
                    
                    let errorMessage = "An error occurred. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                        console.error('Validation errors:', errors);
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                        console.error('Error message:', errorMessage);
                    }
                    
                    alert('Error: ' + errorMessage);
                },
                complete: function() {
                    console.log('AJAX request completed');
                    // Re-enable button
                    $('#issue-certificate-btn').prop('disabled', false).html('<i class="fas fa-save me-1"></i>Issue Certificate');
                }
            });
        });

        // Load medical certificates
        function loadMedicalCertificates() {
            $.ajax({
                url: "{{ route('patients.medical-certificates', $patient->id) }}",
                method: "GET",
                success: function(response) {
                    const tbody = $('#certificates-tbody');
                    tbody.empty();

                    if (response.certificates.length === 0) {
                        tbody.append(`
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <em>No medical certificates found. Click "Issue Medical Certificate" to get started.</em>
                            </td>
                        </tr>
                    `);
                    } else {
                        response.certificates.forEach(function(cert) {
                            const statusBadge = getStatusBadge(cert.status);
                            const actions = getActionButtons(cert);

                            tbody.append(`
                            <tr>
                                <td>${formatDate(cert.date_issued)}</td>
                                <td>${getCertificateTypeDisplay(cert.certificate_type)}</td>
                                <td>${cert.purpose}</td>
                                <td>${cert.valid_until ? formatDate(cert.valid_until) : 'No expiry'}</td>
                                <td><span class="badge ${statusBadge}">${cert.status.charAt(0).toUpperCase() + cert.status.slice(1)}</span></td>
                                <td>${actions}</td>
                            </tr>
                        `);
                        });
                    }
                },
                error: function(xhr) {
                    alert('Error loading medical certificates. Please refresh the page.');
                }
            });
        }

        // Get status badge class
        function getStatusBadge(status) {
            switch (status) {
                case 'active':
                    return 'bg-success';
                case 'revoked':
                    return 'bg-danger';
                case 'expired':
                    return 'bg-secondary';
                default:
                    return 'bg-secondary';
            }
        }

        // Get certificate type display name
        function getCertificateTypeDisplay(type) {
            switch (type) {
                case 'fitness_work':
                    return 'Fitness for Work';
                case 'medical_leave':
                    return 'Medical Leave';
                case 'travel_clearance':
                    return 'Travel Clearance';
                case 'school_sports':
                    return 'School/Sports';
                case 'custom':
                    return 'Custom Certificate';
                default:
                    return type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
            }
        }

        // Get action buttons
        function getActionButtons(cert) {
            let buttons = `
            <button class="btn btn-sm btn-outline-primary view-certificate-btn" data-cert='${JSON.stringify(cert)}'>
                <i class="fas fa-eye me-1"></i>View
            </button>
            <button class="btn btn-sm btn-outline-success download-pdf-btn" data-id="${cert.id}">
                <i class="fas fa-download me-1"></i>Print
            </button>
        `;

            if (cert.status === 'active') {
                buttons += `<button class="btn btn-sm btn-outline-warning revoke-btn" data-id="${cert.id}">
                    <i class="fas fa-ban me-1"></i>Revoke
                </button>`;
            }

            return buttons;
        }

        // Format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        // View Certificate button click
        $(document).on('click', '.view-certificate-btn', function() {
            const cert = $(this).data('cert');
            showCertificateView(cert);
        });

        // Download PDF button click
        $(document).on('click', '.download-pdf-btn', function() {
            const certId = $(this).data('id');
            window.open(`{{ url('/medical-certificates') }}/${certId}/print`, '_blank');
        });

        // Revoke button click
        $(document).on('click', '.revoke-btn', function() {
            const certId = $(this).data('id');
            $('#revoke-certificate-id').val(certId);
            
            // Show modal using Bootstrap 5 method
            const modal = new bootstrap.Modal(document.getElementById('revokeCertificateModal'));
            modal.show();
        });

        // Confirm revoke button click
        $('#confirm-revoke-btn').click(function() {
            const certId = $('#revoke-certificate-id').val();
            const reason = $('#revocationReason').val();

            if (!reason.trim()) {
                alert('Please provide a reason for revocation.');
                return;
            }

            // Disable button to prevent double submission
            $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Revoking...');

            $.ajax({
                url: `{{ url('/medical-certificates') }}/${certId}/revoke`,
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    revocation_reason: reason
                },
                success: function(response) {
                    if (response.success) {
                        // Close modal properly
                        const modalElement = document.getElementById('revokeCertificateModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();
                        
                        // Remove backdrop manually to ensure it's gone
                        setTimeout(function() {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '');
                        }, 100);
                        
                        // Reload certificates
                        loadMedicalCertificates();
                        
                        // Show success message after modal is closed
                        setTimeout(function() {
                            alert('Medical certificate revoked successfully!');
                        }, 300);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while revoking the certificate. Please try again.');
                },
                complete: function() {
                    // Re-enable button
                    $('#confirm-revoke-btn').prop('disabled', false).html('<i class="fas fa-ban me-1"></i>Revoke Certificate');
                }
            });
        });

        // Preview certificate functionality
        $('#preview-certificate-btn').click(function(e) {
            e.preventDefault(); // Prevent form submission
            
            const form = $('#medical-certificate-form')[0];
            
            // Validate form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);
            
            // Populate preview modal with form data
            $('#preview-cert-date').text(formatCertDate(formData.get('date_issued')));
            $('#preview-cert-address').text(formData.get('patient_address') || '{{ $patient->address ?? '' }}');
            $('#preview-cert-exam-date').text(formatCertDate(formData.get('date_issued')));
            $('#preview-cert-diagnosis').text(formData.get('medical_findings') || '');
            $('#preview-cert-remarks').text(formData.get('recommendations') || '');
            $('#preview-cert-physician').text(formData.get('issuing_doctor') || '');
            $('#preview-cert-license').text(formData.get('license_number') || '');
            $('#preview-cert-ptr').text(formData.get('ptr_number') || '');
            
            // Show preview modal
            const previewModal = new bootstrap.Modal(document.getElementById('previewCertificateModal'));
            previewModal.show();
        });
    });

    // Function to show certificate view
    function showCertificateView(cert, isPreview = false) {
        // Populate certificate data
        $('#cert-date').text(formatCertDate(cert.date_issued));
        $('#cert-patient-address').text(cert.patient_address || '{{ $patient->address ?? '' }}');
        $('#cert-diagnosis').text(cert.medical_findings || '');
        $('#cert-remarks').text(cert.recommendations || '');
        $('#cert-physician').text(cert.issuing_doctor || '');
        $('#cert-license').text(cert.license_number || '');
        $('#cert-ptr').text(cert.ptr_number || '');
        $('#cert-exam-date').text(cert.examination_date || formatCertDate(cert.date_issued));

        // Hide management view and show certificate view
        $('#management-view').hide();
        $('#certificate-view').show();
    }

    // Function to show management view
    function showManagementView() {
        $('#certificate-view').hide();
        $('#management-view').show();
    }

    // Format date for certificate (mm-dd-yyyy)
    function formatCertDate(dateString) {
        const date = new Date(dateString);
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const year = date.getFullYear();
        return `${month}-${day}-${year}`;
    }
</script>
