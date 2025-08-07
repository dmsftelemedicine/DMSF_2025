<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="fas fa-heart me-2"></i>
                Lifestyle Prescription Management
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLifestyleModal">
                        <i class="fas fa-plus me-1"></i>
                        Create Lifestyle Plan
                    </button>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0"><i class="fas fa-utensils me-1"></i> Dietary Recommendations</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Reduce carbohydrate intake to 45-60g per meal</li>
                                <li class="list-group-item">Increase fiber intake (25-30g daily)</li>
                                <li class="list-group-item">Limit saturated fats to <10% of total calories</li>
                                <li class="list-group-item">Follow Mediterranean diet pattern</li>
                            </ul>
                            <div class="mt-3">
                                <button class="btn btn-sm btn-outline-primary">Edit Plan</button>
                                <button class="btn btn-sm btn-outline-success">Generate PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-warning">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0"><i class="fas fa-running me-1"></i> Exercise Recommendations</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">150 minutes moderate aerobic activity/week</li>
                                <li class="list-group-item">Resistance training 2-3 times per week</li>
                                <li class="list-group-item">Daily 30-minute walk after meals</li>
                                <li class="list-group-item">Monitor heart rate during exercise</li>
                            </ul>
                            <div class="mt-3">
                                <button class="btn btn-sm btn-outline-warning">Edit Plan</button>
                                <button class="btn btn-sm btn-outline-success">Generate PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="fas fa-chart-line me-1"></i> Monitoring Guidelines</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Blood Sugar Monitoring</h6>
                                    <ul class="list-unstyled">
                                        <li>• Check fasting glucose daily</li>
                                        <li>• Post-meal checks 2hrs after eating</li>
                                        <li>• Target: 80-130 mg/dL (fasting)</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h6>Weight Management</h6>
                                    <ul class="list-unstyled">
                                        <li>• Weekly weight monitoring</li>
                                        <li>• Target: 5-10% weight loss</li>
                                        <li>• BMI goal: 18.5-24.9</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h6>Follow-up Schedule</h6>
                                    <ul class="list-unstyled">
                                        <li>• Next visit: {{ date('Y-m-d', strtotime('+4 weeks')) }}</li>
                                        <li>• HbA1c check: {{ date('Y-m-d', strtotime('+3 months')) }}</li>
                                        <li>• Emergency contact if needed</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Lifestyle Plan Modal -->
<div class="modal fade" id="addLifestyleModal" tabindex="-1" aria-labelledby="addLifestyleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLifestyleModalLabel">Create Lifestyle Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Dietary Recommendations</h6>
                            <div class="mb-3">
                                <label for="dietType" class="form-label">Diet Type</label>
                                <select class="form-select" id="dietType">
                                    <option value="">Select diet type</option>
                                    <option value="diabetic">Diabetic Diet</option>
                                    <option value="mediterranean">Mediterranean Diet</option>
                                    <option value="low_carb">Low Carbohydrate</option>
                                    <option value="dash">DASH Diet</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dietNotes" class="form-label">Dietary Notes</label>
                                <textarea class="form-control" id="dietNotes" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Exercise Recommendations</h6>
                            <div class="mb-3">
                                <label for="exerciseType" class="form-label">Exercise Type</label>
                                <select class="form-select" id="exerciseType">
                                    <option value="">Select exercise type</option>
                                    <option value="aerobic">Aerobic Exercise</option>
                                    <option value="resistance">Resistance Training</option>
                                    <option value="combined">Combined Program</option>
                                    <option value="custom">Custom Plan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exerciseNotes" class="form-label">Exercise Notes</label>
                                <textarea class="form-control" id="exerciseNotes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Prescription</button>
            </div>
        </div>
    </div>
</div> 