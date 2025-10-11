@php
    use App\Support\PeSchema;
    $section = PeSchema::breastAxillae();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('breast_axillae', $physicalExamData['breast_axillae'] ?? [])"
    namePrefix="breast_axillae"
/>
