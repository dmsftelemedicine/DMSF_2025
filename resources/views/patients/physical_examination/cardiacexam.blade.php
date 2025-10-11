@php
    use App\Support\PeSchema;
    $section = PeSchema::cardiacExam();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('cardiac_exam', $physicalExamData['cardiac_exam'] ?? [])"
    namePrefix="cardiac_exam"
/>




