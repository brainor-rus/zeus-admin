<?php

namespace App\Admin\Sections;

use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Display\Table\DisplayTable;
use Zeus\Admin\SectionBuilder\Form\BaseForm\Form;
use Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class Users extends Section
{
    protected $title = 'Пользователи';
    protected $model = '\App\User';

    public static function onDisplay(Request $request){

        $display = Display::table([
            Column::text('name', 'Имя'),
            Column::text('email', 'Email'),
            Column::text('created_at', 'Дата добавления'),
        ])->setPagination(10);

        return $display;
    }

    public static function onCreate()
    {
        return self::onEdit();
    }

    public static function onEdit()
    {
        $form = Form::panel([
            FormColumn::column([
                FormField::input('name', 'Имя')->setRequired(true),
                FormField::datepicker('date', 'Дата','2018-10-01')->setRequired(true),
                FormField::hidden('password')->setValue('asdf'),
            ]),
            FormColumn::column([
                FormField::input('email', 'Email')->setRequired(true)
                    ->setPlaceholder('Email пользователя'),
                FormField::custom('<b>Кастомное поле</b>')
            ], 'col-4'),
        ]);

        return $form;
    }

    public function isDeletable()
    {
        return true;
    }
}