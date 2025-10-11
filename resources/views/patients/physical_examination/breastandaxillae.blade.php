@php
    use App\Support\PeSchema;
    $section = PeSchema::breastAxillae();
    $values = $physicalExamData['breast_axillae'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
