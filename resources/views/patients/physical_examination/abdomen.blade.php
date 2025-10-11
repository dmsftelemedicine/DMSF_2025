@php
    use App\Support\PeSchema;
    $section = PeSchema::abdomen();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('abdomen', $physicalExamData['abdomen'] ?? [])"
    namePrefix="abdomen"
/>




