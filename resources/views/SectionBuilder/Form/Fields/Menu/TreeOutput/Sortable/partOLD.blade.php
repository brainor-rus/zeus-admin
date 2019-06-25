


@foreach($categories_tree as $node)
    @if($node->isRoot())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                @if(count($node->children)>0)
                <a class="btn btn-default" style="padding: 2px 8px;" role="button" data-toggle="collapse" href="#collapse_{{$node->id}}"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                @endif
                {{ $node->name }}
                <a class="btn btn-default" style="padding: 2px;" href="/category/{{ $node->id }}" target="_blank">Перейти</a>
                <a class="btn btn-default" style="padding: 2px;" href="/admin/categories/{{ $node->id }}/edit" target="_blank">Изменить</a>
                <span class="info-block"> ТВК:{{ $node->offers_count }} </span>
                <span class="info-block">ТВВК:{{ $node->leafs_offers_count }} </span>
                @if($node->in_menu == true)
                    <i class="fa fa-eye" aria-hidden="true"></i>
                @else
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                @endif
            </span>
            <div id="collapse_{{ $node->id }}" data-parent-id="{{ $node->id }}" class="panel-collapse collapse">
                <ul class="sortable">
                    @include('partials.catTreeOutput.Sortable.part', ['categories_tree' => $node->children])
                </ul>
            </div>
        </li>
    @elseif($node->isLeaf())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                {{ $node->name }}
                <a class="btn btn-default" style="padding: 2px;" href="/category/{{ $node->id }}" target="_blank">Перейти</a>
                <a class="btn btn-default" style="padding: 2px;" href="/admin/categories/{{ $node->id }}/edit" target="_blank">Изменить</a>
                <span class="info-block"> ТВК:{{ $node->offers_count }} </span>
                <span class="info-block">ТВВК:{{ $node->leafs_offers_count }} </span>
                @if($node->in_menu == true)
                    <i class="fa fa-eye" aria-hidden="true"></i>
                @else
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                @endif
            </span>

        </li>
        <div id="collapse_{{ $node->id }}" data-parent-id="{{ $node->id }}">
            <ul class="sortable">
            </ul>
        </div>
    @elseif ($node->isChild())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                <a class="btn btn-default" style="padding: 2px 8px;" role="button" data-toggle="collapse" href="#collapse_{{$node->id}}" aria-expanded="true" aria-controls="collapse_{{$node->id}}"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                {{ $node->name }}
                <a class="btn btn-default" style="padding: 2px;" href="/category/{{ $node->id }}" target="_blank">Перейти</a>
                <a class="btn btn-default" style="padding: 2px;" href="/admin/categories/{{ $node->id }}/edit" target="_blank">Изменить</a>
                <span class="info-block"> ТВК:{{ $node->offers_count }} </span>
                <span class="info-block">ТВВК:{{ $node->leafs_offers_count }} </span>
                    @if($node->in_menu == true)
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    @endif
                </span>
            <div id="collapse_{{ $node->id }}"  data-parent-id="{{ $node->id }}" class="panel-collapse collapse">
                <ul class="sortable">
                    @include('partials.catTreeOutput.Sortable.part', ['categories_tree' => $node->children])
                </ul>
            </div>
        </li>
    @endif
@endforeach