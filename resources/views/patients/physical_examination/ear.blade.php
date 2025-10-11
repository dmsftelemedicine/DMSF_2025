@php
    use App\Support\PeSchema;
    $section = PeSchema::ear();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('ear', $physicalExamData['ear'] ?? [])"
    namePrefix="ear"
/>



