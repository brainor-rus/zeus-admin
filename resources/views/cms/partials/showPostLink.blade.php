@if(isset($cur_page))
    <div class="text-right">
        @php
        $url = $cur_page['url'];
        if($cur_page['type'] == 'post'){
            $url = '/' . $cur_page['categories'][0]['slug'] . $cur_page['url'];
        }
        @endphp
        <a href="{{ $url }}" target="_blank" class="btn btn-outline-success">Просмотреть</a>
        <hr>
    </div>
@endif
