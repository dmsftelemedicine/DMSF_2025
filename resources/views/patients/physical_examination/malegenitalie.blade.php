@php
    use App\Support\PeSchema;
    $section = PeSchema::maleGenitalia();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('male_genitalia', $physicalExamData['male_genitalia'] ?? [])"
    namePrefix="male_genitalia"
/>
