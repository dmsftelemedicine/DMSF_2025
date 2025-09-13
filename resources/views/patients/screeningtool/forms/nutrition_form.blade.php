<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <form id="nutrition-form">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="consultation_id" id="nutrition_consultation_id" value="">
                
                <div class="row">
                    <!-- Fruits Section -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">1. Daily Fruit Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of fruit (not including juice) do you eat per day?</small>
                            <select class="form-select" name="fruit" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">2. Daily Fruit Juice Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of 100% fruit juice do you drink per day?</small>
                            <select class="form-select" name="fruit_juice" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Vegetables Section -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">3. Daily Vegetable Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of vegetables do you eat per day?</small>
                            <select class="form-select" name="vegetables" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">4. Daily Green Vegetable Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of green vegetables do you eat per day?</small>
                            <select class="form-select" name="green_vegetables" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">5. Daily Starchy Vegetable Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of starchy vegetables do you eat per day?</small>
                            <select class="form-select" name="starchy_vegetables" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Grains Section -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">6. Daily Grain Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of grains do you eat per day?</small>
                            <select class="form-select" name="grains" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">7. Daily Whole Grain Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of whole grains do you eat per day?</small>
                            <select class="form-select" name="whole_grains" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dairy Section -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">8. Daily Milk Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of milk do you drink per day?</small>
                            <select class="form-select" name="milk" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">9. Daily Low-Fat Milk Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of low-fat milk do you drink per day?</small>
                            <select class="form-select" name="low_fat_milk" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Protein Section -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">10. Daily Bean Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of beans do you eat per day?</small>
                            <select class="form-select" name="beans" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">11. Daily Nuts/Seeds Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of nuts and seeds do you eat per day?</small>
                            <select class="form-select" name="nuts_seeds" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">12. Daily Seafood Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of seafood do you eat per day?</small>
                            <select class="form-select" name="seafood" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Sugar-Sweetened Beverages -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">13. Daily Sugar-Sweetened Beverage Servings</label>
                            <small class="text-muted d-block mb-2">On average, how many servings of sugar-sweetened beverages do you drink per day?</small>
                            <select class="form-select" name="ssb" required>
                                <option value="">Select serving amount</option>
                                <option value="1">&lt;1 serving/day</option>
                                <option value="2">1 serving/day</option>
                                <option value="3">2 servings/day</option>
                                <option value="4">3 servings/day</option>
                                <option value="5">4 servings/day</option>
                                <option value="6">5 servings/day</option>
                                <option value="7">&gt;6 servings/day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Added Sugars -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">14. Added Sugars Consumption</label>
                            <small class="text-muted d-block mb-2">How much added sugar do you typically consume?</small>
                            <select class="form-select" name="added_sugars" required>
                                <option value="">Select consumption level</option>
                                <option value="none">None or very little</option>
                                <option value="some">Some (moderate amount)</option>
                                <option value="a_lot">A lot (high amount)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Saturated Fat -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">15. Saturated Fat Consumption</label>
                            <small class="text-muted d-block mb-2">How much saturated fat do you typically consume?</small>
                            <select class="form-select" name="saturated_fat" required>
                                <option value="">Select consumption level</option>
                                <option value="none">None or very little</option>
                                <option value="some">Some (moderate amount)</option>
                                <option value="a_lot">A lot (high amount)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Water -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">16. Water Consumption</label>
                            <small class="text-muted d-block mb-2">How much water do you typically drink daily?</small>
                            <select class="form-select" name="water" required>
                                <option value="">Select consumption level</option>
                                <option value="none">Less than recommended</option>
                                <option value="some">Adequate amount</option>
                                <option value="a_lot">More than adequate</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                <i class="fas fa-undo me-2"></i>Reset Form
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Nutrition Assessment
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function resetForm() {
    document.getElementById('nutrition-form').reset();
}

// Add form validation feedback
$(document).ready(function() {
    $('#nutrition-form select').on('change', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-valid').addClass('is-invalid');
        }
    });
});
</script>
</form>

<script>
    document.querySelectorAll('input[name="grains"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var grains2Question = document.getElementById('grains2-question');
        grains2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="whole_grains"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var wholeGrains2Question = document.getElementById('whole-grains2-question');
        wholeGrains2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="milk"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var milk2Question = document.getElementById('milk2-question');
        milk2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="low_fat_milk"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var lowFatMilk2Question = document.getElementById('low-fat-milk2-question');
        lowFatMilk2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="seafood"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var seafood2Question = document.getElementById('seafood2-question');
        seafood2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="ssb"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var ssb2Question = document.getElementById('ssb2-question');
        ssb2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

</script>


