{{-- Consultation Measurements Component - Combines both Anthropometric and Vital Signs --}}
@props([
    'tabNumber' => 1,
    'consultation' => null,
    'measurements' => null,
    'patient' => null,
    'consultationHeader' => null
])

@if($consultationHeader)
    <div class="consultation-header mb-3 mt-2">
        <h6 class="text-white mb-1">
            {{ $consultationHeader }}
        </h6>
    </div>
@endif

<!-- Anthropometric Measurements Section -->
<x-anthropometric-measurements 
    :tabNumber="$tabNumber" 
    :consultation="$consultation" 
    :measurements="$measurements" 
    :patient="$patient" 
/>

<!-- Vital Signs Section -->
<x-vital-signs 
    :tabNumber="$tabNumber" 
    :consultation="$consultation" 
    :measurements="$measurements" 
    :patient="$patient" 
/>
