@php
    use App\Support\PeSchema;
    $section = PeSchema::nervousSystem();
    $physicalExamData = $physicalExamData ?? [];
@endphp

<x-pe.section
    :section="$section"
    :values="old('nervous_system', $physicalExamData['nervous_system'] ?? [])"
    namePrefix="nervous_system"
/>
