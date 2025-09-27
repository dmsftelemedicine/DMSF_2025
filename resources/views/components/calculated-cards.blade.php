{{-- Anthropometric Measurements Component --}}
@props([
    'tabNumber' => 1,
    'consultation' => null,
    'measurements' => null,
    'patient' => null
])

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

    // --- WHR logic: TAB-AWARE with gender-specific thresholds ---
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

    // 5) If no WHR data from methods, calculate manually if we have measurements
    if (empty($whrData) && $sourceForBmi) {
        $waist = null;
        $hip = null;
        
        // Try to get waist and hip measurements from the source
        if ($sourceForBmi->waist_circumference ?? null) {
            $waist = $sourceForBmi->waist_circumference;
        }
        if ($sourceForBmi->hip_circumference ?? null) {
            $hip = $sourceForBmi->hip_circumference;
        }
        
        // Calculate WHR if both measurements exist
        if ($waist && $hip && $hip > 0) {
            $whrValue = round($waist / $hip, 2);
            $whrData = ['value' => $whrValue];
        }
    }

    // 6) Apply gender-specific thresholds and determine display/CSS class
    $patientGender = $patient->gender ?? null;

    if (!empty($whrData) && isset($whrData['value'])) {
        $whrValue = (float) $whrData['value'];
        $display = 'No Entry';
        $cssClass = 'whr-0';
        
        if (!$patientGender || $patientGender === '' || $patientGender === null) {
            // Sex not specified
            if ($whrValue == 0 || $whrValue === 0.00) {
                $display = 'No Entry';
                $cssClass = 'whr-0';
            } else {
                $display = 'Sex not specified — select sex to interpret WHR';
                $cssClass = 'whr-unknown';
            }
        } elseif (strtolower($patientGender) === 'male' || strtolower($patientGender) === 'm') {
            // Asian male thresholds: Optimal < 0.90, Central obesity ≥ 0.90
            if ($whrValue == 0 || $whrValue === 0.00) {
                $display = 'No Entry';
                $cssClass = 'whr-0';
            } elseif ($whrValue < 0.90) {
                $display = 'Optimal range';
                $cssClass = 'whr-green';
            } else {
                $display = 'Increased health risk';
                $cssClass = 'whr-red';
            }
        } elseif (strtolower($patientGender) === 'female' || strtolower($patientGender) === 'f') {
            // Asian female thresholds: Optimal < 0.80, Borderline 0.80-0.84, Central obesity ≥ 0.85
            if ($whrValue == 0 || $whrValue === 0.00) {
                $display = 'No Entry';
                $cssClass = 'whr-0';
            } elseif ($whrValue < 0.80) {
                $display = 'Optimal range';
                $cssClass = 'whr-green';
            } elseif ($whrValue >= 0.80 && $whrValue < 0.85) {
                $display = 'Borderline risk';
                $cssClass = 'whr-yellow';
            } else {
                $display = 'Increased health risk';
                $cssClass = 'whr-red';
            }
        } else {
            // Unknown gender
            if ($whrValue == 0 || $whrValue === 0.00) {
                $display = 'No Entry';
                $cssClass = 'whr-0';
            } else {
                $display = 'Sex not specified — select sex to interpret WHR';
                $cssClass = 'whr-unknown';
            }
        }
        
        // Update WHR data with calculated values
        $whrData['display'] = $display;
        $whrData['css_class'] = $cssClass;
    } else {
        // 7) Default safe value when no data available
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

<!-- Calculated Cards Component -->
<div class="column col-md-12">
    {{-- BMI card --}}
    <div class="row">
        <div class="col-md-6 mb-2 px-0 pr-1">
            <div class="bmi-card-container">
                <div class="bmi-unit">
                    <h4 class="d-inline-block text-center fw-bold">
                        <span class="text-black text-3xl md:text-2xl font-extrabold uppercase">
                            <strong>BMI</strong>
                        </span>
                        (kg/m²)
                    </h4>
                    <i class="fas fa-info-circle pr-1" id="bmi-info" style="cursor: pointer;" title="BMI Categories:
                        Underweight: < 18.5
                        Normal weight: 18.5-24.9 
                        Overweight: 25-29.9
                        Obesity Class 1: 30-34.9
                        Obesity Class 2: 35-39.9
                        Obesity Class 3: ≥ 40">
                    </i>
                </div>

                <div class="bmi-card {{ $bmiClass }}" id="bmi-card-{{ $tab }}">
                    <div class="bmi-value text-black text-6xl md:text-5xl font-extrabold uppercase">
                        {{ $bmi }}
                    </div>
                    <div class="bmi-status">
                        {{ $bmiLabel }}
                    </div>
                </div>
            </div>
        </div>

        {{-- WHR card --}}
        <div class="col-md-6 mb-2 px-0 pl-1">
            <div class="whr-card-container">
                <div class="whr-unit">
                    <h4 class="d-inline-block text-center fw-bold">
                        <span class="text-black text-3xl md:text-2xl font-extrabold uppercase">
                            <strong>WHR</strong>
                        </span>
                        (waist/hip)
                    </h4>
                    <i class="fas fa-info-circle pr-1" id="whr-info" style="cursor: pointer;" title="WHR Categories (Asian Population):
                        Asian Males:
                        Optimal range: < 0.90
                        Central obesity / Increased health risk: ≥ 0.90

                        Asian Females:
                        Optimal range: < 0.80
                        Borderline risk: 0.80-0.84
                        Central obesity / Increased health risk: ≥ 0.85">
                    </i>
                </div>

                <div class="whr-card {{ $whrData['css_class'] ?? 'whr-0' }}" id="whr-card-{{ $tab }}">
                    <div class="whr-value text-black text-6xl md:text-5xl font-extrabold uppercase">
                        {{ $whrData['value'] ?? '0' }}
                    </div>
                    <div class="whr-label">
                        {{ $whrData['display'] ?? 'No Entry' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end BMI/WHR row --}}
</div>