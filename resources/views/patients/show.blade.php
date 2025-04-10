<x-app-layout>
    <style type="text/css">
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>

    <div class="container mx-auto p-4">
        <div class="card shadow-lg p-4 border-0" style="width: 100%; border-radius: 2rem;">
            <div class="row g-4">
                <!-- Left Section (Profile Image & Basic Info) -->
                <div class="col-md-3 text-left border-end">
                    <a href="{{ route('patients.index') }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </button>
                    </a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit Patient</a>
                    <h5 class="fw-bold mb-1 mt-5 text-center">
                        {{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}
                    </h5>
                    <p class="text-muted mb-2 text-center">{{ $patient->diagnosis }}</p>
                </div>

                <!-- Right Section -->
                <div class="col-md-9" style="border-left: 1px solid black;">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Gender</p>
                            <p class="fw-bold">{{ $patient->gender }}</p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Age</p>
                            <p class="fw-bold">{{ $patient->age }}</p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Blood</p>
                            <p class="fw-bold">{{ $patient->blood_type }}</p>
                        </div>

                        <div class="col-4">
                            <p class="text-muted mb-1">Marital Status</p>
                            <p class="fw-bold text-success">{{ $patient->marital_status }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">Height (cm)</p>
                            <p class="fw-bold">{{ $patient->getHeightInCm() }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">Weight (kg)</p>
                            <p class="fw-bold">{{ $patient->weight_kg }}</p>
                        </div>

                        <div class="col-4">
                            <p class="text-muted mb-1">BMI (kg/m²)</p>
                            <p class="fw-bold">{{ $patient->calculateBMI() }}</p>
                        </div>

                        <div class="col-4">
                            <p class="text-muted mb-1">BMR (kcal/day)</p>
                            <p class="fw-bold">{{ $patient->calculateBMR() }}</p>
                        </div>

                        <div class="col-4">
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
                        <div class="col-4">
                            <p class="text-muted mb-1">Weight Loss / Gain</p>
                            <p class="fw-bold">
                                {{ $patient->tdee ? ($patient->tdee->tdee - 500) . " kcal / " . ($patient->tdee->tdee + 200) . " kcal" : 'Need TDEE data' }}
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">
                                Meal Plan
                                <button class="btn btn-light btn-sm open-meal-plan-modal" data-patient-id="{{ $patient->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>

                            </p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">
                                Macronutrient Split 
                                <button class="btn btn-light btn-sm open-macro-modal" data-patient-id="{{ $patient->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="laboratory-tab" data-bs-toggle="tab" data-bs-target="#laboratory-tab-pane" type="button" role="tab" aria-controls="laboratory-tab-pane" aria-selected="true">Laboratory</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Screening Tool</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="Prescription-tab" data-bs-toggle="tab" data-bs-target="#Prescription-tab-pane" type="button" role="tab" aria-controls="Prescription-tab-pane" aria-selected="false">Prescription</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="laboratory-tab-pane" role="tabpanel" aria-labelledby="laboratory-tab" tabindex="0">
                <br/>
                @include('patients.laboratory.laboratory', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <br/>
                @include('patients.screeningtool.screeningtool', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="Prescription-tab-pane" role="tabpanel" aria-labelledby="Prescription-tab" tabindex="0">
                <br/>
                @include('prescriptions.prescription_patient', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
        </div>
    </div>

    <!-- TDEE Modal -->
    <div class="modal fade" id="tdeeModal" tabindex="-1" aria-labelledby="tdeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tdeeModalLabel">Calculate TDEE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tdeeForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                        <label class="fw-bold">Activity Level</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="sedentary" required>
                            <label class="form-check-label">Sedentary (Little to no exercise)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="lightly active">
                            <label class="form-check-label">Lightly active (1-3 days/week)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="moderately active">
                            <label class="form-check-label">Moderately active (3-5 days/week)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="very active">
                            <label class="form-check-label">Very active (6-7 days/week)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="extra active">
                            <label class="form-check-label">Extra active (Physical job & sports)</label>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">Save TDEE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     

    <!-- Macronutrient Modal -->
    <div class="modal fade" id="macroModal" tabindex="-1" aria-labelledby="macroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="macroModalLabel">Macronutrient Breakdown</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Goal for Fat Loss = <span id="tdee-value"></span> kcal/day</strong></p>
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Protein <br> (0.8g per kg bodyweight)</th>
                                <th>Fat <br> (15% of total calories)</th>
                                <th>Carbohydrates <br> (Remaining Calories)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>= 0.8g x <span id="weight-kg"></span> kg = <strong><span id="protein-grams"></span> g</strong> <br>
                                    x 4 kcal/g = <strong><span id="protein-calories"></span> kcal</strong>
                                </td>
                                <td>= 0.15 x <span id="tdee-value-fat"></span> = <strong><span id="fat-calories"></span> kcal</strong> <br>
                                    ÷ 9 kcal/g = <strong><span id="fat-grams"></span> g</strong>
                                </td>
                                <td>= <span id="tdee-value-carbs"></span> kcal – (<span id="protein-calories"></span> kcal protein) + (<span id="fat-calories"></span> kcal fat) <br>
                                    = <strong><span id="carbs-calories"></span> kcal</strong> ÷ 4 kcal/g = <strong><span id="carbs-grams"></span> g</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Meal Plan Modal-->
    <div class="modal fade" id="mealPlanModal" tabindex="-1" aria-labelledby="mealPlanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mealPlanLabel">Sample Meal Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Meal Type</th>
                                <th>Protein (g)</th>
                                <th>Fat (g)</th>
                                <th>Carbohydrates (g)</th>
                            </tr>
                        </thead>
                        <tbody id="mealPlanTableBody">
                            <tr>
                                <td colspan="5" class="text-center">No records available.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary open-add-meal-modal"><i class="fa-solid fa-plus"></i> Add Meal Plan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Meal Plan Modal-->
    <div class="modal fade" id="addMealPlanModal" tabindex="-1" aria-labelledby="addMealPlanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMealPlanLabel">Add Meal Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMealPlanForm">
                        @csrf
                        <input type="hidden" id="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" id="mealPlanDate" class="form-control" name="mealPlanDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meal Type</label>
                            <select  id="meal_type" class="form-control" name="meal_type">
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="PM Snacks">PM Snacks</option>
                                <option value="Dinner">Dinner</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Protein (g)</label>
                            <input type="number" id="protein" class="form-control" name="protein" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fat (g)</label>
                            <input type="number" id="fat" class="form-control" name="fat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Carbohydrates (g)</label>
                            <input type="number" id="carbohydrates" class="form-control" name="carbohydrates" required>
                        </div>
                        <button type="submit" id="saveMealPlanBtn" class="btn btn-success">Save Meal Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    $('#tdeeForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('tdee.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#tdeeModal').modal('hide'); // Close modal
                $('#tdeeValue').text(response.tdee + ' kcal/day'); // Update display
                alert(response.message);
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
    });

    $(".open-macro-modal").click(function () {
        let patientId = $(this).data("patient-id"); // Get patient ID from button

        $.ajax({
            url: "/patient/" + patientId + "/macronutrients", // Pass ID in URL
            type: "GET",
            success: function (response) {
                $("#tdee-value, #tdee-value-fat, #tdee-value-carbs").text(response.tdee);
                $("#weight-kg").text(response.weight_kg);

                // Macronutrient values
                $("#protein-grams").text(response.protein_grams);
                $("#protein-calories").text(response.protein_calories);
                $("#fat-grams").text(response.fat_grams);
                $("#fat-calories").text(response.fat_calories);
                $("#carbs-grams").text(response.carbs_grams);
                $("#carbs-calories").text(response.carbs_calories);

                // Show modal
                $("#macroModal").modal("show");
            },
            error: function () {
                alert("Error fetching macronutrient data.");
            }
        });
    });

    // Open meal plan modal
    $(".open-meal-plan-modal").click(function () {
        let patientId = $(this).data("patient-id"); // Get patient ID from button attribute

        $.ajax({
            url: "/get-meal-plans/" + patientId,  // Pass patient_id in the URL
            type: "GET",
            success: function (response) {
                let tableBody = $("#mealPlanTableBody");
                tableBody.empty();

                if (response.length > 0) {
                    response.forEach(meal => {
                        tableBody.append(`
                            <tr>
                                <td>${meal.date}</td>
                                <td>${meal.meal_type}</td>
                                <td>${meal.protein} g</td>
                                <td>${meal.fat} g</td>
                                <td>${meal.carbohydrates} g</td>
                            </tr>
                        `);
                    });
                } else {
                    tableBody.append('<tr><td colspan="5" class="text-center">No records available.</td></tr>');
                }

                $("#mealPlanModal").modal("show"); // Show modal
            },
            error: function () {
                alert("Error fetching meal plans.");
            }
        });
    });


    // Open add meal modal
    $(".open-add-meal-modal").click(function () {
        $("#mealPlanModal").modal("hide");
        $("#addMealPlanModal").modal("show");
    });

    // Save new meal plan
    $("#saveMealPlanBtn").click(function () {
        let formData = {
            patient_id: $("#patient_id").val(),
            meal_type: $("#meal_type").val(),
            protein: $("#protein").val(),
            fat: $("#fat").val(),
            carbohydrates: $("#carbohydrates").val(),
            date: $("#mealPlanDate").val(),
            _token: $('meta[name="csrf-token"]').attr("content"), // Include CSRF token
        };

        $.ajax({
            url: "/save-meal-plan", // Ensure this matches your web.php route
            type: "POST",
            data: formData,
            success: function (response) {
                alert("Meal Plan saved successfully!");
                // $("#mealPlanModal").modal("hide");
                // location.reload();
            },
            error: function (xhr) {
                alert("Error saving meal plan: " + xhr.responseText);
            },
        });
    });
});
</script>

</x-app-layout>