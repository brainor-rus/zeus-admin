<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 14:15
 */

namespace Zeus\Admin\SectionBuilder\Form\Panel\Columns\BaseColumn;


use Zeus\Admin\SectionBuilder\Form\Panel\Columns\Column;

class FormColumn
{
    public static function column($fields, $class = 'col')
    {
        return new Column($fields, $class);
    }
}