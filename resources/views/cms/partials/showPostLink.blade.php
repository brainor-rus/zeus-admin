@if(isset($cur_page))
    <div class="text-right">
        <a href="{{ $cur_page['url'] }}" target="_blank" class="btn btn-outline-success">Просмотреть</a>
        <hr>
    </div>
@endif