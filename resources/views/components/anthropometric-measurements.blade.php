{{-- Anthropometric Measurements Component --}}
@props([
    'tabNumber' => 1,
    'consultation' => null,
    'measurements' => null,
    'patient' => null
])

<div class="measurement-section" id="anthropometric-section-{{ $tabNumber }}">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="border-bottom pb-2 mb-0 flex-grow-1 text-white">Anthropometric Measurements</h5>
        <button class="edit-mode-btn" data-section="anthropometric" data-tab="{{ $tabNumber }}">
            <i class="fas fa-edit me-1"></i>Edit Mode
        </button>
    </div>
    <div class="row">
        <div class="col-4 mb-3">
            <p class="text-white mb-1">Height (m)</p>
            <p class="fw-bold editable-measurement" data-field="height" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->getHeightInMeters() ?? $patient?->getHeightInMeters() ?? 'N/A' }}
            </p>
        </div>
        <div class="col-4 mb-3">
            <p class="text-white mb-1">Weight (kg)</p>
            <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->weight_kg ?? $patient?->weight_kg ?? 'N/A' }}
            </p>
        </div>
        <div class="col-4 mb-3">
            <p class="text-white mb-1">BMI (kg/m²)</p>
            <p class="fw-bold" id="bmi-tab{{ $tabNumber }}">
                {{ $measurements?->calculateBMI() ?? $patient?->calculateBMI() ?? 'N/A' }}
            </p>
        </div>
        <div class="col-4 mb-3">
            <p class="text-white mb-1">Waist Circumference (cm)</p>
            <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->waist_circumference ?? $patient?->waist_circumference ?? 'N/A' }}
            </p>
        </div>
        <div class="col-4 mb-3">
            <p class="text-white mb-1">Hip Circumference (cm)</p>
            <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->hip_circumference ?? $patient?->hip_circumference ?? 'N/A' }}
            </p>
        </div>
        <div class="col-4 mb-3">
            <p class="text-white mb-1">Neck Circumference (cm)</p>
            <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->neck_circumference ?? $patient?->neck_circumference ?? 'N/A' }}
            </p>
        </div>
    </div>
</div>
