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
                    <input id="tree_parent_input" type="hidden" hidden="hidden" name="parent_id" value="null">

                    <div class="form-group">
                        <label for="new-tree-element-title">Заголовок <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="new-tree-element-title" name="title" aria-describedby="new-tree-element-title-help" placeholder="Заголовок" required>
                        <small id="new-tree-element-title-help" class="form-text text-muted">Отображается в качестве текста пункта меню</small>
                    </div>

                    <div class="form-group">
                        <label for="new-tree-element-slug">Слаг</label>
                        <input type="text" class="form-control" id="new-tree-element-slug" name="slug" aria-describedby="new-tree-element-slug-help" placeholder="Слаг">
                        <small id="new-tree-element-slug-help" class="form-text text-muted">Необязательное поле. Используется в технических целях</small>
                    </div>

                    <div class="form-group">
                        <label for="new-tree-element-url">Url <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="new-tree-element-url" name="url" aria-describedby="new-tree-element-url-help" placeholder="Url" required>
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