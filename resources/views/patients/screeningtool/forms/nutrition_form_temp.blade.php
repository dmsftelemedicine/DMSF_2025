<form id="nutrition-form">
    @csrf
    <div class="mb-3">
    <label class="form-label">1. (Fruits) On average, how many servings of fruit (not including juice) do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="fruit" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">2. (Fruit Juice) On average, how many servings of 100% fruit juice do you drink per day?</label>
	    <div>
	        <label><input type="radio" name="fruit_juice" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit_juice" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit_juice" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit_juice" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit_juice" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit_juice" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit_juice" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="fruit_juice" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">3. (Vegetables) On average, how many servings of vegetables do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="vegetables" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="vegetables" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="vegetables" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="vegetables" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="vegetables" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="vegetables" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="vegetables" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="vegetables" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">4. (Green Vegetables) On average, how many servings of green vegetables do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="green_vegetables" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="green_vegetables" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="green_vegetables" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="green_vegetables" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="green_vegetables" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="green_vegetables" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="green_vegetables" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="green_vegetables" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">5. (Starchy Vegetables) On average, how many servings of starchy vegetables do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="starchy_vegetables" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="starchy_vegetables" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="starchy_vegetables" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="starchy_vegetables" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="starchy_vegetables" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="starchy_vegetables" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="starchy_vegetables" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="starchy_vegetables" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">6. (Grains) On average, how many servings of grains do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="grains" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3" id="grains2-question" style="display: none;">
	    <label class="form-label">7. (Grains 2) On average, how often do you eat grains?</label>
	    <div>
	        <label><input type="radio" name="grains_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains_frequency" value="never"> Never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="grains_frequency" value="N/A" checked> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">8. (Whole Grains) On average, how many servings of whole grains do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="whole_grains" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3" id="whole-grains2-question" style="display: none;">
	    <label class="form-label">9. (Whole Grains 2) On average, how often do you eat whole grains?</label>
	    <div>
	        <label><input type="radio" name="whole_grains_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains_frequency" value="never"> Never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="whole_grains_frequency" value="N/A" checked> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">10. (Milk) On average, how many servings of milk do you eat or drink per day?</label>
	    <div>
	        <label><input type="radio" name="milk" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3" id="milk2-question" style="display: none;">
	    <label class="form-label">11. (Milk 2) On average, how often do you drink or eat milk products?</label>
	    <div>
	        <label><input type="radio" name="milk_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk_frequency" value="never"> Never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="milk_frequency" value="N/A" checked> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">12. (Low-Fat Milk) On average, how many servings of low-fat milk products do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="low_fat_milk" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3" id="low-fat-milk2-question" style="display: none;">
	    <label class="form-label">13. (Low-Fat Milk 2) On average, how often do you drink or eat low-fat milk products?</label>
	    <div>
	        <label><input type="radio" name="low_fat_milk_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk_frequency" value="never"> Never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="low_fat_milk_frequency" value="N/A" checked> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">14. (Beans) On average, how many servings of beans (legumes) do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="beans" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="beans" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="beans" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="beans" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="beans" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="beans" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="beans" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="beans" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">15. (Nuts & Seeds) On average, how many servings of nuts or seeds do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="nuts_seeds" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="nuts_seeds" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="nuts_seeds" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="nuts_seeds" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="nuts_seeds" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="nuts_seeds" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="nuts_seeds" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="nuts_seeds" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">16. (Seafood) On average, how many servings of seafood do you eat per day?</label>
	    <div>
	        <label><input type="radio" name="seafood" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3" id="seafood2-question" style="display: none;">
	    <label class="form-label">17. (Seafood 2) On average, how often do you eat seafood?</label>
	    <div>
	        <label><input type="radio" name="seafood_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood_frequency" value="never"> Never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="seafood_frequency" value="N/A" checked> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">18. (SSB) On average, how many sugar-sweetened beverages do you drink per day?</label>
	    <div>
	        <label><input type="radio" name="ssb" value="7"> &lt;1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb" value="7"> 1</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb" value="7"> 2</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb" value="7"> 3</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb" value="7"> 4</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb" value="7"> 5</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb" value="7"> &gt;6</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3" id="ssb2-question" style="display: none;">
	    <label class="form-label">19. (SSB2) On average, how often do you drink sugar-sweetened beverages?</label>
	    <div>
	        <label><input type="radio" name="ssb_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb_frequency" value="never"> Never</label>&nbsp;&nbsp;
	        <label><input type="radio" name="ssb_frequency" value="N/A" checked> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">20. (Added Sugars) On average, how much added sugar do you consume per day?</label>
	    <div>
	        <label><input type="radio" name="added_sugars" value="none"> None / Almost None</label>&nbsp;&nbsp;
	        <label><input type="radio" name="added_sugars" value="some"> Some</label>&nbsp;&nbsp;
	        <label><input type="radio" name="added_sugars" value="a_lot"> A Lot</label>&nbsp;&nbsp;
	        <label><input type="radio" name="added_sugars" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">21. (Saturated Fat) How many servings of saturated fat do you consume on average per day?</label>
	    <div>
	        <label><input type="radio" name="saturated_fat" value="none"> None / Almost None</label>&nbsp;&nbsp;
	        <label><input type="radio" name="saturated_fat" value="some"> Some</label>&nbsp;&nbsp;
	        <label><input type="radio" name="saturated_fat" value="a_lot"> A Lot</label>&nbsp;&nbsp;
	        <label><input type="radio" name="saturated_fat" value="na"> Choose Not to Answer</label>
	    </div>
	</div>
	<div class="mb-3">
	    <label class="form-label">22. (Water) On average, how much water do you drink per day?</label>
	    <div>
	        <label><input type="radio" name="water" value="none"> None / Almost None</label>&nbsp;&nbsp;
	        <label><input type="radio" name="water" value="some"> Some</label>&nbsp;&nbsp;
	        <label><input type="radio" name="water" value="a_lot"> A Lot</label>&nbsp;&nbsp;
	        <label><input type="radio" name="water" value="na"> Choose Not to Answer</label>
	    </div>
	</div>

	<input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    document.querySelectorAll('input[name="grains"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var grains2Question = document.getElementById('grains2-question');
        grains2Question.style.display = this.value === "0" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="whole_grains"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var wholeGrains2Question = document.getElementById('whole-grains2-question');
        wholeGrains2Question.style.display = this.value === "0" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="milk"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var milk2Question = document.getElementById('milk2-question');
        milk2Question.style.display = this.value === "0" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="low_fat_milk"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var lowFatMilk2Question = document.getElementById('low-fat-milk2-question');
        lowFatMilk2Question.style.display = this.value === "0" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="seafood"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var seafood2Question = document.getElementById('seafood2-question');
        seafood2Question.style.display = this.value === "0" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="ssb"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var ssb2Question = document.getElementById('ssb2-question');
        ssb2Question.style.display = this.value === "0" ? "block" : "none";
    });
});

</script>


