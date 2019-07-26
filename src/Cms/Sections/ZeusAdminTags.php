<?php

namespace Zeus\Admin\Cms\Sections;

use Zeus\Admin\Cms\Models\ZeusAdminTag;
use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;

class ZeusAdminTags extends Section
{
    protected $title = 'Метки';
    protected $model = 'Zeus\Admin\Cms\Models\ZeusAdminTag';

    public function isCheckAccess(): bool
    {
        return config('zeusAdmin.cms_tags_check_access') ?? false;
    }

    public static function onDisplay(){
        $pluginsFields = app()['PluginsData']['CmsData']['Posts']['DisplayField'] ?? [];
        $brFields = [
            '0.01' => Column::text('id', '#'),
            '0.02' => Column::link('title', 'Название'),
            '0.03' => Column::text('slug', 'Ярлык'),
            '0.04' => Column::text('description', 'Описание')
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);
        ksort($mergedFields);

        $display = Display::table($mergedFields)->setPagination(10);

        return $display->setScopes(['tags']);
    }

    public static function onCreate()
    {
        return self::onEdit(null);
    }

    public static function onEdit($id)
    {
        $pluginsFields = app()['PluginsData']['CmsData']['Tags']['EditField'] ?? [];

        $tags_tree = ZeusAdminTag::where('type', 'tag')->get()->toTree()->toArray();
        $cur_tag = $id ? ZeusAdminTag::with('ancestors')->where('id', $id)->first()->toArray() : null;
        $tagsTreeView = view('zeusAdmin::cms.partials.tagsTree')->with(compact('tags_tree', 'cur_tag'));

        $brFields = [
            '0.01' => FormField::input('title', 'Название')->setRequired(true),
            '0.02' => FormField::input('slug', 'Ярлык (необязательно)'),
            '0.03' => FormField::textarea('description', 'Описание'),
            '0.04' => FormField::custom($tagsTreeView),
            '99.99' => FormField::hidden('type')->setValue("tag"),
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);

        ksort($mergedFields);

        $form = Form::panel([
            FormColumn::column($mergedFields),
        ]);

        return $form;
    }
}