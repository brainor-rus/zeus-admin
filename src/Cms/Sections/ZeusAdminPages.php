<?php

namespace Zeus\Admin\Cms\Sections;

use Zeus\Admin\Cms\Models\ZeusAdminPost;
use Zeus\Admin\Cms\Models\ZeusAdminTag;
use Zeus\Admin\Cms\Models\ZeusAdminTerm;
use Zeus\Admin\Cms\Helpers\TemplatesHelper;
use Zeus\Admin\Cms\Helpers\CustomFieldsHelper;
use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Filter\Types\BaseType\FilterType;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ZeusAdminPages extends Section
{
    protected $title = 'Страницы';
    protected $model = 'Zeus\Admin\Cms\Models\ZeusAdminPost';


    public static function onDisplay(){
        $pluginsFields = app()['PluginsData']['CmsData']['Pages']['DisplayField'] ?? [];
        $brFields = [
            '0.01' => Column::text('id', '#')->setSortable(true),
            '0.02' => Column::link('title', 'Заголовок')->setSortable(true),
            '0.03' => Column::text('description', 'Краткое описание'),
            '0.04' => Column::text('tags.title', 'Метки'),
            '0.05' => Column::text('categories.title', 'Рубрики'),
            '0.06' => Column::text('status', 'Статус')->setSortable(true),
            '0.07' => Column::text('created_at', 'Дата создания')->setSortable(true),
            '0.08' => Column::text('published_at', 'Дата публикации')->setSortable(true),
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);
        ksort($mergedFields);

        $display = Display::table($mergedFields)->setPagination(10);
        
        $filter = [
          FilterType::text('id', '#'),
          FilterType::text('title', 'Заголовок'),
          null,
          FilterType::select('tags.title')->setOptions(
              ZeusAdminTerm::where('type', 'tag')->pluck('title', 'id')->toArray()
          ),
        FilterType::select('categories.title')->setOptions(
            ZeusAdminTerm::where('type', 'category')->pluck('title', 'id')->toArray()
        ),
          null,
          null,
          null,
        ];

        $display->setFilter($filter);

        return $display->setScopes(['pages']);
    }

    public static function onCreate()
    {
        return self::onEdit(null);
    }

    public static function onEdit($id)
    {
        $pluginsFieldsLeft = app()['PluginsData']['CmsData']['Pages']['EditField']['Left'] ?? [];
        $pluginsFieldsRight = app()['PluginsData']['CmsData']['Pages']['EditField']['Right'] ?? [];

        $templates = TemplatesHelper::getTemplates('page');
        $pages_tree = ZeusAdminPost::where('type', 'page')->orderBy('title')->get()->toTree()->toArray();
        $cur_page = $id ? ZeusAdminPost::with('ancestors')->where('id', $id)->first()->toArray() : null;
        $pagesTreeView = view('zeusAdmin::cms.partials.pagesTree')->with(compact('pages_tree', 'cur_page'));

        $brFieldsLeft = [
            '0.01' => FormField::input('title', 'Заголовок')->setRequired(true),
            '0.02' => FormField::textarea('description', 'Краткое описание')->setRows(3),
            '0.03' => FormField::input('slug', 'Слаг (необязательно)'),
            '0.04' => FormField::input('url', 'Ссылка ("." для автогенерации)')
                ->setRequired(true)
                ->setValue('.'),
            '0.05' => FormField::multiselect('tags', 'Метки')
                ->setModelForOptions(ZeusAdminTag::class)
                ->setQueryFunctionForModel(
                    function ($query) {
                        return $query->tags();
                    }
                )
                ->setDisplay('title'),
            '0.06' => FormField::multiselect('categories', 'Рубрики')
                ->setModelForOptions(ZeusAdminTerm::class)
                ->setQueryFunctionForModel(
                    function ($query) {
                        return $query->categories();
                    }
                )
                ->setDisplay('title'),
            '0.07' => FormField::custom(view('zeusAdmin::SectionBuilder.Form.Fields.InsertMedia.insertMedia')->with('id','input_content')),
            '0.08' => FormField::wysiwyg('content', 'Содержимое'),
        ];
        $customFieldsConditions = [
            'condition_parameter'=>'post_type',
            'condition_value'=>'page',
            'customable_type'=>'Zeus\Admin\Cms\Models\ZeusAdminPost',
            'customable_id'=>$id
        ];
        $customFieldGroups = CustomFieldsHelper::getCustomFieldGroupsByCondition($customFieldsConditions);
        if($customFieldGroups->count()>0){
            foreach ($customFieldGroups as $group){
                foreach ($group->fields as $field){
                    $brFieldsLeft[$field->order] = FormField::{$field->type}('custom_fields['.$field->id.']',$field->name);
                    if($field->data->count()>0){
                        $brFieldsLeft[$field->order] = $brFieldsLeft[$field->order]->setValue($field->data[0]->value);
                    }
                }
            }
        }
        $brFieldsRight = [
            '0.001' => FormField::custom(view('zeusAdmin::cms.partials.showPostLink')->with(compact('cur_page'))),
            '0.01' => FormField::select('status', 'Статус')
                ->setOptions([
                    'draft' => 'Черновик',
                    'published' => 'Опубликовано'
                ])
                ->setDefaultSelected('published')
                ->setRequired(true)
                ->setHelpBlock('<a href="#">Статус страницы</a>'),
            '0.02' => FormField::select('template', 'Шаблон')
                ->setOptions($templates),
            '0.03' => FormField::custom($pagesTreeView),
            '0.04' => FormField::select('comment_on', 'Комментарии')
                ->setOptions([
                    0 => 'Запрещены',
                    1 => 'Разрешены'
                ])
                ->setDefaultSelected(0)
                ->setRequired(true),
            '0.05' => FormField::datepicker('published_at', 'Дата публикации')
                ->setLanguage('ru')
                ->setFormat('yyyy-mm-dd hh:ii:ss')
                ->setClearBtn(true)
                ->setTodayBtn(true)
                ->setValue(Carbon::now())
                ->setRequired(true),
            '0.06' => FormField::custom(view('zeusAdmin::cms.partials.thumb')->with(compact('cur_page'))),
            '99.98' => FormField::hidden('thumb'),
            '99.99' => FormField::hidden('type')->setValue("page"),
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

    public function afterSave(Request $request, $model = null)
    {
        $terms = [];
        $terms = array_merge($request->tags ?? [], $terms);
        $terms = array_merge($request->categories ?? [], $terms);
        $model->terms()->detach();
        $model->terms()->attach($terms);

        if($request->url == '.')
        {
            $model->url = $model->default_url;
            $model->save();
        }

        if($request->has('parent_id')) {
            $parent = ZeusAdminPost::where('id', $request->parent_id)->first();
            $parent->appendNode($model);
        } else {
            $model->saveAsRoot();
        }
    }
}