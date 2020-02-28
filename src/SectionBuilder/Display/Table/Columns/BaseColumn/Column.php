<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 01.10.2018
 * Time: 13:07
 */

namespace Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn;

use Zeus\Admin\SectionBuilder\Display\Table\Columns\Types\Link;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\Types\Text;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\Types\Checkbox;

class Column
{
    public static function text($label, $name)
    {
        return new Text($label, $name);
    }

    public static function link($label, $name)
    {
        return new Link($label, $name);
    }

    public static function checkbox($label, $name)
    {
        return new Checkbox($label, $name);
    }
}
