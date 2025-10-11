@php
    use App\Support\PeSchema;
    $section = PeSchema::abdomen();
    $values = $physicalExamData['abdomen'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />




