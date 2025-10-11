@php
    use App\Support\PeSchema;
    $section = PeSchema::ear();
    $values = $physicalExamData['ear'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />



