<!-- Allergies Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Allergies</h5>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="food_allergies" class="form-label">Food Allergies</label>
            <input type="text" class="form-control" id="food_allergies" name="food_allergies" placeholder="Nuts, shellfish, dairy, etc." value="{{ old('food_allergies', $comprehensiveHistory->food_allergies ?? '') }}">
        </div>
        <div class="col-md-6">
            <label for="drug_allergies" class="form-label">Drug Allergies</label>
            <input type="text" class="form-control" id="drug_allergies" name="drug_allergies" placeholder="Penicillin, aspirin, etc." value="{{ old('drug_allergies', $comprehensiveHistory->drug_allergies ?? '') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="animal_allergies" class="form-label">Animal Allergies</label>
            <input type="text" class="form-control" id="animal_allergies" name="animal_allergies" placeholder="Dogs, cats, etc." value="{{ old('animal_allergies', $comprehensiveHistory->animal_allergies ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="plant_allergies" class="form-label">Plant Allergies</label>
            <input type="text" class="form-control" id="plant_allergies" name="plant_allergies" placeholder="Pollen, specific plants, etc." value="{{ old('plant_allergies', $comprehensiveHistory->plant_allergies ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="substance_allergies" class="form-label">Substance Allergies</label>
            <input type="text" class="form-control" id="substance_allergies" name="substance_allergies" placeholder="Metals, latex, etc." value="{{ old('substance_allergies', $comprehensiveHistory->substance_allergies ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="other_allergies" class="form-label">Other Allergies</label>
            <input type="text" class="form-control" id="other_allergies" name="other_allergies" placeholder="Environmental, contact, etc." value="{{ old('other_allergies', $comprehensiveHistory->other_allergies ?? '') }}">
        </div>
    </div>
</div>
