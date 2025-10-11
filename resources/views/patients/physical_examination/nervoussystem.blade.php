@php
    use App\Support\PeSchema;
    $section = PeSchema::nervousSystem();
    $values = $physicalExamData['nervous_system'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
