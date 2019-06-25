<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 10.10.2018
 * Time: 11:54
 */

namespace Zeus\Admin\Cms\Helpers;

use Illuminate\Support\Facades\Config;
use Zeus\Admin\Cms\Models\ZeusAdminMenu;
use Zeus\Admin\Cms\Models\ZeusAdminMenuElement;

class MenuHelper
{
    public static function getMenuTreeById($id)
    {
        $elementsTree = ZeusAdminMenuElement::where('menu_id', $id)->defaultOrder()->get()->toTree();
        return $elementsTree;
    }
}