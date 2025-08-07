<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">
                <i class="fas fa-share-square me-2"></i>
                Referral Form Management
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addReferralModal">
                        <i class="fas fa-plus me-1"></i>
                        Create Referral
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Referred To</th>
                            <th>Specialty</th>
                            <th>Priority</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ date('Y-m-d') }}</td>
                            <td>Dr. Maria Santos</td>
                            <td>Endocrinology</td>
                            <td><span class="badge bg-warning">Routine</span></td>
                            <td>Diabetes management consultation</td>
                            <td><span class="badge bg-primary">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                                <button class="btn btn-sm btn-outline-success">Print</button>
                                <button class="btn btn-sm btn-outline-info">Track</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <em>No additional referrals found. Click "Create Referral" to get started.</em>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0"><i class="fas fa-hospital me-1"></i> Common Referral Destinations</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Endocrinology
                                    <span class="badge bg-primary rounded-pill">3</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Cardiology
                                    <span class="badge bg-primary rounded-pill">2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Ophthalmology
                                    <span class="badge bg-primary rounded-pill">1</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Nephrology
                                    <span class="badge bg-primary rounded-pill">1</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="fas fa-chart-pie me-1"></i> Referral Status Overview</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Pending</span>
                                <span class="badge bg-warning">4</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Completed</span>
                                <span class="badge bg-success">12</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Cancelled</span>
                                <span class="badge bg-danger">1</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Total Referrals</strong>
                                <strong><span class="badge bg-primary">17</span></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Referral Modal -->
<div class="modal fade" id="addReferralModal" tabindex="-1" aria-labelledby="addReferralModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReferralModalLabel">Create Medical Referral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="referralDate" class="form-label">Referral Date</label>
                            <input type="date" class="form-control" id="referralDate" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-select" id="priority">
                                <option value="routine">Routine</option>
                                <option value="urgent">Urgent</option>
                                <option value="emergency">Emergency</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="specialty" class="form-label">Specialty</label>
                            <select class="form-select" id="specialty">
                                <option value="">Select specialty</option>
                                <option value="endocrinology">Endocrinology</option>
                                <option value="cardiology">Cardiology</option>
                                <option value="ophthalmology">Ophthalmology</option>
                                <option value="nephrology">Nephrology</option>
                                <option value="neurology">Neurology</option>
                                <option value="orthopedics">Orthopedics</option>
                                <option value="dermatology">Dermatology</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="referredDoctor" class="form-label">Referred To (Doctor/Clinic)</label>
                            <input type="text" class="form-control" id="referredDoctor" placeholder="Dr. Name or Clinic Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="institution" class="form-label">Institution/Hospital</label>
                            <input type="text" class="form-control" id="institution" placeholder="Hospital or clinic name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contactInfo" class="form-label">Contact Information</label>
                            <input type="text" class="form-control" id="contactInfo" placeholder="Phone number or email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="reasonForReferral" class="form-label">Reason for Referral</label>
                        <textarea class="form-control" id="reasonForReferral" rows="3" placeholder="Detailed reason for referral, including current symptoms and concerns"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="relevantHistory" class="form-label">Relevant Medical History</label>
                        <textarea class="form-control" id="relevantHistory" rows="3" placeholder="Relevant past medical history, current medications, and investigations"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="urgencyReason" class="form-label">Urgency/Timeline</label>
                        <textarea class="form-control" id="urgencyReason" rows="2" placeholder="If urgent, explain why immediate attention is needed"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="includeReports">
                        <label class="form-check-label" for="includeReports">
                            Include recent test results and imaging reports
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary">Preview</button>
                <button type="button" class="btn btn-primary">Create Referral</button>
            </div>
        </div>
    </div>
</div> 