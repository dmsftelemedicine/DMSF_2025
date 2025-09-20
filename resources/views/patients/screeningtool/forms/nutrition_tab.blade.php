<div class="card shadow-lg p-4 border-0 mx-auto mb-4" style="width: 90%; border-radius: 2rem;">

	<h5 class="border-bottom pb-2 mb-3">Nutrition Summary</h5>
	<div class="row">
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">BMR (kcal/day)</p>
			<p class="fw-bold">{{ optional($patient->tdee)->bmr ?? 'N/A' }}</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">
				TDEE
				<button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#tdeeModal">
					<i class="fa-solid fa-plus"></i>
				</button>
			</p>
			<p class="fw-bold" id="tdeeValue">
				{{ $patient->tdee ? $patient->tdee->tdee . ' kcal/day' : 'Not calculated yet' }}
			</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">Weight Loss / Gain</p>
			<p class="fw-bold">
				{{ $patient->tdee ? ($patient->tdee->tdee - 500) . " kcal / " . ($patient->tdee->tdee + 200) . " kcal" : 'Need TDEE data' }}
			</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">
				Macronutrient Split
				<button class="btn btn-light btn-sm open-macro-modal" data-patient-id="{{ $patient->id }}">
					<i class="fa-solid fa-eye"></i>
				</button>
			</p>
		</div>
		<div class="col-4 mb-3">
            <p class="text-muted mb-1">
				Meal Plan
				<button class="btn btn-light btn-sm open-meal-plan-modal" data-patient-id="{{ $patient->id }}">
					<i class="fa-solid fa-eye"></i>
				</button>
			</p>
		</div>
		<div class="col-4 mb-3">
            <p class="text-muted mb-1">
				24hrs Food Recall
				<span id="food-recall-buttons" style="display:none;">
					<button class="btn btn-warning btn-sm open-foodrecall-modal"
						id="add-food-recall-btn"
						data-nutrition-id=""
						data-bs-toggle="modal"
						data-bs-target="#foodRecallModal">
						<i class="fa-solid fa-plus"></i>
					</button>
					<button class="btn btn-light btn-sm open-viewfoodrecall-modal"
						id="view-food-recall-btn"
						data-bs-toggle="modal"
						data-bs-target="#ViewfoodRecallModal"
						data-nutrition-id="">
						<i class="fa-solid fa-eye"></i>
					</button>
				</span>
				<span id="no-nutrition-for-recall" class="text-muted small">
					Select a consultation with nutrition data
				</span>
			</p>
		</div>
	</div>
</div>

<div class="card shadow-lg p-4 border-0">
    <div class="d-flex justify-content-between align-items-center">
        <h5>Nutrition</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NutritionModal">
            Add Nutrition
        </button>
    </div>
    <br>
    <div class="alert alert-info">
            <h6 class="alert-heading mb-2 font-weight-bold">Short Healthy Eating Index (SHEI-22)</h6>
            <p class="mb-2">The SHEI-22 is a concise, 22-item dietary quality assessment tool designed to estimate individuals’ adherence to healthy eating patterns in a user-friendly and efficient manner. Developed through expert panels and decision-tree algorithms, it correlates strongly (r = 0.79) with the full Healthy Eating Index derived from 24-hour dietary recalls. SHEI‑22 also shows moderate to strong validity (r = 0.44–0.64) for key food group intake estimates. It boasts high content validity, internal consistency (Cronbach’s α ≈ 0.80–0.81), and structural validity across diverse populations including college students and international samples.</p>

            <h6 class="alert-heading mb-2 font-weight-bold">Scoring Guide</h6>
            <p class="mb-2">Total Dietary Quality Score (0-100) is calculated as:</p>
            <p class="mb-2">tot_score = total_fruits + whole_fruits + tot_veg + greens_beans + whole_grains + dairy + tot_proteins + seafood_plant + fatty_acid + refined_grains + sodium + added_sugars + sat_fat</p>

            <h6 class="alert-heading mb-2 font-weight-bold">ICD-10 Diagnosis</h6>
            <p class="mb-2">Z72.4 - Inappropriate Diet and Eating Habits</p>

            <small class="text-muted">
                For detailed scoring criteria of each food group, refer to: <br>
                https://pmc.ncbi.nlm.nih.gov/articles/PMC7551037/table/array1/
            </small>
    </div>

    <!-- Consultation-specific nutrition data table -->
    <div id="nutrition-data-container" style="display:none;">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <h6 class="card-title text-primary">
                            <i class="fas fa-chart-line"></i> Latest Nutrition Assessment Summary
                        </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <div id="latest-score-display" class="text-center">
                                    <div class="h3 mb-1 text-primary" id="latest-score-value">--</div>
                                    <small class="text-muted">SHEI-22 Score / 100</small>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div id="score-interpretation" class="small"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h6 class="mt-4">Nutrition Records for Selected Consultation</h6>
        <table class="table table-striped mt-3" id="nutrition-results-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Score</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody id="nutrition-results-tbody">
                <!-- Data will be populated by JavaScript -->
            </tbody>
        </table>
    </div>

    <div id="no-consultation-selected" class="alert alert-info mt-3">
        <i class="fas fa-info-circle"></i> Please select a consultation to view nutrition records.
    </div>
</div>

<!-- Nutritional Modal -->
<div class="modal fade" id="NutritionModal" tabindex="-1" aria-labelledby="NutritionModalabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title d-flex align-items-center" id="NutritionModalLabel">
                    <i class="fas fa-apple-alt me-2"></i>Nutrition Assessment
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
				<!-- Nutritional Form -->
			    @include('patients.screeningtool.forms.nutrition_form')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewNutritionModal" tabindex="-1" aria-labelledby="viewNutritionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title d-flex align-items-center" id="viewNutritionLabel">
                    <i class="fas fa-chart-line me-2"></i>
                    <div>
                        Nutrition Details (<strong><span id="nutrition-date"></span></strong>)
                        <br><small class="text-light opacity-75">SHEI-22 Score: <span id="nutrition-score" class="badge bg-light text-primary"></span>/100</small>
                    </div>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">🍎 Fruits & Vegetables</h6>
                        <p><strong>Fruit Consumption:</strong> <span id="nutrition-fruit" class="text-success"></span></p>
                        <p><strong>Fruit Juice:</strong> <span id="nutrition-fruit-juice" class="text-success"></span></p>
                        <p><strong>Vegetable Consumption:</strong> <span id="nutrition-vegetables" class="text-success"></span></p>
                        <p><strong>Green Vegetables:</strong> <span id="nutrition-green-vegetables" class="text-success"></span></p>
                        <p><strong>Starchy Vegetables:</strong> <span id="nutrition-starchy-vegetables" class="text-success"></span></p>

                        <h6 class="text-primary mb-3 mt-4">🌾 Grains</h6>
                        <p><strong>Grain Consumption:</strong> <span id="nutrition-grains" class="text-warning"></span></p>
                        <p><strong>Grain Frequency:</strong> <span id="nutrition-grains-frequency" class="text-muted"></span></p>
                        <p><strong>Whole Grain Consumption:</strong> <span id="nutrition-whole-grains" class="text-warning"></span></p>
                        <p><strong>Whole Grain Frequency:</strong> <span id="nutrition-whole-grains-frequency" class="text-muted"></span></p>

                        <h6 class="text-primary mb-3 mt-4">🥛 Dairy</h6>
                        <p><strong>Milk Consumption:</strong> <span id="nutrition-milk" class="text-info"></span></p>
                        <p><strong>Milk Frequency:</strong> <span id="nutrition-milk-frequency" class="text-muted"></span></p>
                        <p><strong>Low-Fat Milk:</strong> <span id="nutrition-low-fat-milk" class="text-info"></span></p>
                        <p><strong>Low-Fat Milk Frequency:</strong> <span id="nutrition-low-fat-milk-frequency" class="text-muted"></span></p>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">🥜 Proteins</h6>
                        <p><strong>Beans:</strong> <span id="nutrition-beans" class="text-success"></span></p>
                        <p><strong>Nuts & Seeds:</strong> <span id="nutrition-nuts-seeds" class="text-success"></span></p>
                        <p><strong>Seafood:</strong> <span id="nutrition-seafood" class="text-info"></span></p>
                        <p><strong>Seafood Frequency:</strong> <span id="nutrition-seafood-frequency" class="text-muted"></span></p>

                        <h6 class="text-primary mb-3 mt-4">🥤 Beverages</h6>
                        <p><strong>Sugar-Sweetened Beverages:</strong> <span id="nutrition-ssb" class="text-danger"></span></p>
                        <p><strong>SSB Frequency:</strong> <span id="nutrition-ssb-frequency" class="text-muted"></span></p>
                        <p><strong>Water Consumption:</strong> <span id="nutrition-water" class="text-primary"></span></p>

                        <h6 class="text-primary mb-3 mt-4">⚠️ Limit These</h6>
                        <p><strong>Added Sugars:</strong> <span id="nutrition-added-sugars" class="text-danger"></span></p>
                        <p><strong>Saturated Fat:</strong> <span id="nutrition-saturated-fat" class="text-danger"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Food Recall Modal -->
<div class="modal fade" id="foodRecallModal" tabindex="-1" aria-labelledby="foodRecallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title d-flex align-items-center" id="foodRecallModalLabel">
                    <i class="fas fa-utensils me-2"></i>Create Food Recall Entry
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <form id="foodRecallForm">
                                @csrf
                                <input type="hidden" id="nutrition_id" name="nutrition_id">

                    <div class="mb-3">
                        <label class="form-label">Breakfast</label>
                        <textarea class="form-control" name="breakfast"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">AM Snack</label>
                        <textarea class="form-control" name="am_snack"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lunch</label>
                        <textarea class="form-control" name="lunch"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PM Snack</label>
                        <textarea class="form-control" name="pm_snack"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dinner</label>
                        <textarea class="form-control" name="dinner"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Midnight Snack</label>
                        <textarea class="form-control" name="midnight_snack"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Food view Recall Modal -->
<div class="modal fade" id="ViewfoodRecallModal" tabindex="-1" aria-labelledby="ViewfoodRecallLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title d-flex align-items-center" id="ViewfoodRecallLabel">
                    <i class="fas fa-history me-2"></i>Food Recall Records
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Breakfast</th>
                            <th>AM Snack</th>
                            <th>Lunch</th>
                            <th>PM Snack</th>
                            <th>Dinner</th>
                            <th>Midnight Snack</th>
                        </tr>
                    </thead>
                    <tbody id="foodRecallTableBody">
                        <tr>
                            <td colspan="7" class="text-center">No records available.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
