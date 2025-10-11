@php
    use App\Support\PeSchema;
    $section = PeSchema::neck();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('neck', $physicalExamData['neck'] ?? [])"
    namePrefix="neck"
/>