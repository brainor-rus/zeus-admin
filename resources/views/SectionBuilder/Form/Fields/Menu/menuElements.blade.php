<div class="form-group">
    <label for="input_menu_elements">Элементы меню</label>
    <div class="sortable-wrapper" id="root" data-parent-id="root">
        @if(count($elementsTree)>0)
            @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')
        @else
            @if(isset($id))
                <button type="button" class="btn btn-outline-success add_tree_element" data-target="#add_tree_element_modal" data-tree-type="root" data-tree-neighbor="null">Добавить первый элемент</button>
            @else
                <p>Сначала сохраните меню</p>
            @endif
        @endif
    </div>
    @if(isset($id))
        @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Modals.create')
        @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Modals.edit')
        @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Modals.delete')
        @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Modals.error')
    @endif
</div>