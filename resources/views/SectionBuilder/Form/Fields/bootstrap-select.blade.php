<div class="form-group">
    <select name="{{ $name }}" id="" style="display: none">
        <option value=""></option>
    </select>
    @if(empty($relatedName))
        <label for="input_{{ $name }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <select class="form-control selectpicker bselect {{ isset($classes) ? implode($classes, ' ') : '' }}"
            {{ isset($dataAttributes) ? implode($dataAttributes, ' ') : '' }}
            @if(empty($relatedName)) id="input_{{ $name }}" @endif
            @if($formIgnore)
                data-name="{{ $relatedName ?? $name . (isset($dataAttributes) && in_array('multiple', $dataAttributes) ? '[]' : '') }}"
            @else
                name="{{ $relatedName ?? $name . (isset($dataAttributes) && in_array('multiple', $dataAttributes) ? '[]' : '') }}"
            @endif
            @if($required) {{ $formIgnore ? 'data-required' : 'required' }} @endif
            @if($readonly) readonly @endif>
            @if(isset($options))
                @unless(isset($dataAttributes) && in_array('multiple', $dataAttributes))
                    <option value="">Не задано</option>
                @endunless
                @foreach($options as $key => $option)
                    <option value="{{ $key }}"
                            @if(isset($value))
                                @if(is_array($value) && in_array($key, $value))
                                    selected
                                @elseif($key == $value)
                                    selected
                                @endif
                            @elseif($key == $defaultSelected)
                                selected
                            @endif
                    >
                        {{ $option }}
                    </option>
                @endforeach
            @endif
    </select>
    {!! $helpBlock !!}
</div>