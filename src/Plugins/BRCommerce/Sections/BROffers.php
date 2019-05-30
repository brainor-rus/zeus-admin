<?php

namespace Zeus\Admin\Plugins\BRCommerce\Sections;

use Zeus\Admin\Cms\Models\BRTag;
use Zeus\Admin\Cms\Models\BRTerm;
use Zeus\Admin\Plugins\BRCommerce\Models\BRAttributeName;
use Zeus\Admin\Plugins\BRCommerce\Models\BROffer;
use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Display\Table\DisplayTable;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Zeus\Admin\SectionBuilder\Meta\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BROffers extends Section
{
    protected $model = 'Zeus\Admin\Plugins\BRCommerce\Models\BROffer';
    protected $title = 'Товары';

    public static function onDisplay(){

        $display = Display::table([
            Column::text('id', '#'),
            Column::text('name', 'Название'),
            Column::text('discount', 'Скидка'),
            Column::text('price', 'Цена'),
            Column::text('category.title', 'Категория'),
            Column::text('article', 'Артикул'),
//            Column::text('producer.name', 'Производитель'),
        ])->setPagination(15);

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
            '' => ''
        ])->setScripts([
            'head' => [],
            'body' => [
                'OffersAttrFormAdd' => ('/packages/zeusAdmin/js/OffersAttrFormAdd.js')
            ]
        ]);

        $attributes = null;
        if($id) {
            $offer = BROffer::where('id', $id)->first();
            $attributes = BRAttributeName::where('category_id', $offer->category_id)
                ->whereHas('values', function ($query) use ($offer) {
                    $query->where('offer_id', $offer->id)->select('value');
                })
                ->with(array('first_value'=>function($query) use ($offer) {
                    $query->where('offer_id', $offer->id);
                }))
                ->orderBy('order')
                ->orderBy('name')
                ->get();
        }

        $form = Form::panel([
            FormColumn::column([
                FormField::input('name', 'Название')->setRequired(true),
                FormField::input('slug', 'Слаг (необязательно)'),
                FormField::Wysiwyg('description', 'Описание')
            ]),
            FormColumn::column([
                FormField::input('price', 'Цена')->setValue(0)->setRequired(true),
                FormField::input('discount', 'Скидка (%)')->setValue(0)->setRequired(true),
                FormField::input('article', 'Артикул'),
                FormField::select('category_id', 'Категория')
                    ->setRequired(true)
                    ->setModelForOptions(BRTag::class)
                    ->setQueryFunctionForModel(function ($query) {
                        return $query->offerCategories();
                    })
                    ->setDisplay('title'),
                FormField::select('visible', 'Отображение')
                    ->setOptions([
                        0 => 'Нет',
                        1 => 'Да'
                    ]),
                FormField::custom(view('BRCommerce::partials.attributes')->with(compact('offer', 'attributes')))
            ])
        ]);

        return $form->setMeta($meta);
    }
    
    public function afterSave(Request $request, $model = null)
    {
        // Атрибуты
        DB::table('b_r_attribute_values')->where('offer_id', $model->id)->delete();
        if(isset($_POST['attributes'])){
            foreach ($_POST['attributes'] as $attribute){
                $attribute_name_check = BRAttributeName::where('name', trim($attribute['name']))->where('category_id', $_POST['category_id'])->first();
                if(!isset($attribute_name_check)){
                    $attributeName = new BRAttributeName;
                    $attributeName->name = $attribute['name'];
                    $attributeName->category_id = $_POST['category_id'];
                    $attributeName->filter = 1;
                    $attributeName->save();

                    $attributeNameId = $attributeName->id;
                }
                else{
                    $attributeNameId = $attribute_name_check->id;
                }
                DB::table('b_r_attribute_values')->insert(
                    [
                        'attribute_name_id' => $attributeNameId,
                        'offer_id' => $model->id,
                        'value' => $attribute['value'],
                    ]
                );
            }
        }
    }
}