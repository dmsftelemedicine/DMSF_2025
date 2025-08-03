{{-- File Upload Section Component --}}
{{-- Usage: @include('patients.comprehensive_history.components.file_upload_section', ['section' => 'childhood_illness', 'title' => 'Childhood Illness Files']) --}}

@php
    $sectionId = $section ?? 'default';
    $title = $title ?? 'Files';
    // Try multiple ways to get patient ID for better reliability
    $patientId = null;
    if (isset($patient) && is_object($patient) && isset($patient->id)) {
        $patientId = $patient->id;
    } elseif (request()->route('patient')) {
        $patientId = request()->route('patient');
    } elseif (request()->get('patient_id')) {
        $patientId = request()->get('patient_id');
    }
@endphp

<div class="file-upload-section mt-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="mb-0">{{ $title }}</h6>
        <button type="button" class="btn btn-outline-primary btn-sm" onclick="openUploadModal('{{ $sectionId }}')">
            <i class="fas fa-upload"></i> Upload File
        </button>
    </div>
    
    {{-- Files List --}}
    <div id="files-list-{{ $sectionId }}" class="files-list">
        <div class="text-muted small" id="no-files-{{ $sectionId }}">No files uploaded yet.</div>
    </div>
</div>

<style>
.file-upload-section {
    background-color: #f8f9fa;
    border-radius: 0.375rem;
    padding: 1rem;
    border: 1px solid #dee2e6;
}

.file-item {
    display: flex;
    justify-content: between;
    align-items: center;
    padding: 0.5rem;
    background: white;
    border-radius: 0.25rem;
    margin-bottom: 0.5rem;
    border: 1px solid #e9ecef;
}

.file-item:hover {
    background-color: #f8f9fa;
}

.file-info {
    flex-grow: 1;
}

.file-name {
    font-weight: 500;
    color: #495057;
}

.file-meta {
    font-size: 0.875rem;
    color: #6c757d;
}

.file-actions {
    display: flex;
    gap: 0.25rem;
}

.btn-file-action {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>

<script>
$(document).ready(function() {
    // Load existing files for this section
    loadSectionFiles('{{ $sectionId }}');
});

function loadSectionFiles(section) {
    let patientId = '{{ $patientId ?? "" }}';
    
    // Fallback: try to get from the comprehensive history form if Blade variable is empty
    if (!patientId || patientId === '') {
        patientId = $('form#comprehensiveHistoryForm input[name="patient_id"]').val();
    }
    
    // Another fallback: try to get from URL
    if (!patientId || patientId === '') {
        const urlParts = window.location.pathname.split('/');
        const patientIndex = urlParts.indexOf('patients');
        if (patientIndex !== -1 && urlParts[patientIndex + 1]) {
            patientId = urlParts[patientIndex + 1];
        }
    }
    
    console.log('Loading files for section:', section, 'Patient ID:', patientId);
    
    if (!patientId) {
        console.error('Patient ID not found for loading files');
        return;
    }
    
    $.ajax({
        url: `/patients/${patientId}/comprehensive-history/attachments`,
        method: 'GET',
        data: { section: section },
        success: function(response) {
            console.log('Files loaded for section', section, ':', response);
            displayFiles(section, response.files || []);
        },
        error: function(xhr) {
            console.error('Error loading files for section', section, ':', xhr);
            console.error('Response:', xhr.responseText);
        }
    });
}

function displayFiles(section, files) {
    const container = $(`#files-list-${section}`);
    const noFilesMsg = $(`#no-files-${section}`);
    
    console.log('Displaying files for section', section, ':', files);
    
    if (files.length === 0) {
        noFilesMsg.show();
        container.find('.file-item').remove(); // Remove any existing file items
        return;
    }
    
    noFilesMsg.hide();
    
    let html = '';
    files.forEach(file => {
        html += `
            <div class="file-item" data-file-id="${file.id}">
                <div class="file-info">
                    <div class="file-name">${file.file_name}</div>
                    <div class="file-meta">
                        ${formatFileSize(file.file_size)} • ${formatDate(file.created_at)}
                        ${file.description ? `• ${file.description}` : ''}
                    </div>
                </div>
                <div class="file-actions">
                    <button type="button" class="btn btn-outline-primary btn-file-action" onclick="viewFile(${file.id})">
                        <i class="fas fa-eye"></i> View
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-file-action" onclick="deleteFile(${file.id}, '${section}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    // Replace existing content instead of appending
    container.find('.file-item').remove();
    container.append(html);
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString();
}

function openUploadModal(section) {
    $('#uploadSection').val(section);
    $('#fileUploadModal').modal('show');
}

function viewFile(fileId) {
    let patientId = '{{ $patientId ?? "" }}';
    
    // Fallback: try to get from URL if Blade variable is empty
    if (!patientId || patientId === '') {
        const urlParts = window.location.pathname.split('/');
        const patientIndex = urlParts.indexOf('patients');
        if (patientIndex !== -1 && urlParts[patientIndex + 1]) {
            patientId = urlParts[patientIndex + 1];
        }
    }
    
    $.ajax({
        url: `/patients/${patientId}/comprehensive-history/attachments/${fileId}`,
        method: 'GET',
        success: function(response) {
            showFileViewer(response.file);
        },
        error: function(xhr) {
            alert('Error loading file: ' + (xhr.responseJSON?.message || 'Unknown error'));
        }
    });
}

function showFileViewer(file) {
    $('#viewFileName').text(file.file_name);
    $('#viewFileDescription').text(file.description || 'No description');
    $('#viewFileSize').text(formatFileSize(file.file_size));
    $('#viewFileDate').text(formatDate(file.created_at));
    
    const fileContent = $('#fileViewerContent');
    
    if (file.file_type.startsWith('image/')) {
        fileContent.html(`<img src="/storage/${file.file_path}" class="img-fluid" alt="${file.file_name}">`);
    } else if (file.file_type === 'application/pdf') {
        fileContent.html(`<embed src="/storage/${file.file_path}" type="application/pdf" width="100%" height="500px">`);
    } else {
        fileContent.html(`
            <div class="text-center p-4">
                <i class="fas fa-file fa-3x text-muted mb-3"></i>
                <p>Preview not available for this file type.</p>
                <a href="/storage/${file.file_path}" class="btn btn-primary" download="${file.file_name}">
                    <i class="fas fa-download"></i> Download File
                </a>
            </div>
        `);
    }
    
    $('#fileViewerModal').modal('show');
}

function deleteFile(fileId, section) {
    if (!confirm('Are you sure you want to delete this file?')) return;
    
    let patientId = '{{ $patientId ?? "" }}';
    
    // Fallback: try to get from URL if Blade variable is empty
    if (!patientId || patientId === '') {
        const urlParts = window.location.pathname.split('/');
        const patientIndex = urlParts.indexOf('patients');
        if (patientIndex !== -1 && urlParts[patientIndex + 1]) {
            patientId = urlParts[patientIndex + 1];
        }
    }
    
    $.ajax({
        url: `/patients/${patientId}/comprehensive-history/attachments/${fileId}`,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            loadSectionFiles(section); // Reload files
            alert('File deleted successfully');
        },
        error: function(xhr) {
            alert('Error deleting file: ' + (xhr.responseJSON?.message || 'Unknown error'));
        }
    });
}
</script>
