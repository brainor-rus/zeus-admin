<div class="modal fade" id="edit_tree_element_modal" tabindex="-1" role="dialog" aria-labelledby="editTreeElementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="edit-element-form" method="post" action="/api/tree-elements/menu/edit">
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
                    <button type="submit" class="btn btn-success tree-element-edit-btn">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>