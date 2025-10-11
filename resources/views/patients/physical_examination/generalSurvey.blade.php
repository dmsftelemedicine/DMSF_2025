@php
    use App\Support\PeSchema;
    $section = PeSchema::generalSurvey();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('general_survey', $physicalExamData['general_survey'] ?? [])"
    namePrefix="general_survey"
/>
