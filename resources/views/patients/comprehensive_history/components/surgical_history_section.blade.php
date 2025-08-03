<!-- Surgical History Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Surgical History</h5>
    <div class="mb-3">
        <table class="table table-bordered" id="surgicalTable">
            <thead class="table-light">
                <tr>
                    <th>Year</th>
                    <th>Diagnosis</th>
                    <th>Procedure</th>
                    <th>Biopsy Result</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="surgical_year[]"></td>
                    <td><input type="text" class="form-control" name="surgical_diagnosis[]"></td>
                    <td><input type="text" class="form-control" name="surgical_procedure[]"></td>
                    <td><input type="text" class="form-control" name="surgical_biopsy[]"></td>
                    <td><input type="text" class="form-control" name="surgical_notes[]"></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary btn-sm" id="addSurgicalRow">
            <i class="fa-solid fa-plus"></i> Add Row
        </button>
    </div>

    {{-- File Upload Section for Surgical History --}}
    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'surgical_history', 
        'title' => 'Surgical History Supporting Documents',
        'patient' => $patient ?? null
    ])
</div>
