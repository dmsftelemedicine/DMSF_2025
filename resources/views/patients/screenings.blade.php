<x-app-layout>
    <style type="text/css">
        .bg-marilog {
            background-image: url('{{ asset("images/marilog-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .patient-header {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .patient-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .patient-details {
            display: flex;
            gap: 30px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .patient-detail-item {
            display: flex;
            flex-direction: column;
        }

        .patient-detail-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: 500;
        }

        .patient-detail-value {
            font-size: 14px;
            color: #333;
            font-weight: 600;
            margin-top: 2px;
        }

        .main-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }

        .sidebar {
            width: 250px;
            background: #f8f9fa;
            border-right: 1px solid #e9ecef;
            padding: 0;
        }

        .sidebar-header {
            background: #495057;
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            font-size: 16px;
        }

        .nav-vertical {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-vertical li {
            border-bottom: 1px solid #e9ecef;
        }

        .nav-vertical li:last-child {
            border-bottom: none;
        }

        .nav-vertical .nav-link {
            display: block;
            padding: 15px 20px;
            color: #495057;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .nav-vertical .nav-link:hover {
            background: #e9ecef;
            color: #212529;
        }

        .nav-vertical .nav-link.active {
            background: #007bff;
            color: white;
        }

        .content-area {
            flex: 1;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
        }

        .content-placeholder {
            text-align: center;
            color: #666;
        }

        .content-placeholder h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .content-placeholder p {
            font-size: 16px;
            color: #666;
        }

        .back-button {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #218838;
            color: white;
            text-decoration: none;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        /* Station Status Circles */
        .station-circles {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .circle-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #e9ecef;
            border: 2px solid #dee2e6;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .circle-icon.active {
            background-color: #28a745;
            border-color: #1e7e34;
        }

        /* Section Headers */
        .section-header {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        /* Measurement Cards */
        .measurements-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .measurement-card {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .bmi-card {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
        }

        .whr-card {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .measurement-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .measurement-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .measurement-value.overweight {
            color: #856404;
        }

        .measurement-value.high-risk {
            color: #721c24;
        }

        .measurement-value.normal {
            color: #155724;
        }

        /* Measurement Details */
        .measurements-details {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .measurement-detail {
            flex: 1;
            min-width: 120px;
            display: flex;
            flex-direction: column;
        }

        /* Vital Signs */
        .vital-signs {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>

    <div class="bg-marilog" id="page">
        <div class="container-fluid px-4 py-4">
            <!-- Back to Patient Details Button -->
            <a href="{{ route('patients.show', $patient->id) }}" class="back-button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Patient View
            </a>

            <!-- Patient Header -->
            <div class="patient-header">
                <!-- Top Row: Patient Name, Reference Number, Diabetes Status, Station Status -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <h1 class="patient-name">{{ strtoupper($patient->last_name) }}, {{ strtoupper($patient->first_name) }} {{ strtoupper($patient->middle_name) }}</h1>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Reference Number:</span>
                                <span class="patient-detail-value">{{ $patient->reference_number ?? 'LDC-P00000' }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Diabetes Status:</span>
                                <span class="patient-detail-value">{{ strtoupper($patient->diabetes_status ?? 'NOT DIABETIC') }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Station Status:</span>
                                <div class="station-circles">
                                    <span class="circle-icon active"></span>
                                    <span class="circle-icon"></span>
                                    <span class="circle-icon"></span>
                                    <span class="circle-icon"></span>
                                    <span class="circle-icon"></span>
                                    <span class="circle-icon"></span>
                                    <span class="circle-icon"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row: Personal Details, Anthropometric Measurements, Vital Signs -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="section-header">
                            <span class="patient-detail-label">Personal Details:</span>
                        </div>
                        <div class="patient-details mt-2">
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Age:</span>
                                <span class="patient-detail-value">{{ \Carbon\Carbon::parse($patient->birth_date)->age }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Sex:</span>
                                <span class="patient-detail-value">{{ strtoupper($patient->gender) }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Marital Status:</span>
                                <span class="patient-detail-value">{{ strtoupper($patient->marital_status) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-header">
                            <span class="patient-detail-label">Anthropometric Measurements:</span>
                        </div>
                        <div class="measurements-row mt-2">
                            <div class="measurement-card bmi-card">
                                <span class="measurement-label">BMI (kg/m²):</span>
                                <span class="measurement-value {{ $bmi !== 'N/A' && $bmi >= 25 ? 'overweight' : 'normal' }}">
                                    {{ $bmi !== 'N/A' ? number_format($bmi, 1) : 'N/A' }} ({{ $bmiLabel }})
                                </span>
                            </div>
                            <div class="measurement-card whr-card">
                                <span class="measurement-label">WHR (Waist/Hip):</span>
                                <span class="measurement-value {{ $whr !== 'N/A' && $whrLabel === 'High Risk' ? 'high-risk' : 'normal' }}">
                                    {{ $whr !== 'N/A' ? $whr : 'N/A' }} ({{ $whrLabel }})
                                </span>
                            </div>
                        </div>
                        <div class="measurements-details mt-2">
                            <div class="measurement-detail">
                                <span class="patient-detail-label">Height (m):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->height ?? 'N/A' }}</span>
                            </div>
                            <div class="measurement-detail">
                                <span class="patient-detail-label">Weight (kg):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->weight ?? 'N/A' }}</span>
                            </div>
                            <div class="measurement-detail">
                                <span class="patient-detail-label">Waist (cm):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->waist_circumference ?? 'N/A' }}</span>
                            </div>
                            <div class="measurement-detail">
                                <span class="patient-detail-label">Hip (cm):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->hip_circumference ?? 'N/A' }}</span>
                            </div>
                            <div class="measurement-detail">
                                <span class="patient-detail-label">Neck (cm):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->neck_circumference ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="section-header">
                            <span class="patient-detail-label">Vital Signs:</span>
                        </div>
                        <div class="vital-signs mt-2">
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Temperature (°C):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->temperature ?? 'N/A' }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">BP (mmHg):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->blood_pressure ?? 'N/A' }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">HR (BPM):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->heart_rate ?? 'N/A' }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">O2 Sat. (%):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->oxygen_saturation ?? 'N/A' }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">RR (CPM):</span>
                                <span class="patient-detail-value">{{ $sourceForBmi->respiratory_rate ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Container -->
            <div class="main-container">
                <!-- Sidebar -->
                <div class="sidebar">
                    <ul class="nav-vertical" role="tablist">
                        <li>
                            <button class="nav-link active" id="first-encounter-tab" data-bs-toggle="tab" data-bs-target="#first-encounter-tab-pane" type="button" role="tab" aria-controls="first-encounter-tab-pane" aria-selected="true">
                                First Encounter
                            </button>
                        </li>

                        @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3' && auth()->user()->role !== 'bhw_s4')
                        <li>
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                LD Screening Tools
                            </button>
                        </li>

                        @if(auth()->user()->role !== 'bhw_s5')
                        <li>
                            <button class="nav-link" id="comprehensive-history-tab" data-bs-toggle="tab" data-bs-target="#comprehensive-history-tab-pane" type="button" role="tab" aria-controls="comprehensive-history-tab-pane" aria-selected="false">
                                Comprehensive History
                            </button>
                        </li>
                        <li>
                            <button class="nav-link" id="review-of-systems-tab" data-bs-toggle="tab" data-bs-target="#review-of-systems-tab-pane" type="button" role="tab" aria-controls="review-of-systems-tab-pane" aria-selected="false">
                                Review of Systems
                            </button>
                        </li>
                        <li>
                            <button class="nav-link" id="physical-exam-tab" data-bs-toggle="tab" data-bs-target="#physical-exam-tab-pane" type="button" role="tab" aria-controls="physical-exam-tab-pane" aria-selected="false">
                                Physical Exams
                            </button>
                        </li>
                        <li>
                            <button class="nav-link" id="other-lm-vs-tab" data-bs-toggle="tab" data-bs-target="#other-lm-vs-tab-pane" type="button" role="tab" aria-controls="other-lm-vs-tab-pane" aria-selected="false">
                                Other LM VS
                            </button>
                        </li>
                        @if(auth()->user()->role !== 'bhw_s6')
                        <li>
                            <button class="nav-link" id="assessment-tab" data-bs-toggle="tab" data-bs-target="#assessment-tab-pane" type="button" role="tab" aria-controls="assessment-tab-pane" aria-selected="false">
                                Assessment
                            </button>
                        </li>
                        <li>
                            <button class="nav-link" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="false">
                                Management
                            </button>
                        </li>
                        @endif
                        @endif
                        @endif

                        <li>
                            <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes-tab-pane" type="button" role="tab" aria-controls="notes-tab-pane" aria-selected="false">
                                Notes
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Content Area -->
                <div class="content-area">
                    <div class="tab-content w-100" id="myTabContent">
                        <div class="tab-pane fade show active" id="first-encounter-tab-pane" role="tabpanel" aria-labelledby="first-encounter-tab" tabindex="0">
                            @include('patients.first_encounter.first_encounter_screening', ['patient' => $patient])
                        </div>

                        @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3')
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            @include('patients.screeningtool.screeningtool', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="review-of-systems-tab-pane" role="tabpanel" aria-labelledby="review-of-systems-tab" tabindex="0">
                            @include('patients.review_of_systems.review_of_systems', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="physical-exam-tab-pane" role="tabpanel" aria-labelledby="physical-exam-tab" tabindex="0">
                            @include('patients.physical_examination.physicalExamination', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="comprehensive-history-tab-pane" role="tabpanel" aria-labelledby="comprehensive-history-tab" tabindex="0">
                            @include('patients.comprehensive_history.comprehensive_history', ['patient' => $patient])
                        </div>
                        @if(auth()->user()->role !== 'bhw_s6')
                        <div class="tab-pane fade" id="assessment-tab-pane" role="tabpanel" aria-labelledby="assessment-tab" tabindex="0">
                            @include('patients.screeningtool.forms.assessment_form', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="management-tab-pane" role="tabpanel" aria-labelledby="management-tab" tabindex="0">
                            @include('patients.management.management', ['patient' => $patient])
                        </div>
                        @endif
                        <div class="tab-pane fade" id="other-lm-vs-tab-pane" role="tabpanel" aria-labelledby="other-lm-vs-tab" tabindex="0">
                            @include('patients.otherlmandvs.lifestyle_measures', [
                            'patient' => $patient,
                            'consultation1' => $consultation1,
                            'consultation2' => $consultation2,
                            'consultation3' => $consultation3
                            ])
                        </div>
                        @endif

                        <div class="tab-pane fade" id="notes-tab-pane" role="tabpanel" aria-labelledby="notes-tab" tabindex="0">
                            @include('patients.notes.notes', ['patient' => $patient])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</x-app-layout>