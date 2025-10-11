@php
    use App\Support\PeSchema;
    $section = PeSchema::eyes();
    $values = $physicalExamData['eyes'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
