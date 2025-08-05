<!-- Previous Hospitalization Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Previous Hospitalization</h5>
    <div class="mb-3">
        <table class="table table-bordered" id="hospitalizationTable">
            <thead class="table-light">
                <tr>
                    <th>Year</th>
                    <th>Diagnosis</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="hospitalization_year[]"></td>
                    <td><input type="text" class="form-control" name="hospitalization_diagnosis[]"></td>
                    <td><input type="text" class="form-control" name="hospitalization_notes[]"></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary btn-sm" id="addHospitalizationRow">
            <i class="fa-solid fa-plus"></i> Add Row
        </button>
    </div>

    {{-- File Upload Section for Previous Hospitalization --}}
    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'previous_hospitalization', 
        'title' => 'Previous Hospitalization Supporting Documents',
        'patient' => $patient ?? null
    ])
</div>
