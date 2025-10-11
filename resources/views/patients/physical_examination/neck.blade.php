@php
    use App\Support\PeSchema;
    $section = PeSchema::neck();
    $values = $physicalExamData['neck'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />