<div class="form-group">
    <label for="input_menu_elements">Элементы меню</label>
    <div class="sortable-wrapper" id="root" data-parent-id="root">
        @if(count($elementsTree)>0)
            @include('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')
        @else
            @if(isset($id))
                <button class="btn btn-outline-success add_tree_element" data-target="#add_tree_element_modal" data-tree-type="root" data-tree-neighbor="null">Добавить первый элемент</button>
            @else
                <p>Сначала сохраните меню</p>
            @endif
        @endif
    </div>
    @if(isset($id))
        <div class="modal fade" id="add_tree_element_modal" tabindex="-1" role="dialog" aria-labelledby="addTreeElementModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="new-element-form" method="post" action="/api/tree-elements/menu/create">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTreeElementModalLabel">Новый элемент</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input id="menu_id_input" type="hidden" hidden="hidden" name="menu_id" value="{{$id}}">
                            <input id="tree_neighbor_input" type="hidden" hidden="hidden" name="tree_neighbor" value="null">
                            <input id="tree_type_input" type="hidden" hidden="hidden" name="tree_type" value="null">

                            <div class="form-group">
                                <label for="new-tree-element-title">Заголовок</label>
                                <input type="text" class="form-control" id="new-tree-element-title" name="title" aria-describedby="new-tree-element-title-help" placeholder="Заголовок">
                                <small id="new-tree-element-title-help" class="form-text text-muted">Отображается в качестве текста пункта меню</small>
                            </div>

                            <div class="form-group">
                                <label for="new-tree-element-slug">Слаг</label>
                                <input type="text" class="form-control" id="new-tree-element-slug" name="slug" aria-describedby="new-tree-element-slug-help" placeholder="Слаг">
                                <small id="new-tree-element-slug-help" class="form-text text-muted">Необязательное поле. Используется в технических целях</small>
                            </div>

                            <div class="form-group">
                                <label for="new-tree-element-url">Url</label>
                                <input type="text" class="form-control" id="new-tree-element-url" name="url" aria-describedby="new-tree-element-url-help" placeholder="Url">
                                <small id="new-tree-element-url-help" class="form-text text-muted">Ссылка пункта меню</small>
                            </div>

                            <div class="form-group">
                                <label for="new-tree-element-description">Описание</label>
                                <input type="text" class="form-control" id="new-tree-element-description" name="description" aria-describedby="new-tree-element-description-help" placeholder="Описание">
                                <small id="new-tree-element-description-help" class="form-text text-muted">Необязательное поле. Используется в технических целях</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="button" class="btn btn-success new-tree-element-save-btn">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_tree_element_modal" tabindex="-1" role="dialog" aria-labelledby="editTreeElementModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="new-element-form" method="post" action="/api/tree-elements/menu/edit">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTreeElementModalLabel">Изменить элемент</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input id="tree-element-id-edit-menu-id" type="hidden" hidden="hidden" name="menu_id" value="{{$id}}">
                            <input id="tree-element-id-edit" type="hidden" hidden="hidden" name="element_id" value="null">

                            <div class="form-group">
                                <label for="tree-element-title-edit">Заголовок</label>
                                <input type="text" class="form-control" id="tree-element-title-edit" name="title" aria-describedby="tree-element-title-edit-help" placeholder="Заголовок">
                                <small id="tree-element-title-edit-help" class="form-text text-muted">Отображается в качестве текста пункта меню</small>
                            </div>

                            <div class="form-group">
                                <label for="tree-element-slug-edit">Слаг</label>
                                <input type="text" class="form-control" id="tree-element-slug-edit" name="slug" aria-describedby="tree-element-slug-edit-help" placeholder="Слаг">
                                <small id="tree-element-slug-edit-help" class="form-text text-muted">Необязательное поле. Используется в технических целях</small>
                            </div>

                            <div class="form-group">
                                <label for="tree-element-url-edit">Url</label>
                                <input type="text" class="form-control" id="tree-element-url-edit" name="url" aria-describedby="tree-element-url-edit-help" placeholder="Url">
                                <small id="tree-element-url-edit-help" class="form-text text-muted">Ссылка пункта меню</small>
                            </div>

                            <div class="form-group">
                                <label for="tree-element-description-edit">Описание</label>
                                <input type="text" class="form-control" id="tree-element-description-edit" name="description" aria-describedby="tree-element-description-edit-help" placeholder="Описание">
                                <small id="tree-element-description-edit-help" class="form-text text-muted">Необязательное поле. Используется в технических целях</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="button" class="btn btn-success tree-element-edit-btn">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ajax_error_modal" tabindex="-1" role="dialog" aria-labelledby="ajaxErrorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajaxErrorModalLabel">Ошибка</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="ajax_error_modal_text"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-success tree-element-edit-btn">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>