var attr_counter = 0;
$( "#attribute-add-button" ).click(function() {
    $( "#attributesWrapper" ).append(
        '<div class="row bg-gray-light" id="attrRow_'+attr_counter+'" style="padding-top: 10px; padding-bottom:10px">' +
        '<div class="col-12">'+
        '<span class="btn btn-danger" id="attribute-delete-button" style="margin-bottom: 5px">Удалить атрибут</span>'+
        '</div>'+
        '<div class="col-6">'+
        '<label for="attrName_'+attr_counter+'">Название</label>'+
        '<input id="attrName_'+attr_counter+'" class="form-control" type="text" name="attributes['+attr_counter+'][name]">'+
        '</div>'+
        '<div class="col-6">'+
        '<label for="attrValue_'+attr_counter+'">Значение</label>'+
        '<input id="attrValue_'+attr_counter+'" class="form-control" type="text" name="attributes['+attr_counter+'][value]">'+
        '</div>'+
        '</div>'+
        '<hr>'
    );
    attr_counter = attr_counter+1;
});
$(document).on('click', '#attribute-delete-button', function() {
    $(this).parent().parent().hide("slow");
    $(this).parent().parent().remove();
});
