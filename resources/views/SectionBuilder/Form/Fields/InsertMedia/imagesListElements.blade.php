@if(count($files)>0)
    @foreach($files as $file)
        <div class="insert-media-element ui-state-default">
            <div class="insert-media-file-wrapper">
                <img src="{{ $file->base_url }}-200x200.{{ $file->extension }}"
                     data-insert-media-id="{{ $file->id }}"
                     data-insert-media-url="{{ $file->url }}"
                     data-insert-media-base_url="{{ $file->base_url }}"
                     data-insert-media-base_name="{{ basename($file->url) }}"
                     data-insert-media-extension="{{ $file->extension }}"
                     data-insert-media-title="{{ $file->title }}"
                     data-insert-media-alt="{{ $file->alt }}"
                     title="{{ $file->title ?? basename($file->url) }}"
                >
            </div>
        </div>
    @endforeach
@endif