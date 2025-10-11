@php
    use App\Support\PeSchema;
    $section = PeSchema::maleGenitalia();
    $values = $physicalExamData['male_genitalia'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
