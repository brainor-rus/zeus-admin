<div class="row pt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </li>
                    <li class="list-inline-item">
                        <a @click.prevent="$emit('redirectTo',$event)" href="{{ $pluginData['redirectUrl'] ?? '/'.config("zeusAdmin.admin_url").'/' . $sectionName}}" class="btn btn-secondary">Отмена</a>
                    </li>
                    @if($action === 'edit' && $copyable)
                        <li class="list-inline-item text-muted">|</li>
                        <li class="list-inline-item">
                            @if($copyable)
                                <a href="{{ route('zeusAdmin.section.create.form', ['section' => $sectionName, 'copy' => $id]) }}"
                                   target="_blank"
                                >
                                    <i class="fas fa-link"></i> Создать копию
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
