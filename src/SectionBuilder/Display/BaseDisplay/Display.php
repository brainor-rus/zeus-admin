<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 01.10.2018
 * Time: 13:15
 */

namespace Zeus\Admin\SectionBuilder\Display\BaseDisplay;


use Zeus\Admin\SectionBuilder\Display\Custom\DisplayCustom;
use Zeus\Admin\SectionBuilder\Display\Table\DisplayTable;
use Zeus\Admin\SectionBuilder\Display\Tiles\DisplayTiles;
use Zeus\Admin\SectionBuilder\Display\Trees\DisplayTrees;

class Display
{
    public static function table($columns = null, $pagination = null)
    {
        return new DisplayTable($columns ?? null, $pagination ?? 10);
    }

    public static function tiles($columns = null, $pagination = null)
    {
        return new DisplayTiles($columns ?? null, $pagination ?? 10);
    }

    public static function custom($columns = null, $pagination = null, $view = null)
    {
        return new DisplayCustom($view ?? null);
    }

    public static function trees($columns = null, $pagination = null)
    {
        return new DisplayTrees($columns ?? null, $pagination ?? 10);
    }
}
