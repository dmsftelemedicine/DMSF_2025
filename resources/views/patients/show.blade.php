<x-app-layout>
    <style type="text/css">
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>

    <div class="container mx-auto p-4">
        <div class="card shadow-lg p-4 border-0" style="width: 100%; border-radius: 2rem;">
            <div class="row g-4">
                <!-- Left Section (Profile Image & Basic Info) -->
                <div class="col-md-3 text-left border-end">
                    <a href="{{ route('patients.index') }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </button>
                    </a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit Patient</a>
                    <h5 class="fw-bold mb-1 mt-5 text-center">
                        {{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}
                    </h5>
                    <div class="p-1 text-center">
                        <p class="mb-0">Age: {{ \Carbon\Carbon::parse($patient->birth_date)->age }} years old</p>
                    </div>
                    <div class="p-1 text-center">
                        <p class="mb-0">Sex: {{ $patient->sex }}</p>
                    </div>
                    <div class="p-1 text-center">
                        <p class="mb-0">Status: {{ $patient->marital_status }}</p>
                    </div>
                    <div class="p-1 text-center">
                        <p class="mb-0">Religion: {{ $patient->religion }}</p>
                    </div>
                    <div class="bg-light p-1 rounded border text-center">
                        <p class="mb-0">{{ $patient->reference_number ?? 'Not set' }}</p>
                    </div>
                    
                    <p class="pt-3 text-muted mb-2 text-center">
                        Diagnosis
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#diagnosisModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </p>
                    <p class="text-center">{{ $patient->diagnosis ?? 'Diagnosis not set'}}</p>
                </div>

                <!-- Right Section -->
                <div class="col-md-9" style="border-left: 1px solid black;">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="measurementsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1-content" type="button" role="tab" aria-controls="tab1-content" aria-selected="true">
                                <span class="tab-date">{{ \Carbon\Carbon::parse($tab1Date)->format('M d, Y') }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2-content" type="button" role="tab" aria-controls="tab2-content" aria-selected="false">
                                <span class="tab-date">{{ \Carbon\Carbon::parse($tab2Date)->format('M d, Y') }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3-content" type="button" role="tab" aria-controls="tab3-content" aria-selected="false">
                                <span class="tab-date">{{ \Carbon\Carbon::parse($tab3Date)->format('M d, Y') }}</span>
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="measurementsTabContent">
                        <!-- Tab 1 Content -->
                        <div class="tab-pane fade show active" id="tab1-content" role="tabpanel" aria-labelledby="tab1-tab">
                            <!-- Anthropometric Measurements Section -->
                            <div class="p-2 mb-6">
                                <h5 class="border-bottom pb-2 mb-3">Anthropometric Measurements</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Height (m)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#heightModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="height-tab1">{{ $tab1Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Weight (kg)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#weightModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="weight-tab1">{{ $tab1Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">BMI (kg/m²)</p>
                                        <p class="fw-bold" id="bmi-tab1">{{ $tab1Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Waist Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#waistModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="waist-tab1">{{ $tab1Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Hip Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#hipModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="hip-tab1">{{ $tab1Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Neck Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#neckModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="neck-tab1">{{ $tab1Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div>
                                <h5 class="border-bottom pb-2 mb-3">Vital Signs</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Temperature (°C)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#temperatureModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="temperature-tab1">{{ $tab1Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Heart Rate (BPM)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#heartRateModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="heart-rate-tab1">{{ $tab1Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            O2 Saturation (%)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#o2SaturationModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="o2-saturation-tab1">{{ $tab1Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Respiratory Rate (CPM)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#respiratoryRateModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="respiratory-rate-tab1">{{ $tab1Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Blood Pressure (mmHg)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#bloodPressureModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="blood-pressure-tab1">{{ $tab1Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2 Content (Hidden by default) -->
                        <div class="tab-pane fade" id="tab2-content" role="tabpanel" aria-labelledby="tab2-tab">
                            <!-- Anthropometric Measurements Section -->
                            <div class="p-2 mb-4">
                                <h5 class="border-bottom pb-2 mb-3">Anthropometric Measurements</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Height (m)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#heightModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="height-tab2">{{ $tab2Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Weight (kg)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#weightModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="weight-tab2">{{ $tab2Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">BMI (kg/m²)</p>
                                        <p class="fw-bold" id="bmi-tab2">{{ $tab2Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Waist Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#waistModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="waist-tab2">{{ $tab2Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Hip Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#hipModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="hip-tab2">{{ $tab2Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Neck Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#neckModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="neck-tab2">{{ $tab2Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div>
                                <h5 class="border-bottom pb-2 mb-3">Vital Signs</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Temperature (°C)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#temperatureModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="temperature-tab2">{{ $tab2Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Heart Rate (BPM)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#heartRateModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="heart-rate-tab2">{{ $tab2Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            O2 Saturation (%)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#o2SaturationModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="o2-saturation-tab2">{{ $tab2Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Respiratory Rate (CPM)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#respiratoryRateModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="respiratory-rate-tab2">{{ $tab2Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Blood Pressure (mmHg)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#bloodPressureModal2">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="blood-pressure-tab2">{{ $tab2Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3 Content (Hidden by default) -->
                        <div class="tab-pane fade" id="tab3-content" role="tabpanel" aria-labelledby="tab3-tab">
                            <!-- Anthropometric Measurements Section -->
                            <div class="p-2 mb-4">
                                <h5 class="border-bottom pb-2 mb-3">Anthropometric Measurements</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Height (m)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#heightModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="height-tab3">{{ $tab3Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Weight (kg)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#weightModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="weight-tab3">{{ $tab3Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">BMI (kg/m²)</p>
                                        <p class="fw-bold" id="bmi-tab3">{{ $tab3Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Waist Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#waistModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="waist-tab3">{{ $tab3Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Hip Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#hipModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="hip-tab3">{{ $tab3Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Neck Circumference (cm)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#neckModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="neck-tab3">{{ $tab3Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div>
                                <h5 class="border-bottom pb-2 mb-3">Vital Signs</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Temperature (°C)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#temperatureModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="temperature-tab3">{{ $tab3Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Heart Rate (BPM)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#heartRateModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="heart-rate-tab3">{{ $tab3Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            O2 Saturation (%)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#o2SaturationModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="o2-saturation-tab3">{{ $tab3Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Respiratory Rate (CPM)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#respiratoryRateModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="respiratory-rate-tab3">{{ $tab3Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">
                                            Blood Pressure (mmHg)
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#bloodPressureModal3">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </p>
                                        <p class="fw-bold" id="blood-pressure-tab3">{{ $tab3Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="first-encounter-tab" data-bs-toggle="tab" data-bs-target="#first-encounter-tab-pane" type="button" role="tab" aria-controls="first-encounter-tab-pane" aria-selected="true">First Encounter</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">LD Screening Tools</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="comprehensive-history-tab" data-bs-toggle="tab" data-bs-target="#comprehensive-history-tab-pane" type="button" role="tab" aria-controls="comprehensive-history-tab-pane" aria-selected="false">History</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="review-of-systems-tab" data-bs-toggle="tab" data-bs-target="#review-of-systems-tab-pane" type="button" role="tab" aria-controls="review-of-systems-tab-pane" aria-selected="false">ROS</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="physical-exam-tab" data-bs-toggle="tab" data-bs-target="#physical-exam-tab-pane" type="button" role="tab" aria-controls="physical-exam-tab-pane" aria-selected="false">Physical Exam</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="other-lm-vs-tab" data-bs-toggle="tab" data-bs-target="#other-lm-vs-tab-pane" type="button" role="tab" aria-controls="other-lm-vs-tab-pane" aria-selected="false">Other LM VS</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="assessment-tab" data-bs-toggle="tab" data-bs-target="#assessment-tab-pane" type="button" role="tab" aria-controls="assessment-tab-pane" aria-selected="false">Assessment</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="false">Management</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes-tab-pane" type="button" role="tab" aria-controls="notes-tab-pane" aria-selected="false">Notes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="laboratory-tab" data-bs-toggle="tab" data-bs-target="#laboratory-tab-pane" type="button" role="tab" aria-controls="laboratory-tab-pane" aria-selected="false">Laboratory</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="Prescription-tab" data-bs-toggle="tab" data-bs-target="#Prescription-tab-pane" type="button" role="tab" aria-controls="Prescription-tab-pane" aria-selected="false">Prescription</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="review-of-systems-tab" data-bs-toggle="tab" data-bs-target="#review-of-systems-tab-pane" type="button" role="tab" aria-controls="review-of-systems-tab-pane" aria-selected="false">Review of Systems</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="first-encounter-tab-pane" role="tabpanel" aria-labelledby="first-encounter-tab" tabindex="0">
                <br/>
                @include('patients.first_encounter.first_encounter_screening', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="laboratory-tab-pane" role="tabpanel" aria-labelledby="laboratory-tab" tabindex="0">
                <br/>
                @include('patients.laboratory.laboratory', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <br/>
                @include('patients.screeningtool.screeningtool', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="Prescription-tab-pane" role="tabpanel" aria-labelledby="Prescription-tab" tabindex="0">
                <br/>
                @include('prescriptions.prescription_patient', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="review-of-systems-tab-pane" role="tabpanel" aria-labelledby="review-of-systems-tab" tabindex="0">
                <br/>
                @include('patients.review_of_systems', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="comprehensive-history-tab-pane" role="tabpanel" aria-labelledby="comprehensive-history-tab" tabindex="0">
                <br/>
                @include('patients.comprehensive_history.comprehensive_history', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
        </div>
    </div>

    <!-- TDEE Modal -->
    <div class="modal fade" id="tdeeModal" tabindex="-1" aria-labelledby="tdeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tdeeModalLabel">Calculate TDEE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tdeeForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                        <label class="fw-bold">Activity Level</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="sedentary" required>
                            <label class="form-check-label">Sedentary (Little to no exercise)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="lightly active">
                            <label class="form-check-label">Lightly active (1-3 days/week)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="moderately active">
                            <label class="form-check-label">Moderately active (3-5 days/week)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="very active">
                            <label class="form-check-label">Very active (6-7 days/week)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activity_level" value="extra active">
                            <label class="form-check-label">Extra active (Physical job & sports)</label>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">Save TDEE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     

    <!-- Macronutrient Modal -->
    <div class="modal fade" id="macroModal" tabindex="-1" aria-labelledby="macroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="macroModalLabel">Macronutrient Breakdown</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Goal for Fat Loss = <span id="tdee-value"></span> kcal/day</strong></p>
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Protein <br> (0.8g per kg bodyweight)</th>
                                <th>Fat <br> (15% of total calories)</th>
                                <th>Carbohydrates <br> (Remaining Calories)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>= 0.8g x <span id="weight-kg"></span> kg = <strong><span id="protein-grams"></span> g</strong> <br>
                                    x 4 kcal/g = <strong><span id="protein-calories"></span> kcal</strong>
                                </td>
                                <td>= 0.15 x <span id="tdee-value-fat"></span> = <strong><span id="fat-calories"></span> kcal</strong> <br>
                                    ÷ 9 kcal/g = <strong><span id="fat-grams"></span> g</strong>
                                </td>
                                <td>= <span id="tdee-value-carbs"></span> kcal – (<span id="protein-calories"></span> kcal protein) + (<span id="fat-calories"></span> kcal fat) <br>
                                    = <strong><span id="carbs-calories"></span> kcal</strong> ÷ 4 kcal/g = <strong><span id="carbs-grams"></span> g</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Meal Plan Modal-->
    <div class="modal fade" id="mealPlanModal" tabindex="-1" aria-labelledby="mealPlanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mealPlanLabel">Sample Meal Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Meal Type</th>
                                <th>Protein (g)</th>
                                <th>Fat (g)</th>
                                <th>Carbohydrates (g)</th>
                            </tr>
                        </thead>
                        <tbody id="mealPlanTableBody">
                            <tr>
                                <td colspan="5" class="text-center">No records available.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary open-add-meal-modal"><i class="fa-solid fa-plus"></i> Add Meal Plan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Meal Plan Modal-->
    <div class="modal fade" id="addMealPlanModal" tabindex="-1" aria-labelledby="addMealPlanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMealPlanLabel">Add Meal Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMealPlanForm">
                        @csrf
                        <input type="hidden" id="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" id="mealPlanDate" class="form-control" name="mealPlanDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meal Type</label>
                            <select  id="meal_type" class="form-control" name="meal_type">
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="PM Snacks">PM Snacks</option>
                                <option value="Dinner">Dinner</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Protein (g)</label>
                            <input type="number" id="protein" class="form-control" name="protein" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fat (g)</label>
                            <input type="number" id="fat" class="form-control" name="fat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Carbohydrates (g)</label>
                            <input type="number" id="carbohydrates" class="form-control" name="carbohydrates" required>
                        </div>
                        <button type="submit" id="saveMealPlanBtn" class="btn btn-success">Save Meal Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Diagnosis Modal -->
    <div class="modal fade" id="diagnosisModal" tabindex="-1" aria-labelledby="diagnosisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="diagnosisModalLabel">Edit Diagnosis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="diagnosisForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label">Diagnosis</label>
                            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required>{{ $patient->diagnosis }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Diagnosis</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Height Modal -->
    <div class="modal fade" id="heightModal" tabindex="-1" aria-labelledby="heightModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heightModalLabel">Edit Height</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heightForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="height" class="form-label">Height (meters)</label>
                            <input type="number" step="0.01" class="form-control" id="height" name="height" value="{{ $patient->height }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Height</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Weight Modal -->
    <div class="modal fade" id="weightModal" tabindex="-1" aria-labelledby="weightModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="weightModalLabel">Edit Weight</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="weightForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="weight_kg" class="form-label">Weight (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="weight_kg" name="weight_kg" value="{{ $patient->weight_kg }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Weight</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Waist Circumference Modal -->
    <div class="modal fade" id="waistModal" tabindex="-1" aria-labelledby="waistModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="waistModalLabel">Edit Waist Circumference</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="waistForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="waist_circumference" class="form-label">Waist Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="waist_circumference" name="waist_circumference" value="{{ $patient->waist_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Hip Circumference Modal -->
    <div class="modal fade" id="hipModal" tabindex="-1" aria-labelledby="hipModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hipModalLabel">Edit Hip Circumference</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="hipForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="hip_circumference" class="form-label">Hip Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="hip_circumference" name="hip_circumference" value="{{ $patient->hip_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Neck Circumference Modal -->
    <div class="modal fade" id="neckModal" tabindex="-1" aria-labelledby="neckModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="neckModalLabel">Edit Neck Circumference</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="neckForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="neck_circumference" class="form-label">Neck Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="neck_circumference" name="neck_circumference" value="{{ $patient->neck_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Temperature Modal -->
    <div class="modal fade" id="temperatureModal" tabindex="-1" aria-labelledby="temperatureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="temperatureModalLabel">Edit Temperature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="temperatureForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="temperature" class="form-label">Temperature (°C)</label>
                            <input type="number" step="0.1" class="form-control" id="temperature" name="temperature" value="{{ $patient->temperature }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Heart Rate Modal -->
    <div class="modal fade" id="heartRateModal" tabindex="-1" aria-labelledby="heartRateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heartRateModalLabel">Edit Heart Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heartRateForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="heart_rate" class="form-label">Heart Rate (BPM)</label>
                            <input type="number" class="form-control" id="heart_rate" name="heart_rate" value="{{ $patient->heart_rate }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add O2 Saturation Modal -->
    <div class="modal fade" id="o2SaturationModal" tabindex="-1" aria-labelledby="o2SaturationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="o2SaturationModalLabel">Edit O2 Saturation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="o2SaturationForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="o2_saturation" class="form-label">O2 Saturation (%)</label>
                            <input type="number" class="form-control" id="o2_saturation" name="o2_saturation" value="{{ $patient->o2_saturation }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Respiratory Rate Modal -->
    <div class="modal fade" id="respiratoryRateModal" tabindex="-1" aria-labelledby="respiratoryRateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="respiratoryRateModalLabel">Edit Respiratory Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="respiratoryRateForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="respiratory_rate" class="form-label">Respiratory Rate (bpm)</label>
                            <input type="number" class="form-control" id="respiratory_rate" name="respiratory_rate" value="{{ $patient->respiratory_rate }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Blood Pressure Modal -->
    <div class="modal fade" id="bloodPressureModal" tabindex="-1" aria-labelledby="bloodPressureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloodPressureModalLabel">Edit Blood Pressure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bloodPressureForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="blood_pressure" class="form-label">Blood Pressure (mmHg)</label>
                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" value="{{ $patient->blood_pressure }}" placeholder="e.g., 120/80" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Date Edit Modal -->
    <div class="modal fade" id="dateEditModal" tabindex="-1" aria-labelledby="dateEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateEditModalLabel">Edit Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dateEditForm">
                        <div class="mb-3">
                            <label for="tabDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="tabDate" required>
                        </div>
                        <input type="hidden" id="currentTab">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveDateBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2 MODALS -->
    <!-- Add Height Modal 2 -->
    <div class="modal fade" id="heightModal2" tabindex="-1" aria-labelledby="heightModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heightModalLabel2">Edit Height - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heightForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="height2" class="form-label">Height (meters)</label>
                            <input type="number" step="0.01" class="form-control" id="height2" name="height" value="{{ $patient->height }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Height</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Weight Modal 2 -->
    <div class="modal fade" id="weightModal2" tabindex="-1" aria-labelledby="weightModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="weightModalLabel2">Edit Weight - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="weightForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="weight_kg2" class="form-label">Weight (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="weight_kg2" name="weight_kg" value="{{ $patient->weight_kg }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Weight</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Waist Circumference Modal 2 -->
    <div class="modal fade" id="waistModal2" tabindex="-1" aria-labelledby="waistModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="waistModalLabel2">Edit Waist Circumference - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="waistForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="waist_circumference2" class="form-label">Waist Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="waist_circumference2" name="waist_circumference" value="{{ $patient->waist_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Hip Circumference Modal 2 -->
    <div class="modal fade" id="hipModal2" tabindex="-1" aria-labelledby="hipModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hipModalLabel2">Edit Hip Circumference - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="hipForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="hip_circumference2" class="form-label">Hip Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="hip_circumference2" name="hip_circumference" value="{{ $patient->hip_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Neck Circumference Modal 2 -->
    <div class="modal fade" id="neckModal2" tabindex="-1" aria-labelledby="neckModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="neckModalLabel2">Edit Neck Circumference - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="neckForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="neck_circumference2" class="form-label">Neck Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="neck_circumference2" name="neck_circumference" value="{{ $patient->neck_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Temperature Modal 2 -->
    <div class="modal fade" id="temperatureModal2" tabindex="-1" aria-labelledby="temperatureModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="temperatureModalLabel2">Edit Temperature - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="temperatureForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="temperature2" class="form-label">Temperature (°C)</label>
                            <input type="number" step="0.1" class="form-control" id="temperature2" name="temperature" value="{{ $patient->temperature }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Heart Rate Modal 2 -->
    <div class="modal fade" id="heartRateModal2" tabindex="-1" aria-labelledby="heartRateModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heartRateModalLabel2">Edit Heart Rate - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heartRateForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="heart_rate2" class="form-label">Heart Rate (BPM)</label>
                            <input type="number" class="form-control" id="heart_rate2" name="heart_rate" value="{{ $patient->heart_rate }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add O2 Saturation Modal 2 -->
    <div class="modal fade" id="o2SaturationModal2" tabindex="-1" aria-labelledby="o2SaturationModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="o2SaturationModalLabel2">Edit O2 Saturation - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="o2SaturationForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="o2_saturation2" class="form-label">O2 Saturation (%)</label>
                            <input type="number" class="form-control" id="o2_saturation2" name="o2_saturation" value="{{ $patient->o2_saturation }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Respiratory Rate Modal 2 -->
    <div class="modal fade" id="respiratoryRateModal2" tabindex="-1" aria-labelledby="respiratoryRateModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="respiratoryRateModalLabel2">Edit Respiratory Rate - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="respiratoryRateForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="respiratory_rate2" class="form-label">Respiratory Rate (bpm)</label>
                            <input type="number" class="form-control" id="respiratory_rate2" name="respiratory_rate" value="{{ $patient->respiratory_rate }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Blood Pressure Modal 2 -->
    <div class="modal fade" id="bloodPressureModal2" tabindex="-1" aria-labelledby="bloodPressureModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloodPressureModalLabel2">Edit Blood Pressure - Tab 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bloodPressureForm2">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="blood_pressure2" class="form-label">Blood Pressure (mmHg)</label>
                            <input type="text" class="form-control" id="blood_pressure2" name="blood_pressure" value="{{ $patient->blood_pressure }}" placeholder="e.g., 120/80" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 3 MODALS -->
    <!-- Add Height Modal 3 -->
    <div class="modal fade" id="heightModal3" tabindex="-1" aria-labelledby="heightModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heightModalLabel3">Edit Height - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heightForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="height3" class="form-label">Height (meters)</label>
                            <input type="number" step="0.01" class="form-control" id="height3" name="height" value="{{ $patient->height }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Height</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Weight Modal 3 -->
    <div class="modal fade" id="weightModal3" tabindex="-1" aria-labelledby="weightModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="weightModalLabel3">Edit Weight - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="weightForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="weight_kg3" class="form-label">Weight (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="weight_kg3" name="weight_kg" value="{{ $patient->weight_kg }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Weight</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Waist Circumference Modal 3 -->
    <div class="modal fade" id="waistModal3" tabindex="-1" aria-labelledby="waistModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="waistModalLabel3">Edit Waist Circumference - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="waistForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="waist_circumference3" class="form-label">Waist Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="waist_circumference3" name="waist_circumference" value="{{ $patient->waist_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Hip Circumference Modal 3 -->
    <div class="modal fade" id="hipModal3" tabindex="-1" aria-labelledby="hipModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hipModalLabel3">Edit Hip Circumference - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="hipForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="hip_circumference3" class="form-label">Hip Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="hip_circumference3" name="hip_circumference" value="{{ $patient->hip_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Neck Circumference Modal 3 -->
    <div class="modal fade" id="neckModal3" tabindex="-1" aria-labelledby="neckModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="neckModalLabel3">Edit Neck Circumference - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="neckForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="neck_circumference3" class="form-label">Neck Circumference (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="neck_circumference3" name="neck_circumference" value="{{ $patient->neck_circumference }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Temperature Modal 3 -->
    <div class="modal fade" id="temperatureModal3" tabindex="-1" aria-labelledby="temperatureModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="temperatureModalLabel3">Edit Temperature - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="temperatureForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="temperature3" class="form-label">Temperature (°C)</label>
                            <input type="number" step="0.1" class="form-control" id="temperature3" name="temperature" value="{{ $patient->temperature }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Heart Rate Modal 3 -->
    <div class="modal fade" id="heartRateModal3" tabindex="-1" aria-labelledby="heartRateModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heartRateModalLabel3">Edit Heart Rate - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heartRateForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="heart_rate3" class="form-label">Heart Rate (BPM)</label>
                            <input type="number" class="form-control" id="heart_rate3" name="heart_rate" value="{{ $patient->heart_rate }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add O2 Saturation Modal 3 -->
    <div class="modal fade" id="o2SaturationModal3" tabindex="-1" aria-labelledby="o2SaturationModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="o2SaturationModalLabel3">Edit O2 Saturation - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="o2SaturationForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="o2_saturation3" class="form-label">O2 Saturation (%)</label>
                            <input type="number" class="form-control" id="o2_saturation3" name="o2_saturation" value="{{ $patient->o2_saturation }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Respiratory Rate Modal 3 -->
    <div class="modal fade" id="respiratoryRateModal3" tabindex="-1" aria-labelledby="respiratoryRateModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="respiratoryRateModalLabel3">Edit Respiratory Rate - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="respiratoryRateForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="respiratory_rate3" class="form-label">Respiratory Rate (bpm)</label>
                            <input type="number" class="form-control" id="respiratory_rate3" name="respiratory_rate" value="{{ $patient->respiratory_rate }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Blood Pressure Modal 3 -->
    <div class="modal fade" id="bloodPressureModal3" tabindex="-1" aria-labelledby="bloodPressureModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloodPressureModalLabel3">Edit Blood Pressure - Tab 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bloodPressureForm3">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="blood_pressure3" class="form-label">Blood Pressure (mmHg)</label>
                            <input type="text" class="form-control" id="blood_pressure3" name="blood_pressure" value="{{ $patient->blood_pressure }}" placeholder="e.g., 120/80" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tdeeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('tdee.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#tdeeModal').modal('hide'); // Close modal
                    $('#tdeeValue').text(response.tdee + ' kcal/day'); // Update display
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                }
            });
        });

        $(".open-macro-modal").click(function () {
            let patientId = $(this).data("patient-id"); // Get patient ID from button

            $.ajax({
                url: "/patient/" + patientId + "/macronutrients", // Pass ID in URL
                type: "GET",
                success: function (response) {
                    $("#tdee-value, #tdee-value-fat, #tdee-value-carbs").text(response.tdee);
                    $("#weight-kg").text(response.weight_kg);

                    // Macronutrient values
                    $("#protein-grams").text(response.protein_grams);
                    $("#protein-calories").text(response.protein_calories);
                    $("#fat-grams").text(response.fat_grams);
                    $("#fat-calories").text(response.fat_calories);
                    $("#carbs-grams").text(response.carbs_grams);
                    $("#carbs-calories").text(response.carbs_calories);

                    // Show modal
                    $("#macroModal").modal("show");
                },
                error: function () {
                    alert("Error fetching macronutrient data.");
                }
            });
        });

        // Open meal plan modal
        $(".open-meal-plan-modal").click(function () {
            let patientId = $(this).data("patient-id"); // Get patient ID from button attribute

            $.ajax({
                url: "/get-meal-plans/" + patientId,  // Pass patient_id in the URL
                type: "GET",
                success: function (response) {
                    let tableBody = $("#mealPlanTableBody");
                    tableBody.empty();

                    if (response.length > 0) {
                        response.forEach(meal => {
                            tableBody.append(`
                                <tr>
                                    <td>${meal.date}</td>
                                    <td>${meal.meal_type}</td>
                                    <td>${meal.protein} g</td>
                                    <td>${meal.fat} g</td>
                                    <td>${meal.carbohydrates} g</td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.append('<tr><td colspan="5" class="text-center">No records available.</td></tr>');
                    }

                    $("#mealPlanModal").modal("show"); // Show modal
                },
                error: function () {
                    alert("Error fetching meal plans.");
                }
            });
        });


        // Open add meal modal
        $(".open-add-meal-modal").click(function () {
            $("#mealPlanModal").modal("hide");
            $("#addMealPlanModal").modal("show");
        });

        // Save new meal plan
        $("#saveMealPlanBtn").click(function () {
            let formData = {
                patient_id: $("#patient_id").val(),
                meal_type: $("#meal_type").val(),
                protein: $("#protein").val(),
                fat: $("#fat").val(),
                carbohydrates: $("#carbohydrates").val(),
                date: $("#mealPlanDate").val(),
                _token: $('meta[name="csrf-token"]').attr("content"), // Include CSRF token
            };

            $.ajax({
                url: "/save-meal-plan", // Ensure this matches your web.php route
                type: "POST",
                data: formData,
                success: function (response) {
                    alert("Meal Plan saved successfully!");
                    // $("#mealPlanModal").modal("hide");
                    // location.reload();
                },
                error: function (xhr) {
                    alert("Error saving meal plan: " + xhr.responseText);
                },
            });
        });

        // Diagnosis form submission
        $('#diagnosisForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('patients.update-diagnosis', $patient->id) }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#diagnosisModal').modal('hide');
                    // Update the diagnosis display
                    $('.text-center').last().text(response.diagnosis);
                    alert('Diagnosis updated successfully!');
                    // Refresh the page
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error updating diagnosis: ' + xhr.responseText);
                }
            });
        });

        // Height form submission (Tab-specific)
        $('#heightForm').on('submit', function(e) {
            e.preventDefault();
            
            // Determine which tab is active
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: getCurrentTabDate(tabNumber),
                field_name: 'height',
                field_value: $('#height').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#heightModal').modal('hide');
                    // Update the height display for the current tab
                    $('#height-tab' + tabNumber).text(response.measurement.height + ' m');
                    // Update BMI as well
                    updateBMIForTab(tabNumber, response.measurement.height, response.measurement.weight_kg);
                    alert('Height updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating height: ' + xhr.responseText);
                }
            });
        });

        // Helper function to update BMI
        function updateBMIForTab(tabNumber, height, weight) {
            if (height && weight) {
                const bmi = (weight / (height * height)).toFixed(2);
                $('#bmi-tab' + tabNumber).text(bmi + ' kg/m²');
            }
        }

        // Helper function to get current tab date
        function getCurrentTabDate(tabNumber) {
            const tabDateText = $(`#tab${tabNumber}-tab .tab-date`).text();
            // Convert "Jan 12, 2025" format to "2025-01-12" format
            try {
                return new Date(tabDateText).toISOString().split('T')[0];
            } catch (error) {
                console.warn('Date parsing failed for tab', tabNumber, ':', error);
                // Return today's date as fallback
                return new Date().toISOString().split('T')[0];
            }
        }

        // Weight form submission (Tab-specific)
        $('#weightForm').on('submit', function(e) {
            e.preventDefault();
            
            // Determine which tab is active
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: getCurrentTabDate(tabNumber),
                field_name: 'weight_kg',
                field_value: $('#weight_kg').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#weightModal').modal('hide');
                    // Update the weight display for the current tab
                    $('#weight-tab' + tabNumber).text(response.measurement.weight_kg + ' kg');
                    // Update BMI as well
                    updateBMIForTab(tabNumber, response.measurement.height, response.measurement.weight_kg);
                    alert('Weight updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating weight: ' + xhr.responseText);
                }
            });
        });

        // Waist Circumference form submission (Tab-specific)
        $('#waistForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: getCurrentTabDate(tabNumber),
                field_name: 'waist_circumference',
                field_value: $('#waist_circumference').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#waistModal').modal('hide');
                    $('#waist-tab' + tabNumber).text(response.measurement.waist_circumference + ' cm');
                    alert('Waist circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating waist circumference: ' + xhr.responseText);
                }
            });
        });

        // Hip Circumference form submission (Tab-specific)
        $('#hipForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'hip_circumference',
                field_value: $('#hip_circumference').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#hipModal').modal('hide');
                    $('#hip-tab' + tabNumber).text(response.measurement.hip_circumference + ' cm');
                    alert('Hip circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating hip circumference: ' + xhr.responseText);
                }
            });
        });

        // Neck Circumference form submission (Tab-specific)
        $('#neckForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'neck_circumference',
                field_value: $('#neck_circumference').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#neckModal').modal('hide');
                    $('#neck-tab' + tabNumber).text(response.measurement.neck_circumference + ' cm');
                    alert('Neck circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating neck circumference: ' + xhr.responseText);
                }
            });
        });

        // Temperature form submission (Tab-specific)
        $('#temperatureForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'temperature',
                field_value: $('#temperature').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#temperatureModal').modal('hide');
                    $('#temperature-tab' + tabNumber).text(response.measurement.temperature + ' °C');
                    alert('Temperature updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating temperature: ' + xhr.responseText);
                }
            });
        });

        // Heart Rate form submission (Tab-specific)
        $('#heartRateForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'heart_rate',
                field_value: $('#heart_rate').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#heartRateModal').modal('hide');
                    $('#heart-rate-tab' + tabNumber).text(response.measurement.heart_rate + ' BPM');
                    alert('Heart rate updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating heart rate: ' + xhr.responseText);
                }
            });
        });

        // O2 Saturation form submission (Tab-specific)
        $('#o2SaturationForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'o2_saturation',
                field_value: $('#o2_saturation').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#o2SaturationModal').modal('hide');
                    $('#o2-saturation-tab' + tabNumber).text(response.measurement.o2_saturation + ' %');
                    alert('O2 saturation updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating O2 saturation: ' + xhr.responseText);
                }
            });
        });

        // Respiratory Rate form submission (Tab-specific)
        $('#respiratoryRateForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'respiratory_rate',
                field_value: $('#respiratory_rate').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#respiratoryRateModal').modal('hide');
                    $('#respiratory-rate-tab' + tabNumber).text(response.measurement.respiratory_rate + ' CPM');
                    alert('Respiratory rate updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating respiratory rate: ' + xhr.responseText);
                }
            });
        });

        // Blood Pressure form submission (Tab-specific)
        $('#bloodPressureForm').on('submit', function(e) {
            e.preventDefault();
            
            const activeTabId = $('.nav-link.active[id*="tab"]').attr('id');
            const tabNumber = activeTabId ? activeTabId.replace('tab', '').replace('-tab', '') : '1';
            
            const formData = {
                tab_number: tabNumber,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'blood_pressure',
                field_value: $('#blood_pressure').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#bloodPressureModal').modal('hide');
                    $('#blood-pressure-tab' + tabNumber).text(response.measurement.blood_pressure + ' mmHg');
                    alert('Blood pressure updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating blood pressure: ' + xhr.responseText);
                }
            });
        });

        // Function to format date
        function formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }

        // Double click to edit date
        $('.nav-link').on('dblclick', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const tabNum = $(this).attr('id').replace('tab', '').replace('-tab', '');
            const currentDate = $(this).find('.tab-date').text();
            
            // Convert displayed date to ISO format
            let isoDate;
            try {
                isoDate = new Date(currentDate).toISOString().split('T')[0];
            } catch (error) {
                // Fallback to today's date if parsing fails
                isoDate = new Date().toISOString().split('T')[0];
                console.warn('Date parsing failed, using today:', error);
            }
            
            $('#currentTab').val(tabNum);
            // Store the original date as well
            $('#currentTab').attr('data-original-date', isoDate);
            $('#tabDate').val(isoDate);
            $('#dateEditModal').modal('show');
        });

        // Save date changes
        $('#saveDateBtn').click(function() {
            const tabNum = $('#currentTab').val();
            const oldDate = $('#currentTab').attr('data-original-date');
            const newDate = $('#tabDate').val();
            
            console.log('Date save attempt:', { tabNum, oldDate, newDate });
            
            if (oldDate === newDate) {
                console.log('No date change detected, closing modal');
                $('#dateEditModal').modal('hide');
                return;
            }
            
            const formData = {
                tab_number: tabNum,
                old_date: oldDate,
                new_date: newDate,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            console.log('Sending request with data:', formData);

            $.ajax({
                url: "{{ route('patients.update-measurement-date', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    console.log('Server response:', response);
                    if (response.success) {
                        $(`#tab${tabNum}-tab .tab-date`).text(formatDate(newDate));
                        $('#dateEditModal').modal('hide');
                        alert('Date updated successfully!');
                        // Optionally reload the tab content to show updated data
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error('AJAX error:', xhr);
                    let errorMessage = 'Error updating date';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                    alert(errorMessage);
                }
            });
        });

        // Prevent tab switching when double clicking
        $('.nav-link').on('dblclick', function(e) {
            e.stopPropagation();
        });

        // TAB 2 FORM HANDLERS
        // Height form submission for Tab 2
        $('#heightForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: getCurrentTabDate(2),
                field_name: 'height',
                field_value: $('#height2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#heightModal2').modal('hide');
                    $('#height-tab2').text(response.measurement.height + ' m');
                    updateBMIForTab(2, response.measurement.height, response.measurement.weight_kg);
                    alert('Height updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating height: ' + xhr.responseText);
                }
            });
        });

        // Weight form submission for Tab 2
        $('#weightForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'weight_kg',
                field_value: $('#weight_kg2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#weightModal2').modal('hide');
                    $('#weight-tab2').text(response.measurement.weight_kg + ' kg');
                    updateBMIForTab(2, response.measurement.height, response.measurement.weight_kg);
                    alert('Weight updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating weight: ' + xhr.responseText);
                }
            });
        });

        // Waist Circumference form submission for Tab 2
        $('#waistForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'waist_circumference',
                field_value: $('#waist_circumference2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#waistModal2').modal('hide');
                    $('#waist-tab2').text(response.measurement.waist_circumference + ' cm');
                    alert('Waist circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating waist circumference: ' + xhr.responseText);
                }
            });
        });

        // Hip Circumference form submission for Tab 2
        $('#hipForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'hip_circumference',
                field_value: $('#hip_circumference2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#hipModal2').modal('hide');
                    $('#hip-tab2').text(response.measurement.hip_circumference + ' cm');
                    alert('Hip circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating hip circumference: ' + xhr.responseText);
                }
            });
        });

        // Neck Circumference form submission for Tab 2
        $('#neckForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'neck_circumference',
                field_value: $('#neck_circumference2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#neckModal2').modal('hide');
                    $('#neck-tab2').text(response.measurement.neck_circumference + ' cm');
                    alert('Neck circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating neck circumference: ' + xhr.responseText);
                }
            });
        });

        // Temperature form submission for Tab 2
        $('#temperatureForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'temperature',
                field_value: $('#temperature2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#temperatureModal2').modal('hide');
                    $('#temperature-tab2').text(response.measurement.temperature + ' °C');
                    alert('Temperature updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating temperature: ' + xhr.responseText);
                }
            });
        });

        // Heart Rate form submission for Tab 2
        $('#heartRateForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'heart_rate',
                field_value: $('#heart_rate2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#heartRateModal2').modal('hide');
                    $('#heart-rate-tab2').text(response.measurement.heart_rate + ' BPM');
                    alert('Heart rate updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating heart rate: ' + xhr.responseText);
                }
            });
        });

        // O2 Saturation form submission for Tab 2
        $('#o2SaturationForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'o2_saturation',
                field_value: $('#o2_saturation2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#o2SaturationModal2').modal('hide');
                    $('#o2-saturation-tab2').text(response.measurement.o2_saturation + ' %');
                    alert('O2 saturation updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating O2 saturation: ' + xhr.responseText);
                }
            });
        });

        // Respiratory Rate form submission for Tab 2
        $('#respiratoryRateForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'respiratory_rate',
                field_value: $('#respiratory_rate2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#respiratoryRateModal2').modal('hide');
                    $('#respiratory-rate-tab2').text(response.measurement.respiratory_rate + ' CPM');
                    alert('Respiratory rate updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating respiratory rate: ' + xhr.responseText);
                }
            });
        });

        // Blood Pressure form submission for Tab 2
        $('#bloodPressureForm2').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 2,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'blood_pressure',
                field_value: $('#blood_pressure2').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#bloodPressureModal2').modal('hide');
                    $('#blood-pressure-tab2').text(response.measurement.blood_pressure + ' mmHg');
                    alert('Blood pressure updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating blood pressure: ' + xhr.responseText);
                }
            });
        });

        // TAB 3 FORM HANDLERS
        // Height form submission for Tab 3
        $('#heightForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'height',
                field_value: $('#height3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#heightModal3').modal('hide');
                    $('#height-tab3').text(response.measurement.height + ' m');
                    updateBMIForTab(3, response.measurement.height, response.measurement.weight_kg);
                    alert('Height updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating height: ' + xhr.responseText);
                }
            });
        });

        // Weight form submission for Tab 3
        $('#weightForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'weight_kg',
                field_value: $('#weight_kg3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#weightModal3').modal('hide');
                    $('#weight-tab3').text(response.measurement.weight_kg + ' kg');
                    updateBMIForTab(3, response.measurement.height, response.measurement.weight_kg);
                    alert('Weight updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating weight: ' + xhr.responseText);
                }
            });
        });

        // Waist Circumference form submission for Tab 3
        $('#waistForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'waist_circumference',
                field_value: $('#waist_circumference3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#waistModal3').modal('hide');
                    $('#waist-tab3').text(response.measurement.waist_circumference + ' cm');
                    alert('Waist circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating waist circumference: ' + xhr.responseText);
                }
            });
        });

        // Hip Circumference form submission for Tab 3
        $('#hipForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'hip_circumference',
                field_value: $('#hip_circumference3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#hipModal3').modal('hide');
                    $('#hip-tab3').text(response.measurement.hip_circumference + ' cm');
                    alert('Hip circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating hip circumference: ' + xhr.responseText);
                }
            });
        });

        // Neck Circumference form submission for Tab 3
        $('#neckForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'neck_circumference',
                field_value: $('#neck_circumference3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#neckModal3').modal('hide');
                    $('#neck-tab3').text(response.measurement.neck_circumference + ' cm');
                    alert('Neck circumference updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating neck circumference: ' + xhr.responseText);
                }
            });
        });

        // Temperature form submission for Tab 3
        $('#temperatureForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'temperature',
                field_value: $('#temperature3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#temperatureModal3').modal('hide');
                    $('#temperature-tab3').text(response.measurement.temperature + ' °C');
                    alert('Temperature updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating temperature: ' + xhr.responseText);
                }
            });
        });

        // Heart Rate form submission for Tab 3
        $('#heartRateForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'heart_rate',
                field_value: $('#heart_rate3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#heartRateModal3').modal('hide');
                    $('#heart-rate-tab3').text(response.measurement.heart_rate + ' BPM');
                    alert('Heart rate updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating heart rate: ' + xhr.responseText);
                }
            });
        });

        // O2 Saturation form submission for Tab 3
        $('#o2SaturationForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'o2_saturation',
                field_value: $('#o2_saturation3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#o2SaturationModal3').modal('hide');
                    $('#o2-saturation-tab3').text(response.measurement.o2_saturation + ' %');
                    alert('O2 saturation updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating O2 saturation: ' + xhr.responseText);
                }
            });
        });

        // Respiratory Rate form submission for Tab 3
        $('#respiratoryRateForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'respiratory_rate',
                field_value: $('#respiratory_rate3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#respiratoryRateModal3').modal('hide');
                    $('#respiratory-rate-tab3').text(response.measurement.respiratory_rate + ' CPM');
                    alert('Respiratory rate updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating respiratory rate: ' + xhr.responseText);
                }
            });
        });

        // Blood Pressure form submission for Tab 3
        $('#bloodPressureForm3').on('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                tab_number: 3,
                measurement_date: '{{ $measurementDate }}',
                field_name: 'blood_pressure',
                field_value: $('#blood_pressure3').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#bloodPressureModal3').modal('hide');
                    $('#blood-pressure-tab3').text(response.measurement.blood_pressure + ' mmHg');
                    alert('Blood pressure updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating blood pressure: ' + xhr.responseText);
                }
            });
        });
    });
    </script>

</x-app-layout>