@php
    use App\Support\PeSchema;
    $section = PeSchema::fingerNails();
    $values = $physicalExamData['finger_nails'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />