<div class="form-group">
    <input type="hidden"
           class="form-control"
           @if(empty($relatedName)) id="input_{{ $name }}" @endif
           @if($formIgnore)
            data-name="{{ $relatedName ?? $name }}"
           @else
            name="{{ $relatedName ?? $name }}"
           @endif
           value="{{ $value ?? null }}">
</div>