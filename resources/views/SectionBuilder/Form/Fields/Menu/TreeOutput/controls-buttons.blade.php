<button type="button" class="btn btn-outline-secondary edit_tree_element" style="padding: 2px;"
        data-element-id="{{ $node->id }}"
        data-element-title="{{ $node->title }}"
        data-element-slug="{{ $node->slug }}"
        data-element-url="{{ $node->url }}"
        data-element-description="{{ $node->description }}"
><i class="fas fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="Изменить"></i></button>
<button type="button" class="btn btn-outline-secondary add_tree_element" data-target="#add_tree_element_modal" data-tree-type="before" data-tree-neighbor="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Вставить ДО"><i class="far fa-arrow-alt-circle-up"></i></button>
<button type="button" class="btn btn-outline-secondary add_tree_element" data-target="#add_tree_element_modal" data-tree-type="after" data-tree-neighbor="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Вставить ПОСЛЕ"><i class="far fa-arrow-alt-circle-down"></i></button>
<button type="button" class="btn btn-outline-secondary add_tree_element" data-target="#add_tree_element_modal" data-tree-type="inside" data-tree-parent="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Вставить ВНУТРЬ"><i class="fas fa-plus"></i></button>
<button type="button" class="btn btn-outline-secondary delete_tree_element" data-target="#delete_tree_element_modal" data-tree-element="{{ $node->id }}" style="padding: 2px;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fas fa-trash"></i></button>
