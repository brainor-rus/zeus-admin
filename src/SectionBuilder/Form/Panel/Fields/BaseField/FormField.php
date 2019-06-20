<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 14:21
 */

namespace Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField;


use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BSelect;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Custom;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\DatePicker;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Hidden;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Input;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\MultiSelect;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Related;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Select;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Selectize;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Textarea;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\Wysiwyg;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\DropZone;

class FormField
{
    public static function input($name, $label)
    {
        return new Input($name, $label);
    }

    public static function datepicker($name, $label, $format = 'yyyy-mm-dd')
    {
        return new DatePicker($name, $label, $format);
    }

    public static function textarea($name, $label)
    {
        return new Textarea($name, $label);
    }

    public static function Wysiwyg($name, $label)
    {
        return new Wysiwyg($name, $label);
    }

    public static function select($name, $label)
    {
        return new Select($name, $label);
    }

    public static function bselect($name, $label) {
        return new BSelect($name, $label);
    }

    public static function hidden($name)
    {
        return new Hidden($name);
    }

    public static function custom($html)
    {
        return new Custom($html);
    }

    public static function dropZone($label, $name, $id, $url)
    {
        return new DropZone($label, $name, $id, $url);
    }

    public static function related($name, $label, $model, $columns) {
        return new Related($name, $label, $model, $columns);
    }
}