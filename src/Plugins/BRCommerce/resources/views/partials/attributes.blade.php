<label for="">
    Атрибуты
</label>
<p>
    <a class="btn btn-primary" data-toggle="collapse" href="#attrAccordion" role="button" aria-expanded="false" aria-controls="attrAccordion">
        Развернуть/Свернуть
    </a>
</p>
<div class="collapse" id="attrAccordion">
    <div class="card card-body">
        <div class="row">
            <div class="col-12" id="attributesWrapper">
                @if(isset($attributes))
                    @if(count($attributes)>0)
                        @foreach($attributes as $attribute)
                            <div class="row bg-gray-light" id="attrRow_{{$attribute->id}}" style="padding-top: 10px; padding-bottom:10px">
                                <div class="col-12">
                                    <span class="btn btn-danger" id="attribute-delete-button" style="margin-bottom: 5px">Удалить атрибут</span>
                                </div>
                                <div class="col-6">
                                    <label for="attrName_{{$attribute->id}}">Название</label>
                                    <input id="attrName_{{$attribute->id}}" class="form-control" type="text" name="attributes[exist_{{$attribute->id}}][name]" value="{{$attribute->name}}">
                                </div>
                                <div class="col-6">
                                    <label for="attrValue_{{$attribute->id}}">Значение</label>
                                    <input id="attrValue_{{$attribute->id}}" class="form-control" type="text" name="attributes[exist_{{$attribute->id}}][value]" value="{{$attribute->first_value->value}}">
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="col-12">
                <hr>
                <span class="btn btn-primary" id="attribute-add-button">Добавить атрибут</span>
            </div>
        </div>
    </div>
</div>
