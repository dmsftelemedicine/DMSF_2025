{{-- File Upload and View Modals --}}

<!-- File Upload Modal -->
<div class="modal fade" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileUploadModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="fileUploadForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="uploadSection" name="section">
                    <input type="hidden" name="patient_id" value="{{ $patient->id ?? request()->route('patient') ?? '' }}" id="modalPatientId">
                    
                    <div class="mb-3">
                        <label for="uploadFile" class="form-label">Select File</label>
                        <input type="file" class="form-control" id="uploadFile" name="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                        <div class="form-text">Accepted formats: PDF, Images (JPG, PNG), Word documents. Max size: 10MB</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sectionItem" class="form-label">Specific Item (Optional)</label>
                        <input type="text" class="form-control" id="sectionItem" name="section_item" placeholder="e.g., Measles, Blood pressure medication">
                        <div class="form-text">Specify what this file relates to within the section</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="fileDescription" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="fileDescription" name="description" rows="3" placeholder="Brief description of the file content"></textarea>
                    </div>
                    
                    <!-- Upload Progress -->
                    <div id="uploadProgress" style="display: none;">
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <div class="text-center">
                            <small class="text-muted">Uploading...</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="uploadBtn">
                        <i class="fas fa-upload"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- File Viewer Modal -->
<div class="modal fade" id="fileViewerModal" tabindex="-1" aria-labelledby="fileViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileViewerModalLabel">
                    <i class="fas fa-file"></i> <span id="viewFileName">File</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- File Information -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Description:</small>
                        <span id="viewFileDescription">-</span>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Size:</small>
                        <span id="viewFileSize">-</span>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Uploaded:</small>
                        <span id="viewFileDate">-</span>
                    </div>
                </div>
                
                <hr>
                
                <!-- File Content -->
                <div id="fileViewerContent" class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="downloadFileBtn">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.modal-xl {
    max-width: 90%;
}

#fileViewerContent {
    max-height: 70vh;
    overflow: auto;
}

#fileViewerContent img {
    max-width: 100%;
    height: auto;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

#fileViewerContent embed {
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
}

.progress {
    height: 0.5rem;
}

.upload-dropzone {
    border: 2px dashed #dee2e6;
    border-radius: 0.375rem;
    padding: 2rem;
    text-align: center;
    transition: border-color 0.15s ease-in-out;
}

.upload-dropzone.dragover {
    border-color: #7CAD3E;
    background-color: rgba(124, 173, 62, 0.1);
}

.file-preview {
    max-width: 200px;
    max-height: 200px;
    object-fit: contain;
    border-radius: 0.375rem;
}
</style>

<script>
$(document).ready(function() {
    // File upload form submission
    $('#fileUploadForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const section = $('#uploadSection').val();
        let patientId = $('input[name="patient_id"]').val() || $('#modalPatientId').val();
        
        // Fallback: try to get from the comprehensive history form
        if (!patientId) {
            patientId = $('form#comprehensiveHistoryForm input[name="patient_id"]').val();
        }
        
        if (!patientId) {
            alert('Error: Patient ID not found');
            return;
        }
        
        // Show progress
        $('#uploadProgress').show();
        $('#uploadBtn').prop('disabled', true);
        
        $.ajax({
            url: `/patients/${patientId}/comprehensive-history/attachments`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        $('.progress-bar').css('width', percentComplete + '%');
                    }
                });
                return xhr;
            },
            success: function(response) {
                console.log('File upload successful:', response);
                $('#fileUploadModal').modal('hide');
                $('#fileUploadForm')[0].reset();
                $('#uploadProgress').hide();
                $('#uploadBtn').prop('disabled', false);
                $('.progress-bar').css('width', '0%');
                
                // Reload files for the section
                console.log('Reloading files for section:', section);
                refreshSectionFiles(section);
                
                alert('File uploaded successfully!');
            },
            error: function(xhr) {
                $('#uploadProgress').hide();
                $('#uploadBtn').prop('disabled', false);
                $('.progress-bar').css('width', '0%');
                
                let errorMessage = 'Error uploading file';
                if (xhr.responseJSON?.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON?.errors) {
                    const errors = Object.values(xhr.responseJSON.errors).flat();
                    errorMessage = errors.join(', ');
                }
                
                alert(errorMessage);
            }
        });
    });
    
    // File size validation
    $('#uploadFile').on('change', function() {
        const file = this.files[0];
        if (file) {
            const maxSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxSize) {
                alert('File size must be less than 10MB');
                $(this).val('');
                return;
            }
            
            // Show file preview for images
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = `<img src="${e.target.result}" class="file-preview mt-2" alt="Preview">`;
                    $('#uploadFile').parent().find('.file-preview').remove();
                    $('#uploadFile').parent().append(preview);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    
    // Reset form when modal is hidden
    $('#fileUploadModal').on('hidden.bs.modal', function() {
        $('#fileUploadForm')[0].reset();
        $('#uploadProgress').hide();
        $('#uploadBtn').prop('disabled', false);
        $('.progress-bar').css('width', '0%');
        $('.file-preview').remove();
    });
    
    // Download file button
    $('#downloadFileBtn').on('click', function() {
        const fileName = $('#viewFileName').text();
        const fileContent = $('#fileViewerContent').find('img, embed').first();
        
        if (fileContent.length > 0) {
            const src = fileContent.attr('src');
            if (src) {
                const link = document.createElement('a');
                link.href = src;
                link.download = fileName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    });
    
    // Drag and drop functionality
    const dropzone = $('#uploadFile').parent();
    
    dropzone.on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('dragover');
    });
    
    dropzone.on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
    });
    
    dropzone.on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
        
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            $('#uploadFile')[0].files = files;
            $('#uploadFile').trigger('change');
        }
    });
});

// Global function to refresh files after upload (called from this modal)
function refreshSectionFiles(section) {
    // Call the loadSectionFiles function if it exists (defined in file_upload_section.blade.php)
    if (typeof loadSectionFiles === 'function') {
        loadSectionFiles(section);
    } else {
        console.warn('loadSectionFiles function not found, reloading page');
        location.reload();
    }
}
</script>
