<div class="form-group">
    @if(empty($relatedName))
        <label for="input_{{ $name }}"
               class="@if($isSystem) system @endif"
        >
            {{ $label }} @if($isSystem) (Системное поле) <i class="fas fa-eye"></i> @endif @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif
    <input type="{{$type ?? 'text'}}"
           class="form-control {{ isset($classes) ? implode($classes, ' ') : '' }} @if($isSystem) system-toggle @endif"
           {{ isset($dataAttributes) ? implode($dataAttributes, ' ') : '' }}
           @if(empty($relatedName)) id="input_{{ $name }}" @endif
           @if($formIgnore)
            data-name="{{ $relatedName ?? $name }}"
           @else
            name="{{ $relatedName ?? $name }}"
           @endif
           value="{{ $value ?? null }}"
           @if($required) {{ $formIgnore ? 'data-required' : 'required' }} @endif
           @if($readonly) readonly @endif
           @if(!empty($pattern)) pattern="{{ $pattern }}" @endif
           placeholder="{{ $placeholder ?? null }}">
    {!! $helpBlock !!}
</div>