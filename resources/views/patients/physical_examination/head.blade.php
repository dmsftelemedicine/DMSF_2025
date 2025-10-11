@php
    use App\Support\PeSchema;
    $section = PeSchema::head();
    $values = $physicalExamData['head'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />