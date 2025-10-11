@php
    use App\Support\PeSchema;
    $section = PeSchema::skinHair();
    $values = $physicalExamData['skin_hair'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
    