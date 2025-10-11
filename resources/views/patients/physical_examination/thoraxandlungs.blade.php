@php
    use App\Support\PeSchema;
    $section = PeSchema::thoraxLungs();
    $values = $physicalExamData['thorax_lungs'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />




