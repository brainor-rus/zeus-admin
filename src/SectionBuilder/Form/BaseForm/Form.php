<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 13:00
 */

namespace Zeus\Admin\SectionBuilder\Form\BaseForm;


use Zeus\Admin\SectionBuilder\Form\Custom\CustomForm;
use Zeus\Admin\SectionBuilder\Form\Panel\PanelForm;

class Form
{
    public static function panel($columns)
    {
        return new PanelForm($columns);
    }

    public static function custom($view)
    {
        return new CustomForm($view);
    }
}