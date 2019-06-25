<div class="modal fade" id="delete_tree_element_modal" tabindex="-1" role="dialog" aria-labelledby="deleteTreeElementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="delete-element-form" method="post" action="/api/tree-elements/menu/delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTreeElementModalLabel">Удалить элемент</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="menu_id_input" type="hidden" hidden="hidden" name="menu_id" value="{{$id}}">
                    <input id="tree_element_input" type="hidden" hidden="hidden" name="element_id" value="null">
                    <p>Вы уверены, что хотите удалить этот элемент?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger tree-element-delete-btn">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>