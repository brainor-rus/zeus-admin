<div class="form-group">
    <input type="hidden"
           class="form-control"
           @if(empty($relatedName)) id="input_{{ $name }}" @endif
           name="{{ $relatedName ?? $name }}"
           value="{{ $value ?? null }}">
</div>