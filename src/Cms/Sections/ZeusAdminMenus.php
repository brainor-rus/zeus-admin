<?php

namespace Zeus\Admin\Cms\Sections;

use Zeus\Admin\Cms\Helpers\TemplatesHelper;
use Zeus\Admin\Cms\Helpers\MenuHelper;
use Zeus\Admin\Cms\Models\ZeusAdminMenu;
use Zeus\Admin\Cms\Models\ZeusAdminMenuElement;
use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Zeus\Admin\SectionBuilder\Meta\Meta;

class ZeusAdminMenus extends Section
{
    protected $title = 'Меню';
    protected $model = 'Zeus\Admin\Cms\Models\ZeusAdminMenu';

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);

        if(!empty(config('zeusAdmin.menu_model'))) {
            $this->model = config('zeusAdmin.menu_model');
        }
    }

    public static function onDisplay(){
//        $meta = new Meta;
//        $meta->setStyles([
//            '' => ''
//        ])->setScripts([
//            'head' => [],
//            'body' => [
//                'test' => asset('js/test.js')
//            ]
//        ]);

        $pluginsFields = app()['PluginsData']['CmsData']['Menus']['DisplayField'] ?? [];
        $brFields = [
            '0.01' => Column::text('id', '#'),
            '0.02' => Column::link('title', 'Заголовок'),
            '0.03' => Column::text('class', 'Класс'),
            '0.03' => Column::text('description', 'Описание'),
            '0.04' => Column::text('order', 'Порядок'),
            '0.07' => Column::text('created_at', 'Дата создания'),
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);
        ksort($mergedFields);

        $display = Display::table($mergedFields)
//            ->setMeta($meta)
            ->setPagination(10);

        return $display;
    }

    public static function onCreate()
    {
        return self::onEdit(null);
    }

    public static function onEdit($id)
    {
        $meta = new Meta;
        $meta->setStyles([
            'sortable-css' => asset('packages/zeusAdmin/js/jquery-ui/sortable.css'),
        ])->setScripts([
            'head' => [],
            'body' => [
                'sortable-js' => asset('packages/zeusAdmin/js/jquery-ui/sortable.js'),
            ]
        ]);

        $pluginsFieldsLeft = app()['PluginsData']['CmsData']['Menus']['EditField']['Left'] ?? [];
        $pluginsFieldsRight = app()['PluginsData']['CmsData']['Menus']['EditField']['Right'] ?? [];

        $elementsTree = MenuHelper::getMenuTreeById($id);
        
        $brFieldsLeft = [
            '0.01' => FormField::custom(view('zeusAdmin::SectionBuilder.Form.Fields.Menu.menuElements')
                ->with(compact('elementsTree','id'))),
        ];
        $brFieldsRight = [
            '0.01' => FormField::input('title', 'Заголовок')->setRequired(true),
            '0.02' => FormField::textarea('description', 'Описание')->setRows(3),
            '0.03' => FormField::input('slug', 'Слаг (необязательно)'),
            '0.05' => FormField::input('class', 'Класс'),
            '0.06' => FormField::input('order', 'Порядок')
                ->setValue(0),
        ];

        $mergedFieldsLeft = array_merge($pluginsFieldsLeft, $brFieldsLeft);
        $mergedFieldsRight = array_merge($pluginsFieldsRight, $brFieldsRight);

        ksort($mergedFieldsLeft);
        ksort($mergedFieldsRight);

        $form = Form::panel([
            FormColumn::column($mergedFieldsLeft, 'col-md-8 col-12'),
            FormColumn::column($mergedFieldsRight, 'col-md-4 col-12'),
        ])->setMeta($meta);

        return $form;
    }

//    public function afterSave(Request $request, $model = null)
//    {
//
//    }
}