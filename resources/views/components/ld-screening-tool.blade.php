@props(['patient', 'consultationId' => null])

<style>
    .active-row {
        background-color: #e3f2fd !important;
        font-weight: bold;
    }
    
    .consultation-date-input.is-loading {
        background-color: #f8f9fa;
        opacity: 0.7;
        cursor: wait;
    }
    
    .consultation-date-input.is-valid {
        border-color: #28a745;
        background-color: #d4edda;
    }
    
    .consultation-date-input.is-invalid {
        border-color: #dc3545;
        background-color: #f8d7da;
    }
</style>

<!-- Screening Tool Form Section Start -->
<div id="screeningtool-form-section">
    <input type="hidden" id="consultation_id" name="consultation_id" value="{{ $consultationId }}">
    <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient->id }}">
    <div class="row">
        <div class="col-12">
            <div class="progress-tabs">
                <div class="list-group arrow-steps clearfix" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-nutrition-list" data-bs-toggle="list" href="#list-nutrition" role="tab" aria-controls="list-nutrition">
                        <span>
                            <div class="step-title">Nutrition</div>
                            <div class="step-subtitle">Dietary assessment</div>
                        </span>
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-PA-list" data-bs-toggle="list" href="#list-PA" role="tab" aria-controls="list-PA">
                        <span>
                            <div class="step-title">Physical Activity</div>
                            <div class="step-subtitle">Exercise evaluation</div>
                        </span>
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-QOL-list" data-bs-toggle="list" href="#list-QOL" role="tab" aria-controls="list-QOL">
                        <span>
                            <div class="step-title">Quality of Life</div>
                            <div class="step-subtitle">Wellness screening</div>
                        </span>
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-TP-list" data-bs-toggle="list" href="#list-TP" role="tab" aria-controls="list-TP">
                        <span>
                            <div class="step-title">Telemedicine Perception</div>
                            <div class="step-subtitle">Technology assessment</div>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="list-TP" role="tabpanel" aria-labelledby="list-TP-list">
                @include('patients.screeningtool.forms.telemedicine_perception_result')
            </div>
            <div class="tab-pane fade show active" id="list-nutrition" role="tabpanel" aria-labelledby="list-nutrition-list">
                @include('patients.screeningtool.forms.nutrition_tab')
            </div>
            <div class="tab-pane fade" id="list-QOL" role="tabpanel" aria-labelledby="list-QOL-list">
                @include('patients.screeningtool.forms.quality_life_tab')
            </div>
            <div class="tab-pane fade" id="list-PA" role="tabpanel" aria-labelledby="list-PA-list">
                @include('patients.screeningtool.forms.physical_activity_form')
            </div>
        </div>
    </div>
</div>
<!-- Screening Tool Form Section End -->
 
<style>
    .clearfix:after {
        clear: both;
        content: "";
        display: block;
        height: 0;
    }

    .progress-tabs {
        padding: 20px 10%;
        position: relative;
        font-family: 'Lato', sans-serif;
    }

    .progress-tabs .list-group {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        position: relative;
        margin: 2rem 0;
        max-width: 100%;
        margin-top: 0;
        flex-wrap: nowrap;
    }

    .arrow-steps {
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 100%;
        gap: 10px;
    }

    .arrow-steps .list-group-item {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        color: #666;
        cursor: pointer;
        margin: 0;
        padding: 15px 15px 15px 30px;
        min-width: 180px;
        flex: 1;
        position: relative;
        background-color: #e5e7eb;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; 
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        text-decoration: none;
        max-width: 250px;
    }

    .arrow-steps .list-group-item:after,
    .arrow-steps .list-group-item:before {
        content: " ";
        position: absolute;
        top: 0;
        right: -15px;
        width: 0;
        height: 0;
        border-top: 25px solid transparent;
        border-bottom: 25px solid transparent;
        border-left: 15px solid #e5e7eb;	
        z-index: 2;
        transition: all 0.3s ease;
    }

    .arrow-steps .list-group-item:before {
        right: auto;
        left: 0;
        border-left: 15px solid #fff;	
        z-index: 0;
    }

    .arrow-steps .list-group-item:first-child:before {
        border: none;
    }

    .arrow-steps .list-group-item:first-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .arrow-steps .list-group-item span {
        display: block;
    }

    .arrow-steps .list-group-item .step-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .arrow-steps .list-group-item .step-subtitle {
        font-size: 11px;
        opacity: 0.8;
        font-weight: 400;
    }

    .arrow-steps .list-group-item.active {
        color: #fff;
        background-color: #0891b2;
    }

    .arrow-steps .list-group-item.active:after {
        border-left: 15px solid #0891b2;	
    }

    .arrow-steps .list-group-item.completed {
        color: #ffffff;
        background-color: #10b981;
    }

    .arrow-steps .list-group-item.completed:after {
        border-left: 15px solid #10b981;	
    }

    /* Active state takes priority over completed state */
    .arrow-steps .list-group-item.active.completed {
        color: #fff;
        background-color: #0891b2;
    }

    .arrow-steps .list-group-item.active.completed:after {
        border-left: 15px solid #0891b2;	
    }

    .arrow-steps .list-group-item:last-child:after {
        display: none;
    }

    .arrow-steps .list-group-item:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    /* Handle responsive design */
    @media (max-width: 768px) {
        .arrow-steps {
            flex-direction: column;
        }
        .arrow-steps .list-group-item {
            margin-bottom: 5px;
            min-width: 200px;
            max-width: none;
        }
        .arrow-steps .list-group-item:after,
        .arrow-steps .list-group-item:before {
            display: none;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize consultation mode
        window.consultationMode = true;
        
        // Set consultation and patient IDs
        var consultationId = {{ $consultationId ?? 'null' }};
        var patientId = {{ $patient->id }};
        
        // Set hidden fields in all screening tool forms
        $('#consultation_id').val(consultationId);
        $('#patient_id').val(patientId);
        $('#nutrition_consultation_id').val(consultationId);
        $('#qol_consultation_id').val(consultationId);
        $('#tp_consultation_id').val(consultationId);
        $('#pa_consultation_id').val(consultationId);
        
        // Load existing data for this consultation if consultationId is provided
        if (consultationId) {
            loadConsultationData(consultationId);
        }

        // Function to check and mark completed steps
        function checkCompletedSteps() {
            // Check each step for saved data
            checkStepCompletion('list-nutrition-list');
            checkStepCompletion('list-PA-list');
            checkStepCompletion('list-QOL-list');
            checkStepCompletion('list-TP-list');
        }

        // Make checkCompletedSteps available globally for debugging
        window.checkCompletedSteps = checkCompletedSteps;

        function checkStepCompletion(stepId) {
            let hasData = false;
            
            // Check specifically for saved data in each tab section
            if (stepId === 'list-nutrition-list') {
                // Check if nutrition results table has data rows (excluding "No data" messages)
                const nutritionRows = $('#nutrition-results-tbody tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    // Has data if it's not a "no data" message and has multiple columns
                    return !text.includes('no nutrition data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = nutritionRows.length > 0;
                
            } else if (stepId === 'list-PA-list') {
                // Check if physical activity results table has data
                const paRows = $('#physical-activity-results-tbody tr, #PhysicalActivityTable tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    return !text.includes('no physical activity data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = paRows.length > 0;
                
            } else if (stepId === 'list-QOL-list') {
                // Check if quality of life results table has data
                const qolRows = $('#qualityOfLifeTableBody tr, #qol-results-tbody tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    return !text.includes('no quality of life data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = qolRows.length > 0;
                
            } else if (stepId === 'list-TP-list') {
                // Check if telemedicine perception results table has data
                const tpRows = $('#telemedicine-perception-results-tbody tr, #telemedicine-results-table tr').filter(function() {
                    const $row = $(this);
                    const text = $row.text().toLowerCase();
                    return !text.includes('no telemedicine perception data') && 
                           !text.includes('no data available') &&
                           !text.includes('loading') &&
                           $row.find('td').length > 1 &&
                           !$row.find('td').first().hasClass('text-center');
                });
                hasData = tpRows.length > 0;
            }
            
            // Mark step as completed if it has data
            if (hasData) {
                $('#' + stepId).addClass('completed');
            } else {
                $('#' + stepId).removeClass('completed');
            }
        }

        // Check completed steps on page load (multiple times to ensure all data is loaded)
        setTimeout(checkCompletedSteps, 1000);
        setTimeout(checkCompletedSteps, 2000);
        setTimeout(checkCompletedSteps, 3000);

        // Update completion status when switching tabs
        $('[data-bs-toggle="list"]').on('shown.bs.tab', function (e) {
            // Remove active from all steps
            $('.list-group-item').removeClass('active');
            // Add active to current step (but preserve completed class)
            $(e.target).addClass('active');
            // Check completed steps
            setTimeout(checkCompletedSteps, 200);
        });
        
        $('#telemedicine-perception-form').submit(function(event) {
            event.preventDefault();

            // Add consultation_id to form data
            var formData = $(this).serialize();
            if (consultationId) {
                formData += '&consultation_id=' + consultationId;
            }
            formData += '&patient_id=' + patientId;

            $.ajax({
                url: "{{ route('telemedicine_perception.store') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    alert("Survey submitted successfully!");
                    $('#telemedicine-perception-form')[0].reset();
                    $('#TelemedicinePerceptionModal').modal('hide');
                    // Reload consultation data
                    if (consultationId) {
                        loadConsultationData(consultationId);
                    }
                    // Update completion status
                    setTimeout(checkCompletedSteps, 1000);
                },
                error: function(xhr) {
                    alert("An error occurred. Please try again.");
                }
            });
        });

        $(document).on('click', '.view-details', function () {
            let modalData = {
                date: $(this).data('date') || 'N/A',
                firstTime: $(this).data('first') || 'N/A',
                q1: $(this).data('q1') || 'N/A',
                q2: $(this).data('q2') || 'N/A',
                q3: $(this).data('q3') || 'N/A',
                q4: $(this).data('q4') || 'N/A',
                q5: $(this).data('q5') || 'N/A',
                satisfaction: $(this).data('satisfaction') || 'N/A'
            };
            
            // Use the populateTelemedicineModal function if available
            if (typeof populateTelemedicineModal === 'function') {
                populateTelemedicineModal(modalData);
                $('#viewTestModal').modal('show');
            } else {
                // Fallback: populate modal directly
                $("#data-date").text(modalData.date);
                $("#data-first").text(modalData.firstTime);
                $("#data-q1").text(modalData.q1);
                $("#data-q2").text(modalData.q2);
                $("#data-q3").text(modalData.q3);
                $("#data-q4").text(modalData.q4);
                $("#data-q5").text(modalData.q5);
                $("#data-satisfaction").text(modalData.satisfaction);
                $('#viewTestModal').modal('show');
            }
        });

        $('#nutrition-form').submit(function (e) {
            e.preventDefault();

            // Add consultation_id and patient_id to form data
            var formData = $(this).serialize();
            if (consultationId) {
                formData += '&consultation_id=' + consultationId;
            }
            formData += '&patient_id=' + patientId;

            $.ajax({
                url: "{{ route('nutrition.store') }}", // Define route in web.php
                type: "POST",
                data: formData,
                success: function (response) {
                    alert('Form submitted successfully!');
                    $('#nutrition-form')[0].reset();
                    $('#NutritionModal').modal('hide');
                    // Reload consultation data
                    if (consultationId) {
                        loadConsultationData(consultationId);
                    }
                    // Update completion status
                    setTimeout(checkCompletedSteps, 1000);
                },
                error: function (xhr) {
                    alert('Error submitting form!');
                }
            });
        });

        // TDEE Form Submission Handler
        $(document).on('submit', '#tdeeForm', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('tdee.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    // Close modal
                    const tdeeModal = bootstrap.Modal.getInstance(document.getElementById('tdeeModal'));
                    if (tdeeModal) {
                        tdeeModal.hide();
                    }
                    
                    // Update display with fallbacks
                    $('#tdeeValue').text((response.tdee || 'N/A') + (response.tdee ? ' kcal/day' : ''));
                    $('#bmrValue').text((response.bmr || 'N/A') + (response.bmr ? ' kcal/day' : ''));
                    
                    alert(response.message || 'TDEE saved successfully!');
                },
                error: function(xhr) {
                    let errorMsg = 'Error saving TDEE data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    alert(errorMsg);
                    console.error('TDEE save error:', xhr);
                }
            });
        });

        // Macronutrient Modal Click Handler
        $(document).on('click', '.open-macro-modal', function() {
            let currentPatientId = $(this).data("patient-id") || patientId;

            $.ajax({
                url: "/patient/" + currentPatientId + "/macronutrients",
                type: "GET",
                success: function(response) {
                    // Guard against undefined response
                    if (!response) {
                        alert("No macronutrient data available");
                        return;
                    }

                    // Update TDEE values with fallbacks
                    $("#tdee-value, #tdee-value-fat, #tdee-value-carbs").text(response.tdee || 'N/A');
                    $("#weight-kg").text(response.weight_kg || 'N/A');

                    // Macronutrient values with fallbacks
                    $("#protein-grams").text(response.protein_grams || 'N/A');
                    $("#protein-calories").text(response.protein_calories || 'N/A');
                    $("#fat-grams").text(response.fat_grams || 'N/A');
                    $("#fat-calories").text(response.fat_calories || 'N/A');
                    $("#carbs-grams").text(response.carbs_grams || 'N/A');
                    $("#carbs-calories").text(response.carbs_calories || 'N/A');

                    // Show modal safely
                    try {
                        const macroModal = new bootstrap.Modal(document.getElementById('macroModal'));
                        macroModal.show();
                    } catch (error) {
                        console.error('Error showing macro modal:', error);
                        alert('Error displaying macronutrient data');
                    }
                },
                error: function(xhr) {
                    let errorMsg = "Error fetching macronutrient data.";
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMsg += " " + xhr.responseJSON.error;
                    }
                    alert(errorMsg);
                    console.error('Macronutrient fetch error:', xhr);
                }
            });
        });

        // Meal Plan Modal Click Handler
        $(document).on('click', '.open-meal-plan-modal', function() {
            let currentPatientId = $(this).data("patient-id") || patientId;

            $.ajax({
                url: "/get-meal-plans/" + currentPatientId,
                type: "GET",
                success: function(response) {
                    let tableBody = $("#mealPlanTableBody");
                    tableBody.empty();

                    if (response && response.length > 0) {
                        response.forEach(meal => {
                            let formattedDate = new Date(meal.date).toLocaleDateString() || meal.date;
                            tableBody.append(`
                                <tr>
                                    <td>${formattedDate}</td>
                                    <td>${meal.meal_type || 'N/A'}</td>
                                    <td>${meal.protein || '0'} g</td>
                                    <td>${meal.fat || '0'} g</td>
                                    <td>${meal.carbohydrates || '0'} g</td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.append('<tr><td colspan="5" class="text-center text-muted">No meal plans available.</td></tr>');
                    }

                    // Show modal safely
                    try {
                        const mealPlanModal = new bootstrap.Modal(document.getElementById('mealPlanModal'));
                        mealPlanModal.show();
                    } catch (error) {
                        console.error('Error showing meal plan modal:', error);
                        alert('Error displaying meal plan data');
                    }
                },
                error: function(xhr) {
                    console.error("Error fetching meal plans:", xhr);
                    alert("Error fetching meal plans. Please try again.");
                }
            });
        });

        // Open Add Meal Plan Modal
        $(document).on('click', '.open-add-meal-modal', function() {
            try {
                const mealPlanModal = bootstrap.Modal.getInstance(document.getElementById('mealPlanModal'));
                if (mealPlanModal) {
                    mealPlanModal.hide();
                }
                
                const addMealModal = new bootstrap.Modal(document.getElementById('addMealPlanModal'));
                addMealModal.show();
            } catch (error) {
                console.error('Error opening add meal modal:', error);
            }
        });

        // Save Meal Plan Handler
        $(document).on('click', '#saveMealPlanBtn', function(e) {
            e.preventDefault();
            
            const form = document.getElementById('addMealPlanForm');
            const formData = new FormData(form);
            formData.append('patient_id', patientId);

            $.ajax({
                url: "{{ route('save-meal-plan') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Close modal
                    const addMealModal = bootstrap.Modal.getInstance(document.getElementById('addMealPlanModal'));
                    if (addMealModal) {
                        addMealModal.hide();
                    }
                    
                    // Reset form
                    form.reset();
                    
                    alert(response.message || 'Meal plan saved successfully!');
                },
                error: function(xhr) {
                    console.error('Error saving meal plan:', xhr);
                    let errorMsg = 'Error saving meal plan.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    alert(errorMsg);
                }
            });
        });

        // Helper function to format nutrition values for display
        function formatNutritionValue(value, type = 'serving') {
            if (!value || value === 'na') {
                return '<span class="text-muted">Not answered</span>';
            }
            
            if (value === 'none' || value === 'some' || value === 'a_lot') {
                return value.charAt(0).toUpperCase() + value.slice(1).replace('_', ' ');
            }
            
            // Convert numeric values to meaningful labels
            const servingLabels = {
                '1': '<1 serving/day',
                '2': '1 serving/day', 
                '3': '2 servings/day',
                '4': '3 servings/day',
                '5': '4 servings/day',
                '6': '5 servings/day',
                '7': '>6 servings/day'
            };
            
            const frequencyLabels = {
                '1': 'Never',
                '2': 'Rarely',
                '3': 'Sometimes',
                '4': 'Often',
                '5': 'Usually',
                '6': 'Almost always',
                '7': 'Always',
                'N/A': 'N/A'
            };
            
            if (type === 'frequency') {
                return frequencyLabels[value] || value;
            } else {
                return servingLabels[value] || value + ' servings/day';
            }
        }

        // Use event delegation for dynamically created elements
        $(document).on('click', '.view-nutrition-details', function () {
            // Get data attributes from the clicked button
            let date = $(this).data("date");
            let score = $(this).data("score");
            let fruit = $(this).data("fruit");
            let fruitJuice = $(this).data("fruit_juice");
            let vegetables = $(this).data("vegetables");
            let greenVegetables = $(this).data("green_vegetables");
            let starchyVegetables = $(this).data("starchy_vegetables");
            let grains = $(this).data("grains");
            let grainsFrequency = $(this).data("grains_frequency");
            let wholeGrains = $(this).data("whole_grains");
            let wholeGrainsFrequency = $(this).data("whole_grains_frequency");
            let milk = $(this).data("milk");
            let milkFrequency = $(this).data("milk_frequency");
            let lowFatMilk = $(this).data("low_fat_milk");
            let lowFatMilkFrequency = $(this).data("low_fat_milk_frequency");
            let beans = $(this).data("beans");
            let nutsSeeds = $(this).data("nuts_seeds");
            let seafood = $(this).data("seafood");
            let seafoodFrequency = $(this).data("seafood_frequency");
            let ssb = $(this).data("ssb");
            let ssbFrequency = $(this).data("ssb_frequency");
            let addedSugars = $(this).data("added_sugars");
            let saturatedFat = $(this).data("saturated_fat");
            let water = $(this).data("water");

            // Populate modal fields with formatted values
            $("#nutrition-date").text(date);
            $("#nutrition-score").text(score);
            $("#nutrition-fruit").html(formatNutritionValue(fruit));
            $("#nutrition-fruit-juice").html(formatNutritionValue(fruitJuice));
            $("#nutrition-vegetables").html(formatNutritionValue(vegetables));
            $("#nutrition-green-vegetables").html(formatNutritionValue(greenVegetables));
            $("#nutrition-starchy-vegetables").html(formatNutritionValue(starchyVegetables));
            $("#nutrition-grains").html(formatNutritionValue(grains));
            $("#nutrition-grains-frequency").html(formatNutritionValue(grainsFrequency, 'frequency'));
            $("#nutrition-whole-grains").html(formatNutritionValue(wholeGrains));
            $("#nutrition-whole-grains-frequency").html(formatNutritionValue(wholeGrainsFrequency, 'frequency'));
            $("#nutrition-milk").html(formatNutritionValue(milk));
            $("#nutrition-milk-frequency").html(formatNutritionValue(milkFrequency, 'frequency'));
            $("#nutrition-low-fat-milk").html(formatNutritionValue(lowFatMilk));
            $("#nutrition-low-fat-milk-frequency").html(formatNutritionValue(lowFatMilkFrequency, 'frequency'));
            $("#nutrition-beans").html(formatNutritionValue(beans));
            $("#nutrition-nuts-seeds").html(formatNutritionValue(nutsSeeds));
            $("#nutrition-seafood").html(formatNutritionValue(seafood));
            $("#nutrition-seafood-frequency").html(formatNutritionValue(seafoodFrequency, 'frequency'));
            $("#nutrition-ssb").html(formatNutritionValue(ssb));
            $("#nutrition-ssb-frequency").html(formatNutritionValue(ssbFrequency, 'frequency'));
            $("#nutrition-added-sugars").html(formatNutritionValue(addedSugars));
            $("#nutrition-saturated-fat").html(formatNutritionValue(saturatedFat));
            $("#nutrition-water").html(formatNutritionValue(water));

            // Show the modal
            $("#viewNutritionModal").modal("show");
        });

        // Open modal and set nutrition ID
        $('.open-foodrecall-modal').on('click', function() {
            let nutritionId = $(this).data('nutrition-id');
            $('#nutrition_id').val(nutritionId);
        });

        // Handle form submission via AJAX
        $('#foodRecallForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('food-recall.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert("Food Recall entry added successfully!");
                    $('#foodRecallForm')[0].reset();
                    $('#foodRecallModal').modal('hide');
                },
                error: function(xhr) {
                    alert("An error occurred. Please try again.");
                    console.error(xhr.responseText);
                }
            });
        });

        $(".open-viewfoodrecall-modal").click(function () {
            let nutritionId = $(this).data("nutrition-id");

            // Clear the table while loading
            $("#foodRecallTableBody").html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');

            $.ajax({
                url: "/food-recall/" + nutritionId,
                type: "GET",
                success: function (response) {
                    let rows = "";

                    if (response.foodRecalls && response.foodRecalls.length > 0) {
                        response.foodRecalls.forEach(function (food_recalls) {
                            let formattedDate = new Date(food_recalls.created_at).toLocaleDateString("en-US", {
                                month: "short",
                                day: "2-digit",
                                year: "numeric"
                            });
                            
                            rows += `
                                <tr>
                                    <td>${formattedDate}</td>
                                    <td>${food_recalls.breakfast || 'N/A'}</td>
                                    <td>${food_recalls.am_snack || 'N/A'}</td>
                                    <td>${food_recalls.lunch || 'N/A'}</td>
                                    <td>${food_recalls.pm_snack || 'N/A'}</td>
                                    <td>${food_recalls.dinner || 'N/A'}</td>
                                    <td>${food_recalls.midnight_snack || 'N/A'}</td>
                                </tr>
                            `;
                        });
                    } else {
                        rows = '<tr><td colspan="7" class="text-center text-muted">No food recall entries found.</td></tr>';
                    }

                    $("#foodRecallTableBody").html(rows);
                },
                error: function (xhr) {
                    console.error('Error fetching food recalls:', xhr);
                    $("#foodRecallTableBody").html('<tr><td colspan="7" class="text-center text-danger">Error fetching data. Please try again.</td></tr>');
                }
            });
        });

        // Handle form submission via AJAX
        $('#qualityOfLifeForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Add consultation_id and patient_id to form data
            var formData = $(this).serialize();
            if (consultationId) {
                formData += '&consultation_id=' + consultationId;
            }
            formData += '&patient_id=' + patientId;

            $.ajax({
                url: "{{ route('qualityoflife.store') }}", // Update with your actual route
                type: "POST",
                data: formData,
                success: function(response) {
                    alert("Quality of Life entry added successfully!");
                    $('#qualityOfLifeForm')[0].reset();
                    $('#QualityOfLifeModal').modal('hide');
                    // Reload consultation data
                    if (consultationId) {
                        loadConsultationData(consultationId);
                    }
                    // Update completion status
                    setTimeout(checkCompletedSteps, 1000);
                },
                error: function(xhr) {
                    alert("An error occurred. Please try again.");
                    console.error(xhr.responseText); // Log error for debugging
                }
            });
        });

        // QOL Details view handler
        $(document).on('click', '.view-qol-details', function() {
            // Get data attributes from the clicked button
            let date = $(this).data("date");
            let mobility = $(this).data("mobility");
            let selfCare = $(this).data("self_care");
            let usualActivities = $(this).data("usual_activities");
            let pain = $(this).data("pain");
            let anxiety = $(this).data("anxiety");
            let healthToday = $(this).data("health_today");
            let qolLevel = $(this).data("qol_level");
            
            // Helper function to get level description
            function getLevelDescription(level, dimension) {
                const descriptions = {
                    mobility: {
                        1: 'No problems walking',
                        2: 'Slight problems walking', 
                        3: 'Moderate problems walking',
                        4: 'Severe problems walking',
                        5: 'Unable to walk'
                    },
                    self_care: {
                        1: 'No problems washing or dressing myself',
                        2: 'Slight problems washing or dressing myself',
                        3: 'Moderate problems washing or dressing myself', 
                        4: 'Severe problems washing or dressing myself',
                        5: 'Unable to wash or dress myself'
                    },
                    usual_activities: {
                        1: 'No problems doing my usual activities',
                        2: 'Slight problems doing my usual activities',
                        3: 'Moderate problems doing my usual activities',
                        4: 'Severe problems doing my usual activities', 
                        5: 'Unable to do my usual activities'
                    },
                    pain_discomfort: {
                        1: 'No pain or discomfort',
                        2: 'Slight pain or discomfort',
                        3: 'Moderate pain or discomfort',
                        4: 'Severe pain or discomfort',
                        5: 'Extreme pain or discomfort'
                    },
                    anxiety_depression: {
                        1: 'Not anxious or depressed',
                        2: 'Slightly anxious or depressed',
                        3: 'Moderately anxious or depressed',
                        4: 'Very anxious or depressed',
                        5: 'Extremely anxious or depressed'
                    }
                };
                return descriptions[dimension][level] || 'Unknown level';
            }
            
            // Health perception interpretation
            let healthInterpretation = '';
            if (healthToday >= 80) {
                healthInterpretation = '<span class="badge bg-success me-2">High Perceived Health</span>Excellent health perception reported (80-100).';
            } else if (healthToday >= 50) {
                healthInterpretation = '<span class="badge bg-warning me-2">Moderate Perceived Health</span>Moderate health perception with room for improvement (50-79).';
            } else {
                healthInterpretation = '<span class="badge bg-danger me-2">Low Perceived Health</span>Low health perception that may need attention (0-49).';
            }
            
            // Populate modal fields
            $("#qol-date").text(date || 'N/A');
            $("#qol-health-today").text(healthToday || 'N/A');
            $("#qol-overall-level").text(qolLevel || 'N/A');
            
            // Populate dimension details with fallbacks for undefined values
            $("#qol-mobility-level").text(mobility || 'N/A');
            $("#qol-mobility-desc").text(getLevelDescription(mobility, 'mobility'));
            $("#qol-selfcare-level").text(selfCare || 'N/A');
            $("#qol-selfcare-desc").text(getLevelDescription(selfCare, 'self_care'));
            $("#qol-activities-level").text(usualActivities || 'N/A');
            $("#qol-activities-desc").text(getLevelDescription(usualActivities, 'usual_activities'));
            $("#qol-pain-level").text(pain || 'N/A');
            $("#qol-pain-desc").text(getLevelDescription(pain, 'pain_discomfort'));
            $("#qol-anxiety-level").text(anxiety || 'N/A');
            $("#qol-anxiety-desc").text(getLevelDescription(anxiety, 'anxiety_depression'));
            
            // Set health interpretation
            $("#qol-health-interpretation").html(healthInterpretation);
            
            // Show the modal
            $("#viewQOLModal").modal("show");
        });

        // Physical Activity form submission
        $(document).on('submit', '#physical-activity-form', function(e) {
            e.preventDefault();
            
            var formData = $(this).serialize();
            if (consultationId) {
                formData += '&consultation_id=' + consultationId;
            }
            formData += '&patient_id=' + patientId;

            $.ajax({
                url: "{{ route('physical-activity.store') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    alert("Physical Activity data saved successfully!");
                    $('#physical-activity-form')[0].reset();
                    $('#PhysicalActivityModal').modal('hide');
                    // Reload consultation data (same pattern as nutrition)
                    if (consultationId) {
                        loadConsultationData(consultationId);
                    }
                    // Update completion status
                    setTimeout(checkCompletedSteps, 1000);
                },
                error: function(xhr) {
                    alert("An error occurred while saving. Please try again.");
                    console.error(xhr.responseText);
                }
            });
        });

        // Function to load existing data for a consultation
        function loadConsultationData(consultationId) {
            // Set consultation mode flag
            window.consultationMode = true;
            
            // Load nutrition data
            $.get('/consultations/' + consultationId + '/nutrition', function(data) {
                updateNutritionDisplay(data);
            });
            
            // Load quality of life data
            $.get('/consultations/' + consultationId + '/quality-of-life', function(data) {
                updateQualityOfLifeDisplay(data);
            });
            
            // Load telemedicine perception data
            $.get('/consultations/' + consultationId + '/telemedicine-perception', function(data) {
                updateTelemedicineDisplay(data);
            });
            
            // Load physical activity data
            $.get('/consultations/' + consultationId + '/physical-activity', function(data) {
                updatePhysicalActivityDisplay(data);
            });

            // Check completed steps after loading all data
            setTimeout(checkCompletedSteps, 1000);
        }

        // Functions to update displays with consultation-specific data
        function updateNutritionDisplay(data) {
            var tbody = $('#nutrition-results-tbody');
            tbody.empty();
            
            if (data.length > 0) {
                $('#nutrition-data-container').show();
                $('#no-consultation-selected').hide();
                
                // Show food recall buttons and set nutrition ID for the latest record in this consultation
                let latestNutrition = data[0]; // First item is latest due to orderBy in controller
                $('#food-recall-buttons').show();
                $('#no-nutrition-for-recall').hide();
                $('#add-food-recall-btn').attr('data-nutrition-id', latestNutrition.id);
                $('#view-food-recall-btn').attr('data-nutrition-id', latestNutrition.id);
                
                // Update latest score display and interpretation
                let latestScore = latestNutrition.dq_score || 0;
                $('#latest-score-value').text(latestScore);
                
                let interpretation = '';
                let scoreClass = '';
                if (latestScore >= 80) {
                    interpretation = '<span class="badge bg-success me-2">Excellent</span>Your dietary pattern aligns well with healthy eating guidelines.';
                    scoreClass = 'text-success';
                } else if (latestScore >= 60) {
                    interpretation = '<span class="badge bg-warning me-2">Good</span>Your diet has many healthy components with room for improvement.';
                    scoreClass = 'text-warning';
                } else if (latestScore >= 40) {
                    interpretation = '<span class="badge bg-warning me-2">Needs Improvement</span>Consider increasing fruits, vegetables, and whole grains while reducing processed foods.';
                    scoreClass = 'text-warning';
                } else {
                    interpretation = '<span class="badge bg-danger me-2">Poor</span>Significant dietary changes are recommended. Consider consulting with a nutritionist.';
                    scoreClass = 'text-danger';
                }
                
                $('#latest-score-value').removeClass('text-success text-warning text-danger').addClass(scoreClass);
                $('#score-interpretation').html(interpretation);
                
                data.forEach(function(nutrition) {
                    let formattedDate = new Date(nutrition.created_at).toLocaleDateString("en-US", {
                        month: "short",
                        day: "numeric", 
                        year: "numeric"
                    });
                    
                    let row = `
                        <tr>
                            <td>${formattedDate}</td>
                            <td>${nutrition.dq_score || 0}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary view-nutrition-details" 
                                        data-date="${formattedDate}"
                                        data-score="${nutrition.dq_score || 0}"
                                        data-fruit="${nutrition.fruit}"
                                        data-fruit_juice="${nutrition.fruit_juice}"
                                        data-vegetables="${nutrition.vegetables}"
                                        data-green_vegetables="${nutrition.green_vegetables}"
                                        data-starchy_vegetables="${nutrition.starchy_vegetables}"
                                        data-grains="${nutrition.grains}"
                                        data-grains_frequency="${nutrition.grains_frequency}"
                                        data-whole_grains="${nutrition.whole_grains}"
                                        data-whole_grains_frequency="${nutrition.whole_grains_frequency}"
                                        data-milk="${nutrition.milk}"
                                        data-milk_frequency="${nutrition.milk_frequency}"
                                        data-low_fat_milk="${nutrition.low_fat_milk}"
                                        data-low_fat_milk_frequency="${nutrition.low_fat_milk_frequency}"
                                        data-beans="${nutrition.beans}"
                                        data-nuts_seeds="${nutrition.nuts_seeds}"
                                        data-seafood="${nutrition.seafood}"
                                        data-seafood_frequency="${nutrition.seafood_frequency}"
                                        data-ssb="${nutrition.ssb}"
                                        data-ssb_frequency="${nutrition.ssb_frequency}"
                                        data-added_sugars="${nutrition.added_sugars}"
                                        data-saturated_fat="${nutrition.saturated_fat}"
                                        data-water="${nutrition.water}">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            } else {
                $('#nutrition-data-container').hide();
                $('#no-consultation-selected').show();
                
                // Hide food recall buttons when no nutrition data
                $('#food-recall-buttons').hide();
                $('#no-nutrition-for-recall').show();
            }
            
            // Check completion status after updating nutrition display
            setTimeout(checkCompletedSteps, 100);
        }

        function updateQualityOfLifeDisplay(data) {
            var tableBody = $("#qualityOfLifeTableBody");
            tableBody.empty();
            
            if (data.length > 0) {
                $('#qol-data-container').show();
                $('#no-qol-consultation-selected').hide();
                
                // Update latest QOL summary if elements exist
                let latestRecord = data[0];
                if (latestRecord && $('#latest-qol-score').length) {
                    let healthToday = latestRecord.health_today;
                    
                    $('#latest-health-today').text(healthToday + '/100');
                    
                    // Interpret health today score using VAS scoring
                    let healthInterpretation = '';
                    let healthClass = '';
                    
                    if (healthToday >= 80) {
                        healthInterpretation = '<span class="badge bg-success me-2">High Perceived Health</span>Excellent health perception reported.';
                        healthClass = 'text-success';
                    } else if (healthToday >= 50) {
                        healthInterpretation = '<span class="badge bg-warning me-2">Moderate Perceived Health</span>Moderate health perception with room for improvement.';
                        healthClass = 'text-warning';
                    } else {
                        healthInterpretation = '<span class="badge bg-danger me-2">Low Perceived Health</span>Low health perception that may need attention.';
                        healthClass = 'text-danger';
                    }
                    
                    if ($('#qol-interpretation').length) {
                        $('#qol-interpretation').html(healthInterpretation);
                    }
                    if ($('#latest-health-today').length) {
                        $('#latest-health-today').removeClass('text-success text-warning text-danger').addClass(healthClass);
                    }
                }
                
                data.forEach(function(record) {
                    let formattedDate = new Date(record.created_at).toLocaleDateString("en-US", {
                        month: "short",
                        day: "numeric",
                        year: "numeric"
                    });
                    
                    let healthToday = record.health_today;
                    
                    // Calculate overall QOL level for data attributes
                    let avgScore = (parseInt(record.mobility) + parseInt(record.self_care) + parseInt(record.usual_activities) + parseInt(record.pain || 0) + parseInt(record.anxiety || 0)) / 5;
                    let qolLevel = '';
                    
                    if (avgScore <= 1.5) {
                        qolLevel = 'No Problems';
                    } else if (avgScore <= 2.5) {
                        qolLevel = 'Slight Problems';
                    } else if (avgScore <= 3.5) {
                        qolLevel = 'Moderate Problems';
                    } else if (avgScore <= 4.5) {
                        qolLevel = 'Severe Problems';
                    } else {
                        qolLevel = 'Extreme Problems';
                    }
                    
                    // Determine health perception based on VAS score (Health Today)
                    let healthPerception = '';
                    let healthClass = '';
                    
                    if (healthToday >= 80) {
                        healthPerception = 'High Perceived Health';
                        healthClass = 'text-success';
                    } else if (healthToday >= 50) {
                        healthPerception = 'Moderate Perceived Health';
                        healthClass = 'text-warning';
                    } else {
                        healthPerception = 'Low Perceived Health';
                        healthClass = 'text-danger';
                    }
                    
                    let row = `
                        <tr>
                            <td>${formattedDate}</td>
                            <td>
                                <span class="${healthClass}">${healthPerception}</span><br>
                                <small class="text-muted">VAS Score: ${healthToday}/100 | QOL: ${qolLevel}</small>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary view-qol-details" 
                                        data-date="${formattedDate}"
                                        data-mobility="${record.mobility}"
                                        data-self_care="${record.self_care}"
                                        data-usual_activities="${record.usual_activities}"
                                        data-pain="${record.pain || 'undefined'}"
                                        data-anxiety="${record.anxiety || 'undefined'}"
                                        data-health_today="${record.health_today}"
                                        data-qol_level="${qolLevel}">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            } else {
                $('#qol-data-container').hide();
                $('#no-qol-consultation-selected').show();
            }
            
            // Check completion status after updating QOL display
            setTimeout(checkCompletedSteps, 100);
        }

        function updateTelemedicineDisplay(data) {
            var tbody = $('#telemedicine-results-tbody');
            tbody.empty();
            
            if (data.length > 0) {
                $('#tp-data-container').show();
                $('#no-tp-consultation-selected').hide();
                
                // Update latest telemedicine summary if elements exist
                let latestTest = data[0];
                if (latestTest && $('#latest-telemed-score').length) {
                    // Calculate total score from individual questions since total_score field doesn't exist
                    let totalScore = (parseInt(latestTest.question_1) || 0) + 
                                   (parseInt(latestTest.question_2) || 0) + 
                                   (parseInt(latestTest.question_3) || 0) + 
                                   (parseInt(latestTest.question_4) || 0) + 
                                   (parseInt(latestTest.question_5) || 0);
                    
                    $('#latest-telemed-score').text(totalScore);
                    
                    // Use existing satisfaction from database or calculate based on score
                    let satisfaction = '';
                    let satisfactionClass = '';
                    
                    if (latestTest.satisfaction) {
                        // Use existing satisfaction from database
                        if (latestTest.satisfaction.includes('High')) {
                            satisfaction = '<span class="badge bg-success me-2">High Satisfaction</span>Excellent telemedicine experience reported.';
                            satisfactionClass = 'text-success';
                        } else if (latestTest.satisfaction.includes('Moderate')) {
                            satisfaction = '<span class="badge bg-warning me-2">Moderate Satisfaction</span>Good telemedicine experience with some areas for improvement.';
                            satisfactionClass = 'text-warning';
                        } else {
                            satisfaction = '<span class="badge bg-danger me-2">Low Satisfaction</span>Significant concerns with telemedicine experience.';
                            satisfactionClass = 'text-danger';
                        }
                    } else {
                        // Fallback: calculate based on total score
                        if (totalScore >= 19) {
                            satisfaction = '<span class="badge bg-success me-2">High Satisfaction</span>Excellent telemedicine experience reported.';
                            satisfactionClass = 'text-success';
                        } else if (totalScore >= 12) {
                            satisfaction = '<span class="badge bg-warning me-2">Moderate Satisfaction</span>Good telemedicine experience with some areas for improvement.';
                            satisfactionClass = 'text-warning';
                        } else {
                            satisfaction = '<span class="badge bg-danger me-2">Low Satisfaction</span>Significant concerns with telemedicine experience.';
                            satisfactionClass = 'text-danger';
                        }
                    }
                    
                    if ($('#telemed-interpretation').length) {
                        $('#telemed-interpretation').html(satisfaction);
                    }
                    if ($('#latest-telemed-score').length) {
                        $('#latest-telemed-score').removeClass('text-success text-warning text-danger').addClass(satisfactionClass);
                    }
                }
                
                data.forEach(function(test) {
                    let formattedDate = new Date(test.created_at).toLocaleDateString("en-US", {
                        month: "short",
                        day: "numeric", 
                        year: "numeric"
                    });
                    
                    // Calculate total score from individual questions since total_score field doesn't exist
                    let totalScore = (parseInt(test.question_1) || 0) + 
                                   (parseInt(test.question_2) || 0) + 
                                   (parseInt(test.question_3) || 0) + 
                                   (parseInt(test.question_4) || 0) + 
                                   (parseInt(test.question_5) || 0);
                    
                    // Use existing satisfaction from database or calculate based on score
                    let satisfactionLevel = '';
                    let satisfactionClass = '';
                    
                    if (test.satisfaction) {
                        // Use existing satisfaction from database
                        satisfactionLevel = test.satisfaction;
                        if (test.satisfaction.includes('High')) {
                            satisfactionClass = 'text-success';
                        } else if (test.satisfaction.includes('Moderate')) {
                            satisfactionClass = 'text-warning';
                        } else {
                            satisfactionClass = 'text-danger';
                        }
                    } else {
                        // Fallback: calculate based on total score
                        if (totalScore >= 19) {
                            satisfactionLevel = 'High Satisfaction';
                            satisfactionClass = 'text-success';
                        } else if (totalScore >= 12) {
                            satisfactionLevel = 'Moderate Satisfaction';
                            satisfactionClass = 'text-warning';
                        } else {
                            satisfactionLevel = 'Low Satisfaction';
                            satisfactionClass = 'text-danger';
                        }
                    }
                    
                    // Format first time usage
                    let firstTime = test.first_time || 'N/A';
                    let firstTimeFormatted = firstTime.charAt(0).toUpperCase() + firstTime.slice(1);
                    
                    let row = `
                        <tr>
                            <td>${formattedDate}</td>
                            <td>
                                <span class="${satisfactionClass}">${satisfactionLevel}</span><br>
                                <small class="text-muted">Score: ${totalScore}/25</small>
                            </td>
                            <td>${firstTimeFormatted}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary view-details" 
                                        data-date="${formattedDate}"
                                        data-first="${firstTimeFormatted}"
                                        data-total-score="${totalScore}"
                                        data-satisfaction="${satisfactionLevel}"
                                        data-q1="${test.question_1}"
                                        data-q2="${test.question_2}"
                                        data-q3="${test.question_3}"
                                        data-q4="${test.question_4}"
                                        data-q5="${test.question_5}">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            } else {
                $('#tp-data-container').hide();
                $('#no-tp-consultation-selected').show();
            }
            
            // Check completion status after updating telemedicine display
            setTimeout(checkCompletedSteps, 100);
        }

        function updatePhysicalActivityDisplay(data) {
            var tbody = $('#PhysicalActivityTable tbody');
            tbody.empty();
            
            if (data && data.length > 0) {
                $('#pa-data-container').show();
                $('#no-pa-consultation-selected').hide();
                
                // Calculate activity level for the latest record (first in array)
                let latestActivity = data[0];
                if (latestActivity && latestActivity.id) {
                    calculateAndDisplayActivitySummary(latestActivity.id);
                }
                
                data.forEach(function(activity) {
                    let formattedDate = new Date(activity.created_at).toLocaleDateString("en-US", {
                        month: "short",
                        day: "numeric", 
                        year: "numeric"
                    });
                    
                    // Calculate summary for this activity record
                    let totalMetMinutes = 0;
                    let activeMinutes = 0;
                    
                    if (activity.details && activity.details.length > 0) {
                        activity.details.forEach(function(detail) {
                            let weeklyMinutes = (detail.days * detail.hours * 60) + (detail.days * detail.minutes);
                            activeMinutes += weeklyMinutes;
                            
                            // Use MET value from detail or activity_description
                            let metValue = detail.met || (detail.activity_description ? detail.activity_description.met : 0);
                            if (metValue >= 4) {
                                totalMetMinutes += weeklyMinutes * metValue;
                            }
                        });
                    }
                    
                    // Determine activity level for this record
                    let activityLevel = '';
                    let levelClass = '';
                    if (totalMetMinutes < 600) {
                        activityLevel = 'Inactive';
                        levelClass = 'text-danger';
                    } else if (totalMetMinutes >= 600 && totalMetMinutes < 1500) {
                        activityLevel = 'Moderately Active';
                        levelClass = 'text-warning';
                    } else {
                        activityLevel = 'Highly Active';
                        levelClass = 'text-success';
                    }
                    
                    let row = `
                        <tr>
                            <td>${formattedDate}</td>
                            <td>
                                <span class="${levelClass}">${activityLevel}</span><br>
                                <small class="text-muted">${totalMetMinutes.toFixed(1)} MET·min/week</small>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary view-pa-details" 
                                        data-activity-id="${activity.id}"
                                        data-date="${formattedDate}"
                                        data-level="${activityLevel}"
                                        data-met-minutes="${totalMetMinutes.toFixed(1)}"
                                        data-active-minutes="${activeMinutes}">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            } else {
                $('#pa-data-container').hide();
                $('#no-pa-consultation-selected').show();
            }
            
            // Check completion status after updating physical activity display
            setTimeout(checkCompletedSteps, 100);
        }

        // Function to calculate and display activity summary for latest record
        function calculateAndDisplayActivitySummary(activityId) {
            $.ajax({
                url: `/physical-activity/${activityId}`,
                method: "GET", 
                success: function(response) {
                    let totalMetMinutes = 0;
                    
                    // Calculate total MET minutes for activities ≥4 METs
                    if (response.details && response.details.length > 0) {
                        response.details.forEach(function(detail) {
                            // Handle different data structures that might be returned
                            let metValue = detail.met || (detail.activity_description ? detail.activity_description.met : 0);
                            
                            if (metValue >= 4) {
                                let weeklyMinutes = (detail.days * detail.hours * 60) + (detail.days * detail.minutes);
                                totalMetMinutes += weeklyMinutes * metValue;
                            }
                        });
                    }
                    
                    // Determine activity level
                    let activityLevel = '';
                    let levelClass = '';
                    let interpretation = '';
                    
                    if (totalMetMinutes < 600) {
                        activityLevel = 'Inactive';
                        levelClass = 'text-danger';
                        interpretation = '<span class="badge bg-danger me-2">Inactive</span>Below WHO recommendation; may benefit from moderate activity programs.';
                    } else if (totalMetMinutes >= 600 && totalMetMinutes < 1500) {
                        activityLevel = 'Moderately Active';
                        levelClass = 'text-warning';
                        interpretation = '<span class="badge bg-warning me-2">Moderately Active</span>Meets basic activity guidelines; encourage maintenance/improvement.';
                    } else {
                        activityLevel = 'Highly Active';
                        levelClass = 'text-success';
                        interpretation = '<span class="badge bg-success me-2">Highly Active</span>Exceeds WHO recommendations; excellent activity level.';
                    }
                    
                    // Update display elements if they exist
                    if ($('#latest-activity-level').length) {
                        $('#latest-activity-level').text(activityLevel).removeClass('text-danger text-warning text-success').addClass(levelClass);
                    }
                    if ($('#activity-interpretation').length) {
                        $('#activity-interpretation').html(interpretation + `<br><small class="text-muted">Total MET·min/week: ${totalMetMinutes.toFixed(1)}</small>`);
                    }
                },
                error: function(xhr) {
                    console.error('Error calculating activity summary:', xhr);
                    if ($('#latest-activity-level').length) {
                        $('#latest-activity-level').text('Error');
                    }
                    if ($('#activity-interpretation').length) {
                        $('#activity-interpretation').html('<span class="text-danger">Unable to calculate activity level</span>');
                    }
                }
            });
        }

        // Physical activity view details handler
        $(document).on('click', '.view-pa-details', function() {
            let activityId = $(this).data('activity-id');
            let date = $(this).data('date');
            let level = $(this).data('level');
            let metMinutes = $(this).data('met-minutes');
            let activeMinutes = $(this).data('active-minutes');
            
            // Load detailed activity data
            $.ajax({
                url: `/physical-activity/${activityId}`,
                method: "GET",
                success: function(response) {
                    // Clear and populate activities table
                    let detailsTable = $('#activityDetailsTableBody');
                    detailsTable.empty();
                    
                    let totalMetMinutes = 0;
                    let moderateVigActivities = 0;
                    
                    if (response.details && response.details.length > 0) {
                        response.details.forEach(function(detail) {
                            let activityName = detail.description ? detail.description.name : 'Unknown Activity';
                            let metValue = detail.met || (detail.activity_description ? detail.activity_description.met : 0);
                            let weeklyMinutes = (detail.days * detail.hours * 60) + (detail.days * detail.minutes);
                            let metMinutesWeek = weeklyMinutes * metValue;
                            
                            // Only show moderate to vigorous activities (≥4 METs)
                            if (metValue >= 4) {
                                totalMetMinutes += metMinutesWeek;
                                moderateVigActivities++;
                                
                                // Determine activity level for this specific activity
                                let activityLevel = '';
                                if (metValue >= 4 && metValue < 6) {
                                    activityLevel = 'Moderate';
                                } else if (metValue >= 6) {
                                    activityLevel = 'Vigorous';
                                } else {
                                    activityLevel = 'Light';
                                }
                                
                                let row = `
                                    <tr>
                                        <td>${activityName}</td>
                                        <td>${metValue}</td>
                                        <td>${detail.days}</td>
                                        <td>${detail.hours}</td>
                                        <td>${detail.minutes}</td>
                                        <td>${metMinutesWeek.toFixed(1)}</td>
                                        <td><span class="badge ${metValue >= 6 ? 'bg-danger' : 'bg-warning'}">${activityLevel}</span></td>
                                    </tr>
                                `;
                                detailsTable.append(row);
                            }
                        });
                    }
                    
                    if (moderateVigActivities === 0) {
                        detailsTable.append('<tr><td colspan="7" class="text-center text-muted">No moderate to vigorous activities found (≥4 METs)</td></tr>');
                    }
                    
                    // Update activity summary
                    let summaryHtml = '';
                    let overallLevel = '';
                    let levelClass = '';
                    
                    if (totalMetMinutes < 600) {
                        overallLevel = 'Inactive';
                        levelClass = 'text-danger';
                        summaryHtml = `
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Overall Activity Level:</strong> <span class="${levelClass}">${overallLevel}</span><br>
                                    <strong>Total MET·min/week:</strong> ${totalMetMinutes.toFixed(1)}<br>
                                    <strong>Date Assessed:</strong> ${date}
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-danger alert-sm">
                                        <small><i class="fas fa-exclamation-triangle"></i> Below WHO recommendation of 600 MET·min/week. Consider increasing moderate to vigorous physical activities.</small>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (totalMetMinutes >= 600 && totalMetMinutes < 1500) {
                        overallLevel = 'Moderately Active';
                        levelClass = 'text-warning';
                        summaryHtml = `
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Overall Activity Level:</strong> <span class="${levelClass}">${overallLevel}</span><br>
                                    <strong>Total MET·min/week:</strong> ${totalMetMinutes.toFixed(1)}<br>
                                    <strong>Date Assessed:</strong> ${date}
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-warning alert-sm">
                                        <small><i class="fas fa-check-circle"></i> Meets basic WHO guidelines. Consider increasing activities for additional health benefits.</small>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else {
                        overallLevel = 'Highly Active';
                        levelClass = 'text-success';
                        summaryHtml = `
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Overall Activity Level:</strong> <span class="${levelClass}">${overallLevel}</span><br>
                                    <strong>Total MET·min/week:</strong> ${totalMetMinutes.toFixed(1)}<br>
                                    <strong>Date Assessed:</strong> ${date}
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success alert-sm">
                                        <small><i class="fas fa-star"></i> Exceeds WHO recommendations. Excellent level of physical activity!</small>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    
                    $('#activitySummary').html(summaryHtml);
                    
                    // Show modal
                    $('#PhysicalActivityDetailsModal').modal('show');
                },
                error: function(xhr) {
                    console.error('Error loading physical activity details:', xhr);
                    alert('Error loading activity details. Please try again.');
                }
            });
        });

        // Initialize progress tracking
        $('.list-group-item').on('shown.bs.tab', function (e) {
            let currentStep = parseInt($(this).find('.step-number').text());
            
            // Mark all previous steps as completed
            $('.list-group-item').each(function() {
                let stepNum = parseInt($(this).find('.step-number').text());
                if (stepNum < currentStep) {
                    $(this).addClass('completed');
                } else if (stepNum > currentStep) {
                    $(this).removeClass('completed');
                }
            });
        });
    });
</script>