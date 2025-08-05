<!-- Psychiatric Illness Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Psychiatric Illness</h5>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="psychiatric_anxiety" name="psychiatric_illness[]" value="anxiety">
                <label class="form-check-label" for="psychiatric_anxiety">Anxiety</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="psychiatric_depression" name="psychiatric_illness[]" value="depression">
                <label class="form-check-label" for="psychiatric_depression">Depression</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="psychiatric_mood" name="psychiatric_illness[]" value="mood_disorders">
                <label class="form-check-label" for="psychiatric_mood">Mood Disorders</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="psychiatric_hallucinations" name="psychiatric_illness[]" value="hallucinations">
                <label class="form-check-label" for="psychiatric_hallucinations">Hallucinations</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="psychiatric_delusions" name="psychiatric_illness[]" value="delusions">
                <label class="form-check-label" for="psychiatric_delusions">Delusions</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="psychiatric_others" name="psychiatric_illness[]" value="others">
                <label class="form-check-label" for="psychiatric_others">Others</label>
            </div>
            <div class="mt-2">
                <input type="text" class="form-control" id="psychiatric_others_details" name="psychiatric_others_details" placeholder="Other psychiatric conditions">
            </div>
        </div>
    </div>

    {{-- File Upload Section for Psychiatric History --}}
    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'psychiatric_history', 
        'title' => 'Psychiatric History Supporting Documents',
        'patient' => $patient ?? null
    ])
</div>
