@php
    use App\Support\PeSchema;
    $section = PeSchema::fingerNails();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('finger_nails', $physicalExamData['finger_nails'] ?? [])"
    namePrefix="finger_nails"
/>