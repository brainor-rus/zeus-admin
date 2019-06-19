<div class="form-group date">
    @if(empty($relatedName))
        <label for="input_{{ $name }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif </label>
    @endif
    <input
           @if(empty($relatedName)) id="input_{{ $name }}" @endif
           @if($formIgnore)
             data-name="{{ $relatedName ?? $name }}"
           @else
             name="{{ $relatedName ?? $name }}"
           @endif
           type="text"
           class="form-control datepicker"
           value="{{ $value }}"
           autocomplete="off"
           data-datepicker-format="{{ $format }}"
           data-datepicker-language="{{ $language }}"
           data-datepicker-todayBtn="{{ $todayBtn }}"
           data-datepicker-clearBtn="{{ $clearBtn }}"
           data-datepicker-minuteStep="{{ $minuteStep }}"
           @if($readonly) disabled @endif
           @if($required) {{ $formIgnore ? 'data-required' : 'required' }} @endif>
    {!! $helpBlock !!}
</div>