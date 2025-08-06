<div class="container-fluid">
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
                <table class="table table-striped table-hover">
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
                    <tbody>
                        <tr>
                            <td>{{ date('Y-m-d') }}</td>
                            <td>Fitness for Work</td>
                            <td>Return to work clearance</td>
                            <td>{{ date('Y-m-d', strtotime('+30 days')) }}</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View PDF</button>
                                <button class="btn btn-sm btn-outline-success">Download</button>
                                <button class="btn btn-sm btn-outline-warning">Revoke</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <em>No additional medical certificates found. Click "Issue Medical Certificate" to get started.</em>
                            </td>
                        </tr>
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

<!-- Add Medical Certificate Modal -->
<div class="modal fade" id="addCertificateModal" tabindex="-1" aria-labelledby="addCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCertificateModalLabel">Issue Medical Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="certificateType" class="form-label">Certificate Type</label>
                            <select class="form-select" id="certificateType">
                                <option value="">Select certificate type</option>
                                <option value="fitness_work">Fitness for Work</option>
                                <option value="medical_leave">Medical Leave</option>
                                <option value="travel_clearance">Travel Clearance</option>
                                <option value="school_sports">School/Sports</option>
                                <option value="custom">Custom Certificate</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <input type="text" class="form-control" id="purpose" placeholder="e.g., Return to work after illness">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="issueDate" class="form-label">Issue Date</label>
                            <input type="date" class="form-control" id="issueDate" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validUntil" class="form-label">Valid Until</label>
                            <input type="date" class="form-control" id="validUntil">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="issuingDoctor" class="form-label">Issuing Doctor</label>
                            <input type="text" class="form-control" id="issuingDoctor" placeholder="Dr. Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="licenseNumber" class="form-label">License Number</label>
                            <input type="text" class="form-control" id="licenseNumber" placeholder="Medical license number">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="medicalFindings" class="form-label">Medical Findings</label>
                        <textarea class="form-control" id="medicalFindings" rows="3" placeholder="Brief medical assessment and findings"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recommendations" class="form-label">Recommendations/Restrictions</label>
                        <textarea class="form-control" id="recommendations" rows="3" placeholder="Any work restrictions or recommendations"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="digitalSignature">
                        <label class="form-check-label" for="digitalSignature">
                            Apply digital signature
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary">Preview</button>
                <button type="button" class="btn btn-primary">Issue Certificate</button>
            </div>
        </div>
    </div>
</div> 