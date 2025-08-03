<!-- Upload File Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadForm" method="POST" action="{{ route('comprehensive-history-attachments.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="patient_id" id="modalPatientId">
                    <input type="hidden" name="comprehensive_history_id" id="modalComprehensiveHistoryId">
                    <input type="hidden" name="section" id="modalSection">
                    
                    <div class="mb-3">
                        <label for="modalSectionDisplay" class="form-label">Section</label>
                        <input type="text" class="form-control" id="modalSectionDisplay" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="section_item" class="form-label">Specific Item (Optional)</label>
                        <input type="text" class="form-control" name="section_item" id="section_item" 
                               placeholder="e.g., Diabetes, Surgery type, etc.">
                        <div class="form-text">Specify the particular illness, medication, or condition this file relates to.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="file" id="file" required
                               accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx">
                        <div class="form-text">
                            Accepted formats: JPG, PNG, GIF, PDF, DOC, DOCX, XLS, XLSX (Max: 10MB)
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" name="description" id="description" rows="3"
                                  placeholder="Add any additional notes about this file..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload File</button>
                </div>
            </form>
        </div>
    </div>
</div>
