@props(['sectionKey','row','values'=>[],'namePrefix'=>'pe'])

@php
  $rowKey = $row['key'];
  $base   = "{$namePrefix}[{$sectionKey}][{$rowKey}]";
  $oldDot = "{$namePrefix}.{$sectionKey}.{$rowKey}";
  
  // Default to Normal checked (assume normal unless explicitly abnormal)
  $hasExistingData = !empty(old("{$oldDot}.abnormal")) || !empty(data_get($values,'abnormal'));
  $normalChecked = old("{$oldDot}.normal", data_get($values,'normal', $hasExistingData ? '0' : '1')) == '1';
  
  $abnormals     = $row['options'] ?? [];
  $checkedSet    = collect(old("{$oldDot}.abnormal", data_get($values,'abnormal', [])))->values()->all();
  $otherChecked  = in_array('other', $checkedSet);
  $otherText     = old("{$oldDot}.other_text", data_get($values,'other_text', ''));
@endphp

<tr data-pe-row="{{ $sectionKey }}::{{ $rowKey }}">
  <td><strong>{{ $row['title'] }}</strong></td>

  {{-- Normal --}}
  <td>
    <div class="form-check">
      <input
        class="form-check-input"
        type="checkbox"
        name="{{ $base }}[normal]"
        id="{{ $namePrefix }}_{{ $sectionKey }}_{{ $rowKey }}_normal"
        value="1"
        data-pe-normal
        {{ $normalChecked ? 'checked' : '' }}
      >
      <label class="form-check-label" for="{{ $namePrefix }}_{{ $sectionKey }}_{{ $rowKey }}_normal">
        {{ $row['normal_label'] }}
      </label>
    </div>
  </td>

  {{-- Abnormal --}}
  <td>
    <div class="row g-2" data-pe-abnormal-group>
      @foreach($abnormals as $opt)
        @php
          $isOther = !empty($opt['is_other']);
          $id = "{$namePrefix}_{$sectionKey}_{$rowKey}_opt_{$opt['key']}";
          $checked = in_array($opt['key'], $checkedSet);
        @endphp
        <div class="col-12 d-flex align-items-start">
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              value="{{ $opt['key'] }}"
              name="{{ $base }}[abnormal][]"
              id="{{ $id }}"
              data-pe-abnormal
              data-needs-detail="{{ !empty($opt['needs_detail']) ? '1':'0' }}"
              data-is-other="{{ $isOther ? '1':'0' }}"
              {{ $checked ? 'checked' : '' }}
            >
            <label class="form-check-label ms-2" for="{{ $id }}">
              {{ $opt['label'] }}
              @if(!empty($opt['help']))
                <span tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $opt['help'] }}" style="cursor:pointer;">
                  <i class="fas fa-info-circle text-info ms-1"></i>
                </span>
              @endif
            </label>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Container where detail inputs are injected lazily --}}
    <div class="mt-2" data-pe-detail-container>
      {{-- Server-side rehydration for already-checked options (keeps old() working) --}}
      @foreach($abnormals as $opt)
        @php
          $needs = !empty($opt['needs_detail']);
          $key   = $opt['key'];
          $val   = old("{$oldDot}.detail.$key", data_get($values,"detail.$key",''));
        @endphp
        @if($needs && in_array($key, $checkedSet))
          <div class="mb-1" data-pe-detail for-option="{{ $key }}">
            <input type="text"
              class="form-control form-control-sm"
              name="{{ $base }}[detail][{{ $key }}]"
              value="{{ $val }}"
              placeholder="Additional info for '{{ $opt['label'] }}'">
          </div>
        @endif
      @endforeach

      @if($otherChecked)
        <div class="mb-1" data-pe-other-text>
          <input type="text"
            class="form-control form-control-sm"
            name="{{ $base }}[other_text]"
            value="{{ $otherText }}"
            placeholder="Please specify...">
        </div>
      @endif
    </div>

    {{-- Template cloned by JS when an option is checked (saves DOM on load) --}}
    <template data-pe-detail-template>
      <div class="mb-1" data-pe-detail>
        <input type="text" class="form-control form-control-sm" name="" value="" placeholder="">
      </div>
    </template>
  </td>
</tr>
