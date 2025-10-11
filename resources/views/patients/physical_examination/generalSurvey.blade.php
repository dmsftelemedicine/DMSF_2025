@php
    use App\Support\PeSchema;
    $section = PeSchema::generalSurvey();
    $values = $physicalExamData['general_survey'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
