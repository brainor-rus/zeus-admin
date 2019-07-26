@foreach($data as $node)
    {{print_r($modelPath)}}
    @if($node->isRoot())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                @if(count($node->children)>0)
                    <a class="btn btn-default" style="padding: 2px 8px;" role="button" data-toggle="collapse" href="#collapse_{{$node->id}}"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                @endif
                {{ $node->name }}
                @include('zeusAdmin::SectionBuilder.Display.Trees.controls-buttons', ['node' => $node])
            </span>
            <div id="collapse_{{ $node->id }}" data-parent-id="{{ $node->id }}" data-model-id="{{$modelPath}}" class="collapse show">
                <ul class="sortable" style="min-width: 100%; min-height: 5px;" >
                    @include('zeusAdmin::SectionBuilder.Display.Trees.Sortable.part', ['data' => $node->children])
                </ul>
            </div>
        </li>
    @elseif($node->isLeaf())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                {{ $node->name }}
                @include('zeusAdmin::SectionBuilder.Display.Trees.controls-buttons', ['node' => $node])
            </span>
            <div id="collapse_{{ $node->id }}"  data-parent-id="{{ $node->id }}" data-model-id="{{$modelPath}}" class="collapse show">
                <ul class="sortable">
                </ul>
            </div>
        </li>


    @elseif (count($node->children))
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                <a class="btn btn-default" style="padding: 2px 8px;" role="button" data-toggle="collapse" href="#collapse_{{$node->id}}" aria-expanded="true" aria-controls="collapse_{{$node->id}}"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                {{ $node->name }}
                @include('zeusAdmin::SectionBuilder.Display.Trees.controls-buttons', ['node' => $node])
            </span>
            <div id="collapse_{{ $node->id }}"  data-parent-id="{{ $node->id }}" data-model-id="{{$modelPath}}" class="collapse show">
                <ul class="sortable">
                    @include('zeusAdmin::SectionBuilder.Display.Trees.Sortable.part', ['data' => $node->children])
                </ul>
            </div>
        </li>
    @endif
    @if(isset($node->id))
        @include('zeusAdmin::SectionBuilder.Display.Trees.Modals.create')
        @include('zeusAdmin::SectionBuilder.Display.Trees.Modals.edit')
        @include('zeusAdmin::SectionBuilder.Display.Trees.Modals.delete')
        @include('zeusAdmin::SectionBuilder.Display.Trees.Modals.error')
    @endif
@endforeach

