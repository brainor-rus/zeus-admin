<?php

namespace Zeus\Admin\Plugins\BrainorCommerce\Sections;

use Zeus\Admin\Cms\Models\ZeusAdminTag;
use Zeus\Admin\Cms\Models\ZeusAdminTerm;
use Zeus\Admin\Plugins\BrainorCommerce\Models\BrainorCommerceOffer;
use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Display\Table\DisplayTable;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Illuminate\Http\Request;

class BrainorCommerceCategories extends Section
{
    protected $model = 'Zeus\Admin\Cms\Models\ZeusAdminTerm';
    protected $title = 'Категории';

    public static function onDisplay(){
        $display = Display::table([
            Column::text('id', '#'),
            Column::text('title', 'Название'),
            Column::text('slug', 'Ярлык'),
            Column::text('description', 'Описание')
        ])->setPagination(10);

        return $display->setScopes(['offerCategories']);
    }

    public static function onCreate()
    {
        return self::onEdit(null);
    }

    public static function onEdit($id)
    {
        $category_tree = ZeusAdminTerm::where('type', 'offer_category')->orderBy('title')->get()->toTree()->toArray();
        $cur_category = $id ? ZeusAdminTerm::where('id', $id)->first()->toArray() : null;
        $categoryTreeView = view('BrainorCommerce::partials.categoryTree')->with(compact('category_tree', 'cur_category'));

        $form = Form::panel([
            FormColumn::column([
                FormField::input('title', 'Название')->setRequired(true),
                FormField::input('slug', 'Ярлык (необязательно)'),
                FormField::textarea('description', 'Описание'),
                FormField::hidden('type')->setValue("offer_category"),
            ]),
            FormColumn::column([
                FormField::custom($categoryTreeView)
            ], 'col-lg-4')
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