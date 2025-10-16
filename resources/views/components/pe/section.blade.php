@props([
  'section',                 // array from PeSchema::generalSurvey()
  'values' => [],            // old('pe.general_survey', $model->pe_payload['general_survey'] ?? [])
  'namePrefix' => 'pe'       // root name
])

@php
  $secKey = $section['key'];
  $rows   = $section['rows'] ?? [];
  $ns     = "{$namePrefix}.{$secKey}";
@endphp

<div class="card h-100" data-pe-section="{{ $secKey }}">
  <div class="card-header bg-light py-2">
    <div class="d-flex justify-content-between align-items-center">
      <h6 class="mb-0">
        <i class="fa-solid fa-person me-2"></i>{{ $section['title'] }}
      </h6>
      <div class="d-flex gap-1">
        <button type="button" class="btn btn-sm btn-success" data-pe-action="check-all-normal">
          <i class="fas fa-check-double me-1"></i>Reset to Normal
        </button>
      </div>
    </div>
  </div>

  <div class="card-body py-2">
    <div class="table-responsive">
      <table class="table table-bordered align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th style="width:30%">Category</th>
            <th style="width:35%">Normal</th>
            <th style="width:35%">Abnormal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($rows as $row)
            <x-pe.row
              :sectionKey="$secKey"
              :row="$row"
              :values="data_get($values, $row['key'], [])"
              :namePrefix="$namePrefix"
            />
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
.card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.card:hover {
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}
.form-check-label {
    font-size: 0.95rem;
    line-height: 1.2;
}
.card-body {
    max-height: 350px;
    overflow-y: auto;
}
</style>
