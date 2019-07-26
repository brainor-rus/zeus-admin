@if(isset($data) && count($data) > 0)
    <ul class="sortable">
        @include('zeusAdmin::SectionBuilder.Display.Tree.Sortable.part')
    </ul>
@else
    <button class="btn btn-outline-success add_tree_element" data-target="#add_tree_element_modal" data-tree-type="root" data-tree-neighbor="null">Добавить первый элемент</button>
@endif

