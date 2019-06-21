<div class="form-group">
    @if(empty($relatedName))
        <label for="input_{{ $name }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <input type="{{$type ?? 'text'}}"
           class="form-control {{ isset($classes) ? implode($classes, ' ') : '' }}"
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