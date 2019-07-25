@foreach($elementsTree as $node)
    @if($node->isRoot())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                @if(count($node->children)>0)
                    <a class="btn btn-default" style="padding: 2px 8px;" role="button" data-toggle="collapse" href="#collapse_{{$node->id}}"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                @endif
                {{ $node->title }}
                @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.controls-buttons', ['node' => $node])
            </span>
            <div id="collapse_{{ $node->id }}" data-parent-id="{{ $node->id }}" class="collapse show">
                <ul class="sortable" style="min-width: 100%; min-height: 5px;">
                    @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.part', ['elementsTree' => $node->children])
                </ul>
            </div>
        </li>
    @elseif($node->isLeaf())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                {{ $node->title }}
                @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.controls-buttons', ['node' => $node])
            </span>
            <div id="collapse_{{ $node->id }}"  data-parent-id="{{ $node->id }}" class="collapse show">
                <ul class="sortable">
                </ul>
            </div>
        </li>

    @elseif (count($node->children))
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                <a class="btn btn-default" style="padding: 2px 8px;" role="button" data-toggle="collapse" href="#collapse_{{$node->id}}" aria-expanded="true" aria-controls="collapse_{{$node->id}}"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                {{ $node->title }}
                @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.controls-buttons', ['node' => $node])
            </span>
            <div id="collapse_{{ $node->id }}"  data-parent-id="{{ $node->id }}" class="collapse show">
                <ul class="sortable">
                    @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.part', ['elementsTree' => $node->children])
                </ul>
            </div>
        </li>
    @endif
@endforeach