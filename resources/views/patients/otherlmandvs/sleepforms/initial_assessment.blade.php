<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-bed me-2"></i>Sleep Assessment - Initial Evaluation</h4>
    </div>
    <div class="card-body">
        <form id="sleep-initial-form">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            
            <!-- Basic Sleep Metrics -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3"><i class="fas fa-clock me-2"></i>Your Sleep Habits</h5>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sleep Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" name="sleep_time" id="sleep_time" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Wake Up Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" name="wake_up_time" id="wake_up_time" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Usual Sleep Duration (hours) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="usual_sleep_duration" id="usual_sleep_duration" 
                           min="0" max="24" step="0.5" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sleep Quality Rating <span class="text-danger">*</span></label>
                    <select class="form-control" name="sleep_quality_rating" id="sleep_quality_rating" required>
                        <option value="">Select quality...</option>
                        <option value="1">1 - Worst</option>
                        <option value="2">2 - Very Poor</option>
                        <option value="3">3 - Poor</option>
                        <option value="4">4 - Below Average</option>
                        <option value="5">5 - Average</option>
                        <option value="6">6 - Above Average</option>
                        <option value="7">7 - Good</option>
                        <option value="8">8 - Very Good</option>
                        <option value="9">9 - Excellent</option>
                        <option value="10">10 - Outstanding</option>
                    </select>
                </div>
            </div>

            <!-- Sleep Hygiene Checklist -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3"><i class="fas fa-list-check me-2"></i>Sleep Hygiene Activities</h5>
                    <p class="text-muted">Do you do any of the following less than 2 hours before sleeping?</p>
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="alcohol" id="hygiene_alcohol">
                        <label class="form-check-label" for="hygiene_alcohol">Drinking alcoholic beverages</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="large_meal" id="hygiene_meal">
                        <label class="form-check-label" for="hygiene_meal">Eating a large meal</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="coffee" id="hygiene_coffee">
                        <label class="form-check-label" for="hygiene_coffee">Drinking coffee</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="gadgets" id="hygiene_gadgets">
                        <label class="form-check-label" for="hygiene_gadgets">Using gadgets/screen time</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hygiene_activities[]" value="intense_exercise" id="hygiene_exercise">
                        <label class="form-check-label" for="hygiene_exercise">Intense exercise</label>
                    </div>
                </div>
            </div>

            <!-- Daytime Sleepiness -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3"><i class="fas fa-tired me-2"></i>Daytime Sleepiness</h5>
                    <div class="mb-3">
                        <label class="form-label">Do you feel unusually sleepy during the daytime? <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="daytime_sleepiness" id="daytime_sleepiness_yes" value="yes" required>
                            <label class="form-check-label" for="daytime_sleepiness_yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="daytime_sleepiness" id="daytime_sleepiness_no" value="no" required>
                            <label class="form-check-label" for="daytime_sleepiness_no">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Physical Measurements for Assessment (Read-only) -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-ruler me-2"></i>Physical Measurements for Assessment
                        <small class="text-muted ms-2" id="consultation-indicator">
                            Loading consultation data...
                        </small>
                    </h5>
                    <p class="text-muted">These measurements help assess risk for sleep apnea and other sleep disorders. Data is automatically loaded from the active consultation.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Blood Pressure</label>
                    <input type="text" class="form-control" name="blood_pressure" id="blood_pressure" 
                           value="—" readonly disabled>
                    <small class="text-muted">From consultation measurements</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">BMI (kg/m²)</label>
                    <input type="text" class="form-control" name="bmi" id="bmi" 
                           value="—" readonly disabled>
                    <small class="text-muted">Calculated from height & weight</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="age" 
                           value="{{ $patient->age ?? '—' }}" readonly disabled>
                    <small class="text-muted">From patient profile</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Neck Circumference (cm)</label>
                    <input type="text" class="form-control" name="neck_circumference" id="neck_circumference" 
                           value="—" readonly disabled>
                    <small class="text-muted">From consultation measurements</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Gender</label>
                    <input type="text" class="form-control" name="gender" id="gender" 
                           value="{{ $patient->gender ?? '—' }}" readonly disabled>
                    <small class="text-muted">From patient profile</small>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-primary me-2" id="evaluate-sleep-btn">
                        <i class="fas fa-chart-line me-1"></i>Evaluate & Get Recommendations
                    </button>
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i>Save Assessment
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo me-1"></i>Reset Form
                    </button>
                </div>
            </div>
        </form>

        <!-- Recommendation Area -->
        <div id="sleep-recommendation-area" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Recommended Assessments</h5>
                </div>
                <div class="card-body">
                    <div id="sleep-recommendations-list"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 