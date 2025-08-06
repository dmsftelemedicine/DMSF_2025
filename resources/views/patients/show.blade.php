<x-app-layout>
    <style type="text/css">
        .cardTop {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #496C83;
        }
        .bg-marilog {
            background-image: url('{{ asset("images/marilog-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .fa {
            color: white;
        }

        /* Enhanced Measurement Tabs Styles */
        #measurementsTab {
            border-bottom: none;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }

        #measurementsTab .nav-link {
            border: none;
            border-radius: 8px;
            margin: 0 2px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            color: #2c3e50;
            position: relative;
            overflow: hidden;
        }

        #measurementsTab .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        #measurementsTab .nav-link:hover::before {
            left: 100%;
        }

        #measurementsTab .nav-link:hover {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        #measurementsTab .nav-link:hover .text-dark {
            color: white !important;
        }

        #measurementsTab .nav-link:hover .tab-date {
            color: #ecf0f1 !important;
        }

        #measurementsTab .nav-link.active {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            box-shadow: 0 5px 20px rgba(39, 174, 96, 0.4);
            transform: translateY(-1px);
        }

        #measurementsTab .nav-link.active .text-dark {
            color: white !important;
        }

        #measurementsTab .nav-link.active .tab-date {
            color: #ecf0f1 !important;
        }

        /* Enhanced Badge Styles */
        .badge {
            transition: all 0.3s ease;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #27ae60, #2ecc71) !important;
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22) !important;
            box-shadow: 0 2px 8px rgba(243, 156, 18, 0.3);
        }

        /* Pulse animation for "No Data" badges */
        .badge.bg-warning {
            animation: pulse-warning 2s infinite;
        }

        @keyframes pulse-warning {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Enhanced Tab Date Styling */
        .tab-date {
            color: #34495e;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        /* Consultation header improvements */
        .consultation-header {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 0.75rem;
            border-left: 4px solid #3498db;
        }

        /* Enhanced measurement editing styles */
        .edit-mode-btn {
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .edit-mode-btn:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        }

        .edit-mode-btn.active {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            animation: pulse-success 1.5s infinite;
        }

        @keyframes pulse-success {
            0%, 100% { box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3); }
            50% { box-shadow: 0 4px 16px rgba(39, 174, 96, 0.6); }
        }

        .measurement-section {
            position: relative;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .measurement-section.edit-mode {
            background: rgba(52, 152, 219, 0.1);
            border: 2px dashed #3498db;
            transform: scale(1.02);
        }

        .measurement-input {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 2px solid #3498db !important;
            border-radius: 6px !important;
            transition: all 0.3s ease !important;
            font-weight: bold !important;
        }

        .measurement-input:focus {
            border-color: #27ae60 !important;
            box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25) !important;
        }

        .save-section-btn {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            animation: pulse-save 2s infinite;
        }

        @keyframes pulse-save {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .cancel-edit-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        /* Loading animation for tabs */
        #measurementsTab .nav-link.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        #measurementsTab .nav-link.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #fff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Tabs Styles */

                .nav-tabs {
                padding: 1rem 1rem;
                gap: 0.5rem;
                font-weight: 500;
                border-bottom: none; /* cleaner separation */
                margin-bottom: 1rem;
            }
                .nav-link-bot {
                border-radius: 50px;
                padding: 0.5rem 1rem;
                font-weight: 500;
                background:  linear-gradient(to right, #486C33, #7CAD3E);
                color: white;
                border: none;
                transition: transform 0.2s ease;
            }
                .nav-link-bot:hover {
                transform: translateY(-2px);
            }
                .nav-tabs .nav-link-bot.active {
                background: #1A5D77;
            }
                .tab-content {
                margin-top: .5rem;
                margin-bottom: .5rem;
            }
    </style>

    <div class="bg-marilog">
        <div class="mx-auto p-4">
            <div class="cardTop shadow-lg p-4 border-0" style="width: 100%; border-radius: 2rem;">
                <div class="row g-4">
                <!-- Left Section (Profile Image & Basic Info) -->
                <div class="col-md-3 text-left border-end">
                    <a href="{{ route('patients.index') }}">
                        <button type="button" class="mb-3 border border-white text-white hover:bg-[#1A5D77] hover:text-white transition-colors duration-300 rounded-full px-3 py-1">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </button>
                    </a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">Edit Patient</a>
                    <h5 class="fw-bold mb-1 mt-5 text-center text-white">
                        {{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}
                    </h5>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Age: {{ \Carbon\Carbon::parse($patient->birth_date)->age }} years old</p>
                    </div>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Sex: {{ $patient->gender }}</p>
                    </div>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Status: {{ $patient->marital_status }}</p>
                    </div>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Religion: {{ $patient->religion }}</p>
                    </div>
                    <div class="bg-light p-1 rounded border text-center">
                        <p class="mb-0">{{ $patient->reference_number ?? 'Not set' }}</p>
                    </div>

                    <p class="pt-3 text-white mb-2 text-center">
                        Diagnosis
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#diagnosisModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </p>
                    <p class="text-center text-white">{{ $patient->diagnosis ?? 'Diagnosis not set'}}</p>
                </div>

                <!-- Right Section -->
                <div class="col-md-9" style="border-left: 1px solid black;">
                    <!-- Consultation Info Banner -->
                    <div class="alert alert-info mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>
                                <strong>Consultation-Based Measurements:</strong> Each tab represents a specific consultation session with independent measurement records.
                                <br><small class="text-muted">Dates can be manually edited to match actual consultation schedules.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="measurementsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1-content" type="button" role="tab" aria-controls="tab1-content" aria-selected="true" data-consultation-id="{{ $consultation1?->id }}" data-consultation-number="{{ $consultation1?->consultation_number }}">
                                <div class="d-flex flex-column align-items-center">
                                    <small class="text-dark mb-1">Consultation {{ $consultation1?->consultation_number ?? '1' }}</small>
                                    <span class="tab-date fw-semibold">{{ \Carbon\Carbon::parse($tab1Date)->format('M d, Y') }}</span>
                                    @if($consultation1?->hasMeasurementData())
                                        <span class="badge bg-success mt-1" style="font-size: 0.6rem;">Has Data</span>
                                    @else
                                        <span class="badge bg-warning text-dark mt-1" style="font-size: 0.6rem;">No Data</span>
                                    @endif
                                </div>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2-content" type="button" role="tab" aria-controls="tab2-content" aria-selected="false" data-consultation-id="{{ $consultation2?->id }}" data-consultation-number="{{ $consultation2?->consultation_number }}">
                                <div class="d-flex flex-column align-items-center">
                                    <small class="text-dark mb-1">Consultation {{ $consultation2?->consultation_number ?? '2' }}</small>
                                    <span class="tab-date fw-semibold">{{ \Carbon\Carbon::parse($tab2Date)->format('M d, Y') }}</span>
                                    @if($consultation2?->hasMeasurementData())
                                        <span class="badge bg-success mt-1" style="font-size: 0.6rem;">Has Data</span>
                                    @else
                                        <span class="badge bg-warning text-dark mt-1" style="font-size: 0.6rem;">No Data</span>
                                    @endif
                                </div>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3-content" type="button" role="tab" aria-controls="tab3-content" aria-selected="false" data-consultation-id="{{ $consultation3?->id }}" data-consultation-number="{{ $consultation3?->consultation_number }}">
                                <div class="d-flex flex-column align-items-center">
                                    <small class="text-dark mb-1">Consultation {{ $consultation3?->consultation_number ?? '3' }}</small>
                                    <span class="tab-date fw-semibold">{{ \Carbon\Carbon::parse($tab3Date)->format('M d, Y') }}</span>
                                    @if($consultation3?->hasMeasurementData())
                                        <span class="badge bg-success mt-1" style="font-size: 0.6rem;">Has Data</span>
                                    @else
                                        <span class="badge bg-warning text-dark mt-1" style="font-size: 0.6rem;">No Data</span>
                                    @endif
                                </div>
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="measurementsTabContent">
                        <!-- Tab 1 Content -->
                        <div class="tab-pane fade show active" id="tab1-content" role="tabpanel" aria-labelledby="tab1-tab">
                            <div class="consultation-header mb-3 mt-2">
                                <h6 class="text-white mb-1">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    Consultation {{ $consultation1?->consultation_number ?? '1' }} - {{ \Carbon\Carbon::parse($tab1Date)->format('F d, Y') }}
                                    @if($consultation1)
                                        <small class="text-info">(ID: {{ $consultation1->id }})</small>
                                    @endif
                                </h6>
                            </div>
                            <!-- Anthropometric Measurements Section -->
                            <div class="measurement-section" id="anthropometric-section-1">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="border-bottom pb-2 mb-0 flex-grow-1">Anthropometric Measurements</h5>
                                    <button class="edit-mode-btn" data-section="anthropometric" data-tab="1">
                                        <i class="fas fa-edit me-1"></i>Edit Mode
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Height (m)</p>
                                        <p class="fw-bold editable-measurement" data-field="height" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Weight (kg)</p>
                                        <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">BMI (kg/m²)</p>
                                        <p class="fw-bold" id="bmi-tab1">{{ $tab1Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Waist Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Hip Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Neck Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div class="measurement-section" id="vital-signs-section-1">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="border-bottom pb-2 mb-0 flex-grow-1">Vital Signs</h5>
                                    <button class="edit-mode-btn" data-section="vital-signs" data-tab="1">
                                        <i class="fas fa-edit me-1"></i>Edit Mode
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Temperature (°C)</p>
                                        <p class="fw-bold editable-measurement" data-field="temperature" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Heart Rate (BPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="heart_rate" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">O2 Saturation (%)</p>
                                        <p class="fw-bold editable-measurement" data-field="o2_saturation" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Respiratory Rate (CPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="respiratory_rate" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Blood Pressure (mmHg)</p>
                                        <p class="fw-bold editable-measurement" data-field="blood_pressure" data-tab="1" data-consultation-id="{{ $consultation1?->id }}">{{ $tab1Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2 Content (Hidden by default) -->
                        <div class="tab-pane fade" id="tab2-content" role="tabpanel" aria-labelledby="tab2-tab">
                            <div class="consultation-header mb-3 mt-2">
                                <h6 class="text-white mb-1">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    Consultation {{ $consultation2?->consultation_number ?? '2' }} - {{ \Carbon\Carbon::parse($tab2Date)->format('F d, Y') }}
                                    @if($consultation2)
                                        <small class="text-info">(ID: {{ $consultation2->id }})</small>
                                    @endif
                                </h6>
                            </div>
                            <!-- Anthropometric Measurements Section -->
                            <div class="measurement-section" id="anthropometric-section-2">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="border-bottom pb-2 mb-0 flex-grow-1">Anthropometric Measurements</h5>
                                    <button class="edit-mode-btn" data-section="anthropometric" data-tab="2">
                                        <i class="fas fa-edit me-1"></i>Edit Mode
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Height (m)</p>
                                        <p class="fw-bold editable-measurement" data-field="height" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Weight (kg)</p>
                                        <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">BMI (kg/m²)</p>
                                        <p class="fw-bold" id="bmi-tab2">{{ $tab2Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Waist Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Hip Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Neck Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div class="measurement-section" id="vital-signs-section-2">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="border-bottom pb-2 mb-0 flex-grow-1">Vital Signs</h5>
                                    <button class="edit-mode-btn" data-section="vital-signs" data-tab="2">
                                        <i class="fas fa-edit me-1"></i>Edit Mode
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Temperature (°C)</p>
                                        <p class="fw-bold editable-measurement" data-field="temperature" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Heart Rate (BPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="heart_rate" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">O2 Saturation (%)</p>
                                        <p class="fw-bold editable-measurement" data-field="o2_saturation" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Respiratory Rate (CPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="respiratory_rate" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Blood Pressure (mmHg)</p>
                                        <p class="fw-bold editable-measurement" data-field="blood_pressure" data-tab="2" data-consultation-id="{{ $consultation2?->id }}">{{ $tab2Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3 Content (Hidden by default) -->
                        <div class="tab-pane fade" id="tab3-content" role="tabpanel" aria-labelledby="tab3-tab">
                            <div class="consultation-header mb-3 mt-2">
                                <h6 class="text-white mb-1">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    Consultation {{ $consultation3?->consultation_number ?? '3' }} - {{ \Carbon\Carbon::parse($tab3Date)->format('F d, Y') }}
                                    @if($consultation3)
                                        <small class="text-info">(ID: {{ $consultation3->id }})</small>
                                    @endif
                                </h6>
                            </div>
                            <!-- Anthropometric Measurements Section -->
                            <div class="measurement-section" id="anthropometric-section-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="border-bottom pb-2 mb-0 flex-grow-1 text-white">Anthropometric Measurements</h5>
                                    <button class="edit-mode-btn" data-section="anthropometric" data-tab="3">
                                        <i class="fas fa-edit me-1"></i>Edit Mode
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Height (m)</p>
                                        <p class="fw-bold editable-measurement" data-field="height" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Weight (kg)</p>
                                        <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text mb-1 text-white">BMI (kg/m²)</p>
                                        <p class="fw-bold bg-light p-1 rounded border" id="bmi-tab3">{{ $tab3Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Waist Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Hip Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Neck Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div class="measurement-section" id="vital-signs-section-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="border-bottom pb-2 mb-0 flex-grow-1 text-white">Vital Signs</h5>
                                    <button class="edit-mode-btn" data-section="vital-signs" data-tab="3">
                                        <i class="fas fa-edit me-1"></i>Edit Mode
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Temperature (°C)</p>
                                        <p class="fw-bold editable-measurement" data-field="temperature" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Heart Rate (BPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="heart_rate" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">O2 Saturation (%)</p>
                                        <p class="fw-bold editable-measurement" data-field="o2_saturation" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Respiratory Rate (CPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="respiratory_rate" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-white mb-1">Blood Pressure (mmHg)</p>
                                        <p class="fw-bold editable-measurement" data-field="blood_pressure" data-tab="3" data-consultation-id="{{ $consultation3?->id }}">{{ $tab3Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>

                    <!-- Tabs for Patient Details -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot active" id="first-encounter-tab" data-bs-toggle="tab" data-bs-target="#first-encounter-tab-pane" type="button" role="tab" aria-controls="first-encounter-tab-pane" aria-selected="true">First Encounter</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">LD Screening Tools</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="comprehensive-history-tab" data-bs-toggle="tab" data-bs-target="#comprehensive-history-tab-pane" type="button" role="tab" aria-controls="comprehensive-history-tab-pane" aria-selected="false">History</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="review-of-systems-tab" data-bs-toggle="tab" data-bs-target="#review-of-systems-tab-pane" type="button" role="tab" aria-controls="review-of-systems-tab-pane" aria-selected="false">ROS</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="physical-exam-tab" data-bs-toggle="tab" data-bs-target="#physical-exam-tab-pane" type="button" role="tab" aria-controls="physical-exam-tab-pane" aria-selected="false">Physical Exam</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="other-lm-vs-tab" data-bs-toggle="tab" data-bs-target="#other-lm-vs-tab-pane" type="button" role="tab" aria-controls="other-lm-vs-tab-pane" aria-selected="false">Other LM VS</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="assessment-tab" data-bs-toggle="tab" data-bs-target="#assessment-tab-pane" type="button" role="tab" aria-controls="assessment-tab-pane" aria-selected="false">Assessment</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="false">Management</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes-tab-pane" type="button" role="tab" aria-controls="notes-tab-pane" aria-selected="false">Notes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="prescription-tab" data-bs-toggle="tab" data-bs-target="#prescription-tab-pane" type="button" role="tab" aria-controls="prescription-tab-pane" aria-selected="false">Prescription</button>
                        </li>
                    </ul>

                    <style>
                        .tab-content.active {
                            background-color: #7CAD3E;
                        }
                    </style>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="first-encounter-tab-pane" role="tabpanel" aria-labelledby="first-encounter-tab" tabindex="0">
                            <br/>
                            @include('patients.first_encounter.first_encounter_screening', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <br/>
                            @include('patients.screeningtool.screeningtool', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="prescription-tab-pane" role="tabpanel" aria-labelledby="prescription-tab" tabindex="0">
                            <br/>
                            @include('prescriptions.prescription_patient', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="review-of-systems-tab-pane" role="tabpanel" aria-labelledby="review-of-systems-tab" tabindex="0">
                            <br/>
                            @include('patients.review_of_systems.review_of_systems', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="physical-exam-tab-pane" role="tabpanel" aria-labelledby="physical-exam-tab" tabindex="0">
                            <br/>
                            @include('patients.physical_examination.physicalExamination', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="comprehensive-history-tab-pane" role="tabpanel" aria-labelledby="comprehensive-history-tab" tabindex="0">
                            <br/>
                            @include('patients.comprehensive_history.comprehensive_history', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="assessment-tab-pane" role="tabpanel" aria-labelledby="assessment-tab" tabindex="0">
                            <br/>
                            @include('patients.screeningtool.forms.assessment_form', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="other-lm-vs-tab-pane" role="tabpanel" aria-labelledby="other-lm-vs-tab" tabindex="0">
                            <br/>
                            @include('patients.otherlmandvs.other_lm_vs')
                        </div>
                        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
                    </div>
                </div>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Enhanced edit mode functionality
        $('.edit-mode-btn').on('click', function() {
            const $btn = $(this);
            const section = $btn.data('section');
            const tab = $btn.data('tab');
            const $sectionDiv = $btn.closest('.measurement-section');
            const isEditMode = $btn.hasClass('active');

            if (!isEditMode) {
                // Enter edit mode
                $btn.addClass('active')
                    .html('<i class="fas fa-save me-1"></i>Save Changes');

                $sectionDiv.addClass('edit-mode');

                // Convert measurements to inputs
                $sectionDiv.find('.editable-measurement').each(function() {
                    const $measurement = $(this);
                    const currentValue = $measurement.text().trim();
                    const field = $measurement.data('field');

                    // Always create input, even for N/A values
                    const cleanValue = currentValue === 'N/A' ? '' : currentValue.replace(/[^\d.-]/g, '');
                    const inputType = (field === 'blood_pressure') ? 'text' : 'number';
                    const $input = $('<input>', {
                        type: inputType,
                        step: field === 'height' ? '0.01' : '1',
                        value: cleanValue,
                        placeholder: currentValue === 'N/A' ? 'Enter value' : '',
                        class: 'form-control measurement-input',
                        'data-field': field,
                        'data-original': currentValue
                    });

                    $measurement.html($input);

                    // Auto-focus first input
                    if ($sectionDiv.find('.measurement-input').length === 1) {
                        $input.focus().select();
                    }
                });

                // Add save/cancel buttons
                const $buttonContainer = $('<div class="text-end mt-3"></div>');
                const $saveBtn = $('<button class="save-section-btn"><i class="fas fa-check me-1"></i>Save Section</button>');
                const $cancelBtn = $('<button class="cancel-edit-btn"><i class="fas fa-times me-1"></i>Cancel</button>');

                $buttonContainer.append($saveBtn, $cancelBtn);
                $sectionDiv.append($buttonContainer);

                // Handle save section
                $saveBtn.on('click', function() {
                    saveSection($sectionDiv, $btn, section, tab);
                });

                // Handle cancel
                $cancelBtn.on('click', function() {
                    cancelEdit($sectionDiv, $btn);
                });

                // Handle Enter key to save
                $sectionDiv.find('.measurement-input').on('keypress', function(e) {
                    if (e.which === 13) {
                        saveSection($sectionDiv, $btn, section, tab);
                    }
                });

            } else {
                // Save and exit edit mode
                saveSection($sectionDiv, $btn, section, tab);
            }
        });

        function saveSection($sectionDiv, $btn, section, tab) {
            const $inputs = $sectionDiv.find('.measurement-input');
            const changes = {};
            let hasChanges = false;

            // Collect changes
            $inputs.each(function() {
                const $input = $(this);
                const field = $input.data('field');
                const newValue = $input.val().trim();
                const originalValue = $input.data('original');

                // Consider any non-empty value as a change from N/A, or actual value changes
                if (newValue !== originalValue && (originalValue === 'N/A' || newValue !== '')) {
                    changes[field] = newValue;
                    hasChanges = true;
                }
            });

            if (hasChanges) {
                // Show saving animation
                $btn.html('<i class="fas fa-spinner fa-spin me-1"></i>Saving...')
                    .prop('disabled', true);

                // Get consultation ID from the first measurement in the section
                const consultationId = $inputs.first().closest('.editable-measurement').data('consultation-id');

                // Create array of promises for each field update
                const savePromises = [];

                Object.keys(changes).forEach(fieldName => {
                    const fieldValue = changes[fieldName];

                    const promise = $.ajax({
                        url: "{{ route('patients.update-measurement', $patient->id) }}",
                        method: "POST",
                        data: {
                            tab_number: tab,
                            field_name: fieldName,
                            field_value: fieldValue,
                            consultation_id: consultationId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    savePromises.push(promise);
                });

                // Wait for all saves to complete
                Promise.all(savePromises)
                    .then(responses => {
                        // Update display values
                        $inputs.each(function() {
                            const $input = $(this);
                            const $measurement = $input.closest('.editable-measurement');
                            const newValue = $input.val().trim();
                            const displayValue = newValue === '' ? 'N/A' : newValue;

                            $measurement.html(displayValue).css({
                                'background': 'rgba(39, 174, 96, 0.2)',
                                'border-radius': '4px',
                                'padding': '2px 4px',
                                'transition': 'all 0.3s ease'
                            });

                            // Flash effect
                            setTimeout(() => {
                                $measurement.css({
                                    'background': 'transparent',
                                    'padding': '0'
                                });
                            }, 2000);
                        });

                        // Update measurement status badge
                        const tabButton = $(`#tab${tab}-tab`);
                        const statusBadge = tabButton.find('.badge');
                        statusBadge.removeClass('bg-warning').addClass('bg-success').text('Has Data');

                        // Auto-update BMI if height or weight were changed
                        const changedFields = Object.keys(changes);
                        if (changedFields.includes('height') || changedFields.includes('weight_kg')) {
                            updateBMI(tab);
                        }

                        exitEditMode($sectionDiv, $btn);

                        // Show success message
                        showNotification('✅ Section saved successfully!', 'success');
                    })
                    .catch(xhr => {
                        console.error('Save error:', xhr);

                        $btn.html('<i class="fas fa-edit me-1"></i>Edit Mode')
                            .removeClass('active')
                            .prop('disabled', false);

                        let errorMessage = 'Error saving measurements';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            errorMessage = xhr.responseText;
                        }

                        showNotification('❌ ' + errorMessage, 'error');
                        alert('Error saving: ' + errorMessage);
                    });
            } else {
                exitEditMode($sectionDiv, $btn);
            }
        }

        function cancelEdit($sectionDiv, $btn) {
            $sectionDiv.find('.measurement-input').each(function() {
                const $input = $(this);
                const $measurement = $input.closest('.editable-measurement');
                const originalValue = $input.data('original');

                $measurement.html(originalValue);
            });

            exitEditMode($sectionDiv, $btn);
            showNotification('❌ Changes cancelled', 'info');
        }

        function exitEditMode($sectionDiv, $btn) {
            $btn.removeClass('active')
                .html('<i class="fas fa-edit me-1"></i>Edit Mode')
                .prop('disabled', false);

            $sectionDiv.removeClass('edit-mode');
            $sectionDiv.find('.text-end').remove();
        }

        function showNotification(message, type) {
            const alertType = type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info';
            const $notification = $('<div class="alert alert-' + alertType + ' position-fixed" style="top: 20px; right: 20px; z-index: 9999; max-width: 300px;">' + message + '</div>');

            $('body').append($notification);

            setTimeout(() => {
                $notification.fadeOut(() => $notification.remove());
            }, 3000);
        }

        // Enhanced tab switching with loading animation
        $('#measurementsTab .nav-link').on('click', function() {
            const $this = $(this);

            // Add loading state
            $this.addClass('loading');

            // Remove loading after animation
            setTimeout(() => {
                $this.removeClass('loading');
            }, 300);
        });

        // Add click sound effect (optional)
        $('#measurementsTab .nav-link').on('click', function() {
            // Create a subtle click sound using Web Audio API
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.exponentialRampToValueAtTime(400, audioContext.currentTime + 0.1);

                gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + 0.1);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.1);
            } catch (e) {
                // Silently fail if Web Audio API is not supported
            }
        });

        // Add smooth scroll to tab content
        $('#measurementsTab .nav-link').on('shown.bs.tab', function() {
            $('html, body').animate({
                scrollTop: $('#measurementsTabContent').offset().top - 100
            }, 500);
        });

        // Enhanced hover effects for measurements (but no double-click editing - use Edit Mode buttons instead!)
        $('.editable-measurement').hover(
            function() {
                if (!$(this).closest('.measurement-section').hasClass('edit-mode')) {
                    $(this).css({
                        'background': 'rgba(255, 255, 255, 0.1)',
                        'border-radius': '4px',
                        'padding': '2px 4px',
                        'cursor': 'default',
                        'transition': 'all 0.3s ease'
                    });
                }
            },
            function() {
                if (!$(this).closest('.measurement-section').hasClass('edit-mode')) {
                    $(this).css({
                        'background': 'transparent',
                        'padding': '0'
                    });
                }
            }
        );

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

        // Function to format date
        function formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }

        // Save date changes
        $('#saveDateBtn').click(function() {
            const tabNum = $('#currentTab').val();
            const oldDate = $('#currentTab').attr('data-original-date');
            const newDate = $('#tabDate').val();

            if (oldDate === newDate) {
                $('#dateEditModal').modal('hide');
                return;
            }

            const formData = {
                tab_number: tabNum,
                old_date: oldDate,
                new_date: newDate,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement-date', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
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

        function updateBMI(tab) {
            // Optionally, fetch updated measurement and recalculate BMI
            $.ajax({
                url: '/patients/{{ $patient->id }}/measurements/' + tab,
                method: 'GET',
                success: function(response) {
                    var m = response.measurement;
                    if (m && m.height && m.weight_kg) {
                        var bmi = (m.weight_kg / (m.height * m.height)).toFixed(2);
                        $('#bmi-tab' + tab).text(bmi + ' kg/m²');
                    }
                }
            });
        }
    });
    </script>

</x-app-layout>
