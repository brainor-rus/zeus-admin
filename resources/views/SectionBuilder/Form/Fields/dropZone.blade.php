<div class="form-group">
    @if(empty($relatedName))
        <label for="input_{{ $name }}">{{ $label }} </label>
    @endif
    <div class="dropzone"
         @if(empty($relatedName)) id="input_{{ $name }}" @endif
         data-dropzone-url="{{ $url }}"></div>
    {!! $helpBlock !!}
</div>