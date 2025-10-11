@php
    use App\Support\PeSchema;
    $section = PeSchema::femaleGenitalia();
    $values = $physicalExamData['female_genitalia'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
