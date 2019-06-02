<?php

namespace Zeus\Admin\Plugins\BrainorPay\Sections;

use Zeus\Admin\Section;
use Zeus\Admin\SectionBuilder\Display\BaseDisplay\Display;
use Zeus\Admin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Zeus\Admin\SectionBuilder\Display\Table\DisplayTable;

class Banks extends Section
{
    public static function onDisplay(){

        $display = Display::table([
            Column::text('id', '#'),
        ])->setPagination(2);

        return $display;
    }
}