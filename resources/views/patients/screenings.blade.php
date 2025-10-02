@php
// Controller now provides the selected consultation data and measurements
// These variables are now passed from the controller:
// - $selectedConsultationId
// - $selectedTabNumber  
// - $selectedConsultation
// - $bmi, $bmiLabel, $whr, $whrLabel (calculated for the specific consultation)
// - $sourceForBmi (the measurement source for the selected consultation)

// Set defaults if not provided by controller
$selectedConsultationId = $selectedConsultationId ?? $consultation1?->id ?? null;
$selectedTabNumber = $selectedTabNumber ?? 1;

// Calculate BMI class for styling
$bmiClass = 'bmi-none';
if ($bmi !== 'N/A' && is_numeric($bmi)) {
    if ($bmi < 18.5) {
        $bmiClass = 'bmi-underweight';
    } elseif ($bmi < 25) {
        $bmiClass = 'bmi-healthy';
    } elseif ($bmi < 30) {
        $bmiClass = 'bmi-overweight';
    } elseif ($bmi < 35) {
        $bmiClass = 'bmi-obese1';
    } elseif ($bmi < 40) {
        $bmiClass = 'bmi-obese2';
    } else {
        $bmiClass = 'bmi-obese3';
    }
}

// Calculate WHR class for styling (using Asian population criteria)
$whrClass = 'whr-0';
if ($whr !== 'N/A' && is_numeric($whr)) {
    $patientGender = $patient->gender ?? null;
    $whrValue = (float) $whr;
    
    if (!$patientGender || $patientGender === '' || $patientGender === null) {
        // Sex not specified
        if ($whrValue == 0 || $whrValue === 0.00) {
            $whrClass = 'whr-0';
        } else {
            $whrClass = 'whr-unknown';
        }
    } elseif (strtolower($patientGender) === 'male' || strtolower($patientGender) === 'm') {
        // Asian male thresholds: Optimal < 0.90, Central obesity ≥ 0.90
        if ($whrValue == 0 || $whrValue === 0.00) {
            $whrClass = 'whr-0';
        } elseif ($whrValue < 0.90) {
            $whrClass = 'whr-green';
        } else {
            $whrClass = 'whr-red';
        }
    } elseif (strtolower($patientGender) === 'female' || strtolower($patientGender) === 'f') {
        // Asian female thresholds: Optimal < 0.80, Borderline 0.80-0.84, Central obesity ≥ 0.85
        if ($whrValue == 0 || $whrValue === 0.00) {
            $whrClass = 'whr-0';
        } elseif ($whrValue < 0.80) {
            $whrClass = 'whr-green';
        } elseif ($whrValue >= 0.80 && $whrValue < 0.85) {
            $whrClass = 'whr-yellow';
        } else {
            $whrClass = 'whr-red';
        }
    } else {
        // Unknown gender
        if ($whrValue == 0 || $whrValue === 0.00) {
            $whrClass = 'whr-0';
        } else {
            $whrClass = 'whr-unknown';
        }
    }
}
@endphp

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
            display: column;
            gap: 30px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .patient-detail-item {
            display: row;
        }

        .patient-detail-label {
            font-size: 12px;
            color: #000000;
            text-transform: uppercase;
            font-weight: 500;
        }

        .patient-detail-value {
            font-size: 14px;
            color: #000000;
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
            padding: 20px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            background: white;
            overflow-y: auto;
        }

        .content-placeholder {
            text-align: center;
            color: #000000;
        }

        .content-placeholder h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #000000;
        }

        .content-placeholder p {
            font-size: 16px;
            color: #000000;
        }

        .back-button {
            background: rgba(74, 108, 47, 0.85);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 58px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: rgba(116, 163, 77, 1);
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
            display: row;
            justify-content: space-between;
            text-align: left;
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
            color: #000000;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .measurement-value {
            font-size: 14px;
            font-weight: 600;
            color: #000000;
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

        /* BMI Color Classes */
        .bmi-card.bmi-none {
            background: #FFFFFF;
            border: 2px solid #B7B7B7;
        }

        .bmi-card.bmi-underweight {
            background: #9FD6F5;
            border: 2px solid #2374AB;
        }

        .bmi-card.bmi-healthy {
            background: #CAE156;
            border: 2px solid #798A1F;
        }

        .bmi-card.bmi-overweight {
            background: #FAE158;
            border: 2px solid #F0CD11;
        }

        .bmi-card.bmi-obese1 {
            background: #F7A072;
            border: 2px solid #D65A31;
        }

        .bmi-card.bmi-obese2 {
            background: #E78888;
            border: 2px solid #B23A48;
        }

        .bmi-card.bmi-obese3 {
            background: #E57373;
            border: 2px solid #981616;
        }

        /* WHR Color Classes */
        .whr-card.whr-green {
            background: #CAE156;
            border: 2px solid #798A1F;
        }

        .whr-card.whr-yellow {
            background: #FAE158;
            border: 2px solid #F0CD11;
        }

        .whr-card.whr-red {
            background: #C86B6B;
            border: 2px solid #981616;
        }

        .whr-card.whr-0 {
            background: #FFFFFF;
            border: 2px solid #B7B7B7;
        }

        .whr-card.whr-unknown {
            background: #FFFFFF;
            border: 2px solid #BFBFBF;
        }

        /* Value Text Colors */
        .measurement-value.bmi-text,
        .measurement-value.whr-text {
            color: #000000;
            font-weight: 700;
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
            display: row;
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

        /* Tab content styling */
        .tab-content {
            width: 100%;
            height: 100%;
        }

        .tab-pane {
            width: 100%;
            height: 100%;
        }
    </style>

<div class="bg-marilog" id="page" 
    data-selected-consultation-id="{{ $selectedConsultationId }}"
    data-selected-tab="{{ $selectedTabNumber }}"
    data-consultation-1-id="{{ $consultation1?->id }}"
    data-consultation-2-id="{{ $consultation2?->id }}"
    data-consultation-3-id="{{ $consultation3?->id }}">
        <div class="container-fluid px-4 py-4">
            <!-- Back to Patient Details Button -->
            <a href="{{ route('patients.show', $patient->id) }}#consultation-{{ $selectedTabNumber }}" class="back-button">
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
                                <div class="station-circles">
                                    <span class="circle-icon active"></span>
                                    <span class="circle-icon active"></span>
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
                    <div class="col-md-3 column">
                        <div class="section-header">
                            <span class="patient-detail-label">Personal Details:</span>
                        </div>
                        <div class="patient-details mt-2">
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Age:</span>
                                <span class="patient-detail-value mb-3">{{ \Carbon\Carbon::parse($patient->birth_date)->age }}</span>
                            </div>
                            <div class="patient-detail-item">
                                <span class="patient-detail-label">Sex:</span>
                                <span class="patient-detail-value mb-3">{{ strtoupper($patient->gender) }}</span>
                            </div>
                            <div class="patient-detail-item ">
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
                            <div class="col">
                                <div class="measurement-card bmi-card {{ $bmiClass }}">
                                    <span class="measurement-label">BMI (kg/m²):</span>
                                    <span class="measurement-value bmi-text">
                                        {{ $bmi !== 'N/A' ? number_format($bmi, 2) : 'N/A' }} ({{ $bmiLabel }})
                                    </span>
                                </div>
                                <div class="measurement-detail">
                                    <span class="patient-detail-label">Height (m):</span>
                                    <span class="patient-detail-value">{{ $sourceForBmi->height ?? 'N/A' }}</span>
                                </div>
                                <div class="measurement-detail">
                                    <span class="patient-detail-label">Weight (kg):</span>
                                    <span class="patient-detail-value">{{ $sourceForBmi->weight_kg ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="col">
                                <div class="measurement-card whr-card {{ $whrClass }}">
                                    <span class="measurement-label">WHR (Waist/Hip):</span>
                                    <span class="measurement-value whr-text">
                                        {{ $whr !== 'N/A' ? number_format($whr, 2) : 'N/A' }} ({{ $whrLabel }})
                                    </span>
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
                    </div>
                    <div class="col-md-3">
                        <div class="section-header">
                            <span class="patient-detail-label">Vital Signs:</span>
                        </div>
                        <div class="vital-signs mt-2">
                            <div class="row">
                                <div class="col-6">
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
                                </div>

                                <div class="col-6">
                                    <div class="patient-detail-item">
                                        <span class="patient-detail-label">O2 Sat. (%):</span>
                                        <span class="patient-detail-value">{{ $sourceForBmi->o2_saturation ?? 'N/A' }}</span>
                                    </div>
                                    <div class="patient-detail-item">
                                        <span class="patient-detail-label">RR (CPM):</span>
                                        <span class="patient-detail-value">{{ $sourceForBmi->respiratory_rate ?? 'N/A' }}</span>
                                    </div>
                                </div>
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
                            <button class="nav-link" id="ldscreening-tab" data-bs-toggle="tab" data-bs-target="#ldscreening-tab-pane" type="button" role="tab" aria-controls="ldscreening-tab-pane" aria-selected="false">
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
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'doctor')
                            <div class="tab-pane fade" id="assessment-tab-pane" role="tabpanel" aria-labelledby="assessment-tab" tabindex="0">
                                @include('patients.screeningtool.forms.assessment_form', ['patient' => $patient])
                            </div>
                            
                            <div class="tab-pane fade" id="management-tab-pane" role="tabpanel" aria-labelledby="management-tab" tabindex="0">
                                @include('patients.management.management', ['patient' => $patient])
                            </div>
                        @endif

                        <div class="tab-pane fade" id="notes-tab-pane" role="tabpanel" aria-labelledby="notes-tab" tabindex="0">
                            @include('patients.notes.notes', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade show active" id="first-encounter-tab-pane" role="tabpanel" aria-labelledby="first-encounter-tab" tabindex="0">
                            @include('patients.first_encounter.first_encounter_screening', ['patient' => $patient])
                        </div>
                        
                        @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3')
                            <div class="tab-pane fade" id="review-of-systems-tab-pane" role="tabpanel" aria-labelledby="review-of-systems-tab" tabindex="0">
                                @include('patients.review_of_systems.review_of_systems', ['patient' => $patient])
                            </div>
                            <div class="tab-pane fade" id="comprehensive-history-tab-pane" role="tabpanel" aria-labelledby="comprehensive-history-tab" tabindex="0">
                                @include('patients.comprehensive_history.comprehensive_history', ['patient' => $patient])
                            </div>
                            <div class="tab-pane fade" id="physical-exam-tab-pane" role="tabpanel" aria-labelledby="physical-exam-tab" tabindex="0">
                                @include('patients.physical_examination.physicalExamination', ['patient' => $patient])
                            
                        @endif

                        <div class="tab-pane fade" id="other-lm-vs-tab-pane" role="tabpanel" aria-labelledby="other-lm-vs-tab" tabindex="0">
                            @include('patients.otherlmandvs.lifestyle_measures', [
                                'patient' => $patient,
                                'consultation1' => $consultation1,
                                'consultation2' => $consultation2,
                                'consultation3' => $consultation3
                            ])
                        
                        @if(auth()->user()->role === 'bhw_s5' || auth()->user()->role === 'admin' || auth()->user()->role === 'doctor')
                            <div class="tab-pane fade" id="ldscreening-tab-pane" role="tabpanel" aria-labelledby="ldscreening-tab" tabindex="0">
                                <x-ld-screening-tool :patient="$patient" :consultation-id="$selectedConsultationId"/>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Set up consultation context from route parameters
        document.addEventListener('DOMContentLoaded', function() {
            const pageElement = document.getElementById('page');
            const selectedConsultationId = pageElement.dataset.selectedConsultationId;
            const selectedTab = pageElement.dataset.selectedTab;
            
            // Set global consultation context for included forms
            window.currentConsultationId = selectedConsultationId ? parseInt(selectedConsultationId) : null;
            window.currentConsultationNumber = selectedTab ? parseInt(selectedTab) : 1;
            
            // Display consultation context info (optional - for debugging)
            console.log('Screenings page loaded with consultation context:', {
                consultationId: window.currentConsultationId,
                tabNumber: window.currentConsultationNumber
            });
            
            // Dispatch event to notify included forms about the consultation context
            const consultationContextEvent = new CustomEvent('consultationContextSet', {
                detail: {
                    consultationId: window.currentConsultationId,
                    consultationNumber: window.currentConsultationNumber
                }
            });
            document.dispatchEvent(consultationContextEvent);
            
            // If we have a valid consultation context, show a visual indicator
            if (selectedConsultationId && selectedTab) {
                // You can add visual indicators here if needed
                // For example, highlight which consultation is being viewed
                showConsultationIndicator(selectedTab);
            }
        });

        function showConsultationIndicator(tabNumber) {
            // Add a visual indicator to show which consultation context we're in
            const indicator = document.createElement('div');
            indicator.innerHTML = `
                <div style="position: fixed; top: 10px; right: 10px; background: rgba(74, 108, 47, 1); color: white; 
                        padding: 8px 12px; border-radius: 4px; font-size: 12px; z-index: 1000;">
                    Viewing: Consultation ${tabNumber}
                </div>
            `;
            document.body.appendChild(indicator);
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                indicator.remove();
            }, 3000);
        }
    </script>
</x-app-layout>