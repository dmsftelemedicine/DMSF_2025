@php
    use App\Support\PeSchema;
    $section = PeSchema::femaleGenitalia();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('female_genitalia', $physicalExamData['female_genitalia'] ?? [])"
    namePrefix="female_genitalia"
/>
