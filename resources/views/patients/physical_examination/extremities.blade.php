@php
    use App\Support\PeSchema;
    $section = PeSchema::extremities();
    $values = $physicalExamData['extremities'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
