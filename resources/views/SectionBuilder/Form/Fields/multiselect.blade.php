<div class="form-group">
    <select name="{{ $name }}" id="" style="display: none">
        <option value=""></option>
    </select>
    @if(empty($relatedName))
        <label for="input_{{ $name }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <select class="form-control multiselect"
            multiple
            @if(empty($relatedName)) id="input_{{ $name }}" @endif
            @if($formIgnore)
                data-name="{{ $relatedName ?? $name . '[]' }}"
            @else
                name="{{ $relatedName ?? $name . '[]' }}"
            @endif
            @if($required) {{ $formIgnore ? 'data-required' : 'required' }} @endif
            @if($readonly) readonly @endif>
        @if(isset($options))
            @foreach($options as $key => $option)
                <option value="{{ $key }}" @if(isset($value)) @if(in_array($key, $value)) selected @endif @endif>
                    {{ $option }}
                </option>
            @endforeach
        @endif
    </select>
    {!! $helpBlock !!}
</div>