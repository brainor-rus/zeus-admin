<?php

namespace Zeus\Admin\Cms\Sections;

use Zeus\Admin\Cms\Models\ZeusAdminTerm;
use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Illuminate\Http\Request;

class ZeusAdminTerms extends Section
{
    protected $title = 'Рубрики';
    protected $model = 'Zeus\Admin\Cms\Models\ZeusAdminTerm';

    public function isCheckAccess(): bool
    {
        return config('zeusAdmin.cms_terms_check_access') ?? false;
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

        return $display->setScopes(['categories']);
    }

    public static function onCreate()
    {
        return self::onEdit(null);
    }

    public static function onEdit($id)
    {
        $pluginsFields = app()['PluginsData']['CmsData']['Terms']['EditField'] ?? [];

        $terms_tree = ZeusAdminTerm::where('type', 'category')->get()->toTree()->toArray();
        $cur_term = $id ? ZeusAdminTerm::with('ancestors')->where('id', $id)->first()->toArray() : null;
        $termsTreeView = view('zeusAdmin::cms.partials.termsTree')->with(compact('terms_tree', 'cur_term'));

        $brFields = [
            '0.01' => FormField::input('title', 'Название')->setRequired(true),
            '0.02' => FormField::input('slug', 'Ярлык (необязательно)'),
            '0.03' => FormField::textarea('description', 'Описание'),
            '0.04' => FormField::custom($termsTreeView),
            '99.99' => FormField::hidden('type')->setValue("category"),
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);

        ksort($mergedFields);

        $form = Form::panel([
            FormColumn::column($mergedFields),
        ]);

        return $form;
    }

    public function afterSave(Request $request, $model = null)
    {
        if($request->has('parent_id')) {
            $parent = ZeusAdminTerm::where('id', $request->parent_id)->first();
            $parent->appendNode($model);
        } else {
            $model->saveAsRoot();
        }
    }
}