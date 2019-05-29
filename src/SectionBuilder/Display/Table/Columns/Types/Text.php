<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 01.10.2018
 * Time: 13:10
 */

namespace Zeus\Admin\SectionBuilder\Display\Table\Columns\Types;

use Zeus\Admin\SectionBuilder\Display\Table\Columns\Types\BaseType\Type;

class Text extends Type
{
    public function render($value)
    {
        return $value;
    }
}