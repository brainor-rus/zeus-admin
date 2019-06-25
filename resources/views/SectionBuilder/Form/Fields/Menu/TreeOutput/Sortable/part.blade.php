@foreach($elementsTree as $node)
    @if($node->isRoot())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                @if(count($node->children)>0)
                    <a class="btn btn-default" style="padding: 2px 8px;" role="button" data-toggle="collapse" href="#collapse_{{$node->id}}"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                @endif
                {{ $node->title }}
                <button class="btn btn-outline-secondary edit_tree_element" style="padding: 2px;"
                    data-element-id="{{ $node->id }}"
                    data-element-title="{{ $node->title }}"
                    data-element-slug="{{ $node->slug }}"
                    data-element-url="{{ $node->url }}"
                    data-element-description="{{ $node->description }}"
                ><i class="fas fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="Изменить"></i></button>
                <button class="btn btn-outline-secondary add_tree_element" data-target="#add_tree_element_modal" data-tree-type="before" data-tree-neighbor="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Вставить ДО"><i class="far fa-arrow-alt-circle-up"></i></button>
                <button class="btn btn-outline-secondary add_tree_element" data-target="#add_tree_element_modal" data-tree-type="after" data-tree-neighbor="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Вставить ПОСЛЕ"><i class="far fa-arrow-alt-circle-down"></i></button>
            </span>
            <div id="collapse_{{ $node->id }}" data-parent-id="{{ $node->id }}" class="panel-collapse collapse">
                <ul class="sortable">
                    @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.part', ['elementsTree' => $node->children])
                </ul>
            </div>
        </li>
    @elseif($node->isLeaf())
        <li class="ui-state-default" id="{{ $node->id }}">
            <span class="sortable-li-text">
                {{ $node->title }}
                <button class="btn btn-outline-secondary edit_tree_element" style="padding: 2px;"
                        data-element-id="{{ $node->id }}"
                        data-element-title="{{ $node->title }}"
                        data-element-slug="{{ $node->slug }}"
                        data-element-url="{{ $node->url }}"
                        data-element-description="{{ $node->description }}"
                ><i class="fas fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="Изменить"></i></button>
                <button class="btn btn-outline-secondary add_tree_element" data-target="#add_tree_element_modal" data-tree-type="before" data-tree-neighbor="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Вставить ДО"><i class="far fa-arrow-alt-circle-up"></i></button>
                <button class="btn btn-outline-secondary add_tree_element" data-target="#add_tree_element_modal" data-tree-type="after" data-tree-neighbor="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Вставить ПОСЛЕ"><i class="far fa-arrow-alt-circle-down"></i></button>
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
                {{ $node->title }}
            </span>
            <div id="collapse_{{ $node->id }}"  data-parent-id="{{ $node->id }}" class="panel-collapse collapse">
                <ul class="sortable">
                    @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.part', ['elementsTree' => $node->children])
                </ul>
            </div>
        </li>
    @endif
@endforeach