@php
    use App\Support\PeSchema;
    $section = PeSchema::backPosture();
    $values = $physicalExamData['back_posture'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />



