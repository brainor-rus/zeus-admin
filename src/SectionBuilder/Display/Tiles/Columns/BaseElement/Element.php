<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 01.10.2018
 * Time: 13:07
 */

namespace Zeus\Admin\SectionBuilder\Display\Tiles\Columns\BaseElement;


use Zeus\Admin\SectionBuilder\Display\Tiles\Columns\Types\Text;

class Element
{
    public static function text($label, $name)
    {
        return new Text($label, $name);
    }
}