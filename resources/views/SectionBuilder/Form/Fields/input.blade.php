<div class="form-group">
    @if(empty($relatedName))
        <label for="input_{{ $name }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <input type="{{$type ?? 'text'}}"
           class="form-control"
           @if(empty($relatedName)) id="input_{{ $name }}" @endif
           name="{{ $relatedName ?? $name }}"
           value="{{ $value ?? null }}"
           @if($required) required @endif
           @if($readonly) readonly @endif
           @if(!empty($pattern)) pattern="{{ $pattern }}" @endif
           placeholder="{{ $placeholder ?? null }}">
    {!! $helpBlock !!}
</div>