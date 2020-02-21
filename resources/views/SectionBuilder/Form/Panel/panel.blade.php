@if($showTopButtons)
    @include('zeusAdmin::SectionBuilder.Form.Panel.partials.action-buttons')
@endif
<form @submit.prevent="$emit('fireAction',$event)"
        id="{{ $sectionName }}-edit-form"
        action={{ $action == 'edit' ? "/".config('zeusAdmin.admin_url')."/" . $sectionName . "/" . $id . "/edit-action" : "/".config('zeusAdmin.admin_url')."/" . $sectionName . "/create-action"}}
        method="post"
        @if(isset($attributes)) {{ implode(" ", $attributes) }} @endif
>
    @csrf
    <input type="hidden" name="pluginData[deleteUrl]" value="{{ $pluginData['deleteUrl'] ?? null }}">
    <input type="hidden" name="pluginData[redirectUrl]" value="{{ $pluginData['redirectUrl'] ?? null }}">
    <input type="hidden" name="pluginData[sectionPath]" value="{{ $pluginData['sectionPath'] ?? null }}">

    <div class="row">
        @foreach($columns as $column)
            <div class="{{ $column->getClass() }}">
                @foreach($column->getFields() as $field)
                    @php
                        $currentRow = method_exists($field, 'getRow') && !empty($field->getRow()) ? $field->getRow() : $model;
                    @endphp

                    @if($field instanceof \Zeus\Admin\SectionBuilder\Form\Panel\Fields\Related)
                        @php
                            $relatedRows = $currentRow->{ $field->getName() } ?? null;
                        @endphp
                        {!! $field->render($relatedRows, $action) !!}
                    @elseif($field instanceof \Zeus\Admin\SectionBuilder\Form\Panel\Fields\Gallery)
                        {!! $field->render($model) !!}
                    @else
                        @php
                            $value = $currentRow->{ $field->getName() } ?? null;
                            if($value instanceof Countable)
                            {
                                $value = $value->pluck('id')->toArray();
                            }
                        @endphp
                        {!! $field->render($value) !!}
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
    @if($showButtons)
        @include('zeusAdmin::SectionBuilder.Form.Panel.partials.action-buttons')
    @endif
</form>
