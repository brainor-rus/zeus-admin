<div class="form-group">
    @if(empty($relatedName))
        <label for="input_{{ $name }}">{{ $label }} </label>
    @endif
    <div class="dropzone-gallery border p-5 text-center {{ isset($classes) ? implode($classes, ' ') : '' }}"
         {{ isset($dataAttributes) ? implode($dataAttributes, ' ') : '' }}
         @if(empty($relatedName)) id="input_{{ $name }}" @endif
         data-name="{{ $name }}"
         data-dropzone-url="{{ $url }}">
         Перетащите изображения..
    </div>
    <div>
        {!! $helpBlock !!}
    </div>
    <div class="row mt-3" id="dropzone-photo-preview-input_{{ $id }}">
        @if(isset($model->zaGalleryImages))
            @foreach($model->zaGalleryImages()->withPivot('default')->get() as $photo)
                <input type="hidden" class="preloaded-photos" @if($photo->pivot->default) data-default @endif data-uuid-preload="{{ $photo->uuid }}" value="{{ url($photo->base_url . '.' . $photo->extension) }}">
                <input type="hidden" data-uuid="{{ $photo->uuid }}" name="zagallery[images][]" value="{{ $photo->uuid }}">
            @endforeach
        @endif
    </div>
</div>