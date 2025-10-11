@php
    use App\Support\PeSchema;
    $section = PeSchema::head();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('head', $physicalExamData['head'] ?? [])"
    namePrefix="head"
/>