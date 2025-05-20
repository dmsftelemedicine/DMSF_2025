<div class="card shadow-lg p-4 border-0">
    <div class="d-flex justify-content-between align-items-center">
        <h5>Nutrition Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NutritionModal">
            Add Nutrition
        </button>
    </div>
    @if($patient->nutritions()->exists())
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Score</th>
                        <th>ICD 10</th>
                        <th>Details</th>
                        <th style="text-align: center;">24hrs food Recall</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patient->nutritions as $nutrition)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($nutrition->created_at)->format('M d, Y') }}</td>
                        <td>{{ $nutrition->dq_score }}</td>
                        <td>{{ $nutrition->icd_diagnosis }}</td>
                        <td>
                            <button class="btn btn-info btn-sm view-nutrition-details" 
                                    data-date="{{ \Carbon\Carbon::parse($nutrition->created_at)->format('M d, Y') }}"
                                    data-fruit="{{ $nutrition->fruit }}"
                                    data-fruit_juice="{{ $nutrition->fruit_juice }}"
                                    data-vegetables="{{ $nutrition->vegetables }}"
                                    data-green_vegetables="{{ $nutrition->green_vegetables }}"
                                    data-starchy_vegetables="{{ $nutrition->starchy_vegetables }}"
                                    data-grains="{{ $nutrition->grains }}"
                                    data-grains_frequency="{{ $nutrition->grains_frequency }}"
                                    data-whole_grains="{{ $nutrition->whole_grains }}"
                                    data-whole_grains_frequency="{{ $nutrition->whole_grains_frequency }}"
                                    data-milk="{{ $nutrition->milk }}"
                                    data-milk_frequency="{{ $nutrition->milk_frequency }}"
                                    data-low_fat_milk="{{ $nutrition->low_fat_milk }}"
                                    data-low_fat_milk_frequency="{{ $nutrition->low_fat_milk_frequency }}"
                                    data-beans="{{ $nutrition->beans }}"
                                    data-nuts_seeds="{{ $nutrition->nuts_seeds }}"
                                    data-seafood="{{ $nutrition->seafood }}"
                                    data-seafood_frequency="{{ $nutrition->seafood_frequency }}"
                                    data-ssb="{{ $nutrition->ssb }}"
                                    data-ssb_frequency="{{ $nutrition->ssb_frequency }}"
                                    data-added_sugars="{{ $nutrition->added_sugars }}"
                                    data-saturated_fat="{{ $nutrition->saturated_fat }}"
                                    data-water="{{ $nutrition->water }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewNutritionModal">
                                View Details
                            </button>
                        </td>
                        <td style="text-align: center;">
                                <button class="btn btn-warning btn-sm open-foodrecall-modal" 
                                data-nutrition-id="{{ $nutrition->id }}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#foodRecallModal">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <button class="btn btn-light btn-sm open-viewfoodrecall-modal"
                                data-bs-toggle="modal" 
                                data-bs-target="#ViewfoodRecallModal" 
                                data-nutrition-id="{{ $nutrition->id }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted text-center mt-3">No nutrition records available.</p>
        @endif
</div>

<!-- Telemedicine Perception Modal -->
<div class="modal fade" id="NutritionModal" tabindex="-1" aria-labelledby="NutritionModalabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NutritionModalLabel">Nutrition Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<!-- Telemedicine Form -->
			    @include('patients.screeningtool.forms.nutrition_form')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewNutritionModal" tabindex="-1" aria-labelledby="viewNutritionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewNutritionLabel">Nutrition Details (<strong><span id="nutrition-date"></span></strong>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Fruit Consumption: <strong><span id="nutrition-fruit"></span></strong></p>
                <hr>
                <p>Fruit Juice Consumption: <strong><span id="nutrition-fruit-juice"></span></strong></p>
                <hr>
                <p>Vegetable Consumption: <strong><span id="nutrition-vegetables"></span></strong></p>
                <hr>
                <p>Green Vegetables: <strong><span id="nutrition-green-vegetables"></span></strong></p>
                <hr>
                <p>Starchy Vegetables: <strong><span id="nutrition-starchy-vegetables"></span></strong></p>
                <hr>
                <p>Grain Consumption: <strong><span id="nutrition-grains"></span></strong></p>
                <hr>
                <p>Grain Frequency: <strong><span id="nutrition-grains-frequency"></span></strong></p>
                <hr>
                <p>Whole Grain Consumption: <strong><span id="nutrition-whole-grains"></span></strong></p>
                <hr>
                <p>Whole Grain Frequency: <strong><span id="nutrition-whole-grains-frequency"></span></strong></p>
                <hr>
                <p>Milk Consumption: <strong><span id="nutrition-milk"></span></strong></p>
                <hr>
                <p>Milk Frequency: <strong><span id="nutrition-milk-frequency"></span></strong></p>
                <hr>
                <p>Low-Fat Milk Consumption: <strong><span id="nutrition-low-fat-milk"></span></strong></p>
                <hr>
                <p>Low-Fat Milk Frequency: <strong><span id="nutrition-low-fat-milk-frequency"></span></strong></p>
                <hr>
                <p>Beans Consumption: <strong><span id="nutrition-beans"></span></strong></p>
                <hr>
                <p>Nuts & Seeds Consumption: <strong><span id="nutrition-nuts-seeds"></span></strong></p>
                <hr>
                <p>Seafood Consumption: <strong><span id="nutrition-seafood"></span></strong></p>
                <hr>
                <p>Seafood Frequency: <strong><span id="nutrition-seafood-frequency"></span></strong></p>
                <hr>
                <p>Sugar-Sweetened Beverages: <strong><span id="nutrition-ssb"></span></strong></p>
                <hr>
                <p>SSB Frequency: <strong><span id="nutrition-ssb-frequency"></span></strong></p>
                <hr>
                <p>Added Sugars: <strong><span id="nutrition-added-sugars"></span></strong></p>
                <hr>
                <p>Saturated Fat: <strong><span id="nutrition-saturated-fat"></span></strong></p>
                <hr>
                <p>Water Consumption: <strong><span id="nutrition-water"></span></strong></p>
            </div>
        </div>
    </div>
</div>

<!-- Food Recall Modal -->
<div class="modal fade" id="foodRecallModal" tabindex="-1" aria-labelledby="foodRecallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="foodRecallModalLabel">Create Food Recall Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Food view Recall Modal -->
<div class="modal fade" id="ViewfoodRecallModal" tabindex="-1" aria-labelledby="ViewfoodRecallLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewfoodRecallLabel">Food Recall Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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