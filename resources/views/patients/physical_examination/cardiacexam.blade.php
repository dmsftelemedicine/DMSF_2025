@php
    use App\Support\PeSchema;
    $section = PeSchema::cardiacExam();
    $values = $physicalExamData['cardiac_exam'] ?? [];
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />




