<?php

namespace Zeus\Admin\Cms\Sections;

use Zeus\Admin\Cms\Models\ZeusAdminFile;
use Zeus\Admin\Cms\Models\ZeusAdminTag;
use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Display\Tiles\Columns\BaseElement\Element;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Zeus\Admin\SectionBuilder\Meta\Meta;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ZeusAdminFiles extends Section
{
    protected $title = 'Файлы';
    protected $model = 'Zeus\Admin\Cms\Models\ZeusAdminFile';

    public function isCheckAccess(): bool
    {
        return config('zeusAdmin.cms_files_check_access') ?? false;
    }

    public static function onDisplay(Request $request){
        $currentDisplay = Cookie::get('ZeusAdminFilesDisplay');

        if($request->get('display') == 'table') {
            setcookie('ZeusAdminFilesDisplay', 'table', time()+60*60*24*365);
            $currentDisplay = 'table';
        } else if($request->get('display') == 'tiles') {
            setcookie('ZeusAdminFilesDisplay', 'tiles', time()+60*60*24*365);
            $currentDisplay = 'tiles';
        }

        if($currentDisplay == 'table') {
            $pluginsFields = app()['PluginsData']['CmsData']['Files']['DisplayField'] ?? [];
            $brFields = [
                '0.01' => Column::link('id', '#'),
                '0.02' => Column::text('mime', 'Тип'),
                '0.03' => Column::text('url', 'Url'),
                '0.04' => Column::text('path', 'Путь на сервере'),
                '0.05' => Column::text('size', 'Размер'),
                '0.06' => Column::text('created_at', 'Создан'),
            ];

            $mergedFields = array_merge($pluginsFields, $brFields);
            ksort($mergedFields);

            $display = Display::table($mergedFields)->setPagination(10);
        } else {
            $pluginsFields = app()['PluginsData']['CmsData']['Files']['DisplayField'] ?? [];
            $brFields = [
                '0.01' => Element::text('url', 'Url')->setIsHeaderImage(true, false),
            ];

            $mergedFields = array_merge($pluginsFields, $brFields);
            ksort($mergedFields);

            $display = Display::tiles($mergedFields)->setPagination(10);
        }

        $display->setNav(view('zeusAdmin::cms.partials.filesNav'));

        return $display;
    }

    public static function onCreate()
    {
        $form = Form::panel([
            FormColumn::column([
                FormField::custom(view('zeusAdmin::cms.partials.backFromUploads')),
                FormField::dropZone(
                    'dropzone_files',
                    'Загрузка файлов',
                    'dropzone',
                    '/'.config('zeusAdmin.admin_url').'/cms/files/upload')
            ]),
        ]);

        return $form->setShowButtons(false);
    }

    public static function onEdit($id)
    {
        $pluginsFieldsLeft = app()['PluginsData']['CmsData']['Tags']['Files']['Edit']['Left'] ?? [];
        $pluginsFieldsRight = app()['PluginsData']['CmsData']['Tags']['Files']['Edit']['Right'] ?? [];
        $file = ZeusAdminFile::where('id', $id)->first();

        $brFieldsLeft = [
            "0.01" => FormField::input('title', 'Заголовок'),
            "0.02" => FormField::input('alt', 'Alt (для изображений)'),
            "0.03" => FormField::textarea('description', 'Описание'),
            "0.04" => FormField::bselect('tags', 'Метки')
                ->setModelForOptions(ZeusAdminTag::class)
                ->setDataAttributes([
                    'multiple', 'data-live-search="true"'
                ])
                ->setQueryFunctionForModel(
                    function ($query) {
                        return $query->tags();
                    }
                )
                ->setDisplay('title'),
        ];

        $brFieldsRight = [
            "0.01" => FormField::custom(view('zeusAdmin::cms.partials.filesInput')->with(compact('file'))),
        ];


        $mergedFieldsLeft = array_merge($pluginsFieldsLeft, $brFieldsLeft);
        $mergedFieldsRight = array_merge($pluginsFieldsRight, $brFieldsRight);

        ksort($mergedFieldsLeft);
        ksort($mergedFieldsRight);

        $form = Form::panel([
            FormColumn::column($mergedFieldsLeft, 'col-md-8 col-12'),
            FormColumn::column($mergedFieldsRight, 'col-md-4 col-12'),
        ]);

        return $form;
    }
}