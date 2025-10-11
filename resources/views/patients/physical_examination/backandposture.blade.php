@php
    use App\Support\PeSchema;
    $section = PeSchema::backPosture();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('back_posture', $physicalExamData['back_posture'] ?? [])"
    namePrefix="back_posture"
/>



