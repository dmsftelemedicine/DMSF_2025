@php
    $canEdit = auth()->check() &&
        (auth()->user()->role === 'bhw_s3' ||
         auth()->user()->role === 'doctor' ||
         auth()->user()->role === 'admin');
@endphp


@if($canEdit)
    <x-app-layout>
        <div class="container py-4">
            <!-- Form Container with Border and Shadow -->
            <div class="card shadow-lg p-4 border rounded-lg">
                    <form id="patient-form" action="{{ route('patients.update', $patient->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Hidden input for image path -->
                        <input type="hidden" name="image_path" id="image_path" value="{{ old('image_path', $patient->image_path) }}">

                        <legend>Patient Identifying Record</legend>
                        <hr>

                        <!-- First Row: Personal Information -->
                        <div class="row mb-4 mt-4">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="reference_number">Reference Number</label>
                                <div class="d-flex gap-2">
                                    <!-- Reference Number (numeric part) - Read-only -->
                                    <input type="text" class="form-control rounded-lg @error('reference_number') is-invalid @enderror"
                                        name="reference_number" id="reference_number"
                                        value="{{ old('reference_number', $numericPart) }}" maxlength="5" placeholder="00001" readonly>

                                    <!-- Reference Number Suffix (alphabetic part) - Read-only -->
                                    <input type="text" class="form-control rounded-lg @error('reference_number_suffix') is-invalid @enderror"
                                        name="reference_number_suffix" id="reference_number_suffix"
                                        value="{{ old('reference_number_suffix', $suffixPart) }}" maxlength="3" placeholder="ABC" readonly>
                                </div>
                                @error('reference_number')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                                @error('reference_number_suffix')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control rounded-lg @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name', $patient->last_name) }}" required>
                                    @error('last_name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control rounded-lg @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name', $patient->first_name) }}" required>
                                    @error('first_name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" class="form-control rounded-lg @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" value="{{ old('middle_name', $patient->middle_name) }}">
                                    @error('middle_name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Image Preview Section -->
                        <div class="row mb-4">
                            <div class="col-md-12 text-center">
                                <div id="image-preview-section" class="{{ $patient->image_path ? '' : 'd-none' }}">
                                    <label class="form-label">Current Patient Photo</label>
                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <img id="form-image-preview" src="{{ asset($patient->image_path) }}" alt="Patient Photo" 
                                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 3px solid #7CAD3E;">
                                        <div class="d-flex flex-column gap-2">
                                            <button type="button" id="remove-image-btn" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash"></i> Remove Image
                                            </button>
                                            @if($patient->image_path)
                                            <button type="button" id="restore-image-btn" class="btn btn-outline-secondary btn-sm" style="display: none;">
                                                <i class="fas fa-undo"></i> Restore Original
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="birth_date">Birthdate</label>
                                    <input type="date" class="form-control rounded-lg @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date', $patient->birth_date) }}" required>
                                    @error('birth_date')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control rounded-lg" id="age" value="{{ $patient->age }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sex</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender', $patient->gender) == 'Male' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender', $patient->gender) == 'Female' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    @error('gender')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <legend>Address</legend>
                        <hr>

                        <!-- Address Fields -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="street">Street Address</label>
                                    <input type="text" class="form-control rounded-lg @error('street') is-invalid @enderror" name="street" id="street" value="{{ old('street', $patient->street) }}" required>
                                    @error('street')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brgy_address">Brgy Address</label>
                                    <select class="form-control rounded-lg @error('brgy_address') is-invalid @enderror" name="brgy_address" id="brgy_address" required>
                                        <option value="">Select Barangay</option>
                                        <option value="Sitio Balite, Brgy Marilog, Davao City" {{ old('brgy_address', $patient->brgy_address) == 'Sitio Balite, Brgy Marilog, Davao City' ? 'selected' : '' }}>Sitio Balite, Brgy Marilog, Davao City</option>
                                        <option value="Brgy Cogon, Babak District, IGACOS" {{ old('brgy_address', $patient->brgy_address) == 'Brgy Cogon, Babak District, IGACOS' ? 'selected' : '' }}>Brgy Cogon, Babak District, IGACOS</option>
                                        <option value="other" {{ old('brgy_address', $patient->brgy_address) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('brgy_address')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                    <input type="text" class="form-control rounded-lg mt-2" name="brgy_address_other" id="brgy_address_other" placeholder="If Other, specify" style="display:none;">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_landmark">Address Landmark</label>
                                    <input type="text" class="form-control rounded-lg @error('address_landmark') is-invalid @enderror" name="address_landmark" id="address_landmark" value="{{ old('address_landmark', $patient->address_landmark) }}">
                                    @error('address_landmark')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control rounded-lg @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation', $patient->occupation) }}">
                                    @error('occupation')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <legend>Other Information</legend>
                        <hr>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="highest_educational_attainment">Highest Educational Attainment</label>
                                    <select class="form-control rounded-lg @error('highest_educational_attainment') is-invalid @enderror" name="highest_educational_attainment" id="highest_educational_attainment" required>
                                        <option value="">Select</option>
                                        <option value="No formal education" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'No formal education' ? 'selected' : '' }}>No formal education</option>
                                        <option value="Elementary level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Elementary level' ? 'selected' : '' }}>Elementary level</option>
                                        <option value="Elementary graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Elementary graduate' ? 'selected' : '' }}>Elementary graduate</option>
                                        <option value="Junior HS level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Junior HS level' ? 'selected' : '' }}>Junior HS level</option>
                                        <option value="Junior HS graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Junior HS graduate' ? 'selected' : '' }}>Junior HS graduate</option>
                                        <option value="Senior HS level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Senior HS level' ? 'selected' : '' }}>Senior HS level</option>
                                        <option value="Senior HS graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Senior HS graduate' ? 'selected' : '' }}>Senior HS graduate</option>
                                        <option value="Vocational course" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Vocational course' ? 'selected' : '' }}>Vocational course</option>
                                        <option value="College level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'College level' ? 'selected' : '' }}>College level</option>
                                        <option value="College graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'College graduate' ? 'selected' : '' }}>College graduate</option>
                                        <option value="Doctoral level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Doctoral level' ? 'selected' : '' }}>Doctoral level</option>
                                        <option value="Postdoctoral level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Postdoctoral level' ? 'selected' : '' }}>Postdoctoral level</option>
                                        <option value="Postdoctoral graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Postdoctoral graduate' ? 'selected' : '' }}>Postdoctoral graduate</option>
                                    </select>
                                    @error('highest_educational_attainment')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <select class="form-control rounded-lg @error('marital_status') is-invalid @enderror" name="marital_status" id="marital_status" required>
                                        <option value="">Select</option>
                                        <option value="Married" {{ old('marital_status', $patient->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Live-in" {{ old('marital_status', $patient->marital_status) == 'Live-in' ? 'selected' : '' }}>Live-in</option>
                                        <option value="Separated" {{ old('marital_status', $patient->marital_status) == 'Separated' ? 'selected' : '' }}>Separated</option>
                                        <option value="Single" {{ old('marital_status', $patient->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Widowed" {{ old('marital_status', $patient->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                    @error('marital_status')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monthly_household_income">Monthly Household Income (Php)</label>
                                    <select class="form-control rounded-lg @error('monthly_household_income') is-invalid @enderror" name="monthly_household_income" id="monthly_household_income" required>
                                        <option value="">Select</option>
                                        <option value="<10,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '<10,000' ? 'selected' : '' }}>&lt;10,000</option>
                                        <option value="10,000-20,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '10,000-20,000' ? 'selected' : '' }}>10,000-20,000</option>
                                        <option value="20,000-40,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '20,000-40,000' ? 'selected' : '' }}>20,000-40,000</option>
                                        <option value="40,000-70,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '40,000-70,000' ? 'selected' : '' }}>40,000-70,000</option>
                                        <option value="70,000-100,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '70,000-100,000' ? 'selected' : '' }}>70,000-100,000</option>
                                        <option value=">100,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '>100,000' ? 'selected' : '' }}>>&nbsp;100,000</option>
                                    </select>
                                    @error('monthly_household_income')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select class="form-control rounded-lg @error('religion') is-invalid @enderror" name="religion" id="religion" required>
                                        <option value="">Select</option>
                                        <option value="Christian" {{ old('religion', $patient->religion) == 'Christian' ? 'selected' : '' }}>Christian</option>
                                        <option value="Muslim" {{ old('religion', $patient->religion) == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                        <option value="Other" {{ old('religion', $patient->religion) == 'Other' ? 'selected' : '' }}>Other</option>
                                        <option value="None" {{ old('religion', $patient->religion) == 'None' ? 'selected' : '' }}>None</option>
                                    </select>
                                    @error('religion')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="button" id="cancel-form-btn" onclick="window.location.href='{{ route('patients.show', $patient->id) }}'" class="bg-blue-500 hover:bg-red-500 text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">Cancel</button>
                            <button type="button" id="capture-image-btn" class="bg-[#1A5D77] hover:bg-[#7CAD3E] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300 me-2">
                                <i class="fas fa-camera"></i> {{ $patient->image_path ? 'Change Photo' : 'Capture Photo' }}
                            </button>
                            <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">Update Patient</button>
                        </div>
                    </form>
                </div>
            </div>

        <!-- Camera Modal -->
        <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cameraModalLabel">Capture Patient Photo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <div id="camera-container" class="mb-3">
                                <video id="camera-preview" autoplay playsinline style="width: 100%; max-width: 500px; height: auto; border-radius: 8px;"></video>
                                <div id="camera-controls" class="mt-3">
                                    <button type="button" id="start-camera-btn" class="btn btn-primary">
                                        <i class="fas fa-camera"></i> Start Camera
                                    </button>
                                </div>
                            </div>
                            
                            <div id="captured-image-container" class="mb-3" style="display: none;">
                                <img id="captured-image" style="width: 100%; max-width: 500px; height: auto; border-radius: 8px;">
                                <div class="mt-3">
                                    <button type="button" id="retake-btn" class="btn btn-secondary me-2">
                                        <i class="fas fa-redo"></i> Retake
                                    </button>
                                    <button type="button" id="save-image-btn" class="btn btn-success">
                                        <i class="fas fa-save"></i> Save Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                            <h5 class="mt-3">Are you sure you want to delete this image?</h5>
                            <p class="text-muted">This action cannot be undone.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirm-delete-btn" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Image
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Container -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="successToastBody">
                    Photo uploaded successfully!
                </div>
            </div>
            
            <div id="deleteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger text-white">
                    <i class="fas fa-trash me-2"></i>
                    <strong class="me-auto">Deleted</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Photo deleted successfully!
                </div>
            </div>
        </div>

            <style>
                .btn-updt {
                    background-color: #7CAD3E; /* Green */
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 50px;
                    font-size: 16px;
                }
                .btn-updt:hover {
                    background-color: #1A5D77; /* Darker blue on hover */
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                /* Camera Modal Styles */
                .modal-content {
                    border-radius: 15px;
                }
                
                .modal-header {
                    background-color: #f8f9fa;
                    border-bottom: 1px solid #dee2e6;
                }
                
                #camera-preview, #captured-image {
                    border: 2px solid #dee2e6;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    margin: 0 auto;
                    display: block;
                }
                
                .btn-group {
                    display: flex;
                    gap: 10px;
                    justify-content: center;
                }
                
                .btn {
                    border-radius: 25px;
                    padding: 8px 20px;
                    font-weight: 500;
                }
                
                .btn-primary {
                    background-color: #007bff;
                    border-color: #007bff;
                }
                
                .btn-success {
                    background-color: #28a745;
                    border-color: #28a745;
                }
                
                .btn-secondary {
                    background-color: #6c757d;
                    border-color: #6c757d;
                }

                /* Image Preview Styles */
                .patient-photo {
                    transition: transform 0.2s ease-in-out;
                }
                
                .patient-photo:hover {
                    transform: scale(1.1);
                }
                
                .no-photo-placeholder {
                    background-color: #f8f9fa;
                    border: 2px dashed #dee2e6;
                    color: #6c757d;
                    transition: all 0.2s ease-in-out;
                }
                
                .no-photo-placeholder:hover {
                    background-color: #e9ecef;
                    border-color: #adb5bd;
                }
            </style>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                // Store original image data for restoration
                const originalImagePath = '{{ $patient->image_path ?? '' }}';
                let isImageMarkedForDeletion = false;
                let capturedImageData = null;
                let stream = null;

                // Toast notification function
                function showToast(toastId, message) {
                    const toastElement = document.getElementById(toastId);
                    if (message && toastId === 'successToast') {
                        document.getElementById('successToastBody').textContent = message;
                    }
                    const toast = new bootstrap.Toast(toastElement, {
                        autohide: true,
                        delay: 3000
                    });
                    toast.show();
                }

                // Auto-calculate age from birthdate
                document.getElementById('birth_date').addEventListener('change', function() {
                    const birthDate = new Date(this.value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    document.getElementById('age').value = isNaN(age) ? '' : age;
                });
                
                // Show/hide other barangay field
                document.getElementById('brgy_address').addEventListener('change', function() {
                    document.getElementById('brgy_address_other').style.display = this.value === 'other' ? 'block' : 'none';
                });

                // Camera functionality

                // Capture image button click
                document.getElementById('capture-image-btn').addEventListener('click', function() {
                    const modal = new bootstrap.Modal(document.getElementById('cameraModal'));
                    modal.show();
                });

                // Reset camera modal state when shown
                document.getElementById('cameraModal').addEventListener('shown.bs.modal', function() {
                    // Reset camera controls and captured image container
                    document.getElementById('camera-container').style.display = 'block';
                    document.getElementById('captured-image-container').style.display = 'none';
                    
                    // Reset camera controls
                    const cameraControls = document.getElementById('camera-controls');
                    cameraControls.innerHTML = `
                        <button type="button" id="start-camera-btn" class="btn btn-primary">
                            <i class="fas fa-camera"></i> Start Camera
                        </button>
                    `;
                    
                    // Reset captured image data
                    capturedImageData = null;
                    
                    // Re-attach start camera event listener
                    document.getElementById('start-camera-btn').addEventListener('click', startCameraHandler);
                });

                // Start camera handler function
                async function startCameraHandler() {
                    try {
                        stream = await navigator.mediaDevices.getUserMedia({ 
                            video: { 
                                width: { ideal: 1280 },
                                height: { ideal: 720 },
                                facingMode: 'user'
                            } 
                        });
                        
                        const video = document.getElementById('camera-preview');
                        video.srcObject = stream;
                        
                        // Show camera controls
                        document.getElementById('camera-controls').innerHTML = `
                            <button type="button" id="capture-btn" class="btn btn-warning">
                                <i class="fas fa-camera"></i> Capture Photo
                            </button>
                        `;
                        
                        // Add capture button event listener
                        document.getElementById('capture-btn').addEventListener('click', capturePhoto);
                        
                    } catch (error) {
                        console.error('Error accessing camera:', error);
                        let errorMessage = 'Unable to access camera.';
                        
                        if (error.name === 'NotAllowedError') {
                            errorMessage = 'Camera access denied. Please allow camera access and try again.';
                        } else if (error.name === 'NotFoundError') {
                            errorMessage = 'No camera found on this device.';
                        } else if (error.name === 'NotSupportedError') {
                            errorMessage = 'Camera not supported on this device.';
                        }
                        
                        alert(errorMessage);
                    }
                }

                // Initial start camera button event listener
                document.getElementById('start-camera-btn').addEventListener('click', startCameraHandler);

                // Capture photo
                function capturePhoto() {
                    const video = document.getElementById('camera-preview');
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    
                    console.log('Capturing photo - video dimensions:', video.videoWidth, 'x', video.videoHeight);
                    
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    capturedImageData = canvas.toDataURL('image/jpeg', 0.8);
                    console.log('Captured image data length:', capturedImageData.length);
                    console.log('Image data starts with:', capturedImageData.substring(0, 50));
                    
                    // Stop camera stream
                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                        stream = null;
                    }
                    
                    // Show captured image
                    document.getElementById('captured-image').src = capturedImageData;
                    document.getElementById('camera-container').style.display = 'none';
                    document.getElementById('captured-image-container').style.display = 'block';
                }

                // Retake button click
                document.getElementById('retake-btn').addEventListener('click', function() {
                    document.getElementById('captured-image-container').style.display = 'none';
                    document.getElementById('camera-container').style.display = 'block';
                    document.getElementById('camera-controls').innerHTML = `
                        <button type="button" id="start-camera-btn" class="btn btn-primary">
                            <i class="fas fa-camera"></i> Start Camera
                        </button>
                    `;
                    
                    // Re-add start camera event listener
                    document.getElementById('start-camera-btn').addEventListener('click', async function() {
                        try {
                            stream = await navigator.mediaDevices.getUserMedia({ 
                                video: { 
                                    width: { ideal: 1280 },
                                    height: { ideal: 720 },
                                    facingMode: 'user'
                                } 
                            });
                            
                            const video = document.getElementById('camera-preview');
                            video.srcObject = stream;
                            
                            // Show camera controls
                            document.getElementById('camera-controls').innerHTML = `
                                <button type="button" id="capture-btn" class="btn btn-warning">
                                    <i class="fas fa-camera"></i> Capture Photo
                                </button>
                            `;
                            
                            // Add capture button event listener
                            document.getElementById('capture-btn').addEventListener('click', capturePhoto);
                            
                        } catch (error) {
                            console.error('Error accessing camera:', error);
                            let errorMessage = 'Unable to access camera.';
                            
                            if (error.name === 'NotAllowedError') {
                                errorMessage = 'Camera access denied. Please allow camera access and try again.';
                            } else if (error.name === 'NotFoundError') {
                                errorMessage = 'No camera found on this device.';
                            } else if (error.name === 'NotSupportedError') {
                                errorMessage = 'Camera not supported on this device.';
                            }
                            
                            alert(errorMessage);
                        }
                    });
                    
                    capturedImageData = null;
                });

                // Save image button click
                document.getElementById('save-image-btn').addEventListener('click', function() {
                    console.log('Save image clicked, capturedImageData exists:', !!capturedImageData);
                    console.log('capturedImageData length:', capturedImageData ? capturedImageData.length : 0);
                    
                    if (capturedImageData) {
                        console.log('Processing captured image data...');
                        
                        // Update form preview
                        const previewImg = document.getElementById('form-image-preview');
                        previewImg.src = capturedImageData;
                        
                        // Show image preview section and reset deletion state
                        document.getElementById('image-preview-section').classList.remove('d-none');
                        isImageMarkedForDeletion = false;
                        
                        // Update capture button text and style
                        const captureBtn = document.getElementById('capture-image-btn');
                        captureBtn.innerHTML = '<i class="fas fa-camera"></i> Change Photo';
                        captureBtn.classList.remove('bg-[#1A5D77]', 'hover:bg-[#7CAD3E]');
                        captureBtn.classList.add('bg-[#7CAD3E]', 'hover:bg-[#1A5D77]');
                        
                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('cameraModal'));
                        modal.hide();
                        
                        // Also update the hidden input immediately for debugging
                        document.getElementById('image_path').value = capturedImageData;
                        console.log('Updated hidden input field immediately');
                        
                        // Show success toast
                        showToast('successToast', 'Photo captured! Click "Update Patient" to save changes.');
                        
                        console.log('Image processing complete');
                    } else {
                        console.log('No captured image data available');
                    }
                });

                // Remove image button click - show confirmation modal
                document.getElementById('remove-image-btn').addEventListener('click', function() {
                    console.log('Remove image button clicked - showing confirmation modal');
                    console.log('Current state - isImageMarkedForDeletion:', isImageMarkedForDeletion);
                    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                    deleteModal.show();
                });

                // Confirm delete button click
                document.getElementById('confirm-delete-btn').addEventListener('click', function() {
                    console.log('Confirm delete button clicked - marking image for deletion');
                    
                    // Mark image for deletion (visual only until form submission)
                    isImageMarkedForDeletion = true;
                    capturedImageData = null;
                    
                    console.log('State after marking for deletion - isImageMarkedForDeletion:', isImageMarkedForDeletion);
                    
                    // Hide image preview section visually
                    document.getElementById('image-preview-section').classList.add('d-none');
                    
                    // Show restore button if original image exists
                    if (originalImagePath) {
                        const restoreBtn = document.getElementById('restore-image-btn');
                        if (restoreBtn) {
                            restoreBtn.style.display = 'block';
                        }
                    }
                    
                    // Reset capture button
                    const captureBtn = document.getElementById('capture-image-btn');
                    captureBtn.innerHTML = '<i class="fas fa-camera"></i> Capture Photo';
                    captureBtn.classList.remove('bg-[#7CAD3E]', 'hover:bg-[#1A5D77]');
                    captureBtn.classList.add('bg-[#1A5D77]', 'hover:bg-[#7CAD3E]');
                    
                    // Hide confirmation modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
                    deleteModal.hide();
                    
                    // Show delete toast
                    showToast('deleteToast', 'Photo marked for deletion. Click "Update Patient" to save changes.');
                });

                // Restore image button click (if it exists)
                const restoreBtn = document.getElementById('restore-image-btn');
                if (restoreBtn) {
                    restoreBtn.addEventListener('click', function() {
                        restoreImage();
                        this.style.display = 'none';
                        showToast('successToast', 'Original photo restored!');
                    });
                }

                // Handle delete confirmation modal cancellation
                document.getElementById('deleteConfirmModal').addEventListener('hidden.bs.modal', function(e) {
                    console.log('Delete modal closed');
                    console.log('State after modal close - isImageMarkedForDeletion:', isImageMarkedForDeletion);
                    console.log('Image preview section visible:', !document.getElementById('image-preview-section').classList.contains('d-none'));
                });

                // Modal hidden event - cleanup
                document.getElementById('cameraModal').addEventListener('hidden.bs.modal', function() {
                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                        stream = null;
                    }
                    
                    // Reset modal state
                    document.getElementById('captured-image-container').style.display = 'none';
                    document.getElementById('camera-container').style.display = 'block';
                    document.getElementById('camera-controls').innerHTML = `
                        <button type="button" id="start-camera-btn" class="btn btn-primary">
                            <i class="fas fa-camera"></i> Start Camera
                        </button>
                    `;
                    
                    capturedImageData = null;
                });

                // Form submission handler - apply image changes only on form submit
                document.getElementById('patient-form').addEventListener('submit', function(e) {
                    const imagePathInput = document.getElementById('image_path');
                    
                    console.log('Form submission - Debug info:');
                    console.log('isImageMarkedForDeletion:', isImageMarkedForDeletion);
                    console.log('capturedImageData exists:', !!capturedImageData);
                    console.log('capturedImageData length:', capturedImageData ? capturedImageData.length : 0);
                    console.log('originalImagePath:', originalImagePath);
                    console.log('Current input value length:', imagePathInput.value.length);
                    
                    // Simplified logic: if we have captured image data, use it
                    if (capturedImageData) {
                        console.log('Using captured image data');
                        imagePathInput.value = capturedImageData;
                    } else if (isImageMarkedForDeletion) {
                        console.log('Clearing image (marked for deletion)');
                        imagePathInput.value = '';
                    }
                    // Otherwise, keep whatever is already in the input
                    
                    console.log('Final image_path value length:', imagePathInput.value.length);
                });

                // Cancel button function - restore original image state before navigating away
                document.getElementById('cancel-form-btn').addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent immediate navigation
                    
                    console.log('Cancel button clicked - restoring original image state');
                    console.log('Current state - isImageMarkedForDeletion:', isImageMarkedForDeletion);
                    console.log('Has capturedImageData:', !!capturedImageData);
                    
                    // Always restore to original state when cancelling
                    if (isImageMarkedForDeletion || capturedImageData) {
                        // User either deleted image or took new photo - restore original
                        restoreOriginalImage();
                        
                        // Show a toast notification about restoration
                        showToast('successToast', 'Changes cancelled. Original image restored.');
                        
                        // Navigate after a short delay to show the toast
                        setTimeout(function() {
                            window.location.href = '{{ route('patients.show', $patient->id) }}';
                        }, 1500);
                    } else {
                        // No changes made, navigate immediately
                        window.location.href = '{{ route('patients.show', $patient->id) }}';
                    }
                });

                // Function to restore original image state
                function restoreOriginalImage() {
                    console.log('Restoring original image state');
                    
                    // Reset all state variables
                    isImageMarkedForDeletion = false;
                    capturedImageData = null;
                    
                    // Restore image visibility and original image
                    if (originalImagePath) {
                        document.getElementById('image-preview-section').classList.remove('d-none');
                        document.getElementById('form-image-preview').src = '{{ asset($patient->image_path ?? '') }}';
                        
                        // Reset capture button to original state
                        const captureBtn = document.getElementById('capture-image-btn');
                        captureBtn.innerHTML = '<i class="fas fa-camera"></i> {{ $patient->image_path ? 'Change Photo' : 'Capture Photo' }}';
                        captureBtn.classList.remove('bg-[#7CAD3E]', 'hover:bg-[#1A5D77]');
                        captureBtn.classList.add('bg-[#1A5D77]', 'hover:bg-[#7CAD3E]');
                    } else {
                        // No original image, hide preview section
                        document.getElementById('image-preview-section').classList.add('d-none');
                        
                        // Reset capture button
                        const captureBtn = document.getElementById('capture-image-btn');
                        captureBtn.innerHTML = '<i class="fas fa-camera"></i> Capture Photo';
                        captureBtn.classList.remove('bg-[#7CAD3E]', 'hover:bg-[#1A5D77]');
                        captureBtn.classList.add('bg-[#1A5D77]', 'hover:bg-[#7CAD3E]');
                    }
                    
                    // Hide restore button if it was showing
                    const restoreBtn = document.getElementById('restore-image-btn');
                    if (restoreBtn) {
                        restoreBtn.style.display = 'none';
                    }
                    
                    // Reset hidden input to original value
                    document.getElementById('image_path').value = originalImagePath || '';
                    
                    console.log('Original image state restored');
                }

                // Add a function to restore image if user wants to cancel deletion
                function restoreImage() {
                    if (isImageMarkedForDeletion && originalImagePath) {
                        isImageMarkedForDeletion = false;
                        document.getElementById('image-preview-section').classList.remove('d-none');
                        document.getElementById('form-image-preview').src = '{{ asset($patient->image_path ?? '') }}';
                    }
                }
            </script>
    </x-app-layout>
@else
<x-app-layout>
        <div class="container py-4">
            <div class="alert alert-danger">
                You are not authorized to edit patients.
            </div>
        </div>
    </x-app-layout>
@endif
