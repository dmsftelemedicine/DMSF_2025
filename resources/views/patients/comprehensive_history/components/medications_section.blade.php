<!-- Previous and Current Medications Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Previous and Current Medications</h5>
    <div class="mb-3">
        <label for="medications" class="form-label">List All Medications</label>
        <textarea class="form-control" id="medications" name="medications" rows="4"></textarea>
    </div>

    {{-- File Upload Section for Medications --}}
    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'current_medications', 
        'title' => 'Current Medications Supporting Documents',
        'patient' => $patient ?? null
    ])

    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'previous_medications', 
        'title' => 'Previous Medications Supporting Documents',
        'patient' => $patient ?? null
    ])
</div>
