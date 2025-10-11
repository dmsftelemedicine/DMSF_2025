@php
    use App\Support\PeSchema;
    $section = PeSchema::thoraxLungs();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('thorax_lungs', $physicalExamData['thorax_lungs'] ?? [])"
    namePrefix="thorax_lungs"
/>




