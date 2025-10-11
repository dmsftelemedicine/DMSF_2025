@php
    use App\Support\PeSchema;
    $section = PeSchema::generalSurvey();
    $values  = old('pe.general_survey', data_get($existingGeneralSurvey ?? $generalSurveyData ?? [], '', []));
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
