@php
    use App\Support\PeSchema;
    $section = PeSchema::extremities();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('extremities', $physicalExamData['extremities'] ?? [])"
    namePrefix="extremities"
/>
