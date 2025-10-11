@php
    use App\Support\PeSchema;
    $section = PeSchema::skinHair();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('skin_hair', $physicalExamData['skin_hair'] ?? [])"
    namePrefix="skin_hair"
/>
    