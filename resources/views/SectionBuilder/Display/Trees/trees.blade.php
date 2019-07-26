<div class="row pb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row w-100 align-items-center">
                    <div class="col-auto">
                        @if($firedSection->isCreatable())
                            <a @click.prevent="$emit('redirectTo',$event)" href="{{ Request::url() }}/create" class="btn btn-primary">Создать</a>
                        @endif
                    </div>
                    <div class="col">
                        {!! $nav !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @include('zeusAdmin::SectionBuilder.Display.Trees.Sortable.main')
    </div>
</div>

{{--<div class="table-responsive tiles-table br-display" data-delete-redirect="{{ $pluginData['redirectUrl'] ?? null }}" data-section-path="{{ $pluginData['sectionPath'] ?? null }}">--}}
    {{--<table class="table">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--@foreach($elements as $element)--}}
                {{--<th scope="col">{{ $element->getLabel() }}</th>--}}
            {{--@endforeach--}}
            {{--<th></th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@foreach($fields as $field)--}}
            {{--<tr>--}}
                {{--@foreach($elements as $element)--}}
                    {{--<td scope="col">--}}
                        {{--@if(!$field[$element->getName()] instanceof Countable)--}}
                            {{--{!! $field[$element->getName()] !!}--}}
                        {{--@else--}}
                            {{--@php--}}
                                {{--$path = explode('.', $element->getName());--}}
                                {{--$name = end($path);--}}
                            {{--@endphp--}}
                            {{--@foreach($field[$element->getName()] as $value)--}}
                                {{--<span class="badge badge-info text-white">{!! $value->{$name} !!}</span>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</td>--}}
                {{--@endforeach--}}
                {{--<td class="text-right">--}}
                    {{--@if($firedSection->isEditable())--}}
                        {{--<a @click.prevent="$emit('redirectTo',$event)" href="{{ parse_url(Request::url(), PHP_URL_PATH) . '/' . $field['brRowId'] . '/edit' }}" class="text-success">Ред.</a>--}}
                    {{--@endif--}}
                    {{--@if($firedSection->isDeletable())--}}
                        {{--<button @click="$emit('showDeleteModal',$event)" type="button" class="delete-btn text-danger bg-transparent border-0" data-delete-link="{{ Request::url() . '/' . $field['brRowId'] . '/delete' }}">Удал.</button>--}}
                    {{--@endif--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}
{{--</div>--}}
