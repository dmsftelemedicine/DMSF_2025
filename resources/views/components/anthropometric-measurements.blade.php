{{-- Anthropometric Measurements Component --}}
@props([
    'tabNumber' => 1,
    'consultation' => null,
    'measurements' => null,
    'patient' => null
])

<style>
    .am-container {
        background-color: #FFFFFF; 
        border-radius: 4px; 
        border: 2px solid #F4EDEA; 
        padding: 10px; 
    }
</style>

@php
    // ensure integer tab
    $tab = isset($tabNumber) ? intval($tabNumber) : 1;

    // Resolve source for BMI/measurements (prefer explicit $measurements for this tab, fallback to $patient)
    // If $measurements is an array keyed by tabs, use that entry
    $measurementsForTab = null;
    if (isset($measurements)) {
        // if it's an array or Collection keyed by tab
        if (is_array($measurements) && array_key_exists($tab, $measurements)) {
            $measurementsForTab = $measurements[$tab];
        } elseif ($measurements instanceof \Illuminate\Support\Collection && $measurements->offsetExists($tab)) {
            $measurementsForTab = $measurements[$tab];
        } else {
            // otherwise assume $measurements is already the correct object passed into this component
            $measurementsForTab = $measurements;
        }
    }

    // Final source: prefer tab measurements, fallback to patient
    $sourceForBmi = $measurementsForTab ?? $patient ?? null;

    // BMI (tab-aware)
    $bmi = $sourceForBmi?->calculateBMI() ?? 'N/A';

    // BMI label & css class
    $bmiLabel = 'No Entry';
    $bmiClass = 'bmi-none';
    if ($bmi !== 'N/A') {
        if ($bmi < 18.5) {
            $bmiLabel = 'Underweight';
            $bmiClass = 'bmi-underweight';
        } elseif ($bmi < 25) {
            $bmiLabel = 'Healthy Weight';
            $bmiClass = 'bmi-healthy';
        } elseif ($bmi < 30) {
            $bmiLabel = 'Overweight';
            $bmiClass = 'bmi-overweight';
        } elseif ($bmi < 35) {
            $bmiLabel = 'Obesity (Class 1)';
            $bmiClass = 'bmi-obese1';
        } elseif ($bmi < 40) {
            $bmiLabel = 'Obesity (Class 2)';
            $bmiClass = 'bmi-obese2';
        } else {
            $bmiLabel = 'Obesity (Class 3)';
            $bmiClass = 'bmi-obese3';
        }
    }

    // --- WHR logic: TAB-AWARE (use $tab instead of $tabNumber for consistency) ---
    $whrData = null;

    // 1) Primary: Use patient model with tab number (use $tab consistently)
    if ($patient && method_exists($patient, 'getWHRData')) {
        try {
            $whrData = $patient->getWHRData($tab);
        } catch (\Throwable $e) {
            $whrData = null;
        }
    }

    // 2) Fallback: try tab-specific measurements object if it has WHR methods
    if (empty($whrData) && $measurementsForTab && method_exists($measurementsForTab, 'getWHRData')) {
        try {
            $whrData = $measurementsForTab->getWHRData();
        } catch (\Throwable $e) {
            $whrData = null;
        }
    }

    // 3) Fallback: try generic measurements object if passed (not array keyed by tab)
    if (empty($whrData) && isset($measurements) && !is_array($measurements) && method_exists($measurements, 'getWHRData')) {
        try {
            $whrData = $measurements->getWHRData();
        } catch (\Throwable $e) {
            $whrData = null;
        }
    }

    // 4) Final fallback: patient model without tab number (uses latest measurements)
    if (empty($whrData) && $patient && method_exists($patient, 'getWHRData')) {
        try {
            $whrData = $patient->getWHRData(); // no tab number = latest measurements
        } catch (\Throwable $e) {
            $whrData = null;
        }
    }

    // 5) Default safe value
    if (empty($whrData)) {
        $whrData = ['value' => '0', 'display' => 'No Entry', 'css_class' => 'whr-0'];
    }

    // Ensure $whrData has expected keys and normalize if object returned
    if (!is_array($whrData)) {
        if (is_object($whrData)) {
            $whrData = [
                'value' => $whrData->value ?? ($whrData->get('value') ?? '0'),
                'display' => $whrData->display ?? ($whrData->get('display') ?? 'No Entry'),
                'css_class' => $whrData->css_class ?? ($whrData->get('css_class') ?? 'whr-0'),
            ];
        } else {
            $whrData = ['value' => '0', 'display' => 'No Entry', 'css_class' => 'whr-0'];
        }
    }

    // Ensure all required keys exist with safe defaults
    $whrData = array_merge([
        'value' => '0',
        'display' => 'No Entry', 
        'css_class' => 'whr-0'
    ], $whrData);
@endphp


<div class="col-md-6 px-0 pr-1">
    <div class="am-container">
        <div class="measurement-section" id="anthropometric-section-{{ $tab }}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="border-bottom pb-2 mb-0 flex-grow-1 text-black font-extrabold uppercase">
                    <strong>Anthropometric Measurements</strong>
                </h5>
                <button class="edit-mode-btn" data-section="anthropometric" data-tab="{{ $tab }}">
                    <i class="fas fa-edit me-1"></i>Edit
                </button>
            </div>

            <div class="column">
                <div class="w-100 mb-3">
                    <p class="text-black mb-1"><strong>Height (m)</strong></p>
                    <p class="fw-bold editable-measurement" 
                    data-field="height" 
                    data-tab="{{ $tab }}" 
                    data-consultation-id="{{ $consultation?->id }}">
                        {{ $measurementsForTab?->getHeightInMeters() ?? $patient?->getHeightInMeters() ?? 'N/A' }}
                    </p>
                </div>

                <div class="w-100 mb-3">
                    <p class="text-black mb-1"><strong>Weight (kg)</strong></p>
                    <p class="fw-bold editable-measurement" 
                    data-field="weight_kg" 
                    data-tab="{{ $tab }}" 
                    data-consultation-id="{{ $consultation?->id }}">
                        {{ $measurementsForTab?->weight_kg ?? $patient?->weight_kg ?? 'N/A' }}
                    </p>
                </div>

                <div class="w-100 mb-3">
                    <p class="text-black mb-1"><strong>Waist Circumference (cm)</strong></p>
                    <p class="fw-bold editable-measurement" 
                    data-field="waist_circumference" 
                    data-tab="{{ $tab }}" 
                    data-consultation-id="{{ $consultation?->id }}">
                        {{ $measurementsForTab?->waist_circumference ?? $patient?->waist_circumference ?? 'N/A' }}
                    </p>
                </div>

                <div class="w-100 mb-3">
                    <p class="text-black mb-1"><strong>Hip Circumference (cm)</strong></p>
                    <p class="fw-bold editable-measurement" 
                    data-field="hip_circumference" 
                    data-tab="{{ $tab }}" 
                    data-consultation-id="{{ $consultation?->id }}">
                        {{ $measurementsForTab?->hip_circumference ?? $patient?->hip_circumference ?? 'N/A' }}
                    </p>
                </div>

                <div class="w-100">
                    <p class="text-black mb-1"><strong>Neck Circumference (cm)</strong></p>
                    <p class="fw-bold editable-measurement" 
                    data-field="neck_circumference" 
                    data-tab="{{ $tab }}" 
                    data-consultation-id="{{ $consultation?->id }}">
                        {{ $measurementsForTab?->neck_circumference ?? $patient?->neck_circumference ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
